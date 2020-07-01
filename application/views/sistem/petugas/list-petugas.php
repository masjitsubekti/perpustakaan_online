<div id="list"></div>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function () {
		pagePetugas()
  });
  
	function pagePetugas() {
    $('#div_dimscreen').show();
    $.ajax({
			url: "<?php echo site_url('Petugas/read_petugas')?>",
			type: 'post',
			dataType: 'html',
			data: {},
			beforeSend: function () {},
			success: function (result) {
				$('#list').html(result);
				$('#div_dimscreen').fadeOut('slow');
			}
		});
  }
</script>

