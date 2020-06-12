<style>
    @media (min-width: 992px) {
		.modal-lg {
			width: 80%;
		}
	}
    .modal-full {
        min-width: 80%;
    }
</style>
<div class="modal fade" id="modal-cetak" tabindex="-1" role="dialog" aria-labelledby="modal-cetak" aria-hidden="true">
	<div id="modal-color" class="modal-dialog modal-lg modal-full modal-success" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 style="font-size:16px;" class="modal-title"><i class="fa fa-align-justify"></i> Cetak Kartu Anggota</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
        <div class="modal-body">
          <iframe src="<?= site_url('Cetak/cetak_kartu_anggota/'.$id_anggota) ?>" style="width:100%; height:420px;"></iframe>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
		</div>
	</div>
</div>
