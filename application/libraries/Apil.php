<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apil
{
    private $key = '';
    //public $url = 'https://emanage-prod-websales-api.azurewebsites.net/api/';//production
    //public $url = 'https://emanage-sandbox-websales-api.azurewebsites.net/api/';//sandbox
    public $url = 'https://emanage-dmt-websales-api.azurewebsites.net/api/';
    public $curlConnectTimeout = 200;
    public $curlTimeout = 200;
    private $card_number;
    private $card_cvv;
    private $cc_expmonth;
    private $cc_expyear;
    private $cc_chname;
    private $cc_type;
    public  $webkey;

    public function __construct()
    {
        date_default_timezone_set('Australia/Adelaide');
        $this->webkey = 'd78d789a-cfd1-4025-bd67-059a8739a06e'; // Dark Silverware Key
        $this->webkey_upsell = 'a35be90e-0647-4a36-b95a-00cf69d2051c'; // 
        $this->webkey_downsell = 'c4a9c96c-5eba-4b5f-b516-8d489c6bb99d'; // 
        require_once 'config.php';

    }
    public function get($path, $params = [])
    {
        return $this->request('GET', $path, $params);
    }

    public function delete($path, $params = [])
    {
        return $this->request('DELETE', $path, $params);
    }

    public function post($path, $data = [], $params = [])
    {
        return $this->request('POST', $path, $params, $data);
    }

    public function put($path, $data = [], $params = [])
    {
        return $this->request('PUT', $path, $params, $data);
    }
    public function set_transaction_info()
    {
        if(isset($_REQUEST['card_number'])){
            $this->card_number = $_REQUEST['card_number'];
        }
        if(isset($_REQUEST['card_month'])){
            $this->cc_expmonth = $_REQUEST['card_month'];
        }
        if(isset($_REQUEST['card_year'])){
            $this->cc_expyear = $_REQUEST['card_year'];
        }
        if(isset($_REQUEST['card_cvv'])){
            $this->card_cvv = $_REQUEST['card_cvv'];
        }
        if(isset($_REQUEST['first_name']) && isset($_REQUEST['last_name'])){
            $this->cc_chname = $_REQUEST['first_name'].' '.$_REQUEST['last_name'];
        }
        if(isset($this->card_number))
        {
            if(substr($this->card_number , 0,1)=="3"){
                $this->cc_type = "Amex";
            }
            elseif(substr($this->card_number , 0,1)=="4"){
                $this->cc_type = "Visa";
            }
            elseif(substr($this->card_number , 0,1)=="5"){
                $this->cc_type = "MasterCard";
            }
            elseif(substr($this->card_number , 0,1)=="6"){
                $this->cc_type = "Discover";
            }
            else{
                $this->cc_type = "Visa";
            }
            $_REQUEST['cc_type'] = $this->cc_type;
        }

    }
    public function set_customer_info(){

        foreach($_REQUEST as $key=>$value)
        {
            $_SESSION['cart'][$key] = $value;
        }
        if($_REQUEST['sameasshipping'] && $_REQUEST['sameasshipping'] == 'N')
        {
            foreach($_REQUEST as $key=>$value)
            {
                if(substr($key,0,4) == 'bill' && !empty($value))
                {
                    $_SESSION['cart'][$key] = $value;
                }
            }
        }
        else
        {
            foreach($_SESSION['cart'] as $key=>$value)
            {
                if(substr($key,0,4) == 'ship' && !empty($value))
                {
                    $_SESSION['cart'][str_replace('ship','bill',$key)] = $value;
                }
            }
        }            
    }
   
    public function createOrder($APIKEY="default",$isminiupsell = false , $miniupsell = array())
    {
        if($APIKEY=="default")
        {
            $api_key = $this->webkey;
        }
        else
        {
            $api_key = $APIKEY;
        }

        $month_year = $_SESSION['cart']['card_month'].'/'.$_SESSION['cart']['card_year'];
        $sameshipping = ($_SESSION['cart']['sameasshipping'] == "Y") ? true : false ;

        $referringUrl = $_REQUEST['referringUrl'];
        $screenResolution = $_REQUEST['screenResolution'];
        $landingUrl = $_REQUEST['landingUrl'];
        $OS = $_REQUEST['OS'];
        $device = $_REQUEST['device'];
        $browser = $_REQUEST['browser'];
        
        $analytics = array('referringUrl' => $referringUrl, 'screenResolution' => $screenResolution, 'landingUrl' => $landingUrl, 'OS' => $OS, 'device' => $device, 'browser' => $browser);

        $data = array("useShippingAddressForBilling"=> $sameshipping,
          "productId"=> $_REQUEST['product_id'],
          "customer"=> array(
            "email"=> $_SESSION['cart']['email']
          ),
          "payment"=> array(
            "name"=> $_SESSION['cart']['first_name'].' '.$_SESSION['cart']['last_name'],
            "creditCard"=> $_SESSION['cart']['card_number'],
            "expiration"=> $month_year,
            "cvv"=> $_SESSION['cart']['card_cvv'],
            "creditCardBrand"=> $_SESSION['cart']['cc_type'],
            "cardId"=> ""
          ),
          // "couponCode"=> "$1OFFEACH",
          "shippingMethodId"=> $_REQUEST['shippingMethodId'],
          "comment"=> '',
 
          "shippingAddress"=> array(
            "firstName"=> $_SESSION['cart']['first_name'],
            "middleName"=> '',
            "lastName"=> $_SESSION['cart']['last_name'],
            "address1"=> $_SESSION['cart']['ship_address'],
            "address2"=> "",
            "city"=> $_SESSION['cart']['ship_city'],
            "zipCode"=> $_SESSION['cart']['ship_zipcode'],
            "state"=> $_SESSION['cart']['ship_state'],
            "countryCode"=> $_SESSION['cart']['ship_country'],
            "phoneNumber"=> $_SESSION['cart']['phone'],
          ),
          "billingAddress"=> array(
            
            "firstName"=> $_SESSION['cart']['first_name'],
            "middleName"=> '',
            "lastName"=> $_SESSION['cart']['last_name'],
            "address1"=> $_SESSION['cart']['bill_address'],
            "address2"=> "",
            "city"=> $_SESSION['cart']['bill_city'],
            "zipCode"=> $_SESSION['cart']['bill_zipcode'],
            "state"=> $_SESSION['cart']['bill_state'],
            "countryCode"=> $_SESSION['cart']['bill_country'],
            "phoneNumber"=> $_SESSION['cart']['phone'],
          ),
          "analytics" => $analytics
        );
        if(isset($_SESSION['ExitDiscount']['CRMCODE']) && $_SESSION['ExitDiscount']['CRMCODE'] != '' && $_REQUEST['product_id'] != '137'){
                $data['couponCode'] = $_SESSION['ExitDiscount']['CRMCODE'];
        }
        if($isminiupsell){
            $data['miniUpsell'] = $miniupsell; //array("productId"=> $upsell['productId'], "shippingMethodId"=> $upsell['shippingMethodId']);    
        }
        //echo json_encode($data);
        //print_r($data);
        //exit;
        //echo $api_key;echo "<br>";
        $res = $this->post('orders/'.$api_key,$data);
        $result = array();
        if(isset($res['success'])){  /*  Test Mode For Payment */
        //if(isset($res['success']) && $res['success'] != ''){  /*  Live Mode For Payment */
            $_SESSION['transaction'] = true;
            $_SESSION['message'] = $res['message'];
            if($_REQUEST['product_id'] != '137') //order bump
                $_SESSION['orderNumber'] = $res['orderNumber'];
            else
                $_SESSION['orderNumber-bump'] = $res['orderNumber'];
            $_SESSION['cardId'] = $res['cardId'];
            $_SESSION['shippingAddressId'] = ($res['customerResult']['shippingAddressId'] != '')?$res['customerResult']['shippingAddressId']:NULL;
            $_SESSION['billingAddressId'] = ($res['customerResult']['billingAddressId'] != '')?$res['customerResult']['billingAddressId']:NULL;
            $_SESSION['customerId'] = $res['customerResult']['customerId'];
            $result = array('status'=>true,'message'=>$_SESSION['message'],'orderNumber'=>$_SESSION['orderNumber'],'cardId'=>$_SESSION['cardId'],'shippingAddressId'=>$_SESSION['shippingAddressId'],'billingAddressId'=>$_SESSION['billingAddressId'],'customerId'=>$_SESSION['customerId']);
        } else {
            $_SESSION['checkoutError'] = $res['message'];
            $_SESSION['transaction'] = false;
            $result = array('status'=>false);
            $message = $res['message'];
            if(isset($res['modelState']['model.ShippingAddress.CountryCode'])){
                $message .= ', '.$res['modelState']['model.ShippingAddress.CountryCode'][0];
            }
            if(isset($res['modelState']['model.BillingAddress.CountryCode'])){
                $message .= ' Or '.$res['modelState']['model.BillingAddress.CountryCode'][0];
            }
            $result['message'] = $message;
        }
        $result['response'] = $res; 
        return $result;
    }
    public function createOrderUpsell($orderNumber)
    {
        $up_res = $this->post('orders/upsell/'.$orderNumber);
        return $up_res;
    }
    public function getUpsellsKeys(){
        $response = $this->get('campaigns/'.$this->webkey.'/upsells');
        return $response;
    }
    private function request($method, $path, array $params = [], $data = null)
    {
        $url = trim($path, '/');

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        //echo $method."  ".$this->url .$url.'<br>';exit;
        $curl = curl_init($this->url . $url);
        //print_r($this->url . $url); exit;
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        if ($data !== null) {
            //echo '<pre>'; print_r($data); exit;
            $headers[] = 'Content-Length: ' . strlen(json_encode($data));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //curl_setopt($curl, CURLOPT_USERPWD, $this->key);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->curlConnectTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->curlTimeout);
        //curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } 
        $Response = curl_exec($curl);
        $errorNumber = curl_errno($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($errorNumber) {
            die('CURL: ' . $error.' '.$errorNumber);
        }
        //echo $Response;exit;
        $response = json_decode($Response, true);
        //echo '<br> <pre>'; print_r($response); exit;
        return $response;
    }
}