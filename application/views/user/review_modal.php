<style type="text/css">
.range-slider { margin-top: 10px; }
</style>
<!-- Modal -->
<?php
$CI =& get_instance();
$user = $this->common->get_one_row('tbluser',array('id'=>$review['userId']));

if(isset($school)) {
	$school_det = $this->common->get_one_row('tbl_school',array('id'=>$review['schoolId']));
?>
<div id="schoolModal" class="modal fade" role="dialog">
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
		      			<div class="col-md-12">

		        			<input type="hidden" name="ratingId" class="form-control" value="<?php echo $review['id']; ?>">
		        			<input type="hidden" name="userId" class="form-control" value="<?php echo $user['id']; ?>">
		        			<input type="hidden" name="schoolId" id="schoolId" class="form-control" value="<?php echo $school_det['id']; ?>">
		        			<input type="hidden" name="userName" id="userName" class="form-control" value="<?php echo ucwords($user['fname'].' '.$user['lname']); ?>">

		      				<div class="form-group">
		      					<!-- <label>How you would rate <?php echo ucwords($school_det['name']); ?>? Leave a star rating. <span class="star-mend">*</span></label> 
		      					-->
		      					<label>How you would rate <?php echo ucwords($school_det['name']); ?>? This rating will remain anonymous. <span class="star-mend">*</span></label>
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
									<input type="hidden" name="rating" class="rating-tooltip" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" value="<?php echo $review['rating']; ?>">
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
			        					<input type="text" name="review" class="form-control" value="<?php echo $review['review']; ?>">
			        				</div>
			        			</div>
			        		</div>
		      				<div class="form-group">
		      					<!-- <label>Help us rank this school/teacher in each category by moving the black pin.<span class="star-mend">*</span></label> -->
		      					<label>Help us rank this profile based on your experience in each of the below categories by sliding the pin across the line. This rating will remain anonymous.<span class="star-mend">*</span></label>
		      					<div class="icon-se">
								    <div class="icon-box icon-box-1"></div>
								    <div class="icon-box icon-box-2"></div>
								    <div class="icon-box icon-box-3"></div>
								    <div class="icon-box icon-box-4"></div>
								    <div class="icon-box icon-box-5"></div>
							  	</div>
		      					<div class="range-slider">
					  				<label>Facilities</label>
						  			<input class="range-slider__range" name="facilities" id="facilities" type="range" value="<?php echo $review['facilities'] ?>" min="0" max="100">
						  			<?php /* ?><div class="row">
						  				<div class="col-md-11">
						  					<label>Facilities</label>
								  			<input class="range-slider__range" name="facilities" id="facilities" type="range" value="<?php echo $review['facilities'] ?>" min="0" max="100">
						  				</div>
						  				<div class="col-md-1">
						  					<?php
						  					$fac_emoji = $CI->display_emoji($review['facilities']);
						  					?>
						  					<img src="<?php echo ASSETPATH.'images/'.$fac_emoji.'.png'; ?>" alt="angry">
						  				</div>
						  			</div><?php */ ?>
								</div>
								<div class="range-slider">
									<label>Culture</label>
						  			<input class="range-slider__range" name="culture" id="culture" type="range" value="<?php echo $review['culture'] ?>" min="0" max="100">
								  	<?php /* ?><div class="row">
						  				<div class="col-md-11">
						  					<label>Culture</label>
								  			<input class="range-slider__range" name="culture" id="culture" type="range" value="<?php echo $review['culture'] ?>" min="0" max="100">
						  				</div>
						  				<div class="col-md-1">
						  					<?php
						  					$cul_emoji = $CI->display_emoji($review['culture']);
						  					?>
						  					<img src="<?php echo ASSETPATH.'images/'.$cul_emoji.'.png'; ?>" alt="angry">
						  				</div>
						  			</div><?php */ ?>
								</div>
								<div class="range-slider">
									<label>Staff</label>
						  			<input class="range-slider__range" name="staff" id="staff" type="range" value="<?php echo $review['staff'] ?>" min="0" max="100">
									<?php /* ?><div class="row">
						  				<div class="col-md-11">
						  					<label>Staff</label>
								  			<input class="range-slider__range" name="staff" id="staff" type="range" value="<?php echo $review['staff'] ?>" min="0" max="100">
						  				</div>
						  				<div class="col-md-1">
						  					<?php
						  					$staff_emoji = $CI->display_emoji($review['staff']);
						  					?>
						  					<img src="<?php echo ASSETPATH.'images/'.$staff_emoji.'.png'; ?>" alt="angry">
						  				</div>
						  			</div><?php */ ?>
								</div>
								<div class="range-slider">
									<label>Curriculum </label>
								  	<input class="range-slider__range" name="curriculum" id="curriculum" type="range" value="<?php echo $review['curricullum'] ?>" min="0" max="100">
									<?php /* ?><div class="row">
						  				<div class="col-md-11">
						  					<label>Curriculum </label>
								  			<input class="range-slider__range" name="curriculum" id="curriculum" type="range" value="<?php echo $review['curricullum'] ?>" min="0" max="100">
						  				</div>
						  				<div class="col-md-1">
						  					<?php
						  					$curr_emoji = $CI->display_emoji($review['curricullum']);
						  					?>
						  					<img src="<?php echo ASSETPATH.'images/'.$curr_emoji.'.png'; ?>" alt="angry">
						  				</div>
						  			</div>?php */ ?>
								</div>
								<div class="range-slider">
									<label>Fees</label>
								  	<input class="range-slider__range" name="fees" id="fees" type="range" value="<?php echo $review['fees'] ?>" min="0" max="100">
									<?php /* ?><div class="row">
						  				<div class="col-md-11">
						  					<label>Fees</label>
								  			<input class="range-slider__range" name="fees" id="fees" type="range" value="<?php echo $review['fees'] ?>" min="0" max="100">
						  				</div>
						  				<div class="col-md-1">
						  					<?php
						  					$fee_emoji = $CI->display_emoji($review['fees']);
						  					?>
						  					<img src="<?php echo ASSETPATH.'images/'.$fee_emoji.'.png'; ?>" alt="angry">
						  				</div>
						  			</div><?php */ ?>
								</div>
		      				</div>
		      			</div>
		        		
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	      			<button type="submit" id="reviewFormBtn" class="btn-1">Submit</button>
	      			<button type="button" class="btn-2" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
    	</form>
  	</div>
</div>
<?php
}
else {
	$teacher_det = $this->common->get_one_row('tbl_teacher',array('id'=>$review['teacherId']));
?>
<!-- Modal -->
<div id="teacherModal" class="modal fade" role="dialog">
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
		      			<div class="col-md-12">
		      				<input type="hidden" name="ratingId" value="<?php echo $review['id']; ?>">
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
									<input type="hidden" name="rating" class="rating-tooltip" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" value="<?php echo $review['rating']; ?>">
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
			        					<input type="text" name="review" id="review" class="form-control" value="<?php echo $review['review']; ?>">
			        				</div>
			        			</div>
			        		</div>
		      				<div class="form-group">
		      					<!-- <label>Help us rank this school/teacher in each category by moving the black pin.<span class="star-mend">*</span></label> -->
		      					<label>Help us rank this profile based on your experience in each of the below categories by sliding the pin across the line. This rating will remain anonymous.<span class="star-mend">*</span></label>
		      					<div class="icon-se">
								    <div class="icon-box icon-box-1"></div>
								    <div class="icon-box icon-box-2"></div>
								    <div class="icon-box icon-box-3"></div>
								    <div class="icon-box icon-box-4"></div>
								    <div class="icon-box icon-box-5"></div>
							  	</div>
		      					<div class="range-slider">
						  			<label>Knowledge /Expertise</label>
								  	<input class="range-slider__range" name="knowledge_expertise" id="knowledge_expertise" type="range" value="<?php echo $review['knowledge_expertise'] ?>" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Professionalism</label>
								  	<input class="range-slider__range" name="professionalism" id="professionalism" type="range" value="<?php echo $review['professionalism'] ?>" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Helpfulness/ Willingness</label>
								  	<input class="range-slider__range" name="helpfulness_willingness" id="helpfulness_willingness" type="range" value="<?php echo $review['helpfulness_willingness'] ?>" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Attitude</label>
								  	<input class="range-slider__range" name="attitude" id="attitude" type="range" value="<?php echo $review['attitude'] ?>" min="0" max="100">
								</div>
								<div class="range-slider">
						  			<label>Communication Skills</label>
								  	<input class="range-slider__range" name="communication_skills" id="communication_skills" type="range" value="<?php echo $review['communication_skills'] ?>" min="0" max="100">
								</div>
		      				</div>
		      			</div>
		        		
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	      			<?php
	      			if(isset($this->session->USER['UId'])) {
	      			?>
	      			<button type="submit" id="reviewFormBtn" class="btn btn-primary">Submit</button>
	      			<?php
	      			}
	      			?>
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
    	</form>
  	</div>
</div>
<?php
}
?>
<script type="text/javascript">
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
$(document).ready(function() {
	setTimeout(function() {
		let ele = $('.rating-symbol')['<?php echo $review['rating']-1; ?>'];
		$(ele).click();
		overHoverStar();
	},500);

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

   	$('#reviewForm').on('submit',function(e) {
   		$('#reviewForm').valid();
		e.preventDefault();
		if($('#reviewForm').valid()) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(FRONTEND.'Login/change_review') ?>',
				data: $('#reviewForm').serialize(),
				success: function(response) {
					response = jQuery.parseJSON(response);
					$('#'+response.modal+'Modal').modal('hide');
					if(response.success) {
						swal('Success!', response.message, 'success');
					}
					else {
						if(response.profanity != undefined) {
							swal({
					            title: 'OH NO!',
					            text: response.message,
					            type: 'error'
					        }, function() {
								$('#'+response.modal+'Modal').modal();
					        });
						}
						else {
							swal('Warning!', response.message, 'warning');
						}
					}
				}
			});
		}
	});

});
</script>