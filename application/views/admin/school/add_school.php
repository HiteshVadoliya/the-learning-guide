<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<section class="content-header">
   <?php
   if(isset($school)) {
   ?>
   <h1><i class="fa fa-pencil"></i>&nbsp;Edit School</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add School</h1>
   <?php
   }
   ?>
</section>
<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box box-info">
      
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'manage-school') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <?php 
         $active_tab_1 = "in active";
         $active_tab_2 = "";
         $active_tab_3 = "";
         $active_tab_4 = "";
         if(isset($school)) { 
            $active_tab_1 = ($school['school_type'] == 1 ) ? 'in active' : '';
            $active_tab_2 = ($school['school_type'] == 2 ) ? 'in active' : '';
            $active_tab_3 = ($school['school_type'] == 3 ) ? 'in active' : '';
            $active_tab_4 = ($school['school_type'] == 4 ) ? 'in active' : '';
         } ?>
         <ul class="nav nav-pills">
             <li class="<?= $active_tab_1 ?>"><a data-toggle="pill" href="#home">General</a></li>
             <li class="<?= $active_tab_2 ?>"><a data-toggle="pill" href="#menu1">Primary and Secondary</a></li>
             <li class="<?= $active_tab_3 ?>"><a data-toggle="pill" href="#menu2">Special Needs</a></li>
             <li class="<?= $active_tab_4 ?>"><a data-toggle="pill" href="#menu3">Tertiary</a></li>
           </ul>
           <div class="tab-content">
             <div id="home" class="tab-pane fade <?= $active_tab_1 ?>">
               <!-- <h3>General</h3> -->
               <?php echo $add_general_school; ?>
             </div>
             <div id="menu1" class="tab-pane fade <?= $active_tab_2 ?>">
               <!-- <h3>Primary and Secondary</h3> -->
               <?php echo $add_primary_secoundary_school; ?>
             </div>
             <div id="menu2" class="tab-pane fade <?= $active_tab_3 ?>">
               <!-- <h3>Special Needs</h3> -->
               <?php echo $add_special_need_school; ?>
             </div>
             <div id="menu3" class="tab-pane fade <?= $active_tab_4 ?>">
               <!-- <h3>Tertiary</h3> -->
               <?php echo $add_tertiary_school; ?>
             </div>
           </div>


   </div><!-- /.box -->
</section>

<script src="<?php echo ASSETPATH ?>plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?php echo F_JSPATH ?>custom.js"></script>

<script src="<?= ADMINPATH.'fileupload/js/jquery.dm-uploader.js'; ?>"></script>
<script src="<?= ADMINPATH.'fileupload/js/file_upload.js'; ?>"></script>

<script type="text/javascript">
    
$(document).ready(function() {
   
   $('.about_class').ckeditor();

   $('.phone').on('blur', function() {
      $('.phone').val(function(i, text) {
         return text.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3');
      });
   });

   $('.mobile').on('blur', function() {
      $('.mobile').val(function(i, text) {
         return text.replace(/(\d{4})(\d{3})(\d{3})/, '$1 $2 $3');
      });
   });

   $('.corporate_no').on('blur', function() {
      $('.corporate_no').val(function(i, text) {
         return text.replace(/(\d{2})(\d{2})(\d{2})/, '$1 $2 $3');
      });
   });

   $('.business_no').on('blur', function() {
      $('.business_no').val(function(i, text) {
         return text.replace(/(\d{4})(\d{3})(\d{2})/, '$1 $2 $3');
      });
   });

   /**/
   /*$('#special_needs_support').on('change', function() {
      let need_support = $(this).val();
      if(need_support == 1) {
         $('#cricos_number').removeClass('hide');
      }
      else {
         $('#cricos_number').find('input[name="cricos_number"]').val('');
         $('#cricos_number').addClass('hide');
      }
   });*/

   $('.multi_type').on('change',function() {
      let values = $(this).val();
      console.log(values);
      if($.inArray('tertiary', values) > -1 || $.inArray('tertiary', values) > -1){
         $('.sector').show();
         return true;
      }
      else {
         $('.sector').hide();
         return false;
      }

      if($.inArray('primary', values) > -1 || $.inArray('secondary', values) > -1){
         $('.sector').show();
      }
      else {
         $('.sector').hide();
      }
      if ($.inArray('secondary', values) > -1) {
         $('#international_baccalaureate_div').show();
      }
      else {
         $('#international_baccalaureate_div').hide();
      }
   });

   $('.multiselect-ui').multiselect({
      includeSelectAllOption: true,
      onChange: function(element, checked) {
         let selectArr = ["tafe","college","university"];
         let value = element[0].value;
         if(jQuery.inArray(value, selectArr) !== -1) {
            $(".multiselect-ui option[value='tertiary']").prop("selected", true);
            $('.multiselect-ui').multiselect('refresh');
         }
         
         /**/
         if(value == 'tertiary') {
            if(checked == false) {
               $(selectArr).each(function(k,v) {
                  $(".multiselect-ui option[value='"+v+"']").prop("selected", false);
                  $('.multiselect-ui').multiselect('refresh');
               });
            }
         }
         /**/
      }
   });

   $('.internation_students_class').on('change', function() {
      let need_support = $(this).val();
      if(need_support == 1) {
         // $('#cricos_number').removeClass('hide');
         $('.cricos_number_class').show();
      }
      else {
         $('.cricos_number_class').find('input[name="cricos_number"]').val('');
         // $('#cricos_number').addClass('hide');
         $('.cricos_number_class').hide();
      }
   });

   $('.fees_grade_class').on('change', function() {
      let my_val = $(this).val();
      if(my_val == 1) {
         $('.grade_1').show();
         $('.grade_2').hide();
      }
      else if(my_val == 2) {
         $('.grade_1').hide();
         $('.grade_2').show();
      } else {
         $('.grade_1').hide();
         $('.grade_2').hide();
      }
   });

   <?php
   if(isset($school)) {
   ?>
   setTimeout(function() {
      // $('#special_needs_support').change();
      $('#international_students').change();
   },500);
   <?php
   }
   ?>
   /**/

   jQuery.validator.addMethod('selectcheck', function (value) {
      if(value == '') {
         return true;
      }
   }, "year required");


});

</script>

<script type="text/javascript">
$(function(){

   /* brochure */
   $('#brochure').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'application/pdf',
      content: 'application/json',
      extFilter: ['pdf'],
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
         $('.brochure').val('');
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
      onUploadSuccess: function(id, data){
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         let brochureVal = $('#brochureFile').val();
         let newArr = [];
         if(brochureVal != '') {
            // console.log(brochureVal);
            newArr = jQuery.parseJSON(brochureVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#brochureFile').val(newArr);
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
         ui_single_update_status(this, 'Please Select PDF Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select PDF onFileTypeError', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

   $('#brochure1').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'application/pdf',
      content: 'application/json',
      extFilter: ['pdf'],
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
         $('.brochure').val('');
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
      onUploadSuccess: function(id, data){
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         let brochureVal = $('#brochureFile1').val();
         let newArr = [];
         if(brochureVal != '') {
            // console.log(brochureVal);
            newArr = jQuery.parseJSON(brochureVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#brochureFile1').val(newArr);
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
         ui_single_update_status(this, 'Please Select PDF Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select PDF onFileTypeError', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

   $('#brochure2').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'application/pdf',
      content: 'application/json',
      extFilter: ['pdf'],
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
         $('.brochure').val('');
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
      onUploadSuccess: function(id, data){
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         let brochureVal = $('#brochureFile2').val();
         let newArr = [];
         if(brochureVal != '') {
            // console.log(brochureVal);
            newArr = jQuery.parseJSON(brochureVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#brochureFile2').val(newArr);
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
         ui_single_update_status(this, 'Please Select PDF Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select PDF onFileTypeError', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });
   /* brochure */

   /* photos */
   $('#photos').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
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
         let photosVal = $('#photosFile').val();
         let newArr = [];
         if(photosVal != '') {
            // console.log(photosVal);
            newArr = jQuery.parseJSON(photosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#photosFile').val(newArr);
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

   $('#photos1').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
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
         let photosVal = $('#photosFile1').val();
         let newArr = [];
         if(photosVal != '') {
            // console.log(photosVal);
            newArr = jQuery.parseJSON(photosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#photosFile1').val(newArr);
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

   $('#photos2').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
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
         let photosVal = $('#photosFile2').val();
         let newArr = [];
         if(photosVal != '') {
            // console.log(photosVal);
            newArr = jQuery.parseJSON(photosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#photosFile2').val(newArr);
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
   /* photos */

   /* videos */
   $('#videos').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 5120000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'video/*',
      content: 'application/json',
      extFilter: ['mp4','flv','avi','3gp'],
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
         let videosVal = $('#videosFile').val();
         let newArr = [];
         if(videosVal != '') {
            // console.log(videosVal);
            newArr = jQuery.parseJSON(videosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#videosFile').val(newArr);
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
         ui_single_update_status(this, 'Please Select Video File Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Video Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

   $('#videos1').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 5120000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'video/*',
      content: 'application/json',
      extFilter: ['mp4','flv','avi','3gp'],
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
         let videosVal = $('#videosFile1').val();
         let newArr = [];
         if(videosVal != '') {
            // console.log(videosVal);
            newArr = jQuery.parseJSON(videosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#videosFile1').val(newArr);
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
         ui_single_update_status(this, 'Please Select Video File Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Video Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });
   
   $('#videos2').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 5120000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'video/*',
      content: 'application/json',
      extFilter: ['mp4','flv','avi','3gp'],
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
         let videosVal = $('#videosFile2').val();
         let newArr = [];
         if(videosVal != '') {
            // console.log(videosVal);
            newArr = jQuery.parseJSON(videosVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#videosFile2').val(newArr);
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
         ui_single_update_status(this, 'Please Select Video File Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Video Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });
   /* videos */

   /* Scool Logo */
   $('#schoolLogo, #schoolLogo1, #schoolLogo2').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
      multiple: false,
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
         /*let schoolLogoVal = $('#schoolLogoFile').val();
         let newArr = [];
         if(schoolLogoVal != '') {
            // console.log(schoolLogoVal);
            newArr = jQuery.parseJSON(schoolLogoVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);*/
         // $('#schoolLogoFile').val(newArr);
         // $('#schoolLogoFile').val(customData.path);
         $('#schoolLogoFile').val(customData.path);
         $('#schoolLogoFile1').val(customData.path);
         $('#schoolLogoFile2').val(customData.path);
         
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
   /* Scool Logo */

});

$(".special_needs_support_class").change(function(){
   var value =  $(this).val();
   if(value == 1){
      $(".special_need_category_div_class").removeClass('hide');
   }else{
      $(".special_need_category_div_class").addClass('hide');         
   }
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