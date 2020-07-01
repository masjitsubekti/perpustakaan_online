<div class="row">
<?php if($list_petugas->num_rows()!=0){ 
  foreach ($list_petugas->result() as $row) { ?>
<div class="col-xl-3 col-sm-6">
  <div class="card text-center">
    <div class="card-body">
      <div class="mb-4">
        <img class="rounded-circle avatar-sm" src="<?=base_url()?>assets/all/images/person2.png" alt="">
      </div>
      <h5 class="font-size-15"><a href="#" class="text-dark"><?= $row->name ?></a></h5>
      <p class="text-muted"><?= $row->email ?></p>

      <div>
        <?php if($row->status=='1'){ ?>
          <span class="badge badge-pill badge-success font-size-12 m-1">Aktif</span>
        <?php }else if($row->status=='2'){ ?>
          <span class="badge badge-pill badge-soft-warning font-size-12 m-1">Belum Diverifikasi</span>  
        <?php }else if($row->status=='3'){ ?>
          <span class="badge badge-pill badge-soft-danger font-size-12 m-1">Diblokir</span>  
        <?php } ?>
        <!-- <span class="badge badge-primary font-size-11 m-1">Aktif</span> -->
      </div>
    </div>
    <div class="card-footer bg-transparent border-top">
      <div class="d-flex font-size-20 contact-links">
        <div class="flex-fill">
            <a href="#" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php }else{ ?>
<div class="col-xl-12 col-sm-6">
  <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Data Petugas Tidak Dutemukan ! </div>
</div>
<?php } ?>
</div>