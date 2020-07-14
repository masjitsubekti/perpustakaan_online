<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media">
                            <div class="mr-3">
                                <img src="<?=base_url()?>assets/all/images/superadmin.png" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <h5 class="mb-1">Selamat Datang <?=  $this->session->userdata("auth_nama_user"); ?>, Diaplikasi Perpustakaan Online</h5>
                                    <p class="mb-0">
                                      Aplikasi Perpustakaan Online ini merupakan alat bantu dan media pelayanan Perpustakaan kepada Anda. Silahkan pilih menu disamping untuk memulai.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="div-dashboard"></div>
<br>
<?php $rentang = 7; ?>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/all/Highcharts/code/highcharts.js"></script>
<script src="<?= base_url() ?>assets/all/Highcharts/code/modules/exporting.js"></script>
<script src="<?= base_url() ?>assets/all/Highcharts/code/modules/export-data.js"></script>
<script>
  $(document).ready(function () {
		load_dashboard();
	});

  function load_dashboard() {
		$.ajax({
			url: "<?php echo site_url('Beranda/load_dashboard/')?>",
			type: 'post',
			dataType: 'html',
			data: {},
			beforeSend: function () {},
			success: function (result) {
				$('#div-dashboard').html(result);
			}
		});
	}	

</script>

