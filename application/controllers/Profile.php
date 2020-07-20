<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

  private $nama_menu  = "Profile";     

  public function __construct()
  {
    parent::__construct();
    $this->apl = get_apl();
    $this->load->model('Menu_m');
    $this->load->model('M_main');
    must_login();
  }
  
  public function index()
  {
    // $this->Menu_m->role_has_access($this->nama_menu);
    $data['app'] = $this->apl;
    $data['nama_menu'] = $this->nama_menu;
    $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
    // Breadcrumbs
    $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
    $this->mybreadcrumb->add('Profile', site_url('Profile'));
    $data['breadcrumbs'] = $this->mybreadcrumb->render();
    // End Breadcrumbs
    $id_user = $this->session->userdata("auth_id_user");
    $data_user = $this->M_main->get_where('users','id_user',$id_user)->row_array();
    $data['data_user'] = $data_user;   
    $data['content'] = "profile/v-profile.php";
    $this->parser->parse('sistem/template', $data);
  }
  
  public function load_modal_foto(){
    $id = $this->input->post('id');
    $data['id_user'] = $id; 
    $this->load->view('sistem/profile/modal-foto.php',$data);
  }

  public function simpan_foto(){
    $id_user = $this->input->post('id_user');
    $cek_user = $this->M_main->get_where('users','id_user',$id_user)->num_rows();                    
    if($cek_user!=0){
      $file_foto = lakukan_upload_file('input_file_foto','/assets/data/pp_user/','jpg|png|jpeg');
      $data_object = array(
        'foto' => $file_foto['file_name'], 
      );
      $this->db->where('id_user',$id_user);
      $this->db->update('users',$data_object);
      $response['success'] = TRUE;
      $response['message'] = "Foto Berhasil Diperbarui";
    }else{
      $response['success'] = FALSE;
      $response['message'] = "Data Tidak Ditemukan !";
    }
    echo json_encode($response);
  }

  function update_password() {
    $id = $this->input->post('id_user_pass');
    $password = $this->input->post("konfirm_password");
    date_default_timezone_set('Asia/Jakarta');
    $object = array(
      'password' => md5(md5($password)), 
      'updated_at' => date('Y-m-d H:i:s')
    );
    $this->db->where('id_user',$id);
    $this->db->update('users', $object);
    
    $response['success'] = TRUE;
    $response['message'] = "Password Berhasil Diperbarui!";
    echo json_encode($response);	
  }

  function update_profile() {
    $id = $this->input->post('id_user_profile');
    $nama_user = $this->input->post("nama_user");
    date_default_timezone_set('Asia/Jakarta');
    $object = array( 
      'name' => $nama_user, 
      'updated_at' => date('Y-m-d H:i:s')
    );
    $this->db->where('id_user',$id);
    $this->db->update('users', $object);
    
    $response['success'] = TRUE;
    $response['message'] = "Data Profil berhasil Diperbarui!";
    echo json_encode($response);	
  }
}

/* End of file Profile.php */
