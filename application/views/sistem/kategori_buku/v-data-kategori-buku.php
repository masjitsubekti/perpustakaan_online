
<style>
    .tr-head {
        background-color: #495057;
        color: white;
        text-align: center;
    }
</style>

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
        <th width="5%" style="text-align:center;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No. </th>
        <th width="50%" class="sortable" id="column_nama_kategori" data-sort="asc" onclick="sort_table('#column_nama_kategori','nama_kategori')">Kategori Buku</th>
        <th width="10%" style="text-align:center;">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $no=($paging['current']-1)*$paging['limit']; 
    foreach ($list->result() as $row) { $no++; ?>
    <tr>
        <td style="text-align:center;" ><?=$no;?>.</td>
        <td><?=$row->nama_kategori?></td>
        <td style="text-align:center; padding-top:5px;">
            <a href="javascript:;" data-id="<?=$row->id_kategori?>" data-name="<?=$row->nama_kategori?>" class="btn btn-sm btn-warning btn-ubah" data-toggle="tooltip" title="Edit <?=$row->nama_kategori?>"><i style="color:#fff;" class="fa fa-edit"></i></a>
			<a href="javascript:;" data-id="<?=$row->id_kategori?>" data-name="<?=$row->nama_kategori?>" class="btn btn-sm btn-danger btn-hapus" data-toggle="tooltip" title="Hapus <?=$row->nama_kategori?>"><i class="fa fa-trash"></i></a>	    
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
        <th width="5%" style="text-align:center;">NO. </th>
        <th width="50%">Kategori Buku</th>
        <th width="10%" style="text-align:center;">Aksi</th>
    </tr>
    </thead>
	<tbody>
		<tr>
			<td colspan="3">Data tidak ditemukan !</td>
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
			url: "<?php echo site_url('Kategori_buku/load_modal/')?>",
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
			title: 'Nonaktifkan Kategori Buku',
			text: "Apakah Anda yakin menonaktifkan kategori buku  : " + title + " !",
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
						url: site_url + 'Kategori_buku/nonaktifkan',
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
