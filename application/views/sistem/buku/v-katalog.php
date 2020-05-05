<div class="row">
    <div class="col-lg-12">
        <div class="row mb-3">
            <div class="col-xl-2 col-sm-6">
                <div class="mt-2">
                    <!-- <h5>Katalog Buku</h5> -->
                </div>
            </div>
            <div class="col-lg-8 col-sm-6">
                <!-- <form class="mt-4 mt-sm-0 float-sm-right form-inline"> -->
                    <div class="search-box mr-2">
                        <div class="position-relative">
                            <input type="text" class="form-control border-0 shade" name="cari" id="cari" placeholder="Search...">
                            <i class="bx bx-search-alt search-icon"></i>
                        </div>
                    </div>
                    <!-- <ul class="nav nav-pills product-view-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="bx bx-grid-alt"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bx bx-list-ul"></i></a>
                        </li>
                    </ul> -->
                <!-- </form> -->
            </div>

            <div class="col-xl-2 col-sm-6">
                <div class="mt-2">
                    <!-- <h5>Katalog Buku</h5> -->
                </div>
            </div>
        </div>
        <div id="list"></div>
        
        <!-- end row -->

        <!-- <div class="row">
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item disabled">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item active">
                        <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">5</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div> -->

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


                        