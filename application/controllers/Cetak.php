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

    public function cetak_kartu_anggota() {
      
    }

    public function barcode(){
        // generate_barcode('BK0000007','assets/data/barcode/');
        // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img style="width:180px; height:100px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BK0000001', $generator::TYPE_CODE_128)) . '">';
    }
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */