<?php $CI =& get_instance(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/owl.carousel.css">
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
<div class="teachers-profile-page-se">

    <div class="slider-se">
    	<div class="listing-banner-img-se teacher-listing-new">
    		<div class="container">    			
                 <div class="upper-text-se">
                <?php /*<form id="searchForm" method="post" action="<?php echo base_url('searchquery') ?>"> */ ?>
                    <form method="get" action="<?= base_url('teachers'); ?>" id="searchForm">
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

        <!-- <div class="slider-se">
        	<div class="listing-banner-img-se teacher-listing-new">
        		<div class="container">    			
                    <div class="upper-text-se">
                    </div>
    	    	</div>
        	</div>
    		<div class="bottom-text">
    			<h3>“An investment in knowledge pays the best interest.”  Benjamin Franklin</h3>
    		</div>
        </div> -->

    <!-- <div class="slider-se">
    	<div class="profile-banner-img-se">
    		<div class="container">    			
	    		<div class="upper-text-se">
	    			<div class="row">
	    				<div class="col-md-6 col-md-offset-6">
			    			<h1>Teacher Profile</h1>
		    				<h3>Read or leave reviews, </h3>			    			
		    				<h3>Contact & Compare </h3>	
			    		</div>
			    	</div>
	    		</div>
	    	</div>
    	</div>
		<div class="bottom-text">
			<h3>“We all need people who will give us feedback. That's how we improve.”  Bill Gates</h3>
		</div>
    </div> -->

    <div class="yellow-box">
    	<div class="container">
    		<div class="row">
				<div class="col-md-12">
		    		<?php /* ?><div class="in-box text-center">
		    			<div class="review-box">
		    				<p >Tell us about your learning experience at this school by <br>sharing a star rating, comment or category assessment. </p>
		    				<!-- <a href="javascript:void(0);" class="btn-1"><i class="fa fa-edit"></i> Leave a review!</a> -->
		    				<br>
		    				<a href="javascript:void(0);" id="reviewBtn" class="btn-1"><i class="fa fa-edit"></i> Leave a review!</a>
						</div>
					</div><?php */ ?>
					<div class="page-tab-se text-center">
						<ul>
						    <li class="back-color-1"><a href="#backgrounder">Backgrounder</a></li>
						    <li class="back-color-2"><a href="#reviews">Reviews</a></li>
						    <li class="back-color-3"><a href="#performance">Comparative Performance Metrics</a></li>
						    <li class="back-color-4"><a href="#teachers">School</a></li>        
						    <li class="back-color-5"><a href="#articles">Articles</a></li>        
						    <style>
						    	.page-tab-se li.back-color-5 a:before{background: tr}
						    </style>
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
    					<!-- <div class="brand-logo">
    						<img src="<?php echo FRONTENDPATH ?>images/brand-logo.png" alt="">
    					</div> -->
    					<div class="school-detail-se">
    						<h2>
    							<?php echo $teacher["title"].' '.$teacher["fname"].' '.$teacher["lname"] ?>
    							<?php
		    					/*$flag = false;
		    					if($teacher['teach_school'] != '') {
		    						$flag = true;
		    					?>
		    					<span class="badge badge-success">Teaching</span>
		    					<?php
		    					}
		    					if(!$flag) {
			    					if($teacher['previous_school'] != '') {
			    					?>
			    					<span class="badge badge-danger">Retired</span>
			    					<?php
			    					}
		    					}*/
		    					?>
		    					<?php
		    					if($teacher["teacher_status"]=="0") {
		    						?>
		    						<span class="badge badge-success">Teaching</span>
		    						<?php
		    					} else if($teacher["teacher_status"]=="1") {
		    						?>
		    						<span class="badge badge-danger">Retired</span>
		    						<?php
		    					}
		    					?>
    						</h2>
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
    								<span><i class="fa fa-envelope"></i></span> <a href="mailto:<?php echo $teacher['email']; ?>"><?php echo $teacher['email']; ?></a>
    							</div>
    							<?php
    							if(!empty($teacher['phone'])) {
    							?>
    							<div class="icon-bx">
    								<span><i class="fa fa-phone"></i></span>
    								<?php echo !empty($teacher['phone']) ? $teacher['phone'] : '-'; ?>
    							</div>
    							<?php
    							}
    							if(!empty($teacher['mobile'])) {
    							?>
    							<div class="icon-bx">
    								<span><i class="fa fa-mobile"></i></span> 
    								<?php echo !empty($teacher['mobile']) ? $teacher['mobile'] : '-'; ?>
    							</div>
    							<?php
    							}
    							?>
    							<?php
    							if($teacher['document'] != '') {
    							?>
    							<div class="icon-bx">
    								<span><i class="fa fa-book"></i></span> <a href="<?php echo base_url().ResumePath.$teacher['document']; ?>" target="_blank">Curriculum Vitae</a>
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
    					<?php /*<div id="fb-root"></div>
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
    					</div> */ ?>
    					<!-- <div id="share-button-5" class="need-share-button-default" data-share-position="topCenter" data-share-share-button-class="custom-button">
    					<span class="custom-button"><i class="fa fa-share"></i> share</span></div>
    					<div class="view-icon">
    						<span><i class="fa fa-eye"></i></span> <?php echo $pageview; ?> page views
    					</div> -->
    					<div id="share-button-5" class="need-share-button-default pull-left" data-share-position="topCenter" data-share-share-button-class="custom-button">
    						<span class="custom-button"><i class="fa fa-share"></i> share</span></div>
    					<div class="view-icon pull-left">
    						<!-- <span><i class="fa fa-eye"></i></span> <?php echo $pageview; ?> page views -->
    						<span><i class="fa fa-eye"></i></span> <?php echo $pageview; ?>
    					</div>
    				</div>
    			</div>
    		</div>
		
			<div class="col-md-6">
				<div class="left-se">
					<div class="demo">
					    <ul id="lightSlider">
					    	<?php
					    	$profilePic = $teacher['profile_img'];
					    	if(isset($profilePic) && $profilePic != '') {
							?>
					    	<li data-thumb="<?php echo base_url().ProfilePath.$profilePic; ?>">
								<img src="<?php echo base_url().ProfilePath.$profilePic; ?>" alt="">
					        </li>
							<?php
							}
							else {
							?>
					    	<li data-thumb="<?php echo ASSETPATH.'images/default-image.png'; ?>">
								<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
					        </li>
							<?php
							}
							?>
					    </ul>
					</div>
					<div class="detail-se">
						<p><span>Motto:</span> <?php echo ($teacher['motto'] != '') ? $teacher['motto'] : '--'; ?></p>
						<?php echo $teacher['about']; ?>
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="right-se">
					<div class="detail-se">
						<?php
						$current_school_det = $this->common->get_one_row('tbl_school',array('id'=>$teacher['teach_school']));
						$current_school = ucwords($current_school_det['name']);
						$previous_school = $this->common->get_one_row('tbl_school',array('id'=>$teacher['previous_school']));
						$previous_school = ucwords($previous_school['name']);
						$experience = '';
						$year_start = $teacher['year_started_teach'];
						$today = date('Y');
						$diff = strtotime($year_start)-strtotime($today);
						$year = ($diff > 1) ? 'years' : 'year';
						$experience = $diff.' '.$year;
						?>
						<p> <span>Work status:</span>  <?php echo $teacher["teach_school"] == 1 ? 'Retired' : 'Teaching'; ?> </p>
						<p> <span>Current School: </span>  <?php echo $current_school; ?></p>
						<p> <span>Previous school:</span>  <?php echo $previous_school; ?></p>
						<p> <span>Qualifications: </span> <?php echo $teacher['qualifications']; ?> </p>
						<p> <span>Teaching Experience:</span> <?php echo $experience ?> </p>
						<p> <span>Special Needs experience: </span> <?php echo $teacher["need_experience"] == 1 ? 'Yes' : 'No'; ?></p>
						<?php
						if($teacher["need_experience"]=='1' && $teacher["special_need_category"]!='0') {
							$special_need_categoriesArr = explode(',', $teacher["special_need_category"]);
							$teacher_special_categories = array();
							foreach ($special_need_categoriesArr as $categories) {
								array_push($teacher_special_categories, $special_need_category[$categories]);
							}
							$teacher_special_categories = implode(',', $teacher_special_categories);
							?>
							<p> <span>Special Needs Category: </span> <?php echo $teacher_special_categories; ?></p>
							<?php
						}
						?>

						<p> <span>Units: </span> <?php echo $teacher['units_teach']; ?></p>
						<p> <span>Type:</span>  <?php echo join(',', array_map('ucfirst', explode(',', $teacher["type"])));?></p>
						<p> <span>Tutoring services:</span>  <?php echo $teacher["tutoring_services"] == 1 ? 'Yes' : 'No'; ?></p>
						<?php if($teacher["tutoring_services"] == 1 ){ ?>
							<p> <span>Preferred hours:</span> <?php echo $teacher["preferred_hours"];?></p>
							<?php
							if($teacher["preferred_days"] != '') {
								$preferred_days = explode(',', $teacher["preferred_days"]);
								$preferred_days = implode(', ', $preferred_days);
							?>
							<p> <span>Preferred days:</span> <?php echo ucwords($preferred_days); ?></p>
							<?php
							}
							?>
						<?php } ?>
						<!-- <p> <span>Working With Children Check: </span><?php echo $teacher["working_with_children"] == 1 ? 'Yes' : 'No'; ?></p> -->
						<?php if($teacher["working_with_children"] == 1 ){ ?>
							<p> <span>WWCC number: </span><?php echo $teacher["wwcc_number"];?></p>       
						<?php } ?>
						<p> <span>Multilingual: </span> <?php echo $teacher["multilanguage"] == 1 ? 'Yes' : 'No'; ?></p>
						<?php if($teacher["multilanguage"] == 1 ){ ?>
							<p> <span>Languages spoken: </span><?php echo $teacher["language"];?></p>
						<?php } ?>
						<?php
						$head_office = '';
						if(isset($current_school_det) && $current_school_det['address_1'] != '') {
							$head_office .= ucwords($current_school_det['address_1']).',';
						}
						if($current_school_det['address_2'] != '') {
							$head_office .= ucwords($current_school_det['address_2']).',';
						}
						if($current_school_det['city'] != '') {
							$head_office .= ucwords($current_school_det['city']).',';
						}
						if($current_school_det['state'] != '') {
							$head_office .= ucwords($state['name']).',';
						}
						if($current_school_det['po_box'] != '') {
							$head_office .= ucwords($current_school_det['po_box']).',';
						}
						$head_office = rtrim($head_office, ',');
						?>
						<p class="map-1"><i class="fa fa-map-marker"></i> <span>Office Address: <?php echo $head_office; ?></span>  </p>
						<?php
						if($current_school_det['primary_campus'] != '') {
						?>
						<p class="map-2"><i class="fa fa-map-marker"></i> <span>Primary Campus:</span> <?php echo ucwords($current_school_det['primary_campus']); ?></p>
						<?php
						}
						?>
						<?php
						if(isset($current_school_det) &&  $current_school_det['secondary_campus'] != '') {
						?>
						<p class="map-2"><i class="fa fa-map-marker"></i> <span>Secondary Campus:</span> <?php echo ucwords($current_school_det['secondary_campus']); ?></p>
						<?php
						}
						?>
						<?php if(isset($current_school_det) && $current_school_det['po_box']!='') { ?>
						<p class="map-2"><i class="fa fa-map-marker"></i> <span> PO BOX:  <?php echo $current_school_det['po_box']; ?></span> </p>
						<?php } ?>

					</div>
					<div class="map-se">
						<?php
						$address = array();
						if($current_school_det['address_1'] != '') {
							$address['street'] = $current_school_det['address_1'];
						}
						if($current_school_det['city'] != '') {
							$address['city'] = $current_school_det['city'];
						}
						if($current_school_det['state'] != '') {
							$address['state'] = $state['name'];
						}
						
						// $CI =& get_instance();
						$latlong = $CI->getCoordinates($address);
						$lat = $long = $lat1 = $long1 = $lat2 = $long2 = '';
						if(!empty($latlong)) {
							$lat = $latlong[0];
							$long = $latlong[1];
							// echo $lat.'---'.$long;
						}

						if($current_school_det['show_primary'] == 1) {
							$latlong1 = $CI->getCoordinates($current_school_det['primary_campus'],true);
							if(!empty($latlong1)) {
								$lat1 = $latlong1[0];
								$long1 = $latlong1[1];
							}
						}
						if($current_school_det['show_secondary'] == 1) {
							$latlong2 = $CI->getCoordinates($current_school_det['secondary_campus'],true);
							if(!empty($latlong2)) {
								$lat2 = $latlong2[0];
								$long2 = $latlong2[1];
							}
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
						<p><?php echo ucwords($teacher['fname'].' '.$teacher['lname']); ?> is ranked <span>#<?php echo $rank; ?> out of <?php echo count($teachers); ?></span> teachers in our Australian teacher Directory.</p>
						<?php
						if($teacher['type'] != '0') {
							$type = ucwords(str_replace(',', ', ', $teacher['type']));
						?>
						<?php //if($rankTeacherType > 0) { ?>
							<p>This teacher is ranked <span>#<?php echo $rankTeacherType; ?> in <?php echo $type; ?> Education 
							<?php if($rankState > 0) { ?>
								</span> and <span>#<?php echo $rankState; ?> in <?php echo $state['shortName']; ?>.</span>
							<?php } ?>
							</p>
						<?php //} ?>

						<?php
						}
						?>
						<p>This profile has a <span>total of <?php echo $total_rating; ?> reviews </span> and <?php echo $pageview; ?> page views, therefore <?php echo number_format($visitor,2,'.','') ?>% of visitors have left a review.</p>
						<?php ?><p>There are a total of <span><?php echo $total_click; ?> clicks from this profile to the teacher website,</span> the ‘click through rate’ is <?php echo $click_rate; ?>% </p><?php ?>
					</div>
					<?php
					if(!empty($rating)) {
					?>
					<div class="row">
    					<div class="col-md-6">
    						<div class="school-detail-se">
	    						<h2>
		    						<ul class="star-se">
	    								<li class="display-blok"><span >Star Rating </span></li>
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
	    						<p>People aged <span><?php echo $majorityRatingByAge['minimum_age'].'-'.$majorityRatingByAge['maximum_age']; ?></span> left the most reviews. </p>
	    						<?php
	    						}
	    						else {
	    						?>
	    						<p>People aged <span><?php echo $majorityRatingByAge['minimum_age']; ?></span> left the most reviews.</p>
	    						<?php
	    						}
	    						?>

	    						<p>Most of the ratings came from <?php echo $majorityRatingByState['shortName']; ?>,<span> <?php echo $majorityRatingByState['postcode']; ?></span></p>
	    						<p>The majority of reviewers are <span><?php echo $majorityRatingByUser; ?></span>  </p>
	    						<p>There are <span id="total_writen_review"></span> written reviews for this profile and <span id="tot_cat_asse">0</span> category assessments. </p>
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
    		<!-- <img src="<?php echo FRONTENDPATH ?>images/school.png"> -->
    	</div>
    	<div class="container">
			<div class="col-md-10 col-md-offset-1">
    			<div class="teacher-detail-se">
					<h2>Works @ <?php echo ucwords($current_school_det['name']); ?></h2>	    										
    				<div class="row">
						<div class="col-md-4">
							<div class="hi-school-img">
								<a href="<?php echo base_url('school/'.md5($current_school_det['id'])); ?>">
								<?php
								$photos = $current_school_det['photos'];
								$photos = json_decode($photos, true);
								if(!empty($photos)) {
								?>
								<img src="<?php echo base_url().PhotosPath.$photos[0]; ?>">
								<?php
								}
								else {
								?>
								<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
								<?php
								}
								?>
								</a>
								<a href="javascript:void(0);" class="btn-1">Learn more</a>
							</div>
						</div>
						<div class="col-md-8">
							<ul class="star-se">
    							<?php
    							$rating_school = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$current_school_det['id'],'isDelete'=>0),'schoolId');
    							$rating_school = (!empty($rating_school)) ? $rating_school[0] : array();
    							// $rating_school = array();
    							$average_rating_school = '';
    							$total_review_school = 0;
    							if(!empty($rating_school)) {
    								$average_rating_school = intval($rating_school['average_rating']);
    								$total_review_school = $rating_school['total_rating'];
    							}
    							for ($i=1; $i <= 5; $i++) {
    								$checked = ($i <= $average_rating_school) ? 'checked' : '';
    							?>
    							<span class="fa fa-star <?php echo $checked; ?>"></span>
								<?php
    							}
    							?>
    							<li><?php echo $total_review_school; ?> reviews</li>
    						</ul>
							<div class="detail-se">
								<p> <span>Motto:</span> <?php echo $current_school_det['motto']; ?></p>
								<p> <span>Telephone:</span> <a href="tel:+<?php echo $current_school_det['telephone']; ?>"><?php echo $current_school_det['telephone']; ?></a></p>
								<p> <span>Email:</span> <a href="mailto:<?php echo $current_school_det['email']; ?>"><?php echo $current_school_det['email']; ?></a></p>
							</div>
							<p class="disc"><?php echo $current_school_det['about']; ?></p>
						</div>
    				</div>
    			</div>
			</div>
    	</div>
    </div>

    <?php
    $data['teacherSide'] = true;
    $this->load->view(FRONTEND.'bulletin',$data);
    ?>

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
		      				<input type="hidden" name="schoolId" value="">
		        			<input type="hidden" name="userId" class="form-control" value="<?php echo $user['id']; ?>">
		        			<input type="hidden" name="teacherId" id="teacherId" class="form-control" value="<?php echo $teacher['id']; ?>">
		        			<input type="hidden" name="userName" id="userName" class="form-control" value="<?php echo ucwords($user['fname'].' '.$user['lname']); ?>">

		      				<div class="form-group">
		      					<!-- <label>How you would rate <?php echo ucwords($teacher['fname']).' '.ucwords($teacher['lname']); ?>? Leave a star rating. <span class="star-mend">*</span></label> -->
		      					<label>How you would rate <?php echo ucwords($teacher['fname'].' '.$teacher['lname']); ?>? This rating will remain anonymous. <span class="star-mend">*</span></label>
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
						  			<label>Knowledge /Expertise</label>
								  	<input class="range-slider__range" name="knowledge_expertise" id="knowledge_expertise" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Professionalism</label>
								  	<input class="range-slider__range" name="professionalism" id="professionalism" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Helpfulness/ Willingness</label>
								  	<input class="range-slider__range" name="helpfulness_willingness" id="helpfulness_willingness" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Attitude</label>
								  	<input class="range-slider__range" name="attitude" id="attitude" type="range" value="" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Communication Skills</label>
								  	<input class="range-slider__range" name="communication_skills" id="communication_skills" type="range" value="" min="0" max="100">
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

<script src="<?php echo FRONTENDPATH ?>js/owl.carousel.js"></script> 
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
	let schoolId = '<?php echo $teacher['id']; ?>';
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
		let teacherId = $('#teacherId').val();
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
							html += '<span class="fa fa-star '+checked+'"></span> ';
							// html += '<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>';
						}
						html += '</ul></div>'+review+'</div></div>';
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
        zoom: 5,
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
	marker.bindPopup("<b><?php echo ucwords($current_school_det['name']); ?>!</b>");
	<?php
	}
	if($lat1 != '' && $long1 != '') {
	?>
	var marker1 = L.marker(['<?php echo $lat1; ?>','<?php echo $long1; ?>']).addTo(map);
	marker1.bindPopup("<b><?php echo ucwords($current_school_det['name']); ?>!</b><br>Primary Campus");
	$('.map-2 i').on('click',function() {
		map.setView(new L.LatLng('<?php echo $lat1; ?>','<?php echo $long1; ?>'), 12 );
	});
	<?php
	}
	if($lat2 != '' && $long2 != '') {
	?>
	var marker2 = L.marker(['<?php echo $lat2; ?>','<?php echo $long2; ?>']).addTo(map);
	marker2.bindPopup("<b><?php echo ucwords($current_school_det['name']); ?>!</b><br>Secondary Campus");
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

function fetchRating(teacherId)
{
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url('Home/fetch_rating') ?>',
		data: { teacherId: teacherId },
		success: function(response) {
			$('#reviewsdisplay').html(response);
		}
	});
}

</script>

<script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script>
<script src="<?php echo F_JSPATH ?>custom.js"></script>

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
   return true;
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