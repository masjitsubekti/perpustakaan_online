<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Cetak extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('M_main');
        $this->load->model('Laporan_m');
    }

    public function index() {

    }

    // Export ke excel
    public function export(){
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
    $spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
    ->setLastModifiedBy('Andoyo - Java Web Medi')
    ->setTitle('Office 2007 XLSX Test Document')
    ->setSubject('Office 2007 XLSX Test Document')
    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Test result file');

    $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'LAPORAN PEMINJAMAN');
    $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal($alignment_center);
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(13)->setBold(true);

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
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(65);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(11);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(17);

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
        $tgl_pinjam = ($row->tgl_pinjam!="") ? format_tgl_indo($row->tgl_pinjam) : '';
        $tgl_kembali = ($row->tgl_kembali!="") ? format_tgl_indo($row->tgl_kembali) : '';
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $no)
                    ->setCellValue('B'.$i, ($row->id_anggota!="") ? $row->id_anggota : '')
                    ->setCellValue('C'.$i, ($row->nama_anggota!="") ? $row->nama_anggota : '')
                    ->setCellValue('D'.$i, ($row->no_identitas!="") ? $row->no_identitas : '')
                    ->setCellValue('E'.$i, ($row->nama_jenis_anggota!="") ? $row->nama_jenis_anggota : '')
                    ->setCellValue('F'.$i, ($row->kode_buku!="") ? $row->kode_buku : '')
                    ->setCellValue('G'.$i, ($row->judul!="") ? $row->judul : '')
                    ->setCellValue('H'.$i, ($row->lama_pinjam!="") ? $row->lama_pinjam : '')
                    ->setCellValue('I'.$i, $tgl_pinjam)
                    ->setCellValue('J'.$i, $tgl_kembali)
        ;

        $spreadsheet->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal('left');
        $spreadsheet->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('J'.$i)->getAlignment()->setHorizontal('center');
      
        foreach (range('A', 'J') as $column){
            $spreadsheet->getActiveSheet()->getStyle($column.$i)->applyFromArray($border);
            $spreadsheet->getActiveSheet()->getStyle($column.$i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }   
        $i++;
      }
      // $spreadsheet->getActiveSheet()->setTitle('Laporan Peminjaman');




    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
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

    public function export_laporan_peminjaman(){
      
    }

    public function barcode(){
        // generate_barcode('BK0000007','assets/data/barcode/');
        // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img style="width:180px; height:100px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BK0000001', $generator::TYPE_CODE_128)) . '">';
    }
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */