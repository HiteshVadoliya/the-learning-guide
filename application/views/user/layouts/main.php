<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title><?php echo $pageTitle; ?></title>    
    <link href="<?php echo FRONTENDPATH ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo FRONTENDPATH ?>css/style.css?i=<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" href="<?php echo FRONTENDPATH ?>images/favicon.png" type="images/favicon.png" sizes="16x16">
    <link href="<?php echo FRONTENDPATH ?>css/responsive.css?i=<?php echo time(); ?>" rel="stylesheet">
    <!-- <link href="<?php echo FRONTENDPATH ?>css/fontawesome.css" rel="stylesheet"> -->
    <link href="<?php echo FRONTENDPATH ?>css/slider1.css" rel="stylesheet">
    <link href="<?php echo FRONTENDPATH ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <link href="<?php echo FRONTENDPATH ?>css/custom.css?i=<?php echo time(); ?>" rel="stylesheet">
    <link href="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">
    
    <script src="<?php echo FRONTENDPATH ?>js/jquery-2.2.3.min.js"></script>
    <?php if(isset($robot)) : ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- <script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script> -->
    <?php endif ?>
</head>
<body>
    
    <!-- Loader all pages-->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
              <div class="spinner-wrapper">
                <div class="rotator">
                  <div class="inner-spin"></div>
                  <div class="inner-spin"></div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <!-- ========== Header Start ========== -->
    <?php echo $header; ?>
    <!-- ========== Header Start ========== -->

    <!-- ========== Body Start ========== -->
    <?php echo $content_body; ?>
    <!-- ========== Body Start ========== -->    

    <!-- ========== Footer Start ========== -->
    <?php echo $footer; ?>
    <!-- ========== Footer Start ========== -->

    <script src="<?php echo FRONTENDPATH ?>js/bootstrap.min.js"></script>
    <!-- CK Editor -->
    <script src="<?= ADMINPATH.'plugins/ckeditor/ckeditor.js'; ?>"></script>
    <script src="<?= ADMINPATH.'plugins/ckeditor/adapters/jquery.js'; ?>"></script>
    <!-- <script src="<?php echo FRONTENDPATH ?>js/fontawesome.js"></script> -->
    <!-- Sweet-Alert  -->
    <script src="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="<?php echo ASSETPATH; ?>plugins/bootstrap-sweetalert/jquery.sweet-alert.init.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip(); 
            
            $('.removeCompareSchool').on('click', function() {
                let value = $(this).attr('data-id');
                let element = $(this).parents('li')[0];
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Home/remove_compare_school') ?>',
                    data: { schoolId: value },
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        if(data.success) {
                            $('#popoverOpener').find('span').html(data.count);
                            $('.popover-title').find('span.count').html(data.count);
                            $(element).remove();
                            if(data.count <= 1) {
                                $('#compareBtn').attr('href','javascript:void(0);');
                            }
                            else {
                                $('#compareBtn').attr('href','<?php echo base_url('compare-school'); ?>');
                            }
                        }
                    }
                });
            });

            $('.removeCompareTeacher').on('click', function() {
                let value = $(this).attr('data-id');
                let element = $(this).parents('li')[0];
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Home/remove_compare_teacher') ?>',
                    data: { teacherId: value },
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        if(data.success) {
                            $('#popoverOpener').find('span').html(data.count);
                            $('.popover-title').find('span.count').html(data.count);
                            $(element).remove();
                            if(data.count <= 1) {
                                $('#compareTeacherBtn').attr('href','javascript:void(0);');
                            }
                            else {
                                $('#compareTeacherBtn').attr('href','<?php echo base_url('compare-teacher'); ?>');
                            }
                        }
                    }
                });
            });

            $('#compareBtn').on('click', function() {
                let href = $(this).attr('href');
                if(href == 'javascript:void(0);') {
                    swal('Warning', 'You have to select Another school(s) for compare', 'warning');
                }
            });

            $('#compareTeacherBtn').on('click', function() {
                let href = $(this).attr('href');
                if(href == 'javascript:void(0);') {
                    swal('Warning', 'You have to select Another teacher(s) for compare', 'warning');
                }
            });

            $('#clearAllCompare').on('click',function() {
                let element = $('.popover-content').find('ul');
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Home/clearall_compare') ?>',
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        if(data.success) {
                            $('#popoverOpener').find('span').html(data.count);
                            $('.popover-title').find('span.count').html(data.count);
                            $('#popoverWrapper').addClass('hide');
                            $(element).html('');
                            $('#compareBtn').attr('href','javascript:void(0);');
                            $('#compareTeacherBtn').attr('href','javascript:void(0);');
                            $('#compareBtn').addClass('hide');
                            $('#compareTeacherBtn').addClass('hide');
                            window.location.href = "<?php echo base_url(); ?>";
                        }
                    }
                });
            });

            window.onscroll = function() {
                myFunction()
            };
            var header = document.getElementById("myHeader");
            var sticky = header.offsetTop;
            function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            }
            
        });


        'use strict';
        class Popover {
            constructor(element, trigger, options) {
                this.options = { // defaults
                    position: Popover.BOTTOM
                };
                this.element = element;
                this.trigger = trigger;
                this._isOpen = false;
                Object.assign(this.options, options);
                this.events();
                this.initialPosition();
            }
            events() {
                this.trigger.addEventListener('click', this.toggle.bind(this));
            }
            initialPosition() {
                let triggerRect = this.trigger.getBoundingClientRect();
                this.element.style.top = ~~triggerRect.top + 'px';
                this.element.style.left = ~~triggerRect.left + 'px';
            }
            toggle(e) {
                e.stopPropagation();
                if (this._isOpen) {
                    this.close(e);
                } else {
                    this.element.style.display = 'block';
                    this._isOpen = true;
                    this.outsideClick();
                    this.position();
                }
            }
            targetIsInsideElement(e) {
                let target = e.target;
                if (target) {
                    do {
                        if (target === this.element) {
                            return true;
                        }
                    }
                    while (target = target.parentNode);
                }
                return false;
            }
            close(e) {
                /**/
                let myArr = ['removeCompareSchool','clearAllCompare']
                let element = e.path[1];
                let checkClass = $(element).hasClass('removeCompareSchool');
                let id = '';
                if(!checkClass) {
                    id = $(element)[0].id;
                }
                let class1 = $(element).attr('class');
                let flag = false;
                if((jQuery.inArray(class1, myArr) !== -1) || (jQuery.inArray(id, myArr) !== -1)) {
                    flag = true;
                }
                /**/
                if (!this.targetIsInsideElement(e)) {
                    if(!flag) {
                        this.element.style.display = 'none';
                        this._isOpen = false;
                        this.killOutSideClick();
                    }
                }
            }
            position(overridePosition) {
                let triggerRect = this.trigger.getBoundingClientRect(),
                elementRect = this.element.getBoundingClientRect(),
                position = overridePosition || this.options.position;
                this.element.classList.remove(Popover.TOP, Popover.BOTTOM, Popover.LEFT, Popover.RIGHT); // remove all possible values
                this.element.classList.add(position);
                if (position.indexOf(Popover.BOTTOM) !== -1) {
                    this.element.style.left = ~~triggerRect.left + ~~((triggerRect.width / 2) - ~~(elementRect.width / 2)) + 'px';
                    this.element.style.top = ~~triggerRect.bottom + 'px';
                } else if (position.indexOf(Popover.TOP) !== -1) {
                    this.element.style.left = ~~triggerRect.left + ~~((triggerRect.width / 2) - ~~(elementRect.width / 2)) + 'px';
                    this.element.style.top = ~~(triggerRect.top - elementRect.height) + 'px';
                } else if (position.indexOf(Popover.LEFT) !== -1) {
                    this.element.style.top = ~~((triggerRect.top + triggerRect.height / 2) - ~~(elementRect.height / 2)) + 'px';
                    this.element.style.left = ~~(triggerRect.left - elementRect.width) + 'px';
                } else {
                    this.element.style.top = ~~((triggerRect.top + triggerRect.height / 2) - ~~(elementRect.height / 2)) + 'px';
                    this.element.style.left = ~~triggerRect.right + 'px';
                }
            }
            outsideClick() {
                document.addEventListener('click', this.close.bind(this));
            }
            killOutSideClick() {
                document.removeEventListener('click', this.close.bind(this));
            }
            isOpen() {
                return this._isOpen;
            }
        }
        Popover.TOP = 'top';
        Popover.RIGHT = 'right';
        Popover.BOTTOM = 'bottom';
        Popover.LEFT = 'left';
        document.addEventListener('DOMContentLoaded', function() {
            let btn = document.querySelector('#popoverOpener a'),
            template = document.querySelector('.popover'),
            pop = new Popover(template, btn, {
                position: Popover.BOTTOM
            }),
            links = template.querySelectorAll('.popover-content a');
            /*for (let i = 0, len = links.length; i < len; ++i) {
                let link = links[i];
                // console.log(link);
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    pop.position(this.className);
                    this.blur();
                    return true;
                });
            }*/
        });
    </script>


    <?php $this->load->view(FRONTEND.'notify'); ?>
    

</body>
</html>
