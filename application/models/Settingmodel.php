<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settingmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function batch_update($tbl,$key,$data)
    {
        try
        {
            $this->db->update_batch($tbl, $data, $key);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    function get_all($tbl,$keyname,$val)
    {
        $query = $this->db->select("*")
                      ->from($tbl)
                      ->get();
        $result = $query->result_array();
        $config = array();
        foreach ($result as $key => $value) {
            $config[$value[$keyname]] = $value[$val];
        }
        return $config;
    }
    function get_one_value($tbl,$wh = array(),$val)
    {
        $query = $this->db->select("*")
                      ->from($tbl) 
                      ->where($wh)
                      ->get();
        $result = $query -> result_array();
        return $result[0][$val];
    }
}