<?php
$CI =& get_instance();
$paid_content_partnerships = $CI->common->get_one_row('tbl_content',array('name'=>'paid-content-partnerships'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($paid_content_partnerships)) {
                echo $paid_content_partnerships['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">                 
            <?php
            if(!empty($paid_content_partnerships)) {
                echo $paid_content_partnerships['description'];
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>