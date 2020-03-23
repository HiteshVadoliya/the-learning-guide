<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imageupload {
	function __construct() {
        global $CI;
		$CI =& get_instance();
        $CI->load->library('upload');
	}
    function multipleimageupload($field_name, $upload_path, $allowed_types)
    {
        global $CI;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
             @chmod($upload_path,0777);
        }
        $filesCount = count($_FILES[$field_name]['name']);
        for($i = 0; $i < $filesCount; $i++){
            $ext = pathinfo($_FILES[$field_name]['name'][$i], PATHINFO_EXTENSION);
            $next = sprintf("%04d", $i);
            $file_name = time() .$next."_".rand().'.'.$ext;
            $_FILES['userFile']['name'] = $_FILES[$field_name]['name'][$i];
            $_FILES['userFile']['type'] = $_FILES[$field_name]['type'][$i];
            $_FILES['userFile']['tmp_name'] = $_FILES[$field_name]['tmp_name'][$i];
            $_FILES['userFile']['error'] = $_FILES[$field_name]['error'][$i];
            $_FILES['userFile']['size'] = $_FILES[$field_name]['size'][$i];

            $config['file_name'] = $file_name;
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = $allowed_types;
            $config['overwrite'] = true;
            $config['remove_spaces'] = TRUE;
            $CI->upload->initialize($config);
            if($CI->upload->do_upload('userFile')){
                $fileData = $CI->upload->data();
                $uploadData[$i]['ImagePath'] = $fileData['file_name'];
                $res = $this->resize_image($upload_path,$fileData['file_name'], $upload_path.'/Thumb', '147', '215');
            }else {
                $error = $CI->upload->display_errors();
                return $error;
            }
        }
        return $uploadData;
    }
    public function resize_image($sourcePath,$filename, $desPath, $width = '600', $height = '600')
    {
        global $CI;
        if (!is_dir($desPath)) {
            mkdir($desPath, 0777, TRUE);
             @chmod($desPath,0777);
        }
        $CI->load->library('image_lib');
        $CI->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath."/".$filename;
        $config['new_image'] = $desPath;
        $config['quality'] = '70%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = true;
        $config['thumb_marker'] = '';
        $config['width'] = $width;
        $config['height'] = $height;
        $CI->image_lib->initialize($config);
        if ($CI->image_lib->resize()){
            return true;
        }else{
            
        return false;
      }
    }
}