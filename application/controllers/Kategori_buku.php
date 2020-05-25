<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_buku extends CI_Controller {

    private $nama_menu  = "Kategori Buku";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Kategori_buku_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Kategori_buku'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "kategori_buku/v-kategori-buku.php";
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
      $page['count_row'] = $this->Kategori_buku_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Kategori_buku_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/kategori_buku/v-data-kategori-buku',$data);
    }

    public function load_modal(){
      $id = $this->input->post('id');
      $data['tipe_kategori'] = $this->M_main->get_where('m_tipe_kategori','status','1')->result();
      $data['klasifikasi'] = $this->db->query("select * from m_klasifikasi where status = '1' order by kode_klasifikasi asc ")->result();
      if ($id!=""){
          $data['mode'] = "UPDATE";
          $data['data_kategori'] = $this->M_main->get_where('m_kategori_buku','id_kategori',$id)->row_array();
      }else{
          $data['mode'] = "ADD";
          $data['kosong'] = "";
      }
      $this->load->view('sistem/kategori_buku/v-modal-kategori',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $kode_klasifikasi = strip_tags(trim($this->input->post('kode_klasifikasi')));
        $nama_kategori = strip_tags(trim($this->input->post('nama_kategori')));
        $tipe_kategori = strip_tags(trim($this->input->post('tipe_kategori')));
        if($modeform == 'ADD'){

            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_kategori' => $id,
                'kode_klasifikasi'=>$kode_klasifikasi,
                'nama_kategori'=>$nama_kategori,
                'id_tipe_kategori'=>$tipe_kategori,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_kategori_buku', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Kategori Buku Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Kategori Buku", 'Berhasil Tambah Kategori Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
          }else if($modeform == 'UPDATE'){
            $id_kategori = $this->input->post('id_kategori');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'kode_klasifikasi'=>$kode_klasifikasi,
                'nama_kategori'=>$nama_kategori,
                'id_tipe_kategori'=>$tipe_kategori,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_kategori',$id_kategori);
            $this->db->update('m_kategori_buku', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Kategori Buku Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Kategori Buku", 'Berhasil Edit Kategori Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
			$this->db->where('id_kategori', $id);
			$this->db->update('m_kategori_buku', $object);
			
			$response['success'] = true;
            $response['message'] = "Data berhasil dinonaktifkan !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Hapus Kategori Buku", 'Berhasil Hapus Kategori Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
		}else{
			$response['success'] = false;
			$response['message'] = "Data tidak ditemukan !";
		}
		echo json_encode($response);
	}
}

/* End of file Kategori_buku.php */
