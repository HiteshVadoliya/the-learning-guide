<?php
$special_needs_support = "";
$special_need_category_value = "";
if(isset($_GET['special_needs_support']) && $_GET['special_needs_support']!='')
{
    $special_needs_support = $_GET['special_needs_support']; 
    if($special_needs_support=='1') {
        if(isset($_GET['special_need_category'])) {
            $special_need_category_value = $_GET['special_need_category']; 
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
                    <input type="text" id="school_search" name="searchText" class="form-control" placeholder="Search School by name" value="<?php if(isset($searchParam) && $searchParam!='') { echo $searchParam; } ?>" autocomplete="off" >
                </div>
                <input type="hidden" name="fetchdata" value="<?php if(isset($fetchdata)) { echo $fetchdata; } ?>">
            </div>
            <div class="form-group bx-fin-se hide">
                <div class="styled-select">
                    <select name="filterby" id="filterby" class="form-control">
                        <option value="school" selected="">School </option>
                        <option value="teacher">Teacher</option>
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
                <div class="panel-body" style="<?= $filter_style; ?>">
                    <div id="school"  class="show">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type[]" id="type" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();">
                                        <?php
                                        $typeArr = array('primary','secondary','tertiary'=>array('tafe','college','university'),'special needs');
                                        foreach ($typeArr as $key => $value) {
                                            $sel_type = $sel_subtype = '';
                                            if(isset($filterby)) {
                                                // $type = explode(',', $type);
                                                if(is_array($type)) {
                                                    if(in_array($value, $type)) {
                                                        $sel_type = 'selected';
                                                    }
                                                }
                                            }
                                           /**/
                                           if(is_array($value)) {
                                                $subtype = array();
                                                if(isset($filterby)) {
                                                    $selectArr = array('tafe','college','university');
                                                    foreach ($selectArr as $key1 => $value1) {
                                                        if(in_array($value1, $type)) {
                                                            array_push($subtype, $value1);
                                                        }
                                                    }
                                                    if(in_array($key, $type)) {
                                                        $sel_type = 'selected';
                                                    } else {
                                                        $sel_type = '';
                                                    }
                                                }
                                              ?>
                                              <option value="<?php echo $key; ?>" <?php echo $sel_type ?>><?php echo ucwords($key); ?></option>
                                              <optgroup label="">
                                                 <?php
                                                 foreach ($value as $key1 => $value1) {
                                                    if($sel_type == 'selected') {
                                                       if(in_array($value1, $subtype)) {
                                                          $sel_subtype = 'selected';
                                                       } else {
                                                          $sel_subtype = '';
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Area</label>
                                    <div class="autocomplete">
                                        <input type="text" name="area" id="area" class="form-control" placeholder="Area" autocomplete="off" value="<?php if(isset($filterby) && isset($area)) { echo $area; } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Location</label> 
                                    <select name="state" class="form-control" onchange="filterProcess();">
                                        <option value="">Location </option>
                                        <?php
                                        foreach ($statelist as $key => $value) {
                                            $seleted = '';
                                            if(isset($state)) {
                                                $seleted = $state == $value['id'] ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo $seleted; ?> ><?php echo $value['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Distance</label> 
                                    <select name="distance" class="form-control" onchange="filterProcess();">
                                        <option value="">Distance</option>
                                        <?php
                                        $distanceArr = array('10','20','40','40');
                                        foreach ($distanceArr as $key => $value) {
                                            $sel_distance = '';
                                            if(isset($filterby)) {
                                                $sel_distance = ($distance == $value) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $value; ?>" <?php echo $sel_distance; ?>>
                                            <?php echo $value; ?>km<?php if($key==3) { echo "+"; } ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Sector</label>
                                    <select name="sector[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();">    
                                        <?php
                                        $sectorArr = array('public','private','independent','government');
                                        foreach ($sectorArr as $key => $value) {
                                            $sel_sector = '';
                                            if(isset($filterby)) {
                                                $sel_sector = in_array($value, $sector) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $value; ?>" <?php echo $sel_sector; ?>><?php echo ucwords($value); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Gender</label>   
                                    <select name="gender" class="form-control" onchange="filterProcess();">
                                        <option value="">Gender</option>
                                        <?php
                                        $genderArr = array('male'=>'Male','female'=>'Female','coeducation'=>'Coeducation');
                                        foreach ($genderArr as $key => $value) {
                                            $sel_gender = '';
                                            if(isset($filterby)) {
                                                $sel_gender = ($gender == $key) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel_gender; ?>><?php echo $value; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Religion</label> 
                                    <select name="religion" class="form-control" onchange="filterProcess();">
                                        <option value="">Religion</option>
                                        <?php
                                        $religionArr = array('christian'=>'Christian','catholic'=>'Catholic');
                                        foreach ($religionArr as $key => $value) {
                                            $sel_religion = '';
                                            if(isset($filterby)) {
                                                $sel_religion = ($religion == $key) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel_religion; ?>><?php echo $value; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Students</label> 
                                    <?php
                                    $studentsArr = array('0-200','201-500','501-1000','1000+');
                                    ?>
                                    <select name="no_of_students" class="form-control" onchange="filterProcess();">
                                        <option value="">Students</option>
                                        <?php
                                        foreach ($studentsArr as $key => $value) {
                                            $sel_no_of_students = '';
                                            if(isset($filterby)) {
                                                $sel_no_of_students = ($no_of_students == $value) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $value; ?>" <?php echo $sel_no_of_students; ?>><?php echo $value; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <?php
                                            /*$selectiveCheck = '';
                                            if(isset($filterby) && isset($selective)) {
                                                $selectiveCheck = ($selective == '1') ? 'checked' : '';
                                            }*/
                                            ?>

                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Selective</label>
                                    <select class="form-control " name="selective" id="selective" onchange="filterProcess();" >
                                        <option value="">Selective</option>
                                        <option value="1" <?php if(isset($filterby) && isset($selective) && $selective=='1') { echo 'selected'; } ?>>Yes</option>
                                        <option value="0" <?php if(isset($filterby) && isset($selective) && $selective=='0') { echo 'selected'; } ?>>No</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">    
                                    <label>Special Needs Support -</label>
                                    <select class="form-control " name="special_needs_support" id="special_needs_support" onchange="filterProcess();" >
                                        <option value="">Special Needs Support</option>
                                        <option value="1" <?php if($special_needs_support=='1') { echo 'selected'; } ?>>Yes</option>
                                        <option value="0" <?php if($special_needs_support=='0') { echo 'selected'; } ?>>No</option>
                                    </select>
                                </div>
                            </div>

                            

                            <?php
                            if($special_needs_support=='1') {
                                $hide = " ";
                            } else {
                                $hide = " hide";
                            }

                            ?>

                           <!--  <div class="col-md-3 <?= $hide; ?>" id='special_need_category_div'>
                                <div class="form-group">    
                                    <label>Special Needs Categories</label>
                                    <select class="form-control" name="special_need_category" id="special_need_category"  onchange="filterProcess();">
                                        <option value="">--Select--</option>
                                        <?php
                                        foreach ($special_need_category as $c_key => $c_value) {
                                           $sel = ($c_key==$special_need_category_value) ? 'selected' : '';
                                           ?>
                                           <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                                           <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->
                            

                            <div class="col-md-6 <?= $hide; ?>" id='special_need_category_div'">
                                <div class="form-group">    
                                    <label>Special Needs Categories</label>
                                    <select name="special_need_category[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();"> 
                                        <?php
                                        foreach ($special_need_category as $key => $value) {
                                            $sel_sector = '';
                                            if(isset($filterby)) {
                                                $sel_sector = in_array($value, $special_need_category_value) ? 'selected' : '';
                                            }
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel_sector; ?>><?php echo ucwords($value); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <!-- <div class="col-md-3">
                                <div class="p-tick">
                                    <div class="checkbox-se"> 
                                        <div class="check-list">
                                            <?php
                                            $selectiveCheck = '';
                                            if(isset($filterby) && isset($selective)) {
                                                $selectiveCheck = ($selective == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" name="selective" id="selective" value="1" onchange="filterProcess();" <?php echo $selectiveCheck; ?> /><label for="selective">Selective</label>    
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="p-tick">
                                    <div class="checkbox-se"> 
                                        <div class="check-list">
                                            <?php
                                            $boardCheck = '';
                                            if(isset($filterby) && isset($boarding)) {
                                                $boardCheck = ($boarding == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" name="boarding" id="boarding" value="1" onchange="filterProcess();" <?php echo $boardCheck; ?> /><label for="boarding">Boarding / Housing</label>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-tick">
                                    <div class="checkbox-se">
                                        <div class="check-list">
                                            <?php
                                            $internationalCheck = '';
                                            if(isset($filterby) && isset($international_students)) {
                                                $internationalCheck = ($international_students == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" name="international_students" id="international_students" value="1" onchange="filterProcess();" <?php echo $internationalCheck; ?> /><label for="international_students">International Students Accepted </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="p-tick">
                                    <div class="checkbox-se">
                                        <div class="check-list">
                                            <?php
                                            $specialCheck = '';
                                            if(isset($filterby) && isset($special_needs_support)) {
                                                $specialCheck = ($special_needs_support == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" id="special_needs_support" name="special_needs_support" value="1" onchange="filterProcess();" <?php echo $specialCheck; ?> /><label for="special_needs_support">Infrastructure for Special Needs</label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="p-tick">
                                    <div class="checkbox-se">
                                        <div class="check-list">
                                            <?php
                                            $scholarshipCheck = '';
                                            if(isset($filterby) && isset($scholarship_offer)) {
                                                $scholarshipCheck = ($scholarship_offer == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" id="scholarship_offer" name="scholarship_offer" value="1" onchange="filterProcess();" <?php echo $scholarshipCheck; ?> /><label for="scholarship_offer">Scholarships offered</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $ib_diploma_hide = 'style="display: none;"';
                            if(isset($filterby)) {
                                if (isset($type)) {
                                    if(in_array('secondary', $type)) {
                                        $ib_diploma_hide = '';
                                    }
                                }
                            }
                            ?>
                            <div class="col-md-3" id="ib-diploma" <?php echo $ib_diploma_hide; ?>>
                                <div class="p-tick">
                                    <div class="checkbox-se">
                                        <div class="check-list">
                                            <?php
                                            $interBaccCheck = '';
                                            if(isset($filterby) && isset($international_baccalaureate)) {
                                                $interBaccCheck = ($international_baccalaureate == '1') ? 'checked' : '';
                                            }
                                            ?>
                                            <input type="checkbox" id="international_baccalaureate" name="international_baccalaureate" value="1" onchange="filterProcess();" <?php echo $interBaccCheck; ?> /><label for="international_baccalaureate">IB Diploma Programme</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="teacher" class="hide">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Special Needs Experience</label>
                                    <select class="form-control" name="need_experience">
                                        <option value="">Special Needs Experience</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Working with Children</label>
                                    <select name="working_with_children" id="working_with_children" class="form-control">
                                        <option value="">Working with Children</option>                       
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>WWCC Number</label>
                                    <input type="text" class="form-control" name="wwcc_number" placeholder="WWCC Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Multilingual</label>
                                    <select class="form-control" name="multilanguage" id="multilanguage">
                                        <option value="">Multilingual</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Language</label>
                                    <select name="language[]" class="multiselect-ui form-control" multiple="multiple">
                                        <?php
                                        $typeArr = array('English','Spanish','Chinese','Russian','Arabic','Japanese','German');
                                        foreach ($typeArr as $key => $value) {
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
                                    <label>Tutoring Service</label> 
                                    <select class="form-control" name="tutoring_services" id="tutoring_services">
                                        <option value="">Tutoring Services</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Preferred hours</label>
                                    <input type="text" class="form-control" name="preferred_hours" value="" placeholder="Preferred hours">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>