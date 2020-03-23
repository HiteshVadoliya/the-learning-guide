<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php $img = $this->common->get_one_row('tblsetting',array('SettingKey'=>'Admin_Title') ); echo $img['SettingValue']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= ADMINPATH.'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?= ADMINPATH.'css/login.css'; ?>">
</head>
<body class="hold-transition">


<div class="authentication">

  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            <div class="login-box">
              <div class="login-logo">
              <?php $title = explode(' ', $img['SettingValue']);  ?>
                <a href="<?= base_url(ADMIN) ?>">
                <?php $logo = $this->common->get_one_value('tblsetting',array('SettingKey'=>'Admin_Logo'),'SettingValue'); if($logo != ''){ ?>
                  <img src="<?= LOGOPATH.$logo ?>" alt="" style="height: 50px;">
                  <?php } else {?>
                  <b><?= $title[0] ?></b>Admin
                  <?php }?>
                  </a>
              </div>
              <!-- /.login-logo -->
              <div class="login-box-body">
             <?php $this->load->view(ADMIN.'include/message'); ?>
                <form action="<?= base_url(ADMIN.'Login/Auth'); ?>" method="post">
                  <div class="form-group has-feedback">
                    <input type="email" id="Email" name="Email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span id="Email-error" class="text-danger pull-right"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" id="Password" name="Password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span id="Password-error" class="text-danger pull-right"></span>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" id="Login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                <!-- /.social-auth-links -->
                <a href="javascript:void(0);" data-toggle="modal" data-target="#Forgot" class="white">I forgot my password</a><br>
              </div>
              <!-- /.login-box-body -->
            </div>

        </div>
    </div>
  </div>

    

</div>

<!-- /.login-box -->
    <div class="modal fade" id="Forgot" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">Forgot Password</h4>
          </div>
          <div class="modal-body">
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <form action="<?= ADMIN.'Login/forgotPassword'; ?>" method="post" >
                      <div class="form-group">
                        <label>Enter Your Email</label>    <input type="text" id="FEmail" class="form-control" name="FEmail" value="" placeholder="Enter Email">
                        <span id="FEmail-error" class="text-danger pull-right"></span>
                      </div> 
                      <div class="form-group">
                        <button type="submit" id="BtnForgot" name="BtnForgot" class="btn btn-primary">Send</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-1"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- jQuery 2.2.3 -->
<script src="<?= ADMINPATH.'js/jquery-2.2.3.min.js'; ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= ADMINPATH.'js/bootstrap.min.js'; ?>"></script>
<!-- Custom Validation -->
<script src="<?= ADMINPATH.'plugins/validation/validate.js'; ?>"></script>
<script>
  $(document).ready(function() {
    $('#Login').click(function(event) {
      if(requireandmessage('Email','Email') ||  isvalidemail('Email') || requireandmessage('Password','Password')){
        return false;
      }
    });
    $('#BtnForgot').click(function(event) {
      if(requireandmessage('FEmail','Email') ||  isvalidemail('FEmail')){
        return false;
      }
    });
  });
</script>
</body>
</html>