<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFoundController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        
        $sitesetting = $this->common->get_all_record('tblsetting');
        
        $layout_data['site_favicon'] = $sitesetting[4]['SettingValue'];
        $layout_data['pageTitle'] = $sitesetting[0]['SettingValue'];
        $layout_data['footer'] = '2017 - 2018 © '.$sitesetting[0]['SettingValue'];

        $this->load->view('404', $layout_data);

    }
}