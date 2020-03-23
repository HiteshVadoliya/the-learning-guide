<?php
$CI =& get_instance();
$terms = $CI->common->get_one_row('tbl_content',array('name'=>'terms'));
?>
<div class="about-det-se">
    <div class="container">
        <div class="sec-title">              
            <h2><?php
            if(!empty($terms)) {
                echo $terms['title'];
            }
            ?></h2>
        </div>
        <div class="box-sd-bx">
            <?php
            if(!empty($terms)) {
                  echo $terms['description'];
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>