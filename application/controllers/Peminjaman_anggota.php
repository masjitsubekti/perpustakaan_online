<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peminjaman_anggota extends CI_Controller {

  private $nama_menu  = "Beranda";     

  public function __construct()
  {
    parent::__construct();
    $this->apl = get_apl();
    $this->load->model('Menu_m');
    $this->load->model('M_main');
    $this->load->model('Histori_peminjaman_m');
    $this->load->model('Anggota_m');
    $this->load->model('Peminjaman_m');
    must_login();
  }
  
  public function histori_peminjaman()
  {
    $this->Menu_m->role_has_access($this->nama_menu);

    $data['app'] = $this->apl;
    $data['nama_menu'] = $this->nama_menu;
    $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
    
    // Breadcrumbs
    $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
    $this->mybreadcrumb->add('Histori Peminjaman', site_url('Peminjaman_anggota/histori_peminjaman'));
    $data['breadcrumbs'] = $this->mybreadcrumb->render();
    // End Breadcrumbs
    $id_user = $this->session->userdata("auth_id_user");
    $data_anggota = $this->M_main->get_where('t_anggota','id_user',$id_user)->row_array();
    $data['id_anggota'] = $data_anggota['id_anggota'];
    $data['content'] = "peminjaman_anggota/timeline-peminjaman.php";
    $this->parser->parse('sistem/template', $data);
  } 

  public function peminjaman_aktif()
  {
    $this->Menu_m->role_has_access($this->nama_menu);

    $data['app'] = $this->apl;
    $data['nama_menu'] = $this->nama_menu;
    $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
    
    // Breadcrumbs
    $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
    $this->mybreadcrumb->add('Peminjaman Aktif', site_url('Peminjaman_anggota/peminjaman_aktif'));
    $data['breadcrumbs'] = $this->mybreadcrumb->render();
    // End Breadcrumbs
    
    $id_user = $this->session->userdata("auth_id_user");
    $data_anggota = $this->M_main->get_where('t_anggota','id_user',$id_user)->row_array();
    $data['id_anggota'] = $data_anggota['id_anggota'];
    $data['content'] = "peminjaman_anggota/peminjaman-aktif.php";
    $this->parser->parse('sistem/template', $data);
  }    
  
  public function read_histori_peminjaman(){
    $id_anggota = $this->input->post('id_anggota');
    $data['list_peminjaman'] = $this->Histori_peminjaman_m->list_peminjaman($id_anggota);
    $this->load->view('sistem/peminjaman_anggota/data-histori',$data);
  }

  public function read_peminjaman_aktif(){
    $id_anggota = $this->input->post('id_anggota');
    $data['list'] = $this->Histori_peminjaman_m->get_peminjaman_aktif($id_anggota);
    $this->load->view('sistem/peminjaman_anggota/data-peminjaman-aktif',$data);
  }

  public function modal_detail(){
    $id_detail_peminjaman = $this->input->post('id_detail_peminjaman');
    $data['detail'] = $this->Histori_peminjaman_m->detail_peminjaman_anggota($id_detail_peminjaman)->row_array();
    $this->load->view('sistem/peminjaman_anggota/modal-detail',$data);
  }

  function pinjam(){
    $id_anggota = $this->input->post('id_anggota');
    $kode_buku = $this->input->post('kode_buku');
    $data_anggota = $this->Anggota_m->get_anggota($id_anggota)->row_array();
    $tanggungan = $this->Peminjaman_m->get_peminjaman_anggota($id_anggota)->num_rows();
    $cek_peminjaman = $this->Peminjaman_m->cek_peminjaman_buku($id_anggota,$kode_buku);

    $maximum = $data_anggota['max_peminjaman'];
    $lama_pinjam = $data_anggota['lama_pinjam'];
    $max_pinjam = $maximum - $tanggungan; 

    $cek_stok = $this->Peminjaman_m->cek_ketersediaan_buku($kode_buku)->row_array();
    $ketersediaan_buku = $cek_stok['sisa'];

    if($ketersediaan_buku==0){
        $response['success'] = false;
        $response['message'] = "Maaf, Buku tidak bisa dipinjam, ketersediaan buku saat ini kosong !";
    }else if($cek_peminjaman->num_rows()!=0){
        $response['success'] = false;
        $response['message'] = "Maaf, Buku telah dipinjam pada peminjaman sebelumnya, dan masih belum dikembalikan !";
    }else if($max_pinjam==0){
        $response['success'] = false;
        $response['message'] = "Maksimal Pinjam Hanya ". $maximum ." Items, Silahkan Cek Peminjaman Anda !";
    }else{
        // $buku = $data_buku->row_array();
        $tgl_pinjam = date('Y-m-d');
        $tgl_kembali = date('Y-m-d', strtotime('+'.$lama_pinjam.' days', strtotime($tgl_pinjam)));
        $id_user = $this->session->userdata('auth_id_user');
        // save peminjaman
        $id_pinjam = $this->M_main->get_no_otomatis('t_peminjaman','id_peminjaman','PJ');
        date_default_timezone_set('Asia/Jakarta');
        $data_pinjam = array(
            'id_peminjaman' => $id_pinjam,
            'id_anggota'    => $id_anggota,
            'id_user'       => $id_user,
            'status'        => '1',
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_peminjaman',$data_pinjam);
  
        // save detail peminjaman
        $id_dp = $this->uuid->v4(false);
        $data_detail = array(
            'id_detail_peminjaman'  => $id_dp,
            'id_peminjaman'         => $id_pinjam,
            'kode_buku'             => $kode_buku,
            'tgl_pinjam'            => $tgl_pinjam,
            'tgl_kembali'           => $tgl_kembali,
            'jumlah'                => 1,
            'flag_perpanjangan'     => '0',
            'status'                => '1',
            'created_at'            => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_detail_peminjaman',$data_detail);
      
        $response['success'] = true;
        $response['message'] = "Peminjaman Berhasil !";
    }
    echo json_encode($response);
  }

}

/* End of file Peminjaman_anggota.php */
