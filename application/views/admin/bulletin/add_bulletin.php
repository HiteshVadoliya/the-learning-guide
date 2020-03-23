<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'css/bootstrap-tagsinput.css' ?>">
<style type="text/css">
.dm-uploader { padding: 0; }

</style>
<section class="content-header">
   <?php
   if(isset($bulletin)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Bulletin</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Bulletin</h1>
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
      if(isset($bulletin)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Bulletin/create_update_bulletin/'.$bulletin['id'] ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Bulletin/create_update_bulletin' ?>" method="post" id="bulletinForm" enctype="multipart/form-data">
      <?php
      }
      ?>
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'bulletin') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label>Specify For</label>
                     <select class="form-control" name="type" id="type">
                        <option value="">Select Type</option>
                        <option value="1" <?php if(isset($bulletin)) { if($bulletin['type'] == 1) { echo 'selected'; } } ?>>School</option>
                        <option value="2" <?php if(isset($bulletin)) { if($bulletin['type'] == 2) { echo 'selected'; } } ?>>Teacher</option>
                        <option value="3" <?php if(isset($bulletin)) { if($bulletin['type'] == 3) { echo 'selected'; } } ?>>Both</option>
                     </select>
                  </div>
                  <div class="form-group hide" id="schools">
                     <label>School<span class="star-mend">*</span></label>
                     <select class="form-control" name="school">
                        <option value="">Select School</option>
                        <?php
                        foreach ($schools as $key => $value) {
                           $sel_school = '';
                           if(isset($bulletin)) {
                              $sel_school = ($value['id'] == $bulletin['schoolId']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo $sel_school; ?>><?php echo ucwords($value['name']); ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group hide" id="teachers">
                     <label>Teacher<span class="star-mend">*</span></label>
                     <select class="form-control" name="teacher">
                        <option value="">Select Teacher</option>
                        <?php
                        foreach ($teachers as $key => $value) {
                           $sel_teacher = '';
                           if(isset($bulletin)) {
                              $sel_teacher = ($value['id'] == $bulletin['teacherId']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo $sel_teacher; ?>><?php echo ucwords($value['fname'].' '.$value['lname']); ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Title<span class="star-mend">*</span></label>
                     <input type="text" name="title" class="form-control" placeholder="Title" value="<?php if(isset($bulletin)) { echo $bulletin['title']; } ?>">
                  </div>
                  <div class="mb-3 dm-uploader" id="image">
                     <div class="row">
                        <div class="col-md-10 col-sm-12">
                           <div class="from-group mb-2">
                              <label>Image</label>
                              <input type="text" class="form-control" aria-describedby="fileHelp" placeholder="No image uploaded..." readonly="readonly" />
                              <div class="progress mb-2 d-none">
                                 <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">0%</div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div role="button" class="btn btn-primary mr-2">
                                 <?php
                                 if(isset($bulletin)) {
                                 ?>
                                 <input type="hidden" name="old_Img" id="old_Img" value="<?php echo $bulletin['image']; ?>">
                                 <?php
                                 }
                                 ?>
                                 <input type="hidden" name="ImgFile" id="ImgFile" class="myclass">
                                 <i class="fa fa-folder-o fa-fw"></i> Browse Files
                                 <input type="file" title='Click to Select Profile Image' />
                              </div>
                              <small class="status text-muted">Select a file or drag it over this area..</small>
                           </div>
                        </div>
                        <div class="col-md-2 d-md-block d-sm-none">
                           <?php
                           if(isset($bulletin) && $bulletin['image'] != '' && file_exists(BlogPath.$bulletin['image'])) {
                           ?>
                           <img src="<?php echo base_url().BlogPath.$bulletin['image']; ?>" alt="..." class="img-thumbnail">
                           <?php
                           }
                           else {
                           ?>
                           <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="..." class="img-thumbnail">
                           <?php
                           }
                           ?>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Image Credit/Description</label>
                     <input type="text" name="image_credit" class="form-control" value="<?php if(isset($bulletin)) { echo $bulletin['image_credit']; } ?>" placeholder="Image Credit/Description">
                  </div>
                  <div class="form-group">
                     <label>Keywords/Tags:</label>
                     <input type="text" name="keyword_tags" class="form-control" placeholder="Keywords / Tags" value="<?php if(isset($bulletin)) { echo $bulletin['keyword_tags']; } ?>" data-role="tagsinput">
                  </div>

               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Description<span class="star-mend">*</span></label>
                     <textarea name="description" id="description" class="form-control"><?php if(isset($bulletin)) { echo $bulletin['description']; } ?></textarea>
                  </div>
                  <div id="bulletinImages" class="dm-uploader p-5 text-center">
                     <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Your Images here</h3>
                     <div class="btn btn-primary mb-5">
                        <span>Open the file Browser</span>
                        <input type="hidden" name="bulletinImagesFile" id="bulletinImagesFile">
                        <input type="file" name="school_logo" title='Click to add Files' />
                     </div>
                     <div class="">  
                        <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                           <li class="text-muted text-center empty">No files uploaded.</li>
                        </ul>
                     </div>
                  </div>
                  <?php
                  if(isset($bulletin)) {
                  ?>
                  <input type="hidden" name="old_bulletinImages" value="<?php echo $bulletin['images']; ?>">
                  <?php
                     if($bulletin['images'] != '') {
                        $bulletinImages = json_decode($bulletin['images'],true);
                        ?>
                        <div class="row">
                        <?php
                        foreach ($bulletinImages as $img_key => $image) {
                           if(file_exists(BlogPath.$image)) {
                           ?>
                           <div class="col-md-3">
                              <img src="<?php echo ASSETPATH.'uploads/image/blog/'.$image; ?>" class="img img-responsive" alt="Photos" height="50px">
                           </div>
                           <?php
                           }
                        }
                        ?>
                        </div>
                     <?php
                     }
                  }
                  ?>

               </div>
               
            </div><!-- row -->
            
         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(isset($bulletin)) { echo 'Modify'; }else { echo 'save'; } ?></button>
            <a href="<?= base_url(ADMIN.'manage-bulletin') ?>" class="btn btn-danger pull-right">Cancel</a>
         </div><!-- /.box footer-->
      </form>
   </div><!-- /.box -->
</section>

<script src="<?php echo ASSETPATH ?>plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?= ADMINPATH.'fileupload/js/jquery.dm-uploader.js'; ?>"></script>
<script src="<?= ADMINPATH.'fileupload/js/file_upload.js'; ?>"></script>
<script src="<?= ADMINPATH.'js/bootstrap-tagsinput.min.js'; ?>"></script>

<script type="text/javascript">
    
$(document).ready(function() {
   
   $('#description').ckeditor();

   $("#bulletinForm").validate({
      ignore: [],
      rules: {
         /*type: {
            required: true
         },*/
         school: {
            // required: $('#type').val() == 1
            required: function(element) {
               return $('#type').val() == 1
            }
         },
         teacher: {
            // required: $('#type').val() == 2
            required: function(element) {
               return $('#type').val() == 2
            }
         },
         title: {
            required: true
         },
         about: {
            required: true
         },
         <?php
         if(!isset($bulletin)) {
            ?>
            ImgFile: {
               required: true,
            }
            <?php
         }
         ?>
         
      },
      messages: {
         title: {
            required: 'Please Select Title'
         },
         type: {
            required: 'Please Select Type'
         },
         school: {
            required: 'Please Select School'
         },
         teacher: {
            required: 'Please Select Teacher'
         },
         about: {
            required: 'Please Enter About Teacher'
         }
      },
      errorElement: "span",
      errorPlacement: function ( error, element ) {
         // Add the `help-block` class to the error element
         error.addClass("text-danger");
         if (element.prop( "type" ) === "checkbox") {
            error.insertAfter(element.parent( "label") );
         } else if(element.hasClass("phone")){
            error.insertAfter(element.parent(".input-group"));
         } else if(element.hasClass("myclass")){
            error.insertAfter(element.parent().parent());
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
   
   /**/
   $('#type').on('change',function() {
      $('.error').hide();
      let value = $(this).val();
      var type,typeReverse;
      if(value == 1) {
         type = 'schools';
         typeReverse = 'teachers';
         $('#'+type).removeClass('hide');
         $('#'+typeReverse).addClass('hide');
      }
      else if(value == 2)  {
         type = 'teachers';
         typeReverse = 'schools';
         $('#'+type).removeClass('hide');
         $('#'+typeReverse).addClass('hide');
      } else if(value == 3)  {
         type = 'teachers';
         typeReverse = 'schools';
         $('#'+type).removeClass('hide');
         $('#'+typeReverse).removeClass('hide');
      }
      else {
         $('#schools').addClass('hide');
         $('#teachers').addClass('hide');
      }
   });
   /**/

   <?php
   if(isset($bulletin)) {
   ?>
   setTimeout(function() {
      $('#type').change();
   },500);
   <?php
   }
   ?>

});

</script>

<script type="text/javascript">
$(function(){

   /* Image */
   $('#image').dmUploader({ //
      url: '<?= base_url(ADMIN.'Bulletin/upload_files'); ?>',
      maxFileSize: 100000000, // 3 Megs max
      multiple: false,
      allowedTypes: 'image/*',
      content: 'application/json',
      extFilter: ['jpg','jpeg','png'],
      onDragEnter: function(){
         // Happens when dragging something over the DnD area
         this.addClass('active');
      },
      onDragLeave: function(){
         // Happens when dragging something OUT of the DnD area
         this.removeClass('active');
      },
      onInit: function(){
         // Plugin is ready to use
         ui_add_log('Penguin initialized :)', 'info');
         //this.find('input[type="text"]').val('');
      },
      onComplete: function(){
         // All files in the queue are processed (success or error)
         ui_add_log('All pending tranfers finished');
      },
      onNewFile: function(id, file){
         // When a new file is added using the file selector or the DnD area
         ui_add_log('New file added #' + id);
         if (typeof FileReader !== "undefined"){
            var reader = new FileReader();
            var img = this.find('img');
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
         }
         ui_multi_add_file(id, file, this);
      },
      onBeforeUpload: function(id){
         // about tho start uploading a file
         ui_add_log('Starting the upload of #' + id);
         /*ui_single_update_progress(this, 0, true);      
         ui_single_update_active(this, true);
         ui_single_update_status(this, 'Uploading...');*/
         ui_multi_update_file_progress(id, 0, '', true);
         ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      },
      onUploadProgress: function(id, percent){
         // Updating file progress
         /*ui_single_update_progress(this, percent);*/
         ui_multi_update_file_progress(id, percent);
      },
      onUploadSuccess: function(id, data) {
         $(id).find('.status').html('');
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         /*let resumeVal = $('#resumeFile').val();
         let newArr = [];
         if(resumeVal != '') {
            // console.log(resumeVal);
            newArr = jQuery.parseJSON(resumeVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);*/
         // $('#resumeFile').val(newArr);
         $('#ImgFile').val(customData.path);
         $('#ImgFile-error').hide();

         // $('.brochure').val(customData.path);
         /*ui_single_update_status(this, 'Upload completed.', 'success');*/
         ui_multi_update_file_status(id, 'success', 'Upload Complete');
         ui_multi_update_file_progress(id, 100, 'success', false);
      },
      onUploadError: function(id, xhr, status, message){
         // Happens when an upload error happens
         /*ui_single_update_active(this, false);
         ui_single_update_status(this, 'Error: ' + message, 'danger');*/
         ui_multi_update_file_status(id, 'danger', message);
         ui_multi_update_file_progress(id, 0, 'danger', false);
      },
      onFallbackMode: function(){
         // When the browser doesn't support this plugin :(
         ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
      },
      onFileSizeError: function(file){
         ui_single_update_status(this, 'File excess the size limit', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      },
      onFileTypeError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

   $('#bulletinImages').dmUploader({ //
      url: '<?= base_url(ADMIN.'Bulletin/upload_files'); ?>',
      maxFileSize: 30000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'image/*',
      content: 'application/json',
      extFilter: ['jpg','png','jpeg'],
      onDragEnter: function(){
         // Happens when dragging something over the DnD area
         this.addClass('active');
      },
      onDragLeave: function(){
         // Happens when dragging something OUT of the DnD area
         this.removeClass('active');
      },
      onInit: function(){
         // Plugin is ready to use
         ui_add_log('Penguin initialized :)', 'info');
         //this.find('input[type="text"]').val('');
      },
      onComplete: function(){
         // All files in the queue are processed (success or error)
         ui_add_log('All pending tranfers finished');
      },
      onNewFile: function(id, file){
         // When a new file is added using the file selector or the DnD area
         ui_add_log('New file added #' + id);
         if (typeof FileReader !== "undefined"){
            var reader = new FileReader();
            var img = this.find('img');
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
         }
         ui_multi_add_file(id, file, this);
      },
      onBeforeUpload: function(id){
         // about tho start uploading a file
         ui_add_log('Starting the upload of #' + id);
         /*ui_single_update_progress(this, 0, true);      
         ui_single_update_active(this, true);
         ui_single_update_status(this, 'Uploading...');*/
         ui_multi_update_file_progress(id, 0, '', true);
         ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      },
      onUploadProgress: function(id, percent){
         // Updating file progress
         /*ui_single_update_progress(this, percent);*/
         ui_multi_update_file_progress(id, percent);
      },
      onUploadSuccess: function(id, data) {
         $(id).find('.status').html('');
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         let bulletinImagesVal = $('#bulletinImagesFile').val();
         let newArr = [];
         if(bulletinImagesVal != '') {
            // console.log(bulletinImagesVal);
            newArr = jQuery.parseJSON(bulletinImagesVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#bulletinImagesFile').val(newArr);
         /*ui_single_update_status(this, 'Upload completed.', 'success');*/
         ui_multi_update_file_status(id, 'success', 'Upload Complete');
         ui_multi_update_file_progress(id, 100, 'success', false);
      },
      onUploadError: function(id, xhr, status, message){
         // Happens when an upload error happens
         /*ui_single_update_active(this, false);
         ui_single_update_status(this, 'Error: ' + message, 'danger');*/
         ui_multi_update_file_status(id, 'danger', message);
         ui_multi_update_file_progress(id, 0, 'danger', false);
      },
      onFallbackMode: function(){
         // When the browser doesn't support this plugin :(
         ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
      },
      onFileSizeError: function(file){
         ui_single_update_status(this, 'File excess the size limit', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      },
      onFileTypeError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

});
</script>
<!-- File item template -->
<script type="text/html" id="files-template">
   <li class="media">
      <hr class="mt-1 mb-1" />
      <div class="media-body mb-1">
         <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
         </p>
         <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
      </div>
   </li>
</script>