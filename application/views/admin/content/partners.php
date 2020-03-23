<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<style type="text/css">
.dm-uploader { padding: 0; }

</style>
<section class="content-header">
   <?php
   if(!empty($cms)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Partners</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Partners</h1>
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
      if(!empty($cms)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_partners/'.$cms['id'] ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Content/create_update_partners' ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
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
                     <!-- <label>Yeronga Uniforms<span class="star-mend">*</span></label> -->
                     <div id="sel-none">
                       <div class="form-group">
                         <label>Partners</label>
                         <?php
                         if(isset($cms['id'])) {
                           $option_data = json_decode($cms['title'], true);
                           $option = $option_data['option'];
                           $optvalue = $option_data['optvalue'];
                           foreach ($option as $key => $value) {
                           ?>
                           <div class="row <?php echo ($key == 0) ? 'after-add-more' : 'control-group' ?>">
                             <div class="col-lg-6">
                               <div class="form-group">
                                 <input type="text" name="option[]" value="<?= $value ?>" class="form-control" placeholder="Title">
                               </div>
                             </div>
                             <div class="col-lg-5">
                               <div class="form-group">
                                 <input type="text" name="optvalue[]" value="<?php if(isset($optvalue[$key])) { echo $optvalue[$key]; } ?>" class="form-control" placeholder="Link">
                               </div>
                             </div>
                             <div class="col-lg-1">
                               <?php
                               if($key == 0) {
                               ?>
                               <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
                               <?php
                               }
                               else {
                               ?>
                               <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
                               <?php
                               }
                               ?>
                             </div>
                           </div>
                           <?php
                           }
                         }
                         else {
                         ?>
                         <div class="row after-add-more">
                           <div class="col-lg-6">
                             <div class="form-group">
                               <input type="text" name="option[]" class="form-control" placeholder="Title">
                             </div>
                           </div>
                           <div class="col-lg-5">
                             <div class="form-group">
                               <input type="text" name="optvalue[]" class="form-control" placeholder="Link">
                             </div>
                           </div>
                           <div class="col-lg-1">
                             <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
                           </div>
                         </div>
                         <?php
                         }
                         ?>


                         <!-- Copy Elements -->
                         <div class="copy-fields hide">
                           <div class="row control-group">
                             <div class="col-lg-6">
                               <div class="form-group">
                                 <input type="text" name="option[]" class="form-control" placeholder="Title">
                               </div>
                             </div>
                             <div class="col-lg-5">
                               <div class="form-group">
                                 <input type="text" name="optvalue[]" class="form-control" placeholder="Link">
                               </div>
                             </div>
                             <div class="col-lg-1">
                               <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
                             </div>
                           </div>
                         </div>            
                       </div>
                      <!--  <div class="form-group">
                         <label>Display Option</label>
                         <select name="display" class="form-control">
                           <option value="">Select Option</option>
                           <option value="1" <?php if(isset($cms['id'])) { if($cms['display'] == 1) { echo 'selected'; } } ?>>Paragraph</option>
                           <option value="2" <?php if(isset($cms['id'])) { if($cms['display'] == 2) { echo 'selected'; } } ?>>Image</option>
                         </select>
                       </div> -->
                     </div>
                  </div>
               </div>
               <?php /*
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Yeronga Uniforms<span class="star-mend">*</span></label>
                     <input type="text" name="title" id="title" class="form-control" value="<?php if(isset($cms)) { echo $cms['title']; } ?>">
                  </div>
               </div>
               
               <div class="col-md-12">
                     <div class="form-group">
                        <label>Docustudy ®</label>
                        <input type="text" name="footer_heading" id="footer_heading" class="form-control" value="<?php if(isset($cms)) { echo $cms['footer_heading']; } ?>">
                     </div>
               </div>
               */ ?>

               <!-- <div class="col-md-6">
                  <div class="form-group">
                     <label>Description<span class="star-mend">*</span></label>
                     <textarea name="description" id="description" class="form-control"><?php if(isset($cms)) { echo $cms['description']; } ?></textarea>
                  </div>

               </div>
                -->
            </div><!-- row -->
            
         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(!empty($cms)) { echo 'Modify'; }else { echo 'save'; } ?></button>
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

   $(".add-more").click(function(){ 
       var html = $(".copy-fields").html();
       $(".after-add-more").parent().append(html);
   });

   $("body").on("click",".remove",function(){ 
       $(this).parents(".control-group").remove();
   });

});

</script>