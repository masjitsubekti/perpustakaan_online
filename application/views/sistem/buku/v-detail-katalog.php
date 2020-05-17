
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Detail Buku</h4>
                <br>
                <!-- <br> -->
                <div class="row">
                    <div class="col-xl-5">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-9 offset-md-1 col-sm-12 col-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <?php
                                                $foto = $book['foto'];
                                                if($foto!=""){ ?>
                                                    <img src="<?php echo base_url('assets/data/foto_buku/'.$book['foto']) ?>" alt="<?= $book['judul'] ?>" style="height:250px;" class="img-fluid mx-auto d-block">
                                                <?php }else{ ?>
                                                    <img src="<?php echo base_url('assets/all/images/book_cover3.png') ?>" alt="<?= $book['judul'] ?>" style="height:250px;" class="img-fluid mx-auto d-block">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="mt-4 mt-xl-3">
                            <a href="#" class="text-primary"><?= $book['nama_kategori'] ?></a>
                            <h4 class="mt-1 mb-3"><?= $book['judul'] ?></h4>

                            <p class="text-muted float-left mr-3">
                                <span class="bx bx-star text-warning"></span>
                                <span class="bx bx-star text-warning"></span>
                                <span class="bx bx-star text-warning"></span>
                                <span class="bx bx-star text-warning"></span>
                                <span class="bx bx-star"></span>
                            </p>
                            <p class="text-muted mb-4">( 152 Members Review )</p>

                            <!-- <h6 class="text-success text-uppercase">New</h6> -->
                            <h5 class="mb-4">Stok : <span class="text-muted mr-2"></span> <?= $book['stok'] ?> Items</h5>
                            <!-- <p class="text-muted mb-4">To achieve this, it would be necessary to have uniform grammar pronunciation and more common words If several languages coalesce</p> -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <p class="text-muted"><i class="bx bx-shape-triangle font-size-16 align-middle text-primary mr-1"></i> Tebal Halaman : <?= $book['halaman'] ?> Halaman</p>
                                        <p class="text-muted"><i class="bx bx-unlink font-size-16 align-middle text-primary mr-1"></i> Tinggi : <?= $book['tinggi'] ?> </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <p class="text-muted"><i class="bx bx-user-voice font-size-16 align-middle text-primary mr-1"></i> Edisi Ke <?= $book['edisi'] ?> </p>
                                        <p class="text-muted"><i class="bx bx-cog font-size-16 align-middle text-primary mr-1"></i> Tahun Terbit : <?= $book['tahun_terbit'] ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="mt-5">
                    <h5 class="mb-3">Deskripsi Buku :</h5>

                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;">Judul Buku</th>
                                    <td><?= $book['judul'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">ISBN</th>
                                    <td><?= $book['isbn'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengarang</th>
                                    <td><?= $book['nama_pengarang'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerbit</th>
                                    <td><?= $book['nama_penerbit'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat Terbit</th>
                                    <td><?= $book['tempat_terbit'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Terbit</th>
                                    <td><?= $book['tahun_terbit'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Edisi</th>
                                    <td><?= $book['edisi'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Halaman</th>
                                    <td><?= $book['halaman'] ?> Halaman</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tinggi</th>
                                    <td><?= $book['tinggi'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Lokasi Rak</th>
                                    <td><?= $book['kode_rak'] ?> / <?= $book['nama_rak'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td><?= $book['keterangan'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end Specifications -->
            </div>
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->