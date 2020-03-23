<?php if(validation_errors()){ ?>
    <div class="alert alert-danger alert-dismissable">
    <?php  echo validation_errors(); ?>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
<?php } ?>
<?php
if(null !== $this->session->flashdata('msg')) {
    $message = $this->session->flashdata('msg');
    echo "<div class='alert alert-".$message["class"]." alert-dismissable' class=".$message["class"].">".$message["message"]."</div>"; 
} ?>