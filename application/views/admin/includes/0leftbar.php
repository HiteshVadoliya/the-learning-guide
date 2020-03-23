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
         <li class="treeview <?php if(isset($ActiveMenu) && ($ActiveMenu == 'Manage School' || $ActiveMenu == 'Add School')) { echo 'active'; } ?>">
            <a href="javascript:void(0);">
               <i class="fa fa-university"></i> <span>School</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage School'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-school') ?>"><i class="fa fa-angle-double-right"></i>Manage School</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Add School'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'add-school') ?>"><i class="fa fa-angle-double-right"></i> Add School</a></li>
            </ul>
         </li>
         <li class="treeview <?php if(isset($ActiveMenu) && ($ActiveMenu == 'Manage Teacher' || $ActiveMenu == 'Add Teacher')) { echo 'active'; } ?>">
            <a href="javascript:void(0);">
               <i class="fa fa-user"></i> <span>Teacher</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Teacher'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-teacher') ?>"><i class="fa fa-angle-double-right"></i>Manage Teacher</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Add Teacher'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'add-teacher') ?>"><i class="fa fa-angle-double-right"></i> Add Teacher</a></li>
            </ul>
         </li>

        
         <li class="treeview <?php if(isset($ActiveMenu) && ($ActiveMenu == 'Manage Bulletin' || $ActiveMenu == 'Add Bulletin')) { echo 'active'; } ?>">
            <a href="javascript:void(0);">
               <i class="fa fa-product-hunt"></i> <span>Bulletin</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Bulletin'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-bulletin') ?>"><i class="fa fa-angle-double-right"></i>Manage Bulletin</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Add Bulletin'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'add-bulletin') ?>"><i class="fa fa-angle-double-right"></i> Add Bulletin</a></li>
            </ul>
         </li>

         <li class="treeview <?php if(isset($ActiveMenu) && ($ActiveMenu == 'Manage Calendar' || $ActiveMenu == 'Add Calendar')) { echo 'active'; } ?>">
            <a href="javascript:void(0);">
               <i class="fa fa-calendar"></i> <span>Calendar</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Calendar'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-calendar') ?>"><i class="fa fa-angle-double-right"></i>Manage Calendar</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Add Calendar'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'add-calendar') ?>"><i class="fa fa-angle-double-right"></i> Add Calendar</a></li>
            </ul>
         </li>


         
         <!-- <li class="treeview <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Calendar'){ echo 'active'; } ?>">
            <a href="<?= base_url(ADMIN.'manage-calendar') ?>">
               <i class="fa fa-calendar"></i> <span>Calendar</span>
            </a>
         </li> -->

         <li class="treeview <?php if(isset($ActiveMenu) && $ActiveMenu == 'users'){ echo 'active'; } ?>">
            <a href="<?= base_url(ADMIN.'users') ?>">
               <i class="fa fa-users"></i> <span>Users</span>
            </a>
         </li>
         <li class="treeview <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage-contact'){ echo 'class="active"'; } ?>">
            <a href="<?= base_url(ADMIN.'contact') ?>">
               <i class="fa fa-envelope"></i> <span>Contact</span>
            </a>
         </li>
         <li class="treeview <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Newsletter'){ echo 'class="active"'; } ?>">
            <a href="<?= base_url(ADMIN.'newsletter') ?>">
               <i class="fa fa-envelope"></i> <span>Newsletter</span>
            </a>
         </li>
         <li class="treeview <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Social Media'){ echo 'class="active"'; } ?>">
            <a href="<?= base_url(ADMIN.'social-media') ?>">
               <i class="fa fa-globe"></i> <span>Social Media</span>
            </a>
         </li>
         <li class="treeview <?php if(isset($ActiveMenu) && ($ActiveMenu == 'Manage Terms' || $ActiveMenu == 'Manage Privacy' || $ActiveMenu == 'Manage Content Policy' || $ActiveMenu == 'Manage Paid Content Partnerships' || $ActiveMenu == 'Manage Legal')) { echo 'active'; } ?>">
            <a href="javascript:void(0);">
               <i class="fa fa-product-hunt"></i> <span>Content Pages</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Terms'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-terms') ?>"><i class="fa fa-angle-double-right"></i>Terms & Condition</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Privacy'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-privacy') ?>"><i class="fa fa-angle-double-right"></i>Privacy policy</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Content Policy'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-content-policy') ?>"><i class="fa fa-angle-double-right"></i>Content & Integrity policy</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Paid Content Partnerships'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-paid-content-partnerships') ?>"><i class="fa fa-angle-double-right"></i>Paid Content Partnerships</a></li>
               <li <?php if(isset($ActiveMenu) && $ActiveMenu == 'Manage Legal'){ echo 'class="active"'; } ?>><a href="<?= base_url(ADMIN.'manage-legal') ?>"><i class="fa fa-angle-double-right"></i>Legal</a></li>
            </ul>
         </li>
         <li class="treeview <?= $this->general->active_class('Configuration') ?>">
            <a href="javascript:void(0);">
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