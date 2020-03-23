<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apiltest extends CI_Controller
{
    private $key = '';
    //public $url = 'https://emanage-prod-websales-api.azurewebsites.net/api/';//production
    public $url = 'https://emanage-sandbox-websales-api.azurewebsites.net/api/';//sandbox
    //public $url = 'https://emanage-dmt-websales-api.azurewebsites.net/api/';
    public $curlConnectTimeout = 20;

    public $curlTimeout = 20;

    public function __construct()
    {
        $this->key = 'dc7d2289-101a-41fd-b6d4-63bb3cb6c78f';
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
        /*curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);*/
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
        echo json_encode($data);
        echo $Response;
        $response = json_decode($Response, true);
        echo '<br> <pre>'; print_r($response); exit;
        return $response;
    }
}