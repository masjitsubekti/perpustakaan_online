<style>
	.info-box {
		display: block;
		min-height: 230px;
		background: #fff;
		width: 100%;
		box-shadow: 0 4px 4px rgba(0,0,0,0.1);
		border-radius: 6px;
		margin-bottom: 15px;
	}
</style>
<!-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="media">
                            <div class="mr-3">
                                <img src="<?=base_url()?>assets/themes/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <p class="mb-2">Welcome to skote dashboard</p>
                                    <h5 class="mb-1">Henry wells</h5>
                                    <p class="mb-0">UI / UX Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Total Projects</p>
                                        <h5 class="mb-0">48</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Projects</p>
                                        <h5 class="mb-0">40</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Clients</p>
                                        <h5 class="mb-0">18</h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="clearfix  mt-4 mt-lg-0">
                            <div class="dropdown float-right">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bxs-cog align-middle mr-1"></i> Setting
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> -->
<!--  -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="<?= site_url('Cari_buku') ?>" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/search_book1.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Cari Buku</b></p>
    </div>
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="<?= site_url('Peminjaman_anggota/peminjaman_aktif') ?>" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/book_aktif.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Peminjaman Aktif</b></p>
    </div>
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="<?= site_url('Peminjaman_anggota/histori_peminjaman') ?>" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/histori3.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Histori Peminjaman</b></p>
    </div>
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/person2.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Data Diri</b></p>
    </div>
    </a>
  </div>
  <!-- <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/training.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Pre Post Test</b></p>
    </div>
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="" style="text-decoration: none; color:#3c4b64;">
    <div class="info-box hvr-wobble-vertical" style="text-align: center;">
      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <img src="<?= base_url('assets/all/images/training.png') ?>"/>       
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <p style="font-size: 16px;"><b>Pre Post Test</b></p>
    </div>
    </a>
  </div> -->
</div>
