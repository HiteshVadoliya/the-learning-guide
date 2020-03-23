<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">
<link href="<?php echo FRONTENDPATH; ?>timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo FRONTENDPATH; ?>bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<section class="content-header">
   <?php
      if(isset($event)) {
      ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Edit Event</h1>
   <?php
      }
      else {
      ?>
   <h1><i class="fa fa-plus"></i>&nbsp;Add Event</h1>
   <?php
      }
      ?>
</section>
<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box box-info">
      <?php
         if(isset($calendar)) {
         ?>
      <form role="form" action="<?= ADMIN_LINK.'Calendar/save_task/'.$calendar['id'] ?>" method="post" id="calenderForm" enctype="multipart/form-data">
         <?php
            }
            else {
            ?>
      <form role="form" action="<?= ADMIN_LINK.'Calendar/save_task' ?>" method="post" id="calenderForm" enctype="multipart/form-data">
         <?php
            }
            ?>
         <div class="box-header with-border">
            <h3 class="box-title">
               <a href="<?= base_url(ADMIN.'manage-calendar') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </h3>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="control-label">Event Name<span class="star-mend">*</span></label>
                     <input class="form-control form-white" placeholder="Enter Event" type="text" name="task_name" id="task_name"  value="<?php if(isset($calendar)) { echo $calendar['task_name']; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="control-label">Cost<span class="star-mend">*</span></label>
                     <input class="form-control " type="text" name="task_cost" id="task_cost" placeholder="Event Cost/FREE" value="<?php if(isset($calendar)) { echo $calendar['task_cost']; } ?>" />
                  </div>
                  <div class="form-group">
                     <label class="control-label">Event Description<span class="star-mend">*</span></label>
                     <textarea class="form-control" name="task_description" autocomplete="off"  placeholder="Enter Description"><?php if(isset($calendar)) { echo $calendar['task_description']; } ?></textarea>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Upload Attachment<span class="star-mend">*</span></label>
                     <small> (Allow : jpg, gif, png)</small>
                     <input type="file" class="form-control " id="attachment"  name="attachment[]" 
                        accept="image/gif, image/jpeg, image/png, application/vnd.ms-excel, text/plain, application/pdf, .csv , " >
                  </div>
                  <?php 
                  if(isset($calendar) && $calendar['attachment']!='') {
                     $img = base_url(CalendarPath).$calendar['attachment'];
                     ?>
                     <input type="hidden" name="old_Img" id="old_Img" value="<?php echo $calendar['attachment']; ?>">
                     <div class="col-md-12">
                        <img  src="<?= $img; ?>" width="100px">
                     </div>
                     <?php
                  }
                  ?>

                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>Event Date:<span class="star-mend">*</span></label>
                        <div>
                           <div class="input-group">
                              <input type="text" name="task_date" id="task_date" class="form-control datepicker " autocomplete="off" placeholder="Date of Event" value="<?php if(isset($calendar)) { echo $calendar['task_date']; } ?>">
                              <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Event finish Date:<span class="star-mend">*</span></label>
                        <div>
                           <div class="input-group">
                              <input type="text" name="task_end_date" id="task_end_date" class="form-control datepicker " autocomplete="off" placeholder="End date of Event" value="<?php if(isset($calendar)) { echo $calendar['task_end_date']; } ?>">
                              <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>Event start Time:<span class="star-mend">*</span></label>                                        
                        <div class="input-group">
                           <input id="task_time" name="task_time" type="text" class="form-control timepicker "  autocomplete="off" value="<?php if(isset($calendar)) { echo $calendar['task_time']; } ?>">
                           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Event finish Time:<span class="star-mend">*</span></label>                                        
                        <div class="input-group">
                           <input id="task_end_time" name="task_end_time" type="text" class="form-control timepicker "  autocomplete="off" value="<?php if(isset($calendar)) { echo $calendar['task_end_time']; } ?>">
                           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Select School<span class="star-mend">*</span></label>
                     <select class="form-control" name="task_school_tag" id="task_school_tag">
                        <option value="">Select School</option>
                        <?php
                           foreach ($schools as $key => $s_value) {
                              $sel = '';
                              if(isset($calendar)) {
                                 $sel = ($calendar['task_school_tag']==$s_value['id']) ? 'selected' : '';
                              }
                             ?>
                        <option <?= $sel; ?> value="<?php echo $s_value['id'] ?>"><?php echo $s_value['name']; ?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <label class="control-label">Select Event type (tick one or more of the following) <span class="star-mend">*</span></label>
                  <div class="form-group">
                     <?php
                     
                     if(isset($calendar)) {
                        $task_type = explode(",", $calendar['task_type']);
                     }
                        foreach ($calender_event_type as $event_key => $event_type) {
                           $sel = '';
                           if(isset($calendar)) {
                              $sel = in_array($event_key,$task_type) ? 'checked' : '';
                           }
                          ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="checkbox" style="margin: 0px;">
                              <label style="font-size: 1em">
                                 <input <?= $sel; ?> type="checkbox" value="<?= $event_key; ?>" name="task_type[]">
                                 <span class="cr" style="background: <?= $calender_event_color[$event_key]; ?>" ><i class="cr-icon fa fa-check"></i></span>
                                 <p style="margin: 0px;"><?php echo $event_type ?></p>
                              </label>
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        ?>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Address<span class="star-mend">*</span></label>
                     <textarea class="form-control" name="task_address" id="task_address" autocomplete="off"  placeholder="Enter Address"><?php if(isset($calendar)) { echo $calendar['task_address']; } ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>RSVP Date:</label>
                     <div>
                        <div class="input-group">
                           <input type="text" name="rsvp_date" id="" class="form-control datepicker" autocomplete="off" placeholder="End date of Event" value="<?php if(isset($calendar)) { if($calendar['rsvp_date'] != '') { echo $calendar['rsvp_date']; } } ?>">
                           <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>RSVP Contact</label>
                     <textarea name="rsvp_contact" class="form-control" style="resize: none;"><?php if(isset($calendar)) { if($calendar['rsvp_contact'] != '') { echo $calendar['rsvp_contact']; } } ?></textarea>
                  </div>
               </div>
            </div>
            <!-- row -->
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php if(isset($calendar)) { echo 'Modify'; }else { echo 'save'; } ?></button>
            <a href="<?= base_url(ADMIN.'manage-calendar') ?>" class="btn btn-danger pull-right">Cancel</a>
         </div>
         <!-- /.box footer-->
      </form>
   </div>
   <!-- /.box -->
</section>
<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo FRONTENDPATH; ?>bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo FRONTENDPATH.'timepicker/bootstrap-timepicker.js' ?>"></script>

<script type="text/javascript">
   $(function () {
      $('.datepicker').datepicker({
       format: 'yyyy-mm-dd',
       startDate: '-0d',
       autoclose: true,
      });
   });
   $(function () {
      $('.timepicker').timepicker();
   });

   $(document).ready(function() {
      
      $('input[name="task_type[]"]').on('change',function(e) {
         let target = e.target;
         let length = $('input[name="task_type[]"]:checked').length;
         if(length > 0) {
            $('input[name="task_type[]"]').prop('checked',false);
            $(target).prop('checked',true);
         }
      });

      $("#calenderForm").validate({
         ignore: [],
         rules: {
            task_name: "required",
            task_description: "required",
            task_date: "required",
            task_end_date: "required",
            task_time: "required",
            task_address: "required",
            task_school_tag: "required",
            task_cost: "required",
          },
          messages: {
            task_name: "Please enter Event Title",
            task_description: "Please enter Description",
            task_date: "Please select Date",
            task_end_date: "Please select Date",
            task_time: "Please select Time",
            task_address: "Please enter address",
            task_school_tag: "Please select school",
            task_cost: "Please add cost or FREE",
          },
         errorElement: "span",
         errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass("text-danger");
            if (element.prop( "type" ) === "checkbox") {
               error.insertAfter(element.parent( "label") );
            } else if(element.hasClass("phone")){
               error.insertAfter(element.parent(".input-group"));
            } else if(element.hasClass("myclass")){
               error.insertAfter(element.parent().parent());
            } else if (element.prop( "type" ) === "file") {
               // error.insertAfter(element.parent());
               element.parent().parent().append(error);
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
     
   
   });
   
</script>

<!-- File item template -->
<script type="text/html" id="files-template">
   <li class="media">
      <hr class="mt-1 mb-1" />
      <div class="media-body mb-1">
         <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
         </p>
         <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
      </div>
   </li>
</script>