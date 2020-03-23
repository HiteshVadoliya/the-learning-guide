<style>
   .pagination { float: right; }
</style>
<section class="content-header">
   <h1><i class="fa fa-users"></i>&nbsp;Contact</h1>
</section>

<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">Contact</h3>
         <?php /* <div class="pull-right">
            <a href="<?= base_url(ADMIN.'add-school') ?>" class="btn btn-info btn-flat"> <i class="fa fa-plus"> </i> Add School</a>
         </div> */ ?>
      </div>
      <div class="box-body">
         <div class="row">
            <div class="col-lg-2">
               <div class="form-group">
                  <select name="PerPage" class="form-control" id="PerPage" onchange="gettour()">
                     <?php $this->load->view(ADMIN.'product/optionperpage'); ?>
                  </select>
               </div>
            </div>
            <div class="col-lg-8">
               <!-- <button class="btn btn-info btn-sm" id="AddData">Add Tour To Category</button> -->
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <input type="text" class="form-control" onkeyup="gettour()" name="keywords" id="keywords" placeholder="Search"/>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 col-lg-12">
               <div id="tourList"></div>
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
      url: '<?php echo base_url(ADMIN); ?>Contact/ajax_contact/'+page_num,
      data:'page='+page_num+'&perpage='+perpage+'&keywords='+keywords,
      success: function (html) {
         $('#tourList').html(html);
         $(".Table").DataTable({
            "bAutoWidth": false,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "aoColumns": [
               { "sWidth": "10%" },
               { "sWidth": "15%" },
               { "sWidth": "20%" },
               { "sWidth": "25%" },
               { "sWidth": "15%" },
               { "sWidth": "15%" },
               // { "sWidth": "15%" },
               { "sWidth": "15%","bSortable": false }
            ]
         });
      }
   });
}
</script>