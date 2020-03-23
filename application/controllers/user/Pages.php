<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Settingmodel');
		$this->sendemail = false;
	}

	public function about()
	{
		$this->global['pageTitle'] = ' | About';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."about", $this->global, $data, NULL);
	}

	public function services()
	{
		$this->global['pageTitle'] = ' | Services';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."services", $this->global, $data, NULL);
	}

	public function team()
	{
		$this->global['pageTitle'] = ' | Team';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."team", $this->global, $data, NULL);
	}

	public function faq()
	{
		$this->global['pageTitle'] = ' | Faq';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."faq", $this->global, $data, NULL);
	}

	public function contact()
	{
		$this->global['pageTitle'] = ' | Contact';
		$contact = $this->common->get_all_record('tbl_contact_details')[0];
		$data['contact'] = $contact;
		$this->general->loadViewsFront(FRONTEND."contact", $this->global, $data, NULL);
	}

	public function terms()
	{
		$this->global['pageTitle'] = ' | Terms';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."terms", $this->global, $data, NULL);
	}

	public function privacy_policy()
	{
		$this->global['pageTitle'] = ' | Privacy Policy';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."privacy_policy", $this->global, $data, NULL);
	}

	public function content_integrity_policy()
	{
		$this->global['pageTitle'] = ' | Content Integrity Policy';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."content_integrity_policy", $this->global, $data, NULL);
	}

	public function paid_content_partnerships()
	{
		$this->global['pageTitle'] = ' | Paid Content Partnerships';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."paid_content_partnerships", $this->global, $data, NULL);
	}

	public function who_we_are()
	{
		$this->global['pageTitle'] = ' | Who We Are';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."who_we_are", $this->global, $data, NULL);
	}

	public function legal()
	{
		$this->global['pageTitle'] = ' | Legal';
		$data = array();
		$this->general->loadViewsFront(FRONTEND."legal", $this->global, $data, NULL);
	}
	
	public function submit_contact()
	{
		$response = array();
		$post = $this->input->post();
		$insert = $this->common->insert_record('tbl_contact',$post);
		if($insert) {
			$response['success'] = true;
			// $response['message'] = 'Your Response has been submitted successfully. We will contact you soon.';
			$response['message'] = 'Your email has been sent. A customer service representative will be in touch shortly.';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'Something went wrong! Please try again later.';
		}

		echo json_encode($response);
	}

	public function add_newsletter()
	{
		$response = array();
		$post = $this->input->post();
		$insert = $this->common->insert_record('tbl_newsletter',$post);
		if($insert) {
			$response['success'] = true;
			$response['message'] = 'Newsletter has been submitted successfully. You will recieve Newsletter.';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'Something went wrong! Please try again later.';
		}

		echo json_encode($response);
	}
	public function addition_newsletter()
	{
		$response = array();
		$post = $this->input->post();
		$insert = $this->common->update_record('tbl_newsletter',$post,array('email'=>$post["email"]));
		if($insert) {
			$response['success'] = true;
			$response['message'] = 'Your Additional info has been submitted successfully. You will recieve Newsletter.';
		}
		else {
			$response['success'] = false;
			$response['message'] = 'Something went wrong! Please try again later.';
		}

		echo json_encode($response);
	}

}