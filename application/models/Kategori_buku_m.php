<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Kategori_buku_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from m_kategori_buku mkb 
                left join m_tipe_kategori mtk on mkb.id_tipe_kategori = mtk.id_tipe_kategori 
                where 
                    concat(mkb.kode_kategori,mkb.nama_kategori,mtk.nama_tipe_kategori) like '%$key%' and mkb.status = '$status'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                select mkb.*, mtk.nama_tipe_kategori from m_kategori_buku mkb 
                left join m_tipe_kategori mtk on mkb.id_tipe_kategori = mtk.id_tipe_kategori 
                where 
                    concat(mkb.kode_kategori,mkb.nama_kategori,mtk.nama_tipe_kategori) like '%$key%' 
                    and mkb.status = '$status'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }
    }
    /* End of file Kategori_buku_m.php */    
?>