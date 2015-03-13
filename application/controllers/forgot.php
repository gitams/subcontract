<?php
if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Forgot extends CI_Controller
{

    private $_utilities_model;
    private $_jobOperations_model;
    private $_requestRelations_model;
    private $_viewArray;
    private $_loginDetails;

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedin')) {
            redirect('landing/index');
        }
        $this->check_isValidated();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('vendors_model');
        $this->_utilities_model = $this->load->model('utilities_model', '', TRUE);
        $this->_jobOperations_model = $this->load->model('job_operations_model', '', TRUE);
        $this->_requestRelations_model = $this->load->model('request_relations_model', '', TRUE);
        $this->_loginDetails = $this->session->userdata('userLoginDetails');
        //print'<pre>'; print_r($this->_loginDetails);exit;
        $requests = $this->_requestRelations_model->fetchIncomingRequests($this->_loginDetails->accountid);
        $this->_viewArray['incomingRequestCount'] = $requests->num_rows();
        $orequests = $this->_requestRelations_model->fetchOutgoingRequests($this->_loginDetails->accountid);
        $this->_viewArray['outgoingRequestCount'] = $orequests->num_rows();
        $countCandidates = $this->_requestRelations_model->fetchCandidatesCount($this->_loginDetails->accountid);
        $this->_viewArray['canCount'] = $countCandidates->num_rows();
        $countJobs = $this->_requestRelations_model->fetchJobsCount($this->_loginDetails->accountid);
        $this->_viewArray['jobsCount'] = $countJobs->num_rows();
        $countVendors = $this->_requestRelations_model->fetchVendorsCount($this->_loginDetails->accountid);
        $this->_viewArray['vendorsCount'] = $countVendors->num_rows();
        $cityStateId = $this->_requestRelations_model->vendorLocation($this->_loginDetails->accountid);
        //print_r($cityStateId[0]); exit;
        $cityId = $cityStateId[0]->cityid;
        $stateId = $cityStateId[0]->stateid;
        $this->_viewArray['ymkVendors'] = $this->_requestRelations_model->ymkVendorsList($cityId, $stateId, $this->_loginDetails->accountid);
        //print_r($this->_viewArray['ymkVendors']);
        $this->_viewArray['rsVendors'] = $this->_requestRelations_model->rsVendorsList($this->_loginDetails->accountid);
        //print'<pre>';print_r($this->_viewArray['vendorsCount']);
        $this->_viewArray['jobs'] = $this->_jobOperations_model->allJobList($this->_loginDetails->accountid);
        $this->_viewArray['appliedJobs'] = $this->_jobOperations_model->appliedJobsByEmp($this->_loginDetails->accountid);
    }
    public function forgotP()
	{
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "yasaswikd@gmail.com";
        $config['smtp_pass'] = "dykg.9700";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from('yasaswikd@gmail.com', 'Test User');
        $list = array('xxx@gmail.com');
        $ci->email->to($list);
        $this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
        $ci->email->subject('This is an email test');
        $ci->email->message('It is working. Great!');
        $ci->email->send();
	}
	function fpsubmit()
	{
		
	}
}