<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->apl = get_apl();
      $this->load->model('M_main');
      $this->load->model('Buku_m');
      $this->load->model('Anggota_m');
    }

    public function cetak_label($kode_buku){
      $data['aplikasi'] = $this->apl;
      $data['title'] = "Cetak Label | ".$this->apl['instansi'];
      $data['detail_buku'] = $this->Buku_m->detail_buku($kode_buku)->row_array(); 

      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'potrait');
      $this->pdf->filename = "CETAK LABEL BUKU.pdf";
      $this->pdf->load_view('sistem/buku/layout_cetak/cetak-label.php', $data);
    }

    public function cetak_barcode($kode_buku){
      $data['aplikasi'] = $this->apl;
      $data['title'] = "Cetak Barcode | ".$this->apl['instansi'];
      $data['detail_buku'] = $this->Buku_m->detail_buku($kode_buku)->row_array(); 
      
      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'potrait');
      $this->pdf->filename = "CETAK BARCODE BUKU.pdf";
      $this->pdf->load_view('sistem/buku/layout_cetak/cetak-barcode.php', $data);  
    }

    public function cetak_katalog() {
      
    }

    public function cetak_kartu_anggota($id_anggota){
      $data['aplikasi'] = $this->apl;

      $pecahkan = explode('-', $id_anggota);
      $jml = count($pecahkan);
      
      for($i = 0; $i < $jml; $i++){
        $detail = $this->Anggota_m->get_anggota($pecahkan[$i])->row_array(); 
        $data['anggota'][] = array(
          'id_anggota' => $detail['id_anggota'],
          'nama_anggota' => $detail['nama_anggota'],
          'nama_jenis_anggota' => $detail['nama_jenis_anggota'],
          'foto' => $detail['foto'],
          'barcode' => $detail['barcode'], 
        );
      }

      $this->load->view('sistem/anggota/cetak-kartu-anggota.php', $data);    
    }

    public function cek_kartu(){
      $dataId = json_decode($_POST['id'], true);
      
      $tampung = "";
      $jml_array = count($dataId);
      $no = 0;
      foreach ($dataId as $id) {
        $no++;
        if($no==$jml_array){
            $tampung .= $id;
        }else{
            $tampung .= $id."-";
        }    
      }
      $data['id_anggota'] = $tampung;
      $this->load->view('sistem/anggota/modal-cetak-anggota.php', $data);  
    }

    public function barcode(){
        // generate_barcode('BK0000007','assets/data/barcode/');
        // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img style="width:180px; height:100px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BK0000001', $generator::TYPE_CODE_128)) . '">';
    }
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */