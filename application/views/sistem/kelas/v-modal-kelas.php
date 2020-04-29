<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add" style="display:none;"><i class="bx bx-layer"></i>
					Tambah Kelas</h5>
				<h5 class="modal-title" id="modal_title_update" style="display:none;"><i
						class="bx bx-layer"></i> Edit Kelas</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" id="form">
				<div class="modal-body">
                    <input type="hidden" name="modeform" id="modeform">
                    <input type="hidden" name="id_kelas" id="id_kelas" value="<?php if(isset($data_kelas)){ echo $data_kelas['id_kelas']; } ?>">
            	    <div class="form-group">
						<label for="title">Nama kelas</label>
						<input 
							class="form-control" 
							id="nama_kelas" 
							name="nama_kelas" 
							type="text" 
							placeholder="Nama Kelas . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_kelas)){
											echo $data_kelas['nama_kelas'];
										} 
									?>"
						required >
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
			title: ket1 + ' kelas',
			text: "Apakah Anda yakin "+ ket2 +" kelas !",
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
						url: '<?= site_url() ?>'+'Kelas/simpan',
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
