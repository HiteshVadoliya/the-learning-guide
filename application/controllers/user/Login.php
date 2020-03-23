<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Settingmodel');
		$this->sendemail = false;
	}
	public function index()
	{ 
		if($this->session->USER['UId']){
			redirect(base_url());
		}
		
		$this->clearSession();
		$data['state'] = $this->common->get_all_record('tbl_state');

		$this->global['pageTitle'] = ' | Login';
		$this->global['robot'] = true;
        $this->general->loadViewsFront(FRONTEND."login", $this->global, $data, NULL);
	}

	public function Auth()
	{
		$Email = $this->input->post('email');
		$Password = $this->input->post('password');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE){
			$res = $this->common->get_one_row('tbluser',array('email'=>$Email));
			if(count($res) > 0) {
				$check = $res['password'];
				if($check == md5($Password)){
					$this->session->set_flashdata('success','You are now logged in.');
					$newdata = array(
						'UId' 		=> $res['id'],
				        'UName' 	=> $res['fname']." ".$res['lname'],
				        'UEmail'    => $res['email'],
				    );
					$this->session->set_userdata('USER',$newdata);
					$refer = $this->session->userdata("user_last_page") ? $this->session->userdata("user_last_page") : base_url();
					redirect($refer);
					// echo "Login Successfully";
				} else {
					$this->session->set_flashdata('error','Password Does Not Match Please Enter Correct Password!!');
					redirect(base_url('login'));
				}
			} else {
				$this->session->set_flashdata('error','Invalid Email or Password');
				redirect(base_url('login'));
			}
			
		} else {

			$data['state'] = $this->common->get_all_record('tbl_state');

			$this->global['pageTitle'] = ' | Login';
			$this->global['robot'] = true;
	        $this->general->loadViewsFront(FRONTEND."login", $this->global, $data, NULL);
		}
	}
	public function register()
	{

		/**/
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
		{
			$secret = '6LfHi4QUAAAAALQtXoyHXUXisiteuqqXymdFZFRI';
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response'];
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			$headers = array();
			$headers[] = "Accept: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$responseData = json_decode($result);
	        if($responseData->success)
	        {
	            $succMsg = 'Your contact request have submitted successfully.';
	        }
	        else
	        {
	            $errMsg = 'Robot verification failed, please try again.';
	            $this->session->set_flashdata('error',$errMsg);
				redirect(base_url('login'));
	        }
   		}
   		/**/
		
		$post	= $this->input->post();
		$this->form_validation->set_rules('fname','First Name','required');
		$this->form_validation->set_rules('lname','Last Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tbluser.email]');
		$this->form_validation->set_rules('gender','Gender','required');
		$this->form_validation->set_rules('mobile','Mobile','required');
		$this->form_validation->set_rules('state','State','required');
		$this->form_validation->set_rules('postcode','Postcode','required');
		$this->form_validation->set_rules('password','Password','required');
		
		
		if($this->form_validation->run())
		{
			$password = md5($post['password']);

			$data = array('fname'=>$post['fname'],'lname'=>$post['lname'],'email'=>$post['email'],'gender'=>$post['gender'],'phone'=>$post['mobile'],'profession'=>$post['profession'],'age'=>$post['age'],'password'=>$password,'emailPassword'=>$post['password'],'state'=>$post['state'],'postcode'=>$post['postcode']);
			
			$res = $this->common->insert_record('tbluser',$data);
			if($res)
			{
				$email_body = $this->load->view(FRONTEND.'email/registration_mail', $data, TRUE);
				$mailbody = array('ToEmail'=>$post['email'],'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Successfully Register','Message'=>$email_body);
				if($this->sendemail) {
					$this->general->EmailSend($mailbody);
				}
			}
			
			$this->session->set_flashdata('success','Register Successfully, Please Login');
			redirect(base_url('login'));
			
		} else {			
			$this->session->set_flashdata('error','Please Fill The Data First!!'.validation_errors());
			redirect(base_url('login'));
		}
	}

	public function test()
	{

		$user = $this->common->get_one_row('tbluser',array('id'=>1));
		$data = $user;
		$email_body = $this->load->view(FRONTEND.'email/registration_mail', $data, TRUE);
		$mailbody = array('ToEmail'=>$user['email'],'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Successfully Register','Message'=>$email_body);
		if($this->sendemail) {
			$this->general->EmailSend($mailbody);
		}
		else {
			echo "string";
		}
	}

	public function Profile()
	{
		$this->general->userauth();
		$data['user'] = $this->common->get_one_row('tbluser',array('id'=>$this->session->USER['UId']));
		$data['state'] = $this->common->get_all_record('tbl_state');

		/**/
		$wh_pageview = array('p.userId'=>$this->session->USER['UId']);
		$tables = array('tbl_pageviews p','tbl_school s','tbl_teacher t');
		$joins = array('left','p.schoolId=s.id','p.teacherId=t.id');
		$rows = 'p.*,s.name as schoolname,s.id as schoolId,CONCAT(t.fname," ",t.lname) as teachername, t.id as teacherId';
		$groupBy = 'p.id';
		$order_by = array('p.id'=>'DESC');
		$keywords = '';
		$field_array = array();
		$params['limit'] = 5;
		$params['offset'] = 0;
		$pageview_history = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh_pageview,$keywords,$field_array,$params);

		/**/
		$wh_rating = array('r.userId'=>$this->session->USER['UId']);
		$tables = array('tbl_rating r','tbl_school s','tbl_teacher t');
		$joins = array('left','r.schoolId=s.id','r.teacherId=t.id');
		$rows = 'r.*,s.name as schoolname,s.id as schoolId,CONCAT(t.fname," ",t.lname) as teachername, t.id as teacherId';
		$groupBy = 'r.schoolId,r.teacherId';
		$order_by = array('r.id'=>'DESC');
		$keywords = '';
		$field_array = array();
		$params['limit'] = 10;
		$params['offset'] = 0;
		$rating_history = $this->common->get_all_join_record($tables,$joins,$rows,$groupBy,$order_by,$wh_rating,$keywords,$field_array,$params);
		
		$data['pageview_history'] = $pageview_history;
		$data['rating_history'] = $rating_history;
		$this->global['pageTitle'] = ' | Profile';
		$this->general->loadViewsFront(FRONTEND."profile", $this->global, $data, NULL);
	}

	public function ProfileUpdate()
	{
		$this->general->userauth();
		$response = array();
		$post = $this->input->post();
		$data = array('profession'=>$post['profession'],'fname'=>$post['fname'],'lname'=>$post['lname']/*,'email'=>$post['email']*/,'gender'=>$post['gender'],'age'=>$post['age'],'phone'=>$post['phone'],'state'=>$post['state'],'postcode'=>$post['postcode']);

		$res = $this->common->update_record('tbluser',$data,array('id'=>$this->session->USER['UId']));
		if($res) {
			$response['success'] = true;
			$response['message'] = 'Profile Updated Successfully..';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'No Changes...';
		}
		echo json_encode($response);
	}

	public function check_review()
	{
		$post = $this->input->post();
		$data['user'] = $this->common->get_one_row('tbluser',array('id'=>$this->session->USER['UId']));
		if($post['type'] == 'school') {
			$data['school'] = true;
		}
		if($post['type'] == 'teacher') {
			$data['teacher'] = true;
		}
		
		$data['review'] = $this->common->get_one_row('tbl_rating',array('id'=>$post['id']));
		$this->load->view(FRONTEND.'review_modal',$data);
	}

	public function change_review()
	{
		$post = $this->input->post();
		$data = $post;
		unset($data['ratingId']);
		unset($data['userName']);
		unset($data['teacherId']);
		$wh = array('id'=>$post['ratingId']);
		if(isset($post['schoolId'])) {
			$response['modal'] = 'school';
			unset($data['curriculum']);
			$data['curricullum'] = $post['curriculum'];
		}
		else {
			$response['modal'] = 'teacher';
		}
		$checkProfanity = $this->general->checkProfanity($post['review']);
		if($checkProfanity) {
			$res = $this->common->update_record('tbl_rating',$data,$wh);
			if($res) {
				$response['success'] = true;
				$response['message'] = 'Review has been changed..';
			}
			else {
				$response['success'] = false;
				$response['message'] = 'Review not changed..';
			}
		}
		else {
			$response['success'] = false;
			$response['profanity'] = true;
			$response['message'] = 'A naughty word was detected and we cannot publish it. Please reword your review.';
		}
		echo json_encode($response);
	}

	public function display_emoji($percent)
	{
		$emoji = '';
		if($percent <= 20) {
			$emoji = 'angry';
		}
		elseif ($percent <= 40) {
			$emoji = 'cry';
		}
		elseif ($percent <= 60) {
			$emoji = 'sleeping';
		}
		elseif ($percent <= 80) {
			$emoji = 'smily';
		}
		elseif ($percent <= 100) {
			$emoji = 'cool';
		}
		return $emoji;
	}

	public function Logout()
	{
		$array_items = array('UId' => '', 'UName' => '','UEmail'=>'');
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	public function clearSession()
	{
		$keys = array("");
		foreach ($keys as $key) {
			unset($_SESSION[$key]);
		}
	}

	public function forgot_Password()
	{
		/*Header View Footer*/
		$data = array();
		$this->global['pageTitle'] = ' | Forgot Password';
		$this->general->loadViewsFront(FRONTEND."forgot_password", $this->global, $data, NULL);
	}

	public function forgotPassword()
	{
		$to_email = $this->input->post('email');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == TRUE){
			$res = $this->common->get_all_record('tbluser','*',array('email'=>$to_email));
			
			if(count($res) > 0)
			{
				$password = $res[0]['emailPassword'];
				
				$configuration['password'] = $password;
				$data = $this->common->get_one_row('tbluser'	,array('email'=>$to_email));
				/* Email To User */	
				if($data)
				{
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					$data['password_str'] = substr( str_shuffle( $chars ), 0,13 );
					$data2 = array('ForgotString'=>$data['password_str']);
					$this->common->update_record('tbluser',$data2,array('email'=>$to_email));
					
					$email_body = $this->load->view(FRONTEND.'email/forgot_password', $data, TRUE);
					$mailbody = array('ToEmail'=>$to_email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Your Current Password ','Message'=>$email_body);
					if($this->sendemail) {
						$res = $this->general->EmailSend($mailbody);
					}
					
					if($res > 0){
						$this->session->set_flashdata('success','Reset Passwod Link is Successfully Send To Email Id Check Your Email.');
						redirect(base_url('forgot-password'));
					}
					else {
						$this->session->set_flashdata('phperror','Error occure while sending an Email!');
						redirect(base_url('forgot-password'));
					}
				}

			}
			else {
				$this->session->set_flashdata('error','Your Email '.$to_email.' is not in our record !!!!!!!!');
				redirect(base_url('forgot-password'));
			}
		}
		else {
			$this->session->set_flashdata('error','Enter Email!!');
			redirect(base_url('forgot-password'));
		}
	}

	public function ResetPassword($str)
	{
		if($this->session->USER['UId']){
			redirect(base_url());
		}
		$data['user'] = $this->common->get_one_row('tbluser',array('ForgotString'=>$str));
		if(!$data['user'])
		{
			$this->session->set_flashdata('error','Your Reset Password Link is expired!!');
			redirect(base_url('login'));
		}
		/*Header View Footer*/
		$this->global['pageTitle'] = ' | Reset Password';
		$data['string'] = $str;
		$this->general->loadViewsFront(FRONTEND."reset_password", $this->global, $data, NULL);
	}
	public function ResetPasswordUpdate($str,$id)
	{
		if($this->session->USER['UId']){
			redirect(base_url());
		}
		$res = $this->common->get_one_row('tbluser',array('ForgotString'=>$str));

		if($res) {
			$post = $this->input->post();
			$data = array('password'=>md5($post['password']),'ForgotString'=>'');
			$res = $this->common->update_record('tbluser',$data,array('md5(id)'=>$id));
			if($res) {
				$this->session->set_flashdata('success','New Password Updated Successfully');
			} else {
				$this->session->set_flashdata('error','Something Was Wrong!!');
			}
			redirect(base_url('login'));

		} else {
			$this->session->set_flashdata('error','Something Was Wrong!!');
			redirect(base_url('login'));
		}
	}

	public function change_Password()
	{
		/*Header View Footer*/
		$data = array();
		$this->global['pageTitle'] = ' | Change Password';
		$this->general->loadViewsFront(FRONTEND."change_password", $this->global, $data, NULL);
	}

	public function NewPassword()
	{
		$post = $this->input->post();

		if(!$this->session->USER['UId']){
			redirect(base_url());
		}

		$res = $this->common->get_one_row('tbluser',array('password'=>md5($post['opassword'])));
		
		if($res) {
						
			$data = array('password'=>md5($post['password']),'emailPassword'=>$post['password']);
			$res = $this->common->update_record('tbluser',$data,array('id'=>$this->session->USER['UId']));
			if($res) {
				$this->session->set_flashdata('success','Password Changed Successfully');
			} else {
				$this->session->set_flashdata('error','Something Was Wrong!!');
			}
			redirect(base_url('change-password'));

		}
		else {
			$this->session->set_flashdata('error','Old Password Does not Match !!');
			redirect(base_url('change-password'));
		}
	}
}