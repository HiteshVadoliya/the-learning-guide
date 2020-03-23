<div class="pull-right col-md-12">
   <form action="<?php echo ADMIN_LINK; ?>Importschool\import_general" id="form-slider" class="" role="form" method="POST" enctype="multipart/form-data" >   
      <div class="form-group col-md-4">
         <label class="control-label">Select school CSV <small>(Import only csv file.)</small></label>
         <input type="file" class="form-control" name="school_file" id="school_file" data-placeholder="No file" required="" >
      </div>
      <div class="col-md-6">
         <label class="control-label">&nbsp;</label>
         <br>
            <button type="submit" class="btn btn-primary">Import</button>                           
         <a href="<?php echo ASSETPATH.'general_type_import.csv' ?>" class="btn btn-md btn-info">Download Sample</a>
         <a href="<?php echo ASSETPATH.'general-information_import.csv' ?>" class="btn btn-md btn-info">Download Information</a>
      </div>
   </form>
   <form id="export_schools" method="post" action="<?php echo ADMIN_LINK.'Exportschool/export_general' ?>">
     <div>
       <button type="submit" class="btn btn-primary">Export Schools</button>
     </div>
  </form>
</div>

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
<input type="hidden" name="school_type" value="1">
<div class="box-body">
      <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
               <label>Name<span class="star-mend">*</span></label>
               <input type="text" name="name" class="form-control" value="<?php if(isset($school)) { echo $school['name']; } ?>" placeholder="School Name">
            </div>
            <div class="form-group">
               <label>Type<span class="star-mend">*</span></label>
               <?php /*<select class="form-control" name="type">
                  <option value="">--Select--</option>
                  <option value="0" <?php if(isset($school)) { if($school['type'] == '0') { echo 'selected'; } } ?>>Primary</option>
                  <option value="1" <?php if(isset($school)) { if($school['type'] == '1') { echo 'selected'; } } ?>>Secondary</option>
                  <option value="2" <?php if(isset($school)) { if($school['type'] == '2') { echo 'selected'; } } ?>>Tertiary</option>
                  <option value="3" <?php if(isset($school)) { if($school['type'] == '3') { echo 'selected'; } } ?>>Special School</option>
               </select> */ ?>
               <select name="type[]" id="type" class="multiselect-ui form-control multi_type" multiple="multiple">
                  <?php
                  $typeArr = array('primary','secondary','tertiary'=>array('tafe','college','university'),'special needs');
                  foreach ($typeArr as $key => $value) {
                     $sel_type = $sel_subtype = '';
                     if(isset($school)) {
                        $type = $school['type'];
                        $type = explode(',', $type);
                        $subtype = $school['subtype'];
                        $subtype = explode(',', $subtype);
                        if(is_array($type)) {
                           if(in_array($value, $type)) {
                              $sel_type = 'selected';
                           }
                        }
                     }
                     /**/
                     if(is_array($value)) {
                        if(in_array($key, $type)) {
                           $sel_type = 'selected';
                        }
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo $sel_type ?>><?php echo ucwords($key); ?></option>
                        <optgroup label="">
                           <?php
                           foreach ($value as $key1 => $value1) {
                              if($sel_type == 'selected') {
                                 if(in_array($value1, $subtype)) {
                                    $sel_subtype = 'selected';
                                 }
                              }
                           ?>
                           <option class="inner-select-optgroup" value="<?php echo $value1; ?>" <?php echo $sel_subtype; ?>><?php echo ucwords($value1); ?></option>
                           <?php   
                           }
                           ?>
                        </optgroup>
                        <?php
                     }
                     else {
                     ?>
                     <option value="<?php echo $value; ?>" <?php echo $sel_type ?>><?php echo ucwords($value); ?></option>
                     <?php
                     }
                  }
                  ?>
               </select>
               <?php   
               /*if(isset($school)) {
                  $type = $school['type'];
                  $type = explode(',', $type);
               }
               <div class="row">
                  <div class="checkbox checkbox-inline">
                     <label style="font-size: 1em">
                        <input type="checkbox" checked="" value="primary" name="type[]" <?php if(isset($school)) { if(in_array('primary', $type)) { echo 'checked'; } } ?>>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Primary
                     </label>
                  </div>
                  <div class="checkbox checkbox-inline">
                     <label style="font-size: 1em">
                        <input type="checkbox" value="secondary" name="type[]" <?php if(isset($school)) { if(in_array('secondary', $type)) { echo 'checked'; } } ?>>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Secondary
                     </label>
                  </div>
                  <div class="checkbox checkbox-inline">
                     <label style="font-size: 1em">
                        <input type="checkbox" value="tertiary" name="type[]" <?php if(isset($school)) { if(in_array('tertiary', $type)) { echo 'checked'; } } ?>>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Tertiary
                     </label>
                  </div>
                  <div class="checkbox checkbox-inline">
                     <label style="font-size: 1em">
                        <input type="checkbox" value="special_school" name="type[]" <?php if(isset($school)) { if(in_array('special_school', $type)) { echo 'checked'; } } ?>>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Special School
                     </label>
                  </div>
               </div> */ ?>
            </div>

             <?php
            $disp_hide = 'style="display: none;"';
            if(isset($school)) {
               $checkType = explode(',', $school['type']);
               if(in_array('primary', $checkType) || in_array('secondary', $checkType)) {
                  $disp_hide = '';
               }
            }
            ?>
            <div class="form-group sector" id="sector" <?php echo $disp_hide; ?>>
               <label>Sector<span class="star-mend">*</span></label>
               <?php /*<select class="form-control" name="sector">
                  <option value="">--Select--</option>
                  <option value="government" <?php if(isset($school)) { if($school['sector'] == 'government') { echo 'selected'; } } ?>>Government</option>
                  <option value="private" <?php if(isset($school)) { if($school['sector'] == 'private') { echo 'selected'; } } ?>>Private</option>
                  <option value="selective" <?php if(isset($school)) { if($school['sector'] == 'selective') { echo 'selected'; } } ?>>Selective</option>
               </select> */ ?>
               <?php /*<select name="sector[]" class="multiselect-ui form-control" multiple="multiple">
                  <?php
                  $sectorArr = array('public','private','indepedent','government');
                  foreach ($sectorArr as $key => $value) {
                     $sel_sector = '';
                     $sector = $school['sector'];
                     $sector = explode(',', $sector);
                     if(is_array($sector)) {
                        if(in_array($value, $sector)) {
                           $sel_sector = 'selected';
                        }
                     }
                  ?>
                  <option value="<?php echo $value; ?>" <?php echo $sel_sector; ?>><?php echo ucwords($value); ?></option>
                  <?php
                  }
                  ?>
               </select> */ ?>
               <div class="row">
                  <?php
                  $sectorArr = array('public','private','independent','government');
                  foreach ($sectorArr as $key => $value) {
                     $checked = '';
                     if(isset($school)) {
                        $sector = $school['sector'];
                        $sector = explode(',', $sector);
                        $checked = (in_array($value, $sector)) ? 'checked' : '';
                     }

                  ?>
                  <div class="checkbox checkbox-inline">
                     <label style="font-size: 1em">
                        <input type="checkbox" value="<?php echo $value; ?>" name="sector[]" <?php echo $checked; ?>>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        <?php echo ucwords($value); ?>
                     </label>
                  </div>
                  <?php
                  }
                  ?>
               </div>

            </div>
            <div class="form-group">
               <label>Email<span class="star-mend">*</span></label>
               <input type="text" name="email" class="form-control" value="<?php if(isset($school)) { echo $school['email']; } ?>" placeholder="School Email">
            </div>
            <div class="form-group">
               <label>Telephone</label>
               <input type="text" name="telephone" class="form-control phone" value="<?php if(isset($school)) { echo $school['telephone']; } ?>" placeholder="School Telephone">
            </div>
            <?php /* ?><div class="form-group">
               <label>Mobile</label>
               <input type="text" name="mobile" class="form-control mobile" value="<?php if(isset($school)) { echo $school['mobile']; } ?>" placeholder="School Mobile">
            </div><?php */ ?>
            <div class="form-group">
               <label>Corporate</label>
               <input type="text" name="corporate" class="form-control corporate_no" value="<?php if(isset($school)) { echo $school['corporate_no']; } ?>" placeholder="Corporate Number">
            </div>
            <div class="form-group">
               <label>Business</label>
               <input type="text" name="business" class="form-control business_no" value="<?php if(isset($school)) { echo $school['business_no']; } ?>" placeholder="Business Number">
            </div>
            <div class="form-group">
               <label>Website<span class="star-mend">*</span></label>
               <input type="text" name="website" class="form-control" value="<?php if(isset($school)) { echo $school['website']; } ?>" placeholder="School Website">
            </div>
            
            <div class="form-group">
               <label>Principal<span class="star-mend">*</span></label>
               <input type="text" name="principal" class="form-control" value="<?php if(isset($school)) { echo $school['principal']; } ?>" placeholder="Principal Name">
            </div>
            <div class="form-group">
               <label>No Of Students<span class="star-mend">*</span></label>
               <?php
               $noStdArr = array('100'=>'0-200','350'=>'201-500','750'=>'501-1000','1001'=>'1000+');
               ?>
               <select name="no_of_students" class="form-control">
                  <option value="">No Of Students</option>
                  <?php
                  foreach ($noStdArr as $std_key => $student) {
                     $sel_student = '';
                     if(isset($school)) {
                        $no_of_students = $school['no_of_students'];
                        $student_key = '';
                        if($no_of_students <= 200) {
                           $student_key = '100';
                        }
                        if ($no_of_students > 200 && $no_of_students <= 500) {
                           $student_key = '350';
                        }
                        if ($no_of_students > 500 && $no_of_students <= 1000) {
                           $student_key = '750';
                        }
                        if ($no_of_students > 1000) {
                           $student_key = '1001';
                        }

                        // $sel_student = (array_key_exists($student_key, $noStdArr)) ? 'selected' : '';
                        $sel_student = ($std_key==$no_of_students) ? 'selected' : '';
                     }
                  ?>
                  <option value="<?php echo $std_key; ?>" <?php echo $sel_student; ?>><?php echo $student; ?></option>
                  <?php
                  }
                  ?>
               </select>
               <!-- <input type="text" name="no_of_students" class="form-control" value="<?php if(isset($school)) { echo $school['no_of_students']; } ?>" placeholder="No Of Students"> -->
            </div>
            <div class="form-group">
               <label>Number of Teachers<span class="star-mend">*</span></label>
               <?php
               $noTeacherArr = array('10'=>'0-20','35'=>'21-50','75'=>'51-100','150'=>'101-200','201'=>'200+');
               ?>
               <select name="no_of_teachers" class="form-control">
                  <option value="">No Of Teachers</option>
                  <?php
                  foreach ($noTeacherArr as $teacher_key => $teacher) {
                     $sel_teacher = '';
                     if(isset($school)) {
                        $no_of_teachers = $school['no_of_teachers'];
                        $teacher_key_sel = '';
                        if($no_of_teachers <= 20) {
                           $teacher_key_sel = '10';
                        }
                        if ($no_of_teachers > 20 && $no_of_teachers <= 50) {
                           $teacher_key_sel = '35';
                        }
                        if ($no_of_teachers > 50 && $no_of_teachers <= 100) {
                           $teacher_key_sel = '75';
                        }
                        if ($no_of_teachers > 100 && $no_of_teachers <= 200) {
                           $teacher_key_sel = '150';
                        }
                        if ($no_of_teachers > 200) {
                           $teacher_key_sel = '201';
                        }

                        // $sel_teacher = (array_key_exists($teacher_key_sel, $noTeacherArr)) ? 'selected' : '';
                        $sel_teacher = ($no_of_teachers==$teacher_key) ? 'selected' : '';
                     }
                  ?>
                  <option value="<?php echo $teacher_key; ?>" <?php echo $sel_teacher; ?>><?php echo $teacher; ?></option>
                  <?php
                  }
                  ?>
               </select>
               <!-- <input type="text" name="no_of_teachers" class="form-control" value="<?php if(isset($school)) { echo $school['no_of_teachers']; } ?>" placeholder="No Of Teachers"> -->
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
               <label>Suburb<span class="star-mend">*</span></label>
               <input type="text" name="city" class="form-control" value="<?php if(isset($school)) { echo $school['city']; } ?>" placeholder="Suburb">
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
               <label>Address<span class="star-mend">*</span></label>
               <input type="text" name="address_1" class="form-control" value="<?php if(isset($school)) { echo $school['address_1']; } ?>" placeholder="Street Address">
               <input type="hidden" name="address_2" class="form-control" value="<?php if(isset($school)) { echo $school['address_2']; } ?>" placeholder="optional">
               <input type="hidden" name="address_3" class="form-control" value="<?php if(isset($school)) { echo $school['address_3']; } ?>" placeholder="optional">
            </div>
            <div class="form-group">
               <label>Reception Address</label>
               <input type="text" name="reception" class="form-control" value="<?php if(isset($school)) { echo $school['reception']; } ?>" placeholder="Reception Address">
            </div>
            <div class="form-group">
               <label>Primary Campus Address</label>
               <input type="text" name="primary_campus" class="form-control" value="<?php if(isset($school)) { echo $school['primary_campus']; } ?>" placeholder="Primary Campus Address">
            </div>
            <div class="form-group">
               <div class="checkbox checkbox-inline mycheckbox">
                  <label style="font-size: 1em">
                     <input type="checkbox" value="1" name="show_primary" <?php if(isset($school)) { if($school['show_primary'] == 1) { echo 'checked'; } } ?>>
                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                     Show Primary Campus On Map
                  </label>
               </div>
            </div>
            <div class="form-group">
               <label>Secondary Campus Address</label>
               <input type="text" name="secondary_campus" class="form-control" value="<?php if(isset($school)) { echo $school['secondary_campus']; } ?>" placeholder="Secondary Campus Address">
            </div>
            <div class="form-group">
               <div class="checkbox checkbox-inline mycheckbox">
                  <label style="font-size: 1em">
                     <input type="checkbox" value="1" name="show_secondary" <?php if(isset($school)) { if($school['show_secondary'] == 1) { echo 'checked'; } } ?>>
                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                     Show Secondary Campus On Map
                  </label>
               </div>
            </div>
            <div class="form-group">
               <label>PO Box</label>
               <input type="text" name="po_box" class="form-control" value="<?php if(isset($school)) { echo $school['po_box']; } ?>" placeholder="PO Box">
            </div>
            


         </div>
         <div class="col-lg-6">
            <div class="form-group">
               <label>Religion<span class="star-mend">*</span></label>
               <input type="text" name="religion" class="form-control" value="<?php if(isset($school)) { echo $school['religion']; } ?>" placeholder="Religion">
            </div>
            <div class="form-group">
               <!-- <label>International Students<span class="star-mend">*</span></label> -->
               <label>International Students Accepted<span class="star-mend">*</span></label>
               <select class="form-control" name="internation_students" id="internation_students">
                  <!-- <option value="">--Select--</option> -->
                  <option value="0" <?php if(isset($school)) { if($school['international_students'] == '0') { echo 'selected'; } } ?>>No</option>
                  <option value="1" <?php if(isset($school)) { if($school['international_students'] == '1') { echo 'selected'; } } ?>>Yes</option>
               </select>
            </div>
            <?php
            $cric_disp_hide = 'style="display: none;"';
            if(isset($school)) {
               if($school['international_students'] == '1') {
                  $cric_disp_hide = '';
               }
            }
            ?>
            <div class="form-group" id="cricos_number" <?php echo $cric_disp_hide; ?>>
               <label>CRICOS Number<span class="star-mend">*</span></label>
               <input type="text" name="cricos_number" class="form-control" value="<?php if(isset($school)) { echo $school['cricos_number']; } ?>" placeholder="CRICOS Number">
            </div>
            <div class="form-group">
               <label>Enrolment Officer<span class="star-mend">*</span></label>
               <input type="text" name="enrolment_officer" class="form-control" value="<?php if(isset($school)) { echo $school['enrolments_officer']; } ?>" placeholder="Enrolment Officer Name">
            </div>
            <div class="form-group">
               <label>Enrolment Officer Email<span class="star-mend">*</span></label>
               <input type="text" name="enrolment_officer_email" class="form-control" value="<?php if(isset($school)) { echo $school['enrolments_officer_email']; } ?>" placeholder="Enrolment Officer Email">
            </div>
            <!-- <div class="form-group">
               <label>Address 1<span class="star-mend">*</span></label>
               <input type="text" name="address_1" class="form-control" value="<?php if(isset($school)) { echo $school['address_1']; } ?>" placeholder="Street Address">
            </div>
            <div class="form-group">
               <label>Address 2</label>
               <input type="text" name="address_2" class="form-control" value="<?php if(isset($school)) { echo $school['address_2']; } ?>" placeholder="optional">
            </div>
            <div class="form-group">
               <label>Address 3</label>
               <input type="text" name="address_3" class="form-control" value="<?php if(isset($school)) { echo $school['address_3']; } ?>" placeholder="optional">
            </div> -->
            <div class="form-group">
               <label>Special Needs Support<span class="star-mend">*</span></label>
               <select class="form-control special_needs_support_class" name="special_needs_support" id="special_needs_support">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['special_needs_support'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['special_needs_support'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>

            <?php 
            if(isset($school)){                      
               if($school['special_needs_support'] == 1) 
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
            if (isset($school)) {
               $special_need_category_edit = $school['special_need_category'];
               $special_need_category_edit = explode(',', $special_need_category_edit);
            }
            ?>


            <div class="form-group <?= $hide; ?> special_need_category_div_class" id="special_need_category_div">
               <label>Special needs categories<span class="star-mend">*</span></label>

               <br>
               <?php foreach ($special_need_category as $c_key => $c_value) { ?>
               <div class="checkbox checkbox-inline ">
                  <label style="font-size: 1em">
                     <input <?php if(isset($school)) { if(in_array($c_key, $special_need_category_edit)) { echo 'checked'; } }  ?> type="checkbox" value="<?= $c_key; ?>" name="special_need_category[]">
                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                     <?= $c_value; ?>
                  </label>
               </div>
               <?php } ?>

               <!-- <select class="form-control" name="special_need_category" id="special_need_category">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($special_need_category as $c_key => $c_value) {
                     $sel = ($school['special_need_category']!='' && $school['special_need_category']==$c_key) ? 'selected' : '';
                     ?>
                     <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                     <?php
                  }
                  ?>
               </select> -->
            </div>

           
            <div class="form-group">
               <label>Selective<span class="star-mend">*</span></label>
               <select name="selective" class="form-control">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['selective'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['selective'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>
            <div class="form-group">
               <!-- <label>Commonwealth Funding<span class="star-mend">*</span></label> -->
               <label>Commonwealth Funding</label>
               <?php $currentyear = date('Y') ?>
               <div class="row">
                  <div class="col-md-6">
                     <select name="funding_year" class="form-control funding">
                        <option value="">--Select Year--</option>
                        <?php
                        for ($i=$currentyear; $i > $currentyear-25; $i--) {
                           $sel_year = '';
                           if(isset($school)) {
                              $sel_year = ($i == $school['funding_year']) ? 'selected' : '';
                           }
                        ?>
                        <option value="<?php echo $i; ?>" <?php echo $sel_year ?>><?php echo $i; ?></option>
                        <?php
                        }
                        ?>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <input type="text" name="funding_amount" class="form-control funding" placeholder="Funding Amount" value="<?php if(isset($school)) { echo $school['funding_amount']; } ?>">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <!-- <label>Boarding<span class="star-mend">*</span></label> -->
               <label>Boarding / Housing<span class="star-mend">*</span></label>
               <select class="form-control" name="boarding">
                  <option value="">--Select Boarding--</option>
                  <option value="1" <?php if(isset($school)) { if($school['boarding'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['boarding'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>

            <div class="form-group">
               <label>Student Support</label>
               <select class="form-control" name="student_support">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['student_support'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['student_support'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
               <!-- <input type="text" name="po_box" class="form-control" value="" placeholder="PO Box"> -->
            </div>
            <div class="form-group">
               <label>School Motto<span class="star-mend">*</span></label>
               <input type="text" name="motto" class="form-control" value="<?php if(isset($school)) { echo $school['motto']; } ?>" placeholder="School Motto">
            </div>
            <div class="form-group">
               <label>Scholarship Offers<span class="star-mend">*</span></label>
               <select name="scholarship_offer" class="form-control">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['scholarship_offer'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['scholarship_offer'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>
            <?php
            $international_baccalaureate_style = 'style="display:none;"';
            if(isset($school)) {
               if(in_array('secondary', $type)) {
                  $international_baccalaureate_style = '';
               }
            }
            ?>
            <div class="form-group" id="international_baccalaureate_div" <?php echo $international_baccalaureate_style ?>>
               <label>International Baccalaureate School<span class="star-mend">*</span></label>
               <select name="international_baccalaureate" class="form-control">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['international_baccalaureate'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['international_baccalaureate'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>
            <div class="form-group">
               <label>About School<span class="star-mend">*</span></label>
               <textarea name="about" id="about" class="form-control about_class"><?php if(isset($school)) { echo $school['about']; } ?></textarea>
            </div>
            
         </div>
      </div><!-- row -->
      <div class="row">
         <div class="col-md-6">
            
         </div>
         <div class="col-md-6">
            

         </div>
      </div>
      <hr>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label>School Logo</label>
               <div id="schoolLogo" class="dm-uploader p-5 text-center">
                  <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Your Logo here</h3>
                  <div class="btn btn-primary mb-5">
                     <span>Open the file Browser</span>
                     <input type="hidden" name="schoolLogoFile" id="schoolLogoFile">
                     <input type="file" name="school_logo" title='Click to add Files' />
                  </div>
                  <div class="">  
                     <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">No files uploaded.</li>
                     </ul>
                  </div>
               </div>
               <?php
               if(isset($school)) {
               ?>
               <input type="hidden" name="old_schoolLogo" value="<?php echo $school['school_logo']; ?>">
               <?php
                  if($school['school_logo'] != '' && file_exists(PhotosPath.$school['school_logo'])) {
                  ?>
                  <img src="<?php echo ASSETPATH.'uploads/image/school/'.$school['school_logo']; ?>" class="img img-responsive" alt="Photos" width="150px">
                  <?php
                  }
               }
               ?>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label>Prospectus</label>
               <div id="brochure" class="dm-uploader p-5 text-center">
                  <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                  <div class="btn btn-primary mb-5">
                     <span>Open the file Browser</span>
                     <input type="hidden" name="brochureFile" id="brochureFile">
                     <input type="file" title='Click to add Files' />
                  </div>
                  <div class="">  
                     <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">No files uploaded.</li>
                     </ul>
                  </div>
               </div>
               <?php
               if(isset($school)) {
                  $old_prospectus = $school['prospectus'];
               ?>
               <input type="hidden" name="old_prospectus" value='<?php echo $old_prospectus ?>'>
               <?php
                  if($old_prospectus != '') {
                     $old_prospectus = json_decode($old_prospectus, true);
                     foreach ($old_prospectus as $key => $value) {
                        // if(file_exists(BrochurePath.$value)) {
                        ?>
                        <a href="<?php echo ASSETPATH.'uploads/pdf/brochure/'.$value; ?>" target="_blank"><?php echo $value; ?></a><br>
                        <?php
                        // }
                     ?>
                     <?php
                     }
                  }
               }
               ?>
            </div>
         </div>

      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label>Photos</label>
               <div id="photos" class="dm-uploader p-5 text-center">
                  <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                  <div class="btn btn-primary mb-5">
                     <span>Open the file Browser</span>
                     <input type="hidden" name="photosFile" id="photosFile">
                     <input type="file" title='Click to add Files' />
                  </div>
                  <div class="">  
                     <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">No files uploaded.</li>
                     </ul>
                  </div>
               </div>
               <?php
               if(isset($school)) {
                  if($school['photos'] != '') {
                     $photos = $school['photos'];
                  ?>
                  <input type="hidden" name="old_photos" id="old_photos" value='<?php echo $photos ?>'>
                  <div class="row">
                        <?php
                        $photos = json_decode($school['photos'], true);
                        foreach ($photos as $key => $value) {
                        ?>
                        <div class="col-md-3">
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
               <div id="videos" class="dm-uploader p-5 text-center">
                  <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                  <div class="btn btn-primary mb-5">
                     <span>Open the file Browser</span>
                     <input type="hidden" name="videosFile" id="videosFile">
                     <input type="file" title='Click to add Files' />
                  </div>
                  <div class="">
                     <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">No files uploaded.</li>
                     </ul>
                  </div>
               </div>
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
      <button type="submit" class="btn btn-primary"><?php if(isset($school)) { echo 'Modify'; }else { echo 'save'; } ?></button>
      <a href="<?= base_url(ADMIN.'manage-school') ?>" class="btn btn-danger pull-right">Cancel</a>
   </div><!-- /.box footer-->
</form>

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
         /*telephone: {
            required: true,
            // number: true
         },*/
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
            required: $("#special_needs_support").val() == "1"
         },
         
         enrolment_officer: {
            required: true,
            number: false
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
         },
         /*funding_year: {
            required: true
         },
         funding_amount: {
            required: true,
            number: true
         },*/
         special_needs_support: {
            required: true
         },
         motto: {
            required: true
         },
         scholarship_offer: {
            required: true
         },
         about: {
            required: true
         },
         primary_campus: {
            required: function(element) {
               return $('input[name="show_primary"]').prop('checked')
            }
         },
         secondary_campus: {
            required: function(element) {
               return $('input[name="show_secondary"]').prop('checked')
            }
         }
         /*school_logo: {
            required: true
         }*/
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
            // number: 'Please Enter Number Only'
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
            required: 'Please Enter Enrolment Officer Name',
            number: 'Please Enter Characters.'
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
         /*funding_year: 'Please Select Funding Year',
         funding_amount: {
            required: 'Please Select Funding Amount',
            number: 'Please Enter Only Digit'
         },*/
         special_needs_support: 'Please Select Special Need Support',
         motto: {
            required: 'Please Enter School Motto'
         },
         about: {
            required: 'Please Enter About School'
         },
         scholarship_offer: {
            required: 'Please Select Scholarship Offer'
         },
         primary_campus: 'Please Enter Primary Campus',
         secondary_campus: 'Please Enter Secondary Campus',
         // school_logo: 'Please Select School Logo'
      },
      errorElement: "span",
      errorPlacement: function ( error, element ) {
         // Add the `help-block` class to the error element
         error.addClass("text-danger");
         if (element.prop( "type" ) === "checkbox") {
            error.insertAfter(element.parent( "label") );
         } else if(element.hasClass("phone1")){
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