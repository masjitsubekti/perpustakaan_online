<div class="modal fade exampleModal" id="modal-max" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning"> <i class="fa fa-info-circle"></i> Total Kuota Peminjaman Buku Sudah Maksimal </div>
                <p class="mb-2">ID Anggota &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="text-primary"><?= $id_anggota ?></span></p>
                <p class="mb-4">Nama Anggota &nbsp;: <span class="text-primary"><?= $nama_anggota ?></span></p>
                <p class="mb-4">Maksimal Peminjaman &nbsp; : <span class="text-primary"><?= $max_pinjam ?> Items</span></p>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Peminjaman</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Tanggungan
                                </th>
                                <td>
                                    <?= $tanggungan ?> Items
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Daftar Pinjam
                                </th>
                                <td>
                                    <?= $jumlah ?> Items
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    <?= $total ?> Items
                                </td>
                            </tr>
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