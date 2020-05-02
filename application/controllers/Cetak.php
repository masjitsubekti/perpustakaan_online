<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Cetak extends CI_Controller {

// Load model
public function __construct()
{
parent::__construct();
    $this->load->model('M_main');
}

// Main page
public function index()
{
    $provinsi = $this->provinsi_model->listing();
    $data = array( 'title' => 'Laporan Exel - Java Media',
    'provinsi' => $provinsi
    );
    $this->load->view('laporan', $data, FALSE);
}

// Export ke excel
public function export()
{
$kategori = $this->M_main->get_all('m_kategori_buku');
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
->setLastModifiedBy('Andoyo - Java Web Medi')
->setTitle('Office 2007 XLSX Test Document')
->setSubject('Office 2007 XLSX Test Document')
->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

// Add some data
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', 'Nama Kategori')
;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($kategori->result() as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->nama_kategori);
$i++;
}

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

public function barcode(){
    generate_barcode('BK0000007','assets/data/barcode/');
    // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    // echo '<img style="width:180px; height:100px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BK0000001', $generator::TYPE_CODE_128)) . '">';
}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */