<!doctype html>
<html lang="en">
<head>        
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Perpustakaan Online" name="description" />
    <meta content="Soebekti Devcode" name="Abdul Masjit Subekti" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/data/aplikasi/'.$aplikasi['favicon'])?>">
    <!-- CSS -->
    <?php $this->load->view('sistem/theme_css') ?>
</head>
<body>
    <div class="home-btn d-none d-sm-block"></div>
    <!-- my-5 -->
    <div class="account-pages pt-sm-5">
      <div class="container" id="app">
          <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card overflow-hidden">
                      <div class="bg-soft-primary">
                        <div class="row">
                          <div class="col-8">
                              <div class="text-primary p-4">
                                  <h5 class="text-primary">Lupa Password !</h5>
                                  <p>Form Reset Password.</p>
                              </div>
                          </div>
                          <div class="col-4 align-self-end">
                              <img src="<?=base_url()?>assets/themes/images/profile-img.png" alt="" class="img-fluid">
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0"> 
                          <br>
                          <div class="p-2">
                              <div class="alert alert-success" role="alert">
                                Silahkan Masukan Password Baru !
                              </div>
                              <form id="form-lupa-pass" @submit.prevent="submit">
                                <input type="hidden" id="id_user" name="id_user" value="<?php if (isset($id_user)){echo $id_user;} ?>">
                                <div class="form-group">
                                  <label for="useremail">Password Baru</label>
                                  <input type="password" class="form-control" id="pass_baru" name="pass_baru" placeholder="Password Baru . . ." required>
                                </div>
                                <div class="form-group">
                                  <label for="useremail">Confirm Password</label>
                                  <input type="password" class="form-control" onkeyup="validate_password()" id="confirm_pass_baru" name="confirm_pass_baru" placeholder="Password Baru . . ." required>
                                  <span id="pass-message" style="font-size:14px;"></span>
                                </div>
                                <div class="form-group row mb-0">
                                  <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" id="reset" type="submit">Simpan <i v-show="loading" class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i></button>
                                  </div>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="mt-2 text-center">
                    <p>© 2020 Perpustakaan Online. <b> All rights reserved. </b></p>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- JAVASCRIPT -->
<?php $this->load->view('sistem/theme_js') ?>
<script>
  const site_url = "<?=site_url()?>";
  var vm = new Vue({
      el: '#app',
      data: {
        loading:false,
      },
      methods: {
          submit: function(e) {
              vm.loading = true;
              var form = document.getElementById('form-lupa-pass');
              var formData = new FormData(form);

              axios.post('<?= site_url() ?>'+'/Auth/simpan_pass', formData)
              .then((response) => {
                // success callback
                setTimeout(function(){
                  if(response.data.success===true){
                    Toast.fire({
                      type: 'success',
                      title: response.data.message
                    });  
                    setTimeout(function(){
                      window.location.href = site_url+'/Auth';
                    }, 3000);
                    vm.loading = false;
                  }else{
                    swal("Oops..",response.data.message,"error");
                    vm.loading = false;
                  }   
                }, 1500);
              }, (response) => {
                  // error callback
                  Swal.fire({type: 'error',title: 'Oops...',text: response.data.message});
                  vm.loading = false;
              });
          }
      }
  });

  function validate_password(){
    var pass = $('#pass_baru').val();
    var confirm_pass = $('#confirm_pass_baru').val();
    if(pass!=confirm_pass){
      $('#pass-message').show();
      $('#pass-message').text('Password tidak cocok !');
      $('#pass-message').css('color','red');
      $('#reset').prop('disabled',true);
    }else{
      $('#pass-message').hide();
      $('#pass-message').text('');
      $('#pass-message').css('color','white');
      $('#reset').prop('disabled',false);
    }
  }
</script>
</body>
</html>
