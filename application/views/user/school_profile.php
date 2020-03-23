<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/owl.carousel.css?i=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/needsharebutton.min.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

<style type="text/css">
.searchImage {
    border: #ccc solid 1px;
}
textarea { resize: none; }
#chartdiv { width: 100%; height: 500px; }
.checked { color: #f1b500; }
#map { height: 300px; }
</style>
<?php $CI =& get_instance(); ?>
<div class="profile-page-se">
    <div class="slider-se">
    	<!-- <div class="listing-banner-img-se"> -->
	<div class="profile-banner-img-se">
    		<div class="container">    		
    			<div class="upper-text-se">
                <?php /*<form id="searchForm" method="post" action="<?php echo base_url('searchquery') ?>"> */ ?>
	                <form id="searchForm" method="get" action="<?= base_url('schools'); ?>">
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

    <div class="yellow-box">
    	<div class="container">
    		<div class="row">
				<div class="col-md-12">
		    		<?php /* ?><div class="in-box text-center">
		    			<div class="review-box">
		    				<p>Tell us about your learning experience at this school by <br>sharing a star rating, comment or category assessment. </p>
		    				<br>
		    				<a href="javascript:void(0);" id="reviewBtn" class="btn-1"><i class="fa fa-edit"></i> Leave a review!</a>
						</div>
					</div><?php */ ?>
					<div class="page-tab-se text-center">
						<ul>
						    <li class="back-color-1"><a href="#backgrounder">Backgrounder</a></li>
						    <li class="back-color-2"><a href="#reviews">Reviews</a></li>
						    <li class="back-color-3"><a href="#performance">Comparative Performance Metrics</a></li>
						    <li class="back-color-4"><a href="#teachers">Teachers</a></li>        
						    <li class="back-color-5"><a href="#articles">Articles</a></li>        
						    <li class="back-color-6"><a href="#event">Events</a></li>        
						  </ul>
					</div>
				</div>
    		</div>
    	</div>
    </div>
    <div class="backgrounder-se manu-side-se" id="backgrounder">
    	<div class="side-manu">
    		<span>Backgrounder</span>
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/backgrounder.png"> -->
    	</div>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-9">
    				<div class="title-part">
    					<div class="brand-logo">
    						<?php
    						if($school['school_logo'] != '') {
    						?>
    						<img src="<?php echo base_url().PhotosPath.$school['school_logo']; ?>" alt="" class=""> <!-- searchImage img img-circle -->
    						<?php
    						}
    						else {
    						?>
    						<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
    						<?php
    						}
    						?>
    					</div>
    					<div class="school-detail-se">
    						<h2><?php echo ucwords($school['name']); ?></h2>	    						
    						<ul class="star-se">
    							<?php
    							$average_rating = '';
    							$total_review = 0;
    							if(!empty($rating)) {
    								$average_rating = intval($rating['average_rating']);
    								$total_review = $rating['total_rating'];
    							}
    							for ($i=1; $i <= 5; $i++) {
    								$checked = ($i <= $average_rating) ? 'checked' : '';
    							?>
    							<li><i class="fa fa-star <?php echo $checked; ?>"></i></li>
								<?php
    							}
    							?>
    							<li><?php echo $total_review; ?> reviews</li>
    						</ul>
    						<div class="rel-line">
    							<div class="icon-bx">
    								<span><i class="fa fa-envelope"></i></span> <a href="mailto:<?php echo $school['email']; ?>"><?php echo $school['email']; ?></a>
    							</div>
    							<?php
    							if($school['telephone'] != '') {
    							?>
    							<div class="icon-bx">
    								<?php $phone = str_replace('+', '', $school['telephone']); ?>
    								<span><i class="fa fa-phone"></i></span> <a href="tel:+<?php echo $phone; ?>">+<?php echo $phone; ?></a>
    							</div>
    							<?php
    							}
    							?>
    							<?php
    							if($school['website'] != '') {
    							?>
    							<div class="icon-bx">
    								<span><i class="fa fa-desktop"></i></span> <a href="http://<?php echo $school['website'] ?>" target="_blank" id="schoolWebsite" data-id="<?php echo $school['id']; ?>"><?php echo $school['website'] ?></a>
    							</div>
    							<?php
    							}
    							?>
    							<?php
    							if($school['prospectus'] != '') {
    								$prospectus = json_decode($school['prospectus'],true);
    								$prospectusCount = count($prospectus);
    								if($prospectusCount > 1) {
    								}
    								else {
    								?>
	    							<div class="icon-bx">
	    								<a href="<?php echo base_url().BrochurePath.$prospectus[0]; ?>" target="_blank"><span><i class="fa fa-book"></i></span> Prospectus</a>
	    							</div>
    								<?php
    								}
    							}
    							?>
    							<?php

    							if($school['corporate_no'] != '') {
    							?>
    							<br>
    							<div class="icon-bx" style="margin-top: 5px;">
    								<?php $corporate_no = $school['corporate_no']; ?>
    								<span><i class="fa fa-phone"></i></span> <a href="tel:+<?php echo $corporate_no; ?>"><?php echo $corporate_no; ?></a>
    							</div>
    							<?php
    							}
    							?>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3">
    				<a href="javascript:void(0);" id="reviewBtn" class="btn-1" style="margin-top: 20px;"><i class="fa fa-edit"></i> Leave a review!</a>
    				<div class="share-se">
    					<?php /* <div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2';
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-share-button" data-href="<?php echo base_url().'school/'.md5($school['id']); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
    					<div class="share-icon">
    						<span><i class="fa fa-share"></i></span> share
    					</div>
    					<div id="share-button-5" class="need-share-button-default" data-share-position="topCenter" data-share-share-button-class="custom-button"><span class="custom-button"><strong>Share it</strong></span></div> */ ?>
    					<div id="share-button-5" class="need-share-button-default pull-left" data-share-position="topCenter" data-share-share-button-class="custom-button">
    						<span class="custom-button"><i class="fa fa-share"></i> share</span></div>
    					<div class="view-icon pull-left">
    						<!-- <span><i class="fa fa-eye"></i></span> <?php echo $pageview; ?> page views -->
    						<span><i class="fa fa-eye"></i></span> <?php echo $pageview; ?>
    					</div>
    					<div class="clearfix"></div>
    				</div>
    			</div>
    		</div>
		
				
			<div class="col-md-6">
				<div class="left-se">
					<div class="demo">
					    <ul id="lightSlider">
							<?php
							if($school['photos'] != '') {
								$photos = $school['photos'];
								$photos = json_decode($photos, true);
								foreach ($photos as $key => $value) {
								?>
								<li data-thumb="<?php echo base_url().PhotosPath.$value ?>">
						            <img src="<?php echo base_url().PhotosPath.$value ?>" />
						        </li>
								<?php
								}
							}
							else {
							?>
					        <li data-thumb="<?php echo FRONTENDPATH ?>images/slider-1.jpg">
					            <img src="<?php echo FRONTENDPATH ?>images/slider-1.jpg" />
					        </li>
					        <li data-thumb="<?php echo FRONTENDPATH ?>images/slider-2.jpg">
					            <img src="<?php echo FRONTENDPATH ?>images/slider-2.jpg" />
					        </li>
					        <li data-thumb="<?php echo FRONTENDPATH ?>images/slider-2.jpg">
					            <img src="<?php echo FRONTENDPATH ?>images/slider-2.jpg" />
					        </li>
					        <li data-thumb="<?php echo FRONTENDPATH ?>images/slider-2.jpg">
					            <img src="<?php echo FRONTENDPATH ?>images/slider-2.jpg" />
					        </li>
							<?php
							}
							?>
					    </ul>
					</div>
					<div class="detail-se">
						<p><span>School motto:</span> <?php echo $school['motto']; ?></p>
						<?php echo $school['about']; ?>
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="right-se">
					<div class="detail-se">
						<?php
						if($school['type'] != '0') {
							$type = ucwords(str_replace(',', ', ', $school['type']));
						}
						else {
							$type = '----';
						}
						?>
						<?php if($school['school_type']!='4') { ?>
						<p><span>Principal:</span> <?php echo ucwords($school['principal']); ?></p>
						<?php } ?>
						<?php
						$fees_grade_arr = array("0-8000"=>"$0 - $8000","8001-15000"=>"$8001 - $15000","15001-20000"=>"$15001 - $20000","20001"=>"$20001 +");
						if($school['school_type']=='2' || $school['school_type']=='3') {
							?>
							<?php
							if($school['dep_principal'] != '') {
							?>
							<p><span>Deputy Principal:</span> <?php echo ucwords($school['dep_principal']); ?></p>
							<?php
							}
							if($school['head_of_secondary'] != '') {
							?>
							<p><span>Head of Secondary:</span> <?php echo ucwords($school['head_of_secondary']); ?></p>
							<?php
							}
							if($school['head_of_primary'] != '') {
							?>
							<p><span>Head of Primary:</span> <?php echo ucwords($school['head_of_primary']); ?></p>
							<?php
							}
							if($school['parent_association'] != '') {
							?>
							<p><span>Parent Association:</span> <?php echo ($school['parent_association'] == 0) ? 'No' : 'Yes'; ?> </p>
							<?php
							}
							if($school['parent_association_president'] != '') {
							?>
							<p><span>Parent Association Presiden:</span> <?php echo ucwords($school['parent_association_president']); ?></p>
							<?php
							}
							?>
							<p><span>Annual Fees:</span> <?php echo ($school['fees_grade'] == 1) ? 'Grade 1 - Grade 6' : 'Grade 7 - Grade 12'; ?> ( <?php echo $fees_grade_arr[$school['fees_grade_1']]; ?>) </p>
							<p><span>Student Boarding / Housing:</span> <?php echo ($school['boarding'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Private School Bus:</span> <?php echo ($school['private_school_bus'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Before and After School Care:</span> <?php echo ($school['school_care'] == 0) ? 'No' : 'Yes'; ?> </p>
							<?php
							if($school['school_care_number'] != '') {
							?>
							<p><span>Before and After School Care Contact:</span> <?php echo $school['school_care_number']; ?> </p>
							<?php
							}
							?>
							<?php
							if($school['school_type']=='3'){
								?>
								<p><span>Speech Pathologist Onsite:</span> <?php echo ($school['speech_phthologist'] == 0) ? 'No' : 'Yes'; ?> </p>
								<p><span>Occupational Therapist Onsite:</span> <?php echo ($school['occupational_therapist'] == 0) ? 'No' : 'Yes'; ?> </p>
								<p><span>Scholarships Offered:</span> <?php echo ($school['scholarship_offer'] == 0) ? 'No' : 'Yes'; ?> </p>
								<?php
							}
							?>
							<p><span>Bus Stop on Campus:</span> <?php echo ($school['busstop_campus'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Careers Adviser:</span> <?php echo ($school['careers_adviser'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Student Support / Counselling:</span> <?php echo ($school['student_support'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Student Counsellor or Support Contact:</span> <?php echo ($school['student_counsellor'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Compulsory School Uniform:</span> <?php echo ($school['uniform'] == 0) ? 'No' : 'Yes'; ?> </p>
							<?php
							if($school['ib_diploma_programme'] != '') {
							?>
							<p><span>IB Diploma Programme:</span> <?php echo $school['ib_diploma_programme']; ?> </p>
							<?php
							}
							?>
							<p><span>Infrastructure for Special Needs:</span> <?php echo ($school['infrastructure_special_needs'] == 0) ? 'No' : 'Yes'; ?> </p>
							<?php
							if($school['facilities'] != '') {
							?>
							<p><span>Facilities:</span> <?php echo $school['facilities']; ?></p>
							<?php
							}
							if($school['facilities_contact'] != '') {
							?>
							<p><span>Use of Facilities Contact:</span> <?php echo $school['facilities_contact']; ?></p>
							<?php
							}
							if($school['instagram'] != '') {
							?>
							<p><span>Instagram:</span> <?php echo $school['instagram']; ?></p>
							<?php
							}
							if($school['facebook'] != '') {
							?>
							<p><span>Facebook:</span> <?php echo $school['facebook']; ?></p>
							<?php
							}
							?>
							<?php
						}

						if($school['school_type']=='4') { ?>
							<?php if($school['capmus_location'] != '') { ?>
							<p><span>Campus Location:</span> <?php echo ucwords($school['capmus_location']); ?></p>
							<?php } ?>
							<?php
							if($school['telephone_title'] != '') {
								$option_data = json_decode($school['telephone_title'], true);
								$option = $option_data['option'];
								$optvalue = $option_data['optvalue'];
								foreach ($option as $key => $value) {
								?> <p><span><?= $value?>:</span> <?php echo ucwords($optvalue[$key]) ?></p><?php
								}
								?>
							<?php
							}
							?>
							<?php if($school['chancellor'] != '') { ?>
							<p><span>Chancellor:</span> <?php echo ucwords($school['chancellor']); ?></p>
							<?php } ?>
							<?php if($school['vice_chancellor'] != '') { ?>
							<p><span>Vice Chancellor:</span> <?php echo ucwords($school['vice_chancellor']); ?></p>
							<?php } ?>
							<?php if($school['student_support_officer'] != '') { ?>
							<p><span>Student Support Officer:</span> <?php echo ucwords($school['student_support_officer']); ?></p>
							<?php } ?>
							<?php if($school['student_support_email'] != '') { ?>
							<p><span>Student Support Email:</span> <?php echo ucwords($school['student_support_email']); ?></p>
							<?php } ?>
							<?php if($school['student_association_contact'] != '') { ?>
							<p><span>Student Association Contact:</span> <?php echo ucwords($school['student_association_contact']); ?></p>
							<?php } ?>
							<?php if($school['annual_fees'] != '') { ?>
							<p><span>Annual Fees:</span> <?php echo ucwords($school['annual_fees']); ?></p>
							<?php } ?>

							<p><span>Student Boarding / Housing:</span> <?php echo ($school['boarding'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Private School Bus:</span> <?php echo ($school['private_school_bus'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Onsite Parking:</span> <?php echo ($school['onsite_parking'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Train station close to Campus:</span> <?php echo ($school['train_station'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Careers Adviser:</span> <?php echo ($school['careers_adviser'] == 0) ? 'No' : 'Yes'; ?> </p>
							<p><span>Student Support / Counselling:</span> <?php echo ($school['student_support'] == 0) ? 'No' : 'Yes'; ?> </p>
							
							<?php if($school['student_counsellor'] != '') { ?>
							<p><span>Student Counsellor or Support Contact:</span> <?php echo ucwords($school['student_counsellor']); ?></p>
							<?php } ?>
							
							
							







							<p><span>Bus Stop on Campus:</span> <?php echo ($school['busstop_campus'] == 0) ? 'No' : 'Yes'; ?> </p>
							<?php
							if($school['facilities'] != '') {
							?>
							<p><span>Facilities:</span> <?php echo $school['facilities']; ?></p>
							<?php
							}
							if($school['facilities_contact'] != '') {
							?>
							<p><span>Use of Facilities Contact:</span> <?php echo $school['facilities_contact']; ?></p>
							<?php
							}
							if($school['instagram'] != '') {
							?>
							<p><span>Instagram:</span> <?php echo $school['instagram']; ?></p>
							<?php
							}
							if($school['facebook'] != '') {
							?>
							<p><span>Facebook:</span> <?php echo $school['facebook']; ?></p>
							<?php
							}
							?>

						<?php } ?>

						<?php if($school['school_type']!='4') { ?>
						<p><span>Enrolments Officer:</span> <?php echo ucwords($school['enrolments_officer']); ?> </p>
						<?php } ?>
						<!-- <p><span>Students:</span> <?php echo $school['no_of_students']; ?> </p> -->
						<?php
						$no_of_students = $school['no_of_students'];
                      	$student_key = '';
                      	if($no_of_students <= 200) {
                         	$student_key = '0-200';
                      	}
                      	if ($no_of_students > 200 && $no_of_students <= 500) {
                         	$student_key = '201-500';
                      	}
                      	if ($no_of_students > 500 && $no_of_students <= 1000) {
                         	$student_key = '501-1000';
                      	}
                      	if ($no_of_students > 1000) {
                         	$student_key = '1000+';
                      	}
						?>
						<p><span>Students:</span> <?php echo $student_key; ?> </p>
						<!-- <p><span>Teaching staff: </span> <?php echo $school['no_of_teachers']; ?> </p> -->
						<?php
						$no_of_teachers = $school['no_of_teachers'];
                      	if($no_of_teachers <= 20) {
                         	$teacher_key = '10';
                      	}
                      	if ($no_of_teachers > 20 && $no_of_teachers <= 50) {
                         	$teacher_key = '35';
                      	}
                      	if ($no_of_teachers > 50 && $no_of_teachers <= 100) {
                         	$teacher_key = '75';
                      	}
                      	if ($no_of_teachers > 100 && $no_of_teachers <= 200) {
                         	$teacher_key = '150';
                      	}
                      	if ($no_of_teachers > 200) {
                         	$teacher_key = '201';
                      	}
						?>
						<p><span>Teaching staff: </span> <?php echo $teacher_key; ?> </p>
						<p><span>Type: </span> <?php echo $type; ?> </p>
						<?php
						if ($school['sector'] != '') {
						?>
						<p><span>Sector:</span> <?php echo ucwords($school['sector']); ?>  </p>
						<?php
						}
						?>
						<!-- <p><span>Boarding:</span> <?php echo ($school['boarding'] == 0) ? 'No' : 'Yes'; ?> </p> -->
						<p><span>Boarding / Housing:</span> <?php echo ($school['boarding'] == 0) ? 'No' : 'Yes'; ?> </p>
						<?php
						if ($school['gender'] != '') {
						?>
						<p><span>Gender: </span> <?php echo ucwords($school['gender']); ?> </p>
						<?php
						}
						if($school['religion'] != '') {
						?>
						<p><span>Religion:</span> <?php echo ucwords($school['religion']) ?></p>
						<?php
						}
						if($school['telephone'] != '') {
						?>
						<p><span>Telephone:</span> <?php echo ucwords($school['telephone']) ?></p>
						<?php
						}
						?>
						<!-- <p><span>International students:</span> <?php echo ($school['international_students'] == 0) ? 'No' : 'Yes'; ?></p> -->
						<p><span>International Students Accepted:</span> <?php echo ($school['international_students'] == 0) ? 'No' : 'Yes'; ?></p>
						<?php
						if($school['international_students'] == 1) {
						?>
						<p><span>CRICOS #: </span> <?php echo $school['cricos_number']; ?></p>
						<?php
						}
						?>
						<p><span><?php if($school['school_type']=="4") { echo "Special Needs Infrastructure"; } else { echo "Infrastructure for Special Needs"; } ?> : </span> <?php echo ($school['special_needs_support'] == 0) ? 'No' : 'Yes'; ?></p>
						<?php
						if($school['special_needs_support']=='1') {
						?>
						<!-- <p><span>Infrastructure Special Category: </span> <?php echo $special_need_category[$school['special_needs_support']]; ?></p> -->
						<p>
							<span>Special Needs Categories: </span>
							<?php
							$special_need_categories = explode(',', $school['special_need_category']);
							$categories = '';
							foreach ($special_need_categories as $cat_key => $category) {
								$categories = $categories.','.$special_need_category[$category];
							}
							echo ltrim($categories,',');
							?>
						</p>
						<?php
						}
						?>
						<?php
						if($school['funding_amount'] != '') {
						?>
						<p><span>Commonwealth funding per student for 2019:  </span> $<?php echo $school['funding_amount']; ?></p>
						<?php
						}
						?>
						<?php
						$head_office = '';
						if($school['address_1'] != '') {
							$head_office .= ucwords($school['address_1']).',';
						}
						if($school['address_2'] != '') {
							$head_office .= ucwords($school['address_2']).',';
						}
						if($school['city'] != '') {
							$head_office .= ucwords($school['city']).',';
						}
						if($school['state'] != '') {
							$head_office .= ucwords($state['name']).',';
						}
						if($school['po_box'] != '') {
							$head_office .= ucwords($school['po_box']).',';
						}
						$head_office = rtrim($head_office, ',');
						?>
						<p class="map-1"><i class="fa fa-map-marker"></i> <span>Head Office:</span> <?php echo $head_office; ?> </p>
						<?php
						if($school['primary_campus'] != '' && $school['school_type']!='4') {
						?>
						<p class="map-2"><i class="fa fa-map-marker"></i> <span>Primary Campus:</span> 
							<?php 
							$primary_campuse_explode = explode("!#!", $school['primary_campus']);
							$state_name_primary = $CI->common->get_one_value("tbl_state",array("id"=>$primary_campuse_explode[1]),"name");
							echo $primary_campuse_addresss = $primary_campuse_explode[2].", ".$primary_campuse_explode[0].", ".$state_name_primary;
							echo "<br>";
							echo $primary_campuse_explode[3];
							?>
						</p>

						<?php
						}
						?>

						<?php
						
						if($school['primary_campus'] != '' && $school['school_type']=='4') {
							$option_data = json_decode($school['primary_campus'], true);
							$option = $option_data['address'];
							foreach ($option as $key => $value) {
								$campus_array = explode("!#!", $value);
								?><p class="map-2"><i class="fa fa-map-marker"></i> <span><?= $campus_array[0] ?>:</span> <?php
								$str_replace= str_replace($campus_array[0], "", $value);
								$str_replace= str_replace($campus_array[5], "", $str_replace);
								echo ucwords( str_replace("!#!", " ", $str_replace));
								?></p><?php
							}
						?>
						<?php
						}
						?>

						<?php
						if($school['secondary_campus'] != '') {
						?>
						<p class="map-2"><i class="fa fa-map-marker"></i> <span>Secondary Campus:</span> 

							<?php ucwords( str_replace("!#!", " ", $school['secondary_campus'])  ); 

							
							$secoundary_campuse_explode = explode("!#!", $school['secondary_campus']);
							$state_name_primary = $CI->common->get_one_value("tbl_state",array("id"=>$secoundary_campuse_explode[1]),"name");
							echo $secoundary_campuse_addresss = $secoundary_campuse_explode[2].", ".$secoundary_campuse_explode[0].", ".$state_name_primary;
							echo "<br>";
							echo $secoundary_campuse_explode[3];
							
							?>

						</p>
						<?php
						}
						?>
						
					</div>
					<div class="map-se">
						<?php
						// $address = "MR W HEISENBERG U 235 201-203 BROADWAY AVE WEST BEACH SA 5024 AUSTRALIA";
						$address = array();
						if($school['address_1'] != '') {
							$address['street'] = $school['address_1'];
						}
						if($school['city'] != '') {
							$address['city'] = $school['city'];
						}
						if($school['state'] != '') {
							$address['state'] = $state['name'];
						}
						
						$CI =& get_instance();
						$lat = $long = $lat1 = $long1 = $lat2 = $long2 = '';

						$latlong = $CI->getCoordinates($address);
						
						if($school['show_primary'] == 1 && $school['school_type']!='4') {
							$latlong1 = $CI->getCoordinates($school['primary_campus'],true);
							if(!empty($latlong1)) {
								$lat1 = $latlong1[0];
								$long1 = $latlong1[1];
							}
						}

						/*if($school['primary_campus'] != '' && $school['school_type']=='4') {
							$option_data = json_decode($school['primary_campus'], true);
							$option = $option_data['address'];
							foreach ($option as $key => $value) {
								$primary_campus_string = explode("!#!", $value);
								if($primary_campus_string[4]==1) {
									$address =  ucwords( str_replace("!#!", " ", $value)  );
									$latlong3 = $CI->getCoordinates($address,true);
								}
							}
						}*/

						if($school['show_secondary'] == 1) {
							$latlong2 = $CI->getCoordinates($school['secondary_campus'],true);
							if(!empty($latlong2)) {
								$lat2 = $latlong2[0];
								$long2 = $latlong2[1];
							}
						}

						if(!empty($latlong)) {
							$lat = $latlong[0];
							$long = $latlong[1];
							// echo $lat.'---'.$long;

						}
						?>
						<div class="embed-responsive embed-responsive-16by9">
							<div id="map"></div>
						</div>
					</div>
				</div>
			</div>
		
    	</div>
    </div>

    <div class="reviews-se manu-side-se" id="reviews">
    	<div class="side-manu">
    		<span>Reviews</span>
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/reviews.png"> -->
    	</div>
    	<div class="container">
			<div id="reviewsdisplay"></div>
    	</div>
    </div>

    <div class="cpm-se manu-side-se" id="performance">
    	<div class="side-manu">
    		<span>Comparative Performance Metrics</span>
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/cpm-title.png">	    		 -->
    	</div>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-10 col-md-offset-1">
    				<div class="school-detail-se">
						<h2><img src="<?php echo FRONTENDPATH ?>images/cpm.png" alt=""> Comparative Performance Metrics</h2>	    					
					</div>
					<div class="detail-box">
						<?php
						$total_rating = 0;
						$click_rate = $total_click = 0;
						if(isset($conversion['click'])) {
							$total_click = $conversion['click'];
							$len = strlen($conversion['click']);
							if($len <= 3) {
								$division = 10;
							}
							elseif ($len == 4) {
								$division = 100;
							}
							$click_rate = ($conversion['click'] / $division);
						}
						if(!empty($rating)) {
							$total_rating = $rating['total_rating'];
						}
						?>
						<p><?php echo ucwords($school['name']); ?> is ranked <span>#<?php echo $rank; ?> out of <?php echo count($schools); ?></span> schools in our Australian School Directory.</p>
						<?php
						if($type != '---') {
						?>
						<?php if($rankSchoolType>0) { ?>
						<p>This school is ranked <span>#<?php echo $rankSchoolType; ?> in <?php echo $type; ?> Education </span>
							<?php if($rankState>0) { ?>
						 	and <span>#<?php echo $rankState; ?> in <?php echo $state['shortName']; ?>.</span>
						</p>
							<?php } ?>
						<?php } ?>
						<?php
						}

						?>
						<p>This profile has a <span>total of <?php echo $total_rating; ?> reviews </span> and <?php echo $pageview; ?> page views, therefore <?php echo number_format($visitor,2,'.','') ?>% of visitors have left a review.</p>
						<?php
						if($school['website'] != '') {
						?>
						<p>There are a total of <span><?php echo $total_click; ?> clicks from this profile to the school website,</span> the ‘click through rate’ is <?php echo $click_rate; ?>% </p>
						<?php
						}
						?>
					</div>
					<?php
					if(!empty($rating)) {
					?>
					<div class="row">
    					<div class="col-md-6">
    						<div class="school-detail-se">
	    						<h2>
		    						<ul class="star-se">
	    								<li class="display-blok"><span>Star Rating </span></li>
		    							<?php
		    							for ($i=1; $i <= 5; $i++) {
		    								$checked = ($i <= $average_rating) ? 'checked' : '';
		    							?>
		    							<li><i class="fa fa-star <?php echo $checked; ?>"></i></li>
										<?php
		    							}
		    							?>
		    							<li><?php echo $total_review; ?> reviews</li>
		    						</ul>
		    						<div class="clearfix"></div>
	    						</h2>
	    					</div>
	    					<div class="detail-box">
	    						<?php
	    						if($majorityRatingByAge['minimum_age'] != $majorityRatingByAge['maximum_age']) {
	    						?>
	    						<p>People aged <span><?php echo $majorityRatingByAge['minimum_age'].'-'.$majorityRatingByAge['maximum_age']; ?></span> left the most reviews.</p>
	    						<?php
	    						}
	    						else {
	    						?>
	    						<p>People aged <span><?php echo $majorityRatingByAge['minimum_age']; ?></span> left the most reviews. </p>
	    						<?php
	    						}
	    						?>
	    						<p>Most of the ratings came from <?php echo $majorityRatingByState['shortName']; ?>,<span> <?php echo $majorityRatingByState['postcode']; ?></span></p>
	    						<p>The majority of reviewers are <span><?php echo $majorityRatingByUser; ?></span>  </p>
	    						<p>There are <span id="total_writen_review"></span> written reviews for this profile and <span id="tot_cat_asse">0</span> category assessments.</p>
	    						<!-- <p>The majority of our raters are <span><?php echo $majorityRatingByUser; ?></span>  </p> -->
	    					</div>
    					</div>
    					<div class="col-md-6">
    						<!-- <img src="<?php echo FRONTENDPATH ?>images/srbdbg.png" alt=""> -->
    						<div id="chartdiv"></div>
    					</div>
    				</div>
					<?php
					}
					?>
	    		</div>
	    	</div>
    	</div>
    </div>

    <div class="teachers-se manu-side-se" id="teachers">
    	<div class="side-manu ">
    		<span>Teachers</span>
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/teachers.png"> -->
    	</div>
    	<div class="container">
    		<div class="school-detail-se text-center">
				<h2>Teachers @ <?php echo ucwords($school['name']); ?></h2>	    					
			</div>
    		<div class="row">
    			<div class="col-md-10 col-md-offset-1">
					<?php
					if(!empty($teachers)) {
					?>
    				<div class="owl-carousel carousel-slider">
    					<?php
						foreach ($teachers as $key => $value) {
    					?>
						<div class="item">
							<div class="pro-box text-center">
	    						<div class="pro-img">
	    							<?php
	    							if(isset($value['profile_img']) && $value['profile_img'] != '') {
	    							?>
	    							<img src="<?php echo base_url().ProfilePath.$value['profile_img']; ?>" alt="">
	    							<?php
	    							}
	    							else {
	    							?>
	    							<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
	    							<?php
	    							}
	    							?>
	    						</div>
	    						<h4><a href="<?php echo base_url('teacher/').md5($value['id']); ?>"><?php echo ucwords($value['fname'].' '.$value['lname']); ?></a></h4>
	    						<ul class="star-se">
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>    								
	    						</ul>
	    					</div>
						</div>
    					<?php
    					}	
    					?>
					</div>
    				<?php
					}
					else {
					?>
					<center>There are no teachers currently tagged at this school</center>
					<?php
					}
					?>

    			</div>
    		</div>
    	</div>
    </div>

    <?php
    $data['schoolSide'] = true;
    $this->load->view(FRONTEND.'bulletin',$data);
    ?>

    
    <div class="events-se manu-side-se" id="event">
    	<div class="side-manu ">
    		<span>Events</span>
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/teachers.png"> -->
    	</div>
    	<div class="container">
    		<div class="school-detail-se text-center">
				<h2>Upcoming events and important dates</h2>	    					
			</div>
			
			<?php
			if(isset($calender_event) && count($calender_event) > 0) {
				$calender_eventCount = count($calender_event);
				$class = $id = '';
				$sr = 1;
				foreach ($calender_event as $cal_key => $cal_value) {
					if($sr > 2) {
					    $id = ' id="viewmore" style="display:none;"';
					    $class = 'viewmore';
					}
					$Image = $cal_value['attachment'];
					if($Image != '') {
						if(file_exists(CalendarPath.$Image)) {
							$ImagePre = base_url(CalendarPath).$Image;
						}
						else {
							$ImagePre = ASSETPATH.'images/default-image.png';
						}
					}
					else {
						$ImagePre = ASSETPATH.'images/default-image.png';
					}
					?>
					<div class="row <?= $class; ?>" <?= $id; ?>>
						<div class="row " >
							<div class="col-md-3 ">
								<div class="events-post-photo">
									<img class="responsive" src="<?= $ImagePre ?>">
									<div class="date-event">
										<?= date(" D d M, Y", strtotime($cal_value['task_date'])); ?>
									</div>
								</div>
							</div>
							<div class="col-md-9 ">
								<div class="sub-heading">
									<h2><?= $cal_value['task_name']; ?></h2>							
									<p>
										<span>Time : <?= date('h:i a',strtotime($cal_value['task_time'])).'-'.date('h:i a',strtotime($cal_value['task_end_time'])); ?></span>
										<span>Place : <?= $cal_value['task_address']; ?></span>
										<?php
										/*$event_cost = "This is a FREE Event";
										if($cal_value['free_event']=="0") {
											$event_cost = "$".$cal_value['task_cost'];
										}*/
										$event_cost = $cal_value['task_cost'];
										?>
										<span>Cost : <?= $event_cost; ?></span>
									</p>
									<?php
									if($cal_value['rsvp_date'] != '0000-00-00' || $cal_value['rsvp_contact'] != '') {
									?>
									<p>
										<?php
										if($cal_value['rsvp_date'] != '0000-00-00') {
										?>
										<span>RSVP Date: <?= date('D d M, Y',strtotime($cal_value['rsvp_date'])); ?></span>
										<?php
										}
										if($cal_value['rsvp_contact'] != '') {
										?>
										<span>RSVP Contact: <?= $cal_value['rsvp_contact']; ?></span>
										<?php
										}
										?>
									</p>
									<?php
									}
									?>
								</div>							
								<p><?= $cal_value['task_description']; ?></p>
							</div>

						</div>
						<hr>
					</div>
					
					
					<?php
				$sr++; 
				}
				?>
				<div class="row <?php if($calender_eventCount <= 2) { echo 'hide'; } ?>">
				    <div class="col-md-12 text-center">
				        <button class="plus-minus viewMoreBtn"><i class="fa fa-plus fa-3x"></i></button>	
				    </div>
				</div>

				<div class="row ">
				    <div class="col-md-12 text-center">
				        <div class="event-view">
			                <a href="<?= base_url('calendar/view_all/'.md5($school['id'])); ?>" class="btn-1">View Calender</a>
			            </div>
				    </div>
				</div>
				<?php
			} else {
				?>
				<div class="row text-center">
					<h4>No events</h4>
				</div>
				<?php
			}
			?>
			

			<!-- <div class="col-md-12 text-center">
                <button class="plus-minus viewMoreBtn"><i class="fa fa-plus fa-3x"></i></button>
                <div class="event-view">
	                <a href="<?= base_url('calendar'); ?>" class="btn-1">View Calender</a>
	            </div>
            </div> -->
    		


    	</div>
    </div>
    

</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<!-- Modal -->
<div id="reviewModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
    	<!-- Modal content-->
    	<form id="reviewForm" role="form" method="post">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Leave a Review</h4>
	      		</div>
	      		<div class="modal-body">
	        		<div class="row">
		      			<?php
		      			if(isset($this->session->USER['UId'])) {
		      				$user = $this->common->get_one_row('tbluser',array('id'=>$this->session->USER['UId']));
		      			?>
		      			<div class="col-md-12">

		        			<input type="hidden" name="userId" class="form-control" value="<?php echo $user['id']; ?>">
		        			<input type="hidden" name="schoolId" id="schoolId" class="form-control" value="<?php echo $school['id']; ?>">
		        			<input type="hidden" name="userName" id="userName" class="form-control" value="<?php echo ucwords($user['fname'].' '.$user['lname']); ?>">

		      				<div class="form-group">
		      					<!-- <label>How you would rate <?php echo ucwords($school['name']); ?>? Leave a star rating. <span class="star-mend">*</span></label> -->
		      					<label>How you would rate <?php echo ucwords($school['name']); ?>? This rating will remain anonymous. <span class="star-mend">*</span></label>
		      					<div class="list-style-none form-review-stars">

									<span style="cursor: pointer;">
										<div class="rating-symbol" style="display: inline-block; position: relative;">
											<div class="rating-symbol-background fa fa-star-o fa-2x" style="visibility: visible;"></div>
											<div class="rating-symbol-foreground" style="display: inline-block; position: absolute; overflow: hidden; left: 0px; right: 0px; top: 0px; width: 0px;"><span class="fa fa-star fa-2x"></span></div>
										</div>
										<div class="rating-symbol" style="display: inline-block; position: relative;">
											<div class="rating-symbol-background fa fa-star-o fa-2x" style="visibility: visible;"></div>
											<div class="rating-symbol-foreground" style="display: inline-block; position: absolute; overflow: hidden; left: 0px; right: 0px; top: 0px; width: 0px;"><span class="fa fa-star fa-2x"></span></div>
										</div>
										<div class="rating-symbol" style="display: inline-block; position: relative;">
											<div class="rating-symbol-background fa fa-star-o fa-2x" style="visibility: visible;"></div>
											<div class="rating-symbol-foreground" style="display: inline-block; position: absolute; overflow: hidden; left: 0px; right: 0px; top: 0px; width: 0px;"><span class="fa fa-star fa-2x"></span></div>
										</div>
										<div class="rating-symbol" style="display: inline-block; position: relative;">
											<div class="rating-symbol-background fa fa-star-o fa-2x" style="visibility: visible;"></div>
											<div class="rating-symbol-foreground" style="display: inline-block; position: absolute; overflow: hidden; left: 0px; right: 0px; top: 0px; width: 0px;"><span class="fa fa-star fa-2x"></span></div>
										</div>
										<div class="rating-symbol" style="display: inline-block; position: relative;">
											<div class="rating-symbol-background fa fa-star-o fa-2x" style="visibility: visible;"></div>
											<div class="rating-symbol-foreground" style="display: inline-block; position: absolute; overflow: hidden; left: 0px; right: 0px; top: 0px; width: 0px;"><span class="fa fa-star fa-2x"></span></div>
										</div>
									</span>
									<input type="hidden" name="rating" class="rating-tooltip" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" value="">
									<div class="review-emoticons">
										<div class="review angry"><img class="icon icons8-angry" src="<?php echo ASSETPATH.'images/angry.png'; ?>" alt="angry"></div>
										<div class="review cry"><img class="icon icons8-crying" src="<?php echo ASSETPATH.'images/cry.png'; ?>" alt="crying"></div>
										<div class="review sleeping"><img class="icon icons8-sleeping" src="<?php echo ASSETPATH.'images/sleeping.png'; ?>" alt="sleeping"></div>
										<div class="review smily"><img class="icon icons8-smily" src="<?php echo ASSETPATH.'images/smily.png'; ?>" alt="smily"></div>
										<div class="review cool"><img class="icon icons8-cool" src="<?php echo ASSETPATH.'images/cool.png'; ?>" alt="cool"></div>
									</div>
								</div>
								<br>
		      				</div>
		      				<div class="form-group">
			        			<!-- <label>Tell us why you left this star rating.</label> -->
			        			<label>Please tell us why you left this star rating. Your comment and account name will be shared with the public.</label>
			        			<?php /* <textarea name="review" id="review" class="form-control"></textarea>
			        			<div id="error_check_editor"></div> */ ?>
			        			<div class="row">
			        				<div class="col-md-6">
			        					<input type="text" name="review" id="review" class="form-control">
			        				</div>
			        			</div>
			        		</div>
		      				<div class="form-group">
		      					<!-- <label>Help us rank this school/teacher in each category by moving the black pin.<span class="star-mend">*</span></label> -->
		      					<label>Help us rank this profile based on your experience in each of the below categories by sliding the pin across the line. This rating will remain anonymous.<span class="star-mend">*</span></label>
		      					<br>
	      						<div class="icon-se">
	      						    <div class="icon-box icon-box-1"></div>
	      						    <div class="icon-box icon-box-2"></div>
	      						    <div class="icon-box icon-box-3"></div>
	      						    <div class="icon-box icon-box-4"></div>
	      						    <div class="icon-box icon-box-5"></div>
	      					  	</div>
	      					  	
		      					<div class="range-slider">
						  			<label>Facilities</label>
								  	<input class="range-slider__range" name="facilities" id="facilities" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Culture</label>
								  	<input class="range-slider__range" name="culture" id="culture" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Staff</label>
								  	<input class="range-slider__range" name="staff" id="staff" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Curriculum / STEM</label>
								  	<input class="range-slider__range" name="curriculum" id="curriculum" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Fees</label>
								  	<input class="range-slider__range" name="fees" id="fees" type="range" value="" min="0" max="100">
								</div>
		      				</div>
		      			</div>
		        		<?php
		        		}
		        		else {
		        		?>
	        			<div class="col-md-12 text-center">
	        				<!-- <p>You have to Login for Leave a Review</p> -->
	        				<p>Please sign in or sign up to leave a review</p>
	        				<?php
	        				$url = $CI->config->site_url($CI->uri->uri_string());
	        				$this->session->set_userdata("user_last_page",$url);
	        				?>
	        				<a href="<?php echo base_url('login'); ?>" class="btn-1">Sign In / Sign Up</a>
	        			</div>
		        		<?php
		        		}
		        		?>
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	      			<?php
	      			if(isset($this->session->USER['UId'])) {
	      			?>
	      			<button type="submit" id="reviewFormBtn" class="btn-1">Submit</button>
	      			<?php
	      			}
	      			?>
	        		<button type="button" class="btn-2" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
    	</form>
  	</div>
</div>

<script src="<?php echo FRONTENDPATH ?>js/owl.carousel.js?i=<?php echo time(); ?>"></script> 
<script src="<?php echo FRONTENDPATH ?>js/slider1.js"></script>
<script src="<?php echo FRONTENDPATH ?>js/needsharebutton.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.3/clipboard.min.js"></script>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="https://tiles.unwiredmaps.com/js/leaflet-unwired.js"></script>

<!-- Resources -->
<script src="<?php echo ASSETPATH ?>plugins/amchart/core.js"></script>
<script src="<?php echo ASSETPATH ?>plugins/amchart/charts.js"></script>
<script src="<?php echo ASSETPATH ?>plugins/amchart/animated.js"></script>
<script type="text/javascript">
	$(".viewMoreBtn").on("click", function () {
	    var txt = $("#viewmore").is(':visible') ? '<i class="fa fa-plus fa-3x"></i>' : '<i class="fa fa-minus fa-3x"></i>';
	    $('.viewmore').slideToggle(200);
	    $(".viewMoreBtn").html(txt);
	});
</script>
<!-- Search bar -->

<script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script>
<script src="<?php echo F_JSPATH ?>custom.js"></script>



<script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">

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
});

</script>


<?php
$teacherCnt = $parentCnt = $studentCnt = $otherCnt = 0;
$totalCount = 0;
foreach ($ratingByUser as $key => $value) {
	$totalCount += $value['rating_count'];
	if($value['profession'] == 'teacher') {
		$teacherCnt = $value['percentage'];
	}
	if($value['profession'] == 'other') {
		$otherCnt = $value['percentage'];
	}
	if($value['profession'] == 'parent') {
		$parentcnt = $value['percentage'];
	}
	if($value['profession'] == 'student') {
		$studentCnt = $value['percentage'];
	}
}

if(!empty($rating)) {
?>
<!-- Chart code -->
<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [{
  "type": "Others",
  "percent": <?php echo $otherCnt ?>,
  "color": "#f88e1e"
},{
  "type": "Parents",
  "percent": <?php echo $parentCnt ?>,
  "color": "#24c70a"
}, {
  "type": "Teachers",
  "percent": <?php echo $teacherCnt ?>,
  "color" : "#1868b1"
}, {
  "type": "Students",
  "percent": <?php echo $studentCnt ?>,
  "color" : "#c709ab"
}];

/*let watermark = new am4core.Label();
watermark.text = "My awesome chart © 2018 Myself";
chart.plotContainer.children.push(watermark);
watermark.align = "right";
watermark.valign = "bottom";*/

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "percent";
pieSeries.dataFields.category = "type";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

var sliceTemplate1 = pieSeries.slices.template;
sliceTemplate1.cornerRadius = 0;
sliceTemplate1.draggable = false;
sliceTemplate1.inert = false;
sliceTemplate1.propertyFields.fill = "color";
sliceTemplate1.propertyFields.fillOpacity = "opacity";
sliceTemplate1.propertyFields.stroke = "color";
sliceTemplate1.propertyFields.strokeDasharray = "strokeDasharray";
sliceTemplate1.strokeWidth = 1;
sliceTemplate1.strokeOpacity = 1;

/*let rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;*/

chart.legend = new am4charts.Legend();
chart.legend.position = "right";
</script>
<?php
}

?>


<script type="text/javascript">
$(document).ready(function() {

	/* Review Post */
	let schoolId = '<?php echo $school['id']; ?>';
	fetchRating(schoolId);

	// $('#review').ckeditor();
	$('#reviewBtn').click(function() {
		$('#reviewModal').modal();
	});
	$.validator.addMethod("check_ck_add_method", function (value, element) {
        return check_ck_editor();
    });

	function check_ck_editor() {
    	if (CKEDITOR.instances.review.getData() == '') {
	        return false;
	    }
	    else {
	        $("#error_check_editor").empty();
	        return true;
	    }
	}
	$("#reviewForm").validate({
  		ignore: [],
      	rules: {
        	review: {
        		// required: true
        		// check_ck_add_method: true
        		/*required: function() {
             		CKEDITOR.instances.review.updateElement();
                },*/
        	},
        	rating: {
        		required: true
        	}
      	},
      	messages: {
         	review: {
        		// required: 'Please Enter Review',
        		// check_ck_add_method: 'Please Enter Review'
        	},
        	rating: {
        		required: 'Please Select Your Rating'
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
         	} else if(element.hasClass('rating-tooltip')) {
            	error.insertAfter(element.parent());
         		error.addClass('mt-15');
            	$('<br>').insertAfter(error);
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
   	$('#facilities').rules('add', {
	    range: [0, 100]
  	});
	$('#reviewForm').on('submit',function(e) {
		$('#reviewForm').valid();
		e.preventDefault();
		let formData = $(this).serializeArray();
		let schoolId = $('#schoolId').val();
		let rating = $('.rating-tooltip').val();
		let review = $('#review').val();
		if($('#reviewForm').valid()) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url('Home/submit_review') ?>',
				data: formData,
				success: function(response) {
					response = jQuery.parseJSON(response);
					if(!response.success) {
						$('#reviewModal').modal('hide');
						if(response.profanity !== undefined) {
							// swal('OH NO!',response.message,'error');
							swal({
					            title: 'OH NO!',
					            text: response.message,
					            type: 'error'
					        }, function() {
								$('#reviewModal').modal();
					        });
						}
						else {
							swal('Error',response.message,'error');
						}
					}
					else {
						$('#reviewForm input[name="rating"]').val('');
						// CKEDITOR.instances.review.setData('');
						/**/
						$('.rating-symbol').removeClass('myClass');
						overHoverStar();
						let classes = $('.rating-symbol').attr('class');
						classes = classes.split(' ')[1];
						$('.review').removeClass('visible');
						$('.review').css({'opacity': '0','visibility': 'hidden'});
						/**/
						$('#reviewModal').modal('hide');
						// let textSuccess = (response.success) ? 'Success' : 'Error';
						let textSuccess = (response.success) ? 'Thank You!' : 'Error';
						let responseSuccess = (response.success) ? 'success' : 'error';
						// fetchRating(schoolId);
						// swal(textSuccess, response.message, responseSuccess);
						<?php
						if(isset($this->session->USER['UId'])) {
							$name = $user['fname'].' '.$user['lname'];
							$name = str_replace("'", '', $name);
						?>
						let html = '<div id="fadeIn" style="display:none;"><div class="reviews-box"><div class="reviews-title"><span><?php echo ucwords($name).'<br>'; ?> <?php echo ucwords($user['profession']); ?></span><ul class="star-se">';
						<?php
						}
						else {
						?>
						let html = '';
						<?php
						}
						?>
						for(var i=1; i<=5; i++) {
							let checked = (i <= rating) ? 'checked' : '';
							html += '<span class="fa fa-star '+checked+'"></span>';
							// html += '<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>';
						}
						html += '</ul></div>'+review+'</div></div>';
						// console.log(html);
						if(response.success) {
							if(rating > 2.5) {
								let putReview = $('.appendDiv .school-detail-se h2').html();
								let str = putReview.replace('<i class="fa fa-pencil"></i> ','');
								str = str.split(' Written Reviews');
								countStr = parseInt(str) + 1;
								$('.appendDiv .school-detail-se h2').html('<i class="fa fa-pencil"></i> '+countStr+' Written Reviews');
							}
						}
						swal({
				            title: textSuccess,
				            text: response.message,
				            type: responseSuccess
				        }, function() {
				        	if(response.success) {
					        	if(rating > 2.5) {
						        	$("html, body").animate({
										scrollTop: $('#reviewsdisplay').offset().top + $('.appendDiv').outerHeight(true) - 300
									}, 500);
									$('.appendDiv').append(html);
									$('#fadeIn').fadeIn(3000);
					        	}
				        	}
				        });
					}
				}
			});
		}
		return false;
	});
	/* Review Post */
	var key = '4e830a8564e293';
	var streets = L.tileLayer.Unwired({key: key, scheme: "streets"});
	var map = L.map('map', {
		<?php
		if($lat != '' && $long != '') {
		?>
        center: ['<?php echo $lat; ?>','<?php echo $long; ?>'],
		<?php
		}
		else {
		?>
        center: [-24.994167,134.866944],
		<?php
		}
		?>
        zoom: 3,
        layers: [streets]
	});
	L.control.scale().addTo(map);
	L.control.layers({
	    "Streets": streets
	}).addTo(map);
	<?php
	if($lat != '' && $long != '') {
	?>
	var marker = L.marker(['<?php echo $lat; ?>','<?php echo $long; ?>']).addTo(map);
	marker.bindPopup("<b><?php echo ucwords($school['name']); ?>!</b>");
	$('.map-1 i').on('click',function() {
		map.setView(new L.LatLng('<?php echo $lat; ?>','<?php echo $long; ?>'), 12 );
	});
	<?php
	}
	if($lat1 != '' && $long1 != '') {
	?>
	var marker1 = L.marker(['<?php echo $lat1; ?>','<?php echo $long1; ?>']).addTo(map);
	marker1.bindPopup("<b><?php echo ucwords($school['name']); ?>!</b><br>Primary Campus");
	$('.map-2 i').on('click',function() {
		map.setView(new L.LatLng('<?php echo $lat1; ?>','<?php echo $long1; ?>'), 12 );
	});
	<?php
	}

	if($school['primary_campus'] != '' && $school['school_type']=='4') {

		$option_data = json_decode($school['primary_campus'], true);
		$option = $option_data['address'];
		foreach ($option as $key => $value) {
			$campus_array = explode("!#!", $value);
			$str_replace = str_replace($campus_array[0], "", $value);
			$str_replace = str_replace($campus_array[5], "", $str_replace);
			$add = ucwords( str_replace("!#!", " ", $str_replace));
			$latlong3 = $CI->getCoordinates($add,true);
			?>
			var marker2 = L.marker(['<?php echo $latlong3[0]; ?>','<?php echo $latlong3[1]; ?>']).addTo(map);
			marker2.bindPopup("<b><?php echo ucwords($campus_array[0]); ?>!</b><br>Primary Campus");
			<?php						

		}
	}

	if($lat2 != '' && $long2 != '') {
	?>
	var marker2 = L.marker(['<?php echo $lat2; ?>','<?php echo $long2; ?>']).addTo(map);
	marker2.bindPopup("<b><?php echo ucwords($school['name']); ?>!</b><br>Secondary Campus");
	<?php
	}
	?>

	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1		            
	        },
	        600:{
	            items:3		            
	        },
	        1000:{
	            items:4,		            
	            loop:false
	        }
	    }
	});
	
	$('#lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    loop: true,
	    slideMargin: 0,
	    thumbItem: 4
	});
	
	var rangeSlider = function() {
	  	var slider = $('.range-slider'),
	      	range = $('.range-slider__range'),
	      	value = $('.range-slider__value');
		    
	  	slider.each(function() {
		    value.each(function(){
	      		var value = $(this).prev().attr('value');
		      	$(this).html(value);
		    });
		    range.on('input', function(){
		      	$(this).next(value).html(this.value);
		    });
	  	});
	};

	rangeSlider();


	/* Rating */
	jQuery('.rating-symbol:nth-child(1)').hover(function() {
		jQuery('.review.angry').css({
			'opacity': '1',
			'visibility': 'visible',
		});
	}, function() {
		jQuery('.review.angry').css({
			'opacity': '0',
			'visibility': 'hidden',
		});
	});
	jQuery('.rating-symbol:nth-child(2)').hover(function() {
		jQuery('.review.cry').css({
			'opacity': '1',
			'visibility': 'visible',
		});
	}, function() {
		jQuery('.review.cry').css({
			'opacity': '0',
			'visibility': 'hidden',
		});
	});
	jQuery('.rating-symbol:nth-child(3)').hover(function() {
		jQuery('.review.sleeping').css({
			'opacity': '1',
			'visibility': 'visible',
		});
	}, function() {
		jQuery('.review.sleeping').css({
			'opacity': '0',
			'visibility': 'hidden',
		});
	});
	jQuery('.rating-symbol:nth-child(4)').hover(function() {
		jQuery('.review.smily').css({
			'opacity': '1',
			'visibility': 'visible',
		});
	}, function() {
		jQuery('.review.smily').css({
			'opacity': '0',
			'visibility': 'hidden',
		});
	});
	jQuery('.rating-symbol:nth-child(5)').hover(function() {
		jQuery('.review.cool').css({
			'opacity': '1',
			'visibility': 'visible',
		});
	}, function() {
		jQuery('.review.cool').css({
			'opacity': '0',
			'visibility': 'hidden',
		});
	});

	var rtngSym = jQuery('.rating-symbol');
	var rtngTip = jQuery('input.rating-tooltip');
	myArr = ['angry','cry','sleeping','smily','cool']

	jQuery('.rating-symbol:first-of-type').hover(function() {
		jQuery('.rating-symbol:first-of-type .rating-symbol-foreground span').css('color', '#de9147');
		/**/
		onHoverStar('.rating-symbol:first-of-type');
		/**/
	}, function() {
		/**/
		overHoverStar();
		// outHoverStar('.rating-symbol:first-of-type');
		/**/
	});
	jQuery('.rating-symbol:nth-of-type(2)').hover(function() {
		jQuery('.rating-symbol:first-of-type .rating-symbol-foreground span').css('color', '#de9147');
		jQuery('.rating-symbol:nth-of-type(2) .rating-symbol-foreground span').css('color', '#de9147');
		/**/
		onHoverStar('.rating-symbol:first-of-type');
		onHoverStar('.rating-symbol:nth-of-type(2)');
		/**/
	}, function() {
		/**/
		overHoverStar();
		/**/
	});
	jQuery('.rating-symbol:nth-of-type(3)').hover(function() {
		jQuery('.rating-symbol:first-of-type .rating-symbol-foreground span').css('color', '#dec435');
		jQuery('.rating-symbol:nth-of-type(2) .rating-symbol-foreground span').css('color', '#dec435');
		jQuery('.rating-symbol:nth-of-type(3) .rating-symbol-foreground span').css('color', '#dec435');
		/**/
		onHoverStar('.rating-symbol:first-of-type');
		onHoverStar('.rating-symbol:nth-of-type(2)');
		onHoverStar('.rating-symbol:nth-of-type(3)');
		/**/
	}, function() {
		/**/
		overHoverStar();
		/**/
	});
	jQuery('.rating-symbol:nth-of-type(4)').hover(function() {
		jQuery('.rating-symbol:first-of-type .rating-symbol-foreground span').css('color', '#c5de35');
		jQuery('.rating-symbol:nth-of-type(2) .rating-symbol-foreground span').css('color', '#c5de35');
		jQuery('.rating-symbol:nth-of-type(3) .rating-symbol-foreground span').css('color', '#c5de35');
		jQuery('.rating-symbol:nth-of-type(4) .rating-symbol-foreground span').css('color', '#c5de35');
		/**/
		onHoverStar('.rating-symbol:first-of-type');
		onHoverStar('.rating-symbol:nth-of-type(2)');
		onHoverStar('.rating-symbol:nth-of-type(3)');
		onHoverStar('.rating-symbol:nth-of-type(4)');
		/**/
	}, function() {
		/**/
		overHoverStar();
		/**/
	});
	jQuery('.rating-symbol:nth-of-type(5)').hover(function() {
		jQuery('.rating-symbol:first-of-type .rating-symbol-foreground span').css('color', '#73cf42');
		jQuery('.rating-symbol:nth-of-type(2) .rating-symbol-foreground span').css('color', '#73cf42');
		jQuery('.rating-symbol:nth-of-type(3) .rating-symbol-foreground span').css('color', '#73cf42');
		jQuery('.rating-symbol:nth-of-type(4) .rating-symbol-foreground span').css('color', '#73cf42');
		jQuery('.rating-symbol:nth-of-type(5) .rating-symbol-foreground span').css('color', '#73cf42');
		/**/
		onHoverStar('.rating-symbol:first-of-type');
		onHoverStar('.rating-symbol:nth-of-type(2)');
		onHoverStar('.rating-symbol:nth-of-type(3)');
		onHoverStar('.rating-symbol:nth-of-type(4)');
		onHoverStar('.rating-symbol:nth-of-type(5)');
		/**/
	}, function() {
		/**/
		overHoverStar();
		/**/
	});
	rtngSym.on('click', function(event) {
		event.preventDefault();
		position = $(".rating-symbol").index(this);
		$('input.rating-tooltip').val(position+1);

		var thsVal 	= jQuery('input.rating-tooltip').val();

		//alert(thsVal);
		if (thsVal == 1) {
			jQuery('.review.angry').addClass('visible');
			jQuery('.rating-symbol:first-of-type').addClass('angry');
			jQuery('.rating-symbol').removeClass('cry');
			jQuery('.rating-symbol').removeClass('sleeping');
			jQuery('.rating-symbol').removeClass('smily');
			jQuery('.rating-symbol').removeClass('cool');
			/**/
			onHoverStar('.rating-symbol:first-of-type');
			jQuery('.rating-symbol').removeClass('myClass');
			jQuery('.rating-symbol:first-of-type').addClass('myClass');
			/**/
		}else{
			jQuery('.review.angry').removeClass('visible');
		};

		if (thsVal == 2) {
			jQuery('.review.cry').addClass('visible');
			jQuery('.rating-symbol:first-of-type').addClass('cry');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('cry');
			jQuery('.rating-symbol').removeClass('angry');
			jQuery('.rating-symbol').removeClass('sleeping');
			jQuery('.rating-symbol').removeClass('smily');
			jQuery('.rating-symbol').removeClass('cool');
			/**/
			onHoverStar('.rating-symbol:first-of-type');
			onHoverStar('.rating-symbol:nth-of-type(2)');
			jQuery('.rating-symbol').removeClass('myClass');
			jQuery('.rating-symbol:first-of-type').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('myClass');
			/**/
		}else{
			jQuery('.review.cry').removeClass('visible');
		};

		if (thsVal == 3) {
			jQuery('.review.sleeping').addClass('visible');
			jQuery('.rating-symbol:first-of-type').addClass('sleeping');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('sleeping');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('sleeping');
			jQuery('.rating-symbol').removeClass('angry');
			jQuery('.rating-symbol').removeClass('cry');
			jQuery('.rating-symbol').removeClass('smily');
			jQuery('.rating-symbol').removeClass('cool');
			/**/
			onHoverStar('.rating-symbol:first-of-type');
			onHoverStar('.rating-symbol:nth-of-type(2)');
			onHoverStar('.rating-symbol:nth-of-type(3)');
			jQuery('.rating-symbol').removeClass('myClass');
			jQuery('.rating-symbol:first-of-type').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('myClass');
			/**/
		}else{
			jQuery('.review.sleeping').removeClass('visible');
		};

		if (thsVal == 4) {
			jQuery('.review.smily').addClass('visible');
			jQuery('.rating-symbol:first-of-type').addClass('smily');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('smily');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('smily');
			jQuery('.rating-symbol:nth-of-type(4)').addClass('smily');
			jQuery('.rating-symbol').removeClass('angry');
			jQuery('.rating-symbol').removeClass('cry');
			jQuery('.rating-symbol').removeClass('sleeping');
			jQuery('.rating-symbol').removeClass('cool');
			/**/
			onHoverStar('.rating-symbol:first-of-type');
			onHoverStar('.rating-symbol:nth-of-type(2)');
			onHoverStar('.rating-symbol:nth-of-type(3)');
			onHoverStar('.rating-symbol:nth-of-type(4)');
			jQuery('.rating-symbol').removeClass('myClass');
			jQuery('.rating-symbol:first-of-type').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(4)').addClass('myClass');
			/**/
		}else{
			jQuery('.review.smily').removeClass('visible');
		};

		if (thsVal == 5) {
			jQuery('.review.cool').addClass('visible');
			jQuery('.rating-symbol:first-of-type').addClass('cool');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('cool');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('cool');
			jQuery('.rating-symbol:nth-of-type(4)').addClass('cool');
			jQuery('.rating-symbol:nth-of-type(5)').addClass('cool');
			jQuery('.rating-symbol').removeClass('angry');
			jQuery('.rating-symbol').removeClass('cry');
			jQuery('.rating-symbol').removeClass('sleeping');
			jQuery('.rating-symbol').removeClass('smily');
			/**/
			onHoverStar('.rating-symbol:first-of-type');
			onHoverStar('.rating-symbol:nth-of-type(2)');
			onHoverStar('.rating-symbol:nth-of-type(3)');
			onHoverStar('.rating-symbol:nth-of-type(4)');
			onHoverStar('.rating-symbol:nth-of-type(5)');
			jQuery('.rating-symbol').removeClass('myClass');
			jQuery('.rating-symbol:first-of-type').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(2)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(3)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(4)').addClass('myClass');
			jQuery('.rating-symbol:nth-of-type(5)').addClass('myClass');
			/**/
		}else{
			jQuery('.review.cool').removeClass('visible');
		};

	});
	/* Rating */

	/* Conversion_click */
	$('#schoolWebsite').on('click', function() {
		let schoolId = $(this).attr('data-id');
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(FRONTEND.'School/add_conversion'); ?>',
			data: { schoolId: schoolId },
			success: function(response) {
				response = jQuery.parseJSON(response);
				console.log(response.message);
			}
		});
		// return false;
	});
	/* Conversion_click */

	$(document).on('click', 'a[href^="#"]', function (event) {
	    event.preventDefault();

	    $('html, body').animate({
	        scrollTop: $($.attr(this, 'href')).offset().top
	    }, 500);
	});

	new needShareDropdown(document.getElementById('share-button-5'), {
	// child selector of custom share button
	shareButtonClass: false, 
	// default or box
	iconStyle: 'default', 
	// horizontal or vertical
	boxForm: 'horizontal', 
	// top / middle / bottom + Left / Center / Right
	position: 'bottomCenter', 
	// text for trigger button
	buttonText: 'Share',
	// http or https
	protocol: ['http', 'https'].indexOf(window.location.href.split(':')[0]) === -1 ? 'https://' : '//',
	// url to share
	url: window.location.href,
	// title to share
	// title: root.getTitle(),
	// image to share
	// image: root.getImage(),
	// description to share
	// description: root.getDescription(),
	// social networks
	// networks: 'Mailto,Twitter,Pinterest,Facebook,GooglePlus,Reddit,Delicious,Tapiture,StumbleUpon,Linkedin,Slashdot,Technorati,Posterous,Tumblr,GoogleBookmarks,Newsvine,Pingfm,Evernote,Friendfeed,Vkontakte,Odnoklassniki,Mailru'
	networks: 'Twitter,Facebook,GooglePlus,Directcopy'
	});

	

    var clipboard = new Clipboard('.copytoclip');
    clipboard.on('success', function(e) {
		swal('Success!', 'Copied to clipboard Successfully..', 'success');
	});

	clipboard.on('error', function(e) {
		swal('Error!', 'Copy to clipboard not copied..', 'error');
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

});

function onHoverStar(element)
{
	$(element).find('.rating-symbol-background').css('visibility','hidden');
	$(element).find('.rating-symbol-foreground').css('width','auto');
}

function outHoverStar(element)
{
	$(element).find('.rating-symbol-background').css('visibility','visible');
	$(element).find('.rating-symbol-foreground').css('width','0px');
}

function overHoverStar()
{
	let count = 0;
	$('.rating-symbol').each(function(k,v) {
		let check = $(v).hasClass('myClass');
		if(!check) {
			outHoverStar(v);
		}
		else {
			count++;
		}
	});
	if(count > 0) {
		let myArr = { 1: '#de9147', 2: '#de9147', 3: '#dec435', 4: '#c5de35', 5: '#73cf42'}
		$('.myClass').find('.rating-symbol-foreground span').css('color', myArr[count]);
	}
}

function fetchRating(schoolId)
{
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url('Home/fetch_rating') ?>',
		data: { schoolId: schoolId },
		success: function(response) {
			$('#reviewsdisplay').html(response);
		}
	});
}




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



</script>