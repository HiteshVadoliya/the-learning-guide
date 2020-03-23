<?php
$this->table = 'tbl_calendar';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<style type="text/css">
   
   .checkbox input[type="checkbox"] {
       cursor: pointer;
       opacity: 0;
       z-index: 1;
       outline: none !important;
   }
   .checkbox-success input[type="checkbox"]:checked + label::before {
       background-color: #4bd396;
       border-color: #4bd396;
   }

   .checkbox label::before {
       -o-transition: 0.3s ease-in-out;
       -webkit-transition: 0.3s ease-in-out;
       background-color: #ffffff;
       border-radius: 2px;
       border: 1px solid #dadada;
       content: "";
       display: inline-block;
       height: 17px;
       left: 0;
       margin-left: -20px;
       position: absolute;
       transition: 0.3s ease-in-out;
       width: 22px;
       outline: none !important;
       margin-top: 2px;
   }

   .checkbox-success input[type="checkbox"]:checked + label::after {
       color: #ffffff;
   }
   .checkbox input[type="checkbox"]:checked + label::after {
       content: "Yes";
       font-family: 'Material Design Icons';
       font-weight: bold;
   }
   .checkbox label::after {
       color: #797979;
       display: inline-block;
       font-size: 11px;
       height: 16px;
       left: 0;
       margin-left: -20px;
       padding-left: 3px;
       padding-top: 1px;
       position: absolute;
       top: 2px;
       width: 16px;
       content: "No";
   }
</style>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>Image</td>
         <td>User</td>
         <td>Event Name</td>
         <td>Description</td>
         <td>Date</td>
         <td>Time</td>
         <td>Status</td>
         <td>Action</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $calendar) {

         /*if($calendar['status'] == 1) {
         }*/
         $attachment = '<img src="'.base_url().CalendarPath.'default.jpg" width="100px" >';
         if($calendar['attachment']!='' && file_exists(CalendarPath.$calendar['attachment']) ) {
          $attachment = '<img src="'.base_url().CalendarPath.$calendar['attachment'].'" width="100px" >';
         }
        $checked = '';

         if($calendar['approval'] == 2 ){
            $status = '<div class="material-switch tex-center"  style="pointer-events: none;">
                <input id="status'.$calendar['calid'].'" name="status" data-id="'.$calendar['calid'].'" type="checkbox" '.$checked.' value="0"  disabled="disabled" />
                <label for="status'.$calendar['calid'].'" class="label-primary"></label>
            </div>';

            $approved = '<div class="material-switch tex-center">
                            <input id="status'.$calendar['calid'].'" name="status" class="TaskApproval" data-CalId="'.$calendar['calid'].'" data-UserId="'.$calendar['userid'].'" type="checkbox" '.$checked.' value="0" />
                            <label for="status'.$calendar['calid'].'" class="label-primary"></label>
                        </div>';
            

         }else{

            $approved = '<span class="btn btn-xs btn-success">Approved</span>';
               $status = '<div class="material-switch tex-center">
                <input id="status'.$calendar['calid'].'" name="status" class="calendarStatus" data-id="'.$calendar['calid'].'" data-value="'.$calendar['fname'].' '.$calendar['lname'].'" type="checkbox" '.$checked.' value="0"   />
                <label for="status'.$calendar['calid'].'" class="label-primary"></label>
            </div>';
         }
         $action = '';
         $action .= '<a href="'.ADMIN_LINK.'add-calendar/'.$calendar['calid'].'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a> ';
         $action .= '<button class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'Calendar/deleteData" data-id="'.$calendar['calid'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
      ?>
      <tr>
         <td><?php echo $attachment; ?></td>
         <td><?php echo $calendar['fname']." ".$calendar['lname']; ?></td>
         <td><?php echo $calendar['task_name']; ?></td>
         <td><?php echo $calendar['task_description']; ?></td>
         <td><?php echo date('d-m-Y',strtotime($calendar['task_date'])); ?></td>
         <td><?php echo date('H:i:s',strtotime($calendar['task_time'])); ?></td>
         <td><?php echo $approved; ?></td>
         <td><?php echo $action; ?></td>
      </tr>
      <?php
      } 
   }
   ?>
   </tbody>
</table>
<div class="row">
   <div class="col-md-12">
      <?php echo $this->ajax_pagination->create_links(); ?>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

   $('.TaskApproval').on('change',function() {

      var status = '1';
      CalId = $(this).attr('data-CalId');
      UserId = $(this).attr('data-UserId');
      
      
      swal({
         title: "Are you sure you want to proceed? ",
         text: "Once approved, this event will go live.",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes!",
         cancelButtonText: "No",
         closeOnConfirm: false,
         closeOnCancel: true
      }, 
      function (isConfirm) {    
         if (isConfirm) {
            approvedstatus(CalId,UserId,status);
            swal("Success", "An event has been created.", "success");
         }
         else {
            $('#status'+CalId).prop('checked',false);
         } 
      });
      
   });

});



function approvedstatus(CalId,UserId,status)
  {
     $.ajax({
        type: 'POST',
        url: '<?php echo ADMIN_LINK.'Calendar/approve' ?>',
        data: { CalId: CalId, UserId: UserId,status:status },
        success: function(data) {
           data = jQuery.parseJSON(data);
           let abc = $('.pagination .active a').text();
           if(abc >= 1) {
              abc -= 1;
           }
           let pagenum = abc * 10;
           gettour(pagenum);
        }
     });
  }

</script>