<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Petugas_m extends CI_Model {
        function list_petugas(){
            $query = $this->db->query("
                select us.*, r.id_roles, r.name as nama_role from users us
                  left join user_has_roles uhr on us.id_user = uhr.id_user
                  left join roles r on uhr.id_roles = r.id_roles
                where  
                  uhr.id_roles = 'HA02'
                order by us.name asc
            ");
            return $query;
        }
    }
    /* End of file Rak_m.php */    
?>