<?php $this->load->view(ADMIN.'include/header',array('ActiveMenu'=>'PTRContent')); ?>
    <section class="content-header">
      <h1>Title Info</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view(ADMIN.'include/message'); ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-lg-6">
          <div class="box box-info">
            <form role="form" action="<?= base_url(ADMIN.'Privacy/UpdateContent') ?>" method="post">
              <div class="box-header with-border">
                <h3 class="box-title">
                Pages Title
                </h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Privacy Title</label>
                  <input type="text" id="PrivacyTitle" name="PrivacyTitle" class="form-control" value="<?= isset($title['PrivacyTitle'])?$title['PrivacyTitle']:set_value('PrivacyTitle') ?>" placeholder="Privacy Title">
                  <span id="PrivacyTitle-error" class="text-danger pull-right"></span>
                </div>
                <div class="form-group">
                  <label>Refund Title</label>
                  <input type="text" id="RefundTitle" name="RefundTitle" class="form-control" value="<?= isset($title['RefundTitle'])?$title['RefundTitle']:set_value('RefundTitle') ?>" placeholder="Refund Title">
                  <span id="RefundTitle-error" class="text-danger pull-right"></span>
                </div>
                <div class="form-group">
                  <label>Terms Title</label>
                  <input type="text" id="TermsTitle" name="TermsTitle" class="form-control" value="<?= isset($title['TermsTitle'])?$title['TermsTitle']:set_value('TermsTitle') ?>" placeholder="Terms Title">
                  <span id="TermsTitle-error" class="text-danger pull-right"></span>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="Update" class="btn btn-primary">Save</button>
                <a href="<?= base_url(ADMIN) ?>" id="Cancel" class="btn btn-danger pull-right">Cancel</a>
              </div><!-- /.box footer-->
            </form>
        </div><!-- /.box -->
     </div>
     </div>
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#Update').click(function(event) {
      if(requireandmessage('PrivacyTitle','Privacy Title') || requireandmessage('RefundTitle','Refund Title') || requireandmessage('TermsTitle','Terms Title')){
        return false;
      }
    });
  });
</script>