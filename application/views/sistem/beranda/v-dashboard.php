<!-- Load Selamat Datang -->
<?php $this->load->view('sistem/beranda/v-beranda.php') ?>
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

