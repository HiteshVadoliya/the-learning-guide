<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'ProductView')); ?>
<style>
  .pagination { float: right; }
</style>
    <section class="content-header">
      <h1>Product</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Product</h3>
        </div>
        <div class="box-body">
          <?php if($showAddButton): ?>
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
                <div id="tourList">
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h4>No Product Found. <a href="<?= base_url(ADMIN.'Product/add') ?>" class="btn btn-success btn-flat"> <i class="fa fa-plus"> </i> Add Product </a></h4> 
              </div>
            </div>
          <?php endif; ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script type="text/javascript">
function myapprove(a) {
  var r = confirm("Are You Sure Want To "+a+" This Product ???");
  if (r == true) {
    return true;
  } else {
    return false;
  }
}
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
    url: '<?php echo base_url(ADMIN); ?>Product/ajaxProductData/'+page_num,
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
            { "sWidth": "15%","bSortable": false }
          ]
        });
    }
  });
}
</script>