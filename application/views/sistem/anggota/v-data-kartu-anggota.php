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
        <th width="3%" style="text-align:left;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No </th>
        <th width="20%" class="sortable" id="column_nama_anggota" data-sort="" onclick="sort_table('#column_nama_anggota','nama_anggota')">Nama Anggota</th>
        <th width="6%" class="sortable" id="column_jenis_kelamin" data-sort="" onclick="sort_table('#column_jenis_kelamin','jenis_kelamin')">Jenkel</th>
        <th width="10%" class="sortable" id="column_jenis_anggota" data-sort="" onclick="sort_table('#column_jenis_anggota','nama_jenis_anggota')">Jenis Anggota</th>
        <th width="15%" class="sortable" id="column_alamat" data-sort="" onclick="sort_table('#column_alamat','alamat')">Alamat / Telp</th>
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
      <h5 class="font-size-14 text-truncate"><span href="javascript:;" class="text-dark"><?=$row->nama_anggota?></span></h5>
        <p class="text-muted mb-0">ID Anggota : <?= $row->id_anggota ?></p>
        <p class="text-muted mb-0">No Identitas : <?= $row->no_identitas ?></p>
      </td>
      <td style="text-align:center;"><?= $row->jenis_kelamin ?></td>
      <td style="text-align:center;"><?= $row->nama_jenis_anggota ?></td>
      <td>
        <h5 class="font-size-14 text-truncate"><span href="javascript:;" class="text-dark"><?=$row->alamat?></span></h5>
        <p class="text-muted mb-0">No Telp : <?= $row->no_telp ?></p>
      </td>
      <td style="text-align:center; padding-top:5px;">
        <a href="javascript:;" data-id="<?=$row->id_anggota?>" data-name="<?=$row->nama_anggota?>" class="btn btn-sm btn-success btn-cetak-kartu" data-toggle="tooltip" title="Cetak Kartu <?=$row->nama_anggota?>"><i class="fa fa-copy"></i></a>	    
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
      <th width="3%" style="text-align:left;">No </th>
      <th width="20%">Nama Anggota</th>
      <th width="6%">Jenkel</th>
      <th width="10%">Jenis Anggota</th>
      <th width="15%">Alamat / Telp</th>
      <th width="8%">Aksi</th>
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
    
	$('[data-toggle="tooltip"]').tooltip();   
	$('.btn-hapus').click(function (e) {
		var id = $(this).attr('data-id');
    var title = $(this).attr('data-name');
  
		Swal.fire({
			title: 'Nonaktifkan Anggota',
			text: "Apakah Anda yakin menonaktifkan anggota  : " + title + " !",
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
						url: site_url + 'Anggota/nonaktifkan',
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
