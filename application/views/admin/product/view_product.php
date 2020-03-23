<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'ViewProduct')); ?>
    <section class="content-header">
      <h1> View Product </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
          <a href="<?= base_url(ADMIN.'Product') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
          </h3>
        </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <table class="table table-responsive table-striped">
                    <tr>
                      <td>
                        <label>Title</label>
                      </td>
                      <td><?= isset($edit['Title'])?$edit['Title']:'' ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label>Quantity</label>
                      </td>
                      <td><?= isset($edit['Quantity'])?$edit['Quantity']:'' ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label>Price</label>
                      </td>
                      <td><?= isset($edit['Price'])?CURRENCY.$edit['Price']:ERRMSG ?></td>
                    </tr>
                    <tr>
                      <td>
                        <label>Display Order Bumps</label>
                      </td>
                      <td><?= isset($edit['IsDisplayOrderBumps']) && $edit['IsDisplayOrderBumps'] == '1'?'Yes':'No' ?></td>
                    </tr>
                    <tr>
                    <td><label>Image</label></td>
                      <td><?php $path = isset($edit['Image'])?$edit['Image']:'' ?>
                      <img src="<?= base_url(TOURPATH.$path) ?>" id="PreviewImage" alt="Image" style="height: auto; max-width: 300px;overflow: hidden;display: block;"/>
                      </td>
                    </tr>
                     <tr>
                    <td><label>Image 2</label></td>
                      <td><?php $path2 = isset($edit['Image2'])?$edit['Image2']:'' ?>
                      <img src="<?= base_url(TOURPATH.$path2) ?>" id="PreviewImage" alt="Image" style="height: auto; max-width: 300px;overflow: hidden;display: block;"/>
                      </td>
                    </tr>
                </table>
              </div>
              <div class="col-md-6">
                  <table class="table table-responsive table-striped">
                    <tr>
                      <td colspan="2">
                        <label>Image Colors</label>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><?php $path3 = isset($edit['ColorsPhotoImage'])?$edit['ColorsPhotoImage']:'' ?><img src="<?= base_url(TOURPATH.$path3) ?>" id="PreviewImage" alt="Image" style="height: auto; max-width: 100%;overflow: hidden;display: block;"/></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <label>Short Description</label>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><?= isset($edit['ShortDescription'])?$edit['ShortDescription']:ERRMSG ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <label>Description</label>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><?= isset($edit['Description'])?$edit['Description']:ERRMSG ?></td>
                    </tr>
                  </table>
              </div>
            </div>
          </div> 
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script>
  $(document).ready(function() {
  });
</script>
