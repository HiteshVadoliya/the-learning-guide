<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('NotFoundController');
	}

	public function terms()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Terms';
        $data['terms'] = $this->common->get_one_row('tbl_content',array('id'=>'1'));
        
        $this->global['ActiveMenu'] = 'Manage Terms';
        $this->general->loadViews(ADMIN."content/terms", $this->global, $data, NULL);
    }

    public function create_update_terms($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'terms','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Terms Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-terms');

        }
        else {

            $terms = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Terms Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-terms');

        }
    }

    public function privacy()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Privacy';
        $data['privacy'] = $this->common->get_one_row('tbl_content',array('id'=>'2'));
        
        $this->global['ActiveMenu'] = 'Manage Privacy';
        $this->general->loadViews(ADMIN."content/privacy_policy", $this->global, $data, NULL);
    }

    public function create_update_privacy($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'privacy-policy','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Privacy Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-privacy');

        }
        else {

            $privacy = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Privacy Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-privacy');

        }
    }

    public function content_policy()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Content Policy';
        $data['content_policy'] = $this->common->get_one_row('tbl_content',array('id'=>'3'));
        
        $this->global['ActiveMenu'] = 'Manage Content Policy';
        $this->general->loadViews(ADMIN."content/content_policy", $this->global, $data, NULL);
    }

    public function create_update_content_policy($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'content-integrity-policy','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Content Policy Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-content-policy');

        }
        else {

            $content_policy = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Content Policy Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-content-policy');

        }
    }

    public function paid_content_partnerships()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Paid Content Partnerships';
        $data['paid_content_partnerships'] = $this->common->get_one_row('tbl_content',array('id'=>'4'));
        
        $this->global['ActiveMenu'] = 'Manage Paid Content Partnerships';
        $this->general->loadViews(ADMIN."content/paid_content_partnerships", $this->global, $data, NULL);
    }

    public function create_update_paid_content_partnerships($id='')
    {
        $post = $this->input->post(); 

        $data = array('name'=>'paid-content-partnerships','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Paid Content Partnerships Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-paid-content-partnerships');

        }
        else {

            $paid_content_partnerships = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Paid Content Partnerships Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-paid-content-partnerships');

        }
    }

    public function legal()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Legal';
        $data['legal'] = $this->common->get_one_row('tbl_content',array('name'=>'legal'));
        
        $this->global['ActiveMenu'] = 'Manage Legal';
        $this->general->loadViews(ADMIN."content/legal", $this->global, $data, NULL);
    }

    public function create_update_legal($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'legal','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Legal Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-legal');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Legal Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-legal');

        }
    }

    public function faq()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | FAQ';
        $data['cms'] = $this->common->get_one_row('tbl_content',array('id'=>'5'));
        
        $this->global['ActiveMenu'] = 'Manage Faq';
        $this->general->loadViews(ADMIN."content/faq", $this->global, $data, NULL);
    }

    public function create_update_faq($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'faq','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'FAQ Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-faq');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'FAQ Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-faq');

        }
    }

    public function services()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Services';
        $data['cms'] = $this->common->get_one_row('tbl_content',array('id'=>'7'));
        
        $this->global['ActiveMenu'] = 'Manage Services';
        $this->general->loadViews(ADMIN."content/services", $this->global, $data, NULL);
    }

    public function create_update_services($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'services','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Services Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-services');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Services Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-services');

        }
    }

    public function stories()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Our Stories';
        $data['cms'] = $this->common->get_one_row('tbl_content',array('id'=>'6'));
        
        $this->global['ActiveMenu'] = 'Manage Stories';
        $this->general->loadViews(ADMIN."content/stories", $this->global, $data, NULL);
    }

    public function create_update_stories($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'stories','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Stories Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-stories');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Stories Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-stories');

        }
    }

    public function team()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Our team';
        $data['cms'] = $this->common->get_one_row('tbl_content',array('id'=>'8'));
        
        $this->global['ActiveMenu'] = 'Manage Team';
        $this->general->loadViews(ADMIN."content/team", $this->global, $data, NULL);
    }

    public function create_update_team($id='')
    {
        $post = $this->input->post();

        $data = array('name'=>'team','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],'description'=>$post['description']);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Team Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-team');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Team Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-team');

        }
    }

    public function partners()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Our Partners';
        $data['cms'] = $this->common->get_one_row('tbl_content',array('id'=>'9'));
        
        $this->global['ActiveMenu'] = 'Manage Partners';
        $this->general->loadViews(ADMIN."content/partners", $this->global, $data, NULL);
    }

    public function create_update_partners($id='')
    {
        $post = $this->input->post();


        //if($type != 'select') {
            $optionData = array();
            $optionData['option'] = $post['option'];
            $optionData['optvalue'] = $post['optvalue'];
            
            foreach ($optionData as $key => $optionDatavalue) {
                $optionData[$key] = array_filter($optionDatavalue);
            }
            $optionData = json_encode($optionData);
        //}

        // $data = array('name'=>'partners','title'=>$post['title'],'footer_heading'=>$post['footer_heading'],/*'description'=>$post['description']*/);
        $data = array('name'=>'partners','title'=>$optionData);

        if($id) {

            $wh = array('id'=>$id);
            $bulletinId = $this->common->update_record('tbl_content',$data,$wh);
            $messge = array('message' => 'Partners Details Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-partners');

        }
        else {

            $legal = $this->common->insert_record('tbl_content',$data);
            $messge = array('message' => 'Partners Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-partners');

        }
    }



    public function social_media()
    {
        $this->general->adminauth();

        $this->global['pageTitle'] = ' | Social Media';
        $data['social_media'] = $this->common->get_one_row('tbl_social_media');
        
        $this->global['ActiveMenu'] = 'Manage social_media';
        $this->general->loadViews(ADMIN."content/social_media", $this->global, $data, NULL);
    }

    public function create_update_social_media($id='')
    {
        $post = $this->input->post();
        
        if($post['facebook'] == '' && $post['instagram'] == '' && $post['linkedin'] != '' && $post['youtube'] != '' && $post['twitter'] != '') {
            $this->form_validation->set_rules('facebook','Facebook','trim|required');
            $this->form_validation->set_rules('instagram','Instagram','trim|required');
            $this->form_validation->set_rules('linkedin','Linkedin','trim|required');
            $this->form_validation->set_rules('youtube','Youtube','trim|required');
            $this->form_validation->set_rules('twitter','Twitter','trim|required');
        }
        else {
            if($post['facebook'] != '') {
                $this->form_validation->set_rules('facebook','Facebook','callback_valid_url');
            }
            if($post['instagram'] != '') {
                $this->form_validation->set_rules('instagram','Instagram','callback_valid_url');
            }
            if($post['linkedin'] != '') {
                $this->form_validation->set_rules('linkedin','Linkedin','callback_valid_url');
            }
            if($post['youtube'] != '') {
                $this->form_validation->set_rules('youtube','Youtube','callback_valid_url');
            }
            if($post['twitter'] != '') {
                $this->form_validation->set_rules('twitter','Twitter','callback_valid_url');
            }

        }

        if($this->form_validation->run() == FALSE) {
            $messge = array('message' => validation_errors(),'class' => 'warning');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'social-media');
        }
        else {
            
            $data = array('facebook'=>$post['facebook'],'instagram'=>$post['instagram'],'linkedin'=>$post['linkedin'],'youtube'=>$post['youtube'],'twitter'=>$post['twitter']);
            // ,'title'=>$post['title']

            if($id) {

                $wh = array('id'=>$id);
                $bulletinId = $this->common->update_record('tbl_social_media',$data,$wh);
                $messge = array('message' => 'Social Media Updated Successfully..','class' => 'success');
                $this->session->set_flashdata('msg',$messge);
                redirect(ADMIN_LINK.'social-media');

            }
            else {

                $social_media = $this->common->insert_record('tbl_social_media',$data);
                $messge = array('message' => 'Social Media Added Successfully..','class' => 'success');
                $this->session->set_flashdata('msg',$messge);
                redirect(ADMIN_LINK.'social-media');

            }
        }

    }

    function valid_url($url)
    {
        if(preg_match("/^http(|s):\/{2}(.*)\.([a-z]){2,}(|\/)(.*)$/i", $url)) {
            if(filter_var($url, FILTER_VALIDATE_URL)) return TRUE;
        }
        $this->form_validation->set_message('valid_url', 'The %s must be a valid URL.');
        return FALSE;
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
        if($type == 'bulletin') {
            
            $where = array('id'=>$post['bulletinId']);
            $table = 'tbl_bulletin';
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

}
