<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Ajax_pagination');
        $this->perPage = 1;
	}

	public function index()
	{
        $this->general->adminauth();
		$data = array();
		$this->global['pageTitle'] = ' | Manage Calendar';
        $this->global['ActiveMenu'] = 'Manage Calendar';
        $this->general->loadViews(ADMIN."calendar/manage_calendar", $this->global, $data, NULL);
	}

    public function add_event($id='') {
        $schools = $this->common->get_all('tbl_school',array('status'=>1,'isDelete'=>0));

        if($id) {
            $data['calendar'] = $this->common->get_one_row('tbl_calendar',array('id'=>$id));
            $this->global['pageTitle'] = ' | Edit Event';
        }
        else {
            // $data = array();
            $this->global['pageTitle'] = ' | Add Event';
        }
        
        $data['schools'] = $schools;
        $data['calender_event_type'] = $this->config->item('calender_event_type');
        $data['calender_event_color'] = $this->config->item('calender_event_color');

        $this->global['ActiveMenu'] = 'Add Calendar';
        $this->general->loadViews(ADMIN."calendar/add_calendar", $this->global, $data, NULL);
    }

    public function save_task($id='')
    {

        $post = $this->input->post();
        $user_id = '0';
        $response = array();
        /*echo "<pre>";
        print_r($post);
        die();*/

        $this->form_validation->set_rules('task_name','Task Name','required');
        $this->form_validation->set_rules('task_description','Description','required');
        $this->form_validation->set_rules('task_date','Task Date Name','required');
        $this->form_validation->set_rules('task_time','Task Time Name','required');
        $this->form_validation->set_rules('task_address','Address','required');

        $task_name          =   $post['task_name'];
        $task_description   =   $post['task_description'];
        $task_date          =   $post['task_date'];
        $task_end_date      =   $post['task_end_date'];
        $task_time          =   $post['task_time'];
        $task_end_time      =   $post['task_end_time'];
        $task_school_tag    =   $post['task_school_tag'];
        $task_address       =   $post['task_address'];
        $rsvp_date          =   $post['rsvp_date'];
        $rsvp_contact       =   $post['rsvp_contact'];
        $task_type          =   "";
        if(isset($post['task_type'])) {
            $task_type = implode(",", $post['task_type']);
        }


        $free_event = "0";
        $task_cost = "0";
        $task_cost = $post['task_cost'];

        $filename = "";
        /*echo "<pre>";
        print_r($_FILES);
        echo "</pre>";*/
        
        // $attachment = "filename_";
        $dataArray = array(
            "task_name"         => $task_name,
            "task_description"  => $task_description,
            // "attachment"        => $filename,
            "task_date"         => $task_date,
            "task_end_date"     => $task_end_date,
            "task_time"         => $task_time,
            "task_end_time"     => $task_end_time,
            "task_school_tag"   => $task_school_tag,
            "task_address"      => $task_address,
            "free_event"        => $free_event,
            "task_cost"         => $task_cost,
            "task_type"         => $task_type,
            "rsvp_date"         => $rsvp_date,
            "rsvp_contact"      => $rsvp_contact,
            "user_id"           => $user_id,
            "approval"           => '1',
        );

        if($id) {
            
            

            if ($_FILES['attachment']['name'][0]!='') {
                $title = 'task_';
                $attach =  $this->upload_files('assets/uploads/task_attach/', $title, $_FILES['attachment']);
                if(!empty($attach)) {
                    $filename = $attach[0];
                }
            } else {
                $filename = $post['old_Img'];
            } 
            /*echo "<br>";
            echo $filename;

            echo "<pre>";
            print_r($_FILES['attachment']['name']);
            echo "</pre>";
            die(); */

            /*if($_FILES['attachment']['name']!='') {
                $title = 'task_';
                $attach =  $this->upload_files('assets/uploads/task_attach/', $title, $_FILES['attachment']);
                if(!empty($attach)) {
                    $filename = $attach[0];
                }
            } else {
                $filename = $post['old_Img'];
            } 
            */
            $dataArray['attachment'] = $filename;
            

            $wh = array('id'=>$id);
            $this->common->update_record('tbl_calendar',$dataArray,$wh);
            $messge = array('message' => 'Event Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('success',"Event Updated Successfully..");
            redirect(ADMIN_LINK.'add-calendar/'.$id);

        } else {

            if ($_FILES['attachment']['name'][0]!='') {
                $title = 'task_';
                $attach =  $this->upload_files('assets/uploads/task_attach/', $title, $_FILES['attachment']);
                if(!empty($attach)) {
                    $filename = $attach[0];
                }
            }  
            $dataArray['attachment'] = $filename;

            $result_attach = $this->common->insert_record('tbl_calendar',$dataArray);
            if($result_attach) {
                $this->session->set_flashdata('success','Thank you for adding an event to our calendar..');
                redirect(ADMIN_LINK.'manage-calendar');                
            } else {            
                $this->session->set_flashdata('success','Something Went Wrong!!');
                redirect(ADMIN_LINK.'manage-calendar');
            }
        }

        

        /*if($this->form_validation->run())
        {
            $result_attach = $this->common->insert_record('tbl_calendar',$dataArray);
            if($result_attach) {
                $messge = array('message' => 'Thank you for adding an event to our calendar..','class' => 'success');
                $this->session->set_flashdata('success',$messge);
                redirect(ADMIN_LINK.'manage-calendar');                
            } else {            
                $messge = array('message' => 'Something Went Wrong!!'.validation_errors(),'class' => 'success');
                $this->session->set_flashdata('success',$messge);
                redirect(ADMIN_LINK.'manage-calendar');
            }
        } else {
            $messge = array('message' => 'Please Fill The Data First!!'.validation_errors(),'class' => 'success');
            $this->session->set_flashdata('success',$messge);
            redirect(ADMIN_LINK.'manage-calendar');
        }*/
        
    }

    private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['attachment[]']['name']= $files['name'][$key];
            $_FILES['attachment[]']['type']= $files['type'][$key];
            $_FILES['attachment[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['attachment[]']['error']= $files['error'][$key];
            $_FILES['attachment[]']['size']= $files['size'][$key];

            //$fileName = $title .'_'.time();
            $image = str_replace(" ", "_", $image);
            $fileName = $title .'_'.time().$image;

            

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('attachment[]')) {
                $this->upload->data();
            } else {
                return false;
            }
            $images[] = $fileName;
        }

        return $images;
    }

    /*private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['attachment[]']['name']= $files['name'][$key];
            $_FILES['attachment[]']['type']= $files['type'][$key];
            $_FILES['attachment[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['attachment[]']['error']= $files['error'][$key];
            $_FILES['attachment[]']['size']= $files['size'][$key];

            //$fileName = $title .'_'.time();
            $image = str_replace(" ", "_", $image);
            $fileName = $title .'_'.time().$image;

            

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('attachment[]')) {
                $this->upload->data();
            } else {
                return false;
            }
            $images[] = $fileName;
        }

        return $images;
    }*/
    

	public function ajax_calendar()
	{
        $conditions = array();
        $page = $this->input->post('page');
        $perpage = $this->input->post('perpage');
        $this->perPage = $perpage;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        $field_array = array();
        $keywords = $this->input->post('keywords');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
            $field_array = array("c.task_name","c.task_date","c.task_time","u.fname","u.lname");
        }
       
        $tables = array('tbl_calendar c','tbluser u');
        $joins = array('c.user_id = u.id ');
        $rows = '*,u.id as userid, c.id as calid';
        $order_by = 'c.id';
        $order = 'DESC';
        $groupBy = "";
        $wh = array('c.isDelete'=> 0,'u.isDelete'=> 0);
        $params = array();
        
        // $record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
        $this->db->last_query();
        if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Calendar/ajax_calendar';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'gettour';
            $config['uri_segment'] = 4;
            $config['show_count'] = false;
            $this->ajax_pagination->initialize($config);
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            /**/
            $limit['start'] = $offset;
            $limit['limit'] = $this->perPage;
            /**/
           // $data['tours'] = $this->common->get_all_record_with_limit($tablename,$order_by,$order,$limit,$wh);

            
            $result = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$limit);
            $data['tours'] = $result;

        }
        else {
            $data['tours'] = array();   
        }
        $this->load->view(ADMIN.'calendar/get_calendar', $data, false);
    
    }

    /* Approved Status */

    public function approve()
    {
        $response = array();
        $post = $this->input->post();

        $cal_id = $post['CalId'];
        $user_id = $post['UserId'];
        $status = $post['status'];



        $data = array('approval'=>$status);

            
        $where = array('id'=>$cal_id);
        $table = 'tbl_calendar';
        $user_p = $this->db->select('fname,lname,email')->from('tbluser')->where('id',$user_id)->get()->result_array();
        $user_p = $user_p[0];
        $profile_name = $user_p['fname'].' '.$user_p['lname'];
        $profile_email = $user_p['email'];

        $cal_d = $this->db->select('task_name,task_date,task_time')->from('tbl_calendar')->where('id',$cal_id)->get()->result_array();
        $cal_d = $cal_d[0];
        

        $update = $this->common->update_record($table,$data,$where);

        // Email send to reference 
        $e_data['name'] = $profile_name;
        $e_data['task_name'] = $cal_d['task_name'];
        $e_data['task_date'] = $cal_d['task_date'];
        $e_data['task_time'] = $cal_d['task_time'];
        /**/
        $email_body = $this->load->view(ADMIN.'email/calendar_approval_email', $e_data, TRUE);
        $subject = 'Approved of Event';        
        $mailbody = array('ToEmail'=>$profile_email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>$subject,'Message'=>$email_body);
        $this->general->EmailSend($mailbody);
        /**/

        $response['success'] = true;
        $response['message'] = 'Event Approval Send Successfully..';

        echo json_encode($response);

    }

    function deleteData()
    {
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        
        $where_array = array($field => $id);

        $data_array = array('isDelete'=>1);
        $result = $this->common->update_record($table_name, $data_array,$where_array);
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
        
    }


}
