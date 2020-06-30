<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    private $nama_menu  = "Peminjaman";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Peminjaman_m');
        $this->load->model('Anggota_m');
        must_login();
    }
    
    public function index()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
        
        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Peminjaman', site_url('Peminjaman'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        $data['content'] = "peminjaman/v-peminjaman.php";
        $this->parser->parse('sistem/template', $data);
    }
    
    public function jatuh_tempo(){
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
        
        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Jatuh Tempo', site_url('Peminjaman/terlambat'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        $data['content'] = "peminjaman/v-terlambat.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function read_anggota(){
        $id_anggota = $this->input->post('id_anggota');
        $data_anggota = $this->Anggota_m->get_anggota($id_anggota);
        
        if($data_anggota->num_rows()==0){
            $response['success'] = false;
            $response['message'] = "Maaf, ID Anggota tidak ditemukan !";
        }else{
            $anggota = $data_anggota->row_array();
            $peminjaman = $this->Peminjaman_m->get_peminjaman_anggota($id_anggota)->num_rows();
            $response['id_anggota'] = ($anggota['id_anggota']!="") ? $anggota['id_anggota'] : "-";
            $response['nama_anggota'] = ($anggota['nama_anggota']!="") ? $anggota['nama_anggota'] : "-";
            $response['jenis_anggota'] = ($anggota['nama_jenis_anggota']!="") ? $anggota['nama_jenis_anggota'] : "-";
            $response['lama_pinjam'] = ($anggota['lama_pinjam']!="") ? $anggota['lama_pinjam'] : "-";
            $response['max_pinjam'] = ($anggota['max_peminjaman']!="") ? $anggota['max_peminjaman'] : 0;
            $response['tanggungan'] = $peminjaman;

            $response['success'] = true;
            $response['message'] = "ID Anggota ditemukan !";
        }
        echo json_encode($response);
    }

    function sisipkan_td_peminjaman(){
        $id_anggota = $this->input->post('id_anggota');
        $kode_buku = $this->input->post('kode_buku');
        $nextform = $this->input->post('nextform');
        $data_buku = $this->db->get_where('t_buku', array('kode_buku' => $kode_buku, 'status' => '1'));
        $data_anggota = $this->Anggota_m->get_anggota($id_anggota)->row_array();
        $tanggungan = $this->Peminjaman_m->get_peminjaman_anggota($id_anggota)->num_rows();
        $cek_peminjaman = $this->Peminjaman_m->cek_peminjaman_buku($id_anggota,$kode_buku);

        $maximum = $data_anggota['max_peminjaman'];
        $lama_pinjam = $data_anggota['lama_pinjam'];
        $max_pinjam = $maximum - $tanggungan; 

        if($data_buku->num_rows()==0){
            $response['success'] = false;
            $response['message'] = "Maaf, Kode Buku tidak ditemukan !";
        }else{
            $cek_stok = $this->Peminjaman_m->cek_ketersediaan_buku($kode_buku)->row_array();
            $ketersediaan_buku = $cek_stok['sisa'];

            if($ketersediaan_buku==0){
                $response['success'] = false;
                $response['message'] = "Maaf, Buku tidak bisa dipinjam, ketersediaan buku saat ini kosong !";
            }else if($cek_peminjaman->num_rows()!=0){
                $response['success'] = false;
                $response['message'] = "Maaf, Buku telah dipinjam pada peminjaman sebelumnya, dan masih belum dikembalikan !";
            }else{
                $buku = $data_buku->row_array();
                $tgl_pinjam = date('Y-m-d');
                $tgl_kembali = date('Y-m-d', strtotime('+'.$lama_pinjam.' days', strtotime($tgl_pinjam)));
                
                $response['kode_buku'] = $buku['kode_buku'];
                $response['judul'] = $buku['judul'];
                $response['format_tanggal_pinjam'] = $tgl_pinjam;
                $response['format_tanggal_kembali'] = $tgl_kembali;
                $response['tanggal_pinjam'] = ($tgl_pinjam!="") ? tgl_indo($tgl_pinjam) : "-" ;
                $response['tanggal_kembali'] = ($tgl_kembali!="") ? tgl_indo($tgl_kembali) : "-" ;
                $response['foto'] = $buku['foto'];

                $response['nomor_urut'] = $nextform;

                $response['success'] = true;
                $response['message'] = "Berhasil menambahkan buku !";
            }
        }
        echo json_encode($response);
    }

    public function simpan_peminjaman(){
        $id_anggota = $this->input->post('f_idAnggota');
        $kode_buku = $this->input->post('td_kodeBuku');
        $tgl_pinjam = $this->input->post('td_tglPinjam');
        $tgl_kembali = $this->input->post('td_tglKembali');
        $id_user = $this->session->userdata('auth_id_user');
        
        // $status = '';
        $count_row = $this->input->post('jumlah_row');
        // for($i = 0; $i < $count_row; $i++) {
        //     if($kode_buku[$i]){

        //     }
        // }

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
        for($i = 0; $i < $count_row; $i++) {
            $id_dp = $this->uuid->v4(false);
            $data_detail = array(
                'id_detail_peminjaman'  => $id_dp,
                'id_peminjaman'         => $id_pinjam,
                'kode_buku'             => $kode_buku[$i],
                'tgl_pinjam'            => $tgl_pinjam[$i],
                'tgl_kembali'           => $tgl_kembali[$i],
                'jumlah'                => 1,
                'flag_perpanjangan'     => '0',
                'status'                => '1',
                'created_at'            => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_detail_peminjaman',$data_detail);
            $response['data_detail_peminjaman'][] = $data_detail;
        }

        $response['success'] = true;
        $response['message'] = "Peminjaman Berhasil Disimpan !";
        echo json_encode($response);
    }

    public function load_modal_max(){
        $id_anggota = $this->input->post('id_anggota');
        $jumlah = $this->input->post('jumlah');
        $tanggungan = $this->input->post('tanggungan');
        $max_pinjam = $this->input->post('max_pinjam');
        $anggota = $this->M_main->get_where('t_anggota','id_anggota',$id_anggota)->row_array();
        $total = $tanggungan + $jumlah;

        $data['id_anggota'] = $anggota['id_anggota'];
        $data['nama_anggota'] = $anggota['nama_anggota'];
        $data['jumlah']     = $jumlah;
        $data['tanggungan'] = $tanggungan;
        $data['max_pinjam'] = $max_pinjam;
        $data['total']      = $total;
        $this->load->view('sistem/peminjaman/modal-max',$data);
    }

    public function read_data_terlambat($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
      
      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->Peminjaman_m->list_count_terlambat($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Peminjaman_m->list_data_terlambat($key, $limit, $offset, $column, $sort);
  
      $this->load->view('sistem/peminjaman/v-data-terlambat',$data);
    }

    public function load_modal_catatan(){
      $id = $this->input->post('id');
      $pecahkan = explode('/', $id);
      $data['id_anggota'] = $pecahkan[0];
      $data['id_detail_peminjaman'] = $pecahkan[1];
      $data_pinjam = $this->Peminjaman_m->get_peminjaman_perid($pecahkan[1])->row_array();
      $data['data_pinjam'] = $data_pinjam;
      $this->load->view('sistem/peminjaman/modal-catatan',$data);
    }

    public function kirim_notif(){
      $id_anggota = $this->input->post('id_anggota');
      $id_detail_peminjaman = $this->input->post('id_detail_peminjaman');
      $catatan = $this->input->post('catatan');
      $data_pinjam = $this->Peminjaman_m->get_peminjaman_perid($id_detail_peminjaman)->row_array();
      $anggota = $this->M_main->get_where('t_anggota', 'id_anggota', $id_anggota)->row_array();
      $nama = $anggota['nama_anggota'];
      $email = $anggota['email'];

      $response['success'] = TRUE;
      $response['message_email'] = api_notif_jatuh_tempo($nama,$email,$catatan,$data_pinjam);		    
      $response['message'] = "Notifikasi Berhasil Dikirim !";
      $response['page'] = "Auth";
      echo json_encode($response);
    }
}

/* End of file Beranda.php */
