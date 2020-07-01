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
<div class="table-responsive">
  <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="tr-head">
        <th style="min-width: 60px;" style="text-align:left;" class="sortable" id="column_waktu" data-sort="desc" onclick="sort_table('#column_waktu','created_at')">No </th>
        <th style="min-width: 150px;" class="sortable" id="column_id_anggota" data-sort="" onclick="sort_table('#column_id_anggota','id_anggota')">ID Anggota</th>
        <th style="min-width: 300px;" class="sortable" id="column_nama_anggota" data-sort="" onclick="sort_table('#column_nama_anggota','nama_anggota')">Nama Anggota</th>
        <th style="min-width: 200px;" class="sortable" id="column_no_identitas" data-sort="" onclick="sort_table('#column_no_identitas','no_identitas')">No Identitas</th>
        <th style="min-width: 150px;" class="sortable" id="column_nama_jenis_anggota" data-sort="" onclick="sort_table('#column_nama_jenis_anggota','nama_jenis_anggota')">Jenis Anggota</th>
        <th style="min-width: 150px;" class="sortable" id="column_kode_buku" data-sort="" onclick="sort_table('#column_kode_buku','kode_buku')">Kode Buku</th>
        <th style="min-width: 350px;" class="sortable" id="column_judul" data-sort="" onclick="sort_table('#column_judul','judul')">Judul</th>
        <th style="min-width: 150px;" class="sortable" id="column_lama_pinjam" data-sort="" onclick="sort_table('#column_lama_pinjam','lama_pinjam')">Durasi Pinjam</th>
        <th style="min-width: 160px;" class="sortable" id="column_tgl_pinjam" data-sort="" onclick="sort_table('#column_tgl_pinjam','tgl_pinjam')">Tanggal Pinjam</th>
        <th style="min-width: 160px;" class="sortable" id="column_tgl_kembali" data-sort="" onclick="sort_table('#column_tgl_kembali','tgl_kembali')">Tanggal Kembali</th>
        <th style="min-width: 150px;">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $no=($paging['current']-1)*$paging['limit']; 
    foreach ($list->result() as $row) { $no++; ?>
    <tr>
        <td style="text-align:center;"><?=$no;?>.</td>
        <td style="text-align:center;"><?=$row->id_anggota?></td>
        <td><?=$row->nama_anggota?></td>
        <td style="text-align:center;"><?=$row->no_identitas?></td>
        <td style="text-align:center;"><?=$row->nama_jenis_anggota?></td>
        <td style="text-align:center;"><?=$row->kode_buku?></td>
        <td><?=$row->judul?></td>
        <td style="text-align:center;"><?=$row->lama_pinjam?></td>
        <td style="text-align:center;"><?= tgl_indo($row->tgl_pinjam)?></td>
        <td style="text-align:center;"><?= tgl_indo($row->tgl_kembali)?></td>
        <td style="text-align:center;">
          <?php if($row->status=='1'){ ?>
            <span class="badge badge-danger font-size-12">Belum Dikembalikan</span>
          <?php }else if($row->status=='2'){ ?>
            <span class="badge badge-success font-size-12">Dikembalikan</span>  
          <?php } ?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>
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
<div class="table-responsive">
<table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="tr-head">
        <th style="min-width: 60px;">No </th>
        <th style="min-width: 150px;">ID Anggota</th>
        <th style="min-width: 300px;">Nama Anggota</th>
        <th style="min-width: 200px;">No Identitas</th>
        <th style="min-width: 150px;">Jenis Anggota</th>
        <th style="min-width: 150px;">Kode Buku</th>
        <th style="min-width: 350px;">Judul</th>
        <th style="min-width: 150px;">Durasi Pinjam</th>
        <th style="min-width: 160px;">Tanggal Pinjam</th>
        <th style="min-width: 160px;">Tanggal Kembali</th>
        <th style="min-width: 150px;">Status</th>
    </tr>
    </thead>
	<tbody>
		<tr>
			<td colspan="11">Data tidak ditemukan !</td>
		</tr>
	</tbody>
</table>
</div>
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
</script>
