function tgl_indo(tgl){
  var date = new Date(tgl);
  var tahun = date.getFullYear();
  var bulan = date.getMonth();
  var tanggal = date.getDate();
  var hari = date.getDay();
  // var jam = date.getHours();
  // var menit = date.getMinutes();
  // var detik = date.getSeconds();
  
  switch(hari) {
    case 0: hari = "Minggu"; break;
    case 1: hari = "Senin"; break;
    case 2: hari = "Selasa"; break;
    case 3: hari = "Rabu"; break;
    case 4: hari = "Kamis"; break;
    case 5: hari = "Jum'at"; break;
    case 6: hari = "Sabtu"; break;
  }

  switch(bulan) {
    case 0: bulan = "Januari"; break;
    case 1: bulan = "Februari"; break;
    case 2: bulan = "Maret"; break;
    case 3: bulan = "April"; break;
    case 4: bulan = "Mei"; break;
    case 5: bulan = "Juni"; break;
    case 6: bulan = "Juli"; break;
    case 7: bulan = "Agustus"; break;
    case 8: bulan = "September"; break;
    case 9: bulan = "Oktober"; break;
    case 10: bulan = "November"; break;
    case 11: bulan = "Desember"; break;
  }

  var tampilTanggal = tanggal + " " + bulan + " " + tahun;
  return tampilTanggal;
}

function get_bulan(bln){
  switch(bln) {
    case '01': bulan = "Januari"; break;
    case '02': bulan = "Februari"; break;
    case '03': bulan = "Maret"; break;
    case '04': bulan = "April"; break;
    case '05': bulan = "Mei"; break;
    case '06': bulan = "Juni"; break;
    case '07': bulan = "Juli"; break;
    case '08': bulan = "Agustus"; break;
    case '09': bulan = "September"; break;
    case '10': bulan = "Oktober"; break;
    case '11': bulan = "November"; break;
    case '12': bulan = "Desember"; break;
  }
  return bulan;
}