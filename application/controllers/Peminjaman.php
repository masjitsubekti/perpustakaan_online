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

    public function read_anggota()
	{
        $id_anggota = $this->input->post('id_anggota');
        $data_anggota = $this->M_main->get_where('t_anggota', 'id_anggota', $id_anggota);
        $data['id_anggota'] = $id_anggota;
        $data['data_anggota'] = $data_anggota;
		$this->load->view('sistem/peminjaman/v-detail-peminjaman',$data);
    }

    function sisipkan_td_peminjaman(){
        $kode_buku = $this->input->post('kode_buku');
        $nextform = $this->input->post('nextform');
        $response['success'] = true;
        $response['message'] = "Coba Sweet";
        $response['kode_buku'] = $kode_buku;
        $response['nomor_urut'] = $nextform;
        echo json_encode($response);
    }
}

/* End of file Beranda.php */
