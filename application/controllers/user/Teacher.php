<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Settingmodel');
		$this->sendemail = false;
	}

	public function index()
	{

		$filter_open = 'YES';
		$post = $this->input->get();
		
		if(isset($post['filterby']) && $post['filterby'] == 'teacher') {
			if(!isset($post['type']) AND !isset($post['sector']) AND !isset($post['selective']) AND !isset($post['boarding']) AND !isset($post['international_students']) AND !isset($post['scholarship_offer']) AND !isset($post['international_baccalaureate']) AND !isset($post['']) AND $post['state'] == '' AND $post['distance'] == '' AND $post['gender'] == '' AND $post['religion'] == '' AND $post['no_of_students'] == '' AND (isset($post['special_needs_support']) && $post['special_needs_support'] == '') AND $post['need_experience'] == '' AND $post['wwcc_number'] == '' AND $post['multilanguage'] == '' AND $post['tutoring_services'] == '' AND $post['preferred_hours'] == '') {
				$filter_open = 'NO';
			}
		}
		$data['filter_open'] = $filter_open;

		// redirect('NotFoundController');
		$post = $this->input->get();
		$data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1,'approval'=>0));
		$data['searchParam'] = (!empty($post)) ? $post['searchText'] : '';
		$this->global['pageTitle'] = ' | Teachers';
		$data = array_merge($data,$post);

		$data['special_need_category'] = $this->config->item('special_need_category');
        // $this->general->loadViewsFront(FRONTEND."schools", $this->global, $data, NULL);
        $this->general->loadViewsFront(FRONTEND."teacher_listing", $this->global, $data, NULL);
	}

	public function search_result($rowno=0)
	{
		$data['special_need_category'] = $this->config->item('special_need_category');
		$post = $this->input->post();
		
		$fetchArr = array('top-10-teacher-in-australia','most-viewed-teacher','best-teacher-in-nsw','best-teacher-in-vic','best-teacher-in-qld','best-teacher-in-nt','best-teacher-in-wa','best-teacher-in-sa','best-teacher-in-act','best-teacher-in-tas');

		if(isset($post['fetchdata']) && in_array($post['fetchdata'], $fetchArr)) {
			$search = $area = $type = '';
			/**/
			if($post['fetchdata'] == 'top-10-teacher-in-australia') {
				
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0);
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 10;
				$params['offset'] = 0;

			}
			if($post['fetchdata'] == 'most-viewed-teacher') {
				
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
			}
			if($post['fetchdata'] == 'best-teacher-in-nsw') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'NSW');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-vic') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'VIC');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-qld') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'QLD');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-nt') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'NT');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-wa') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'WA');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-sa') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'SA');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-act') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'ACT');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}
			if($post['fetchdata'] == 'best-teacher-in-tas') {
				
				$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0,'st.shortName'=>'TAS');
				$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2','tbl_rating r','tbl_state st');
				$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id','r.teacherId=t.id','s1.state=st.id');
				$rows = 't.*, s1.name as current_school, s2.name as previous_school,AVG(r.rating) AS average_rating';
				$groupBy = 't.id';
				$order_by = array('average_rating'=>'DESC');
				$keywords = '';
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
				$find_in_set = '';
				$params['limit'] = 1;
				$params['offset'] = 0;
			}

			$limit = $params['limit'];
			//$res = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

			$params = array();

			if(!empty($post["need_experience"])){
				$wh['t.need_experience'] =  $post["need_experience"];
				if($post["need_experience"]=='1' && !empty($post["special_need_category"])) {
					$wh['t.special_need_category'] = $post["special_need_category"];
				}

			}
			
			/*if(!empty($post["working_with_children"])){
				$wh['t.working_with_children'] =  $post["working_with_children"];
				if(!empty($post["wwcc_number"])){
					$wh['t.wwcc_number'] =  $post["wwcc_number"];
				}
			}*/

			if(!empty($post["wwcc_number"])){
				if($post["wwcc_number"]=='1') {
					$wh['t.wwcc_number !='] =  '';
				} else if($post["wwcc_number"]=='0') {
					$wh['t.wwcc_number'] =  '';
				}
			}


			if(!empty($post["tutoring_services"])){
				$wh['t.tutoring_services'] =  $post["tutoring_services"];
				if(!empty($post["preferred_hours"])){
					$wh['t.preferred_hours'] =  $post["preferred_hours"];
				}
			}
			if(!empty($post["multilanguage"])){
				$wh['t.multilanguage'] =  $post["multilanguage"];
				if(!empty($post["language"])){
					foreach ($post["language"] as $key => $value) {
		                $find_in_set .= '( find_in_set("'.$value.'",t.language) <> 0) OR';
		            }
		            $find_in_set = rtrim($find_in_set,'OR');
		        }
	            

			}
			
			$res2 = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
			// echo $this->db->last_query(); die();
			$bestArr = array('best-teacher-in-nsw','best-teacher-in-vic','best-teacher-in-qld','best-teacher-in-nt','best-teacher-in-wa','best-teacher-in-sa','best-teacher-in-act','best-teacher-in-tas');
			if(in_array($post['fetchdata'], $bestArr)) {
				if(!empty($res2)) {
					$teacherId = md5($res2[0]['id']);
					$data['redirect_link'] = base_url().'teacher/'.$teacherId;
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
	        $config ['base_url'] =  base_url().'find-teacher';
	        // $config ['total_rows'] = count($res2);
	        $config ['total_rows'] = 10;
	        $config['use_page_numbers'] = TRUE;
	        // $config ['per_page'] = $rowperpage;
	        $config ['per_page'] = 10;
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

			$params['limit'] = $limit; //10;
			$params['start'] = 0;
			$params['offset'] = 0;

			$res = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

			// echo $this->db->last_query(); die();
			$this->pagination->initialize($config);
	        $data['page_link'] = $this->pagination->create_links( );
	        $data['result'] = $res;
	        $data['row'] = $rowno;
	        $data['no_of_item'] = count($res);
	        /*echo "<pre>";
	        print_r($data);
	        die();*/
	        
		}
		else {

			/**/
			$wh = array('t.isDelete'=>0,'t.status'=>1,'t.approval'=>0);
			$find_in_set = '';
			if(isset($post['searchparam'])) {
				$search = $post['searchparam'];
			}
			else if (isset($post['searchText'])) {
				$search = $post['searchText'];
			}
			else {
				$search = '';
			}
			/**/
			$type = '';
			if(isset($post['language']) && $post['language'] != '')  {
				$type = $post['language'];
				$type = implode(',', $type);
			}
			$tables = array('tbl_teacher t','tbl_school s1','tbl_school s2');
			$joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id');

			// $joins = array('left','t.teach_school = s1.id','t.previous_school = s2.id');
			$rows = 't.*, s1.name as current_school, s2.name as previous_school';
			
			/*echo "---------------------";
				echo "<pre>";
				print_r($joins);
				die();*/
			/*$wh['t.teach_school != '] = '0';
			$wh['t.previous_school != '] = '0';*/

			$groupBy = '';
			$order_by = array('t.id'=>'ASC');
			$keywords = $search;
			if($type != '') {
				// $field_array = array('t.language'=>$type);
				$field_array = array();
			}
			else {
				$field_array = array('t.fname','t.lname','CONCAT(t.fname," ",t.lname)');
			}

			if(!empty($post["need_experience"])){
				/*$wh['t.need_experience'] =  $post["need_experience"];
				if($post["need_experience"]=='1' && !empty($post["special_need_category"])) {
					$wh['t.special_need_category'] = $post["special_need_category"];
				}*/

			}
			
			/*if(!empty($post["working_with_children"])){
				$wh['t.working_with_children'] =  $post["working_with_children"];
				if(!empty($post["wwcc_number"])){
					$wh['t.wwcc_number'] =  $post["wwcc_number"];
				}
			}	*/

			if(!empty($post["wwcc_number"])){
				if($post["wwcc_number"]=='1') {
					$wh['t.wwcc_number !='] =  '';
				} else if($post["wwcc_number"]=='0') {
					$wh['t.wwcc_number'] =  '';
				}
			}
		
			if(!empty($post["tutoring_services"])){
				$wh['t.tutoring_services'] =  $post["tutoring_services"];
				if(!empty($post["preferred_hours"])){
					$wh['t.preferred_hours'] =  $post["preferred_hours"];
				}
			}
			
			if(!empty($post["multilanguage"])){
				$wh['t.multilanguage'] =  $post["multilanguage"];
				if(!empty($post["language"])){
					foreach ($post["language"] as $key => $value) {
		                $find_in_set .= '( find_in_set("'.$value.'",t.language) <> 0) OR';
		            }
		            $find_in_set = rtrim($find_in_set,'OR');
		        }
	            

			}

			if(!empty($post['special_need_category'])){				
				foreach ($post['special_need_category'] as $key => $value) {
	                $find_in_set .= '( find_in_set("'.$value.'",t.special_need_category) <> 0) OR';
	            }
	            $find_in_set = rtrim($find_in_set,'OR');	            
	        }

			/*$params['limit'] = 5;
			$params['offset'] = 0;
			*/
			//$res = $this->common->get_join_all_record_search($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);
			$params = array();
			$res2 = $this->common->get_join_all_record_search($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);
			// echo $this->db->last_query(); die();
			$rowperpage = 5;
			if($rowno != 0){
	            $rowno = ($rowno-1) * $rowperpage;
	        } 
	        
	        $this->load->library ( 'pagination' );
	        $config ['base_url'] =  base_url().'find-teacher';
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
			$res = $this->common->get_join_all_record_search($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params,$find_in_set);

			$this->pagination->initialize($config);
	        $data['page_link'] = $this->pagination->create_links( );
	        $data['result'] = $res;
	        $data['row'] = $rowno;

			$data['no_of_item'] = count($res2);
		}

		// echo $this->db->last_query(); die();
		/**/
		$data['result'] = $res;
		if(!isset($data['redirect_link'])) {
			$this->load->view(FRONTEND.'ajax/filter_teacher',$data);
		}
		else {
			echo json_encode($data);
		}
		/*$this->global['pageTitle'] = ' | Search Result';
        $this->general->loadViewsFront(FRONTEND."school_listing", $this->global, $data, NULL);*/
	}

	public function teacher_details($id)
	{
		
		$this->session->set_userdata('teacherBtn',true);
		$teacher = $this->common->get_one_row('tbl_teacher',array('md5(id)'=>$id));
		if(empty($teacher)) {
			redirect('404');
		}

		/**/
		$school = $this->common->get_one_row('tbl_school',array('id'=>$teacher['id']));
		$ip = $this->input->ip_address();
		$check = $this->common->get_one_row('tbl_pageviews',array('ip'=>$ip,'teacherId'=>$teacher['id']));
		if($check == '') {
			$pageViewData = array('ip'=>$ip,'teacherId'=>$teacher['id']);
			if(isset($this->session->USER['UId'])) {
				$pageViewData['userId'] = $this->session->USER['UId'];
			}
			$insertPageView = $this->common->insert_record('tbl_pageviews',$pageViewData);
		}
		/**/
		
		$state = $this->common->get_one_row('tbl_state',array('id'=>$school['state']));
		/*$schools = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'status'=>1));*/
		$teachers = $this->common->get_all_record('tbl_teacher','*',array('isDelete'=>0,'status'=>1));
		$pageView = $this->common->get_all_record_groupby('tbl_pageviews','count(*) AS pageview',array('teacherId'=>$teacher['id']),'teacherId');
		$pageView = $pageView[0]['pageview'];
		// $visitor = $this->common->get_all_record_groupby('tbl_pageviews','count(*) AS pageview',array('schoolId'=>$school['id'],'userId !='=>0),'schoolId');
		$tables = array('tbl_pageviews p','tbl_rating r');
		$joins = array('p.userId = r.userId AND p.teacherId = r.teacherId');
		$rows = 'count(p.id) AS pageview';
		$keywords = '';
		$field_array = $params = array();
		$groupBy = 'r.teacherId';
		$order_by = '';
		$wh = array('r.teacherId'=>$teacher['id']);
		$visitor = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
		if(!empty($visitor)) {
			$visitor = $visitor[0]['pageview'];
			$visitorCount = ($visitor / $pageView) * 100;
		}
		else {
			$visitorCount = 0;
		}

		$ratings = $this->common->get_all_record_groupby('tbl_rating','COUNT(*) AS total_rating, AVG(rating) AS average_rating',array('teacherId'=>$teacher['id'],'isDelete'=>0),'teacherId');
		$ratings = (!empty($ratings)) ? $ratings[0] : array();

		/*ranking*/
		$rank = $rankState = $rankTeacherType = 0;
		$rankQuery = 'SELECT @rownum := @rownum +1 AS rank,prequery.teacherId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT teacherId, COUNT(*) AS total_rating, AVG(rating) AS average_rating FROM tbl_rating GROUP BY teacherId ORDER BY average_rating DESC ) prequery';
		$rankData = $this->common->cust_query($rankQuery);
		foreach ($rankData as $key => $value) {
			if($value['teacherId'] == $teacher['id']) {
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
		$rankTeacherTypeQuery = "SELECT @rownum := @rownum +1 AS rank,prequery.teacherId,prequery.total_rating,prequery.average_rating FROM ( SELECT @rownum := 0 ) sqlvars,( SELECT r.teacherId, COUNT(r.id) AS total_rating, AVG(r.rating) AS average_rating FROM tbl_teacher t LEFT JOIN tbl_rating r ON r.teacherId = t.id WHERE t.type LIKE '%".$teacher['type']."%' GROUP BY teacherId ORDER BY average_rating DESC ) prequery";
		$rankTeacherTypeData = $this->common->cust_query($rankTeacherTypeQuery);
		foreach ($rankTeacherTypeData as $key => $value) {
			if($value['teacherId'] == $teacher['id']) {
				$rankTeacherType = $value['rank'];
				break;
			}
		}
		/*ranking*/

		/*review by user*/
		$tables = array('tbl_rating r','tbluser u');
		$joins = array('u.id = r.userId');
		$rows = 'u.profession, COUNT(r.userId) as rating_count, (COUNT(r.userId) / (SELECT COUNT(r1.userId) FROM tbl_rating r1 WHERE r1.teacherId = '.$teacher['id'].')) * 100 AS \'percentage\'';
		$keywords = $order_by = '';
		$field_array = $params = array();
		$groupBy = 'u.profession';
		$wh = array('u.isDelete'=>0,'r.teacherId'=>$teacher['id']);
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
		$wh = array('u.isDelete'=>0,'r.teacherId'=>$teacher['id']);
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
		$wh = array('r.isDelete'=>0,'r.teacherId'=>$teacher['id']);
		$majorityRatingByAge = $this->common->get_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array);
		/*Majority review by age*/

		/*Conversion & Clicks*/
		$conversion = $this->common->get_all_record_groupby('tbl_conversion','SUM(click) as click',array('teacherId'=>$teacher['id']),'teacherId');
		$conversion = (!empty($conversion) && $conversion != '') ? $conversion[0] : array();
		/*Conversion & Clicks*/

		//* special need category */
		$data['special_need_category'] = $this->config->item('special_need_category');		
		//* special need category */
		/**/
		$data['pageview'] = $pageView;
		$data['visitor'] = $visitorCount;
		$data['rank'] = $rank;
		$data['rankState'] = $rankState;
		$data['rankTeacherType'] = $rankTeacherType;
		$data['ratingByUser'] = $ratingByUser;
		$data['majorityRatingByUser'] = $majorityRatingByUser;
		$data['majorityRatingByState'] = $majorityRatingByState;
		$data['majorityRatingByAge'] = $majorityRatingByAge;
		$data['conversion'] = $conversion;
		$data['teacher'] = $teacher;
		// $data['schools'] = $schools;
		$data['state'] = $state;
		$data['teachers'] = $teachers;
		$data['rating'] = $ratings;
		$this->global['pageTitle'] = ' | '.ucwords($teacher['fname'].' '.$teacher['lname']);
		$this->general->loadViewsFront(FRONTEND."teacher_profile", $this->global, $data, NULL);
	}

	function add_conversion()
	{
		$response = array();
		$post = $this->input->post();
		$teacherId = $post['teacherId'];
		$ip = $this->input->ip_address();
		$check = $this->common->get_one_row('tbl_conversion',array('ip'=>$ip,'teacherId'=>$teacherId));
		$data = array('teacherId'=>$teacherId);
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

			if(!isset($response['error']) && $response[0]!='') {
				$response = $response[0];
			}
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
		$key = 'AIzaSyAQbFC5pd8c1B78s1urrspjfjPsh1fFR_k';
		$url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India&key=$key";
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


  	public function teacher_store(){
        	
            $this->load->library('form_validation'); 
            $type = $this->input->post('type');           
            if($type == 'school'){
            	
            	$this->form_validation->set_rules('s_name','School','trim|required');
            	$this->form_validation->set_rules('s_email','School email ','trim|required');	

            }else{
            	
            	$this->form_validation->set_rules('t_name','Teacher ','trim|required');
            	$this->form_validation->set_rules('t_email','Teacher email ','trim|required');

            }
            $this->form_validation->set_rules('fname','First Name Type ','trim|required');
            $this->form_validation->set_rules('lname','Last Name ','trim|required');
            $this->form_validation->set_rules('type','Select Type ','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $data["msg"] = validation_errors();
                $data["result"] = 'error';
                echo json_encode($data);
                exit;
            }
            else
            {
            	$type = $this->input->post('type');
            	$uemail = $this->input->post('uemail');
            	$fname = $this->input->post('fname');
            	$lname = $this->input->post('lname');
            	
            	if($type == 'school'){
            		$s_name = $this->input->post('s_name');
            		$s_email = $this->input->post('s_email');	
            		$profile_name = $s_name;
            		$profile_email = $s_email;
            		$post_data = array(
	                    'reference_by'=>$fname.' '.$lname,
	                    'reference_email'=>$uemail,
	                    'name'=>$s_name,
	                    'email'=>$s_email,
	                    'created_date'=>date('Y-m-d H:i:s'),
	                    'approval'=>'1',
	                    'status'=>'0'
	                );
	                $result = $this->common->insert_record('tbl_school',$post_data);
	                $link = base_url().'user/teacher/teacher_approval/'.base64_encode($result).'/'.$type;

            	}
            	if($type == 'teacher'){

            		$t_name = $this->input->post('t_name');
            		$t_email = $this->input->post('t_email');
            		$profile_name = $t_name;
            		$profile_email = $t_email;
            		$post_data = array(
            			'reference_by'=>$fname.' '.$lname,
            			'reference_email'=>$uemail,
	                    'fname'=>$t_name,
	                    'email'=>$t_email,
	                    'created_date'=>date('Y-m-d H:i:s'),
	                    'approval'=>'1',
	                    'status'=>'0'
	                );
	                $result = $this->common->insert_record('tbl_teacher',$post_data);
	                $link = base_url().'user/teacher/teacher_approval/'.base64_encode($result).'/'.$type;

            	}
            	// Email send to form fill
               	$e_data['name'] = ucfirst($fname) .' '.ucfirst($lname);
               	$e_data['type'] = $type;
               	$e_data['profile_name'] = ucfirst($profile_name);
 				$email_body = $this->load->view(FRONTEND.'email/request_email', $e_data, TRUE);

				// $subject = 'Your request for add '.$type.' profile';
				// $subject = 'New school/teacher profile request';
				$subject = 'New '.$type.' profile request';
				
				$mailbody = array('ToEmail'=>$uemail,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>$subject,'Message'=>$email_body);
				$this->general->EmailSend($mailbody);
				


                // Email send to teacher or school
               	$e_data['link'] = $link;
               	$e_data['type'] = $type;
               	$e_data['name'] = ucfirst($fname) .' '.ucfirst($lname);
               	$e_data['profile_name'] = ucfirst($profile_name);
				$email_body = $this->load->view(FRONTEND.'email/teacher_school_approval', $e_data, TRUE);

				$mailbody = array('ToEmail'=>$profile_email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Teacher Approval Required','Message'=>$email_body);
				$this->general->EmailSend($mailbody);
                
                if($result > 0)
                {
                    $data["msg"] = 'Thank you. Your request has been submitted successfully.<br>';
	                $data["result"] = 'success';

                }
                else
                {
                    $data["msg"] = 'Contact form send successfully';
	                $data["result"] = 'danger';

                }                
                echo json_encode($data);
                exit;
            }

    }


    public function approval($id,$type){
    	
    	if($type == 'school'){
    		$table = 'tbl_school';
    	}else{
    		$table = 'tbl_teacher';
    	}
    	$data =  array('approval'=>2);
		$where = array('id'=> base64_decode($id));
		$res = $this->common->update_record($table,$data,$where);
		if($res)
        {
            // $msg = 'Teacher approval Successfully.Wait for admin approval';
            $msg = 'Thank you. Admin will review your profile criteria and create your account shortly.';
            $type = 'success';

        }
        else
        {
            /*$msg = 'Teacher approval already . Wait for admin approval';
            $type = 'danger';*/
            // $msg = 'Teacher approval Successfully.Wait for admin approval';
            $msg = 'Thank you. Admin will review your profile criteria and create your account shortly.';
            $type = 'success';

        } 
        $messge = array('message' => $msg,'class' => $type);
        $this->session->set_flashdata('msg',$messge);
        redirect(base_url());
    }
	
}