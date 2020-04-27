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
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>