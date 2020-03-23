<style>
  /*.lg-bg { background-color: black; }*/
</style>
<section class="content-header">
   <h1>Setting</h1>
</section>
<!-- Main content -->
<section class="content">
   <?php $this->load->view(ADMIN.'include/message'); ?>
   <!-- Default box -->
   <div class="box box-info">
      <form role="form" action="<?= base_url(ADMIN.'Configuration/update_setting') ?>" method="post" enctype="multipart/form-data">
        <div class="box-header with-border">
          <h3 class="box-title">Setting</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Admin Title</label>
                <input type="text" id="Admin_Title" name="Admin_Title" class="form-control" value="<?= isset($setting['Admin_Title'])?$setting['Admin_Title']:set_value('Admin_Title') ?>" placeholder="Admin Title">
                <span id="Admin_Title-error" class="text-danger pull-right"></span>
              </div>
              <!-- <label>Choose Image </label> -->
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Admin Logo</label>
                      <input type="file" name="Admin_Logo" id="Admin_Logo" class="Admin_Logo">
                      <p class="help-block">(Valid File Type: JPEG , PNG).</p>
                      <span id="Admin_Logo-error" class="text-danger pull-right"></span>
                  </div>
                </div>
                <div class="col-lg-5 lg-bg">
                <?php $path = isset($setting['Admin_Logo'])?$setting['Admin_Logo']:'' ?>
                <img src="<?= LOGOPATH.$path; ?>" id="PreviewAdmin_Logo" alt="Admin Logo" class="img img-responsive" style="height: 50px;" />
                </div>
                <div class="col-lg-1"></div>
              </div>
            </div><!-- col-lg-6 -->
            <div class="col-lg-6">
              <div class="form-group">
                <label>Front End Title</label>
                <input type="text" id="FrontEnd_Title" name="FrontEnd_Title" class="form-control" value="<?= isset($setting['FrontEnd_Title'])?$setting['FrontEnd_Title']:set_value('FrontEnd_Title') ?>" placeholder="Front End Title">
                <span id="FrontEnd_Title-error" class="text-danger pull-right"></span>
              </div>
              <!-- <label>Choose Image 160(w) * 34(h) </label> -->
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label>Front End Logo</label>
                      <input type="file" name="FrontEnd_Logo" id="FrontEnd_Logo" class="FrontEnd_Logo">
                      <p class="help-block">(Valid File Type: JPEG , PNG).</p>
                      <span id="FrontEnd_Logo-error" class="text-danger pull-right"></span>
                  </div>
                </div>
                <div class="col-lg-5 lg-bg">
                <?php $path = isset($setting['FrontEnd_Logo'])?$setting['FrontEnd_Logo']:'' ?>
                    <img src="<?= LOGOPATH.$path; ?>" id="PreviewFrontEnd_Logo" alt="Front End Logo" class="img img-responsive" style="height: 50px;" />
                </div>
                <div class="col-lg-1"></div>
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
</section>
    
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script type="text/javascript">
$(document).ready(function(){
   $('#Answer').ckeditor();
   $('#Add').click(function(event) {
      if(requireandmessage('Admin_Title','Admin Title') || requireandmessage('FrontEnd_Title','Front End Title')){
         return false;
      }// || requireandmessage('TwitterLink','Twitter Link')
   });
   $(".Admin_Logo,.FrontEnd_Logo").on("change", function (event) {
      var id = $(this).attr("id");
      filename = event.target.files[0].name;
      file = filename.split(".").pop().toLowerCase();
      $("#Preview"+id).fadeIn("fast").attr('src','');
      if(file == "jpg" || file == "png" || file == "jpeg"){
         var tmppath = URL.createObjectURL(event.target.files[0]);
         $("#Preview"+id).fadeIn("fast").attr('src',tmppath);
         $('#'+id+'-error').html('');
      }
      else {
         $('#'+id+'-error').html("Please Select Correct File Only.!!!");
         $(this).val("");
      }
   });
});
</script>