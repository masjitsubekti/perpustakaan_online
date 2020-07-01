<div class="table-responsive">
<table class="table table-centered mb-0 table-nowrap">
  <thead class="thead-light">
    <tr>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>
  </thead>
  <tbody>
  <?php if($list->num_rows()!=0){ 
  foreach ($list->result() as $row) { ?>
    <tr>
        <td>
            <img src="<?= base_url('assets/data/foto_buku/'.$row->foto) ?>" alt="<?= $row->judul ?>"
            title="product-img" class="avatar-md" />
        </td>
        <td>
            <h5 class="font-size-14 text-truncate"><a href="javascript:;" class="text-dark"><?= $row->judul ?></a></h5>
            <p class="mb-0">Kode Buku : <span class="font-weight-medium"><?= $row->kode_buku ?></span></p>
        </td>
        <td>
          <?= tgl_indo($row->tgl_pinjam) ?>
        </td>
        <td>
          <?= tgl_indo($row->tgl_kembali) ?>
        </td>
        <td>
          <?php if($row->status=='1'){ ?>
            <span class="badge badge-danger font-size-12">Belum Dikembalikan</span>
          <?php }else if($row->status=='2'){ ?>
            <span class="badge badge-success font-size-12">Dikembalikan</span>  
          <?php } ?>
        </td>
        <!-- <td>
          <a href="javascript:void(0);" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
        </td> -->
    </tr>
  <?php } ?>
<?php }else{ ?>
  <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Data Peminjaman Tidak Dutemukan ! </div>
<?php } ?>
  </tbody>
</table>
</div>