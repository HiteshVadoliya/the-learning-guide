<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		//$this->general->adminauth();
		if($this->session->ADMS['AId']){
			redirect(base_url(ADMIN.'Home'));
		}
		$this->load->view(ADMIN.'login_view');
	}
	public function Auth()
	{
		$Email = $this->input->post('Email');
		$Password = $this->input->post('Password');
		$this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE){
			$res = $this->common->get_all_record('tbladmin','',array('EmailId'=>$Email));
			if(count($res) > 0){
				// $this->load->library('encrypt');
				// $check = $this->encrypt->decode($res[0]['Password']);
				$Password = md5($Password);
				$check = $res[0]['Password'];
				
				if($check == $Password){
					
					$this->session->set_flashdata('Success!','You are now logged in.');
					$newdata = array(
							'AId'  => $res[0]['AdminId'],
					        'AName'  => $res[0]['Name'],
					        'AEmail'     => $res[0]['EmailId'],
					        'AProfile'  => $res[0]['ProfilePicture']);

					
					$this->session->set_userdata('ADMS',$newdata);
					$refer = $this->session->userdata("last_page")?$this->session->userdata("last_page"):base_url(ADMIN.'Home');
					
					redirect($refer);
				} else {

					$this->session->set_flashdata('error','Password Does Not Match Please Enter Correct Password!!');
					redirect(base_url(ADMIN.'Login'));
				}
			} else {
				$this->session->set_flashdata('error','Enter Valid Email!!');
				redirect(base_url(ADMIN.'Login'));
			}
			
		} else {
			$this->load->view('admin/login_view');
		}
	}
	public function Logout()
	{
		$array_items = array('AId' => '', 'AName' => '','AEmail'=>'');
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		redirect(base_url(ADMIN).'Login');
	}
	public function forgotPassword()
	{
		$this->load->library('encrypt');
		$to_email = $this->input->post('FEmail');
		$this->form_validation->set_rules('FEmail', 'Email', 'required');
		if ($this->form_validation->run() == TRUE){
			$res = $this->common->get_all_record('tbladmin',array('EmailId'=>$to_email));
			
			if(count($res) > 0)
			{
				$password = $this->encrypt->decode($res[0]['Password']);
				
				$this->load->model('Settingmodel');
				$configuration['config'] = $this ->Settingmodel->get_all('tblconfig','ConfigKey','ConfigValue');
				$configuration['password'] = $password;
					/* Email To User */
				$mailbody['ToEmail'] 	= $to_email;
				$mailbody['FromName'] 	= FROMNAME;
				$mailbody['FromEmail'] 	= FROMMAIL;
				$mailbody['Subject'] = "Triipster - Your Current Password";
				$this->load->view(ADMIN.'email/admin_forget_password',$configuration);
				$mailbody['Message'] = $this->output->get_output();
				//echo $mailbody['Message']; exit;
				$this->general->EmailSend($mailbody);
				
				//$res = $this->general->SendSimpleMail($data);
				//$res = $this->general->Send_Email($data);
				if($res > 0){
					$this->session->set_flashdata('success','Passwod is Successfully Send To Email Id Check Your Email.');
					redirect(base_url(ADMIN));
				} else {
					$this->session->set_flashdata('phperror','Error occure while sending an Email!');
					redirect(base_url(ADMIN));
				}
			} else {
				$this->session->set_flashdata('error','Your Email '.$to_email.' is not in our record !!!!!!!!');
				redirect(base_url(ADMIN.'Login'));
			}
		} else {
			$this->session->set_flashdata('error','Enter Email!!');
			redirect(base_url(ADMIN.'Login'));
		}
	}
}
