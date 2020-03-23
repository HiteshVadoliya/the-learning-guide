<?php
$need_experience = "";
$special_need_category_value = "";
if(isset($_GET['need_experience']) && $_GET['need_experience']!='')
{
    $need_experience = $_GET['need_experience']; 
    if($need_experience=='1') {
        if(isset($_GET['special_need_category_teacher'])){
            $special_need_category_value = $_GET['special_need_category_teacher']; 
        }
    }

};
if(!isset($filter_open)) {
    $filter_open = 'NO';
}
?>
<div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="search-adv-search">
                                    <div class="form-group bx-fin-se">
                                        <div class="autocomplete">
                                            <input type="text" id="teacher_search" name="searchText" class="form-control" placeholder="Search Teacher by name" value="<?php if(isset($searchParam) && $searchParam!='') { echo $searchParam; } ?>"  autocomplete="off">
                                        </div>
                                        <input type="hidden" name="fetchdata" value="<?php if(isset($fetchdata)) { echo $fetchdata; } ?>">
                                    </div>
                                    <div class="form-group bx-fin-se hide">
                                        <div class="styled-select">
                                            <select name="filterby" id="filterby" class="form-control">
                                                <option value="school">School </option>
                                                <option value="teacher" selected>Teacher</option>
                                            </select>                                       
                                        </div>
                                    </div>                  
                                    <div class="form-group bx-fin-se">
                                        <button type="submit" class="btn-1">Find</button>
                                        <!-- <a href="#">Advanced Search</a> -->
                                    </div>
                                </div>
                                <div class="styled-select text-center">                             
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Advanced Search</h6>
                                            <!-- <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span> -->
                                            <span class="pull-right clickable panel-collapsed"><i class="fa fa-plus"></i></span>
                                        </div>
                                        <?php
                                        $filter_style= "display:none";
                                        if($filter_open=='YES') {
                                            $filter_style= "display:block";
                                        }
                                        ?>
                                        <div class="panel-body" style="display: none;">
                                            <div id="school" class="hide">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Type</label>
                                                            <select name="type[]" class="multiselect-ui form-control" multiple="multiple">
                                                                <?php
                                                                $typeArr = array('primary','secondary','tertiary','special needs');
                                                                foreach ($typeArr as $key => $value) {
                                                                    $sel_type = '';
                                                                    if(is_array($type)) {
                                                                        if(in_array($value, $type)) {
                                                                            $sel_type = 'selected';
                                                                        }
                                                                    }
                                                                    else {  
                                                                        if(isset($findSchool)) {
                                                                            $sel_type = ($type == $value) ? 'selected' : '';
                                                                        }
                                                                    }
                                                                ?>
                                                                <option value="<?php echo $value; ?>" <?php echo $sel_type ?>><?php echo ucwords($value); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>State</label> 
                                                            <select name="state" class="form-control">
                                                                <option value="">State</option>
                                                                <?php
                                                                foreach ($state as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Distance</label> 
                                                            <select name="distance" class="form-control">
                                                                <option value="">Distance</option>
                                                                <option value="10">10km</option>
                                                                <option value="20">20km</option>
                                                                <option value="40">40km</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">    
                                                            <label>Sector</label>
                                                            <select name="sector[]" class="multiselect-ui form-control" multiple="multiple">
                                                               <?php
                                                                $sectorArr = array('public','private','indepedent','government');
                                                                foreach ($sectorArr as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value; ?>"><?php echo ucwords($value); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">    
                                                            <label>Gender</label>   
                                                            <select name="gender" class="form-control">
                                                                <option value="">Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="coeducation">Co-Education</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">    
                                                            <label>Religion</label> 
                                                            <select name="religion" class="form-control">
                                                                <option value="">Religion</option>
                                                                <option value="christian">Christian</option>
                                                                <option value="catholic">Catholic</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">    
                                                            <label>Students</label> 
                                                            <?php
                                                            $studentsArr = array('20-200','201-500','501-800','800+');
                                                            ?>
                                                            <select name="no_of_students" class="form-control" onchange="filterProcess();">
                                                                <option value="">Students</option>
                                                                <?php
                                                                foreach ($studentsArr as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se"> 
                                                                <div class="check-list">
                                                                    <input type="checkbox" name="selective" id="selective" value="1" /><label for="selective">Selective</label>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se"> 
                                                                <div class="check-list">
                                                                    <input type="checkbox" name="boarding" id="boarding" value="1" /><label for="boarding">Boarding</label>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se">
                                                                <div class="check-list">
                                                                    <input type="checkbox" name="international_students" id="international_students" value="1" /><label for="international_students">International Students Accepted </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se">
                                                                <div class="check-list">
                                                                    <input type="checkbox" id="special_needs_support" name="special_needs_support" value="1" /><label for="special_needs_support">Infrastructure for Special Needs</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se">
                                                                <div class="check-list">
                                                                    <input type="checkbox" id="scholarship_offer" name="scholarship_offer" value="1" /><label for="scholarship_offer">Scholarships offered</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-tick">
                                                            <div class="checkbox-se">
                                                                <div class="check-list">
                                                                    <input type="checkbox" id="international_baccalaureate" name="international_baccalaureate" value="1" /><label for="international_baccalaureate">International Baccalaureate School</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="teacher" class="show">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Special Needs Experience</label>
                                                            <select class="form-control " name="need_experience" id="need_experience" onchange="filterProcess();">
                                                                <option value="">Special Needs Experience</option>
                                                                <option value="1" <?php if(isset($filterby)) { if(isset($need_experience) && $need_experience  == '1') { echo 'selected'; } } ?>>Yes</option>
                                                                <option value="0" <?php if(isset($filterby)) { if(isset($need_experience) && $need_experience  == '0') { echo 'selected'; } } ?> >No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- special_need_category_value -->

                                                    <?php
                                                    if($need_experience=='1') {
                                                        $hide = " ";
                                                    } else {
                                                        $hide = " hide";
                                                    }
                                                    ?>

                                                    <!-- <div class="col-md-3 <?= $hide; ?> " id='special_need_category_div'>
                                                        <div class="form-group">
                                                            <label>Special Needs Categories</label>
                                                            <select class="form-control" name="special_need_category" id="special_need_category"  onchange="filterProcess();">
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($special_need_category as $c_key => $c_value) {
                                                                   $sel = ($special_need_category_value==$c_key) ? 'selected' : '';
                                                                   ?>
                                                                   <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                                                                   <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> -->


                                                    <div class="col-md-6 <?= $hide; ?> " id='special_need_category_div'">
                                                        <div class="form-group">    
                                                            <label>Special Needs Categories</label>
                                                            <select name="special_need_category[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();"> 
                                                                <?php
                                                                foreach ($special_need_category as $key => $value) {
                                                                    $sel_sector = '';
                                                                    if(isset($filterby)) {
                                                                        $sel_sector = in_array($value, $special_need_category_edit) ? 'selected' : '';
                                                                    }
                                                                ?>
                                                                <option value="<?php echo $key; ?>" <?php echo $sel_sector; ?>><?php echo ucwords($value); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <?php /*
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Working with Children</label>
                                                            <select name="working_with_children" id="working_with_children" class="form-control" onchange="filterProcess();"> 
                                                                <option value="">Working with Children</option>                       
                                                                <option value="1" <?php if(isset($filterby)) { if(isset($working_with_children) && $working_with_children  == '1') { echo 'selected'; } } ?>>Yes</option>
                                                                <option value="0" <?php if(isset($filterby)) { if(isset($working_with_children) && $working_with_children  == '0') { echo 'selected'; } } ?>>No</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    */ ?>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>WWCC number provided</label>
                                                            <select name="wwcc_number" id="wwcc_number" class="form-control" onchange="filterProcess();"> 
                                                                <option value="">WWCC number provided</option>                       
                                                                <option value="1" <?php if(isset($filterby)) { if(isset($wwcc_number) && $wwcc_number  == '1') { echo 'selected'; } } ?>>Yes</option>
                                                                <option value="0" <?php if(isset($filterby)) { if(isset($wwcc_number) && $wwcc_number  == '0') { echo 'selected'; } } ?>>No</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    
                                                   <!--  <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>WWCC Number</label>
                                                            <input type="text" class="form-control" name="wwcc_number" placeholder="WWCC Number" value="<?php if(isset($filterby)) { if(isset($wwcc_number)) { echo $wwcc_number; } } ?>" onchange="filterProcess();">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Multilingual</label>
                                                            <select class="form-control" name="multilanguage" id="multilanguage" onchange="filterProcess();">
                                                                <option value="">Multilingual</option>
                                                                <option value="1" <?php if(isset($filterby)) { if(isset($multilanguage) && $multilanguage == '1') { echo 'selected'; } } ?>>Yes</option>
                                                                <option value="0" <?php if(isset($filterby)) { if(isset($multilanguage) && $multilanguage == '0') { echo 'selected'; } } ?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Language</label>
                                                            <select name="language[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();">
                                                                <?php
                                                                $languages = $this->common->get_all_record('tbl_language',"*",array('isDelete'=>0));
                                                                // $typeArr = array('English','Spanish','Chinese','Russian','Arabic','Japanese','German');
                                                                foreach ($languages as $lang_key => $lang) {
                                                                    $sel_type = '';
                                                                    if(isset($filterby)) {
                                                                        $sel_type = in_array($lang['language'], $type) ? 'selected' : '';
                                                                    }
                                                                ?>
                                                                <option value="<?php echo $lang['language']; ?>" <?php echo $sel_type ?>><?php echo ucwords($lang['language']); ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Tutoring Service</label> 
                                                            <select class="form-control" name="tutoring_services" id="tutoring_services" onchange="filterProcess();">
                                                                <option value="">Tutoring Services</option>
                                                                <option value="1" <?php if(isset($filterby)) { if(isset($tutoring_services) && $tutoring_services == '1') { echo 'selected'; } } ?>>Yes</option>
                                                                <option value="0" <?php if(isset($filterby)) { if(isset($tutoring_services) && $tutoring_services == '0') { echo 'selected'; } } ?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Preferred hours</label>
                                                            <input type="text" class="form-control" name="preferred_hours" value="<?php if(isset($filterby)) { if(isset($preferred_hours)) { echo $preferred_hours; } } ?>" placeholder="Preferred hours" onchange="filterProcess();">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>