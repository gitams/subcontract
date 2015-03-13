<?php   if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class No_profile_employer extends CI_Controller
{
    private $_utilities_model;
    private $_viewArray;
    private $_loginDetails;
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedin')) {
            redirect('landing/index');
        }
        $this->load->model('company_details_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        //$userDetails = $this->session->userdata('userLoginDetails');
        //print'<pre>'; print_r($userDetails);
        //$contactId = $userDetails->contactid;
        $this->_utilities_model = $this->load->model('utilities_model', '', TRUE);
        $this->check_isValidated();
    }
    private function check_isValidated() {
        $userDetails = $this->session->userdata('userLoginDetails');
        $contact_type_id = $userDetails->contacttypeid;
        if ($contact_type_id == 4) {
            redirect('no_profile');
        }
    }
    public function index() {
        try {
            $this->_loginDetails = $this->session->userdata('userLoginDetails');
            //print"<pre>"; print_r($this->_loginDetails); //exit;
            $contactId = $this->_loginDetails->contactid;
            $accountId = $this->_loginDetails->accountid;
            $profileCheck = $this->company_details_model->checkProfileEmployer($accountId);
            $profileExist = count($profileCheck);
            //print $profileExist; exit;
            if ($profileExist != 0) {
                $p = $this->company_details_model->getProfile($contactId);
                $this->_viewArray['profile'] = $p[0];
                $this->_viewArray['pExist'] = $profileExist;
                $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
                $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
                $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
                $this->load->view('after_register_login', $this->_viewArray);
            } else {
                redirect('dashboard/index');
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function getStates()
    {
        //print_r($_GET); exit;
        $viewArray['states'] = $this->_utilities_model->fetchStates(trim($_POST['countryId']));
        $this->load->view('partials/getstates', $viewArray);
    }

    public function getCities()
    {
        $viewArray['cities'] = $this->_utilities_model->fetchCities(trim($_POST['stateId']));
        $this->load->view('partials/getcities', $viewArray);
    }
    public function saveEmployer() {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId = $userDetails->contactid;
            $accountId = $userDetails->accountid;
            //print'<pre>';print_r($_POST); exit;

            $data['locationname']     = trim($_POST['fAddress']);
            $data['latitude']     = $_POST['latitude'];
            $data['longitude']     = $_POST['longitude'];
            //$data['address']     = $_POST['address1']." ".$_POST['address2'];
            $data['status']         = 1;
            $data['createddate']   = date("Y-m-d");
            $locationId = $this->company_details_model->insert_location_after_login($data);
            //print'<pre>';print_r($_POST); exit;

            $alData['accountid'] = $accountId;
            $alData['locationid'] = $locationId;
            $alData['status'] = 1;
            $alData['createdby'] = $accountId;
            $alData['createddate'] = date("Y-m-d");
            $accLoc = $this->company_details_model->insert_account_location_after_login($alData);

            $indus['industrytype'] = $_POST['industry'];
            $indusUp = $this->company_details_model->update_industry_after_login($indus,$accountId);

            $contact['first_name'] = trim($_POST['contactName']);
            $contact['phonenumber'] = trim($_POST['contactNumber']);
            $conUp = $this->company_details_model->update_contact_after_login($contact,$accountId);

            $social['asu_account_id'] = $accountId;
            $social['asu_contact_id'] = $contactId;
            $social['asu_website'] = $_POST['website'];
            $socialIns = $this->company_details_model->insert_website_after_login($social);

            $name = $this->company_details_model->getUserName($accountId);
            $name = $name[0];
            //print_r($name->first_name);exit;
            $username = $name->first_name. ' ' .$name->last_name;
            $this->session->unset_userdata('username');
            $this->session->set_userdata('username', $username);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Profile Creation Successful';
            $this->session->set_flashdata('error', $error);
            redirect('dashboard/index');
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function signout() {
        $this->session->unset_userdata('isLoggedin');
        $this->session->unset_userdata('userLoginDetails');
        redirect(base_url());
    }
}
