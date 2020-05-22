<div class="row">
    <div class="col-12">
        <div class="card shade">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Setting Aplikasi</h4>
                <br>
                <!--  -->
                <form action="" id="form">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="alert alert-info"><b>PENTING!</b><ol class="pl-3 mb-0"><li>Lengkapi data formulir berikut. Kolom yang memiliki tanda bintang "*", maka wajib diisi.</li><li>Sesuaikan identitas pribadi dengan data di KTP-el.</li><li>Isilah sesuai dengan kaidah-kaidah penulisan bahasa Indonesia untuk mempermudah proses verifikasi.</li></ol></div> -->
                        <!-- apl -->
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-6 col-form-label pull-right" for="judul"><h4>Aplikasi</h4></label>   
                            <div class="col-md-9">
                              <div class="col-md-9">
                              <input class="form-control" id="id" type="hidden" name="id" autocomplete="off" value="<?php echo $app['id']; ?>">
                            </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="nama_sistem">Nama Aplikasi<span style="font-size:17px;">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" id="nama_sistem" type="text" name="nama_sistem" autocomplete="off" placeholder="Nama Aplikasi . . . " value="<?php echo $app['nama_sistem']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="akronim_nama_sistem">Akronim Aplikasi</label>
                            <div class="col-md-9">
                              <input class="form-control" id="akronim_nama_sistem" type="text" name="akronim_nama_sistem" autocomplete="off" placeholder="Akronim Aplikasi . . . " value="<?php echo $app['akronim_nama_sistem']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="akronim_nama_sistem">URL Root<span style="font-size:17px;">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" id="url_root" type="text" name="url_root" autocomplete="off" placeholder="URL Root . . . " value="<?php echo $app['url_root']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-6 col-form-label pull-right" for="judul"><h4>Profil Instansi</h4></label>   
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="nama">Nama instansi<span style="font-size:17px;">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" id="nama" type="text" name="nama" autocomplete="off" placeholder="Nama Instansi . . . " value="<?php echo $app['instansi']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="telpon">Tagline</label>
                            <div class="col-md-9">
                              <input class="form-control" id="tagline" type="text" name="tagline" autocomplete="off"  placeholder="Tagline . . . " value="<?php echo $app['tagline']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="telpon">No Telepon</label>
                            <div class="col-md-9">
                              <input class="form-control" id="telp" type="text" name="telp" autocomplete="off"  placeholder="No Telepon . . . " value="<?php echo $app['telp']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="fax">Fax</label>
                            <div class="col-md-9">
                              <input class="form-control" id="fax" type="fax" name="fax" autocomplete="off"  placeholder="Fax . . . " value="<?php echo $app['fax']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="email">Email Instansi<span style="font-size:17px;">*</span></label>
                            <div class="col-md-9">
                              <input class="form-control" id="email" type="email" name="email" autocomplete="off" placeholder="Email . . . " value="<?php echo $app['email_instansi']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="email">Password Email</label>
                            <div class="col-md-9">
                              <input class="form-control" id="pass_email" type="password" name="pass_email" autocomplete="off" placeholder="Password Email . . . " value="<?php echo $app['pass_instansi']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-6 col-form-label pull-right" for="judul"><h4>Alamat</h4></label>
                            <div class="col-md-9">
      
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="jalan">Jalan</label>
                            <div class="col-md-9">
                              <input class="form-control" id="jalan" type="text" name="jalan" autocomplete="off"  placeholder="Jalan . . . " value="<?php echo $app['jalan']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="kelurahan">Kelurahan</label>
                            <div class="col-md-9">
                              <input class="form-control" id="kelurahan" type="text" name="kelurahan" autocomplete="off"  placeholder="Kelurahan . . . " value="<?php echo $app['kelurahan']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="kecamatan">Kecamatan</label>
                            <div class="col-md-9">
                              <input class="form-control" id="kecamatan" type="text" name="kecamatan" autocomplete="off"  placeholder="Kecamatan . . . " value="<?php echo $app['kecamatan']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="kabupaten">Kabupaten / Kota</label>
                            <div class="col-md-9">
                              <input class="form-control" id="kabupaten" type="text" name="kabupaten"autocomplete="off"  placeholder="Kabupaten / Kota . . . " value="<?php echo $app['kabupaten']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="provinsi">Provinsi</label>
                            <div class="col-md-9">
                              <input class="form-control" id="provinsi" type="text" name="provinsi" autocomplete="off"  placeholder="Provinsi . . . " value="<?php echo $app['provinsi']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label pull-right" for="kode_pos">Kode Pos</label>
                            <div class="col-md-9">
                              <input class="form-control" id="kode_pos" type="text" name="kode_pos"autocomplete="off"  placeholder="Kode Pos . . . " value="<?php echo $app['kode_pos']; ?>">
                            </div>
                          </div>  
                        </div>
                        <!-- end apl -->
                        <!-- logo -->
                        <br>
                        <h3 style="font-size:18px;"> <i class=""></i> Logo Aplikasi</h3>
                        <!-- <br> -->
                        <!-- <div class="alert alert-info"><b>Ketentuan:</b><ol class="pl-3 mb-0"><li>Pas foto formal terbaru (bukan foto <i>selfie</i>!). Muka harus terlihat jelas.</li><li>Ukuran foto 3×4, format PNG atau JPEG.</li></ol></div> -->
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 box-upload">
                                <center>
                                    <h5><b>Logo Instansi</b></h5>
                                    <small><span style="color:#e74c3c; font-size:11px;">*) Wajib Diisi</span></small>
                                    <br>
                                    <?php 
                                    if(isset($app)){
                                        if($app['logo']!=""){ ?>
                                            <img id="image-logo-instansi" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/data/aplikasi/'.$app['logo']) ?>" alt="">
                                        <?php }else{ ?>
                                            <img id="image-logo-instansi" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                        <?php }
                                    }else{ ?>
                                        <img id="image-logo-instansi" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                    <?php } ?> 
                                    <br>
                                    <span id="format_logo_instansi"><small><i>Format : .jpg, .jpeg, .png</i></small></span>
                                    <a style="display:none;" href="javascript:;" class="btn-remove-image" id="remove_logo_instansi"><i class="fa fa-times"></i> Batal</a>
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="logo_instansi" id="logo_instansi" accept="image/*">
                                </center>
                            </div>
                            <div class="col-md-6 col-sm-6 box-upload">
                                <center>
                                    <h5><b>Logo Favicon</b></h5>
                                    <small><span style="color:#e74c3c; font-size:11px;">*) Wajib Diisi</span></small>
                                    <br>
                                    <?php 
                                    if(isset($app)){
                                        if($app['favicon']!=""){ ?>
                                            <img id="image-logo-favicon" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/data/aplikasi/'.$app['favicon']) ?>" alt="">
                                        <?php }else{ ?>
                                            <img id="image-logo-favicon" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                        <?php }
                                    }else{ ?>
                                        <img id="image-logo-favicon" style="width: 150px;height: 150px;" src="<?php echo base_url('assets/all/images/thumbnail_picture.png') ?>" alt="">
                                    <?php } ?> 
                                    <br>
                                    <span id="format_logo_favicon"><small><i>Format : .jpg, .jpeg, .png</i></small></span>
                                    <a style="display:none;" href="javascript:;" class="btn-remove-image" id="remove_logo_favicon"><i class="fa fa-times"></i> Batal</a>
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="logo_favicon" id="logo_favicon" accept="image/*">
                                </center>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="pull-right">
                            <!-- <a class="btn btn-secondary" href="<?= site_url('Anggota') ?>" ><i class="fa fa-times"></i>&nbsp;Batal</a> -->
                            <button class="btn btn-primary" id="btn-simpan" type="submit"> <i class="fa fa-check"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
                <br> 
            </div>
        </div>
    </div>
</div>
<div id="div-modal"></div>

<script src="<?php echo base_url('assets/themes/libs/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/select2/js/select2.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('assets/themes/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
<script>
    $(document).ready(function () {
        
    });

    // Logo Instansi
    var base_url = '<?php echo base_url() ?>';
    $("#logo_instansi").change(function(e) {
        if( document.getElementById("logo_instansi").files.length == 0 ){
        }else{
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.getElementById("image-logo-instansi");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
            $('#format_logo_instansi').hide();
            $('#remove_logo_instansi').show();
        }
    });

    $("#remove_logo_instansi").click( function(){
        $('#logo_instansi').val('');
        $('#format_logo_instansi').show();
        $('#remove_logo_instansi').hide();
        $("#image-logo-instansi").attr('src', base_url+"assets/all/images/thumbnail_picture.png");
    });

    // Logo Favicon
    $("#logo_favicon").change(function(e) {
        if( document.getElementById("logo_favicon").files.length == 0 ){
        }else{
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.getElementById("image-logo-favicon");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
            $('#format_logo_favicon').hide();
            $('#remove_logo_favicon').show();
        }
    });

    $("#remove_logo_favicon").click( function(){
        $('#logo_favicon').val('');
        $('#format_logo_favicon').show();
        $('#remove_logo_favicon').hide();
        $("#image-logo-favicon").attr('src', base_url+"assets/all/images/thumbnail_picture.png");
    });

    $('#form').submit(function (event) {
		event.preventDefault();

		Swal.fire({
			title: 'Setting Aplikasi',
			text: "Apakah Anda yakin Mengubah Setting Aplikasi !",
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
						url: '<?= site_url() ?>'+'Setting/simpan',
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
                    location.reload();
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