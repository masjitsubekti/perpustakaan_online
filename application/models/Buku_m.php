<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Buku_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from t_buku tb 
                    left join m_kategori_buku mk on tb.id_kategori = mk.id_kategori 
                    left join m_sumber ms on tb.id_sumber = ms.id_sumber 
                    left join m_rak mr on tb.id_rak = mr.id_rak 
                    left join m_penerbit mp on tb.id_penerbit = mp.id_penerbit 
                where 
                    concat(tb.kode_buku, tb.judul, tb.pengarang) like '%$key%' 
                    and tb.status = '$status'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                select tb.*, mk.nama_kategori, ms.nama_sumber, mr.nama_rak, mp.nama_penerbit from t_buku tb 
                    left join m_kategori_buku mk on tb.id_kategori = mk.id_kategori 
                    left join m_sumber ms on tb.id_sumber = ms.id_sumber 
                    left join m_rak mr on tb.id_rak = mr.id_rak 
                    left join m_penerbit mp on tb.id_penerbit = mp.id_penerbit 
                where 
                    concat(tb.kode_buku, tb.judul, tb.pengarang) like '%$key%' 
                    and tb.status = '$status'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }
    }
    /* End of file Buku_m.php */    
?>