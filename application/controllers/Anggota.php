<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    private $nama_menu  = "Keanggotaan";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Anggota_m');
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
        $this->mybreadcrumb->add('Daftar Anggota', site_url('Anggota'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        $data['content'] = "anggota/v-anggota.php";
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
      $page['count_row'] = $this->Anggota_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Anggota_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/anggota/v-data-anggota',$data);
    }

    public function form_add()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Daftar Anggota', site_url('Anggota'));
        $this->mybreadcrumb->add('Tambah Anggota', site_url('Anggota/form_add'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        
        $data['modeform'] = 'ADD';
        $data['id_anggota'] = $this->M_main->get_no_otomatis('t_anggota','id_anggota','AG');
        $data['jenkel'] = $this->M_main->get_all('m_jenkel')->result();
        $data['jenis_anggota'] = $this->M_main->get_where('m_jenis_anggota','status','1')->result();
        
        $data['content'] = "anggota/v-form-anggota.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function form_edit($id_anggota)
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Daftar Anggota', site_url('Anggota'));
        $this->mybreadcrumb->add('Edit Anggota', site_url('Anggota/form_edit'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        
        $data['modeform'] = 'UPDATE';
        $data['data_anggota'] = $this->M_main->get_where('t_anggota','id_anggota',$id_anggota)->row_array();
        $data['jenkel'] = $this->M_main->get_all('m_jenkel')->result();
        $data['jenis_anggota'] = $this->M_main->get_where('m_jenis_anggota','status','1')->result();

        $data['content'] = "anggota/v-form-anggota.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function simpan(){
        $modeform               = $this->input->post('modeform');
        $id_anggota             = strip_tags(trim($this->input->post('id_anggota')));
        $nama_anggota           = strip_tags(trim($this->input->post('nama_anggota')));
        $no_identitas           = strip_tags(trim($this->input->post('no_identitas')));
        $tempat_lahir           = strip_tags(trim($this->input->post('tempat_lahir')));
        $tgl_lahir              = strip_tags(trim($this->input->post('tanggal_lahir')));
        $jenkel                 = strip_tags(trim($this->input->post('jenkel')));
        $alamat                 = strip_tags(trim($this->input->post('alamat')));
        $kode_pos               = strip_tags(trim($this->input->post('kode_pos')));
        $no_telp                = strip_tags(trim($this->input->post('no_telp')));
        $email                  = strip_tags(trim($this->input->post('email')));
        $keterangan             = strip_tags(trim($this->input->post('keterangan')));
        $tanggal_registrasi     = strip_tags(trim($this->input->post('tanggal_registrasi')));
        $password               = strip_tags(trim($this->input->post('password')));
        $konfirmasi_password    = strip_tags(trim($this->input->post('konfirmasi_password')));
        $jenis_anggota          = $this->input->post('jenis_anggota');
       
        $time1                  = strtotime($tgl_lahir);
        $time2                  = strtotime($tanggal_registrasi);
        $tgl_lahir              = date('Y-m-d',$time1);
        $tanggal_registrasi     = date('Y-m-d',$time2);
        
        // Siswa / Anggota
        $role = 'HA05';

        if($modeform == 'ADD'){

            $get_no_id = $this->M_main->get_where('t_anggota','no_identitas',$no_identitas)->num_rows();
            $get_email = $this->M_main->get_where('users','email',$email)->num_rows();
            $get_username = $this->M_main->get_where('users','username',$id_anggota)->num_rows();   
        
            if($get_no_id!=0){
                $response['success'] = FALSE;
                $response['message'] = "Maaf, No Identitas Sudah Terdaftar Sebagai Anggota !";
            }else if($get_email!=0){
                $response['success'] = FALSE;
                $response['message'] = "Maaf, Email Sudah Terdaftar Sebagai Akun Anggota !";
            }else if($get_username!=0){
                $response['success'] = FALSE;
                $response['message'] = "Maaf, No Identitas Sudah Terdaftar Sebagai Akun Anggota !";
            }else{

                $foto_anggota       = lakukan_upload_file('foto_anggota','/assets/data/foto_anggota/','jpg|png|jpeg');
                $barcode            = generate_barcode($id_anggota,'assets/data/barcode_anggota/');
                // save user
                $id_user = $this->uuid->v4(false);
                date_default_timezone_set('Asia/Jakarta');
                $data_user = array(
                    'id_user'       => $id_user,
                    'name'          => $nama_anggota,
                    'username'      => $id_anggota,
                    'email'         => $email,
                    'password'      => md5(md5($password)),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'status'        => '1',
                );
                $this->db->insert('users',$data_user);

                // save Role
                $id_role = $this->uuid->v4(false);
                $data_akses = array(
                    'id_has_roles'  => $id_role,
                    'id_roles'      => $role,
                    'id_user'       => $id_user,
                    'created_at'    => date('Y-m-d H:i:s'),
                );
                $this->db->insert('user_has_roles', $data_akses);

                // save anggota
                $data_object = array(
                    'id_anggota'        =>$id_anggota,
                    'no_identitas'      =>$no_identitas,
                    'nama_anggota'      =>$nama_anggota,
                    'tempat_lahir'      =>$tempat_lahir,
                    'tgl_lahir'         =>$tgl_lahir,
                    'jenis_kelamin'     =>$jenkel,
                    'alamat'            =>$alamat,
                    'kode_pos'          =>$kode_pos,
                    'no_telp'           =>$no_telp,
                    'email'             =>$email,
                    'id_jenis_anggota'  =>$jenis_anggota,
                    'keterangan'        =>$keterangan,
                    'tgl_registrasi'    =>$tanggal_registrasi,
                    // 'berlaku_hingga'    =>$berlaku_hingga,
                    'foto'              =>$foto_anggota['file_name'],
                    'barcode'           =>$barcode,
                    'id_user'           =>$id_user,
                    'status'            =>'1',
                    'created_at'        =>date('Y-m-d H:i:s')
                );
                $this->db->insert('t_anggota', $data_object);
                $response['success'] = TRUE;
                $response['message'] = "Data Anggota Berhasil Disimpan";
                
                $username = $this->session->userdata('auth_username');
                insert_log($username, "Tambah Anggota", 'Berhasil Tambah Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }

        }else if($modeform == 'UPDATE'){
            $id_anggota_ubah = $this->input->post('id_anggota_ubah');
            $foto_anggota       = lakukan_upload_file('foto_anggota','/assets/data/foto_anggota/','jpg|png|jpeg');
            // cek upload
            $cek_upload = $this->M_main->get_where('t_anggota','id_anggota',$id_anggota_ubah)->row_array();
            $id_user = $cek_upload['id_user'];
            $users = $this->M_main->get_where('users','id_user',$id_user)->row_array();
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'no_identitas'      =>$no_identitas,
                'nama_anggota'      =>$nama_anggota,
                'tempat_lahir'      =>$tempat_lahir,
                'tgl_lahir'         =>$tgl_lahir,
                'jenis_kelamin'     =>$jenkel,
                'alamat'            =>$alamat,
                'kode_pos'          =>$kode_pos,
                'no_telp'           =>$no_telp,
                'email'             =>$email,
                'id_jenis_anggota'  =>$jenis_anggota,
                'keterangan'        =>$keterangan,
                'tgl_registrasi'    =>$tanggal_registrasi,
                'foto'              =>(!empty($_FILES["foto_anggota"]["tmp_name"])) ? $foto_anggota['file_name'] : $cek_upload['foto'],    
                'updated_at'        =>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_anggota',$id_anggota_ubah);
            $this->db->update('t_anggota', $data_object);

            // Update user
            date_default_timezone_set('Asia/Jakarta');
            $data_user = array(
                'password'      => ($password!="") ? md5(md5($password)) : $users['password'],
                'updated_at'    => date('Y-m-d H:i:s'),
            );

            $this->db->where('id_user',$id_user);
            $this->db->update('users', $data_user);

            $response['success'] = true;
            $response['message'] = "Data Anggota Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Anggota", 'Berhasil Edit Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        }
        echo json_encode($response);   
    }

    public function nonaktifkan(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			date_default_timezone_set('Asia/Jakarta');
			$object = array(
				'status' => '0',
				'deleted_at' => date('Y-m-d H:i:s'),
			);
			$this->db->where('id_anggota', $id);
			$this->db->update('t_anggota', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Anggota", 'Berhasil Hapus Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file Anggota.php */
