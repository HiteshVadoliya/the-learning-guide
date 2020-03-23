<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'AddProduct')); ?>
    <section class="content-header">
      <h1><?= $opr ?> Product</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
        <div class="box box-info">
          <?php if(isset($edit['ProductId'])){ ?>
            <form role="form" action="<?= base_url(ADMIN.'Product/editprocess') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ProductId" value="<?= $edit['ProductId'] ?>">
            <input type="hidden" name="OldImage" value="<?= $edit['Image'] ?>">
            <input type="hidden" name="OldImage2" value="<?= $edit['Image2'] ?>">
            <input type="hidden" name="OldImage3" value="<?= $edit['ColorsPhotoImage'] ?>">
            <?php } else { ?>
            <form role="form" action="<?= base_url(ADMIN.'Product/saveprocess') ?>" method="post" enctype="multipart/form-data">
            <?php } ?>
              <div class="box-header with-border">
                <h3 class="box-title">
                <?php if(isset($edit['ProductId']) && isset($CategoryId)){ ?>
                  <a href="<?= base_url(ADMIN.'Product/view_category/'.$CategoryId) ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                <?php } else { ?>
                <a href="<?= base_url(ADMIN.'Product') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                <?php } ?>
                </h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" id="Title" name="Title" class="form-control" value="<?= isset($edit['Title'])?$edit['Title']:set_value('Title') ?>" placeholder="Title">
                      <span id="Title-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <span class="text-danger">Select The Image Size 460 * 283</span></div>
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Upload Image</label><br />
                          <input id="Image" name="Image" class="Image" type="file" />
                          <span id="Image-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <?php $path = isset($edit['Image'])?TOURPATH.$edit['Image']:'' ?>
                        <?php
                        $src = '';
                        if($path!="" && file_exists($path))
                        {
                            $src = base_url($path);
                        }
                        else
                        {
                            $src = ASSETPATH.'images/default-image.png';
                        }
                        ?>
                        <img id="PreviewImage" src="<?= $src ?>" alt="No Image Selected" style="width: 50%;height: 200px;">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <span class="text-danger">Select The Image Size 390 * 330</span></div>
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Upload Image 2</label><br />
                          <input id="Image2" name="Image2" class="Image2" type="file" />
                          <span id="Image2-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <?php $path = isset($edit['Image2'])?TOURPATH.$edit['Image2']:'' ?>
                        <?php
                        $src = '';
                        if($path!="" && file_exists($path))
                        {
                            $src = base_url($path);
                        }
                        else
                        {
                            $src = ASSETPATH.'images/default-image.png';
                        }
                        ?>
                        <img id="PreviewImage2" src="<?= $src ?>" alt="No Image Selected" style="width: 50%;height: 200px;">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Price</label>
                          <input type="text" id="Price" name="Price" class="form-control" value="<?= isset($edit['Price'])?$edit['Price']:set_value('Price') ?>" placeholder="Price">
                          <span id="Price-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Quantity</label>
                          <input type="text" id="Quantity" name="Quantity" class="form-control" value="<?= isset($edit['Quantity'])?$edit['Quantity']:set_value('Quantity') ?>" placeholder="Quantity">
                          <span id="Quantity-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Short Description</label>
                      <textarea name="ShortDescription" id="ShortDescription" class="form-control" placeholder="Enter ShortDescription" rows="4"><?= isset($edit['ShortDescription'])?$edit['ShortDescription']:set_value('ShortDescription') ?></textarea>
                      <span id="ShortDescription-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="form-group">
                      <label>Display Order Bumps</label>
                      <label class="radio-inline">
                        <input type="radio" name="IsDisplayOrderBumps" value="1" <?= (isset($edit['IsDisplayOrderBumps']) && $edit['IsDisplayOrderBumps'] == '1')?'checked="checked"':'' ?>>Yes
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="IsDisplayOrderBumps" value="0" <?= (isset($edit['IsDisplayOrderBumps']) && $edit['IsDisplayOrderBumps'] == '0')?'checked="checked"':'' ?>>No
                      </label>
                      <span id="IsDisplayOrderBumps-error" class="text-danger pull-right"></span>
                    </div>
                  </div><!-- col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-xs-12">
                        <span class="text-danger">Select The Image Size 172 * 127</span></div>
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Upload Testimonial Image</label><br />
                          <input id="ColorsPhotoImage" name="ColorsPhotoImage" class="ColorsPhotoImage" type="file" />
                          <span id="ColorsPhotoImage-error" class="text-danger pull-right"></span>
                        </div>
                      </div>
                      <div class="col-xs-8">
                      <?php $path = isset($edit['ColorsPhotoImage'])?TOURPATH.$edit['ColorsPhotoImage']:'' ?>
                      </div>
                      <div class="col-xs-6">
                        <?php
                        $src = '';
                        if($path!="" && file_exists($path))
                        {
                            $src = base_url($path);
                        }
                        else
                        {
                            $src = ASSETPATH.'images/default-image.png';
                        }
                        ?>
                        <img id="PreviewColorsPhotoImage" src="<?= $src ?>" alt="No Image Selected" style="width: 60%;height: 200px;">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="Description" id="Description" class="form-control" placeholder="Enter Description"><?= isset($edit['Description'])?$edit['Description']:set_value('Description') ?></textarea>
                      <span id="Description-error" class="text-danger pull-right"></span>
                    </div>
                    <div class="form-group">
                      <label>Amazing Benifit Section</label>
                      <textarea name="benifitSection" id="benifitSection" class="form-control" placeholder="Enter Description"><?= isset($edit['benifitSection'])?$edit['benifitSection']:set_value('benifitSection') ?></textarea>
                      <span id="benifitSection-error" class="text-danger pull-right"></span>
                    </div>
                  </div>
                </div><!-- row -->
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="Add" class="btn btn-primary"><?= $opr ?></button>
                <a href="<?= base_url(ADMIN.'Product') ?>" id="Cancel" class="btn btn-danger pull-right">Cancel</a>
              </div><!-- /.box footer-->
            </form>
        </div><!-- /.box -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script src="<?= ADMINPATH.'plugins/jquery.numeric.min.js'; ?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    
    $("#Price,#Quantity").numeric({
     negative:false,
    });
    $('#Description').ckeditor();
    $('#benifitSection').ckeditor();
    
    $('#Add').click(function(event) {
      if(requireandmessage('Title','Title') || requireandmessage('Price','Price') || requireandmessage('Quantity','Quantity')){
        return false;
      }
      if(requireandmessage('ShortDescription','Description') || requireandmessage('Description','Description') || requireandmessage('benifitSection','Description')){
        return false;
      }
      if($(this).text() == 'Add'){
        if(isexistfile('Image')){
          return false;  
        }
      }
    });
    $(".Image,.Image2,.ColorsPhotoImage").on("change", function (event) {
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