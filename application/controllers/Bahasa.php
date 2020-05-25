<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahasa extends CI_Controller {

    private $nama_menu  = "Bahasa";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Bahasa_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Bahasa'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "bahasa/v-bahasa.php";
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
      $page['count_row'] = $this->Bahasa_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Bahasa_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/bahasa/v-data-bahasa',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_bahasa'] = $this->M_main->get_where('m_bahasa','id_bahasa',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/bahasa/v-modal-bahasa',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_bahasa = strip_tags(trim($this->input->post('nama_bahasa')));
        if($modeform == 'ADD'){
            
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_bahasa' => $id,
                'nama_bahasa'=>$nama_bahasa,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_bahasa', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data bahasa Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Bahasa", 'Berhasil Tambah Bahasa', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_bahasa = $this->input->post('id_bahasa');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'nama_bahasa'=>$nama_bahasa,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_bahasa',$id_bahasa);
            $this->db->update('m_bahasa', $data_object);

            $response['success'] = true;
            $response['message'] = "Data bahasa Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Bahasa", 'Berhasil Edit Bahasa', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
        $this->db->where('id_bahasa', $id);
        $this->db->update('m_bahasa', $object);
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Bahasa", 'Berhasil Hapus Bahasa', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());         
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
	}
}

/* End of file bahasa.php */
