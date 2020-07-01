<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Peminjaman Aktif</h4>
                <br>
                <br>
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $id_anggota ?>">
                <div id="list"></div>
                <div class="row mt-4">
                  <!-- No Content -->
                </div> <!-- end row-->
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function () {
		pagePeminjaman()
  });
  
	function pagePeminjaman() {
    $('#div_dimscreen').show();
    var id_anggota = $('#id_anggota').val();
		$.ajax({
			url: "<?php echo site_url('Peminjaman_anggota/read_peminjaman_aktif')?>",
			type: 'post',
			dataType: 'html',
			data: {
				id_anggota: id_anggota,
			},
			beforeSend: function () {},
			success: function (result) {
				$('#list').html(result);
				$('#div_dimscreen').fadeOut('slow');
			}
		});
  }
</script>
