<!doctype html>
<html lang="en">
<head>        
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Subekti Devcode" name="Abdul Masjit Subekti" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/themes/images/favicon.ico">
    <!-- CSS -->
    <?php $this->load->view('sistem/theme_css') ?>
</head>
<body>
    <div class="home-btn d-none d-sm-block">
        <!-- <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a> -->
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container" id="app">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign in to continue to Skote.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="<?=base_url()?>assets/themes/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div>
                                <a href="index.html">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="<?=base_url()?>assets/themes/images/logo.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2" id="login">
                                <form class="form-horizontal" @submit.prevent="login">
    
                                    <div class="form-group">
                                        <label for="username">Username / Email</label>
                                        <input type="text" class="form-control" v-model="user_login" id="user_login" name="user_login" placeholder="Enter Username / Email" autocomplete="off">
                                    </div>
            
                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" v-model="password_login" id="password_login" name="password_login" placeholder="Enter Password" autocomplete="off">
                                    </div>
            
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        <div v-show="loading">
                                        <br>
                                        <center>
                                            <i style="font-size:24px;" class="bx bx-loader bx-spin font-size-20 align-middle mr-2 text-success"></i>
                                        </center>
                                        </div>
                                    </div>
        
                                    <div class="mt-4 text-center">
                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                    </div>
                                </form>
                            </div>
        
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Don't have an account ? <a href="auth-register.html" class="font-weight-medium text-primary"> Signup now </a> </p>
                        <p>© 2020 Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
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
			el: '#login',
			data: {
				user_login: "",
				password_login: "",
				loading:false,
			},
			methods:{
				login:function(event){
					vm.loading = true;
					var formdata = new FormData();
					formdata.append('user_login', this.user_login);
					formdata.append('password_login', this.password_login);
					axios({
						method: 'post',
						url: site_url+'/Auth/check_auth',
						data: formdata,
					})
					.then(function (response){
						if(response.data.success===true){
              Toast.fire({
                  type: 'success',
                  title: response.data.message
              });       
              setTimeout(function(){ 
                  window.location.href = site_url+response.data.page;
                  vm.loading = false;
              }, 2000);          
						}else{
              setTimeout(function(){ 
                Swal.fire({type: 'error',title: 'Oops...',text: response.data.message});
                vm.loading = false;
              }, 1000);
						}
					});
				}
			}
        })        
	</script>
</body>
</html>
