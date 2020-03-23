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
$this->table = 'tbl_school';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<form id="export_schools" method="post" action="<?php echo ADMIN_LINK.'Exportschool/export' ?>">
<!--   <div>
    <button id="exportSchoolBtn" class="btn btn-primary">Export Schools</button>
  </div> -->
<table class="table table-responsive Table">
   <thead>
      <tr>
         <!-- <td><input type="checkbox" name="select_all_school" id="select_all_scholl"></td> -->
         <td>Name</td>
         <td>Type</td>
         <td>Principal Name</td>
         <td>Enrolment Officer</td>
         <td>Is Approved</td>
         <td align="center" id="get_sponsored" data-id="1">Sponsored</td>
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
         /*$typeArr = array(0=>'Primary',1=>'Secondary',2=>'Tertiary',3=>'Special School');
         $type = $typeArr[$school['type']];*/
         $type = $school['type'];
         if($type != '0') {

            $type = str_replace(',', ', ', $type);
            $type = str_replace('_', ' ', $type);
            $type = ucwords($type);
         }
         else {

            $type = '--';
         }

         $action = '<a href="'.ADMIN_LINK.'add-school/'.$school['id'].'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a> ';
         $action .= '<button type="button" class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'School/deleteData" data-id="'.$school['id'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
         $checked = '';
         if($school['status'] == 1) {
            $checked = 'checked=""';
         }

         
         if($school['approval'] == 2){

            $status = '<div class="material-switch tex-center"  style="pointer-events: none;">
                <input id="status'.$school['id'].'" name="status" data-id="'.$school['id'].'" type="checkbox" '.$checked.' value="0"  disabled="disabled" />
                <label for="status'.$school['id'].'" class="label-primary"></label>
            </div>';

            $approved = '<div class="material-switch tex-center">
                            <input id="status'.$school['id'].'" name="status" class="schoolApproved" data-reference-name="'.$school['reference_by'].'" data-reference-email="'.$school['reference_email'].'" data-id="'.$school['id'].'" data-value="'.$school['name'].'" type="checkbox" '.$checked.' value="0" />
                            <label for="status'.$school['id'].'" class="label-primary"></label>
                        </div>';
            

         }else{

            $approved = '<span class="btn btn-xs btn-success">Approved</span>';

               $status = '<div class="material-switch tex-center">
                <input id="status'.$school['id'].'" name="status" class="schoolStatus" data-id="'.$school['id'].'" data-value="'.$school['name'].'" type="checkbox" '.$checked.' value="0"   />
                <label for="status'.$school['id'].'" class="label-primary"></label>
            </div>';
         }


         $ischecked = $school["is_sponsored"] == '1' ? 'checked="checked"' : '';

         $is_fetured = '<div class="checkbox checkbox-success"><input class="changeFeatured" data-id="'.$school['id'].'" data-status="'.$school['is_sponsored'].'"  type="checkbox"  '.$ischecked.' id="switch'.$school["id"].'" switch="bool"/><label for="switch'.$school['id'].'" data-on-label="Yes" data-off-label="No"></label></div>';

      ?>
      <tr>
         <!-- <td><input type="checkbox" name="select_school[]" value="<?php echo $school['id']; ?>"></td> -->
         <td><?php echo $school['name'] ?></td>
         <td><?php echo $type ?></td>
         <td><?php echo $school['principal'] ?></td>
         <td><?php echo $school['enrolments_officer'] ?></td>
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
  $("#get_sponsored").on("click",function(){
    var data_id = $("#is_sponsored_filter").val();
    console.log(data_id);
    if(data_id==1) {
      $("#is_sponsored_filter").val("0");
      $("#keywords").val("sponsored");
    } else {
      $("#is_sponsored_filter").val("1");
      $("#keywords").val("");
    }
    gettour();
  });
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

    $('#exportSchoolBtn').on('click',function(e) {
      e.preventDefault();
      var ids = [];
      if($('input[name="select_school[]"]:checked').length > 0) {
        $('input[name="select_school[]"]:checked').each(function(){
          ids.push( $(this).val() );
        });

        $('#export_schools').submit();
        /*$.ajax({
          type: 'POST',
          url:'<?php echo ADMIN_LINK.'Exportschool/export' ?>',
          data: { ids : ids },
          dataType: 'html',
          success: function(data) {

          }
        });*/
      }
      else {
        alert('You have to select At least one school to export');
      }
    });
});


function changestatus(status,schoolId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'School/changeStatus/school' ?>',
      data: { status: status, schoolId: schoolId },
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

 $('.schoolApproved').on('change',function() {

      var status = '0';
      schoolId = $(this).attr('data-id');
      school = $(this).attr('data-value');
      reference_by = $(this).attr('data-reference-name');
      reference_email = $(this).attr('data-reference-email');
      
      swal({
         title: "Are you sure you want to proceed?",
         // text: "Your approval will create a school for "+school+".",
         text: "Your approval will create a profile for "+school+".",
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
            approvedstatus(status,schoolId,reference_by,reference_email);
            swal("Success", "A Profile has been created.", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+schoolId).prop('checked',status);
         } 
      });
      
  });

  function approvedstatus(status,schoolId,reference_by,reference_email)
  {
     $.ajax({
        type: 'POST',
        url: '<?php echo ADMIN_LINK.'Teacher/approve/school' ?>',
        data: { status: status, schoolId: schoolId, reference_by: reference_by, reference_email: reference_email },
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

  $('#select_all_scholl').on("change", function() {
     $('input[name="select_school[]"]').not(this).prop('checked', this.checked);
  });

  $('input[name="select_school[]"]').click(function(){
    if($('input[name="select_school[]"]').length == $('input[name="select_school[]"]:checked').length) {
      $("#select_all_scholl").attr("checked", "checked");
    } else {
      $("#select_all_scholl").removeAttr("checked");
    }
  });

  $('.changeFeatured').on('change',function() {

      status = $(this).attr('data-status');
      schoolId = $(this).attr('data-id');
      
      if(status == 1){ 
            var title = "Remove Featured School";
            // var text = "You want to remove featured from school ";
            var text = "Are you sure you want to proceed? ";
            status = 0;
      }else{
            var title = "Add Featured School";
            // var text = "You want to featured this school";
            var text = "Are you sure you want to proceed? ";
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
            featured_status(status,schoolId);
            status = (status == '1') ? true : false;
            $('#status'+schoolId).prop('checked',status);
            // swal("Success", "School has been featured successfully..", "success");
         } else {
            $('#switch'+schoolId).prop('checked', false);
         } 
      });
      
   });

function featured_status(status,schoolId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'School/is_featured' ?>',
      data: { status: status, schoolId: schoolId },
      success: function(data) {
         data = jQuery.parseJSON(data);
          if(data.success) {
            swal("Success", data.message, "success");
          }
          else {
            swal("Error", data.message, "error");
          }
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