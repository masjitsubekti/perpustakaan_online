<link rel="stylesheet" href="<?=base_url('assets/all/css/fieldset-legend.css')?>">
<style>
	.bootstrap-duallistbox-container select {
    padding: 5px !important;
  }
</style>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	<div id="modal-color" class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header modal-success">
				<h5 class="modal-title" id="modal_title_add" style="display:none;"><i class="bx bx-layer"></i>
					Tambah Menu</h5>
				<h5 class="modal-title" id="modal_title_update" style="display:none;"><i
						class="bx bx-layer"></i> Edit Menu</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			  <form action="" id="form">
				  <div class="modal-body">
            <input type="hidden" name="modeform" id="modeform">
            <input type="hidden" name="id_menu" id="id_menu" value="<?php if(isset($data_menu)){ echo $data_menu['id_menu']; } ?>">
            <div class="form-group">
                <label for="provinsi">Hak Akses</label>
                <select class="form-control" id="hak_akses" name="hak_akses" required>
                    <option value="">Pilih Hak Akses</option>
                    <?php  foreach ($list_role as $role) { ?>
                        <option value="<?= $role->id_roles ?>"><?= $role->name ?></option>    
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="provinsi">Posisi Menu</label>
                <select class="form-control" id="posisi" name="posisi" required>
                    <option value="">Pilih Posisi Menu</option>
                    <?php  foreach ($list_posisi as $p) { ?>
                        <option value="<?= $p->id_posisi ?>"><?= $p->posisi ?></option>    
                    <?php } ?>
                </select>
            </div>
            <div class="form-group" id="levels">
                <label for="level">Level Menu</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="">Pilih Level Menu</option>
                    <option value="1">Parent Menu</option>
                    <option value="2">Sub Menu</option>    
                </select>
            </div>
            <div class="form-group" id="parent" style="display:none;">
                <label for="provinsi">Parent Menu</label>
                <select class="form-control" id="parent_menu" name="parent_menu" required>
                    <option value="">Pilih Parent Menu</option>
                    <?php  foreach ($parent_menu as $pm) { ?>
                        <option value="<?= $pm->id_menu ?>"><?= $pm->nama_menu ?></option>    
                    <?php } ?>
                </select>
            </div>
            <!-- Sub Menu -->
            <div id="sub" style="display:none;">
              <fieldset class="scheduler-border">
                <legend class="scheduler-border"><h5><i id="spinner_menu"></i> Pilih Sub Menu</h5></legend>
                <div class="row">
                  <div class="col-md-12" id="div-notif-menu">
                    <div class="alert alert-info">
                      <h6>Harap <b>Pilih Parent Menu</b> untuk menampilkan sub menu !</h6>
                    </div>
                  </div>
                  <div class="col-md-12" id="div-select-menu" style="display:none;">
                  </div>
                </div>
              </fieldset>
            </div>
            <!-- end sub menu -->
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-primary" style="background-color:#3867d6;color:white;" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
    var selectbox = $('.select-box').bootstrapDualListbox();	

    $('#hak_akses').select2({
      placeholder: "Pilih Hak Akses",
      allowClear: true,
      dropdownParent: $('#modal')
    });

    $('#parent_menu').select2({
      placeholder: "Pilih Parent Menu",
      allowClear: true,
      dropdownParent: $('#parent')
    });

    $('#form').submit(function (event) {
		  event.preventDefault();
      var modeform = $('#modeform').val();
      var ket1 = '';
      var ket2 = '';
      if(modeform=='ADD'){
          ket1 = 'Simpan';
          ket2 = 'Menyimpan';
      }else{
          ket1 = 'Ubah';
          ket2 = 'Mengubah';
      }

		Swal.fire({
			title: ket1 + ' menu',
			text: "Apakah Anda yakin "+ ket2 +" menu !",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3498db',
			cancelButtonColor: '#95a5a6',
			confirmButtonText: 'Simpan',
			cancelButtonText: 'Batal',
			showLoaderOnConfirm: true,
			preConfirm: function () {
				return new Promise(function (resolve) {
						$.ajax({
						url: '<?= site_url() ?>'+'menu/simpan',
						method: 'POST',
						dataType: 'json',	
						data: new FormData($('#form')[0]),
						async: true,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data.success == true) {
								Toast.fire({
									type: 'success',
									title: data.message
								});
								$('#modal').modal('hide');
								swal.hideLoading()
								pageLoad(1);
							} else {
								Swal.fire({type: 'error',title: 'Oops...',text: data.message});
							}
						},
						fail: function (event) {
							alert(event);
						}
					});
				});
			},
			allowOutsideClick: false
		});
		event.preventDefault();
    });

    $(document).ready(function(){
      $('#level').change(function(){
        var posisi=$(this).val();
          if(posisi=='1'){
            document.getElementById("parent").style.display = "block";
            document.getElementById("sub").style.display = "none";
            // document.getElementById("menu").removeAttribute("required");
          }else if(posisi=='2'){
            document.getElementById("sub").style.display = "block";    
            document.getElementById("parent").style.display = "block";
            // document.getElementById("menu").setAttribute("required", "");
          }
      });
    });

    $('#parent_menu').change(function(){
        var parent_menu = $(this).val();
        $('#spinner_menu').addClass("fa fa-spin fa-spinner");
        $.ajax({
          url: '<?= site_url() ?>'+'/Menu/get_sub_menu',
          type: 'post',
          dataType: 'html',
          data: {
            parent_menu: parent_menu
          },
          beforeSend: function () {},
          success: function (result) {
            setTimeout(function(){ 
              $('#div-notif-menu').hide()
              $('#div-select-menu').show()
              $('#spinner_menu').removeClass();
              $('#div-select-menu').html(result);
            }, 500);
          }
        });
    });
</script>
