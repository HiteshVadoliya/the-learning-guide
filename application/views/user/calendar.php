<!-- fullCalendar -->
<link href="<?php echo FRONTENDPATH ?>css/fullcalendar.min.css" rel="stylesheet">
<link href="<?php echo FRONTENDPATH ?>css/fullcalendar.print.min.css" rel="stylesheet" media="print">
<!-- Datepicker -->
<link href="<?php echo FRONTENDPATH; ?>timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo FRONTENDPATH; ?>bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/needsharebutton.min.css">

<div class="profile-page-se ">
      <div class="slider-se">
        <div class="profile-banner-img-se">
          <div class="container">         
            <div class="upper-text-se">
                <form id="searchForm" method="get" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-adv-search">
                                <div class="form-group bx-fin-se">
                                    <input type="text" name="searchText" class="form-control" placeholder="Search event by name" value="<?= $searchText; ?>">
                                </div>                                                    
                                <div class="form-group bx-fin-se">
                                    <button type="submit" class="btn-1">Find</button>
                                    <!-- <a href="#">Advanced Search</a> -->
                                </div>
                            </div>                             
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      <div class="bottom-text">
        <h3>“GOOD ORDER IS THE FOUNDATION OF ALL THINGS.” EDMUND BURKE</h3>
      </div>
    </div>

    
  <div class="calendar-page">

      <div class="container-fluid">
          <div class="cus-container">
            <div class="row">
              <div class="col-md-3 col-sm-12 col-xs-12">
              </div>
              <div class="col-md-9 col-sm-12 col-xs-12">
                <?php $this->load->view(FRONTEND.'include/message'); ?>
                <!-- <section class="content-header">
                  <h1><a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-1 waves-effect m-t-20 waves-light"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add event</a> <span></span> </h1>
                </section> -->
              </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="filter-section">
                        <!-- <div class="filter-title">     
                            <h3>Advanced Search</h3>
                        </div> -->
                        <form class="filter-check-box-se" name="filter_form" id="filter_form" > 
                            <input type="hidden" name="search" id="search" value="<?php if(isset($searchText) && $searchText!='') { echo $searchText; } ?>">
                            <input type="hidden" name="school_id" id="school_id" value="<?php if(isset($school_id) && $school_id!='') { echo $school_id; } ?>">
                            <div class=" cf filter_div">    
                                <label class="bold-lab filter-col" for="">Filter by event type:</label>
                                <div class="checkbox">
                                    <ul>
                                        <?php
                                        foreach($calender_event_type as $key_e => $event_type) {
                                        ?>
                                        <li>
                                            <label>
                                                <input type="checkbox" value="<?= $key_e ?>" name="task_type[]" class="run_filter">
                                                <span class="cr" style="background: <?= $calender_event_color[$key_e]; ?>"><i class="cr-icon fa fa-check"></i></span>
                                                <p class="color-box-label"><?= $event_type; ?></p>
                                            </label>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul> 
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="">
                        <div class="box box-primary">
                            <div class="box-body no-padding">
                                <div class="text-right">
                                  <h1><a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-1 waves-effect m-t-20 waves-light"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add event</a> <span></span> </h1>
                                </div>
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div> 
                </div>  

                <div class="col-md-2">
                    <div class="" id="upcoming_event">
                      <label class='bold-lab filter-col'> Upcoming Events </label>
                    </div> 
                </div>
                
              </div>
          </div>
      </div>
    </div>
    
<div class="clear"></div>    
    
<?php /*
<div class="calendar-page">
  <div class="container ">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Calendar <span><a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-1 waves-effect m-t-20 waves-light"  data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Create Event </a></span> </h1>
      </section>

      <?php $this->load->view(FRONTEND.'include/message'); ?>

      <div class="col-md-3 col-sm-3 col-xs-3">
      </div>
      

      <!-- Main content -->
      <section class="content">
        <div class="row">

          
           
          <!-- /.col -->
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</div>
*/ ?>
</div>
<div class="clear"></div>
<input type="hidden" name="is_view" id="is_view" value="<?php echo $is_view ?>">

<!-- Modal Add Category -->
<div class="modal fade none-border create_modal" id="add-category">
    <div class="modal-dialog">
        <form id="create_task" name="create_task" action="javascript:void(0);" enctype='multipart/form-data'  >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Event</h4>
                    <?php 
                    if(isset($this->session->USER['UId'])) {
                      ?>
                      <div class="row">
                         <!--  <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Cost<span class="star-mend">*</span></label>
                                  <input class="form-control " type="number" name="task_cost" id="task_cost" min="1" />
                              </div>
                          </div> -->
                          
                          <!-- <div class="col-md-3">
                            <div class="form-group">
                              <div class="row">
                                <div class="checkbox">
                                      <label style="font-size: 1em">
                                          <input type="checkbox" value="1" name="free_event" id="free_event">
                                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                          <p>This is a FREE Event</p>
                                      </label>
                                  </div>
                              </div>
                            </div>
                          </div> -->
                      </div>
                      <?php
                    }
                    ?>
                </div>
                <div class="modal-body">
                      <div class="msg"></div>
                      <?php
                      $CI =& get_instance();
                      if(isset($this->session->USER['UId'])) {
                      ?>
                      <div id="form-step-1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Event Name<span class="star-mend">*</span></label>
                                    <input class="form-control form-white" placeholder="Enter Event" type="text" name="task_name" id="task_name" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Cost<span class="star-mend">*</span></label>
                                    <input class="form-control " type="text" name="task_cost" id="task_cost" placeholder="Event Cost/FREE" />
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Event Description<span class="star-mend">*</span></label>
                                    <textarea class="form-control" name="task_description" autocomplete="off" required placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address<span class="star-mend">*</span></label>
                                    <textarea class="form-control" name="task_address" id="task_address" autocomplete="off" required placeholder="Enter Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Upload Attachment<span class="star-mend">*</span></label>
                                     <small> (Allow : jpg, gif, png)</small>
                                    <input type="file" class="form-control " id="attachment"  name="attachment[]" 
                                    accept="image/gif, image/jpeg, image/png, application/vnd.ms-excel, text/plain, application/pdf, .csv , " >
                                </div>
                            </div>
                            <div class="col-md-12">
                              <img id="ImageView" src="" width="100px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Event Date:<span class="star-mend">*</span></label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" name="task_date" id="task_date" class="form-control datepicker required" autocomplete="off" placeholder="Date of Event" >
                                        <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Event finish Date:<span class="star-mend">*</span></label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" name="task_end_date" id="task_end_date" class="form-control datepicker required" autocomplete="off" placeholder="End date of Event" >
                                        <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Event start Time:<span class="star-mend">*</span></label>                                        
                                <div class="input-group">
                                    <input id="task_time" name="task_time" type="text" class="form-control timepicker required"  autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>                                        
                            </div>

                            <div class="form-group col-md-6">
                                <label>Event finish Time:<span class="star-mend">*</span></label>                                        
                                <div class="input-group">
                                    <input id="task_end_time" name="task_end_time" type="text" class="form-control timepicker required"  autocomplete="off">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>                                        
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select School<span class="star-mend">*</span></label>
                                    <select class="form-group" name="task_school_tag" id="task_school_tag">
                                      <option value="">Select School</option>
                                      <?php
                                      foreach ($schools as $key => $s_value) {
                                        ?><option value="<?php echo $s_value['id'] ?>"><?php echo $s_value['name']; ?></option><?php
                                      }
                                      ?>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="">
                               <p style="margin-top: 20px;"> <span class="star-mend">*</span>If you select a school, this event will appear on that school profile!</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Please select the most relevant event category <span class="star-mend">*</span></label>
                                    <?php
                                    foreach ($calender_event_type as $event_key => $event_type) {
                                      ?>
                                      <div class="col-md-6">
                                        <div class="form-group">                                          
                                            <div class="checkbox" style="margin: 0px;" >
                                              <label style="font-size: 1em">
                                                  <input type="checkbox" value="<?= $event_key; ?>" name="task_type[]">
                                                  <span class="cr" style="background: <?= $calender_event_color[$event_key]; ?>"><i class="cr-icon fa fa-check"></i></span>
                                                  <p style="margin: 0px;"><?php echo $event_type ?></p>
                                              </label>
                                            </div>                                          
                                        </div>
                                      </div>
                                      <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RSVP Date:</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" name="rsvp_date" id="" class="form-control datepicker" autocomplete="off" placeholder="End date of Event" >
                                            <span class="input-group-addon bg-custom b-0"><i class="fa fa-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RSVP Contact</label>
                                    <textarea name="rsvp_contact" class="form-control" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                      <!-- Paypal -->
                      <div id="paypal-div" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="myform text-center">   
                                   <a href="<?php echo base_url().'user/Calendar/buy/'.$this->session->USER['UId']; ?>" id="paypal_url" class="btn btn-primary"><i class="fa fa-paypal"></i> Pay with PayPal </a>
                                </div>

                            </div>
                        </div>
                      </div>
                      <!-- Paypal -->
                      <?php
                      }
                      else {
                      ?>
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <!-- <p>Please log in to add a new event to our calendar.</p> -->
                          <p>Please Sign In or Sign Up to add a new event to our calendar.</p>
                          <?php
                          $url = $CI->config->site_url($CI->uri->uri_string());
                          $this->session->set_userdata("user_last_page",$url);
                          ?>
                          <a href="<?php echo base_url('login'); ?>" class="btn-1">Sign In / Sign Up</a>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <?php
                    if(isset($this->session->USER['UId'])) {
                    ?>
                    <button type="submit" class="btn btn-success waves-effect waves-light save-category" >Save</button>
                    <div class="row text-left">
                        <!-- <div class="col-md-12">
                            Advert cost: $52 + GST<br>
                            <small>*Unlimited event changes. Changes must be emailed to admin and given 48 hours notice. The event will remain visible after event date on monthly calendar and searchable. Shareable format to increase prospective audience and interest.</small>
                        </div> -->
                        <?php /* ?><div class="col-md-12">
                            <p>
                                <small>All events are sent to Admin for approval and are FOC.</small><br>
                                <small>If event is approved, the event will appear on our calendar, relevant school profile (if selected) and our 'Upcoming Events' list. The listing will remain visible after the event date on our monthly calendar unless removed by Admin due to breach of <a href="<?php echo base_url('content-integrity-policy'); ?>">Content and Integrity Policy</a> or specifically requested by event host/s via email.</small><br>
                                <small>Any changes must be emailed to Admin 3 working days prior to event date.</small>
                            </p>
                        </div><?php */ ?>
                        <div class="col-sm-12">
                          <ul>
                            <li>It is FREE to share an event to our calendar</li>
                            <li>All event forms are sent to Admin for approval and approval may take up to 5 working days.</li>
                            <li>If your event is approved, the event will appear on our calendar, relevant school profile (if selected), our 'Upcoming Events' list and any other relevant media UNLESS specifically requested.</li>
                            <li>The listing will remain visible after the event date on our monthly calendar unless removed by Admin, this may be due to a breach of the Content and Integrity Policy or as requested by the event host/s via email.</li>
                            <li>Any changes to the event must be emailed to Admin 5 working days prior to event date.</li>
                          </ul>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END MODAL -->

<div class="modal fade none-border create_modal" id="show-category">
    <div class="modal-dialog">
        <form method="post" method="post" action="javascript:;" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">View Event</h4>
                </div>
                <div class="modal-body">
                    <div class="msg"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Event Name</label>
                                <span id="task_name"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cost</label>
                                <span id="cost_price"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img id="ImageView" src="" width="150px">
                        </div>
                    </div>
  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Event Description</label>
                                <span id="task_description"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <span id="task_address"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Event Date:</label>
                            <span id="task_date"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Event Date:</label>
                            <span id="task_end_date"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Event Start Time:</label>                                        
                            <span id="task_time"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Event Finish Time:</label>                                        
                            <span id="task_time_end"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">School</label>
                                <span id="task_school_tag"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Event type </label>
                                <div id="event_type"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" id="rsvp_date_div" style="display: none;">
                            <div class="form-group">
                                <label>RSVP Date</label>
                                <span id="rsvp_date"></span>
                            </div>
                        </div>
                        <div class="col-md-6" id="rsvp_contact_div" style="display: none;">
                            <div class="form-group">
                                <label>RSVP Contact</label>
                                <span id="rsvp_contact"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- <div class="col-md-3">
                  <div class="share-se">
                    <div id="share-button-5" class="need-share-button-default" data-abc="http://abc.com" data-share-position="topCenter" data-share-share-button-class="custom-button">
                      <span class="custom-button"><i class="fa fa-share"></i> share</span></div>
                  </div>
                </div> -->
               <!--  <div class="col-md-3">
                  <div class="share-se">
                    
                    <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[url]=<script>this.href</script>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"  target="_parent" href="javascript:;">
                        Share our Facebook page!
                    </a>


                    <a href="http://www.facebook.com/sharer/sharer.php?u='<?php echo "http://bhimani.com.au/demo/school-review" ?>'">Share on Facebook</a>
                    <a href="https://twitter.com/home?status=">Share on Twitter</a>
                    <a href="https://plus.google.com/share?url=">Share on Google+</a>
                </div> -->
                <div id="share_button">
                  <a href="javascript:;" id="fb"><span class="need-share-button_link need-share-button_facebook" data-network="facebook"></span></a>
                  <a href="javascript:;" id="twitt"><span class="need-share-button_link need-share-button_twitter" data-network="twitter"></span></a>
                  <a title="Add to Calendar" href="javascript:;" id="ics" class="create-ics" data-id="16"><span class="need-share-button_link"><i class="fa fa-calendar"></i></span></a>
                  <a title="Share via Email" id="email_link" href=""><span class="need-share-button_link"><i class="fa fa-envelope" aria-hidden="true"></i></span></a>
                  <a title="Copy link" href="javascript:;" onclick="copyToClipboard('#copy')" id="copy"><span class="need-share-button_link"><i class="fa fa-copy"></i></span></a><span id="success_copy" style="display: none;">copied</span>
                  <?php
                  $USER = $this->session->userdata('USER');
                  ?>
                  <input type="hidden" name="user_email" id="user_email" value="<?php echo $USER['UEmail']; ?>">
                  <!-- <input type="text" name="school_name" id="school_name" value=""> -->

                  <!-- <button class="btn btn-default " data-id="16">Create .ics</button> -->
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php
// echo $filePath = base_url('assets/download.ics');


// echo shell_exec("http://localhost/the-learning-guide/assets/download.ics");

/*echo exec($filePath); 
shell_exec($filePath);
system($filePath); */
?>

<script type="text/javascript">
  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('data-value')).select();
    document.execCommand("copy");
    $('#success_copy').fadeIn(500).fadeOut(500);    
    $temp.remove();
  }



  var file_path = 'http://localhost/the-learning-guide/assets/download.ics';
  var a = document.createElement('A');
  a.href = file_path;
  a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
  document.body.appendChild(a);
  // a.click();
  // a.dblclick();
  // a.dblclick(); 
  // document.body.removeChild(a);

</script>
<!-- fullCalendar -->
<script src="<?php echo FRONTENDPATH ?>js/moment.js"></script>
<script src="<?php echo FRONTENDPATH ?>js/fullcalendar.min.js"></script>
<script src="<?php echo FRONTENDPATH ?>js/jquery.validate.js"></script>
<script src="<?php echo FRONTENDPATH; ?>bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo FRONTENDPATH.'timepicker/bootstrap-timepicker.js' ?>"></script>
<script src="<?php echo FRONTENDPATH ?>js/needsharebutton.js"></script>
<script type="text/javascript">
  
$(document).ready(function() {

    /**/
    $('input[name="task_type[]"]').on('change',function(e) {
        let target = e.target;
        let length = $('input[name="task_type[]"]:checked').length;
        if(length > 0) {
            $('input[name="task_type[]"]').prop('checked',false);
            $(target).prop('checked',true);
        }
    });

    $('#attachment').on('change',function() {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("ImageView").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
    /**/

  $(".create-ics").on("click",function(){
    var event_id = $(this).attr('data-id');

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url().FRONTEND.'Calendar/getCalItem' ?>',
      data: { id: event_id },
      success: function(data) {
        data = $.parseJSON(data);        
        var msgData = data.task_name;
        var startDate = data.task_date+"T"+data.task_time;
        var endDate = data.task_end_date+"T"+data.task_end_time;
        var title = data.task_name;        
        var icsMSG1 = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nPRODID:https://www.google.com/\r\nBEGIN:VEVENT\r\nUID:https://www.google.com/\r\nDTSTAMP:" + msgData + "Z\r\nDTSTART:" + startDate + "\r\nSUMMARY:" + data.task_name + "\r\nDESCRIPTION:" + data.task_description + "\r\nLOCATION:" + data.task_address + "\r\n";
        var icsMSG2 = '';
        if(endDate != '') {
            icsMSG2 = "DTEND:" + endDate +"\r\n";
        }
        icsMSG3 = "SUMMARY:" + title + "\r\nEND:VEVENT\r\nEND:VCALENDAR";
        icsMSG = icsMSG1 + icsMSG2 + icsMSG3;

        


        window.open( "data:text/calendar;charset=utf8," + icsMSG);       
      }
    });

    

  });

    let is_view = $("#is_view").val();
    if(is_view!='') {
        let id = is_view;
        var ImageViewPath = '<?php echo base_url(CalendarPath); ?>';
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url().FRONTEND.'Calendar/getCalItem' ?>',
            data: { id: id },
            success: function(data) {
                data = $.parseJSON(data);
                $('#show-category').modal();
                $('#show-category').find('#task_name').html(data.task_name);
                $('#show-category').find('#task_description').html(nl2br(data.task_description));
                $('#show-category').find('#task_date').html(data.task_date);
                $('#show-category').find('#task_end_date').html(data.task_end_date);
                $('#show-category').find('#task_time').html(data.task_time);
                $('#show-category').find('#task_time_end').html(data.task_end_time);
                $('#show-category').find('#fb').attr('data-share_id',data.calId);
                $('#show-category').find('#twitt').attr('data-share_id',data.calId);
                $('#show-category').find('#task_address').html(nl2br(data.task_address));
                $('#show-category').find('#ics').attr("data-id",data.calId);

                if(data.rsvp_date != '0000-00-00') {
                    $('#show-category').find('#rsvp_date_div').show();
                    $('#show-category').find('#rsvp_date').html(data.rsvp_date);
                }
                else {
                    $('#show-category').find('#rsvp_date_div').hide();
                    $('#show-category').find('#rsvp_date').html('');
                }
                if(data.rsvp_contact != '') {
                    $('#show-category').find('#rsvp_contact_div').show();
                    $('#show-category').find('#rsvp_contact').html(data.rsvp_contact);
                }
                else {
                    $('#show-category').find('#rsvp_contact_div').hide();
                    $('#show-category').find('#rsvp_contact').html('');
                }

                var copy_link = '<?php echo base_url('calendar/view/') ?>' + data.calId;
                $('#show-category').find('#copy').attr('data-value',copy_link);

                var event_cost = data.task_cost;
                $('#show-category').find('#cost_price').html(event_cost);
              
                var data_school = '';
                if(data.task_school_tag!='') {
                    get_school(data.task_school_tag);
                }
                
                if(data.task_type!='') {
                    get_event(data.task_type);
                }
                
                var UEmail = $("#user_email").val();
              
                var body_contain = '';
                body_contain += ' Event Name : '         + data.task_name;
                body_contain += '\n Start Date-Time : '    + data.task_date + ' ' + data.task_time;
                body_contain += '\n End Date-Time : '   + data.task_end_date + ' ' + data.task_end_time;
                body_contain += '\n School : '   + data.name;
                body_contain += '\n Cost : '   + event_cost;
                body_contain += '\n Description : \n'      + data.task_description;
                body_contain += '\n Location : \n'         + data.task_address;
              
                body_contain = encodeURI(body_contain);
              
                var email_details = 'mailto:'+UEmail+'?&subject='+data.task_name+'&body='+ body_contain;

                $('#show-category').find('#email_link').attr('href',email_details);
                
                if(data.attachment!=''){
                    $('#ImageView').show();
                    $('#show-category').find('#ImageView').attr('src', ImageViewPath+data.attachment);
                    $('#ImageView').error(function() {
                        $('#ImageView').hide();
                    });
                }
                else {
                    $('#show-category').find('#ImageView').hide();
                }
            }
        });
    }

  $("form[name='create_task']").validate({
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
    submitHandler: function(form) {
      form.submit();
    }
  });

  $('#create_task').on('submit',function(e) {
    e.preventDefault();
    let PaypalURL = '<?php echo base_url().'user/Calendar/buy/'.$this->session->USER['UId'].'/'; ?>';
    $.ajax({
      type: 'POST',
      url: '<?= base_url('save_task'); ?>',
      data:new FormData(this),
      enctype: 'multipart/form-data', 
      contentType: false,
      cache: false,  
      processData:false,
      dataType: 'json',
      success: function(data) {
        if(data.success) {
          /*$('#form-step-1').hide();
          $("#paypal_url").attr('href', PaypalURL + data.last_id);
          $('#paypal-div').show();*/
          $('#add-category').modal('hide');
          $('#create_task')[0].reset();
          if(data.success) {
            swal('Success !',data.msg,'success');
          }
          else {
            swal('Error !',data.msg,'error');
          }
        }
      }
    });
    // return false;
  });

});
</script>
<!-- Page specific script -->
<script>
    $(".run_filter").on("change",function(){
      get_event_data();
    });
    get_event_data();
    upcoming_event();
    function get_event_data() {
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url().FRONTEND.'calendar/get_all_event' ?>',
        data : $('#filter_form').serialize(),
        dataType : 'json',
        success:function(data) {
          var date = new Date()
          var d    = date.getDate(),
              m    = date.getMonth(),
              y    = date.getFullYear()

              $('#calendar').fullCalendar({
                    header    : {
                      left  : 'prev,next today',
                      center: 'title',
                      right : 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                      today: 'today',
                      month: 'month',
                      week : 'week',
                      day  : 'day'
                    },
                    //Random default events
                    // events : events
                    // events    :events,
                    events    :data,
                    editable  : false,
                    droppable : false, // this allows things to be dropped onto the calendar !!!
                    drop      : function (date, allDay) { // this function is called when something is dropped

                      // retrieve the dropped element's stored Event Object
                      var originalEventObject = $(this).data('eventObject')

                      // we need to copy it, so that multiple events don't have a reference to the same object
                      var copiedEventObject = $.extend({}, originalEventObject)

                      // assign it the date that was reported
                      copiedEventObject.start           = date
                      copiedEventObject.allDay          = allDay
                      // copiedEventObject.backgroundColor = $(this).css('background-color')
                      // copiedEventObject.borderColor     = $(this).css('border-color')

                      // render the event on the calendar
                      // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                      // is the "remove after drop" checkbox checked?
                      if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove()
                      }

                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        let id = calEvent.id;
                        var ImageViewPath = '<?php echo base_url(CalendarPath); ?>';
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url().FRONTEND.'Calendar/getCalItem' ?>',
                            data: { id: id },
                            success: function(data) {
                                data = $.parseJSON(data);
                                $('#show-category').modal();
                                $('#show-category').find('#task_name').html(data.task_name);
                                $('#show-category').find('#task_description').html(nl2br(data.task_description));
                                $('#show-category').find('#task_date').html(data.task_date);
                                $('#show-category').find('#task_end_date').html(data.task_end_date);
                                $('#show-category').find('#task_time').html(data.task_time);
                                $('#show-category').find('#task_time_end').html(data.task_end_time);
                                $('#show-category').find('#fb').attr('data-share_id',data.calId);
                                $('#show-category').find('#twitt').attr('data-share_id',data.calId);
                                $('#show-category').find('#task_address').html(nl2br(data.task_address));
                                $('#show-category').find('#ics').attr("data-id",data.calId);

                                if(data.rsvp_date != '0000-00-00') {
                                    $('#show-category').find('#rsvp_date_div').show();
                                    $('#show-category').find('#rsvp_date').html(data.rsvp_date);
                                }
                                else {
                                    $('#show-category').find('#rsvp_date_div').hide();
                                    $('#show-category').find('#rsvp_date').html('');
                                }
                                if(data.rsvp_contact != '') {
                                    $('#show-category').find('#rsvp_contact_div').show();
                                    $('#show-category').find('#rsvp_contact').html(data.rsvp_contact);
                                }
                                else {
                                    $('#show-category').find('#rsvp_contact_div').hide();
                                    $('#show-category').find('#rsvp_contact').html('');
                                }
                                
                                var copy_link = '<?php echo base_url('calendar/view/') ?>' + data.calId;
                                $('#show-category').find('#copy').attr('data-value',copy_link);

                                var event_cost = data.task_cost;
                                $('#show-category').find('#cost_price').html(event_cost);
                          
                                var data_school = '';
                                if(data.task_school_tag!='') {
                                    get_school(data.task_school_tag);
                                }
                                
                                if(data.task_type!='') {
                                    get_event(data.task_type);
                                }
                            
                                var UEmail = $("#user_email").val();
                          
                                var body_contain = '';
                                body_contain += ' Event Name : '         + data.task_name;
                                body_contain += '\n Start Date-Time : '    + data.task_date + ' ' + data.task_time;
                                body_contain += '\n End Date-Time : '   + data.task_end_date + ' ' + data.task_end_time;
                                body_contain += '\n School : '   + data.name;
                                body_contain += '\n Cost : '   + event_cost;
                                body_contain += '\n Description : \n'      + data.task_description;
                                body_contain += '\n Location : \n'         + data.task_address;
                          
                                body_contain = encodeURI(body_contain);
                          
                                var email_details = 'mailto:'+UEmail+'?&subject='+data.task_name+'&body='+ body_contain;

                                $('#show-category').find('#email_link').attr('href',email_details);
                                if(data.attachment!=''){
                                    $('#ImageView').show();
                                    $('#show-category').find('#ImageView').attr('src', ImageViewPath+data.attachment);
                                    $('#ImageView').error(function() {
                                        $('#ImageView').hide();
                                    });
                                }
                                else {
                                    $('#show-category').find('#ImageView').hide();
                                }
                            }
                        });
                    }

              });
            
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar( 'addEventSource', data );

            

            

            
        }

      });
    }

    function get_event(task_type) {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url().FRONTEND.'Calendar/get_event' ?>',
        data: { task_type: task_type },
        success: function(html) {
          if(html!='') {
            $("#event_type").html(html);
          }
          
        }
      });
    }

    function get_school(school_id) {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url().FRONTEND.'Calendar/get_school' ?>',
        data: { school_id: school_id },
        success: function(data) {
          data_school = $.parseJSON(data);
          $('#show-category').find('#task_school_tag').html(data_school);
          // $('#school_name').val(data_school);
        }
      });
    }


    function upcoming_event() {
      var school_id = $("#school_id").val();
      $.ajax({
        url : '<?php echo base_url().FRONTEND.'calendar/get_upcomint_event' ?>',
        type : 'POST',
        data : { school_id : school_id },
        dataType : 'html',
        success : function(html) {
          if(html!=''){
            $("#upcoming_event").html(html);
          }
        }
      });
    }
    

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

  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        /*$(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })*/

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    
    

    

    
    $("#fb").on('click',function(e){
      let share_id = $(this).attr('data-share_id');
      let url = "<?php echo base_url('calendar/view/') ?>" + share_id;
      var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'facebook-popup', 'height=350,width=600');
      if(facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    });


    $("#twitt").on('click',function(e){

      let share_id = $(this).attr('data-share_id');
      let url = "<?php echo base_url('calendar/view/') ?>" + share_id;      
      var twitterWindow = window.open('https://twitter.com/share?url=' + url, 'twitter-popup', 'height=350,width=600');
      if(twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    });

   

    

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  });
  function nl2br (str, is_xhtml) {   
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
  }
</script>