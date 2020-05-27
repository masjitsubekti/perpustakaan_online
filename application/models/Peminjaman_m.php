<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Peminjaman_m extends CI_Model {
        function get_peminjaman_anggota($id_anggota,$status="1"){
            $query = "
                    select tp.*, tdp.*, judul from t_peminjaman tp 
                        left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                        left join t_buku tb on tdp.kode_buku = tb.kode_buku 
                    where 
                        tdp.status = '$status'
                        and tp.id_anggota = '$id_anggota'
            ";
            return $this->db->query($query);
        }

        function cek_peminjaman_buku($id_anggota,$kode_buku,$status="1"){
            $query = "
                    select tp.*, tdp.* from t_peminjaman tp 
                        left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                    where 
                        tdp.status = '$status'
                        and tp.id_anggota = '$id_anggota'
                        and tdp.kode_buku = '$kode_buku'               
            ";
            return $this->db->query($query);
        }
        
      function cek_ketersediaan_buku($kode_buku,$status="1"){
            $query = "
                    select x.kode_buku, x.judul, x.stok, x.jml_dipinjam, (x.stok - x.jml_dipinjam) as sisa from 
                        (select tb.kode_buku, tb.judul, tb.stok, 
                            (select count(*) as jml_dipinjam from t_detail_peminjaman tdp
                             where tdp.status = '$status'
                        and tdp.kode_buku = tb.kode_buku 
                    ) as jml_dipinjam 
                    from t_buku tb 
                    )x
                    where x.kode_buku = '$kode_buku'               
            ";
          return $this->db->query($query);
      }
        
      function list_count_peminjaman($status="1"){
          $query = $this->db->query("
              select count(*) as jml from t_peminjaman tp 
                left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                left join t_buku tb on tdp.kode_buku = tb.kode_buku 
                left join t_anggota ta on tp.id_anggota = ta.id_anggota 
                left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
              where tp.status = '$status'              
          ")->row_array();
          return $query;
      }

      function list_data_peminjaman($limit="", $offset="", $column="", $sort="", $status="1"){
          $query = $this->db->query("
              select tp.*, ta.nama_anggota, tdp.id_detail_peminjaman, ta.no_identitas, mja.nama_jenis_anggota, tdp.kode_buku, tb.judul,
              tdp.tgl_pinjam, tdp.tgl_kembali, datediff(tdp.tgl_kembali ,tdp.tgl_pinjam) as lama_pinjam from t_peminjaman tp 
                left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                left join t_buku tb on tdp.kode_buku = tb.kode_buku 
                left join t_anggota ta on tp.id_anggota = ta.id_anggota 
                left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
              where tp.status = '$status'
              order by $column $sort
              limit $limit offset $offset
          ");
          return $query;
      }
	}
    /* End of file Peminjaman_m.php */    
?>
