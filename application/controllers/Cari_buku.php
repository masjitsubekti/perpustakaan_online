<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cari_buku extends CI_Controller {

  private $nama_menu  = "Cari Buku";     

  public function __construct()
  {
    parent::__construct();
    $this->apl = get_apl();
    $this->load->model('Menu_m');
    $this->load->model('Buku_m');
    $this->load->model('M_main');
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
    $this->mybreadcrumb->add('Cari Buku', site_url('Cari_buku'));
    $data['breadcrumbs'] = $this->mybreadcrumb->render();
    // End Breadcrumbs

    $data['content'] = "buku/v-katalog.php";
    $this->parser->parse('sistem/template', $data);
  }    

  public function detail_katalog($kode_buku)
  {
    $this->Menu_m->role_has_access($this->nama_menu);

    $data['app'] = $this->apl;
    $data['nama_menu'] = $this->nama_menu;
    $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

    // Breadcrumbs
    $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
    $this->mybreadcrumb->add('Cari Buku', site_url('Cari_buku'));
    $this->mybreadcrumb->add('Detail Katalog', site_url('Cari_buku/detail_katalog'));
    $data['breadcrumbs'] = $this->mybreadcrumb->render();
    // End Breadcrumbs
    
    $data['book'] = $this->Buku_m->detail_buku($kode_buku)->row_array();
    $data['content'] = "buku/v-detail-katalog.php";
    $this->parser->parse('sistem/template', $data);
  }

}

/* End of file Cari_buku.php */
