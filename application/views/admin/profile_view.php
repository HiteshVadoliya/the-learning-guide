<?php
$this->load->view(ADMIN.'include/header', array("Active" => "Profile"));
?>
<section class="content-header">
    <h1>Profile</h1>
</section>

<!-- Main content -->
<section class="content">
 <?php $this->load->view(ADMIN.'include/message'); ?>
    <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Profile</h3>
                    </div><!-- /.box-header -->
                    <form role="form" action="<?= base_url(ADMIN.'Profile/Update'); ?>" method="post" enctype="multipart/form-data" id="changeprofile_form">
                    <div class="box-body">
                    <input type="hidden" name="AdminId" value="<?= $profile['AdminId'] ?>">
                        <table class="table table-responsive table-striped">
                            <tbody>
                                <tr>
                                    <td><label>Name</label></td>
                                    <td>
                                    <input type="text" id="Name" name="Name" class="form-control" value="<?= $profile['Name'] ?>" placeholder="">
                                    <label id="Name-error" class="text-danger pull-right" ></label>
                                    </td>
                                </tr>
                                <tr><td colspan="2"><br></td></tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td><input type="text" id="EmailId" name="EmailId" class="form-control" value="<?= $profile['EmailId'] ?>" placeholder="">
                                    <label id="EmailId-error" class="text-danger pull-right" ></label>
                                    </td>
                                </tr>
                                <tr><td colspan="2"><br></td></tr>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="ChangeProfile" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Change Password</h3>
                    </div><!-- /.box-header -->
                     <form role="form" action="<?= base_url(ADMIN.'Profile/changePassword'); ?>" method="post" enctype="multipart/form-data" id="changePassword_form">
                     <input type="hidden" name="email" value="<?= $profile['EmailId'] ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="OldPassword">Old Password</label>
                            <input type="password" name="OldPassword" id="OldPassword" class="form-control"/>
                            <label id="OldPassword-error" class="text-danger pull-right" ></label>
                        </div>
                        <div class="form-group">
                            <label for="NewPassword">New Password</label>
                            <input type="password" name="NewPassword" id="NewPassword" class="form-control"/>
                            <label id="NewPassword-error" class="text-danger pull-right" ></label>
                        </div>
                        <div class="form-group">
                            <label for="RePassword">Re-Enter New Password</label>
                            <input type="password" name="RePassword" id="RePassword" class="form-control"/>
                            <label id="RePassword-error" class="text-danger pull-right" ></label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="Change" class="btn btn-primary">Change Password</button>
                        <a href="<?= base_url(ADMIN) ?>" class="pull-right"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                     </form>
                </div>
            </div>
            <!-- right column -->
    </div>   <!-- /.row -->
<?php $this->load->view(ADMIN.'include/footer'); ?>
<script>
$(document).ready(function() {
    $('#ChangeProfile').click(function(event) {
      if(requireandmessage('Name','Name') ||  requireandmessage('EmailId','EmailId')){
        return false;
      }
    });
     $('#Change').click(function(event) {
      if(requireandmessage('OldPassword','Current Password') ||  requireandmessage('NewPassword','New Password') || requireandmessage('RePassword','Retype Password') || isconfirmpassword('NewPassword','RePassword')){
        return false;
      }
    });
});
</script>