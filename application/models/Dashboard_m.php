<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Dashboard_m extends CI_Model {
    function count_anggota(){
      $query = $this->db->query("
         select count(*) as total_anggota from t_anggota where status = '1'
      ");
      return $query;
    }
    function count_buku(){
      $query = $this->db->query("
         select count(*) as total_buku from t_buku where status = '1'
      ");
      return $query;
    }
    function count_jenis_koleksi(){
      $query = $this->db->query("
         select count(*) as total_jenis_koleksi from m_jenis_koleksi where status = '1'
      ");
      return $query;
    }
    function count_rak(){
      $query = $this->db->query("
         select count(*) as total_rak from m_rak where status = '1'
      ");
      return $query;
    }

    function chart_perbulan($bulan, $tahun){
      $query = $this->db->query("
        select
          sum(case when status = '1' then 1 else 0 end) as peminjaman,
          sum(case when status = '2' then 1 else 0 end) as pengembalian
        from t_detail_peminjaman 
        where
          EXTRACT(MONTH FROM tgl_pinjam) = '$bulan' and EXTRACT(YEAR FROM tgl_pinjam) = '$tahun' 
      ");
      return $query;
    }
  }
  /* End of file Dashboard_m.php */    
?>