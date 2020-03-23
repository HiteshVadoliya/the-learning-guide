<?php $CI =& get_instance();?>
<style type="text/css">
.reviews-progressbar label span { font-size: 12px; font-weight: 500; }

@media screen and (max-width: 1600px){
	.gry-sponsor{left: -3%;}
}
@media screen and (max-width: 1400px){
	.gry-sponsor{left: -5%;}
}
@media screen and (max-width: 1200px){
	.gry-sponsor{left: -10%;}
}
@media screen and (max-width: 992px){
	.gry-sponsor {
	    position: inherit;
	    transform: inherit;
	    left: 0;
	    right: 0;
	    text-align: center;
	}
}

@import "lesshat";
.star-ratings-css {
  unicode-bidi: bidi-override;
  color: #c5c5c5;
  font-size: 25px;
  height: 25px;
  width: 100px;
  margin: 0 auto;
  position: relative;
  padding: 0;
  text-shadow: 0px 1px 0 #a2a2a2;
  
  &-top {
    color: #e7711b;
    padding: 0;
    position: absolute;
    z-index: 1;
    display: block;
    top: 0;
    left: 0;
    overflow: hidden;
  }
  &-bottom {
    padding: 0;
    display: block;
    z-index: 0;
  }
}

// Method 2) Using a Sprite
.star-ratings-sprite {
  background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
  font-size: 0;
  height: 21px;
  line-height: 0;
  overflow: hidden;
  text-indent: -999em;
  width: 110px;
  margin: 0 auto;
  
  &-rating {
    background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
    background-position: 0 100%;
    float: left;
    height: 21px;
    display:block;
  }
  
}

// Stuff for Pen styling
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600,700);
body { margin: 50px; text-align: center; font-family: 'Open Sans', sans-serif; background: #f2fbff; }
em { font-style: italic; }
h1 { font-size: 24px; margin-bottom: 25px; font-weight: bold; text-transform: uppercase; }
h2 { font-size: 16px; margin-bottom: 15px;}

</style>

<div class="search-box-se">
	<h3><?php echo $no_of_item ?> search results found</h3>
</div>

<!-- Start : Sponsored School  -->
<?php 
if( count($sponsored_school) > 0 && count($result) > 0){ ?>
<div class="gry-box-se">
	<div class="gry-sponsor">Sponsored Posts</div>
		<div class="container">
		<?php 
			foreach ($sponsored_school as $key => $value) {

				$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$value['id'],'isDelete'=>0),'schoolId');
				$rating = (!empty($rating)) ? $rating[0] : array();
				// $class = ($key == 0) ? 'gry-box-se' : 'category-se';
				// $class = 'category-se';
				?>
					<div class="row">
						<div class="col-md-7">
							<div class="title-part">	    					
								<div class="school-detail-se">
									<div class="main-title-bx">
										<?php if($value['school_logo'] != '' && file_exists(PhotosPath.$value['school_logo'])) { ?>
					                        <img src="<?php echo ASSETPATH.'uploads/image/school/'.$value['school_logo']; ?>" class="img img-responsive  product-logo" alt="Photos" width="150px">
					                    <?php }else{ ?>					                    	
					                    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" class="img img-responsive" alt="Photos" width="150px">
					                    <?php } ?>
					                	
										<h2 style="font-size: 20px;">
											<a href="<?php echo base_url('school/'.md5($value['id'])); ?>">
												<?php echo $value['name']; ?>
											</a>
										</h2>	
									
										<ul class="star-se">
											<?php /*
											$average_rating = '';
											$total_rating = 0;
											if(!empty($value['total_rating'])) {
												$average_rating = $value['average_rating'];
												$total_rating = $value['total_rating'];
											}
											for ($i=1; $i <= 5; $i++) {
												$checked = ($i <= $average_rating) ? 'checked' : ''; ?>
												<span class="fa fa-star <?php echo $checked; ?>"></span>
											<?php } ?>
											<li>									
												<?php echo $value["total_rating"]; ?> reviews
											</li>
											*/ ?>
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
										<!-- <h4>Sponsored post</h4> -->
									</div>
									<div class="detail-se">
			    						<p><span>Motto:</span> <?php echo $value['motto']; ?></p>
			    						<p><span>Email:</span> <?php echo $value['email']; ?></p>
			    						<?php
			    						if($value['website'] != '') {
			    						?>
			    						<p><span>Website:</span> <a class="text-black-underline" href="<?php echo $value['website']; ?>" target="_blank"><?php echo $value['website']; ?></a></p>
			    						<?php
			    						}
			    						?>
			    						<p><span>Telephone:</span> <?php echo $value['telephone']; ?></p>
			    					</div>
			    					<?php
			    					$string = $value['about'];
			    					$string = strip_tags($string);
									if (strlen($string) > 300) {
									    // truncate string
									    $stringCut = substr($string, 0, 300);
									    $endPoint = strrpos($stringCut, ' ');
									    /**/
									    $stringCut1 = substr($string, 300, strlen($string));
										/**/
									    //if the string doesn't contain any space then it will cut without word basis.
									    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
									    $string .= '... <div id="viewmore'.$value['id'].'" style="display:none;">'.$stringCut1.'</div><a href="javascript:void(0);" class="viewMoreBtn" data-id="'.$value['id'].'">Read More</a>';
									}
									echo $string;
			    					?>
								</div>
							</div>
						</div>    		
						<div class="col-md-5">
							<div class="left-se">
								<?php 
								if($value['photos'] != '') {
									$photos = $value['photos'];
									$photos = json_decode($photos, true);
									$slider_image = $photos[0]; ?>
							            <img src="<?php echo base_url().PhotosPath.$slider_image ?>" />
							    <?php }else{ ?>
									<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" style="width: 37%;" class="img img-responsive" alt="Photos" >
								<?php } ?>
			                    			                    
							
								<!-- <a href="<?php echo base_url('school/'.md5($value['id'])); ?>" class="btn-1">Learn more</a> -->
								<!-- <a href="<?php echo $value['website']; ?>" class="btn-1" target="_blank" id="schoolWebsite" data-id="<?php echo $value['id']; ?>"  target="_blank">visit website</a> -->

								<?php
								/*$tot_like = $this->db->select('id')->where('school_id',$value['id'])->get('like')->num_rows();
				      			if(isset($this->session->USER['UId'])) {
				      				$user = $this->common->get_one_row('tbluser',array('id'=>$this->session->USER['UId']));
				      				
				      			?>
									<a href="javascript:void(0);" data-id="<?php echo $value['id'] ?>" class="heart-btn likebtn">
										<i class="fa fa-heart"></i><span class="likecount"><?php echo $tot_like; ?></span></a>
								<?php }else{ ?>
									<?php
			        				$url = base_url().'Home/set_like/'.$value['id'];
			        				$this->session->set_userdata("user_last_page",$url);
			        				?>
									<a href="<?php echo base_url('login'); ?>" class="heart-btn"><i class="fa fa-heart"></i><span class="likecount"><?php echo $tot_like; ?></span></a>
								<?php }*/ ?>

								<!-- <a href="#" class="custom-share-btn">									
									<span class="custom-button"><i class="fa fa-share"></i></span>
								</a> -->

							</div>
						</div>
					</div> 
					<?php if($key == 0){ ?>
						<hr>
					<?php } ?>
			<?php }
		?>
	</div>
</div>
<?php } ?>
<!-- End : Sponsored School  -->

<?php
foreach ($result as $key => $value) {
	$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$value['id'],'isDelete'=>0),'schoolId');
	$rating = (!empty($rating)) ? $rating[0] : array();
	// $class = ($key == 0) ? 'gry-box-se' : 'category-se';
	$class = 'category-se';
	?>
    <div class="<?php echo $class; ?>">
    	<div class="container">
    		<div class="row">
			    <?php
		    	/*if($key == 0) {
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
	    				<div class="main-title-bx">
	    					<?php if($value['school_logo'] != '' && file_exists(PhotosPath.$value['school_logo'])) { ?>
		                        <img src="<?php echo ASSETPATH.'uploads/image/school/'.$value['school_logo']; ?>" class="img img-responsive product-logo profile_img" alt="Photos" width="150px">
		                    <?php }else{ ?>
		                    	
		                    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" class="img img-responsive profile_img" alt="Photos" width="150px">
		                    <?php } ?>
			    			<h2>
			    				<a href="<?php echo base_url('school/'.md5($value['id'])); ?>"><?php echo ucwords($value['name']); ?></a>
				    			<?php
								$close = '';
								if($this->session->userdata('compareSchool')) {
									$compareArr = $this->session->userdata('compareSchool');
									$close = (in_array($value['id'], $compareArr)) ? 'close' : '';
								}
								?>
								
								<!-- <div class="clearfix"></div> -->
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
								<a class="btn-2 btn-right compareSchoolBtn <?php echo $close; ?>" data-id="<?php echo $value['id']; ?>"><i class="fa fa-plus"></i>&nbsp;Compare</a>			
			    			</h2>

							<div class="right-side-tit">
								<h3><?php 
									if(!empty($reviews)) 
									{ 
										$c_word = $reviews['total_review'] == 1 ? ' Category Assessment' : ' Category Assessments';
										echo $reviews['total_review'].$c_word; 

									}else{ 

										echo 'There are no assessments'; 
									} 
									?>
								</h3>
								<?php if(!empty($reviews)) {
								?><p>(Average Score)</p><?php
								} ?>
							</div>

						</div>
						<!-- <p><?php if(!empty($reviews)) { echo $reviews['total_review']; } ?>&nbsp;Category Assessment<br><span style="font-size: 15px;float: right;">Average Score</span></p> -->		

						

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
		    					<?php
		    					$string = $value['about'];
		    					$string = strip_tags($string);
								if (strlen($string) > 300) {
								    // truncate string
								    $stringCut = substr($string, 0, 300);
								    $endPoint = strrpos($stringCut, ' ');
								    /**/
								    $stringCut1 = substr($string, 300, strlen($string));
									/**/
								    //if the string doesn't contain any space then it will cut without word basis.
								    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
								    $string .= '... <div id="viewmore'.$value['id'].'" style="display:none;">'.$stringCut1.'</div><a href="javascript:void(0);" class="viewMoreBtn" data-id="'.$value['id'].'">Read More</a>';
								}
								echo $string;
		    					?>
		    					<!-- <div class="row">
		    						<div class="col-md-6">
		    							<a href="javascript:void(0);" class="btn-1">Learn more</a>
		    						</div>
		    						<div class="col-md-6">
		    							
		    						</div>
		    					</div> -->
		    				</div>
						</div>
						<div class="col-md-6">
							<?php
							if(!empty($reviews)) {
							?>
							<div class="icon-se">
							    <div class="icon-box icon-box-1"></div>
							    <div class="icon-box icon-box-2"></div>
							    <div class="icon-box icon-box-3"></div>
							    <div class="icon-box icon-box-4"></div>
							    <div class="icon-box icon-box-5"></div>
						  	</div>
							<div class="reviews-progressbar">
						  		<div class="range-slider">
						  			<label>Facilities&nbsp;<span>(<?php echo round($reviews['fac']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['fac']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Culture&nbsp;<span>(<?php echo round($reviews['cul']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['cul']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Staff&nbsp;<span>(<?php echo round($reviews['sta']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['sta']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Curriculum &nbsp;<span>(<?php echo round($reviews['cur']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['cur']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Fees&nbsp;<span>(<?php echo round($reviews['fee']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" type="range" value="<?php if(!empty($reviews)) { echo $reviews['fee']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
						  	</div>
							<?php
							}
							else {
							?>
							<!-- <p class="text-center">There are No Assessment..</p> -->
							<?php
							}
							?>


						</div>
					</div>
				</div>
		    	<?php
		    	// }
		    	?>
    		</div>
    	</div>
    </div>
<?php

}
?>
<div class="container">
<div class="pull-right" id='pagination'><?php echo $page_link ?></div>
</div>
<script type="text/javascript">

$('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    filterProcess(pageno);
    // loadPagination(pageno);

});

/*function loadPagination(pagno){
	$(".loadermain").fadeIn();
    $.ajax({
        url: '<?=base_url()?>find-school-page/'+pagno,
        type: 'POST',
        dataType: 'json',
        method:'post',
        data : {},
        success: function(response){
        	console.log(response);
            $('#pagination').html(response.pagination);
        // createList(response.result,response.row,response.redirect);
        },
        complete: function() {
            $(".loadermain").fadeOut();
        },
    });
}*/

$(document).ready(function() {
	$('.compareSchoolBtn').on('click', function() {
		let classCheck = $(this).hasClass('close');
		if(!classCheck) {
			let element = $(this);
			let value = $(this).attr('data-id');
			/**/
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url('Home/add_compare_school') ?>',
				data: { schoolId: value },
				success: function(data) {
					data = jQuery.parseJSON(data);
					if(data.success) {

						element.addClass('close');
						let check1 = $('#popoverWrapper').hasClass('hide');
						if(check1) {
							$('#popoverWrapper').removeClass('hide');
						}
						$('#popoverOpener').find('span').html(data.count);
						$('.popover-title').find('span.count').html(data.count);
						let html = data.html;
						$('.popover-content').find('ul').append(html);
						let check = $('#compareBtn').hasClass('hide');
						if(check) {
							$('#compareBtn').removeClass('hide');
						}
						if(data.count <= 1) {
							$('#compareBtn').attr('href','javascript:void(0);');
						}
						else {
							$('#compareBtn').attr('href','<?php echo base_url('compare-school'); ?>');
							/*if(data.count > 4) {
							}*/
						}
					}
					else {
						element.removeClass('close');
						if(data.prompt != undefined) {
							swal({
				               	// title: "Are you sure?",
				               	title: '',
				               	text: data.message,
				               	type: "warning",
				               	showCancelButton: true,
				               	confirmButtonColor: "#DD6B55",
				               	confirmButtonText: "Yes!",
				               	cancelButtonText: "No",
				               	closeOnConfirm: true,
				               	closeOnCancel: true
			               	}, function (isConfirm) {    
			                  	if (isConfirm) {
			                  		let compareId = data.compareId;
			                  		$.ajax({
										type: 'POST',
										url: '<?php echo base_url('Home/add_compare_school') ?>',
										data: { schoolId: compareId, typeForce: true },
										success: function(data1) {
											data1 = jQuery.parseJSON(data1);
											if(data1.success) {
												element.addClass('close');
												let check1 = $('#popoverWrapper').hasClass('hide');
												if(check1) {
													$('#popoverWrapper').removeClass('hide');
												}
												$('#popoverOpener').find('span').html(data1.count);
												$('.popover-title').find('span.count').html(data1.count);
												let html = data1.html;
												$('.popover-content').find('ul').append(html);
												let check = $('#compareBtn').hasClass('hide');
												if(check) {
													$('#compareBtn').removeClass('hide');
												}
												if(data1.count <= 1) {
													$('#compareBtn').attr('href','javascript:void(0);');
												}
												else {
													$('#compareBtn').attr('href','<?php echo base_url('compare-school'); ?>');
													/*if(data.count > 4) {
													}*/
												}
												// swal('Success!', data1.message, 'success');
											}
											else {
												swal('Warning', data1.message, 'warning');
											}
										}
									});
			               		}
			            	});
						}
						else {
							swal('Warning', data.message, 'warning');
						}
					}
				}
			});
			/**/
		}

	});

	$('.likebtn').on('click', function() {
		
		var id = $(this).attr('data-id');
		var thisclass = $(this);
		if(id.length != 0) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url('Home/set_like') ?>',
				data: { id: id },
				success: function(data) {
					data = jQuery.parseJSON(data);
					if(data.success) {

						swal('Success!', data.message, 'success');
						thisclass.find('.likecount').html(data.count);
					}
					else {

						swal('Warning', data.message, 'warning');
					}
				}
			});
			/**/
		}

	});

	

	$(".viewMoreBtn").on("click", function () {
		let id = $(this).attr('data-id');
		$('#viewmore'+id).slideToggle(0);
        var txt = $("#viewmore"+id).is(':visible') ? 'Read Less' : 'Read More';
        $(".viewMoreBtn").text(txt);
    });


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
</script>