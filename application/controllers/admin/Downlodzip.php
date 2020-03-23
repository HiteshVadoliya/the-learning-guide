<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downlodzip extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminmodel');
		$this->load->library('Ajax_pagination');
        $this->perPage = 1;
	}
	public function view()
	{
		$this->load->library('zip');
		$path = 'application/controllers/';
		$this->zip->read_dir($path);
		$this->zip->archive('assets/myarchive.zip');
		// Download the file to your desktop. Name it "my_backup.zip"
		//$this->zip->download('my_backup.zip'); 
	}
}
