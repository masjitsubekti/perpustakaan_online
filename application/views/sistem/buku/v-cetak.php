<div class="row">
    <div class="col-12">
        <div class="card shade">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Pencetakan</h4>
                <br>
                <!--  -->
                <div class="row">
                    <div class="col-md-2">
                        <select class="form-control" name="limit" id="limit" onchange="pageLoad(1)">
                            <option value="10" selected>10 Baris</option>
                            <option value="25">25 Baris</option>
                            <option value="50">50 Baris</option>
                            <option value="100">100 Baris</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <!-- <a href="<?= site_url('Buku/form_add') ?>" class="btn btn-success" id="btn-add"> <b> <i class="bx bx-plus-circle"></i> </b> Tambah</a> -->
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" id="cari" name="cari" class="form-control" placeholder="Cari . . .">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div id="list"></div> 
            </div>
        </div>
    </div>
</div>
<!-- DATA SORT -->
<input type="hidden" name="input_id_th" id="input_id_th" value="#column_waktu">
<input type="hidden" name="input_column" id="input_column" value="created_at">
<input type="hidden" name="input_sort" id="input_sort" value="desc">
<div id="div-modal"></div>

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
    var id_th = $('#input_id_th').val();
    var column = $('#input_column').val();
    var sort = $('#input_sort').val();

		var limit = $('#limit').val();
		var cari = $('#cari').val();
		$.ajax({
			url: "<?php echo site_url('Buku/read_data_cetak/')?>" + i,
			type: 'post',
			dataType: 'html',
			data: {
				limit: limit,
				cari: cari,
				column:column,
				sort:sort,
			},
			beforeSend: function () {},
			success: function (result) {
				$('#list').html(result);
				$('#div_dimscreen').fadeOut('slow');
				sort_finish(id_th,sort);
			}
		});
  }  
</script>