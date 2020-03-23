<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //Ajax Get Product
    public function getproducts($params = array(),$wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblproduct');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('ProductId','desc');
        $this->db->where('IsDeleted',0);
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
     public function getproducts_count()
    {
        $this->db->select('*');
        $this->db->from('tblproduct');
        $this->db->where('IsDeleted','0');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getsubproducts($params = array(),$wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblsubproduct');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('SubProductId','desc');
        $this->db->where('IsDeleted','0');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getsuborderitem($wh = array())
    {
        $this->db->select('toq.*,tac.ColorName');
        $this->db->from('tblorderquantity as toq');
        $this->db->join('tblavailcolor as tac','toq.ColorId=tac.ColorId');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    //Ajax Get Order
    public function getorders($params = array(),$wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblorder');
        if(!empty($params['search']['keywords'])){
            //$this->db->like('FullName',$params['search']['keywords']);
            $k = $params['search']['keywords'];
            $this->db->or_like(array('FullName' => $k, 'StreetAddress' => $k, 'City' => $k, 'State' => $k));
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('OrderId','desc');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
        
    }
    //18-09-2017 Added
    public function getlastorder($wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblsubproduct');
        $this->db->where('IsDeleted','0');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $this->db->order_by('DisplayOrder','desc');
        $query = $this->db->get();
        $query = $query->result_array();
        return (count($query) > 0)?$query[0]['DisplayOrder']:array();
    }

    //Added 02-10-2017
    public function getcoupons($params = array(),$wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblcoupon');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        $this->db->order_by('CouponId','desc');
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $this->db->where('ExpiryDate >=', date('Y-m-d h:i:s'));
        $this->db->where('IsDeleted','0');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    //Added 03-10-2017
    public function getpromos($params = array(),$wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblpromo');
        if(!empty($params['search']['keywords'])){
            $this->db->like('PromoCode',$params['search']['keywords']);
        }
        $this->db->order_by('PromoId','desc');
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $this->db->where('IsDeleted','0');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    
    // Not require now
    public function getprivacy($params = array())
    {
        $this->db->select('*');
        $this->db->from('tblprivacycontent');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //$this->db->order_by('PrivacyId','desc');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getterms($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbltermscontent');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //$this->db->order_by('PrivacyId','desc');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getrefund($params = array())
    {
        $this->db->select('*');
        $this->db->from('tblrefundcontent');
        if(!empty($params['search']['keywords'])){
            $this->db->like('Title',$params['search']['keywords']);
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    public function getstates($wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblstates');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():array();
    }
    public function getcountry($wh = array())
    {
        $this->db->select('*');
        $this->db->from('tblcountry');
        if(count($wh) > 0 && $wh != '')
            $this->db->where($wh);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():array();
    }
}
/* End of file Adminmodel.php */
/* Location: ./application/models/admin/Adminmodel.php */