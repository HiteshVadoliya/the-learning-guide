<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/jquery.dm-uploader.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= ADMINPATH.'fileupload/css/styles.css' ?>">

<div class="loadermain">
    <div><img style="width:10%" src="<?php echo ASSETPATH.'images/loader.svg'; ?>"><br><span style="color: #fff;">Loading Please Wait...</span></div>
</div>

<style>
    .pro-slider-se{background:transparent; }
    .pro-slide-box { background: #fff; border:1px solid #d7d7d7 ;    /*max-height: 100px;*/}
    .loadermain{ width: 100%; height: 100vh; position: fixed; left: 0px; right: 0px; top: 0px; bottom: 0px; background: rgba(0, 0, 0, 0.6); z-index: 2000; text-align: center; display: table; }
    .loadermain div{ vertical-align: middle; display: table-cell; width: 200px; }
    .loadermain img{ display: inline; }

/*Wizard CSS*/
.wizard {
    margin: 20px auto;
    background: #fff;
}

.wizard .nav-tabs {
    position: relative;
    margin: 40px auto;
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
}

.wizard > div.wizard-inner {
    position: relative;
}

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 16%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}
.list-inline {
    clear: both;
    padding: 3%;
}
@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>

    <div class="slider-se">
        <div class="listing-banner-img-se bulletin-listing">
            <div class="container">             
                <div class="upper-text-se">                
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-adv-search">
                                    <div class="form-group bx-fin-se">
                                        <input type="text" name="searchtxt" id="searchtxt" class="form-control" placeholder="Search articles using a key word or phrase" value="<?php if(isset($searchText) && $searchText!='') { echo $searchText; } ?>">
                                    </div>
                                    <div class="form-group bx-fin-se hide">
                                    </div>
                                    <div class="form-group bx-fin-se">
                                        <button type="button" class="btn-1 run_filter">Find</button>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    
                </div>                
            </div>
        </div>
        <div class="bottom-text">
            <h3>“ALL THAT I SAW AND LEARNED WAS A NEW DELIGHT TO ME...”  MARIE CURIE</h3>
            <!-- <h3>“An investment in knowledge pays the best interest.”  Benjamin Franklin</h3> -->
        </div>
    </div>


<div class="pro-slider-se">

    <div class="container-fluid">
        <div class="cus-container">
            <div class="pull-right">
                <!-- <h3>LATEST POSTS</h3> -->
                <h3 id="no_of_item"></h3>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-section">
                        <div class="filter-title">     
                            <h3>Advanced Search</h3>
                        </div>
                        <form class="filter-check-box-se" >                                    
                            <div class="form-group">
                                <label class="filter-col" for="">Sort by date:</label>
                                <select id="order_date" name="order_date" class="form-control run_filter_select">
                                    <option value="">Select</option>
                                    <option value="desc">Newest</option>
                                    <option value="asc">Oldest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="filter-col" for="">Sort by popularity:</label>
                                <select id="popularity" name="popularity" class="form-control run_filter_select">
                                    <option value="">select</option>
                                    <option value="read_desc">Most read</option>
                                    <option value="read_asc">Least read</option>
                                    <option value="like_desc">Most liked</option>
                                    <option value="like_asc">Least liked</option>
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label class="filter-col" for="">Sort by context:</label>
                                <select id="context" name="context" class="form-control run_filter_select">
                                    <option value="0">General</option>
                                    <option value="1">School</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Both</option>
                                </select>                                
                            </div>

                            <div class=" cf">    
                                <label class="filter-col" for="">Sort by Category:</label>
                                <div class="checkbox">
                                    <ul>
                                        <li>
                                            <label>
                                                <input type="checkbox" value="primary" name="type[]" class="run_filter">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                <p class="">Primary</p>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="checkbox" value="secondary" name="type[]" class="run_filter">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                <p class="">Secondary</p>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="checkbox" value="tertiary" name="type[]" class="run_filter">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                <p class="">Tertiary</p>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="checkbox" value="special_school" name="type[]" class="run_filter">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                <p class="">Special Needs</p>
                                            </label>
                                        </li>

                                    </ul>
                                        
                                </div>                  
                            </div>
                        </form> 
                    </div>

                    <div class="filter-section">
                        <div class="filter-title">     
                            <h3>Top articles this month</h3>
                        </div>
                        <div class="filer-likecount">                                       
                            <ul>
                                <?php foreach ($most_bulletin_this_month as $key => $value) {
                                    //$tot_like = $this->db->select('id')->where('bulletin_id',$value['id'])->get('like')->num_rows();
                                    if(isset($value) && $value['image'] != '' && file_exists(BlogPath.$value['image'])) {
                                    $img = base_url().BlogPath.$value['image'];
                                    }else {
                                    $img = ASSETPATH.'images/default-image.png';
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php echo base_url().'bulletin-detail/'.md5($value['id']); ?>" data-id="" class="">
                                            <span><img src="<?php echo $img; ?>"></span>
                                            <?php echo $value['title'] ?>        
                                        </a>
                                        <!-- <span> <a href="javascript:void(0);" data-id="" class=""><i class="fa fa-heart"></i>
                                        <span class="likecount"><?php echo $value['total_like']; ?></span></a></span> -->
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                    <div class="filter-section">
                         <div class="filter-title">     
                            <h3>Most searched words</h3>
                        </div>
                        <div class="searched-words">
                            <ul>
                                <?php foreach ($most_keyword_list as $key => $value) { ?>
                                    <li><label><a href="javascript:void(0)" data-id="<?php echo $value['keyword'] ?>" class="run_filter"> <?php echo $value['keyword'] ?> </a></label></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div id="bulletin_list"></div>
                    </div> 
                    <div class="pull-right" id='pagination'></div>                         
                </div>
                
            </div>
        </div>
    </div>
    
</div>



<?php
/*if(isset($this->session->USER['UId'])) {
    $this->load->view(FRONTEND.'bulletin_question');
}*/
?>

<?php $this->load->view(FRONTEND.'instagram'); ?>

<style type="text/css">
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;   
    cursor: inherit;
    display: block;
}
.fom-se .checkbox label p {
    color: #000;
}
span.btn-attach {
    background: #fff;
    line-height: 30px;
}
.fom-se .checkbox .cr {
    border-radius: 3px;
    background: #fff;
}
</style>
<div class="yellow-gry-se">
    <div class="gry-se">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-md-offset-2">
                    <div class="sub-title-box">
                        <h3>Tell us what we should publish next!</h3>
                        <div class="msgsuccess"></div>
                        <p>We are always on the lookout for exciting stories in education. <br>
                        Feel free to submit an article or nominate a topic of interest.</p>
                    </div>
                    <div class="fom-se">
                        <form method="post" id="instaReviewForm" name="instaReviewForm" enctype="multipart/form-data">
                            <div class="row">
                                <div id="not-anonymous-div">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="fname" class="form-control" placeholder="Your name or alias">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="lname" class="form-control" placeholder="Your surname">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Your email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Tell us a little bit about your story"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- <div class="form-group">
                                        <span class="btn btn-attach btn-file form-control">
                                            Attach a file <input type="file" name="attachment" multiple="multiple">
                                        </span>
                                        <div id="attachment-div" style="display: none;"></div>
                                    </div> -->
                                    <div id="bulletinImages" class="dm-uploader p-5 text-center">
                                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop Your Images here</h3>
                                        <div class="btn btn-primary mb-5">
                                            <span>Open the file Browser</span>
                                            <input type="hidden" name="bulletinImagesFile" id="bulletinImagesFile">
                                            <input type="file" name="school_logo" title='Click to add Files' />
                                        </div>
                                        <div class="">  
                                            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                                               <li class="text-muted text-center empty">No files uploaded.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label style="font-size: 1em">
                                                <input type="checkbox" name="anonymous" id="anonymous">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                <p>I would like to remain anonymous</p>
                                            </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" name="submitBtn" class="btn-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="<?= ADMINPATH.'fileupload/js/jquery.dm-uploader.js'; ?>"></script>
<script src="<?= ADMINPATH.'fileupload/js/file_upload.js'; ?>"></script>

<script type="text/javascript">
$("#frm_question").validate({
    ignore: [],
    rules: {                
        que_1: { required: true },
        que_2: { required: true },
        que_3: { required: true },
    },
    messages: {
        que_1: { required: 'Enter Select' },
        que_2: { required: 'Enter answer' },
        que_3: { required: 'Enter answer' },
    },
    errorElement: "span",
    errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass("text-danger");
        if (element.prop( "type" ) === "checkbox") {
            error.insertAfter(element.parent( "label") );
        } else {
            error.insertAfter(element.parent());
        }
    },
    highlight: function ( element, errorClass, validClass ) {
        //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        //$( element ).parents( ".col-md-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
    },

    submitHandler: function (form) {
        var formData = new FormData($(form)[0]);
        $.ajax({
            url: '<?php echo base_url(); ?>save-question',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            success: function (response) {
                if(response.result == 'error'){
                    $('.msgsuccess').html('<div class="alert alert-danger">'+response.msg+'</div>');
                }else{
                    $('.msgsuccess').html('<div class="alert alert-success">'+response.msg+'</div>');
                    $('#frm_question')[0].reset();
                }
            },
            error: function(){
                $('.msgsuccess').html('<div class="alert alert-danger">Some things went wrong</div>');
            }
        });
        return false;
    }
});
</script>
<script type='text/javascript'>
$(document).ready(function(){

    $("#instaReviewForm").validate({
        ignore: [],
        rules: {
            fname: { 
                required: function(element) {
                   return $('#anonymous').prop('checked') == false
                }
            },
            lname: { 
                required: function(element) {
                   return $('#anonymous').prop('checked') == false
                }
            },
            email: { 
                required: function(element) {
                   return $('#anonymous').prop('checked') == false
                }
            },
            message: { required: true }
        },
        messages: {
            fname: { required: "Please Enter First Name" },
            lname: { required: "Please Enter Last Name" },
            email: { required: "Please Enter Email" },
            message: { required: "Please Enter About your story" }
        },
        errorElement: "span",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass("text-danger");
            if (element.prop( "type" ) === "checkbox") {
                error.insertAfter(element.parent( "label") );
            } else if(element.hasClass("phone")){
                error.insertAfter(element.parent(".input-group"));
            } else if(element.hasClass("funding")){
                error.insertAfter(element);
            } else if (element.prop( "type" ) === "file") {
                // error.insertAfter(element.parent());
                element.parent().parent().append(error);
            } else if(element.hasClass('rating-tooltip')) {
                error.insertAfter(element.parent());
                error.addClass('mt-15');
                $('<br>').insertAfter(error);
            } else {
                error.insertAfter(element.parent());
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            //$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            //$( element ).parents( ".col-md-6 col-sm-6,.col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        submitHandler: function (form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().FRONTEND.'Bulletin/submit_insta_review' ?>',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    data = jQuery.parseJSON(data);
                    $('#instaReviewForm')[0].reset();
                    $('#files').html('');
                    msgEle = $('.sub-title-box').find('.msgsuccess');
                    if(data.success) {
                        $(msgEle).html('<div class="alert alert-success alert-dismissible">\
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
                          <strong>Success!</strong> '+data.message+'.\
                        </div>');
                    }
                    else {
                        $(msgEle).html('<div class="alert alert-danger alert-dismissible">\
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
                          <strong>Error!</strong> '+data.message+'.\
                        </div>');
                    }
                }
            });
            return false;
        }
    });

    $('#anonymous').on('change',function() {
        if($('#anonymous').prop('checked')) {
            $('#not-anonymous-div').hide();
        }
        else {
            $('#not-anonymous-div').show();
        }
    });
    
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $('.step-1').on('click',function() {
        if($('input[name="que_1"]').val() != '') {
            
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else {
            return false;
        }
    
    });

    $('.step-2').on('click',function() {
        var ans_val = $("input[name='que_2']:checked").val();                
        if(ans_val) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else {
            return false;
        }            
    });

    $('.step-3').on('click',function() {
        var ans_val = $("input[name='que_3']:checked").val();                
        if(ans_val) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else {
            return false;
        }            
    });

    $('.step-4').on('click',function() {
        var ans_val = $("input[name='que_4']:checked").val();                
        if(ans_val) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else {
            return false;
        }            
    });

    $('.step-5').on('click',function() {
        var ans_val = $("input[name='que_5']:checked").val();                
        if(ans_val) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else {
            return false;
        }            
    });

    $('.step-6').on('click',function() {
        if($('input[name="que_6"]').val() != '') {                    
            $("frm_question").submit();
        }
        else {
            return false;
        }           
    });

    $('.btn-attach input').on('change',function(e) {
        if($(this).val() != '') {
            $('#attachment-div').show();
            var files = $(this).prop('files');
            var names = $.map(files, function(val) { return val.name; });
            var html = 'Attached Files: <br>';
            $(names).each(function(k,v) {
                html += v+'<br>';
            });
            $('#attachment-div').html(html);
        }
        else {
            $('#attachment-div').html('');
        }
    });

    // var flag = false;
    $(".next-step-").click(function (e) {

        /*var parent_fieldset = $(this).parents('.tab-pane');
        console.log(parent_fieldset);

        var next_step = true;
        if(flag) {
            myFlag = true;    
        } 

        parent_fieldset.find('.cls').each(function() {
            if($(this).val() == "") {
                // console.log($(this));
                if($(this).attr('id') != 'tfeed' && $(this).attr('id') != 'ffeed')
                {
                    $(this).addClass('input-error');
                    next_step = false;
                }
            }
            else {
                $(this).removeClass('input-error');
            }
            console.log($(this).val());
        });
        console.log(next_step);
        return false;*/

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
    

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    $(document).on('click','.run_filter',function(){   
        var most_search = $(this).attr('data-id');         
        if (typeof most_search === "undefined") {
            var searchtxt = $('#searchtxt').val();
        }else{
            var searchtxt = most_search;
        }
        var sort_by = $( "#order_date option:selected" ).val();
        var context = $( "#context option:selected" ).val();
        
        var category = [];
        $. each($("input[name='type[]']:checked"), function(){
            category.push($(this).val());
        });
        var popularity = $( "#popularity option:selected" ).val();
        loadPagination(0,searchtxt,category,sort_by,context,popularity);
    });

    $(document).on('change','.run_filter_select',function(){            
        var searchtxt = $('#searchtxt').val();
        var sort_by = $( "#order_date option:selected" ).val();
        var context = $( "#context option:selected" ).val();
        var category = [];
        $. each($("input[name='type[]']:checked"), function(){
            category.push($(this).val());
        });
        var popularity = $( "#popularity option:selected" ).val();
        
        loadPagination(0,searchtxt,category,sort_by,context,popularity);
    });

    $('#pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        //loadPagination(pageno,CategoryArray);

        var searchtxt = $('#searchtxt').val();
        var sort_by = $( "#order_date option:selected" ).val();
        var context = $( "#context option:selected" ).val();
        var category = [];
        $. each($("input[name='type[]']:checked"), function(){
            category.push($(this).val());
        });
        var popularity = $( "#popularity option:selected" ).val();
        
        loadPagination(pageno,searchtxt,category,sort_by,context,popularity);

    });

    let searchText = $("#searchtxt").val();
    loadPagination(0,searchText);


    // Load pagination
    function loadPagination(pagno,searchText=null,category=null,sort_by=null,context=null,popularity=null){
        $(".loadermain").fadeIn();
        $.ajax({
            url: '<?=base_url()?>user/Bulletin/loadRecord/'+pagno,
            type: 'get',
            dataType: 'json',
            method:'post',
            data : {
                    searchText:searchText,
                    categoryName:category,
                    context:context,
                    sort_by:sort_by,
                    popularity:popularity
                },
            success: function(response){
                $("#no_of_item").html(response.no_of_item + " articles");
                $('#pagination').html(response.pagination);
                createList(response.result,response.row,response.redirect);
            },
            complete: function() {
                //$(".loadermain").addClass('hide');
                $(".loadermain").fadeOut();
            },
        });
    }

    
    function createList(result,sno,redirect){
        
        sno = Number(sno);
        $('#bulletin_list').empty();
        for(index in result){
          
            var id = result[index].id;
            var md5id = result[index].md5id;
            var title = result[index].title;
            var school_name = result[index].school_name;
            var teacher_name = result[index].teacher_name;
            var total_like = result[index].total_like;
            var image = result[index].image;
            var type = result[index].type;
            var content = result[index].description;
            var uid = result[index].uid;
            content = content.substr(0, 50) + " ...";
            content = strip_tags(content);
            sno+=1;
            var school_id   = result[index].school_id;    
            var teacher_id  = result[index].teacher_id;    
            school_name = '';
            // school_name = 'tagged ';
            if(school_name == null && teacher_name == null){
                school_name = '';
            }else{
                if(result[index].teacher_name != null)
                {
                    let url = '<?php echo base_url('teacher/') ?>' + teacher_id;
                    // school_name = 'tagged Kellyvalle '+teacher_name;                    
                    // school_name = 'tagged '+result[index].keyword_tags;                    
                    // school_name += 'tagged : ' +result[index].teacher_name+", "; 
                    school_name += '<a href='+url+'>'+result[index].teacher_name+'</a> ' +'<br>';
                }
                if(result[index].school_name != null){
                    let url = '<?php echo base_url('school/') ?>' + school_id;
                    // school_name = 'tagged Kellyvalle '+school_name;                                            
                    // school_name = 'tagged '+result[index].keyword_tags;
                    school_name += '<a href='+url+'>'+result[index].school_name+'</a> ';
                }
            }
            if(image.length == 0){
                img = '<?php echo ASSETPATH.'images/default-image.png'; ?>';
            }else{
                img = '<?php echo base_url().BlogPath; ?>'+image;
            }
            
            var curr_userid = '<?= $this->session->USER['UId']; ?>';
            var liked_color = '';
            if(curr_userid==uid) {
                var liked_color = 'liked_color';
            }

            var like_link ='<a href="javascript:void(0);" data-id="'+id+'" class="heart-btn-bulletin likebtn_bulletin '+liked_color+' "><i class="fa fa-heart"></i><span class="likecount">'+total_like+'</span> </a>';
            
            var link = '<?php echo base_url().'bulletin-detail/'; ?>'+md5id;
            var row = '<div class="col-lg-3 col-md-4 col-sm-6">';
                row += '<div class="pro-slide-box bulletin">';
                row += '<span class="like-icon-heart">'+like_link+'</span>';                               
                row += '<div class="pro-img">';
                row += '<a href="'+link+'">';
                row += '<img src="'+img+'" alt="..." class="img-thumbnail"></a>';
                row += ' </a>';
                row += '</div>';

                row += '<h4><a href="'+link+'">'+title+'</a></h4>';
                row += '<p>'+content+'</p>';
                row += '<div class="bottom-logo-text ">';
                row += '<p>'+school_name+'</p>';
                row += '</div>';

                row += '<a href="'+link+'" class="bulletin-readmore">Read More</a>';
                row += '</div>';
                row += '</div>';


            $('#bulletin_list').append(row);

        }
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
    }

});




function strip_tags(str, allow){ 
 // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>) 
 allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); 
 
 var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi; 
 var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi; 
 return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) { 
 return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :''; 
 }); 
} 
</script>
<script type="text/javascript">
$(function() {
    $('#bulletinImages').dmUploader({ //
      url: '<?= base_url(ADMIN.'Bulletin/upload_files'); ?>',
      maxFileSize: 30000000, // 3 Megs max
      multiple: true,
      allowedTypes: 'image/*',
      content: 'application/json',
      extFilter: ['jpg','png','jpeg','pdf','docx','doc'],
      onDragEnter: function(){
         // Happens when dragging something over the DnD area
         this.addClass('active');
      },
      onDragLeave: function(){
         // Happens when dragging something OUT of the DnD area
         this.removeClass('active');
      },
      onInit: function(){
         // Plugin is ready to use
         ui_add_log('Penguin initialized :)', 'info');
         //this.find('input[type="text"]').val('');
      },
      onComplete: function(){
         // All files in the queue are processed (success or error)
         ui_add_log('All pending tranfers finished');
      },
      onNewFile: function(id, file){
         // When a new file is added using the file selector or the DnD area
         ui_add_log('New file added #' + id);
         if (typeof FileReader !== "undefined"){
            var reader = new FileReader();
            var img = this.find('img');
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
         }
         ui_multi_add_file(id, file, this);
      },
      onBeforeUpload: function(id){
         // about tho start uploading a file
         ui_add_log('Starting the upload of #' + id);
         /*ui_single_update_progress(this, 0, true);      
         ui_single_update_active(this, true);
         ui_single_update_status(this, 'Uploading...');*/
         ui_multi_update_file_progress(id, 0, '', true);
         ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      },
      onUploadProgress: function(id, percent){
         // Updating file progress
         /*ui_single_update_progress(this, percent);*/
         ui_multi_update_file_progress(id, percent);
      },
      onUploadSuccess: function(id, data) {
         $(id).find('.status').html('');
         var customData = jQuery.parseJSON(data);
         // console.log(customData.path);
         var response = JSON.stringify(data);
         // A file was successfully uploaded
         ui_add_log('Server Response for file #' + id + ': ' + response);
         ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
         /*ui_single_update_active(this, false);*/
         // You should probably do something with the response data, we just show it
         // this.find('input[type="text"]').val(customData.path);
         let bulletinImagesVal = $('#bulletinImagesFile').val();
         let newArr = [];
         if(bulletinImagesVal != '') {
            // console.log(bulletinImagesVal);
            newArr = jQuery.parseJSON(bulletinImagesVal);
            newArr.push(customData.path);
         }
         else {
            newArr.push(customData.path);
         }
         newArr = JSON.stringify(newArr);
         $('#bulletinImagesFile').val(newArr);
         /*ui_single_update_status(this, 'Upload completed.', 'success');*/
         ui_multi_update_file_status(id, 'success', 'Upload Complete');
         ui_multi_update_file_progress(id, 100, 'success', false);
      },
      onUploadError: function(id, xhr, status, message){
         // Happens when an upload error happens
         /*ui_single_update_active(this, false);
         ui_single_update_status(this, 'Error: ' + message, 'danger');*/
         ui_multi_update_file_status(id, 'danger', message);
         ui_multi_update_file_progress(id, 0, 'danger', false);
      },
      onFallbackMode: function(){
         // When the browser doesn't support this plugin :(
         ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
      },
      onFileSizeError: function(file){
         ui_single_update_status(this, 'File excess the size limit', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      },
      onFileTypeError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
         ui_single_update_status(this, 'Please Select Image Only', 'danger');
         ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
   });

});
</script>
<!-- File item template -->
<script type="text/html" id="files-template">
   <li class="media">
      <hr class="mt-1 mb-1" />
      <div class="media-body mb-1">
         <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
         </p>
         <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
      </div>
   </li>
</script>