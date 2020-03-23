<style type="text/css">
.bulletin img {
    /*height: 300px;*/
    width: 100%;
}
.ger-title h2{margin-bottom: 10px;}
{
}
/*.carousel-3d-container[data-v-c06c963c], .carousel-3d-slider[data-v-c06c963c]{
    height: 600px !important;
    overflow: visible;
}
.carousel-3d-slide.current{
    height: 490px!important;
}
.carousel-3d-slide{
    background: transparent;
    border:none;
    overflow: visible;
    height: 490px!important;
}*/
<?php
$CI =& get_instance();
?>
</style>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/needsharebutton.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo FRONTENDPATH ?>css/main.css">
<div class="slider-se">
    <div class="profile-banner-img-se">
        <div class="container">             
            <div class="upper-text-se">
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <h1>Bulletin</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-text">
        <h3>“We all need people who will give us feedback. That's how we improve.” Bill Gates</h3>
    </div>
</div>

<?php $tot_like = $this->db->select('id')->where('bulletin_id',$bulletin['id'])->get('like')->num_rows(); ?>
<div class="" style="position: relative;">
    <div class="cat-5-img-se">
        <img src="<?php echo FRONTENDPATH ?>images/cat-5.png" alt="123">
    </div>
    <div class="container">
        <div class="bulletin pro-service-se">
            <div class="col-lg-12">
                <!-- the actual blog post: title/author/date/content -->
                <div class="ger-title">
                    <h2>
                        <?php echo $bulletin['title']; ?>
                        <span>
                            <a href="javascript:void(0);" data-id="<?php echo $bulletin['id']; ?>" class="heart-btn-bulletin likebtn_bulletin">
                                <i class="fa fa-heart"></i>
                                <span class="likecount"><?php echo $tot_like; ?></span>
                            </a>
                        </span>     
                    </h2>
                    <p class="text-center"><i class="fa fa-calendar"></i> Posted on <?php echo date('M d, Y', strtotime($bulletin['created_date'])).' at '.date('h:i A', strtotime($bulletin['created_date'])); ?></p>
                    <p class="text-center"> 
                        <?php if( !empty($school_name) || !empty($teacher_name) ){ 
                            $tagged = !empty($school_name) ? $school_name : $teacher_name;
                            // echo 'tagged Kellyvalle '. $tagged;
                            echo 'Tags: '.ucwords(str_replace(',', ' , ', $bulletin['keyword_tags']));
                        } ?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" style="margin-bottom: 0px;">
                        <?php
                        if($bulletin['schoolId']) {
                        ?>
                        <a href="<?php echo base_url().'school/'.md5($bulletin['schoolId']); ?>" style="color: #333; text-decoration: underline;"><?php echo $school_name; ?></a><br>
                        <?php
                        }
                        if($bulletin['teacherId']) {
                        ?>
                        <a href="<?php echo base_url().'teacher/'.md5($bulletin['teacherId']); ?>" style="color: #333; text-decoration: underline;"><?php echo $teacher_name; ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- <div class="col-md-4">
                    </div> -->
                    <div class="col-md-6">
                        <div class="bulletin-heart">
                        </div>
                    </div>
                
                    <div class="col-md-6 text-right">
                        <div id="share-button-5" class="need-share-button-default " data-share-position="topCenter" data-share-share-button-class="custom-button">
                            <span class="custom-button"><i class="fa fa-share"></i> share</span>
                        </div>
                        <div class="view-icon" style="margin-top: 5px; display: inline-block;">
                            <span><i class="fa fa-eye"></i></span> <?php echo $pageView; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>            
                <!-- <p><i class="fa fa-calendar"></i> Posted on August 24, 2014 at 9:00 PM</p> -->
                <hr>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    if(isset($bulletin) && $bulletin['image'] != '' && file_exists(BlogPath.$bulletin['image'])) {
                    ?>
                    <img src="<?php echo base_url().BlogPath.$bulletin['image']; ?>" alt="..." class="img-thumbnail">
                    <?php
                    }
                    else {
                    ?>
                    <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="..." class="img-thumbnail">
                    <?php
                    }

                    if($bulletin['image_credit'] != '') {
                    ?>
                    <p><strong>Credit:</strong> <?php echo $bulletin['image_credit']; ?></p>
                    <?php
                    }
                    ?>
                    </a>
                </div>
                <div class="col-md-8 description">
                    <?php
                    echo $bulletin['description'];
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if($bulletin['images'] != '') {
                    ?>
                    <h4>Additional Images:</h4>
                    <div class="row">
                        <?php
                        $bulletinImages = json_decode($bulletin['images'],true);
                        foreach ($bulletinImages as $img_key => $image) {
                            if(file_exists(BlogPath.$image)) {
                            ?>
                            <div class="col-md-3">
                                <img src="<?php echo ASSETPATH.'uploads/image/blog/'.$image; ?>" class="img img-responsive" alt="Photos" height="50px">
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php /* ?><div class="row">
                <div class="col-md-12 text-center">
                    <a href="<?php echo base_url().'bulletin'; ?>" class="btn-1">Back to Bulletin</a>
                </div>
            </div><?php */ ?>
        </div>
    </div>
</div>

<?php //$this->load->view(FRONTEND.'bulletin'); ?>

<div class="pro-slider-se">
    <div class="container">
        <div class="school-detail-se text-center">
            <div class="ger-title">
                <h2><a href="<?php echo base_url().'bulletin'; ?>"> Bulletin </a> </h2>
            </div>
        </div>
    </div>
    <div class="BULLETIN-BOX-DESIGN">
        <div class="container">
            <div class="row">
                <div class="">
                    <?php
                    foreach ($current_articles as $current_key => $article) {
                        $TeacherId = ($article['teacherId']) ? $article['teacherId'] : '';
                        $schoolId = ($article['schoolId']) ? $article['schoolId'] : '';
                        $TeacherULR = $TeacherName = '';
                        if($TeacherId!='') {
                            $TeacherInfo = $CI->common->get_one_row('tbl_teacher',array('id'=>$TeacherId,'isDelete'=>0));
                            $TeacherInfo['id'];
                            $TeacherName = $TeacherInfo['fname'].' '.$TeacherInfo['lname'];
                            $TeacherULR = base_url('teacher/'.md5($TeacherInfo['id']));
                        }

                        $SchoolULR = $SchoolName = '';
                        if($schoolId!='') {
                            $SchoolInfo = $CI->common->get_one_row('tbl_school',array('id'=>$schoolId,'isDelete'=>0));
                            $SchoolInfo['id'];
                            $SchoolName = $SchoolInfo['name'];
                            $SchoolULR = base_url('school/'.md5($SchoolInfo['id']));
                        }
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="pro-slide-box bulletin">
                            <div class="pro-img">
                                <a href="<?php echo base_url().'bulletin-detail/'.md5($article['id']); ?>">
                                <?php
                                if(isset($article) && $article['image'] != '' && file_exists(BlogPath.$article['image'])) {
                                ?>
                                <img src="<?php echo base_url().BlogPath.$article['image']; ?>" alt="..." class="img-thumbnail">
                                <?php
                                }
                                else {
                                ?>
                                <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="..." class="img-thumbnail">
                                <?php
                                }
                                ?>
                                </a>
                            </div>
                            <h6 class="count_nm"><?php echo $CI->time_elapsed_string($article['created_date']); ?></h6>
                            <h4><a href="<?php echo base_url().'bulletin-detail/'.md5($article['id']); ?>"><?php echo $article['title']; ?></a></h4>
                            <p class="cont-text-aextion">
                                <?php
                                $string = $article['description'];
                                $string = strip_tags($string);
                                if (strlen($string) > 100) {
                                   $stringCut = substr($string, 0, 100);
                                   $endPoint = strrpos($stringCut, ' ');
                                   $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                   $string .= '... ';
                                }
                                echo $string;
                                ?>
                            </p>
                            <?php $tot_like = $this->db->select('id')->where('bulletin_id',$article['id'])->get('like')->num_rows();
                            $already = $this->db->select('id')->where('user_id',$this->session->USER['UId'])->where('bulletin_id',$article['id'])->get('like')->num_rows();    
                            $liked_color = "";
                            if($already>0) {
                                $liked_color = "liked_color";
                            }
                            ?>
                            
                            <span class="like-icon-heart" style="background: #fff;"> <a href="javascript:void(0);" data-id="<?php echo $article['id'] ?>" class="heart-btn-bulletin likebtn likebtn_bulletin <?php echo $liked_color; ?> " ><i class="fa fa-heart"></i><span class="likecount"><?php echo $tot_like; ?></span> </a></span>

                            <div class="other-upper-text-box ">
                                <br>                                
                                <p>
                                    <a href="<?php echo $TeacherULR ?>"><?php echo $TeacherName; ?></a>
                                    <?php if($TeacherName!='') { echo '<br>'; } ?>
                                    <a href="<?php echo $SchoolULR?>"><?php echo $SchoolName; ?></a>
                                </p>
                            </div>
                            <a href="<?php echo base_url().'bulletin-detail/'.md5($article['id']); ?>" class="bulletin-readmore">Read More</a>
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

<?php /* ?><div class="gry-box-se">
    <div class="cat-5-img-se">
        <img src="<?php echo FRONTENDPATH ?>images/cat-5.png" alt="123">
    </div>
    <div class="container-fluid">
        <div class="ger-title">
            <h2>TELL US WHST YOU THINK</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>How motivated are you to study?</h3>
                        </div>
                        <div class="yse-no-section rang-slider-se">                            
                            <ul>
                                <li><i class="fa fa-briefcase"></i></li>
                                <li><div class="slidecontainer"><input type="range" min="1" max="100" value="10" class="slider" id="myRange"></div></li>
                            </ul>                                                                  
                        </div>
                        <div class="vote-section">
                            <p>431 votes</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>Should schools provide a FREE lunch for students?</h3>
                        </div>
                        <div class="yse-no-section">                                
                            <ul>
                                <li>
                                    <p>
                                        <span class="yes-text-color">Yes</span>
                                        60%
                                    </p>
                                </li>                                    
                                <li>
                                    <p>
                                        <span>No</span>
                                        40%
                                    </p>
                                </li>
                            </ul>                                

                        </div>
                        <div class="vote-section">
                            <p>14352 votes</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>Do you think provate schools offer a better education than public schools?</h3>
                        </div>
                        <div class="yse-no-section">                                
                            <ul>
                                <li>
                                    <p>
                                        <span class="yes-text-color">Yes</span>
                                        30%
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <span>No</span>
                                        70%
                                    </p>
                                </li>                                
                            </ul>
                        </div>
                        <div class="vote-section">
                            <p>312 votes</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>Do you think your teachers require training on how to engage with students?</h3>
                        </div>
                        <div class="yse-no-section">                                
                            <ul>
                                <li>
                                    <p>
                                        <span class="yes-text-color">Yes</span>
                                        40%
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <span>No</span>
                                        60%
                                    </p>
                                </li>
                            </ul>                                

                        </div>
                        <div class="vote-section">
                            <p>154 votes</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>is having a degree going to increase your job prospects?</h3>
                        </div>
                        <div class="yse-no-section">                                
                            <ul>
                                <li>
                                    <p>
                                        <span class="yes-text-color">Yes</span>
                                        70%
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <span>No</span>
                                        30%
                                    </p>
                                </li>
                            </ul>                                
                        </div>
                        <div class="vote-section">
                            <p>312 votes</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="title-for-yes-no">
                            <h3>How much of what you learn at school is applicable to real life situations?</h3>
                        </div>
                        <div class="yse-no-section rang-slider-se">                            
                            <ul>
                                <li><i class="fa fa-briefcase"></i></li>
                                <li><div class="slidecontainer"><input type="range" min="1" max="100" value="10" class="slider" id="myRange"></div></li>
                            </ul>                                                                  
                        </div>
                        <div class="vote-section">
                            <p>252 votes</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="right-cat-box">
                    
                    <div class="col-md-8">
                        <div class="text-and-progress-section  text-center">
                            <h3>Where do you think<br> bullying occurs the most?</h3>
                        </div>
                        <ul class="skill-list">
                          <li class="skill">
                            <p>primary</p>
                            <progress class="skill-1" max="100" value="50"></progress>
                          </li>
                          <li class="skill">
                            <p>secondary</p>
                            <progress class="skill-2" max="100" value="75"></progress>
                          </li>
                          <li class="skill">
                            <p>tertiary</p>
                            <progress class="skill-3" max="100" value="25"></progress>
                          </li>
                        </ul>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php */ ?>

<?php /* ?><div id="survey">
    <div class="container">
        <div class="bulletin-form-section">
            <div class="container">
                

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(isset($this->session->USER['UId'])) {
                        ?>
                        <form id="surveyForm">
                            <input type="hidden" name="bulletin_id" value="<?php echo $bulletin['id']; ?>">
                            <div class="uic-wrapper no-touch">
                                <ul>
                                    <li>
                                        <ul class="cards-wrapper">
                                            <li class="card card-front active">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>How motivated are you to study?</h3>
                                                    </div>
                                                    <div class="yse-no-section rang-slider-se">
                                                        <div>
                                                            <span class="inline"><i class="fa fa-briefcase"></i></span>
                                                            <span class="inline">
                                                                <div class="slidecontainer">
                                                                    <input type="range" min="0" max="100" value="0" class="slider cls" id="myRange" name="que_1">
                                                                    <span class="error"></span>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="vote-section">
                                                        <p> votes</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-middle">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>Should schools provide a FREE lunch for students?</h3>
                                                    </div>
                                                    <div class="yse-no-section">
                                                        <div>
                                                            <span class="inline">
                                                                <p>
                                                                    <span class="yes-text-color">Yes</span>
                                                                    <input class="cls" type="radio" name="que_2" value="1">
                                                                </p>
                                                            </span>
                                                            <span class="inline">
                                                                <p>
                                                                    <span>No</span>
                                                                    <input class="cls" type="radio" name="que_2" value="0">
                                                                </p>
                                                            </span>
                                                            <span class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-back">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>Do you think private schools offer a better education than public schools?</h3>
                                                    </div>
                                                    <div class="yse-no-section">
                                                        <div>
                                                            <span class="inline">
                                                                <p>
                                                                    <span class="yes-text-color">Yes</span>
                                                                    <input class="cls" type="radio" name="que_3" value="1">
                                                                </p>
                                                            </span>
                                                            <span class="inline">
                                                                <p>
                                                                    <span>No</span>
                                                                    <input class="cls" type="radio" name="que_3" value="0">
                                                                </p>
                                                            </span>
                                                            <span class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-back1">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>Do you think your teachers require training on how to engage with students?</h3>
                                                    </div>
                                                    <div class="yse-no-section">
                                                        <div>
                                                            <span class="inline">
                                                                <p>
                                                                    <span class="yes-text-color">Yes</span>
                                                                    <input class="cls" type="radio" name="que_4" value="1">
                                                                </p>
                                                            </span>
                                                            <span class="inline">
                                                                <p>
                                                                    <span>No</span>
                                                                    <input class="cls" type="radio" name="que_4" value="0">
                                                                </p>
                                                            </span>
                                                            <span class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-back2">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>is having a degree going to increase your job prospects?</h3>
                                                    </div>
                                                    <div class="yse-no-section">
                                                        <div>
                                                            <span class="inline">
                                                                <p>
                                                                    <span class="yes-text-color">Yes</span>
                                                                    <input class="cls" type="radio" name="que_5" value="1">
                                                                </p>
                                                            </span>
                                                            <span class="inline">
                                                                <p>
                                                                    <span>No</span>
                                                                    <input class="cls" type="radio" name="que_5" value="0">
                                                                </p>
                                                            </span>
                                                            <span class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-back3">
                                                <div class="">
                                                    <div class="title-for-yes-no">
                                                        <h3>How much of what you learn at school is applicable to real life situations?</h3>
                                                    </div>
                                                    <div class="yse-no-section rang-slider-se">
                                                        <div>
                                                            <span class="inline"><i class="fa fa-briefcase"></i></span>
                                                            <span class="inline">
                                                                <div class="slidecontainer">
                                                                    <input type="range" min="1" max="100" value="10" class="slider cls" id="myRange" name="que_6">
                                                                    <span class="error"></span>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="vote-section">
                                                        <p> votes</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="card card-out">
                                                <center>
                                                    <i style="font-size:62px;color: #66bf65;" class="fa fa-check"></i>
                                                    <br>
                                                    <h1>Survey Completed Successfully!</h1>
                                                </center>
                                            </li>
                                        </ul>
                                        <nav>
                                            <ul>
                                                <li><a class="btn-back" href="#0"><i class="fa fa-arrow-left"></i></a></li>
                                                <li><a class="btn-next" href="#0">Next <i class="fa fa-arrow-right"></i></a></li>
                                                <li><a href="#0" class="btn-finish hide">Finish</a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <?php
                        }
                        else {
                            $CI =& get_instance();
                            $url = $CI->config->site_url($CI->uri->uri_string());
                            $this->session->set_userdata("user_last_page",$url);
                        ?>
                        <div class="text-center">
                            <h2>You have to login For Bulletin Survey</h2>
                            <a href="<?php echo base_url('login'); ?>" class="btn-1">Login</a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><?php */ ?>

<script src="<?php echo FRONTENDPATH ?>js/needsharebutton.js"></script>
<script src="<?php echo FRONTENDPATH ?>js/main.js"></script>
<script type="text/javascript">
    
new needShareDropdown(document.getElementById('share-button-5'), {
shareButtonClass: false, 
iconStyle: 'default', 
boxForm: 'horizontal', 
position: 'bottomCenter', 
buttonText: 'Share',
protocol: ['http', 'https'].indexOf(window.location.href.split(':')[0]) === -1 ? 'https://' : '//',
url: window.location.href,
image: 'http://bhimani.com.au/demo/school-review/assets/uploads/image/blog/5c53ec9931cf5_1920-750-2.jpg',
// description to share
// description: root.getDescription(),
// social networks
// networks: 'Mailto,Twitter,Pinterest,Facebook,GooglePlus,Reddit,Delicious,Tapiture,StumbleUpon,Linkedin,Slashdot,Technorati,Posterous,Tumblr,GoogleBookmarks,Newsvine,Pingfm,Evernote,Friendfeed,Vkontakte,Odnoklassniki,Mailru'
networks: 'Twitter,Facebook,GooglePlus,Directcopy'
});
$('.likebtn_bulletin').on('click', function() {
    var id = $(this).attr('data-id');
    
    var thisclass = $(this);
    if(id.length != 0) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('user/Bulletin/set_like') ?>',
            data: { id: id },
            success: function(data) {
                data = jQuery.parseJSON(data);
                
                if(data.redirect) {
                    window.location.href = "<?php echo base_url('login'); ?>";
                }else{
                    if(data.success) {
                        swal('success', data.message, 'success');
                        thisclass.find('.likecount').html(data.count);
                    }
                    else {
                        swal('Warning', data.message, 'warning');
                    }
                }
            }
        });
        /**/
    }
});
$('.btn-finish').on('click', function() {
    var currentCard = $(".card-front"),
        middleCard = $(".card-middle"),
        ele = $(this);
    /**/
    let formData = $('#surveyForm').serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url().FRONTEND.'Bulletin/save_question' ?>',
        data: formData,
        success: function(data) {
            data = jQuery.parseJSON(data);
            if(data.result) {
            }
            else {
            }
            console.log(data.msg);
        }
    });
    /**/
    currentCard.removeClass('card-front myLastCard').addClass('toRight');
    middleCard.removeClass('card-middle').addClass('card-front');
    $(ele).hide();
    $('.btn-back').hide();
 });
</script>
