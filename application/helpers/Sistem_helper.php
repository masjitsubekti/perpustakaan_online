<?php
function get_apl(){
    $CI =& get_instance();
    $data = $CI ->db
                ->where('id','CONF1')
                ->get('app_config')
                ->row_array();
    return $data;     
}
function get_jarak_waktu_penginapan($waktu_awal, $waktu_akhir){
    date_default_timezone_set('Asia/Jakarta');
    $apl = get_apl();
    $jarak = $apl['jarak_waktu_penginapan'];
    // $data = array();
    $data['tanggal_awal'] = date('Y-m-d', strtotime($waktu_awal." - $jarak days"));
    $data['tanggal_akhir'] = date('Y-m-d', strtotime($waktu_akhir." + $jarak days"));
    return $data;
}
function is_login(){
    $CI =& get_instance();
    $sesi_is_login = $CI->session->userdata('auth_is_login');
    if($sesi_is_login==TRUE){
        redirect(site_url('Beranda'));
    }
}
function must_login(){
    $CI =& get_instance();
    $cek = $CI->session->userdata('auth_is_login');
    if($cek==FALSE){
        redirect(site_url());
    }
}
function get_hari($hari){
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
    
            case 'Mon':			
                $hari_ini = "Senin";
            break;
    
            case 'Tue':
                $hari_ini = "Selasa";
            break;
    
            case 'Wed':
                $hari_ini = "Rabu";
            break;
    
            case 'Thu':
                $hari_ini = "Kamis";
            break;
    
            case 'Fri':
                $hari_ini = "Jumat";
            break;
    
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
        return $hari_ini;
}
function get_bulan($bulan){
    $array_bulan=array(
        '01'=>'Januari',
        '02'=>'Februari',
        '03'=>'Maret',
        '04'=>'April',
        '05'=>'Mei',
        '06'=>'Juni',
        '07'=>'Juli',
        '08'=>'Agustus',
        '09'=>'September',
        '10'=>'Oktober',
        '11'=>'November',
        '12'=>'Desember'
    );
    $bulan_ini = $array_bulan[$bulan];
    return $bulan_ini;
}
function generate_tanggal_indonesia($tgl){
    $array_bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
    $waktu_db = strtotime($tgl);
    $hari = date('d',$waktu_db);
    $bulan = $array_bulan[date('m',$waktu_db)];
    $tahun = date('Y',$waktu_db);
    return $hari.' '.$bulan.' '.$tahun;
}
function tgl_indo_dan_jam($tanggal){
    $date = strtotime($tanggal);
    $tanggal =  date('Y-m-d', $date);
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function kelamin($jenkel){
    if ($jenkel=='L') {
        echo "Laki - Laki";
    }elseif ($jenkel=='P') {
        echo "Perempuan";
    }else{
        echo "-";
    }
}
function validateDate($date, $format = 'd-m-Y')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function api_register($id_user,$nama,$email){
    $CI =& get_instance();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => $CI->apl['email_instansi'],
        'smtp_pass' => $CI->apl['pass_instansi'],
        'smtp_port' => 465,
        'crlf'      => "\r\n",
        'newline'   => "\r\n"
    ];

    $CI->load->library('email', $config); 
    $CI->email->from($CI->apl['email_instansi'], $CI->apl['nama_sistem']);
    $CI->email->to($email);
    // $CI->email->attach('url_file');
    $CI->email->subject('Verifikasi Pendaftaran | '.$CI->apl['nama_sistem']);
    $data['id_user'] = $id_user;
    $data['nama'] = $nama;
    $data['root_apl'] = $CI->apl['url_root'];
    $body = $CI->load->view('front/login/format-email',$data,TRUE);
    $CI->email->message($body);
    if ($CI->email->send()) {
        $message = 'Sukses! email berhasil dikirim.';
    } else {
        $message =  'Error! email tidak dapat dikirim.';
    }
    return $message;
}

function api_reset_pass($id_user,$nama,$email){
    $CI =& get_instance();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => $CI->apl['email_instansi'],
        'smtp_pass' => $CI->apl['pass_instansi'],
        'smtp_port' => 465,
        'crlf'      => "\r\n",
        'newline'   => "\r\n"
    ];

    $CI->load->library('email', $config); 
    $CI->email->from($CI->apl['email_instansi'], $CI->apl['nama_sistem']);
    $CI->email->to($email);
    // $CI->email->attach('url_file');
    $CI->email->subject('Reset Password | '.$CI->apl['nama_sistem']);
    $data['id_user'] = $id_user;
    $data['nama'] = $nama;
    $data['root_apl'] = $CI->apl['url_root'];
    $body = $CI->load->view('front/login/format-email-reset-pass',$data,TRUE);
    $CI->email->message($body);
    if ($CI->email->send()) {
        $message = 'Sukses! email berhasil dikirim.';
    } else {
        $message =  'Error! email tidak dapat dikirim.';
    }
    return $message;
}

function api_add_peserta($id_user,$nama,$email,$username){
    $CI =& get_instance();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => $CI->apl['email_instansi'],
        'smtp_pass' => $CI->apl['pass_instansi'],
        'smtp_port' => 465,
        'crlf'      => "\r\n",
        'newline'   => "\r\n"
    ];

    $CI->load->library('email', $config); 
    $CI->email->from($CI->apl['email_instansi'], $CI->apl['nama_sistem']);
    $CI->email->to($email);
    // $CI->email->attach('url_file');
    $CI->email->subject('Verifikasi Pendaftaran | '.$CI->apl['nama_sistem']);
    $data['id_user'] = $id_user;
    $data['username'] = $username;
    $data['nama'] = $nama;
    $data['root_apl'] = $CI->apl['url_root'];
    $body = $CI->load->view('admin_sistem/format_email/email-add-peserta',$data,TRUE);
    $CI->email->message($body);
    if ($CI->email->send()) {
        $message = 'Sukses! email berhasil dikirim.';
    } else {
        $message =  'Error! email tidak dapat dikirim.';
    }
    return $message;
}

function api_usulan_pelatihan($id_user,$nama,$email,$username,$param,$data_pelatihan = array()){
    $CI =& get_instance();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => $CI->apl['email_instansi'],
        'smtp_pass' => $CI->apl['pass_instansi'],
        'smtp_port' => 465,
        'crlf'      => "\r\n",
        'newline'   => "\r\n"
    ];

    $CI->load->library('email', $config); 
    $CI->email->from($CI->apl['email_instansi'], $CI->apl['nama_sistem']);
    $CI->email->to($email);
    // $CI->email->attach('url_file');
    $CI->email->subject('Pengajuan Usulan Pelatihan | '.$CI->apl['nama_sistem']);
    $data['id_user'] = $id_user;
    $data['nama'] = $nama;
    $data['username'] = $username;
    $data['data_pelatihan'] = $data_pelatihan;
    $data['root_apl'] = $CI->apl['url_root'];
    if($param == "USULAN_PELATIHAN"){
        $body = $CI->load->view('admin_sistem/format_email/email-usulan-pelatihan',$data,TRUE);     
    }else if($param == "VERIFIKASI_USULAN_PELATIHAN"){
        $body = $CI->load->view('admin_sistem/format_email/email-verifikasi-booking',$data,TRUE);
    }
    $CI->email->message($body);
    if ($CI->email->send()) {
        $message = 'Sukses! email berhasil dikirim.';
    } else {
        $message =  'Error! email tidak dapat dikirim.';
    }
    return $message;
}

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function format_tgl_indo($tanggal){
    $bulan = array (
        1 =>   '01',
        '02',
        '03',
        '04',
        '05',
        '06',
        '07',
        '08',
        '09',
        '10',
        '11',
        '12'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . '-' . $bulan[ (int)$pecahkan[1] ] . '-' . $pecahkan[0];
}

function format_nip($nip, $batas = " ") {
    $nip = trim($nip," ");
    $panjang = strlen($nip);
     
    if($panjang == 18) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin
        $sub[] = substr($nip, 3, 3); // nomor urut
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2].$batas.$sub[3];
    } elseif($panjang == 15) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2];
    } elseif($panjang == 9) {
        $sub = str_split($nip,3);
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2];
    } else {
        return $nip;
    }
}

function nama_gelar($g_depan,$nama,$g_belakang){
    $gelar_depan = "";
    $gelar_belakang = "";
    // gelar depan
    if($g_depan=="-"||$g_depan==""){
        $gelar_depan;
    }else{
        $gelar_depan = $g_depan.' ';
    } 
    // gelar belakang
    if($g_belakang=="-"||$g_belakang==""){
        $gelar_belakang;
    }else{
        $gelar_belakang = ' '.$g_belakang;
    } 
    return $gelar_depan.$nama.$gelar_belakang;
}

function nama_pelatihan($nama_pelatihan,$angkatan){
    $sambung_angkatan = "";
    // Angkatan
    if($angkatan=="-"||$angkatan==""){
        $sambung_angkatan = "";
    }else{
        $sambung_angkatan = ' Angkatan '.$angkatan;
    } 
    return $nama_pelatihan.$sambung_angkatan;
}

function status_pelaksanaan($tgl_awal,$tgl_akhir){
    $tgl_sekarang = date('Y-m-d');
    if($tgl_awal=="" || $tgl_akhir==""){
        $status = "4"; //tgl belum ditentukan
    }else if($tgl_sekarang < $tgl_awal){
        $status = "1"; //pending
    }else if($tgl_sekarang >= $tgl_awal && $tgl_sekarang <= $tgl_akhir){
        $status = "2"; //Running
    }else if($tgl_sekarang > $tgl_akhir){
        $status = "3"; //finish
    }
    return $status;
}

function narasi_status_pelaksanaan($tgl_awal,$tgl_akhir,$param=""){
    $tgl_sekarang = date('Y-m-d');
    if($tgl_awal=="" || $tgl_akhir==""){
        $status = "<span class='badge badge-secondary' style='font-size:12px;'> Pending </span>";
        $status_front = "<span class='badge badge-warning' style='font-size:12px;'> Belum Dimulai </span>";
    }else if($tgl_sekarang < $tgl_awal){
        $status = "<span class='badge badge-secondary' style='font-size:12px;'> Pending </span>"; //pending
        $status_front = "<span class='badge badge-warning' style='font-size:12px;'> <i class='fa fa-clock-o'></i>  Belum Dimulai </span>"; //pending
    }else if($tgl_sekarang >= $tgl_awal && $tgl_sekarang <= $tgl_akhir){
        $status = "<span class='badge badge-secondary' style='font-size:12px;'> Running </span>"; //Running
        $status_front = "<span class='badge badge-info' style='font-size:12px;'> <i class='fa fa-gavel'></i> Sedang Berlangsung </span>"; //Running
    }else if($tgl_sekarang > $tgl_akhir){
        $status = "<span class='badge badge-secondary' style='font-size:12px;'> Finish </span>"; //finish
        $status_front = "<span class='badge badge-success' style='font-size:12px;'> <i class='fa fa-check-circle'></i> Selesai </span>"; //finish
    }

    if($param=="FRONT"){
        return $status_front;  
    }else{
        return $status;
    }
}

function tgl_pendaftaran($tgl_awal){
    $tgl = date('Y-m-d');
    $tgl_pendaftaran = date('Y-m-d', strtotime('-45 days', strtotime($tgl_awal)));
    return $tgl_pendaftaran;
}

function get_kriteria($nilai){
    $pecahkan = explode('.', $nilai);
    $ex_nilai = intval($pecahkan[0]);
    if($ex_nilai >= 45 && $ex_nilai <= 55){
        $kriteria = "Kurang";
    }else if($ex_nilai >= 56 && $ex_nilai <= 75){
        $kriteria = "Cukup";     
    }else if($ex_nilai >= 76 && $ex_nilai <= 85){
        $kriteria = "Baik";
    }else if($ex_nilai >= 86 && $ex_nilai <= 100){
        $kriteria = "Sangat Baik";
    }else{
        $kriteria = "";
    }
    return $kriteria;
}

function get_persentase($nilai,$total){
    $persentase = intval($nilai) / intval($total) * 100;
    $format = sprintf('%0.1f', $persentase);
    // $hasil = round($persentase, 1);
    return $format;
}
function format_nilai($nilai){
    $format = sprintf('%0.1f', $nilai);
    return $format;
}
function rata_rata_nilai($jum_nilai,$total){
    $nilai = $jum_nilai/$total;
    $average = sprintf('%0.1f', $nilai);
    return $average;
}
function kodeRandom($length = 10) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str  .= $characters[$rand];
    }
    return $str;
}
// Prepost Test
function get_nilai_prepost($nilai,$total){
    $persentase = intval($nilai) / intval($total) * 100;
    $format = sprintf('%0.2f', $persentase);
    return $format;
}
function format_nilai_kenaikan($nilai){
    $format = sprintf('%0.2f', $nilai);
    return $format;
}
function format_nilai_desimal($nilai){
    $format = sprintf('%0.0f', $nilai);
    return $format;
}
function rata_rata_prepost($jum_nilai,$total){
    $nilai = $jum_nilai/$total;
    $average = sprintf('%0.2f', $nilai);
    return $average;
}
