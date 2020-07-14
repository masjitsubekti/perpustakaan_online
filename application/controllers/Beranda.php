<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Beranda extends CI_Controller {

  private $nama_menu  = "Beranda";     

  public function __construct()
  {
    parent::__construct();
    $this->apl = get_apl();
    $this->load->model('Menu_m');
    $this->load->model('Dashboard_m');
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
    $roles = $this->session->userdata("auth_id_role");
    if($roles=="HA05"){
      $data['content'] = "beranda/v-beranda-anggota.php";
    }else if($roles=="HA01"){
      $data['content'] = "beranda/v-dashboard.php";
    }else{
      $data['content'] = "beranda/v-beranda.php";    
    }

    $this->parser->parse('sistem/template', $data);
  }    

  public function load_dashboard(){
    // dashboard atas
    $data['anggota'] = $this->Dashboard_m->count_anggota()->row_array();
    $data['buku'] = $this->Dashboard_m->count_buku()->row_array();
    $data['rak'] = $this->Dashboard_m->count_rak()->row_array();
    $data['jenis_koleksi'] = $this->Dashboard_m->count_jenis_koleksi()->row_array();
    
    // chart perbulan
    date_default_timezone_set('Asia/Jakarta');
    $tahun = date('Y');
    $bulan = date('m');
    $data['tahun'] = $tahun;
    $data['bulan'] = $bulan;
    $data['pie'] = $this->Dashboard_m->chart_perbulan($bulan, $tahun)->row_array();
    $this->load->view('sistem/beranda/data-dashboard.php',$data);
  }
}

/* End of file Beranda.php */
