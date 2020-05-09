<div class="row">
    <div class="col-xl-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Pengembalian</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="text-sm-right">
                            <a href="javascript:;" style="display:none;" onclick="button_batal()" id="btn-batal" class="btn btn-danger"> <i class="fa fa-times"></i> Batalkan Transaksi</a>
                        </div>
                    </div>
                </div>
                <hr>
                <?php $nama_user = $this->session->userdata('auth_nama_user'); ?>
                <div id="alert-awal" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> <i class="fa fa-info-circle"></i> Halo <?= $nama_user ?> ! </strong>Silahkan masukan ID Anggota untuk memulai transaksi pengembalian.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="alert-ketemu" style="display:none;" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa fa-info-circle"></i> ID Anggota ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group row mb-4" id="box-id">
                    <label for="billing-name" class="col-md-2 col-form-label">ID Anggota</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota" placeholder="Enter ID Anggota">
                    </div>
                </div>
                <div id="data_anggota" style="display:none;">
                    <!-- Data Peminjaman -->
                    <div class="table-responsive">
                    <table class="table borderless table-hover">
                        <tr>
                            <th style="text-align:left; width:15%;">ID Anggota</th>
                            <td style="text-align:left; width:5%;"> : </td>
                            <td style="text-align:left; width:30%;" id="td_idAnggota"></td>
                            <th style="text-align:left; width:15%;">Nama Anggota</th>
                            <td style="text-align:left; width:5%;"> : </td>
                            <td style="text-align:left; width:30%;" id="td_namaAnggota"></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Jenis Anggota</th>
                            <td> : </td>
                            <td style="text-align:left;" id="td_jenisAnggota"></td>
                            <th style="text-align:left;">Lama Pinjam</th>
                            <td> : </td>
                            <td style="text-align:left;" id="td_lamaPinjam"></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Maksimal Pinjam</th>
                            <td> : </td>
                            <td style="text-align:left;" id="td_maksimum"></td>
                            <th style="text-align:left;">Tanggungan</th>
                            <td> : </td>
                            <td style="text-align:left;" id="td_tanggungan"></td>
                        </tr>
                    </table>
                    <input type="hidden" id="max_pinjam" name="max_pinjam">
                    <input type="hidden" id="jml_tanggungan" name="jml_tanggungan">
                    <hr>
                    </div>
                    <h4 class="card-title" style="font-size:15px;"> <i class="bx bx-layer"></i> Daftar Peminjaman</h4>
                    <br>
                    <!-- <form id="form-pinjam" method="POST" action=""> -->
                    <div id="list"></div>
                    <hr>
                    <!-- </form> -->
                </div>
                <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="input_id_th" id="input_id_th" value="#column_waktu">
<input type="hidden" name="input_column" id="input_column" value="created_at">
<input type="hidden" name="input_sort" id="input_sort" value="desc">
<div id="div_modal"></div>
<!--  -->
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script>
    $(document).ready(function () {

	});

  	$('#id_anggota').on('keypress', function (e) {
		if (e.which == 13) {
			pageAnggota();
		}
	});

	function pageAnggota() {
        $('#div_dimscreen').show();
		var id_anggota = $('#id_anggota').val();
		$.ajax({
			url: "<?php echo site_url('Pengembalian/read_anggota/')?>",
			type: 'post',
			dataType: 'json',
			data: {
				id_anggota: id_anggota,
			},
			beforeSend: function () {},
			success: function (data) {
                if (data.success == true) {
                    $('#data_anggota').show();
                    $('#td_idAnggota').text(data.id_anggota);
                    $('#td_namaAnggota').text(data.nama_anggota);
                    $('#td_jenisAnggota').text(data.jenis_anggota);
                    $('#td_lamaPinjam').text(data.lama_pinjam+' Hari');
                    $('#td_maksimum').text(data.max_pinjam+ ' Buku');
                    $('#td_tanggungan').text(data.tanggungan);
                    $('#max_pinjam').val(data.max_pinjam);
                    $('#jml_tanggungan').val(data.tanggungan);
                    $('#f_idAnggota').val(data.id_anggota);
                    $('#alert-awal').hide();    
                    $('#box-id').hide();    
                    $('#btn-batal').show();    
                    $('#alert-ketemu').show();    
                    $('#div_dimscreen').fadeOut('slow');

                    pageLoad(1);
                } else {
                    // setTimeout(function(){
                    // }, 2000);
                    $('#div_dimscreen').fadeOut('slow');
                    Swal.fire({type: 'error',title: 'Oops...',text: data.message});
                }
			}
		});
    }

    function pageLoad(i) {
        $('#div_dimscreen').show();

        var id_th = $('#input_id_th').val();
        var column = $('#input_column').val();
        var sort = $('#input_sort').val();

        var id_anggota = $('#id_anggota').val();
		var limit = 50;
		var cari = '';
		$.ajax({
			url: "<?php echo site_url('Pengembalian/read_data/')?>" + i,
			type: 'post',
			dataType: 'html',
			data: {
                id_anggota : id_anggota,
				limit: limit,
				cari: cari,
				column:column,
				sort:sort,
			},
			beforeSend: function () {},
			success: function (result) {
				$('#list').html(result);
				$('#div_dimscreen').fadeOut('slow');
				sort_finish(id_th,sort);
			}
		});
    }

    function button_batal(){
        Swal.fire({
        title: 'Batalkan Transaksi',
        text: "Apakah Anda yakin membatalkan transaksi !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }
</script>
