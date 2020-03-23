<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo FRONTENDPATH ?>images/favicon.png" type="images/favicon.png" sizes="16x16">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/font-awesome.min.css' ?>">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/_all-skins.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/blue.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/jquery-jvectormap-1.2.2.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/bootstrap3-wysihtml5.min.css'; ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/dataTables.bootstrap.css'; ?>">
  <link href="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">
  <!-- custom css -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/custom.css?i='.time(); ?>">
  <style type="text/css">
    img {  
      position: relative;
    }

    img:after {  
      content: "\f1c5" " " attr(alt);
      font-family: FontAwesome;
      display: block;
      position: absolute;
      z-index: 2;
      top: 0;
      left: 0;
      width: 100%;
      height: auto;
      background-color: #fff;
    }
    </style>
    <script src="<?= ADMINPATH.'js/jquery-2.2.3.min.js'; ?>"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Loader all pages-->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper">
            
            <?php echo $topbar; ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $leftbar; ?>
            
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content-wrapper">
                    <!-- Start content -->
                    <?php echo $content_body ?>
                    <!-- content -->
                </div>

                <?php echo  $footer; ?>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

            <!-- Right Sidebar -->
            <?php echo  $rightbar; ?>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->

        <div class="control-sidebar-bg"></div>
    </div><!-- /.wrapper -->

    <!-- jQuery 2.2.3 -->
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <script src="<?= ADMINPATH.'js/bootstrap.min.js'; ?>"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <script src="<?= ADMINPATH.'js/jquery.sparkline.min.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/jquery-jvectormap-1.2.2.min.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/jquery-jvectormap-world-mill-en.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/jquery.knob.js'; ?>"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
    <script src="<?= ADMINPATH.'js/bootstrap3-wysihtml5.all.min.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/jquery.slimscroll.min.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/fastclick.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/app.min.js'; ?>"></script>
    <!-- Sweet-Alert  -->
    <script src="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/jquery.sweet-alert.init.js"></script>

    <script src="<?= ADMINPATH.'js/demo.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/custom.js'; ?>"></script>
    <!-- CK Editor -->
    <script src="<?= ADMINPATH.'plugins/ckeditor/ckeditor.js'; ?>"></script>
    <script src="<?= ADMINPATH.'plugins/ckeditor/adapters/jquery.js'; ?>"></script>

    <!-- DataTables -->
    <script src="<?= ADMINPATH.'js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?= ADMINPATH.'js/dataTables.bootstrap.min.js'; ?>"></script>
    <!-- Custom Validation -->
    <script src="<?= ADMINPATH.'plugins/validation/validate.js'; ?>"></script>
    </body>
    </html>
    <script type="text/javascript">
    var baseurl = '<?= base_url(ADMIN) ?>';
      function myconfirm(a) {
        var r = confirm("Are You Sure Want To Delete ?!");
        if (r == true) {
          return true;
        } else {
          return false;
        }
      }
      $(document).ready(function() {
         
      });
    </script>

</body>
</html>