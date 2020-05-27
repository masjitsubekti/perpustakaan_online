<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Laporan extends CI_Controller {

    private $nama_menu  = "Laporan";     

    public function __construct()
    {
        parent::__construct();
        $this->apl = get_apl();
        $this->load->model('Menu_m');
        $this->load->model('Peminjaman_m');
        $this->load->model('Laporan_m');
        must_login();
    }
    
    public function peminjaman(){
      $this->Menu_m->role_has_access($this->nama_menu);

      $data['app'] = $this->apl;
      $data['nama_menu'] = $this->nama_menu;
      $data['title'] = $this->nama_menu." | ".$this->apl['nama_sistem'];
      
      // Breadcrumbs
      $this->mybreadcrumb->add('Beranda', site_url('Beranda'));
      $this->mybreadcrumb->add('Laporan Peminjaman', site_url('Laporan/peminjaman'));
      $data['breadcrumbs'] = $this->mybreadcrumb->render();
      // End Breadcrumbs
      $data['content'] = "laporan/laporan_peminjaman/v-peminjaman.php";
      $this->parser->parse('sistem/template', $data);
    }    

    public function read_data_peminjaman($pg=1){
      $key	= ($this->input->post("cari") != "") ? strtoupper(quotes_to_entities($this->input->post("cari"))) : "";
      $limit	= $this->input->post("limit");
      $offset = ($limit*$pg)-$limit;
      $column = $this->input->post('column');
      $sort = $this->input->post('sort');
      // per tanggal dan tahun
      $pertanggal = ($this->input->post('input_per_tanggal')!="") ? $this->input->post('input_per_tanggal') : "";
      $pertahun = $this->input->post('input_per_tahun');
      // perbulan
      $bulan = $this->input->post('bulan');
      $tahun = $this->input->post('tahun');
      // rentang tanggal
      $tgl_awal = ($this->input->post('tgl_awal')!="") ? $this->input->post('tgl_awal') : "";
      $tgl_akhir = ($this->input->post('tgl_akhir')!="") ? $this->input->post('tgl_akhir') : "";

      $page              = array();
      $page['limit']     = $limit;
      $page['count_row'] = $this->Laporan_m->list_count_peminjaman($bulan, $tahun, $pertahun, $pertanggal, $tgl_awal, $tgl_akhir)['jml'];
      $page['current']   = $pg;
      $page['list']      = gen_paging($page);
      $data['paging']    = $page;
      $data['list']      = $this->Laporan_m->list_data_peminjaman($bulan, $tahun, $pertahun, $pertanggal, $tgl_awal, $tgl_akhir, $limit, $offset, $column, $sort);

      $this->load->view('sistem/laporan/laporan_peminjaman/v-data-peminjaman',$data);
    }

    public function export_laporan_peminjaman(){
      $aplikasi = $this->apl;
      $laporan_peminjaman = $this->Laporan_m->get_laporan_peminjaman();
      // Create new Spreadsheet object
      $spreadsheet = new Spreadsheet();
  
      // Set document properties
      $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
      $spreadsheet->getDefaultStyle()->getFont()->setSize(11);
  
      $alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
      $alignment_left = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT;
      $vertical_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
  
      // Set document properties
      $spreadsheet->getProperties()->setCreator('Perpustakaan - '.$aplikasi['instansi'])
      ->setLastModifiedBy('Perpustakaan - '.$aplikasi['instansi'])
      ->setTitle('Laporan Peminjaman')
      ->setKeywords('Laporan Peminjaman');
  
      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
      $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'LAPORAN PEMINJAMAN BUKU');
      $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal($alignment_center);
      $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(13)->setBold(true);
      
      // $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
      // $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', $aplikasi['instansi']);
      // $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal($alignment_center);
      // $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(13)->setBold(true);
  
      $border = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '2D2D2D'],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ],
      ];
  
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
  
      $spreadsheet->setActiveSheetIndex(0)
      // BARIS 1
      ->setCellValue('A4', 'NO')
      ->setCellValue('B4', 'ID ANGGOTA')
      ->setCellValue('C4', 'NAMA ANGGOTA')
      ->setCellValue('D4', 'NO IDENTITAS')
      ->setCellValue('E4', 'JENIS ANGGOTA')
      ->setCellValue('F4', 'KODE BUKU')
      ->setCellValue('G4', 'JUDUL')
      ->setCellValue('H4', 'DURASI PINJAM')
      ->setCellValue('I4', 'TANGGAL PINJAM')
      ->setCellValue('J4', 'TANGGAL KEMBALI')
      ;
  
      foreach (range('A', 'J') as $column){
        $spreadsheet->getActiveSheet()->getStyle($column.'4')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle($column.'4')->applyFromArray($border);
        $spreadsheet->getActiveSheet()->getStyle($column.'4')->getAlignment()->setVertical($vertical_center);
        $spreadsheet->getActiveSheet()->getStyle($column.'4')->getFont()->setBold(true);
      }
        
      $i=5; 
      $no=0;
      foreach($laporan_peminjaman->result() as $row) { $no++;
          $tgl_pinjam = ($row->tgl_pinjam!="") ? tgl_indo($row->tgl_pinjam) : '';
          $tgl_kembali = ($row->tgl_kembali!="") ? tgl_indo($row->tgl_kembali) : '';
          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A'.$i, $no)
                      ->setCellValue('B'.$i, ($row->id_anggota!="") ? $row->id_anggota : '')
                      ->setCellValue('C'.$i, ($row->nama_anggota!="") ? $row->nama_anggota : '')
                      ->setCellValue('D'.$i, ($row->no_identitas!="") ? $row->no_identitas : '')
                      ->setCellValue('E'.$i, ($row->nama_jenis_anggota!="") ? $row->nama_jenis_anggota : '')
                      ->setCellValue('F'.$i, ($row->kode_buku!="") ? $row->kode_buku : '')
                      ->setCellValue('G'.$i, ($row->judul!="") ? $row->judul : '')
                      ->setCellValue('H'.$i, ($row->lama_pinjam!="") ? $row->lama_pinjam.' Hari' : '')
                      ->setCellValue('I'.$i, $tgl_pinjam)
                      ->setCellValue('J'.$i, $tgl_kembali)
          ;
  
          $spreadsheet->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal('left');
          $spreadsheet->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal('left');
          $spreadsheet->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setHorizontal('center');
          $spreadsheet->getActiveSheet()->getStyle('J'.$i)->getAlignment()->setHorizontal('center');
        
          foreach (range('A', 'J') as $column){
              $spreadsheet->getActiveSheet()->getStyle($column.$i)->applyFromArray($border);
              $spreadsheet->getActiveSheet()->getStyle($column.$i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
          }   
          $i++;
      }
  
      // Rename worksheet
      $spreadsheet->getActiveSheet()->setTitle('Laporan Peminjaman '.date('d-m-Y'));
  
      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
      $spreadsheet->setActiveSheetIndex(0);
  
      // Redirect output to a client’s web browser (Xlsx)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Laporan Peminjaman.xlsx"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');
  
      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0
  
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;
  }
}

/* End of file Laporan.php */
