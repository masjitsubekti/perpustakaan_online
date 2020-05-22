<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $nama_menu  = "User";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('User_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('User'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "user/v-user.php";
        $this->parser->parse('sistem/template', $data);
    }    

    public function read_data($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
		
      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->User_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->User_m->list_data($key, $limit, $offset, $column, $sort);

		  $this->load->view('sistem/user/v-data-user',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        $data['list_role'] = $this->M_main->get_all('roles')->result();
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_user'] = $this->User_m->detail_user($id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/user/v-modal-user',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama = strip_tags(trim($this->input->post('nama_user')));
        $username = strip_tags(trim($this->input->post('username')));
        $email = strip_tags(trim($this->input->post('email')));
        $password = md5(md5(strip_tags($this->input->post('password'))));
        $hak_akses = strip_tags(trim($this->input->post('hak_akses')));

        if($modeform == 'ADD'){
            $get_username = $this->M_main->get_where('users','username',$username)->num_rows();   
            $get_email = $this->M_main->get_where('users','email',$email)->num_rows();

            if($get_username!=0){
              $response['success'] = FALSE;
              $response['message'] = "Maaf, Username Sudah Terdaftar, Harap gunakan username lain !";
       
              $username = $this->session->userdata('auth_username');
              insert_log($username, "Tambah User", 'Username Sudah Terdaftar', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }else if($get_email!=0){
              $response['success'] = FALSE;
              $response['message'] = "Maaf, Email Sudah Terdaftar !";
            
              $username = $this->session->userdata('auth_username');
              insert_log($username, "Tambah User", 'Email Sudah Terdaftar', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }else{
              $id = $this->uuid->v4(false);
              date_default_timezone_set('Asia/Jakarta');
              $data_object = array(
                  'id_user' => $id, 
                  'name'=>$nama,
                  'username'=>$username,
                  'email'=>$email,
                  'password'=>$password,
                  'created_at'=>date('Y-m-d H:i:s'),
                  'status'=>'1',
              );
              $this->db->insert('users', $data_object);

              $id_has_roles = $this->uuid->v4(false);
              $data_akses = array(
                  'id_has_roles' => $id_has_roles,
                  'id_roles'=>$hak_akses,
                  'id_user'=>$id,
                  'created_at'=>date('Y-m-d H:i:s'),
              );
              $this->db->insert('user_has_roles', $data_akses);

              $response['success'] = TRUE;
              $response['message'] = "Data User Berhasil Disimpan";

              $username = $this->session->userdata('auth_username');
              insert_log($username, "Tambah User", 'Berhasil Tambah User', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }
        }else if($modeform == 'UPDATE'){

            $id_user = strip_tags(trim($this->input->post('id_user')));

            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(  
                'name'=>$nama,
                'username'=>$username,
                'email'=>$email,
                'password'=>$password,
                'updated_at'=>date('Y-m-d H:i:s'),
            );
				
            $this->db->where('id_user',$id_user);
            $this->db->update('users', $data_object);

            $this->db->where(array('id_user' => $id_user, 'id_roles' => $hak_akses));
            $this->db->delete('user_has_roles');
            
            $id_has_roles = $this->uuid->v4(false);
            $data_akses = array(
                'id_has_roles' => $id_has_roles,
                'id_roles'=>$hak_akses,
                'id_user'=>$id_user,
                'created_at'=>date('Y-m-d H:i:s'),
            );
            $this->db->insert('user_has_roles', $data_akses);

            $response['success'] = true;
            $response['message'] = "Data User Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit User", 'Berhasil Edit User', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        }
        echo json_encode($response);   
    }

    public function nonaktifkan(){
      if($this->input->post('id')){
        $id = $this->input->post('id');
        date_default_timezone_set('Asia/Jakarta');
        $object = array(
          'status' => '3', // diblokir
        );
        $this->db->where('id_user', $id);
        $this->db->update('users', $object);
        
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus User", 'Berhasil Hapus User', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());        
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
    }
    
    public function aktifkan(){
      if($this->input->post('id')){
        $id = $this->input->post('id');
        date_default_timezone_set('Asia/Jakarta');
        $object = array(
          'status' => '1', // diaktifkan
        );
        $this->db->where('id_user', $id);
        $this->db->update('users', $object);
        
        $response['success'] = true;
        $response['message'] = "Data berhasil diaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Aktifkan User", 'Berhasil aktifkan User', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());        
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
	}
}

/* End of file User.php */
