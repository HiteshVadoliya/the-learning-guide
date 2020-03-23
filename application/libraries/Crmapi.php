<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crmapi extends CI_Controller
{
    private $key = '';
    public $url = 'https://crmapi.responsecrm.com/api/v1/open/';

    //const USER_AGENT = 'Printful PHP API SDK 2.0';

    public $curlConnectTimeout = 20;

    public $curlTimeout = 20;

    public function __construct()
    {
        $this->key = 'bf9aa260-b5f0-4a3b-ba61-9bff220dfc6b';
        //282d1acb-0ff7-1111-1111-88980c028eaf
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
    private function request($method, $path, array $params = [], $data = null)
    {
        $url = trim($path, '/');

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        echo $method."  ".$this->url .$url.'<br>';
        //exit;
        $curl = curl_init($this->url . $url);

        //curl_setopt($curl, CURLOPT_USERPWD, $this->key);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        /*curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);*/
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->curlConnectTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->curlTimeout);
        //curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        //echo '<pre>'; print_r(json_encode($data));
        //echo '<br>'; //exit;
        //print_r($data); 
        $Response = curl_exec($curl);
        $errorNumber = curl_errno($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($errorNumber) {
            die('CURL: ' . $error.' '.$errorNumber);
        }

        $response = json_decode($Response, true);

        if (!isset($response['Status'])) {
           die('Invalid API response');
        }
        return $response;
    }
}