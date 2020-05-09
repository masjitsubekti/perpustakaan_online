<div class="row">
    <div class="col-xl-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Peminjaman</h4>
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
                    <strong> <i class="fa fa-info-circle"></i> Halo <?= $nama_user ?> ! </strong>Silahkan masukan ID Anggota untuk memulai transaksi peminjaman.
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
                    <div class="form-group row mb-4">
                        <label for="billing-name" class="col-md-2 col-form-label">Kode Buku</label>
                        <div class="col-md-5">
                            <input type="text" id="kode_buku" name="kode_buku" class="form-control" id="billing-name" placeholder="Masukan Kode Buku">
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:" onclick="addRow()" class="btn btn-success"> <i class="bx bx-plus-circle"></i> Add List</a>
                        </div>
                    </div>
                    <form id="form-pinjam" method="POST" action="">
                    <div class="table-responsive">
                    <input type="hidden" id="f_idAnggota" name="f_idAnggota" class="form-control">
                        <table class="table table-centered mb-0 table-nowrap" id="dataTable">
                            <thead>
                            <tr class="tr-head">
                                <th style="text-align:left;" scope="col">Foto</th>
                                <th style="text-align:left;" scope="col">Judul</th>
                                <th style="text-align:center;" scope="col">Tanggal Pinjam</th>
                                <th style="text-align:center;" scope="col">Tanggal Kembali</th>
                                <th style="text-align:center;" scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                        <input type="hidden" name="jumlah_row" id="jumlah-row" value="0">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-right">
                                        <button type="submit" id="btn-save" class="btn btn-success">Simpan Peminjaman</button>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <br>
                        </div>
                    </div>
                    </form>
                </div>
                <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>
<div id="div_modal"></div>
<!--  -->
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script>
    $(document).ready(function () {
		button_save()
	});

  	$('#id_anggota').on('keypress', function (e) {
		if (e.which == 13) {
			pageAnggota();
		}
	});

    $('#kode_buku').on('keypress', function (e) {
		if (e.which == 13) {
			addRow();
		}
	});

	function pageAnggota() {
        $('#div_dimscreen').show();
		var id_anggota = $('#id_anggota').val();
		$.ajax({
			url: "<?php echo site_url('Peminjaman/read_anggota/')?>",
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
                    button_save()
                } else {
                    // setTimeout(function(){
                    // }, 2000);
                    $('#div_dimscreen').fadeOut('slow');
                    Swal.fire({type: 'error',title: 'Oops...',text: data.message});
                }
			}
		});
    }

    function addRow(){
        var id_anggota = $('#id_anggota').val();
        var kode_buku = $("#kode_buku").val(); 
        var jumlah = parseInt($("#jumlah-row").val()); 
        var nextform = jumlah + 1; 
        var maximum = parseInt($("#max_pinjam").val());
        var tanggungan = parseInt($("#jml_tanggungan").val());
        var max_pinjam = maximum - tanggungan;
        if(kode_buku==""){
            Swal.fire({type: 'error',title: 'Oops...',text: 'Kode buku tidak boleh kosong !'});
        }else if(jumlah>=max_pinjam){
            $.ajax({
                url: "<?php echo site_url('Peminjaman/load_modal_max/')?>",
                type: 'post',
                dataType: 'html',
                data : {
                    id_anggota : id_anggota,
                    jumlah : jumlah,
                    tanggungan : tanggungan,
                    max_pinjam : maximum
                },
                beforeSend: function () {},
                success: function (result) {
                    $('#div_modal').html(result);
                    $('#modal-max').modal('show');
                    button_save()
                }
            });
        }else{
            $.ajax({
                url: "<?php echo site_url('Peminjaman/sisipkan_td_peminjaman') ?>",
                type: "post",
                dataType: "json",
                data:{
                    id_anggota : id_anggota,
                    kode_buku : kode_buku,
                    nextform : nextform,
                },
                success: function(data) {
                    if (data.success == true) {
                        Toast.fire({
                            type: 'success',
                            title: data.message
                        });
                        
                        $('#dataTable').append(
                            '<tr>'+
                                '<th scope="row"><img src="<?= base_url() ?>assets/data/foto_buku/' + data.foto + '" alt="product-img" title="product-img" class="avatar-md"></th>'+
                                '<td>'+
                                    '<h5 class="font-size-14 text-truncate"><a href="javascript:;" class="text-dark">' + data.judul + '</a></h5>'+
                                    '<p class="text-muted mb-0">'+ data.kode_buku +'</p>'+
                                    '<input type="hidden" name="td_kodeBuku[]" id="td_kodeBuku" value="'+ data.kode_buku +'">'+
                                '</td>'+
                                '<td style="text-align:center;">' + data.tanggal_pinjam + 
                                    '<input type="hidden" name="td_tglPinjam[]" id="td_tglPinjam" value="'+ data.format_tanggal_pinjam +'">'+
                                '</td>'+
                                '<td style="text-align:center;">' + data.tanggal_kembali + 
                                    '<input type="hidden" name="td_tglKembali[]" id="td_tglKembali" value="'+ data.format_tanggal_kembali +'">'+
                                '</td>'+
                                '<td style="text-align:center;">'+
                                    '<a href="javascript:void(0);" onclick="deleteRow(this)" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-size-18"></i></a>'+
                                '</td>'+
                            '</tr>'
                        );
                        $("#jumlah-row").val(nextform);
                        $("#kode_buku").val('');
                        button_save()
                    } else {
                        Swal.fire({type: 'error',title: 'Oops...',text: data.message});
                    }
                    
                },
                error: function(e) 
                {
                    alert('Error: ' + e);
                }
            });
        }
    }

    function deleteRow(r) {   
        Swal.fire({
        title: 'Hapus Buku',
        text: "Apakah Anda yakin menghapus buku !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',	
        }).then((result) => {
            if (result.value) {
                Toast.fire({
                    type: 'success',
                    title: 'Buku Berhasil dihapus !'
                });
                var jumlah = parseInt($("#jumlah-row").val()); 
                var moverow = jumlah - 1; 
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("dataTable").deleteRow(i);
                $("#jumlah-row").val(moverow);
                button_save()
            }
        })
    }

    $('#form-pinjam').submit(function (event) {
		event.preventDefault();
		Swal.fire({
			title: 'Simpan Peminjaman',
			text: "Apakah Anda yakin menyimpan peminjaman !",
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
						url: '<?= site_url() ?>'+'Peminjaman/simpan_peminjaman',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form-pinjam')[0]),
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
                                $('#btn-save').prop('disabled',true);
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
    
    function button_save(){
        var jumlah_pinjam = parseInt($("#jumlah-row").val()); 
        if(jumlah_pinjam==0){
            $('#btn-save').prop('disabled',true);
        }else{
            $('#btn-save').prop('disabled',false);
        }
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



