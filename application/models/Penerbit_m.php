<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Penerbit_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from m_penerbit where concat(nama_penerbit) like '%$key%' and status = '$status'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                select * from m_penerbit
                where 
                    concat(nama_penerbit) like '%$key%' 
                    and status = '$status'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }
    }
    /* End of file Kategori_buku_m.php */    
?>