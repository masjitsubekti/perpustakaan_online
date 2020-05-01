<div class="row">
    <div class="col-12">
        <div class="card shade">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Buku</h4>
                <br>
                <!--  -->
                <div class="row">
                    <div class="col-md-12">
                        form
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

<script src="<?php echo base_url('assets/themes/libs/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url()?>assets/all/js/sort-table.js"></script>
<script>
    $(document).ready(function () {
        // pageLoad(1)
        console.log('its work');
	});
</script>