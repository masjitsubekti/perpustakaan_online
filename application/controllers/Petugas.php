<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

  private $nama_menu  = "Data Petugas";     

  public function __construct()
  {
      parent::__construct();
      $this->apl = get_apl();
      $this->load->model('Menu_m');
      $this->load->model('M_main');
      $this->load->model('Petugas_m');
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
      $this->mybreadcrumb->add($this->nama_menu, site_url('Petugas'));
      $data['breadcrumbs'] = $this->mybreadcrumb->render();
      // End Breadcrumbs

      $data['content'] = "petugas/list-petugas.php";
      $this->parser->parse('sistem/template', $data);
  }
  
  public function read_petugas(){
    $data['list_petugas'] = $this->Petugas_m->list_petugas();
    $this->load->view('sistem/petugas/data-petugas',$data);
  }
}

/* End of file Petugas.php */
