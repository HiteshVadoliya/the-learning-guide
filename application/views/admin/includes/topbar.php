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