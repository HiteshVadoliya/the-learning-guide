<?php
$this->table = 'tbl_rating';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<form id="export_schools" method="post" action="<?php echo ADMIN_LINK.'Exportschool/export' ?>">
  
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>User Name</td>
         <?php if($type=='school') {
          ?><td>School</td><?php
         } else if($type=='teacher') {
          ?><td>Teacher</td><?php
         }
         ?>
         <td>Rating</td>
         <td>Review</td>
         <td>Status</td>
         <td>Action</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $school) {
         $i++;
         $action = "";
         $action .= '<button type="button" class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'School/deleteData" data-id="'.$school['id'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
         $checked = '';

         if($school['status'] == 1) {
            $checked = 'checked=""';
         }

         
         if($school['status'] == 1){

            $status = '<div class="material-switch tex-center"  >
                <input class="schoolStatus" id="status'.$school['id'].'" name="status" data-id="'.$school['id'].'" type="checkbox" '.$checked.' value="0" />
                <label for="status'.$school['id'].'" class="label-primary"></label>
            </div>';


         }else{

            
               $status = '<div class="material-switch tex-center">
                <input id="status'.$school['id'].'" name="status" class="schoolStatus" data-id="'.$school['id'].'" type="checkbox" '.$checked.' value="0"   />
                <label for="status'.$school['id'].'" class="label-primary"></label>
            </div>';
         }

         if($type=='school') {
           $school_name = $this->common->get_one_row("tbl_school",array("id"=>$school['schoolId']));
           $new_name = $school_name['name'];
         } else if($type=='teacher') {
           $school_name = $this->common->get_one_row("tbl_teacher",array("id"=>$school['teacherId']));
           $new_name = $school_name['title'].". ".$school_name['fname']." ".$school_name['lname'];
         }
      ?>
      <tr>
         <td><?php echo $school['fname']." ".$school['lname'] ?></td>
         <td><?php echo $new_name; ?></td>
         <td><?php echo $school['rating'] ?></td>
         <td><?php echo $school['review'] ?></td>
         <td><?php echo $status ?></td>
         <td><?php echo $action ?></td>
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
   $('.schoolStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      schoolId = $(this).attr('data-id');
      school = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+school+"?",
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
            changestatus(status,schoolId);
            // swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+schoolId).prop('checked',status);
         } 
      });
      
   });

   
});


function changestatus(status,schoolId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Review/changeStatus/' ?>',
      data: { status: status, Id: schoolId },
      success: function(data) {
         data = jQuery.parseJSON(data);
         swal("Success", data.message, "success");
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