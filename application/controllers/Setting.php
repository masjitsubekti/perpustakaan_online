<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {

    private $nama_menu  = "Setting Aplikasi";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        must_login();
    }
    
    public function index(){
      $this->Menu_m->role_has_access($this->nama_menu);

      $data['app'] = $this->apl;
      $data['nama_menu'] = $this->nama_menu;
      $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];        
      // Breadcrumbs
      $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
      $this->mybreadcrumb->add($this->nama_menu, site_url('Config_aplikasi'));
      $data['breadcrumbs'] = $this->mybreadcrumb->render();
      // End Breadcrumbs
      $data['content'] = "aplikasi/v-form-aplikasi.php";
      $this->parser->parse('sistem/template', $data);
    }    

    public function simpan(){
      $this->form_validation->set_rules('id', 'id', 'required');
      $this->form_validation->set_rules('nama_sistem', 'nama_sistem', 'required');
      $this->form_validation->set_rules('nama', 'nama', 'required');
      $this->form_validation->set_rules('url_root', 'url_root', 'required');
      $this->form_validation->set_rules('email', 'email', 'required');
      if ($this->form_validation->run() == FALSE) {
        $response['success'] = false;
        $response['message'] = 'Kolom yang memiliki tanda bintang "*", maka wajib diisi.';

        $username = $this->session->userdata('auth_username');
        insert_log($username, "Setting Aplikasi", 'Kolom yang memiliki tanda bintang "*", maka wajib diisi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
      } else {
        $id = strip_tags($this->input->post('id'));
        $nama_instansi = strip_tags($this->input->post("nama"));
        $email = strip_tags($this->input->post("email"));
        $jalan = strip_tags($this->input->post("jalan"));
        $kelurahan = strip_tags($this->input->post("kelurahan"));
        $kecamatan = strip_tags($this->input->post("kecamatan"));
        $kabupaten = strip_tags($this->input->post("kabupaten"));
        $provinsi = strip_tags($this->input->post("provinsi"));
        $kode_pos = strip_tags($this->input->post("kode_pos"));	
        $nama_sistem = strip_tags($this->input->post("nama_sistem"));	
        $url_root = $this->input->post("url_root");	
        $akronim_nama_sistem = strip_tags($this->input->post("akronim_nama_sistem"));	
        $telp = strip_tags($this->input->post("telp"));	
        $fax = strip_tags($this->input->post("fax"));	
        $tagline = strip_tags($this->input->post("tagline"));	
        $pass_email = strip_tags($this->input->post("pass_email"));	
        $logo_instansi = lakukan_upload_file('logo_instansi','/assets/data/aplikasi/','jpg|png|jpeg');
        $logo_favicon = lakukan_upload_file('logo_favicon','/assets/data/aplikasi/','jpg|png|jpeg');
        $cek_upload = $this->M_main->get_where('app_config','id',$id)->row_array();
           
        date_default_timezone_set('Asia/Jakarta');
        $object = array(
          'nama_sistem' => $nama_sistem,
          'tagline' => $tagline,
          'instansi' => $nama_instansi, 
          'logo' => (!empty($_FILES["logo_instansi"]["tmp_name"])) ? $logo_instansi['file_name'] : $cek_upload['logo'], 
          'favicon' => (!empty($_FILES["logo_favicon"]["tmp_name"])) ? $logo_favicon['file_name'] : $cek_upload['favicon'],
          'email_instansi' => $email,
          'pass_instansi' => $pass_email,
          'url_root' => $url_root,
          'jalan' => $jalan, 
          'kelurahan' => $kelurahan, 
          'kecamatan' => $kecamatan, 
          'kabupaten' => $kabupaten, 
          'provinsi' => $provinsi,
          'kode_pos' => $kode_pos,
          'telp' => $telp,
          'fax' => $fax,
          'akronim_nama_sistem' => $akronim_nama_sistem,
        );
  
        $this->db->where('id',$id);
        $this->db->update('app_config', $object);
  
        $response['success'] = TRUE;
        $response['message'] = "Aplikasi berhasil diperbarui !";
        $response['page'] = site_url('Setting');

        $username = $this->session->userdata('auth_username');
        insert_log($username, "Setting Aplikasi", 'Berhasil Ubah Setting Aplikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
      }
      echo json_encode($response);			
    }
}

/* End of file Setting.php */
