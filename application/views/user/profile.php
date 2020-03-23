<?php
?>
<style type="text/css">
#informationForm input {
   border: #ccc solid 1px;
   border-radius: 3px;
}
</style>
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
<div class="profile-box">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <ul class="nav panel-tabs">
                     <li class="active"><a href="#account" data-toggle="tab">Account Information</a></li>
                     <!-- <li><a href="#history" data-toggle="tab">View Your History</a></li> -->
                     <li><a href="#rating_history" data-toggle="tab">View / edit your reviews</a></li>
                  </ul>
               </div>
               <div class="panel-body">
                  <div class="tab-content">
                     <div class="tab-pane active" id="account">
                        <div class="row">
                           <div class="col-md-12">
                              <h2>Your Information</h2>
                              <form id="informationForm">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                           <label>Type</label>
                                           <?php
                                           $professionArr = array('Student', 'Parent', 'Teacher', 'Other');
                                           ?>
                                           <select name="profession" class="form-control">
                                             <option value="">I am a..</option>
                                             <?php
                                             foreach ($professionArr as $key => $value) {
                                                $select = $user['profession'] == strtolower($value) ? 'selected' : '';
                                             ?>
                                             <option value="<?php echo strtolower($value); ?>" <?php echo $select; ?> ><?php echo $value ?></option>
                                             <?php
                                             }
                                             ?>
                                           </select>
                                       </div>
                                    </div>                                 
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" name="fname" class="form-control" value="<?php echo $user['fname']; ?>">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" name="lname" class="form-control" value="<?php echo $user['lname']; ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Email</label>
                                          <input type="text" name="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Gender</label>
                                          <select name="gender" class="form-control">
                                             <option value="">Select Gender</option>
                                             <option value="male" <?php if($user['gender'] == 'male') { echo 'selected'; } ?>>Male</option>
                                             <option value="female" <?php if($user['gender'] == 'female') { echo 'selected'; } ?>>Female</option>
                                          </select>
                                       </div>
                                    </div>
                                 
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Age</label>
                                          <input type="text" name="age" class="form-control" value="<?php echo $user['age'] ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Phone</label>
                                          <input type="text" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                                       </div>
                                    </div>
                                 
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>State</label>
                                          <select name="state" class="form-control">
                                             <option value="">Select State</option>
                                             <?php
                                             foreach ($state as $key => $value) {
                                                $sel_state = ($value['id'] == $user['state']) ? 'selected' : '';
                                             ?>
                                             <option value="<?php echo $value['id'] ?>" <?php echo $sel_state ?>><?php echo $value['name'] ?></option>
                                             <?php
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Postcode</label>
                                          <input type="text" name="postcode" class="form-control" value="<?php echo $user['postcode'] ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <button class="btn-1">Save</button>
                                    </div>
                                 </div>

                              </form>      
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="history">
                        <?php
                        if(!empty($pageview_history)) {
                        ?>
                        <ul style="list-style: unset; padding-left: 20px;">
                           <?php
                           foreach ($pageview_history as $key => $value) {
                           ?>
                           <li>
                              <?php
                              if($value['schoolname'] != '') {
                              ?>
                              You have Visited <a href="<?php echo base_url('school/').md5($value['schoolId']); ?>"><?php echo $value['schoolname'] ?></a>
                              <?php
                              }
                              else if($value['teachername'] != '') {
                              ?>
                              You have Visited <a href="<?php echo base_url('teacher/').md5($value['teacherId']); ?>"><?php echo $value['teachername'] ?></a>
                              <?php
                              }
                              ?>
                           </li>
                           <?php
                           }
                           ?>
                        </ul>
                        <?php
                        }
                        else {
                        ?>
                        <h4 class="text-center">No Records</h4>
                        <?php
                        }
                        ?>
                     </div>
                     <div class="tab-pane" id="rating_history">
                        <ul style="list-style: unset; padding-left: 20px;">
                           <?php
                           foreach ($rating_history as $key => $value) {
                           ?>
                           
                           <li>
                              <?php
                              if($value['schoolname'] != '') {
                              ?>
                              You left a Review for <a href="javascript:void(0);" class="reviewBtn" data-type="school" data-id="<?php echo $value['id'] ?>"><?php echo $value['schoolname'] ?></a> on <?php echo date('Y-m-d' , strtotime($value['created_date']) ); ?>
                              <?php
                                 if($value['updated_date'] != '0000-00-00 00:00:00'){
                                    echo '. This was amended on the '.date('Y-m-d' , strtotime($value['updated_date']) ).'.';
                                 }
                              }
                              else if($value['teachername'] != '') {
                              ?>
                              You left a Review for <a href="javascript:void(0);" class="reviewBtn" data-type="teacher" data-id="<?php echo $value['id'] ?>"><?php echo $value['teachername'] ?> </a> on <?php echo date('Y/m/d' , strtotime($value['created_date']) ); ?>
                              <?php
                                 if($value['updated_date'] != '0000-00-00 00:00:00'){
                                    echo '. This was amended on the '.date('Y/m/d' , strtotime($value['updated_date']) ).'.';
                                 }
                              }
                              ?>
                           </li>
                           <?php
                           }
                           ?>
                        </ul>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="review-result"></div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

   $("#informationForm").validate({
      rules: {
         profession: "required",
         fname: "required",
         lname: "required",
         email: "required",
         gender: "required",
         age: "required",
        // phone: "required",
         state: "required",
         postcode: "required",
      },
      messages: {
         profession: "Please Select Type",
         fname: "Please Enter First Name",
         lname: "Please Enter Last Name",
         email: "Please Enter Email",
         gender: "Please Select Gender",
         age: "Please Enter Age",
        // phone: "Please Enter Phone",
         state: "Please Select State",
         postcode: "Please Enter Postcode",
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

   /**/
   $('#informationForm').on('submit', function(e) {
      e.preventDefault();
      $('#informationForm').valid();
      if($('#informationForm').valid()) {   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(FRONTEND.'Login/ProfileUpdate') ?>',
            data: $('#informationForm').serialize(),
            success: function(data) {
               // console.log(data);
               data = jQuery.parseJSON(data);
               if(data.success) {
                  swal('Success!', data.message, 'success');
               }
               else {
                  swal('Warning!', data.message, 'warning');
               }
            }
         });
      }
   });
   /**/

   $('.reviewBtn').on('click',function() {
      let id = $(this).attr('data-id');
      let type = $(this).attr('data-type');
      $.ajax({
         type: 'POST',
         url: '<?php echo base_url(FRONTEND.'Login/check_review') ?>',
         data: { id: id, type: type },
         dataType: 'html',
         success: function(data) {
            $('#review-result').html(data);
            if(type == 'school') {
               $('#schoolModal').modal();
            }
            else {
               $('#teacherModal').modal();
            }
         }
      });
   });

}); 
</script>