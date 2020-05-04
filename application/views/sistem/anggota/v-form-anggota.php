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
                        <div class="alert alert-info"><b>PENTING!</b><ol class="pl-3 mb-0"><li>Lengkapi data formulir berikut. Kolom yang memiliki tanda bintang "*", maka wajib diisi.</li><li>Sesuaikan identitas pribadi dengan data di KTP-el.</li><li>Isilah sesuai dengan kaidah-kaidah penulisan bahasa Indonesia untuk mempermudah proses verifikasi.</li></ol></div>
                        <input type="text" id="modeform" name="modeform" value="<?= $modeform ?>">
                        <input type="text" id="id_anggota_ubah" name="id_anggota_ubah" value="<?php if(isset($data_anggota)){ echo $data_anggota['id_anggota']; } ?>">
                        <?php if($modeform=="ADD"){ ?>
                            <div class="form-group">
                                <label for="title">ID Anggota</label>
                                <input class="form-control" id="id_anggota" name="id_anggota" type="text" placeholder="ID Anggota . . ." autocomplete="off" value="<?= $id_anggota ?>" readonly>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="nama_anggota">Nama Anggota</label>
                            <input class="form-control" id="nama_anggota" name="nama_anggota" type="text" placeholder="Nama Anggota . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['nama_anggota']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="no_identitas">No Identitas</label>
                            <input class="form-control" id="no_identitas" name="no_identitas" type="text" placeholder="No Identitas . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['no_identitas']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Tempat Lahir . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['tempat_lahir']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="text" name="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir . . ." class="form-control" data-date-format="dd-mm-yyyy"  placeholder="Tanggal Lahir" data-provide="datepicker" data-date-autoclose="true" value="<?php if(isset($data_anggota)){ echo $data_anggota['tgl_lahir']; } ?>" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                        <div class="form-group">
                            <label for="kategori">Jenis Kelamin</label>
                            <select class="form-control jenkel" name="jenkel" id="jenkel">
                                <option value=""></option>
                                <?php foreach ($jenkel as $jk) {?>
                                <option 
                                    <?php 
                                        if(isset($data_anggota)){
                                            if($data_anggota['jenis_kelamin']==$jk->id_jenkel){
                                                echo " selected ";
                                            }
                                        } 
                                        ?>	
                                        value="<?=$jk->id_jenkel?>">
                                    <?=$jk->jenis_kelamin?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    
                        <br>
                        <h3 style="font-size:18px;"> <i class=""></i> Alamat & Kontak</h3>
                        <br>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['alamat']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input class="form-control" id="kode_pos" name="kode_pos" type="text" placeholder="Kode Pos . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['kode_pos']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telp / HP</label>
                            <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="No Telp / HP . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['no_telp']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['email']; } ?>"required >
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan / Catatan</label>
                            <input class="form-control" id="keterangan" name="keterangan" type="text" placeholder="Keterangan . . ." autocomplete="off" value="<?php if(isset($data_anggota)){ echo $data_anggota['keterangan']; } ?>"required >
                        </div>

                        <br>
                        <h3 style="font-size:18px;"> <i class=""></i> User Account</h3>
                        <br>
                        
                        <div class="form-group">
                            <label>Tanggal Registrasi</label>
                            <div class="input-group">
                                <input type="text" name="tanggal_registrasi" name="tanggal_registrasi" placeholder="Tanggal Registrasi . . ." class="form-control" data-date-format="dd-mm-yyyy"  placeholder="Tanggal Registrasi" data-provide="datepicker" data-date-autoclose="true" value="<?php if(isset($data_anggota)){ echo $data_anggota['tgl_registrasi']; } ?>" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>

                        <div class="form-group">
                            <label>Berlaku Hingga</label>
                            <div class="input-group">
                                <input type="text" name="berlaku_hingga" name="berlaku_hingga" placeholder="Berlaku Hingga . . ." class="form-control" data-date-format="dd-mm-yyyy"  placeholder="Berlaku Hingga" data-provide="datepicker" data-date-autoclose="true" value="<?php if(isset($data_anggota)){ echo $data_anggota['berlaku_hingga']; } ?>" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password . . ." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input class="form-control" id="konfirmasi_password" name="konfirmasi_password" type="password" placeholder="Konfirmasi Password . . ." autocomplete="off">
                        </div>
                        
                        <!-- foto -->
                        <br>
                        <h3 style="font-size:18px;"> <i class=""></i> Foto Anggota</h3>
                        <br>
                        <div class="alert alert-info"><b>Ketentuan:</b><ol class="pl-3 mb-0"><li>Pas foto formal terbaru (bukan foto <i>selfie</i>!). Muka harus terlihat jelas.</li><li>Ukuran foto 3×4, format PNG atau JPEG.</li></ol></div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 box-upload">
                                <center>
                                    <h5><b>Foto Anggota</b></h5>
                                    <!-- <small><span style="color:#e74c3c">*) Wajib Diisi</span></small> -->
                                    <br>
                                    <br>
                                    <img id="image-foto-anggota" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                    <br>
                                    <span id="format_foto_anggota"><small><i>Format : .jpg, .jpeg, .png</i></small></span>
                                    <a style="display:none;" href="javascript:;" class="btn-remove-image" id="remove_foto_anggota"><i class="fa fa-times"></i> Batal</a>
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="foto_anggota" id="foto_anggota" accept="image/*">
                                </center>
                            </div>
                        </div>
                        <br><br>
                        <hr>
                        <div class="pull-right">
                            <a class="btn btn-dark" href="<?= site_url('Buku') ?>" ><i class="fa fa-times"></i>&nbsp;Batal</a>
                            <button class="btn btn-primary" type="submit" id="lanjut_page5" style="background-color:#3867d6;color:white;"> <i class="fa fa-check"></i>&nbsp;Simpan</button>
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

    $('.jenkel').select2({
        placeholder: "Pilih Jenis Kelamin . . . ",
        allowClear: true,
    });
    
    var base_url = '<?php echo base_url() ?>';
    $("#foto_anggota").change(function(e) {
        if( document.getElementById("foto_anggota").files.length == 0 ){
        }else{
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.getElementById("image-foto-anggota");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
            $('#format_foto_anggota').hide();
            $('#remove_foto_anggota').show();
        }
    });
    $("#remove_foto_anggota").click( function(){
        $('#foto_anggota').val('');
        $('#format_foto_anggota').show();
        $('#remove_foto_anggota').hide();
        $("#image-foto-anggota").attr('src', base_url+"assets/all/images/thumbnail_picture.png");
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
			title: ket1 + ' anggota',
			text: "Apakah Anda yakin "+ ket2 +" anggota !",
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
						url: '<?= site_url() ?>'+'Anggota/simpan',
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
                                    window.location.href = "<?= site_url('Anggota') ?>";
                                }, 2000);
                                
							} else {
								setTimeout(function(){ 
                                    Swal.fire({type: 'error',title: 'Oops...',text: data.message});
                                }, 1000);
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