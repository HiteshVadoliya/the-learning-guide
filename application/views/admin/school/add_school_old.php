<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<section class="content-header">
   <?php
   if(isset($school)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit School</h1>
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
      <?php
      if(isset($school)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'School/create_update_school/'.$school['id'] ?>" method="post" id="schoolForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'School/create_update_school' ?>" method="post" id="schoolForm" enctype="multipart/form-data">
      <?php
      }
      ?>
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'manage-school') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label>Name<span class="star-mend">*</span></label>
                     <input type="text" name="name" class="form-control" value="<?php if(isset($school)) { echo $school['name']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Email<span class="star-mend">*</span></label>
                     <input type="text" name="email" class="form-control" value="<?php if(isset($school)) { echo $school['email']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Telephone<span class="star-mend">*</span></label>
                     <input type="text" name="telephone" class="form-control" value="<?php if(isset($school)) { echo $school['telephone']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Website<span class="star-mend">*</span></label>
                     <input type="text" name="website" class="form-control" value="<?php if(isset($school)) { echo $school['website']; } ?>">
                  </div>
                  <!-- <div class="form-group">
                     <label>Prospectus</label>
                     <input type="file" name="prospectus[]" class="filestyle" placeholder="Brochure" multiple="" accept="application/pdf">
                     <?php
                     if(isset($school)) {
                        if($school['prospectus'] != '') {
                           $prospectus = json_decode($school['prospectus'], true);
                        ?>
                        <input type="hidden" name="old_prospectus" id="old_prospectus" value='<?php echo $school['prospectus'] ?>'>
                        <?php
                           foreach ($prospectus as $key => $value) {
                           ?>
                           <a href="<?php echo ASSETPATH.'uploads/pdf/brochure/'.$value; ?>" target="_blank"><?php echo $value; ?></a><br>
                           <?php
                           }
                        }
                     }
                     ?>
                  </div> -->
                  <div class="form-group">
                     <label>Principal<span class="star-mend">*</span></label>
                     <input type="text" name="principal" class="form-control" value="<?php if(isset($school)) { echo $school['principal']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>No Of Students<span class="star-mend">*</span></label>
                     <input type="text" name="no_of_students" class="form-control" value="<?php if(isset($school)) { echo $school['no_of_students']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>No Of Teachers<span class="star-mend">*</span></label>
                     <input type="text" name="no_of_teachers" class="form-control" value="<?php if(isset($school)) { echo $school['no_of_teachers']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Type<span class="star-mend">*</span></label>
                     <select class="form-control" name="type">
                        <option value="">--Select--</option>
                        <option value="0" <?php if(isset($school)) { if($school['type'] == '0') { echo 'selected'; } } ?>>Primary</option>
                        <option value="1" <?php if(isset($school)) { if($school['type'] == '1') { echo 'selected'; } } ?>>Secondary</option>
                        <option value="2" <?php if(isset($school)) { if($school['type'] == '2') { echo 'selected'; } } ?>>Tertiary</option>
                        <option value="3" <?php if(isset($school)) { if($school['type'] == '3') { echo 'selected'; } } ?>>Special School</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Boarding<span class="star-mend">*</span></label>
                     <select class="form-control" name="boarding">
                        <option value="">--Select Boarding--</option>
                        <option value="1" <?php if(isset($school)) { if($school['boarding'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($school)) { if($school['boarding'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Gender<span class="star-mend">*</span></label>
                     <select class="form-control" name="gender">
                        <option value="male" <?php if(isset($school)) { if($school['gender'] == 'male') { echo 'selected'; } } ?>>Male</option>
                        <option value="female" <?php if(isset($school)) { if($school['gender'] == 'female') { echo 'selected'; } } ?>>Female</option>
                        <option value="coeducation" <?php if(isset($school)) { if($school['gender'] == 'coeducation') { echo 'selected'; } } ?>>Co-Education</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Sector<span class="star-mend">*</span></label>
                     <select class="form-control" name="sector">
                        <option value="">--Select--</option>
                        <option value="government" <?php if(isset($school)) { if($school['sector'] == 'government') { echo 'selected'; } } ?>>Government</option>
                        <option value="private" <?php if(isset($school)) { if($school['sector'] == 'private') { echo 'selected'; } } ?>>Private</option>
                        <option value="selective" <?php if(isset($school)) { if($school['sector'] == 'selective') { echo 'selected'; } } ?>>Selective</option>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label>Religion<span class="star-mend">*</span></label>
                     <input type="text" name="religion" class="form-control" value="<?php if(isset($school)) { echo $school['religion']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>International Students<span class="star-mend">*</span></label>
                     <select class="form-control" name="internation_students">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($school)) { if($school['international_students'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($school)) { if($school['international_students'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>CRICOS Number<span class="star-mend">*</span></label>
                     <input type="text" name="cricos_number" class="form-control" value="<?php if(isset($school)) { echo $school['cricos_number']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Enrolment Officer<span class="star-mend">*</span></label>
                     <input type="text" name="enrolment_officer" class="form-control" value="<?php if(isset($school)) { echo $school['enrolments_officer']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Enrolment Officer Email<span class="star-mend">*</span></label>
                     <input type="text" name="enrolment_officer_email" class="form-control" value="<?php if(isset($school)) { echo $school['enrolments_officer_email']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Suburb<span class="star-mend">*</span></label>
                     <input type="text" name="city" class="form-control" value="<?php if(isset($school)) { echo $school['city']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>State<span class="star-mend">*</span></label>
                     <select class="form-control" name="state">
                        <option value="">--Select State--</option>
                        <?php
                        foreach ($state as $key => $value) {
                           $sel_state = '';
                           if(isset($school)) {
                              $sel_state = ($school['state'] == $value['id']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo $sel_state ?>><?php echo $value['name'] ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Address 1<span class="star-mend">*</span></label>
                     <input type="text" name="address_1" class="form-control" value="<?php if(isset($school)) { echo $school['address_1']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Address 2</label>
                     <input type="text" name="address_2" class="form-control" value="<?php if(isset($school)) { echo $school['address_2']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Address 3</label>
                     <input type="text" name="address_3" class="form-control" value="<?php if(isset($school)) { echo $school['address_3']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Special Needs Support<span class="star-mend">*</span></label>
                     <select class="form-control" name="special_needs_support">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($school)) { if($school['special_needs_support'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($school)) { if($school['special_needs_support'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  
               </div>
            </div><!-- row -->
            <hr>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="">
                        <div class="mb-3 dm-uploader single" id="brochure">
                           <div class="row">
                              <div class="form-row">
                                 <div class="col-md-10 col-sm-12">
                                    <div class="form-group mb-2">
                                       <label>Prospectus</label>
                                       <input type="text" class="form-control brochure" aria-describedby="fileHelp" placeholder="No File Uploaded..." readonly="readonly">
                                       <div class="progress mb-2 d-none">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                                          0%
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div role="button" class="btn btn-primary mr-2">
                                          <i class="fa fa-folder-o fa-fw"></i> Browse Files
                                          <input type="file" title="Click to add Files">
                                          <input type="hidden" name="brochureFile" id="brochureFile">
                                       </div>
                                       <small class="status text-muted">Select a file or drag it over this area..</small>
                                    </div>
                                 </div>
                                 <div class="col-md-2  d-md-block  d-sm-none">
                                    <?php
                                    $path = (isset($edit['image']) && $edit['image']!= '')?CATPATH.$edit['id'].'/'.$edit['image']:'';
                                    $src = '';
                                    if($path!="" && file_exists($path))
                                    {
                                        $src = base_url($path);
                                    }
                                    else
                                    {
                                      $src = ASSETPATH.'images/default-image.png';
                                    }
                                    ?>
                                    <img src="<?= $src ?>" alt="Category Image" class="img-thumbnail">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Photos</label>
                     <input type="file" name="photos[]" class="filestyle" placeholder="Brochure" multiple="" accept="image/*">
                     <?php
                     if(isset($school)) {
                        if($school['photos'] != '') {
                           $photos = json_decode($school['photos'], true);
                        ?>
                        <input type="hidden" name="old_photos" id="old_photos" value='<?php echo $school['photos'] ?>'>
                        <br>
                        <div class="row">
                              <?php
                              foreach ($photos as $key => $value) {
                              ?>
                           <div class="col-md-3">
                              <!-- <a href="<?php echo ASSETPATH.'uploads/pdf/brochure/'.$value; ?>" target="_blank"><?php echo $value; ?></a><br> -->
                              <img src="<?php echo ASSETPATH.'uploads/image/school/'.$value; ?>" class="img img-responsive" alt="Photos" width="150px">
                           </div>
                              <?php
                              }
                              ?>
                        </div>
                        <?php
                        }
                     }
                     ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Videos</label>
                     <input type="file" name="videos[]" class="filestyle" placeholder="Brochure" multiple="" accept="video/*">
                     <?php
                     if(isset($school)) {
                        if($school['videos'] != '') {
                           $videos = json_decode($school['videos'], true);
                        ?>
                        <input type="hidden" name="old_videos" id="old_videos" value='<?php echo $school['videos'] ?>'>
                        <?php
                           foreach ($videos as $key => $value) {
                           ?>
                           <a href="<?php echo ASSETPATH.'uploads/video/school/'.$value; ?>" target="_blank"><?php echo $value; ?></a><br>
                           <?php
                           }
                        }
                     }
                     ?>
                  </div>
               </div>
            </div>

         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="<?= base_url(ADMIN.'manage-school') ?>" class="btn btn-danger pull-right">Cancel</a>
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
        
    $("#schoolForm").validate({
        rules: {
            name: {
               required: true
            },
            email: {
               required: true,
               email: true
            },
            telephone: {
               required: true,
               number: true
            },
            website: {
               required: true
            },
            /*prospectus: {
               required: true
            },*/
            no_of_students: {
               required: true,
               number: true
            },
            no_of_teachers: {
               required: true,
               number: true
            },
            type: {
               required: true
            },
            boarding: {
               required: true
            },
            gender: {
               required: true
            },
            religion: {
               required: true
            },
            internation_students: {
               required: true
            },
            cricos_number: {
               required: true
            },
            enrolment_officer: {
               required: true
            },
            enrolment_officer_email: {
               required: true
            },
            city: {
               required: true
            },
            state: {
               required: true
            },
            address_1: {
               required: true
            },
            principal: {
               required: true
            },
            sector: {
               required: true
            }
        },
        messages: {
            name: {
               required: 'Please Enter School Name'
            },
            email: {
               required: 'Please Enter School Email',
               email: 'Please Enter Valid Email'
            },
            telephone: {
               required: 'Please Enter School Telephone',
               number: 'Please Enter Number Only'
            },
            website: {
               required: 'Please Enter School Website'
            },
            /*prospectus: {
               required: 'Please Select Prospectus'
            },*/
            no_of_students: {
               required: 'Please Enter No Of Students',
               number: 'Please Enter Number Only'
            },
            no_of_teachers: {
               required: 'Please Enter No Of Teachers',
               number: 'Please Enter Number Only'
            },
            type: {
               required: 'Please Select Type'
            },
            boarding: {
               required: 'Please Select Boarding'
            },
            gender: {
               required: 'Please Select Gender'
            },
            religion: {
               required: 'Please Enter Religion'
            },
            internation_students: {
               required: 'Please Select International Students'
            },
            cricos_number: {
               required: 'Please Enter CRICOS Number'
            },
            enrolment_officer: {
               required: 'Please Enter Enrolment Officer Name'
            },
            enrolment_officer_email: {
               required: 'Please Enter Enrolment Officer Email'
            },
            city: {
               required: 'Please Enter Suburb'
            },
            state: {
               required: 'Please Select State'
            },
            address_1: {
               required: 'Please Enter Address'
            },
            principal: 'Please Enter Principal Name',
            sector: 'Please Select Sector',
        },
        errorElement: "span",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass("text-danger");
            if (element.prop( "type" ) === "checkbox") {
                error.insertAfter(element.parent( "label") );
            } else if(element.hasClass("phone")){
                error.insertAfter(element.parent(".input-group"));
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

<script type="text/javascript">
$(function(){
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
         ui_multi_add_file(id, file);
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
         this.find('input[type="text"]').val(customData.path);
         $('#brochureFileo').val(customData.path);
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
         // ui_single_update_status(this, 'File excess the size limit', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      },
      onFileTypeError: function(file){
         // ui_single_update_status(this, 'Please Select PDF Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         // ui_single_update_status(this, 'Please Select PDF onFileTypeError', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
    });
  
});
</script>
<!-- File item template -->
<script type="text/html" id="files-template">
   <li class="media">
      <div class="media-body mb-1">
         <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
         </p>
         <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
         <hr class="mt-1 mb-1" />
      </div>
   </li>
</script>