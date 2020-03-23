<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'ProductPriceView')); ?>
<style>
  .pagination { float: right; }
</style>
    <section class="content-header">
      <h1>Product Price (<?= $Title ?>)</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="<?= base_url(ADMIN.'Product') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a></h3>
        </div>
        <div class="box-body">
          <div class="row top-margin">
            <div class="col-lg-3">
               <a href="<?= base_url(ADMIN.'Product/AddPrice/'.md5($ProductId)) ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Price</a>
            </div>
          </div><br>
        
          <table class="table table-responsive Table">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Additional Offer</th>
                <th>Final Total</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if(count($prices)){ $i = 0; foreach ($prices as $price) { $i++; 
                $active = $price['PriceId'].",tblprices,PriceId,".ADMIN."Product/view_price/".md5($ProductId);
                $data = base64_encode($active);
                ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $price['ProductQuantity'].' '.$price['PText'] ?></td>
                  <td><?= $price['AdditionalOffer'] ?></td>
                  <td><?= CURRENCY.$price['FinalTotal'] ?></td>
                  <td class="btnall">
                   <a href="<?= base_url(ADMIN.'Product/AddPrice/'.md5($ProductId).'/'.md5($price['PriceId'])) ?>" class="btn btn-info btn-sm Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                   <a href="<?= base_url(ADMIN.'Product/DeleteRecordPrice/'.$data) ?>" class="btn btn-danger btn-sm" onclick="return myconfirm();"><i class="fa fa-times"></i></a>&nbsp;&nbsp;
                   <a href="javascript:void(0);" class="btn btn-success btn-sm View" data-id="<?= $price['PriceId'] ?>"><i class="fa fa-info-circle"></i></a>
                  </td>
              </tr>
              <?php } } ?>
              </tbody>
            </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
<div id="ViewPrice" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Price</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-striped">
               <tbody>
                 <tr>
                   <td>Quantity</td>
                   <td><span id="DProductQuantity"></span></td>
                 </tr>
                 <tr>
                   <td>Text</td>
                   <td><span id="DPText"></span></td>
                 </tr>
                 <tr>
                   <td>Per Product Price</td>
                   <td><span id="DPerProductPrice"></span></td>
                 </tr>
                 <tr>
                   <td>AdditionalOffer</td>
                   <td><span id="DAdditionalOffer"></span></td>
                 </tr>
                 <tr>
                   <td>Shipping Charge</td>
                   <td><span id="DShippingCharge"></span></td>
                 </tr>
                 <tr>
                   <td>Final Total</td>
                   <td><span id="DFinalTotal"></span></td>
                 </tr>
               </tbody>
             </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
    $('.Table').DataTable({
      "bAutoWidth": false, 
      "aoColumns": [
          { "sWidth": "15%" },
          { "sWidth": "20%" },
          { "sWidth": "20%" },
          { "sWidth": "25%" },
          { "sWidth": "20%","bSortable": false }
        ]
    });
    baseurl = '<?= base_url(ADMIN.'Product/GetPriceInfo') ?>';
    $('.Table').on('click', '.View', function(event) {
      var id = $(this).data('id');
      $.ajax({
          type: 'POST', 
          url: baseurl, 
          data: { PriceId: id }, 
          dataType: 'json',
          success: function (data) {
            if(data['status']){
              $('#DProductQuantity').html(data['ProductQuantity']);
              $('#DPText').html(data['PText']);
              $('#DPerProductPrice').html(data['PerProductPrice']);
              $('#DAdditionalOffer').html(data['AdditionalOffer']);
              $('#DShippingCharge').html(data['ShippingCharge']);
              $('#DFinalTotal').html(data['FinalTotal']);
              $('#ViewPrice').modal('show');
            }
          }
      });
    });
  });
</script>