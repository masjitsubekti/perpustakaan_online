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
    height: 3cm;
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
          $kolom = 3;
          $jml = 18;
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
                  <span style="font-size:13px;">220</span><br>
                  <span style="font-size:13px;">AHM</span><br>
                  <span style="font-size:13px;">Y</span>
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