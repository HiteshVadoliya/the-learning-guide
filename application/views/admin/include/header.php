<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php $img = $this->common->get_one_row('tblsetting',array('SettingKey'=>'Admin_Title') ); echo $img['SettingValue']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?= ADMINPATH.'css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/_all-skins.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/blue.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/jquery-jvectormap-1.2.2.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/bootstrap3-wysihtml5.min.css'; ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/dataTables.bootstrap.css'; ?>">
  <!-- custom css -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/custom.css'; ?>">
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

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url(ADMIN) ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">ML<!-- <img src="<?= base_url(LOGOPATH.'admin-logo-mini.png') ?>" alt=""> --><!-- <b>T</b>A --></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      <img src="<?= LOGOPATH.getSiteSetting('Admin_Logo'); ?>" alt="" style="max-width: 80px; max-height: 40px;">
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-user"></i>
              <span class="hidden-xs"><?= $this->session->ADMS['AName'] ?><i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="height:auto !important; ">
                <p> <?= $this->session->ADMS['AName'] ?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php /* ?><a href="<?= base_url(ADMIN.'Profile') ?>" class="btn btn-default btn-flat">Profile</a> <?php */ ?>
                  <a href="<?= base_url() ?>" target="_blank" class="btn btn-default btn-flat" style="margin-left: 18px;">Visit Site</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url(ADMIN.'Login/Logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
 <!-- Menu Bar Start-->
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?= $this->general->active_class('Home') ?>">
          <a href="<?= base_url(ADMIN) ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?= $this->general->active_class('') ?>">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>School</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(isset($ActiveMenu) && $ActiveMenu == ''){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-school') ?>"><i class="fa fa-angle-double-right"></i>Manage School</a></li>
            <li <?php if(isset($ActiveMenu) && $ActiveMenu == ''){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'add-school') ?>"><i class="fa fa-angle-double-right"></i> Add School</a></li>
          </ul>
        </li>
        <li class="treeview <?= $this->general->active_class('Configuration') ?>">
          <a href="#">
            <i class="fa fa-th"></i> <span>Website Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Setting'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'Configuration/setting') ?>"><i class="fa fa-angle-double-right"></i>Manage Website Identity</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 <!-- Menu Bar End-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">