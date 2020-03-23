<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Settingmodel');
		// $this->load->library('Apil');
		$this->sendemail = false;
	}
	public function index()
	{ 
		$this->clearSession();
		// $data['school'] = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'status'=>1));
		$schoolQuery = 'SELECT s.name,COUNT(r.id) AS total_rating, AVG(r.rating) AS average_rating,s.photos,s.id FROM tbl_school s 
		   LEFT JOIN tbl_rating r ON r.schoolId = s.id WHERE s.isDelete = 0 
		    GROUP BY s.id ORDER BY total_rating desc limit 12';
		$school = $this->common->cust_query($schoolQuery);
		/*echo "<pre>";
		print_r($school);
		exit;*/
		$data['school'] = $school;
		$this->global['pageTitle'] = ' | Home';
		
		$data["tot_teacher"] = $this->db->from('tbl_teacher')->where('isDelete',0)->get()->num_rows();
		$data["tot_school"] = $this->db->from('tbl_school')->where('isDelete',0)->get()->num_rows();
		$data["tot_review"] = $this->db->from('tbl_rating')->where('isDelete',0)->get()->num_rows();
		$data["tot_month_visit"] = $this->db->from('tbl_pageviews')->get()->num_rows();
		
		$result = $this->db->select('*')->from('tbl_teacher')->where('isDelete',0)->where('is_sponsored',1)->order_by('updated_date','desc')->limit(10)->get()->result_array();
		// echo $this->db->last_query(); die();

		$data['featured_teacher'] = $result;
		$data['state'] = $this->common->get_all_record('tbl_state');
		$data['special_need_category'] = $this->config->item('special_need_category');

		/* Most View School */
			$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
			$tables = array('tbl_school s','tbl_state st','tbl_pageviews p');
			$joins = array('s.state = st.id','p.schoolId=s.id');
			$rows = 's.id,st.shortName as stateName, COUNT(p.schoolId) AS total_rating';
			$groupBy = 's.id';
			$order_by = array('total_rating'=>'DESC');
			$keywords = '';
			$field_array = array('s.name');
			$find_in_set = '';
			$params['limit'] = 1;
			$params['offset'] = 0;

			$res2_most_view_school = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);
			if(!empty($res2_most_view_school)) {
				$data['most_view_school_href'] = base_url('school/'.md5($res2_most_view_school[0]['id']));
			} else {
				$data['most_view_school_href'] = "javascript:;";
			}
			//echo $this->db->last_query(); die();		

		/* Most View School */

		/*Most view Teacher */

			
			$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0);
			$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_pageviews p');
			$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','p.teacherId=t.id');
			$rows = 't.*, s1.name as current_school, s2.name as previous_school,COUNT(p.teacherId) AS total_rating';
			$groupBy = 't.id';
			$order_by = array('total_rating'=>'DESC');
			$keywords = '';
			$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
			$find_in_set = '';
			$params['limit'] = 1;
			$params['offset'] = 0;

			$res2_most_view_teacher = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

			if(!empty($res2_most_view_teacher)) {
				$data['most_view_teacher_href'] = base_url('teacher/'.md5($res2_most_view_teacher[0]['id']));
			} else {
				$data['most_view_teacher_href'] = "javascript:;";
			}
			//echo $this->db->last_query(); die();		
		
		/*Most view Teacher */
        $this->general->loadViewsFront(FRONTEND."home", $this->global, $data, NULL);
	}

	public function searchquery($filterby='')
	{
		$post = $this->input->post();
		
		/*echo "<pre>";
		print_r($post);
		die();*/

		if(!empty($post)) {
			$search = $post['searchText'];
			if(isset($post['filterby']) && $post['filterby'] == 'school') {
				$this->session->set_userdata('schoolBtn',true);
			}
			else if(isset($post['filterby']) && $post['filterby'] == 'teacher') {
				$this->session->set_userdata('teacherBtn',true);
			}
		}
		else {
			$search = '';
			if($filterby == 'school') {
				$this->session->set_userdata('schoolBtn',true);
			}
			else if($filterby == 'teacher') {
				$this->session->set_userdata('teacherBtn',true);
			}
		}

		redirect(base_url('search/'.$search));
	}

	public function search($keywords='')
	{
		$post = $this->input->get();

		// print_r($post); die();

		if(isset($post['filterby']) && $post['filterby'] == 'event') {
			redirect(base_url('calendar?searchText='.$post["searchText"]));			
		} else if(isset($post['filterby']) && $post['filterby'] == 'bulletin') {
			redirect(base_url('bulletin?searchText='.$post["searchText"]));			
		}
		
		$data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1));
		$this->global['pageTitle'] = ' | Search Result';
		$keywords = (isset($post['searchText'])) ? $post['searchText'] : '';
		$data['searchParam'] = $keywords;
		$data = array_merge($data,$post);

		$data['statelist'] = $this->common->get_all_record('tbl_state');
		$data['special_need_category'] = $this->config->item('special_need_category');
		if(isset($post['special_need_category'])) {
			$data['special_need_category_edit'] = $post['special_need_category'];
		}
		if(isset($post['special_need_category_teacher'])) {
			$data['special_need_category_edit'] = $post['special_need_category_teacher'];
		}
		$filter_open = 'YES';
		
		if($post['filterby'] == 'school') {
			if(!isset($post['type']) AND !isset($post['sector']) AND !isset($post['selective']) AND !isset($post['boarding']) AND !isset($post['international_students']) AND !isset($post['scholarship_offer']) AND !isset($post['international_baccalaureate']) AND !isset($post['state']) AND !isset($post['distance']) AND !isset($post['gender']) AND !isset($post['religion']) AND !isset($post['no_of_students']) AND !isset($post['special_needs_support']) AND !isset($post['need_experience']) AND !isset($post['wwcc_number']) AND !isset($post['multilanguage']) AND !isset($post['tutoring_services']) AND !isset($post['preferred_hours'])) {
				$filter_open = 'NO';
			}
			$data['filter_open'] = $filter_open;
			$this->general->loadViewsFront(FRONTEND."school_listing", $this->global, $data, NULL);
		}
		else if($post['filterby'] == 'teacher') {

			if(!isset($post['type']) AND !isset($post['sector']) AND !isset($post['selective']) AND !isset($post['boarding']) AND !isset($post['international_students']) AND !isset($post['scholarship_offer']) AND !isset($post['international_baccalaureate']) AND !isset($post['state']) AND !isset($post['distance']) AND !isset($post['gender']) AND !isset($post['religion']) AND !isset($post['no_of_students']) AND !isset($post['special_needs_support']) AND !isset($post['need_experience']) AND !isset($post['wwcc_number']) AND !isset($post['multilanguage']) AND !isset($post['tutoring_services']) AND !isset($post['preferred_hours'])) {
				$filter_open = 'NO';
			}
			$data['filter_open'] = $filter_open;
			
			$this->general->loadViewsFront(FRONTEND."teacher_listing", $this->global, $data, NULL);
		}
		else {
			redirect(base_url());
		}
	}

	public function search_main()
	{
		$post = $this->input->post();
		/*echo "<pre>";
		print_r($post);
		die();
		$city = $post['s_text'];
		$tables = array('tbl_city c','tbl_state st');
		$joins = array('c.stateId = st.id');
		$rows = 'c.name as city,st.name as state';
		$groupBy = $order_by = '';
		$keywords = $city;
		$field_array = array('c.name');
		$params['limit'] = 5;
		$params['offset'] = 0;
		$wh = array();
		$cities = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);*/

		$keywords = $post['s_text'];
		$filterby = $post['filterby'];

		if($filterby=='school') {

			$field_array = array("name");
			$wh = array('isDelete'=>0,'status'=>1);
			$result = $this->common->search_query("tbl_school","id,name",$wh,$keywords,$field_array);

			$searchArray = array();
			foreach ($result as $key => $value) {
				$url = base_url().'school/'.md5($value['id']);
				$searchArray[$key]['id'] = $url;
				$searchArray[$key]['name'] = ucwords($value['name']);
			}
		} else if($filterby=='teacher') {

			$field_array = array("fname","lname");
			$wh = array('isDelete'=>0,'status'=>1);
			$result = $this->common->search_query("tbl_teacher","id,fname,lname",$wh,$keywords,$field_array);

			$searchArray = array();
			foreach ($result as $key => $value) {
				$searchArray[] = ucwords($value['fname']." ".$value['lname']);
			}
		} else if($filterby=='bulletin') {

			$field_array = array("title");
			$wh = array('isDelete'=>0,'status'=>1);
			$result = $this->common->search_query("tbl_bulletin","id,title",$wh,$keywords,$field_array);

			$searchArray = array();
			foreach ($result as $key => $value) {
				$searchArray[] = ucwords($value['title']);
			}
		} else if($filterby=='event') {

			$field_array = array("task_name");
			$wh = array('isDelete'=>0,'approval'=>1);
			$result = $this->common->search_query("tbl_calendar","id,task_name",$wh,$keywords,$field_array);

			$searchArray = array();
			foreach ($result as $key => $value) {
				$searchArray[] = ucwords($value['task_name']);
			}
		}

		echo json_encode($searchArray);
	}

	public function search_by_area($rowno=0)
	{	
		$except_array = array();
		$ip = $this->input->ip_address();
		// $ip = "103.90.44.199";
		$details = json_decode(file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key=ecf61aa52103ba1e71a5eae33c5d08c4292912bc319d8047c53ddb440f390d16&ip='.$ip.'&format=json'));
		$lat = $details->latitude;
		$lon = $details->longitude;

		$query = "SELECT 
		  id, (
		    3959 * acos (
		      cos ( radians($lat) )
		      * cos( radians( latitude ) )
		      * cos( radians( longitude ) - radians($lon) )
		      + sin ( radians($lat) )
		      * sin( radians( latitude ) )
		    )
		  ) AS distance
		FROM tbl_school
		WHERE isDelete=0 
		HAVING distance < 30
		ORDER BY distance DESC 
		LIMIT 0 , 2;";

		$id_array = array();
		$nearbylist =  $this->common->cust_query($query);
		foreach ($nearbylist as $key => $value) {
			$id_array[] = $value['id'];
		}
		$nearbyid = implode(",", $id_array);
		$nearbyid = explode(",", $nearbyid);
		
		// die();

		$data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1));
		// $this->db->select('s.* , COUNT(r.id) AS total_rating, AVG(r.rating) AS average_rating')
		$this->db->select('s.*')
		->from('tbl_school s')
		//->join('tbl_rating r','r.schoolId=s.id','left')		
		->where('s.isDelete',0)
		->where('s.approval',0)
		->where('s.is_sponsored',1)
		// ->where_in('s.id', $nearbyid)
		->limit(2);

		$this->db->join('tbl_rating r','r.schoolId=s.id','left');
        $this->db->group_by('s.id');
        // $this->db->order_by("s.id", "desc");
        $this->db->order_by("s.updated_date", "desc");
		$query = $this->db->get();
		$sponsored_school = $query->result_array();
		/*echo $this->db->last_query();
		echo "<pre>";
		print_r($sponsored_school);
		exit;*/
		$data['sponsored_school'] = $sponsored_school;

		$post = $this->input->post();

		/*echo "<pre>";
		print_r($post);
		die();*/
		
		$fetchArr = array('top-10-school-in-australia','most-viewed-school','top-10-primary-schools','top-10-secondary-schools','top-10-tertiary-schools','top-10-special-needs-schools','best-school-in-nsw','best-school-in-vic','best-school-in-qld','best-school-in-nt','best-school-in-wa','best-school-in-sa','best-school-in-act','best-school-in-tas');

		if(isset($post['fetchdata']) && in_array($post['fetchdata'], $fetchArr)) {

			$search = $area = $type = '';
			$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
			/**/
			if($post['fetchdata'] == 'top-10-school-in-australia') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'most-viewed-school') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_pageviews p');
				$joins = array('left','s.state = st.id','p.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, COUNT(p.schoolId) AS total_rating';
				$groupBy = 's.id';
				$order_by = array('total_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'top-10-primary-schools') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name','s.type'=>'primary');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'top-10-secondary-schools') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name','s.type'=>'secondary');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'top-10-tertiary-schools') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name','s.type'=>'tertiary');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'top-10-special-needs-schools') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name','s.type'=>'special needs');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-nsw') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'NSW');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-vic') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'VIC');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-qld') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'QLD');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-nt') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'NT');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-wa') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'WA');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-sa') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'SA');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-act') {
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'ACT');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-school-in-tas') {
				
				$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1,'st.shortName'=>'TAS');
				$tables = array('tbl_school s','tbl_state st','tbl_rating r');
				$joins = array('left','s.state = st.id','r.schoolId=s.id');
				$rows = 's.*,st.shortName as stateName, AVG(r.rating) AS average_rating';
				$groupBy = 's.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('s.name');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if(isset($nearbyid) && $nearbyid!="") {
				$params['where_not_in_field'] = "s.id"; 
				$params['where_not_in_ids'] = $nearbyid; 
			}

			// $res = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
			/**/
			$area = $city = $state = '';
			// $wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
			$find_in_set = '';
			if(isset($post['area']) && $post['area'] != '') {
				$area = explode(',', $post['area']);
				$city = $area[0];
				$state = $area[1];
				$area = implode(',', $area);
				$wh = array('s.city'=>$city,'st.name'=>$state);
			}
			/**/
			$type = '';
			$subtype = array();
			if(isset($post['type']) && $post['type'] != '')  {
				$type = $post['type'];
				if(in_array('tertiary', $type)) {
	                $selectArr = array('tafe','college','university');
	                foreach ($selectArr as $key => $value) {
	                    if(in_array($value, $type)) {
	                        array_push($subtype, $value);
	                        $pos = array_search($value, $type);
	                        unset($type[$pos]);
	                    }
	                }
	            }
				$type = implode(',', $type);
				$subtype = implode(',', $subtype);
			}
			if(isset($post['searchparam'])) {
				$search = $post['searchparam'];
			}
			else if(isset($post['searchText'])) {
				$search = $post['searchText'];
			}
			else {
				$search = '';
			}
			/*if(isset($post['sector']) && $post['sector'] != '') {
				$wh['s.sector'] = $post['sector'];
			}*/
			if(isset($post['gender']) && $post['gender'] != '') {
				$wh['s.gender'] = $post['gender'];
			}
			if(isset($post['selective']) && $post['selective'] != '') {
				$wh['s.selective'] = $post['selective'];
			}
			if(isset($post['boarding']) && $post['boarding'] != '') {
				$wh['s.boarding'] = $post['boarding'];
			}
			if(isset($post['international_students']) && $post['international_students'] != '') {
				$wh['s.international_students'] = $post['international_students'];
			}
			if(isset($post['special_needs_support']) && $post['special_needs_support'] != '') {
				/*$wh['s.special_needs_support'] = $post['special_needs_support'];
				if($post["special_needs_support"]=='1' && !empty($post["special_need_category"])) {
					$wh['s.special_need_category'] = $post["special_need_category"];
				}*/
			}
			if(isset($post['no_of_students']) && $post['no_of_students'] != '') {
				$post['no_of_students'] = str_replace('+', '', $post['no_of_students']);
				$students = explode('-', $post['no_of_students']);
				if(isset($students[0]) && $students[0] != '') {
					$wh['s.no_of_students>='] = $students[0];
				}
				if(isset($students[1]) && $students[1] != '') {
					$wh['s.no_of_students<='] = $students[1];
				}
			}
			if(isset($post['religion']) && $post['religion'] != '') {
				$wh['s.religion'] = $post['religion'];
			}
			if(isset($post['scholarship_offer']) && $post['scholarship_offer'] != '') {
				$wh['s.scholarship_offer'] = $post['scholarship_offer'];
			}
			if(isset($post['international_baccalaureate']) && $post['international_baccalaureate'] != '') {
				$wh['s.international_baccalaureate'] = $post['international_baccalaureate'];
			}
			if(isset($post['state']) &&  !empty($post['state'])){
				$wh['s.state'] = $post['state'];
			}

			if(!empty($post['special_need_category'])){				
				foreach ($post['special_need_category'] as $key => $value) {
	                $find_in_set .= '( find_in_set("'.$value.'",s.special_need_category) <> 0) OR';
	            }
	            $find_in_set = rtrim($find_in_set,'OR');	            
	        }
			// Pagination code
			/*echo "<pre>";
			print_r($post);
			echo "</pre>";*/
			$res2 = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);
			// echo $this->db->last_query(); die();
			$bestArr = array('best-school-in-nsw','best-school-in-vic','best-school-in-qld','best-school-in-nt','best-school-in-wa','best-school-in-sa','best-school-in-act','best-school-in-tas');
			if(in_array($post['fetchdata'], $bestArr)) {
				if(!empty($res2)) {
					$schoolId = md5($res2[0]['id']);
					$data['redirect_link'] = base_url().'school/'.$schoolId;
				}
				else {
					$data['redirect_link'] = '';
				}
			}
			$rowperpage = 10;
			if($rowno != 0){
	            $rowno = ($rowno-1) * $rowperpage;
	        } 
	        
	        $this->load->library ( 'pagination' );
	        $config ['base_url'] =  base_url().'find-school';
	        $config ['total_rows'] = count($res2);
	        $config['use_page_numbers'] = TRUE;
	        $config ['per_page'] = $rowperpage;
	        $config ['num_links'] = 3;
	        $config ['full_tag_open'] = '<nav><ul class="pagination">';
	        $config ['full_tag_close'] = '</ul></nav>';
	        $config ['first_tag_open'] = '<li class="page-item">';
	        $config ['first_link'] = 'First';
	        $config ['first_tag_close'] = '</li>';
	        $config ['prev_link'] = 'Previous';
	        $config ['prev_tag_open'] = '<li class="page-item">';
	        $config ['prev_tag_close'] = '</li>';
	        $config ['next_link'] = 'Next';
	        $config ['next_tag_open'] = '<li class="page-item">';
	        $config ['next_tag_close'] = '</li>';
	        $config ['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	        $config ['cur_tag_close'] = '</a></li>';
	        $config ['num_tag_open'] = '<li>';
	        $config ['num_tag_close'] = '</li>';
	        $config ['last_tag_open'] = '<li class="page-item">';
	        $config ['last_link'] = 'Last';
	        $config ['last_tag_close'] = '</li>';

	       


			$params['limit'] = $params['limit']; // $rowperpage;
			$params['start'] = $rowno;
			$params['offset'] = $rowno;
			$res = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

			$this->pagination->initialize($config);
	        $data['page_link'] = $this->pagination->create_links( );
	        $data['result'] = $res;
	        $data['row'] = $rowno;

		}
		else {
			/*echo "<pre>";
			print_r($post);;
			die();*/
			/**/
			$area = $city = $state = '';
			// $wh = array('s.isDelete'=>0,'s.approval !='=>1);
			$wh = array('s.isDelete'=>0,'s.approval'=>0,'s.status'=>1);
			$find_in_set = '';
			if(isset($post['area']) && $post['area'] != '') {
				$area = explode(',', $post['area']);
				$city = $area[0];
				$state = $area[1];
				$area = implode(',', $area);
				$wh = array('s.city'=>$city,'st.name'=>$state);
			}
			/**/
			$type = '';
			$subtype = array();
			if(isset($post['type']) && $post['type'] != '')  {
				$type = $post['type'];
				if(in_array('tertiary', $type)) {
	                $selectArr = array('tafe','college','university');
	                foreach ($selectArr as $key => $value) {
	                    if(in_array($value, $type)) {
	                        array_push($subtype, $value);
	                        $pos = array_search($value, $type);
	                        unset($type[$pos]);
	                    }
	                }
	            }
				$type = implode(',', $type);
				$subtype = implode(',', $subtype);
			}
			if(isset($post['searchparam'])) {
				$search = $post['searchparam'];
			}
			else if(isset($post['searchText'])) {
				$search = $post['searchText'];
			}
			else {
				$search = '';
			}
			/*if(isset($post['sector']) && $post['sector'] != '') {
				$wh['s.sector'] = $post['sector'];
			}*/
			if(isset($post['gender']) && $post['gender'] != '') {
				$wh['s.gender'] = $post['gender'];
			}
			if(isset($post['selective']) && $post['selective'] != '') {
				$wh['s.selective'] = $post['selective'];
			}
			if(isset($post['boarding']) && $post['boarding'] != '') {
				$wh['s.boarding'] = $post['boarding'];
			}
			if(isset($post['international_students']) && $post['international_students'] != '') {
				$wh['s.international_students'] = $post['international_students'];
			}
			if(isset($post['special_needs_support']) && $post['special_needs_support'] != '') {
				/*$wh['s.special_needs_support'] = $post['special_needs_support'];
				if($post["special_needs_support"]=='1' && !empty($post["special_need_category"])) {
					$wh['s.special_need_category'] = $post["special_need_category"];
				}*/
			}
			if(isset($post['no_of_students']) && $post['no_of_students'] != '') {
				$post['no_of_students'] = str_replace('+', '', $post['no_of_students']);
				$students = explode('-', $post['no_of_students']);
				if(isset($students[0]) && $students[0] != '') {
					$wh['s.no_of_students>='] = $students[0];
				}
				if(isset($students[1]) && $students[1] != '') {
					$wh['s.no_of_students<='] = $students[1];
				}
			}
			if(isset($post['religion']) && $post['religion'] != '') {
				$wh['s.religion'] = $post['religion'];
			}
			if(isset($post['scholarship_offer']) && $post['scholarship_offer'] != '') {
				$wh['s.scholarship_offer'] = $post['scholarship_offer'];
			}
			if(isset($post['international_baccalaureate']) && $post['international_baccalaureate'] != '') {
				$wh['s.international_baccalaureate'] = $post['international_baccalaureate'];
			}
			if(isset($post['state']) &&  !empty($post['state'])){
				$wh['s.state'] = $post['state'];
			}

			
			/*echo "<pre>";
			print_r($wh);
			die();*/
			/**/
			$tables = array('tbl_school s','tbl_state st');
			$joins = array('left','s.state = st.id');
			$rows = 's.*,st.shortName as stateName, (
		    3959 * acos (
		      cos ( radians('.$lat.') )
		      * cos( radians( latitude ) )
		      * cos( radians( longitude ) - radians('.$lon.') )
		      + sin ( radians('.$lat.') )
		      * sin( radians( latitude ) )
		    )
		  ) AS distance';
			$groupBy = '';
			$order_by = array('s.id'=>'ASC');
			$keywords = $search;
			if($type != '') {
				$field_array = array('s.name','s.type'=>$type);
				if($subtype != '') {
					$field_array['s.subtype'] = $subtype;
				}
			}
			else {
				$field_array = array('s.name');
			}
			if(!empty($post['sector'])){
				$sector = $post['sector'];
				$sector = implode(',', $sector);;
				/*foreach ($post['sector'] as $key => $value) {
	                $find_in_set .= '( find_in_set("'.$value.'",s.sector) <> 0) OR';
	            }
	            $find_in_set = rtrim($find_in_set,'OR');*/
	            $field_array = array('s.sector'=>$sector);
	        }
	        /*echo "<pre>";
	        print_r($field_array1);
	        echo "</pre>";*/
			
			if(isset($post['distance']) &&  !empty($post['distance'])){
				if(is_numeric($post['distance'])) {
					$params['having'] = "distance < ".$post['distance'];
				} else {
					$distance =  str_replace("+","", $post['distance']);
					$params['having'] = "distance > ".$distance;
				}
			}

			// print_r($nearbyid); die();
			if(isset($nearbyid) && $nearbyid!="") {
				$params['where_not_in_field'] = "s.id"; 
				$params['where_not_in_ids'] = $nearbyid; 

			}
			
			/*if(!empty($post['special_need_category'])){
				$special_need_category = $post['special_need_category'];
				$special_need_category = implode(',', $special_need_category);;
				foreach ($post['sector'] as $key => $value) {
	                $find_in_set .= '( find_in_set("'.$value.'",s.sector) <> 0) OR';
	            }
	            $find_in_set = rtrim($find_in_set,'OR');
	            $field_array2 = array('s.special_need_category'=>$special_need_category);
	        }*/
	        // echo $special_need_category; die();
	        // $field_array = array_merge($field_array2,$field_array1);
	        
	        if(!empty($post['special_need_category'])){
				
				foreach ($post['special_need_category'] as $key => $value) {
	                $find_in_set .= '( find_in_set("'.$value.'",s.special_need_category) <> 0) OR';
	            }
	            $find_in_set = rtrim($find_in_set,'OR');	            
	        }
	        /*print_r($post['special_need_category']);
	        if(isset($post['special_need_category']) && $post['special_need_category']!="") {
		        $params['where_in_field'] = "s.special_need_category"; 
				$params['where_in_ids'] = $post['special_need_category']; 
			}*/

	        /*echo "<pre>";
	        print_r($field_array);
	        echo "</pre>";*/


			// Pagination code
			$params['where_or'] = array('s.city'=>$search);
 
			$res2 = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);
			
			if(count($res2) <= 2) {
				if(isset($nearbyid) && $nearbyid!="") {
					/*$params['where_not_in_field'] = "s.id"; 
					$params['where_not_in_ids'] = $nearbyid; */
					unset($params['where_not_in_field']);
					unset($params['where_not_in_ids']);
					$res2 = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);

				}
			}
			//echo count($res2);

			// echo $this->db->last_query(); die();
			$rowperpage = 5;
			if($rowno != 0){
	            $rowno = ($rowno-1) * $rowperpage;
	        } 
	        
	        $this->load->library ( 'pagination' );
	        $config ['base_url'] =  base_url().'find-school';
	        $config ['total_rows'] = count($res2);
	        $config['use_page_numbers'] = TRUE;
	        $config ['per_page'] = $rowperpage;
	        $config ['num_links'] = 3;
	        $config ['full_tag_open'] = '<nav><ul class="pagination">';
	        $config ['full_tag_close'] = '</ul></nav>';
	        $config ['first_tag_open'] = '<li class="page-item">';
	        $config ['first_link'] = 'First';
	        $config ['first_tag_close'] = '</li>';
	        $config ['prev_link'] = 'Previous';
	        $config ['prev_tag_open'] = '<li class="page-item">';
	        $config ['prev_tag_close'] = '</li>';
	        $config ['next_link'] = 'Next';
	        $config ['next_tag_open'] = '<li class="page-item">';
	        $config ['next_tag_close'] = '</li>';
	        $config ['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	        $config ['cur_tag_close'] = '</a></li>';
	        $config ['num_tag_open'] = '<li>';
	        $config ['num_tag_close'] = '</li>';
	        $config ['last_tag_open'] = '<li class="page-item">';
	        $config ['last_link'] = 'Last';
	        $config ['last_tag_close'] = '</li>';


			$params['limit'] = $rowperpage;
			$params['start'] = $rowno;
			$params['offset'] = $rowno;
			$res = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);

			$this->pagination->initialize($config);
	        $data['page_link'] = $this->pagination->create_links( );
	        $data['result'] = $res;
	        $data['row'] = $rowno;

			
		}

		// To search by miles instead of kilometers, replace 6371 with 3959.
		$data['result'] = $res;
		$data['searchParam'] = $search;
		$data['area'] = $area;
		$type = explode(',', $type);
		$data['type'] = $type;
		$data['findSchool'] = true;
		$data['no_of_item'] = count($res2);
		
		/*echo $this->db->last_query();*/
		if(!isset($data['redirect_link'])) {
			$this->load->view(FRONTEND.'ajax/filter_school',$data);
		}
		else {
			echo json_encode($data);
		}
		/*$this->global['pageTitle'] = ' | Search Result';
        $this->general->loadViewsFront(FRONTEND."school_listing", $this->global, $data, NULL);*/
	}

	public function search_city()
	{
		$post = $this->input->post();
		$city = $post['area'];
		$tables = array('tbl_city c','tbl_state st');
		$joins = array('c.stateId = st.id');
		$rows = 'c.name as city,st.name as state';
		$groupBy = $order_by = '';
		$keywords = $city;
		$field_array = array('c.name');
		$params['limit'] = 5;
		$params['offset'] = 0;
		$wh = array();
		$cities = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		
		$cityArr = array();
		foreach ($cities as $key => $value) {
			$cityArr[] = ucwords($value['city'].','.$value['state']);
		}

		echo json_encode($cityArr);
	}

	/* public function search_school_name()
	{
		$post = $this->input->post();
		$school_name = $post['school_name'];
		$tables = 'tbl_school s';
		$params['Select'] = 's.name';
		$groupBy = $order_by = '';
		$keywords = $school_name;
		$field_array = array('s.name');
		$params['Limit'] = 5;
		$wh = array();
		$schools = $this->common->get_all($tables,$wh,$params,$keywords,$field_array);
		
		$schoolArr = array();
		foreach ($schools as $school_key => $school) {
			$schoolArr[] = ucwords($school['name']);
		}

		echo json_encode($schoolArr);
	} 
 
	public function search_teacher_name()
	{
		$post = $this->input->post();
		$teacher_name = $post['teacher_name'];
		$tables = 'tbl_teacher s';
		$params['Select'] = 's.fname, s.lname';
		$groupBy = $order_by = '';
		$keywords = $teacher_name;
		$field_array = array('s.fname', 's.lname');
		$params['Limit'] = 5;
		$wh = array();
		$teachers = $this->common->get_all($tables,$wh,$params,$keywords,$field_array);
		
		$teacherArr = array();
		foreach ($teachers as $teacher_key => $teacher) {
			$teacherArr[] = ucwords($teacher['fname'] . ' ' . $teacher['lname']);
		}

		echo json_encode($teacherArr);
	} */

	public function submit_review()
	{
		$response = array();
		$post = $this->input->post();
		
		if(!empty($post['schoolId']) ){
			$data = array('userId'=>$post['userId'],'schoolId'=>$post['schoolId'],'rating'=>$post['rating'],'review'=>$post['review'],'facilities'=>$post['facilities'],'culture'=>$post['culture'],'staff'=>$post['staff'],'curricullum'=>$post['curriculum'],'fees'=>$post['fees']);
			if($post['rating'] <= 2.5 && $post['review']!="") {
				$data['status'] = 0;
			}
			$check = $this->common->get_one_row('tbl_rating',array('userId'=>$post['userId'],'schoolId'=>$post['schoolId'],'isDelete'=>0));
		}else{
			$data = array('userId'=>$post['userId'],'teacherId'=>$post['teacherId'],'rating'=>$post['rating'],'review'=>$post['review'],
				'knowledge_expertise'=>$post['knowledge_expertise'],
				'professionalism'=>$post['professionalism'],
				'helpfulness_willingness'=>$post['helpfulness_willingness'],
				'attitude'=>$post['attitude'],
				'communication_skills'=>$post['communication_skills'] );
			if($post['rating'] <= 2.5 && $post['review']!="") {
				$data['status'] = 0;
			}
			$check = $this->common->get_one_row('tbl_rating',array('userId'=>$post['userId'],'teacherId'=>$post['teacherId'],'isDelete'=>0));
		}
		
		if($check) {
			$response['success'] = false;
			// $response['message'] = 'You have already submitted a review. If you would like to change your review, simply go to your account and click on "Edit/view your reviews" then select the review you would like to change. !!!';
			$response['message'] = 'You have already left a review. If you would like to change it, please go to your account profile then select \'view/edit your review\' and click on the relevant profile name.';
		}
		else {

			$checkProfanity = $this->general->checkProfanity($post['review']);
			if($checkProfanity) {
				$insert = $this->common->insert_record('tbl_rating',$data);
				if($insert) {
					$response['success'] = true;
					// $response['message'] = 'Review Submitted Successfully';
					if($post['rating'] <= 2.5) {
						$response['message'] = 'Your review has been submitted and sent to admin for approval.';
					}
					else {
						$response['message'] = 'Your review has been submitted.';
					}
				}
				else {
					$response['success'] = false;
					$response['message'] = 'Something went wrong! Please try again later';
				}
			}
			else {
				$response['success'] = false;
				$response['profanity'] = true;
				$response['message'] = 'A naughty word was detected and we cannot publish it. Please reword your review.';
			}
		}

		echo json_encode($response);
	}

	public function fetch_rating()
	{
		$post = $this->input->post();
		$tables = array('tbl_rating r','tbluser u');
		$joins = array('r.userId = u.id');
		$rows = '*';
		$groupBy = $order_by = $keywords = '';
		$field_array = array();
		if(isset($post['more'])) {
			$params['limit'] = 10;
		}
		else {
			$params['limit'] = 5;
		}
		$params['offset'] = 0;

		if(isset($post['schoolId'])) {

			$schoolId = $post['schoolId'];
			$wh = array('r.isDelete'=>0,'r.status'=>1,'schoolId'=>$schoolId);
			$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(facilities) AS fac, AVG(culture) AS cul, AVG(staff) AS sta, AVG(curricullum) AS cur, AVG(fees) AS fee FROM `tbl_rating` WHERE `schoolId` = '".$schoolId."' AND `isDelete` = 0 AND status = 1 AND review != '' AND (`facilities` != 0 OR `culture` != 0 OR `staff` != 0 OR `curricullum` !=0 OR `fees` != 0) GROUP BY schoolId";
			$data['school'] = $post['schoolId'];
		}
		else {

			$teacherId = $post["teacherId"];
			$wh = array('r.isDelete'=>0,'r.status'=>1,'teacherId'=>$teacherId);
			$reviewsQuery = "SELECT COUNT(id) AS total_review, AVG(knowledge_expertise) as knw, AVG(professionalism) as pro, AVG(helpfulness_willingness) as help, AVG(attitude) as att, AVG(communication_skills) as comm FROM `tbl_rating` WHERE `teacherId` = '".$teacherId."' AND `isDelete` = 0 AND status = 1 AND review != '' GROUP BY teacherId";
			$data['teacher'] = $post["teacherId"];
		}

		$wh['review !='] = '';
		$ratings = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		$totalRatings = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array);

		$reviews = $this->common->cust_query($reviewsQuery);
		$reviews = (!empty($reviews)) ? $reviews[0] : array();
		
		$data['ratings'] = $ratings;
		$data['totalRatings'] = count($totalRatings);
		$data['reviews'] = $reviews;
		
		$this->load->view(FRONTEND.'ajax/get_reviews', $data, false);
	}

	public function add_compare_school()
	{
		$response = array();
		$post = $this->input->post();
		$count = 0;
		if($this->session->userdata('compareTeacher')) {
			$response['success'] = false;
			$response['count'] = $count;
			$response['message'] = 'Please Remove Teachers From Compare List..';
			echo json_encode($response);
			exit;
		}
		$school = $this->common->get_one_row('tbl_school',array('id'=>$post['schoolId']));
		if($this->session->userdata('compareSchool')) {
			$compareArr = $this->session->userdata('compareSchool');
			$typeArr = array();

			if(count($compareArr) > 4) {
				$response['success'] = false;
				$response['count'] = $count;
				$response['message'] = 'Limit Exceed';
				echo json_encode($response);
				exit;
			}
			foreach ($compareArr as $key => $value) {
					
				$schoolType = $this->common->get_one_row('tbl_school',array('id'=>$value));
				if(!in_array($post['schoolId'], $compareArr)) {
					array_push($compareArr, $post['schoolId']);
					if(!in_array($schoolType['type'], $typeArr)) {
						array_push($typeArr, $schoolType['type']);
					}
				}

				
				if($schoolType['type'] == $school['type']) {
				}
				else {
					if(!isset($post['typeForce'])) {
						$response['success'] = false;
						$response['prompt'] = true;
						$response['compareId'] = $post['schoolId'];
						$response['count'] = $count;
						// $response['message'] = 'You have to select Same Category For School';
						// $response['message'] = 'Interesting... We see that you wish to compare different types of schools ('.implode(',', $typeArr).') Are you sure you want to proceed? We won\'t stop you, but we recommend that you compare schools within the same school type to get the most relevant information.';
						$response['message'] = 'You are comparing different school types. We recommend that you compare the same school types to ensure you get the most relevant information. Are you sure you want to proceed?';
						echo json_encode($response);
						exit;
					}
				}
			}
		}
		else {
			$compareArr = array($post['schoolId']);
		}

		$this->session->set_userdata('compareSchool',$compareArr);
		$count = count($compareArr);

		/**/
		$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
		$html = '<li>
			<h3>
				<a href="'.base_url('school/'.md5($school['id'])).'">'.ucwords($school['name']).' </a>
				<span>
					<a href="javascript:void(0);" class="removeCompareSchool" data-id="'.$school['id'].'">
						<i class="fa fa-times"></i>
					</a>
				</span>
			</h3>
			<p>'.$state['shortName'].', '.$school['city'].'</p>
			<hr>
		</li>';

		$response['success'] = true;
		$response['count'] = $count;
		$response['html'] = $html;
		
		echo json_encode($response);

	}

	public function add_compare_teacher()
	{
		$response = array();
		$post = $this->input->post();
		$count = 0;
		if($this->session->userdata('compareSchool')) {
			$response['count'] = $count;
			$response['success'] = false;
			$response['message'] = 'Please Remove Schools From Compare List..';
			echo json_encode($response);
			exit;
		}
		if($this->session->userdata('compareTeacher')) {
			$compareArr = $this->session->userdata('compareTeacher');
			if(count($compareArr) > 4) {
				$response['success'] = false;
				$response['count'] = $count;
				$response['message'] = 'Limit Exceed';
				echo json_encode($response);
				exit;
			}
			array_push($compareArr, $post['teacherId']);
		}
		else {
			$compareArr = array($post['teacherId']);
		}

		$this->session->set_userdata('compareTeacher',$compareArr);
		$count = count($compareArr);

		/**/
		$teacher = $this->common->get_one_row('tbl_teacher',array('id'=>$post['teacherId']));
		$school = $this->common->get_one_row('tbl_school',array('id'=>$teacher['teach_school']));
		$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
		$html = '<li>
			<h3>
				<a href="'.base_url('teacher/'.md5($post['teacherId'])).'">'.ucwords($teacher['fname'].' '.$teacher['lname']).' </a>
				<span>
					<a href="javascript:void(0);" class="removeCompareTeacher" data-id="'.$teacher['id'].'">
						<i class="fa fa-times"></i>
					</a>
				</span>
			</h3>
			<p>'.$state['shortName'].', '.$school['city'].'</p>
			<hr>
		</li>';

		$response['success'] = true;
		$response['count'] = $count;
		$response['html'] = $html;
		
		echo json_encode($response);

	}

	public function remove_compare_school()
	{
		$response = array();
		$post = $this->input->post();
		$count = 0;
		if($this->session->userdata('compareSchool')) {
			$compareArr = $this->session->userdata('compareSchool');
			if (($key = array_search($post['schoolId'], $compareArr)) !== false) {
				unset($compareArr[$key]);
			}
			$this->session->set_userdata('compareSchool',$compareArr);
			$count = count($compareArr);
			$response['success'] = true;
			$response['count'] = $count;
			$response['message'] = 'Removed Successfully..';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'No Session..';
		}

		echo json_encode($response);
	}

	public function remove_compare_teacher()
	{
		$response = array();
		$post = $this->input->post();
		$count = 0;
		if($this->session->userdata('compareTeacher')) {
			$compareArr = $this->session->userdata('compareTeacher');
			if (($key = array_search($post['teacherId'], $compareArr)) !== false) {
			    unset($compareArr[$key]);
			}
			$this->session->set_userdata('compareTeacher',$compareArr);
			$count = count($compareArr);
			$response['success'] = true;
			$response['count'] = $count;
			$response['message'] = 'Removed Successfully..';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'No Session..';
		}

		echo json_encode($response);
	}

	public function clearall_compare()
	{
		$response = array();
		if($this->session->userdata('compareSchool')) {
			$count = 0;
			unset($_SESSION['compareSchool']);
			$response['success'] = true;
			$response['count'] = $count;
			$response['message'] = 'Cleared Successfully..';
		}
		else if($this->session->userdata('compareTeacher')) {
			$count = 0;
			unset($_SESSION['compareTeacher']);
			$response['success'] = true;
			$response['count'] = $count;
			$response['message'] = 'Cleared Successfully..';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'No Session..';	
		}

		echo json_encode($response);
	}

	public function compare_school()
	{
		$data = array();
		$this->global['pageTitle'] = ' | Compare Schools';
		if($this->session->userdata('compareSchool')) {
			$compareArr = $this->session->userdata('compareSchool');
			$data['compare'] = $compareArr;
		}
		else {

			$data['compare'] = array();
		}

		$this->general->loadViewsFront(FRONTEND."compare_school", $this->global, $data, NULL);
	}

	public function compare_teacher()
	{
		$data = array();
		$this->global['pageTitle'] = ' | Compare Teachers';
		if($this->session->userdata('compareTeacher')) {
			$compareArr = $this->session->userdata('compareTeacher');
			$data['compare'] = $compareArr;
		}
		else {

			$data['compare'] = array();
		}

		$this->general->loadViewsFront(FRONTEND."compare_teacher", $this->global, $data, NULL);
	}

	/**/
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

  	function getAddressFromIp($ip)
  	{
  		if($_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "10.0.0.102") {
  			$getloc = json_decode(file_get_contents("http://ipinfo.io/"));
  		}
  		else {
  			$getloc = json_decode(file_get_contents("http://ipinfo.io/".$ip));
  		}
  		
  		$latlong = $getloc->loc;
  		$latlong = explode(',', $latlong);
  		/*$lat = $latlong[0];
  		$long = $latlong[1];*/
  		return $latlong;
  	}
	/**/


	/* Paypal */
	function buy()
	{
		$post = $this->input->post();
		if(!empty($post['amount']) && !empty($post['school']) )
        {
        	if(isset($post['paymentCreditCardBtn'])) {
        		// Credit Card
        		$data = $post;
        		unset($data['paymentCreditCardBtn']);
        		
        		$this->load->view(FRONTEND.'getcreditcard',$data);
        	}
        	if(isset($post['paymentBtn'])) {
        		// using paypal login
	        	if( !isset($this->session->USER['UId']) ) {
					redirect(base_url('login'));
				}
			  	
			  	$school_id = $post["school"];
			  	$start_date = $post["start_date"];
			  	$end_date = $post["end_date"];
			  	$result = $this->db->select('name')->from('tbl_school')->where('id',$school_id)->get()->result_array();
			  	$school_name =  $result[0]['name'];
			  	$amount = $post["amount"];

	          	$this->load->library('paypal_lib');
	          	$returnURL = base_url().'Home/Paypal_Success';
	          	$cancelURL = base_url().'Home/Paypal_Cancel';
	          	$notifyURL = base_url().'Home/Paypal_ipn';
	          	$first_name = $this->session->USER['UName'];
	          	$last_name = $this->session->USER['UName'];
	          	$email = $this->session->USER['UEmail'];
	          	$userID = $this->session->USER['UId'];
	          	// Add fields to paypal form  
	          
	          	$this->paypal_lib->add_field('return', $returnURL);
	          	$this->paypal_lib->add_field('cancel_return', $cancelURL);
	          	$this->paypal_lib->add_field('notify_url', $notifyURL);
	          	$this->paypal_lib->add_field('custom', $post["school"].'_'.$userID.'_'.$start_date.'_'.$end_date);                    
	          	$this->paypal_lib->add_field('no_shipping', '1');
	          	$this->paypal_lib->add_field('first_name', $first_name);
	          	$this->paypal_lib->add_field('last_name', $last_name);
	          	$this->paypal_lib->add_field('email', $email);
	          
	          	$this->paypal_lib->add_field('item_name_1', $school_name);
	          	$this->paypal_lib->add_field('item_number_1', 1);
	          	$this->paypal_lib->add_field('amount_1', $amount);
	          	$this->paypal_lib->add_field('quantity_1', 1);

	          	$this->paypal_lib->paypal_auto_form();
	         	// Paypal integration end //
        	}

	    }else{
	    	$this->session->set_flashdata('error','Password Does Not Match Please Enter Correct Password!!');
			redirect(base_url('login'));
	    }

    }

    public function Paypal_ipn()
    {


    	$paypalInfo = $this->input->post();

    	$paypalInfo = array('mc_gross' => '204.96','protection_eligibility' => 'Eligible','address_status' => 'confirmed','item_number1' => '1','item_number2' => '2','payer_id' => '7BGH5L7MYVYVQ','address_street' => 'Flat no. 507 Wing A Raheja Residency Film City Road, Goregaon East','payment_date' => '05:02:49 Jul 25, 2018 PDT','payment_status' => 'Completed','charset' => 'windows-1252','address_zip' => '400097','first_name' => 'test','mc_fee' => '8.29','address_country_code' => 'IN','address_name' => 'test buyer','notify_version' => '3.9','custom' => '1','payer_status' => 'verified','business' => 'crazycoder08@gmail.com','address_country' => 'India','num_cart_items' => '2','address_city' => 'Mumbai','verify_sign' => 'ALxGJYdzDSvPgFHgC84ph2vBgxZUADenlC.URKpDyfo4yg5P3x2CUNfw','payer_email' => 'ghiadeep-buyer@gmail.com','txn_id' => '935823910L234103R','payment_type' => 'instant','last_name' => 'buyer','address_state' => 'Maharashtra','item_name1' => 'Standard Product Photos Page','receiver_email' => 'crazycoder08@gmail.com','item_name2' => 'Standard Product Photos Page','payment_fee' => '8.29','quantity1' => '1','quantity2' => '1','receiver_id' => 'KZMPRZUAP75H2','txn_type' => 'cart','mc_gross_1' => '109.98','mc_currency' => 'USD','mc_gross_2' => '94.98','residence_country' => 'IN','test_ipn' => '1','transaction_subject' => '','payment_gross' => '204.96','ipn_track_id' => 'a614f8e58fe36');

    	$data1 = json_encode($paypalInfo);
    	$my_file = 'file.txt';
    	$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
    	$data = $data1.'\n\n\n';
    	fwrite($handle, $data);


        $custom = $paypalInfo["custom"]; 
        $name = ucfirst($paypalInfo["first_name"]).' '. ucfirst($paypalInfo["last_name"]); 
        $email = $paypalInfo["email"];
        $arr = explode('_', $custom);
        $school_id = $arr[0];
        $user_id = $arr[1];
        $start_date = date('Y-m-d', strtotime($arr[2]) ) ;
        $end_date = date('Y-m-d', strtotime($arr[3]) ) ;

        $receiver_email = $paypalInfo["receiver_email"];
        $array['payment_method'] = 'Paypal';
        $array['payment_status'] = $paypalInfo["payment_status"];
        $array['payer_email'] = $paypalInfo["payer_email"];
        $array['currency_code'] = $paypalInfo["mc_currency"];
        $array['payment_amt'] = $paypalInfo["payment_gross"];
        $array['school_id'] = $school_id;
        $array['user_id'] = $user_id;
        
        if($paypalInfo["payment_status"] == 'Refunded'){
            /*$array['refund_txn_id'] = $paypalInfo["txn_id"];
            $array['status'] = "Cancelled";
            $array['request'] = "ca";*/
        }else{
            $array['txn_id'] = $paypalInfo["txn_id"];
        }

        $school_data = array(
        	'is_sponsored'=>'1',
        	'start_date'=>$start_date,
        	'end_date'=>$end_date,
        	);
        $this->common->update_record( 'tbl_school', $school_data, array('id'=>$school_id) );
        $insert = $this->common->insert_record('transaction',$array);

        $edata['name'] = $name;
        $edata['paypal'] = $paypalInfo;
        $email_body = $this->load->view(FRONTEND.'email/sponsor_payment', $edata, TRUE);
		$mailbody = array('ToEmail'=>$email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Sponsor school payment successfully','Message'=>$email_body);
		$this->general->EmailSend($mailbody);

        /*
        $send_data = array("to"=>'14.vinesh@gmail.com',
						   "subject"=>'Success',
						   "message"=> json_encode($paypalInfo) );
		$this->general->SendSimpleMail($send_data);    
        $from_email = FROMMAIL;
        $from_email = 'hiteshd84@gmail.com';
        $email = '14.vinesh@gmail.com';
        $message = $this->load->view('paypal/payment_success', $array, TRUE);
        $mail_result = $this->general->EmailSend($from_email,$email,'Sponsor school payment successfully',$message);
        */



    }
    public function Paypal_Cancel()
	{
		$this->global['pageTitle'] = 'Cancelled';
		$this->general->loadViewsFront(FRONTEND."paypal/cancel", $this->global, NULL, NULL);
	}
	public function Paypal_Success()
	{

		$this->global['pageTitle'] = 'Thanks for Sponsor a School';
		$this->general->loadViewsFront(FRONTEND."paypal/success", $this->global, NULL, NULL);
		
	}
	/* Paypal */

	public function clearSession()
	{
		// unset($_SESSION['compareSchool']);
		unset($_SESSION['compareTeacher']);
		$keys = array('schoolBtn','teacherBtn');
		foreach ($keys as $key) {
			unset($_SESSION[$key]);
		}
	}

	public function test()
	{
		echo "testing...";
	}

	public function sendTestMail($OrderId)
	{
		$this->load->model('Adminmodel');
		$emaildata['UserName'] = $emaildata['orderinfo']['FullName'];
		$email_body = $this->load->view(FRONTEND.'email/order_main', $emaildata, TRUE);
		$mailbody = array('ToEmail'=>$emaildata['orderinfo']['Email'],'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'','Message'=>$email_body);
		if($this->sendemail)
			echo $email_body;
			$this->general->EmailSend($mailbody);

	}

	public function get_notify()
	{
		$current_time = date('Y-m-d H:i:s');
		$time_before_6sec = date('Y-m-d H:i:s', strtotime('-6 seconds') );

		$notify = $this->common->get_all('notify',array('created_date>='=>$time_before_6sec,'created_date<='=>$current_time),array());
		$response['notify'] = $notify;
		echo json_encode($response);

		/*foreach ($notify as $key => $value) {			
			$this->common->update_record('notify',array('is_view'=>'Y'),array('id'=>$value['id']));
		}*/
	}

	public function update_notify()
	{
		$id = $this->input->post('id');
		$this->common->update_record('notify',array('is_view'=>'Y'),array('id'=>$id));
		
	}
	public function set_like($schol_id = '')
	{

		if( !empty($schol_id)){
			$id = $schol_id;	
		}else{
			$post = $this->input->post();
			$id = $post['id'];	
		}
		
		$user_id = $this->session->USER['UId'];
		$already = $this->db->select('id')->where('user_id',$user_id)->where('school_id',$id)->get('like')->num_rows();		
		if($already > 0){
			$this->db->where('user_id', $user_id);
			$this->db->where('school_id', $id);
      		$result = $this->db->delete('like'); 
      		// $msg =  'Unlike Successfully.';
			$msg =  'Thank you for unliking this post.';
		}else{

			$data = array(
					'user_id'=>$user_id,
					'school_id'=>$id,
					);
			$result =  $this->db->insert('like',$data);
			// $msg =  'Thank you for sharing your interest.';
			$msg =  'Thank you for liking this post.';
		}
		if( !empty($schol_id)){
			redirect(base_url('schools/'));
		}else{
			$tot_like = $this->db->select('id')->where('school_id',$id)->get('like')->num_rows();
			$response['success'] = true;
			$response['count'] = $tot_like;
			$response['message'] = $msg;
			echo json_encode($response);
		}
	}
	

	public function search_keyword()
	{
		$post = $this->input->post();
		
		$keyword = $post['s_text'];

		$query = "SELECT * FROM ( select b.id, b.title as name, 'bulletin' as recordtype from tbl_bulletin b WHERE b.title like '%".$keyword."%' union all select id, s.name AS name, 'school' as recordtype from tbl_school s WHERE s.name like '%".$keyword."%' union all select id, c.task_name as name, 'calendar' as recordtype from tbl_calendar c WHERE c.task_name like '%".$keyword."%' union all select id, CONCAT(t.fname,' ',t.lname) as name, 'teacher' as recordtype from tbl_teacher t WHERE t.fname like '%".$keyword."%' OR t.lname like '%".$keyword."%' ) as bs ORDER by id DESC LIMIT 0,10";

		$result = $this->db->query($query)->result_array();

		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
		
		$searchArray = array();
		foreach ($result as $key => $value) {
			$url = '#';
			if($value['recordtype'] == 'school') {
				$url = base_url().'school/'.md5($value['id']);
			}
			if($value['recordtype'] == 'teacher') {
				$url = base_url().'teacher/'.md5($value['id']);
			}
			if($value['recordtype'] == 'bulletin') {
				$url = base_url().'bulletin-detail/'.md5($value['id']);
			}
			if($value['recordtype'] == 'calendar') {
				$url = base_url().'calendar/view/'.$value['id'];
			}
			$searchArray[$key]['id'] = $url;
			$searchArray[$key]['name'] = ucwords($value['name']);
		}

		echo json_encode($searchArray);
	}
	
	function full_search()
	{
		$post = $this->input->get();
		$keyword = $post['searchText'];

		$query = "SELECT * FROM ( select b.id, b.title as name, 'bulletin' as recordtype, b.created_date as mydate from tbl_bulletin b WHERE b.title like '%".$keyword."%' union all select id, s.name AS name, 'school' as recordtype, s.created_date as mydate from tbl_school s WHERE s.name like '%".$keyword."%' union all select id, c.task_name as name, 'calendar' as recordtype, c.created_date as mydate from tbl_calendar c WHERE c.task_name like '%".$keyword."%' union all select id, CONCAT(t.fname,' ',t.lname) as name, 'teacher' as recordtype, t.created_date as mydate from tbl_teacher t WHERE t.fname like '%".$keyword."%' OR t.lname like '%".$keyword."%' ) as bs ORDER by id,mydate DESC LIMIT 0,50";
		
		$full_search = $this->db->query($query)->result_array();

		$schoolArr = $teacherArr = $bulletinArr = $calendarArr = array();
		
		foreach ($full_search as $search_key => $search) {
			if($search['recordtype'] == 'bulletin') {
				array_push($bulletinArr, $search);
			}
			if($search['recordtype'] == 'school') {
				array_push($schoolArr, $search);
			}
			if($search['recordtype'] == 'calendar') {
				array_push($calendarArr, $search);
			}
			if($search['recordtype'] == 'teacher') {
				array_push($teacherArr, $search);
			}
		}

		$data['schools'] = $schoolArr;
		$data['teachers'] = $teacherArr;
		$data['events'] = $calendarArr;
		$data['bulletins'] = $bulletinArr;
		$data['totalRecords'] = count($full_search);

		$this->global['pageTitle'] = ' | Search Result';
		$this->general->loadViewsFront(FRONTEND."full_search", $this->global, $data, NULL);
	}

	function paypal_credit_card_payment()
	{
		require_once(APPPATH.'third_party/php-paypal-credit-card/PPBootStrap.php');
		$post = $this->input->post();
		
		$p_price = $post['amount'];
		$p_currency = 'USD';

		$school_data = $this->common->get_one_row('tbl_school',array('id'=>$post['id']));
		$p_name = $school_data['name'];

		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];

		/*
		* shipping adress
		*/
		$address = new AddressType();
		$address->Name = "$firstName $lastName";
		$address->Street1 = $_POST['address1'];
		$address->Street2 = $_POST['address2'];
		$address->CityName = $_POST['city'];
		$address->StateOrProvince = $_POST['state'];
		$address->PostalCode = $_POST['zip'];
		$address->Country = $_POST['country'];
		$address->Phone = $_POST['phone'];

		$orderTotal = new BasicAmountType();
		$orderTotal->currencyID = $p_currency;
		$orderTotal->value = $p_price;

		$paymentDetails = new PaymentDetailsType();
		$paymentDetails->ShipToAddress = $address;

		$itemDetails = new PaymentDetailsItemType();
		$itemDetails->Name = $p_name;

		$itemDetails->Amount = $orderTotal;

		$itemDetails->Quantity = '1';

		$itemDetails->ItemCategory = 'School';
		$paymentDetails->PaymentDetailsItem[0] = $itemDetails;
		$paymentDetails->OrderTotal = $orderTotal;
		
		if (isset($_REQUEST['notifyURL'])) {
			$paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
		}

		$personName = new PersonNameType();
		$personName->FirstName = $firstName;
		$personName->LastName = $lastName;

		//information about the payer
		$payer = new PayerInfoType();
		$payer->PayerName = $personName;
		$payer->Address = $address;
		$payer->PayerCountry = $_POST['country'];

		$cardDetails = new CreditCardDetailsType();
		$cardDetails->CreditCardNumber = $_POST['creditCardNumber'];
		
		$cardDetails->CreditCardType = $_POST['creditCardType'];
		$cardDetails->ExpMonth = $_POST['expDateMonth'];
		$cardDetails->ExpYear = $_POST['expDateYear'];
		$cardDetails->CVV2 = $_POST['cvv2Number'];
		$cardDetails->CardOwner = $payer;

		$ddReqDetails = new DoDirectPaymentRequestDetailsType();
		$ddReqDetails->CreditCard = $cardDetails;
		$ddReqDetails->PaymentDetails = $paymentDetails;
		$ddReqDetails->PaymentAction = $_REQUEST['paymentType'];

		$doDirectPaymentReq = new DoDirectPaymentReq();
		$doDirectPaymentReq->DoDirectPaymentRequest = new DoDirectPaymentRequestType($ddReqDetails);

		$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
		try {
			/* wrap API method calls on the service object with a try catch */
			$doDirectPaymentResponse = $paypalService->DoDirectPayment($doDirectPaymentReq);
		}
		catch (Exception $ex) {
			$ex_message = $ex->getMessage();
			$ex_type = get_class($ex);
			if($ex instanceof PPConnectionException) {
				$ex_detailed_message = "Error connecting to " . $ex->getUrl();
			} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
				$ex_detailed_message = $ex->errorMessage();
			} else if($ex instanceof PPConfigurationException) {
				$ex_detailed_message = "Invalid configuration. Please check your configuration file";
			}
			
			$data['ex_type'] = $ex_type;
			$data['ex_message'] = $ex_message;
			$data['ex_detailed_message'] = $ex_detailed_message;
		}

		$this->global['pageTitle'] = ' | Paypal Payment';
		
		if ($doDirectPaymentResponse->Ack == 'Success') {
			$data['amount'] = $doDirectPaymentResponse->Amount->value;
			$data['currency'] = $doDirectPaymentResponse->Amount->currencyID;
			$data['TransactionID'] = $doDirectPaymentResponse->TransactionID;

			$this->general->loadViewsFront(FRONTEND.'paypal/credit_success',$this->global, $data, NULL);
		}
		else {
			$data = array();
			$this->general->loadViewsFront(FRONTEND.'paypal/credit_failed',$this->global, $data, NULL);
		}

	}
}