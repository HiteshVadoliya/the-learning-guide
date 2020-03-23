<?php
$this->table = 'tbl_bulletin_review';
$tablename = base64_encode($this->table);
$tableId = base64_encode('review_id');
?>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>ID</td>
         <td>Name</td>
         <td>Email</td>
         <td>Message</td>
         <td>Date</td>
         <!-- <td>Status</td> -->
         <td>Followed Up</td>
         <td>Action</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $review) {
         $i++;
         $action = '<button class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'Bulletin/deleteData" data-id="'.$review['review_id'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
         $checked = '';
         if($review['status'] == 1) {
            $checked = 'checked=""';
         }
         $status = '<div class="material-switch tex-center">
             <input id="status'.$review['review_id'].'" name="status" class="bulletinReviewStatus" data-id="'.$review['review_id'].'" data-value="'.$review['review_fname'].'" type="checkbox" '.$checked.' value="0" />
             <label for="status'.$review['review_id'].'" class="label-primary"></label>
         </div>';
      ?>
      <tr>
         <td><?php echo $review['review_id'] ?></td>
         <td><?php echo ucwords($review['review_fname'].' '.$review['review_lname']); ?></td>
         <td><?php echo $review['review_email']; ?></td>
         <td>
            <?php
            $string = $review['review_message'];
            $string = strip_tags($string);
            if (strlen($string) > 50) {
               $stringCut = substr($string, 0, 50);
               $endPoint = strrpos($stringCut, ' ');
               $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
               // $string .= '... <a href="javascript:void(0);" class="read_more" data-id="'.$review['review_id'].'">Read More</a>';
               $string .= '... <a href="'.base_url(ADMIN.'insta-feed-details/'.$review['review_id']).'">Read More</a>';
            }
            echo $string;
            ?>
         </td>
         <td><?php echo date('d-m-Y',strtotime($review['created_date'])); ?></td>
         <td><?php echo $status; ?></td>
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

<!-- The Modal -->
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

   /**/
   $('.bulletinReviewStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      reviewId = $(this).attr('data-id');
      review = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+review+"?",
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
            changestatus(status,reviewId);
            swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+reviewId).prop('checked',status);
         } 
      });
      
   });

});


function changestatus(status,reviewId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Bulletin/changeStatus/review' ?>',
      data: { status: status, reviewId: reviewId },
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