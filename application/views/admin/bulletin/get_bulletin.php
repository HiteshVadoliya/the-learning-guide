<?php
$this->table = 'tbl_bulletin';
$tablename = base64_encode($this->table);
$tableId = base64_encode('id');
?>
<table class="table table-responsive Table">
   <thead>
      <tr>
         <td>Image</td>
         <td>Description</td>
         <td>Title</td>
         <td>Date</td>
         <td>Status</td>
         <td>Action</td>
      </tr>
   </thead>
   <tbody>
   <?php
   if(count($tours)) { 
      $i = 0;
      foreach ($tours as $key => $bulletin) {
         $i++;
         $action = '<a href="'.ADMIN_LINK.'add-bulletin/'.$bulletin['id'].'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a> ';
         $action .= '<button class="btn btn-icon waves-effect btn-sm btn-danger rowDelete ajaxTable" data-url="'.ADMIN_LINK.'Bulletin/deleteData" data-id="'.$bulletin['id'].'" data-td="'.$tablename.'" data-i="'.$tableId.'"> <i class="fa fa-trash"></i> </button> ';
         $checked = '';
         if($bulletin['status'] == 1) {
            $checked = 'checked=""';
         }
         $status = '<div class="material-switch tex-center">
             <input id="status'.$bulletin['id'].'" name="status" class="bulletinStatus" data-id="'.$bulletin['id'].'" data-value="'.$bulletin['title'].'" type="checkbox" '.$checked.' value="0" />
             <label for="status'.$bulletin['id'].'" class="label-primary"></label>
         </div>';
      ?>
      <tr>
         <td>
            <?php
            if(isset($bulletin) && $bulletin['image'] != '' && file_exists(BlogPath.$bulletin['image'])) {
            ?>
            <img src="<?php echo base_url().BlogPath.$bulletin['image']; ?>" alt="..." class="img-thumbnail">
            <?php
            }
            else {
            ?>
            <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="..." class="img-thumbnail">
            <?php
            }
            ?>
         </td>
         <td>
            <?php
            $string = $bulletin['description'];
            $string = strip_tags($string);
            if (strlen($string) > 50) {
               $stringCut = substr($string, 0, 50);
               $endPoint = strrpos($stringCut, ' ');
               $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
               $string .= '... <a href="'.base_url(ADMIN).'add-bulletin/'.$bulletin['id'].'">Read More</a>';
            }
            echo $string;
            ?>
         </td>
         <td><?php echo ucwords($bulletin['title']); ?></td>
         <td><?php echo date('d-m-Y',strtotime($bulletin['created_date'])); ?></td>
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

<script type="text/javascript">
$(document).ready(function() {

   /**/
   $('.bulletinStatus').on('change',function() {

      var status = $(this).prop('checked') ? '1' : '0';
      bulletinId = $(this).attr('data-id');
      bulletin = $(this).attr('data-value');
      
      swal({
         title: "Are you sure?",
         text: "Are you sure you want to change status for "+bulletin+"?",
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
            changestatus(status,bulletinId);
            swal("Success", "Status has been changed successfully..", "success");
         }
         else {
            status = (status == '1') ? false : true;
            $('#status'+bulletinId).prop('checked',status);
         } 
      });
      
   });

});


function changestatus(status,bulletinId)
{
   $.ajax({
      type: 'POST',
      url: '<?php echo ADMIN_LINK.'Bulletin/changeStatus/bulletin' ?>',
      data: { status: status, bulletinId: bulletinId },
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