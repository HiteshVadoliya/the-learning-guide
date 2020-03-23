<?php
$this->table = 'tbl_contact';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>Name</td>
         <td>Subject</td>
         <td>Email</td>
         <td>Phone</td>
         <td>Message</td>
         <td>Date</td>
         <td>Follow Up</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $contact) {
         $i++;
         $checked = '';
         if($contact['follow_up'] == 1) {
            $checked = 'checked=""';
         }
         $status1 = '<div class=" tex-center">
             <input id="status'.$contact['id'].'" name="status" class="contactStatus" data-id="'.$contact['id'].'" data-value="'.$contact['name'].'" type="checkbox" '.$checked.' value="0" />
             <label for="status'.$contact['id'].'" class="label-primary"></label>
         </div>';
         $status = '<div class="checkbox">
            <label style="font-size: 1.5em">
               <input id="status'.$contact['id'].'" type="checkbox" name="status" class="contactStatus" data-id="'.$contact['id'].'" data-value="'.$contact['name'].'" value="'.$contact['follow_up'].'" '.$checked.'>
               <span class="cr"><i class="cr-icon fa fa-check"></i></span>
            </label>
         </div>';
      ?>
      <tr>
         <td><?php echo ucwords($contact['name']); ?></td>
         <td><?php echo $contact['subject']; ?></td>
         <td><?php echo $contact['email']; ?></td>
         <td><?php echo $contact['phone']; ?></td>
         <td>
            <?php
            $string = $contact['message'];
            $string = strip_tags($string);
            if (strlen($string) > 50) {
               $stringCut = substr($string, 0, 50);
               $endPoint = strrpos($stringCut, ' ');
               $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
               $string .= '... <a href="'.base_url(ADMIN).'view-contact/'.md5($contact['id']).'">Read More</a>';
            }
            echo $string;
            ?>
         </td>
         <td><?php echo date('d-m-Y',strtotime($contact['created_date'])); ?></td>
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
   $('.contactStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      contactId = $(this).attr('data-id');
      contact = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+contact+"?",
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
            changestatus(status,contactId);
            swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+contactId).prop('checked',status);
         } 
      });
      
   });
});

function changestatus(status,contactId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Contact/changeStatus/contact' ?>',
      data: { status: status, contactId: contactId },
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