<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Histori_peminjaman_m extends CI_Model {
        function detail_peminjaman_anggota($id_detail_peminjaman){
            $query = $this->db->query("
                select x.*, (x.denda_perhari * terlambat_peminjaman) as denda_peminjaman from(
                  select tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
                  tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari, tdp.created_at,
                  (select CURDATE()) as tgl_sekarang, tpb.tgl_pengembalian, tpb.hari_terlambat as terlambat_pengembalian, tpb.denda as denda_pengembalian,
                  case 
                      when (select CURDATE() - tdp.tgl_kembali) >=0 then (select CURDATE() - tdp.tgl_kembali)
                  else 0
                  end as terlambat_peminjaman
                  from t_peminjaman tp 
                      left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                      left join t_buku tb on tdp.kode_buku = tb.kode_buku
                      left join t_anggota ta on tp.id_anggota = ta.id_anggota
                    left join t_pengembalian tpb on tdp.id_detail_peminjaman = tpb.id_detail_peminjaman 
                      left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota
                  )x
                  where 
                    x.id_detail_peminjaman = '$id_detail_peminjaman'   
            ");
            return $query;
        }

      function peminjaman_anggota($id_peminjaman){
          $query = "
                  select tp.*, tdp.*, judul from t_peminjaman tp 
                      left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                      left join t_buku tb on tdp.kode_buku = tb.kode_buku 
                  where 
                      tp.id_peminjaman = '$id_peminjaman'
                  order by tp.created_at desc
          ";
          return $this->db->query($query);
      }
    }
    /* End of file Histori_peminjaman_m.php */    
?>