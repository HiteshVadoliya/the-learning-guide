<?php
$this->table = 'tbl_newsletter';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>First Name</td>
         <td>Last Name</td>
         <td>Email</td>
         <td>State</td>
         <td>Profession</td>
         <td>Date</td>
         <td>Status</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $newsletter) {
         $i++;
         $checked = '';
         if($newsletter['status'] == 1) {
            $checked = 'checked=""';
         }
         $status = '<div class="material-switch tex-center">
             <input id="status'.$newsletter['id'].'" name="status" class="newsletterStatus" data-id="'.$newsletter['id'].'" data-value="'.$newsletter['email'].'" type="checkbox" '.$checked.' value="0" />
             <label for="status'.$newsletter['id'].'" class="label-primary"></label>
         </div>';
      ?>
      <tr>
         <td><?php echo $newsletter['fname']; ?></td>
         <td><?php echo $newsletter['lname']; ?></td>
         <td><?php echo $newsletter['email']; ?></td>
         <td><?php echo $newsletter['name']; ?></td>
         <td><?php echo $newsletter['profession']; ?></td>
         <td><?php echo date('d-m-Y',strtotime($newsletter['created_date'])); ?></td>
         <td><?php echo $status; ?></td>
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

   /**/
   $('.newsletterStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      newsletterId = $(this).attr('data-id');
      newsletter = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+newsletter+"?",
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
            changestatus(status,newsletterId);
            swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+newsletterId).prop('checked',status);
         } 
      });
      
   });

});


function changestatus(status,newsletterId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Contact/changeStatus/newsletter' ?>',
      data: { status: status, newsletterId: newsletterId },
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