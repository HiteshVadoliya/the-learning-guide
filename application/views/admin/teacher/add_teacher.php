<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<section class="content-header">
   <?php
   if(isset($teacher)) {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Teacher</h1>
   <?php
   }
   else {
   ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Teacher</h1>
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
      if(isset($teacher)) {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Teacher/create_update_teacher/'.$teacher['id'] ?>" method="post" id="teacherForm" enctype="multipart/form-data">
      <?php
      }
      else {
      ?>
      <form role="form" action="<?= ADMIN_LINK.'Teacher/create_update_teacher' ?>" method="post" id="teacherForm" enctype="multipart/form-data">
      <?php
      }
      ?>
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'manage-teacher') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-lg-6">
                  
                  <div class="form-group">
                     <label>Salutation<span class="star-mend">*</span></label>
                     <select name="title" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        $titleArr = array('Mr','Mrs','Ms','Miss','Dr');
                        foreach ($titleArr as $key => $value) {
                           $sel_title = '';
                           if(isset($teacher)) {
                              $sel_title = ($value == $teacher['title']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value ?>" <?php echo $sel_title ?>><?php echo $value ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>First Name<span class="star-mend">*</span></label>
                     <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php if(isset($teacher)) { echo $teacher['fname']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Last Name<span class="star-mend">*</span></label>
                     <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php if(isset($teacher)) { echo $teacher['lname']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Email<span class="star-mend">*</span></label>
                     <input type="text" name="email" class="form-control" value="<?php if(isset($teacher)) { echo $teacher['email']; } ?>" placeholder="Teacher Email">
                  </div>
                  <div class="form-group">
                     <label>Phone<!-- <span class="star-mend">*</span> --></label>
                     <input type="text" name="phone" class="form-control phone" value="<?php if(isset($teacher)) { echo $teacher['phone']; } ?>" placeholder="Teacher Phone">
                  </div>

                  <div class="form-group">
                     <label>Mobile</label>
                     <input type="text" name="mobile" class="form-control mobile" value="<?php if(isset($teacher)) { echo $teacher['mobile']; } ?>" placeholder="Teacher Mobile">
                  </div>
                 

                  <div class="form-group">
                     <label>Qualifications<span class="star-mend">*</span></label>
                     <input type="text" name="qualifications" class="form-control" placeholder="Qualifications" value="<?php if(isset($teacher)) { echo $teacher['qualifications']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Status<span class="star-mend">*</span></label>
                     <select class="form-control" name="teacher_status" id="teacher_status">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($teacher)) { if($teacher['teacher_status'] == '1') { echo 'selected'; } } ?>>Retired</option>
                        <option value="0" <?php if(isset($teacher)) { if($teacher['teacher_status'] == '0') { echo 'selected'; } } ?>>Teaching</option>
                     </select>
                  </div>

                  <?php
                  $teach_school_section = "display:none";
                  $previous_school_section = "display:none";
                  if(isset($teacher)) {
                     if($teacher['teacher_status'] == '1') { 
                        $teach_school_section = "display:none";
                        $previous_school_section = "display:none";
                     }
                     /*if($teacher['teacher_status'] == '0') { 
                        $teach_school_section = "display:none";
                        $previous_school_section = "display:block";
                     }*/
                  }

                  ?>

                  <div class="form-group" id="teach_school_section" style="<?php echo $teach_school_section ?>">
                     <!-- <label>School Where Teaching<span class="star-mend">*</span></label> -->
                     <label>School Where Teaching</label>
                     <select name="teach_school" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($school as $key => $value) {
                           $sel_teach = '';
                           if(isset($teacher)) {
                              $sel_teach = ($value['id'] == $teacher['teach_school']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo $sel_teach ?>><?php echo ucwords($value['name']) ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group" id="previous_school_section" style="<?php //echo $previous_school_section ?>">
                     <!-- <label>Previous School<span class="star-mend">*</span></label> -->
                     <label>Previous School</label>
                     <select name="previous_school" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($school as $key => $value) {
                           $sel_previous_teach = '';
                           if(isset($teacher)) {
                              $sel_previous_teach = ($value['id'] == $teacher['previous_school']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo $sel_previous_teach ?>><?php echo ucwords($value['name']) ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>About Teacher<span class="star-mend">*</span></label>
                     <textarea name="about" id="about" class="form-control"><?php if(isset($teacher)) { echo $teacher['about']; } ?></textarea>
                  </div>

               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Year Started Teaching<span class="star-mend">*</span></label>
                     <div class="row">
                        <?php $currentyear = date('Y') ?>
                        <div class="col-md-6">
                           <select name="year_started_teach" class="form-control">
                              <option value="">--Select--</option>
                              <?php
                              for ($i=$currentyear; $i > $currentyear-55; $i--) {
                                 $sel_year = '';
                                 if(isset($teacher)) {
                                    $sel_year = ($i == $teacher['year_started_teach']) ? 'selected' : '';
                                 }
                              ?>
                              <option value="<?php echo $i; ?>" <?php echo $sel_year ?>><?php echo $i; ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Units Teach<span class="star-mend">*</span></label>
                     <input type="text" name="units_teach" class="form-control" placeholder="Units Teach" value="<?php if(isset($teacher)) { echo $teacher['units_teach']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>Type<span class="star-mend">*</span></label>
                     <?php
                     if (isset($teacher)) {
                        $type = $teacher['type'];
                        $type = explode(',', $type);
                     }
                     ?>
                     <div class="row">
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" checked="" value="primary" name="type[]" <?php if(isset($teacher)) { if(in_array('primary', $type)) { echo 'checked'; } } ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              Primary
                           </label>
                        </div>
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" value="secondary" name="type[]" <?php if(isset($teacher)) { if(in_array('secondary', $type)) { echo 'checked'; } } ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              Secondary
                           </label>
                        </div>
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" value="tertiary" name="type[]" <?php if(isset($teacher)) { if(in_array('tertiary', $type)) { echo 'checked'; } } ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              Tertiary
                           </label>
                        </div>
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" value="special_school" name="type[]" <?php if(isset($teacher)) { if(in_array('special_school', $type)) { echo 'checked'; } } ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              Special School
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Tutoring Services<span class="star-mend">*</span></label>
                     <select class="form-control" name="tutoring_services" id="tutoring_services">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($teacher)) { if($teacher['tutoring_services'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($teacher)) { if($teacher['tutoring_services'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  <?php 
                  if(isset($teacher)){                      
                     if($teacher['tutoring_services'] == 1) 
                     { 
                        $hide = '';                      
                     }else{                         
                        $hide = 'hide'; 
                     }
                  }else{ 
                     $hide = 'hide'; 
                  } 
                  ?>
                  <div class="form-group <?php echo $hide; ?>" id="preferred_hours_div">
                     <label>Preferred hours<span class="star-mend">*</span></label>
                     <input type="text" class="form-control timerangepicker" name="preferred_hours" value="<?php if(isset($teacher)) { echo $teacher['preferred_hours']; } ?>">
                  </div>
                  <div class="form-group <?php echo $hide; ?>" id="preferred_days_div">
                     <label>Preferred days<span class="star-mend">*</span></label>
                     <div class="row">
                        <?php
                        $days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
                        foreach ($days as $day) {
                           $sel_day = '';
                           if(isset($teacher)) {
                              $daysArr = explode(',',$teacher['preferred_days']);
                              $sel_day = (in_array($day, $daysArr)) ? 'checked' : '';
                           }
                        ?>
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" value="<?php echo $day; ?>" name="preferred_days[]" <?php echo $sel_day; ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              <?php echo $day; ?>
                           </label>
                        </div>
                        <?php
                        }
                        ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Social Account</label>
                     <input type="text" name="social_link" class="form-control" placeholder="Social Account Link" value="<?php if(isset($teacher)) { echo $teacher['social_link']; } ?>">
                  </div>
                  <div class="form-group">
                     <label>School Moto<span class="star-mend">*</span></label>
                     <input type="text" name="motto" class="form-control" value="<?php if(isset($teacher)) { echo $teacher['motto']; } ?>" placeholder="Teacher Motto">
                  </div>

               </div>
               
            </div><!-- row -->
            <hr>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Resume</label>
                     <div id="resume" class="dm-uploader p-5 text-center">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Your Logo here</h3>
                        <div class="btn btn-primary mb-5">
                           <span>Open the file Browser</span>
                           <input type="hidden" name="resumeFile" id="resumeFile">
                           <input type="file" name="resume" title='Click to add Files' />
                        </div>
                        <div class="">  
                           <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                              <li class="text-muted text-center empty">No files uploaded.</li>
                           </ul>
                        </div>
                     </div>
                     <?php
                     if(isset($teacher)) {
                     ?>
                     <input type="hidden" name="old_resume" value="<?php echo $teacher['document']; ?>">
                     <?php
                        if($teacher['document'] != '' && file_exists(ResumePath.$teacher['document'])) {
                        ?>
                        <a href="<?php echo ASSETPATH.'uploads/document/teacher/'.$teacher['document']; ?>" target="_blank"><?php echo $teacher['document']; ?></a>
                        <?php
                        }
                     }
                     ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mb-3 dm-uploader" id="profile">
                     <div class="form-row">
                        <div class="col-md-10 col-sm-12">
                           <div class="from-group mb-2">
                              <label>Profile Image</label>
                              <input type="text" class="form-control" aria-describedby="fileHelp" placeholder="No image uploaded..." readonly="readonly" />
                              <div class="progress mb-2 d-none">
                                 <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">0%</div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div role="button" class="btn btn-primary mr-2">
                                 <?php
                                 if(isset($teacher)) {
                                 ?>
                                 <input type="hidden" name="old_profileImg" id="old_profileImg" value="<?php echo $teacher['profile_img']; ?>">
                                 <?php
                                 }
                                 ?>
                                 <input type="hidden" name="profileImgFile" id="profileImgFile">
                                 <i class="fa fa-folder-o fa-fw"></i> Browse Files
                                 <input type="file" title='Click to Select Profile Image' />
                              </div>
                              <small class="status text-muted">Select a file or drag it over this area..</small>
                           </div>
                        </div>
                        <div class="col-md-2 d-md-block d-sm-none">
                           <?php
                           if(isset($teacher) && $teacher['profile_img'] != '' && file_exists(ProfilePath.$teacher['profile_img'])) {
                           ?>
                           <img src="<?php echo base_url().ProfilePath.$teacher['profile_img']; ?>" alt="..." class="img-thumbnail">
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
               </div>

            </div>


            <div class="row">
                  <div class="form-group col-md-6">
                     <label>Special Needs Experience<span class="star-mend">*</span></label>
                     <select class="form-control" name="need_experience" id="need_experience">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($teacher)) { if($teacher['need_experience'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($teacher)) { if($teacher['need_experience'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>

                  <?php 
                  if(isset($teacher)){                      
                     if($teacher['need_experience'] == 1) 
                     { 
                        $hide = '';                      
                     }else{                         
                        $hide = 'hide'; 
                     }
                  }else{ 
                     $hide = 'hide'; 
                  } 
                  ?>

                  <?php
                  if (isset($teacher)) {
                     $special_need_category_edit = $teacher['special_need_category'];
                     $special_need_category_edit = explode(',', $special_need_category_edit);
                  }
                  ?>

                  <div class="form-group col-md-6 <?= $hide; ?>" id="special_need_category_div">
                     <label>Special needs categories<span class="star-mend">*</span></label>
                     <br>
                     <?php foreach ($special_need_category as $c_key => $c_value) { 

                        ?>
                     <div class="checkbox checkbox-inline ">
                        <label style="font-size: 1em">
                           <input <?php if(isset($teacher)) { if(in_array($c_key, $special_need_category_edit)) { echo 'checked'; } }  ?> type="checkbox" value="<?= $c_key; ?>" name="special_need_category[]">
                           <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                           <?= $c_value; ?>
                        </label>
                     </div>
                     <?php } ?>
                     <!-- 
                     <select class="form-control" name="special_need_category" id="special_need_category">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($special_need_category as $c_key => $c_value) {
                           $sel = ($teacher['special_need_category']!='' && $teacher['special_need_category']==$c_key) ? 'selected' : '';
                           ?>
                           <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                           <?php
                        }
                        ?>
                     </select> -->
                  </div>
            </div>

            <div class="row">
                  <?php /* <div class="form-group col-md-6">
                     <label>Working with Children<span class="star-mend">*</span></label>
                     <select name="working_with_children" id="working_with_children" class="form-control"> 
                        <option value="">--Select--</option>                       
                        <option value="1" <?php if(isset($teacher)) { if($teacher['working_with_children'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($teacher)) { if($teacher['working_with_children'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  <?php 
                  if(isset($teacher)){                      
                     if($teacher['working_with_children'] == 1) 
                     { 
                        $hide = '';                      
                     }else{                         
                        $hide = 'hide'; 
                     }
                  }else{ 
                     $hide = 'hide'; 
                  }  */
                  ?>
                  <input type="hidden" name="working_with_children" value="1">
                  <div class="form-group col-md-6 <?php // echo $hide; ?>" id="wwcc_number_div">
                     <label>WWCC number<span class="star-mend">*</span></label>
                     <input type="text" class="form-control" name="wwcc_number" value="<?php if(isset($teacher)) { echo $teacher['wwcc_number']; } ?>">
                  </div>
            </div> 

            <div class="row">
                  <div class="form-group col-md-6">
                     <label>Multilingual<span class="star-mend">*</span></label>
                     <select class="form-control" name="multilanguage" id="multilanguage">
                        <option value="">--Select--</option>
                        <option value="1" <?php if(isset($teacher)) { if($teacher['multilanguage'] == '1') { echo 'selected'; } } ?>>Yes</option>
                        <option value="0" <?php if(isset($teacher)) { if($teacher['multilanguage'] == '0') { echo 'selected'; } } ?>>No</option>
                     </select>
                  </div>
                  <?php 
                  if(isset($teacher)){                      
                     if($teacher['multilanguage'] == 1) 
                     { 
                        $hide = '';                      
                     }else{                         
                        $hide = 'hide'; 
                     }
                  }else{ 
                     $hide = 'hide'; 
                  } 
                  ?>
                  
                  <div class="form-group col-md-6 <?=$hide?>" id="language_div">
                     <!-- <label>Type<span class="star-mend">*</span></label> -->
                     <label>Language/s<span class="star-mend">*</span></label>
                     <?php
                     if (isset($teacher)) {
                        $type = $teacher['language'];
                        $type = explode(',', $type);

                     }
                     ?>
                     <div class="row">
                        <?php
                        foreach ($language as $lang_key => $lang) {
                           $sel_lang = '';
                           if(isset($teacher)) { 
                              $sel_lang = (in_array($lang['language'], $type)) ? 'checked' : '';
                           }
                        ?>
                        <div class="checkbox checkbox-inline">
                           <label style="font-size: 1em">
                              <input type="checkbox" value="<?php echo $lang['language'] ?>" name="language[]" <?php echo $sel_lang ?>>
                              <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                              <?php echo $lang['language'] ?>
                           </label>
                        </div>
                        <?php
                        }
                        ?>
                        
                     </div>
                  </div>
            </div>


         </div><!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(isset($teacher)) { echo 'Modify'; }else { echo 'save'; } ?></button>
            <a href="<?= base_url(ADMIN.'manage-teacher') ?>" class="btn btn-danger pull-right">Cancel</a>
         </div><!-- /.box footer-->
      </form>
   </div><!-- /.box -->
</section>

<script src="<?php echo ASSETPATH ?>plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?= ADMINPATH.'fileupload/js/jquery.dm-uploader.js'; ?>"></script>
<script src="<?= ADMINPATH.'fileupload/js/file_upload.js'; ?>"></script>

<script type="text/javascript">

$(function() {
   $('.timerangepicker').daterangepicker({
      timePicker: true,
      timeOnly: true,
      locale: {
         format: 'hh:mm A'
      }
   }).on('show.daterangepicker', function(ev, picker) {
      picker.container.find(".calendar-table").hide();
   });
});

$(document).ready(function() {
   
   $('#about').ckeditor();

   $("#teacherForm").validate({
      rules: {
         title: {
            required: true
         },
         fname: {
            required: true
         },
         lname: {
            required: true
         },
         email: {
            required: true,
            email: true
         },
         qualifications: {
            required: true
         },
         teach_school: {
            // required: true
            required: function(element) {
               return $('#teacher_status').val() != 1
            }
         },
         previous_school: {
            // required: true
            required: function(element) {
               return $('#teacher_status').val() == 1
            }
         },
         year_started_teach: {
            required: true
         },
         units_teach: {
            required: true
         },
         type: {
            required: true
         },
         tutoring_services: {
            required: true
         },
         teacher_status: {
            required: true
         },
         about: {
            required: true
         },
         motto: {
            required: true
         }
         
      },
      messages: {
         title: {
            required: 'Please Select Title'
         },
         fname: {
            required: 'Please Enter First Name'
         },
         lname: {
            required: 'Please Enter Last Name'
         },
         email: {
            required: 'Please Enter Email',
            email: 'Please Enter Valid Email'
         },
         qualifications: {
            required: 'Please Enter Qualifications'
         },
         teach_school: {
            required: 'Please Select School Where Teaching'
         },
         previous_school: {
            required: 'Please Select Previous School'
         },
         year_started_teach: {
            required: 'Please Select Year Started'
         },
         units_teach: {
            required: 'Please Enter Units Teach'
         },
         type: {
            required: 'Please Select Type'
         },
         tutoring_services: {
            required: 'Please Select Tutoring Services'
         },
         teacher_status: {
            required: 'Please Enter Status'
         },
         about: {
            required: 'Please Enter About Teacher'
         },
         motto: {
            required: 'Please Enter Teacher Motto'
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

   $('#teacher_status').on('change',function(e){
      // let status = $(this).val();
      let status = $("#teacher_status option:selected").val();
      if(!status) {
         /*$("#teach_school_section").hide();
         $("#previous_school_section").hide();*/
      }
      if(status == 1) {
         $("#teach_school_section").hide();
         $("#previous_school_section").show();
         if($('select[name="previous_school"]').val() == '') {
            swal({
               title: "Alert!",
               text: "You have to Select Previous School",
               type: "warning"
            });
         }
      }
      if(status == 0) {
         // console.log($('select[name="teach_school"]').val());
         $("#teach_school_section").show();
         $("#previous_school_section").hide();
         if($('select[name="teach_school"]').val() == '') {
            swal({
               title: "Alert!",
               text: "You have to Select School Where Teaching",
               type: "warning"
            });
         }
      }
   });

});

</script>

<script type="text/javascript">
$(function(){

   /* Resume */
   $('#resume').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
      multiple: false,
      allowedTypes: '*',
      content: 'application/json',
      extFilter: ['pdf','docx','doc'],
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
         $('#resumeFile').val(customData.path);
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
         ui_single_update_status(this, 'Please Select Pdf/Doc File Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Pdf/Doc File Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });
   /* Resume */

   /* Profile Image */
   $('#profile').dmUploader({ //
      url: '<?= base_url(ADMIN.'School/upload_files'); ?>',
      maxFileSize: 3000000, // 3 Megs max
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
         $('#profileImgFile').val(customData.path);
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

});
</script>

<script type="text/javascript">
   $(document).ready(function() {
   
      /*$('.phone').on('blur', function() {
         $('.phone').val(function(i, text) {
            return text.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3');
         });
      });

      $('.mobile').on('blur', function() {
         $('.mobile').val(function(i, text) {
            return text.replace(/(\d{4})(\d{3})(\d{3})/, '$1 $2 $3');
         });
      });*/

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

<script type="text/javascript">
   $("#tutoring_services").change(function(){
      var value =  $(this).val();
      if(value == 1){
         $("#preferred_hours_div").removeClass('hide');
         $("#preferred_days_div").removeClass('hide');
      }else{
         $("#preferred_hours_div").addClass('hide');         
         $("#preferred_days_div").addClass('hide');
      }
   });

   $("#working_with_children").change(function(){
      var value =  $(this).val();
      if(value == 1){
         $("#wwcc_number_div").removeClass('hide');
      }else{
         $("#wwcc_number_div").addClass('hide');         
      }
   });

   $("#multilanguage").change(function(){
      var value =  $(this).val();
      if(value == 1){
         $("#language_div").removeClass('hide');
      }else{
         $("#language_div").addClass('hide');         
      }
   });

   $("#need_experience").change(function(){
      var value =  $(this).val();
      if(value == 1){
         $("#special_need_category_div").removeClass('hide');
      }else{
         $("#special_need_category_div").addClass('hide');         
      }
   });
</script>