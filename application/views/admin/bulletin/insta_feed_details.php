<style>
   .pagination { float: right; }
</style>
<section class="content-header">
   <h1><i class="fa fa-users"></i>&nbsp;Proposed bulletin story Details</h1>
</section>

<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">Proposed bulletin story</h3>
         <!-- <div class="pull-right">
            <a href="<?= base_url(ADMIN.'add-bulletin') ?>" class="btn btn-info btn-flat"> <i class="fa fa-plus"> </i> Add Bulletin</a>
         </div> -->
      </div>
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <table class="table table-responsive table-striped">
                  <tr>
                     <td>
                        <label>Name</label>
                     </td>
                     <td>
                        <?php
                        echo ucwords($review['review_fname'].' '.$review['review_lname']);
                        ?>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Email</label>
                     </td>
                     <td>
                        <?php echo $review['review_email']; ?>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Message</label>
                     </td>
                     <td>
                        <?php echo $review['review_message']; ?>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Attached File(s)</label>
                     </td>
                     <td>
                        <?php
                        if($review['review_file'] != '') {
                           $json = json_decode($review['review_file']);
                           if(is_null($json)) {
                              $path = 'assets/uploads/bulletin/'.$review['review_file'];
                           ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <img src="<?php echo base_url($path) ?>" alt="Review Image" height="100px">
                              </div>
                           </div>
                           <?php
                           }
                           else {
                           ?>
                           <div class="row">
                              <?php
                              foreach ($json as $file) {
                                 $path = 'assets/uploads/bulletin/'.$file;
                              ?>
                              <div class="col-md-3">
                                 <img src="<?php echo base_url($path) ?>" alt="Review Image" height="100px">
                              </div>
                              <?php
                              }
                              ?>
                           </div>
                           <?php
                           }
                        }
                        ?>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Date</label>
                     </td>
                     <td>
                        <?php echo date('d M Y H:i A',strtotime($review['created_date'])); ?>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         
      </div><!-- /.box-body -->
   </div><!-- /.box -->
</section>
   
<script type="text/javascript">
$(document).ready(function(){
   load_ajex_loader('<?= ADMINPATH.'images/ajax-loader.gif'; ?>','Loading Please Wait...');
   gettour();
});
function gettour(page_num) {
   page_num = page_num?page_num:0;
   var perpage = $('#PerPage').val();
   var keywords = $('#keywords').val();
   $.ajax({
      type: 'POST',
      url: '<?php echo base_url(ADMIN); ?>Bulletin/ajax_insta_feed/'+page_num,
      data:'page='+page_num+'&perpage='+perpage+'&keywords='+keywords,
      success: function (html) {
         $('#tourList').html(html);
         $(".Table").DataTable({
            "bAutoWidth": false,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "columnDefs" : [
              { "targets": 0, "visible": false }
            ],
            "aaSorting": [[0, 'desc']],
            "aoColumns": [
               { "sWidth": "10%" },
               { "sWidth": "10%" },
               { "sWidth": "30%" },
               { "sWidth": "10%" },
               { "sWidth": "25%" },
               { "sWidth": "15%" },
               // { "sWidth": "15%" },
               { "sWidth": "15%","bSortable": false }
            ]
         });
      }
   });
}
</script>