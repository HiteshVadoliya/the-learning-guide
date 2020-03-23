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
<?php
$this->table = 'tbl_teacher';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>Name</td>
         <td>Type</td>
         <td>School Where Teaching</td>
         <td>Enrolment Officer</td>
         <td>Is New</td>
         <td>Is Approved</td>
         <!-- <td align="center">Sponsored</td> -->
         <td align="center">Featured</td>
         <td>Status</td>
         <td>Action</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $teacher) {
         $i++;
         $teach_school = $teacher['teach_school'];
         $schoolArr = $this->common->get_one_row('tbl_school',array('id'=>$teach_school));
         $school = $schoolArr['name'];
         $type = $teacher['type'];
         if($type != '0') {
            $type = str_replace(',', ', ', $type);
            $type = str_replace('_', ' ', $type);
            $type = ucwords($type);
         }
         else {

            $type = '--';
         }
         
        $new_teacher = "";
        if($teacher['approval'] == 1){
          $new_teacher = '<span class="label label-info">New</span>';
        }

         $action = '<a href="'.ADMIN_LINK.'add-teacher/'.$teacher['id'].'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a> ';
         $action .= '<button class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'Teacher/deleteData" data-id="'.$teacher['id'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
         $checked = '';
         if($teacher['status'] == 1) {
            $checked = 'checked=""';
         }
         

         if($teacher['approval'] == 2 || $teacher['approval'] == 1){

            $status = '<div class="material-switch tex-center"  style="pointer-events: none;">
                <input id="status'.$teacher['id'].'" name="status" data-id="'.$teacher['id'].'" type="checkbox" '.$checked.' value="0"  disabled="disabled" />
                <label for="status'.$teacher['id'].'" class="label-primary"></label>
            </div>';

            $approved = '<div class="material-switch tex-center">
                            <input id="status'.$teacher['id'].'" name="status" class="teacherApproved" data-reference-name="'.$teacher['reference_by'].'" data-reference-email="'.$teacher['reference_email'].'" data-id="'.$teacher['id'].'" data-value="'.$teacher['fname'].' '.$teacher['lname'].'" type="checkbox" '.$checked.' value="0" />
                            <label for="status'.$teacher['id'].'" class="label-primary"></label>
                        </div>';
            

         }else{
            
            $approved = '<span class="btn btn-xs btn-success">Approved</span>';
               $status = '<div class="material-switch tex-center">
                <input id="status'.$teacher['id'].'" name="status" class="teacherStatus" data-id="'.$teacher['id'].'" data-value="'.$teacher['fname'].' '.$teacher['lname'].'" type="checkbox" '.$checked.' value="0"   />
                <label for="status'.$teacher['id'].'" class="label-primary"></label>
            </div>';
         }

         $ischecked = $teacher["is_sponsored"] == '1' ? 'checked="checked"' : '';

         $is_fetured = '<div class="checkbox checkbox-success"><input class="changeFeatured" data-id="'.$teacher['id'].'" data-status="'.$teacher['is_sponsored'].'" data-value="'.$teacher['fname'].' '.$teacher['lname'].'"  type="checkbox"  '.$ischecked.' id="switch'.$teacher["id"].'" switch="bool"/><label for="switch'.$teacher['id'].'" data-on-label="Yes" data-off-label="No"></label></div>';


      ?>
      <tr>
         <td><?php echo $teacher['name']; ?></td>
         <td><?php echo $type ?></td>
         <td><?php echo $school ?></td>
         <td><?php echo $teacher['fname'] ?></td>
         <td><?php echo $new_teacher ?></td>
         <td><?php echo $approved ?></td>
         <td align="center"><?php echo $is_fetured ?></td>
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
   $('.teacherStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      teacherId = $(this).attr('data-id');
      teacher = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+teacher+"?",
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
            changestatus(status,teacherId);
            // swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+teacherId).prop('checked',status);
         } 
      });
      
   });

   $('.teacherApproved').on('change',function() {

      var status = '0';
      teacherId = $(this).attr('data-id');
      teacher = $(this).attr('data-value');
      reference_by = $(this).attr('data-reference-name');
      reference_email = $(this).attr('data-reference-email');
      
      swal({
         title: "Are you sure you want to proceed? ",
         text: "Your approval will create an account for "+teacher+".",
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
            approvedstatus(status,teacherId,reference_by,reference_email);
            swal("Success", "An account was created", "success");
         }
         else {
            $('#status'+teacherId).prop('checked',false);
         } 
      });
      
   });

});


function changestatus(status,teacherId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Teacher/changeStatus/teacher' ?>',
      data: { status: status, teacherId: teacherId },
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


function approvedstatus(status,teacherId,reference_by,reference_email)
  {
     $.ajax({
        type: 'POST',
        url: '<?php echo ADMIN_LINK.'Teacher/approve/teacher' ?>',
        data: { status: status, teacherId: teacherId, reference_by: reference_by, reference_email: reference_email },
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




$('.changeFeatured').on('change',function() {

      status = $(this).attr('data-status');
      teacherId = $(this).attr('data-id');
      teacher = $(this).attr('data-value');
      
      if(status == 1){ 
            /*var title = "Remove Featured Teacher";
            var text = "You want to remove featured from teacher ("+teacher+") ? ";*/
            var title = "Feature Teacher on homepage ";
            var text = "Are you sure you want to remove this profile from homepage?";
            status = 0;
      }else{
            // var title = "Add Featured Teacher";
            // var text = "You want to featured this teacher : "+teacher+"?";
            var title = "Feature Teacher on homepage ";
            var text = "Are you sure you want to share this profile to the homepage?";
            status = 1;
      }
      swal({
         title: title,
         text: text,
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
            featured_status(status,teacherId);
            swal("Success", "Teacher has been featured successfully..", "success");
         }
         else {
            // status = (status == '1') ? false : true;
            /*status = false;
            $('#status'+teacherId).prop('checked',status);*/
            $('#switch'+teacherId).prop('checked',false);
         } 
      });
      
   });

function featured_status(status,teacherId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Teacher/is_featured' ?>',
      data: { status: status, teacherId: teacherId },
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