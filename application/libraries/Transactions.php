<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*include("config.php");*/
class Transactions
{
    private $CI;
    private $cc_number;
    private $cc_cvv;
    private $cc_expmonth;
    private $cc_expyear;
    private $cc_chname;
    private $api_username;
    private $api_password;
    private $cc_type;
    private $guid;
    private $siteid;
    private $ProductGroupKey;
    public $product_name;
    public $product_key;
    static $_instance;

    public static function getInstance()
    {
        if(!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->guid = 'bf9aa260-b5f0-4a3b-ba61-9bff220dfc6b';
        $this->siteid = '1004635';
        $this->ProductGroupKey = '1bd2d002-d670-41b7-beb4-70ee88a827fb';
        $this->set_product_data();
        //require_once 'config.php';
    }
    public function setCCInfo()
    {
//var_dump($_REQUEST);
        if(isset($_REQUEST['cc_number'])){
            $this->cc_number = $_REQUEST['cc_number'];
        }
        if(isset($_REQUEST['fields_expmonth'])){
            $this->cc_expmonth = $_REQUEST['fields_expmonth'];
        }
        if(isset($_REQUEST['fields_expyear'])){
            $this->cc_expyear = $_REQUEST['fields_expyear'];
        }
        if(isset($_REQUEST['cc_cvv'])){
            $this->cc_cvv = $_REQUEST['cc_cvv'];
        }
        if(isset($_REQUEST['billingFirstName']) && isset($_REQUEST['billingLastName'])){
            $this->cc_chname = $_REQUEST['billingFirstName'].' '.$_REQUEST['billingLastName'];
        }
        if(isset($this->cc_number))
        {
            if(substr($this->cc_number , 0,1)=="3"){
                $this->cc_type = "Amex";
            }
            elseif(substr($this->cc_number , 0,1)=="4"){
                $this->cc_type = "Visa";
            }
            elseif(substr($this->cc_number , 0,1)=="5"){
                $this->cc_type = "MasterCard";
            }
            elseif(substr($this->cc_number , 0,1)=="6"){
                $this->cc_type = "Discover";
            }
            else{
                $this->cc_type = "visa";
            }
        }
    }
    function getSiteInfo(){
        $this->guid = API_GUID;
        $_SESSION['siteid'] = $_SESSION['SESS_API_SITEID'];
        $siteid = $_SESSION['SESS_API_SITEID'];
        $productData        =   $_SESSION['product_detail'][$siteid];
        $product_id = $_REQUEST['product_id'];
        $this->product_key   = (isset($productData[$product_id]['product_key']))?trim($productData[$product_id]['product_key']):'';
        $this->product_name  = (isset($productData[$product_id]['product_name']))?trim($productData[$product_id]['product_name']):'';
        if($_SESSION['inprod'] != '1')
            $_SESSION['cart']['product_name'] = $this->product_name;
        $this->setCustomerInfo();
    }
    private function setCustomerInfo(){
        foreach($_REQUEST as $key=>$value)
        {
            $_SESSION['cart'][$key] = $value;
        }
        if($_REQUEST['tshipping'] && $_REQUEST['tshipping'] == 'S')
        {
            foreach($_REQUEST as $key=>$value)
            {
                if(substr($key,0,7) == 'billing' && !empty($value))
                {
                    $_SESSION['cart'][$key] = $value;
                }
            }
        }
        else
            foreach($_SESSION['cart'] as $key=>$value)
            {
                if(substr($key,0,8) == 'shipping' && !empty($value))
                {
                    $_SESSION['cart'][str_replace('shipping','billing',$key)] = $value;
                }
            }
    }
    public function runTransaction($ordertype = 'signup'){
        if($ordertype == 'signup')
        {
            $transaction = array(
                "ApiGuid"=>$this->guid,
                "SiteID"=> $_SESSION['siteid'],
                "CustomerID"=> $_SESSION['customer_id'],
                "IpAddress"=>$_SERVER['REMOTE_ADDR'],
                "BillingAddress" => array(
                    "FirstName"=>$_SESSION['cart']['billingFirstName'],
                    "LastName"=>$_SESSION['cart']['billingLastName'],
                    "Address1"=>$_SESSION['cart']['billingAddress'],
                    "Address2"=>$_SESSION['cart']['billingAddress2'],
                    "City"=>$_SESSION['cart']['billingCity'],
                    "State"=>$_SESSION['cart']['billingState'],
                    "CountryISO"=>$_SESSION['cart']['billingCountry'],
                    "ZipCode"=>$_SESSION['cart']['billingZipPostal']
                ),
                "PaymentInformation" => array(
                    "AffiliateID"=>$_SESSION['cart']['affiliate'],
                    "SubAffiliateID"=>$_SESSION['cart']['affiliate_sub'],
                    "ExpMonth"=>$this->cc_expmonth,
                    "ExpYear"=>$this->cc_expyear,
                    "CCNumber"=>$this->cc_number,
                    "NameOnCard"=>$_SESSION['cart']['billingLastName']." ".$_SESSION['cart']['billingFirstName'],
                    "CVV"=>$this->cc_cvv,
                    "ProductGroups"=>array(
                        array(
                            "ProductGroupKey"=>$this->product_key,
                            /*        "CustomProducts"=>array(
                                      array(
                                        "ProductID"=>11622,
                                        "Amount"=>3.12,
                                        "Quantity"=>1
                                      )
                                    )*/
                        )
                    )
                )
            );
            $turl = "https://crmapi.responsecrm.com/api/v1/transactions/run/signup";
        } else {
            $product_key = $_SESSION['product_detail'][$this->siteid][$_SESSION['UpsellId']]['product_key'];
            echo $product_key; exit;
            $transaction = array(
                "ApiGuid"=>$this->guid,
                //"SiteID"=> $_SESSION['siteid'],//$this->siteid
                "CustomerID"=> $_SESSION['customer_id'],
                "IpAddress"=>$_SERVER['REMOTE_ADDR'],
                "ProductGroups"=>array(
                    array("ProductGroupKey"=>$this->product_key,)
                )
            );
            $turl = "https://crmapi.responsecrm.com/api/v1/transactions/run/upsell";
        }
        $data = json_encode($transaction);
        $ch = curl_init();
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ($ch, CURLOPT_URL, $turl);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        $response = json_decode($result);
        if($response->Status == 0)
        {
            $this->response = $result;
            $this->status = $response->Status;
            $this->result = $response->Transaction->OrderInfo->ResponseText;
            $_SESSION['transaction_id'] = $response->Transaction->OrderInfo->TransactionID;
            $_SESSION['transaction_result'] = $response->Transaction->OrderInfo->ResponseText;
            $_SESSION['customer_result'] = '0';
            $_SESSION['transaction_code'] = '1';
            return $this;
        } else {
            if($response->Status == 1) $_SESSION['checkoutError'] = $response->ErrorMessage[0];
            if($response->Status == 2) $_SESSION['checkoutError'] = 'T2 - Internal Exception';
        }
        return $transaction_code;
    }
    public function getCustomerId(){
        $customer = array(
            "ApiGuid"       => $this->guid,
            "SiteID"        => $_SESSION['siteid'],
            "FirstName"=>$_SESSION['cart']['shippingFirstName'],
            "LastName"=>$_SESSION['cart']['shippingLastName'],
            "Email"=>$_SESSION['cart']['shippingEmail'],
            "Phone"=>$_SESSION['cart']['shippingPhone'],
            "Address1"=>$_SESSION['cart']['shippingAddress'],
            "Address2"=>$_SESSION['cart']['shippingAddress2'],
            "City"=>$_SESSION['cart']['shippingCity'],
            "State"=>$_SESSION['cart']['shippingState'],
            "CountryISO"=>$_SESSION['cart']['shippingCountry'],
            "ZipCode"=>$_SESSION['cart']['shippingZipPostal'],
            "IpAddress"=>$_SERVER['REMOTE_ADDR'],
            "AffiliateID"=>$_SESSION['cart']['affiliate'],
            "SubAffiliateID"=>$_SESSION['cart']['affiliate_sub']
        );
        $data = json_encode($customer);
        $ch = curl_init();
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ($ch, CURLOPT_URL, "https://crmapi.responsecrm.com/api/v1/transactions/insertcustomer");
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        $response = json_decode($result);
        //print_r($response);
        if($response->Status == 0)
        {
            $this->response = $result;
            $this->status = $response->Status;
            $_SESSION['customer_id'] = $response->CustomerID;
            $_SESSION['customer_result'] = '0';
            return $this;
        } else {
            if($response->Status == 1) echo '1 - Validation Error: Value of ApiGuid is invalid';
            if($response->Status == 2) echo '2 - Internal Exception';
            die();
        }
    }
    function getCountry()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $gi = geoip_open("GeoIP.dat", GEOIP_STANDARD);
        return geoip_country_code_by_addr($gi, $ip);
    }
    public function set_product_data()
    {
        $_SESSION['SESS_API_SITEID'] = $this->siteid;
        $_SESSION['product_detail'] = array
        (
            '1004635' => array( //test
                '1' => array('product_id' => '1','product_name' => 'Product Name 1','product_key' => 'bfb1b266-5c77-4dfe-9185-a7a601ef8e67'), //test
                '2' => array('product_id' => '2','product_name' => 'Eye Lift Serum','product_key' => '43bf33eb-8a07-43f0-a54b-663190524c88'), //test
                '3' => array('product_id' => '3','product_name' => 'Revitalizing Face Serum Night Cream','product_key' => 'c0cb1523-1ec6-4a12-8119-4e9e48c4c6fb'), //test
            )
        );
    }
    function checkCardLevel( $bin ) {
        global $mysqli;
        $query_prepare = "SELECT level FROM " . TABLE_NAME . " WHERE bin = ?";
        $stmt = $mysqli->stmt_init();
        if( ! $stmt = $mysqli->prepare( $query_prepare ) ) {
            print_r( $stmt );
            echo "Code Error " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        }
        if( ! $stmt->bind_param( 's', $bin ) ) {
            echo "Code Error " . $stmt->errno . "\n";
            echo "Error: " . $stmt->error . "\n";
            exit;
        }
        if( ! $stmt->execute() ) {
            echo "Code Error " . $stmt->errno . "\n";
            echo "Error: " . $stmt->error . "\n";
            exit;
        }
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        if( !empty( $row['level'] ))
            return strtoupper( $row['level'] );
        else
            return 'NOT DETECTED';
    }

}

