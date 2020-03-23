<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bulletin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Settingmodel');
		$this->load->model('Bulleting_model','bulleting_model');
		$this->sendemail = false;
	}

	public function index()
	{
		// redirect('NotFoundController');
		$get = $this->input->get();
		
		$searchText = "";
		if(isset($get) && !empty($get)) {
			$searchText = $get['searchText'];
		}
		$data['searchText'] = $searchText; 

		$this_month = date('m');
		$this_year = date('Y');
		
		$this->db->select('b.title,b.id,b.image,COUNT(l.id) AS total_like')->from('tbl_bulletin b');
		$this->db->join("like AS l","l.bulletin_id=b.id");
		$this->db->where('status','1')->where('isDelete','0');
		$this->db->group_by('b.id'); 
		$this->db->where('MONTH(l.created_date)', $this_month)->where('YEAR(l.created_date)', $this_year)->limit(5);
		$query = $this->db->get();
		$most_bulletin_this_month = $query->result_array();
		// echo $this->db->last_query(); die();
		$data['most_bulletin_this_month'] = $most_bulletin_this_month;

		$most_keyword_list = $this->db->select('keyword')->from('analysis')->order_by('rand()')->order_by('no_total_search','desc')->group_by('keyword')->limit(12)->get()->result_array();

		$data['most_keyword_list'] = $most_keyword_list;

		$this->global['pageTitle'] = ' | Bulletin';


		/* Start : Get Install photos */
        // use this instagram access token generator http://instagram.pixelunion.net/
        
        $access_token= "7366930712.c00b67e.e79e649788d241e189a95b0b58aa45d4";
        $photo_count=12;


        $json_link="https://api.instagram.com/v1/users/self/media/recent/?";
        $json_link.="access_token={$access_token}&count={$photo_count}";
        
        $json = file_get_contents($json_link,true);
       
        $obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);

        
        $baseURL = 'https://api.instagram.com/v1/users/self/media/recent/?';
        $requestFields = array (
            'access_token' => $access_token,
            'count' => $photo_count
        );
        $requestBody = http_build_query($requestFields);

        $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $baseURL);
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: '.strlen($requestBody),
            'Connection: close'
          ));
        $post = curl_exec($ch); 
        
        $data['insta_photo'] = $obj['data']; 
        // $data['insta_photo'] = array(); 


        // $data['insta_photo'] = array(); 
        
        /* End : Get Install photos */

        /* question calculation */

        $answer = $this->common->get_all_record("bulletin_question","*",array("isDelete"=>0));
        $answer_count = count($answer);
        $ans_1 = "";
        $ans_2_yes = $ans_2_no = $ans_3_yes = $ans_3_no = $ans_4_yes = $ans_4_no = $ans_5_yes = $ans_5_no = '0';
        
        
        foreach ($answer as $q_key => $q_value) {
			($q_value['que_2']) ? $ans_2_yes++ : $ans_2_no++;
			($q_value['que_3']) ? $ans_3_yes++ : $ans_3_no++;
			($q_value['que_4']) ? $ans_4_yes++ : $ans_4_no++;
			($q_value['que_5']) ? $ans_5_yes++ : $ans_5_no++;
		}

		
		$data['ans_1'] = $answer_count;

		$data['ans_2_yes'] = round(($ans_2_yes * 100) / $answer_count);
		$data['ans_2_no'] = round(($ans_2_no * 100) / $answer_count);

		$data['ans_3_yes'] = round(($ans_3_yes * 100) / $answer_count);
		$data['ans_3_no'] = round(($ans_3_no * 100) / $answer_count);

		$data['ans_4_yes'] = round(($ans_4_yes * 100) / $answer_count);
		$data['ans_4_no'] = round(($ans_4_no * 100) / $answer_count);

		$data['ans_5_yes'] = round(($ans_5_yes * 100) / $answer_count);
		$data['ans_5_no'] = round(($ans_5_no * 100) / $answer_count);
		
		$data['ans_6'] = $answer_count;
        
        /* question calculation */


		$this->general->loadViewsFront(FRONTEND."bulletins", $this->global, $data, NULL);
	}

	public function save_question() {
		// ALTER TABLE `bulletin_question`  ADD `bulletin_id` INT NOT NULL  AFTER `user_id`;
		$post = $this->input->post();
		$this->load->library('form_validation'); 

		$this->form_validation->set_rules('que_1','survey question ','trim|required');
		$this->form_validation->set_rules('que_2','survey question ','trim|required');
		$this->form_validation->set_rules('que_3','survey question ','trim|required');
		$this->form_validation->set_rules('que_4','survey question ','trim|required');
		$this->form_validation->set_rules('que_5','survey question ','trim|required');
		$this->form_validation->set_rules('que_6','survey question ','trim|required');

		if($this->form_validation->run() == FALSE)
		{
		    $data["msg"] = validation_errors();
		    $data["result"] = 'error';
		    echo json_encode($data);
		    exit;
		} else {

			$user_id = $this->session->USER['UId'];

			$UserData = array(
				"que_1" => $post['que_1'],
				"que_2" => $post['que_2'],
				"que_3" => $post['que_3'],
				"que_4" => $post['que_4'],
				"que_5" => $post['que_5'],
				"que_6" => $post['que_6'],
				"user_id" => $user_id,
				"bulletin_id" => $post['bulletin_id'],
			);

			$res = $this->common->insert_record("bulletin_question",$UserData);

	        if($res > 0)
	        {
	            $data["msg"] = 'Thank you. survey is submitted.<br>';
	            $data["result"] = 'success';

	        }
	        else
	        {
	            $data["msg"] = 'Something Went Wrong';
	            $data["result"] = 'danger';

	        }                
	        echo json_encode($data);
	        exit;
		}

	}

	public function bulletin_details($id)
	{
		$bulletin = $this->common->get_one_row('tbl_bulletin',array('md5(id)'=>$id));
		
		/* PAGE VIEW */
		$ip = $this->input->ip_address();
		$check = $this->common->get_one_row('tbl_pageviews',array('ip'=>$ip,'bulletinId'=>$bulletin['id']) );
		if($check == '') {
			$pageViewData = array('ip'=>$ip,'bulletinId'=>$bulletin['id']);
			if(isset($this->session->USER['UId'])) {
				$pageViewData['userId'] = $this->session->USER['UId'];
			}
			$insertPageView = $this->common->insert_record('tbl_pageviews',$pageViewData);
		}
		/* PAGE VIEW */

		if($bulletin['schoolId'] > 0){
			$school_name = $this->db->select('s.name as school_name')->from('tbl_school as s')->where('s.id',$bulletin['schoolId'])->get()->row_array();
			$school_name = $school_name['school_name'];
		}else{
			$school_name = '';
		}
		if($bulletin['teacherId'] > 0){
			$teacher_name = $this->db->select('CONCAT(t.fname," ",t.lname) as teacher_name')->from('tbl_teacher as t')->where('t.id',$bulletin['teacherId'])->get()->row_array();
			$teacher_name = $teacher_name['teacher_name'];
		}else{
			$teacher_name = '';
		}
		$pageView = $this->common->get_all_record_groupby('tbl_pageviews','count(*) AS pageview',array('md5(bulletinId)'=>$id),'bulletinId');
		$pageView = $pageView[0]['pageview'];

		$params['Select'] = '*';
		$params['Limit'] = '4';
		$params['ShortBy'] = 'created_date';
		$params['ShortOrder'] = 'DESC';
		$wh_curr_article = array('status'=>1,'isDelete'=>0);
		$current_articles = $this->common->get_all('tbl_bulletin',$wh_curr_article,$params);
		$data['current_articles'] = $current_articles;

		if(empty($bulletin)) {
			redirect(base_url());
		}
		$data['pageView'] = $pageView;
		$data['school_name'] = $school_name;
		$data['teacher_name'] = $teacher_name;
		$data['bulletin'] = $bulletin;
		$this->global['pageTitle'] = ' | '.ucwords($bulletin['title']);
		$this->general->loadViewsFront(FRONTEND."bulletin_details", $this->global, $data, NULL);
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

  	public function loadRecord($rowno=0){
  		$rowperpage = 12;
        if($rowno != 0){
            $rowno = ($rowno-1) * $rowperpage;
        }        
        $searchText = $this->security->xss_clean($this->input->post('searchText'));             
        $context = $this->security->xss_clean($this->input->post('context'));             
        $category = $this->input->post('categoryName');
        $sort_by = $this->security->xss_clean($this->input->post('sort_by'));     
        $popularity = $this->security->xss_clean($this->input->post('popularity'));     
        
        if(!empty($searchText)){
        	$checkProfanity = $this->general->checkProfanity($searchText);
        	if($checkProfanity) {
	        	$query = $this->db->select('id,no_total_search')->from('analysis')->where('keyword',$searchText)->get();
	        	$keyword_tot = $query->num_rows();
	        	$keyword_arr = $query->result_array();
	        	$keyword_tot = $this->db->where('keyword',$searchText)->from("analysis")->count_all_results();
	        	if($keyword_tot>0){
	        		$keyword_tot = $keyword_arr[0]['no_total_search'] + 1;
		        	$this->db->update( 'analysis',array('no_total_search'=>$keyword_tot),array('keyword'=>trim($searchText)) );
		        }else{
		        	$this->db->insert( 'analysis',array('keyword'=>trim($searchText)) );	        	
		        }
        	}
        }
        
        $allcount = $this->bulleting_model->BulletinListingCount($searchText);
        //$all_record_count = $this->bulleting_model->BulletinListingCount($searchText,$context,$sort_by,$popularity,$category);  
        $all_record_count = $this->bulleting_model->BulletinListingCount($searchText,$context,$sort_by,$popularity,$category);  
        $productlist_record = $this->bulleting_model->BulletinListing($searchText,$context,$sort_by,$popularity,$rowperpage,$rowno,$category);  

        


        $this->load->library ( 'pagination' );
        $config ['base_url'] =  base_url().'user/Bulletin/loadRecord';
        $config ['total_rows'] = $all_record_count;
        $config['use_page_numbers'] = TRUE;
        $config ['per_page'] = $rowperpage;
        $config ['num_links'] = 5;
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
        $config ['cur_tag_open'] = '<li class="active"><a href="#">';
        $config ['cur_tag_close'] = '</a></li>';
        $config ['num_tag_open'] = '<li>';
        $config ['num_tag_close'] = '</li>';
        $config ['last_tag_open'] = '<li class="page-item">';
        $config ['last_link'] = 'Last';
        $config ['last_tag_close'] = '</li>';
        
        /*foreach ($productlist_record as  $value) {
        	if(!isset($this->session->USER['UId'])) {
        		$redirect_url = base_url().'Bulletin/set_like/'.$value->id;
	            $value->redirect_link = $redirect_url;
	        }
        	$value->tot_like = "123";
        }*/
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links( );
        $data['result'] = $productlist_record;
        $data['row'] = $rowno;
        if(isset($this->session->USER['UId'])) {
	        $data['redirect'] = 'n';
	    }else{
	        $data['redirect'] = 'y';	    	
	    }
	    // $data['no_of_item'] = $allcount;
	    $data['no_of_item'] = $all_record_count;

        echo json_encode($data);
        
    }

    public function set_like($bulletin_id = '')
	{

		if( !empty($bulletin_id)){

			$id = $bulletin_id;	

		}else{

			$post = $this->input->post();
			$id = $post['id'];
		
		}

			if( !isset($this->session->USER['UId']) ) { 
	            
	            $url = base_url().'user/Bulletin/set_like/'.$id;
	            $this->session->set_userdata("user_last_page",$url);
	            $response['redirect'] = true;
				echo json_encode($response);
				exit;

	        }else{			
		
		
				$user_id = $this->session->USER['UId'];
				$already = $this->db->select('id')->where('user_id',$user_id)->where('bulletin_id',$id)->get('like')->num_rows();		
				if($already > 0){
					$this->db->where('user_id', $user_id);
					$this->db->where('bulletin_id', $id);
		      		$result = $this->db->delete('like'); 
		      		$msg =  'We have removed your "like".';
		      		$addRemove = "remove";
				}else{

					$data = array(
							'user_id'=>$user_id,
							'bulletin_id'=>$id,
							);
					$result =  $this->db->insert('like',$data);
					$msg =  'Thank you for liking this post.';
					$addRemove = "add";
				}

				if( !empty($bulletin_id)){
					redirect(base_url('bulletin'));
				}else{
				
					$tot_like = $this->db->select('id')->where('bulletin_id',$id)->get('like')->num_rows();
					$response['success'] = true;
					$response['count'] = $tot_like;
					$response['message'] = $msg;
					$response['addRemove'] = $addRemove;
					echo json_encode($response);
				}
				
			}
		
	}

	function submit_insta_review()
	{
		$response = array();
		$post = $this->input->post();
		$data = array();
		$flag = true;
		if(isset($post['anonymous'])) {
			$data = array('review_fname'=>'Anonymous','review_lname'=>'','review_email'=>'anonymous@no-reply.com','status'=>0,'review_message'=>$post['message'],'review_anonymous'=>1);
		}
		else {
			$data = array('review_fname'=>$post['fname'],'review_lname'=>$post['lname'],'review_email'=>$post['email'],'status'=>0,'review_message'=>$post['message']);
		}

		/*if($_FILES['attachment']['error'] == 0) {
			$title = 'bulletin_';
            $attach =  $this->upload_files('assets/uploads/bulletin/', $title, $_FILES['attachment'],'attachment');
            if(isset($attach['error'])) {
            	$flag = false;
            	$response['success'] = false;
            	$response['message'] = $attach['error'];
            }
            else {
            	$data['review_file'] = $attach['filename'];
            }
		}*/

		/* Images */
        if($post['bulletinImagesFile'] != '') {

            $path = 'assets/uploads/bulletin/';
            if(!is_dir($path)) {
                mkdir($path);
            }
            
            $Images = array();
            $bulletinImagesFile = json_decode($post['bulletinImagesFile'], true);
            foreach ($bulletinImagesFile as $key => $value) {
                $src = MyPath.$value;
                $dest = 'assets/uploads/bulletin/'.$value;
                copy($src, $dest);
                unlink($src);
            }

            $data['review_file'] = $post['bulletinImagesFile'];
            
        }
        /* Images */
		
		if($flag) {
			$insert = $this->common->insert_record('tbl_bulletin_review',$data);
			if($insert) {
				$response['success'] = true;
				// $response['message'] = "Your Review has been Submitted Successfully.";
				$response['message'] = "Thank you! Your story has been submitted to our Bulletin Editor.";
			}
		}

		echo json_encode($response);
	}

	private function upload_files($path, $title, $files,$field_name)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        if(!is_dir($path)) {
        	mkdir($path);
        }

        $image = str_replace(" ", "_", $files['name']);
        $fileName = $title .'_'.time().$image;
        $this->load->library('upload', $config);
        
        $config['file_name'] = $fileName;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field_name)) {
        	$error = array('error' => $this->upload->display_errors());
        	return $error;
        }
        else {
        	$images['filename'] = $fileName;
        	return $images;
        }
        
    }

    function time_elapsed_string($datetime, $full = false)
    {
        $today = time();    
		$createdday= strtotime($datetime); 
		$datediff = abs($today - $createdday);  
		$difftext = "";  
		$years = floor($datediff / (365*60*60*24));  
		$months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
		$days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
		$hours= floor($datediff/3600);  
		$minutes= floor($datediff/60);  
		$seconds= floor($datediff);  
		
		if($difftext=="")  
		{  
			if($years>1)  
				$difftext=$years." years ago";  
			elseif($years==1)  
				$difftext=$years." year ago";  
		}  
		//month checker  
		if($difftext=="")  
		{  
			if($months>1)  
				$difftext=$months." months ago";  
			elseif($months==1)  
				$difftext=$months." month ago";  
		}
		//month checker 
		if($difftext=="")  
		{  
			if($days>1)
				$difftext=$days." days ago";  
			elseif($days==1)  
				$difftext=$days." day ago";  
		}
		//hour checker  
		if($difftext=="")  
		{
			if($hours>1)  
				$difftext=$hours." hours ago";  
			elseif($hours==1)  
				$difftext=$hours." hour ago";  
		}
		//minutes checker
		if($difftext=="")  
		{  
			if($minutes>1)  
				$difftext=$minutes." minutes ago";  
			elseif($minutes==1)  
				$difftext=$minutes." minute ago";  
		}
		//seconds checker  
		if($difftext=="")  
		{  
			if($seconds>1)  
				$difftext=$seconds." seconds ago";  
			elseif($seconds==1)  
				$difftext=$seconds." second ago";  
		}
		
		return $difftext;
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