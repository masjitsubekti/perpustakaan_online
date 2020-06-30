<div class="modal fade exampleModal" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if($detail['status']=='1'){ ?>
          <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Belum Dikembalikan </div>
        <?php }else if($detail['status']=='2'){ ?>
          <div class="alert alert-info"> <i class="fa fa-info-circle"></i> Telah Dikembalikan </div>  
        <?php } ?>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap">
            <tbody>
              <tr>
                <th scope="row" width="5%">Kode Buku</th>
                <th width="1%">:</th>
                <td width="20%">
                  <?= $detail['kode_buku'] ?>
                </td>
              </tr>
              <tr>
                <th scope="row" width="5%">Judul</th>
                <th width="1%">:</th>
                <td width="20%">
                  <?= $detail['judul'] ?>
                </td>
              </tr>
              <tr>
                <th scope="row" width="5%">Tanggal Pinjam</th>
                <th width="1%">:</th>
                <td width="20%">
                  <?= tgl_indo($detail['tgl_pinjam']) ?>
                </td>
              </tr>
              <tr>
                <th scope="row" width="5%">Tanggal Kembali</th>
                <th width="1%">:</th>
                <td width="20%">
                  <?= tgl_indo($detail['tgl_kembali']) ?>
                </td>
              </tr>
              <tr>
                <th scope="row" width="5%">Tanggal Pengembalian</th>
                <th width="1%">:</th>
                <td width="20%">
                  <?= ($detail['tgl_pengembalian']!="") ? tgl_indo($detail['tgl_pengembalian']) : '-' ?>
                </td>
              </tr>
              <?php if($detail['status']=='1'){ ?>
                <tr>
                  <th scope="row" width="5%">Terlambat</th>
                  <th width="1%">:</th>
                  <td width="20%">
                    <?= $detail['terlambat_peminjaman'] ?> Hari
                  </td>
                </tr>
                <tr>
                  <th scope="row" width="5%">Denda</th>
                  <th width="1%">:</th>
                  <td width="20%">
                    Rp <?= number_format($detail['denda_peminjaman']) ?>
                  </td>
                </tr>
              <?php }else if($detail['status']=='2'){ ?>
                <tr>
                  <th scope="row" width="5%">Terlambat</th>
                  <th width="1%">:</th>
                  <td width="20%">
                    <?= $detail['terlambat_pengembalian'] ?> Hari
                  </td>
                </tr>
                <tr>
                  <th scope="row" width="5%">Denda</th>
                  <th width="1%">:</th>
                  <td width="20%">
                    Rp <?= number_format($detail['denda_pengembalian']) ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>