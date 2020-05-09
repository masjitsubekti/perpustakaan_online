<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengembalian extends CI_Controller {

    private $nama_menu  = "Pengembalian";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Anggota_m');
        $this->load->model('Peminjaman_m');
        $this->load->model('Pengembalian_m');
        must_login();
    }
    
    public function index(){
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
        
        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Pengembalian', site_url('Pengembalian'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        $data['content'] = "pengembalian/v-pengembalian.php";
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

    public function read_data($pg=1)
	{
		$key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
		$limit	= $this->input->post("limit");
		$offset = ($limit*$pg)-$limit;
		$column = $this->input->post('column');
        $sort = $this->input->post('sort');
        $id_anggota = $this->input->post('id_anggota');
		
		$page              = array();
		$page['limit']     = $limit;
		$page['count_row'] = $this->Pengembalian_m->list_count($id_anggota,$key)['jml'];
        $page['current']   = $pg;
		$page['list']      = gen_paging($page);
		$data['paging']    = $page;
		$data['list']      = $this->Pengembalian_m->list_data($id_anggota, $key, $limit, $offset, $column, $sort);

		$this->load->view('sistem/pengembalian/v-data-pengembalian',$data);
    }

    public function kembali(){
        $id_detail_peminjaman = $this->input->post('id');
        $id_user = $this->session->userdata('auth_id_user');
        $peminjaman = $this->Pengembalian_m->detail_peminjaman($id_detail_peminjaman)->row_array();

        //Simpan Pengembalian
        $id = $this->uuid->v4(false);
        date_default_timezone_set('Asia/Jakarta');
        $data_object = array(
            'id_pengembalian' => $id,
            'id_detail_peminjaman'=>$id_detail_peminjaman,
            'id_user'=>$id_user,
            'tgl_pengembalian'=>date('Y-m-d'),
            'hari_terlambat'=>$peminjaman['terlambat'],
            'denda'=>$peminjaman['denda'],
            'status'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        );
        $this->db->insert('t_pengembalian', $data_object);

        // Update Peminjaman
        $data_pinjam = array(
            'status'=>'2',
        );    
        $this->db->where('id_detail_peminjaman',$id_detail_peminjaman);
        $this->db->update('t_detail_peminjaman', $data_pinjam);

        $response['success'] = true;
        $response['message'] = "Buku Berhasil Dikembalikan !";
        echo json_encode($response);
    }

    public function perpanjang(){
        $id_detail_peminjaman = $this->input->post('id');
        $peminjaman = $this->Pengembalian_m->detail_peminjaman($id_detail_peminjaman)->row_array();
        $perpanjangan = ($peminjaman['perpanjangan']!="") ? $peminjaman['perpanjangan'] : 0;
        $lama_pinjam = $peminjaman['lama_pinjam'];
        $max_perpanjangan = $peminjaman['max_perpanjangan'];

        if($perpanjangan>=$max_perpanjangan){
            $response['success'] = false;
            $response['message'] = "Total Kuota Perpanjangan Buku Sudah Maksimal !";
        }else{
            $diperpanjang = $perpanjangan + 1;
            $tgl_kembali_lama = $peminjaman['tgl_kembali'];
            $tgl_kembali = date('Y-m-d', strtotime('+'.$lama_pinjam.' days', strtotime($tgl_kembali_lama)));        
            // Update Peminjaman
            $data_pinjam = array(
                'tgl_kembali'=>$tgl_kembali,
                'perpanjangan'=>$diperpanjang,
                'flag_perpanjangan'=>'1',
            );    
            $this->db->where('id_detail_peminjaman',$id_detail_peminjaman);
            $this->db->update('t_detail_peminjaman', $data_pinjam);

            $response['success'] = true;
            $response['message'] = "Buku Berhasil Diperpanjang !";
        }   
        echo json_encode($response);    
    }

}

/* End of file Pengembalian.php */
