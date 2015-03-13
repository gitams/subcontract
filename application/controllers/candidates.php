<?php
if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Candidates extends CI_Controller
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
        $this->_viewArray['ymkVendors'] = $this->_requestRelations_model->ymkVendorsList($cityId,$stateId,$this->_loginDetails->accountid);
        //print_r($this->_viewArray['ymkVendors']);
        $this->_viewArray['rsVendors'] = $this->_requestRelations_model->rsVendorsList($this->_loginDetails->accountid);
        //print'<pre>';print_r($this->_viewArray['vendorsCount']);
        $this->_viewArray['jobs'] = $this->_jobOperations_model->allJobList($this->_loginDetails->accountid);
        $this->_viewArray['appliedJobs'] = $this->_jobOperations_model->appliedJobsByEmp($this->_loginDetails->accountid);
    }
    
	public function requestresume()
	{
		$this->load->model('request_resumes_model');
		$val = addslashes($_POST['val']);
		$canID = addslashes($_POST['canID']);
		$output= array();
		$this->_viewArray['placed'] = $this->request_resumes_model->requestResume($val,$canID);
		if($this->_viewArray['placed'])
		{
			$output['status'] = "success";
		}
		else
		{
			$output['status'] = "fail";
		}
		echo json_encode($output);
		exit;
	}
	private function new_view($title, $viewArray) {
        $this->load->view('layout/header_new', array('title' => $title));
        $this->load->view('layout/after_login_layout_new_latest', $viewArray);
        $this->load->view('layout/footer_new', array());
    }
    public function download($can_id='')
    {
        $this->load->helper('download');
        $this->load->model("candidates_model");
        $result = $this->candidates_model->get_can_res($can_id);
        $result = $result[0];
        $file_name = $result->can_resume;
        $file_path = $this->config->item('base_url').'application/candidates_resumes/$file_name';//exit;

        $data = file_get_contents($file_path);
        force_download($file_name, $data);
        exit;
    }
	public function resumes_download()
	{


		$userDetails = $this->session->userdata('userLoginDetails');
        $accountid = $userDetails->accountid;
		
		$this->db->select('*');
		$this->db->from('request_resumes rr');
		$this->db->join('candidates c', 'c.can_id=rr.can_id');
		$this->db->join('skills as ss','ss.skillid = c.can_maj_skill','left');
		$this->db->join('accounts as a','a.accountid = c.can_account_id','left');
		$this->db->join('candidate_details as cd', 'cd.candidate_id = c.can_id','left');
		$this->db->where('rr.request_status',1);
		$this->db->where('c.can_account_id',$accountid);
		$this->db->group_by('c.can_id');
		$this->_viewArray['resume_request']=$this->db->get()->result();


		
		$this->_viewArray['page'] = 'resumes_download';
        $this->new_view('Resume Acceptence Page', $this->_viewArray);
		//$this->load->view('resumes_download',$rows);
	}
    public function accept_resume_download()
    {
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountid = $userDetails->accountid;

        $this->db->select('*');
        $this->db->from('request_resumes rr');
        $this->db->join('candidates c', 'c.can_id=rr.can_id');
        $this->db->join('skills as ss','ss.skillid = c.can_maj_skill','left');
        $this->db->join('accounts as a','a.accountid = c.can_account_id','left');
        $this->db->join('candidate_details as cd', 'cd.candidate_id = c.can_id','left');
        $this->db->where('rr.request_status',1);
        $this->db->where('c.can_account_id',$accountid);
        $this->db->group_by('c.can_id');
        $this->_viewArray['resume_request']=$this->db->get()->result();


        $this->_viewArray['page'] = 'resumes_download';
        $this->new_view('Resume Acceptence Page', $this->_viewArray);
        //$this->load->view('resumes_download',$rows);
    }
    
}
