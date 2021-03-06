<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class jenis_anggota extends CI_Controller {

    private $nama_menu  = "Setting Jenis Anggota";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Jenis_anggota_m');
        must_login();
    }
    
    public function index(){
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add($this->nama_menu, site_url('Jenis_anggota'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "jenis_anggota/v-jenisAnggota.php";
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
      $page['count_row'] = $this->Jenis_anggota_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Jenis_anggota_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/jenis_anggota/v-data-jenisAnggota',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_jenis'] = $this->M_main->get_where('m_jenis_anggota','id_jenis_anggota',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/jenis_anggota/v-modal-jenisAnggota',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $nama_jenis_anggota = strip_tags(trim($this->input->post('nama_jenis_anggota')));
        $max_pinjam = strip_tags(trim($this->input->post('max_peminjaman')));
        $max_perpanjangan = strip_tags(trim($this->input->post('max_perpanjangan')));
        $lama_pinjam = strip_tags(trim($this->input->post('lama_pinjam')));
        $jum_denda = strip_tags(trim($this->input->post('jumlah_denda')));
        $notifikasi_terlambat = strip_tags(trim($this->input->post('notifikasi_terlambat')));
        if($modeform == 'ADD'){
            $id_max = $this->db->query("select coalesce(max(id_jenis_anggota),0) as id from m_jenis_anggota")->row_array();
            $id = $id_max['id']+1;
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'id_jenis_anggota' => $id,
                'nama_jenis_anggota'=>$nama_jenis_anggota,
                'max_perpanjangan'=>$max_perpanjangan,
                'jumlah_denda'=>$jum_denda,
                'max_peminjaman'=>$max_pinjam,
                'lama_pinjam'=>$lama_pinjam,
                'notifikasi_terlambat'=>$notifikasi_terlambat,
                'status'=>'1',
                'created_at'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('m_jenis_anggota', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Jenis Anggota Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Jenis Anggota", 'Berhasil Tambah Jenis Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $id_jenis_anggota = $this->input->post('id_jenis_anggota');
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
              'nama_jenis_anggota'=>$nama_jenis_anggota,
              'max_perpanjangan'=>$max_perpanjangan,
              'jumlah_denda'=>$jum_denda,
              'max_peminjaman'=>$max_pinjam,
              'lama_pinjam'=>$lama_pinjam,
              'notifikasi_terlambat'=>$notifikasi_terlambat,
              'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('id_jenis_anggota',$id_jenis_anggota);
            $this->db->update('m_jenis_anggota', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Jenis Anggota Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Jenis Anggota", 'Berhasil Edit Jenis Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
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
        $this->db->where('id_jenis_anggota', $id);
        $this->db->update('m_jenis_anggota', $object);
        
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Jenis Anggota", 'Berhasil Hapus Jenis Anggota', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
	  }
}

/* End of file Jenis_anggota.php */
