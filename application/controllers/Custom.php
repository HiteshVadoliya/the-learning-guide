<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{ 
		
	}

	public function test()
	{
		$post = $this->input->post();
		$data = json_encode($post);
		$my_file = 'file.txt';
        $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
        $data2 = $data.'\n\n\n';
        fwrite($handle, $data2);
	}
}