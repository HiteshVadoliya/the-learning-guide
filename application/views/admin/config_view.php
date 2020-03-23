<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'OrderBumps')); ?>
    <section class="content-header">
      <h1>Order Bumps</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
        <div class="box box-info">
            <form role="form" action="<?= base_url(ADMIN.'Configuration/update_process') ?>" method="post" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Order Bumps</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Price</label>
                      <input type="text" id="OrderBumpsPrice" name="OrderBumpsPrice" class="form-control" value="<?= isset($config['OrderBumpsPrice'])?$config['OrderBumpsPrice']:set_value('OrderBumpsPrice') ?>" placeholder="Price">
                      <span id="OrderBumpsPrice-error" class="text-danger pull-right"></span>
                    </div>
                  </div><!-- col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="OrderBumpsDescription" id="OrderBumpsDescription" class="form-control" rows="5" placeholder="Description"><?= isset($config['OrderBumpsDescription'])?$config['OrderBumpsDescription']:set_value('OrderBumpsDescription') ?></textarea>
                      <span id="OrderBumpsDescription-error" class="text-danger pull-right"></span>
                    </div>
                  </div>
                </div><!-- row -->
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="Add" class="btn btn-primary">Update</button>
                <a href="<?= base_url(ADMIN.'Home') ?>" id="Cancel" class="btn btn-danger pull-right">Cancel</a>
              </div><!-- /.box footer-->
            </form>
        </div><!-- /.box -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#Add').click(function(event) {
      if(requireandmessage('OrderBumpsPrice','Price') || requireandmessage('OrderBumpsDescription','Description')){
        return false;
      }
    });
  });
</script>