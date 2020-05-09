<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Anggota_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from t_anggota where concat(nama_anggota) like '%$key%' and status = '$status'
            ")->row_array();
            return $query;
        }
    
        function list_data($key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("
                select * from t_anggota
                where 
                    concat(nama_anggota) like '%$key%' 
                    and status = '$status'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }

        function get_anggota($id_anggota,$status="1"){
            $query = "
                select ta.*, mja.nama_jenis_anggota, mja.lama_pinjam, mja.max_peminjaman, mja.max_perpanjangan, mja.jumlah_denda from t_anggota ta 
                    left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota 
                where 
                    ta.status = '$status'
                    and ta.id_anggota = '$id_anggota'        
            ";
            return $this->db->query($query);
        }
    }
    /* End of file Kategori_buku_m.php */    
?>