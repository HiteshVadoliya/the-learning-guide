<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calendar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Settingmodel');
        $this->sendemail = false;
    }

    public function index($view = '',$school_id = '')
    {
        // echo $filePath = base_url('assets/download.ics');
        // exec("http://localhost/the-learning-guide/assets/download.ics");
        // echo $path.'download.ics'; die();
        /*$path = $_SERVER['DOCUMENT_ROOT'].'/the-learning-guide/assets/';
        exec($path.'download.ics');*/
        // exec('cd '.$path);
        // exec('download.ics');
        // die();
        $post = $this->input->get();
        $searchText = "";
        if(isset($post['searchText']) && $post['searchText']!='') {
            $searchText = $post['searchText'];
        }


        $this->global['pageTitle'] = ' | Calendar';

        $wh = array("approval"=>"1","isDelete"=>"0");

        $this->db->select("*");
        $this->db->from("tbl_calendar");
        $this->db->where($wh);
        if($searchText!='') {
            $this->db->like("task_name",$searchText);
        }
        $data['searchText'] = $searchText;
        $data['result'] = $this->db->get()->result_array();
        /*echo "<pre>";
        print_r($data['result']);
        die();*/

        //$data['result'] = $this->common->get_all("tbl_calendar",$wh);
        /*echo "<pre>";
        print_r($data['result']);
        echo $this->db->last_query();
        die();*/
        $data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1));
        $data['is_view'] = $view;

        $data['calender_event_type'] = $this->config->item('calender_event_type');
        $data['calender_event_color'] = $this->config->item('calender_event_color');

        if(count($data['result']) > 0) {
            foreach ($data['result'] as $key => $value) {
                $data['task'][$key]['title'] = $value['task_name'];
                $data['task'][$key]['start'] = $value['task_date']." ".$value['task_time'];
                $data['task'][$key]['end'] = $value['task_end_date']." ".$value['task_end_time'];
                // $data['task'][$key]['backgroundColor'] = $data['calender_event_color'][$value['task_type']];
                // $data['task'][$key]['borderColor'] = $data['calender_event_color'][$value['task_type']];
                $data['task'][$key]['textColor'] = '#000';
                $data['task'][$key]['id'] = $value['id'];
            }

        } else {
            $data['task'][0]['title'] = "";
            $data['task'][0]['start'] = "";
            $data['task'][0]['backgroundColor'] = "#00a65a";
            $data['task'][0]['id'] = "";
        }

        $data['task'] = json_encode($data['task']);
        
        //$arr_reason = $this->config->item('quote_unsuccessful_reason');

        
        $this->general->loadViewsFront(FRONTEND."calendar", $this->global, $data, NULL);
    }

    public function get_all_event() {

        $post = $this->input->post();
        $searchText = $post['search'];
        if(isset($post['searchText']) && $post['searchText']!='') {
            $searchText = $post['searchText'];
        }

        $this->global['pageTitle'] = ' | Calendar';
        $wh = array("approval"=>"1","isDelete"=>"0");
        $school_id = $post['school_id'];
        
        if($school_id!='') {
            $wh["md5(task_school_tag)"] = $school_id;
        }

        $this->db->select("*");
        $this->db->from("tbl_calendar");
        $this->db->where($wh);


        if($searchText!='') {
            $this->db->like("task_name",$searchText);
        }

        $find_in_set = '';
        if(!empty($post['task_type'])){
            foreach ($post['task_type'] as $key => $value) {
                $find_in_set .= '( find_in_set("'.$value.'",task_type) <> 0) OR';
            }
            $find_in_set = rtrim($find_in_set,'OR');                
            $find_in_set = "(".$find_in_set.")";
        }
        
        if($find_in_set != '') {
            $this->db->where($find_in_set);
        }
        $this->db->group_by("id");


        $data['searchText'] = $searchText;
        $data['result'] = $this->db->get()->result_array();
        
        
        $data['calender_event_type'] = $this->config->item('calender_event_type');
        $data['calender_event_color'] = $this->config->item('calender_event_color');

        if(count($data['result']) > 0) {
            foreach ($data['result'] as $key => $value) {
                $color_id = 1;
                if($value['task_type']!='') {
                    $color_array = explode(",", $value['task_type']);
                    $color_id = $color_array[0];
                }

                $data['task'][$key]['title'] = $value['task_name'];
                $data['task'][$key]['start'] = $value['task_date']." ".$value['task_time'];
                $data['task'][$key]['end'] = $value['task_end_date']." ".$value['task_end_time'];
                $data['task'][$key]['backgroundColor'] = $data['calender_event_color'][$color_id];
                $data['task'][$key]['borderColor'] = $data['calender_event_color'][$color_id];
                $data['task'][$key]['textColor'] = '#000';
                $data['task'][$key]['id'] = $value['id'];
            }

        } else {
            $data['task'][0]['title'] = "";
            $data['task'][0]['start'] = "";
            $data['task'][0]['backgroundColor'] = "#00a65a";
            $data['task'][0]['borderColor'] = "#00a65a";
            $data['task'][0]['textColor'] = "#000";
            $data['task'][0]['id'] = "";
        }

        echo json_encode($data['task']);
    }

    public function get_upcomint_event() {

        $school_id = $this->input->post('school_id');
        $calender_event_type = $this->config->item('calender_event_type');
        $calender_event_color = $this->config->item('calender_event_color');

        $currDate = date('Y-m-d');
        $wh = array("task_date >= "=>$currDate,"approval"=>"1","isDelete"=>"0");
        if($school_id!='') {
            $wh["md5(task_school_tag)"] = $school_id;
        }
        // $limit['start'] = "0";
        $limit['Limit'] ="7";
        $limit['ShortBy'] ="task_date";
        $limit['ShortOrder'] ="ASC";


        $upcoming =  $this->common->get_all('tbl_calendar',$wh,$limit);
        // $upcoming =  $this->common->get_all_record_with_limit('tbl_calendar','id', 'DESC',$limit,$wh,"*");

        
        if(count($upcoming) > 0) {
            echo "<label class='bold-lab filter-col'> Upcoming Events </label>";
        }
        foreach ($upcoming as $key => $event) {
            $month = date('F',strtotime($event['task_date']));
            $dt = date('d',strtotime($event['task_date']));
            $s_time = date('h:i A',strtotime($event['task_time']));
            $task_type = array();
            if($event['task_type']!='') {
            $task_type = explode(",", $event['task_type']);
            }

            
            $color_id = 1;
            if($event['task_type']!='') {
                $color_array = explode(",", $event['task_type']);
                $color_id = $color_array[0];
            }
            ?>
            <div class="calendar-event-list">
                <span class="back-color-box" style="background: <?= $calender_event_color[$color_id] ?>"></span>
                <div class="discr-cal">
                    <div><span><?= $dt; ?></span><p><?= $month; ?></p></div>
                </div>
                <div class="">
                    <p><h5><?= ucwords($event['task_name']); ?> <span><?= $s_time; ?></span></h5></p>
                    <p>Event Type : 
                    <?php
                    $type = '';
                    if(!empty($task_type)) {
                        foreach ($task_type as $key_type => $value_type) {
                            $type .= $calender_event_type[$value_type].", ";
                        }
                        echo rtrim($type, ", ");
                    }
                    ?>
                    </p>
                    <p>Location : <?= $event['task_address']; ?></p>
                </div>
            </div>
            <?php
        }
    }

    public function view_all($school_id = '')
    {
        $school_id;
        $post = $this->input->get();
        $searchText = "";
        if(isset($post['searchText']) && $post['searchText']!='') {
            $searchText = $post['searchText'];
        }


        $this->global['pageTitle'] = ' | Calendar';

        $wh = array("approval"=>"1","isDelete"=>"0",'md5(task_school_tag)'=>$school_id);

        $this->db->select("*");
        $this->db->from("tbl_calendar");
        $this->db->where($wh);
        if($searchText!='') {
            $this->db->like("task_name",$searchText);
        }
        $data['searchText'] = $searchText;
        $data['result'] = $this->db->get()->result_array();

        // echo $this->db->last_query(); die();
        /*echo "<pre>";
        print_r($data['result']);
        die();*/

        //$data['result'] = $this->common->get_all("tbl_calendar",$wh);
        /*echo "<pre>";
        print_r($data['result']);
        echo $this->db->last_query();
        die();*/
        $data['schools'] = $this->common->get_all_record('tbl_school','name,id',array('isDelete'=>0,'status'=>1));
        // $data['calender_event_color'] = $this->config->item('calender_event_color');

        $data['is_view'] = "";

        $data['calender_event_type'] = $this->config->item('calender_event_type');
        $data['calender_event_color'] = $this->config->item('calender_event_color');

        if(count($data['result']) > 0) {
            foreach ($data['result'] as $key => $value) {
                $color_id = 1;
                if($value['task_type']!='') {
                    $color_array = explode(",", $value['task_type']);
                    $color_id = $color_array[0];
                }

                $data['task'][$key]['title'] = $value['task_name'];
                $data['task'][$key]['start'] = $value['task_date']." ".$value['task_time'];
                $data['task'][$key]['end'] = $value['task_end_date']." ".$value['task_end_time'];
                $data['task'][$key]['backgroundColor'] = $data['calender_event_color'][$color_id];
                $data['task'][$key]['borderColor'] = $data['calender_event_color'][$color_id];
                $data['task'][$key]['textColor'] = '#000';
                $data['task'][$key]['id'] = $value['id'];
            }

        } else {
            $data['task'][0]['title'] = "";
            $data['task'][0]['start'] = "";
            $data['task'][0]['backgroundColor'] = "#00a65a";
            $data['task'][0]['borderColor'] = "#00a65a";
            $data['task'][0]['textColor'] = "#000";
            $data['task'][0]['id'] = "";
        }

        $data['school_id'] = $school_id;

        
        //$arr_reason = $this->config->item('quote_unsuccessful_reason');

        // $data['calender_event_type'] = $this->config->item('calender_event_type');
        
        $this->general->loadViewsFront(FRONTEND."calendar", $this->global, $data, NULL);
    }

    public function add_task()
    {
        $post = $this->input->post();
        $user_id = $this->session->USER['UId'];
        $response = array();
        /*echo "<pre>";
        print_r($post);
        die();*/

        $this->form_validation->set_rules('task_name','Task Name','required');
        $this->form_validation->set_rules('task_description','Description','required');
        $this->form_validation->set_rules('task_date','Task Date Name','required');
        $this->form_validation->set_rules('task_time','Task Time Name','required');
        //$this->form_validation->set_rules('task_school_tag','School','required');
        $this->form_validation->set_rules('task_address','Address','required');

        $task_name          =   $post['task_name'];
        $task_description   =   $post['task_description'];
        $task_date          =   $post['task_date'];
        $task_end_date      =   $post['task_end_date'];
        $task_time          =   $post['task_time'];
        $task_end_time      =   $post['task_end_time'];
        $task_school_tag    =   $post['task_school_tag'];
        $task_address       =   $post['task_address'];
        $task_type          =   "";
        $rsvp_date          =   $post['rsvp_date'];
        $rsvp_contact       =   $post['rsvp_contact'];
        if(isset($post['task_address'])) {
            $task_type = implode(",", $post['task_type']);
        }


        $free_event = "0";
        $task_cost = "0";
        /*if(isset($post['free_event']) && $post['free_event']=='1') {
            $free_event = '1';
        } else {
            $task_cost = $post['task_cost'];
        }*/

        $task_cost = $post['task_cost'];

        

        $filename = "";
        if (empty($_FILES['attachment[]']['name'][0])) {
            $title = 'task_';
            $attach =  $this->upload_files('assets/uploads/task_attach/', $title, $_FILES['attachment']);
            if(!empty($attach)) {
                $filename = $attach[0];
            }

        }  
        // $attachment = "filename_";
        $dataArray = array(
            "task_name"         => $task_name,
            "task_description"  => $task_description,
            "attachment"        => $filename,
            "task_date"         => $task_date,
            "task_end_date"     => $task_end_date,
            "task_time"         => $task_time,
            "task_end_time"     => $task_end_time,
            "task_school_tag"   => $task_school_tag,
            "task_address"      => $task_address,
            "free_event"        => $free_event,
            "task_cost"         => $task_cost,
            "task_type"         => $task_type,
            "user_id"           => $user_id,
            "rsvp_date"         => $rsvp_date,
            "rsvp_contact"      => $rsvp_contact,
        );

        

        if($this->form_validation->run())
        {
            $result_attach = $this->common->insert_record('tbl_calendar',$dataArray);
            if($result_attach) {
                // $this->session->set_flashdata('success','Your event has been shared.');
                // $this->session->set_flashdata('success','Thank you for adding an event to our calendar.');
                $this->session->set_flashdata('success','Thank you for adding an event to our calendar. If approved by Admin, your event will be displayed');
                // redirect(base_url('calendar'));
                $response['success'] = true;
                // $response['msg'] = 'Thank you for adding an event to our calendar';
                $response['msg'] = 'Thank you for adding an event to our calendar. If approved by Admin, your event will be displayed';
                $response['last_id'] = $result_attach;
            } else {            
                $this->session->set_flashdata('error','Something Went Wrong!!'.validation_errors());
                // redirect(base_url('calendar'));
                $response['success'] = false;
                $response['msg'] = 'Something Went Wrong';
            }
        } else {
            $this->session->set_flashdata('error','Please Fill The Data First!!'.validation_errors());
            // redirect(base_url('calendar'));
            $response['success'] = false;
            $response['msg'] = 'Please Fill The Data First!!';
        }
          
        echo json_encode($response);
    }
    // PAYMENT
    public function Paypal_Cancel()
    {
        $this->session->set_flashdata('error','Payment is Cancelled!!'.validation_errors());
        redirect(base_url('calendar'));
    }

    public function buy($id='',$event_id = ''){

        // Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url
        
        
        // Get current user ID from session
        $userID = $this->session->USER['UId'];//$_SESSION['userID'];
        
        $cartArr = '';
        $cartArr .= 'uid='.$userID;
        $cartArr .= '&event_id='.$event_id;
        
        $this->load->library('Paypal_lib');
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('custom', $cartArr);
        /*$i = 0;
        foreach ($product as $key => $value) {
            $i++;
            $category = $this->common->get_one_row('tbl_category',array('id'=>$value['cid']));
            $questions = $this->common->get_all_record('tbl_questions',array('fk_cid'=>$value['cid']));
            $price = $value['price'];

            $this->paypal_lib->add_field('item_name_'.$i, $category['name']);
            $this->paypal_lib->add_field('item_number_'.$i, $i);
            $this->paypal_lib->add_field('amount_'.$i, $price);
            $this->paypal_lib->add_field('quantity_'.$i, $value['quantity']);
        }*/
        $wh = array('id'=>$event_id,'isDelete'=>'0');
        $eventInfo = $this->common->get_one_row('tbl_calendar',$wh);
        $eventName = $eventInfo['task_name'];

        $this->paypal_lib->add_field('item_name_1', $eventName);
        $this->paypal_lib->add_field('item_number_1', '1');
        $this->paypal_lib->add_field('amount_1', '2');
        $this->paypal_lib->add_field('quantity_1', '1');

        // Load paypal form
        $this->paypal_lib->paypal_auto_form();

    }

    public function Paypal_Success()
    {
        $this->session->set_flashdata('success','Thank you for adding an event to our calendar.');
        redirect(base_url('calendar'));
        /*$this->global['pageTitle'] = 'Thanks for Payment';
        $this->general->loadViewsFront(FRONTEND."paypal/success_event", $this->global, NULL, NULL);*/
    }
    // PAYMENT

    public function getCalItem()
    {
        $post = $this->input->post();
        $this->db->select('c.*,s.*,c.id as calId, s.id as schId')->from('tbl_calendar c');
        $this->db->join('tbl_school s','s.id=c.task_school_tag','inner');
        $this->db->where('c.id',$post['id']);
        $query = $this->db->get();
        $calEvent = $query->row_array();
        $calEvent['task_time'] = date( 'H:i', strtotime($calEvent['task_time']) );
        $calEvent['task_end_time'] = date( 'H:i', strtotime($calEvent['task_end_time']) );
        //$calEvent = $this->common->get_one_row('tbl_calendar',array('id'=>$post['id']));
        echo json_encode($calEvent);
    }

    public function get_school() {
        $post = $this->input->post();
        $school_details = $this->common->get_one_value('tbl_school',array('id'=>$post['school_id']),'name');
        echo json_encode($school_details);
    }

    public function get_event() {
        $post = $this->input->post();
        $data['calender_event_type'] = $this->config->item('calender_event_type');
        $task_array = explode(",", $post['task_type']);

        if(count($task_array) > 0) {

            foreach ($task_array as $key => $value) {
                $event =  $data['calender_event_type'][$value];
                ?>
                <div class="col-md-3">
                    <div class="form-group">
                      <div class="row">
                        <div class="checkbox">
                              <label style="font-size: 1em">
                                  <input type="checkbox" checked disabled>
                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                  <p><?= $event; ?></p>
                              </label>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php
            }
        } else {
            echo "";
        }
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
    
}