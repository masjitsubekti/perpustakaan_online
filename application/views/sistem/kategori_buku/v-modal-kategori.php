<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add" style="display:none;"><i class="bx bx-layer"></i>
					Tambah Kategori Buku</h5>
				<h5 class="modal-title" id="modal_title_update" style="display:none;"><i
						class="bx bx-layer"></i> Edit Kategori Buku</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" id="form">
				<div class="modal-body">
          <input type="hidden" name="modeform" id="modeform">
          <input type="hidden" name="id_kategori" id="id_kategori" value="<?php if(isset($data_kategori)){ echo $data_kategori['id_kategori']; } ?>">
          <div class="form-group">
						<label for="title">Kode Klasifikasi<span style="font-size:16px;"></span></label>
						  <select class="form-control kode_klasifikasi" name="kode_klasifikasi" id="kode_klasifikasi">
                  <option value=""></option>
                  <?php foreach ($klasifikasi as $kl) {?>
                  <option 
                      <?php 
                          if(isset($data_kategori)){
                              if($data_kategori['kode_klasifikasi']==$kl->kode_klasifikasi){
                                  echo " selected ";
                              }
                          } 
                          ?>	
                          value="<?=$kl->kode_klasifikasi?>">
                        <?=$kl->kode_klasifikasi?> - <?=$kl->nama_klasifikasi?>
                  </option>
                  <?php } ?>
              </select>
					</div>	
					<div class="form-group">
						<label for="title">Nama Kategori<span style="font-size:16px;">*</span></label>
						<input 
							class="form-control" 
							id="nama_kategori" 
							name="nama_kategori" 
							type="text" 
							placeholder="Nama Kategori . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_kategori)){
											echo $data_kategori['nama_kategori'];
										} 
									?>"
						required >
					</div>	
					<div class="form-group">
						<label for="kategori">Tipe Kategori<span style="font-size:16px;">*</span></label>
						<select class="form-control tipe_kategori" name="tipe_kategori" id="tipe_kategori" required>
							<option value=""></option>
							<?php foreach ($tipe_kategori as $kt) {?>
							<option 
								<?php 
									if(isset($data_kategori)){
										if($data_kategori['id_tipe_kategori']==$kt->id_tipe_kategori){
											echo " selected ";
										}
									} 
									?>	
									value="<?=$kt->id_tipe_kategori?>">
								<?=$kt->nama_tipe_kategori?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-primary" style="background-color:#3867d6;color:white;" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	  $('.tipe_kategori').select2({
        placeholder: "Pilih Tipe Kategori . . . ",
        allowClear: true,
        dropdownParent: $('#modal')
    });

    $('#kode_klasifikasi').select2({
      placeholder: "Pilih Klasifikasi",
      allowClear: true,
      dropdownParent: $('#modal')
    });

    $('#form').submit(function (event) {
		event.preventDefault();
		var modeform = $('#modeform').val();
        var ket1 = '';
        var ket2 = '';
        if(modeform=='ADD'){
            ket1 = 'Simpan';
            ket2 = 'Menyimpan';
        }else{
            ket1 = 'Ubah';
            ket2 = 'Mengubah';
        }

		Swal.fire({
			title: ket1 + ' Kategori Buku',
			text: "Apakah Anda yakin "+ ket2 +" Kategori Buku !",
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
						url: '<?= site_url() ?>'+'Kategori_buku/simpan',
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
								$('#modal').modal('hide');
								swal.hideLoading()
								pageLoad(1);
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
