<?php
$CI =& get_instance();
$state = $CI->common->get_all_record('tbl_state');
?>
<div class="sign-in-se">
    <div class="container">
        <div class="plan-box-se">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <h3>Looking for more information?</h3>
            </div>
        </div>
    </div>
    <div class="news-letter-se">
        <div class="cat-2-img-se">
            <img src="<?php echo FRONTENDPATH ?>images/cat-2.png" alt="123">
        </div>
        <div class="container">
            <div class="row">
                <div class="msg"></div>
                <div class="col-md-12">
                    <div id="news-message"></div>
                </div>
            </div>
            <form id="newsletterForm">
                <div class="col-md-9 col-sm-9 col-xs-7">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Sign up to our newsletter" autocomplete="off" required>
                    </div>
                    <!-- <a href="javascript:void(0);" class="btn-1">Sign up to our newsletter</a> -->
                </div>
                <div class="col-md-3 col-sm-3 col-xs-5">
                    <!-- <a href="javascript:void(0);" class="btn-1">Submit</a> -->
                    <button class="btn-1" style="width: 100%;" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#newsletterForm').on('submit',function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(FRONTEND.'Pages/add_newsletter') ?>',
            data: $('#newsletterForm').serialize(),
            success: function(data) {
                data = jQuery.parseJSON(data);
                $('#modal-addNewsL').modal('show');
                /*if(data.success) {
                    swal('Success!', data.message, 'success');
                    $('#modal-addNewsL').modal('show');
                }
                else {
                    swal('Error!', data.message, 'error');
                }*/
                var email_val = $('#newsletterForm').find('input[name="email"]').val();
                $('#addNewsL').find('input[name="email"]').val(email_val);
                $('#newsletterForm').find('input[name="email"]').val('');
            }
        });
    });
});
</script>


<div class="modal fade" id="modal-addNewsL">
  <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Newsletter Recipient Details</h4>
              </div>
              <form role="form" id="addNewsL" name="addNewsL" method="post"  role="form" enctype="multipart/form-data">

                  <div class="modal-body">  
                        <div class="box-body">
                            <div class="msg"></div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="slider">First Name</label>
                                        <input type="text" class="form-control required" value="" id="fname" name="fname" Placeholder="First Name">
                                    </div>                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="slider">Last Name</label>
                                        <input type="text" class="form-control required" value="" id="lname" name="lname" Placeholder="Last Name">
                                    </div>                                    
                                </div>                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="slider">Email</label>
                                        <input type="email" style="pointer-events: none;" class="form-control " id="email" name="email" Placeholder="Email">
                                    </div>                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="slider">State</label>
                                        <select name="state" class="form-control">
                                        <option value="">State</option>
                                        <?php
                                        foreach ($state as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="slider">Type</label>
                                        <?php $professionArr = array('Student', 'Parent', 'Teacher', 'Other'); ?>
                                        <select name="profession" class="form-control">
                                            <option value="">I am a..</option>
                                            <?php foreach ($professionArr as $key => $value) { ?>
                                                <option value="<?php echo strtolower($value); ?>"><?php echo $value ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                                    
                                </div>
                                
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary btn-submit" value="Submit" />
                      <input type="reset" class="btn btn-default" value="Reset" />
                  </div>
              </form>
        </div>
  </div>
</div>

<script src="<?php echo ASSETPATH ?>plugins/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#addNewsL').validate({ // initialize the plugin
         rules:{
            fname :{ required : true }
          },
          messages:{
            fname :{ required : "First Name required" }
          },
          submitHandler: function (form) {
           
                  var formData = new FormData($(form)[0]);
                  $.ajax({
                      url: '<?php echo base_url(FRONTEND.'Pages/addition_newsletter') ?>',
                      type: 'POST',
                      data: formData,
                      async: false,
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType:'json',
                      success: function (response) {

                           if(response.result == 'error'){
                              swal('Success', response.message, 'success');
                            }else{
                                swal('Success', response.message, 'success');
                              $('#modal-addNewsL').modal('hide');
                              $('#addNewsL')[0].reset();
                            }

                      }
                  });
                  return false;
             
          }
    });
</script>