<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Controller {

    private $nama_menu  = "Rak Buku";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Rak_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Rak'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "rak/v-rak.php";
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
		$page['count_row'] = $this->Rak_m->list_count($key)['jml'];
        $page['current']   = $pg;
		$page['list']      = gen_paging($page);
		$data['paging']    = $page;
		$data['list']      = $this->Rak_m->list_data($key, $limit, $offset, $column, $sort);

		$this->load->view('sistem/rak/v-data-rak',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_rak'] = $this->M_main->get_where('m_rak','id_rak',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/rak/v-modal-rak',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $kode_rak = strip_tags(trim($this->input->post('kode_rak')));
        $nama_rak = strip_tags(trim($this->input->post('nama_rak')));
        if($modeform == 'ADD'){
            $cek_rak = $this->M_main->get_where('m_rak','kode_rak',$kode_rak);
            if($cek_rak->num_rows()!=0){
                $response['success'] = FALSE;
                $response['message'] = "Maaf, Kode Rak Buku Sudah Ada !";
           
                $username = $this->session->userdata('auth_username');
                insert_log($username, "Tambah Rak Buku", 'Gagal Kode Rak Sudah Ada', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }else{
                $id = $this->uuid->v4(false);
                date_default_timezone_set('Asia/Jakarta');
                $data_object = array(
                    'id_rak' => $id,
                    'kode_rak'=>$kode_rak,
                    'nama_rak'=>$nama_rak,
                    'status'=>'1',
                    'created_at'=>date('Y-m-d H:i:s')
                );
                $this->db->insert('m_rak', $data_object);
                $response['success'] = TRUE;
                $response['message'] = "Data Rak Buku Berhasil Disimpan";
                
                $username = $this->session->userdata('auth_username');
                insert_log($username, "Tambah Rak Buku", 'Berhasil Tambah Rak Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
            }
        }else if($modeform == 'UPDATE'){
            $id_rak = $this->input->post('id_rak');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'kode_rak'=>$kode_rak,
                'nama_rak'=>$nama_rak,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_rak',$id_rak);
            $this->db->update('m_rak', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Rak Buku Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Rak Buku", 'Berhasil Edit Rak Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
			$this->db->where('id_rak', $id);
			$this->db->update('m_rak', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Rak Buku", 'Berhasil Hapus Rak Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file rak.php */
