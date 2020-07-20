<div class="">
  <form action="" id="form-pass">
    <input type="hidden" id="id_user_pass" name="id_user_pass" value="<?= $data_user['id_user'] ?>">
    <div class="form-group">
      <label class="control-label col-md-3">Password Baru</label>
      <div class="col-md-12">
        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password Baru"
        autocomplete="off" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Ulang Password Baru</label>
      <div class="col-md-12">
        <input type="password" id="konfirm_password" name="konfirm_password" class="form-control" placeholder="Masukkan Ulang Password Baru"
        autocomplete="off" onkeyup="validate_password()" required>
        <span id="pass-message" style=""></span>
      </div>
    </div>
    <div class="col-md-12">
    <hr>
    <button class="btn btn-primary" id="submit-reset" type="submit">Simpan</button>
    </div>
  </form> 
</div>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script>
  $('#form-pass').submit(function (event) {
		event.preventDefault();
		Swal.fire({
			title: 'Ubah Password',
			text: "Apakah Anda yakin mengubah password !",
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
						url: '<?= site_url() ?>'+'Profile/update_password',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form-pass')[0]),
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

function validate_password(){
  var pass = $('#password').val();
  var confirm_pass = $('#konfirm_password').val();
  if(pass!=confirm_pass){
    $('#pass-message').show();
    $('#pass-message').text('Password tidak cocok !');
    $('#pass-message').css('color','red');
    $('#submit-reset').prop('disabled',true);
  }else{
    $('#pass-message').hide();
    $('#pass-message').text('');
    $('#pass-message').css('color','white');
    $('#submit-reset').prop('disabled',false);
  }
}
</script>
            