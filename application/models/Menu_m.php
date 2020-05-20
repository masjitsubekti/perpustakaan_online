<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Menu_m extends CI_Model {
        private $redirect_default = 'Auth';
        function role_has_access($menu){
            $id_role = $this->session->userdata('auth_id_role');
            $query=$this->db->query("
                                    select mu.id_menu from c_menu_user mu
                                    join c_menu m on (m.id_menu=mu.id_menu)
                                    where id_roles ='$id_role' and nama_menu = '$menu'		
            ");
            if($query->num_rows()==0){
                redirect(site_url($this->redirect_default), 'refresh');
            }
        }

        function get_menu_1($role){
            $query = $this->db->query("
                  select m.* from c_menu_user mu
                    join c_menu m on mu.id_menu = m.id_menu
                  where 
                    mu.id_roles = '$role' and mu.id_posisi = 1 and  level = 1 
                  order by mu.urutan asc"
            );
            return $query;
        }

        function list_count($key="", $status="1"){
            $query = $this->db->query("
                  select count(*) as jml from c_menu_user cmu 
                      left join c_menu cm on cmu.id_menu = cm.id_menu 
                      left join roles r on cmu.id_roles = r.id_roles 
                  where concat(cm.nama_menu, r.name, cm.keterangan) like '%$key%'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                    select cmu.*, cm.nama_menu, r.name as nama_role, cm.keterangan from c_menu_user cmu 
                        left join c_menu cm on cmu.id_menu = cm.id_menu 
                        left join roles r on cmu.id_roles = r.id_roles 
                    where 
                        concat(cm.nama_menu, r.name, cm.keterangan) like '%$key%' 
                    order by $column $sort
                    limit $limit offset $offset
            ");
            return $query;
        }

        function get_sub_menu($id_parent_menu){
          $query = $this->db->query("
                    select * from c_menu
                    where id_parent = '$id_parent_menu' "
          );
          return $query;
        }

        function get_menu_max_level1($id_role="", $level="1"){
          $query = $this->db->query("
                                select coalesce(max(urutan),0) as urutan from c_menu_user where id_roles = '$id_role' and level = '$level'
                                order by urutan asc
          ");
          return $query;
        }
        function get_menu_max_level2($id_roles="", $id_parent_menu, $level="2"){
            $query = $this->db->query("
                                select coalesce(max(urutan),0) as urutan from c_menu_user 
                                where id_roles = '$id_roles' and id_parent_menu = '$id_parent_menu' and level = '$level'
                                order by urutan asc
            ");
            return $query;
        }
    }
    /* End of file Menu_m.php */    
?>