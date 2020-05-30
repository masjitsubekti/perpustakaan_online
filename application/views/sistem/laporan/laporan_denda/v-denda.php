<style>
  .datepicker{
    z-index:1050 !important;
  }
</style>

<div class="row">
    <div class="col-12">
        <div class="card shade">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Laporan Denda</h4>
                <!-- <br> -->
                <br>
                <div class="form-group row mb-4" id="box-id">
                    <label for="billing-name" class="col-md-2 col-form-label">Kategori Waktu</label>
                    <div class="col-md-10">
                      <select class="form-control" name="modeKategori" id="modeKategori">
                        <option value="">- Pilih Kategori -</option>
                        <option value="PERTANGGAL">Pertanggal</option>
                        <option value="RENTANG_TANGGAL">Rentang Tanggal</option>
                        <option value="PERBULAN">Perbulan</option>
                        <option value="PERTAHUN">Pertahun</option>
                      </select>
                    </div>
                </div>

                <!-- Box kategori -->
                <div class="form-group row mb-4" id="boxPerTanggal" style="display:none;">
                  <label for="" class="col-md-2 col-form-label">Pilih Tanggal</label>
                  <div class="col-md-10">
                    <input type="text" name="input_per_tanggal" id="input_per_tanggal" class="form-control date-picker" placeholder="Pilih Tanggal . . . ." autocomplete="off" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true">
                  </div>
                </div>

                <div class="form-group row" id="boxRentangTanggal" style="display:none;">
                  <label for="kategori" class="col-md-2 col-form-label"> Pilih Rentang Tanggal</label>
                  <div class="col-md-4">
                    <input type="text" name="tgl_awal" id="tgl_awal" class="form-control date-picker" data-date-format='yyyy-mm-dd' placeholder="Pilih Tanggal Awal . . . ." autocomplete="off" data-provide="datepicker" data-date-autoclose="true">
                  </div>
                  <div class="col-md-2">
                    <center>
                      s/d
                    </center>
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control date-picker" data-date-format='yyyy-mm-dd' placeholder="Pilih Tanggal Akhir . . . ." autocomplete="off" data-provide="datepicker" data-date-autoclose="true">
                  </div>
                </div>

                <div class="form-group row" id="boxBulan" style="display:none;">
                  <label for="kategori" class="col-md-2 col-form-label"> Pilih Bulan</label>
                  <div class="col-md-4">
                    <!-- <input type="text" name="bulan" id="bulan" class="form-control date-picker" placeholder="Pilih Bulan . . . ." autocomplete="off" data-date-format="MM yyyy" data-date-min-view-mode="1" data-provide="datepicker" data-date-autoclose="true"> -->
                    <select class="form-control" name="bulan" id="bulan" onchange="">
                    <option value="">- Pilih Bulan -</option>
                    <?php 
                    $bulan = date('m');
                    $array_bulan=array(
                        '01'=>'Januari',
                        '02'=>'Februari',
                        '03'=>'Maret',
                        '04'=>'April',
                        '05'=>'Mei',
                        '06'=>'Juni',
                        '07'=>'Juli',
                        '08'=>'Agustus',
                        '09'=>'September',
                        '10'=>'Oktober',
                        '11'=>'November',
                        '12'=>'Desember'
                    );
                    foreach ($array_bulan as $key => $value) { ?>
                        <option 
                        <?php if($bulan==$key){
                            echo " selected";
                        } ?> 
                        value="<?= $key ?>"><?= $value ?></option>    
                    <?php } ?>
                </select> 
                  </div>
                  <div class="col-md-2">
                    <!-- <center> -->
                      <label class="col-form-label"> Pilih Tahun</label>
                    <!-- </center> -->
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="tahun" id="tahun" class="form-control date-picker" placeholder="Pilih Tahun . . . ." autocomplete="off" data-date-min-view-mode="2" data-date-format="yyyy" data-provide="datepicker" data-date-autoclose="true">
                  </div>
                </div>

                <div class="form-group row mb-4" id="boxTahun" style="display:none;">
                  <label for="" class="col-md-2 col-form-label">Pilih Tahun</label>
                  <div class="col-md-10">
                    <input type="text" name="input_per_tahun" id="input_per_tahun" class="form-control date-picker" placeholder="Pilih Tahun . . . ." autocomplete="off" data-date-min-view-mode="2" data-date-format="yyyy" data-provide="datepicker" data-date-autoclose="true">
                  </div>
                </div>
                <!-- end Box Kategori -->

                <!-- Button -->
                <!-- <br> -->
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                      <a href="javascript:;" onclick="pageLoad(1)" class="btn btn-info btn-box"> <i class="fa fa-search"></i> &nbsp; Preview</a>
                      <a href="javascript:;" onclick="refresh()" class="btn btn-warning btn-box"> <i class="fas fa-sync-alt"></i> &nbsp; Reset</a>
                    </div>
                </div>
                <!-- End Button -->
                <hr>
                <br>
                <div id="box-list" style="display:none;">
                <h4 style="text-align:center;" > LAPORAN DENDA </h4>
                <h4 style="text-align:center;" id="narasi" ></h4>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-2">
                      <select class="form-control" name="limit" id="limit" onchange="pageLoad(1)">
                            <option value="10" selected>10 Baris</option>
                            <option value="25">25 Baris</option>
                            <option value="50">50 Baris</option>
                            <option value="100">100 Baris</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                      <a href="javascript:;" onclick="export_lap()" class="btn btn-success btn-box">  <i class="fas fa-file-excel"></i> &nbsp; Export Excel </a>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" id="cari" name="cari" class="form-control" placeholder="Cari . . .">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <br>
                <div id="list"></div> 
            </div>
        </div>
    </div>
</div>
<!-- DATA SORT -->
<input type="hidden" name="input_id_th" id="input_id_th" value="#column_waktu">
<input type="hidden" name="input_column" id="input_column" value="created_at">
<input type="hidden" name="input_sort" id="input_sort" value="desc">
<div id="div-modal"></div>

<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script src="<?=base_url()?>assets/all/js/format-date.js"></script>
<script>
   $(document).ready(function () {
		// pageLoad(1)
	});

  $('#cari').on('keypress', function (e) {
		if (e.which == 13) {
			pageLoad(1);
		}
	});

	function pageLoad(i) {
    var modeKategori = $('#modeKategori').val();
    if(modeKategori==""){
      Swal.fire({type: 'error',title: 'Oops...',text: 'Harap Pilih Kategori Waktu'});
    }else{
    
      $('#div_dimscreen').show();
      var id_th = $('#input_id_th').val();
      var column = $('#input_column').val();
      var sort = $('#input_sort').val();
      var limit = $('#limit').val();
      var cari = $('#cari').val();
      // Param Laporan
      var pertanggal = $('#input_per_tanggal').val();
      var pertahun = $('#input_per_tahun').val();
      var bulan = $('#bulan').val();
      var tahun = $('#tahun').val();
      var tgl_awal = $('#tgl_awal').val();
      var tgl_akhir = $('#tgl_akhir').val();

      var narasi = "";
      if(pertanggal!=""){
      	narasi = "PERTANGGAL "+tgl_indo(pertanggal);
      }else if(pertahun!=""){
      	narasi = "TAHUN "+pertahun;
      }else if(bulan!="" && tahun!=""){
        narasi = "BULAN "+get_bulan(bulan).toUpperCase()+" "+tahun;
      }else if(tgl_awal!="" && tgl_akhir!=""){
        narasi = "TANGGAL "+tgl_indo(tgl_awal)+ " - " +tgl_indo(tgl_akhir);
      }else{
        narasi = "";
      }

      $.ajax({
        url: "<?php echo site_url('Laporan/read_data_denda/')?>" + i,
        type: 'post',
        dataType: 'html',
        data: {
          limit: limit,
          cari: cari,
          column:column,
          sort:sort,
          input_per_tanggal:pertanggal,
          input_per_tahun:pertahun,
          bulan:bulan,
          tahun:tahun,
          tgl_awal:tgl_awal,
          tgl_akhir:tgl_akhir,
        },
        beforeSend: function () {},
        success: function (result) {
          $('#box-list').show();
          $('#narasi').text(narasi);
          $('#list').html(result);
          $('#div_dimscreen').fadeOut('slow');
          sort_finish(id_th,sort);
        }
      });
    }
  }

  function kosong(){
      $('#input_per_tanggal').val('');
      $('#input_per_tahun').val('');
		  $('#bulan').val('');
      $('#tahun').val('');
		  $('#tgl_awal').val('');
      $('#tgl_akhir').val('');
  }
  
  $('#modeKategori').change(function(){
    var modeKategori = $(this).val();
    if(modeKategori=='PERTANGGAL'){
			$('#boxPerTanggal').show('slow')
			$('#boxRentangTanggal').hide('slow')
      $('#boxBulan').hide('slow')
      $('#boxTahun').hide('slow')
      kosong()
    }else if(modeKategori=='RENTANG_TANGGAL'){
			$('#boxPerTanggal').hide('slow')
			$('#boxRentangTanggal').show('slow')
      $('#boxBulan').hide('slow')
      $('#boxTahun').hide('slow')
      kosong()
		}else if(modeKategori=='PERBULAN'){
      $('#boxPerTanggal').hide('slow')
			$('#boxRentangTanggal').hide('slow')
      $('#boxBulan').show('slow')
      $('#boxTahun').hide('slow')
      kosong()
    }else if(modeKategori=='PERTAHUN'){
      $('#boxPerTanggal').hide('slow')
			$('#boxRentangTanggal').hide('slow')
			$('#boxBulan').hide('slow')
			$('#boxTahun').show('slow')
      kosong()
    }
  });

  function refresh(){
		location.reload();
	}

	function export_lap(){
    var modeKategori = $('#modeKategori').val();
    if(modeKategori==""){
      Swal.fire({type: 'error',title: 'Oops...',text: 'Harap Pilih Kategori Waktu'});
    }else{
      var pertanggal = $('#input_per_tanggal').val();
      var pertahun = $('#input_per_tahun').val();
      var bulan = $('#bulan').val();
      var tahun = $('#tahun').val();
      var tgl_awal = $('#tgl_awal').val();
      var tgl_akhir = $('#tgl_akhir').val();
      var param_pertanggal = "";
      var param_pertahun = "";
      var param_bulan = "";
      var param_tahun = "";
      var param_tgl_awal = "";
      var param_tgl_akhir = "";

      if(pertanggal==""){
      	param_pertanggal = "ALL";
      }else{
      	param_pertanggal = pertanggal;
      }
      if(pertahun==""){
      	param_pertahun = "ALL";
      }else{
      	param_pertahun = pertahun;
      }
      if(bulan==""){
      	param_bulan = "ALL";
      }else{
      	param_bulan = bulan;
      }
      if(tahun==""){
      	param_tahun = "ALL";
      }else{
      	param_tahun = tahun;
      }
      if(tgl_awal==""){
      	param_tgl_awal = "ALL";
      }else{
      	param_tgl_awal = tgl_awal;
      }
      if(tgl_akhir==""){
      	param_tgl_akhir = "ALL";
      }else{
      	param_tgl_akhir = tgl_akhir;
      }

      window.location.href = "<?= site_url('Laporan/export_laporan_denda/') ?>"+param_bulan+"/"+param_tahun+"/"+param_pertahun+"/"+param_pertanggal+"/"+param_tgl_awal+"/"+param_tgl_akhir;
    }
  }
</script>