<div class="table-responsive">
<?php
    $x = ($paging['limit']*$paging['current'])-$paging['limit'];
        
    if($x<=0)
    {
        $no=0;
    }
    else
    {
        $no = $x;
    }
    $no++;
    
    if($list->num_rows()!=0){
?>
    <table class="table table-centered mb-0" id="dataTable">
        <thead class="">
        <tr class="tr-head">
            <th width="5%" style="text-align:left;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No </th>
            <th width="" style="text-align:left;" scope="col" class="sortable" id="column_judul" data-sort="" onclick="sort_table('#column_judul','judul')">Judul</th>
            <th width="" style="text-align:center;" scope="col" class="sortable" id="column_tgl_pinjam" data-sort="" onclick="sort_table('#column_tgl_pinjam','tgl_pinjam')">Tanggal Pinjam</th>
            <th width="" style="text-align:center;" scope="col" class="sortable" id="column_tgl_kembali" data-sort="" onclick="sort_table('#column_tgl_kembali','tgl_kembali')">Tanggal Kembali</th>
            <th style="text-align:center;" scope="col">Terlambat</th>
            <th style="text-align:center;" scope="col">Denda</th>
            <th style="text-align:center;" scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no=0; 
        foreach ($list->result() as $row) { $no++; ?>
        <tr>
            <td style="text-align:left;" ><?=$no;?>.</td>
            <td>
                <h5 class="font-size-14 text-truncate"><a href="javascript:;" class="text-dark"><?= $row->judul ?></a></h5>
                <p class="text-muted mb-0"><?= $row->kode_buku ?></p>
                <?php if($row->flag_perpanjangan=='1'){ ?>
                    <p class="mb-0" style="color:#34c38f; font-weight:500;">Diperpanjang</p>
                <?php } ?>
            </td>
            <td style="text-align:center;"><?= ($row->tgl_pinjam!="") ? tgl_indo($row->tgl_pinjam) : "-" ?></td>
            <td style="text-align:center;"><?= ($row->tgl_kembali!="") ? tgl_indo($row->tgl_kembali) : "-" ?></td>
            <td style="text-align:center;"><?= $row->terlambat ?> Hari</td>
            <td style="text-align:center;">Rp. <?= number_format($row->denda) ?></td>
            <td style="text-align:center; padding-top:5px;">
                <a href="javascript:;" data-id="<?=$row->id_detail_peminjaman?>" data-name="<?=$row->judul?>" class="btn btn-sm btn-info btn-kembali" data-toggle="tooltip" title="Kembalikan <?=$row->judul?>">Kembali</a>
                <a href="javascript:;" data-id="<?=$row->id_detail_peminjaman?>" data-name="<?=$row->judul?>" class="btn btn-sm btn-success btn-perpanjang" data-toggle="tooltip" title="Perpanjang <?=$row->judul?>">Perpanjang</a>	    
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="6">
                <h6 class="m-0 text-right">Total:</h6>
            </td>
            <td>
                <?= $no ?> Items
            </td>
        </tr>
        </tbody>
    </table>

    <div class="row" style="">
    <input type='hidden' id='current' name='current' value='<?php echo $paging['current'] ?>'>
        
    </div>
<?php }else{ ?>
    <table class="table table-centered mb-0 table-nowrap" id="dataTable">
        <thead class="">
        <tr class="tr-head">
            <th width="5%" style="text-align:left;">No </th>
            <th style="text-align:left;" scope="col">Judul</th>
            <th style="text-align:center;" scope="col">Tanggal Pinjam</th>
            <th style="text-align:center;" scope="col">Tanggal Kembali</th>
            <th style="text-align:center;" scope="col">Terlambat</th>
            <th style="text-align:center;" scope="col">Denda</th>
            <th style="text-align:center;" scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">Tidak Ada Peminjaman ! </td>
            </tr>
        </tbody>
    </table>
<?php } ?>
</div>

<script>
    $('[data-toggle="tooltip"]').tooltip();

     function sort_table(id,column){
        var sort = $(id).attr("data-sort");
 
        $('#input_id_th').val(id);
        $('#input_column').val(column);
        
		if(sort=="asc"){
            sort = 'desc';
		}else if(sort=="desc"){
            sort = 'asc';
		}else{
            sort = 'asc';
		}
        $('#input_sort').val(sort);
        pageLoad(1);
    }


    $('.btn-kembali').click(function (e) {
		var id = $(this).attr('data-id');
        var title = $(this).attr('data-name');
  
		Swal.fire({
			title: 'Kembalikan Buku',
			text: "Apakah Anda yakin mengembalikan buku  : " + title + " !",
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
						method: 'POST',
						dataType: 'json',
						url: '<?= site_url() ?>' + 'Pengembalian/kembali',
						data: {
							id: id
						},
						success: function (data) {
							if (data.success === true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								swal.hideLoading()
								// pageLoad(1);
                                pageAnggota();
							} else {
								Swal.fire({
									type: 'error',
									title: 'Oops...',
									text: data.message
								});
							}
						},
						fail: function (e) {
							alert(e);
						}
					});
				});
			},
			allowOutsideClick: false
		});
		e.preventDefault();
	});

    $('.btn-perpanjang').click(function (e) {
		var id = $(this).attr('data-id');
        var title = $(this).attr('data-name');
  
		Swal.fire({
			title: 'Perpanjang Buku',
			text: "Apakah Anda yakin memperpanjang buku  : " + title + " !",
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
						method: 'POST',
						dataType: 'json',
						url: '<?= site_url() ?>' + 'Pengembalian/perpanjang',
						data: {
							id: id
						},
						success: function (data) {
							if (data.success === true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								swal.hideLoading()
								// pageLoad(1);
                                pageAnggota();
							} else {
								Swal.fire({
									type: 'error',
									title: 'Oops...',
									text: data.message
								});
							}
						},
						fail: function (e) {
							alert(e);
						}
					});
				});
			},
			allowOutsideClick: false
		});
		e.preventDefault();
	});
</script>