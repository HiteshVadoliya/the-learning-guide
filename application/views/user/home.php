
<link rel="stylesheet" href="<?php echo F_CSSPATH ?>animate.min.css">
<link rel="stylesheet" href="<?php echo F_CSSPATH ?>morphext.css">
<link rel="stylesheet" href="<?php echo F_CSSPATH ?>owl.carousel.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="<?php echo F_JSPATH ?>typed.min.js" type="text/javascript"></script>

<style type="text/css">
.checked { color: #f1b500; }
.pro-box h4 a { color: #000; }
.upper-text-se .panel-heading{
    width: 20%;
    background: #000 !important;
    position: absolute;
    top: -38px;
    right: 0;
    color: #fff;
     text-align: left !important; 
    border-radius: 0;
}
.upper-text-se .panel-body{}


.upper-text-se .panel.panel-default{
    margin:0px;
    margin-top: 20px;
    box-shadow: none;
    border-radius: 0px;
    border:none;
}
.styled-select{overflow: visible;}

.styled-select .panel-title{
    font-size: 13px !important; 
}
.panel-heading span {
    margin-top: -17px;
    font-size: 14px;
    margin-right: -8px;
}

</style>
<?php /* ?><div class="icon-bar-right">
  <a href="#" data-toggle="tooltip" data-placement="left" data-original-title="Uniforms and accessories" class="icon-box"><span><img src="<?php echo FRONTENDPATH ?>images/icon-1.png"></span></a>   
  <a href="#" data-toggle="tooltip" data-placement="left" data-original-title="Study notes and books" class="icon-box"><span><img src="<?php echo FRONTENDPATH ?>images/icon-2.png"></span></a>   
  <a href="#" data-toggle="tooltip" data-placement="left" data-original-title="Stationery" class="icon-box last-child"><span><img src="<?php echo FRONTENDPATH ?>images/icon-3.png"></span></a>   
</div><?php */ ?>

<div class="slider-se">
    <div class="main-banner-img-se">
        <div class="container">             
            <div class="upper-text-se">
                <?php /*<form id="searchForm" method="post" action="<?php echo base_url('searchquery') ?>"> */ ?>
                <form id="searchForm" method="get" action="<?php echo base_url('search') ?>">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">


                            <?php
                            if(null !== $this->session->flashdata('msg')) {
                                $message = $this->session->flashdata('msg');
                                echo "<div class='alert alert-".$message["class"]." alert-dismissable' class=".$message["class"].">".$message["message"]."</div>"; 
                            } ?>
                            
                            <h1>FIND<span><img src="<?php echo F_IMGPATH ?>check.png"></span> COMPARE<span><img src="<?php echo F_IMGPATH ?>check.png"></span> REVIEW<span><img src="<?php echo F_IMGPATH ?>check.png"></span></h1>
                            <h3>Australian Schools and Teachers<br> in Primary, Secondary, Tertiary and Special Needs education</h3>
                            <?php /* ?><div class="search-pennal">
                                <div class="form-group">
                                    <input type="text" name="searchText" id="searchText" class="form-control" placeholder="Search schools or teachers by name" autocomplete="off">
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="btn-se">
                                <button type="submit" name="schoolBtn" class="btn-1">FIND A SCHOOL</button>
                                <button type="submit" name="teacherBtn" class="btn-1">FIND A TEACHER</button>
                            </div> <?php */ ?>
                            
                            <div class="search-adv-search">
                                <div class="form-group bx-fin-se">
                                    <input type="text" name="searchText" class="form-control" placeholder="Search by name or location" autocomplete="off">
                                </div>
                                <div class="form-group bx-fin-se">
                                    <div class="styled-select">
                                        <select name="filterby" id="filterby" class="form-control">
                                            <option value="school">School </option>
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
                                    <div class="panel-body" style="display: none;">

                                        <div id="school">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select name="type[]" id="type" class="multiselect-ui form-control" multiple="multiple">
                                                            <?php
                                                            $typeArr = array('primary','secondary','tertiary'=>array('tafe','college','university'),'special needs');
                                                            foreach ($typeArr as $key => $value) {
                                                                $sel_type = '';
                                                                if(isset($type)) {
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
                                                                }
                                                                if(is_array($value)) {
                                                                ?>
                                                                <option value="<?php echo $key; ?>" <?php echo $sel_type ?>><?php echo ucwords($key); ?></option>
                                                                <optgroup label="">
                                                                    <?php
                                                                    foreach ($value as $key1 => $value1) {
                                                                    ?>
                                                                    <option value="<?php echo $value1 ?>" class="inner-select-optgroup"><?php echo ucwords($value1) ?></option>
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
                                                            ?>
                                                            <?php
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
                                                        <select name="state" class="form-control myinputchange">
                                                            <option value="">Location</option>
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
                                                            <option value="40">40km+</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">    
                                                        <label>Sector</label>
                                                        <select name="sector[]" class="multiselect-ui form-control" multiple="multiple">
                                                           <?php
                                                            $sectorArr = array('public','private','independent','government');
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
                                                            <option value="coeducation">Coeducation</option>
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
                                                        $studentsArr = array('0-200','201-500','501-1000','1000+');
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
                                                    <div class="form-group">    
                                                        <label>Selective</label>
                                                        <select class="form-control " name="selective" id="selective" >
                                                            <option value="">Selective</option>
                                                            <option value="1" >Yes</option>
                                                            <option value="0" >No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">    
                                                        <label>Special Needs Support</label>
                                                        <select class="form-control " name="special_needs_support" id="special_needs_support" >
                                                            <option value="">Special Needs Support</option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-3 hide special_need_category_div" >
                                                    <div class="form-group">    
                                                        <label>Special Needs Categories</label>
                                                        <select class="form-control" name="special_need_category" id="special_need_category"  >
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($special_need_category as $c_key => $c_value) {
                                                               $sel = '';
                                                               ?>
                                                               <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                                                               <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->

                                                <div class="col-md-6 hide special_need_category_div">
                                                    <div class="form-group">    
                                                        <label>Special Needs Categories</label>
                                                        <select name="special_need_category[]" class="multiselect-ui form-control" multiple="multiple" >
                                                           <?php
                                                            foreach ($special_need_category as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $value; ?>"><?php echo ucwords($value); ?></option>
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
                                                                <input type="checkbox" name="selective" id="selective" value="1" /><label for="selective">Selective</label>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-3">
                                                    <div class="p-tick">
                                                        <div class="checkbox-se"> 
                                                            <div class="check-list">
                                                                <input type="checkbox" name="boarding" id="boarding" value="1" /><label for="boarding">Boarding / Housing</label>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <div class="col-md-3" id="ib-diploma" style="display: none;">
                                                    <div class="p-tick">
                                                        <div class="checkbox-se">
                                                            <div class="check-list">
                                                                <input type="checkbox" id="international_baccalaureate" name="international_baccalaureate" value="1" /><label for="international_baccalaureate">IB Diploma Programme</label>
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
                                                        <select class="form-control" name="need_experience" id="need_experience">
                                                            <option value="">Special Needs Experience</option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-3 hide special_need_category_div" >
                                                    <div class="form-group">
                                                        <label>Special Needs Categories</label>
                                                        <select class="form-control" name="special_need_category_teacher" id="special_need_category_teacher"  >
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($special_need_category as $c_key => $c_value) {
                                                               $sel = '';
                                                               ?>
                                                               <option value="<?= $c_key; ?>" <?= $sel; ?> ><?= $c_value; ?></option>
                                                               <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> -->

                                                <div class="col-md-6 hide special_need_category_div_teacher">
                                                    <div class="form-group">    
                                                        <label>Special Needs Categories</label>
                                                        <select name="special_need_category_teacher[]" class="multiselect-ui form-control" multiple="multiple">
                                                           <?php
                                                            foreach ($special_need_category as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $value; ?>"><?php echo ucwords($value); ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Working with Children</label>
                                                        <select name="working_with_children" id="working_with_children" class="form-control">
                                                            <option value="">Working with Children</option>                       
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>WWCC number provided</label>
                                                        <!-- <input type="text" class="form-control" name="wwcc_number" placeholder="WWCC Number"> -->
                                                        <select name="wwcc_number" id="wwcc_number" class="form-control">
                                                            <option value="">WWCC number provided</option>                       
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
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
                                                            $languages = $this->common->get_all_record('tbl_language',"*",array('isDelete'=>0));
                                                            // $typeArr = array('English','Spanish','Chinese','Russian','Arabic','Japanese','German');
                                                            foreach ($languages as $lang_key => $lang) {
                                                            ?>
                                                            <option value="<?php echo $lang['language']; ?>"><?php echo ucwords($lang['language']); ?></option>
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
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>

<div class="title-se" style="    padding: 20px 0;">  
    <div class="container text-center">
        <script>hljs.initHighlightingOnLoad();</script>
        <h2>WE HELP YOU
            <span id="typed-strings">
                <span>find the right school </span>
                <span>read school and teacher reviews </span>
                <span>compare schools </span>
                <span>leave school reviews</span>
                <span>leave teacher reviews</span>
                <span>assess schools and teachers </span>
                <span>learn more about your teacher</span>
                <span>find teachers who tutor</span>                
            </span>
            <span id="typed" style="/*white-space:pre;*/"></span>
        </h2>
    </div>
</div>

<!-- <section class="counter" style="margin-bottom: 70px;">
        <div class="main_counter_area">
            <div class="overlay">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="col-md-2 col-sm-3 text-center counter_progess">                                
                                <div class="counter_num" id="month_visit"><?php echo $tot_month_visit; ?></div>
                                <span class="count_nm">Monthly visits</span>                                                                          
                            </div>
                            <div class="col-md-2 col-sm-3 text-center counter_progess">                                
                                <div class="counter_num" id="tot_review"><?php echo $tot_review; ?></div>
                                <span class="count_nm">Reviews</span>                                                                          
                            </div>
                            <div class="col-md-2 col-sm-3 text-center counter_progess">                                
                                <div class="counter_num" id="tot_school"><?php echo $tot_school; ?></div>
                                <span class="count_nm">Schools</span>                                                                          
                            </div>
                            <div class="col-md-2 col-sm-3 text-center counter_progess">                                
                                <div class="counter_num" id="tot_teacher"><?php echo $tot_teacher; ?></div>
                                <span class="count_nm">Teacher</span>                                                                          
                            </div>
                            <?php /* ?>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="progressbar">
                                    <div class="second circle" data-percent="<?php echo $tot_review; ?>">
                                        <strong></strong>  
                                        <span>Reviews</span>                                          
                                    </div>
                                </div>
                            </div>                                
                            <div class="col-md-3 col-sm-3 ">
                                <div class="progressbar">
                                    <div class="second circle" data-percent="<?php echo $tot_school; ?>">
                                        <strong></strong>                                            
                                        <span>Schools</span>                                          

                                    </div>                            
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="progressbar">
                                    <div class="second circle" data-percent="<?php echo $tot_teacher; ?>">
                                        <strong></strong>                                            
                                        <span>Teacher</span>                                          

                                    </div>                            
                                </div>
                            </div>
                            <?php */?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section> -->












<div class="new-btn-se">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>HIGH ACHIEVERS</h2>
                <P>Browse the top rated school and teacher profiles as voted by real students, parents and teachers</P>
            </div>
            <div class="col-md-8">
                <ul class="black-btn-se">
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="top-10-school-in-australia">
                            <button class="black-button">Top 10 schools in australia</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo $most_view_school_href ?>" method="post">
                            <!-- <input type="hidden" name="filterby" value="school"> -->
                            <!-- <input type="hidden" name="fetchdata" value="most-viewed-school"> -->
                            <button class="black-button">most Viewed school </button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="top-10-teacher-in-australia">
                            <button class="black-button">Top 10 teachers in australia</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo $most_view_teacher_href ?>" method="post">
                            <!-- <input type="hidden" name="filterby" value="teacher"> -->
                            <!-- <input type="hidden" name="fetchdata" value="most-viewed-teacher"> -->
                            <button class="black-button">most viewed Teacher </button>
                        </form>
                    </li>

                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="top-10-primary-schools">
                            <button class="black-button">Top 10 primary schools </button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="top-10-secondary-schools">
                            <button class="black-button">Top 10 Secondary Schools</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="top-10-tertiary-schools">
                            <button class="black-button">Top 10 tertiary schools</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="top-10-special-needs-schools">
                            <button class="black-button">top 10 special needs schools</button>
                        </form>
                    </li>
                </ul>

                <ul class="yellow-btn-se">
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-nsw">
                            <button class="black-button">best school in nsw</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-nsw">
                            <button class="black-button">best teacher in nsw</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-vic">
                            <button class="black-button">best school in vic</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-vic">
                            <button class="black-button">best teacher in vic</button>
                        </form>
                    </li>

                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-qld">
                            <button class="black-button">best school in qld</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-qld">
                            <button class="black-button">best teacher in qld</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-nt">
                            <button class="black-button">best school in nt</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-nt">
                            <button class="black-button">best teacher in nt</button>
                        </form>
                    </li>

                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-wa">
                            <button class="black-button">best school in wa</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-wa">
                            <button class="black-button">best teacher in wa</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-sa">
                            <button class="black-button">best school in sa</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-sa">
                            <button class="black-button">best teacher in sa</button>
                        </form>
                    </li>

                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-act">
                            <button class="black-button">best school in act</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-act">
                            <button class="black-button">best teacher in act</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="school">
                            <input type="hidden" name="fetchdata" value="best-school-in-tas">
                            <button class="black-button">best school in tas</button>
                        </form>
                    </li>
                    <li>
                        <form action="<?php echo base_url('search') ?>" method="get">
                            <input type="hidden" name="filterby" value="teacher">
                            <input type="hidden" name="fetchdata" value="best-teacher-in-tas">
                            <button class="black-button">best teacher in tas</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php /*
<div class="school-teacher-se">
    <div class="container text-center">
        <div class="col-md-6">
            <div class="sch-tea-se">
                <h3>SCHOOLS</h3>
                <p>Tell us what you like about your school!</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="sch-tea-se">
                <h3>TEACHERS</h3>
                <p>Give your teachers a positive review!</p>
            </div>
        </div>
    </div>
</div>

<div class="service-se">        
    <div class="cat-1-img-se">
        <img src="<?php echo FRONTENDPATH ?>images/cat-1.png" alt="123">
    </div>
    <div class="tab-se">
        <div class="circal"></div>
        <div class="container">
            <a href="javascript:void(0);">AUSTRALIA’S LARGEST </a><a href="javascript:void(0);"> USER REVIEW GUIDE FOR SCHOOLS AND TEACHERS. </a>
        </div>
    </div>
    <div class="service-detail-se">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-1.png" alt="">
                        </div>
                        <h4>Find the right school</h4>
                        <p>Every school profile has a star rating, written reviews, comparative metrics report and category assessment. A general overview, contact info and teacher list is also available. </p>   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-2.png" alt="">
                        </div>
                        <h4>Learn more about your teacher</h4>
                        <p>Find a teacher, download their resume, contact them, analyse their comparative metrics or learn more about them through user feedback.</p>   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-3.png" alt="">
                        </div>
                        <h4>Compare performance</h4>
                        <p>Learn more about how each school or teacher is ranked as we compare each profile and give you easy to share and read metrics.</p>    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-4.png" alt="">
                        </div>
                        <h4>Read the latest news</h4>
                        <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles. </p>    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-5.png" alt="">
                        </div>
                        <h4>Attend FREE workshops</h4>
                        <p>Learn new skills and network  with mentors or fellow students to enhance your learning experience because we make study easier. </p> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box text-center">
                        <div class="img-box">
                            <img src="<?php echo FRONTENDPATH ?>images/img-6.png" alt="">
                        </div>
                        <h4>Save important dates</h4>
                        <p>Our calendar has all the important dates and events in education.You may save these important dates directly to your calendar or upload a new date/event for the public to see.</p>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>

<div class="pro-service-se">
    <div class="cat-1-img-se">
        <img src="<?php echo F_IMGPATH; ?>cat-1.png" alt="123">
    </div>
    <div class="container">
        <div class="ger-title">
            <h2>TOP SCHOOLS <span>Near You</span>
            <!-- <div>‘Top schools’ are ranked according to star ratings.</div> -->
            <div>'Top Schools' are ranked according to user star reviews</div>
            </h2>            
        </div>

        <div class="out-pro-se">
            <div class="row">

            	<?php
                $numOfCols = 4;
                $rowCount = 0;
                $schoolCount = count($school);
                $bootstrapColWidth = 12 / $numOfCols;

            	foreach ($school as $key => $value) {
            	?>
                <div class="col-md-3 col-sm-6">
                    <div class="pro-box">
                        <div class="pro-img">
                            <?php
                            if($value['photos'] != '') {
                                $image = json_decode($value['photos'],true);
                                $image = $image[0];
                                if(file_exists(PhotosPath.$image)) {
                                ?>
                                <img src="<?php echo base_url().PhotosPath.$image; ?>" alt="">
                                <?php
                                }
                                else {
                                ?>
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                                <?php
                                }
                            }
                            else {
                            ?>
                            <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            <?php
                            }
                            ?>
                        </div>
                        <h4><a href="<?php echo base_url('school/'.md5($value['id'])); ?>"><?php echo $value['name'] ?></a></h4>
                        <ul class="star-se">
                            <?php
                            $average_rating = intval($value['average_rating']);
                            for ($i=1; $i <= 5; $i++) {
                                $checked = ($i <= $average_rating) ? 'checked' : '';
                            ?>
                            <span class="fa fa-star <?php echo $checked; ?>"></span>
                            <?php
                            }
                            ?>
                            <li>                                    
                                <?php echo $value["total_rating"]; ?> reviews
                            </li>
                        </ul>

                    </div>
                </div>
            	<?php
                    $rowCount++;
                    $class = $id = '';
                    if($rowCount > 7) {
                        // $class = 'hide';
                        $id = 'id="viewmore" style="display:none;"';
                    }
                    if($rowCount < $schoolCount) {
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row '.$class.'" '.$id.'>';
                    }
            	}
            	?>

            </div>
            <div class="row <?php if($schoolCount <= 8) { echo 'hide'; } ?>">
                <div class="col-md-12 text-center">
                    <button class="plus-minus viewMoreBtn"><i class="fa fa-plus fa-3x"></i></button>
                </div>
            </div>
        </div>

        <!-- <div class="other-upper-text">
            <h3>‘Top schools’ are ranked according to star ratings.<h3>            
        </div> -->
    </div>

    
</div>


<!-- ***************************************** -->
<style type="text/css">
    .carousel-3d-container[data-v-c06c963c], .carousel-3d-slider[data-v-c06c963c]{
        height: 600px !important;
        overflow: visible;
    }
    .carousel-3d-slide{
        background: transparent;
        border:none;
        overflow: visible;
        height: 490px!important;
    }
    .carousel-3d-slide.current{
        height: 490px!important;
    }
</style>
<!-- TESTIMONIALS -->
<?php if( count($featured_teacher) > 0 ){ ?>
    <div class="testimonial-se">
        <div class="container">
            <div class="ger-title">
                <h2>FEATURED TEACHERS
                    <div>Read teacher reviews, find a tutor, contact a teacher or leave a review </div>
                </h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="carousel3d">
                        <carousel-3d :perspective="0" :display="5" :controls-visible="true" :autoplay="true">
                        <?php 
                        $n=1;
                        foreach ($featured_teacher as $teacher) { 
                        $rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$teacher['id'],'isDelete'=>0),'teacherId');
                        $rating = (!empty($rating)) ? $rating[0] : array();
                        $current_school_det = $this->common->get_one_row('tbl_school',array('id'=>$teacher['teach_school']));
                        $current_school = ucwords($current_school_det['name']);
                        ?>
                        <a href="<?php echo base_url().'teacher/'.md5($teacher['id']) ; ?> ">
                            <slide :index="<?php echo $n; ?>">
                                <div class="shadow-effect">

                                    <?php if(!empty($teacher['profile_img'])) { ?>

                                        <img class="profile-img" src="<?php echo base_url().ProfilePath.$teacher['profile_img']; ?>" alt="">

                                    <?php }else {?>

                                        <img class="profile-img" src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">

                                    <?php } ?>

                                    <div class="content-box">
                                        <h4><?php echo ucfirst($teacher['fname']).' '.ucfirst($teacher['lname']) ?></h4>

                                        <ul class="star-se">
                                        <?php
                                        $average_rating = '';
                                        $total_rating = 0;
                                        if(!empty($rating)) {
                                            $average_rating = $rating['average_rating'];
                                            $total_rating = $rating['total_rating'];
                                        }
                                        for ($i=1; $i <= 5; $i++) {
                                            $checked = ($i <= $average_rating) ? 'checked' : '';
                                        ?>
                                        <span class="fa fa-star <?php echo $checked; ?>"></span>
                                        <?php
                                        }
                                        ?>
                                        
                                        <li>
                                            <?php echo $total_rating; ?> reviews
                                        </li>
                                    </ul>
                                    <?php
                                    $string = $teacher['about'];
                                    $string = strip_tags($string);
                                    if (strlen($string) > 200) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 200);
                                        $endPoint = strrpos($stringCut, ' ');
                                        /**/
                                        $stringCut1 = substr($string, 200, strlen($string));
                                        /**/
                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <div id="feature'.$teacher['id'].'" style="display:none;">'.$stringCut1.'</div><a href="'.base_url().'teacher/'.md5($teacher['id']).'" class="featureBtn" data-id="'.$teacher['id'].'">Read More</a>';
                                    }
                                    echo $string;
                                    ?>
                                    
                                        <div class="bottom-logo-text">
                                            <p>Works @ <?php echo $current_school; ?> 
                                            <?php if($teacher['tutoring_services'] == '1'){ ?>
                                                <span><img src="<?php echo F_IMGPATH; ?>tutor.png"></span>
                                            <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>   
                            </slide>
                        </a>
                          <?php $n++; } ?>
                        </carousel-3d>
                    </div>         

                   

                </div>
            </div>
            <!-- <div class="other-upper-text">
                <h3>Read teacher reviews, find a tutor, contact a teacher or leave a review </h3>
            </div> -->
            <!-- <p class="upper-text-top"></p> -->
        </div>
    </div>
<?php } ?>
    <!-- END OF TESTIMONIALS -->
<script src='<?php echo F_JSPATH ?>vue.js'></script>
<script src='<?php echo F_JSPATH ?>vue-carousel-3d.min.js'></script>
<script >
new Vue({
  el: '#carousel3d',
  data: {
    slides: 7
  },
  components: {
    'carousel-3d': Carousel3d.Carousel3d,
    'slide': Carousel3d.Slide
  }
})
//# sourceURL=pen.js
</script>
<!-- ************************************** -->

<!-- TESTIMONIALS -->
<?php /* if( count($featured_teacher) > 0 ){ ?>
    <div class="testimonial-se">
        <div class="container">
            <div class="ger-title">
                <h2>FEATURED TEACHERS</h2>
            </div>
            <div class="row">
                <div class="col-md-12">         
                    <div id="customers-testimonials" class="owl-carousel">  
                        <?php foreach ($featured_teacher as $teacher) { 
                        $rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$teacher['id'],'isDelete'=>0),'teacherId');
                        $rating = (!empty($rating)) ? $rating[0] : array();
                        $current_school_det = $this->common->get_one_row('tbl_school',array('id'=>$teacher['teach_school']));
                        $current_school = ucwords($current_school_det['name']);
                        ?>
                        <div class="item">
                              <div class="shadow-effect">

                                    <?php if(!empty($teacher['profile_img'])) { ?>

                                        <img class="profile-img" src="<?php echo base_url().ProfilePath.$teacher['profile_img']; ?>" alt="">

                                    <?php }else {?>

                                        <img class="profile-img" src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">

                                    <?php } ?>

                                    <div class="content-box">
                                        <h4><?php echo ucfirst($teacher['fname']).' '.ucfirst($teacher['lname']) ?></h4>

                                        <ul class="star-se">
                                        <?php
                                        $average_rating = '';
                                        $total_rating = 0;
                                        if(!empty($rating)) {
                                            $average_rating = $rating['average_rating'];
                                            $total_rating = $rating['total_rating'];
                                        }
                                        for ($i=1; $i <= 5; $i++) {
                                            $checked = ($i <= $average_rating) ? 'checked' : '';
                                        ?>
                                        <span class="fa fa-star <?php echo $checked; ?>"></span>
                                        <?php
                                        }
                                        ?>
                                        
                                        <li>
                                            <?php echo $total_rating; ?> reviews
                                        </li>
                                    </ul>
                                    <?php echo $teacher['about']; ?>
                                    
                                        <div class="bottom-logo-text">
                                            <p>Works @ <?php echo $current_school; ?> <span><img src="<?php echo F_IMGPATH; ?>tutor.png"></span></p>
                                        </div>
                                    </div>
                              </div>                          
                        </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
            <p style=" font-family: 'Permanent Marker', cursive; color: #000; text-align: center; padding-top: 20px; font-size: 18px;}">Read teacher reviews, find a tutor, learn more about your teacher or leave a review. </p>
        </div>
    </div>
<?php } */ ?>
    <!-- END OF TESTIMONIALS -->



<?php $this->load->view(FRONTEND.'bulletin'); ?>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="<?php echo F_JSPATH ?>custom.js"></script>
<script src="<?php echo F_JSPATH ?>morphext.js"></script>

<script type="text/javascript">
function prettyLog(str) {
  // console.log('%c ' + str, 'color: green; font-weight: bold;');
}
$(document).ready(function() {

    /**/
    var typed = new Typed("#typed", {
        stringsElement: '#typed-strings',
        typeSpeed: 80,
        backSpeed: 50,
        backDelay: 800,
        startDelay: 0,
        loop: true,
        onComplete: function(self) { prettyLog('onCmplete ' + self) },
        preStringTyped: function(pos, self) { prettyLog('preStringTyped ' + pos + ' ' + self); },
        onStringTyped: function(pos, self) { prettyLog('onStringTyped ' + pos + ' ' + self) },
        onLastStringBackspaced: function(self) { prettyLog('onLastStringBackspaced ' + self) },
        onTypingPaused: function(pos, self) { prettyLog('onTypingPaused ' + pos + ' ' + self) },
        onTypingResumed: function(pos, self) { prettyLog('onTypingResumed ' + pos + ' ' + self) },
        onReset: function(self) { prettyLog('onReset ' + self) },
        onStop: function(pos, self) { prettyLog('onStop ' + pos + ' ' + self) },
        onStart: function(pos, self) { prettyLog('onStart ' + pos + ' ' + self) },
        onDestroy: function(self) { prettyLog('onDestroy ' + self) }
    });

    $("#js-rotating").Morphext({
        animation: "slideInDown",
        speed: 2500,
        complete: function () {
            // console.log("This is called after a phrase is animated in! Current phrase index: " + this.index);
        }
    });
    /**/

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


    $('#filterby').on('change',function() {
        /*let value = $(this).val();
        let href = $('#advanceSearch').attr('href');
        href = href.split('/');
        href.splice(-1,1);
        href = href.join('/');
        href += '/'+value;
        $('#advanceSearch').attr('href',href);*/
        let check = $('.filter').hasClass('hide');
        if(!check) {
            filterChange();
        }
    });

    // special_need
    $("#need_experience").change(function(){
        var value =  $(this).val();
        if(value == 1){
            // $("#special_need_category_teacher")[0].selectedIndex = 0;
            $(".special_need_category_div_teacher").removeClass('hide');
        }
        else {
            $(".special_need_category_div_teacher").addClass('hide');         
        }
    });
        /**/

    $("#special_needs_support").change(function(){
        var value =  $(this).val();
        if(value == 1){
            // $("#special_need_category")[0].selectedIndex = 0;
            $(".special_need_category_div").removeClass('hide');
        }
        else {
            $(".special_need_category_div").addClass('hide');         
        }
    });

    $('#advanceSearch').on('click', function() {
        filterChange();
    });

    $('#area').typeahead({
        source: function(query, result){
            $.ajax({
                url: '<?php echo base_url('Home/search_city'); ?>',
                method: 'post',
                data: { area: query },
                dataType:"json",
                success: function(data) {
                    result($.map(data, function(item){
                        return item;
                    }));
                }
            });
        }
    });

    $(".viewMoreBtn").on("click", function () {
        var txt = $("#viewmore").is(':visible') ? '<i class="fa fa-plus fa-3x"></i>' : '<i class="fa fa-minus fa-3x"></i>';
        $('#viewmore').slideToggle(200);
        $(".viewMoreBtn").html(txt);
    });

    /**/
    $(document).on('click', '.panel-heading span.clickable', function(e){
        var $this = $(this);
        if(!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
            
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
            
        }
    })
    /**/

    $('#type').on('change',function() {
        let values = $(this).val();
        if($.inArray('secondary', values) > -1){
            $('#ib-diploma').show();
        }
        else {
            $('#ib-diploma').hide();
        }
    });

});

function filterChange()
{
    let filterby = $('#filterby').val();
    if(filterby == 'teacher') {
        $('.filter').removeClass('hide');
        let check = $('#school').hasClass('hide');
        $('#teacher').removeClass('hide');
        if(!check) {
            $('#school').addClass('hide');
        }
    }
    else if(filterby == 'school') {
        $('.filter').removeClass('hide');
        $('#school').removeClass('hide');
        let check = $('#teacher').hasClass('hide');
        if(!check) {
            $('#teacher').addClass('hide');
        }
    }

    var $this = $('.filter').find('.panel-heading span.clickable');
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
}
</script>





<script src="<?php echo F_JSPATH ?>owl.carousel.js"></script> 
  
<script type="text/javascript">
jQuery(document).ready(function($) {
                        
    $('#customers-testimonials').owlCarousel({
        loop: false,
        center: true,
        items: 3,
        stagePadding: 1,
        margin: 0,                                      
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1170: {
            items: 5
          }
        }
    });
});
</script>

<script src="<?php echo F_JSPATH ?>circle-progress.js"></script>
<script>
    $(document).ready(function ($) {
        function animateElements() {
            $('.progressbar').each(function () {
                var elementPos = $(this).offset().top;
                var topOfWindow = $(window).scrollTop();
                var percent = $(this).find('.circle').attr('data-percent');
                var animate = $(this).data('animate');
                if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
                    $(this).data('animate', true);
                    $(this).find('.circle').circleProgress({
                        // startAngle: -Math.PI / 2,
                        value: percent / 300,
                        size : 400,
                        thickness: 15,
                        fill: {
                            color: '#fae60a'
                        }
                    }).on('circle-animation-progress', function (event, progress, stepValue) {
                        $(this).find('strong').text((stepValue*300).toFixed(0));
                    }).stop();
                }
            });
        }

        animateElements();
        $(window).scroll(animateElements);
    });
</script>

<script>

(function($) {
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);

jQuery(function($) {

    $('#month_visit').countTo({
        from: 0,
        to: <?php echo $tot_month_visit; ?>,
        speed: 5000,
        refreshInterval: 50,
        onComplete: function(value) {
            console.debug(this);
        }
    });
    $('#tot_review').countTo({
        from: 0,
        to: <?php echo $tot_review; ?>,
        speed: 5000,
        refreshInterval: 50,
        onComplete: function(value) {
            console.debug(this);
        }
    }); 
    $('#tot_school').countTo({
        from: 0,
        to: <?php echo $tot_school; ?>,
        speed: 5000,
        refreshInterval: 50,
        onComplete: function(value) {
            console.debug(this);
        }
    });
    $('#tot_teacher').countTo({
        from: 0,
        to: <?php echo $tot_teacher; ?>,
        speed: 5000,
        refreshInterval: 50,
        onComplete: function(value) {
            console.debug(this);
        }
    });        
});
</script>



