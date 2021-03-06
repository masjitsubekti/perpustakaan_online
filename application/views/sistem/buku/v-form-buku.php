<div class="row">
    <div class="col-12">
        <div class="card shade">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Form Buku</h4>
                <br>
                <!--  -->
                <form action="" id="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info"><b>PENTING!</b><ol class="pl-3 mb-0"><li>Lengkapi data formulir berikut. Kolom yang memiliki tanda bintang "*", maka wajib diisi.</li><li>Isilah sesuai dengan kaidah-kaidah penulisan bahasa Indonesia untuk mempermudah proses pencarian buku.</li></ol></div>
                        <input type="hidden" id="modeform" name="modeform" value="<?= $modeform ?>">
                        <input type="hidden" id="kode_buku_ubah" name="kode_buku_ubah" value="<?php if(isset($data_buku)){ echo $data_buku['kode_buku']; } ?>">
                        <?php if($modeform=="ADD"){ ?>
                            <div class="form-group">
                                <label for="title">Kode Buku</label>
                                <input class="form-control" id="kode_buku" name="kode_buku" type="text" placeholder="Kode Buku . . ." autocomplete="off" value="<?= $kode_buku ?>" readonly>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="title">Judul Buku<span style="font-size:16px;">*</span></label>
                            <input class="form-control" id="judul" name="judul" type="text" placeholder="Judul Buku . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['judul']; } ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input class="form-control" id="isbn" name="isbn" type="text" placeholder="ISBN . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['isbn']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="pengarang">Pengarang<span style="font-size:16px;">*</span></label>
                            <select class="form-control pengarang" name="pengarang" id="pengarang" required>
                                <option value=""></option>
                                <?php foreach ($pengarang as $kt) {?>
                                <option 
                                    <?php 
                                        if(isset($data_buku)){
                                            if($data_buku['id_pengarang']==$kt->id_pengarang){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>
                                        value="<?=$kt->id_pengarang?>">
                                    <?=$kt->nama_pengarang?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori<span style="font-size:16px;">*</span></label>
                            <select class="form-control kategori" name="kategori" id="kategori" required>
                                <option value=""></option>
                                <?php foreach ($kategori as $kt) {?>
                                <option 
                                    <?php 
                                        if(isset($data_buku)){
                                            if($data_buku['id_kategori']==$kt->id_kategori){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>	
                                        value="<?=$kt->id_kategori?>">
                                    <?=$kt->nama_kategori?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rak">Lokasi / Rak<span style="font-size:16px;">*</span></label>
                            <select class="form-control rak" name="lokasi_rak" id="rak_lokasi" required>
                                <option value=""></option>
                                <?php foreach ($rak as $rk) {?>
                                <option 
                                    <?php 
                                        if(isset($data_buku)){
                                            if($data_buku['id_rak']==$rk->id_rak){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>	
                                        value="<?=$rk->id_rak?>">
                                    <?=$rk->kode_rak?> - <?=$rk->nama_rak?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber<span style="font-size:16px;">*</span></label>
                            <select class="form-control sumber" name="sumber" id="sumber" required>
                                <option value=""></option>
                                <?php foreach ($sumber as $sb) {?>
                                <option 
                                    <?php 
                                        if(isset($data_buku)){
                                            if($data_buku['id_sumber']==$sb->id_sumber){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>	
                                        value="<?=$sb->id_sumber?>">
                                    <?=$sb->nama_sumber?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Penerbit<span style="font-size:16px;">*</span></label>
                            <select class="form-control penerbit" name="penerbit" id="penerbit" required>
                                <option value=""></option>
                                <?php foreach ($penerbit as $pb) {?>
                                <option 
                                    <?php 
                                        if(isset($data_buku)){
                                            if($data_buku['id_penerbit']==$pb->id_penerbit){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>	
                                        value="<?=$pb->id_penerbit?>">
                                    <?=$pb->nama_penerbit?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Jenis Koleksi<span style="font-size:16px;">*</span></label>
                                <select class="form-control jenis_koleksi" name="jenis_koleksi" id="jenis_koleksi" required>
                                    <option value=""></option>
                                    <?php foreach ($jenis_koleksi as $jk) {?>
                                    <option 
                                        <?php 
                                            if(isset($data_buku)){
                                                if($data_buku['id_jenis_koleksi']==$jk->id_jenis_koleksi){
                                                    echo " selected ";
                                                }
                                            } 
                                            ?>	
                                            value="<?=$jk->id_jenis_koleksi?>">
                                        <?=$jk->nama_jenis_koleksi?>
                                    </option>
                                    <?php } ?>
                                </select>
                              </div>
                          </div>
                          <div class="col-md-6">        
                              <div class="form-group">
                                  <label class="control-label">Bahasa<span style="font-size:16px;">*</span></label>
                                  <select class="form-control bahasa" name="bahasa" id="bahasa" required>
                                      <option value=""></option>
                                      <?php foreach ($bahasa as $bhs) {?>
                                      <option 
                                          <?php 
                                              if(isset($data_buku)){
                                                  if($data_buku['id_bahasa']==$bhs->id_bahasa){
                                                      echo " selected ";
                                                  }
                                              } 
                                              ?>	
                                              value="<?=$bhs->id_bahasa?>">
                                          <?=$bhs->nama_bahasa?>
                                      </option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_terbit">Tempat Terbit</label>
                                    <input class="form-control" id="tempat_terbit" name="tempat_terbit" type="text" placeholder="Tempat Terbit . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['tempat_terbit']; } ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <div class="input-group">
                                        <input type="text" name="tahun_terbit" name="tahun_terbit" placeholder="Tahun Terbit . . ." class="form-control" data-date-min-view-mode="2" data-date-format="yyyy" data-provide="datepicker" value="<?php if(isset($data_buku)){ echo $data_buku['tahun_terbit']; } ?>" data-date-autoclose="true" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                        </div>

                        <br>
                        <h3 style="font-size:18px;"> <i class=""></i> Deskripsi</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="halaman">Halaman</label>
                                    <input class="form-control" id="halaman" name="halaman" type="text" placeholder="Halaman . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['halaman']; } ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tinggi">Tinggi (Example : 21x14)</label>
                                    <input class="form-control" id="tinggi" name="tinggi" type="text" placeholder="Tinggi . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['tinggi']; } ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="stok">DDC</label>
                            <input class="form-control" id="ddc" name="ddc" type="text" placeholder="DDC . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['ddc']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="stok">No Inventaris</label>
                            <input class="form-control" id="no_inventaris" name="no_inventaris" type="text" placeholder="No inventaris . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['no_inventaris']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="stok">Edisi</label>
                            <input class="form-control" id="edisi" name="edisi" type="text" placeholder="Edisi . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['edisi']; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok / Jumlah<span style="font-size:16px;">*</span></label>
                            <input class="form-control" id="stok" name="stok" type="text" placeholder="Stok / Jumlah . . ." autocomplete="off" value="<?php if(isset($data_buku)){ echo $data_buku['stok']; } ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan . . ." cols="30" rows="3"><?php if(isset($data_buku)){ echo $data_buku['keterangan']; } ?></textarea>
                        </div>
                        <br>
                        <div class="form-group row">
                            &nbsp;&nbsp;&nbsp;&nbsp;<label for="" style="font-size:14px;"> <b> Bagikan Buku ? </b></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="custom-control custom-radio mb-3">
                              <input type="radio" id="customRadio1" 
                                <?php if(isset($data_buku)){ 
                                  if($data_buku['flag_bagikan']=="1"){
                                    echo " checked";
                                  } 
                                } ?>
                               value="1" name="bagikan" class="custom-control-input" style="cursor:pointer;">
                              <label class="custom-control-label" for="customRadio1" style="cursor:pointer;">Public</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="custom-control custom-radio mb-3">
                              <input type="radio" id="customRadio2" 
                              <?php if(isset($data_buku)){ 
                                  if($data_buku['flag_bagikan']=="2"){
                                    echo " checked";
                                  } 
                              } ?>
                              value="2" name="bagikan" class="custom-control-input" style="cursor:pointer;">
                              <label class="custom-control-label" for="customRadio2" style="cursor:pointer;">Private</label>
                            </div>
                        </div>

                        <!-- foto -->
                        <!-- <br> -->
                        <h3 style="font-size:18px;"> <i class=""></i> Foto Sampul Buku</h3>
                        <br>
                        <!-- <div class="alert alert-info"><b>Ketentuan:</b><ol class="pl-3 mb-0"><li>Pas foto formal terbaru (bukan foto <i>selfie</i>!). Muka harus terlihat jelas.</li><li>Ukuran foto 3×4, format PNG atau JPEG.</li></ol></div> -->
                        <!-- <br> -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 box-upload">
                                <center>
                                    <h5><b>Foto Sampul</b></h5>
                                    <!-- <small><span style="color:#e74c3c">*) Wajib Diisi</span></small> -->
                                    <br>
                                    <br>
                                    <?php 
                                    if(isset($data_buku)){
                                        if($data_buku['foto']!=""){ ?>
                                            <img id="image-foto-sampul" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/data/foto_buku/'.$data_buku['foto']) ?>" alt="">
                                        <?php }else{ ?>
                                            <img id="image-foto-sampul" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                        <?php }
                                    }else{ ?>
                                        <img id="image-foto-sampul" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                    <?php } ?>
                                    <br>
                                    <span id="format_foto_sampul"><small><i>Format : .jpg, .jpeg, .png</i></small></span>
                                    <a style="display:none;" href="javascript:;" class="btn-remove-image" id="remove_foto_sampul"><i class="fa fa-times"></i> Batal</a>
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="foto_sampul" id="foto_sampul" accept="image/*">
                                </center>
                            </div>
                        </div>
                        <br><br>
                        <hr>
                        <div class="pull-right">
                            <a class="btn btn-secondary" href="<?= site_url('Buku') ?>" ><i class="fa fa-times"></i>&nbsp;Batal</a>
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-check"></i>&nbsp;Simpan</button>
                        </div>
      
                    </div>
                </div>
                </form>
                <br> 
            </div>
        </div>
    </div>
</div>
<!-- DATA SORT -->
<input type="hidden" name="input_id_th" id="input_id_th" value="#column_waktu">
<input type="hidden" name="input_column" id="input_column" value="created_at">
<input type="hidden" name="input_sort" id="input_sort" value="desc">
<div id="div-modal"></div>

<script src="<?php echo base_url('assets/themes/libs/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/select2/js/select2.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
<script>
    $(document).ready(function () {
        
    });

    $('.pengarang').select2({
        placeholder: "Pilih Pengarang . . . ",
        allowClear: true,
    });

    $('.kategori').select2({
        placeholder: "Pilih Kategori . . . ",
        allowClear: true,
    });

    $('.penerbit').select2({
        placeholder: "Pilih Penerbit . . . ",
        allowClear: true,
    });

    $('.rak').select2({
        placeholder: "Pilih Rak . . . ",
        allowClear: true,
    });

    $('.sumber').select2({
        placeholder: "Pilih Sumber . . . ",
        allowClear: true,
    });

    $('.jenis_koleksi').select2({
        placeholder: "Pilih Jenis Koleksi . . . ",
        allowClear: true,
    });

    $('.bahasa').select2({
        placeholder: "Pilih Bahasa . . . ",
        allowClear: true,
    });
    
    var base_url = '<?php echo base_url() ?>';
    $("#foto_sampul").change(function(e) {
        if( document.getElementById("foto_sampul").files.length == 0 ){
        }else{
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.getElementById("image-foto-sampul");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
            $('#format_foto_sampul').hide();
            $('#remove_foto_sampul').show();
        }
    });
    $("#remove_foto_sampul").click( function(){
        $('#foto_sampul').val('');
        $('#format_foto_sampul').show();
        $('#remove_foto_sampul').hide();
        $("#image-foto-sampul").attr('src', base_url+"assets/all/images/thumbnail_picture.png");
    });

    $('#form').submit(function (event) {
		event.preventDefault();
		var modeform = $('#modeform').val();
        var ket1 = '';
        var ket2 = '';
        if(modeform=='ADD'){
            ket1 = 'Simpan';
            ket2 = 'menyimpan';
        }else{
            ket1 = 'Ubah';
            ket2 = 'mengubah';
        }

		Swal.fire({
			title: ket1 + ' Buku',
			text: "Apakah Anda yakin "+ ket2 +" buku !",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3498db',
			cancelButtonColor: '#95a5a6',
			confirmButtonText: 'Simpan',
			cancelButtonText: 'Batal',
			showLoaderOnConfirm: true,
			preConfirm: function () {
				return new Promise(function (resolve) {
						$.ajax({
						url: '<?= site_url() ?>'+'Buku/simpan',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form')[0]),
						async: true,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data.success == true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								swal.hideLoading()
                setTimeout(function(){ 
                    window.location.href = "<?= site_url('Buku') ?>";
                }, 2000);
                                
							} else {
								Swal.fire({type: 'error',title: 'Oops...',text: data.message});
							}
						},
						fail: function (event) {
							alert(event);
						}
					});
				});
			},
			allowOutsideClick: false
		});
		event.preventDefault();
    });
</script>