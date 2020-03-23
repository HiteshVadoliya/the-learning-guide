<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Ajax_pagination');
        $this->perPage = 1;
	}

	public function index()
	{
        $type = $this->uri->segment(3);

        $this->general->adminauth();
		$data = array();
		$this->global['pageTitle'] = ' | Manage Review';
        $this->global['ActiveMenu'] = 'Manage Review';
        $data['type'] = $type;
        $this->general->loadViews(ADMIN."school/manage_review", $this->global, $data, NULL);
	}

    
	public function ajax_data()
	{
        $conditions = array();
        $page = $this->input->post('page');
        $perpage = $this->input->post('perpage');
        $post = $this->input->post();
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
            $field_array = array("r.schoolId","r.rating","r.review","u.fname","u.lname");
        }
       
        $tables = array('tbl_rating r','tbluser u');
        $joins = array('r.userId = u.id ');
        $rows = 'r.status,r.id,r.schoolId,r.teacherId,r.rating,r.review,u.id as userid,u.fname,u.lname';
        $order_by = 'r.id';
        $order = 'DESC';
        $groupBy = "r.id";
        $wh = array('r.isDelete'=> 0,'u.isDelete'=> 0,'r.rating <='=>2);
        if($post['type']=='school') {
            $wh['r.schoolId !='] = 0;
        } else if($post['type']=='teacher') {
            $wh['r.teacherId !='] = 0;
        }
        $params = array();
        
        // $record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);

        // echo $this->db->last_query();
        
        if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Review/ajax_data';
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
        $data['type'] = $post['type'];
        $this->load->view(ADMIN.'school/get_school_review', $data, false);
    
    }

    
    public function changeStatus($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];


        $data = array('status'=>$status);

        $where = array('id'=>$post['Id']);

        
        $table = 'tbl_rating';
        
        
        $update = $this->common->update_record($table,$data,$where);
        
        $response['success'] = true;
        /*if($status) {
            $response['message'] = 'This profile is now live!';
        }
        else {
            $response['message'] = 'This profile is now off!';
        }*/
        $response['message'] = 'Status Changed Successfully..';

        echo json_encode($response);

    }



}
