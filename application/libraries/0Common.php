<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {
	public $CI;
	function __construct() {
		$this ->CI =& get_instance();
        $this->CI->load->database();
	}
	//model Query
	public function get_all_record($tablename,$rows="*",$wh = array())
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tablename);
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);
		$res = $this->CI->db->get();
		$res = $res->result_array();
		return !empty($res)?$res:array();
	}
	public function get_all($tbl,$wh = array(),$params = array())
	{
		if(array_key_exists("Select",$params)){
			$this->CI->db->select($params['Select']);
        } else {
        	$this->CI->db->select('*');	
        }
        $this->CI->db->from($tbl);
        if(array_key_exists("ShortBy",$params) && array_key_exists("ShortOrder",$params)){
			$this->CI->db->order_by($params['ShortBy'],$params['ShortOrder']);
        }
        if(array_key_exists("Limit",$params)){
			$this->CI->db->limit($params['Limit']);
        }
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);
		$res = $this->CI->db->get();
		$res = $res->result_array();
		return !empty($res)?$res:array();
	}
	public function get_all_record_orderby($tablename,$by, $order = 'DESC',$wh = array())
	{
		$this->CI->db->select('*');
		$this->CI->db->from($tablename);
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);
		$this->CI->db->order_by($by,$order);
		$res = $this->CI->db->get();
		$res = $res->result_array();
		return !empty($res)?$res:array();
	}
	public function get_one_row($table,$wh = array() )
	{
		$this->CI->db->select("*");
		$this->CI->db->from($table);
		if(count($wh) > 0 || $wh != '')
		$this->CI->db->where($wh);
	 	$query = $this->CI->db->get();
 		$results = $query->result_array();
 		return !empty($results)?$results[0]:false;
	}
	public function insert_record($tblname,$data)
	{
		$this->CI->db->insert($tblname,$data); 
		return $this->CI->db->insert_id();
	}
	// public function update_record($table,$wh,$data)
	public function update_record($table,$data,$wh)
	{
		$this->CI->db->where($wh)
			   ->update($table, $data);
		return $this->CI->db->affected_rows();
	}
	public function delete_record_from_db($table,$wh)
	{
		$this->CI->db->where($wh);
		$this->CI->db->delete($table);
		return true;
	}
	public function cust_query($query){
		$res = $this->CI->db->query($query);
		return $res->result_array();
	}
	public function select_sum_of_colomn($table,$col,$wh = array())
    {
    	$this->CI->db->select_sum($col);
    	$this->CI->db->from($table);
    	if(count($wh2) > 0 || $wh2 != '')
    		$this->CI->db->where($wh);
    	$res = $this->CI->db->get();
    	$res2 = $res->result_array();
    	return !empty($res2)?$res2[0][$col]:false;
    }
	public function prepare_array_from_table($table,$colname,$wh = array())
    {
    	$result = array();
    	$this->CI->db->select($colname);
    	$this->CI->db->from($table);
    	if(count($wh) > 0 || $wh != '')
    		$this->CI->db->where($wh);
    	$query = $this->CI->db->get();
    	$data = $query->result_array();
    	foreach ($data as $value) {
    		array_push($result, $value[$colname]);
    	}
    	return !empty($result)?$result:array();
    }
	public function get_one_value($table,$wh = array(),$colname)
	{
		$this->CI->db->select('*');
		$this->CI->db->from($table);
		if(!empty($wh) || count($wh) > 0)
			$this->CI->db->where($wh);
		$res = $this->CI->db->get();
		$type = $res->result_array();
		return !empty($type)?$type[0][$colname]:false;
	}
	public function get_record_in_between($table,$colname,$wh = array())
	{
	   $this->CI->db->select('*');
	   $this->CI->db->from($table);
	   if($wh != '' && is_string($wh))
	   		$this->CI->db->where($wh);
		$res = $this->CI->db->get();
		$type = $res->result_array();
		return !empty($type)?$type[0]:false;
	}
	public function get_all_record_groupby($tablename,$rows,$wh = array(),$groupBy='')
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tablename);
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);

		if($groupBy != '') {
			$this->CI->db->group_by($groupBy);
		}
		$res = $this->CI->db->get();
		$result = $res->result_array();
		return $result;
	}
	public function get_all_record_with_limit_like($tablename,$by, $order = 'DESC',$limit=array(),$wh = array(),$rows="*",$keywords='',$field_array=array())
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tablename);
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);
		/*if($limit != '')
			$this->CI->db->limit($limit);*/
		if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
            $this->CI->db->limit($limit['limit'],$limit['start']);
        }elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
            $this->CI->db->limit($limit['limit']);
        }
		$this->CI->db->order_by($by,$order);
		if($keywords != '') {
			$this->CI->db->group_start();
			if(isset($field_array) && !empty($field_array)) {
				foreach ($field_array as $key => $field) {
					$this->CI->db->or_like($field,$keywords);
				}
			}
			$this->CI->db->group_end();
		}
		$res = $this->CI->db->get();
		$res = $res->result_array();
		return !empty($res)?$res:array();
	}

	public function get_all_record_with_limit($tablename,$by, $order = 'DESC',$limit=array(),$wh = array(),$rows="*")
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tablename);
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);
		/*if($limit != '')
			$this->CI->db->limit($limit);*/
		if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
            $this->CI->db->limit($limit['limit'],$limit['start']);
        }elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
            $this->CI->db->limit($limit['limit']);
        }
		$this->CI->db->order_by($by,$order);
		$res = $this->CI->db->get();
		$res = $res->result_array();
		return !empty($res)?$res:array();
	}

	// Join Data
	public function get_join_record($tables,$joins,$rows="*",$groupBy="",$order_by="",$wh = array(),$keywords='',$field_array=array())
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tables[0]);
		foreach ($joins as $key => $value) {
			$tbl = $tables[$key+1];
			// $tbl = explode(' ', $tbl)[0];
			$this->CI->db->join($tbl, $value);
		}
		if($groupBy != '') {
			$this->CI->db->group_by($groupBy);
		}
		if($order_by != "") {
 			$this->CI->db->order_by($order_by, 'desc'); 
		}
		
		if($keywords != '') {
			if(isset($field_array) && !empty($field_array)) {
				foreach ($field_array as $key => $field) {
					$this->CI->db->or_like($field,$keywords);
				}
			}
		}

		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);

		$query = $this->CI->db->get();
		// return $query->result_array();
		return $query->row_array();
	}

	public function get_join_all_record($tables,$joins,$rows="*",$groupBy="",$order_by="",$wh = array(),$keywords='',$field_array=array(),$params = array())
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tables[0]);
		foreach ($joins as $key => $value) {
			$tbl = $tables[$key+1];
			// $tbl = explode(' ', $tbl)[0];
			$this->CI->db->join($tbl, $value);
		}
		if($groupBy != '') {
			$this->CI->db->group_by($groupBy);
		}
		if($order_by != "") {
 			$this->CI->db->order_by($order_by, 'desc'); 
		}
		
		if($keywords != '') {
			if(isset($field_array) && !empty($field_array)) {
				foreach ($field_array as $key => $field) {
					if($key == 0) {
						$this->CI->db->like($field,$keywords);
					}
					else {
						$this->CI->db->or_like($field,$keywords);
					}
				}
			}
		}

		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit']);
        }

		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);

		$query = $this->CI->db->get();
		return $query->result_array();
		// return $query->row_array();
	}

	public function get_join_all_record_search($tables,$joins,$rows="*",$groupBy="",$order_by=array(),$wh = array(),$keywords='',$field_array=array(),$params = array(),$find_in_set="")
	{
		$this->CI->db->select($rows);
		$this->CI->db->from($tables[0]);
		foreach ($joins as $key => $value) {
			$tbl = $tables[$key+1];
			// $tbl = explode(' ', $tbl)[0];
			$this->CI->db->join($tbl, $value);
		}
		if($groupBy != '') {
			$this->CI->db->group_by($groupBy);
		}
		
		if(!empty($order_by)) {
			foreach ($order_by as $key => $value) {
 				$this->CI->db->order_by($key, $value); 
			}
		}
		
		if(isset($field_array) && !empty($field_array)) {
			$this->CI->db->group_start();
			foreach ($field_array as $key => $field) {
				if (!is_numeric($key)) {
					$keywords = $field;
					$field = $key;
				}
				if($key == 0) {
					$this->CI->db->like($field,$keywords);
				}
				else {
					$this->CI->db->or_like($field,$keywords);
				}
			}
			$this->CI->db->group_end();
		}
		else {
			// $this->CI->db->like($field,$keywords);
		}
		// die();

		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit']);
        }
        if($find_in_set != '') {
			$this->CI->db->where($find_in_set);
		}
		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);

		$query = $this->CI->db->get();
		return $query->result_array();
		// return $query->row_array();
	}

	public function get_all_join_record($tables,$joins,$rows="*",$groupBy="",$order_by=array(),$wh = array(),$keywords='',$field_array=array(),$params = array(),$find_in_set='')
	{
		$this->CI->db->select($rows);
		
		$joinCount = count($joins);
		$join_type = '';
		
		foreach ($joins as $key => $value) {
			if($key < $joinCount) {
				$tbl = $tables[$key];
				if($key == 0) {
					$this->CI->db->from($tbl);
					$join_type = ($value != '') ? $value : '';
				}
				else {
					$this->CI->db->join($tbl, $value, $join_type);
				}
			}
		}
		
		if($groupBy != '') {
			$this->CI->db->group_by($groupBy);
		}

		if(!empty($order_by)) {
			foreach ($order_by as $key => $value) {
				$val = ($value != '') ? $value : 'ASC';
 				$this->CI->db->order_by($key, $val); 
			}
		}

		if($find_in_set != '') {
			$this->CI->db->where($find_in_set);
		}

		/*if($keywords != '') {
			if(isset($field_array) && !empty($field_array)) {
				foreach ($field_array as $key => $field) {
					if($key == 0) {
						$this->CI->db->like($field,$keywords);
					}
					else {
						$this->CI->db->or_like($field,$keywords);
					}
				}
			}
		}*/
		if(isset($field_array) && !empty($field_array)) {
			$this->CI->db->group_start();
			foreach ($field_array as $key => $field) {
				if (!is_numeric($key)) {
					$keywords = $field;
					$field = $key;
				}
				if($key == 0) {
					$this->CI->db->like($field,$keywords);
				}
				else {
					$this->CI->db->or_like($field,$keywords);
				}
			}
			$this->CI->db->group_end();
		}
		else {
			// $this->CI->db->like($field,$keywords);
		}

		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->CI->db->limit($params['limit']);
        }

        if(array_key_exists("having",$params)){
            $this->CI->db->having($params['having']);
        }

        if(array_key_exists("where_not_in_field",$params) && array_key_exists("where_not_in_ids",$params)){
            $this->CI->db->where_not_in($params['where_not_in_field'],$params['where_not_in_ids']);
        }

        if(array_key_exists("where_in_field",$params) && array_key_exists("where_in_ids",$params)){
            $this->CI->db->where_in($params['where_in_field'],$params['where_in_ids']);
        }

		if(count($wh) > 0 && $wh != '')
			$this->CI->db->where($wh);

		$query = $this->CI->db->get();
		return $query->result_array();
	}



	public function get_all_setting($tbl,$keyname,$val)
    {
        $this->CI->db->select("*");
        $this->CI->db->from($tbl);
        $query =  $this->CI->db->get();
        $result = $query->result_array();
        $config = array();
        foreach ($result as $key => $value) {
            $config[$value[$keyname]] = $value[$val];
        }
        return $config;
    }
    public function executeSQL($sql='')
    {
    	if($sql != '')
    	{
    		$query = $this->CI->db->query($sql);
    		return $query->result_array();
    	}
    }
    /* Create Contact In Active Campgain List */
    public function createContact($contact_data = array())
    { 
    	if(!empty($contact_data))
    	{

	      $file_url = APPPATH."third_party/active-campaign-api/includes/ActiveCampaign.class.php";
	      require_once($file_url);
	      $ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);
	      
	      if (!(int)$ac->credentials_test()) {
	        //echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";exit();
	      }
	      
	      $list_id = ACTIVECAMPAIGN_LIST_ID;
	      echo "<p>Credentials valid & Working! Proceeding...</p>";exit;
	      exit;
	      /*
	      	ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	      */

	      $contact = array(
	        "email"              => $contact_data['email'],
	        "first_name"         => $contact_data['first_name'],
	        "last_name"          => $contact_data['last_name'],
	        "phone"          	 => $contact_data['phone'],
	        "p[{$list_id}]"      => $list_id,
	        "status[{$list_id}]" => 1, // "Active" status
	      );

	      $contact_sync = $ac->api("contact/sync", $contact);

	      if (!(int)$contact_sync->success) {
	        // request failed
	        log_message('error',  $contact_sync->error);
	        //echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
	        //exit();
	      }   

	        // successful request
	        $contact_id = (int)$contact_sync->subscriber_id;
	        //echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
	    	//exit;
	    }
    }
}
?>