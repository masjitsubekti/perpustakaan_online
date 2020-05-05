
<div class="row">
        
<?php
    $x = ($paging['limit']*$paging['current'])-$paging['limit'];
        
    if($x<=0)
    {
        $no=0;
    }
    else
    {
        $no = $x;
    }
    $no++;
    
    if($list->num_rows()!=0){
?>


<?php 
    $no=($paging['current']-1)*$paging['limit']; 
    foreach ($list->result() as $row) { $no++; ?>

<div class="col-xl-3 col-sm-6 col-xs-6">
    <div class="card shade">
        <div class="card-body">
            <div class="product-img position-relative">
                <div class="avatar-sm product-ribbon">
                    <span class="avatar-title rounded-circle  bg-primary">
                        - 25 %
                    </span>
                </div>
                <img src="<?= base_url() ?>assets/data/foto_buku/<?= $row->foto ?>" style="width:100%; height:230px;" alt="" class="img-fluid mx-auto d-block">
            </div>
            <div class="mt-4 text-center">
                <h5 class="mb-3 text-truncate"><a href="<?= site_url('Buku/detail_katalog') ?>" class="text-dark"><?= $row->judul ?></a></h5>
                
                <p class="text-muted">
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                </p>
                <h5 class="my-0"><span class="text-muted mr-2"><del>$500</del></span> <b>$450</b></h5>
            </div>
        </div>
    </div>
</div>


<?php } ?>

</div>
<div class="row">
<input type='hidden' id='current' name='current' value='<?php echo $paging['current'] ?>'>
	<br>
	<hr>
	<div class="col-xs-12 col-md-6">
        Menampilkan data
        <?php $batas_akhir = (($paging['current'])*$paging['limit']);
        if ($batas_akhir > $paging['count_row']) {
            $batas_akhir = $paging['count_row'];
        }
        echo ((($paging['current']-1)*$paging['limit'])+1).' - '.$batas_akhir.' dari total '.$paging['count_row']; ?>
        data
	</div>
	<br>
	<div class="col-xs-12 col-md-6">
		<div style="float:right;">
			<?php echo $paging['list']; ?>
		</div>
	</div>
</div>

<?php }else{ ?>
    Data Kosong
<?php } ?>