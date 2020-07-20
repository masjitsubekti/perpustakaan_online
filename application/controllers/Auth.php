<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->apl = get_apl();
		$this->load->model('Auth_m');
		$this->load->model('M_main');
	}
	
	public function index()
	{
		$data['aplikasi'] = $this->apl;
		$data['title'] = "Selamat Datang | ".$this->apl['nama_sistem'];
		$this->load->view('front/auth-login', $data);
  }
  
	public function lupa_password()
	{
		$data['aplikasi'] = $this->apl;
		$data['title'] = "Lupa Password | ".$this->apl['nama_sistem'];
		$this->load->view('front/lupa_password/lupa-password', $data);
	}

	public function check_auth(){
		$this->form_validation->set_rules('user_login', 'user_login', 'trim|required');
		$this->form_validation->set_rules('password_login', 'password_login', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$response['success'] = false;
			$response['message'] = "Username atau Password tidak boleh kosong !";
		}
		else
		{
			$email = strip_tags($this->input->post('user_login'));
			$password = md5(md5(strip_tags($this->input->post('password_login'))));
			$username = $email;
			
			$cek_status = $this->Auth_m->cek_status_by_email_pass($email,$password);
			if($cek_status->num_rows()!=0){
				$cek_status = $cek_status->row_array();
				$status = $cek_status['status'];

				//cek status (aktif, belum diverifikasi, terblokir)
				if($status=="3"){
					$response['success'] = false;
					$response['message'] = "Akun Anda diblokir oleh sistem, hubungi pusat bantuan untuk memulihkannya !";
					insert_log($username, "Login Aplikasi", 'Akun Diblokir', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
				}elseif($status=="2"){
					$response['success'] = false;
					$response['message'] = "Anda belum memverifikasi Email yang telah kami kirimkan ke $email !";
					insert_log($username, "Login Aplikasi", 'Email Belum Diverifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
				}elseif($status=="1"){
					$cek_login = $this->Auth_m->cek_login($cek_status['id_user']);
					if($cek_login->num_rows()!=0){
						//user ditemukan
						$data_login=$cek_login->result();
						
						$array = array(
							'auth_id_user' => $data_login[0]->user_id, 
							'auth_nama_user' => $data_login[0]->nama_user,
							'auth_email' => $data_login[0]->email,
							'auth_username' => $username,
							'auth_foto' => $data_login[0]->foto,
							'auth_pilih_role' => FALSE,
						);
						$this->session->set_userdata( $array );
						
						if($cek_login->num_rows()>1){
							// user punya lebih dari 1 akses
							
							$array_pilih = array(
								'auth_pilih_role' => TRUE,
							);
							$this->session->set_userdata( $array_pilih );
							
							$response['success'] = true;
							$response['message'] = "Berhasil Login, Silahkan Pilih Akses !";
							$response['page'] = 'Auth/choose';
							insert_log($username, "Login Aplikasi", 'Berhasil Login Pilih Akses', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
						}else{
							//user hanya punya 1 akses
							$array_role = array(
								'auth_pilih_role' => FALSE,
								'auth_is_login' => TRUE,
								'auth_id_role' => $data_login[0]->role_id, 
								'auth_nama_role' => $data_login[0]->nama_role, 
							);
							$this->session->set_userdata( $array_role );

							$response['success'] = true;
							$response['message'] = "Selamat Datang ".$data_login[0]->nama_user." !";
							$response['page'] = 'Beranda';
							insert_log($username, "Login Aplikasi", 'Berhasil Login', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
						}

					}else{
						//Akun Anda user salah
						$response['success'] = false;
						$response['message'] = "Akun Anda Tidak Ditemukan !";
						insert_log($username, "Login Aplikasi", 'Akun Tidak Ditemukan', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
					}
				}else{
					$response['success'] = false;
					$response['message'] = "Akun Anda dinonaktifkan !";
					insert_log($username, "Login Aplikasi", 'Akun Dinonaktifkan', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
				}
			}else{
				//Akun Anda user salah
				$response['success'] = false;
				$response['message'] = "Akun Anda Tidak Ditemukan !";
				insert_log($username, "Login Aplikasi", 'Akun Tidak Ditemukan', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
			}
		}
		echo json_encode($response);
	}
	public function choose(){ //method yang menampilkan pilihan akses user
		$sesi_pilih_role = $this->session->userdata('auth_pilih_role');
		if($sesi_pilih_role == TRUE){
			$data['aplikasi'] = $this->apl;
			$data['title'] = "Pilih Akses | ".$this->apl['nama_sistem'];
			
			$id_user = $this->session->userdata('auth_id_user');
			$role = $this->Auth_m->get_role_by_id_user($id_user);
			$data['count_roles'] = $role->num_rows();  
			$data['roles'] = $role->result();  
			$this->parser->parse('front/choose_role', $data);
		}else{
			redirect(site_url());
		}
	}

	public function proses_role(){
		$id_role = $this->input->post('id');
		$role = $this->M_main->get_where('roles','id',$id_role)->row_array();
		$array_role = array(
			'auth_pilih_role' => FALSE,
			'auth_is_login' => TRUE,
			'auth_id_role' => $id_role, 
			'auth_nama_role' => $role['name'], 
		);
		$this->session->set_userdata( $array_role );
		
		$response['success'] = true;
		$response['message'] = "Selamat Datang ".$this->session->userdata('auth_nama_user')." !";
		$response['page'] = 'Beranda';
		insert_log($username, "Login Aplikasi", 'Berhasil Login', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
		echo json_encode($response);
  }
  
  public function email_reset_password(){
    $email = $this->input->post('email_reset');
    $cek_email = $this->M_main->get_where('users','email',$email);
    $num_email = $cek_email->num_rows();
    if($num_email==0){
      $response['success'] = FALSE;
      $response['message'] = "Maaf email anda tidak terdaftar !";
      insert_log($email, "Reset Password", 'Gagal Kirim Email Verifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());	
    }else{
      $data_user = $cek_email->row_array();
      $id_user = $data_user['id_user'];
      $nama_lengkap = $data_user['name'];
      $response['success'] = TRUE;
      $response['message'] = "Silahkan cek email anda untuk melanjutkan permintaan reset password !";
      $response['message_email'] = api_reset_pass($id_user,$nama_lengkap, $email);
      insert_log($email, "Reset Password", 'Berhasil Kirim Email Verifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());			      
    }
    echo json_encode($response);
  }

  public function form_reset($id_user){
    $data['aplikasi'] = $this->apl;
    $data['title'] = "Reset Password | ".$this->apl['nama_sistem'];
    $data['id_user'] = $id_user;
    $this->load->view('front/lupa_password/form-reset.php',$data);
  }   

  public function simpan_pass(){
    $id_user = $this->input->post('id_user');
    $pass_baru = md5(md5(strip_tags($this->input->post('pass_baru'))));
    $confirm_pass_baru = $this->input->post('confirm_pass_baru');

    $data_user = $this->M_main->get_where('users','id_user',$id_user)->row_array();
    $email = $data_user['email'];
    
    date_default_timezone_set('Asia/Jakarta');
    $object_update = array(
      'password'=>$pass_baru,
      'updated_at' => date('Y-m-d H:i:s')
    );
    $this->db->where('id_user',$id_user);
    $this->db->update('users',$object_update);
    
    $response['success'] = TRUE;
    $response['message'] = "Ubah password berhasil, silahkan login dengan password baru anda !";
    $response['page'] = "Auth";
    insert_log($email, "Reset Password", 'Berhasil Ubah Password', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());			      
    echo json_encode($response);
  }
	
	function logout(){
		$username = $this->session->userdata('auth_username');
		insert_log($username, "Logout Aplikasi", 'Berhasil Logout', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());
		
		$this->session->sess_destroy();
		$data['success'] = TRUE;
		$data['message'] = "Anda Berhasil Logout !";
		$data['page'] = "Auth";
		echo json_encode($data);
	}
}
