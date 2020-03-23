<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<style type="text/css">
.dm-uploader { padding: 0; }

</style>
<section class="content-header">
   <?php
   if(!empty($terms)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Terms</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Terms</h1>
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
      if(!empty($terms)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_terms/'.$terms['id'] ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_terms' ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
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
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Page Heading<span class="star-mend">*</span></label>
                     <input type="text" name="title" id="title" class="form-control" value="<?php if(isset($terms)) { echo $terms['title']; } ?>">
                  </div>
               </div>
               
               <div class="col-md-12">
                     <div class="form-group">
                        <label>Footer Heading</label>
                        <input type="text" name="footer_heading" id="footer_heading" class="form-control" value="<?php if(isset($terms)) { echo $terms['footer_heading']; } ?>">
                     </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label>Description<span class="star-mend">*</span></label>
                     <textarea name="description" id="description" class="form-control"><?php if(isset($terms)) { echo $terms['description']; } ?></textarea>
                  </div>

               </div>
               
            </div><!-- row -->
            
         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(!empty($terms)) { echo 'Modify'; }else { echo 'save'; } ?></button>
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