<!DOCTYPE html>
<html lang="en">
<head>       
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Subekti Devcode" name="Abdul Masjit Subekti" />
    <!-- CSS -->
    <?php include('theme_css.php') ?>
</head>
<body data-sidebar="dark">
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
                    
                </div>
            </div>
    
        <!-- MODAL -->
        <?php include('modal.php') ?>    
        
        <!-- FOOTER -->
        <?php include('theme_footer.php') ?>
        </div>
    </div>

    <!-- RIGHT SIDEBAR -->
    <?php include('theme_right_sidebar.php') ?>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <?php include('theme_js.php') ?>
</body>
</html>