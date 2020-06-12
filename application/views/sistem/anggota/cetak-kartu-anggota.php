<!DOCTYPE html>
<html>
<head>    
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
    position: relative; 
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
    padding-top:5px;
  }

  .front-card header {
    padding: 15px 0px;
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

  .footer{
    position: absolute; 
    bottom: 11px; 
    text-align: center;
    width: 195px;
  }

  .member-name{
    position: absolute; 
    bottom: 72px; 
    text-align: center;
    padding-right: 13px;
    width: 195px;
  }

  .image-footer{
    position: absolute; 
    bottom: 8px; 
    text-align: center;
    padding-right: 13px;
  }

  .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
  }

  .btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .btn-success:active:hover,
  .btn-success.active:hover,
  .open>.dropdown-toggle.btn-success:hover,
  .btn-success:active:focus,
  .btn-success.active:focus,
  .open>.dropdown-toggle.btn-success:focus,
  .btn-success:active.focus,
  .btn-success.active.focus,
  .open>.dropdown-toggle.btn-success.focus {
    color: #fff;
    background-color: #398439;
    border-color: #255625;
  }

  .btn-success:hover {
    color: #fff;
    background-color: #449d44;
    border-color: #398439;
  }
</style>
</head>
<body>
<div id="layout">
  <center><button id="btnExportpdf" onclick="this.style.display='none';window.print();this.style.display='block';" class="btn btn-outline btn-success"><i class="fa fa-print"></i> CETAK</button></center>
  <table>
    <tbody class="">
      <?php  
          $kolom = 2;
          $jml = 2;
          $i=0;    
          foreach ($anggota as $member) {
            if(($i) % $kolom== 0) {    
              echo'<tr>';   
            }  ?>

            <td class="text-center" style="padding-top:6px;">
              <div class="cardStyle">
                <table class="table">
                    <tr>
                      <td style="width: 65%; padding-left:10px; padding-right:5px;" valign="top">
                      <div class="front-card">
                        <header>
                          <div class="logo" style="text-align:center;">
                            <center>
                              <img src="<?= base_url('assets/data/aplikasi/'.$aplikasi['logo']) ?>">
                            </center>
                            <div class="sub-brand">Kartu Anggota Perpustakaan</div>
                            <div class="brand"> <?= $aplikasi['instansi'] ?> </div>
                          </div>
                        </header>
                        <div class="member-name">
                          <p style="font-size:11px; font-weight:bold;"><?= strtoupper($member['nama_anggota']) ?></p>
                        </div>
                          <div class="text-center footer" style="background-color: white;color:black; padding-top: 5px;padding-bottom: 5px;">
                            <img style="width:4.5cm;height:0.8cm;" src="<?= base_url('assets/data/barcode_anggota/'.$member['barcode']) ?>" alt="">
                            <div style="font-size:10px;padding-top: -9px;margin-top: -4px;"><?= $member['id_anggota'] ?></div>
                            <div style="font-size:8px;padding-top:-16px;padding-bottom: -1px;margin-top: 5px;color: black;">Berlaku Hingga : Selama Menjadi Anggota</div>
                          </div>
                      </div>
                      </td>
                      <td style="width: 35%; padding-right:4px;" class="text-center" valign="top">
                        <div class="image-card" style="padding:5px; padding-top: 9px; text-align:center;">
                          <div class="text-center" style="background-color: black; color:white; padding:3px;" valign="top">
                            <span style="font-size:11px;"> <?= strtoupper($member['nama_jenis_anggota']) ?> <span>
                          </div>
                          <div style="font-size:11px; font-weight: bold; padding-top: 6px; text-transform: uppercase; color: #000 !important;  "><?= $member['id_anggota'] ?></div>
                          <br>
                          <div class="image-footer">
                            <img style="width:100%; height:110px;" src="<?= base_url('assets/data/foto_anggota/'.$member['foto']) ?>" alt="">
                          </div>
                        </div>
                      </td>
                    </tr>
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