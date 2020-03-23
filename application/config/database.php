<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

if($_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "pc-01" || $_SERVER["HTTP_HOST"] == "192.168.1.100" || $_SERVER["HTTP_HOST"] == "10.0.0.100" || $_SERVER["HTTP_HOST"] == "10.0.0.102") 
{
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "the_learning_guide";

}else{

	$hostname = "localhost";
	$username = "bhimanic_screv";
	$password = "Test#123";
	$dbname = "bhimanic_school-review";

}

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $hostname,
	/*'username' => 'funnelad_silver',
	'password' => 'User@123!',
	'database' => 'funnelad_darksilverware',*/
	'username' => $username,
	'password' => $password,
	'database' => $dbname,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
