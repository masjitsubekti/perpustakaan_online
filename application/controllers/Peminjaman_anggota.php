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
  
  public function read_histori_peminjaman(){
    $id_anggota = $this->input->post('id_anggota');
    $data['list_peminjaman'] = $this->M_main->get_where('t_peminjaman','id_anggota',$id_anggota);
    $this->load->view('sistem/peminjaman_anggota/data-histori',$data);
  }

  public function modal_detail(){
    $id_detail_peminjaman = $this->input->post('id_detail_peminjaman');
    $data['detail'] = $this->Histori_peminjaman_m->detail_peminjaman_anggota($id_detail_peminjaman)->row_array();
    $this->load->view('sistem/peminjaman_anggota/modal-detail',$data);
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

    $data['content'] = "peminjaman_anggota/peminjaman-aktif.php";
    $this->parser->parse('sistem/template', $data);
  }    

}

/* End of file Peminjaman_anggota.php */
