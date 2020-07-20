<div class="">
  <form action="" id="form-profil">
    <input type="hidden" id="id_user_profile" name="id_user_profile" value="<?= $data_user['id_user'] ?>">
    <div class="form-group">
      <label class="control-label col-md-3">Nama User</label>
      <div class="col-md-12">
        <input type="text" id="nama_user" name="nama_user" class="form-control" placeholder="Masukkan Nama User . . . "
        autocomplete="off" value="<?= $data_user['name'] ?>" required>
      </div>
    </div>
    <div class="col-md-12">
    <hr>
    <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form> 
</div>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script>
  $('#form-profil').submit(function (event) {
		event.preventDefault();
		Swal.fire({
			title: 'Ubah Profile',
			text: "Apakah Anda yakin mengubah profile !",
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
						url: '<?= site_url() ?>'+'Profile/update_profile',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form-profil')[0]),
						async: true,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data.success == true) {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });

                Toast.fire({
                  type: 'success',
                  title: data.message
                })
								swal.hideLoading()
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
            