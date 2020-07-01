<?php 
  $role =  $this->session->userdata('auth_id_role');
  $id_user = $this->session->userdata('auth_id_user');
	$menu1 = $this->db->query("
						select m.* from c_menu_user mu
						    join c_menu m on mu.id_menu = m.id_menu
                        where 
                            mu.id_roles = '$role' 
                            and mu.id_posisi= '1' and  level = 1 
						order by mu.urutan asc"
          );
  $users =  $this->db->query("
            select * from users
            where id_user = '$id_user' "
          );
?>

<div class="vertical-menu">
<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <?php
            foreach ($menu1->result() as $m1) {
                $id_menu_level_1 = $m1->id_menu;
                $menu2 = $this->db->query("
                                            select m.* from c_menu_user mu
                                                join c_menu m on mu.id_menu = m.id_menu
                                            where mu.id_roles = '$role' and mu.id_posisi = '1' 
                                                and level = 2 
                                                and id_parent_menu = '$id_menu_level_1' 
                                            order by mu.urutan asc"
                                        );
                $jml_menu2 = $menu2->num_rows();
                if($jml_menu2!=0){ ?>
                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="<?=$m1->class_icon?>"></i>
                            <span><?=$m1->nama_menu?></span>
                        </a>
                        <ul class="sub-menu">
                            <?php foreach ($menu2->result() as $m2) { ?>					
                                
                                <li><a href="<?= site_url($m2->link_menu)?>"><?=$m2->nama_menu?></a></li>
                        
                            <?php } ?>
                        </ul>
                    </li>

                <?php }else{ ?>

                    <li>
                        <a href="<?= site_url($m1->link_menu)?>" class=" waves-effect">
                            <i class="<?=$m1->class_icon?>"></i>
                            <span><?=$m1->nama_menu?></span>
                        </a>
                    </li>

                <?php }} ?>
                <li>
                    <a href="javascript:;"  onclick="logout_menu()" class=" waves-effect">
                        <i class="bx bx-log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
<script>
  function logout_menu() {
    Swal.fire({
        title: 'Keluar dari Sistem ?',
        text: "Apakah Anda yakin keluar dari sistem !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                axios.post('<?= site_url() ?>'+'/Auth/logout')
                .then((response) => {
                    // success callback
                    setTimeout(function(){
                        if(response.data.success===true){
                            Swal.fire('Berhasil',response.data.message,'success');
                            swal.hideLoading()
                            setTimeout(function(){ 
                              window.location.href = '<?= site_url() ?>' + response.data.page;
                            }, 1000);
                        }else{
                            Swal.fire({type: 'error',title: 'Oops...',text: response.data.message});
                        }   
                    }, 1000);
                }, (response) => {
                    // error callback
                    Swal.fire({type: 'error',title: 'Oops...',text: 'error...'});
                });
            });
        },
        allowOutsideClick: false
    });
}
</script>