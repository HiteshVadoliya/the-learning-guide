<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settingmodel');
    }
    public function index()
    {
        //$this -> setting();
        redirect(base_url(ADMIN.'Configuration/setting'));
    }
    function view()
    {
        $this->general->adminauth();
        $data['config'] = $this ->Settingmodel->get_all('tblconfig','ConfigKey','ConfigValue');
        $this->load->view(ADMIN."config_view", $data);
    }
    function update_process()
    {
        $data = $this->input->post();
        $config = array();
        foreach ($data as $key => $value) {
            $config[] = array("ConfigKey" => $key, "ConfigValue" => $value);
        }
        $res = $this->Settingmodel->batch_update('tblconfig','ConfigKey',$config);
        $this->general->processandredirect($res,'Order Bumps Information Updated Successfully !!!','Sorry, Something went wrong. Try Again.!!!',ADMIN.'Configuration/view');
    }
    public function setting()
    {
        $this->general->adminauth();
        $data['setting'] = $this ->Settingmodel->get_all('tblsetting','SettingKey','SettingValue');
        //echo "<pre>"; print_r($data); exit;
        // $this->load->view(ADMIN.'setting_view',$data);
        $this->global['pageTitle'] = ' | Website Setting';
        $this->global['ActiveMenu'] = 'Setting';
        $this->general->loadViews(ADMIN."setting_view", $this->global, $data, NULL);
    }
    public function update_setting()
    {
        $data = $this->input->post();
        $config = array();
        foreach ($data as $key => $value) {
            $config[] = array("SettingKey" => $key, "SettingValue" => $value);
        }
        if($this->Settingmodel->batch_update('tblsetting','SettingKey',$config)){
            if ($_FILES['Admin_Logo']['error'] == 0) {
                $ext = pathinfo($_FILES['Admin_Logo']['name'], PATHINFO_EXTENSION);
                $result = $this->general->upload_file("Admin_Logo", UPLOADPATHADMIN,'admin_logo.'.$ext, "jpg|png|jpeg");
                if (is_array($result)) {
                    $this->session->flashdata('error','But Sorry, Admin Logo Not Uploaded.!!!');
                    redirect(base_url(ADMIN.'Configuration/setting'));
                }
                $update[] = array("SettingKey" => "Admin_Logo","SettingValue" =>'admin_logo.'.$ext);
                $this->Settingmodel->batch_update('tblsetting','SettingKey',$update);
            }
            if ($_FILES['FrontEnd_Logo']['error'] == 0) {
                $ext = pathinfo($_FILES['FrontEnd_Logo']['name'], PATHINFO_EXTENSION);
                $result = $this->general->upload_file("FrontEnd_Logo", UPLOADPATHFRONT,'logo.'.$ext, "jpg|png|jpeg");
                if (is_array($result)) {
                    $this->session->flashdata('error','But Sorry, Front End Logo Not Uploaded.!!!');
                    redirect(base_url(ADMIN.'Configuration/setting'));
                }
                $update[] = array("SettingKey" => "FrontEnd_Logo","SettingValue" =>'logo.'.$ext);
                $this->Settingmodel->batch_update('tblsetting','SettingKey',$update);
            }
            $this->session->set_flashdata('success','Setting Updated Successfully!!!');
            redirect(base_url(ADMIN.'Configuration/setting'));
        } else {
            $this->session->set_flashdata('error','Setting Not Updated!!!');
            redirect(base_url(ADMIN.'Configuration/setting'));
        }
    }
    
    //added 07-12-2017
    function view_timer()
    {
        $this->general->adminauth();
        $data['config'] = $this ->Settingmodel->get_all('tblconfig','ConfigKey','ConfigValue');
        $this->load->view(ADMIN."mobile_timer_view", $data);
    }
    function update_timer()
    {
        $data = $this->input->post();
        $config = array();
        foreach ($data as $key => $value) {
            $config[] = array("ConfigKey" => $key, "ConfigValue" => $value);
        }
        $res = $this->Settingmodel->batch_update('tblconfig','ConfigKey',$config);
        $this->general->processandredirect($res,'Mobile Timer Information Updated Successfully !!!','Sorry, Something went wrong. Try Again.!!!',ADMIN.'Configuration/view_timer');
    }
}