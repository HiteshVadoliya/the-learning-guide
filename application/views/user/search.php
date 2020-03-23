<style type="text/css">
    .searchImage {
        border: #ccc solid 1px;
    }
</style>
<div class="pro-service-se">
    <div class="container">
        <div class="ger-title">
            <h2>Search Result</h2>
        </div>
        <div class="out-pro-se">
            <div class="row">
                <?php
                if(isset($school)) {
                    if(count($result) > 0) {
                        foreach ($result as $key => $value) {
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="pro-box">
                                <div class="pro-img">
                                    <?php
                                    if($value['school_logo'] != '') {
                                    ?>
                                    <img src="<?php echo base_url().PhotosPath.$value['school_logo'] ?>" alt="" class="searchImage">
                                    <?php
                                    }
                                    else {
                                    ?>
                                    <img src="<?php echo FRONTENDPATH.'images/banner-1.png'; ?>" alt="">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <h4><a href="<?php echo base_url().'school/'.md5($value['id']); ?>"><?php echo $value['name']; ?></a></h4>
                                <ul class="star-se">
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>                                 
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    else {
                    ?>
                    <div class="col-md-12 text-center">
                        <p>No School Found..</p>
                    </div>
                    <?php
                    }
                }
                elseif (isset($teacher)) {
                    if(count($result) > 0) {
                        foreach ($result as $key => $value) {
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="pro-box">
                                <div class="pro-img">
                                    <?php
                                    if(isset($value['profile_img']) && $value['profile_img'] != '') {
                                    ?>
                                    <img src="<?php echo base_url().ProfilePath.$value['profile_img'] ?>" alt="" class="searchImage">
                                    <?php
                                    }
                                    else {
                                    ?>
                                    <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <h4><a href="<?php echo base_url().'teacher/'.md5($value['id']); ?>"><?php echo ucwords($value['fname'].' '.$value['lname']); ?></a></h4>
                                <ul class="star-se">
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-star"></i></a></li>                                 
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    else {
                    ?>
                    <div class="col-md-12 text-center">
                        <p>No Teacher Found..</p>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="other-upper-text">
        <h3>'Top schools' are ranked according to user star ratings.</h3>
    </div>
</div>

<div class="pro-slider-se">
    <div class="container">
        <div class="ger-title">
            <h2><span>bulletin</span> Share and read news in education</h2>
        </div>
    </div>
    <div class="container-fluid">
        <div class="">
            <div class="row">
                <div class="col-md-10 col-md-offset-2">                 
                    <div class="col-md-2 col-sm-4">
                        <div class="pro-slide-box">
                            <div class="pro-img">
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            </div>
                            <h4>Title</h4>
                            <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles.</p>
                            <a href="javascript:void(0);" class="btn-1">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="pro-slide-box">
                            <div class="pro-img">
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            </div>
                            <h4>Title</h4>
                            <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles.</p>
                            <a href="javascript:void(0);" class="btn-1">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="pro-slide-box">
                            <div class="pro-img">
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            </div>
                            <h4>Title</h4>
                            <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles.</p>
                            <a href="javascript:void(0);" class="btn-1">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="pro-slide-box">
                            <div class="pro-img">
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            </div>
                            <h4>Title</h4>
                            <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles.</p>
                            <a href="javascript:void(0);" class="btn-1">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="pro-slide-box">
                            <div class="pro-img">
                                <img src="<?php echo FRONTENDPATH ?>images/banner-1.png" alt="">
                            </div>
                            <h4>Title</h4>
                            <p>Read or share important news in education. Our Bulletin contains current survey statistics too and allows users to publish articles.</p>
                            <a href="javascript:void(0);" class="btn-1">Read More</a>
                        </div>
                    </div>                              
                </div>
                <div class="col-md-2 col-sm-4">
                </div>
            </div>
            <div class="main-btn-se">
                <a href="javascript:void(0);" class="btn-1">Read more articles</a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>