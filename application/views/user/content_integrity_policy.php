<?php
$CI =& get_instance();
$content_policy = $CI->common->get_one_row('tbl_content',array('name'=>'content-integrity-policy'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($content_policy)) {
                echo $content_policy['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">                 
            <?php
            if(!empty($content_policy)) {
              	echo $content_policy['description'];
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>