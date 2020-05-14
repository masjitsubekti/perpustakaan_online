<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_kategori extends CI_Controller {

    private $nama_menu  = "Tipe Kategori";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Tipe_kategori_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Tipe_kategori'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "tipe_kategori/v-tipe-kategori.php";
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
		$page['count_row'] = $this->Tipe_kategori_m->list_count($key)['jml'];
        $page['current']   = $pg;
		$page['list']      = gen_paging($page);
		$data['paging']    = $page;
		$data['list']      = $this->Tipe_kategori_m->list_data($key, $limit, $offset, $column, $sort);

		$this->load->view('sistem/tipe_kategori/v-data-tipe-kategori',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_tipe_kategori'] = $this->M_main->get_where('m_tipe_kategori','id_tipe_kategori',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/tipe_kategori/v-modal-tipe-kategori',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_tipe_kategori = strip_tags(trim($this->input->post('nama_tipe_kategori')));
        if($modeform == 'ADD'){
            
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_tipe_kategori' => $id,
                'nama_tipe_kategori'=>$nama_tipe_kategori,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_tipe_kategori', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Tipe Kategori Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Tipe Kategori", 'Berhasil Tambah Tipe Kategori', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_tipe_kategori = $this->input->post('id_tipe_kategori');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'nama_tipe_kategori'=>$nama_tipe_kategori,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_tipe_kategori',$id_tipe_kategori);
            $this->db->update('m_tipe_kategori', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Tipe Kategori Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Tipe Kategori", 'Berhasil Edit Tipe Kategori', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
			$this->db->where('id_tipe_kategori', $id);
			$this->db->update('m_tipe_kategori', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Tipe Kategori", 'Berhasil Hapus Tipe Kategori', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file tipe_kategori.php */
