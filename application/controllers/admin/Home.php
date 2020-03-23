<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->general->adminauth();
		$this->load->model('Adminmodel');

		$data['school'] = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'status'=>1,'approval'=>0));
		$data['teacher'] = $this->common->get_all_record('tbl_teacher','*',array('isDelete'=>0,'status'=>1,'approval'=>0));
		$data['user'] = $this->common->get_all_record('tbluser','*',array('isDelete'=>0/*,'status'=>1*/));
		$data['school_nofitifation'] = $this->common->get_all_record('tbl_school','*',array('approval'=>2));
		$data['teacher_nofitifation'] = $this->common->get_all_record('tbl_teacher','*',array('approval'=>2));

		$data['tbl_calendar'] =$this->common->get_all_record('tbl_calendar','*',array('approval'=>2));
		// $data['school_nofitifation_review'] =$this->common->get_all_record('tbl_rating','*',array('schoolId !='=>0,'isDelete'=>0,'rating <='=>2));
		$data['school_nofitifation_review'] =$this->common->get_all_record('tbl_rating','*',array('schoolId !='=>0,'isDelete'=>0,'rating <='=>2,'status'=>0));
		// $data['teacher_nofitifation_review'] =$this->common->get_all_record('tbl_rating','*',array('teacherId !='=>0,'isDelete'=>0,'rating <='=>2));
		$data['teacher_nofitifation_review'] =$this->common->get_all_record('tbl_rating','*',array('teacherId !='=>0,'isDelete'=>0,'rating <='=>2,'status'=>0));



		$this->global['pageTitle'] = ' | Home';
        $this->general->loadViews(ADMIN."home", $this->global, $data, NULL);
	}

	public function SoftDelete($data = '')
	{
		$this->general->soft_delete($data);
	}
	public function DeleteRecord($data = '')
	{
		$this->general->delete_record($data);
	}

	public function new_user_chart() {

		$response = array();
		
		$curr_date = date("Y-m-d H:i:s");
		$first_week_end = date('Y-m-d H:i:s', strtotime($curr_date. ' +1 days'));
		$first_week_start =  date('Y-m-d H:i:s', strtotime($curr_date. ' -7 days'));

		$sec_week_end = date('Y-m-d H:i:s', strtotime($first_week_start. ' +1 days'));
		$sec_week_start =  date('Y-m-d H:i:s', strtotime($sec_week_end. ' -7 days'));

		$this->db->select("id,fname");
		$this->db->from("tbluser");
		$this->db->where('createDate <=', $first_week_end);
		$this->db->where('createDate >=', $first_week_start);
		$first = $this->db->get()->result_array();

		$this->db->select("id,fname");
		$this->db->from("tbluser");
		$this->db->where('createDate <=', $sec_week_end);
		$this->db->where('createDate >=', $sec_week_start);
		
		$sec = $this->db->get()->result_array();

		$response['first_week'] = count($first);
		$response['sec_week'] = count($sec);
		echo json_encode($response);


	}

	public function review_counter() {

		$response = array();

		$data['teacher_review'] = $this->common->get_all_record('tbl_rating','*',array('schoolId !='=>0));
		$data['school_review'] = $this->common->get_all_record('tbl_rating','*',array('teacherId!='=>0));
		
		$response['teacher'] = count($data['teacher_review']);
		$response['school'] = count($data['school_review']);
		echo json_encode($response);


	}

	public function new_review() 
	{
		$response = array();
		
		$curr_date = date("Y-m-d H:i:s");
		$first_week_end = date('Y-m-d H:i:s', strtotime($curr_date. ' +1 days'));
		$first_week_start =  date('Y-m-d H:i:s', strtotime($curr_date. ' -7 days'));

		$sec_week_end = date('Y-m-d H:i:s', strtotime($first_week_start. ' +1 days'));
		$sec_week_start =  date('Y-m-d H:i:s', strtotime($sec_week_end. ' -7 days'));

		$this->db->select("id,schoolId");
		$this->db->from("tbl_rating");
		$this->db->where("schoolId !=",0);
		$this->db->where('created_date <=', $first_week_end);
		$this->db->where('created_date >=', $first_week_start);
		$first_week_school = $this->db->get()->result_array();

		$this->db->select("id,schoolId");
		$this->db->from("tbl_rating");
		$this->db->where("schoolId !=",0);
		$this->db->where('created_date <=', $sec_week_end);
		$this->db->where('created_date >=', $sec_week_start);
		
		$sec_week_school = $this->db->get()->result_array();

		$school_array = array("0"=>count($first_week_school),"1"=>count($sec_week_school));

		$this->db->select("id,teacherId");
		$this->db->from("tbl_rating");
		$this->db->where("teacherId !=",0);
		$this->db->where('created_date <=', $first_week_end);
		$this->db->where('created_date >=', $first_week_start);
		$first_week_teacher = $this->db->get()->result_array();

		$this->db->select("id,teacherId");
		$this->db->from("tbl_rating");
		$this->db->where("teacherId !=",0);
		$this->db->where('created_date <=', $sec_week_end);
		$this->db->where('created_date >=', $sec_week_start);
		
		$sec_week_teacher = $this->db->get()->result_array();

		$teacher_array = array("0"=>count($first_week_teacher),"1"=>count($sec_week_teacher));

		$response['teacher'] = $teacher_array;
		$response['school'] = $school_array;
		echo json_encode($response);
	}

	public function traffic_weekly_engagement() {

		$response = array();
		$curr_date = date("Y-m-d H:i:s");
		$end_date = date('Y-m-d H:i:s',strtotime($curr_date. ' -1 days'));
		$start_date =  date('Y-m-d H:i:s', strtotime($curr_date. ' -8 days'));	

		$my_array = array();
		$key = 0;
		while (strtotime($start_date) <= strtotime($end_date)) {
		    $timestamp = strtotime($start_date);
		    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
		    $month = date('M',strtotime($start_date));
		    $day = date('j', strtotime($start_date));
		    $my_array[$key]['activity'] = $this->get_activity_chart($start_date);
		    $val_day = $day." ".$month;
		    $my_array[$key]['day'] = $val_day;
		    $key++;
		}
		echo json_encode($my_array);
	}

	public function traffic_monthly_engagement() {

		$response = array();
		$curr_date = date("Y-m-d H:i:s");
		$end_date = date('Y-m-d H:i:s',strtotime($curr_date. ' -1 months'));
		$start_date =  date('Y-m-d H:i:s', strtotime($curr_date. ' -12 months'));	

		$my_array = array();
		$key = 0;
		while (strtotime($start_date) <= strtotime($end_date)) {
		    $timestamp = strtotime($start_date);
		    $start_date = date ("Y-m-d", strtotime("+1 months", strtotime($start_date)));
		    $month = date('M',strtotime($start_date));
		    $day = date('j', strtotime($start_date));
		    $my_array[$key]['activity'] = $this->get_activity_chart($start_date);
		    $val_day = $day." ".$month;
		    $my_array[$key]['day'] = $val_day;
		    $key++;
		}
		echo json_encode($my_array);
	}

	public function top_school()
	{
		$response = array();
		$curr_date = date("Y-m-d H:i:s");
		$end_date = date('Y-m-d H:i:s',strtotime($curr_date. ' -1 days'));
		$start_date =  date('Y-m-d H:i:s', strtotime($curr_date. ' -8 days'));	

		$my_array = array();
		$wh = array('p.schoolId !=' => '','p.created_date >=' => 'NOW()');
		$tables = array('tbl_pageviews p','tbl_school s');
		$joins = array('p.schoolId=s.id');
		$rows = 'COUNT(p.schoolId) as total_count, s.name';
		$groupBy = 'p.schoolId';
		$order_by = array();
		$keywords = '';
		$field_array = array();
		$find_in_set = '';
		$params['limit'] = 10;
		$params['offset'] = 0;
		$pageViewSchool = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		$schools = array();
		$count = array();
		foreach ($pageViewSchool as $school) {
			// array_push($schools, str_replace('-', '', substr($school['name'],0,25)));
			array_push($schools, str_replace('-', '', $school['name']));
			array_push($count, $school['total_count']);
		}
		$my_array['schools'] = $schools;
		$my_array['count'] = $count;
		echo json_encode($my_array);	
	}

	public function top_teacher()
	{
		$response = array();
		$curr_date = date("Y-m-d H:i:s");
		$end_date = date('Y-m-d H:i:s',strtotime($curr_date. ' -1 days'));
		$start_date =  date('Y-m-d H:i:s', strtotime($curr_date. ' -8 days'));	

		$my_array = array();
		$wh = array('p.teacherId !=' => '','p.created_date >=' => 'NOW()');
		$tables = array('tbl_pageviews p','tbl_teacher t');
		$joins = array('p.teacherId=t.id');
		$rows = 'COUNT(p.teacherId) as total_count, CONCAT(t.fname," ",t.lname) as name';
		$groupBy = 'p.teacherId';
		$order_by = array();
		$keywords = '';
		$field_array = array();
		$find_in_set = '';
		$params['limit'] = 10;
		$params['offset'] = 0;
		$pageViewTeacher = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		$teachers = array();
		$count = array();
		foreach ($pageViewTeacher as $teacher) {
			// array_push($teachers, str_replace('-', '', substr($teacher['name'],0,25)));
			array_push($teachers, str_replace('-', '', $teacher['name']));
			array_push($count, $teacher['total_count']);
		}
		$my_array['teachers'] = $teachers;
		$my_array['count'] = $count;
		echo json_encode($my_array);
	}

	function get_activity_chart($start_date) {

	    $data = $this->db->select(" *, count(ip) as total_activity ")
	    ->from("tbl_traffic")
	    ->group_by("ip")
	    ->like("created_date",$start_date)
	    ->get()->result_array();
	    if(count($data)==null) {
	        $res = "0";
	    } else {
	        $res = count($data);
	    }
	    return $res;
	}
}
