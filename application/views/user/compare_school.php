<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<style type="text/css">
.checked { color: #f1b500; }
.logo-of-brand img { border: none; }
.rwd-table a { color: #333; }
.rwd-table th, .rwd-table td {
    text-align: left;
}
textarea { resize: none; }
#chartdiv { width: 100%; height: 500px; }
.checked { color: #f1b500; }
#map { height: 500px; }
</style>
<?php
function table_rating($row,$compare)
{
    $CI =& get_instance();
    $ratingArr = range(20,100,20);
    foreach ($compare as $key => $value) {
        $school = $CI->common->get_one_row('tbl_school',array('id'=>$value));
        $reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(facilities) AS fac, AVG(culture) AS cul, AVG(staff) AS sta, AVG(curricullum) AS cur, AVG(fees) AS fee FROM `tbl_rating` WHERE `schoolId` = '".$value."' AND `isDelete` =0 AND (`facilities` != 0 OR `culture` != 0 OR `staff` != 0 OR `curricullum` !=0 OR `fees` != 0) GROUP BY schoolId";
        $reviews = $CI->common->cust_query($reviewsQuery);
        $reviews = (!empty($reviews)) ? $reviews[0] : array();
        if($row == 'title') {
        ?>
        <td data-th="Title">
            <div class="logo-of-brand">
                <?php
                if($school['school_logo'] != '' && file_exists(PhotosPath.$school['school_logo'])) {
                ?>
                <img src="<?php echo PhotosPath.$school['school_logo']; ?>" alt="">
                <?php
                }
                else {
                ?>
                <img src="<?php echo ASSETPATH.'images/default-image.png' ?>" alt="">
                <?php
                }
                ?>
                <h3><a href="<?php echo base_url('school/').md5($value); ?>"><?php echo ucwords($school['name']); ?></a></h3>
            </div>
        </td>
        <?php
        }
        else if($row == 'reviews') {
            $rating = $CI->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$value,'isDelete'=>0),'schoolId');
            $rating = (!empty($rating)) ? $rating[0] : array();
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                $total_rating = 0;
                if(!empty($rating)) {
                    $average_rating = $rating['average_rating'];
                    $total_rating = $rating['total_rating'];
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
                <li><?php echo $total_rating; ?> reviews</li>
            </ul>
        </td>
        <?php
        }
        else if($row == 'facilities') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['fac']);
                    $average_rating = ($average_rating * 5) / 100;
                    $average_rating = intval($average_rating);
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
            </ul>
        </td>
        <?php
        }
        else if($row == 'culture') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['cul']);
                    $average_rating = ($average_rating * 5) / 100;
                    $average_rating = intval($average_rating);
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
            </ul>
        </td>
        <?php
        }
        else if($row == 'staff') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['sta']);
                    $average_rating = ($average_rating * 5) / 100;
                    $average_rating = intval($average_rating);
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
            </ul>
        </td>
        <?php
        }
        else if($row == 'curricullum') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['cur']);
                    $average_rating = ($average_rating * 5) / 100;
                    $average_rating = intval($average_rating);
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
            </ul>
        </td>
        <?php
        }
        else if($row == 'fees') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['fee']);
                    $average_rating = ($average_rating * 5) / 100;
                    $average_rating = intval($average_rating);
                }
                for ($i=1; $i <= 5; $i++) {
                    $checked = ($i <= $average_rating) ? 'checked' : '';
                ?>
                <span class="fa fa-star <?php echo $checked; ?>"></span>
                <?php
                }
                ?>
            </ul>
        </td>
        <?php
        }
        else if($row == 'sector') {
            $sector = str_replace(',', ', ', $school['sector']);
            $sector = ucwords($sector);
        ?>
        <td data-th="title"><?php echo $sector; ?></td>
        <?php
        }
        else if($row == 'gender') {
            $gender = ucwords($school['gender']);
        ?>
        <td data-th="title"><?php echo $gender; ?></td>
        <?php
        }
        else if($row == 'religion') {
            $religion = ucwords($school['religion']);
        ?>
        <td data-th="title"><?php echo $religion; ?></td>
        <?php
        }
        else if($row == 'students') {
            $no_of_students = $school['no_of_students'];
            $student_key = '';
            if($no_of_students <= 200) {
                $student_key = '0-200';
            }
            if ($no_of_students > 200 && $no_of_students <= 500) {
                $student_key = '201-500';
            }
            if ($no_of_students > 500 && $no_of_students <= 1000) {
                $student_key = '501-1000';
            }
            if ($no_of_students > 1000) {
                $student_key = '1000+';
            }
        ?>
        <!-- <td data-th="title"><?php echo $no_of_students; ?></td> -->
        <td data-th="title"><?php echo $student_key; ?></td>
        <?php
        }
        else if($row == 'type') {
            $type = str_replace(',', ', ', $school['type']);
            $type = ucwords($type);
        ?>
        <td data-th="title"><?php echo $type; ?></td>
        <?php
        }
        else if($row == 'selective') {
            $selective = ($school['selective'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $selective; ?></td>
        <?php
        }
        else if($row == 'boarding') {
            $boarding = ($school['boarding'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $boarding; ?></td>
        <?php
        }
        else if($row == 'international_students') {
            $international_students = ($school['international_students'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $international_students; ?></td>
        <?php
        }
        else if($row == 'infrastructral_needs') {
            $infrastructral_needs = ($school['special_needs_support'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $infrastructral_needs; ?></td>
        <?php
        }
        else if($row == 'scholarship_offer') {
            $scholarship_offer = ($school['scholarship_offer'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $scholarship_offer; ?></td>
        <?php
        }
        else if($row == 'international_baccalaureate') {
            $international_baccalaureate = ($school['international_baccalaureate'] == '1') ? 'Yes' : 'No';
        ?>
        <td data-th="title"><?php echo $international_baccalaureate; ?></td>
        <?php
        }
        else if($row == 'rank') {
            $rank = 0;
            $rankQuery = 'SELECT @rownum := @rownum +1 AS rank,prequery.schoolId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT schoolId, COUNT(*) AS total_rating, AVG(rating) AS average_rating FROM tbl_rating GROUP BY schoolId ORDER BY average_rating DESC ) prequery';
            $rankData = $CI->common->cust_query($rankQuery);
            foreach ($rankData as $key => $value) {
                if($value['schoolId'] == $school['id']) {
                    $rank = $value['rank'];
                    break;
                }
            }
        ?>
        <td data-th="title"><?php echo $rank; ?></td>
        <?php
        }

    }
}
?>
<div class="Compare-schools-profile-page-se">
    <div class="slider-se">
        <div class="profile-banner-img-se">
            <div class="container">
                <div class="upper-text-se">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            <!-- <h1>Compare schools</h1> -->
                            <!-- <h3>Read or leave reviews, </h3>                           
                                <h3>Contact & Compare </h3>  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-text">
            <h3>“We all need people who will give us feedback. That's how we improve.”  Bill Gates</h3>
        </div>
    </div>
    <div class="">
        <div class="container">
            <?php
            if(empty($compare)) {
            ?>
            <div class="text-center nodata">
                <img src="<?php echo F_IMGPATH.'warning_icon.png' ?>" alt="No Data">
                <h4>There are No Schools for Compare. Please Select School</h4>
            </div>
            <?php
            }
            else if(count($compare) <= 1) {
            ?>
            <div class="text-center nodata">
                <img src="<?php echo F_IMGPATH.'warning_icon.png' ?>" alt="No Data">
                <h4>You have to select Atleast 2 Schools. Please Select School</h4>
                <a href="<?php echo base_url('schools'); ?>" class="btn btn-primary">Go to School Section</a>
            </div>
            <?php
            }
            else {
            ?>
            <div class="ger-title">
                <h2 class="text-center">School Comparison Chart</h2>
            </div>
            <!-- <h3 class="text-center cursive">Find the right school for you</h3> -->
            <table class="rwd-table">
                
                <tr class="text-center">
                    <th ></th>
                    <th tdata-th="Title" class="sidebar-tab-with-table" colspan=""></th>
                    <?php echo table_rating('title',$compare); ?>
                </tr>

                <tr class="sidebar-tab-with-table">
                    <td rowspan="8" style="background: #fd8652;border-radius: 30px 0 0 30px;">
                        <p style="font-weight: bold;writing-mode: tb-rl;transform: rotate(180deg);color:#000;">Reviews</p>
                    </td>
                <tr>
                <tr class="text-center">
                    <td><strong>Star Ratings</strong></td>
                    <?php echo table_rating('reviews',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Facilities</strong></td>
                    <?php echo table_rating('facilities',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Culture</strong></td>
                    <?php echo table_rating('culture',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title" ><strong>Staff</strong></td>
                    <?php echo table_rating('staff',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Curriculum</strong></td>
                    <?php echo table_rating('curricullum',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Fees</strong></td>
                    <?php echo table_rating('fees',$compare); ?>
                </tr>
                <tr class="sidebar-tab-with-table">
                    <td rowspan="13" style="background: #fae60a;border-radius: 30px 0 0 30px;">
                        <p style="font-weight: bold;writing-mode: tb-rl;transform: rotate(180deg);color:#000;">Backgrounder</p>
                    </td>
                <tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Sector</strong></td>
                    <?php echo table_rating('sector',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Gender</strong></td>
                    <?php echo table_rating('gender',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Religion</strong></td>
                    <?php echo table_rating('religion',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Students</strong></td>
                    <?php echo table_rating('students',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Type</strong></td>
                    <?php echo table_rating('type',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Selective</strong></td>
                    <?php echo table_rating('selective',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Boarding / Housing</strong></td>
                    <?php echo table_rating('boarding',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>International Students</strong></td>
                    <?php echo table_rating('international_students',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Special Needs</strong></td>
                    <?php echo table_rating('infrastructral_needs',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Scholarships</strong></td>
                    <?php echo table_rating('scholarship_offer',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title"><strong>IB Diploma Programme</strong></td>
                    <?php echo table_rating('international_baccalaureate',$compare); ?>
                </tr>
                <tr class="sidebar-tab-with-table">
                    <td rowspan="0" style="background: #6dade3;border-radius: 30px 0 0 30px;">
                        <p style="font-weight: bold;writing-mode: tb-rl;transform: rotate(180deg);color:#000;">#</p>
                    </td>
                <tr>
                <tr class="text-center">
                    <td data-th="title"><strong>Database Rank</strong></td>
                    <?php echo table_rating('rank',$compare); ?>
                </tr>

            </table>
            <?php
            }
            ?>
        </div>

    </div>
</div>

<?php
$sc_name1 = $sc_name2 = $sc_name3 = $sc_name4 = $sc_name5 = '';
$lat = $long = $lat1 = $long1 = $lat2 = $long2 = $lat3 = $long3 = $lat4 = $long4 = '';
$compareCount = count($compare);
$CI =& get_instance();
for ($i=0; $i < $compareCount; $i++) {
    /**/
    $scFull = $CI->common->get_one_row('tbl_school',array('id'=>$compare[$i]));
    $state = $this->common->get_one_row('tbl_state',array('id'=>$scFull['state']));
    $address = array();
    if($scFull['address_1'] != '') {
        $address['street'] = $scFull['address_1'];
    }
    if($scFull['city'] != '') {
        $address['city'] = $scFull['city'];
    }
    if($scFull['state'] != '') {
        $address['state'] = $state['name'];
    }
    $latlong = $CI->getCoordinates($address);
    /**/
    if($i == 0) {
        $sc_name1 = ucwords($scFull['name']);
        if(!empty($latlong)) {
            $lat = $latlong[0];
            $long = $latlong[1];
        }
    }
    if($i == 1) {
        $sc_name2 = ucwords($scFull['name']);
        if(!empty($latlong)) {
            $lat1 = $latlong[0];
            $long1 = $latlong[1];
        }
    }
    if($i == 2) {
        $sc_name3 = ucwords($scFull['name']);
        if(!empty($latlong)) {
            $lat2 = $latlong[0];
            $long2 = $latlong[1];
        }
    }
    if($i == 3) {
        $sc_name4 = ucwords($scFull['name']);
        if(!empty($latlong)) {
            $lat3 = $latlong[0];
            $long3 = $latlong[1];
        }
    }
    if($i == 4) {
        $sc_name5 = ucwords($scFull['name']);
        if(!empty($latlong)) {
            $lat4 = $latlong[0];
            $long4 = $latlong[1];
        }
    }
}

/*Self Address*/
$ip = $this->input->ip_address();
$selfLatLong = $CI->getAddressFromIp($ip);
$selfLat = $selfLatLong[0];
$selfLong = $selfLatLong[1];
/*Self Address*/
/*echo "First: <br>";
echo $lat.','.$long.'<br>';
echo "Second: <br>";
echo $lat1.','.$long1.'<br>';
echo "Third: <br>";
echo $lat2.','.$long2.'<br>';
echo "Fourth: <br>";
echo $lat3.','.$long3.'<br>';
echo "Fifth: <br>";
echo $lat4.','.$long4.'<br>';*/
?>


<div class="compare--map--section">
    <div class="ger-title">
        <h2>Comparable School Locations</h2>
        <!-- <h4 class="cursive">Location of Compared Schools</h4> -->
    </div>
    <div class="embed-responsive embed-responsive-16by9">
        <div id="map"></div>
    </div>
</div>


<?php $this->load->view(FRONTEND.'newsletter'); ?>

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="https://tiles.unwiredmaps.com/js/leaflet-unwired.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var key = '4e830a8564e293';
    var streets = L.tileLayer.Unwired({key: key, scheme: "streets"});
    var map = L.map('map', {
        <?php
        if($selfLat != '' && $selfLong != '') {
        ?>
        center: ['<?php echo $selfLat; ?>','<?php echo $selfLong; ?>'],
        <?php
        }
        else {
        ?>
        center: [-24.994167,134.866944],
        <?php
        }
        ?>
        zoom: 10,
        layers: [streets]
    });
    L.control.scale().addTo(map);
    L.control.layers({
        "Streets": streets
    }).addTo(map);

    <?php
    if($lat != '' && $long != '') {
    ?>
    var marker = L.marker(['<?php echo $lat; ?>','<?php echo $long; ?>']).addTo(map);
    marker.bindPopup("<b><?php echo $sc_name1; ?>!</b>");
    <?php
    }
    if($lat1 != '' && $long1 != '') {
    ?>
    var marker1 = L.marker(['<?php echo $lat1; ?>','<?php echo $long1; ?>']).addTo(map);
    marker1.bindPopup("<b><?php echo $sc_name2; ?>!</b>");
    <?php
    }
    if($lat2 != '' && $long2 != '') {
    ?>
    var marker2 = L.marker(['<?php echo $lat2; ?>','<?php echo $long2; ?>']).addTo(map);
    marker2.bindPopup("<b><?php echo $sc_name3; ?>!</b>");
    <?php
    }
    if($lat3 != '' && $long3 != '') {
    ?>
    var marker3 = L.marker(['<?php echo $lat3; ?>','<?php echo $long3; ?>']).addTo(map);
    marker3.bindPopup("<b><?php echo $sc_name4; ?>!</b>");
    <?php
    }
    if($lat4 != '' && $long4 != '') {
    ?>
    var marker4 = L.marker(['<?php echo $lat4; ?>','<?php echo $long4; ?>']).addTo(map);
    marker4.bindPopup("<b><?php echo $sc_name5; ?>!</b>");
    <?php
    }
    if($selfLat != '' && $selfLong != '') {
    ?>
    // var myIcon = L.divIcon({className: 'fa fa-map-marker my-map-icon'});
    var myIcon = L.icon({
        iconUrl: '<?php echo F_IMGPATH.'marker/' ?>red.png',
        iconSize:     [25, 41],
    });
    var marker5 = L.marker(['<?php echo $selfLat; ?>','<?php echo $selfLong; ?>'],{icon: myIcon}).addTo(map);
    marker5.bindPopup("<b><?php echo 'You Are Here'; ?>!</b>");
    <?php
    }
    ?>
});
</script>