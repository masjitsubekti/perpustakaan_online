<style>
	.info-box {
		display: block;
		min-height: 230px;
		background: #fff;
		width: 100%;
		box-shadow: 0 2px 2px rgba(0,0,0,0.1);
		border-radius: 6px;
		margin-bottom: 15px;
	}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media">
                            <div class="mr-3">
                                <img src="<?=base_url()?>assets/all/images/superadmin.png" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <h5 class="mb-1">Selamat Datang <?=  $this->session->userdata("auth_nama_user"); ?>, Diaplikasi Perpustakaan Online</h5>
                                    <p class="mb-0">
                                      Aplikasi Perpustakaan Online ini merupakan alat bantu dan media pelayanan Perpustakaan kepada Anda. Silahkan pilih menu disamping untuk memulai.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
</div>
