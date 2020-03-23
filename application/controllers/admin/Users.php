<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
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
		$this->global['pageTitle'] = ' | Users';
        $this->global['ActiveMenu'] = 'users';
        $this->general->loadViews(ADMIN."users/users", $this->global, $data, NULL);
	}

	public function ajax_users()
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
            $field_array = array("fname","lname","email");
        }
       
        $wh = array('isDelete'=>0);
        $data = array();
        $tablename = 'tbluser';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';

        $limit = array();

        // $record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"id",$keywords,$field_array);
       	if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_users';
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
            $data['tours'] = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,$rows,$keywords,$field_array);
        }
        else {
            $data['tours'] = array();   
        }
        $this->load->view(ADMIN.'users/get_users', $data, false);
    }

    /* Change Status */

    public function changeStatus($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];

        $data = array('status'=>$status);

        if($type == 'user') {
            
            $where = array('id'=>$post['userId']);
            $table = 'tbluser';
        }
        
        $update = $this->common->update_record($table,$data,$where);
        
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
