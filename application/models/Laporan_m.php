<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Laporan_m extends CI_Model {

      function list_count_peminjaman($bulan="", $tahun="", $pertahun="", $pertanggal, $tgl_awal, $tgl_akhir, $status="1"){
        $query = "
            select count(*) as jml from t_peminjaman tp 
              left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
              left join t_buku tb on tdp.kode_buku = tb.kode_buku 
              left join t_anggota ta on tp.id_anggota = ta.id_anggota 
              left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
            where tp.status = '$status' ";
        // bulanan
        if($bulan!="" and $tahun!=""){
          $query .= " and EXTRACT(MONTH FROM tdp.tgl_pinjam) = '$bulan' and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$tahun' ";
        }
        // pertahun
        if($pertahun!=""){
          $query .= " and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$pertahun' ";
        }             
        // pertanggal
        if($pertanggal!=""){
          $query .= " and tdp.tgl_pinjam = '$pertanggal' ";
        }
        // rentang
        if($tgl_awal!="" and $tgl_akhir!=""){
          $query .= " and tdp.tgl_pinjam >= '$tgl_awal' and tdp.tgl_pinjam <= '$tgl_akhir' ";
        }
        
        return $this->db->query($query)->row_array();
      }

      function list_data_peminjaman($bulan="", $tahun="", $pertahun="", $pertanggal, $tgl_awal, $tgl_akhir, $limit="", $offset="", $column="", $sort="", $status="1"){
        $query = "
            select tp.*, ta.nama_anggota, tdp.id_detail_peminjaman, ta.no_identitas, mja.nama_jenis_anggota, tdp.kode_buku, tb.judul,
            tdp.tgl_pinjam, tdp.tgl_kembali, datediff(tdp.tgl_kembali ,tdp.tgl_pinjam) as lama_pinjam from t_peminjaman tp 
              left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
              left join t_buku tb on tdp.kode_buku = tb.kode_buku 
              left join t_anggota ta on tp.id_anggota = ta.id_anggota 
              left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
            where tp.status = '$status' ";
        // bulanan
        if($bulan!="" and $tahun!=""){
          $query .= " and EXTRACT(MONTH FROM tdp.tgl_pinjam) = '$bulan' and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$tahun' ";
        }
        // pertahun
        if($pertahun!=""){
          $query .= " and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$pertahun' ";
        }              
        // pertanggal
        if($pertanggal!=""){
          $query .= " and tdp.tgl_pinjam = '$pertanggal' ";
        }
        // rentang
        if($tgl_awal!="" and $tgl_akhir!=""){
          $query .= " and tdp.tgl_pinjam >= '$tgl_awal' and tdp.tgl_pinjam <= '$tgl_akhir' ";
        }
        $query .= " order by $column $sort
                    limit $limit offset $offset ";
        return $this->db->query($query);
    }

    function get_laporan_peminjaman($bulan="", $tahun="", $pertahun="", $pertanggal="", $tgl_awal="", $tgl_akhir="", $status="1"){
      $query = "
          select tp.*, ta.nama_anggota, tdp.id_detail_peminjaman, ta.no_identitas, mja.nama_jenis_anggota, tdp.kode_buku, tb.judul,
          tdp.tgl_pinjam, tdp.tgl_kembali, datediff(tdp.tgl_kembali ,tdp.tgl_pinjam) as lama_pinjam from t_peminjaman tp 
            left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
            left join t_buku tb on tdp.kode_buku = tb.kode_buku 
            left join t_anggota ta on tp.id_anggota = ta.id_anggota 
            left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
          where tp.status = '$status' ";

      if($bulan!="ALL" and $tahun!="ALL"){
        $query .= " and EXTRACT(MONTH FROM tdp.tgl_pinjam) = '$bulan' and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$tahun' ";
      }
      // pertahun
      if($pertahun!="ALL"){
        $query .= " and EXTRACT(YEAR FROM tdp.tgl_pinjam) = '$pertahun' ";
      }              
      // pertanggal
      if($pertanggal!="ALL"){
        $query .= " and tdp.tgl_pinjam = '$pertanggal' ";
      }
      // rentang
      if($tgl_awal!="ALL" and $tgl_akhir!="ALL"){
        $query .= " and tdp.tgl_pinjam >= '$tgl_awal' and tdp.tgl_pinjam <= '$tgl_akhir' ";
      }
      $query .= " order by tp.created_at desc ";
      return $this->db->query($query);
    }

    // ====================== Laporan Pengembalian ======================================

    function list_count_pengembalian($bulan="", $tahun="", $pertahun="", $pertanggal="", $tgl_awal="", $tgl_akhir="", $status_denda="", $status="2"){
      $query = "
          select count(*) as jml from t_peminjaman tp 
            left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman
            left join t_pengembalian tpb on tdp.id_detail_peminjaman = tpb.id_detail_peminjaman 
            left join t_buku tb on tdp.kode_buku = tb.kode_buku 
            left join t_anggota ta on tp.id_anggota = ta.id_anggota 
            left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
          where 
            tdp.status = '$status' ";
      // status denda
      if($status_denda!=""){
        $query .= " and tpb.status = '$status_denda' ";
      }
      // bulanan
      if($bulan!="" and $tahun!=""){
        $query .= " and EXTRACT(MONTH FROM tpb.tgl_pengembalian) = '$bulan' and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$tahun' ";
      }
      // pertahun
      if($pertahun!=""){
        $query .= " and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$pertahun' ";
      }             
      // pertanggal
      if($pertanggal!=""){
        $query .= " and tpb.tgl_pengembalian = '$pertanggal' ";
      }
      // rentang
      if($tgl_awal!="" and $tgl_akhir!=""){
        $query .= " and tpb.tgl_pengembalian >= '$tgl_awal' and tpb.tgl_pengembalian <= '$tgl_akhir' ";
      }
      
      return $this->db->query($query)->row_array();
    }

    function list_data_pengembalian($bulan="", $tahun="", $pertahun="", $pertanggal="", $tgl_awal="", $tgl_akhir="", $status_denda="", $limit="", $offset="", $column="", $sort="", $status="2"){
      $query = "
          select 
          tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
          tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari,
          mja.lama_pinjam, mja.max_peminjaman, mja.max_perpanjangan, tdp.created_at, datediff(tdp.tgl_kembali ,tdp.tgl_pinjam) as durasi_pinjam,
          tpb.tgl_pengembalian, tpb.hari_terlambat , tpb.denda, tdp.perpanjangan 
          from t_peminjaman tp 
            left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman
            left join t_pengembalian tpb on tdp.id_detail_peminjaman = tpb.id_detail_peminjaman 
            left join t_buku tb on tdp.kode_buku = tb.kode_buku 
            left join t_anggota ta on tp.id_anggota = ta.id_anggota 
            left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
          where 
            tdp.status = '$status' ";
      // status denda
      if($status_denda!=""){
        $query .= " and tpb.status = '$status_denda' ";
      }
      // bulanan
      if($bulan!="" and $tahun!=""){
        $query .= " and EXTRACT(MONTH FROM tpb.tgl_pengembalian) = '$bulan' and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$tahun' ";
      }
      // pertahun
      if($pertahun!=""){
        $query .= " and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$pertahun' ";
      }              
      // pertanggal
      if($pertanggal!=""){
        $query .= " and tpb.tgl_pengembalian = '$pertanggal' ";
      }
      // rentang
      if($tgl_awal!="" and $tgl_akhir!=""){
        $query .= " and tpb.tgl_pengembalian >= '$tgl_awal' and tpb.tgl_pengembalian <= '$tgl_akhir' ";
      }
      $query .= " order by $column $sort
                  limit $limit offset $offset ";
      return $this->db->query($query);
    }

    function get_laporan_pengembalian($bulan="", $tahun="", $pertahun="", $pertanggal="", $tgl_awal="", $tgl_akhir="", $status_denda="", $status="2"){
      $query = "                          
          select 
          tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
          tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari,
          mja.lama_pinjam, mja.max_peminjaman, mja.max_perpanjangan, tdp.created_at, datediff(tdp.tgl_kembali ,tdp.tgl_pinjam) as durasi_pinjam,
          tpb.tgl_pengembalian, tpb.hari_terlambat , tpb.denda, tdp.perpanjangan 
          from t_peminjaman tp 
            left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman
            left join t_pengembalian tpb on tdp.id_detail_peminjaman = tpb.id_detail_peminjaman 
            left join t_buku tb on tdp.kode_buku = tb.kode_buku 
            left join t_anggota ta on tp.id_anggota = ta.id_anggota 
            left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota              
          where 
            tdp.status = '$status' ";
      // status denda
      if($status_denda!=""){
        $query .= " and tpb.status = '$status_denda' ";
      }
      // bulanan
      if($bulan!="ALL" and $tahun!="ALL"){
        $query .= " and EXTRACT(MONTH FROM tpb.tgl_pengembalian) = '$bulan' and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$tahun' ";
      }
      // pertahun
      if($pertahun!="ALL"){
        $query .= " and EXTRACT(YEAR FROM tpb.tgl_pengembalian) = '$pertahun' ";
      }             
      // pertanggal
      if($pertanggal!="ALL"){
        $query .= " and tpb.tgl_pengembalian = '$pertanggal' ";
      }
      // rentang
      if($tgl_awal!="ALL" and $tgl_akhir!="ALL"){
        $query .= " and tpb.tgl_pengembalian >= '$tgl_awal' and tpb.tgl_pengembalian <= '$tgl_akhir' ";
      }

      $query .= " order by tpb.created_at desc ";
      return $this->db->query($query);
    }

  }
    /* End of file Laporan_m.php */    
?>
