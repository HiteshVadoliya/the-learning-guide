<?php
$CI =& get_instance();
$privacy = $CI->common->get_one_row('tbl_content',array('name'=>'privacy-policy'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($privacy)) {
                echo $privacy['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">                 
            <?php
            if(!empty($privacy)) {
                  echo $privacy['description'];
            }
            ?>    
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>