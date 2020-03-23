<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('site_logo'))
{
	function getSiteSetting($setKey=''){
		if($setKey != '')
		{
			$CI =& get_instance();
			$where = array("SettingKey"=>$setKey);
			$row = $CI->common->get_one_row("tblsetting",$where);
			if($row)
			{
				return $row['SettingValue'];
			}
			else
			{
				return false;
			}
		}
		
	}
}

if ( ! function_exists('getConfigValue'))
{
	function getConfigValue($configKey=''){
		if($configKey != '')
		{
			$CI =& get_instance();
			$where = array("ConfigKey"=>$configKey);
			$row = $CI->common->get_one_row("tblconfig",$where);
			if($row)
			{
				return $row['ConfigValue'];
			}
			else
			{
				return false;
			}
		}
		
	}
}

if ( ! function_exists('createOptions')){
	function createOptions($key_values = array(),$caption = "Value",$selected_key = null){
		$options  = '<option value=""> Select '.$caption.' </option>';
		if(!empty($key_values))
		{
			foreach ($key_values as $key => $value) {
				if($selected_key == $key)
				{
					$options .= '<option value="'.$key.'" selected>'.$value.'</option>';
				}
				else
				{
					$options .= '<option value="'.$key.'">'.$value.'</option>';
				}
			}
		}
		return $options;

	}
}

if ( ! function_exists('setFlashMessage')){
	function setFlashMessage($message='',$message_type='danger',$key='errorMessage'){
		$CI =& get_instance();
		if($message != '')
		{
			$html = '<div class="alert alert-'.$message_type.'" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>';
			$html .= $message;
			$html .= '</div>';
			$CI->session->set_flashdata($key,$html);
		}
	}
}

if ( ! function_exists('getFlashMessage')){
	function getFlashMessage($key='errorMessage'){
		$CI =& get_instance();
		if($CI->session->flashdata($key))
		{
			echo $CI->session->flashdata($key);
		}
		else
		{
			return null;
		}
	}
}

?>