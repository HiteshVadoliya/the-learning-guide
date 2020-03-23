<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homemodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
     
}

/* End of file Homemodel.php */
/* Location: ./application/models/Homemodel.php */