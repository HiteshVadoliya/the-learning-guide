<div class="pull-right col-md-12">
   <form action="<?php echo ADMIN_LINK; ?>Importschool\import_tertiary" id="form-slider" class="" role="form" method="POST" enctype="multipart/form-data" >   
      <div class="form-group col-md-4">
         <label class="control-label">Select school CSV <small>(Import only csv file.)</small></label>
         <input type="file" class="form-control" name="school_file" id="school_file" data-placeholder="No file" required="">
      </div>
      <div class="col-md-6">
         <label class="control-label">&nbsp;</label>
         <br>
            <button type="submit" class="btn btn-primary">Import</button>                           
         <a href="<?php echo ASSETPATH.'tertiary_type_import.csv' ?>" class="btn btn-md btn-info">Download Sample</a>
         <a href="<?php echo ASSETPATH.'tertiary-information_import.csv' ?>" class="btn btn-md btn-info">Download Information</a>
      </div>
   </form>
   <form id="export_schools" method="post" action="<?php echo ADMIN_LINK.'Exportschool/export_tertiary' ?>">
     <div>
       <button type="submit" class="btn btn-primary">Export Schools</button>
     </div>
  </form>
</div>


<?php
if(isset($school)) {
?>
<form role="form" action="<?= ADMIN_LINK.'School/create_update_school_tertiary/'.$school['id'] ?>" method="post" id="schoolForm3" enctype="multipart/form-data">
<?php
}
else {
?>
<form role="form" action="<?= ADMIN_LINK.'School/create_update_school_tertiary' ?>" method="post" id="schoolForm3" enctype="multipart/form-data">
<?php
}
?>
<input type="hidden" name="school_type" value="4">
<div class="box-body">
      <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
               <label>Name<span class="star-mend">*</span></label>
               <input type="text" name="name" class="form-control" value="<?php if(isset($school)) { echo $school['name']; } ?>" placeholder="School Name">
            </div>

            <div class="form-group">
               <label>School Motto<span class="star-mend">*</span></label>
               <input type="text" name="motto" class="form-control" value="<?php if(isset($school)) { echo $school['motto']; } ?>" placeholder="School Motto">
            </div>

            <div class="form-group">
               <label>Type<span class="star-mend">*</span></label>
               <select name="type[]" id="type" class="multiselect-ui form-control multi_type" multiple="multiple">
                  <?php
                  // $typeArr = array('primary','secondary','tertiary'=>array('tafe','college','university'),'special needs');
                  $typeArr = array('tertiary'=>array('tafe','college','university'));
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
               <label>Campus locations<span class="star-mend">*</span></label>
               <input type="text" name="capmus_location" id="capmus_location" class="form-control" value="<?php if(isset($school)) { echo $school['capmus_location']; } ?>" placeholder="Campus locations">
            </div>

            <div id="sel-none">
              <div class="form-group">
                <label>Telephone</label>
                <?php
                if(isset($school['id'])) {
                  $option_data = json_decode($school['telephone_title'], true);
                  $option = $option_data['option'];
                  $optvalue = $option_data['optvalue'];
                  if(!empty($option)) {
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
                          <input type="text" name="optvalue[]" value="<?php if(isset($optvalue[$key])) { echo $optvalue[$key]; } ?>" class="form-control" placeholder="land line">
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
                      <input type="text" name="optvalue[]" class="form-control" placeholder="land line">
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
                        <input type="text" name="optvalue[]" class="form-control" placeholder="land line">
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                </div>            
              </div>
           </div>

            

            <div class="form-group">
               <label>Website<span class="star-mend">*</span></label>
               <input type="text" name="website" class="form-control" value="<?php if(isset($school)) { echo $school['website']; } ?>" placeholder="School Website">
            </div>

            <div class="form-group">
               <label>Email<span class="star-mend">*</span></label>
               <input type="text" name="email" class="form-control" value="<?php if(isset($school)) { echo $school['email']; } ?>" placeholder="School Email">
            </div>

            <div class="form-group">
               <label>Chancellor </label>
               <input type="text" class="form-control" name="chancellor" value="<?php if(isset($school)) { echo $school['chancellor']; } ?>" placeholder="Chancellor">
            </div>

            <div class="form-group">
               <label>Vice Chancellor </label>
               <input type="text" class="form-control" name="vice_chancellor" value="<?php if(isset($school)) { echo $school['vice_chancellor']; } ?>" placeholder="Vice Chancellor">
            </div>


            <div class="form-group">
               <label>Student Support Officer<span class="star-mend">*</span></label>
               <input type="text" name="student_support_officer" class="form-control" value="<?php if(isset($school)) { echo $school['student_support_officer']; } ?>" placeholder="Student Support Officer">
            </div>

            <div class="form-group">
               <label>Student Support Email <span class="star-mend">*</span></label>
               <input type="text" name="student_support_email" class="form-control" value="<?php if(isset($school)) { echo $school['student_support_email']; } ?>" placeholder="Student Support Email">
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
                        $sel_teacher = ($no_of_teachers==$teacher_key) ? 'selected' : '';
                     }
                  ?>
                  <option value="<?php echo $teacher_key; ?>" <?php echo $sel_teacher; ?>><?php echo $teacher; ?></option>
                  <?php
                  }
                  ?>
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
               <label>Religion<span class="star-mend">*</span></label>
               <input type="text" name="religion" class="form-control" value="<?php if(isset($school)) { echo $school['religion']; } ?>" placeholder="Religion">
            </div>

            <div class="form-group">
               <label>Student Association<span class="star-mend">*</span></label>
               <input type="text" name="student_association" class="form-control" value="<?php if(isset($school)) { echo $school['student_association']; } ?>" placeholder="Student Association">
            </div>

            <div class="form-group">
               <label>Student Association Contact <span class="star-mend">*</span></label>
               <input type="text" name="student_association_contact" class="form-control" value="<?php if(isset($school)) { echo $school['student_association_contact']; } ?>" placeholder="Student Association Contact">
            </div>

            <div class="form-group">
               <label>Annual Fees Average<span class="star-mend">*</span></label>
               <input type="text" name="annual_fees" class="form-control" value="<?php if(isset($school)) { echo $school['annual_fees']; } ?>" placeholder="Annual Fees Average">
            </div>

             <div class="form-group">
               <label>Student Boarding / Housing<span class="star-mend">*</span></label>
               <select class="form-control" name="boarding">
                  <option value="">-- Select --</option>
                  <option value="1" <?php if(isset($school)) { if($school['boarding'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['boarding'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>

             <div class="form-group">
               <label>Private School/Shuttle Bus<span class="star-mend">*</span></label>
               <select class="form-control" name="private_school_bus">
                  <option value="">-- Select --</option>
                  <option value="1" <?php if(isset($school)) { if($school['private_school_bus'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['private_school_bus'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>

            <div class="form-group">
               <label>Onsite Parking<span class="star-mend">*</span></label>
               <select class="form-control" name="onsite_parking">
                  <option value="">-- Select --</option>
                  <option value="1" <?php if(isset($school)) { if($school['onsite_parking'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['onsite_parking'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>

            

            <div class="form-group">
               <label>Scholarship Offers<span class="star-mend">*</span></label>
               <select name="scholarship_offer" class="form-control">
                  <option value="">--Select--</option>
                  <option value="1" <?php if(isset($school)) { if($school['scholarship_offer'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['scholarship_offer'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>


            <div class="form-group">
               <label>Bus Stop on Campus <span class="star-mend">*</span></label>
               <select class="form-control" name="busstop_campus">
                  <option value="">-- Select --</option>
                  <option value="1" <?php if(isset($school)) { if($school['busstop_campus'] == '1') { echo 'selected'; } } ?>>Yes</option>
                  <option value="0" <?php if(isset($school)) { if($school['busstop_campus'] == '0') { echo 'selected'; } } ?>>No</option>
               </select>
            </div>


            
            <div class="form-group">
               <!-- <label>Special Needs Support<span class="star-mend">*</span></label> -->
               <label>Special Needs Infrastructure<span class="star-mend">*</span></label>
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
            </div>

          </div>

            <div class="row">
               <div class="col-md-6">
                   
                    

                  
                   
                     


                     <div class="form-group">
                        <label>Train station close to Campus <span class="star-mend">*</span></label>
                        <select class="form-control" name="train_station">
                           <option value="">-- Select --</option>
                           <option value="1" <?php if(isset($school)) { if($school['train_station'] == '1') { echo 'selected'; } } ?>>Yes</option>
                           <option value="0" <?php if(isset($school)) { if($school['train_station'] == '0') { echo 'selected'; } } ?>>No</option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label>Careers Adviser <span class="star-mend">*</span></label>
                        <select class="form-control" name="careers_adviser">
                           <option value="">-- Select --</option>
                           <option value="1" <?php if(isset($school)) { if($school['careers_adviser'] == '1') { echo 'selected'; } } ?>>Yes</option>
                           <option value="0" <?php if(isset($school)) { if($school['careers_adviser'] == '0') { echo 'selected'; } } ?>>No</option>
                        </select>
                     </div>


                     <div class="form-group">
                        <label>Student Support / Counselling</label>
                        <select class="form-control" name="student_support">
                           <option value="">--Select--</option>
                           <option value="1" <?php if(isset($school)) { if($school['student_support'] == '1') { echo 'selected'; } } ?>>Yes</option>
                           <option value="0" <?php if(isset($school)) { if($school['student_support'] == '0') { echo 'selected'; } } ?>>No</option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label>Student Counsellor or Support Contact</label>
                        <input type="text" class="form-control" name="student_counsellor" value="<?php if(isset($school)) { echo $school['student_counsellor']; } ?>" placeholder="Student Counsellor or Support Contact">
                     </div>

                     <div class="form-group">
                         <label>International Students Accepted<span class="star-mend">*</span></label>
                         <select class="form-control internation_students_class" name="internation_students" id="internation_students">
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

                      <div class="form-group cricos_number_class" id="cricos_number" <?php echo $cric_disp_hide; ?>>
                         <label>CRICOS Number<span class="star-mend">*</span></label>
                         <input type="text" name="cricos_number" class="form-control" value="<?php if(isset($school)) { echo $school['cricos_number']; } ?>" placeholder="CRICOS Number">
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
                         <label>PO Box</label>
                         <input type="text" name="po_box" class="form-control" value="<?php if(isset($school)) { echo $school['po_box']; } ?>" placeholder="PO Box">
                      </div>

                      <div class="form-group">
                         <label>About School<span class="star-mend">*</span></label>
                         <textarea name="about" id="about" class="form-control about_class"><?php if(isset($school)) { echo $school['about']; } ?></textarea>
                      </div>

                      <div class="form-group" id="facilities">
                         <label>Facilities</label>
                         <div class="row">
                            <?php
                            $sectorArr =  array("Pool","Tennis Court","Basketball Court","Library","School Canteen","Lockers","Student Lounge","Elevator/s","Sick Bay","Gymnasium","Bike racks","Uniform Shop","All Gender Bathroom","Shuttle Bus","Bus stop","Preschool","Science Labs","Student Kitchen","3D Printer"," Volleyball Court","Netball Court","Lecture Theatre","Music Room","School Nurse","Onsite Visitor Parking","Football Field","Rowing Shed");
                            foreach ($sectorArr as $key => $value) {
                               $checked = '';
                               if(isset($school)) {
                                  $sector = $school['facilities'];
                                  $sector = explode(',', $sector);
                                  $checked = (in_array($value, $sector)) ? 'checked' : '';
                               }

                            ?>
                            <div class="checkbox checkbox-inline">
                               <label style="font-size: 1em">
                                  <input type="checkbox" value="<?php echo $value; ?>" name="facilities[]" <?php echo $checked; ?>>
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                  <?php echo ucwords($value); ?>
                               </label>
                            </div>
                            <?php
                            }
                            ?>
                         </div>

                      </div>
                      <!-- <div id="sel-none"> -->
                      <div class="form-group">
                         <label>Use of Facilities Contact</label>
                         <input type="text" name="facilities_contact" class="form-control" value="<?php if(isset($school)) { echo $school['facilities_contact']; } ?>" placeholder="Use of Facilities Contact">
                      </div>
                      <?php
                      if(isset($school)) {

                        $option_data = json_decode($school['primary_campus'], true); 
                        $option = $option_data['address'];
                      }
                      ?>
                      <div class="form-group">
                        <label>Primary Campus Address</label>
                        <?php
                        if(isset($school['id']) && $school['primary_campus']!='' && !empty($option)) {
                          $option_data = json_decode($school['primary_campus'], true);
                          $option = $option_data['address'];

                          foreach ($option as $key => $value) {
                           $primary_address_arr = explode("!#!", $value);
                          ?>
                          <div class="row <?php echo ($key == 0) ? 'after-add-more2' : 'control-group2' ?>">
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_campus_title[]" class="form-control" value="<?php if(isset($school)) { echo $primary_address_arr[0]; } ?>" placeholder="Primary Campus Title">
                            </div>
                           <div class="form-group col-lg-12">
                              <input type="text" name="primary_address_suburb[]" id="primary_address_suburb" class="form-control" value="<?php if(isset($school)) { echo $primary_address_arr[1]; } ?>" placeholder="Primary Campus Suburb">
                           </div>
                            <div class="form-group col-lg-12">
                               <select class="form-control" name="primary_state[]">
                                  <option value="">--Select Primary Campus State--</option>
                                  <?php
                                  foreach ($state as $k => $value) {
                                     $sel_state = '';
                                     if(isset($school)) {
                                        if (isset($primary_address_arr[2])) {
                                           $sel_state = ($primary_address_arr[2] == $value['id']) ? 'selected' : '';
                                        }
                                     }
                                  ?>
                                  <option value="<?php echo $value['id'] ?>" <?php echo $sel_state ?>><?php echo $value['name'] ?></option>
                                  <?php
                                  }
                                  ?>
                               </select>
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_campus[]" class="form-control" value="<?php if(isset($school)) { echo (isset($primary_address_arr[2])) ? $primary_address_arr[3] : ''; } ?>" placeholder="Primary Campus Address">
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_po_box[]" class="form-control" value="<?php if(isset($school)) { echo (isset($primary_address_arr[3])) ? $primary_address_arr[4] : ''; } ?>" placeholder="Primary Postcode Box">
                            </div>
                            <?php 
                            $checkbox_status = (isset($primary_address_arr[5]) && $primary_address_arr[5]) ? 'checked' : '';
                            ?>
                            <div class="form-group col-lg-12">
                               <div class="checkbox checkbox-inline mycheckbox">
                                  <label style="font-size: 1em">
                                     <input type="checkbox" value="1" name="show_primary[]"  <?php echo $checkbox_status ?> class="checkbox_check">
                                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                     Show Primary Campus On Map
                                  </label>
                               </div>
                               <input type="hidden" name="checkbox_value[]" class="checkbox_value" value="<?= $primary_address_arr[5] ?>">
                            </div>
                            
                            <div class="form-group col-lg-12">
                              <?php
                              if($key == 0) {
                              ?>
                              <button class="btn btn-success add-more2" type="button"><i class="fa fa-plus"></i></button>
                              <?php
                              }
                              else {
                              ?>
                              <button class="btn btn-danger remove2" type="button"><i class="fa fa-minus"></i></button>
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
                        <div class="row after-add-more2">
                          <div class="form-group col-lg-12">
                             <input type="text" name="primary_campus_title[]" class="form-control" value="" placeholder="Primary Campus Title">
                          </div>
                           <div class="form-group col-lg-12">
                              <input type="text" name="primary_address_suburb[]" class="form-control" value="" placeholder="Primary Campus Suburb">
                           </div>
                           <div class="form-group col-lg-12">
                               <select class="form-control" name="primary_state[]">
                                  <option value="">--Select Primary Campus State--</option>
                                   <?php
                                   foreach ($state as $key => $value) {
                                      $sel_state = '';
                                      if(isset($school)) {
                                         if (isset($primary_address_arr[1])) {
                                            $sel_state = ($primary_address_arr[1] == $value['id']) ? 'selected' : '';
                                         }
                                      }
                                   ?>
                                   <option value="<?php echo $value['id'] ?>" <?php echo $sel_state ?>><?php echo $value['name'] ?></option>
                                   <?php
                                   }
                                   ?>
                               </select>
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_campus[]" class="form-control" value="" placeholder="Primary Campus Address">
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_po_box[]" class="form-control" value="" placeholder="Primary Postcode Box">
                            </div>
                            <div class="form-group col-lg-12">
                               <div class="checkbox checkbox-inline mycheckbox">
                                  <label style="font-size: 1em">
                                     <input type="checkbox" value="1" name="show_primary[]" class="checkbox_check" >
                                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                     Show Primary Campus On Map
                                  </label>
                               </div>
                                <input type="hidden" name="checkbox_value[]" class="checkbox_value" value="0">
                            </div>

                            <div class="form-group col-lg-12">
                              <button class="btn btn-success add-more2" type="button"><i class="fa fa-plus"></i></button>
                            </div>
                          
                        </div>
                        <?php
                        }
                        ?>
                      </div>


                        <!-- Copy Elements -->
                     <div class="copy-fields2 hide">
                        <div class="row control-group2 ">
                            <div class="form-group col-lg-12">
                              <input type="text" name="primary_campus_title[]" class="form-control" value="" placeholder="Primary Campus Title">
                            </div>
                           <div class="form-group col-lg-12">
                              <input type="text" name="primary_address_suburb[]" class="form-control" value="" placeholder="Primary Campus Suburb">
                           </div>
                           <div class="form-group col-lg-12">
                               <select class="form-control" name="primary_state[]">
                                  <option value="">--Select Primary Campus State--</option>
                                   <?php
                                   foreach ($state as $key => $value) {
                                      $sel_state = '';
                                      if(isset($school)) {
                                         if (isset($primary_address_arr[1])) {
                                            $sel_state = ($primary_address_arr[1] == $value['id']) ? 'selected' : '';
                                         }
                                      }
                                   ?>
                                   <option value="<?php echo $value['id'] ?>" <?php echo $sel_state ?>><?php echo $value['name'] ?></option>
                                   <?php
                                   }
                                   ?>
                               </select>
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_campus[]" class="form-control" value="" placeholder="Primary Campus Address">
                            </div>
                            <div class="form-group col-lg-12">
                               <input type="text" name="primary_po_box[]" class="form-control" value="" placeholder="Primary Postcode Box">
                            </div>
                            <div class="form-group col-lg-12">
                               <div class="checkbox checkbox-inline mycheckbox">
                                  <label style="font-size: 1em">
                                     <input type="checkbox" value="1" name="show_primary[]" class="checkbox_check">
                                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                     Show Primary Campus On Map
                                  </label>
                               </div>
                              <input type="hidden" name="checkbox_value[]" class="checkbox_value" value="0" >
                            </div>

                            <div class="form-group col-lg-12">
                              <button class="btn btn-danger remove2" type="button"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                     </div>


                      

                     

                   <div class="form-group">
                      <label>Instagram </label>
                      <input type="text" class="form-control" name="instagram" value="<?php if(isset($school)) { echo $school['instagram']; } ?>" placeholder="Instagram">
                   </div>


                   <div class="form-group">
                      <label>Facebook </label>
                      <input type="text" class="form-control" name="facebook" value="<?php if(isset($school)) { echo $school['facebook']; } ?>" placeholder="Facebook">
                   </div>
                   </div>
               </div>               
            </div>



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
                     <div id="brochure2" class="dm-uploader p-5 text-center">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                        <div class="btn btn-primary mb-5">
                           <span>Open the file Browser</span>
                           <input type="hidden" name="brochureFile" id="brochureFile2">
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
                     <div id="photos2" class="dm-uploader p-5 text-center">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                        <div class="btn btn-primary mb-5">
                           <span>Open the file Browser</span>
                           <input type="hidden" name="photosFile" id="photosFile2">
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
                     <div id="videos2" class="dm-uploader p-5 text-center">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h3>
                        <div class="btn btn-primary mb-5">
                           <span>Open the file Browser</span>
                           <input type="hidden" name="videosFile" id="videosFile2">
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

            


         </div>
       
         <div class="col-lg-6">
            
           
            
         </div>
      <hr>
      

      <div class="box-footer">
         <button type="submit" class="btn btn-primary"><?php if(isset($school)) { echo 'Modify'; }else { echo 'save'; } ?></button>
         <a href="<?= base_url(ADMIN.'manage-school') ?>" class="btn btn-danger pull-right">Cancel</a>
      </div><!-- /.box footer-->
      
</div><!-- /.box-body -->


      </div>
</form>   
    </div>
   <script type="text/javascript">
      $(document).ready(function() {
       $("#schoolForm3").validate({
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
            principal: {
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
            reception_state: {
               required: $("#reception_address_suburb").val() != " "
            },
            reception_po_box: {
               required: $("#reception_address_suburb").val() != " "
            },
            reception_address: {
               required: $("#reception_address_suburb").val() != " "
            },


            primary_state: {
               required: $("#primary_address_suburb").val() != " "
            },
            primary_campus: {
               required: $("#primary_address_suburb").val() != " "
            },
            primary_po_box: {
               required: $("#primary_address_suburb").val() != " "
            },
            
              
            
            secondary_state: {
               required: $("#secoundary_address_suburb").val() != " "
            },
            secondary_campus: {
               required: $("#secoundary_address_suburb").val() != " "
            },
            secoundary_po_box: {
               required: $("#secoundary_address_suburb").val() != " "
            },
            
           /* $("#").val().length > 0) {
               
               : {
                  required: true
               },
               reception_address: {
                  required: true
               },
               reception_po_box: {
                  required: true
               },                   
               
            }*/
            
            
            
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
            funding_year: {
               required: true
            },
            funding_amount: {
               required: true,
               number: true
            },
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
            },
            capmus_location: { required: true },
            

            student_support_officer: { required: true },
            student_support_email: { required: true },
            student_association: { required: true },
            student_association_contact: { required: true },
            annual_fees: { required: true },
            busstop_campus: { required: true },
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
            funding_year: 'Please Select Funding Year',
            funding_amount: {
               required: 'Please Select Funding Amount',
               number: 'Please Enter Only Digit'
            },
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
            capmus_location: 'Please Enter Campus Location ',
            student_support_officer: 'Please Enter Support officer ',
            student_support_email: 'Please Enter Support Email ',
            student_association: 'Please Enter Support Email ',
            student_association_contact: 'Please Enter Support Email ',
            annual_fees: 'Please Enter Support Email ',
            busstop_campus: 'Please Enter Support Email ',
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

   $(document).ready(function() {
      
      

      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").parent().append(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

      $(".add-more2").click(function(){ 
          var html = $(".copy-fields2").html();
          $(".after-add-more2").parent().append(html);
      });

      $("body").on("click",".remove2",function(){ 
          $(this).parents(".control-group2").remove();
      });

      

      

      $(document).on("click",".checkbox_check",function(){
        if($(this).is(":checked")){
          // console.log("Checkbox is checked." );
          // $(this).parents(".form-group").find('input[name="checkbox_value"]').val('1');
          $(this).parents(".mycheckbox").next().val('1')
        } else {
          // console.log("Not checked." );
          // $(this).parents(".form-group").find('input[name="checkbox_value"]').val('0');
          $(this).parents(".mycheckbox").next().val('0')
        }
        // console.log($(this).parents(".mycheckbox").next());
      })

   });



   </script>

