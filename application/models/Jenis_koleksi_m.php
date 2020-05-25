<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Jenis_koleksi_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from m_jenis_koleksi where concat(nama_jenis_koleksi) like '%$key%' and status = '$status'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                select * from m_jenis_koleksi
                where 
                    concat(nama_jenis_koleksi) like '%$key%' 
                    and status = '$status'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }
    }
    /* End of file jenis_koleksi_m.php */    
?>