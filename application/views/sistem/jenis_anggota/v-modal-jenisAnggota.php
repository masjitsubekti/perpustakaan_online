<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add" style="display:none;"><i class="bx bx-layer"></i>
					Tambah Jenis Anggota</h5>
				<h5 class="modal-title" id="modal_title_update" style="display:none;"><i
						class="bx bx-layer"></i> Edit Jenis Anggota</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" id="form">
				<div class="modal-body">
          <input type="hidden" name="modeform" id="modeform">
          <input type="hidden" name="id_jenis_anggota" id="id_jenis_anggota" value="<?php if(isset($data_jenis)){ echo $data_jenis['id_jenis_anggota']; } ?>">
          <div class="form-group">
						<label for="title">Nama Jenis Anggota</label>
						<input 
							class="form-control" 
							id="nama_jenis_anggota" 
							name="nama_jenis_anggota" 
							type="text" 
							placeholder="Nama Jenis Anggota . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['nama_jenis_anggota'];
										} 
									?>"
						required >
					</div>
          <div class="form-group">
						<label for="title">Max Peminjaman</label>
						<input 
							class="form-control" 
							id="max_peminjaman" 
							name="max_peminjaman" 
							type="text" 
							placeholder="Max Peminjaman . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['max_peminjaman'];
										} 
									?>"
						required >
					</div>	
          <div class="form-group">
						<label for="title">Max Perpanjangan</label>
						<input 
							class="form-control" 
							id="max_perpanjangan" 
							name="max_perpanjangan" 
							type="text" 
							placeholder="Max Perpanjangan . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['max_perpanjangan'];
										} 
									?>"
						required >
					</div>	
          <div class="form-group">
						<label for="title">Lama Pinjam</label>
						<input 
							class="form-control" 
							id="lama_pinjam" 
							name="lama_pinjam" 
							type="text" 
							placeholder="Lama Pinjam . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['lama_pinjam'];
										} 
									?>"
						required >
					</div>	
          <div class="form-group">
						<label for="title">Jumlah Denda (Perhari)</label>
						<input 
							class="form-control" 
							id="jumlah_denda" 
							name="jumlah_denda" 
							type="text" 
							placeholder="Jumlah denda . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['jumlah_denda'];
										} 
									?>"
						required >
					</div>	
          <div class="form-group">
						<label for="title">Notifikasi Terlambat</label>
						<input 
							class="form-control" 
							id="notifikasi_terlambat" 
							name="notifikasi_terlambat" 
							type="text" 
							placeholder="Notifikasi Terlambat . . ." 
							autocomplete="off" 
							value="<?php 
										if(isset($data_jenis)){
											echo $data_jenis['notifikasi_terlambat'];
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
			title: ket1 + ' Jenis Anggota',
			text: "Apakah Anda yakin "+ ket2 +" Jenis Anggota !",
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
						url: '<?= site_url() ?>'+'Jenis_anggota/simpan',
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

  function setInputFilter(textbox, inputFilter) {
		["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			textbox.addEventListener(event, function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
			});
		});
	}

	// Install input filters.
	setInputFilter(document.getElementById("max_perpanjangan"), function(value) {
	return /^-?\d*$/.test(value); 
  });

	setInputFilter(document.getElementById("max_peminjaman"), function(value) {
	return /^-?\d*$/.test(value); 
  });

	setInputFilter(document.getElementById("lama_pinjam"), function(value) {
	return /^-?\d*$/.test(value); 
  });

	setInputFilter(document.getElementById("jumlah_denda"), function(value) {
	return /^-?\d*$/.test(value); 
  });

  setInputFilter(document.getElementById("notifikasi_terlambat"), function(value) {
	return /^-?\d*$/.test(value); 
  });

</script>
