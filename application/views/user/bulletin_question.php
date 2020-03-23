<div class="gry-box-se">
    <!-- <div class="cat-5-img-se">
        <img src="<?php echo FRONTENDPATH ?>images/cat-5.png" alt="123">
    </div> -->
    <div class="container-fluid">
        <!-- <div class="ger-title">
            <h2>TELL US WHST YOU THINK</h2>
        </div> -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="container">
                    <div class="row">
                        <div class="msgsuccess"></div>
                        <section>
                            <div class="wizard">
                                <div class="wizard-inner">
                                    <div class="connecting-line"></div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" >
                                                <span class="round-tab">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled" >
                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" >
                                                <span class="round-tab">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled" >
                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" >
                                                <span class="round-tab">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled" >
                                            <a href="#step4" data-toggle="tab" aria-controls="step3" role="tab" >
                                                <span class="round-tab">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled" >
                                            <a href="#step5" data-toggle="tab" aria-controls="step3" role="tab" >
                                                <span class="round-tab">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled" >
                                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" >
                                                <span class="round-tab">
                                                    <i class="glyphicon glyphicon-ok"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <form role="form" name="frm_question" id="frm_question" action="javascript:;" method="post" >
                                    <div class="tab-content">
                                        <div class="tab-pane active text-center" role="tabpanel" id="step1">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>How motivated are you to study?</h3>
                                                </div>
                                                <div class="yse-no-section rang-slider-se">
                                                    <ul>
                                                        <li><i class="fa fa-briefcase"></i></li>
                                                        <li><div class="slidecontainer"><input type="range" min="1" max="100" value="10" class="slider cls" id="myRange" name="que_1"></div></li>
                                                    </ul>
                                                </div>
                                                <div class="vote-section">
                                                    <p><?= $ans_1; ?> votes</p>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <?php
                                              $CI =& get_instance();
                                              if(isset($this->session->USER['UId'])) {
                                              ?><li><button type="button" class="btn btn-default step-1 next-step ">Next</button></li>
                                                
                                            <?php } else {
                                                ?><li><a href="<?php echo base_url('login'); ?>" class="btn-1">Login</a></li><?php
                                                }?>


                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>Should schools provide a FREE lunch for students?</h3>
                                                </div>
                                                <div class="yse-no-section">
                                                    <ul>
                                                        <li>
                                                            <p>
                                                                <span class="yes-text-color">Yes</span>
                                                                <input class="cls" type="radio" name="que_2" value="1">
                                                                <?= $ans_2_yes; ?>%
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span>No</span>
                                                                <input class="cls" type="radio" name="que_2" value="0">
                                                                <?= $ans_2_no; ?>%
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="vote-section">
                                                    <p>14352 votes</p>
                                                </div> -->
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-default step-2 next-step ">Next</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step3">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>Do you think provate schools offer a better education than public schools?</h3>
                                                </div>
                                                <div class="yse-no-section">
                                                    <ul>
                                                        <li>
                                                            <p>
                                                                <span class="yes-text-color">Yes</span>
                                                                <input type="radio" name="que_3" value="1">
                                                                <?= $ans_3_yes; ?>%
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span>No</span>
                                                                <input type="radio" name="que_3" value="0">
                                                                <?= $ans_3_no; ?>%
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="vote-section">
                                                    <p>312 votes</p>
                                                </div> -->
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <!-- <li><button type="button" class="btn btn-default next-step">Skip</button></li> -->
                                                <li><button type="button" class="btn btn-default step-3 next-step">Next</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step4">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>Do you think your teachers require training on how to engage with students?</h3>
                                                </div>
                                                <div class="yse-no-section">
                                                    <ul>
                                                        <li>
                                                            <p>
                                                                <span class="yes-text-color">Yes</span>
                                                                <input type="radio" name="que_4" value="1">
                                                                <?= $ans_4_yes; ?>%
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span>No</span>
                                                                <input type="radio" name="que_4" value="0">
                                                                <?= $ans_4_no; ?>%
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="vote-section">
                                                    <p>154 votes</p>
                                                </div> -->
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <!-- <li><button type="button" class="btn btn-default next-step">Skip</button></li> -->
                                                <li><button type="button" class="btn btn-default step-4 next-step">Next</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>is having a degree going to increase your job prospects?</h3>
                                                </div>
                                                <div class="yse-no-section">
                                                    <ul>
                                                        <li>
                                                            <p>
                                                                <span class="yes-text-color">Yes</span>
                                                                <input type="radio" name="que_5" value="1">
                                                                <?= $ans_5_yes; ?>%
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span>No</span>
                                                                <input type="radio" name="que_5" value="0">
                                                                <?= $ans_5_no; ?>%
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="vote-section">
                                                    <p> votes</p>
                                                </div> -->
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <!-- <li><button type="button" class="btn btn-default next-step">Skip</button></li> -->
                                                <li><button type="button" class="btn btn-default step-5 next-step">Next</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="complete">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <div class="title-for-yes-no">
                                                    <h3>How much of what you learn at school is applicable to real life situations?</h3>
                                                </div>
                                                <div class="yse-no-section rang-slider-se">
                                                    <ul>
                                                        <li><i class="fa fa-briefcase"></i></li>
                                                        <li><div class="slidecontainer"><input type="range" min="1" max="100" value="10" class="slider" id="myRange" name="que_6"></div></li>
                                                    </ul>
                                                </div>
                                                <div class="vote-section">
                                                    <p><?= $ans_6; ?> votes</p>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="submit" class="btn btn-primary next-step">Save</button></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

          <!--   <div class="col-md-4">
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
            </ul> -->

        </div>
    </div>
</div>
</div>
</div>
</div>

