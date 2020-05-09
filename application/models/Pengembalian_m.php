<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Pengembalian_m extends CI_Model {
        function list_count($key="", $status="1"){
            $query = $this->db->query("
                select count(*) as jml from(
                    select tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
                    tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari, tdp.created_at,
                    (select CURDATE()) as tgl_sekarang,
                    case 
                        when (select CURDATE() - tdp.tgl_kembali) >=0 then (select CURDATE() - tdp.tgl_kembali)
                    else 0
                    end as terlambat
                    from t_peminjaman tp 
                        left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                        left join t_buku tb on tdp.kode_buku = tb.kode_buku
                        left join t_anggota ta on tp.id_anggota = ta.id_anggota
                        left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota 
                    )x        
                ")->row_array();
            return $query;
        }
    
        function list_data($id_anggota, $key="",  $limit="", $offset="", $column="", $sort="", $status="1"){
            $query = $this->db->query("                
                select x.*, (x.denda_perhari * terlambat) as denda from(
                    select tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
                    tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari, tdp.created_at,
                    (select CURDATE()) as tgl_sekarang,
                    case 
                        when (select CURDATE() - tdp.tgl_kembali) >=0 then (select CURDATE() - tdp.tgl_kembali)
                    else 0
                    end as terlambat
                    from t_peminjaman tp 
                        left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                        left join t_buku tb on tdp.kode_buku = tb.kode_buku
                        left join t_anggota ta on tp.id_anggota = ta.id_anggota
                        left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota 
                    )x
                    where 
                        x.status = '$status'
                        and x.id_anggota = '$id_anggota'
                order by $column $sort
                limit $limit offset $offset
            ");
            return $query;
        }

        function detail_peminjaman($id_detail_peminjaman){
            $query = $this->db->query("                
                select x.*, (x.denda_perhari * terlambat) as denda from(
                    select tp.id_peminjaman, tdp.id_detail_peminjaman, tp.id_anggota, ta.nama_anggota, tdp.kode_buku, tb.judul,
                    tdp.tgl_pinjam, tdp.tgl_kembali, tdp.perpanjangan, tdp.flag_perpanjangan, ta.id_jenis_anggota, mja.nama_jenis_anggota as jenis_anggota, tdp.status, mja.jumlah_denda as denda_perhari,
                    mja.lama_pinjam, mja.max_peminjaman, mja.max_perpanjangan, tdp.created_at, (select CURDATE()) as tgl_sekarang,
                    case 
                        when (select CURDATE() - tdp.tgl_kembali) >=0 then (select CURDATE() - tdp.tgl_kembali)
                    else 0
                    end as terlambat
                    from t_peminjaman tp 
                        left join t_detail_peminjaman tdp on tp.id_peminjaman = tdp.id_peminjaman 
                        left join t_buku tb on tdp.kode_buku = tb.kode_buku
                        left join t_anggota ta on tp.id_anggota = ta.id_anggota
                        left join m_jenis_anggota mja on ta.id_jenis_anggota = mja.id_jenis_anggota 
                    )x
                    where 
                        x.id_detail_peminjaman = '$id_detail_peminjaman'
            ");
            return $query;
        }
    }
    /* End of file Pengembalian_m.php */    
?>