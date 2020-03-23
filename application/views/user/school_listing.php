<!-- <link rel="stylesheet" type="text/css" href="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/sample in bootstrap v3/bootstrap/css/bootstrap.min.css' ?>"> -->
<link rel="stylesheet" type="text/css" href="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' ?>">
<style type="text/css">
textarea { resize: none; }
.checked { color: #f1b500; }
.school-detail-se h2 a { color: #000; }
.title-se-box h2 a { color: #000; }
</style>

<div class="search-add-page-se">
    <div class="slider-se">
    	<div class="listing-banner-img-se">
    		<div class="container">    		
    			<div class="upper-text-se">
                <?php /*<form id="searchForm" method="post" action="<?php echo base_url('searchquery') ?>"> */ ?>
	                <form id="searchForm" method="get" action="">
	                    <?php $this->load->view(FRONTEND.'school_searching'); ?>
	                </form>
            	</div>
	    		<!-- <div class="upper-text-se">
	    			<div class="row">
	    				<div class="col-md-6 col-md-offset-6">
			    			<h1>school listings</h1>
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
	    <div class="yellow-box">
	    	<div class="container">
	    		<div class="row">
					<div class="col-md-10 col-md-offset-1">
			    		<div class="in-box text-center">
			    			<div class="review-box">
			    				<p >Let’s start, find your school.</p>
		    					<!-- <input type="hidden" name="searchparam" value="<?php echo $searchParam; ?>"> -->
		    					<input type="hidden" name="fetchdata" value="<?php if(isset($fetchdata)) { echo $fetchdata; } ?>">
			    				<div class="row">
			    					<div class="col-md-12">
			    						<div class="form-group">
		    								<input type="text" name="searchparam" id="searchparam" class="form-control" placeholder="Search By Name" autocomplete="off" value="<?php echo $searchParam; ?>">
		    							</div>
			    					</div>
				    				<div class="col-md-4">
				    					<div class="form-group">
					    					<div class="autocomplete">
					    						<input type="text" name="area" id="area" class="form-control" placeholder="Area" autocomplete="off" value="<?php if(isset($findSchool)) { echo $area; } ?>">
					    					</div>
					    				</div>
				    				</div>
				    				<div class="col-md-4">
				    					<div class="form-group">
									        <select name="type[]" class="multiselect-ui form-control" multiple="multiple">
					    						<?php
					    						$typeArr = array('primary','secondary','tertiary','special needs');
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
	    </div>
	    <div class="container">
	    	<div class="row">
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
	                                                        <label>State</label> 
	                                                        <select name="state" class="form-control">
	                                                            <option value="">State </option>
	                                                            <?php
	                                                            foreach ($statelist as $key => $value) {
	                                                            	$seleted = $state == $value['id'] ? 'selected' : '';
	                                                            ?>
	                                                            <option value="<?php echo $value['id'] ?>" <?php echo $seleted; ?> ><?php echo $value['name'] ?></option>
	                                                            <?php
	                                                            }
	                                                            ?>
	                                                        </select>
	                                                    </div>
														<div class="form-group">	
															<label>Distance</label>	
															<select name="distance" class="form-control" onchange="filterProcess();">
													    		<option value="">Distance</option>
																<?php
																$distanceArr = array('10','20','40');
																foreach ($distanceArr as $key => $value) {
																	$sel_distance = '';
																	if(isset($filterby)) {
																		$sel_distance = ($distance == $value) ? 'selected' : '';
																	}
																?>
													    		<option value="<?php echo $value; ?>" <?php echo $sel_distance; ?>><?php echo $value; ?>km</option>
																<?php
																}
																?>
													    	</select>
										    			</div>
										    		</li>
										    		<li class="text-box-col">
														<div class="form-group">	
															<label>Sector</label>
															<select name="sector[]" class="multiselect-ui form-control" multiple="multiple" onchange="filterProcess();">	
															<!-- <select name="sector" class="form-control" onchange="filterProcess();">
													    		<option value="">Sector</option> -->
													    		<?php
													    		$sectorArr = array('public','private','indepedent','government');
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
										    		</li>
										    		<li class="text-box-col">
														<div class="form-group">	
															<label>Gender</label>	
															<select name="gender" class="form-control" onchange="filterProcess();">
													    		<option value="">Gender</option>
																<?php
																$genderArr = array('male'=>'Male','female'=>'Female','coeducation'=>'Co-Education');
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
										    		</li>
										    		<li class="text-box-col">
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
										    		</li>
										    		<li class="text-box-col">
														<div class="form-group">	
															<label>Students</label>	
															<?php
													    	$studentsArr = array('20-200','201-500','501-800','800+');
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
										    		</li>
										    	</ul>
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
											    		<div class="check-list">
											    			<?php
											    			$boardCheck = '';
											    			if(isset($filterby) && isset($boarding)) {
																$boardCheck = ($boarding == '1') ? 'checked' : '';
															}
											    			?>
											    			<input type="checkbox" name="boarding" id="boarding" value="1" onchange="filterProcess();" <?php echo $boardCheck; ?> /><label for="boarding">Boarding</label>   
											    		</div>
											    		<div class="check-list">
											    			<?php
											    			$internationalCheck = '';
											    			if(isset($filterby) && isset($international_students)) {
																$internationalCheck = ($international_students == '1') ? 'checked' : '';
															}
											    			?>
											    			<input type="checkbox" name="international_students" id="international_students" value="1" onchange="filterProcess();" <?php echo $internationalCheck; ?> /><label for="international_students">International Students Accepted </label>
											    		</div>
											    		<div class="check-list">
											    			<?php
											    			$specialCheck = '';
											    			if(isset($filterby) && isset($special_needs_support)) {
																$specialCheck = ($special_needs_support == '1') ? 'checked' : '';
															}
											    			?>
											    			<input type="checkbox" id="special_needs_support" name="special_needs_support" value="1" onchange="filterProcess();" <?php echo $specialCheck; ?> /><label for="special_needs_support">Infrastructure for Special Needs</label>
											    		</div>
											    		<div class="check-list">
											    			<?php
											    			$scholarshipCheck = '';
											    			if(isset($filterby) && isset($scholarship_offer)) {
																$scholarshipCheck = ($scholarship_offer == '1') ? 'checked' : '';
															}
											    			?>
											    			<input type="checkbox" id="scholarship_offer" name="scholarship_offer" value="1" onchange="filterProcess();" <?php echo $scholarshipCheck; ?> /><label for="scholarship_offer">Scholarships offered</label>
											    		</div>
											    		<div class="check-list">
											    			<?php
											    			$interBaccCheck = '';
											    			if(isset($filterby) && isset($international_baccalaureate)) {
																$interBaccCheck = ($international_baccalaureate == '1') ? 'checked' : '';
															}
											    			?>
											    			<input type="checkbox" id="international_baccalaureate" name="international_baccalaureate" value="1" onchange="filterProcess();" <?php echo $interBaccCheck; ?> /><label for="international_baccalaureate">International Baccalaureate School</label>
											    		</div>
											    	</div>
											    	
											    </div>

											</div>
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
	$bestArr = array('best-school-in-nsw','best-school-in-vic','best-school-in-qld','best-school-in-nt','best-school-in-wa','best-school-in-sa','best-school-in-act','best-school-in-tas');
	?>
    <div id="search-results"></div>

	<?php
	$sponsorData['schools'] = $schools;
	$this->load->view(FRONTEND.'sponsor_school',$sponsorData);
	?>
    
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<!-- <script type="text/javascript" src="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/sample in bootstrap v3/bootstrap/js/bootstrap.min.js'; ?>"></script> -->
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
<!-- <script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script> -->
<script src="<?php echo F_JSPATH ?>custom.js"></script>
<script src="<?= ADMINPATH.'plugins/validation/validate.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function() {

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

     $("#special_needs_support").change(function(){
        var value =  $(this).val();
        if(value == 1){
            // $("#special_need_category")[0].selectedIndex = 0;
            $("#special_need_category_div").removeClass('hide');
        }
        else {
            $("#special_need_category_div").addClass('hide');         
        }
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

	$('#school_search').typeahead({
		source: function(query, result){
			$.ajax({
				url: '<?php echo base_url('Home/search_main'); ?>',
				method: 'post',
				data: { s_text: query, 'filterby': 'school' },
				dataType:"json",
				success: function(data) {
					result($.map(data, function(item){
						// return item;
						return {
			                url: item.id,
			                value: item.name
			            }
					}));
				}
			});
		},
		displayText: function(item) {
	        return item.value
	    },
	    updater: function(item) {
	        window.location.href = item.url;
	        return item;
	    }
	});

	$('#searchBtn').on('click',function() {
		filterProcess();
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

    $('#type').on('change',function() {
        let values = $(this).val();
        if($.inArray('secondary', values) > -1){
            $('#ib-diploma').show();
        }
        else {
            $('#ib-diploma').hide();
        }
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
		url = '<?php echo base_url('find-school/') ?>'+$page;
	}
	else {
		url = '<?php echo base_url('find-school') ?>';
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