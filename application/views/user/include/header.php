<header id="myHeader">
	<nav class="navbar navbar-default">
	  	<div class="container">
	    	<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		      	<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?= LOGOPATH.getSiteSetting('FrontEnd_Logo'); ?>" alt="logo"></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav">
			        <li><a href="<?php echo base_url('schools'); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Find the right school and read reviews">SCHOOLS</a></li>
		          	<li><a href="<?php echo base_url('teachers'); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Leave a review or learn more about your teacher">TEACHERS</a></li>
		          	<!-- <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" data-original-title="Download and share study resources">DOCUSTUDY</a></li> -->
		          	<li><a href="<?php echo base_url('bulletin'); ?>" data-toggle="tooltip" data-placement="bottom"  data-original-title="Read news in education">BULLETIN</a></li>
		          	<li><a href="<?php echo base_url('calendar'); ?>"  data-toggle="tooltip" data-placement="bottom"  data-original-title="Save, share and promote important events">CALENDAR</a></li>
	          	</ul>

          		<ul class="nav navbar-nav navbar-right">		      		
			  		<li class="search-se"> 
			  			<a class="" data-toggle="collapse" data-target=".search-input"> <i class="fa fa-search"></i> </a>
						<div class="collapse search-input">
					  		<form id="demo-2" method="get" action="<?php echo base_url('full_search') ?>">				  			
								<div class="input-group">					                
			                        <!-- <select class="form-control" name="filterby" id="filterby" >
			                        	<option value="school">School</option>
			                        	<option value="teacher">Teacher</option>
			                        	<option value="bulletin">Bulletin</option>
			                        	<option value="event">Event</option>
			                        </select> -->
				                    <div class="input-group-btn">
				                        <!-- <input type="text" name="search_type" id="search_type" value="school"> -->

				                        <!-- <button type="button" class="btn-1 btn-search  dropdown-toggle" data-toggle="dropdown">
				                            <span class="label-icon">Schools</span>
				                            <span class="caret"></span>
				                        </button>
				                        <ul class="dropdown-menu pull-left" role="menu" id="serach_change">
				                           <li>
				                                <a href="#">				                                    
				                                    <span class="label-icon">Schools</span>
				                                </a>
				                            </li>
				                            <li>
				                                <a href="#">				                                    
				                                    <span class="label-icon">Teachers</span>
				                                </a>
				                            </li>
				                            <li>
				                                <a href="#">				                                
				                                <span class="label-icon">Bulletin</span>
				                                </a>
				                            </li>
				                            <li>
				                                <a href="#">				                                
				                                <span class="label-icon">Event</span>
				                                </a>
				                            </li>
				                        </ul> -->
				                    </div>					        
				                    <input type="search" name="searchText" id="searchText" placeholder="Search our website using a word or phrase" autocomplete="off" class="form-control" >
				                    <div class="input-group-btn">
				                        <button type="button" class="btn-1 btn-search btn-default">GO</button>
				                    </div>
				                </div>				               
						        <script type="text/javascript">					        	 
									$(function(){								    
									    $(".input-group-btn .dropdown-menu li a").click(function(){
									        var selText = $(this).html();
									       $(this).parents('.input-group-btn').find('.btn-search').html(selText);
									   });
									});
						        </script>
					  			<!-- <input type="hidden" name="filterby" value="school">
					    		<input type="search" name="searchText" id="searchText" placeholder="Search our website using a word or phrase" autocomplete="off">
				    			<span class="input-search-icon"> <a href="javascript:void(0);"><i class="fa fa-search"></i></a></span>
				    			<button type="submit" name="schoolBtn" class="hide"></button> -->
					  		</form>
						</div>
			  		</li>
			  		<?php
			  		if(isset($this->session->USER['UId']))  {
			  		?>
			  		<li class="header-icon-li dropdown">
			      		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		                   	<div class="header-icon">
	                      		<i class="fa fa-3x fa-user"></i>
		                   	</div>
		                </a>
		                <ul class="dropdown-menu">
		                	<li><a href="javascript:void(0);">Hello, <?php echo $this->session->USER['UName']; ?></a></li>
		                	<li><a href="<?= base_url('my-profile') ?>">My Profile</a></li>
		                	<li><a href="<?= base_url('change-password') ?>">Change Password</a></li>
	               			<li><a href="<?= base_url(FRONTEND.'Login/Logout') ?>">Logout</a></li>
		                </ul>
	            	</li>
			  		<?php
			  		}
			  		else {
			  		?>
		      		<li class="signin-btn"> <a href="<?php echo base_url('login'); ?>"><i class="fa fa-user"></i> SIGN IN <span>/</span> SIGN UP</a></li>
			  		<?php
			  		}
			  		?>
		      		<li class="signin-btn">
		      			<?php /* <a href="javascript:void(0);"> Compare List (0)</a> */ ?>
		      			<?php
		      			$count = 0;
		      			$class = 'hide';
		      			$classTeacher = 'hide';
		      			$href = 'href="javascript:void(0);"';
		      			if($this->session->userdata('compareSchool')) {
		      				$compareArr = $this->session->userdata('compareSchool');
		      				$count = count($compareArr);
		      				$class = '';
		      			}
		      			else if($this->session->userdata('compareTeacher')) {
		      				$compareArr = $this->session->userdata('compareTeacher');
		      				$count = count($compareArr);
		      				$class = '';
		      				$classTeacher = '';
		      			}
		      			?>
		      			<div id="popoverOpener">
		      				<a type="button" class="">Compare List (<span><?php echo $count; ?></span>)</a>
						</div>

						<div id="popoverWrapper" class="<?php echo $class ?>">
						  	<div class="popover" role="tooltip">
						    	<div class="arrow"></div>
					    		<h3 class="popover-title">You have <span class="count"><?php echo $count; ?></span> schools in your compare List <span><a href="javascript:void(0);" id="clearAllCompare"><i class="fa fa-times"></i></a></span></h3>
					    		<div class="popover-content">
					      			<ul>
					      				<?php
					      				if($this->session->userdata('compareSchool')) {
					      					foreach ($compareArr as $key => $value) {
					      						$school = $this->common->get_one_row('tbl_school',array('id'=>$value));
												$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
											?>
						      				<li>
												<h3>
													<a href="<?php echo base_url('school/'.md5($value)); ?>"><?php echo ucwords($school['name']) ?> </a>
													<span>
														<a href="javascript:void(0);" class="removeCompareSchool" data-id="<?php echo $school['id'] ?>">
															<i class="fa fa-times"></i>
														</a>
													</span>
												</h3>
												<p><?php echo $state['shortName'].', '.$school['city'] ?></p>
												<hr>
											</li>
											<?php
					      					}

					      					if($count > 1) {
					      						$href = 'href="'.base_url('compare-school').'"';
					      					}
					      				}
					      				else if($this->session->userdata('compareTeacher')) {
					      					$class = 'hide';
					      					foreach ($compareArr as $key => $value) {
					      						$teacher = $this->common->get_one_row('tbl_teacher',array('id'=>$value));
												$school = $this->common->get_one_row('tbl_school',array('id'=>$teacher['teach_school']));
												$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
											?>
						      				<li>
												<h3>
													<a href="<?php echo base_url('teacher/'.md5($value)); ?>"><?php echo ucwords($teacher['fname'].' '.$teacher['lname']); ?> </a>
													<span>
														<a href="javascript:void(0);" class="removeCompareTeacher" data-id="<?php echo $teacher['id'] ?>">
															<i class="fa fa-times"></i>
														</a>
													</span>
												</h3>
												<p><?php echo $state['shortName'].', '.$school['city'] ?></p>
												<hr>
											</li>
											<?php
					      					}

					      					if($count > 1) {
					      						$href = 'href="'.base_url('compare-teacher').'"';
					      					}
					      				}
					      				?>
					      			</ul>
					      			<?php /* <hr> */ ?>
					      			<a class="btn-com-sc <?php echo $class; ?>" id="compareBtn" <?php echo $href; ?>>Compare Schools</a>
					      			<a class="btn-com-sc <?php echo $classTeacher; ?>" id="compareTeacherBtn" <?php echo $href; ?>>Compare Teachers</a>
					    		</div>
					  		</div>
						</div>
		      		</li>
		      	</ul>
		    </div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
</header>
<script src="<?php echo F_JSPATH ?>bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
	$('#searchText').typeahead({
		source: function(query, result){
			var filterby = $("#filterby option:selected").val();
			$.ajax({
				// url: '<?php echo base_url('Home/search_main'); ?>',
				// data: { s_text: query, filterby:filterby },
				url: '<?php echo base_url('Home/search_keyword'); ?>',
				method: 'post',
				data: { s_text: query },
				dataType:"json",
				success: function(data) {
					result($.map(data, function(item){
						// return item.name;
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

	$('.btn-search').on('click',function() {
		$('#demo-2').submit();
	});
</script>
