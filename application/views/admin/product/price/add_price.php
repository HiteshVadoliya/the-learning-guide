<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'AddPrice')); ?>
    <section class="content-header">
      <h1><?= $opr ?> Price</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
        <div class="box box-info">
          <?php if(isset($edit['PriceId'])){ ?>
            <form role="form" action="<?= base_url(ADMIN.'Product/editprice') ?>" method="post">
            <input type="hidden" name="PriceId" value="<?= $edit['PriceId'] ?>">
            <?php } else { ?>
            <form role="form" action="<?= base_url(ADMIN.'Product/saveprice') ?>" method="post">
            <?php } ?>
            <input type="hidden" name="ProductId" value="<?= $ProductId ?>">
              <div class="box-header with-border">
                <h3 class="box-title">
                <a href="<?= base_url(ADMIN.'Product/view_price/'.md5($ProductId)) ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="text" id="ProductQuantity" name="ProductQuantity" class="form-control" value="<?= isset($edit['ProductQuantity'])?$edit['ProductQuantity']:set_value('ProductQuantity') ?>" placeholder="Quantity">
                      <span id="ProductQuantity-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="form-group">
                      <label>Text</label>
                      <input type="text" id="PText" name="PText" class="form-control" value="<?= isset($edit['PText'])?$edit['PText']:set_value('PText') ?>" placeholder="Text">
                      <span id="PText-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="form-group">
                      <label>Per Product Price</label>
                      <input type="text" id="PerProductPrice" name="PerProductPrice" class="form-control" value="<?= isset($edit['PerProductPrice'])?$edit['PerProductPrice']:set_value('PerProductPrice') ?>" placeholder="Per Product Price">
                      <span id="PerProductPrice-error" class="text-danger pull-right"></span>
                    </div>
                  </div><!-- col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Additional Offer</label>
                      <input type="text" id="AdditionalOffer" name="AdditionalOffer" class="form-control" value="<?= isset($edit['AdditionalOffer'])?$edit['AdditionalOffer']:set_value('AdditionalOffer') ?>" placeholder="Additional Offer">
                      <span id="AdditionalOffer-error" class="text-danger pull-right"></span>
                    </div> 
                    <div class="form-group">
                      <label>Shipping Charge</label>
                      <input type="text" id="ShippingCharge" name="ShippingCharge" class="form-control" value="<?= isset($edit['ShippingCharge'])?$edit['ShippingCharge']:set_value('ShippingCharge') ?>" placeholder="Shipping Charge">
                      <span id="ShippingCharge-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Final Total</label>
                          <input type="text" id="FinalTotal" name="FinalTotal" class="form-control" value="<?= isset($edit['FinalTotal'])?$edit['FinalTotal']:set_value('FinalTotal') ?>" placeholder="Final Total">
                          <span id="FinalTotal-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                       <div class="form-group">
                          <label>Actual Total</label>
                          <input type="text" id="ActualTotal" name="ActualTotal" class="form-control" value="<?= isset($edit['ActualTotal'])?$edit['ActualTotal']:set_value('ActualTotal') ?>" placeholder="Actual Total" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- row -->
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="Add" class="btn btn-primary"><?= $opr ?></button>
                <a href="<?= base_url(ADMIN.'Product/view_price/'.md5($ProductId)) ?>" id="Cancel" class="btn btn-danger pull-right">Cancel</a>
              </div><!-- /.box footer-->
            </form>
        </div><!-- /.box -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script src="<?= ADMINPATH.'plugins/jquery.numeric.min.js'; ?>"></script>

<script type="text/javascript">

  $(document).ready(function(){
    
    $("#PerProductPrice,#ProductQuantity").numeric({
     negative:false,
    });
    $(this).on('keyup','#ProductQuantity,#PerProductPrice',function(){
      var qty = $('#ProductQuantity').val();
      peritemprice = $('#PerProductPrice').val();
      oldval = '<?= $Price ?>';
      tot = (parseFloat((peritemprice * 100)/oldval) - 100)
      discount = Math.round(Math.abs(tot));
      $('#AdditionalOffer').val('Additional '+discount+'% Off');
      final = parseFloat((qty * peritemprice));
      $('#FinalTotal').val(final);
      //Actual Total
      ap = parseFloat((qty * oldval));
      $('#ActualTotal').val(ap);
    });
    <?php if(isset($edit['PriceId'])){ ?>
      setTimeout(function(){
        $('#ProductQuantity').trigger('keyup');
      },500);
    <?php } ?>
    $('#Add').click(function(event) {
      if(requireandmessage('ProductQuantity','Quantity') || requireandmessage('PText','Text') || requireandmessage('PerProductPrice','Per Product Price') || requireandmessage('AdditionalOffer','Additional Offer') || requireandmessage('ShippingCharge','Shipping Charge') || requireandmessage('FinalTotal','Final Total')){
        return false;
      }
      if(requireandmessage('ShortDescription','Description') || requireandmessage('Description','Description')){
        return false;
      }
    });
    $(".Image").on("change", function (event) {
        var id = $(this).attr("id");
        filename = event.target.files[0].name;
        file = filename.split(".").pop().toLowerCase();
        $("#Preview"+id).fadeIn("fast").attr('src','');
        if(file == "jpg" || file == "png" || file == "jpeg" || file == "gif"){
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#Preview"+id).fadeIn("fast").attr('src',tmppath);
            $('#'+id+'-error').html('');
        } else {
          $('#'+id+'-error').html("Please Select Correct File Only.!!!");
          $(this).val("");
        }
    });
  });
</script>