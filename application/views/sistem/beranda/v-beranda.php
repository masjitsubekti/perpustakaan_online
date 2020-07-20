<?php 
  $id_user = $this->session->userdata('auth_id_user');
  $users =  $this->db->query("
    select * from users
    where id_user = '$id_user' 
  ");
  
  $data_user = $users->row_array();
  $foto_user = $data_user['foto'];
  $foto_url = '';
  if($foto_user!=""){
    $foto_url = base_url().'assets/data/pp_user/'.$foto_user; 
  }else{ 
    $foto_url = base_url().'assets/all/images/superadmin.png';
  }
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media">
                            <div class="mr-3">
                                <img src="<?= $foto_url ?>" alt="" class="avatar-md rounded-circle img-thumbnail">
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

