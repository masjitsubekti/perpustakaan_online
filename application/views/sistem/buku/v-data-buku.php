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
<table class="table table-bordered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="tr-head">
        <th width="4%" style="text-align:center;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No </th>
        <th width="30%" style="text-align:left;" class="sortable" id="column_judul" data-sort="" onclick="sort_table('#column_judul','judul')">Judul</th>
        <th width="10%" class="sortable" id="column_judul" data-sort="" onclick="sort_table('#column_nama_kategori','nama_kategori')">Kategori</th>
        <th width="15%" class="sortable" id="column_penerbit" data-sort="" onclick="sort_table('#column_nama_penerbit','nama_penerbit')">Penerbit</th>
        <th width="6%" class="sortable" id="column_stok" data-sort="" onclick="sort_table('#column_stok','stok')">Stok</th>
        <th width="8%" style="text-align:center;">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $no=($paging['current']-1)*$paging['limit']; 
    foreach ($list->result() as $row) { $no++; ?>
    <tr>
      <td style="text-align:center;"><?=$no;?>.</td>
      <td>
        <h5 class="font-size-14 text-truncate"><span href="javascript:;" class="text-dark"><?=$row->judul?></span></h5>
        <p class="text-muted mb-0">Kode Buku : <?= $row->kode_buku ?></p>
        <p class="text-muted mb-0">ISBN : <?= ($row->isbn!="") ? $row->isbn : "-" ?></p>
      </td>
      <td style="text-align:center;"><?=$row->nama_kategori?></td>
      <td>
        <h5 class="font-size-14 text-truncate"><span href="javascript:;" class="text-dark">Penerbit : <?= $row->nama_penerbit ?></span></h5>
        <p class="text-muted mb-0">Tahun Terbit : <?= ($row->tahun_terbit!="") ? $row->tahun_terbit : "-" ?></p>
        <p class="text-muted mb-0">Pengarang : <?= $row->nama_pengarang ?></p>
      </td>
      <td style="text-align:center;"><?=$row->stok?></td>
      <td style="text-align:center; padding-top:5px;">
        <a href="<?= site_url('Buku/form_edit/'.$row->kode_buku) ?>" data-id="<?=$row->kode_buku?>" data-name="<?=$row->judul?>" class="btn btn-sm btn-warning btn-ubah" data-toggle="tooltip" title="Edit <?=$row->judul?>"><i style="color:#fff;" class="fa fa-edit"></i></a>
        <a href="javascript:;" data-id="<?=$row->kode_buku?>" data-name="<?=$row->judul?>" class="btn btn-sm btn-danger btn-hapus" data-toggle="tooltip" title="Hapus <?=$row->judul?>"><i class="fa fa-trash"></i></a>	    
      </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<br>
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
      <th width="4%" style="text-align:center;">No </th>
      <th width="30%" style="text-align:left;">Judul</th>
      <th width="10%">Kategori</th>
      <th width="15%">Penerbit</th>
      <th width="6%">Stok</th>
      <th width="8%" style="text-align:center;">Aksi</th>
    </tr>
    </thead>
	<tbody>
		<tr>
			<td colspan="6">Data tidak ditemukan !</td>
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
			url: "<?php echo site_url('buku/load_modal/')?>",
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
			title: 'Nonaktifkan buku',
			text: "Apakah Anda yakin menonaktifkan buku  : " + title + " !",
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
						url: site_url + 'buku/nonaktifkan',
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
