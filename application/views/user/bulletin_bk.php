<div class="pro-slider-se <?php if(isset($teacherSide) || isset($schoolSide)) { echo 'manu-side-se" id="articles'; } ?>">
    <?php
    if(isset($teacherSide) || isset($schoolSide)) {
        $article_type = "school";
        if(isset($teacherSide)) {
            $article_type = "teacher";
        }
    ?>
    <div class="side-manu ">
        <span>Articles</span>
        <!-- <img src="<?php echo FRONTENDPATH ?>images/articles.png">-->
    </div>
    <?php
    }
    ?>
    <div class="container">
        <div class="school-detail-se text-center">
            <?php
            if(isset($teacherSide) || isset($schoolSide)) {
            ?>
            <h2>Read articles related to this <?= $article_type; ?></h2>
            <?php
            }
            else {
            ?>
            <div class="ger-title">
                <h2><a href="<?php echo base_url('bulletin')?>" style="color: #000;"> BULLETIN</a>
                <div>Share and read news in education</div>
                </h2>
            <!-- <h2><span></span></h2> -->
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="BULLETIN-BOX-DESIGN">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $CI =& get_instance();
                    $params['Limit'] = 8;
                    $params['ShortBy'] = 'created_date';
                    $params['ShortOrder'] = 'DESC';
                    $rowCount = 0;
                    if(isset($teacherSide)) {
                        $bulletin = $CI->common->get_all('tbl_bulletin',array('teacherId'=>$teacher['id'],'status'=>1,'isDelete'=>0),$params);
                    }
                    elseif (isset($schoolSide)) {
                        $bulletin = $CI->common->get_all('tbl_bulletin',array('schoolId'=>$school['id'],'status'=>1,'isDelete'=>0),$params);
                    }
                    else {
                        $bulletin = $CI->common->get_all('tbl_bulletin',array('status'=>1,'isDelete'=>0),$params);

                    }

                    $cnt = count($bulletin);
                    if( $cnt > 0 ) {
                        foreach ($bulletin as $key => $value) {
                            $TeacherId = ($value['teacherId']) ? $value['teacherId'] : '';
                            $schoolId = ($value['schoolId']) ? $value['schoolId'] : '';
                            $TeacherULR = $TeacherName = '';
                            if($TeacherId!='') {
                                $TeacherInfo = $this->common->get_one_row('tbl_teacher',array('id'=>$TeacherId,'isDelete'=>0));
                                $TeacherInfo['id'];
                                $TeacherName = $TeacherInfo['fname'].' '.$TeacherInfo['lname'];
                                $TeacherULR = base_url('teacher/'.md5($TeacherInfo['id']));
                            }

                            $SchoolULR = $SchoolName = '';
                            if($schoolId!='') {
                                $SchoolInfo = $this->common->get_one_row('tbl_school',array('id'=>$schoolId,'isDelete'=>0));
                                $SchoolInfo['id'];
                                $SchoolName = $SchoolInfo['name'];
                                $SchoolULR = base_url('school/'.md5($SchoolInfo['id']));
                            }

                            $class = $id = '';
                            if($rowCount > 3) {
                                $class = 'viewmore_1';
                                $id = ' style="display:none;"';
                                //id="viewmore"
                            }
                            
                            ?>
                            <div class="col-md-3 col-sm-6 <?= $class ?>" <?= $id; ?> >
                                <div class="pro-slide-box bulletin">
                                    <div class="pro-img">
                                        <a href="<?php echo base_url().'bulletin-detail/'.md5($value['id']); ?>">
                                        <?php
                                        if(isset($value) && $value['image'] != '' && file_exists(BlogPath.$value['image'])) {
                                        ?>
                                        <img src="<?php echo base_url().BlogPath.$value['image']; ?>" alt="..." class="img-thumbnail">
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
                                    <h6 class="count_nm"><?php echo time_elapsed_string($value['created_date']); ?></h6>
                                    <h4><a href="<?php echo base_url().'bulletin-detail/'.md5($value['id']); ?>"><?php echo $value['title']; ?></a></h4>
                                    <p class="cont-text-aextion">
                                        <?php
                                        $string = $value['description'];
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
                                    <?php $tot_like = $this->db->select('id')->where('bulletin_id',$value['id'])->get('like')->num_rows();
                                    $already = $this->db->select('id')->where('user_id',$this->session->USER['UId'])->where('bulletin_id',$value['id'])->get('like')->num_rows();    
                                    $liked_color = "";
                                    if($already>0) {
                                        $liked_color = "liked_color";
                                    }
                                    ?>
                                    <!-- <div class="heart-btn-bulletin">
                                        
                                    </div> -->
                                    
                                    <?php
                                    // if($value['keyword_tags'] != '') {
                                    ?>
                                    <!-- <div class="other-upper-text-box ">
                                        <p>tagged <?php echo strip_tags($value['keyword_tags']); ?><span> <a href="javascript:void(0);" data-id="<?php echo $value['id'] ?>" class="heart-btn-bulletin likebtn"><i class="fa fa-heart"></i><span class="likecount"><?php echo $tot_like; ?></span> </a></span>
                                        </p>
                                    </div> -->

                                        <span class="like-icon-heart" style="background: #fff;"> <a href="javascript:void(0);" data-id="<?php echo $value['id'] ?>" class="heart-btn-bulletin likebtn likebtn_bulletin <?php echo $liked_color; ?> " ><i class="fa fa-heart"></i><span class="likecount"><?php echo $tot_like; ?></span> </a></span>

                                    <div class="other-upper-text-box ">
                                        <br>                                
                                        <p>
                                            <a href="<?php echo $TeacherULR ?>"><?php echo $TeacherName; ?></a>
                                            <?php if($TeacherName!='') { echo '<br>'; } ?>
                                            <a href="<?php echo $SchoolULR?>"><?php echo $SchoolName; ?></a>
                                        </p>
                                    </div>

                                    <!-- <div class="other-upper-text-box ">
                                        <p>
                                            <a href="<?php echo $TeacherULR ?>"><?php echo $TeacherName; ?></a>
                                            <?php if($TeacherName!='') { echo '<br>'; } ?>
                                            <a href="<?php echo $SchoolULR?>"><?php echo $SchoolName; ?></a>
                                        </p>
                                    </div> -->
                                    <?php
                                    // }
                                    ?>


                                    <a href="<?php echo base_url().'bulletin-detail/'.md5($value['id']); ?>" class="bulletin-readmore">Read More</a>
                                </div>
                            </div>
                            <?php
                            $rowCount++; 
                        }
                    } else {
                        ?><div class="row text-center"><h4>There are no articles tagged to this profile.</h4></div><?php
                    }
                    ?>                              
                </div>  
                              
            </div>
            <?php
            if($cnt > 4) {
            ?>
            <div class="row <?php if($bulletin <= 4) { echo 'hide'; } ?>">
                <div class="col-md-12 text-center">
                    <button class="plus-minus viewMoreBtn_12"><i class="fa fa-plus fa-3x"></i></button>
                </div>
            </div>
            <!-- <div class="main-btn-se">
                <a href="<?php echo base_url('bulletins') ?>" class="btn-1">Read more articles</a>
            </div> -->
            <?php
            }
            ?>
        </div>
            <!-- <div class="other-upper-text">
                <h3>Share and read news in education<h3>            
            </div> -->
    </div>

</div>


<?php 
function time_elapsed_string($datetime, $full = false) {
        $today = time();    
                 $createdday= strtotime($datetime); 
                 $datediff = abs($today - $createdday);  
                 $difftext="";  
                 $years = floor($datediff / (365*60*60*24));  
                 $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
                 $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
                 $hours= floor($datediff/3600);  
                 $minutes= floor($datediff/60);  
                 $seconds= floor($datediff);  
                 //year checker  
                 if($difftext=="")  
                 {  
                   if($years>1)  
                    $difftext=$years." years ago";  
                   elseif($years==1)  
                    $difftext=$years." year ago";  
                 }  
                 //month checker  
                 if($difftext=="")  
                 {  
                    if($months>1)  
                    $difftext=$months." months ago";  
                    elseif($months==1)  
                    $difftext=$months." month ago";  
                 }  
                 //month checker  
                 if($difftext=="")  
                 {  
                    if($days>1)  
                    $difftext=$days." days ago";  
                    elseif($days==1)  
                    $difftext=$days." day ago";  
                 }  
                 //hour checker  
                 if($difftext=="")  
                 {  
                    if($hours>1)  
                    $difftext=$hours." hours ago";  
                    elseif($hours==1)  
                    $difftext=$hours." hour ago";  
                 }  
                 //minutes checker  
                 if($difftext=="")  
                 {  
                    if($minutes>1)  
                    $difftext=$minutes." minutes ago";  
                    elseif($minutes==1)  
                    $difftext=$minutes." minute ago";  
                 }  
                 //seconds checker  
                 if($difftext=="")  
                 {  
                    if($seconds>1)  
                    $difftext=$seconds." seconds ago";  
                    elseif($seconds==1)  
                    $difftext=$seconds." second ago";  
                 }  
                 return $difftext;  
    
}
?>
<script type="text/javascript">

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
                            if(data.addRemove=='add') {
                                thisclass.addClass('liked_color');
                            } else {
                                thisclass.removeClass('liked_color');
                            }
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

$(".viewMoreBtn_12").on("click", function () {
    // var txt_1 = $(".viewMoreBtn_12").is(':visible') ? '<i class="fa fa-plus fa-3x"></i>' : '<i class="fa fa-minus fa-3x"></i>';
    var txt_1 = $(".viewMoreBtn_12").html();
    if(txt_1=='<i class="fa fa-plus fa-3x"></i>') {
        var new_html = '<i class="fa fa-minus fa-3x"></i>';
    } else {
        var new_html = '<i class="fa fa-plus fa-3x"></i>';
    }
    $('.viewmore_1').slideToggle(200);
    $(".viewMoreBtn_12").html(new_html);
});
</script>