<div class="row">
    <div class="col-xl-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Peminjaman</h4>
                <hr>
                <div class="form-group row mb-4" id="box-id">
                    <label for="billing-name" class="col-md-2 col-form-label">ID Anggota</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota" placeholder="Enter ID Anggota">
                    </div>
                </div>
                <div id="data_anggota"></div>
            </div>
        </div>
    </div>
</div>
<div class="checkout-tabs">
    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <!-- <div class="card shadow-none border mb-0">
                <div class="card-body">
                    <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Data Buku</h4>
                    <hr>
                    <div class="form-group row mb-4">
                        <label for="billing-name" class="col-md-2 col-form-label">Kode Buku</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="billing-name" placeholder="Enter Kode Buku">
                        </div>
                    </div>
                    <div id="list"></div>
                </div>
            </div> -->

            <div class="row mt-4">
                <div class="col-sm-6">
                    <a href="ecommerce-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link">
                        <i class="mdi mdi-arrow-left mr-1"></i> Back to Shopping Cart </a>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="text-sm-right">
                        <a href="ecommerce-checkout.html" class="btn btn-success">
                            <i class="mdi mdi-truck-fast mr-1"></i> Proceed to Shipping </a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <br>

        </div>

    </div>
</div>


<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script>
    $(document).ready(function () {
		
	});

  	$('#id_anggota').on('keypress', function (e) {
		if (e.which == 13) {
			pageAnggota();
		}
	});

	function pageAnggota() {
        $('#div_dimscreen').show();
		var id_anggota = $('#id_anggota').val();
		$.ajax({
			url: "<?php echo site_url('Peminjaman/read_anggota/')?>",
			type: 'post',
			dataType: 'html',
			data: {
				id_anggota: id_anggota,
			},
			beforeSend: function () {},
			success: function (result) {
				$('#data_anggota').html(result);
				$('#div_dimscreen').fadeOut('slow');
				$('#box-id').hide();
			}
		});
    }
    
</script>



