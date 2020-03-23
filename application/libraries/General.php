<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {
	public $CI;
	function __construct() {
		$this ->CI =& get_instance();
		$this ->CI->load->library('common');
		date_default_timezone_set('Australia/Adelaide');//Asia/Calcutta
	}
	function active_class($controller){
		return $this->CI->router->fetch_class() == $controller?'active':'';
	}
	public function adminauth()
	{
		$this->SetHeader();
		$controller = $this->CI->router->fetch_class();
		/*if($this->CI->session->ADMS['AId']=='' && $this->CI->session->ADMS['AId'] == null){
			$method = $this->CI->router->fetch_method()!='index'?$this->CI->router->fetch_method():'';
			$this->CI->session->set_userdata("last_page", base_url().ADMIN.$controller.'/'.$method);
			redirect(base_url(ADMIN));
		}*/
	}
	public function userauth()
	{
		$this->SetHeader();

		$controller = $this->CI->router->fetch_class();
		if($this->CI->session->USER['UId']=='' && $this->CI->session->USER['UId'] == null){
			$method = $this->CI->router->fetch_method()!='index'?$this->CI->router->fetch_method():'';
			//$this->CI->session->set_userdata("user_last_page", base_url().FRONTEND.$controller.'/'.$method);
			$this->CI->session->set_userdata("user_last_page",base_url($this->CI->uri->segment(1)));
			redirect(base_url('login'));
		}
	}
	//countroller Function
	public function processandredirect($res,$success,$error,$cname)
	{
		if($res > 0)
		{
			$this->CI->session->set_flashdata('success', $success);
			redirect(base_url($cname));
		} else {
			$this->CI->session->set_flashdata('error',$error);
			redirect(base_url($cname));
		}
	}
	public function delete_record($data)
	{
		$arr=explode(",",base64_decode($data));
		$id = $arr[0];
		$table = $arr[1];
		$columnname = $arr[2];
		$controller = $arr[3];
		$aff_row = $this->CI->common->delete_record_from_db($table,array($columnname=>$id));
		$this->processandredirect($aff_row,'Record Deleted Successfully','Record Not Deleted !!!',$controller);
	}
	public function soft_delete($data)
	{
		$arr = explode(",",base64_decode($data));
		$id = $arr[0];
		$table = $arr[1];
		$colname = $arr[2];
		$activecolname = $arr[3];
		$zeroorone = $arr[4];
		$controller = $arr[5];
		$text = $arr[6];
		$data1 = array( $activecolname =>$zeroorone );
		$aff_row = $this->CI->common->update_record($table,array($colname=>$id),$data1);
		$this->processandredirect($aff_row,$text.' Deleted Successfully !!!',$text.' Not Deleted!!!',$controller);
	}
	public function active_or_deactive($data)
	{
		$arr=explode(",",base64_decode($data));
		$id=$arr[0];
		$table=$arr[1];
		$colname=$arr[2];
		$activecolname = $arr[3];
		$zeroorone = $arr[4];
		$controller=$arr[5];
		if($zeroorone == 0)
			$res = "De Activated";
		else
			$res = "Activated";
		$data1 = array( $activecolname =>$zeroorone );
		$aff_row = $this->CI->common->update_record($table,array($colname=>$id),$data1);
		$this->processandredirect($aff_row,'Record '.$res.' Successfully !!!','Record Not '.$res.' !!!',$controller);
	}
	public function upload_file($field_name, $upload_path, $file_name, $allowed_types)
    {
    	$this->CI->load->library('upload');
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
             @chmod($upload_path,0777);
        }
        $config['file_name'] = $file_name;
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['overwrite'] = true;
        $config['remove_spaces'] = TRUE;
        
        $this->CI->upload->initialize($config);

        $FileName = "";
        if ($this->CI->upload->do_upload($field_name)) {
            $file = $this->CI->upload->data();
            $FileName = $file['file_name'];
            chmod($file['full_path'],0777);
        } else {
            $error['error'] = $this->CI->upload->display_errors();
            return $error;
        }
        return $FileName;
    }
    public function SetHeader()
    {
    	$this->CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->CI->output->set_header('Pragma: no-cache');
		$this->CI->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    public function checkext($name,$cname,$allowed = array('jpg','jpeg','png'))
    {
    	$ext = strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION));
    	if(!in_array($ext, $allowed)){
    		$this->CI->session->set_flashdata('error','You are Trying To Upload File That Are Not Allowed!!');
			redirect(base_url($cname));
    	} else {
    		return $ext;
    	}
    }
    public function createslug($string) // Product Slug BY Ravi Patel 
	{   
	  $slug = strtolower(trim(preg_replace('/-{2,}/','-',preg_replace('/[^a-zA-Z0-9-.]/', '-', $string)),"-"));
	  return $slug;
	}
	public function resize_image($path,$name,$w = '360',$h = '240',$isthumb = false,$thumbpath = '')
	{
		if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
            @chmod($path,0777);
        }
		//copy(SUBSERVICEPATH.$name, SUBSERVICEPATH.'main/'.$name);
		include_once APPPATH.'third_party/resize_image.php';
		$image = new SimpleImage(); 
		$image->load($path.$name);
		$image->resize($w,$h);
		if($isthumb){
			if (!is_dir($path.$thumbpath)) {
	            mkdir($path.$thumbpath, 0777, TRUE);
	            @chmod($path.$thumbpath,0777);
	        }
			$image->save($path.$thumbpath.$name);
		} else {
			$image->save($path.$name);	
		}
		return true;
	}

	/* Load View ADMIN */
	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{
		$sitesetting = $this->CI->common->get_all_record('tblsetting');
		
		$headerInfo['site_name'] = $sitesetting[0]['SettingValue'];
    	$headerInfo['site_logo'] = $sitesetting[3]['SettingValue'];
		$headerInfo['site_favicon'] = $sitesetting[4]['SettingValue'];
		$headerInfo['pageTitle'] = $sitesetting[0]['SettingValue'] .' '. $headerInfo['pageTitle'];

		$layout_data['topbar'] = $this->CI->load->view(ADMIN.'includes/topbar', $headerInfo, true);
        $layout_data['leftbar'] = $this->CI->load->view(ADMIN.'includes/leftbar', $headerInfo, true);
        $layout_data['rightbar'] = $this->CI->load->view(ADMIN.'includes/rightbar', $headerInfo, true);
		$layout_data['footer'] = $this->CI->load->view(ADMIN.'includes/footer','',true);
		$layout_data['content_body'] = $this->CI->load->view($viewName, $pageInfo, true);
		
		$this->CI->load->view(ADMIN.'layouts/main', $layout_data);

    }
	/* Load View ADMIN */

	/* Load View FRONT */
	function loadViewsFront($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL,$extra = NULL)
	{
		
		$sitesetting = $this->CI->common->get_all_record('tblsetting');

		$headerInfo['navTab'] = "home";
		$headerInfo['site_logo'] = $sitesetting[3]['SettingValue'];
		$headerInfo['site_favicon'] = $sitesetting[4]['SettingValue'];
        $headerInfo['pageTitle'] = $sitesetting[2]['SettingValue'] .' '. $headerInfo['pageTitle'];
	           
		$layout_data['header'] = $this->CI->load->view(FRONTEND.'include/header', $headerInfo, true);
		$layout_data['footer'] = $this->CI->load->view(FRONTEND.'include/footer',$footerInfo,true);
		$layout_data['content_body'] = $this->CI->load->view($viewName, $pageInfo, true);
		$this->CI->load->view(FRONTEND.'layouts/main', $layout_data);
    }
	/* Load View FRONT */

	public function SendSimpleMail($data)
	{
		$to = $data['to'];
		$subject = $data['subject'];
		$message = $data['message'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <admin@inkatlas.com>' . "\r\n";
		if(mail($to,$subject,$message,$headers))
			return true;
		else 
			return false;
	}
	public function EmailSend($data = array())
	{
		include_once APPPATH.'third_party/class.phpmailer.php';
		$subject	= $data['Subject'];
		$to_email = $data['ToEmail'];
		$from_mail = $data['FromEmail'];
		$from_name = $data['FromName'];
		$body = $data['Message'];
		$mail = new PHPMailer();
	
		$mail->SetFrom($from_mail,$from_name); // From email ID and from name
		$mail->AddAddress(stripslashes($to_email));
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$mail->Send();
	}
	public function getmeta($param = array())
	{
		$res = '';
		$res .= '<meta name="description" content="'.$param['description'].'" />'.PHP_EOL;
		$res .= '<meta name="keywords" content="'.$param['keywords'].'" />'.PHP_EOL;
		$res .= '<meta property="og:title" content="'.$param['title'].'" />'.PHP_EOL;
		if(array_key_exists("image",$param)){
			$res .= '<meta property="og:image" content="'.base_url($param['path']).'" />'.PHP_EOL;
		}
		return $res;
	}
	public function get_rating($res = '')
	{
		$output = '';
		for ($i = 1; $i < 6; $i++) { 
            if($i <= round($res))
                $output .= '<i class="icon-smile voted"></i>'.PHP_EOL;
            else
                $output .= '<i class="icon-smile"></i>'.PHP_EOL;
        }
        return $output;
	}
	public function get_avg($wh = array())
	{
		$this->CI->load->model('Homemodel');
		$review = $this->CI->Homemodel->selectavgreview($wh);
		if(count($review) > 0){
			$avgreview = $review[0];
			$res = (round($avgreview['avg_Position']) + round($avgreview['avg_TouristGuide']) + round($avgreview['avg_Price']) + round($avgreview['avg_Quality'])) / 4;
			return $res;
		} else { 
			return '';
		}
	}
	//Get Value Of Product
	public function converter($amount,$aedrate = '',$convert = false)//$aedrate = $1
	{
		if($aedrate == ''){
			if(isset($_SESSION['Currency']) && $_SESSION['Currency'] == 'USD'){
				$aedrate = $this->CI->common->get_one_value('tblconfig',array('ConfigKey'=>'AEDRate'),'ConfigValue');
				$amt = floatval($amount / $aedrate);
				//$amt = round($amt);//number_format(round($amt, 2),2);
				$amt = round($amt, 2);//number_format(round($amt, 2),2);
				return CURRENCYUS.''.$amt;
			} else {
				return CURRENCY.' '.$amount;
			}
		} else {
			if($convert){
				$amt = floatval($amount / $aedrate);
				$amt = round($amt, 2);//number_format(round($amt, 2),2);
				return CURRENCYUS.''.$amt;
			} else {
				return CURRENCY.' '.$amount;
			}
		}
	}
	public function getamount($amount)
	{
		$aedrate = $this->CI->common->get_one_value('tblconfig',array('ConfigKey'=>'AEDRate'),'ConfigValue');
		$amt = floatval($amount / $aedrate);
		//$amt = round($amt);//number_format(round($amt, 2),2);
		$amt = round($amt, 2);//number_format(round($amt, 2),2);
		return $amt;
	}

	public function checkProfanity($text)
	{
		$filterWords = array("nigga","nigger","niggers","sandnigger","sandniggers","sandniggas","sandnigga","honky","honkies","chink","chinks","gook","gooks","wetback","wetbacks","spick","spik","spicks","spiks","bitch","bitches","bitchy","bitching","cunt","cunts","twat","twats","fag","fags","faggot","faggots","faggit","faggits","ass","asses","asshole","assholes","shit","shits","shitty","shity","dick","dicks","pussy","pussies","pussys","fuck","sex","fucks","fucker","fucka","fuckers","fuckas","fucking","fuckin","fucked","motherfucker","motherfuckers","motherfucking","motherfuckin","mothafucker","mothafucka","motherfucka");

		$new = array("****", "*******");
		$string1 = str_ireplace($filterWords, $new, $text);
		$left = preg_replace("/[\* ]+/", "", $string1);
		if($text == $string1) {
			return true;
		}
		else {
			return false;
		}
	}
}
?>