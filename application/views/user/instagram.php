<link href="<?php echo F_CSSPATH ?>main-instagram.css" rel="stylesheet">
<div class="new-btn-se instagram-box-section">
    <div class="container">
        <div class="ger-title">            
            <h2>@thelearningguide</h2>
        </div>
        <?php /* ?><ul class="instagram-post text-center">       
            <?php
            foreach ($insta_photo as $post) {
                $img_url = $post['images']['thumbnail']['url'];
                if(isset($post['caption'])) {
                    $caption = $post['caption']['text'];
                }
                $likes = '3144';//$post['likes'];
                $post_link = $post['link'];
                $username = $post['user']['username'];
            ?>
            <li>
                <div class="img-holder">
                    <img src="<?php echo $img_url; ?>" style="width:85px;" alt="Awesome Image">
                    <div class="overlay-style-one">
                        <div class="box">
                            <div class="content">
                                <!-- <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>     -->
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
            }
            ?>
        </ul><?php */ ?>
        <div class="carouselGallery-grid hidden-xs">
            <div class="row">
                <div class="carouselGallery-col-60">
                    <?php
                    foreach ($insta_photo as $post_key => $post) {
                        // $img_url = $post['images']['thumbnail']['url'];
                        $img_url = $post['images']['standard_resolution']['url'];
                        $caption = '';
                        if(isset($post['caption'])) {
                            $caption = $post['caption']['text'];
                        }
                        $likes = $post['likes']['count'];
                        $post_link = $post['link'];
                        $username = $post['user']['username'];
                    ?>
                    <div class="carouselGallery-col-1 img-holder carouselGallery-carousel" data-index="<?php echo $post_key; ?>" data-username="<?php echo $username; ?>" data-imagetext="<?php echo $caption; ?>" data-location="" data-likes="<?php echo $likes; ?>" data-imagepath="<?php echo $img_url; ?>" data-posturl="<?php echo $post_link; ?>" style="background-image:url(<?php echo $img_url; ?>);">
                        <div class="carouselGallery-item">
                            <div class="carouselGallery-item-meta">
                                <span class="carouselGallery-item-meta-user">
                                    @<?php echo $username; ?>
                                </span>
                                <span class="carouselGallery-item-meta-likes">
                                    <span class="icons icon-heart"></span><?php echo $likes; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo F_JSPATH ?>main-instagram.js?time=<?php echo time(); ?>"></script>	