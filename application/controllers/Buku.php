<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    private $nama_menu  = "Data Buku";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('M_main');
        $this->load->model('Buku_m');
        must_login();
    }
    
    public function index()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Daftar Buku', site_url('Buku'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "buku/v-buku.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function katalog()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Katalog', site_url('Buku/katalog'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "buku/v-katalog.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function cetak()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Cetak', site_url('Buku/cetak'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
 
        $data['content'] = "buku/v-cetak.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function detail_katalog($kode_buku)
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Katalog', site_url('Buku/katalog'));
        $this->mybreadcrumb->add('Detail Katalog', site_url('Buku/detail_katalog'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        
        $data['book'] = $this->Buku_m->detail_buku($kode_buku)->row_array();
        $data['content'] = "buku/v-detail-katalog.php";
        $this->parser->parse('sistem/template', $data);
    }
    
    public function form_add()
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Daftar Buku', site_url('Buku'));
        $this->mybreadcrumb->add('Tambah Buku', site_url('Buku/form_add'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        
        $data['modeform'] = 'ADD';
        $data['kode_buku'] = $this->M_main->getKodeMaster7('BK','kode_buku','t_buku');
        $data['kategori'] = $this->M_main->get_where('m_kategori_buku','status','1')->result();
        $data['penerbit'] = $this->M_main->get_where('m_penerbit','status','1')->result();
        $data['rak'] = $this->M_main->get_where('m_rak','status','1')->result();
        $data['sumber'] = $this->M_main->get_where('m_sumber','status','1')->result();
        $data['pengarang'] = $this->M_main->get_where('m_pengarang','status','1')->result();
        $data['bahasa'] = $this->M_main->get_where('m_bahasa','status','1')->result();
        $data['jenis_koleksi'] = $this->M_main->get_where('m_jenis_koleksi','status','1')->result();
        
        $data['content'] = "buku/v-form-buku.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function form_edit($kode_buku)
    {
        $this->Menu_m->role_has_access($this->nama_menu);

        $data['app'] = $this->apl;
        $data['nama_menu'] = $this->nama_menu;
        $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];

        // Breadcrumbs
        $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
        $this->mybreadcrumb->add('Daftar Buku', site_url('Buku'));
        $this->mybreadcrumb->add('Edit Buku', site_url('Buku/form_edit'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        // End Breadcrumbs
        
        $data['modeform'] = 'UPDATE';
        $data['kode_buku'] = $this->M_main->getKodeMaster7('BK','kode_buku','t_buku');
        $data['kategori'] = $this->M_main->get_where('m_kategori_buku','status','1')->result();
        $data['penerbit'] = $this->M_main->get_where('m_penerbit','status','1')->result();
        $data['rak'] = $this->M_main->get_where('m_rak','status','1')->result();
        $data['sumber'] = $this->M_main->get_where('m_sumber','status','1')->result();
        $data['data_buku'] = $this->M_main->get_where('t_buku','kode_buku',$kode_buku)->row_array();
        $data['pengarang'] = $this->M_main->get_where('m_pengarang','status','1')->result();
        $data['bahasa'] = $this->M_main->get_where('m_bahasa','status','1')->result();
        $data['jenis_koleksi'] = $this->M_main->get_where('m_jenis_koleksi','status','1')->result();
        
        $data['content'] = "buku/v-form-buku.php";
        $this->parser->parse('sistem/template', $data);
    }

    public function read_data($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
      
      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->Buku_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Buku_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/buku/v-data-buku',$data);
    }

    public function read_katalog($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
      $data['key'] = $key;
      
      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->Buku_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Buku_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/buku/v-data-katalog',$data);
    }

    public function read_data_cetak($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
      
      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->Buku_m->list_count($key)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Buku_m->list_data($key, $limit, $offset, $column, $sort);

      $this->load->view('sistem/buku/v-data-cetak',$data);
    }

    public function load_modal_cetak(){
      $id = $this->input->post('id');
      $mode = $this->input->post('mode');
      $judul = $this->input->post('judul');
      $data['kode_buku'] = $id;
      $data['mode'] = $mode;
      $data['judul'] = $judul;
      $this->load->view('sistem/buku/modal-cetak',$data);
    }

    public function simpan(){
        $modeform = $this->input->post('modeform');
        $kode_buku = strip_tags(trim($this->input->post('kode_buku')));
        $judul = strip_tags(trim($this->input->post('judul')));
        $isbn = strip_tags(trim($this->input->post('isbn')));
        $pengarang = strip_tags(trim($this->input->post('pengarang')));
        $kategori = strip_tags(trim($this->input->post('kategori')));
        $lokasi_rak = strip_tags(trim($this->input->post('lokasi_rak')));
        $sumber = strip_tags(trim($this->input->post('sumber')));
        $penerbit = strip_tags(trim($this->input->post('penerbit')));
        $tempat_terbit = strip_tags(trim($this->input->post('tempat_terbit')));
        $tahun_terbit = strip_tags(trim($this->input->post('tahun_terbit')));
        $halaman = strip_tags(trim($this->input->post('halaman')));
        $tinggi = strip_tags(trim($this->input->post('tinggi')));
        $edisi = strip_tags(trim($this->input->post('edisi')));
        $stok = strip_tags(trim($this->input->post('stok')));
        $keterangan = strip_tags(trim($this->input->post('keterangan')));
        $bahasa = strip_tags(trim($this->input->post('bahasa')));
        $jenis_koleksi = strip_tags(trim($this->input->post('jenis_koleksi')));
        $ddc = strip_tags(trim($this->input->post('ddc')));
        $no_inventaris = strip_tags(trim($this->input->post('no_inventaris')));
        $bagikan = $this->input->post('bagikan');
        $foto_sampul = lakukan_upload_file('foto_sampul','/assets/data/foto_buku/','jpg|png|jpeg');
        
        if($modeform == 'ADD'){
            $barcode = generate_barcode($kode_buku,'assets/data/barcode_buku/');
            
            $id = $this->uuid->v4(false);
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'kode_buku'     =>$kode_buku,
                'judul'         =>$judul,
                'id_pengarang'  =>$pengarang,
                'id_kategori'   =>$kategori,
                'id_sumber'     =>$sumber,
                'id_rak'        =>$lokasi_rak,
                'id_penerbit'   =>$penerbit,
                'tahun_terbit'  =>$tahun_terbit,
                'tempat_terbit' =>$tempat_terbit,
                'halaman'       =>$halaman,
                'tinggi'        =>$tinggi,
                'stok'          =>$stok,
                'edisi'         =>$edisi,
                'ddc'           =>$ddc,
                'isbn'          =>$isbn,
                'no_inventaris' =>$no_inventaris,
                'id_jenis_koleksi' =>$jenis_koleksi,
                'id_bahasa'     =>$bahasa,
                'tanggal'       =>date('Y-m-d'),
                'foto'          =>(!empty($_FILES["foto_sampul"]["tmp_name"])) ? $foto_sampul['file_name'] : "",
                'barcode'       =>$barcode,
                'keterangan'    =>$keterangan,
                'flag_bagikan'  =>$bagikan,
                'status'        =>'1',
                'created_at'    =>date('Y-m-d H:i:s')
            );
            $this->db->insert('t_buku', $data_object);
            $response['success'] = TRUE;
            $response['message'] = "Data Buku Berhasil Disimpan";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Tambah Buku", 'Berhasil Tambah Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        
        }else if($modeform == 'UPDATE'){
            $kode_buku_ubah = $this->input->post('kode_buku_ubah');
            $cek_upload = $this->M_main->get_where('t_buku','kode_buku',$kode_buku_ubah)->row_array();
            
            date_default_timezone_set('Asia/Jakarta');
            $data_object = array(
                'judul'         =>$judul,
                'id_pengarang'  =>$pengarang,
                'id_kategori'   =>$kategori,
                'id_sumber'     =>$sumber,
                'id_rak'        =>$lokasi_rak,
                'id_penerbit'   =>$penerbit,
                'tahun_terbit'  =>$tahun_terbit,
                'tempat_terbit' =>$tempat_terbit,
                'halaman'       =>$halaman,
                'tinggi'        =>$tinggi,
                'stok'          =>$stok,
                'edisi'         =>$edisi,
                'ddc'           =>$ddc,
                'isbn'          =>$isbn,
                'no_inventaris' =>$no_inventaris,
                'id_jenis_koleksi' =>$jenis_koleksi,
                'id_bahasa'     =>$bahasa,
                'foto'          =>(!empty($_FILES["foto_sampul"]["tmp_name"])) ? $foto_sampul['file_name'] : $cek_upload['foto'],
                'keterangan'    =>$keterangan,    
                'flag_bagikan'  =>$bagikan,
                'updated_at'=>date('Y-m-d H:i:s')
            );
				
            $this->db->where('kode_buku',$kode_buku_ubah);
            $this->db->update('t_buku', $data_object);

            $response['success'] = true;
            $response['message'] = "Data Buku Berhasil Diperbarui !";
            
            $username = $this->session->userdata('auth_username');
            insert_log($username, "Edit Buku", 'Berhasil Edit Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());       
        }
        echo json_encode($response);   
    }

    public function nonaktifkan(){
      if($this->input->post('id')){
        $id = $this->input->post('id');
        date_default_timezone_set('Asia/Jakarta');
        $object = array(
          'status' => '0',
          'deleted_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('kode_buku', $id);
        $this->db->update('t_buku', $object);
        
        $response['success'] = true;
        $response['message'] = "Data berhasil dinonaktifkan !";
        
        $username = $this->session->userdata('auth_username');
        insert_log($username, "Hapus Buku", 'Berhasil Hapus Buku', $this->input->ip_address(), $this->agent->browser(), $this->agent->agent_string());        
      }else{
        $response['success'] = false;
        $response['message'] = "Data tidak ditemukan !";
      }
      echo json_encode($response);
    }
    
}

/* End of file buku.php */
