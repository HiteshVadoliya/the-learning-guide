<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<style type="text/css">
.dm-uploader { padding: 0; }

</style>
<section class="content-header">
   <?php
   if(!empty($social_media)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Social Media</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Social Media</h1>
   <?php
   }
   ?>
</section>
<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box box-info">
      <?php
      if(!empty($social_media)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_social_media/'.$social_media['id'] ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_social_media' ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      ?>
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN) ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-6">
                  <?php $this->load->view(ADMIN.'includes/message'); ?>
                  <div class="form-group">
                     <label>Facebook</label>
                     <input type="text" name="facebook" class="form-control" value="<?php if(!empty($social_media)) { echo $social_media['facebook']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Instagram</label>
                     <input type="text" name="instagram" class="form-control" value="<?php if(!empty($social_media)) { echo $social_media['instagram']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Linkedin</label>
                     <input type="text" name="linkedin" class="form-control" value="<?php if(!empty($social_media)) { echo $social_media['linkedin']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Youtube</label>
                     <input type="text" name="youtube" class="form-control" value="<?php if(!empty($social_media)) { echo $social_media['youtube']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Twitter</label>
                     <input type="text" name="twitter" class="form-control" value="<?php if(!empty($social_media)) { echo $social_media['twitter']; } ?>">
                  </div>

               </div>
               
            </div><!-- row -->
            
         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(!empty($social_media)) { echo 'Modify'; }else { echo 'save'; } ?></button>
            <a href="<?= base_url(ADMIN) ?>" class="btn btn-danger pull-right">Cancel</a>
         </div><!-- /.box footer-->
      </form>
   </div><!-- /.box -->
</section>

<script src="<?php echo ASSETPATH ?>plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?= ADMINPATH.'fileupload/js/jquery.dm-uploader.js'; ?>"></script>
<script src="<?= ADMINPATH.'fileupload/js/file_upload.js'; ?>"></script>

<script type="text/javascript">
    
$(document).ready(function() {
   
   $('#description').ckeditor();

});

</script>