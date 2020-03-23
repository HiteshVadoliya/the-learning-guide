<?php
$CI =& get_instance();
?>
<style type="text/css">
	.hr_strong {
		height:1px; border:none; color:#000; background-color:#000;
	}
</style>

<div class="search-add-page-se">
    <div class="slider-se">
    	<div class="full-search-banner-img-se">
    		<div class="container">    		
    			<div class="upper-text-se"></div>
	    	</div>
    	</div>
		<div class="bottom-text">
			<h3>“Imagination is the highest form of research.” Albert Einstien</h3>
		</div>
    </div>

	<div id="search-results">
		<div class="search-box-se">
			<h3><?php echo $totalRecords; ?> search results found</h3>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="results full_search_li">
						<?php /* ?><ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#schools">Schools</a></li>
							<li><a data-toggle="tab" href="#teachers">Teachers</a></li>
							<li><a data-toggle="tab" href="#bulletins">Bulletin</a></li>
							<li><a data-toggle="tab" href="#events">Calendar</a></li>
						</ul><?php */ ?>
						<div class="page-tab-se">
							<ul>
								<li class="active_tab back-color-1" data-class="schools" ><a data-toggle="tab" href="#schools"> Schools ( <?php echo count($schools); ?> )</a></li>
								<li class="active_tab back-color-2" data-class="teachers" ><a data-toggle="tab" href="#teachers">Teachers ( <?php echo count($teachers); ?> )</a></li>
								<li class="active_tab back-color-3" data-class="bulletins" ><a data-toggle="tab" href="#bulletins">Bulletin ( <?php echo count($bulletins); ?> )</a></li>
								<li class="active_tab back-color-4" data-class="events" ><a data-toggle="tab" href="#events">Calendar ( <?php echo count($events); ?> )</a></li>
						  	</ul>
						</div>

						<div class="tab-content">
							<div id="schools" class="tab-pane category-se fade in active">
								<?php
								if(!empty($schools)) {
									foreach ($schools as $school_key => $school) {
										$id = $school['id'];
										$school = $CI->common->get_one_row('tbl_school',array('id'=>$id));
										$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(facilities) AS fac, AVG(culture) AS cul, AVG(staff) AS sta, AVG(curricullum) AS cur, AVG(fees) AS fee FROM `tbl_rating` WHERE `schoolId` = '".$school['id']."' AND `isDelete` =0 AND (`facilities` != 0 OR `culture` != 0 OR `staff` != 0 OR `curricullum` !=0 OR `fees` != 0) GROUP BY schoolId";
										$reviews = $this->common->cust_query($reviewsQuery);
										$reviews = (!empty($reviews)) ? $reviews[0] : array();
										$type = str_replace(',', ', ', $school['type']);
										$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$school['id'],'isDelete'=>0),'schoolId');
										$rating = (!empty($rating)) ? $rating[0] : array();
									?>
									<div class="title-se-box">
										<div class="main-title-bx">
											<?php if($school['school_logo'] != '' && file_exists(PhotosPath.$school['school_logo'])) { ?>
						                        <img src="<?php echo ASSETPATH.'uploads/image/school/'.$school['school_logo']; ?>" class="img img-responsive product-logo" alt="Photos" width="150px">
						                    <?php }else{ ?>
						                    	
						                    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" class="img img-responsive" alt="Photos" width="150px">
						                    <?php } ?>
											<h4>
												<a href="<?php echo base_url().'school/'.md5($school['id']); ?>"><?php echo $school['name']; ?></a>
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
											</h4>
											<p><?php echo $school['about']; ?></p>
										</div>
									</div>
									<hr class="hr_strong">
									<?php
									}
								}
								else {
									echo 'There are No schools.';
								}
								?>
							</div>
							<div id="teachers" class="tab-pane category-se fade">
								<?php
								if(!empty($teachers)) {
									foreach ($teachers as $teacher_key => $teacher) {
										$id = $teacher['id'];
										$teacher = $CI->common->get_one_row('tbl_teacher',array('id'=>$id));
										$rating = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$teacher['id'],'isDelete'=>0),'teacherId');
										$rating = (!empty($rating)) ? $rating[0] : array();
										$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(knowledge_expertise) as knw, AVG(professionalism) as pro, AVG(helpfulness_willingness) as help, AVG(attitude) as att, AVG(communication_skills) as comm FROM `tbl_rating` WHERE `teacherId` = '".$teacher['id']."' AND `isDelete` = 0 AND (`knowledge_expertise` != 0 OR `professionalism` != 0 OR `helpfulness_willingness` != 0 OR `attitude` !=0 OR `communication_skills` != 0) GROUP BY teacherId";
										$reviews = $this->common->cust_query($reviewsQuery);
										$reviews = (!empty($reviews)) ? $reviews[0] : array();
								    	/**/
							    		$type = str_replace(',', ', ', $teacher['type']);
									?>
									<div class="title-se-box">
										<div class="main-title-bx">
											<?php
									    	$profilePic = $teacher['profile_img'];
									    	if(isset($profilePic) && $profilePic != '') {
											?>
									    	<img src="<?php echo base_url().ProfilePath.$profilePic; ?>" alt="">
									        <?php
											}
											else {
											?>
									    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
									        <?php
											}
											?>
											<h4>
												<a href="<?php echo base_url().'teacher/'.md5($teacher['id']); ?>"><?php echo ucwords($teacher['fname'].' '.$teacher['lname']); ?></a>
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
											</h4>
											<p><?php echo $teacher['about']; ?></p>
										</div>
									</div>
									<hr class="hr_strong">
									<?php
									}
								}
								else {
									echo 'There are No teachers.';
								}
								?>
							</div>
							<div id="bulletins" class="tab-pane fade">
								<?php
								if(!empty($bulletins)) {
									foreach ($bulletins as $bulletin_key => $bulletin) {
										$id = $bulletin['id'];
										$bulletin = $CI->common->get_one_row('tbl_bulletin',array('id'=>$id));
									?>
									<div class="title-se-box">
										<div class="main-title-bx">
											<?php
									    	$profilePic = $bulletin['image'];
									    	if(isset($profilePic) && $profilePic != '') {
											?>
									    	<img src="<?php echo base_url().BlogPath.$profilePic; ?>" alt="">
									        <?php
											}
											else {
											?>
									    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
									        <?php
											}
											?>
											<h4>
												<a href="<?php echo base_url().'bulletin/'.md5($bulletin['id']); ?>"><?php echo ucwords($bulletin['title']); ?></a>
											</h4>
											<p><?php echo $bulletin['description']; ?></p>
										</div>
									</div>
									<hr class="hr_strong">
									<?php
									}
								}
								else {
									echo 'There are No bulletins.';
								}
								?>
							</div>
							<div id="events" class="tab-pane fade">
								<?php
								if(!empty($events)) {
									foreach ($events as $event_key => $event) {
										$id = $event['id'];
										$calendar = $CI->common->get_one_row('tbl_calendar',array('id'=>$id));
									?>
									<div class="title-se-box">
										<div class="main-title-bx">
											<?php
									    	/*$profilePic = $bulletin['image'];
									    	if(isset($profilePic) && $profilePic != '') {
											?>
									    	<img src="<?php echo base_url().BlogPath.$profilePic; ?>" alt="">
									        <?php
											}
											else {
											?>
									    	<img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
									        <?php
											}*/
											?>
											<h4>
												<a href="<?php echo base_url().'calendar/view/'.$calendar['id']; ?>"><?php echo ucwords($calendar['task_name']); ?></a>
											</h4>
											<p><?php echo $calendar['task_description']; ?></p>
										</div>
									</div>
									<hr class="hr_strong">
									<?php
									}
								}
								else {
									echo 'There are No events.';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script type="text/javascript">
$(document).ready(function() {
	$(".active_tab").on("click",function(){
		b = $(this).attr('data-class');
		var bgcolor = '#fae60a5c';
		if(b=='schools') {
			var bgcolor = '#fae60a5c';
		} else if(b=='teachers') {
			var bgcolor = '#fa750a52';
		} else if(b=='bulletins') {
			var bgcolor = '#6dade340';			
		} else if(b=='events') {
			var bgcolor = '#58e5622b';						
		}
		var a = $(".tab-content").css({"background-color": bgcolor});;
	});
});
</script>