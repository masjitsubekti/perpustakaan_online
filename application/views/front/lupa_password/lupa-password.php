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
                                Silahkan Masukan Email Akun Anda, Untuk Melakukan Reset Password !
                              </div>
                              <form id="form-lupa-pass" @submit.prevent="lupa_password">
                                <div class="form-group">
                                  <label for="useremail">Email</label>
                                  <input type="email" class="form-control" v-model="email_reset" id="email_reset" name="email_reset" placeholder="Masukan Email . . ." autocomplete="off" required>
                                </div>
                                <div class="form-group row mb-0">
                                  <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Kirim Verifikasi Email <i v-show="loading" class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i></button>
                                  </div>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="mt-2 text-center">
                    <p>Kembali Ke Halaman Login ? <a href="<?= site_url('Auth') ?>" class="font-weight-medium text-primary"> Login</a> </p>
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
  var lp = new Vue({
    el: '#app',
    data: {
      email_reset: "",
      loading:false,
    },
    methods:{
      lupa_password:function(event){
        lp.loading = true;
        var formdata_reset = new FormData();
        formdata_reset.append('email_reset', this.email_reset);
        axios({
          method: 'post',
          url: site_url+'Auth/email_reset_password',
          data: formdata_reset,
        })
        .then(function (response){
          if(response.data.success===true){
            Swal.fire({type: 'success',title: 'Success...',text: response.data.message});
            lp.email_reset = "";
            lp.loading = false;
          }else{
            Swal.fire({type: 'error',title: 'Oops...',text: response.data.message});
            lp.loading = false;
          }
        });
      }
    }
  })
</script>
</body>
</html>
