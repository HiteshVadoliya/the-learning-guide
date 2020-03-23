<?php
$CI =& get_instance();
$social_media = $CI->common->get_one_row('tbl_social_media');
$wh = array('isDelete'=>0);
$content_page = $CI->common->get_all_record('tbl_content','title,footer_heading',$wh);
?>
<footer>
    <div class="footer-se">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3>About Us</h3>
                    <ul class="links">
                        <li class=""><a href="<?php echo base_url('who-we-are'); ?>">Our Story & Values</a></li>
                        <li class=""><a href="<?php echo base_url('services'); ?>">Services</a></li>
                        <li class=""><a href="<?php echo base_url('team'); ?>">Meet the Team</a></li>
                        <li class=""><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
                        <li class=""><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
                        <!-- <li class=""><a href="<?php echo base_url('who-we-are'); ?>">Who we are</a></li> -->
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Legal</h3>
                    <ul class="links">
                        <li class=""><a href="<?php echo base_url('terms'); ?>">Terms of Use</a></li>
                        <li class=""><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
                        <li class=""><a href="<?php echo base_url('content-integrity-policy'); ?>">Content & Integrity Policy</a></li>
                        <li class=""><a href="<?php echo base_url('paid-content-partnerships'); ?>">Paid Content & Partnerships</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Partners</h3>
                    <ul class="links">
                        <?php
                        $option_data = json_decode($content_page[8]['title'], true);
                        $option = $option_data['option'];
                        $optvalue = $option_data['optvalue'];
                        foreach ($option as $key => $value) {
                        ?><li class=""><a target="_blank" href="<?= $optvalue[$key] ?>"><?= $value ?></a></li><?php
                        }
                        ?>

                        <!-- <li class=""><a target="_blank" href="<?= $content_page[8]['title'] ?>">Yeronga Uniforms</a></li>
                        <li class=""><a target="_blank" href="<?= $content_page[8]['footer_heading'] ?>">Docustudy ®</a></li> -->
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Keep In Touch</h3>
                    <ul class="socail-icon">
                        <li>
                            <?php
                            $facebook = (!empty($social_media)) ? ($social_media['facebook'] != '') ? $social_media['facebook'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $facebook; ?>"><i class="fa fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <?php
                            $instagram = (!empty($social_media)) ? ($social_media['instagram'] != '') ? $social_media['instagram'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <?php
                            $linkedin = (!empty($social_media)) ? ($social_media['linkedin'] != '') ? $social_media['linkedin'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <?php
                            $youtube = (!empty($social_media)) ? ($social_media['youtube'] != '') ? $social_media['youtube'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $youtube; ?>"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <?php
                            $twitter = (!empty($social_media)) ? ($social_media['twitter'] != '') ? $social_media['twitter'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="copy-se ">
                        <p>ABN: 70 069 378 72</p>
                        <p>Copyright &copy; The Learning Guide</p>
                        <p>All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</footer>
<?php /* ?><footer>
    <div class="footer-se">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="links">
                        <li class=""><a href="<?php echo base_url('about'); ?>">About Us</a></li>
                        <li class=""><a href="<?php echo base_url('who-we-are'); ?>">Who we are</a></li>
                        <li class=""><a href="<?php echo base_url('services'); ?>">Services</a></li>
                        <li class=""><a href="<?php echo base_url('team'); ?>">Meet the Team</a></li>
                        <li class=""><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul  class="links">
                        <li class=""><a href="<?php echo base_url('terms'); ?>">Terms of Use</a></li>
                        <li class=""><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
                        <li class=""><a href="<?php echo base_url('content-integrity-policy'); ?>">Content & Integrity Policy</a></li>
                        <li class=""><a href="<?php echo base_url('paid-content-partnerships'); ?>">Paid Content & Partnerships</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-right">
                    <ul class="socail-icon">
                        <li>
                            <?php
                            $facebook = (!empty($social_media)) ? ($social_media['facebook'] != '') ? $social_media['facebook'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $facebook; ?>"><i class="fa fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <?php
                            $instagram = (!empty($social_media)) ? ($social_media['instagram'] != '') ? $social_media['instagram'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <?php
                            $linkedin = (!empty($social_media)) ? ($social_media['linkedin'] != '') ? $social_media['linkedin'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <?php
                            $youtube = (!empty($social_media)) ? ($social_media['youtube'] != '') ? $social_media['youtube'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $youtube; ?>"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <?php
                            $twitter = (!empty($social_media)) ? ($social_media['twitter'] != '') ? $social_media['twitter'] : 'javascript:void(0);' : 'javascript:void(0);';
                            ?>
                            <a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                    <div class="copy-se ">
                        <p>Copyright &copy; The Learning Guide</p>
                        <p>ABN: 70 069 378 72</p>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</footer><?php */ ?>