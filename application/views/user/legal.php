<?php
$CI =& get_instance();
$legal = $CI->common->get_one_row('tbl_content',array('name'=>'legal'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($legal)) {
                echo $legal['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">                 
            <?php
            if(!empty($legal)) {
                echo $legal['description'];
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>