<?php if($data_anggota->num_rows()!=0){ 
    $anggota = $data_anggota->row_array();    
?>
<div id="data-anggota"></div>
<table class="table borderless table-hover">
    <tr>
        <th style="text-align:left; width:15%;">ID Anggota</th>
        <td style="text-align:left; width:5%;"> : </td>
        <td style="text-align:left; width:30%;"> <?= $anggota['id_anggota'] ?> </td>
        <th style="text-align:left; width:15%;">Nama Anggota</th>
        <td style="text-align:left; width:5%;"> : </td>
        <td style="text-align:left; width:30%;"> <?= $anggota['nama_anggota'] ?> </td>
    </tr>
    <tr>
        <th style="text-align:left;">Jenis Anggota</th>
        <td> : </td>
        <td style="text-align:left;"> <?php echo "-"; ?> </td>
        <th style="text-align:left;">Lama Pinjam</th>
        <td> : </td>
        <td style="text-align:left;"> <?php echo "-"; ?> </td>
    </tr>
    <tr>
        <th style="text-align:left;">Maksimum</th>
        <td> : </td>
        <td style="text-align:left;"> <?php echo "-"; ?> </td>
        <th style="text-align:left;">Tanggungan</th>
        <td> : </td>
        <td style="text-align:left;"> <?php echo "-"; ?> </td>
    </tr>
</table>
</div>
<hr>
<h4 class="card-title" style="font-size:17px;"> <i class="bx bx-layer"></i> Data Buku</h4>
<br>
<div class="form-group row mb-4">
    <label for="billing-name" class="col-md-2 col-form-label">Kode Buku</label>
    <div class="col-md-5">
        <input type="text" id="kode_buku" name="kode_buku" class="form-control" id="billing-name" placeholder="Enter Kode Buku">
    </div>
    <div class="col-md-2">
        <a href="javascript:" onclick="addRow()" class="btn btn-success"> <i class="bx bx-plus-circle"></i> Add List</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-centered mb-0 table-nowrap" id="dataTable">
        <thead class="thead-light">
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Judul</th>
            <th style="text-align:center;" scope="col">Tanggal Pinjam</th>
            <th style="text-align:center;" scope="col">Tanggal Kembali</th>
            <th style="text-align:center;" scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
    <input type="hidden" name="jumlah_row" id="jumlah-row" value="0">
</div>
<?php }else{ ?>
    <table class="table borderless table-hover">
    <tr>
        <td>Data anggota tidak ditemukan !</td>
    </tr>
<?php } ?>

<script>
    function addRow(){
    var kode_buku = $("#kode_buku").val(); 
    var jumlah = parseInt($("#jumlah-row").val()); 
    var nextform = jumlah + 1; 

        $.ajax({
            url: "<?php echo site_url('Peminjaman/sisipkan_td_peminjaman') ?>",
            type: "post",
            dataType: "json",
            data:{
                kode_buku : kode_buku,
                nextform : nextform,
            },
            success: function(data) {
                if (data.success == true) {
                    Toast.fire({
                        type: 'success',
                        title: data.message
                    });
                    
                    $('#dataTable').append(
                        '<tr>'+
                            '<th scope="row"><img src="<?= base_url() ?>assets/themes/images/product/img-1.png" alt="product-img" title="product-img" class="avatar-md"></th>'+
                            '<td>'+
                                '<h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-shirt  (64GB) </a></h5>'+
                                '<p class="text-muted mb-0">'+ data.kode_buku +'</p>'+
                            '</td>'+
                            '<td style="text-align:center;">$ 450</td>'+
                            '<td style="text-align:center;">$ 450</td>'+
                            '<td style="text-align:center;">'+
                                '<a href="javascript:void(0);" onclick="deleteRow(this)" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-size-18"></i></a>'+
                            '</td>'+
                        '</tr>'
                    );
                    $("#jumlah-row").val(nextform);
                } else {
                    Swal.fire({type: 'error',title: 'Oops...',text: data.message});
                }
                
            },
            error: function(e) 
            {
                alert('Error: ' + e);
            }
        });
    }

    function deleteRow(r) {   
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Toast.fire({
                    type: 'success',
                    title: 'Berhasil'
                });
                var jumlah = parseInt($("#jumlah-row").val()); 
                var moverow = jumlah - 1; 
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("dataTable").deleteRow(i);
                $("#jumlah-row").val(moverow);

            }
        })
    }
</script>

                                   