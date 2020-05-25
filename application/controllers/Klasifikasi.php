<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klasifikasi extends CI_Controller {

    private $nama_menu  = "Klasifikasi";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Klasifikasi_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Klasifikasi'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "klasifikasi/v-klasifikasi.php";
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
      $page['count_row'] = $this->Klasifikasi_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Klasifikasi_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/klasifikasi/v-data-klasifikasi',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_klasifikasi'] = $this->M_main->get_where('m_klasifikasi','id_klasifikasi',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/klasifikasi/v-modal-klasifikasi',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_klasifikasi = strip_tags(trim($this->input->post('nama_klasifikasi')));
        $kode_klasifikasi = strip_tags(trim($this->input->post('kode_klasifikasi')));
        if($modeform == 'ADD'){
            
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_klasifikasi' => $id,
                'kode_klasifikasi'=>$kode_klasifikasi,
                'nama_klasifikasi'=>$nama_klasifikasi,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_klasifikasi', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Klasifikasi Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Klasifikasi", 'Berhasil Tambah Klasifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_klasifikasi = $this->input->post('id_klasifikasi');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
              'kode_klasifikasi'=>$kode_klasifikasi,
              'nama_klasifikasi'=>$nama_klasifikasi,
              'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_klasifikasi',$id_klasifikasi);
            $this->db->update('m_klasifikasi', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Klasifikasi Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Klasifikasi", 'Berhasil Edit Klasifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
        $this->db->where('id_klasifikasi', $id);
        $this->db->update('m_klasifikasi', $object);
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Klasifikasi", 'Berhasil Hapus Klasifikasi', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());         
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
	}
}

/* End of file klasifikasi.php */
