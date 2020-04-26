<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Auth_m extends CI_Model {
        public function cek_status_by_email_pass($email,$pass){
            $query  = $this->db->query("
                                    select id_user, status from users
                                    where (email = '$email' or username = '$email') 
                                    and password = '$pass' limit 1
            ");
            return $query;
        }
        public function cek_login($user_id){
            $query  = $this->db->query("
                                    select u.id_user as user_id, u.name as nama_user, u.email as email, r.id_roles as role_id, r.name as nama_role, u.status, u.foto from users u
                                    join user_has_roles uhr on u.id_user = uhr.id_user
                                    join roles r on r.id_roles = uhr.id_roles
                                    where u.id_user = '$user_id'
                                    ");
            return $query;
        }
        public function get_role_by_id_user($id){
            $query  = $this->db->query("
                                    select uhr.id_roles as role_id, r.name as nama_role, r.img from users u
                                    join user_has_roles uhr on u.id_user = uhr.id_user
                                    join roles r on r.id_roles = uhr.id_roles
                                    where u.id_roles= '$id'
            ");
            return $query;
        }
    }
    /* End of file Auth_m.php */
?>