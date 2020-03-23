<link rel="stylesheet" type="text/css" href="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' ?>">
<style type="text/css">
textarea { resize: none; }
.checked { color: #f1b500; }
.school-detail-se h2 a, .title-se-box h2 a { color: #000; }
.gry-box-se img { width: auto;/* height: 350px;*/ }
</style>
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
<div class="search-add-page-se">
    <div class="slider-se">
    	<div class="listing-banner-img-se teacher-listing">
    		<div class="container">    			
                <div class="upper-text-se">
                <?php /*<form id="searchForm" method="post" action="<?php echo base_url('searchquery') ?>"> */ ?>
                    <form method="get" action="" id="searchForm">
                        <?php $this->load->view(FRONTEND.'teacher_searching'); ?>
                    </form>
                </div>
	    		<!-- <div class="upper-text-se">
	    			<div class="row">
	    				<div class="col-md-6 col-md-offset-6">
			    			<h1>Teacher Listing</h1>
		    				<h3>Primary, Secondary,  </h3>			    			
		    				<h3>Tertiary & Special Needs</h3>			    			
			    		</div>
			    	</div>
	    		</div> -->
	    	</div>
    	</div>
		<div class="bottom-text">
			<h3>“An investment in knowledge pays the best interest.”  Benjamin Franklin</h3>
		</div>
    </div>

    <?php /*<form method="post" id="searchForm">
        <div class="yellow-box" style="padding:0">
            <div class="container">
                <div class="col-md-10 col-md-offset-1">
                    <div class="in-box text-center">
                        <div class="review-box">
                            <p>Let’s start, find your teacher.</p>
                            <input type="hidden" name="fetchdata" value="<?php if(isset($fetchdata)) { echo $fetchdata; } ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="searchparam" id="searchparam" class="form-control" placeholder="Search my name  or key words" autocomplete="off" value="<?php echo $searchParam; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="need_experience" onchange="filterProcess();">
                                            <option value="">Special Needs Experience</option>
                                            <option value="1" <?php if(isset($filterby)) { if($need_experience == '1') { echo 'selected'; } } ?>>Yes</option>
                                            <option value="0" <?php if(isset($filterby)) { if($need_experience == '0') { echo 'selected'; } } ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn-1" id="searchBtn">Search</button>
                                    <!-- <a href="javascript:void(0);" class="btn-1">Search</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="fancy-collapse-panel">
                    <?php
                    $collapsed = $in = '';
                    if(!isset($filterby)) {
                        $collapsed = 'collapsed';
                    }
                    else {
                        $in = 'in';
                    }
                    ?>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a class="<?php echo $collapsed; ?>" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Advance Search
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse <?php echo $in; ?>" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="filter-sc">
                                        <div class="gry-box-fil">                                                       
                                            <ul>
                                                <li class="text-box-col">
                                                    <div class="form-group">
                                                        <!-- <label>Working with Children</label> -->
                                                        <select name="working_with_children" id="working_with_children" class="form-control" onchange="filterProcess();"> 
                                                            <option value="">Working with Children</option>                       
                                                            <option value="1" <?php if(isset($filterby)) { if($working_with_children == '1') { echo 'selected'; } } ?>>Yes</option>
                                                            <option value="0" <?php if(isset($filterby)) { if($need_experience == '0') { echo 'selected'; } } ?>>No</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="text-box-col hide" id="wwcc_number_div">
                                                    <div class="form-group">
                                                        <!-- <label>WWCC Number</label> -->
                                                        <input type="text" class="form-control" name="wwcc_number" placeholder="WWCC Number" value="<?php if(isset($filterby)) { if(isset($wwcc_number)) { echo $wwcc_number; } } ?>" onchange="filterProcess();">
                                                    </div>
                                                </li>
                                                <li class="text-box-col">
                                                    <div class="form-group">
                                                        <!-- <label>Multilingual</label> -->
                                                        <select class="form-control" name="multilanguage" id="multilanguage" onchange="filterProcess();">
                                                            <option value="">Multilingual</option>
                                                            <option value="1" <?php if(isset($filterby)) { if($multilanguage == '1') { echo 'selected'; } } ?>>Yes</option>
                                                            <option value="0" <?php if(isset($filterby)) { if($multilanguage == '0') { echo 'selected'; } } ?>>No</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="text-box-col hide" id="language_div">
                                                    <div class="form-group">
                                                        <select name="language[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();">
                                                            <?php
                                                            $typeArr = array('English','Spanish','Chinese','Russian','Arabic','Japanese','German');
                                                            foreach ($typeArr as $key => $value) {
                                                                $sel_type = '';
                                                                if(isset($filterby)) {
                                                                    $sel_type = in_array($value, $type) ? 'selected' : '';
                                                                }
                                                            ?>
                                                            <option value="<?php echo $value; ?>" <?php echo $sel_type ?>><?php echo ucwords($value); ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="text-box-col">
                                                    <div class="form-group">
                                                        <!-- <label>Tutoring Service</label>  -->
                                                        <select class="form-control" name="tutoring_services" id="tutoring_services" onchange="filterProcess();">
                                                            <option value="">Tutoring Services</option>
                                                            <option value="1" <?php if(isset($filterby)) { if($tutoring_services == '1') { echo 'selected'; } } ?>>Yes</option>
                                                            <option value="0" <?php if(isset($filterby)) { if($tutoring_services == '0') { echo 'selected'; } } ?>>No</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="text-box-col hide" id="preferred_hours_div">
                                                    <div class="form-group">
                                                        <!-- <label>Preferred hours</label> -->
                                                        <input type="text" class="form-control" name="preferred_hours" value="<?php if(isset($filterby)) { if(isset($preferred_hours)) { echo $preferred_hours; } } ?>" placeholder="Preferred hours" onchange="filterProcess();">
                                                    </div>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form> */ ?>

    <?php
    $bestArr = array('best-teacher-in-nsw','best-teacher-in-vic','best-teacher-in-qld','best-teacher-in-nt','best-teacher-in-wa','best-teacher-in-sa','best-teacher-in-act','best-teacher-in-tas');
    ?>
    <div id="search-results"></div>

    <?php
    $sponsorData['schools'] = $schools;
    $this->load->view(FRONTEND.'sponsor_school',$sponsorData);
    ?>
    
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>


<script type="text/javascript" src="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'; ?>" charset="UTF-8"></script>
<!-- <script type="text/javascript" src="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js'; ?>" charset="UTF-8"></script> -->
<script type="text/javascript">
$('.form_date').datetimepicker({
    // language:  'fr',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
</script>

<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script>
<script src="<?php echo F_JSPATH ?>custom.js"></script>
<script src="<?= ADMINPATH.'plugins/validation/validate.js'; ?>"></script>

<script type="text/javascript">
$(document).ready(function() {

    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });

    /*$('#area').typeahead({
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
    });*/

    $('#teacher_search').typeahead({
        source: function(query, result){
            console.log('test');
            $.ajax({
                url: '<?php echo base_url('Home/search_main'); ?>',
                method: 'post',
                data: { s_text: query, 'filterby': 'teacher' },
                dataType:"json",
                success: function(data) {
                    result($.map(data, function(item){
                        return item;
                    }));
                }
            });
        }
    });

    $('#searchBtn').on('click',function() {
        filterProcess();
    });

    /**/
    $("#tutoring_services").change(function(){
        var value =  $(this).val();
        if(value == 1){
            $("#preferred_hours_div").removeClass('hide');
        }
        else {
            $("#preferred_hours_div").addClass('hide');         
        }
    });

    $("#working_with_children").change(function(){
        var value =  $(this).val();
        if(value == 1){
            $("#wwcc_number_div").removeClass('hide');
        }
        else {
            $("#wwcc_number_div").addClass('hide');         
        }
    });

    $("#multilanguage").change(function(){
        var value =  $(this).val();
        if(value == 1){
            $("#language_div").removeClass('hide');
        }
        else {
            $("#language_div").addClass('hide');         
        }
    });
// special_need
    $("#need_experience").change(function(){
        var value =  $(this).val();
        if(value == 1){
            // $("#special_need_category")[0].selectedIndex = 0;
            $("#special_need_category_div").removeClass('hide');
        }
        else {
            $("#special_need_category_div").addClass('hide');         
        }
    });
    /**/

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

    $('#advanceSearch').on('click', function() {
        filterChange();
    });

    setTimeout(function() {
        filterProcess();
        <?php
        if(isset($_GET['filterby']) && $filter_open=='YES') {
        ?>
        $('.panel-heading span.clickable').click();
        <?php
        }
        ?>
    },500);

});

function filterProcess($page = '')
{
    if($page != '') {
        url = '<?php echo base_url('find-teacher/') ?>'+$page;
    }
    else {
        url = '<?php echo base_url('find-teacher') ?>';
    }
    // load_ajex_loader('<?= ADMINPATH.'images/ajax-loader.gif'; ?>','Loading Please Wait...');
    load_ajex_loader('<?= ASSETPATH.'images/loader.svg'; ?>','Loading Please Wait...');
    <?php
    if(isset($_GET['fetchdata'])) {
        if(in_array($_GET['fetchdata'], $bestArr)) {
        ?>
        $.ajax({
            type: 'POST',
            url: url,
            data: $('#searchForm').serialize(),
            success: function(response) {
                response_data = jQuery.parseJSON(response);
                if(response_data.redirect_link != '') {
                    window.location.href = response_data.redirect_link;
                }
                else {
                    $('#search-results').html('<div class="search-box-se">\
                        <h3>0 search results found</h3>\
                    </div>');
                }
            }
        });
        <?php
        }
        else {
        ?>
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: $('#searchForm').serialize(),
            success: function(response) {
                $('#search-results').html(response);
                <?php //if( isset($_GET["searchText"]) || $filter_open == 'NO'){ ?>              
                <?php if( isset($_GET["searchText"]) ){ ?>              
                    $('html,body').animate({                    
                        scrollTop: $('#search-results').offset().top - 100
                    });
                <?php } ?>
            }
        });
        <?php
        }
    }
    else {
    ?>
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'html',
        data: $('#searchForm').serialize(),
        success: function(response) {
            $('#search-results').html(response);
            <?php //if( isset($_GET["searchText"]) || $filter_open == 'NO'){ ?>              
            <?php if( isset($_GET["searchText"]) ){ ?>              
                $('html,body').animate({                    
                    scrollTop: $('#search-results').offset().top - 100
                });
            <?php } ?>
        }
    });
    <?php
    }
    ?>
}

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