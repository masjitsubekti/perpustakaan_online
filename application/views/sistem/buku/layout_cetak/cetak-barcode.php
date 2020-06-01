<!DOCTYPE html>
<html>
<head>    
<title><?=$title?></title>	
<link rel="icon" sizes="16x16" href="">
<style>
  #layout{
    /* margin-left:0px; */
    /* margin:0px; */
  }
  .table {
    border-collapse: collapse;
    border-color: black;
    font-family: Arial, Verdana, Helvetica, 'Trebuchet MS';
    width:100%;
  }
  .head-table th{
    padding: 2px;
    border: 1px solid black;
    font-family: Arial, Verdana, Helvetica, 'Trebuchet MS';
    font-size:11px;
  }
  .body-table td,th{
    padding: 3px;
    border: 1px solid black;
    font-family: Arial, Verdana, Helvetica, 'Trebuchet MS';
    font-size:11px;
  }
  .head-lap td{
    padding: 1px;
    font-family: Arial, Helvetica, sans-serif; 
  }
  .text-center{
    text-align:center;
  }
  .text-left{
    text-align:left;
  }
  .text-right{
    text-align:right;
  }
  .line-title {
    border: 0;
    border-style: inset;
    border-top: 1px solid #000;
  }
  .line-title-child {
    border: 0;
    margin-top: -7px;
    border-top: 1px solid #000;
  }
  .labelStyle {
    width: 6cm;
    height: 4.5cm;
    text-align: center;
    margin: 0.05cm;
    padding: 0;
    border: 1px solid #000000;
  }
  .labelHeaderStyle {
    background-color: #CCCCCC;
    font-weight: bold;
    padding: 2px;
    margin-bottom: 5px;
  }
</style>
</head>
<body>
<div id="layout">
<table class="table">
    <tbody class="">
      <?php
          // barcode
          $path_barcode = base_url('assets/data/barcode_buku/'.$detail_buku['barcode']);
          $type = pathinfo($path_barcode, PATHINFO_EXTENSION);
          $data = file_get_contents($path_barcode);
          $barcode = 'data:image/' . $type . ';base64,' . base64_encode($data);
          
          $kolom = 3;
          $jml = 15;
          $i=0;    
          while ($i < $jml) {
            if(($i) % $kolom== 0) {    
              echo'<tr>';   
            }  ?>

            <td class="text-center" width="100%" style="padding-top:6px;">
              <div class="labelStyle" valign="top">
                <div class="labelHeaderStyle">
                  <span style="font-size:13px;">PERPUSTAKAAN</span>
                  <br>
                  <span style="font-size:13px;"><?= $aplikasi['instansi'] ?></span>
                  </div>
                  <br>
                  <div style="padding-top:-7px;">
                    <img style="width:5cm; height:1.4cm;" src="<?= $barcode ?>" alt="">
                    <p style="padding-top:-28px; font-size:14px;"><?= $detail_buku['kode_buku'] ?></p>
                    <p style="padding-top:-12px; font-size:11px;"><?= $detail_buku['judul'] ?></p>
                  </div>
               </div>
            </td>

            <?php  if(($i % $kolom) == ($kolom - 1) || ($i + 1) == $jml) {
              echo "</tr>";
            }
          $i++;
          }
      ?>
    </tbody>
</table>
</div>
</body>
</html>