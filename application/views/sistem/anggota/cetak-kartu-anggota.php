<?php
$path_foto = base_url('assets/data/foto_anggota/'.$detail_anggota['foto']);
$type = pathinfo($path_foto, PATHINFO_EXTENSION);
$data = file_get_contents($path_foto);
$foto = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path_barcode = base_url('assets/data/barcode_anggota/'.$detail_anggota['barcode']);
$type = pathinfo($path_barcode, PATHINFO_EXTENSION);
$data = file_get_contents($path_barcode);
$barcode = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path_logo = base_url('assets/data/aplikasi/'.$aplikasi['logo']);
$type = pathinfo($path_logo, PATHINFO_EXTENSION);
$data = file_get_contents($path_logo);
$logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

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
  .cardStyle {
    width: 8.6cm;
    height: 5.4cm;
    text-align: center;
    margin: 0.05cm;
    padding: 0;
    border: 1px solid #000000;
  }
  .cardHeaderStyle {
    background-color: #CCCCCC;
    font-weight: bold;
    /* padding: 2px; */
    /* margin-bottom: 5px; */
  }
  .box-card div {
    float: left;
    clear: none;
    width:100%;
    text-align: center;
    /* font-family: Arial, Helvetica, sans-serif;  */
  }

  .front-card {
    /* background-color: #E5E5E5;     */
  }

  .front-card header {
    padding: 15px 10px;
    /* background-color: #fff; */
    text-transform: uppercase;
    color: #000 !important;  
  }

  .front-card header .brand {
    font-size: 7pt;
    font-weight: bold;
  }

  .front-card header .sub-brand {
    font-size: 6pt;
  }

  .front-card header .brand,
  .front-card header .sub-brand {
    /* padding-left: 45px; */
  }

  .front-card .logo img {
    margin-top:-10px;
    margin-bottom:2px;
    width:35px;
    height:35px;
  }
</style>
</head>
<body>
<div id="layout">

  <table class="table">
    <tbody class="">
      <?php  
        
          $kolom = 2;
          $jml = 2;
          $i=0;    
          while ($i < $jml) {
            if(($i) % $kolom== 0) {    
              echo'<tr>';   
            }  ?>

            <td class="text-center" width="100%" style="padding-top:6px;">
              <div class="cardStyle">
                <table class="table">
                  <!-- <tbody> -->
                    <tr>
                      <td style="width: 65%; padding-left:10px; padding-right:5px;">
                      <div class="front-card">
                        <header>
                          <div class="logo" style="text-align:center;">
                            <center>
                              <img src="<?= $logo ?>">
                            </center>
                            <div class="sub-brand">Kartu Anggota Perpustakaan</div>
                            <div class="brand"><?= $aplikasi['instansi'] ?></div>
                            <!-- <div class="brand">Institut Teknologi Aditama Surabaya</div> -->
                          </div>
                        </header>
                        <div style="text-align:center; margin-top:9px;">
                          <span style="font-size:11px; font-weight:bold;"><?= strtoupper($detail_anggota['nama_anggota']) ?></span>
                          <div class="text-center" style="background-color: white; color:black; padding:0px;">
                            <img style="width:4.5cm; height:0.8cm; padding-top:16px;" src="<?= $barcode ?>" alt="">
                            <p style="font-size:10px; padding-top:-26px;"><?= $detail_anggota['id_anggota'] ?></p>
                            <p style="font-size:8px; padding-top:-16px;">Berlaku Hingga : Selama Menjadi Anggota</p>
                          </div>
                        </div>
                      </div>
                      </td>
                      <td style="width: 35%; padding-right:10px;" class="text-center">
                        <div class="" style="padding:4px; text-align:center;">
                          <div class="text-center" style="background-color: black; color:white; padding:3px; margin-top:-1px;" valign="top">
                            <span style="font-size:11px;"> <?= strtoupper($detail_anggota['nama_jenis_anggota']) ?> <span>
                          </div>
                          <p style="font-size:11px; padding-top:-15px; font-weight:bold;"><?= $detail_anggota['id_anggota'] ?></p>
                          <!-- &nbsp; -->
                          <img style="width:90px; height:100px;" src="<?= $foto ?>" alt="">
                        </div>
                      </td>
                    </tr>
                  <!-- </tbody> -->
                </table>
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