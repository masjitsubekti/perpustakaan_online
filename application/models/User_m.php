<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class User_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                    select count(*) as jml from users us
                        left join user_has_roles uhr on us.id_user = uhr.id_user
                        left join roles r on uhr.id_roles = r.id_roles
                    where concat(us.name, us.email, us.username, us.status, r.id_roles, r.name) like '%$key%'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                    select us.*, r.id_roles, r.name as nama_role from users us
                        left join user_has_roles uhr on us.id_user = uhr.id_user
                        left join roles r on uhr.id_roles = r.id_roles
                    where concat(us.name, us.email, us.username, us.status, r.id_roles, r.name) like '%$key%' 
                    order by $column $sort
                    limit $limit offset $offset
            ");
            return $query;
        }
        function get_role($id){
            $query = $this->db->query("                                    
                    select * from user_has_roles uhs
                        left join roles r on uhs.id_roles = r.id_roles
                    where 
                        id_roles = '$id'
            ");
            return $query;
        }
        function detail_user($id){
            $query = $this->db->query("                                    
                    select us.*, r.id_roles from users us
                        left join user_has_roles uhr on us.id_user = uhr.id_user
                        left join roles r on uhr.id_roles = r.id_roles
                    where 
                        us.id_user = '$id'
            ");
            return $query;
        }
    }
    /* End of file User_m.php */    
?>