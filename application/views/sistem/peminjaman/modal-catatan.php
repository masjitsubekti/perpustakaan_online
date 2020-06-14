<div class="modal fade exampleModal" id="modal-catatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="bx bx-layer"></i> Catatan Notifikasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" id="form-catatan">
            <div class="modal-body">
                <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Catatan Bersifat Opsional </div>
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $id_anggota ?>">
                <input type="hidden" name="id_detail_peminjaman" id="id_detail_peminjaman" value="<?= $id_detail_peminjaman ?>">
                
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <tbody>
                            <tr>
                                <th style="width:10%;">
                                  Nama
                                </th>
                                <td style="width:3%;"> : </td>
                                <td style="width:30%;">
                                  <?= $data_pinjam['nama_anggota'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                  Judul
                                </th>
                                <td> : </td>
                                <td>
                                  <?= $data_pinjam['judul'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                  Tanggal Pinjam
                                </th>
                                <td> : </td>
                                <td>
                                  <?= tgl_indo($data_pinjam['tgl_pinjam']) ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                  Tanggal Kembali
                                </th>
                                <td> : </td>
                                <td>
                                  <?= tgl_indo($data_pinjam['tgl_kembali']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                  <label for="alamat">Keterangan / Catatan</label>
                  <textarea name="catatan" id="catatan" class="form-control" placeholder="Keterangan / Catatan . . ." cols="30" rows="6"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
  $('#form-catatan').submit(function (event) {
		event.preventDefault();

		Swal.fire({
			title: 'Kirim Notifikasi',
			text: "Apakah Anda yakin Mengirim Notifikasi Jatuh Tempo!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3498db',
			cancelButtonColor: '#95a5a6',
			confirmButtonText: 'Kirim',
			cancelButtonText: 'Batal',
			showLoaderOnConfirm: true,
			preConfirm: function () {
				return new Promise(function (resolve) {
						$.ajax({
						url: '<?= site_url() ?>'+'Peminjaman/kirim_notif',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form-catatan')[0]),
						async: true,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data.success == true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								$('#modal-catatan').modal('hide');
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