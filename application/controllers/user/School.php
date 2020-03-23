<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class School extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Settingmodel');
		$this->sendemail = false;
	}

	public function index()
	{

		$post = $this->input->get();		
		// $filter_open = 'YES';
		$filter_open = 'NO';
		if(isset($post['filterby']) && $post['filterby'] == 'school') {
			if(!isset($post['type']) AND !isset($post['sector']) AND !isset($post['selective']) AND !isset($post['boarding']) AND !isset($post['international_students']) AND !isset($post['scholarship_offer']) AND !isset($post['international_baccalaureate']) AND !isset($post['state']) AND !isset($post['distance']) AND !isset($post['gender']) AND !isset($post['religion']) AND !isset($post['no_of_students']) AND !isset($post['special_needs_support']) AND !isset($post['need_experience']) AND !isset($post['wwcc_number']) AND !isset($post['multilanguage']) AND !isset($post['tutoring_services']) AND !isset($post['preferred_hours'])) {
				$filter_open = 'NO';
			}
		}
		
		$data['filter_open'] = $filter_open;			
		
		// redirect('NotFoundController');
		/*$tables = array('tbl_school s','tbl_state st');
		$joins = array('left','st.id = s.state');
		$rows = 's.*,st.shortName as stateName';
		$groupBy = $keywords = '';
		$order_by = array('s.id'=>'');
		$field_array = $params = array();
		$wh = array('s.isDelete'=>0);
		$schools = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

		$data['result'] = $schools;*/
		$post = $this->input->get();
		$this->global['pageTitle'] = ' | Schools';
		$data['searchParam'] = (!empty($post)) ? $post['searchText'] : '';
		$data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1));
		$data = array_merge($data,$post);
		$data['statelist'] = $this->common->get_all_record('tbl_state');
		$data['special_need_category'] = $this->config->item('special_need_category');
		// $this->general->loadViewsFront(FRONTEND."schools", $this->global, $data, NULL);
		
		$this->general->loadViewsFront(FRONTEND."school_listing", $this->global, $data, NULL);
	}

	public function school_details($id)
	{
		$data['statelist'] = $this->common->get_all_record('tbl_state');
		$data['special_need_category'] = $this->config->item('special_need_category');
		$this->session->set_userdata('schoolBtn',true);
		$school = $this->common->get_one_row('tbl_school',array('md5(id)'=>$id));
		if(empty($school)) {
			redirect('404');
		}

		/**/
		$ip = $this->input->ip_address();
		$check = $this->common->get_one_row('tbl_pageviews',array('ip'=>$ip,'schoolId'=>$school['id']));
		if($check == '') {
			$pageViewData = array('ip'=>$ip,'schoolId'=>$school['id']);
			if(isset($this->session->USER['UId'])) {
				$pageViewData['userId'] = $this->session->USER['UId'];
			}
			$insertPageView = $this->common->insert_record('tbl_pageviews',$pageViewData);
		}
		/**/
		
		$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
		// $schools = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'status'=>1));
		$schools = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'approval !='=>1));

		
		$teachers = $this->common->get_all_record('tbl_teacher','*',array('teach_school'=>$school['id']));
		
		$pageView = $this->common->get_all_record_groupby('tbl_pageviews','count(*) AS pageview',array('schoolId'=>$school['id']),'schoolId');
		$pageView = $pageView[0]['pageview'];
		// $visitor = $this->common->get_all_record_groupby('tbl_pageviews','count(*) AS pageview',array('schoolId'=>$school['id'],'userId !='=>0),'schoolId');
		$tables = array('tbl_pageviews p','tbl_rating r');
		$joins = array('p.userId = r.userId AND p.schoolId = r.schoolId');
		$rows = 'count(p.id) AS pageview';
		$keywords = '';
		$field_array = $params = array();
		$groupBy = 'r.schoolId';
		$order_by = '';
		$wh = array('r.schoolId'=>$school['id']);

		$visitor = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		if(!empty($visitor)) {
			$visitor = $visitor[0]['pageview'];
			$visitorCount = ($visitor / $pageView) * 100;
		}
		else {
			$visitorCount = 0;
		}

		$ratings = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('schoolId'=>$school['id'],'isDelete'=>0),'schoolId');
		$ratings = (!empty($ratings)) ? $ratings[0] : array();
		
		/*ranking*/
		$rank = $rankState = $rankSchoolType = 0;
		$rankQuery = 'SELECT @rownum := @rownum +1 AS rank,prequery.schoolId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT schoolId, COUNT(*) AS total_rating, AVG(rating) AS average_rating FROM tbl_rating GROUP BY schoolId ORDER BY average_rating DESC ) prequery';
		$rankData = $this->common->cust_query($rankQuery);
		foreach ($rankData as $key => $value) {
			if($value['schoolId'] == $school['id']) {
				$rank = $value['rank'];
				break;
			}
		}
		$rankStateQuery = "SELECT @rownum := @rownum +1 AS rank,prequery.schoolId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT r.schoolId, COUNT(r.id) AS total_rating, AVG(r.rating) AS average_rating FROM tbl_school s LEFT JOIN tbl_rating r ON r.schoolId = s.id WHERE s.state = '".$school['state']."' GROUP BY schoolId ORDER BY average_rating DESC ) prequery";
		$rankStateData = $this->common->cust_query($rankStateQuery);
		foreach ($rankStateData as $key => $value) {
			if($value['schoolId'] == $school['id']) {
				$rankState = $value['rank'];
				break;
			}
		}
		$rankSchoolTypeQuery = "SELECT @rownum := @rownum +1 AS rank,prequery.schoolId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT r.schoolId, COUNT(r.id) AS total_rating, AVG(r.rating) AS average_rating FROM tbl_school s LEFT JOIN tbl_rating r ON r.schoolId = s.id WHERE s.type LIKE '%".$school['type']."%' GROUP BY schoolId ORDER BY average_rating DESC ) prequery";
		$rankSchoolTypeData = $this->common->cust_query($rankSchoolTypeQuery);
		foreach ($rankSchoolTypeData as $key => $value) {
			if($value['schoolId'] == $school['id']) {
				$rankSchoolType = $value['rank'];
				break;
			}
		}
		/*ranking*/

		/*review by user*/
		$tables = array('tbl_rating r','tbluser u');
		$joins = array('u.id = r.userId');
		$rows = 'u.profession, COUNT(r.userId) as rating_count, (COUNT(r.userId) / (SELECT COUNT(r1.userId) FROM tbl_rating r1 WHERE r1.schoolId = '.$school['id'].')) * 100 AS \'percentage\'';
		$keywords = $order_by = '';
		$field_array = $params = array();
		$groupBy = 'u.profession';
		$wh = array('u.isDelete'=>0,'r.schoolId'=>$school['id']);
		$ratingByUser = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		/*review by user*/

		/*Majority review by user*/
		$tables = array('tbl_rating r','tbluser u');
		$joins = array('u.id = r.userId');
		$rows = 'u.gender, CONCAT(u.fname," ",u.lname) as username, count(u.gender) as count_gender';
		$keywords = '';
		$field_array = array();
		$groupBy = 'u.gender';
		$order_by = 'count_gender';
		$wh = array('u.isDelete'=>0,'r.schoolId'=>$school['id']);
		$majorityRatingByUser = $this->common->get_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array);
		$majorityRatingByUser = ucwords($majorityRatingByUser['gender']);
		/*Majority review by user*/

		/*Majority review by user*/
		$tables = array('tbl_rating r','tbluser u','tbl_state st');
		$joins = array('u.id = r.userId','st.id = u.state');
		$rows = 'u.state, st.shortName, u.postcode, CONCAT(u.fname," ",u.lname) as username, count(u.postcode) as count_state_postcode';
		$keywords = '';
		$field_array = array();
		$groupBy = 'u.postcode';
		$order_by = 'count_state_postcode';
		$wh = array('u.isDelete'=>0,'r.schoolId'=>$school['id']);
		$majorityRatingByState = $this->common->get_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array);
		/*Majority review by user*/

		/*Majority review by age*/
		$tables = array('tbl_rating r','tbluser u');
		$joins = array('u.id = r.userId');
		$rows = 'MIN(u.age) AS minimum_age, MAX(u.age) as maximum_age';
		$keywords = '';
		$field_array = array();
		$groupBy = $order_by = '';
		$wh = array('r.isDelete'=>0,'r.schoolId'=>$school['id']);
		$majorityRatingByAge = $this->common->get_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array);
		/*Majority review by age*/

		/*Conversion & Clicks*/
		$conversion = $this->common->get_all_record_groupby('tbl_conversion','SUM(click) as click',array('schoolId'=>$school['id']),'schoolId');
		$conversion = (!empty($conversion) && $conversion != '') ? $conversion[0] : array();
		/*Conversion & Clicks*/

		/**/
		$curr_date = date('Y-m-d');
		$wh_cal = array("task_school_tag"=>$school['id'],"isDelete"=>"0","approval"=>"1","task_date >="=>$curr_date);
		$params_cal['Limit'] = '4';
		$params_cal['ShortOrder'] = 'ASC';
		$params_cal['ShortBy'] = 'task_date';
		$data['calender_event'] = $this->common->get_all("tbl_calendar",$wh_cal,$params_cal);
		
		/**/
		$data['pageview'] = $pageView;
		$data['visitor'] = $visitorCount;
		$data['rank'] = $rank;
		$data['rankState'] = $rankState;
		$data['rankSchoolType'] = $rankSchoolType;
		$data['ratingByUser'] = $ratingByUser;
		$data['majorityRatingByUser'] = $majorityRatingByUser;
		$data['majorityRatingByState'] = $majorityRatingByState;
		$data['majorityRatingByAge'] = $majorityRatingByAge;
		$data['conversion'] = $conversion;
		$data['school'] = $school;
		$data['schools'] = $schools;
		$data['state'] = $state;
		$data['teachers'] = $teachers;
		$data['rating'] = $ratings;
		$this->global['pageTitle'] = ' | '.ucwords($school['name']);
		$this->general->loadViewsFront(FRONTEND."school_profile", $this->global, $data, NULL);
	}

	function add_conversion()
	{
		$response = array();
		$post = $this->input->post();
		$schoolId = $post['schoolId'];
		$ip = $this->input->ip_address();
		$check = $this->common->get_one_row('tbl_conversion',array('ip'=>$ip,'schoolId'=>$schoolId));
		$data = array('schoolId'=>$schoolId);
		if(isset($this->session->USER['UId'])) {
			$data['userId'] = $this->session->USER['UId'];
		}
		
		if($check != '') {
			$data['click'] = $check['click'] + 1;
			$where = array('ip'=>$ip);
			$res = $this->common->update_record('tbl_conversion',$data,$where);
		}
		else {
			$data['click'] = 1;
			$data['ip'] = $ip;
			$res = $this->common->insert_record('tbl_conversion',$data);
		}

		if($res) {
			$response['success'] = true;
			$response['message'] = 'Conversion Added Successfully..';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'Something went Wrong! Please Try again Later';
		}

		echo json_encode($response);
	}

	function getCoordinates($address,$check=false)
	{
		$key = '4e830a8564e293';
		if($check) {
			$address = str_replace(' ', '+', $address);
			$url ='https://locationiq.org/v1/search.php?key='.$key.'&q='.$address.'&format=json';
		}
		else {
			$address = http_build_query($address);
			$url ='https://locationiq.org/v1/search.php?key='.$key.'&'.$address.'&format=json';
		}
		// $key = 'pk.b8f788507d00d55ce2d0e48391f7a929';
		// echo $url; die();
		$curl = curl_init($url);
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER    =>  true,
			CURLOPT_FOLLOWLOCATION    =>  true,
			CURLOPT_MAXREDIRS         =>  10,
			CURLOPT_TIMEOUT           =>  30,
			CURLOPT_CUSTOMREQUEST     =>  'GET',
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo 'cURL Error #:' . $err;
		}
		else {
			$response = json_decode($response, true);
			$response = $response[0];
			if(isset($response['place_id'])) {
				$lat = $response['lat'];
				$long = $response['lon'];
				return array($lat, $long);
			}
			else {
				return array();
			}
		}
  	}
  	/*function getCoordinates($address)
	{
		// $address = "India+Panchkula";
		// $key = 'AIzaSyAQbFC5pd8c1B78s1urrspjfjPsh1fFR_k';
		$key = 'AIzaSyCfbR3nz8JZ_tMCeBf4CZ6vjEnXkv_74Kk';
		$url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$key";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response);
		if(isset($response->results[0]->geometry)) {
			$lat = $response->results[0]->geometry->location->lat;
			$long = $response->results[0]->geometry->location->lng;
			return array($lat, $long);
		}
		else {
			return array();
		}
  	}*/
	
}