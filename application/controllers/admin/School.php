<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Ajax_pagination');
        $this->perPage = 1;
	}

	public function index()
	{
		$this->general->adminauth();
		$data = array();
		$this->global['pageTitle'] = ' | Manage School';
        $this->global['ActiveMenu'] = 'Manage School';
        $this->general->loadViews(ADMIN."school/manage_school", $this->global, $data, NULL);
	}

	public function ajax_school()
	{
        $conditions = array();
        $page = $this->input->post('page');
        $perpage = $this->input->post('perpage');
        $this->perPage = $perpage;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        $wh = array();
        $field_array = array();
        $keywords = $this->input->post('keywords');
        
        if(!empty($keywords)){
            if($keywords == "sponsored") {
                $wh['is_sponsored'] = "1";
                $keywords = '';
            } else {
                $conditions['search']['keywords'] = $keywords;
                $field_array = array("name","principal");
            }
        }
       
        $wh['isDelete'] = 0;
        $wh['approval !=']=1;

        
        $data = array();
        $tablename = 'tbl_school';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';

        $limit = array();

        //$record = $this->common->get_all_record('tbl_school',$rows,$wh);
        $record = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,"id",$keywords,$field_array);
        if($record != '') {
            $totalRec = count($record);
            $config['target']      = '#tourList';
            $config['base_url']    = base_url(ADMIN).'Tour/ajax_school';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'gettour';
            $config['uri_segment'] = 4;
            $config['show_count'] = false;
            $this->ajax_pagination->initialize($config);
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            /**/
            $limit['start'] = $offset;
            $limit['limit'] = $this->perPage;
            /**/
            $data['tours'] = $this->common->get_all_record_with_limit_like($tablename,$order_by,$order,$limit,$wh,$rows,$keywords,$field_array);
            // $data['tours'] = $this->common->get_all_record_with_limit($tablename,$order_by,$order,$limit,$wh);
            
        }
        else {
            $data['tours'] = array();   
        }
        $this->load->view(ADMIN.'school/get_school', $data, false);
    }

	public function add_school($id='')
	{
		$this->general->adminauth();

		$data['state'] = $this->common->get_all_record('tbl_state','*',array('isDelete'=>0));
		if($id) {

			$data['school'] = $this->common->get_one_row('tbl_school',array('id'=>$id));
			$this->global['pageTitle'] = ' | Edit School';
		}
		else {

			$this->global['pageTitle'] = ' | Add School';
		}
        $data['special_need_category'] = $this->config->item('special_need_category');

        $data['add_general_school'] = $this->load->view(ADMIN."school/add_general_school", $data,true);
        $data['add_primary_secoundary_school'] = $this->load->view(ADMIN."school/add_primary_secoundary_school", $data,true);
        $data['add_special_need_school'] = $this->load->view(ADMIN."school/add_special_need_school", $data,true);
        $data['add_tertiary_school'] = $this->load->view(ADMIN."school/add_tertiary_school", $data,true);

        $this->global['ActiveMenu'] = 'Add School';
        $this->general->loadViews(ADMIN."school/add_school", $this->global, $data, NULL);
	}

    public function create_update_school_tertiary($id='')
    {
        $post = $this->input->post();
        /*echo "<pre>";
        print_r($post);
        echo "</pre>";*/
        

        /**/
        $subtype = "";
        if( isset($post['type']) && !empty($post['type']) ){
            $type = $post['type'];
            /**/
            $subtype = array();
            if(in_array('tertiary', $type)) {
                $selectArr = array('tafe','college','university');
                foreach ($selectArr as $key => $value) {
                    if(in_array($value, $type)) {
                        array_push($subtype, $value);
                        $pos = array_search($value, $type);
                        unset($type[$pos]);
                    }
                }
            }
            /**/
            $subtype = implode(',', $subtype);
            $type = implode(',', $type);
        }else{
            $type = 'primary';
        }
        

        echo "<pre>";
        print_r($post["primary_campus_title"]);
        // die();

        $primary_campus = $post["primary_campus"];
        $primary_campus_title = $post["primary_campus_title"];
        $primary_address_suburb = $post["primary_address_suburb"];
        $primary_state = $post["primary_state"];
        $primary_po_box = $post["primary_po_box"];
        $show_primary = $post["show_primary"];
        $checkbox_value = $post["checkbox_value"];

        $primarycampus = array();
        foreach ($primary_campus as $key => $value) {
            if($value!='') {
                $primary_campus_title[$key];
                $primary_address_suburb[$key];
                $primary_state[$key];
                $primary_po_box[$key];
                $primary_campus = $value;
                $show_primary[$key] = $checkbox_value[$key];
                
                $primarycampus[] = $primary_campus_title[$key]."!#!".$primary_address_suburb[$key]."!#!".$primary_state[$key]."!#!".$primary_po_box[$key]."!#!".$primary_campus."!#!".$show_primary[$key];
            }
        }

       /* echo "<pre>";
        print_r($primarycampus);
        print_r($post["show_primary"]);
        print_r($post["checkbox_value"]);
        die();*/

        /*echo "<pre>";
        print_r($primarycampus);*/
        

        $PrimaryCampusData['address'] = $primarycampus;
        
        foreach ($PrimaryCampusData as $key => $optionDatavalue) {
            $primary_campus_address[$key] = array_filter($optionDatavalue);
        }
        $primary_campus = json_encode($primary_campus_address);


       /* echo "<pre>";
        print_r($primary_campus_address);
        die();*/

        //$primary_campus = $post["primary_address_suburb"]."!#!".$post["primary_state"]."!#!".$post["primary_campus"]."!#!".$post["primary_po_box"];

        $data = array('email'=>$post['email'],'website'=>$post['website'],'name'=>$post['name'],'no_of_students'=>$post['no_of_students'],'no_of_teachers'=>$post['no_of_teachers'],'type'=>$type,'subtype'=>$subtype,'boarding'=>$post['boarding'],'gender'=>$post['gender'],'religion'=>$post['religion'],'international_students'=>$post['internation_students'],'cricos_number'=>$post['cricos_number'],'city'=>$post['city'],'state'=>$post['state'],'address_1'=>$post['address_1'],'po_box'=>$post['po_box'],'primary_campus'=>$primary_campus,'student_support'=>$post['student_support'],'motto'=>$post['motto'],'scholarship_offer'=>$post['scholarship_offer'],'about'=>$post['about']);

        if(!empty($post['sector'])) {
            $sector = $post['sector'];
            $sector = implode(',', $sector);
            $data['sector'] = $sector;
        }
        
        // $data['telephone_campus'] = $post['telephone_campus'];

        $optionData = array();

        $option_value = array();
        foreach ($post['option'] as $key => $value) {
            if($value!='') {
                $option_value[] = $value;
            }
        }

        $optionval_value = array();
        foreach ($post['optvalue'] as $key => $value) {
            if($value!='') {
                $optionval_value[] = $value;
            }
        }

        /*echo "<pre>";
        print_r($optionval_value);
        die();*/
        $optionData['option'] = $option_value;
        $optionData['optvalue'] = $optionval_value;
        
        foreach ($optionData as $key => $optionDatavalue) {
            $optionData[$key] = array_filter($optionDatavalue);
        }
        $optionData = json_encode($optionData);

        $data['telephone_title'] = $optionData;


       







        $data['capmus_location'] = $post['capmus_location'];
        $data['chancellor'] = $post['chancellor'];
        $data['vice_chancellor'] = $post['vice_chancellor'];
        $data['student_support_officer'] = $post['student_support_officer'];
        $data['student_support_email'] = $post['student_support_email'];
        $data['student_association'] = $post['student_association'];
        $data['student_association_contact'] = $post['student_association_contact'];
        $data['annual_fees'] = $post['annual_fees'];
        $data['private_school_bus'] = $post['private_school_bus'];
        $data['onsite_parking'] = $post['onsite_parking'];
        $data['scholarship_offer'] = $post['scholarship_offer'];
        $data['busstop_campus'] = $post['busstop_campus'];
        $data['train_station'] = $post['train_station'];
        $data['careers_adviser'] = $post['careers_adviser'];
        $data['student_counsellor'] = $post['student_counsellor'];
        $data['school_type'] = $post['school_type'];

        if(!empty($post['facilities'])) {
            $facilities = $post['facilities'];
            $facilities = implode(',', $facilities);
            $data['facilities'] = $facilities;
        }
        $data['facilities_contact'] = $post['facilities_contact'];
        $data['instagram'] = $post['instagram'];
        $data['facebook'] = $post['facebook'];



        $data['special_need_category'] = '';
        if($post['special_needs_support'] == 1){
            $data['special_needs_support']  = $post['special_needs_support'];
            $special_need_category = $post['special_need_category'];
            $data['special_need_category'] =  implode(',', $special_need_category);
        }


        /*if(isset($post['show_primary'])) {
            $data['show_primary'] = $post['show_primary'];
        }
        else {
        }*/
            $data['show_primary'] = 0;
        
        if($id) {


            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_prospectus != '') {
                    $old_prospectus = json_decode($old_prospectus, true);
                    $brochure = array_merge($old_prospectus,$brochureFile);
                    $brochure = json_encode($brochure);
                    $data['prospectus'] = $brochure;
                }
                else {

                    $data['prospectus'] = $post['brochureFile'];
                }
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_photos != '') {
                    $old_photos = json_decode($old_photos, true);
                    $photos = array_merge($old_photos,$photosFile);
                    $photos = json_encode($photos);
                    $data['photos'] = $photos;
                }
                else {

                    $data['photos'] = $post['photosFile'];
                }
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_videos != '') {
                    $old_videos = json_decode($old_videos, true);
                    $videos = array_merge($old_videos,$videosFile);
                    $videos = json_encode($videos);
                    $data['videos'] = $videos;
                }
                else {

                    $data['videos'] = $post['videosFile'];
                }
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_schoolLogo != '') {
                    
                    unlink(PhotosPath.$old_schoolLogo);
                }

                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            $wh = array('id'=>$id);
            $schoolId = $this->common->update_record('tbl_school',$data,$wh);
            // echo $this->db->last_query(); die();
            $messge = array('message' => 'School Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-school/'.$id);

        }
        else {

            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['prospectus'] = $post['brochureFile'];
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['photos'] = $post['photosFile'];
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['videos'] = $post['videosFile'];
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            
            $schoolId = $this->common->insert_record('tbl_school',$data);
            
            /* Add to notify */
            $data_nofity = array(
                'type'=> 'School',
                'title'=> $post['name'],
                'link' => base_url().'school/'.md5($schoolId),
                'is_view' => 'N'
            );
            $this->common->insert_record('notify',$data_nofity);
            /* Add to notify */
            
            $messge = array('message' => 'School Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-school');

        }
    }


    public function create_update_school_special($id='')
    {
        $post = $this->input->post();
      
        /**/
        $subtype = "";
        if( isset($post['type']) && !empty($post['type']) ){
            $type = $post['type'];
            /**/
            $subtype = array();
            if(in_array('tertiary', $type)) {
                $selectArr = array('tafe','college','university');
                foreach ($selectArr as $key => $value) {
                    if(in_array($value, $type)) {
                        array_push($subtype, $value);
                        $pos = array_search($value, $type);
                        unset($type[$pos]);
                    }
                }
            }
            /**/
            $subtype = implode(',', $subtype);
            $type = implode(',', $type);
        }else{
            $type = 'primary';
        }
        
        /**/
        /*,'mobile'=>$post['mobile']*/
        // 'business_no'=>$post['business'],
        // 'international_baccalaureate'=>$post['international_baccalaureate']
        // 'address_2'=>$post['address_2'],'address_3'=>$post['address_3'],

        $reception = $post["reception_address_suburb"]."!#!".$post["reception_state"]."!#!".$post["reception_address"]."!#!".$post["reception_po_box"];

        $primary_campus = $post["primary_address_suburb"]."!#!".$post["primary_state"]."!#!".$post["primary_campus"]."!#!".$post["primary_po_box"];

        $secondary_campus = $post["secoundary_address_suburb"]."!#!".$post["secondary_state"]."!#!".$post["secondary_campus"]."!#!".$post["secoundary_po_box"];
        //$reception = "Combination of Address";
        if($post['funding_year']!="") { $funding_year = $post['funding_year']; } else { $funding_year = ""; }
        if($post['funding_amount']!="") { $funding_amount = $post['funding_amount']; } else { $funding_amount = ""; }

        $data = array('email'=>$post['email'],'telephone'=>$post['telephone'],'corporate_no'=>$post['corporate'],'website'=>$post['website'],'name'=>$post['name'],'principal'=>$post['principal'],'no_of_students'=>$post['no_of_students'],'no_of_teachers'=>$post['no_of_teachers'],'type'=>$type,'subtype'=>$subtype,'boarding'=>$post['boarding'],'gender'=>$post['gender'],'religion'=>$post['religion'],'international_students'=>$post['internation_students'],'cricos_number'=>$post['cricos_number'],'enrolments_officer'=>$post['enrolment_officer'],'enrolments_officer_email'=>$post['enrolment_officer_email'],'city'=>$post['city'],'state'=>$post['state'],'address_1'=>$post['address_1'],'funding_year'=>$funding_year,'funding_amount'=>$funding_amount,'special_needs_support'=>$post['special_needs_support'],'reception'=>$reception,'po_box'=>$post['po_box'],'primary_campus'=>$primary_campus,'secondary_campus'=>$secondary_campus,'student_support'=>$post['student_support'],'motto'=>$post['motto'],'scholarship_offer'=>$post['scholarship_offer'],'selective'=>$post['selective'],'about'=>$post['about']);

        if(!empty($post['sector'])) {
            $sector = $post['sector'];
            $sector = implode(',', $sector);
            $data['sector'] = $sector;
        }
        

        $data['telephone_2'] = $post['telephone_2'];
        $data['dep_principal'] = $post['dep_principal'];
        $data['head_of_secondary'] = $post['head_of_secondary'];
        $data['head_of_primary'] = $post['head_of_primary'];
        $data['school_type'] = $post['school_type'];
        $data['fees_grade'] = $post['fees_grade'];
        $data['fees_grade_1'] = $post['fees_grade_1'];
        $data['private_school_bus'] = $post['private_school_bus'];
        $data['school_care'] = $post['school_care'];
        $data['school_care_number'] = $post['school_care_number'];
        $data['scholarship_offer'] = $post['scholarship_offer'];
        $data['busstop_campus'] = $post['busstop_campus'];
        $data['careers_adviser'] = $post['careers_adviser'];
        $data['student_counsellor'] = $post['student_counsellor'];
        $data['uniform'] = $post['uniform'];
        $data['ib_diploma_programme'] = $post['ib_diploma_programme'];
        $data['infrastructure_special_needs'] = $post['infrastructure_special_needs'];
        $data['parent_association'] = $post['parent_association'];
        $data['parent_association_president'] = $post['parent_association_president'];

        
        $data['speech_phthologist'] = $post['speech_phthologist'];
        $data['occupational_therapist'] = $post['occupational_therapist'];
        $data['scholarship_offer'] = $post['scholarship_offer'];

        if(!empty($post['facilities'])) {
            $facilities = $post['facilities'];
            $facilities = implode(',', $facilities);
            $data['facilities'] = $facilities;
        }
        $data['facilities_contact'] = $post['facilities_contact'];
        $data['instagram'] = $post['instagram'];
        $data['facebook'] = $post['facebook'];



        $data['special_need_category'] = '';
        if($post['special_needs_support'] == 1){
            $special_need_category = $post['special_need_category'];
            $data['special_need_category'] =  implode(',', $special_need_category);
        }

        if(isset($post['show_primary'])) {
            $data['show_primary'] = $post['show_primary'];
        }
        else {
            $data['show_primary'] = 0;
        }
        if(isset($post['show_secondary'])) {
            $data['show_secondary'] = $post['show_secondary'];
        }
        else {
            $data['show_secondary'] = 0;
        }

        if($id) {


            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_prospectus != '') {
                    $old_prospectus = json_decode($old_prospectus, true);
                    $brochure = array_merge($old_prospectus,$brochureFile);
                    $brochure = json_encode($brochure);
                    $data['prospectus'] = $brochure;
                }
                else {

                    $data['prospectus'] = $post['brochureFile'];
                }
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_photos != '') {
                    $old_photos = json_decode($old_photos, true);
                    $photos = array_merge($old_photos,$photosFile);
                    $photos = json_encode($photos);
                    $data['photos'] = $photos;
                }
                else {

                    $data['photos'] = $post['photosFile'];
                }
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_videos != '') {
                    $old_videos = json_decode($old_videos, true);
                    $videos = array_merge($old_videos,$videosFile);
                    $videos = json_encode($videos);
                    $data['videos'] = $videos;
                }
                else {

                    $data['videos'] = $post['videosFile'];
                }
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_schoolLogo != '') {
                    
                    unlink(PhotosPath.$old_schoolLogo);
                }

                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            $wh = array('id'=>$id);
            $schoolId = $this->common->update_record('tbl_school',$data,$wh);
            $messge = array('message' => 'School Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-school/'.$id);

        }
        else {

            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['prospectus'] = $post['brochureFile'];
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['photos'] = $post['photosFile'];
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['videos'] = $post['videosFile'];
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            
            $schoolId = $this->common->insert_record('tbl_school',$data);

            /* Add to notify */
            $data_nofity = array(
                'type'=> 'School',
                'title'=> $post['name'],
                'link' => base_url().'school/'.md5($schoolId),
                'is_view' => 'N'
            );
            $this->common->insert_record('notify',$data_nofity);
            /* Add to notify */
            
            $messge = array('message' => 'School Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-school');

        }
    }

    public function create_update_school($id='')
    {
        $post = $this->input->post();

        /**/
        $subtype = "";
        if( isset($post['type']) && !empty($post['type']) ){
            $type = $post['type'];
            /**/
            $subtype = array();
            if(in_array('tertiary', $type)) {
                $selectArr = array('tafe','college','university');
                foreach ($selectArr as $key => $value) {
                    if(in_array($value, $type)) {
                        array_push($subtype, $value);
                        $pos = array_search($value, $type);
                        unset($type[$pos]);
                    }
                }
            }
            /**/
            $subtype = implode(',', $subtype);
            $type = implode(',', $type);
        }else{
            $type = 'primary';
        }
        $sector = $post['sector'];
        $sector = implode(',', $sector);
        /**/
        /*,'mobile'=>$post['mobile']*/
        if($post['funding_year']!="") { $funding_year = $post['funding_year']; } else { $funding_year = ""; }
        if($post['funding_amount']!="") { $funding_amount = $post['funding_amount']; } else { $funding_amount = ""; }

        $data = array('email'=>$post['email'],'telephone'=>$post['telephone'],'corporate_no'=>$post['corporate'],'business_no'=>$post['business'],'website'=>$post['website'],'name'=>$post['name'],'principal'=>$post['principal'],'no_of_students'=>$post['no_of_students'],'no_of_teachers'=>$post['no_of_teachers'],'type'=>$type,'subtype'=>$subtype,'sector'=>$sector,'boarding'=>$post['boarding'],'gender'=>$post['gender'],'religion'=>$post['religion'],'international_students'=>$post['internation_students'],'cricos_number'=>$post['cricos_number'],'enrolments_officer'=>$post['enrolment_officer'],'enrolments_officer_email'=>$post['enrolment_officer_email'],'city'=>$post['city'],'state'=>$post['state'],'address_1'=>$post['address_1'],'address_2'=>$post['address_2'],'address_3'=>$post['address_3'],'funding_year'=>$funding_year,'funding_amount'=>$funding_amount,'special_needs_support'=>$post['special_needs_support'],'reception'=>$post['reception'],'po_box'=>$post['po_box'],'primary_campus'=>$post['primary_campus'],'secondary_campus'=>$post['secondary_campus'],'student_support'=>$post['student_support'],'motto'=>$post['motto'],'scholarship_offer'=>$post['scholarship_offer'],'selective'=>$post['selective'],'international_baccalaureate'=>$post['international_baccalaureate'],'about'=>$post['about']);

        $data['school_type'] = $post['school_type'];
        $data['special_need_category'] = '';
        if($post['special_needs_support'] == 1){
            $special_need_category = $post['special_need_category'];
            $data['special_need_category'] =  implode(',', $special_need_category);
        }

        if(isset($post['show_primary'])) {
            $data['show_primary'] = $post['show_primary'];
        }
        else {
            $data['show_primary'] = 0;
        }
        if(isset($post['show_secondary'])) {
            $data['show_secondary'] = $post['show_secondary'];
        }
        else {
            $data['show_secondary'] = 0;
        }

        if($id) {


            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_prospectus != '') {
                    $old_prospectus = json_decode($old_prospectus, true);
                    $brochure = array_merge($old_prospectus,$brochureFile);
                    $brochure = json_encode($brochure);
                    $data['prospectus'] = $brochure;
                }
                else {

                    $data['prospectus'] = $post['brochureFile'];
                }
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_photos != '') {
                    $old_photos = json_decode($old_photos, true);
                    $photos = array_merge($old_photos,$photosFile);
                    $photos = json_encode($photos);
                    $data['photos'] = $photos;
                }
                else {

                    $data['photos'] = $post['photosFile'];
                }
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_videos != '') {
                    $old_videos = json_decode($old_videos, true);
                    $videos = array_merge($old_videos,$videosFile);
                    $videos = json_encode($videos);
                    $data['videos'] = $videos;
                }
                else {

                    $data['videos'] = $post['videosFile'];
                }
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_schoolLogo != '') {
                    
                    unlink(PhotosPath.$old_schoolLogo);
                }

                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            $wh = array('id'=>$id);
            $schoolId = $this->common->update_record('tbl_school',$data,$wh);
            $messge = array('message' => 'School Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-school/'.$id);

        }
        else {

            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['prospectus'] = $post['brochureFile'];
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['photos'] = $post['photosFile'];
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['videos'] = $post['videosFile'];
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            
            $schoolId = $this->common->insert_record('tbl_school',$data);

            /* Add to notify */
            $data_nofity = array(
                'type'=> 'School',
                'title'=> $post['name'],
                'link' => base_url().'school/'.md5($schoolId),
                'is_view' => 'N'
            );
            $this->common->insert_record('notify',$data_nofity);
            /* Add to notify */
            
            $messge = array('message' => 'School Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-school');

        }
    }	

    public function create_update_school_primary($id='')
    {
        $post = $this->input->post();
       /* echo "<pre>";
        print_r($post);
        echo "</pre>";
        die();*/

        /**/
        $subtype = "";
        if( isset($post['type']) && !empty($post['type']) ){
            $type = $post['type'];
            /**/
            $subtype = array();
            if(in_array('tertiary', $type)) {
                $selectArr = array('tafe','college','university');
                foreach ($selectArr as $key => $value) {
                    if(in_array($value, $type)) {
                        array_push($subtype, $value);
                        $pos = array_search($value, $type);
                        unset($type[$pos]);
                    }
                }
            }
            /**/
            $subtype = implode(',', $subtype);
            $type = implode(',', $type);
        }else{
            $type = 'primary';
        }
        
        /**/
        /*,'mobile'=>$post['mobile']*/
        // 'business_no'=>$post['business'],
        // 'international_baccalaureate'=>$post['international_baccalaureate']
        // 'address_2'=>$post['address_2'],'address_3'=>$post['address_3'],

        $reception = $post["reception_address_suburb"]."!#!".$post["reception_state"]."!#!".$post["reception_address"]."!#!".$post["reception_po_box"];

        $primary_campus = $post["primary_address_suburb"]."!#!".$post["primary_state"]."!#!".$post["primary_campus"]."!#!".$post["primary_po_box"];

        $secondary_campus = $post["secoundary_address_suburb"]."!#!".$post["secondary_state"]."!#!".$post["secondary_campus"]."!#!".$post["secoundary_po_box"];
        //$reception = "Combination of Address";
        if($post['funding_year']!="") { $funding_year = $post['funding_year']; } else { $funding_year = ""; }
        if($post['funding_amount']!="") { $funding_amount = $post['funding_amount']; } else { $funding_amount = ""; }

        $data = array('email'=>$post['email'],'telephone'=>$post['telephone'],'corporate_no'=>$post['corporate'],'website'=>$post['website'],'name'=>$post['name'],'principal'=>$post['principal'],'no_of_students'=>$post['no_of_students'],'no_of_teachers'=>$post['no_of_teachers'],'type'=>$type,'subtype'=>$subtype,'boarding'=>$post['boarding'],'gender'=>$post['gender'],'religion'=>$post['religion'],'international_students'=>$post['internation_students'],'cricos_number'=>$post['cricos_number'],'enrolments_officer'=>$post['enrolment_officer'],'enrolments_officer_email'=>$post['enrolment_officer_email'],'city'=>$post['city'],'state'=>$post['state'],'address_1'=>$post['address_1'],'funding_year'=>$funding_year,'funding_amount'=>$funding_amount,'special_needs_support'=>$post['special_needs_support'],'reception'=>$reception,'po_box'=>$post['po_box'],'primary_campus'=>$primary_campus,'secondary_campus'=>$secondary_campus,'student_support'=>$post['student_support'],'motto'=>$post['motto'],'scholarship_offer'=>$post['scholarship_offer'],'selective'=>$post['selective'],'about'=>$post['about']);

        if(!empty($post['sector'])) {
            $sector = $post['sector'];
            $sector = implode(',', $sector);
            $data['sector'] = $sector;
        }
        
        $data['telephone_2'] = $post['telephone_2'];
        $data['dep_principal'] = $post['dep_principal'];
        $data['head_of_secondary'] = $post['head_of_secondary'];
        $data['head_of_primary'] = $post['head_of_primary'];
        $data['school_type'] = $post['school_type'];
        $data['fees_grade'] = $post['fees_grade'];
        $data['fees_grade_1'] = $post['fees_grade_1'];
        $data['private_school_bus'] = $post['private_school_bus'];
        $data['school_care'] = $post['school_care'];
        $data['school_care_number'] = $post['school_care_number'];
        $data['scholarship_offer'] = $post['scholarship_offer'];
        $data['busstop_campus'] = $post['busstop_campus'];
        $data['careers_adviser'] = $post['careers_adviser'];
        $data['student_counsellor'] = $post['student_counsellor'];
        $data['uniform'] = $post['uniform'];
        $data['ib_diploma_programme'] = $post['ib_diploma_programme'];
        $data['infrastructure_special_needs'] = $post['infrastructure_special_needs'];
        $data['parent_association'] = $post['parent_association'];
        $data['parent_association_president'] = $post['parent_association_president'];

        if(!empty($post['facilities'])) {
            $facilities = $post['facilities'];
            $facilities = implode(',', $facilities);
            $data['facilities'] = $facilities;
        }
        $data['facilities_contact'] = $post['facilities_contact'];
        $data['instagram'] = $post['instagram'];
        $data['facebook'] = $post['facebook'];



        $data['special_need_category'] = '';
        if($post['special_needs_support'] == 1){
            $special_need_category = $post['special_need_category'];
            $data['special_need_category'] =  implode(',', $special_need_category);
        }

        if(isset($post['show_primary'])) {
            $data['show_primary'] = $post['show_primary'];
        }
        else {
            $data['show_primary'] = 0;
        }
        if(isset($post['show_secondary'])) {
            $data['show_secondary'] = $post['show_secondary'];
        }
        else {
            $data['show_secondary'] = 0;
        }

        if($id) {


            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_prospectus != '') {
                    $old_prospectus = json_decode($old_prospectus, true);
                    $brochure = array_merge($old_prospectus,$brochureFile);
                    $brochure = json_encode($brochure);
                    $data['prospectus'] = $brochure;
                }
                else {

                    $data['prospectus'] = $post['brochureFile'];
                }
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_photos != '') {
                    $old_photos = json_decode($old_photos, true);
                    $photos = array_merge($old_photos,$photosFile);
                    $photos = json_encode($photos);
                    $data['photos'] = $photos;
                }
                else {

                    $data['photos'] = $post['photosFile'];
                }
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                if($old_videos != '') {
                    $old_videos = json_decode($old_videos, true);
                    $videos = array_merge($old_videos,$videosFile);
                    $videos = json_encode($videos);
                    $data['videos'] = $videos;
                }
                else {

                    $data['videos'] = $post['videosFile'];
                }
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                if($old_schoolLogo != '') {
                    
                    unlink(PhotosPath.$old_schoolLogo);
                }

                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            $wh = array('id'=>$id);
            $schoolId = $this->common->update_record('tbl_school',$data,$wh);
            $messge = array('message' => 'School Updated Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'add-school/'.$id);

        }
        else {

            if($post['brochureFile'] != '') {

                $brochure = array();
                $old_prospectus = $post['old_prospectus'];
                $brochureFile = json_decode($post['brochureFile'], true);
                foreach ($brochureFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = BrochurePath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['prospectus'] = $post['brochureFile'];
                
            }

            if($post['photosFile'] != '') {

                $photos = array();
                $old_photos = $post['old_photos'];
                $photosFile = json_decode($post['photosFile'], true);
                foreach ($photosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = PhotosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['photos'] = $post['photosFile'];
                
            }

            if($post['videosFile'] != '') {

                $videos = array();
                $old_videos = $post['old_videos'];
                $videosFile = json_decode($post['videosFile'], true);
                foreach ($videosFile as $key => $value) {
                    $src = MyPath.$value;
                    $dest = VideosPath.$value;
                    copy($src, $dest);
                    unlink($src);
                }

                $data['videos'] = $post['videosFile'];
                
            }

            if($post['schoolLogoFile'] != '') {

                $schoolLogo = array();
                $old_schoolLogo = $post['old_schoolLogo'];
                $schoolLogoFile = $post['schoolLogoFile'];
                
                $src = MyPath.$schoolLogoFile;
                $dest = PhotosPath.$schoolLogoFile;
                copy($src, $dest);
                unlink($src);
                
                $data['school_logo'] = $post['schoolLogoFile'];
                
            }

            
            $schoolId = $this->common->insert_record('tbl_school',$data);

            /* Add to notify */
            $data_nofity = array(
                'type'=> 'School',
                'title'=> $post['name'],
                'link' => base_url().'school/'.md5($schoolId),
                'is_view' => 'N'
            );
            $this->common->insert_record('notify',$data_nofity);
            /* Add to notify */
            
            $messge = array('message' => 'School Added Successfully..','class' => 'success');
            $this->session->set_flashdata('msg',$messge);
            redirect(ADMIN_LINK.'manage-school');

        }
    }

    /* Change Status */

    public function changeStatus($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];

        $data = array('status'=>$status);

        if($type == 'school') {
            
            $where = array('id'=>$post['schoolId']);
            $table = 'tbl_school';
        }
        
        $update = $this->common->update_record($table,$data,$where);
        
        $response['success'] = true;
        if($status) {
            $response['message'] = 'This profile is now live!';
        }
        else {
            $response['message'] = 'This profile is now off!';
        }
        // $response['message'] = 'Status Changed Successfully..';

        echo json_encode($response);

    }

    /* Approved Status */

    public function approve($type='')
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];

        $data = array('approval'=>$status);

        if($type == 'school') {
            
            $where = array('id'=>$post['schoolId']);
            $table = 'tbl_school';
        }
        
        $update = $this->common->update_record($table,$data,$where);
        
        $response['success'] = true;
        $response['message'] = 'Status Changed Successfully..';

        echo json_encode($response);

    }

    /* Change Status */

	function deleteData()
    {
        $id = $this->input->post('id');
        $table_name = base64_decode( $this->input->post('td') );
        $field = base64_decode( $this->input->post('i') );
        
        $where_array = array($field => $id);

        $data_array = array('isDelete'=>1);
        $result = $this->common->update_record($table_name, $data_array,$where_array);
        if ($result > 0) { 
            echo(json_encode(array('status'=>TRUE))); 
        }
        else { 
            echo(json_encode(array('status'=>FALSE))); 
        }
        
    }

    /* Upload Files */
    public function upload_files()
    {
        try {
            if (
                !isset($_FILES['file']['error']) ||
                is_array($_FILES['file']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            $filename = uniqid().'_'.$_FILES['file']['name'];
            // $filepath = sprintf(MyPath.'%s_%s', uniqid(), $_FILES['file']['name']);
            $filepath = MyPath.$filename;

            if (!move_uploaded_file($_FILES['file']['tmp_name'],$filepath)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            // All good, send the response
            $data = array('status' => 'ok','path' => $filename);
            //echo json_encode($data);

        } catch (RuntimeException $e) {
            // Something went wrong, send the err message as JSON
            http_response_code(400);

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        echo json_encode($data);
    }


    /* Is Featured */

    public function is_featured()
    {
        $response = array();
        $post = $this->input->post();
        $status = $post['status'];
        $data = array('is_sponsored'=>$status, 'status'=>$status);
        $where = array('id'=>$post['schoolId']);
        $table = 'tbl_school';        
        $update = $this->common->update_record($table,$data,$where);
        $response['success'] = true;
        // $response['message'] = 'School set as Featured Successfully..';
        if($status) {
            $response['message'] = 'School has been featured successfully..';
        }
        else{
            $response['message'] = 'School has been removed.';
        }
        echo json_encode($response);
    }

    /*if($post['Image'] != '') {
        $next_id = $this->common->get_next_id('tbl_category');
        $src = MyPath.$post['Image'];
        if(!is_dir(CATPATH.$next_id.'/')) {
            mkdir(CATPATH.$next_id.'/');
        }
        $dest = CATPATH.$next_id.'/'.$post['Image'];
        copy($src, $dest);
        $this->general->resize_image(CATPATH.$next_id.'/',$post['Image'],'200','200',true,'Thumb/');
        unlink($src);
        $data['image'] = $post['Image'];

        $res = $this->common->insert_record('tbl_category',$data);
        if(!$res) {
            unlink(CATPATH.$next_id.'/'.$post['Image']);
            unlink(CATPATH.$next_id.'/Thumb/'.$post['Image']);
        }
        $this->general->processandredirect($res,'Category Added Successfully','Category Not Added',ADMIN.'category');
    }
    
    if($post['Image'] != '') {  
        if($OldImage != '') {
            unlink(CATPATH.$id.'/'.$OldImage);
            unlink(CATPATH.$id.'/Thumb/'.$OldImage);
        }
        $src = MyPath.$post['Image'];
        if(!is_dir(CATPATH.$id)) {
            mkdir(CATPATH.$id);
        }
        $dest = CATPATH.$id.'/'.$post['Image'];
        copy($src, $dest);
        $this->general->resize_image(CATPATH.$id.'/',$post['Image'],'200','200',true,'Thumb/');
        unlink($src);
        $data['image'] = $post['Image'];
    }
    else {
        if($OldImage == "") {
            $this->session->set_flashdata('error','Please Select Image');
        }
        // redirect(base_url(ADMIN.'category/add/'.$id));
    }
    */

}
