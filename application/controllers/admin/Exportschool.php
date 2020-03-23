<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Exportschool extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'term_condition';
        $this->load->library('csvimport');
        $this->load->library('Ajax_pagination');
        $this->perPage = 1;
    }

    /*public function index()
    {
        $this->general->adminauth();
        $data = array();
        $this->global['pageTitle'] = ' | Manage School';
        $this->global['ActiveMenu'] = 'Manage School';
        $this->general->loadViews(ADMIN."export/manage_school", $this->global, $data, NULL);
    }*/

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
        $keywords = $this->input->post('keywords');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
       
        $wh = array('isDelete'=>0,'approval !='=>1);
        $data = array();
        $tablename = 'tbl_school';
        $rows = '*';
        $order_by = 'id';
        $order = 'DESC';

        $record = $this->common->get_all_record('tbl_school',$rows,$wh);
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
            $data['tours'] = $this->common->get_all_record_with_limit($tablename,$order_by,$order,$limit,$wh);
        }
        else {
            $data['tours'] = array();   
        }
        $this->load->view(ADMIN.'export/get_school', $data, false);
    }
    /*function index()
    {
        if($this->isAdmin() != TRUE)
        {
            $this->loadThis();
        }
        else
        {   

            $result = $this->crud->get_record_with_where_limit('term_condition');
            $data["term"] = $result[0];
            $this->global['pageTitle'] = ' Import Leads';
            $this->loadViews(ADMIN."lead-upload", $this->global, $data, NULL);
        }
    }*/

    function export()
    {   
        $post = $this->input->post();
        
        $query = $this->db->select('s.*,st.shortName as state')
        ->from('tbl_school s')
        ->where('s.isDelete',0)
        ->where('s.approval!=',1)
        ->where_in('s.id',$post['select_school']);
        $this->db->join('tbl_state st','st.id=s.state','left');

        $query = $this->db->get();
        $record = $query->result_array();
        
        foreach ($record as $key => $value) {
            $record[$key]['boarding'] = ($value['boarding'] == 0 ) ? 'False' : 'True';
            $record[$key]['student_support'] = ($value['student_support'] == 0 ) ? 'False' : 'True';
            $record[$key]['special_needs_support'] = ($value['special_needs_support'] == 0 ) ? 'False' : 'True';
            $record[$key]['scholarship_offer'] = ($value['scholarship_offer'] == 0 ) ? 'False' : 'True';
            $record[$key]['international_baccalaureate'] = ($value['international_baccalaureate'] == 0 ) ? 'False' : 'True';
            $record[$key]['selective'] = ($value['selective'] == 0 ) ? 'False' : 'True';
            $record[$key]['show_primary'] = ($value['show_primary'] == 0 ) ? 'False' : 'True';
            $record[$key]['is_sponsored'] = ($value['is_sponsored'] == 0 ) ? 'False' : 'True';
            $record[$key]['status'] = ($value['status'] == 0 ) ? 'False' : 'True';
            $record[$key]['approval'] = ($value['approval'] == 0 ) ? 'False' : 'True';
            unset($record[$key]['isDelete']);
            unset($record[$key]['created_date']);
            unset($record[$key]['updated_date']);
        }

        $record[] = array('Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email');

        $data = array_reverse($record);

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"test".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    function export_general()
    {   
        $post = $this->input->post();
        
        $query = $this->db->select('
            s.id,
            s.school_number,
            s.name,
            s.type,
            s.subtype,
            s.sector,
            s.email,
            s.telephone,
            s.corporate_no,
            s.business_no,
            s.website,
            s.principal,
            s.no_of_students,
            s.no_of_teachers,
            s.gender,
            s.city,
            s.state,
            s.address_1,
            s.reception,
            s.primary_campus,
            s.show_primary,
            s.secondary_campus,
            s.show_secondary,
            s.po_box,
            s.religion,
            s.international_students,
            s.cricos_number,
            s.enrolments_officer,
            s.enrolments_officer_email,
            s.special_needs_support,
            s.special_need_category,
            s.selective,
            s.funding_year,
            s.funding_amount,
            s.boarding,
            s.student_support,
            s.motto,
            s.scholarship_offer,
            s.international_baccalaureate,
            s.about,

            ,st.name as state')
        ->from('tbl_school s')
        ->where('s.isDelete',0)
        ->where('s.approval!=',1)
        ->where('s.school_type',1);
        $this->db->join('tbl_state st','st.id=s.state','left');

        $query = $this->db->get();
        $record = $query->result_array();
       /* echo "<pre>";
        print_r($record);
        die();*/

        $special_need_category = $this->config->item('special_need_category');
        
        foreach ($record as $key => $value) {
            
            $record[$key]['show_primary'] = ($value['show_primary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['show_secondary'] = ($value['show_secondary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['international_students'] = ($value['international_students'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['special_needs_support'] = ($value['special_needs_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['selective'] = ($value['selective'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['student_support'] = ($value['student_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['scholarship_offer'] = ($value['scholarship_offer'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['international_baccalaureate'] = ($value['international_baccalaureate'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['boarding'] = ($value['boarding'] == 0 ) ? 'No' : 'Yes';
            
            $special_need = explode(",", $value['special_need_category']);
            $special_need_value = "";
            foreach ($special_need_category as $sp_key => $sp_value) {
                if(in_array($sp_key,$special_need)) {
                    $special_need_value .= $sp_value.",";
                }
            }
            $special_need_value;
            $record[$key]['special_need_category'] = $special_need_value;
            
        }
        

        $record[] = array(
            'id',
            'School Number',
            'School Name',
            'Type',
            'Sub Type',
            'sector',
            'Email',
            'Telephone',
            'Corporate',
            'Business',
            'website',
            'principal',
            'No of Student',
            'No of Teacher',
            'gender',
            'Suburb',
            'State',
            'Address',
            'Reception Address',
            'Primary Campus Address',
            'Show Primary Campus On Map',
            'Secondary Campus Address',
            'Show Secondary Campus On Map',
            'PO Box',
            'Religion',
            'International Students Accepted',
            'CRICOS Number',
            'Enrolment Officer',
            'Enrolment Officer Email',
            'Special Needs Support',
            'Special needs categories',
            'selective',
            'Commonwealth Funding Year',
            'Commonwealth Funding Amoun',
            'Boarding / Housing',
            'Student Support',
            'School Motto',
            'Scholarship Offers',
            'International Baccalaureate School',
            'About School',
        );
        // $record[] = array('Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email');

        $data = array_reverse($record);
        /*echo "<pre>";
        print_r($data); die();*/

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"general_school_export".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }


    function export_secoundary()
    {   
        $post = $this->input->post();
        
        $query = $this->db->select('
            s.id,
            s.school_number,
            s.name,
            s.motto,
            s.type,
            s.subtype,
            s.sector,
            s.email,
            s.telephone,
            s.telephone_2,
            s.corporate_no,
            s.website,
            s.principal,
            s.dep_principal,
            s.head_of_secondary,
            s.head_of_primary,
            s.enrolments_officer,
            s.enrolments_officer_email,
            s.no_of_students,
            s.no_of_teachers,
            s.gender,
            s.religion,
            s.parent_association,
            s.parent_association_president,
            s.selective,
            s.fees_grade,
            s.fees_grade_1,
            s.boarding,
            s.private_school_bus,
            s.school_care,
            s.school_care_number,
            s.scholarship_offer,
            s.busstop_campus,
            s.careers_adviser,
            s.student_support,
            s.student_counsellor,
            s.uniform,
            s.ib_diploma_programme,
            s.international_students,
            s.cricos_number,
            s.infrastructure_special_needs,
            s.special_needs_support,
            s.special_need_category,
            s.city,
            s.state,
            s.address_1,
            s.po_box,
            s.reception,
            s.primary_campus,
            s.show_primary,
            s.secondary_campus,
            s.show_secondary,
            s.about,
            s.facilities,
            s.facilities_contact,
            s.instagram,
            s.facebook,

            ,st.name as state')
        ->from('tbl_school s')
        ->where('s.isDelete',0)
        ->where('s.approval!=',1)
        ->where('s.school_type',2);
        $this->db->join('tbl_state st','st.id=s.state','left');

        $query = $this->db->get();
        $record = $query->result_array();
       /* echo "<pre>";
        print_r($record);
        die();*/

        $special_need_category = $this->config->item('special_need_category');
        
        foreach ($record as $key => $value) {
            
            $record[$key]['show_primary'] = ($value['show_primary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['show_secondary'] = ($value['show_secondary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['international_students'] = ($value['international_students'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['special_needs_support'] = ($value['special_needs_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['selective'] = ($value['selective'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['student_support'] = ($value['student_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['scholarship_offer'] = ($value['scholarship_offer'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['boarding'] = ($value['boarding'] == 0 ) ? 'No' : 'Yes';
            
            $special_need = explode(",", $value['special_need_category']);
            $special_need_value = "";
            foreach ($special_need_category as $sp_key => $sp_value) {
                if(in_array($sp_key,$special_need)) {
                    $special_need_value .= $sp_value.",";
                }
            }
            $special_need_value;
            $record[$key]['special_need_category'] = $special_need_value;

            // 'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"];

            $record[$key]['reception'] = str_replace("!#!", " ", $value["reception"]);
            $record[$key]['primary_campus'] = str_replace("!#!", " ", $value["primary_campus"]);
            $record[$key]['secondary_campus'] = str_replace("!#!", " ", $value["secondary_campus"]);
            
        }

        
        /*'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],
        'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
        'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',
        'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],*/
        

        $record[] = array(
            'id',
            'School Number',
            'School Name',
            'motto',
            'Type',
            'Sub Type',
            'sector',
            'Email',
            'Primary Campus Number',
            'Secondary Campus Number',
            'Corporate',
            'website',
            'School Principal',
            'Deputy Principal',
            'Head of Secondary',
            'Head of Primary',
            'Enrolment Officer',
            'Enrolment Officer Email',
            'No of Student',
            'No of Teacher',
            'gender',
            'Religion',
            'Parent Association',
            'Parent Association President',
            'selective',
            'Annual Fees',
            'Fees',
            'Student Boarding / Housing',
            'Private School Bus',
            'Before and After School Care',
            'Before and After School Care Contact',
            'Scholarship Offers',
            'Bus Stop on Campus',
            'Careers Adviser',
            'Student Support / Counselling',
            'Student Counsellor or Support Contact',
            'Compulsory School Uniform',
            'IB Diploma Programme',
            'International Students Accepted',
            'CRICOS Number',
            'Infrastructure for Special Needs',
            'Special Needs Support',
            'Special needs categories',
            'Suburb',
            'State',
            'Address',
            'PO Box',

            'Reception',

            'Primary Campus',
            'Show Primary Campus On Map',

            'Secondary Campus',
            'Show Secondary Campus On Map',

            'About School',
            'Facilities',
            'Use of Facilities Contact',
            'Instagram',
            'Facebook',
        );
        // $record[] = array('Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email');

        $data = array_reverse($record);
        /*echo "<pre>";
        print_r($data); die();*/

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"secoundary_school_export".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    function export_special()
    {   
        $post = $this->input->post();
        
        $query = $this->db->select('
            s.id,
            s.school_number,
            s.name,
            s.motto,
            s.type,
            s.subtype,
            s.sector,
            s.email,
            s.telephone,
            s.telephone_2,
            s.corporate_no,
            s.website,
            s.principal,
            s.dep_principal,
            s.head_of_secondary,
            s.head_of_primary,
            s.enrolments_officer,
            s.enrolments_officer_email,
            s.no_of_students,
            s.no_of_teachers,
            s.gender,
            s.religion,
            s.parent_association,
            s.parent_association_president,
            s.selective,
            s.fees_grade,
            s.fees_grade_1,
            s.boarding,
            s.private_school_bus,
            s.school_care,
            s.school_care_number,
            s.speech_phthologist,
            s.occupational_therapist,
            s.scholarship_offer,
            s.busstop_campus,
            s.careers_adviser,
            s.student_support,
            s.student_counsellor,
            s.uniform,
            s.ib_diploma_programme,
            s.international_students,
            s.cricos_number,
            s.infrastructure_special_needs,
            s.special_needs_support,
            s.special_need_category,
            s.city,
            s.state,
            s.address_1,
            s.po_box,
            s.reception,
            s.primary_campus,
            s.show_primary,
            s.secondary_campus,
            s.show_secondary,
            s.about,
            s.facilities,
            s.facilities_contact,
            s.instagram,
            s.facebook,

            ,st.name as state')
        ->from('tbl_school s')
        ->where('s.isDelete',0)
        ->where('s.approval!=',1)
        ->where('s.school_type',3);
        $this->db->join('tbl_state st','st.id=s.state','left');

        $query = $this->db->get();
        $record = $query->result_array();
       /* echo "<pre>";
        print_r($record);
        die();*/

        $special_need_category = $this->config->item('special_need_category');
        
        foreach ($record as $key => $value) {
            
            $record[$key]['fees_grade'] = ($value['fees_grade'] == 1 ) ? 'Grade 1 - Grade 6' : 'Grade 7 - Grade 12';
            $record[$key]['parent_association'] = ($value['parent_association'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['show_primary'] = ($value['show_primary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['show_secondary'] = ($value['show_secondary'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['international_students'] = ($value['international_students'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['special_needs_support'] = ($value['special_needs_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['selective'] = ($value['selective'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['student_support'] = ($value['student_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['scholarship_offer'] = ($value['scholarship_offer'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['boarding'] = ($value['boarding'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['speech_phthologist'] = ($value['speech_phthologist'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['occupational_therapist'] = ($value['occupational_therapist'] == 0 ) ? 'No' : 'Yes';

            $record[$key]['private_school_bus'] = ($value['private_school_bus'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['school_care'] = ($value['school_care'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['careers_adviser'] = ($value['careers_adviser'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['uniform'] = ($value['uniform'] == 0 ) ? 'No' : 'Yes';
            
            $special_need = explode(",", $value['special_need_category']);
            $special_need_value = "";
            foreach ($special_need_category as $sp_key => $sp_value) {
                if(in_array($sp_key,$special_need)) {
                    $special_need_value .= $sp_value.",";
                }
            }
            $special_need_value;
            $record[$key]['special_need_category'] = $special_need_value;

            // 'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"];

            $record[$key]['reception'] = str_replace("!#!", " ", $value["reception"]);
            $record[$key]['primary_campus'] = str_replace("!#!", " ", $value["primary_campus"]);
            $record[$key]['secondary_campus'] = str_replace("!#!", " ", $value["secondary_campus"]);
            
        }

        
        /*'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],
        'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
        'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',
        'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],*/
        

        $record[] = array(
            'id',
            'School Number',
            'School Name',
            'motto',
            'Type',
            'Sub Type',
            'sector',
            'Email',
            'Primary Campus Number',
            'Secondary Campus Number',
            'Corporate',
            'website',
            'School Principal',
            'Deputy Principal',
            'Head of Secondary',
            'Head of Primary',
            'Enrolment Officer',
            'Enrolment Officer Email',
            'No of Student',
            'No of Teacher',
            'gender',
            'Religion',
            'Parent Association',
            'Parent Association President',
            'selective',
            'Annual Fees',
            'Fees',
            'Student Boarding / Housing',
            'Private School Bus',
            'Before and After School Care',
            'Before and After School Care Contact',
            'Speech Pathologist Onsite',
            'Occupational Therapist Onsite',
            'Scholarship Offers',
            'Bus Stop on Campus',
            'Careers Adviser',
            'Student Support / Counselling',
            'Student Counsellor or Support Contact',
            'Compulsory School Uniform',
            'IB Diploma Programme',
            'International Students Accepted',
            'CRICOS Number',
            'Infrastructure for Special Needs',
            'Special Needs Support',
            'Special needs categories',
            'Suburb',
            'State',
            'Address',
            'PO Box',

            'Reception',

            'Primary Campus',
            'Show Primary Campus On Map',

            'Secondary Campus',
            'Show Secondary Campus On Map',

            'About School',
            'Facilities',
            'Use of Facilities Contact',
            'Instagram',
            'Facebook',
        );
        // $record[] = array('Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email');

        $data = array_reverse($record);
        /*echo "<pre>";
        print_r($data); die();*/

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"special_school_export".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    function export_tertiary()
    {   
        $post = $this->input->post();
        
        $query = $this->db->select('
            s.id,
            s.school_number,
            s.name,
            s.motto,
            s.type,
            s.subtype,
            s.sector,
            s.capmus_location,
            s.telephone_title,
            s.website,
            s.email,
            s.chancellor,
            s.vice_chancellor,
            s.student_support_officer,
            s.student_support_email,
            s.no_of_students,
            s.no_of_teachers,
            s.gender,
            s.religion,
            s.student_association,
            s.student_association_contact,
            s.annual_fees,
            s.boarding,
            s.private_school_bus,
            s.onsite_parking,
            s.scholarship_offer,
            s.busstop_campus,
            s.special_needs_support,
            s.special_need_category,
            s.train_station,
            s.careers_adviser,
            s.student_support,
            s.student_counsellor,
            s.international_students,
            s.cricos_number,
            s.city,
            s.state,
            s.address_1,
            s.po_box,
            s.about,
            s.facilities,
            s.facilities_contact,
            s.primary_campus,
            s.instagram,
            s.facebook,

            ,st.name as state')
        ->from('tbl_school s')
        ->where('s.isDelete',0)
        ->where('s.approval!=',1)
        ->where('s.school_type',4);
        $this->db->join('tbl_state st','st.id=s.state','left');

        $query = $this->db->get();
        $record = $query->result_array();
            /*echo "<pre>";
            print_r($record);*/
        // die();

        $special_need_category = $this->config->item('special_need_category');
        
        foreach ($record as $key => $value) {
            
            $telephone_title = array();
            $option_data = json_decode($value['telephone_title'], true);
            $option = $option_data['option'];
            $optvalue = $option_data['optvalue'];
            foreach ($option as $key_3 => $value_3) {
                 $telephone_title[] = $value_3." - ".$optvalue[$key_3];
            }
            $record[$key]['telephone_title'] = implode(",", $telephone_title);

            //$record[$key]['telephone_title'] = $telephone_title;

            
            $record[$key]['international_students'] = ($value['international_students'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['private_school_bus'] = ($value['private_school_bus'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['onsite_parking'] = ($value['onsite_parking'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['busstop_campus'] = ($value['busstop_campus'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['train_station'] = ($value['train_station'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['careers_adviser'] = ($value['careers_adviser'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['special_needs_support'] = ($value['special_needs_support'] == 0 ) ? 'No' : 'Yes';
            
            $record[$key]['student_support'] = ($value['student_support'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['scholarship_offer'] = ($value['scholarship_offer'] == 0 ) ? 'No' : 'Yes';
            $record[$key]['boarding'] = ($value['boarding'] == 0 ) ? 'No' : 'Yes';
            
            $special_need = explode(",", $value['special_need_category']);
            $special_need_value = "";
            foreach ($special_need_category as $sp_key => $sp_value) {
                if(in_array($sp_key,$special_need)) {
                    $special_need_value .= $sp_value.",";
                }
            }

            $special_need_value;
            $record[$key]['special_need_category'] = $special_need_value;

            $option_data = json_decode($value['primary_campus'], true); 
            $option = $option_data['address'];
            $primary_campus_address = array();
            if($record[$key]['primary_campus']!='' && !empty($option)) {
                $option_data = json_decode($record[$key]['primary_campus'], true);
                $option = $option_data['address'];
                    if(!empty($option)) {
                        foreach ($option as $key2 => $value_2) {
                           $primary_address_arr = explode("!#!", $value_2);
                           $primary_campus_address[] = $primary_address_arr[0]." : ".$primary_address_arr[1]." ".$primary_address_arr[2]." ".$primary_address_arr[4]." ".$primary_address_arr[4];
                        }
                        $record[$key]['primary_campus'] = $primary_campus_address;
                    }
                        $record[$key]['primary_campus'] = "";
            } else {
                $record[$key]['primary_campus'] = "";
            }
            $record[$key]['primary_campus'] = implode(" ::: ", $primary_campus_address);
            // $record[$key]['primary_campus'] = $primary_campus_address;
            
            // $record[$key]['primary_campus'] = str_replace("!#!", " ", $value["primary_campus"]);
            
        }


        /*echo "<pre>";
        print_r($record);
        die();*/
        // die();

        
        /*'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],
        'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
        'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',
        'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],*/
        

        $record[] = array(
            'id',
            'School Number',
            'School Name',
            'motto',
            'Type',
            'Sub Type',
            'sector',
            'Campus locations',
            'Telephone ',
            'Website',
            'Email',
            'Chancellor',
            'Vice Chancellor',
            'Student Support Officer',
            'Student Support Email',
            'No of Student',
            'No of Teacher',
            'gender',
            'Religion',
            'Student Association',
            'Student Association Contact',
            'Annual Fees Average',
            'Student Boarding / Housing',
            'Private School/Shuttle Bus',
            'Onsite Parking',
            'Scholarship Offers',
            'Bus Stop on Campus',
            'Special Needs Infrastructure',
            'Special needs categories',
            'Train station close to Campus',
            'Careers Adviser',
            'Student Support / Counselling',
            'Student Counsellor or Support Contact',
            'International Students Accepted',
            'CRICOS Number',
            'Suburb',
            'State',
            'Address',
            'PO Box',
            'About School',
            'Facilities',
            'Use of Facilities Contact',

            // 'Primary Campus Title',
            'Primary Campus Address',
            // 'Show Primary Campus On Map',

            'Instagram',
            'Facebook',
        );
        // $record[] = array('Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email');

        $data = array_reverse($record);
       /* echo "<pre>";
        print_r($data); die();*/

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"tertiary_school_export".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');

        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }
    
}

?>