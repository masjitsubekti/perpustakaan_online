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
		$data['title'] = "LOGIN | ".$this->apl['nama_sistem'];
		$this->load->view('front/auth-login', $data);
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
