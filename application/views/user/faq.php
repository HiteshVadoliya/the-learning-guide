<?php
$CI =& get_instance();
$cms = $CI->common->get_one_row('tbl_content',array('id'=>'5'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($cms)) {
                echo $cms['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">
            <?php
            if(!empty($cms)) {
                  echo $cms['description'];
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>