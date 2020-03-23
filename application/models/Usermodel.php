<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    //Model That Contain User's Function
    //getcartdata not require Now
    public function getcartdata($wh = array())
    {
        $this->db->select('tc.*,tt.Image,tt.Title as TourName');
        $this->db->from('tblcart as tc');
        $this->db->join('tbltour as tt','tc.TourId = tt.TourId','left');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $this->db->where('tc.CartId','1');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    //To Get Wishlist By User Id
    public function getwishlist($params = array(),$wh = array())
    {
        $this->db->select('tw.*,tt.Image,tt.Title as TourName,tt.*');
        $this->db->from('tblwishlist as tw');
        $this->db->join('tbltour as tt','tw.TourId = tt.TourId','left');
        if(!empty($params['search']['keywords'])){
            $this->db->like('tt.Name',$params['search']['keywords']);
        }
        $this->db->order_by('tw.WishlistId','DESC');
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if($this->session->USER['UserId']){
            $this->db->where('tw.UserId',$this->session->USER['UserId']);
        }
        if(count($wh) > 0)
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    //Get The Cart services
    public function getcartservice($wh = array())
    {
        $this->db->select('tss.*,ts.Name,ts.PerPersonPrice as Price');
        $this->db->from('tblselectedservice as tss');
        $this->db->join('tblservice as ts','tss.ServiceId = ts.ServiceId','left');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    //User Profile Get Orders
    public function getorders($params = array(),$wh = array())
    {
        //echo '<pre>'; print_r($params);
        $this->db->select('*');
        $this->db->from('tblcartdetails');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Name',$params['search']['keywords']);
        }
        //$this->db->order_by('CartId','DESC');
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if(array_key_exists("sort_date",$params) && $params['sort_date'] == 'DESC'){
            $this->db->order_by("OrderDate", "DESC");    
        } else {
            //$this->db->order_by("str_to_date('OrderDate', '%d-%b-%Y')", "asc");
            $this->db->order_by("OrderDate", "ASC");
        }
        if($this->session->USER['UserId']){
            $this->db->where('UserId',$this->session->USER['UserId']);
        }
        if(count($wh) > 0)
            $this->db->where($wh);
        $this->db->where('OrderStatus','2');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getnum($wh = array(),$type = 'NoOfAdult')
    {   
        if($type == 'NoOfAdult')
            $this->db->select_sum('NoOfAdult');
        else
            $this->db->select_sum('NoOfKid');
        $this->db->from('tblcartitems');
        $this->db->where('OrderStatus','2');
        if(count($wh) > 0)
            $this->db->where($wh);
        $query = $this->db->get();
        $res = $query->result_array();
        //echo '<pre>'; print_r($res); exit;
        return (count($res) > 0)?$res[0][$type]:array();
    }
}

/* End of file Homemodel.php */
/* Location: ./application/models/Homemodel.php */