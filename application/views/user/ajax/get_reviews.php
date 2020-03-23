<div class="row">
	<div class="col-md-6 appendDiv">
		<div class="school-detail-se">
			<h2><i class="fa fa-pencil"></i> <?php echo count($ratings); ?> Written Reviews</h2>
		</div>
		<?php
		foreach ($ratings as $key => $value) {
		?>
		<div class="reviews-box">
			<div class="reviews-title">
				<span><?php echo ucwords($value['fname'].' '.$value['lname']).'<br>'; ?> <?php echo ucwords($value['profession']); ?></span>
				<ul class="star-se">
					<?php
					for ($i=1; $i <= 5; $i++) {
						$checked = ($i <= $value['rating']) ? 'checked' : '';
					?>
					<span class="fa fa-star <?php echo $checked; ?>"></span>
					<?php
					}
					?>
				</ul>
			</div>
			<p><?php echo ($value['review'] != '') ? $value['review'] : '-'; ?></p>
		</div>
		<?php
		}

		/**/
		if($totalRatings > 5) {
		?>
		<div class="reviews-mor">
			<a href="javascript:void(0);" id="viewMoreRating" data-id="<?php if(isset($school)) { echo $school; } if(isset($teacher)) { echo $teacher; } ?>">
				<i class="fa fa-angle-down"></i>
			</a>
		</div>
		<?php
		}
		?>
	</div>
	<?php
	if(!empty($reviews)) {
	?>
	<div class="col-md-6">
		<div class="school-detail-se">
			<h2>
				<img src="<?php echo FRONTENDPATH ?>images/ca.png"> <?php echo $reviews['total_review']; ?> Category Assessments
				<p>Average scores as voted by our users</p>
			</h2>							
		</div>
		<div class="icon-se">
		    <div class="icon-box icon-box-1"></div>
		    <div class="icon-box icon-box-2"></div>
		    <div class="icon-box icon-box-3"></div>
		    <div class="icon-box icon-box-4"></div>
		    <div class="icon-box icon-box-5"></div>
	  	</div>
	  
		<div class="reviews-progressbar">
			<?php
			if(isset($school)) {
			?>
	  		<div class="range-slider">
	  			<label>Facilities</label>
			  	<input class="range-slider__range" type="range" value="<?php echo $reviews['fac']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Culture</label>
			  	<input class="range-slider__range" type="range" value="<?php echo $reviews['cul']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Staff</label>
			  	<input class="range-slider__range" type="range" value="<?php echo $reviews['sta']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Curriculum </label>
			  	<input class="range-slider__range" type="range" value="<?php echo $reviews['cur']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Fees</label>
			  	<input class="range-slider__range" type="range" value="<?php echo $reviews['fee']; ?>" min="0" max="100" disabled>
			</div>
			<?php
			}
			else if(isset($teacher)) {
			?>
			<div class="range-slider">
	  			<label>Knowledge /Expertise</label>
			  	<input class="range-slider__range" name="knowledge_expertise" id="knowledge_expertise" type="range" value="<?php echo $reviews['knw']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Professionalism</label>
			  	<input class="range-slider__range" name="professionalism" id="professionalism" type="range" value="<?php echo $reviews['pro']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Helpfulness/ Willingness</label>
			  	<input class="range-slider__range" name="helpfulness_willingness" id="helpfulness_willingness" type="range" value="<?php echo $reviews['help']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Attitude</label>
			  	<input class="range-slider__range" name="attitude" id="attitude" type="range" value="<?php echo $reviews['att']; ?>" min="0" max="100" disabled>
			</div>
			<div class="range-slider">
	  			<label>Communication Skills</label>
			  	<input class="range-slider__range" name="communication_skills" id="communication_skills" type="range" value="<?php echo $reviews['comm']; ?>" min="0" max="100" disabled>
			</div>
			<?php
			}
			?>
	  	</div>
	</div>
	<?php
	}
	?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#viewMoreRating').on('click',function() {
		let schoolId = $(this).attr('data-id');
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('Home/fetch_rating') ?>',
			data: { schoolId: schoolId, more: true },
			success: function(response) {
				$('#reviewsdisplay').html(response);
			}
		});
	});
});
$('#tot_cat_asse').html(<?php echo (!empty($reviews)) ? $reviews['total_review'] : 0; ?>);
$('#total_writen_review').html(<?php echo count($ratings); ?>);
</script>