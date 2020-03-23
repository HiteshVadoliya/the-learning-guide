<?php
$CI =& get_instance();
$social_media = $CI->common->get_one_row('tbl_social_media');
?>
<div class="slider-se">
	<div class="about-banner-img-se">
		<div class="container">    			
    		<div class="upper-text-se">
    			<div class="row">
    				<div class="col-md-6 col-md-offset-6">
		    			<h1>Contact Us</h1>		    				
		    		</div>
		    	</div>
    		</div>
    	</div>
	</div>
	<div class="bottom-text">
		<h3>Your free account will allow you to leave reviews on school or teacher profiles</h3>
	</div>
</div>

<div class="content-se">
	<div class="container">
 		<section class="contact-page-section">
  			<div class="container">
      			<div class="sec-title">              
            		<h2>Let's Get in Touch.</h2>
        		</div>
        		<div class="inner-container">
          			<div class="row clearfix">
              			<!--Form Column-->
                		<div class="form-column col-md-8 col-sm-12 col-xs-12">
                  			<div class="inner-column">                          
                        		<!--Contact Form-->
                        		<div class="contact-form">
                            		<form id="contactForm">
                                		<div class="row clearfix">
                                    		<div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        		<input type="text" name="name" placeholder="Name" class="myClass">
                                    		</div>
                                    		<div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        		<input type="text" name="email" placeholder="Email" class="myClass">
                                    		</div>
                                    		<div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        		<input type="text" name="subject" placeholder="Subject" class="myClass">
                                    		</div>
                                    		<div class="form-group col-md-6 col-sm-6 co-xs-12">
                                        		<input type="text" name="phone" placeholder="Phone" class="myClass">
                                    		</div>
                                    		<div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        		<textarea name="message" placeholder="Message" class="myClass"></textarea>
                                    		</div>
                                    		<div class="form-group col-md-12 col-sm-12 co-xs-12">
                                        		<button id="contactBtn" class="btn-1">Send Now</button>
                                    		</div>
                                		</div>
                            		</form>
                        		</div>
                        		<!--End Contact Form-->                        
                    		</div>
                		</div>                
                		<!--Info Column-->
                		<div class="info-column col-md-4 col-sm-12 col-xs-12">
                  			<div class="inner-column">
                      			<h2>Contact Info</h2>
                        		<ul class="list-info">
                                    <?php
                                    if(!empty($contact)) {
                                    ?>
                                    <li><i class="fa fa-globe"></i> <?php echo $contact['address']; ?></li>
                                    <li><i class="fa fa-envelope"></i> <?php echo $contact['email']; ?></li>
                                    <li><i class="fa fa-phone"></i> <?php echo $contact['phone']; ?></li>
                                    <?php
                                    }
                                    else {
                                    ?>
                          			<li><i class="fa fa-globe"></i> 123 Test Street, Australia.</li>
		                            <li><i class="fa fa-envelope"></i> example@test</li>
		                            <li><i class="fa fa-phone"></i> 1-234-567-890 <br> 1-234-567-890</li>
                                    <?php
                                    }
                                    ?>
		                        </ul>
		                        <ul class="social-icon-four">
		                            <li class="follow">Follow on: </li>
		                            <li>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-facebook-f"></i> </a> -->
                                        <?php
                                        $facebook = (!empty($social_media)) ? ($social_media['facebook'] != '') ? $social_media['facebook'] : 'javascript:void(0);' : 'javascript:void(0);';
                                        ?>
                                        <a href="<?php echo $facebook; ?>"><i class="fa fa-facebook-f"></i></a>
                                    </li>
		                            <li>
                                        <?php
                                        $instagram = (!empty($social_media)) ? ($social_media['instagram'] != '') ? $social_media['instagram'] : 'javascript:void(0);' : 'javascript:void(0);';
                                        ?>
                                        <a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-twitter"></i> </a> -->
                                    </li>
		                            <li>
                                        <?php
                                        $linkedin = (!empty($social_media)) ? ($social_media['linkedin'] != '') ? $social_media['linkedin'] : 'javascript:void(0);' : 'javascript:void(0);';
                                        ?>
                                        <a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-google-plus"></i> </a> -->
                                    </li>
		                            <li>
                                        <?php
                                        $youtube = (!empty($social_media)) ? ($social_media['youtube'] != '') ? $social_media['youtube'] : 'javascript:void(0);' : 'javascript:void(0);';
                                        ?>
                                        <a href="<?php echo $youtube; ?>"><i class="fa fa-youtube"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-dribbble"></i> </a> -->
                                    </li>
		                            <li>
                                        <?php
                                        $twitter = (!empty($social_media)) ? ($social_media['twitter'] != '') ? $social_media['twitter'] : 'javascript:void(0);' : 'javascript:void(0);';
                                        ?>
                                        <a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i> </a> -->
                                    </li>
		                        </ul>
                    		</div>
                		</div>                
            		</div>
        		</div>
    		</div>
		</section>
	</div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#contactForm").validate({
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true
            },
            subject: 'required',
            phone: 'required',
            message: 'required'
        },
        messages: {
            name: 'Please Enter Name',
            email: {
                required: 'Please Enter Email',
                email: 'Please Enter Valid Email'
            },
            subject: 'Please Enter Subject',
            phone: 'Please Enter Phone',
            message: 'Please Enter Message'
        },
        errorElement: "span",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass("text-danger");
            if (element.prop( "type" ) === "checkbox") {
                error.insertAfter(element.parent( "label") );
            } else if(element.hasClass("phone")){
                error.insertAfter(element.parent(".input-group"));
            } else if(element.hasClass("myClass")){
                error.insertAfter(element);
            } else if (element.prop( "type" ) === "file") {
                // error.insertAfter(element.parent());
                element.parent().parent().append(error);
            } else {
                error.insertAfter(element.parent);
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
        }
    });

    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        if($('#contactForm').valid()) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(FRONTEND.'Pages/submit_contact') ?>',
                data: $('#contactForm').serialize(),
                success: function(data) {
                    data = jQuery.parseJSON(data);
                    if(data.success) {
                        swal('Success!', data.message, 'success');
                    }
                    else {
                        swal('Error!', data.message, 'error');
                    }
                    $('input[name="name"]').val('');
                    $('input[name="email"]').val('');
                    $('input[name="subject"]').val('');
                    $('input[name="phone"]').val('');
                    $('textarea[name="message"]').val('');
                }
            });
        }
    });
});
</script>