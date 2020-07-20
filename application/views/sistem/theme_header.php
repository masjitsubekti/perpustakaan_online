
<header id="page-topbar">
    <div class="navbar-header">
      <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
            <div style="font-color:white; text-align:left;" class="logo logo-light">
              <span class="logo-sm">
                <img src="<?=base_url('assets/data/aplikasi/'.$app['logo'])?>" alt="" height="22">
              </span>
              <span class="logo-lg" style="color:white; padding-top: 18px;">
                <img src="<?=base_url('assets/data/aplikasi/'.$app['logo'])?>" alt="" style="width:40px; height:40px;">
                PERPUSTAKAAN ONLINE
              </span>
            </div>
          </div>
          <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
          </button>
      </div>
      <div class="d-flex">
        <div class="dropdown d-none d-lg-inline-block ml-1">
          <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
            <i class="bx bx-fullscreen"></i>
          </button>
        </div>
        <div class="dropdown d-inline-block">
          <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
              $id_user = $this->session->userdata('auth_id_user');
              $users =  $this->db->query("
                select * from users
                where id_user = '$id_user' 
              ");
              
              $data_user = $users->row_array();
              $foto_user = $data_user['foto'];
              $foto_url = '';
              if($foto_user!=""){
                $foto_url = base_url().'assets/data/pp_user/'.$foto_user; 
              }else{ 
                $foto_url = base_url().'assets/all/images/superadmin.png';
              } 
            ?>
            <img class="rounded-circle header-profile-user" src="<?= $foto_url ?>" alt="Header Avatar">
            <span class="d-none d-xl-inline-block ml-1"><?= $this->session->userdata("auth_nama_user"); ?></span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
          
          </button>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- item-->
              <a class="dropdown-item" href="<?= site_url('Profile') ?>"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
              <!-- <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a> -->
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="javascipt:;" onclick="logout()"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
            </div>
          </div>
        </div>
    </div>
</header> 
<script>
  function logout() {
    Swal.fire({
        title: 'Keluar dari Sistem ?',
        text: "Apakah Anda yakin keluar dari sistem !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                axios.post('<?= site_url() ?>'+'/Auth/logout')
                .then((response) => {
                    // success callback
                    setTimeout(function(){
                        if(response.data.success===true){
                            Swal.fire('Berhasil',response.data.message,'success');
                            swal.hideLoading()
                            setTimeout(function(){ 
                              window.location.href = '<?= site_url() ?>' + response.data.page;
                            }, 1000);
                        }else{
                            Swal.fire({type: 'error',title: 'Oops...',text: response.data.message});
                        }   
                    }, 1000);
                }, (response) => {
                    // error callback
                    Swal.fire({type: 'error',title: 'Oops...',text: 'error...'});
                });
            });
        },
        allowOutsideClick: false
    });
}
</script>