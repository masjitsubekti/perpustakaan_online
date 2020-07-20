<div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add"><i class="bx bx-layer"></i>
					Ubah Foto Profile
        </h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" id="form-foto">
				<div class="modal-body">
          <input type="hidden" id="id_user" name="id_user" value="<?= $id_user ?>">
          <div class="form-group">
            <label for="title">Pilih Foto</label>
            <br>
            <input type="file" class="form-control" name="input_file_foto" id="input_file_foto" accept="image/*" required>
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
  $('#form-foto').submit(function (event) {
		event.preventDefault();
		Swal.fire({
			title: 'Ubah Foto',
			text: "Apakah Anda yakin mengubah foto Profile !",
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
						url: '<?= site_url() ?>'+'Profile/simpan_foto',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form-foto')[0]),
						async: true,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data.success == true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								$('#modal-foto').modal('hide');
                swal.hideLoading();
                setTimeout(function(){
                  location.reload();
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
