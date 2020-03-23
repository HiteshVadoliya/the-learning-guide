<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulletin extends CI_Controller
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
		$this->global['pageTitle'] = ' | Bulletin';
        $this->global['ActiveMenu'] = 'Manage Bulletin';
        $this->general->loadViews(ADMIN."bulletin/bulletin", $this->global, $data, NULL);
	}

	public function ajax_bulletin()
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
        $limit = array();
        $field_array = array();
        $keywords = $this->input->post('keywords');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
            $field_array = array("title");
        }
       
        $wh = array('isDelete'=>0);
        $data = array();
        $tablename = 'tbl_bulletin';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';

        //$record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"id",$keywords,$field_array);
       	if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_bulletin';
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
        $this->load->view(ADMIN.'bulletin/get_bulletin', $data, false);
    }

    public function add_bulletin($id='')
    {
        $this->general->adminauth();

        $schools = $this->common->get_all('tbl_school',array('status'=>1,'isDelete'=>0));
        $teachers = $this->common->get_all('tbl_teacher',array('status'=>1,'isDelete'=>0));

        if($id) {

            $data['bulletin'] = $this->common->get_one_row('tbl_bulletin',array('id'=>$id));
            $this->global['pageTitle'] = ' | Edit Bulletin';
        }
        else {

            // $data = array();
            $this->global['pageTitle'] = ' | Add Bulletin';
        }

        $data['schools'] = $schools;
        $data['teachers'] = $teachers;
        $this->global['ActiveMenu'] = 'Add Bulletin';
        $this->general->loadViews(ADMIN."bulletin/add_bulletin", $this->global, $data, NULL);
    }

    public function create_update_bulletin($id='')
    {
        $post = $this->input->post();

        $data = array('type'=>$post['type'],'title'=>trim($post['title']),'description'=>$post['description'],'image_credit'=>$post['image_credit'],'keyword_tags'=>$post['keyword_tags']);
        if($post['type'] == 1) {
            $data['schoolId'] = $post['school'];
        }
        if($post['type'] == 2) {
            $data['teacherId'] = $post['teacher'];
        }
        if($post['type'] == 3) {
            $data['schoolId'] = $post['school'];
            $data['teacherId'] = $post['teacher'];
        }
        
        if($id) {

            /* Image */
            if($post['ImgFile'] != '') {

                $path = BlogPath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $Img = array();
                $old_Img = $post['old_Img'];
                $ImgFile = $post['ImgFile'];
                
                $src = MyPath.$ImgFile;
                $dest = BlogPath.$ImgFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_Img != '') {                    
                    unlink(BlogPath.$old_Img);
                }

                $data['image'] = $post['ImgFile'];
                
            }
            /* Profile Image */

            /* Images */
            if($post['bulletinImagesFile'] != '') {

                $path = BlogPath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $Images = array();
                $old_bulletinImages = $post['old_bulletinImages'];
                $bulletinImagesFile = json_decode($post['bulletinImagesFile'], true);
                foreach ($bulletinImagesFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BlogPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_bulletinImages != '') {
                    $old_bulletinImages = json_decode($old_bulletinImages, true);
                    $Images = array_merge($old_bulletinImages,$bulletinImagesFile);
                    $Images = json_encode($Images);
                    $data['images'] = $Images;
                }
                else {

                    $data['images'] = $post['bulletinImagesFile'];
                }
                
            }
            /* Images */

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_bulletin',$data,$wh);
            $messge = array('message' => 'Bulletin Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-bulletin/'.$id);

        }
        else {

            /* Profile Image */
            if($post['ImgFile'] != '') {

                $path = BlogPath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $Img = array();
                $ImgFile = $post['ImgFile'];
                
                $src = MyPath.$ImgFile;
                $dest = BlogPath.$ImgFile;
                copy($src, $dest);
                unlink($src);
                
                $data['image'] = $post['ImgFile'];
                
            }
            /* Profile Image */

            /* Images */
            if($post['bulletinImagesFile'] != '') {

                $path = BlogPath;
                if(!is_dir($path)) {
                    mkdir($path);
                }
                
                $Images = array();
                $bulletinImagesFile = json_decode($post['bulletinImagesFile'], true);
                foreach ($bulletinImagesFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BlogPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['images'] = $post['bulletinImagesFile'];
                
            }
            /* Images */

            $bulletinId = $this->common->insert_record('tbl_bulletin',$data);
            $messge = array('message' => 'Bulletin Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            
            $data_nofity = array(
                'type'=> 'Blog', 
                'title'=> $post['title'],
                'link' => base_url().'bulletin-detail/'.md5($bulletinId),
                'is_view' => 'N',
                'created_date' => date('Y-m-d H:i:s')
            );
            $this->common->insert_record('notify',$data_nofity);
            redirect(ADMIN_LINK.'bulletin');

        }
    }

    /* Review Form */
    public function insta_feed()
    {
        $this->general->adminauth();
        $data = array();
        $this->global['pageTitle'] = ' | Insta Feed Review';
        $this->global['ActiveMenu'] = 'Insta Feed';
        $this->general->loadViews(ADMIN."bulletin/insta_feed", $this->global, $data, NULL);
    }

    public function ajax_insta_feed()
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
        $limit = array();
        $field_array = array();
        $keywords = $this->input->post('keywords');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
            $field_array = array("title");
        }
       
        $wh = array('isDelete'=>0);
        $data = array();
        $tablename = 'tbl_bulletin_review';
        $rows = '*';
        $order_by = 'review_id';
        $order = 'DESC';

        //$record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"review_id",$keywords,$field_array);
        if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_insta_feed';
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
        $this->load->view(ADMIN.'bulletin/get_insta_feed', $data, false);
    }
    /* Review Form */

    /* Insta Feed Details */
    public function insta_feed_details($id)
    {
        $this->general->adminauth();
        if($id) {
            $review = $this->common->get_one_row('tbl_bulletin_review',array('review_id'=>$id));
            $this->global['pageTitle'] = ' | Insta Feed Details';
            $this->global['ActiveMenu'] = 'Insta Feed Details';
            $data['review'] = $review;
            $this->general->loadViews(ADMIN."bulletin/insta_feed_details", $this->global, $data, NULL);
        }
        else {
            redirect(base_url(ADMIN.'insta-feed'));
        }
    }
    /* Insta Feed Details */

    
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
        if($type == 'bulletin') {
            
            $where = array('id'=>$post['bulletinId']);
            $table = 'tbl_bulletin';
        }
        if($type == 'review') {
            
            $where = array('review_id'=>$post['reviewId']);
            $table = 'tbl_bulletin_review';
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
        /*ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');*/
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
                    throw new RuntimeException('Other Error.');
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

}
