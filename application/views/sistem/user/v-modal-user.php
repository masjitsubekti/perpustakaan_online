<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add" style="display:none;"><i class="bx bx-layer"></i>
					Tambah User</h5>
				<h5 class="modal-title" id="modal_title_update" style="display:none;"><i
						class="bx bx-layer"></i> Edit User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" id="form">
				<div class="modal-body">
                    <input type="hidden" name="modeform" id="modeform">
                    <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($data_user)){ echo $data_user['id_user']; } ?>">
            	    <div class="form-group">
						<label for="title">Nama User</label>
						<input 
							class="form-control" 
							id="nama_user" 
							name="nama_user" 
							type="text" 
							placeholder="Nama user . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_user)){
											echo $data_user['name'];
										} 
									?>"
						required >
					</div>	
                    <div class="form-group">
						<label for="title">Username</label>
						<input 
							class="form-control" 
							id="username" 
							name="username" 
							type="text" 
							placeholder="Username . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_user)){
											echo $data_user['username'];
										} 
									?>"
						required >
					</div>	
                    <div class="form-group">
						<label for="title">Email</label>
						<input 
							class="form-control" 
							id="email" 
							name="email" 
							type="text" 
							placeholder="Email . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_user)){
											echo $data_user['email'];
										} 
									?>"
						required >
					</div>	
                    <div class="form-group">
                        <label for="hak_akses">Pilih Hak Akses</label>
                        <select class="form-control" id="hak_akses" name="hak_akses" required>
                            <option value="">- Pilih Hak Akses -</option>
                            <?php foreach ($list_role as $roles){ ?>
                                <option
                                    <?php 
										if(isset($data_user)){
                                            if($data_user['id_roles'] == $roles->id_roles){
                                                echo 'selected';
                                            }
										}
                                    ?>
                                    value="<?= $roles->id_roles ?>">
                                    <?= $roles->name; ?> 
                                 </option>    
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
						<label for="title">Password</label>
						<input 
							class="form-control" 
							id="password" 
							name="password" 
							type="text" 
							placeholder="Password . . ." 
							autocomplete="off" 
							value=""
						required >
					</div>	
                    <div class="form-group">
						<label for="title">Confirm Password</label>
						<input 
							class="form-control" 
							id="confirm_password" 
							name="confirm_password" 
							type="text" 
							placeholder="Confirm Password . . ." 
							autocomplete="off" 
							value=""
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
			title: ket1 + ' user',
			text: "Apakah Anda yakin "+ ket2 +" user !",
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
						url: '<?= site_url() ?>'+'User/simpan',
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
