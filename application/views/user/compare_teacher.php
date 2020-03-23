<style type="text/css">
.checked { color: #f1b500; }
.logo-of-brand img { border: none; }
.rwd-table a { color: #333; }
</style>
<?php
function table_rating($row,$compare)
{
    $CI =& get_instance();
    $ratingArr = range(20,100,20);
    foreach ($compare as $key => $value) {
        $teacher = $CI->common->get_one_row('tbl_teacher',array('id'=>$value));
        $reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(knowledge_expertise) as knw, AVG(professionalism) as pro, AVG(helpfulness_willingness) as help, AVG(attitude) as att, AVG(communication_skills) as comm FROM `tbl_rating` WHERE `teacherId` = '".$value."' AND `isDelete` = 0 AND (`knowledge_expertise` != 0 OR `professionalism` != 0 OR `helpfulness_willingness` != 0 OR `attitude` !=0 OR `communication_skills` != 0) GROUP BY teacherId";
        $reviews = $CI->common->cust_query($reviewsQuery);
        $reviews = (!empty($reviews)) ? $reviews[0] : array();
        if($row == 'title') {
        ?>
        <td data-th="Title">
            <div class="logo-of-brand">
                <?php
                if(isset($teacher['profile_img']) && $teacher['profile_img'] != '') {
                ?>
                <img src="<?php echo base_url().ProfilePath.$teacher['profile_img']; ?>" alt="">
                <?php
                }
                else {
                ?>
                <img src="<?php echo ASSETPATH.'images/default-image.png'; ?>" alt="">
                <?php
                }
                ?>
                <h3><a href="<?php echo base_url('teacher/').md5($value); ?>"><?php echo ucwords($teacher['fname'].' '.$teacher['lname']); ?></a></h3>
            </div>
        </td>
        <?php
        }
        else if($row == 'reviews') {
            $rating = $CI->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$value,'isDelete'=>0),'schoolId');
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
        else if($row == 'knowledge_expertise') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['knw']);
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
        else if($row == 'professionalism') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['pro']);
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
        else if($row == 'help') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['help']);
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
        else if($row == 'attitude') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['att']);
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
        else if($row == 'communication_skills') {
        ?>
        <td data-th="Reviews">
            <ul class="star-se text-center">
                <?php
                $average_rating = '';
                if(!empty($reviews)) {
                    $average_rating = intval($reviews['comm']);
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
                                <h3>Contact & Compare </h3>	 -->
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
                <h4>There are No Schools for Compare. Please Select Teacher</h4>
                <a href="<?php echo base_url('teachers'); ?>" class="btn btn-primary">Go to Teacher Section</a>
            </div>
            <?php
            }
            else if(count($compare) <= 1) {
            ?>
            <div class="text-center nodata">
                <img src="<?php echo F_IMGPATH.'warning_icon.png' ?>" alt="No Data">
                <h4>You have to select Atleast 2 Teachers. Please Select Teacher</h4>
                <a href="<?php echo base_url('teachers'); ?>" class="btn btn-primary">Go to Teacher Section</a>
            </div>
            <?php
            }
            else {
            ?>
            <h2 class="text-center">Comparison Chart</h2>
            <h3 class="text-center cursive">Find the right school for you</h3>
            <table class="rwd-table">
                <tr class="text-center">
                    <th tdata-th="Title"></th>
                    <?php echo table_rating('title',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td>Reviews</td>
                    <?php echo table_rating('reviews',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title">Knowledge Expertise</td>
                    <?php echo table_rating('knowledge_expertise',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title">Professionalism</td>
                    <?php echo table_rating('professionalism',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title">Helpfulness/ Willingness</td>
                    <?php echo table_rating('help',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title">Attitude</td>
                    <?php echo table_rating('attitude',$compare); ?>
                </tr>
                <tr class="text-center">
                    <td data-th="title">Communication Skills</td>
                    <?php echo table_rating('communication_skills',$compare); ?>
                </tr>
            </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONTEND.'newsletter'); ?>