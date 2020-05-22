<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    private $nama_menu  = "Setting Menu";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('menu_m');
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
        $this->mybreadcrumb->add($this->nama_menu, site_url('Menu'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "menu/v-menu.php";
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
      $page['count_row'] = $this->Menu_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Menu_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/menu/v-data-menu',$data);
    }

    public function load_modal(){
        $id = $this->input->post('id');
        $data['list_role'] = $this->M_main->get_all('roles')->result();
        $data['list_posisi'] = $this->M_main->get_all('c_posisi_menu')->result();
        $data['parent_menu'] = $this->M_main->get_where('c_menu','is_parent','1')->result();
        $data['sub_menu'] = $this->M_main->get_where('c_menu','is_parent','2')->result();
        
        if ($id!=""){
            $data['mode'] = "UPDATE";
            $data['data_menu'] = $this->M_main->get_where('m_menu','id_menu',$id)->row_array();
        }else{
            $data['mode'] = "ADD";
            $data['kosong'] = "";
        }
        $this->load->view('sistem/menu/v-modal-menu',$data);
    }

    function get_sub_menu(){
      $id_parent_menu = $this->input->post('parent_menu');
      $sub_menu = $this->Menu_m->get_sub_menu($id_parent_menu);
      $data['jml_menu'] = $sub_menu->num_rows();
      $data['sub_menu'] = $sub_menu->result();
      $this->load->view("sistem/menu/v-select-menu.php", $data);
    }

    public function simpan(){
      $id_role = strip_tags(trim($this->input->post('hak_akses')));
      $id_posisi = strip_tags(trim($this->input->post('posisi')));
      $parent_menu = strip_tags(trim($this->input->post('parent_menu')));
      $level = strip_tags(trim($this->input->post('level')));

      if($level=='1'){ 
          // level parent menu 
          $max_menu = $this->Menu_m->get_menu_max_level1($id_role)->row_array();
          $urutan = $max_menu['urutan']+1;
          date_default_timezone_set('Asia/Jakarta');
          $id = $this->uuid->v4(false);
          $data_object = array(
              'id_menu_user'  => $id, 
              'id_menu'       => $parent_menu,
              'id_roles'      => $id_role,
              'id_posisi'     => $id_posisi,
              'urutan'        => $urutan,
              'level'         => $level,
              'created_at'    => date('Y-m-d H:i:s'),
          );
          $this->db->insert('c_menu_user', $data_object);    
          $response['success'] = TRUE;
          $response['message'] = "Data Menu Berhasil Disimpan";
          
          $username = $this->session->userdata('auth_username');
          insert_log($username, "Tambah Menu", 'Berhasil Tambah Menu', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
      }else{
          // Sub Menu
          $sub_menu = ($this->input->post('menu'));
          if($sub_menu==""){
            $response['success'] = FALSE;
            $response['message'] = "Harap pilih sub menu !";        
          }else{
            date_default_timezone_set('Asia/Jakarta');
            foreach($sub_menu as $menu){
                $max_menu = $this->Menu_m->get_menu_max_level2($id_role, $parent_menu)->row_array();
                $urutan = $max_menu['urutan']+1;
                $id = $this->uuid->v4(false);
                $data_object = array(
                    'id_menu_user'    => $id, 
                    'id_menu'         => $menu,
                    'id_roles'        => $id_role,
                    'id_posisi'       => $id_posisi,
                    'urutan'          => $urutan,
                    'id_parent_menu'  => $parent_menu,
                    'level'           => $level,
                    'created_at'      => date('Y-m-d H:i:s'),
                );
                $this->db->insert('c_menu_user', $data_object);    
            }
            $response['success'] = TRUE;
            $response['message'] = "Data Menu Berhasil Disimpan";
        
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Menu", 'Berhasil Tambah Menu', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
          }
        }   
      echo json_encode($response);
    }

    public function nonaktifkan(){
      if($this->input->post('id')){
        $id = $this->input->post('id');
        date_default_timezone_set('Asia/Jakarta');
        
        $this->db->where('id_menu_user', $id);
        $this->db->delete('c_menu_user');
        $response['success'] = true;
        $response['message'] = "Menu berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Menu", 'Berhasil Hapus Menu', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());         
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
    }
}

/* End of file menu.php */
