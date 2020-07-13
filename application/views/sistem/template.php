<!DOCTYPE html>
<html lang="en">
<head>       
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Subekti Devcode" name="Abdul Masjit Subekti" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/data/aplikasi/'.$app['favicon'])?>">
    <!-- CSS -->
    <?php include('theme_css.php') ?>
    <!-- rgba(0, 0, 0, 0.5); -->
</head>
<body data-sidebar="dark">
    <!-- Loader -->
    <div id="div_dimscreen" class="dimScreen" style="display:none;">
      <div class="lds-ripple"><div></div><div></div></div>
    </div>
    <!-- Begin page -->
    <div id="layout-wrapper">

    <!-- HEADER -->
    <?php include('theme_header.php') ?>    
        
    <!-- SIDEBAR -->
    <?php include('theme_sidebar.php') ?>     
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- BREADCRUMB -->
                    <?php include('theme_breadcrumb.php') ?>

                    <!-- CONTENT -->
                    <?php include($content) ?>                
                </div>
            </div>
    
        <!-- MODAL -->
        <?php include('modal.php') ?>    
        
        <!-- FOOTER -->
        <?php include('theme_footer.php') ?>
        </div>
    </div>

    <!-- RIGHT SIDEBAR -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <?php include('theme_js.php') ?>
</body>
</html>