<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<section class="content-header">
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Contact</h1>
</section>
<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box box-info">
      <form role="form" action="<?= ADMIN_LINK.'Contact/create_update_contact_details' ?>" method="post" id="languageForm" enctype="multipart/form-data">
         <?php /* ?><div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'contact') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div><?php */ ?>
         <div class="box-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label>Address</label>
                     <input type="text" name="address" class="form-control" placeholder="Address" value="<?php if(!empty($contact_details)) { echo $contact_details['address']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Email</label>
                     <input type="text" name="email" class="form-control" placeholder="Email" value="<?php if(!empty($contact_details)) { echo $contact_details['email']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Phone</label>
                     <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php if(!empty($contact_details)) { echo $contact_details['phone']; } ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  
               </div>
               
            </div><!-- row -->
            
         </div><!-- /.box-body -->
         <div class="box-footer">
            <input type="hidden" name="action" value="<?php if(!empty($contact_details)) { echo 'edit'; } else { echo 'add'; } ?>">
            <button type="submit" class="btn btn-primary"><?php if(isset($language)) { echo 'Modify'; }else { echo 'save'; } ?></button>
            <a href="<?= base_url(ADMIN.'manage-language') ?>" class="btn btn-danger pull-right">Cancel</a>
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
   
   $('#about').ckeditor();

   $("#languageForm").validate({
      rules: {
         language: { required: true }
      },
      messages: {
         language: { required: "Please Enter Language" } 
      },
      errorElement: "span",
      errorPlacement: function ( error, element ) {
         // Add the `help-block` class to the error element
         error.addClass("text-danger");
         if (element.prop( "type" ) === "checkbox") {
            error.insertAfter(element.parent( "label") );
         } else if(element.hasClass("phone")){
            error.insertAfter(element.parent(".input-group"));
         } else if(element.hasClass("funding")){
            error.insertAfter(element);
         } else if (element.prop( "type" ) === "file") {
            // error.insertAfter(element.parent());
            element.parent().parent().append(error);
         } else {
            error.insertAfter(element.parent());
         }
      },
      highlight: function ( element, errorClass, validClass ) {
         //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
      },
      unhighlight: function (element, errorClass, validClass) {
         //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
      }
   });

});

</script>