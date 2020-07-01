<ul class="verti-timeline list-unstyled">
<?php if($list_peminjaman->num_rows()!=0){ 
  foreach ($list_peminjaman->result() as $row) { ?>
    <li class="event-list">
      <div class="event-timeline-dot">
        <i class="bx bx-right-arrow-circle"></i>
      </div>
      <div class="media">
        <div class="mr-3">
            <i class="bx bx-badge-check h2 text-primary"></i>
        </div>
        <div class="media-body">
          <div>
            <!-- <h5> Peminjaman Tanggal <?= generate_tanggal_indonesia($row->created_at) ?> </h5> -->
            <?php 
              $detail = $this->Histori_peminjaman_m->peminjaman_anggota($row->id_peminjaman)->result();
              foreach ($detail as $a) { ?>
              <p style="font-size:14px; font-weight: 500; color: #495057;"> <?= $a->judul ?></p>
              <div style="margin-top: -10px;">
                <span>Tanggal Pinjam&nbsp;&nbsp;&nbsp; : <?= tgl_indo($a->tgl_pinjam) ?></span><br> 
                <span>Tanggal Kembali&nbsp;: <?= tgl_indo($a->tgl_kembali) ?></span><br>
                <?php if($a->status=='1'){ ?>
                  <span class="badge badge-pill badge-soft-danger font-size-12">Belum Dikembalikan</span>
                <?php }else if($a->status=='2'){ ?>
                  <span class="badge badge-pill badge-soft-success font-size-12">Dikembalikan</span>  
                <?php } ?>
                <a href="javascript:;" class="btn-detail" data-id="<?=$a->id_detail_peminjaman?>">Detail</a>
              </div>
              <hr>
            <?php } ?>
          </div>
        </div>
      </div>
    </li>
  <?php } ?>
<?php }else{ ?>
  <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Data Peminjaman Tidak Dutemukan ! </div>
<?php } ?>
</ul>

<script>
  $(".btn-detail").click(function() {
		$('#div_dimscreen').show();
    var id = $(this).attr('data-id');
		$.ajax({
			url: "<?php echo site_url('Peminjaman_anggota/modal_detail/')?>",
			type: 'post',
			dataType: 'html',
      data:{id_detail_peminjaman:id},
			beforeSend: function () {},
			success: function (result) {    
				$('#div-modal').html(result);
				$('#div_dimscreen').fadeOut('slow');
				$('#modal-detail').modal('show');
			}
		});
  });
</script>