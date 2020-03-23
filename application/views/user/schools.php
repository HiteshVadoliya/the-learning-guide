<!-- <link rel="stylesheet" type="text/css" href="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/sample in bootstrap v3/bootstrap/css/bootstrap.min.css' ?>"> -->
<link rel="stylesheet" type="text/css" href="<?php echo ADMINPATH.'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' ?>">
<style type="text/css">
textarea { resize: none; }
.checked { color: #f1b500; }
.school-detail-se h2 a { color: #000; }
.title-se-box h2 a { color: #000; }
</style>
<div class="listing-page-se">
    <div class="slider-se">
    	<div class="listing-banner-img-se">
    		<div class="container">    			
	    		<div class="upper-text-se">
	    			<div class="row">
	    				<div class="col-md-6 col-md-offset-6">
			    			<h1>school listings</h1>
		    				<h3>Primary, Secondary,  </h3>			    			
		    				<h3>Tertiary & Special Needs</h3>			    			
			    		</div>
			    	</div>
	    		</div>
	    	</div>
    	</div>
		<div class="bottom-text">
			<h3>“An investment in knowledge pays the best interest.”  Benjamin Franklin</h3>
		</div>
    </div>

    <?php
    foreach ($result as $key => $value) {
    	$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$value['id'],'isDelete'=>0),'schoolId');
    	$rating = (!empty($rating)) ? $rating[0] : array();
    	$class = ($key == 0) ? 'gry-box-se' : 'category-se';
		?>
	    <div class="<?php echo $class; ?>">
	    	<div class="container">
	    		<div class="row">
				    <?php
			    	if($key == 0) {
			    	?>
	    			<div class="col-md-6">
	    				<div class="title-part">	    					
	    					<div class="school-detail-se">
	    						<h2><a href="<?php echo base_url('school/'.md5($value['id'])); ?>"><?php echo ucwords($value['name']); ?></a></h2>					
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
	    							<li><?php echo $total_rating; ?> reviews</li>
	    						</ul>
	    						<h3>Sponsored post</h3>
	    						<div class="detail-se">
		    						<p><span>Motto:</span> <?php echo $value['motto']; ?></p>
		    						<p><span>Telephone:</span> <?php echo $value['telephone']; ?></p>
		    						<p><span>Email:</span> <?php echo $value['email']; ?></p>
		    					</div>
		    					<?php echo $value['about']; ?>
	    					</div>
	    				</div>
	    			</div>    		
	    			<div class="col-md-6">
	    				<div class="left-se">
	    					<?php
                            if($value['photos'] != '') {
                            	$photos = json_decode($value['photos'], true);
                            	$photos = $photos[0];
                            ?>
                            <img src="<?php echo base_url().PhotosPath.$photos; ?>" alt="" class="School Photos">
                            <?php
                            }
                            else {
                            ?>
                            <img src="<?php echo FRONTENDPATH.'images/slider-1.png'; ?>" alt="">
                            <?php
                            }
                            ?>
							<a href="javascript:void(0);" class="btn-1">Learn more</a>
							<a href="http://<?php echo $value['website']; ?>" target="_blank" class="btn-1">visit website</a>
							<a href="javascript:void(0);" class="heart-btn"><i class="fa fa-heart"></i><span>10</span></a>
						</div>
	    			</div>
			    	<?php
			    	}
			    	else {
			    		/**/
				    	$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(facilities) AS fac, AVG(culture) AS cul, AVG(staff) AS sta, AVG(curricullum) AS cur, AVG(fees) AS fee FROM `tbl_rating` WHERE `schoolId` = '".$value['id']."' AND `isDelete` =0 AND (`facilities` != 0 OR `culture` != 0 OR `staff` != 0 OR `curricullum` !=0 OR `fees` != 0) GROUP BY schoolId";
						$reviews = $this->common->cust_query($reviewsQuery);
						$reviews = (!empty($reviews)) ? $reviews[0] : array();
						/**/
			    		$type = str_replace(',', ', ', $value['type']);
			    	?>
			    	<div class="col-md-10 col-md-offset-1">
		    			<div class="title-se-box">
			    			<h2><a href="<?php echo base_url('school/'.md5($value['id'])); ?>"><?php echo ucwords($value['name']); ?></a></h2>
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
    							<li><?php echo $total_rating; ?> reviews</li>
							</ul>				
							<p>Category Assessment</p>			
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="description-se">
									<div class="detail-se">
										<p><span>Motto:</span> <?php echo $value['motto']; ?></p>
										<p><span>Principal:</span> <?php echo ucwords($value['principal']); ?></p>
										<p><span>Type:</span> <?php echo ucwords($type); ?> </p>
										<p><span>Gender:</span> <?php echo ucwords($value['gender']); ?></p>
										<p><span>Religion:</span> <?php echo ucwords($value['religion']); ?></p>
										<p><span>Telephone:</span> <?php echo ucwords($value['telephone']); ?></p>
										<p><span>Address:</span> <?php echo ucwords($value['address_1']) .' '. $value['stateName'].' '.$value['po_box']; ?></p>		    				
			    					</div>
			    					<?php echo $value['about']; ?>
			    					<a href="javascript:void(0);" class="btn-1">Learn more</a>
			    				</div>
							</div>
							<div class="col-md-6">										    		
								<div class="reviews-progressbar">
							  		<?php
									if(!empty($reviews)) {
									?>
									<div class="reviews-progressbar">
								  		<div class="range-slider">
								  			<label>Facilities</label>
										  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['fac']; } else { echo '0'; } ?>" min="0" max="100" disabled>
										</div>
										<div class="range-slider">
								  			<label>Culture</label>
										  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['cul']; } else { echo '0'; } ?>" min="0" max="100" disabled>
										</div>
										<div class="range-slider">
								  			<label>Staff</label>
										  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['sta']; } else { echo '0'; } ?>" min="0" max="100" disabled>
										</div>
										<div class="range-slider">
								  			<label>Curriculum / STEM</label>
										  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['cur']; } else { echo '0'; } ?>" min="0" max="100" disabled>
										</div>
										<div class="range-slider">
								  			<label>Fees</label>
										  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['fee']; } else { echo '0'; } ?>" min="0" max="100" disabled>
										</div>
								  	</div>
									<?php
									}
									else {
									?>
									<p class="text-center">There are No Assessment..</p>
									<?php
									}
									?>
							  	</div>

							</div>
						</div>
					</div>
			    	<?php
			    	}
			    	?>
	    		</div>
	    	</div>
	    </div>
    <?php
    }
    ?>

	<div class="yellow-gry-se">
		<div class="cat-4-img-se">
    		<img src="<?php echo FRONTENDPATH ?>images/cat-3.png" alt="">
    	</div>
		<div class="yellow-se">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="sub-title-box">
							<h3>Sponsor a School </h3>
							<p>You can promote a school profile in our directory.</p>
							<p>Your sponsorship will help other teachers, parents and students locate your school of choice more easily.</p>
						</div>
						<div class="fom-se">
							<form method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<select name="school" class="form-control">
												<option value="">Select School</option>
												<?php
												foreach ($schools as $key => $value) {
												?>
												<option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['name']); ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group date form_date" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                    <input class="form-control" size="16" name="start_date" type="text" value="" readonly placeholder="Start Date">
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							                </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group date form_date" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							                    <input class="form-control" size="16" name="end_date" type="text" value="" readonly placeholder="End Date">
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							                </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="amount" class="form-control" placeholder="Total">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<button name="paymentBtn" class="btn-1">Submit</button>
											<!-- <a href="javascript:void(0);" class="btn-1">Submit</a> -->
										</div>
									</div>
								</div>
							</form>
							<p><small>*All payments are processed through PayPal. </small></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="gry-se">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="sub-title-box">
							<h3>Not the right profile? </h3>
							<p>Can’t find a school?  Want to update a current listing?  </p>
						</div>
						<div class="fom-se">
							<form>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" name="school_name" class="form-control" placeholder="School Name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" name="email" class="form-control" placeholder="Your email address">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="3" name="message" class="form-control" placeholder="Message "></textarea>
										</div>
									</div>
									<div class="col-md-6">										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<button name="findSchoolBtn" class="btn-1">Submit</button>
											<!-- <a href="javascript:void(0);" class="btn-1">Submit</a> -->
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
</div>

<div class="sign-in-se">
	<div class="container">
    	<div class="plan-box-se">
    		<div class="col-md-6"></div>
    		<div class="col-md-6">
    			<h3>Looking for more information?</h3>
    		</div>
    	</div>
    </div>
	<div class="news-letter-se">
		<div class="cat-2-img-se">
    		<img src="<?php echo FRONTENDPATH ?>images/cat-2.png" alt="123">
    	</div>
		<div class="container">
    		<div class="col-md-9">
				<a href="javascript:void(0);" class="btn-1">Sign up to our newsletter</a>    			
    		</div>
			<div class="col-md-3">
				<a href="javascript:void(0);" class="btn-1">Submit</a>    			
    		</div>
    	</div>
	</div>
</div>

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