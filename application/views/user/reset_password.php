<!-- <script src='https://www.google.com/recaptcha/api.js?render=6LeDh4QUAAAAANeb9ZOzux9igoc5rWFw3oJUNwnj'></script> -->

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
		<h3>Your free account will allow you to leave reviews on school or teacher profiles</h3>
	</div>
</div>

<div class="yellow-box">
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<?php $this->load->view(FRONTEND.'include/message'); ?>
    		<div class="in-box">
    			<h3>Reset Password</h3>
    			<p>Welcome Back</p>
    			<form id="resetPasswordForm" method="post" action="<?php echo base_url(FRONTEND.'Login/ResetPasswordUpdate/'.$string.'/'.md5($user['id'])) ?>">
	    			<div class="row">
	    				<div class="col-md-9">
							<div class="form-group">
							    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
							</div>
							<div class="form-group">
							    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
							</div>
	    				</div>
	    			</div>
	    			<div class="row">
	    				<div class="col-md-4">
	    					<div class="form-group">
	    						<button class="btn-1">Reset Password</button>
	    					</div>
	    				</div>
	    			</div>
    			</form>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {

	$("#resetPasswordForm").validate({
      	rules: {
         	password: {
         		required: true
         	},
         	confirm_password: {
         		required: true,
         		equalTo: "#password"
         	}

      	},
      	messages: {
			password: {
         		required: 'Please Enter Password'
         	},
         	confirm_password: {
         		required: 'Please Enter Password',
         		equalTo: 'Password does not match...'
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