<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
<section class="content-header">
   <h1> Dashboard</h1>
</section>
<section class="content">
    <?php $this->load->view(ADMIN.'include/message'); $cc = 'fa-check'; ?>
    <div class="row top-margin">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($school); ?></h3>
                    <p>School</p>
                </div> <a href="<?= base_url(ADMIN.'manage-school') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($teacher); ?></h3>
                    <p>Teacher</p>
                </div> <a href="<?= base_url(ADMIN.'manage-teacher') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($user); ?></h3>
                    <p>Users</p>
                </div> <a href="<?= base_url(ADMIN.'users') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($tbl_calendar); ?></h3>
                    <p>Pending events for approval</p>
                </div> <a href="<?= base_url(ADMIN.'manage-calendar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($school_nofitifation_review); ?></h3>
                    <p>Negative written reviews for approval (School)</p>
                </div> <a href="<?= base_url(ADMIN.'manage-review/school') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo count($teacher_nofitifation_review); ?></h3>
                    <p>Negative written reviews for approval (Teacher)</p>
                </div> <a href="<?= base_url(ADMIN.'manage-review/teacher') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Top School Profile</h4>
            </div>
            <!-- <div class="card-body text-center " id="new_user_chart_container"> -->
                <canvas id="top_school" height="150"></canvas>
            <!--  -->
        </div>
        <div class="col-md-6">
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Top Teacher Profile</h4>
            </div>
            <!-- <div class="card-body text-center " id="new_user_chart_container"> -->
                <canvas id="top_teacher" height="150"></canvas>
            <!--  -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Users Registration</h4>
            </div>
            <!-- <div class="card-body text-center " id="new_user_chart_container"> -->
                <canvas id="new_user_chart" height="150"></canvas>
            <!--  -->
            
        </div>

        <div class="col-md-4">
            
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Review Counter for Schools & Teachers</h4>
            </div>
            <!-- <div class="card-body text-center " id="new_user_chart_container"> -->
                <canvas id="review_counter" height="150"></canvas>
            <!--     -->
            
        </div>

        <div class="col-md-4">
            
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Review for Schools & Teachers</h4>
            </div>
            <!-- <div class="card-body text-center " id="new_user_chart_container"> -->
                <canvas id="new_review" height="150"></canvas>
            <!--     -->
            
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Traffic Of Weekly Engagement</h4>
            </div>
            <canvas id="traffic_weekly_engagement" height="150"></canvas>
        </div>
        <div class="col-md-6">
            <div class="card-header">
                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Traffic Of Monthly Engagement</h4>
            </div>
            <canvas id="traffic_monthly_engagement" height="150"></canvas>
        </div>
    </div>

</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
<script type="text/javascript">

top_school();
function top_school()
{
    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/top_school" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {
            new Chart(document.getElementById("top_school"),
            {
                "type":"bar",
                "data":{
                    "labels": data.schools,
                    "datasets":[
                    {
                        "label": "Top School Profile",
                        "data": data.count,
                        "fill":false,
                        "backgroundColor":"rgba(255, 99, 132, 0.2)",
                        "borderColor":"rgb(255, 99, 132)",
                        "borderWidth":1,

                    }]
                },
                "options":
                {
                    "scales":
                    {
                        "yAxes":[
                        {
                            "ticks": {
                                // "beginAtZero":true 
                                /*"suggestedMin": 0,
                                "suggestedMax": 50,*/
                            }
                        }],
                        "xAxes": [{
                            "ticks": {
                                callback: function(value, index, values) {
                                    value = value.substring(0,20);
                                    return value;
                                }
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

top_teacher();
function top_teacher()
{
    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/top_teacher" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {
            new Chart(document.getElementById("top_teacher"),
            {
                "type":"bar",
                "data":{
                    "labels": data.teachers,
                    "datasets":[
                    {
                        "label": "Top Teacher Profile",
                        "data": data.count,
                        "fill":false,
                        "backgroundColor":"rgba(255, 99, 132, 0.2)",
                        "borderColor":"rgb(255, 99, 132)",
                        "borderWidth":1,

                    }]
                },
                "options":
                {
                    "scales":
                    {
                        "yAxes":[
                        {
                            "ticks": {
                                // "beginAtZero":true 
                                /*"suggestedMin": 0,
                                "suggestedMax": 50,*/
                            }
                        }],
                        "xAxes": [{
                            "ticks": {
                                callback: function(value, index, values) {
                                    value = value.substring(0,20);
                                    return value;
                                }
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

new_user_chart();
function new_user_chart()
{
    /*$('#new_user_chart').remove(); // this is my <canvas> element
    $('#new_user_chart_container').append('<canvas id="new_user_chart" height="100"><canvas>');*/

    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/new_user_chart" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {
            new Chart(document.getElementById("new_user_chart"),
            {
                "type":"horizontalBar",
                "data":{
                    "labels": [],
                    "datasets":[
                    {
                        "label":"This Week",
                        "data":[data.first_week],
                        "fill":false,
                        "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                        "borderColor":["rgb(255, 99, 132)"],
                        "borderWidth":1,

                    },
                    {
                        "label":"Last Week",
                        "data":[data.sec_week],
                        "fill":false,
                        "backgroundColor":["rgba(255, 159, 64, 0.2)"],
                        "borderColor":["rgb(255, 159, 64)"],
                        "borderWidth":1
                    }]
                },
                "options":
                {
                    "scales":
                    {
                        "xAxes":[
                        {
                            "ticks": {
                                // "beginAtZero":true 
                                "suggestedMin": 0,
                                "suggestedMax": 50,
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

review_counter();

function review_counter()
{
    /*$('#review_counter').remove(); // this is my <canvas> element
    $('#review_counter_container').append('<canvas id="review_counter" height="100"><canvas>');*/

    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/review_counter" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {

            new Chart(document.getElementById("review_counter"),
            {
                "type":"horizontalBar",
                "data": {
                    "labels": [],
                    "datasets":[
                    {
                        "label":"School",
                        "data":[data.school],
                        "fill":false,
                        "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                        "borderColor":["rgb(255, 99, 132)"],
                        "borderWidth":1,
                    },
                    {
                        "label":"Teacher",
                        "data":[data.teacher],
                        "fill":false,
                        "backgroundColor":["rgba(255, 159, 64, 0.2)"],
                        "borderColor":["rgb(255, 159, 64)"],
                        "borderWidth":1
                    }]
                },
                "options": {
                    "scales": {
                        "xAxes": [
                        {
                            "ticks": {
                                "beginAtZero":true 
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

new_review()
function new_review()
{
    /*$('#new_review').remove(); // this is my <canvas> element
    $('#new_review_container').append('<canvas id="new_review" height="100"><canvas>');*/

    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/new_review" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {
            new Chart(document.getElementById("new_review"),
            {
                "type":"horizontalBar",
                "data": {
                    "labels": [],
                    "datasets":[
                    {
                        "label":"School Last Week",
                        "data":[data.school[0]],
                        "fill":false,
                        "backgroundColor":["rgba(1, 12, 97, 0.6)"],
                        "borderColor":["rgb(1, 12, 97)"],
                        "borderWidth":1,
                    },
                    {
                        "label":"School This Week",
                        "data":[data.school[1]],
                        "fill":false,
                        "backgroundColor":["rgba(54, 74, 239,0.5)"],
                        "borderColor":["rgb(54, 74, 239)"],
                        "borderWidth":1
                    },
                    {
                        "label":"Teacher Last Week",
                        "data":[data.teacher[0]],
                        "fill":false,
                        "backgroundColor":["rgba(4, 95, 4,0.5)"],
                        "borderColor":["rgb(4, 95, 4)"],
                        "borderWidth":1,
                    },
                    {
                        "label":"Teacher This Week",
                        "data":[data.teacher[1]],
                        "fill":false,
                        "backgroundColor":["rgba(61, 226, 61,0.5)"],
                        "borderColor":["rgb(61, 226, 61)"],
                        "borderWidth":1
                    }]
                },
                "options":
                {
                    "scales":
                    {
                        "xAxes": [
                        {
                            "ticks": {
                                // "beginAtZero":true 
                                "suggestedMin": 0,
                                "suggestedMax": 50,
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

traffic_weekly_engagement()
function traffic_weekly_engagement()
{
    /*new Chart(document.getElementById("traffic_weekly_engagement"),
    {
        "type": 'line',
        "data": {
            "datasets": [{
                "label": 'First dataset',
                "data": [0, 20, 40, 50, 30, 20, 25],
                "fill":false,
                "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                "borderColor":["rgb(255, 99, 132)"],
                "borderWidth":1,
            }],
            "labels": ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday']
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "suggestedMin": 50,
                        "suggestedMax": 100
                    }
                }]
            }
        }
    });*/
    
    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/traffic_weekly_engagement" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {

            var day = [];
            var activity = [];
            var day = [];
            var activity = [];

            for(var i in data) {
                day.push(data[i].day);
                activity.push(data[i].activity);
            }

            new Chart(document.getElementById("traffic_weekly_engagement"),
            {
                "type": 'line',
                "data": {
                    "datasets": [{
                        "label": 'Traffic Of Weekly Engagement',
                        "data": activity,
                        "fill":true,
                        "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                        "borderColor":["rgb(255, 99, 132)"],
                        "borderWidth":1,
                    }],
                    "labels": day
                },
                "options": {
                    "scales": {
                        "yAxes": [{
                            "ticks": {
                                // "beginAtZero":true
                                "suggestedMin": 0,
                                "suggestedMax": 50
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

traffic_monthly_engagement()
function traffic_monthly_engagement()
{
    /*new Chart(document.getElementById("traffic_monthly_engagement"),
    {
        "type": 'line',
        "data": {
            "datasets": [{
                "label": 'First dataset',
                "data": [0, 20, 40, 50, 30, 20, 25],
                "fill":false,
                "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                "borderColor":["rgb(255, 99, 132)"],
                "borderWidth":1,
            }],
            "labels": ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday']
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "suggestedMin": 50,
                        "suggestedMax": 100
                    }
                }]
            }
        }
    });*/
    
    $.ajax({
        url: "<?php echo ADMIN_LINK."Home/traffic_monthly_engagement" ?>",
        method: "POST",
        dataType: "json",
        data :{},
        success: function(data) {

            var day = [];
            var activity = [];
            var day = [];
            var activity = [];

            for(var i in data) {
                day.push(data[i].day);
                activity.push(data[i].activity);
            }

            new Chart(document.getElementById("traffic_monthly_engagement"),
            {
                "type": 'line',
                "data": {
                    "datasets": [{
                        "label": 'Traffic Of Monthly Engagement',
                        "data": activity,
                        "fill":true,
                        "backgroundColor":["rgba(255, 99, 132, 0.2)"],
                        "borderColor":["rgb(255, 99, 132)"],
                        "borderWidth":1,
                    }],
                    "labels": day
                },
                "options": {
                    "scales": {
                        "yAxes": [{
                            "ticks": {
                                // "beginAtZero":true
                                "suggestedMin": 0,
                                "suggestedMax": 50
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>