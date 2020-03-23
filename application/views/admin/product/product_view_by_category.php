<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'TourView')); ?>
<?php if($this->ajax_pagination->getShowcount()){ ?>
<style>
.pagination > li:first-child {
    float: left;
    padding-right: 30px;
    padding-top: 7px;
}
</style>
<?php } ?>
<style>
  .pagination { float: right; }
</style>
    <section class="content-header">
      <h1>Product By Category (<?= isset($Name)?$Name:''; ?>)</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
           <h3 class="box-title"><a href="<?= base_url(ADMIN.'Tour') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back To Product</a></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-2">
              <select name="PerPage" class="form-control" id="PerPage" onchange="gettour()">
                <?php $this->load->view(ADMIN.'tour/optionperpage'); ?>
              </select>
            </div>
            <div class="col-lg-8"></div>
            <div class="col-lg-2">
              <input type="text" class="form-control" onkeyup="gettour()" name="keywords" id="keywords" placeholder="Search"/>
            </div>
          </div>
          <div id="tourList">
            
          </div>
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
  var CategoryId = '<?= $CategoryId ?>';
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url(ADMIN); ?>Tour/ajaxTourData/'+page_num,
    data:'page='+page_num+'&perpage='+perpage+'&keywords='+keywords+'&CategoryId='+CategoryId,
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
            { "sWidth": "15%" },
            { "sWidth": "10%" },
            { "sWidth": "15%" },
            { "sWidth": "15%","bSortable": false }
          ]
        });
    }
  });
}
</script>