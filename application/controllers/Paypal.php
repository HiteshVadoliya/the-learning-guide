<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
     function  __construct(){
        parent::__construct();
        $this->load->library('paypal_lib');
        //$this->load->model('product');
     }
     
    function success(){
        
        /*$data = $_REQUEST;

        $json_data = json_encode($data);
        $where = array('id'=>$this->session->userdata('checkout_id'));
        $this->common->update_record('tbl_checkout',$where,array('paypal_result'=>$json_data));
        
        $array_items = array('checkout_id'=>'');
        $this->session->unset_userdata($array_items);
        
        $paypalInfo = $_REQUEST;
        
        $data['item_number'] = $paypalInfo['item_number1']; 
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_amt'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['status'] = $paypalInfo["payment_status"];*/

        $paypalInfo = array('payer_email' => 'ghiadeep-buyer@gmail.com','payer_id' => '7BGH5L7MYVYVQ','payer_status' => 'VERIFIED','first_name' => 'test','last_name' => 'buyer','address_name' => 'test buyer','address_street' => 'Flat no. 507 Wing A Raheja Residency','address_city' => 'Mumbai','address_state' => 'Maharashtra','address_country_code' => 'IN','address_zip' => '400097','residence_country' => 'IN','txn_id' => '9Y886146FS9205601','mc_currency' => 'USD','mc_fee' => '2.06','mc_gross' => '45.00','protection_eligibility' => 'ELIGIBLE','payment_fee' => '2.06','payment_gross' => '45.00','payment_status' => 'Completed','payment_type' => 'instant','item_name' => 'Standard Product','item_number' => '123456','quantity' => '1','txn_type' => 'web_accept','payment_date' => '2018-07-24T10:20:23Z','business' => 'crazycoder08@gmail.com','receiver_id' => 'KZMPRZUAP75H2','notify_version' => 'UNVERSIONED','custom' => '1','verify_sign' => 'AfcZZffkhOLgGAktBDWZJdpsk80dAQj017hedtQpqYQzCTyjORPxaElv','ci_session' => '65p5k1k5m8ifol7o7m2cnuidim8tjaqv');

        $data['item_number'] = $paypalInfo['item_number']; 
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_amt'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['status'] = $paypalInfo["payment_status"];
        
        // Pass the transaction data to view

        $this->common->views('paypal/success',$data);
        /*$this->load->view(FRONTEND.'include/header');
        $this->load->view(FRONTEND.'paypal/success', $data);
        $this->load->view(FRONTEND.'include/footer');*/
    }
     
     function cancel(){
        // Load payment failed view
        $data = array();
        $this->common->views('paypal/cancel',$data);
     }
     
    public function ipn(){
        // Paypal return transaction details array
        $paypalInfo = $this->input->post();

        /*$data1 = json_encode($paypalInfo);
        $my_file = 'file.txt';
        $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
        $data = $data1.'\n\n\n';
        fwrite($handle, $data);*/

        /*$paypalInfo = array('mc_gross' => '204.96','protection_eligibility' => 'Eligible','address_status' => 'confirmed','item_number1' => '1','item_number2' => '2','payer_id' => '7BGH5L7MYVYVQ','address_street' => 'Flat no. 507 Wing A Raheja Residency Film City Road, Goregaon East','payment_date' => '05:02:49 Jul 25, 2018 PDT','payment_status' => 'Completed','charset' => 'windows-1252','address_zip' => '400097','first_name' => 'test','mc_fee' => '8.29','address_country_code' => 'IN','address_name' => 'test buyer','notify_version' => '3.9','custom' => '1','payer_status' => 'verified','business' => 'crazycoder08@gmail.com','address_country' => 'India','num_cart_items' => '2','address_city' => 'Mumbai','verify_sign' => 'ALxGJYdzDSvPgFHgC84ph2vBgxZUADenlC.URKpDyfo4yg5P3x2CUNfw','payer_email' => 'ghiadeep-buyer@gmail.com','txn_id' => '935823910L234103R','payment_type' => 'instant','last_name' => 'buyer','address_state' => 'Maharashtra','item_name1' => 'Standard Product Photos Page','receiver_email' => 'crazycoder08@gmail.com','item_name2' => 'Standard Product Photos Page','payment_fee' => '8.29','quantity1' => '1','quantity2' => '1','receiver_id' => 'KZMPRZUAP75H2','txn_type' => 'cart','mc_gross_1' => '109.98','mc_currency' => 'USD','mc_gross_2' => '94.98','residence_country' => 'IN','test_ipn' => '1','transaction_subject' => '','payment_gross' => '204.96','ipn_track_id' => 'a614f8e58fe36');*/

        /*{"mc_gross":"2.00","protection_eligibility":"Eligible","address_status":"confirmed","item_number1":"1","payer_id":"AD42F4SA6SKYG","address_street":"1 Main St","payment_date":"03:19:54 Mar 14, 2019 PDT","payment_status":"Completed","charset":"windows-1252","address_zip":"95131","first_name":"Misal","mc_fee":"0.45","address_country_code":"US","address_name":"Misal Bhimani","notify_version":"3.9","custom":"1","payer_status":"verified","business":"misalbhimani1991-facilitator@gmail.com","address_country":"United States","num_cart_items":"1","address_city":"San Jose","verify_sign":"AKijrNsJfD3TLSAXAu4OTD8pUQLUAimJqIrfmt2u8wVdl1cC7GGTXxOt","payer_email":"misalbhimani1991.buyer@gmail.com","txn_id":"05C54433R6636580G","payment_type":"instant","last_name":"Bhimani","item_name1":"Test2 Event","address_state":"CA","receiver_email":"misalbhimani1991-facilitator@gmail.com","payment_fee":"0.45","shipping_discount":"0.00","quantity1":"1","insurance_amount":"0.00","receiver_id":"PRSSVGVNDVSZA","txn_type":"cart","discount":"0.00","mc_gross_1":"2.00","mc_currency":"USD","residence_country":"US","test_ipn":"1","shipping_method":"Default","transaction_subject":"","payment_gross":"2.00","ipn_track_id":"e11cc43561351"};*/


       /* $paypalInfo =  array (
          'mc_gross' => '2.00',
          'protection_eligibility' => 'Eligible',
          'address_status' => 'confirmed',
          'item_number1' => '1',
          'payer_id' => 'AD42F4SA6SKYG',
          'address_street' => '1 Main St',
          'payment_date' => '03:42:37 Mar 14, 2019 PDT',
          'payment_status' => 'Completed',
          'charset' => 'windows-1252',
          'address_zip' => '95131',
          'first_name' => 'Misal',
          'mc_fee' => '0.45',
          'address_country_code' => 'US',
          'address_name' => 'Misal Bhimani',
          'notify_version' => '3.9',
          'custom' => 'uid=1&event_id=8',
          'payer_status' => 'verified',
          'business' => 'misalbhimani1991-facilitator@gmail.com',
          'address_country' => 'United States',
          'num_cart_items' => '1',
          'address_city' => 'San Jose',
          'verify_sign' => 'AMHWvEJ0MTzk0G5zLN9Q9xOuAdLqAQGC2GNEGVxYVgZbFmr1Ye5nZG.6',
          'payer_email' => 'misalbhimani1991.buyer@gmail.com',
          'txn_id' => '64F72873FY454325X',
          'payment_type' => 'instant',
          'last_name' => 'Bhimani',
          'item_name1' => 'Test2 Event',
          'address_state' => 'CA',
          'receiver_email' => 'misalbhimani1991-facilitator@gmail.com',
          'payment_fee' => '0.45',
          'shipping_discount' => '0.00',
          'quantity1' => '1',
          'insurance_amount' => '0.00',
          'receiver_id' => 'PRSSVGVNDVSZA',
          'txn_type' => 'cart',
          'discount' => '0.00',
          'mc_gross_1' => '2.00',
          'mc_currency' => 'USD',
          'residence_country' => 'US',
          'test_ipn' => '1',
          'shipping_method' => 'Default',
          'transaction_subject' => '',
          'payment_gross' => '2.00',
          'ipn_track_id' => '8001b493b6098',
        );
        */
        
        $custom = $paypalInfo["custom"];

        $arr = explode('&', $custom);
        $user_id = explode("=", $arr[0]);
        $user_id = $user_id[1];

        $event_id = explode("=", $arr[1]);
        $event_id = $event_id[1];

        /* user data */
        $wh = array('id'=>$user_id);
        $user_data = $this->common->get_one_row('tbluser',$wh);
        $email = $user_data['email'];
        $user_name = $user_data['fname']." ".$user_data['lname'];
        /* user data */

        $name = ucfirst($paypalInfo["first_name"]).' '. ucfirst($paypalInfo["last_name"]); 
        $receiver_email = $paypalInfo["receiver_email"];        
        
        $array['user_id']           = $user_id;
        $array['event_id']          = $event_id;
        $array['payment_method']    = 'Paypal';
        $array['txn_id']            = $paypalInfo["txn_id"];
        $array['payment_amt']       = $paypalInfo["payment_gross"];
        $array['currency_code']     = $paypalInfo["mc_currency"];
        $array['payer_email']       = $paypalInfo["payer_email"];
        $array['payment_status']    = $paypalInfo["payment_status"];

        $insert = $this->common->insert_record('transaction_event',$array);


        $edata['name'] = $user_name;
        $edata['paypal'] = $paypalInfo;
        $email_body = $this->load->view(FRONTEND.'email/event_payment', $edata, TRUE);
        $mailbody = array('ToEmail'=>$email,'FromName'=>FROMNAME,'FromEmail'=> FROMMAIL,'Subject'=>'Event payment successfully','Message'=>$email_body);
        $this->general->EmailSend($mailbody);
        /*echo $this->db->last_query();
        die();*/
    
    }
}