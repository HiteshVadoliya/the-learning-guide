<section class="content-header">
   <h1><i class="fa fa-users"></i>&nbsp;View Contact</h1>
</section>

<!-- Main content -->
<section class="content">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">
            <a href="<?= base_url(ADMIN.'contact') ?>" class="btn btn-info btn-md text-center"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
         </h3>
      </div>
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <table class="table table-responsive table-striped">
                  <tr>
                     <td>
                        <label>Name</label>
                     </td>
                     <td><?php echo ucwords($contact['name']); ?></td>
                  </tr>
                  <tr>
                     <td>
                        <label>Email</label>
                     </td>
                     <td><?php echo $contact['email']; ?></td>
                  </tr>
                  <tr>
                     <td>
                        <label>Phone</label>
                     </td>
                     <td><?php echo $contact['phone']; ?></td>
                  </tr>
                  <tr>
                     <td>
                        <label>Subject</label>
                     </td>
                     <td><?php echo $contact['subject']; ?></td>
                  </tr>
                  <tr>
                     <td>
                        <label>Message</label>
                     </td>
                     <td><?php echo $contact['message']; ?></td>
                  </tr>
               </table>
            </div>
         </div>
         
      </div><!-- /.box-body -->
   </div><!-- /.box -->
</section>
   
<script type="text/javascript">
$(document).ready(function(){
   load_ajex_loader('<?= ADMINPATH.'images/ajax-loader.gif'; ?>','Loading Please Wait...');
});
</script>