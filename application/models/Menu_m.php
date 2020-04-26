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
    }
    /* End of file Menu_m.php */    
?>