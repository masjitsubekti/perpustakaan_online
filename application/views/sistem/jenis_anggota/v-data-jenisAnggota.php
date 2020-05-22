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
<table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="tr-head">
        <th width="3%" style="text-align:center;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No </th>
        <th width="13%" class="sortable" id="column_nama_jenis_anggota" data-sort="" onclick="sort_table('#column_nama_jenis_anggota','nama_jenis_anggota')">Jenis Anggota</th>
        <th width="8%" class="sortable" id="column_max_pinjam" data-sort="" onclick="sort_table('#column_max_pinjam','max_peminjaman')">Max Pinjam</th>
        <th width="10%" class="sortable" id="column_max_perpanjangan" data-sort="" onclick="sort_table('#column_max_perpanjangan','max_perpanjangan')">Max Perpanjangan</th>
        <th width="10%" class="sortable" id="column_lama_pinjam" data-sort="" onclick="sort_table('#column_lama_pinjam','lama_pinjam')">Lama Pinjam</th>
        <th width="10%" class="sortable" id="column_jumlah_denda" data-sort="" onclick="sort_table('#column_jumlah_denda','jumlah_denda')">Denda</th>
        <th width="10%" style="text-align:center;">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $no=($paging['current']-1)*$paging['limit']; 
    foreach ($list->result() as $row) { $no++; ?>
    <tr>
      <td style="text-align:center;" ><?=$no;?>.</td>
      <td style="text-align:left;"><?=$row->nama_jenis_anggota?></td>
      <td style="text-align:center;"><?=$row->max_peminjaman?> x</td>
      <td style="text-align:center;"><?=$row->max_perpanjangan?> x</td>
      <td style="text-align:center;"><?=$row->lama_pinjam?> Hari</td>
      <td style="text-align:center;">Rp <?= ($row->jumlah_denda!="") ? number_format($row->jumlah_denda) : 0 ?></td>
      <td style="text-align:center; padding-top:5px;">
        <a href="javascript:;" data-id="<?=$row->id_jenis_anggota?>" data-name="<?=$row->nama_jenis_anggota?>" class="btn btn-sm btn-warning btn-ubah" data-toggle="tooltip" title="Edit <?=$row->nama_jenis_anggota?>"><i style="color:#fff;" class="fa fa-edit"></i></a>
        <a href="javascript:;" data-id="<?=$row->id_jenis_anggota?>" data-name="<?=$row->nama_jenis_anggota?>" class="btn btn-sm btn-danger btn-hapus" data-toggle="tooltip" title="Hapus <?=$row->nama_jenis_anggota?>"><i class="fa fa-trash"></i></a>	    
      </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<!-- pagination -->
<div class="row">
<input type='hidden' id='current' name='current' value='<?php echo $paging['current'] ?>'>
	<br>
	<hr>
	<div class="col-xs-12 col-md-6">
        Menampilkan data
        <?php $batas_akhir = (($paging['current'])*$paging['limit']);
        if ($batas_akhir > $paging['count_row']) {
            $batas_akhir = $paging['count_row'];
        }
        echo ((($paging['current']-1)*$paging['limit'])+1).' - '.$batas_akhir.' dari total '.$paging['count_row']; ?>
        data
	</div>
	<br>
	<div class="col-xs-12 col-md-6">
		<div style="float:right;">
			<?php echo $paging['list']; ?>
		</div>
	</div>
</div>
<?php }else{ ?>

<table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="tr-head">
      <th width="3%">No </th>
      <th width="13%">Jenis Anggota</th>
      <th width="8%">Max Pinjam</th>
      <th width="10%">Max Perpanjangan</th>
      <th width="10%">Lama Pinjam</th>
      <th width="10%">Denda</th>
      <th width="10%">Aksi</th>
    </tr>
    </thead>
	<tbody>
		<tr>
			<td colspan="7">Data tidak ditemukan !</td>
		</tr>
	</tbody>
</table>
<?php } ?>
<!-- pagination -->
<script>
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
    
  var site_url = '<?= site_url() ?>/';

  $(".btn-ubah").click(function() {
		$('#div_dimscreen').show();
    var id = $(this).attr('data-id');
		$.ajax({
			url: "<?php echo site_url('Jenis_anggota/load_modal/')?>",
			type: 'post',
			dataType: 'html',
            data:{id:id},
			beforeSend: function () {},
			success: function (result) {    
				$('#div-modal').html(result);
				$('#div_dimscreen').fadeOut('slow');
				$('#modal_title_update').show();
				$('#modeform').val('UPDATE');
				$('#modal-color').addClass('modal-warning');
				$('#modal').modal('show');
			}
		});
    });
    
	$('[data-toggle="tooltip"]').tooltip();   
	$('.btn-hapus').click(function (e) {
		var id = $(this).attr('data-id');
    var title = $(this).attr('data-name');
  
		Swal.fire({
			title: 'Nonaktifkan Jenis Anggota',
			text: "Apakah Anda yakin menonaktifkan jenis anggota  : " + title + " !",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#95a5a6',
			confirmButtonText: 'Nonaktifkan',
			cancelButtonText: 'Batal',
			showLoaderOnConfirm: true,
			preConfirm: function () {
				return new Promise(function (resolve) {
					$.ajax({
						method: 'POST',
						dataType: 'json',
						url: site_url + 'Jenis_anggota/nonaktifkan',
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
								pageLoad(1);
							} else {
								Swal.fire({
									icon: 'error',
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
