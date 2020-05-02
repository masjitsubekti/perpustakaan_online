<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    private $nama_menu  = "Beranda";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
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
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        $data['content'] = "beranda/v-beranda.php";
        $this->parser->parse('sistem/template', $data);
    }    


    public function cetak(){
        $data = array(
            "dataku" => array(
                "nama" => "Petani Kode",
                "url" => "http://petanikode.com"
            )
        );

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "REKAP EVALUASI PENYELENGGARAAN.pdf";
        $this->pdf->load_view('sistem/beranda/cetak.php', $data);
    }
}

/* End of file Beranda.php */
