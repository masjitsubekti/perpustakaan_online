<style>
  .btn-ubah {
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 600;
  }
  .tab-content {
    margin-top: -1px;
    background: #fff;
    border: 1px solid #c8ced3;
    padding:12px;
  }

  /* Profile sidebar */
  .profile-sidebar {
    padding: 20px 0 10px 0;
    background: #fff;
  }
  .profile-userpic  img {
    width: 160px;
    height: 160px;
    -webkit-border-radius: 50% !important;
    -moz-border-radius: 50% !important;
    border-radius: 50% !important;
    border: 3px solid #e0d7d7;
    object-position: 50% 7%;
    object-fit:cover;
  }
  .profile-usertitle {
    text-align: center;
    margin-top: 20px;
  }
  .profile-usertitle-name {
    color: #5a7391;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 7px;
  }
  .profile-usertitle-job {
    text-transform: uppercase;
    color: #5b9bd1;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
  }
  .profile-userbuttons {
    text-align: center;
  }
  .profile-userbuttons .btn {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600;
    padding: 6px 15px;
    margin-right: 5px;
  }
  .profile-userbuttons .btn:last-child {
    margin-right: 0px;
  }
  .profile-content {
    padding: 20px;
    background: #fff;
    min-height: 460px;
  }
  .nav-tabs .nav-link.active {
    color: #2f353a;
    background: #fff;
    border-color: #c8ced3;
    border-bottom-color: #fff;
  }
</style>
<div class="row profile">
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="profile-sidebar card">
      <div class="profile-userpic">
        <center>
        <?php if($data_user['foto']==""){ ?>
          <img src="<?=base_url()?>assets/all/images/superadmin.png" class="image-responsive" alt="">
        <?php }else{ ?>
          <img src="<?=base_url('assets/data/pp_user/'.$data_user['foto'])?>" class="image-responsive" alt="">
        <?php } ?>
        </center>
      </div>
      <div class="profile-usertitle">
        <div class="profile-usertitle-name">
          <?=$this->session->userdata('auth_nama_user');?>
        </div>
        <div class="profile-usertitle-job">
          <?=$this->session->userdata('auth_nama_role');?>
        </div>
      </div>
      <div class="profile-userbuttons">
        <a href="javascript:;" data-id="<?php echo $this->session->userdata("auth_id_user"); ?>" data-name="" title="Ubah Foto" id="btn-ubah-foto" class="btn btn-success btn-sm"> <i class="fa fa-camera"></i> &nbsp; Ubah Foto</a>
      </div>
    </div>
  </div>
  <div class="col-md-9 col-sm-9 col-xs-12">
  <div class="card">
    <div class="card-header" style="background-color:#3a95d2;color:white;">
      <span> <i class="fa fa-align-justify"></i> <strong>Profile</strong> </span>
    </div>
    <div class="card-body">
    <!--  -->
    <div class="mb-4">
      <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item nav-tabs-item">
              <a class="nav-link nav-tabs-link active show" data-toggle="tab" href="#tab_profile" role="tab" aria-controls="home" aria-selected="true">
                  <i class="fa fa-address-card"></i> Data User
              </a>
          </li>
          <li class="nav-item nav-tabs-item">
              <a class="nav-link nav-tabs-link" data-toggle="tab" href="#tab_ubah_password" role="tab" aria-controls="messages"
                  aria-selected="false">
              <i class="fa fa-key"></i> Ubah Password</a>
          </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active show" id="tab_profile" role="tabpanel">
          <!-- form Profile -->
          <?php $this->load->view('sistem/profile/form-ubah-profile.php') ?>
          <!-- end form Profile -->
        </div>
        <div class="tab-pane" id="tab_ubah_password" role="tabpanel">
          <!-- form ubah password -->
          <?php $this->load->view('sistem/profile/form-ubah-password.php') ?>
          <!-- end form ubah password -->
        </div>
      </div>
    </div>
    <!--  -->
    </div>
  </div>
</div>
<div id="div_modal"></div>
<script src="<?=base_url()?>assets/themes/libs/jquery/jquery.min.js"></script>
<script>
  $("#btn-ubah-foto").click(function() {
    $('#div_dimscreen').show();
    var id = $(this).attr('data-id');
    $.ajax({
      url: "<?php echo site_url('Profile/load_modal_foto/')?>",
      type: 'post',
      dataType: 'html',
      data:{id:id},
      beforeSend: function () {},
      success: function (result) {    
        $('#div_modal').html(result);
        $('#div_dimscreen').fadeOut('slow');
        $('#modal-foto').modal('show');
      }
    });
  });
</script>

