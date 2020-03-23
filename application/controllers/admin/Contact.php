<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
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
		$this->global['pageTitle'] = ' | Contacts';
        $this->global['ActiveMenu'] = 'Manage-contact';
        $this->general->loadViews(ADMIN."contact/contact", $this->global, $data, NULL);
	}

	public function ajax_contact()
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
            $field_array = array("name","email","phone","subject");
        }
       
        $wh = array('isDelete'=>0);
        $data = array();
        $tablename = 'tbl_contact';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';

        $limit = array();

        // $record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"id",$keywords,$field_array);
       	if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_contact';
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
        $this->load->view(ADMIN.'contact/get_contact', $data, false);
    }

    public function edit_contact()
    {
        $this->general->adminauth();
        $this->global['pageTitle'] = ' | Edit Contact Detail';
        $this->global['ActiveMenu'] = 'Edit-contact';
        $contact_details = $this->common->get_all_record('tbl_contact_details');
        if(!empty($contact_details)) {
            $data['contact_details'] = $contact_details[0];
            // $data['contact_details'] = $this->common->get_all_record('tbl_contact_details')[0];
        } else {
            $contact_details = array();
            $data['contact_details'] = $contact_details;
        }
        
        // $data['contact_details'] = $this->common->get_all_record('tbl_contact_details')[0];
        $this->general->loadViews(ADMIN."contact/edit_contact", $this->global, $data, NULL);
    }

    public function create_update_contact_details()
    {
        $response = array();
        $post = $this->input->post();
        $action = $post['action'];
        unset($post['action']);
        if($action == 'edit') {
            $data = $post;
            $wh = array();
            $update = $this->common->update_record('tbl_contact_details',$data,$wh);

            $messge = array('message' => 'Contact Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'edit-contact');
        }
        else {
            $data = $post;
            $insert = $this->common->insert_record('tbl_contact_details',$data);

            $messge = array('message' => 'Contact Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'edit-contact');
        }
    }

    public function view_contact($id)
    {
        $this->general->adminauth();
        $data['id'] = $id;
        $data['contact'] = $this->common->get_one_row('tbl_contact',array('md5(id)'=>$id));
        if(empty($data['contact'])) {
            redirect(base_url(ADMIN.'contact'));
        }
        $this->global['pageTitle'] = ' | View Contact Detail';
        $this->global['ActiveMenu'] = 'Manage-contact';
        $this->general->loadViews(ADMIN."contact/view_contact", $this->global, $data, NULL);
    }

    public function newsletter()
    {
        $this->general->adminauth();
        $data = array();
        $this->global['pageTitle'] = ' | Newsletter';
        $this->global['ActiveMenu'] = 'Manage Newsletter';
        $this->general->loadViews(ADMIN."contact/newsletter", $this->global, $data, NULL);
    }

    public function ajax_newsletter()
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
            $field_array = array("n.fname","n.lname","n.email");
        }
       
        /*$wh = array('isDelete'=>0);
        $data = array();
        $tablename = 'tbl_newsletter';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';*/


        $tables = array('tbl_newsletter n','tbl_state s');
        $joins = array('s.id = n.state');
        $rows = '*';
        $order_by = 'n.id';
        $order = 'DESC';
        $groupBy = "";
        $wh = array('n.isDelete'=> 0,'s.isDelete'=> 0);
        $params = array();
        
        // $record = $this->common->get_all_record($tablename,$rows,$wh);
        $record = $this->common->get_join_all_record($tables,$joins,$rows,$groupBy,$order_by,$wh,$keywords,$field_array,$params);
        $this->db->last_query();
        if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_newsletter';
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
            
            // die();
            /*$this->db->select('n.*,s.name')->from('tbl_newsletter n')
            ->join('tbl_state s','s.id = n.state','left');
            if(!empty($offset)){
                $this->db->limit($this->perPage,$offset);
            }else{
                $this->db->limit($this->perPage);                
            }
            $this->db->where('n.isDelete',0);
            $this->db->order_by($order_by,$order);
            $query = $this->db->get();
            $result = $query->result_array();
            $data['tours'] = $result;*/

            
        }
        else {
            $data['tours'] = array();   
        }
        $this->load->view(ADMIN.'contact/get_newsletter', $data, false);
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
        if($type == 'newsletter') {
            
            $where = array('id'=>$post['newsletterId']);
            $table = 'tbl_newsletter';
        }
        if($type == 'contact') {
            
            $where = array('id'=>$post['contactId']);
            $data['follow_up'] = $status;
            $table = 'tbl_contact';
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

}
