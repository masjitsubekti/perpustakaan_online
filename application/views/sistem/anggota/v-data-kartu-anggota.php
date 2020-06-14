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
        <th width="8%" style="text-align:center;">
          <a href="javascript:;" id="btn-cetak" class="btn btn-success"> <b> <i class="bx bx-copy-alt"></i> </b> Cetak</a>
        </th>
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
      <td style="text-align:center;" valign="middle">
        <!-- <a href="javascript:;" data-id="<?=$row->id_anggota?>" data-name="<?=$row->nama_anggota?>" class="btn btn-sm btn-success btn-cetak-kartu" data-toggle="tooltip" title="Cetak Kartu <?=$row->nama_anggota?>"><i class="fa fa-copy"></i></a>	     -->
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="id_cek" class="custom-control-input" id="customCheck_<?= $no ?>" value="<?=$row->id_anggota?>">
          <label class="custom-control-label" for="customCheck_<?= $no ?>">Cetak </label>
        </div>
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

<div id="modal_cetak" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color : #ecf0f1">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tujuan Bedah</h4>
      </div>
      <form action="" id="form-tujuan-bedah">
      <div class="modal-body">
        <div id="boxIframe"></div>
        <div id="checkId"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary batal" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-info">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

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

  $("#btn-cetak").click(function() {
    var anggota = [];
    $.each($("input[name='id_cek']:checked"), function() {
      anggota.push($(this).val());
    });

    var jum_length = anggota.length;
    if(jum_length==0){
      Swal.fire({type: 'error',title: 'Oops...',text: 'Harap Pilih Anggota !'});
    }else if(jum_length>8){
      Swal.fire({type: 'error',title: 'Oops...',text: 'Batas Antrian Cetak Maksimal 8 Kartu Anggota !'});    
    }else{
      $.ajax({
        url: "<?php echo site_url('Cetak/cek_kartu')?>",
        type: 'post',
        dataType: 'html',
        data:{
          id:JSON.stringify(anggota),
        },
        beforeSend: function () {},
        success: function (result) {    
          $('#div-modal').html(result);
          $('#modal-cetak').modal('show');
        }
      });
    }
  });

</script>
