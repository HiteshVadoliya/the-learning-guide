<?php

class Bulleting_model extends CI_Model 
{
    function __construct() {
        parent::__construct(); 
        
    }

    
             
    function BulletinListing($searchText = '',$context = '',$sort_by = '',$popularity = '', $page, $segment,$category = array())
    {   

        $this->db->select('b.*,MD5(b.id) as md5id,COUNT(l.id) AS total_like,s.name as school_name, md5(s.id) as school_id, md5(t.id) as teacher_id, CONCAT(t.fname," ",t.lname) as teacher_name,l.user_id as uid');
        $this->db->from('tbl_bulletin as b');
        $this->db->join("like AS l","l.bulletin_id=b.id",'left');
        $this->db->join("tbl_school AS s","b.schoolId=s.id",'left');
        $this->db->join("tbl_teacher AS t","b.teacherId=t.id",'left');
        $searchText = trim($searchText);
        if(!empty($searchText)) {
            $this->db->group_start();
            // $this->db->like('b.title',$searchText);
            $this->db->or_like('b.title',$searchText)->or_like('b.description',$searchText)->or_like('b.keyword_tags',$searchText);
            $this->db->group_end();
        }
        
        if(!empty($category)){
            
            //$category = explode(',', $category);
            
            $this->db->group_start();
            foreach ($category as $key => $value) {
                
                $this->db->or_where('FIND_IN_SET("'.$value.'", s.type)');
                
            }
            $this->db->group_end();
        }

        if(!empty($popularity)) {
            
            $po_arr = explode('_', $popularity);            
            $this->db->order_by('total_like',$po_arr[1]); 
            
        }
        
        $this->db->where('b.status','1'); 
        $this->db->where('b.isDelete','0'); 
        if(!empty($context)) {
            $this->db->group_start();
            $this->db->where('b.type',$context); 
            $this->db->or_where('b.type',3); 
            $this->db->group_end();
        }
        else {
            //$this->db->or_where('b.type',3); 
        }
        $this->db->group_by('b.id'); 
        if(!empty($sort_by)) {
            $this->db->order_by('b.id',$sort_by); 
        }
        $this->db->order_by('b.id',"DESC"); 
        /*$this->db->order_by('b.created_date',"DESC"); 
        $this->db->order_by('b.updated_date',"DESC"); */
        $this->db->limit($page, $segment);    
        $query = $this->db->get();
        //echo $query = $this->db->last_query();
        $result = $query->result();    
        return $result;
    }
    function BulletinListingCount($searchText = '',$context = '',$sort_by = '',$popularity = '',$category = array())
    {   

        $this->db->select('b.*,MD5(b.id) as md5id,COUNT(l.id) AS total_like,s.name as school_name, md5(s.id) as school_id, md5(t.id) as teacher_id, CONCAT(t.fname," ",t.lname) as teacher_name,l.user_id as uid');
        $this->db->from('tbl_bulletin as b');
        $this->db->join("like AS l","l.bulletin_id=b.id",'left');
        $this->db->join("tbl_school AS s","b.schoolId=s.id",'left');
        $this->db->join("tbl_teacher AS t","b.teacherId=t.id",'left');
        $searchText = trim($searchText);
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->like('b.title',$searchText)->or_like('b.description',$searchText)->or_like('b.keyword_tags',$searchText);
            $this->db->group_end();
        }
        
        if(!empty($category)){
            
            //$category = explode(',', $category);
            
            $this->db->group_start();
            foreach ($category as $key => $value) {
                
                $this->db->or_where('FIND_IN_SET("'.$value.'", s.type)');
                
            }
            $this->db->group_end();
        }

        if(!empty($popularity)) {
            
            $po_arr = explode('_', $popularity);            
            $this->db->order_by('total_like',$po_arr[1]); 
            
        }
        
        $this->db->where('b.status','1'); 
        $this->db->where('b.isDelete','0'); 
        if(!empty($context)) {
            $this->db->where('b.type',$context); 
            $this->db->or_where('b.type',3); 
        }
        else {
            $this->db->or_where('b.type',3); 
        }
        $this->db->group_by('b.id'); 
        if(!empty($sort_by)) {
            $this->db->order_by('b.id',$sort_by); 
        }
            $this->db->order_by('b.id',"DESC"); 
        //$this->db->limit($page, $segment);    
        
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;

    }
    function BulletinListingCount1($searchText,$context = '',$sort_by = '',$popularity = '',$category = array())
    {
        
        $this->db->select('b.*');
        $this->db->from('tbl_bulletin as b');
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->like('b.title',$searchText)->or_like('b.description',$searchText);
            $this->db->group_end();
        }
        /*if(!empty($category)){
            $this->db->where_in('b.content', $category);
        } */ 
        if(!empty($sort_by)) {
            $this->db->where('b.created_date',$sort_by); 
        }
        $this->db->where('b.status','1');  
        $this->db->where('b.isDelete','0');   
        if($context == '') {
            $this->db->or_where('b.type',3); 
        }
        else {
            $this->db->where('b.type',$context); 
            $this->db->or_where('b.type',3); 
        }
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }






}