<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengarang extends CI_Controller {

    private $nama_menu  = "Pengarang";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Pengarang_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Pengarang'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "pengarang/v-pengarang.php";
        $this->parser->parse('sistem/template', $data);
    }    

    public function read_data($pg=1)
	{
		$key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
		$limit	= $this->input->post("limit");
		$offset = ($limit*$pg)-$limit;
		$column = $this->input->post('column');
        $sort = $this->input->post('sort');
		
		$page              = array();
		$page['limit']     = $limit;
		$page['count_row'] = $this->Pengarang_m->list_count($key)['jml'];
        $page['current']   = $pg;
		$page['list']      = gen_paging($page);
		$data['paging']    = $page;
		$data['list']      = $this->Pengarang_m->list_data($key, $limit, $offset, $column, $sort);

		$this->load->view('sistem/pengarang/v-data-pengarang',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_pengarang'] = $this->M_main->get_where('m_pengarang','id_pengarang',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/pengarang/v-modal-pengarang',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_pengarang = strip_tags(trim($this->input->post('nama_pengarang')));
        if($modeform == 'ADD'){
            
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_pengarang' => $id,
                'nama_pengarang'=>$nama_pengarang,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_pengarang', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Pengarang Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Pengarang", 'Berhasil Tambah Pengarang', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_pengarang = $this->input->post('id_pengarang');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'nama_pengarang'=>$nama_pengarang,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_pengarang',$id_pengarang);
            $this->db->update('m_pengarang', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Pengarang Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Pengarang", 'Berhasil Edit Pengarang', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
			$this->db->where('id_pengarang', $id);
			$this->db->update('m_pengarang', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Pengarang", 'Berhasil Hapus Pengarang', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file pengarang.php */
