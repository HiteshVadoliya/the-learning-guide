<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'MobileTimer')); ?>
    <section class="content-header">
      <h1>Mobile PopUp Time</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
            <form role="form" action="<?= base_url(ADMIN.'Configuration/update_timer') ?>" method="post" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Set Interval For Mobile View Pop Up</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Mobile PopUp Time</label>
                      <select name="MobilePopUpTime" id="MobilePopUpTime" class="form-control">
                        <?php for ($i=1; $i <= 60 ; $i++) { ?>
                        <option value="<?= $i ?>" <?= (isset($config['MobilePopUpTime']) && $config['MobilePopUpTime'] == $i)?'selected="selected"':'' ?>><?= $i ?></option>
                        <?php } ?>
                      </select>
                      <span id="MobilePopUpTime-error" class="text-danger pull-right"></span>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="form-group">
                      <label>Mobile PopUp Time Type (Minutes or Second)</label>
                      <select name="MobilePopUpTimeType" id="MobilePopUpTimeType" class="form-control">
                        <option value="Minutes" <?= (isset($config['MobilePopUpTimeType']) && $config['MobilePopUpTimeType'] == 'Minutes')?'selected="selected"':'' ?>>Minutes</option>
                        <option value="Seconds" <?= (isset($config['MobilePopUpTimeType']) && $config['MobilePopUpTimeType'] == 'Seconds')?'selected="selected"':'' ?>>Seconds</option>
                      </select>
                      <span id="MobilePopUpTimeType-error" class="text-danger pull-right"></span>
                    </div>
                  </div>
                </div><!-- row -->
              </div>
              <div class="box-footer">
                <button type="submit" id="Add" class="btn btn-primary">Update</button>
                <a href="<?= base_url(ADMIN.'Configuration') ?>" id="Cancel" class="btn btn-danger pull-right">Cancel</a>
              </div><!-- /.box footer-->
            </form>
          </div><!-- /.box -->
        </div><!-- row -->
      </div><!-- /.box-body -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#Add').click(function(event) {
      if(requireandmessage('MobilePopUpTime','Mobile PopUp Time')){
        return false;
      }
    });
  });
</script>