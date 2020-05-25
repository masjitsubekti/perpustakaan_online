<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber extends CI_Controller {

    private $nama_menu  = "Sumber";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Sumber_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Sumber'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "sumber/v-sumber.php";
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
      $page['count_row'] = $this->Sumber_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Sumber_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/sumber/v-data-sumber',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_sumber'] = $this->M_main->get_where('m_sumber','id_sumber',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/sumber/v-modal-sumber',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_sumber = strip_tags(trim($this->input->post('nama_sumber')));
        $keterangan = strip_tags(trim($this->input->post('keterangan')));
        if($modeform == 'ADD'){
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_sumber' => $id,
                'nama_sumber'=>$nama_sumber,
                'keterangan'=>$keterangan,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_sumber', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Sumber Buku Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Sumber Buku", 'Berhasil Tambah Sumber Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_sumber = $this->input->post('id_sumber');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'nama_sumber'=>$nama_sumber,
                'keterangan'=>$keterangan,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_sumber',$id_sumber);
            $this->db->update('m_sumber', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Sumber Buku Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Sumber Buku", 'Berhasil Edit Sumber Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
			$this->db->where('id_sumber', $id);
			$this->db->update('m_sumber', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Sumber Buku", 'Berhasil Hapus Sumber Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file sumber.php */
