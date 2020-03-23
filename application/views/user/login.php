<!-- <script src='https://www.google.com/recaptcha/api.js?render=6LeDh4QUAAAAANeb9ZOzux9igoc5rWFw3oJUNwnj'></script> -->
<!-- <script src='https://www.google.com/recaptcha/api.js?render=6Lc3JasUAAAAAPwtyXt5pN96PK9o8HUw82reTcPW'></script> -->


<div class="slider-se">
	<div class="login-banner-img-se">
		<div class="container">    			
    		<div class="upper-text-se">
    			<div class="row">
    				<div class="col-md-6 col-md-offset-6">
		    			<h1>Hello.</h1>
	    				<h3>You’re awesome. </h3>
		    		</div>
		    	</div>
    		</div>
    	</div>
	</div>
	<div class="bottom-text">
		<h3>"The greatness of a community is most accurately measured by the actions of its members." Coretta Scott King</h3>
	</div>
</div>

<div class="">
	<div class="container">
		
	</div>
</div>

<div class="signup-se">    	
	<div class="cat-3-img-se">
		<img src="<?php echo FRONTENDPATH ?>images/cat-3.png" alt="123">
	</div>
	
	<div class="signup-detail-se">
    	<div class="container">
    		<div class="row">
	    		<div class="col-md-5 yellow-box">
					<?php $this->load->view(FRONTEND.'include/message'); ?>
		    		<div class="in-box">
		    			<h3>Sign In</h3>
		    			<p>Welcome Back</p>
		    			<form id="loginForm" method="post" action="<?php echo base_url(FRONTEND.'Login/auth') ?>">
			    			<div class="row">
			    				<div class="col-md-12">
									<div class="form-group">
									    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
									</div>
									<div class="form-group">
									    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
									</div>
			    				</div>    			
			    				<div class="col-md-5">
			    					<button class="btn-1">Log In</button>
			    				</div>
			    			</div>
						  	<div class="">
							    <!-- <label>Did you forget your password?</label> -->
							    <a href="<?php echo base_url('forgot-password') ?>">Did you forget your password?</a>
							    <!-- <a href="javascript:void(0);">Did you forget your password?</a> -->
						  	</div>
		    			</form>
					</div>
				</div>
	    		<div class="col-md-7">
	    			<h3>Sign Up</h3>
					<p>Leave reviews <!-- with an account --></p>
	    			<div class="">
	    				<form method="post" id="registerForm" action="<?php echo base_url(FRONTEND.'Login/register') ?>">
	    					<div class="row">
		    					<div class="col-md-5">
									<div class="form-group">
									    <input type="text" name="fname" class="form-control" placeholder="First Name">
									</div>
		    					</div>
		    					<div class="col-md-7">
									<div class="form-group">
									    <input type="text" name="lname" class="form-control" placeholder="Surname">
									</div>
		    					</div>
	    					</div>
	    					<div class="row">
		    					<div class="col-md-5">
									<div class="form-group">
									    <select name="gender" class="form-control">
									    	<option value="">Gender</option>
									    	<option value="male">Male</option>
									    	<option value="female">Female</option>
									    	<option value="other">Other</option>
									    	<option value="prefer not to disclose">Prefer Not To Disclose</option>
									    </select>
									</div>
		    					</div>
		    					<div class="col-md-7">
									<div class="form-group">
									    <!-- <input type="text" name="age" class="form-control" placeholder="Age"> -->
									    <input type="text" name="mobile" class="form-control" placeholder="Mobile">
									</div>
		    					</div>
	    					</div>
	    					<div class="row">
	    						<div class="col-md-5">
									<div class="form-group">
									    <select name="state" class="form-control">
									    	<option value="">State</option>
									    	<?php
									    	foreach ($state as $key => $value) {
									    	?>
									    	<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
									    	<?php
									    	}
									    	?>
									    </select>
									</div>
	    						</div>
	    						<div class="col-md-7">
									<div class="form-group">
									    <input type="text" name="postcode" class="form-control" placeholder="Postcode">
									</div>
	    						</div>
	    					</div>
	    					<div class="row">
	    						<div class="col-md-5">
									<div class="form-group">
									    <!-- <input type="text" name="profession" class="form-control" placeholder="I am a.."> -->
									    <?php
									    $professionArr = array('Student', 'Parent', 'Teacher', 'Other');
									    ?>
									    <select name="profession" class="form-control">
									    	<option value="">I am a..</option>
									    	<?php
									    	foreach ($professionArr as $key => $value) {
									    	?>
									    	<option value="<?php echo strtolower($value); ?>"><?php echo $value ?></option>
									    	<?php
									    	}
									    	?>
									    </select>
									</div>
	    						</div>
	    						<div class="col-md-7">
	    							<div class="form-group">
									    <input type="text" name="age" class="form-control" placeholder="Age">
	    							</div>
	    						</div>
	    					</div>
	    					<div class="row">
	    						<div class="col-md-12">
									<div class="form-group">
									    <input type="text" name="email" class="form-control" placeholder="Email address">
									</div>
									<div class="form-group">
									    <span class="eye-password">
									    	<input type="password" name="password" class="form-control" id="password" placeholder="Password">
									    	<a class="view-pass" id="viewPassword"><i class="fa fa-eye"></i></a>
									    </span>
									</div>
								</div>
								<?php
								if($_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "10.0.0.102") 
								{

								} else {
								?>	
								<div class="col-md-5">
									<div class="form-group">
										<!-- <img src="<?php echo FRONTENDPATH ?>images/robot.jpg" alt=""> -->
										<div class="g-recaptcha" data-sitekey="6Lc3JasUAAAAANsYT6cNczMhcrJkw0Yghl5JkuVb"></div>
									</div>
								</div>
								<?php
								}
								?>

								<div class="col-md-12">
									<div class="form-group">
										<div class="row">
											<div class="checkbox">
					                           	<label style="font-size: 1em">
				                              		<input type="checkbox" value="0" name="terms">
					                              	<span class="cr"><i class="cr-icon fa fa-check"></i></span>
					                              	<p class="sign-comman-text">I have read, understood and accept your
					                              		<a href="<?php echo base_url('terms') ?>" target="_blank"> Terms of Use </a>  , 
					                              		<a href="<?php echo base_url('content-integrity-policy') ?>" target="_blank"> Content & Integrity Policy </a> and 
					                              		<a href="<?php echo base_url('privacy-policy') ?>" target="_blank"> Privacy Policy</a>. By creating an account, I acknowledge that I will abide by these conditions. </p>
					                           	</label>
					                        </div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<button type="submit" class="btn-1">Create Account</button>
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

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

		$("#loginForm").validate({
	      	rules: {
	         	email: { required: true, email:true },
	         	password: { required: true },
	      	},
	      	messages: {
				email: { required: 'Please Enter Email' },
				password: { required: 'Please Enter Password' },
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
	         	} else {
		            error.insertAfter(element);
	         	}
	      	},
	      	highlight: function ( element, errorClass, validClass ) {
	         	//$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
	      	},
	      	unhighlight: function (element, errorClass, validClass) {
	         	//$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
	      	}
	   	});

	$("#registerForm").validate({
      	rules: {
         	fname: {
	            required: true
         	},
         	lname: {
         		required: true
         	},
         	gender: {
         		required: true
         	},
         	/*mobile: {
         		required: true
         	},*/
         	age: "required",
         	state: {
         		required: true
         	},
         	postcode: {
         		required: true
         	},
         	profession: {
         		required: true
         	},
         	email: {
         		required: true
         	},
         	password: {
         		required: true
         	},
         	terms: {
         		required: true
         	}

      	},
      	messages: {
			fname: {
				required: 'Please Enter First Name'
			},
			lname: {
         		required: 'Please Enter SurName'
         	},
         	gender: {
         		required: 'Please Select Gender'
         	},
         	/*mobile: {
         		required: 'Please Enter Mobile No.'
         	},*/
         	age: "Please Enter Age",
         	state: {
         		required: 'Please Select State'
         	},
         	postcode: {
         		required: 'Please Enter Postcode'
         	},
         	/*profession: {
         		required: 'Please Enter '
         	},*/
         	email: {
         		required: 'Please Enter Email'
         	},
         	password: {
         		required: 'Please Enter Password'
         	},
         	terms: {
         		required: 'Please Select Terms and Policy'
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
         	} else {
	            error.insertAfter(element);
         	}
      	},
      	highlight: function ( element, errorClass, validClass ) {
         	//$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
      	},
      	unhighlight: function (element, errorClass, validClass) {
         	//$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
      	}
   	});

   	/* View Password */
   	$('#viewPassword').click(function() {
   		let x = $("#password");
   		if (x.attr('type') === "password") {
	    	x.attr('type',"text");
	  	} else {
		    x.attr('type',"password");
	  	} 		
   	});

   	$('#registerForm').on('submit', function() {
   		if($(this).valid()) {
   			if(grecaptcha.getResponse() == '') {
   				alert('Please Verify You are not Robot');
   				return false;
	   		}
   		}
   	});

});

</script>