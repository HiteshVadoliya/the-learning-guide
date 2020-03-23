<style type="text/css">
.reviews-progressbar label span { font-size: 12px; font-weight: 500; }
</style>
<div class="search-box-se">
	<h3><?php echo $no_of_item ?> search results found</h3>
</div>

<?php /*<div class="category-se">	    	
	<div class="container">
		<div class="row">
    		<div class="col-md-10 col-md-offset-1">		    			
				<div class="row">
					<?php
					foreach ($result as $key => $value) {
						$type = str_replace(',', ', ', $value['type']);
					?>
					<div class="col-md-6">
						<div class="teachers-box">
							<div class="title-se-box">
								<?php
								$total_review = 0;
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
				    			<h2><a href="<?php echo base_url('teacher/'.md5($value['id'])); ?>"><?php echo ucwords($value['fname'].' '.$value['lname']); ?></a></h2>	    						
								<ul class="star-se">
									<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
	    							<li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
									<li><?php echo $total_review; ?> reviews </li>
								</ul>											
							</div>
							<div class="description-se">
								<div class="detail-se">
									<p><span>Email:</span> <?php echo $value['email']; ?></p>
									<p><span>Qualifications:</span> <?php echo $value['qualifications']; ?></p>
									<p><span>Current School:</span> <?php echo $value['current_school']; ?></p>
									<p><span>Previous School:</span> <?php echo $value['previous_school']; ?></p>
									<p><span>Units Teach:</span> <?php echo ucwords($value['units_teach']); ?></p>
									<p><span>Teaches In:</span> <?php echo ucwords($type); ?></p>
		    						<a href="javascript:void(0);" class="btn-1">Learn more</a>
		    					</div>
		    					<!-- <p>“ronbark Ridge Public School is a coeducational primary school,serving years K-SW, Sydney Western Suburbs region. Ironbark Ridge Public School is one of two gover area. wheiefnf enfefnenfioenofienfoienfoienf efneojkn fejfneijfn”</p> -->
		    				</div>
		    			</div>
					</div>
					<?php
					}
					?>
				</div>						
			</div>					
		</div>	    		
	</div>
</div> */ ?>

<?php
foreach ($result as $key => $value) {
	$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$value['id'],'isDelete'=>0),'teacherId');
	$rating = (!empty($rating)) ? $rating[0] : array();
	$current_school_det = $this->common->get_one_row('tbl_school',array('id'=>$value['teach_school']));
	$current_school = ucwords($current_school_det['name']);
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
    						<h2><a href="<?php echo base_url('teacher/'.md5($value['id'])); ?>"><?php echo ucwords($value['fname'].' '.$value['lname']); ?></a></h2>
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
	    						<p><span>School:</span> <?php echo $current_school; ?></p>
	    						<p><span>Email:</span> <a href="mailto:<?php echo $value['email']; ?>"><?php echo $value['email']; ?></a></p>
	    						<p><span>Motto:</span> <?php echo $value['motto']; ?></p>
	    					</div>
	    					<?php echo $value['about']; ?>
    					</div>
    				</div>
    			</div>    		
    			<div class="col-md-6">
    				<div class="left-se">
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
						<a href="javascript:void(0);" class="btn-1">Learn more</a>
						<a href="" target="_blank" class="btn-1">Download CV</a>
						<a href="javascript:void(0);" class="heart-btn"><i class="fa fa-heart"></i><span>10</span></a>
					</div>
    			</div>
		    	<?php
		    	}
		    	else {
		    		/**/
			    	$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(knowledge_expertise) as knw, AVG(professionalism) as pro, AVG(helpfulness_willingness) as help, AVG(attitude) as att, AVG(communication_skills) as comm FROM `tbl_rating` WHERE `teacherId` = '".$value['id']."' AND `isDelete` = 0 AND (`knowledge_expertise` != 0 OR `professionalism` != 0 OR `helpfulness_willingness` != 0 OR `attitude` !=0 OR `communication_skills` != 0) GROUP BY teacherId";
					$reviews = $this->common->cust_query($reviewsQuery);
					$reviews = (!empty($reviews)) ? $reviews[0] : array();
			    	/**/
		    		$type = str_replace(',', ', ', $value['type']);
		    	?>
		    	<div class="col-md-10 col-md-offset-1">
	    			<div class="title-se-box">
	    				<div class="main-title-bx">
	    					<?php
					    	$profilePic = $value['profile_img'];
					    	if(isset($profilePic) && $profilePic != '') {
							?>
					    	<img src="<?php echo base_url().ProfilePath.$profilePic; ?>" class="profile_img" alt="">
					        <?php
							}
							else {
							?>
					    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" class="profile_img" alt="">
					        <?php
							}
							?>
			    			<h2>
			    				<a href="<?php echo base_url('teacher/'.md5($value['id'])); ?>">
			    					<?php echo ucwords($value['fname'].' '.$value['lname']); ?> 
			    					<?php
			    					/*$flag = false;
			    					if($value['teach_school'] != '') {
			    						$flag = true;
			    					?>
			    					<span class="badge badge-success">Teaching</span>
			    					<?php
			    					}
			    					if(!$flag) {
				    					if($value['previous_school'] != '') {
				    					?>
				    					<span class="badge badge-danger">Retired</span>
				    					<?php
				    					}
			    					}*/
			    					?>
			    					<?php
			    					if($value["teacher_status"]=="0") {
			    						?>
			    						<span class="badge badge-success">Teaching</span>
			    						<?php
			    					} else if($value["teacher_status"]=="1") {
			    						?>
			    						<span class="badge badge-danger">Retired</span>
			    						<?php
			    					}
			    					if ($value['tutoring_services']) {
			    					?>
			    					<img src="<?php echo F_IMGPATH.'tutor.png'; ?>" class="tutor_img" alt="Tutor Image" height="25px">
			    					<?php
			    					}
			    					?>
			    				</a>
			    				<?php
								$close = '';
								if($this->session->userdata('compareTeacher')) {
									$compareArr = $this->session->userdata('compareTeacher');
									$close = (in_array($value['id'], $compareArr)) ? 'close' : '';
								}
								?>
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
									<!-- <li><?php echo $total_rating; ?> reviews</li> -->
									
									<li>
										<?php echo $total_rating; ?> reviews
									</li>
								</ul>
								<a class="btn-2 btn-right compareTeacherBtn <?php echo $close; ?>" data-id="<?php echo $value['id']; ?>"><i class="fa fa-plus"></i>&nbsp; Compare</a>
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

					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="description-se">
								<div class="detail-se">
									<?php
									$state = $this->common->get_one_row('tbl_state',array('id'=>$current_school_det['state']));
									$head_office = ucwords($current_school_det['address_1']).', '.ucwords($current_school_det['city']).', '.ucwords($state['name']).' '.$current_school_det['po_box'];
									$motto = ($value['motto'] != '') ? $value['motto'] : '-';
									?>
									<p><span>Motto:</span> <?php echo $motto; ?></p>
									<p><span>Type:</span> <?php echo ucwords($type); ?></p>
									<p><span>School:</span> <?php echo $current_school; ?></p>
		    						<p><span>Email:</span> <a href="mailto:<?php echo $value['email']; ?>"><?php echo $value['email']; ?></a></p>
		    						<p><span>Qualifications:</span> <?php echo $value['qualifications'] ?></p>
		    						<p><span>Work Status:</span> <?php echo $value["teach_school"] == 1 ? 'Retired' : 'Teaching'; ?></p>
		    						<p><span>Address:</span> <?php echo $head_office; ?></p>

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
		    					<?php //echo $value['about']; ?>
		    					<!-- <div class="row">
		    						<div class="col-md-6">
		    							<a href="javascript:void(0);" class="btn-1">Learn more</a>
		    						</div>
		    						<div class="col-md-6"></div>
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
						  			<label>Knowledge /Expertise&nbsp;<span>(<?php echo round($reviews['knw']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" name="knowledge_expertise" id="knowledge_expertise" type="range" value="<?php if(!empty($reviews)) { echo $reviews['knw']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Professionalism&nbsp;<span>(<?php echo round($reviews['pro']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" name="professionalism" id="professionalism" type="range" value="<?php if(!empty($reviews)) { echo $reviews['pro']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Helpfulness/ Willingness&nbsp;<span>(<?php echo round($reviews['help']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" name="helpfulness_willingness" id="helpfulness_willingness" type="range" value="<?php if(!empty($reviews)) { echo $reviews['help']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Attitude&nbsp;<span>(<?php echo round($reviews['att']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" name="attitude" id="attitude" type="range" value="<?php if(!empty($reviews)) { echo $reviews['att']; } else { echo '0'; } ?>" min="0" max="100" disabled>
								</div>
								<div class="range-slider">
						  			<label>Communication Skills&nbsp;<span>(<?php echo round($reviews['comm']).'%'; ?>)</span></label>
								  	<input class="range-slider__range" name="communication_skills" id="communication_skills" type="range" value="<?php if(!empty($reviews)) { echo $reviews['comm']; } else { echo '0'; } ?>" min="0" max="100" disabled>
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
		$(".viewMoreBtn").on("click", function () {
			let id = $(this).attr('data-id');
			$('#viewmore'+id).slideToggle(0);
	        var txt = $("#viewmore"+id).is(':visible') ? 'Read Less' : 'Read More';
	        $(".viewMoreBtn").text(txt);
	    });
$('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    filterProcess(pageno);
    // loadPagination(pageno);

});
$(document).ready(function() {
	$('.compareTeacherBtn').on('click', function() {
		let classCheck = $(this).hasClass('close');
		if(!classCheck) {
			let element = $(this);
			let value = $(this).attr('data-id');
			/**/
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url('Home/add_compare_teacher') ?>',
				data: { teacherId: value },
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
							$('#compareTeacherBtn').removeClass('hide');
						}
						if(data.count <= 1) {
							$('#compareTeacherBtn').attr('href','javascript:void(0);');
						}
						else {
							$('#compareTeacherBtn').attr('href','<?php echo base_url('compare-teacher'); ?>');
							/*if(data.count > 4) {
								swal('Warning', data.message, 'warning');
							}*/
						}
					}
					else {
						
						element.removeClass('close');
						swal('Warning', data.message, 'warning');
					}
				}
			});
			/**/
		}

	});

});
</script>