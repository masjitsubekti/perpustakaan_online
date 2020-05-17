<div class="row">
    <div class="col-lg-12">
        <div class="row mb-3">
            <div class="col-xl-2 col-sm-2">
                <div class="mt-2">
                    <!-- <h5>Katalog Buku</h5> -->
                </div>
            </div>
            <div class="col-lg-8 col-sm-8">
                <div class="search-box mr-2">
                    <div class="position-relative">
                        <input type="text" class="form-control border-0 shade" name="cari" id="cari" placeholder="Search...">
                        <i class="bx bx-search-alt search-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-2">
                <div class="mt-2">
                    <!-- <h5>Katalog Buku</h5> -->
                </div>
            </div>
        </div>
        <div id="list"></div>
        <!-- end row -->
    </div>
</div>

<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script>
    $(document).ready(function () {
		pageLoad(1)
	});

  	$('#cari').on('keypress', function (e) {
		if (e.which == 13) {
			pageLoad(1);
		}
	});

	function pageLoad(i) {
        $('#div_dimscreen').show();

        // var id_th = $('#input_id_th').val();
        // var column = $('#input_column').val();
        // var sort = $('#input_sort').val();

		// var limit = $('#limit').val();
		var cari = $('#cari').val();
		$.ajax({
			url: "<?php echo site_url('Buku/read_katalog/')?>" + i,
			type: 'post',
			dataType: 'html',
			data: {
				limit: 8,
				cari: cari,
				column:'created_at',
				sort:'desc',
			},
			beforeSend: function () {},
			success: function (result) {
				$('#list').html(result);
				$('#div_dimscreen').fadeOut('slow');
				// sort_finish(id_th,sort);
			}
		});
    }

</script>


                        