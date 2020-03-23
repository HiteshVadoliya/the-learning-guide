<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller
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
		$this->global['pageTitle'] = ' | Manage teacher';
        $this->global['ActiveMenu'] = 'Manage Teacher';
        $this->general->loadViews(ADMIN."teacher/manage_teacher", $this->global, $data, NULL);
	}

	public function ajax_teacher()
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
            $field_array = array('fname','lname','email');
        }

        // $wh = array('isDelete'=>0,'approval !='=>1);
        $wh = array('isDelete'=>0);

        if(!empty($keywords) && $keywords=='new') {
            $keywords = "";
            $wh = array();
            $wh = array('isDelete'=>0,'approval'=>1);
        }
        
        
        $data = array();
        $tablename = 'tbl_teacher';
        $rows = '*,CONCAT(fname," ",lname) as name';
        $order_by = 'id';
        $order = 'DESC';
        $limit = array();
        //$record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"id",$keywords,$field_array);

       	if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_teacher';
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
            // $data['tours'] = $this->common->get_all_record_with_limit($tablename,$order_by,$order,$limit,$wh,$rows);
            $data['tours'] = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,$rows,$keywords,$field_array);
        }
        else {
            $data['tours'] = array();   
        }
        // echo $this->db->last_query(); 
        $this->load->view(ADMIN.'teacher/get_teacher', $data, false);
    }

	public function add_teacher($id='')
	{
		$this->general->adminauth();

		$data['school'] = $this->common->get_all_record('tbl_school','*',array('isDelete'=>0,'status'=>1));
        $data['language'] = $this->common->get_all_record('tbl_language','*',array('isDelete'=>0,'status'=>1));
		if($id) {

			$data['teacher'] = $this->common->get_one_row('tbl_teacher',array('id'=>$id));
			$this->global['pageTitle'] = ' | Edit Teacher';
		}
		else {

			$this->global['pageTitle'] = ' | Add Teacher';
		}
        $data['special_need_category'] = $this->config->item('special_need_category');
        $this->global['ActiveMenu'] = 'Add Teacher';
        $this->general->loadViews(ADMIN."teacher/add_teacher", $this->global, $data, NULL);
	}

	public function create_update_teacher($id='')
	{
		$post = $this->input->post();

        $type = $post['type'];
        $type = implode(',', $type);
        
		$data = array('title'=>$post['title'],'fname'=>$post['fname'],'lname'=>$post['lname'],'email'=>$post['email'],'phone'=>$post['phone'],'mobile'=>$post['mobile'],'qualifications'=>$post['qualifications'],'teach_school'=>$post['teach_school'],'previous_school'=>$post['previous_school'],'year_started_teach'=>$post['year_started_teach'],'units_teach'=>$post['units_teach'],'type'=>$type,'tutoring_services'=>$post['tutoring_services'],'teacher_status'=>$post['teacher_status'],'motto'=>$post['motto'],'about'=>$post['about'],'social_link'=>$post['social_link'],'need_experience'=>$post['need_experience'], 'working_with_children'=>$post['working_with_children'],'multilanguage'=>$post['multilanguage']);

        $data['special_need_category'] = '';
        if($post['need_experience'] == 1){
            $special_need_category = $post['special_need_category'];
            $data['special_need_category'] =  implode(',', $special_need_category);
        }

        if($id) {

            /* Resume */
            if($post['resumeFile'] != '') {

                $resume = array();
                $old_resume = $post['old_resume'];
                $resumeFile = $post['resumeFile'];
                
                $src = MyPath.$resumeFile;
                $dest = ResumePath.$resumeFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_resume != '') {
                    
                    unlink(ResumePath.$old_resume);
                }

                $data['document'] = $post['resumeFile'];
                
            }
            /* Resume */

            /* Profile Image */
            if($post['profileImgFile'] != '') {

                $path = ProfilePath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $profileImg = array();
                $old_profileImg = $post['old_profileImg'];
                $profileImgFile = $post['profileImgFile'];
                
                $src = MyPath.$profileImgFile;
                $dest = ProfilePath.$profileImgFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_profileImg != '') {
                    
                    unlink(ProfilePath.$old_profileImg);
                }

                $data['profile_img'] = $post['profileImgFile'];
                
            }
            /* Profile Image */

            if($post['tutoring_services'] == 1){
                $preferred_hours = $post['preferred_hours'];
                $data['preferred_hours'] = $preferred_hours;
                if(isset($post['preferred_days'])) {
                    $preferred_days = $post['preferred_days'];
                    $preferred_days = implode(',', $preferred_days);
                    $data['preferred_days'] = $preferred_days;
                }
            }
            // if($post['working_with_children'] == 1){
                $data['wwcc_number'] =  $post['wwcc_number'];
            // }
            if($post['multilanguage'] == 1){
                $type = $post['language'];
                $data['language'] =  implode(',', $type);
            }

            $wh = array('id'=>$id);
			$schoolId = $this->common->update_record('tbl_teacher',$data,$wh);
			$messge = array('message' => 'Teacher Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-teacher/'.$id);

		}
		else {

            /* Resume */
            if($post['resumeFile'] != '') {

                $resume = array();
                $resumeFile = $post['resumeFile'];

                $src = MyPath.$resumeFile;
                $dest = ResumePath.$resumeFile;
                copy($src, $dest);
                unlink($src);
                
                $data['document'] = $post['resumeFile'];
                
            }
            /* Resume */

            /* Profile Image */
            if($post['profileImgFile'] != '') {

                $path = ProfilePath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $profileImg = array();
                $profileImgFile = $post['profileImgFile'];
                
                $src = MyPath.$profileImgFile;
                $dest = ProfilePath.$profileImgFile;
                copy($src, $dest);
                unlink($src);
                
                $data['profile_img'] = $post['profileImgFile'];
                
            }
            /* Profile Image */

            if($post['tutoring_services'] == 1){
                $data['preferred_hours'] =  $post['preferred_hours'];
            }
            if($post['working_with_children'] == 1){
                $data['wwcc_number'] =  $post['wwcc_number'];
            }
            if($post['multilanguage'] == 1){
                $type = $post['language'];
                $data['language'] =  implode(',', $type);
            }
            
			$schoolId = $this->common->insert_record('tbl_teacher',$data);
            $messge = array('message' => 'Teacher Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            /* Add to notify */
            $data_nofity = array(
                'type'=> 'Teacher',
                'title'=> $post['title'],
                'link' => base_url().'teacher/'.md5($schoolId),
                'is_view' => 'N'
            );
            $this->common->insert_record('notify',$data_nofity);
            /* Add to notify */
            redirect(ADMIN_LINK.'manage-teacher');

		}
	}

    /* Change Status */

    public function changeStatus($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];

        $data = array('status'=>$status);

        if($type == 'teacher') {
            
            $where = array('id'=>$post['teacherId']);
            $table = 'tbl_teacher';
        }
        
        $update = $this->common->update_record($table,$data,$where);
        
        $response['success'] = true;
        if($status) {
            $response['message'] = 'This profile is now live!';
        }
        else {
            $response['message'] = 'This profile is now off!';
        }
        // $response['message'] = 'Status Changed Successfully..';

        echo json_encode($response);

    }

    /* Approved Status */

    public function approve($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];

        $data = array('approval'=>$status);
        if($type == 'teacher') {
            
            $where = array('id'=>$post['teacherId']);
            $table = 'tbl_teacher';
            $link = base_url().'teacher/'.md5($post['teacherId']);
            $teacher_p = $this->db->select('fname,lname,email')->from('tbl_teacher')->where('id',$post['teacherId'])->get()->result_array();
            $teacher_p = $teacher_p[0];
            $profile_name = $teacher_p['fname'].' '.$teacher_p['lname'];
            $profile_email = $teacher_p['email'];
        }
        if($type == 'school') {
            
            $where = array('id'=>$post['schoolId']);
            $table = 'tbl_school';
            $link = base_url().'school/'.md5($post['schoolId']);
            $school_p = $this->db->select('name,email')->from('tbl_school')->where('id',$post['schoolId'])->get()->result_array();
            $school_p = $school_p[0];
            $profile_name = $school_p['name'];
            $profile_email = $school_p['email'];
        }
        
        $update = $this->common->update_record($table,$data,$where);

        // Email send to reference 
        $e_data['name'] = ucfirst($post['reference_by']);
        $e_data['type'] = ucfirst($type);
        $e_data['profile_name'] = $profile_name;
        $e_data['link'] = $link;
        /**/
        $email_body = $this->load->view(FRONTEND.'email/link_send_to_reference_email', $e_data, TRUE);
        $subject = 'Your request has been approved';        
        $mailbody = array('ToEmail'=>$post['reference_email'],'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>$subject,'Message'=>$email_body);
        $this->general->EmailSend($mailbody);
        /**/

        /* To Teacher/School */
        /*data*/
        $teacher_data = array('name'=>$profile_name,'link'=>$link);
        /*data*/
        $email_teacher_body = $this->load->view(FRONTEND.'email/link_send_to_teacher_email', $teacher_data, TRUE);
        $teacher_subject = 'Your profile is live!';
        $teacher_mailbody = array('ToEmail'=>$profile_email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>$subject,'Message'=>$email_teacher_body);
        $this->general->EmailSend($teacher_mailbody);
        /* To Teacher/School */
        
        $response['success'] = true;
        $response['message'] = 'Status Changed Successfully..';

        echo json_encode($response);

    }

    /* Change Status */

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

    /* Upload Files */
    public function upload_files()
    {
        try {
            if (
                !isset($_FILES['file']['error']) ||
                is_array($_FILES['file']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            $filename = uniqid().'_'.$_FILES['file']['name'];
            // $filepath = sprintf(MyPath.'%s_%s', uniqid(), $_FILES['file']['name']);
            $filepath = MyPath.$filename;

            if (!move_uploaded_file($_FILES['file']['tmp_name'],$filepath)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            // All good, send the response
            $data = array('status' => 'ok','path' => $filename);
            //echo json_encode($data);

        } catch (RuntimeException $e) {
            // Something went wrong, send the err message as JSON
            http_response_code(400);

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        echo json_encode($data);
    }


    /* Is Featured */

    public function is_featured()
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];
        $data = array('is_sponsored'=>$status);
        $where = array('id'=>$post['teacherId']);
        $table = 'tbl_teacher';        
        $update = $this->common->update_record($table,$data,$where);        
        $response['success'] = true;
        $response['message'] = 'Teacher Featured Successfully..';
        echo json_encode($response);
    }

    /*if($post['Image'] != '') {
        $next_id = $this->common->get_next_id('tbl_category');
        $src = MyPath.$post['Image'];
        if(!is_dir(CATPATH.$next_id.'/')) {
            mkdir(CATPATH.$next_id.'/');
        }
        $dest = CATPATH.$next_id.'/'.$post['Image'];
        copy($src, $dest);
        $this->general->resize_image(CATPATH.$next_id.'/',$post['Image'],'200','200',true,'Thumb/');
        unlink($src);
        $data['image'] = $post['Image'];

        $res = $this->common->insert_record('tbl_category',$data);
        if(!$res) {
            unlink(CATPATH.$next_id.'/'.$post['Image']);
            unlink(CATPATH.$next_id.'/Thumb/'.$post['Image']);
        }
        $this->general->processandredirect($res,'Category Added Successfully','Category Not Added',ADMIN.'category');
    }
    
    if($post['Image'] != '') {  
        if($OldImage != '') {
            unlink(CATPATH.$id.'/'.$OldImage);
            unlink(CATPATH.$id.'/Thumb/'.$OldImage);
        }
        $src = MyPath.$post['Image'];
        if(!is_dir(CATPATH.$id)) {
            mkdir(CATPATH.$id);
        }
        $dest = CATPATH.$id.'/'.$post['Image'];
        copy($src, $dest);
        $this->general->resize_image(CATPATH.$id.'/',$post['Image'],'200','200',true,'Thumb/');
        unlink($src);
        $data['image'] = $post['Image'];
    }
    else {
        if($OldImage == "") {
            $this->session->set_flashdata('error','Please Select Image');
        }
        // redirect(base_url(ADMIN.'category/add/'.$id));
    }
    */

}
