<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_koleksi extends CI_Controller {

    private $nama_menu  = "Jenis Koleksi";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Jenis_koleksi_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Jenis_koleksi'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "jenis_koleksi/v-jenisKoleksi.php";
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
      $page['count_row'] = $this->Jenis_koleksi_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Jenis_koleksi_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/jenis_koleksi/v-data-jenisKoleksi',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_jenis_koleksi'] = $this->M_main->get_where('m_jenis_koleksi','id_jenis_koleksi',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/jenis_koleksi/v-modal-jenisKoleksi',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_jenis_koleksi = strip_tags(trim($this->input->post('nama_jenis_koleksi')));
        if($modeform == 'ADD'){

            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_jenis_koleksi' => $id,
                'nama_jenis_koleksi'=>$nama_jenis_koleksi,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_jenis_koleksi', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Jenis Koleksi Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Jenis Koleksi", 'Berhasil Tambah Jenis Koleksi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_jenis_koleksi = $this->input->post('id_jenis_koleksi');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'nama_jenis_koleksi'=>$nama_jenis_koleksi,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_jenis_koleksi',$id_jenis_koleksi);
            $this->db->update('m_jenis_koleksi', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Jenis Koleksi Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Jenis Koleksi", 'Berhasil Edit Jenis Koleksi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
        $this->db->where('id_jenis_koleksi', $id);
        $this->db->update('m_jenis_koleksi', $object);
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Jenis Koleksi", 'Berhasil Hapus Jenis Koleksi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());         
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
	}
}

/* End of file Jenis_koleksi.php */
