<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Importschool extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'term_condition';
        $this->load->library('csvimport');
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

    function import()
    {   
        if(!empty($_FILES["school_file"]["tmp_name"])){

            
            /*if($_FILES["school_file"]["type"] != "text/csv" && $_FILES["school_file"]["type"] != "application/octet-stream" ){

                $message =  array('message' => 'Only CSV file allow.','class'=>'danger');
                $this->session->set_flashdata('msg',$message);
                redirect(ADMIN.'manage-school');

                 'Id', 'Category', 'Email', 'Telephone', 'Mobile', 'Website', 'Prospectus', 'School Number', 'Name', 'Principal', 'No Of Students', 'No Of Teachers', 'Type', 'Sub Type', 'Subtype', 'Sector', 'Department Type', 'Boarding', 'Gender', 'Religion', 'International Students', 'Cricos Number', 'Enrolments Officer', 'Enrolments Officer Email', 'City', 'State', 'Address 1', 'Address 2', 'Address 3', 'Latitude', 'Longitude', 'Reception', 'Po Box', 'Primary Campus', 'Secondary Campus', 'Motto', 'About', 'Student Support', 'Special Needs Support', 'Scholarship Offer', 'International Baccalaureate', 'Selective', 'Funding Year', 'Funding Amount', 'Photos', 'Videos', 'School Logo', 'Show Primary', 'Show Secondary', 'Corporate No', 'Business No', 'Education Portfolio', 'Start Date', 'End Date', 'Is Sponsored', 'Status', 'Approval', 'Reference By', 'Reference Email', 'IsDelete', 'Created Date', 'Updated Date'

            }*/
            $file_data = $this->csvimport->get_array($_FILES["school_file"]["tmp_name"]);
            /*echo "<pre>";
            print_r($file_data);
            die();*/

            if(!empty($file_data)){

                foreach($file_data as $key => $row)
                {   
                    
                    if( $row['Category'] != 'Child Care'){ // Ignore child care
                        $school_list = $this->db->select('id')->from('tbl_school')->where('school_number',$row['School Number'])->get()->result_array();
                        if(!empty($school_list)){

                            $data_update[] = array(
                                'id' => $school_list[0]['id'], 
                                'category' => isset($row['Category'] ) ? $row['Category'] : '', 
                                'email' => isset($row['Email'] ) ? $row['Email'] : '', 
                                'telephone' => isset($row['Telephone'] ) ? $row['Telephone'] : '', 
                                'mobile' => isset($row['Mobile'] ) ? $row['Mobile'] : '', 
                                'website' => isset($row['Website'] ) ? $row['Website'] : '', 
                                'prospectus' => isset($row['Prospectus'] ) ? $row['Prospectus'] : '', 
                                'school_number' => isset($row['School Number'] ) ? $row['School Number'] : '', 
                                'name' => isset($row['Name'] ) ? $row['Name'] : '', 
                                'principal' => isset($row['Principal'] ) ? $row['Principal'] : '', 
                                'no_of_students' => isset($row['No Of Students'] ) ? $row['No Of Students'] : '', 
                                'no_of_teachers' => isset($row['No Of Teachers'] ) ? $row['No Of Teachers'] : '', 
                                'type' => isset($row['Type'] ) ? $row['Type'] : '', 
                                'sub_type' => isset($row['Sub Type'] ) ? $row['Sub Type'] : '', 
                                'subtype' => isset($row['Subtype'] ) ? $row['Subtype'] : '', 
                                'sector' => isset($row['Sector'] ) ? $row['Sector'] : '', 
                                'department_type' => isset($row['Department Type'] ) ? $row['Department Type'] : '', 
                                'boarding' => isset($row['Boarding'] ) ? $row['Boarding'] : '', 
                                'gender' => isset($row['Gender'] ) ? $row['Gender'] : '', 
                                'religion' => isset($row['Religion'] ) ? $row['Religion'] : '', 
                                'international_students' => isset($row['International Students'] ) ? $row['International Students'] : '', 
                                'cricos_number' => isset($row['Cricos Number'] ) ? $row['Cricos Number'] : '', 
                                'enrolments_officer' => isset($row['Enrolments Officer'] ) ? $row['Enrolments Officer'] : '', 
                                'enrolments_officer_email' => isset($row['Enrolments Officer Email'] ) ? $row['Enrolments Officer Email'] : '', 
                                'city' => isset($row['City'] ) ? $row['City'] : '', 
                                'state' => isset($row['State'] ) ? $row['State'] : '', 
                                'address_1' => isset($row['Address 1'] ) ? $row['Address 1'] : '', 
                                'address_2' => isset($row['Address 2'] ) ? $row['Address 2'] : '', 
                                'address_3' => isset($row['Address 3'] ) ? $row['Address 3'] : '', 
                                'latitude' => isset($row['Latitude'] ) ? $row['Latitude'] : '', 
                                'longitude' => isset($row['Longitude'] ) ? $row['Longitude'] : '', 
                                'reception' => isset($row['Reception'] ) ? $row['Reception'] : '', 
                                'po_box' => isset($row['Po Box'] ) ? $row['Po Box'] : '', 
                                'primary_campus' => isset($row['Primary Campus'] ) ? $row['Primary Campus'] : '', 
                                'secondary_campus' => isset($row['Secondary Campus'] ) ? $row['Secondary Campus'] : '', 
                                'motto' => isset($row['Motto'] ) ? $row['Motto'] : '', 
                                'about' => isset($row['About'] ) ? $row['About'] : '', 
                                'student_support' => isset($row['Student Support'] ) ? $row['Student Support'] : '', 
                                'special_needs_support' => isset($row['Special Needs Support'] ) ? $row['Special Needs Support'] : '', 
                                'scholarship_offer' => isset($row['Scholarship Offer'] ) ? $row['Scholarship Offer'] : '', 
                                'international_baccalaureate' => isset($row['International Baccalaureate'] ) ? $row['International Baccalaureate'] : '', 
                                'selective' => isset($row['Selective'] ) ? $row['Selective'] : '', 
                                'funding_year' => isset($row['Funding Year'] ) ? $row['Funding Year'] : '', 
                                'funding_amount' => isset($row['Funding Amount'] ) ? $row['Funding Amount'] : '', 
                                'photos' => isset($row['Photos'] ) ? $row['Photos'] : '', 
                                'videos' => isset($row['Videos'] ) ? $row['Videos'] : '', 
                                'school_logo' => isset($row['School Logo'] ) ? $row['School Logo'] : '', 
                                'show_primary' => isset($row['Show Primary'] ) ? $row['Show Primary'] : '', 
                                'show_secondary' => isset($row['Show Secondary'] ) ? $row['Show Secondary'] : '', 
                                'corporate_no' => isset($row['Corporate No'] ) ? $row['Corporate No'] : '', 
                                'business_no' => isset($row['Business No'] ) ? $row['Business No'] : '', 
                                'education_portfolio' => isset($row['Education Portfolio'] ) ? $row['Education Portfolio'] : '', 
                                'start_date' => isset($row['Start Date'] ) ? $row['Start Date'] : '', 
                                'end_date' => isset($row['End Date'] ) ? $row['End Date'] : '', 
                                'is_sponsored' => isset($row['Is Sponsored'] ) ? $row['Is Sponsored'] : '', 
                                'status' => isset($row['Status'] ) ? $row['Status'] : '', 
                                'approval' => isset($row['Approval'] ) ? $row['Approval'] : '', 
                                'reference_by' => isset($row['Reference By'] ) ? $row['Reference By'] : '', 
                                'reference_email' => isset($row['Reference Email'] ) ? $row['Reference Email'] : '', 
                                'isDelete' => 0
                            ); 

                        }else{

                             $data[] = array(
                                'id' => isset($row['Id'] ) ? $row['Id'] : '', 
                                'category' => isset($row['Category'] ) ? $row['Category'] : '', 
                                'email' => isset($row['Email'] ) ? $row['Email'] : '', 
                                'telephone' => isset($row['Telephone'] ) ? $row['Telephone'] : '', 
                                'mobile' => isset($row['Mobile'] ) ? $row['Mobile'] : '', 
                                'website' => isset($row['Website'] ) ? $row['Website'] : '', 
                                'prospectus' => isset($row['Prospectus'] ) ? $row['Prospectus'] : '', 
                                'school_number' => isset($row['School Number'] ) ? $row['School Number'] : '', 
                                'name' => isset($row['Name'] ) ? $row['Name'] : '', 
                                'principal' => isset($row['Principal'] ) ? $row['Principal'] : '', 
                                'no_of_students' => isset($row['No Of Students'] ) ? $row['No Of Students'] : '', 
                                'no_of_teachers' => isset($row['No Of Teachers'] ) ? $row['No Of Teachers'] : '', 
                                'type' => isset($row['Type'] ) ? $row['Type'] : '', 
                                'sub_type' => isset($row['Sub Type'] ) ? $row['Sub Type'] : '', 
                                'subtype' => isset($row['Subtype'] ) ? $row['Subtype'] : '', 
                                'sector' => isset($row['Sector'] ) ? $row['Sector'] : '', 
                                'department_type' => isset($row['Department Type'] ) ? $row['Department Type'] : '', 
                                'boarding' => isset($row['Boarding'] ) ? $row['Boarding'] : '', 
                                'gender' => isset($row['Gender'] ) ? $row['Gender'] : '', 
                                'religion' => isset($row['Religion'] ) ? $row['Religion'] : '', 
                                'international_students' => isset($row['International Students'] ) ? $row['International Students'] : '', 
                                'cricos_number' => isset($row['Cricos Number'] ) ? $row['Cricos Number'] : '', 
                                'enrolments_officer' => isset($row['Enrolments Officer'] ) ? $row['Enrolments Officer'] : '', 
                                'enrolments_officer_email' => isset($row['Enrolments Officer Email'] ) ? $row['Enrolments Officer Email'] : '', 
                                'city' => isset($row['City'] ) ? $row['City'] : '', 
                                'state' => isset($row['State'] ) ? $row['State'] : '', 
                                'address_1' => isset($row['Address 1'] ) ? $row['Address 1'] : '', 
                                'address_2' => isset($row['Address 2'] ) ? $row['Address 2'] : '', 
                                'address_3' => isset($row['Address 3'] ) ? $row['Address 3'] : '', 
                                'latitude' => isset($row['Latitude'] ) ? $row['Latitude'] : '', 
                                'longitude' => isset($row['Longitude'] ) ? $row['Longitude'] : '', 
                                'reception' => isset($row['Reception'] ) ? $row['Reception'] : '', 
                                'po_box' => isset($row['Po Box'] ) ? $row['Po Box'] : '', 
                                'primary_campus' => isset($row['Primary Campus'] ) ? $row['Primary Campus'] : '', 
                                'secondary_campus' => isset($row['Secondary Campus'] ) ? $row['Secondary Campus'] : '', 
                                'motto' => isset($row['Motto'] ) ? $row['Motto'] : '', 
                                'about' => isset($row['About'] ) ? $row['About'] : '', 
                                'student_support' => isset($row['Student Support'] ) ? $row['Student Support'] : '', 
                                'special_needs_support' => isset($row['Special Needs Support'] ) ? $row['Special Needs Support'] : '', 
                                'scholarship_offer' => isset($row['Scholarship Offer'] ) ? $row['Scholarship Offer'] : '', 
                                'international_baccalaureate' => isset($row['International Baccalaureate'] ) ? $row['International Baccalaureate'] : '', 
                                'selective' => isset($row['Selective'] ) ? $row['Selective'] : '', 
                                'funding_year' => isset($row['Funding Year'] ) ? $row['Funding Year'] : '', 
                                'funding_amount' => isset($row['Funding Amount'] ) ? $row['Funding Amount'] : '', 
                                'photos' => isset($row['Photos'] ) ? $row['Photos'] : '', 
                                'videos' => isset($row['Videos'] ) ? $row['Videos'] : '', 
                                'school_logo' => isset($row['School Logo'] ) ? $row['School Logo'] : '', 
                                'show_primary' => isset($row['Show Primary'] ) ? $row['Show Primary'] : '', 
                                'show_secondary' => isset($row['Show Secondary'] ) ? $row['Show Secondary'] : '', 
                                'corporate_no' => isset($row['Corporate No'] ) ? $row['Corporate No'] : '', 
                                'business_no' => isset($row['Business No'] ) ? $row['Business No'] : '', 
                                'education_portfolio' => isset($row['Education Portfolio'] ) ? $row['Education Portfolio'] : '', 
                                'start_date' => isset($row['Start Date'] ) ? $row['Start Date'] : '', 
                                'end_date' => isset($row['End Date'] ) ? $row['End Date'] : '', 
                                'is_sponsored' => isset($row['Is Sponsored'] ) ? $row['Is Sponsored'] : '', 
                                'status' => isset($row['Status'] ) ? $row['Status'] : '', 
                                'approval' => isset($row['Approval'] ) ? $row['Approval'] : '', 
                                'reference_by' => isset($row['Reference By'] ) ? $row['Reference By'] : '', 
                                'reference_email' => isset($row['Reference Email'] ) ? $row['Reference Email'] : ''
                            ); 

                        }
                    }
                }
                
                if(!empty($data)){
                    $result = $this->db->insert_batch('tbl_school', $data);
                }
                if(!empty($data_update)){
                    $result = $this->db->update_batch('tbl_school', $data_update,'id');
                }

                /*
                $insertdata =  array(
                    "uploaded_by" => $this->session->userdata ('name'),
                    "file_name" => $_FILES["lead"]["name"],
                    "created_date" => date('Y-m-d m:i:s')
                );
                $this->crud->insert("tbl_leads_import_history",$insertdata);
                */

                if($result > 0)
                {   
                    $messge = array('message' => 'School Import successfully','class' => 'success');
                    $this->session->set_flashdata('msg',$messge );
                }
                else
                {
                    $this->session->set_flashdata(
                        'message', 'Something went wrong',
                        'class', 'error'
                    );
                }
            }else{
                $messge = array('message' => 'Import file is Empty','class' => 'danger');
                $this->session->set_flashdata('msg',$messge );
            } 
        }else{
            $message =  array('message' => 'Please Select CSV file.','class'=>'danger');
            $this->session->set_flashdata('msg',$message);
        }               
        redirect(ADMIN.'manage-school');

    }

    function import_general()
    {   
        if(!empty($_FILES["school_file"]["tmp_name"])){

            $file_data = $this->csvimport->get_array($_FILES["school_file"]["tmp_name"]);
            /*  echo "<pre>";
            print_r($file_data);
            die();
            */
            if(!empty($file_data)){
                /*echo "<pre>";
                print_r($file_data);
                echo "</pre>";
                die();*/
                foreach($file_data as $key => $row)
                {   
                    $school_edit = array();
                    if($row['id']!=0) {
                        $school_edit = $this->db->select('id')->from('tbl_school')->where('id',$row['id'])->get()->result_array();                        
                    } 
                    if(!empty($school_edit)) {
                        $data_update[] = array(
                            'school_type' => '1',
                            'id' => isset($row['id']) ? $row['id'] : '',
                            'school_number' => isset($row['School Number']) ? $row['School Number'] : '',
                            'name' => isset($row['School Name']) ? $row['School Name'] : '',
                            'type' => isset($row['Type']) ? $row['Type'] : '',
                            'subtype' => isset($row['Sub Type']) ? $row['Sub Type'] : '',
                            'sector' => isset($row['sector'] ) ? $row['sector'] : '', 
                            'email' => isset($row['Email']) ? $row['Email'] : '',
                            'telephone' => isset($row['Telephone']) ? $row['Telephone'] : '',
                            'corporate_no' => isset($row['Corporate']) ? $row['Corporate'] : '',
                            'business_no' => isset($row['Business']) ? $row['Business'] : '',
                            'website' => isset($row['website']) ? $row['website'] : '',
                            'principal' => isset($row['principal']) ? $row['principal'] : '',
                            'no_of_students' => isset($row['No of Student']) ? $row['No of Student'] : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? $row['No of Teacher'] : '',
                            'gender' => isset($row['gender']) ? $row['gender'] : '',
                            'city' => isset($row['Suburb']) ? $row['Suburb'] : '',
                            'state' => isset($row['State']) ? $row['State'] : '',
                            'address_1' => isset($row['Address']) ? $row['Address'] : '',
                            'reception' => isset($row['Reception Address']) ? $row['Reception Address'] : '',
                            'primary_campus' => isset($row['Primary Campus Address']) ? $row['Primary Campus Address'] : '',
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? $row['Show Primary Campus On Map'] : '',
                            'secondary_campus' => isset($row['Secondary Campus Address']) ? $row['Secondary Campus Address'] : '',
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? $row['Show Secondary Campus On Map'] : '',
                            'po_box' => isset($row['PO Box']) ? $row['PO Box'] : '',
                            'religion' => isset($row['Religion']) ? $row['Religion'] : '',
                            'international_students' => isset($row['International Students Accepted']) ? $row['International Students Accepted'] : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? $row['CRICOS Number'] : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? $row['Enrolment Officer'] : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? $row['Enrolment Officer Email'] : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? $row['Special Needs Support'] : '',
                            'special_need_category' => isset($row['Special needs categories']) ? $row['Special needs categories'] : '',
                            'selective' => isset($row['selective']) ? $row['selective'] : '',
                            'funding_year' => isset($row['Commonwealth Funding Year']) ? $row['Commonwealth Funding Year'] : '',
                            'funding_amount' => isset($row['Commonwealth Funding Amoun']) ? $row['Commonwealth Funding Amoun'] : '',
                            'boarding' => isset($row['Boarding / Housing']) ? $row['Boarding / Housing'] : '',
                            'student_support' => isset($row['Student Support']) ? $row['Student Support'] : '',
                            'motto' => isset($row['School Motto']) ? $row['School Motto'] : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? $row['Scholarship Offers'] : '',
                            'international_baccalaureate' => isset($row['International Baccalaureate School']) ? $row['International Baccalaureate School'] : '',
                            'about' => isset($row['About School']) ? $row['About School'] : '',
                        );
                    } else {
                        $data[] = array(
                            'school_type' => '1',
                            'school_number' => isset($row['School Number']) ? $row['School Number'] : '',
                            'name' => isset($row['School Name']) ? $row['School Name'] : '',
                            'type' => isset($row['Type']) ? $row['Type'] : '',
                            'subtype' => isset($row['Sub Type']) ? $row['Sub Type'] : '',
                            'sector' => isset($row['sector'] ) ? $row['sector'] : '', 
                            'email' => isset($row['Email']) ? $row['Email'] : '',
                            'telephone' => isset($row['Telephone']) ? $row['Telephone'] : '',
                            'corporate_no' => isset($row['Corporate']) ? $row['Corporate'] : '',
                            'business_no' => isset($row['Business']) ? $row['Business'] : '',
                            'website' => isset($row['website']) ? $row['website'] : '',
                            'principal' => isset($row['principal']) ? $row['principal'] : '',
                            'no_of_students' => isset($row['No of Student']) ? $row['No of Student'] : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? $row['No of Teacher'] : '',
                            'gender' => isset($row['gender']) ? $row['gender'] : '',
                            'city' => isset($row['Suburb']) ? $row['Suburb'] : '',
                            'state' => isset($row['State']) ? $row['State'] : '',
                            'address_1' => isset($row['Address']) ? $row['Address'] : '',
                            'reception' => isset($row['Reception Address']) ? $row['Reception Address'] : '',
                            'primary_campus' => isset($row['Primary Campus Address']) ? $row['Primary Campus Address'] : '',
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? $row['Show Primary Campus On Map'] : '',
                            'secondary_campus' => isset($row['Secondary Campus Address']) ? $row['Secondary Campus Address'] : '',
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? $row['Show Secondary Campus On Map'] : '',
                            'po_box' => isset($row['PO Box']) ? $row['PO Box'] : '',
                            'religion' => isset($row['Religion']) ? $row['Religion'] : '',
                            'international_students' => isset($row['International Students Accepted']) ? $row['International Students Accepted'] : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? $row['CRICOS Number'] : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? $row['Enrolment Officer'] : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? $row['Enrolment Officer Email'] : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? $row['Special Needs Support'] : '',
                            'special_need_category' => isset($row['Special needs categories']) ? $row['Special needs categories'] : '',
                            'selective' => isset($row['selective']) ? $row['selective'] : '',
                            'funding_year' => isset($row['Commonwealth Funding Year']) ? $row['Commonwealth Funding Year'] : '',
                            'funding_amount' => isset($row['Commonwealth Funding Amoun']) ? $row['Commonwealth Funding Amoun'] : '',
                            'boarding' => isset($row['Boarding / Housing']) ? $row['Boarding / Housing'] : '',
                            'student_support' => isset($row['Student Support']) ? $row['Student Support'] : '',
                            'motto' => isset($row['School Motto']) ? $row['School Motto'] : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? $row['Scholarship Offers'] : '',
                            'international_baccalaureate' => isset($row['International Baccalaureate School']) ? $row['International Baccalaureate School'] : '',
                            'about' => isset($row['About School']) ? $row['About School'] : '',
                        );
                    }
                    

                }

                if(!empty($data)){
                    $result = $this->db->insert_batch('tbl_school', $data);
                }
                if(!empty($data_update)){
                    $result = $this->db->update_batch('tbl_school', $data_update,'id');
                }

                if($result > 0)
                {   
                    $messge = array('message' => 'School Import successfully','class' => 'success');
                    $this->session->set_flashdata('msg',$messge );
                }
                else
                {
                    $this->session->set_flashdata(
                        'message', 'Something went wrong',
                        'class', 'error'
                    );
                }
            }else{
                $messge = array('message' => 'Import file is Empty','class' => 'danger');
                $this->session->set_flashdata('msg',$messge );
            } 
        }else{
            $message =  array('message' => 'Please Select CSV file.','class'=>'danger');
            $this->session->set_flashdata('msg',$message);
        }               
        redirect(ADMIN.'add-school');

    }


    function import_secoundary()
    {   
        if(!empty($_FILES["school_file"]["tmp_name"])){

            $file_data = $this->csvimport->get_array($_FILES["school_file"]["tmp_name"]);
            /*  echo "<pre>";
            print_r($file_data);
            die();
            */
            if(!empty($file_data)){
                /*echo "<pre>";
                print_r($file_data);
                echo "</pre>";
                die();*/
                foreach($file_data as $key => $row)
                {   
                    $school_edit = array();
                    if($row['id']!=0) {
                        $school_edit = $this->db->select('id')->from('tbl_school')->where('id',$row['id'])->get()->result_array();                        
                    } 
                    if(!empty($school_edit)) {
                        $data_update[] = array(
                            'school_type' => '2',
                            'id' => isset($row['id']) ? $row['id'] : '',
                            'school_number' => isset($row['School Number']) ? ($row['School Number']) : '',
                            'name' => isset($row['School Name']) ? ($row['School Name']) : '',
                            'motto' => isset($row['motto']) ? ($row['motto']) : '',
                            'type' => isset($row['Type']) ? ($row['Type']) : '',
                            'subtype' => isset($row['Sub Type']) ? ($row['Sub Type']) : '',
                            'sector' => isset($row['sector']) ? ($row['sector']) : '',
                            'email' => isset($row['Email']) ? ($row['Email']) : '',
                            'telephone' => isset($row['Primary Campus Number']) ? ($row['Primary Campus Number']) : '',
                            'telephone_2' => isset($row['Secondary Campus Number']) ? ($row['Secondary Campus Number']) : '',
                            'corporate_no' => isset($row['Corporate']) ? ($row['Corporate']) : '',
                            'website' => isset($row['website']) ? ($row['website']) : '',
                            'principal' => isset($row['School Principal']) ? ($row['School Principal']) : '',
                            'dep_principal' => isset($row['Deputy Principal']) ? ($row['Deputy Principal']) : '',
                            'head_of_secondary' => isset($row['Head of Secondary']) ? ($row['Head of Secondary']) : '',
                            'head_of_primary' => isset($row['Head of Primary']) ? ($row['Head of Primary']) : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? ($row['Enrolment Officer']) : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? ($row['Enrolment Officer Email']) : '',
                            'no_of_teachers' => isset($row['No of Student']) ? ($row['No of Student']) : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? ($row['No of Teacher']) : '',
                            'gender' => isset($row['gender']) ? ($row['gender']) : '',
                            'religion' => isset($row['Religion']) ? ($row['Religion']) : '',
                            'parent_association' => isset($row['Parent Association']) ? ($row['Parent Association']) : '',
                            'parent_association_president' => isset($row['Parent Association President']) ? ($row['Parent Association President']) : '',
                            'selective' => isset($row['selective']) ? ($row['selective']) : '',
                            'fees_grade' => isset($row['Annual Fees']) ? ($row['Annual Fees']) : '',
                            'fees_grade_1' => isset($row['Fees']) ? ($row['Fees']) : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? ($row['Student Boarding / Housing']) : '',
                            'private_school_bus' => isset($row['Private School Bus']) ? ($row['Private School Bus']) : '',
                            'school_care' => isset($row['Before and After School Care']) ? ($row['Before and After School Care']) : '',
                            'school_care_number' => isset($row['Before and After School Care Contact']) ? ($row['Before and After School Care Contact']) : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? ($row['Scholarship Offers']) : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? ($row['Bus Stop on Campus']) : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? ($row['Careers Adviser']) : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? ($row['Student Support / Counselling']) : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? ($row['Student Counsellor or Support Contact']) : '',
                            'uniform' => isset($row['Compulsory School Uniform']) ? ($row['Compulsory School Uniform']) : '',
                            'ib_diploma_programme' => isset($row['IB Diploma Programme']) ? ($row['IB Diploma Programme']) : '',
                            'international_students' => isset($row['International Students Accepted']) ? ($row['International Students Accepted']) : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? ($row['CRICOS Number']) : '',
                            'infrastructure_special_needs' => isset($row['Infrastructure for Special Needs']) ? ($row['Infrastructure for Special Needs']) : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? ($row['Special Needs Support']) : '',
                            'special_need_category' => isset($row['Special needs categories']) ? ($row['Special needs categories']) : '',
                            'city' => isset($row['Suburb']) ? ($row['Suburb']) : '',
                            'state' => isset($row['State']) ? ($row['State']) : '',
                            'address_1' => isset($row['Address']) ? ($row['Address']) : '',
                            'po_box' => isset($row['PO Box']) ? ($row['PO Box']) : '',

                            'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],

                            'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',

                            /* 'id' => isset($row['reception suburb']) ? ($row['reception suburb']) : '',
                            'id' => isset($row['reception  state']) ? ($row['reception  state']) : '',
                            'id' => isset($row['reception  address']) ? ($row['reception  address']) : '',
                            'id' => isset($row['reception  po box']) ? ($row['reception  po box']) : '',

                            'id' => isset($row['primary campus suburb']) ? ($row['primary campus suburb']) : '',
                            'id' => isset($row['primary campus state']) ? ($row['primary campus state']) : '',
                            'id' => isset($row['primary campus address']) ? ($row['primary campus address']) : '',
                            'id' => isset($row['primary campus po box']) ? ($row['primary campus po box']) : '',
                            'id' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'id' => isset($row['Secondary Campus  suburb']) ? ($row['Secondary Campus  suburb']) : '',
                            'id' => isset($row['Secondary Campus  state']) ? ($row['Secondary Campus  state']) : '',
                            'id' => isset($row['Secondary Campus  address']) ? ($row['Secondary Campus  address']) : '',
                            'id' => isset($row['Secondary Campus po box']) ? ($row['Secondary Campus po box']) : '',
                            'id' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',*/

                            'about' => isset($row['About School']) ? ($row['About School']) : '',
                            'facilities' => isset($row['Facilities']) ? ($row['Facilities']) : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? ($row['Use of Facilities Contact']) : '',
                            'instagram' => isset($row['Instagram']) ? ($row['Instagram']) : '',
                            'facebook' => isset($row['Facebook']) ? ($row['Facebook']) : '',
                        );
                    } else {
                        $data[] = array(
                            'school_type' => '2',
                            'school_number' => isset($row['School Number']) ? ($row['School Number']) : '',
                            'name' => isset($row['School Name']) ? ($row['School Name']) : '',
                            'motto' => isset($row['motto']) ? ($row['motto']) : '',
                            'type' => isset($row['Type']) ? ($row['Type']) : '',
                            'subtype' => isset($row['Sub Type']) ? ($row['Sub Type']) : '',
                            'sector' => isset($row['sector']) ? ($row['sector']) : '',
                            'email' => isset($row['Email']) ? ($row['Email']) : '',
                            'telephone' => isset($row['Primary Campus Number']) ? ($row['Primary Campus Number']) : '',
                            'telephone_2' => isset($row['Secondary Campus Number']) ? ($row['Secondary Campus Number']) : '',
                            'corporate_no' => isset($row['Corporate']) ? ($row['Corporate']) : '',
                            'website' => isset($row['website']) ? ($row['website']) : '',
                            'principal' => isset($row['School Principal']) ? ($row['School Principal']) : '',
                            'dep_principal' => isset($row['Deputy Principal']) ? ($row['Deputy Principal']) : '',
                            'head_of_secondary' => isset($row['Head of Secondary']) ? ($row['Head of Secondary']) : '',
                            'head_of_primary' => isset($row['Head of Primary']) ? ($row['Head of Primary']) : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? ($row['Enrolment Officer']) : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? ($row['Enrolment Officer Email']) : '',
                            'no_of_students' => isset($row['No of Student']) ? ($row['No of Student']) : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? ($row['No of Teacher']) : '',
                            'gender' => isset($row['gender']) ? ($row['gender']) : '',
                            'religion' => isset($row['Religion']) ? ($row['Religion']) : '',
                            'parent_association' => isset($row['Parent Association']) ? ($row['Parent Association']) : '',
                            'parent_association_president' => isset($row['Parent Association President']) ? ($row['Parent Association President']) : '',
                            'selective' => isset($row['selective']) ? ($row['selective']) : '',
                            'fees_grade' => isset($row['Annual Fees']) ? ($row['Annual Fees']) : '',
                            'fees_grade_1' => isset($row['Fees']) ? ($row['Fees']) : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? ($row['Student Boarding / Housing']) : '',
                            'private_school_bus' => isset($row['Private School Bus']) ? ($row['Private School Bus']) : '',
                            'school_care' => isset($row['Before and After School Care']) ? ($row['Before and After School Care']) : '',
                            'school_care_number' => isset($row['Before and After School Care Contact']) ? ($row['Before and After School Care Contact']) : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? ($row['Scholarship Offers']) : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? ($row['Bus Stop on Campus']) : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? ($row['Careers Adviser']) : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? ($row['Student Support / Counselling']) : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? ($row['Student Counsellor or Support Contact']) : '',
                            'uniform' => isset($row['Compulsory School Uniform']) ? ($row['Compulsory School Uniform']) : '',
                            'ib_diploma_programme' => isset($row['IB Diploma Programme']) ? ($row['IB Diploma Programme']) : '',
                            'international_students' => isset($row['International Students Accepted']) ? ($row['International Students Accepted']) : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? ($row['CRICOS Number']) : '',
                            'infrastructure_special_needs' => isset($row['Infrastructure for Special Needs']) ? ($row['Infrastructure for Special Needs']) : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? ($row['Special Needs Support']) : '',
                            'special_need_category' => isset($row['Special needs categories']) ? ($row['Special needs categories']) : '',
                            'city' => isset($row['Suburb']) ? ($row['Suburb']) : '',
                            'state' => isset($row['State']) ? ($row['State']) : '',
                            'address_1' => isset($row['Address']) ? ($row['Address']) : '',
                            'po_box' => isset($row['PO Box']) ? ($row['PO Box']) : '',
                            'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],
                            'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',
                            'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',

                            /* 'id' => isset($row['reception suburb']) ? ($row['reception suburb']) : '',
                            'id' => isset($row['reception  state']) ? ($row['reception  state']) : '',
                            'id' => isset($row['reception  address']) ? ($row['reception  address']) : '',
                            'id' => isset($row['reception  po box']) ? ($row['reception  po box']) : '',

                            'id' => isset($row['primary campus suburb']) ? ($row['primary campus suburb']) : '',
                            'id' => isset($row['primary campus state']) ? ($row['primary campus state']) : '',
                            'id' => isset($row['primary campus address']) ? ($row['primary campus address']) : '',
                            'id' => isset($row['primary campus po box']) ? ($row['primary campus po box']) : '',
                            'id' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'id' => isset($row['Secondary Campus  suburb']) ? ($row['Secondary Campus  suburb']) : '',
                            'id' => isset($row['Secondary Campus  state']) ? ($row['Secondary Campus  state']) : '',
                            'id' => isset($row['Secondary Campus  address']) ? ($row['Secondary Campus  address']) : '',
                            'id' => isset($row['Secondary Campus po box']) ? ($row['Secondary Campus po box']) : '',
                            'id' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',*/

                            'about' => isset($row['About School']) ? ($row['About School']) : '',
                            'facilities' => isset($row['Facilities']) ? ($row['Facilities']) : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? ($row['Use of Facilities Contact']) : '',
                            'instagram' => isset($row['Instagram']) ? ($row['Instagram']) : '',
                            'facebook' => isset($row['Facebook']) ? ($row['Facebook']) : '',
                        );
                    }
                    

                }

                /*echo "<pre>";
                print_r($data);
                die();*/
                if(!empty($data)){
                    $result = $this->db->insert_batch('tbl_school', $data);
                }
                if(!empty($data_update)){
                    $result = $this->db->update_batch('tbl_school', $data_update,'id');
                }
                /*echo $this->db->last_query();
                die();*/

                if($result > 0)
                {   
                    $messge = array('message' => 'School Import successfully','class' => 'success');
                    $this->session->set_flashdata('msg',$messge );
                }
                else
                {
                    $this->session->set_flashdata(
                        'message', 'Something went wrong',
                        'class', 'error'
                    );
                }
            }else{
                $messge = array('message' => 'Import file is Empty','class' => 'danger');
                $this->session->set_flashdata('msg',$messge );
            } 
        }else{
            $message =  array('message' => 'Please Select CSV file.','class'=>'danger');
            $this->session->set_flashdata('msg',$message);
        }               
        redirect(ADMIN.'add-school');

    }

    function import_special()
    {   
        if(!empty($_FILES["school_file"]["tmp_name"])){

            $file_data = $this->csvimport->get_array($_FILES["school_file"]["tmp_name"]);
            /*echo "<pre>";
            print_r($file_data);
            die();*/
            
            if(!empty($file_data)){
                /*echo "<pre>";
                print_r($file_data);
                echo "</pre>";
                die();*/
                foreach($file_data as $key => $row)
                {   
                    $school_edit = array();
                    if($row['id']!=0) {
                        $school_edit = $this->db->select('id')->from('tbl_school')->where('id',$row['id'])->get()->result_array();                        
                    } 
                    if(!empty($school_edit)) {
                        $data_update[] = array(
                            'school_type' => '3',
                            'id' => isset($row['id']) ? $row['id'] : '',
                            'school_number' => isset($row['School Number']) ? ($row['School Number']) : '',
                            'name' => isset($row['School Name']) ? ($row['School Name']) : '',
                            'motto' => isset($row['motto']) ? ($row['motto']) : '',
                            'type' => isset($row['Type']) ? ($row['Type']) : '',
                            'subtype' => isset($row['Sub Type']) ? ($row['Sub Type']) : '',
                            'sector' => isset($row['sector']) ? ($row['sector']) : '',
                            'email' => isset($row['Email']) ? ($row['Email']) : '',
                            'telephone' => isset($row['Primary Campus Number']) ? ($row['Primary Campus Number']) : '',
                            'telephone_2' => isset($row['Secondary Campus Number']) ? ($row['Secondary Campus Number']) : '',
                            'corporate_no' => isset($row['Corporate']) ? ($row['Corporate']) : '',
                            'website' => isset($row['website']) ? ($row['website']) : '',
                            'principal' => isset($row['School Principal']) ? ($row['School Principal']) : '',
                            'dep_principal' => isset($row['Deputy Principal']) ? ($row['Deputy Principal']) : '',
                            'head_of_secondary' => isset($row['Head of Secondary']) ? ($row['Head of Secondary']) : '',
                            'head_of_primary' => isset($row['Head of Primary']) ? ($row['Head of Primary']) : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? ($row['Enrolment Officer']) : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? ($row['Enrolment Officer Email']) : '',
                            'no_of_teachers' => isset($row['No of Student']) ? ($row['No of Student']) : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? ($row['No of Teacher']) : '',
                            'gender' => isset($row['gender']) ? ($row['gender']) : '',
                            'religion' => isset($row['Religion']) ? ($row['Religion']) : '',
                            'parent_association' => isset($row['Parent Association']) ? ($row['Parent Association']) : '',
                            'parent_association_president' => isset($row['Parent Association President']) ? ($row['Parent Association President']) : '',
                            'selective' => isset($row['selective']) ? ($row['selective']) : '',
                            'fees_grade' => isset($row['Annual Fees']) ? ($row['Annual Fees']) : '',
                            'fees_grade_1' => isset($row['Fees']) ? ($row['Fees']) : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? ($row['Student Boarding / Housing']) : '',
                            'private_school_bus' => isset($row['Private School Bus']) ? ($row['Private School Bus']) : '',
                            'school_care' => isset($row['Before and After School Care']) ? ($row['Before and After School Care']) : '',
                            'school_care_number' => isset($row['Before and After School Care Contact']) ? ($row['Before and After School Care Contact']) : '',
                            
                            'speech_phthologist' => isset($row['Speech Pathologist Onsite']) ? ($row['Speech Pathologist Onsite']) : '',
                            'occupational_therapist' => isset($row['Occupational Therapist Onsite']) ? ($row['Occupational Therapist Onsite']) : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? ($row['Scholarship Offers']) : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? ($row['Bus Stop on Campus']) : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? ($row['Careers Adviser']) : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? ($row['Student Support / Counselling']) : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? ($row['Student Counsellor or Support Contact']) : '',
                            'uniform' => isset($row['Compulsory School Uniform']) ? ($row['Compulsory School Uniform']) : '',
                            'ib_diploma_programme' => isset($row['IB Diploma Programme']) ? ($row['IB Diploma Programme']) : '',
                            'international_students' => isset($row['International Students Accepted']) ? ($row['International Students Accepted']) : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? ($row['CRICOS Number']) : '',
                            'infrastructure_special_needs' => isset($row['Infrastructure for Special Needs']) ? ($row['Infrastructure for Special Needs']) : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? ($row['Special Needs Support']) : '',
                            'special_need_category' => isset($row['Special needs categories']) ? ($row['Special needs categories']) : '',
                            'city' => isset($row['Suburb']) ? ($row['Suburb']) : '',
                            'state' => isset($row['State']) ? ($row['State']) : '',
                            'address_1' => isset($row['Address']) ? ($row['Address']) : '',
                            'po_box' => isset($row['PO Box']) ? ($row['PO Box']) : '',

                            'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],

                            'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',

                            /* 'id' => isset($row['reception suburb']) ? ($row['reception suburb']) : '',
                            'id' => isset($row['reception  state']) ? ($row['reception  state']) : '',
                            'id' => isset($row['reception  address']) ? ($row['reception  address']) : '',
                            'id' => isset($row['reception  po box']) ? ($row['reception  po box']) : '',

                            'id' => isset($row['primary campus suburb']) ? ($row['primary campus suburb']) : '',
                            'id' => isset($row['primary campus state']) ? ($row['primary campus state']) : '',
                            'id' => isset($row['primary campus address']) ? ($row['primary campus address']) : '',
                            'id' => isset($row['primary campus po box']) ? ($row['primary campus po box']) : '',
                            'id' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'id' => isset($row['Secondary Campus  suburb']) ? ($row['Secondary Campus  suburb']) : '',
                            'id' => isset($row['Secondary Campus  state']) ? ($row['Secondary Campus  state']) : '',
                            'id' => isset($row['Secondary Campus  address']) ? ($row['Secondary Campus  address']) : '',
                            'id' => isset($row['Secondary Campus po box']) ? ($row['Secondary Campus po box']) : '',
                            'id' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',*/

                            'about' => isset($row['About School']) ? ($row['About School']) : '',
                            'facilities' => isset($row['Facilities']) ? ($row['Facilities']) : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? ($row['Use of Facilities Contact']) : '',
                            'instagram' => isset($row['Instagram']) ? ($row['Instagram']) : '',
                            'facebook' => isset($row['Facebook']) ? ($row['Facebook']) : '',
                        );
                    } else {
                        $data[] = array(
                            'school_type' => '3',
                            'school_number' => isset($row['School Number']) ? ($row['School Number']) : '',
                            'name' => isset($row['School Name']) ? ($row['School Name']) : '',
                            'motto' => isset($row['motto']) ? ($row['motto']) : '',
                            'type' => isset($row['Type']) ? ($row['Type']) : '',
                            'subtype' => isset($row['Sub Type']) ? ($row['Sub Type']) : '',
                            'sector' => isset($row['sector']) ? ($row['sector']) : '',
                            'email' => isset($row['Email']) ? ($row['Email']) : '',
                            'telephone' => isset($row['Primary Campus Number']) ? ($row['Primary Campus Number']) : '',
                            'telephone_2' => isset($row['Secondary Campus Number']) ? ($row['Secondary Campus Number']) : '',
                            'corporate_no' => isset($row['Corporate']) ? ($row['Corporate']) : '',
                            'website' => isset($row['website']) ? ($row['website']) : '',
                            'principal' => isset($row['School Principal']) ? ($row['School Principal']) : '',
                            'dep_principal' => isset($row['Deputy Principal']) ? ($row['Deputy Principal']) : '',
                            'head_of_secondary' => isset($row['Head of Secondary']) ? ($row['Head of Secondary']) : '',
                            'head_of_primary' => isset($row['Head of Primary']) ? ($row['Head of Primary']) : '',
                            'enrolments_officer' => isset($row['Enrolment Officer']) ? ($row['Enrolment Officer']) : '',
                            'enrolments_officer_email' => isset($row['Enrolment Officer Email']) ? ($row['Enrolment Officer Email']) : '',
                            'no_of_students' => isset($row['No of Student']) ? ($row['No of Student']) : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? ($row['No of Teacher']) : '',
                            'gender' => isset($row['gender']) ? ($row['gender']) : '',
                            'religion' => isset($row['Religion']) ? ($row['Religion']) : '',
                            'parent_association' => isset($row['Parent Association']) ? ($row['Parent Association']) : '',
                            'parent_association_president' => isset($row['Parent Association President']) ? ($row['Parent Association President']) : '',
                            'selective' => isset($row['selective']) ? ($row['selective']) : '',
                            'fees_grade' => isset($row['Annual Fees']) ? ($row['Annual Fees']) : '',
                            'fees_grade_1' => isset($row['Fees']) ? ($row['Fees']) : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? ($row['Student Boarding / Housing']) : '',
                            'private_school_bus' => isset($row['Private School Bus']) ? ($row['Private School Bus']) : '',
                            'school_care' => isset($row['Before and After School Care']) ? ($row['Before and After School Care']) : '',
                            'school_care_number' => isset($row['Before and After School Care Contact']) ? ($row['Before and After School Care Contact']) : '',
                            'speech_phthologist' => isset($row['Speech Pathologist Onsite']) ? ($row['Speech Pathologist Onsite']) : '',
                            'occupational_therapist' => isset($row['Occupational Therapist Onsite']) ? ($row['Occupational Therapist Onsite']) : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? ($row['Scholarship Offers']) : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? ($row['Bus Stop on Campus']) : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? ($row['Careers Adviser']) : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? ($row['Student Support / Counselling']) : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? ($row['Student Counsellor or Support Contact']) : '',
                            'uniform' => isset($row['Compulsory School Uniform']) ? ($row['Compulsory School Uniform']) : '',
                            'ib_diploma_programme' => isset($row['IB Diploma Programme']) ? ($row['IB Diploma Programme']) : '',
                            'international_students' => isset($row['International Students Accepted']) ? ($row['International Students Accepted']) : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? ($row['CRICOS Number']) : '',
                            'infrastructure_special_needs' => isset($row['Infrastructure for Special Needs']) ? ($row['Infrastructure for Special Needs']) : '',
                            'special_needs_support' => isset($row['Special Needs Support']) ? ($row['Special Needs Support']) : '',
                            'special_need_category' => isset($row['Special needs categories']) ? ($row['Special needs categories']) : '',
                            'city' => isset($row['Suburb']) ? ($row['Suburb']) : '',
                            'state' => isset($row['State']) ? ($row['State']) : '',
                            'address_1' => isset($row['Address']) ? ($row['Address']) : '',
                            'po_box' => isset($row['PO Box']) ? ($row['PO Box']) : '',
                            'reception' => $row["reception suburb"]."!#!".$row["reception  state"]."!#!".$row["reception  address"]."!#!".$row["reception  po box"],
                            'primary_campus' => $row["primary campus suburb"]."!#!".$row["primary campus state"]."!#!".$row["primary campus address"]."!#!".$row["primary campus po box"],
                            'show_primary' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',
                            'secondary_campus' => $row["Secondary Campus  suburb"]."!#!".$row["Secondary Campus  state"]."!#!".$row["Secondary Campus  address"]."!#!".$row["Secondary Campus po box"],
                            'show_secondary' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',

                            /* 'id' => isset($row['reception suburb']) ? ($row['reception suburb']) : '',
                            'id' => isset($row['reception  state']) ? ($row['reception  state']) : '',
                            'id' => isset($row['reception  address']) ? ($row['reception  address']) : '',
                            'id' => isset($row['reception  po box']) ? ($row['reception  po box']) : '',

                            'id' => isset($row['primary campus suburb']) ? ($row['primary campus suburb']) : '',
                            'id' => isset($row['primary campus state']) ? ($row['primary campus state']) : '',
                            'id' => isset($row['primary campus address']) ? ($row['primary campus address']) : '',
                            'id' => isset($row['primary campus po box']) ? ($row['primary campus po box']) : '',
                            'id' => isset($row['Show Primary Campus On Map']) ? ($row['Show Primary Campus On Map']) : '',

                            'id' => isset($row['Secondary Campus  suburb']) ? ($row['Secondary Campus  suburb']) : '',
                            'id' => isset($row['Secondary Campus  state']) ? ($row['Secondary Campus  state']) : '',
                            'id' => isset($row['Secondary Campus  address']) ? ($row['Secondary Campus  address']) : '',
                            'id' => isset($row['Secondary Campus po box']) ? ($row['Secondary Campus po box']) : '',
                            'id' => isset($row['Show Secondary Campus On Map']) ? ($row['Show Secondary Campus On Map']) : '',*/

                            'about' => isset($row['About School']) ? ($row['About School']) : '',
                            'facilities' => isset($row['Facilities']) ? ($row['Facilities']) : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? ($row['Use of Facilities Contact']) : '',
                            'instagram' => isset($row['Instagram']) ? ($row['Instagram']) : '',
                            'facebook' => isset($row['Facebook']) ? ($row['Facebook']) : '',
                        );
                    }
                    

                }

                /*echo "<pre>";
                print_r($data);
                die();*/
                if(!empty($data)){
                    $result = $this->db->insert_batch('tbl_school', $data);
                }
                if(!empty($data_update)){
                    $result = $this->db->update_batch('tbl_school', $data_update,'id');
                }
                /*echo $this->db->last_query();
                die();*/

                if($result > 0)
                {   
                    $messge = array('message' => 'School Import successfully','class' => 'success');
                    $this->session->set_flashdata('msg',$messge );
                }
                else
                {
                    $this->session->set_flashdata(
                        'message', 'Something went wrong',
                        'class', 'error'
                    );
                }
            }else{
                $messge = array('message' => 'Import file is Empty','class' => 'danger');
                $this->session->set_flashdata('msg',$messge );
            } 
        }else{
            $message =  array('message' => 'Please Select CSV file.','class'=>'danger');
            $this->session->set_flashdata('msg',$message);
        }               
        redirect(ADMIN.'add-school');

    }

    function import_tertiary()
    {   
        if(!empty($_FILES["school_file"]["tmp_name"])){

            $file_data = $this->csvimport->get_array($_FILES["school_file"]["tmp_name"]);
            /*echo "------";
            echo "<pre>";
            print_r($file_data);
            die();*/
            
            if(!empty($file_data)){
               /* echo "<pre>";
                print_r($file_data);
                echo "</pre>";*/
                // die();
                foreach($file_data as $key => $row)
                {   
                    $optionData = array();

                    $tel_title = isset($row['Telephone Title']) ? $row['Telephone Title'] : '';
                    $tel_no = isset($row['Telephone']) ? $row['Telephone'] : '';

                    $optionData['option'] = array($tel_title);
                    $optionData['optvalue'] = array($tel_no);
                    
                    foreach ($optionData as $key => $optionDatavalue) {
                        $optionData[$key] = array_filter($optionDatavalue);
                    }
                    $telephone_title = json_encode($optionData);
                    

                   

                    $primary_campus = !empty($row["primary campus address"]) ?   array($row["primary campus address"]) : array();
                    $primary_campus_title = !empty($row["primary campus title"]) ?   array($row["primary campus title"]) : array();
                    $primary_address_suburb = !empty($row["primary campus suburb"]) ?   array($row["primary campus suburb"]) : array();
                    $primary_state = !empty($row["primary campus state"]) ?   array($row["primary campus state"]) : array();
                    $primary_po_box = !empty($row["primary campus po box"]) ?   array($row["primary campus po box"]) : array();
                    $show_primary = !empty($row["Show Primary Campus On Map"]) ?   array($row["Show Primary Campus On Map"]) : array();
                    // $checkbox_value = $post["checkbox_value"];

                    
                    
                    $primarycampus = array();
                    foreach ($primary_campus as $key => $value) {
                        if($value!='') {
                            $primary_campus_title[$key];
                            $primary_address_suburb[$key];
                            $primary_state[$key];
                            $primary_po_box[$key];
                            $primary_campus = $value;
                            $show_primary[$key];
                            
                            $primarycampus[] = $primary_campus_title[$key]."!#!".$primary_address_suburb[$key]."!#!".$primary_state[$key]."!#!".$primary_po_box[$key]."!#!".$primary_campus."!#!".$show_primary[$key];
                        }
                    }

                    $PrimaryCampusData['address'] = $primarycampus;
                    
                    foreach ($PrimaryCampusData as $key => $optionDatavalue) {
                        $primary_campus_address[$key] = array_filter($optionDatavalue);
                    }
                    $primary_campus = json_encode($primary_campus_address);

                    $school_edit = array();
                    if($row['id']!=0) {
                        $school_edit = $this->db->select('id')->from('tbl_school')->where('id',$row['id'])->get()->result_array();                        
                    } 
                    if(!empty($school_edit)) {
                        $data_update[] = array(
                            'id' => isset($row['id']) ? $row['id'] : '',
                            'school_type' => '4',
                            'school_number' => isset($row['School Number']) ? $row['School Number'] : '',
                            'name' => isset($row['School Name']) ? $row['School Name'] : '',
                            'motto' => isset($row['motto']) ? $row['motto'] : '',
                            'type' => isset($row['Type']) ? $row['Type'] : '',
                            'subtype' => isset($row['Sub Type']) ? $row['Sub Type'] : '',
                            'sector' => isset($row['sector']) ? $row['sector'] : '',
                            'capmus_location' => isset($row['Campus locations']) ? $row['Campus locations'] : '',
                            'telephone_title' => $telephone_title,
                            'website' => isset($row['Website']) ? $row['Website'] : '',
                            'email' => isset($row['Email']) ? $row['Email'] : '',
                            'chancellor' => isset($row['Chancellor']) ? $row['Chancellor'] : '',
                            'vice_chancellor' => isset($row['Vice Chancellor']) ? $row['Vice Chancellor'] : '',
                            'student_support_officer' => isset($row['Student Support Officer']) ? $row['Student Support Officer'] : '',
                            'student_support_email' => isset($row['Student Support Email']) ? $row['Student Support Email'] : '',
                            'no_of_students' => isset($row['No of Student']) ? $row['No of Student'] : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? $row['No of Teacher'] : '',
                            'gender' => isset($row['gender']) ? $row['gender'] : '',
                            'religion' => isset($row['Religion']) ? $row['Religion'] : '',
                            'student_association' => isset($row['Student Association']) ? $row['Student Association'] : '',
                            'student_association_contact' => isset($row['Student Association Contact']) ? $row['Student Association Contact'] : '',
                            'annual_fees' => isset($row['Annual Fees Average']) ? $row['Annual Fees Average'] : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? $row['Student Boarding / Housing'] : '',
                            'private_school_bus' => isset($row['Private School/Shuttle Bus']) ? $row['Private School/Shuttle Bus'] : '',
                            'onsite_parking' => isset($row['Onsite Parking']) ? $row['Onsite Parking'] : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? $row['Scholarship Offers'] : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? $row['Bus Stop on Campus'] : '',
                            'special_needs_support' => isset($row['Special Needs Infrastructure']) ? $row['Special Needs Infrastructure'] : '',
                            'special_need_category' => isset($row['Special needs categories']) ? $row['Special needs categories'] : '',
                            'train_station' => isset($row['Train station close to Campus']) ? $row['Train station close to Campus'] : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? $row['Careers Adviser'] : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? $row['Student Support / Counselling'] : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? $row['Student Counsellor or Support Contact'] : '',
                            'international_students' => isset($row['International Students Accepted']) ? $row['International Students Accepted'] : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? $row['CRICOS Number'] : '',
                            'city' => isset($row['Suburb']) ? $row['Suburb'] : '',
                            'state' => isset($row['State']) ? $row['State'] : '',
                            'address_1' => isset($row['Address']) ? $row['Address'] : '',
                            'po_box' => isset($row['PO Box']) ? $row['PO Box'] : '',

                          /*  'id' => isset($row['primary campus suburb']) ? $row['primary campus suburb'] : '',
                            'id' => isset($row['primary campus state']) ? $row['primary campus state'] : '',
                            'id' => isset($row['primary campus address']) ? $row['primary campus address'] : '',
                            'id' => isset($row['primary campus po box']) ? $row['primary campus po box'] : '',*/


                            'about' => isset($row['About School']) ? $row['About School'] : '',
                            'facilities' => isset($row['Facilities']) ? $row['Facilities'] : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? $row['Use of Facilities Contact'] : '',

                            'primary_campus' => $primary_campus,               
                            'instagram' => isset($row['Instagram']) ? $row['Instagram'] : '',
                            'facebook' => isset($row['Facebook']) ? $row['Facebook'] : '',
                        );
                    } else {

                        


                        $data[] = array(
                            'school_type' => '4',
                            'school_number' => isset($row['School Number']) ? $row['School Number'] : '',
                            'name' => isset($row['School Name']) ? $row['School Name'] : '',
                            'motto' => isset($row['motto']) ? $row['motto'] : '',
                            'type' => isset($row['Type']) ? $row['Type'] : '',
                            'subtype' => isset($row['Sub Type']) ? $row['Sub Type'] : '',
                            'sector' => isset($row['sector']) ? $row['sector'] : '',
                            'capmus_location' => isset($row['Campus locations']) ? $row['Campus locations'] : '',
                            'telephone_title' => $telephone_title,

                            'website' => isset($row['Website']) ? $row['Website'] : '',
                            'email' => isset($row['Email']) ? $row['Email'] : '',
                            'chancellor' => isset($row['Chancellor']) ? $row['Chancellor'] : '',
                            'vice_chancellor' => isset($row['Vice Chancellor']) ? $row['Vice Chancellor'] : '',
                            'student_support_officer' => isset($row['Student Support Officer']) ? $row['Student Support Officer'] : '',
                            'student_support_email' => isset($row['Student Support Email']) ? $row['Student Support Email'] : '',
                            'no_of_students' => isset($row['No of Student']) ? $row['No of Student'] : '',
                            'no_of_teachers' => isset($row['No of Teacher']) ? $row['No of Teacher'] : '',
                            'gender' => isset($row['gender']) ? $row['gender'] : '',
                            'religion' => isset($row['Religion']) ? $row['Religion'] : '',
                            'student_association' => isset($row['Student Association']) ? $row['Student Association'] : '',
                            'student_association_contact' => isset($row['Student Association Contact']) ? $row['Student Association Contact'] : '',
                            'annual_fees' => isset($row['Annual Fees Average']) ? $row['Annual Fees Average'] : '',
                            'boarding' => isset($row['Student Boarding / Housing']) ? $row['Student Boarding / Housing'] : '',
                            'private_school_bus' => isset($row['Private School/Shuttle Bus']) ? $row['Private School/Shuttle Bus'] : '',
                            'onsite_parking' => isset($row['Onsite Parking']) ? $row['Onsite Parking'] : '',
                            'scholarship_offer' => isset($row['Scholarship Offers']) ? $row['Scholarship Offers'] : '',
                            'busstop_campus' => isset($row['Bus Stop on Campus']) ? $row['Bus Stop on Campus'] : '',
                            'special_needs_support' => isset($row['Special Needs Infrastructure']) ? $row['Special Needs Infrastructure'] : '',
                            'special_need_category' => isset($row['Special needs categories']) ? $row['Special needs categories'] : '',
                            'train_station' => isset($row['Train station close to Campus']) ? $row['Train station close to Campus'] : '',
                            'careers_adviser' => isset($row['Careers Adviser']) ? $row['Careers Adviser'] : '',
                            'student_support' => isset($row['Student Support / Counselling']) ? $row['Student Support / Counselling'] : '',
                            'student_counsellor' => isset($row['Student Counsellor or Support Contact']) ? $row['Student Counsellor or Support Contact'] : '',
                            'international_students' => isset($row['International Students Accepted']) ? $row['International Students Accepted'] : '',
                            'cricos_number' => isset($row['CRICOS Number']) ? $row['CRICOS Number'] : '',
                            'city' => isset($row['Suburb']) ? $row['Suburb'] : '',
                            'state' => isset($row['State']) ? $row['State'] : '',
                            'address_1' => isset($row['Address']) ? $row['Address'] : '',
                            'po_box' => isset($row['PO Box']) ? $row['PO Box'] : '',

                          /*  'id' => isset($row['primary campus suburb']) ? $row['primary campus suburb'] : '',
                            'id' => isset($row['primary campus state']) ? $row['primary campus state'] : '',
                            'id' => isset($row['primary campus address']) ? $row['primary campus address'] : '',
                            'id' => isset($row['primary campus po box']) ? $row['primary campus po box'] : '',*/


                            'about' => isset($row['About School']) ? $row['About School'] : '',
                            'facilities' => isset($row['Facilities']) ? $row['Facilities'] : '',
                            'facilities_contact' => isset($row['Use of Facilities Contact']) ? $row['Use of Facilities Contact'] : '',

                            'primary_campus' => $primary_campus,               
                            'instagram' => isset($row['Instagram']) ? $row['Instagram'] : '',
                            'facebook' => isset($row['Facebook']) ? $row['Facebook'] : '',
                        );
                    }
                    

                }

                /*echo "<pre>";
                print_r($data);
                die();*/
                if(!empty($data)){
                    $result = $this->db->insert_batch('tbl_school', $data);
                }
                if(!empty($data_update)){
                    $result = $this->db->update_batch('tbl_school', $data_update,'id');
                }
               /* echo $this->db->last_query();
                die();*/

                if($result > 0)
                {   
                    $messge = array('message' => 'School Import successfully','class' => 'success');
                    $this->session->set_flashdata('msg',$messge );
                }
                else
                {
                    $this->session->set_flashdata(
                        'message', 'Something went wrong',
                        'class', 'error'
                    );
                }
            }else{
                $messge = array('message' => 'Import file is Empty','class' => 'danger');
                $this->session->set_flashdata('msg',$messge );
            } 
        }else{
            $message =  array('message' => 'Please Select CSV file.','class'=>'danger');
            $this->session->set_flashdata('msg',$message);
        }               
        redirect(ADMIN.'add-school');

    }

    function ajax_datatable(){
        
        $tablename = base64_encode($this->table);
        $tableId = base64_encode('business_id');

        $config['select'] = 'lh.*';
        $config['table'] = 'tbl_leads_import_history lh';
        
        $config['column_order'] = array('lh.uploaded_by','lh.file_name','lh.created_date');
        $config['column_search'] = array('lh.uploaded_by','lh.file_name','lh.created_date');         
        $config['order'] = array('id' => 'desc');
        $this->load->library('datatables', $config, 'datatable');
        $records = $this->datatable->get_datatables();
        $data = array();

        foreach ($records as $record) {
          
            $action = '';
            $row = array();
            $row[] = $record->uploaded_by;
            $row[] = $record->file_name;
            $row[] = $record->created_date;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
   
   
}

?>