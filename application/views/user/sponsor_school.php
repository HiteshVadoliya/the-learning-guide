<div class="yellow-gry-se">
	<div class="cat-4-img-se">
		<img src="<?php echo FRONTENDPATH ?>images/cat-3.png" alt="">
	</div>
	<div class="yellow-se">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-md-offset-3">
					<div class="sub-title-box">
						<h3>Sponsor a School </h3>
						<p>You can promote a school profile in our directory.</p>
						<p>Your sponsorship will help other teachers, parents and students locate your school of choice more easily.</p>
					</div>
					<div class="fom-se">
						<form method="post" action="<?= base_url('payment') ?>" id="sponsorForm" name="sponsorForm">
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
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="input-group date form_date" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						                    <input class="form-control" size="16" id="start_date" name="start_date" type="text" value="" readonly placeholder="Start Date">
						                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						                </div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="input-group date form_date" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						                    <input class="form-control" size="16" id="end_date" name="end_date" type="text" value="" readonly placeholder="End Date">
						                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						                </div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<input type="text" name="amount_dummy" id="amount_dummy" class="form-control" placeholder="Total : $0" readonly="">
										<input type="hidden" name="amount" id="amount" class="form-control" placeholder="Total : $0" readonly="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<button style="width: 100%" name="paymentBtn" type="submit" class="btn-1 btn btn-primary"><i class="fa fa-paypal"></i> Pay with PayPal </a></button>
										<!-- <button name="paymentBtn" type="submit" class="btn-1">Submit</button> -->
										<!-- <a href="javascript:void(0);" class="btn-1">Submit</a> -->
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<button style="width: 100%" name="paymentCreditCardBtn" type="submit" class="btn-1 btn btn-primary"><i class="fa fa-paypal"></i> Pay with Credit Card </a></button>
										<!-- <button name="paymentBtn" type="submit" class="btn-1">Submit</button> -->
										<!-- <a href="javascript:void(0);" class="btn-1">Submit</a> -->
									</div>
								</div>
							</div>
						</form>
						<!-- <p><small>*Sponsorship is $15 per day and will be calculated at checkout then processed through PayPal.</small></p> -->
						<p><small>*School Sponsorship is $15 per day.</small></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="gry-se">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-md-offset-3">
					<div class="sub-title-box">
						<h3>Want to add or update a profile?</h3>
						<div class="msgsuccess"></div>
					</div>
					<div class="fom-se">
						<form method="post" id="teacherForm" name="teacherForm">
							<div class="row">
							  <div class="col-md-6 col-sm-6">
								  <div class="form-group">
				                     <input type="text" name="fname" class="form-control" placeholder="Your name" >
				                  </div>
				              </div>
				              <div class="col-md-6 col-sm-6">
				                  <div class="form-group">
				                     <input type="text" name="lname" class="form-control" placeholder="Your surname">
				                  </div>
				              </div>
				              <div class="col-md-12">
				                  <div class="form-group">
				                     <input type="email" name="uemail" class="form-control" placeholder="Your email">
				                  </div>
				              </div>
				              <div class="col-md-12">
				                  <div class="form-group">
				                     <select name="type" class="form-control type">
				                     	<option value="">Profile type you wish to add or update</option>
				                     	<option value="school">School</option>
				                     	<option value="teacher">Teacher</option>
				                     </select>
				                  </div>
				              </div>
				              <div id="teacher">
					              <div class="col-md-6 col-sm-6">
					                  <div class="form-group">
					                     <input type="text" name="t_name" class="form-control" placeholder="Teacher Name">
					                  </div>
					              </div>
					              <div class="col-md-6 col-sm-6">
					                  <div class="form-group">
					                     <input type="text" name="t_email" class="form-control" placeholder="Teacher Email">
					                  </div>
					              </div>
					          </div>
					          <div id="school">
					              <div class="col-md-6 col-sm-6">
					                  <div class="form-group">
					                     <input type="text" name="s_name" class="form-control" placeholder="School Name">
					                  </div>
					              </div>
					              <div class="col-md-6 col-sm-6">
					                  <div class="form-group">
					                     <input type="text" name="s_email" class="form-control" placeholder="School Email">
					                  </div>
					              </div>
					          </div>

							  <div class="col-md-6 col-sm-6">
									<div class="form-group">
										<button type="submit" name="findSchoolBtn" class="btn-1">Submit</button>
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

<script type="text/javascript">
function Convert_DMY2MDY(str) {
    var mdy = str.split('/');
    return mdy[1]+'/'+mdy[0]+'/'+mdy[2];
}
calculate_amount();
function calculate_amount() {

	if( $('#start_date').val() != '' && $('#end_date').val() != '') {
		var date1 = new Date( Convert_DMY2MDY( $('#start_date').val() ) );
		var date2 = new Date( Convert_DMY2MDY( $('#end_date').val() ) );
		
		var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

		$total_amount = ( diffDays + 1 ) * 15;
		$("#amount_dummy").val( 'Total : $'+$total_amount );
		$("#amount").val($total_amount);
	} else {
		$("#amount_dummy").val('Total : $');
		$("#amount").val('');
	}
}

$(document).on('change', '#start_date', function() {
	calculate_amount();
});

$(document).on('change', '#end_date', function() {
	calculate_amount();
});

$(document).ready(function() {

	$("#sponsorForm").validate({
  		ignore: [],
      	rules: {
        	
        	school: { required: true },
        	start_date: { required: true },
        	end_date: { required: true },
        	amount_dummy: { required: true },
        	amount: { required: true }
      	},
      	messages: {
         	school: { required: 'Please Select School' },
         	start_date: { required: 'Please Select Start Date' },
         	end_date: { required: 'Please Select End Date' },
         	amount_dummy: { required: 'Enter Amount' },
         	amount: { required: 'Enter Amount' }
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
         	//$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
      	},
      	unhighlight: function (element, errorClass, validClass) {
         	//$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
      	}
   	});

   	$("#teacherForm").validate({
  		ignore: [],
      	rules: {
        	
        	fname: { required: true },
        	lname: { required: true },
        	type: { required: true },
        	email: { 
        		email:true,
        		required: true
        		}
      	},
      	messages: {
         	fname: { required: 'Enter First Name' },
         	lname: { required: 'Enter Last Name' },
         	type: { required: 'Select school or teacher' },
         	email: { 
         		email: 'Enter valid email',
         		required: 'Please Email' 
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
         	//$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
      	},
      	unhighlight: function (element, errorClass, validClass) {
         	//$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
      	},

      	submitHandler: function (form) {

               
              var formData = new FormData($(form)[0]);
              $.ajax({
                  url: '<?php echo base_url(); ?>user/Teacher/teacher_store',
                  type: 'POST',
                  data: formData,
                  async: false,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:'json',
                  success: function (response) {

                    if(response.result == 'error'){
                        
                        $('.msgsuccess').html('<div class="alert alert-danger">'+response.msg+'</div>');

                    }else{

                      $('.msgsuccess').html('<div class="alert alert-success">'+response.msg+'</div>');
                      

                      $('#teacherForm')[0].reset();

                    }

                  },
                  error: function(){
                  	$('.msgsuccess').html('<div class="alert alert-danger">Some things went wrong</div>');
                  }
              });
              return false;
         
      }



   	});
   	$("#teacherForm").find("#school").hide();
   	$("#teacherForm").find("#teacher").hide();
   	/*$('#school').hide();
   	$('#teacher').hide();*/
   	$(".type").change(function(){
   		var type = $(this).val();
   		if(type == 'school'){
   			$("#teacherForm").find("#school").show();
   			$("#teacherForm").find("#teacher").hide();
   			/*$('#school').show();
   			$('#teacher').hide();*/
   		}else if(type== 'teacher'){
   			$("#teacherForm").find("#school").hide();
   			$("#teacherForm").find("#teacher").show();
   			/*$('#school').hide();
   			$('#teacher').show();*/
   		}else{
   			$("#teacherForm").find("#school").hide();
   			$("#teacherForm").find("#teacher").hide();
   			/*$('#school').hide();
   			$('#teacher').hide();*/
   		}
   	})

});
</script>


