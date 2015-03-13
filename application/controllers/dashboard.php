<?php
if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Dashboard extends CI_Controller
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
        $this->check_isFirstTime();
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
    private function check_isValidated(){
        $userDetails = $this->session->userdata('userLoginDetails');
        $contact_type_id = $userDetails->contacttypeid;
        if($contact_type_id == 4){
            redirect('user_dashboard');
        }
    }
    private function check_isFirstTime(){
        try {
            $this->load->model('company_details_model');
            $this->_loginDetails = $this->session->userdata('userLoginDetails');
            //print"<pre>"; print_r($this->_loginDetails); //exit;
            $contactId = $this->_loginDetails->contactid;
            $accountId = $this->_loginDetails->accountid;
            $profileCheck = $this->company_details_model->checkProfileEmployer($accountId);
            $profileExist = count($profileCheck);
            //print $profileExist; exit;
            if ($profileExist != 0) {
                redirect('no_profile_employer');
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function index()
    {
        //print'<pre>';print_r($this->session->userdata('userLoginDetails'));
        //$userDetails = $this->session->userdata('userLoginDetails');
        //$contact_type_id = $userDetails->contacttypeid;
        //echo $contact_type_id; exit;
        $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
        $this->_viewArray['page'] = 'home_after_login_view';
        $this->_view('Dashboard', $this->_viewArray);
    }
    public function reqCount(){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $requests = $this->_requestRelations_model->fetchIncomingRequests($accountId);
        $iReqCount = $requests->num_rows();
        //print_r($iReqCount);
        echo $iReqCount;
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
    public function myProfile(){
        try {
            $this->_viewArray['page'] = 'myprofile_view';
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
            $this->_viewArray['profile'] = $this->_utilities_model->profile($this->_loginDetails->accountid);
            $this->_viewArray['social'] = $this->_utilities_model->pSocial($this->_loginDetails->accountid);
            $this->_viewArray['services'] = $this->_utilities_model->pServices($this->_loginDetails->accountid);
            $this->_viewArray['company'] = $this->_utilities_model->pCompany($this->_loginDetails->accountid);
            $this->_viewArray['portfolio'] = $this->_utilities_model->pPortfolio($this->_loginDetails->accountid);
            $this->new_view('Dashboard', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    
    public function otherProfile($reqAccId){
        try {
            $this->_viewArray['page'] = 'other_employer_profile_view';
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
            $this->_viewArray['profile'] = $this->_utilities_model->profile($reqAccId);
            $this->_viewArray['social'] = $this->_utilities_model->pSocial($reqAccId);
            $this->_viewArray['services'] = $this->_utilities_model->pServices($reqAccId);
            $this->_viewArray['company'] = $this->_utilities_model->pCompany($reqAccId);
            $this->_viewArray['portfolio'] = $this->_utilities_model->pPortfolio($reqAccId);
            $this->new_view('View Profile', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function addpost()
    {
        try {
            $this->_viewArray['page'] = 'addpost';
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
            $this->new_view('Dashboard', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function savePost()
    {
        try {
            //print'<pre>'; print_r($_POST); exit;
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;
            $this->_jobOperations_model->saveJobPost($_POST, $accountId, $contactId);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Job Added Successfully';
            $this->session->set_flashdata('error', $error);
            redirect('dashboard/myposts');
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function myposts()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            //print($accountId);
            $jobPosts = $this->_jobOperations_model->fetchJobPostings($accountId);
            /*$this->load->view('layout/header_new');
            $this->load->view('jobs_list_view', $this->_viewArray);
            $this->load->view('layout/footer_new');*/
            $this->_viewArray['page'] = 'myposts';
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['myJobs'] = $jobPosts;
            //echo json_encode($jobPosts);
            //exit;
            $this->new_view('My Posts', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function applied() {
        try{
            $post_id = $_POST['post_id'];
            $applied['acs'] = $this->_jobOperations_model->fetchApplied($post_id);
            //print'<pre>'; print_r($applied); exit;
            //print_r($applied);
            $this->load->view('layout/applied_view',$applied);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function joblist()
    {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $jobPosts = $this->_jobOperations_model->allJobList($accountId);
            //$this->_viewArray['page'] = 'jobs_list_view';
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['page'] = 'jobs_list_view';
            $this->_viewArray['jobs'] = $jobPosts;
            //echo json_encode($jobPosts);
            //exit;
            $this->new_view('jobslistView', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    /*public function request()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $this->_viewArray['page'] = 'requestauto';
                $this->_viewArray['companies'] = $this->fetchCompanySuggestions();
                $this->_view('Send a Request', $this->_viewArray);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }*/
    public function sendarequest()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                //print_r($_POST); exit;
                $from = $this->_loginDetails->accountid;
                $to = trim($_POST['selectCompanies']);
                $this->_requestRelations_model->createRelation($from, $to);
                $error[0][0] = 'alert alert-success';
                $error[0][1] = 'Request sent successfully.';
                $this->session->set_flashdata('error', $error);
                redirect('dashboard/index');
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function sendarequestFromSearch()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                //print_r($_POST); exit;
                $from = $this->_loginDetails->accountid;
                $to = trim($_POST['accountid']);
                $this->_requestRelations_model->createRelation($from, $to);
                $error[0][0] = 'alert alert-success';
                $error[0][1] = 'Request sent successfully.';
                $this->session->set_flashdata('error', $error);
                //redirect('dashboard/index');
                return true;
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function approverequest()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $from = $this->_loginDetails->accountid;
                $this->_viewArray['page'] = 'requestlist';
                $requests = $this->_requestRelations_model->fetchIncomingRequests($from);
                $this->_viewArray['requests'] = $requests->result();
                $this->_view('Accept Requests', $this->_viewArray);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function updaterequest()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $to = $this->_loginDetails->accountid;
                $id = trim($_POST['id']);
                $typeId = trim($_POST['typeid']);
                if ($typeId == 1) {
                    if ($this->_requestRelations_model->approveRequest($id, $to)) {
                        echo 'Request has been approved.';
                    } else {
                        echo 'Invalid Request Sent';
                    }
                } elseif ($typeId == 2) {
                    if ($this->_requestRelations_model->cancelRequest($to, $id)) {
                        echo 'Request has been Cancelled.';
                    } else {
                        echo 'Invalid Request Sent';
                    }
                } elseif ($typeId == 2) {
                    if ($this->_requestRelations_model->deleteRequest($to, $id)) {
                        echo 'Request has been Cancelled.';
                    } else {
                        echo 'Invalid Request Sent';
                    }
                }
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function sentrequest()
    {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $from = $this->_loginDetails->accountid;
                $this->_viewArray['page'] = 'sentrequestlist';
                $requests = $this->_requestRelations_model->fetchOutgoingRequests($from);
                $this->_viewArray['requests'] = $requests->result();
                $this->_view('Accept Requests', $this->_viewArray);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function connections() {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $connections = $this->_requestRelations_model->fetchActiveConnections($this->_loginDetails->accountid);
                $this->_viewArray['page'] = 'connections';
                $this->_viewArray['requests'] = $connections->result();
                $this->new_view('Accept Requests', $this->_viewArray);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function empByMap(){
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $this->_viewArray['page'] = 'employers_in_map_view';
            $this->_viewArray['empLats'] = $this->_requestRelations_model->fetchLats($accountId);
            //print"<pre>";print_r($this->_viewArray['empLats']);
            $this->new_view('Employer By Region', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function fetchCompanySuggestions() {
        $term = '';
        if (isset($_GET['term'])) {
            $term = trim($_GET['term']);
        }
        $result = $this->_jobOperations_model->fetchCompanies($term, $this->_loginDetails->accountid);
        $output = array();
        if ($result->num_rows > 0) {
            $counter = 0;
            foreach ($result->result() as $record) {
                $output[$counter]['item'] = $record->item;
                $output[$counter]['id'] = $record->id;
                $counter++;
            }
        } else {
            $counter = 0;
            $output[$counter]['item'] = 'No Companies Found';
            $output[$counter]['id'] = '0';
        }
        return(json_encode($output));
    }

    private function _view($title, $viewArray) {
        $this->load->view('layout/header_new', array('title' => $title));
        $this->load->view('layout/after_login_layout_new', $viewArray);
        $this->load->view('layout/footer_new', array());
    }
    private function new_view($title, $viewArray) {
        $this->load->view('layout/header_new', array('title' => $title));
        $this->load->view('layout/after_login_layout_new_latest', $viewArray);
        $this->load->view('layout/footer_new', array());
    }
    public function signout() {
        $this->session->unset_userdata('isLoggedin');
        $this->session->unset_userdata('userLoginDetails');
        redirect(base_url());
    }
    public function vendorsList(){
        try{
            $current = $this->_loginDetails->accountid;
            $result = $this->vendors_model->getVendors($current);
            //print '<pre>'; print_r($result);
            $this->_viewArray['vendors'] = $result;
            //$output = array('vendors' => $result);
            //echo json_encode($output);
            //exit;
            $this->load->view('vendorsearch.php', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function vendorsSearch(){
        $search = $_POST['key'];
        //print_r($search); exit;
        $currentid = $this->_loginDetails->accountid;
        $result = $this->vendors_model->searchVendors($search,$currentid);
        //print '<pre>'; print_r($result); exit;
        $output = array('vendors' => $result);
        //echo json_encode($output);
        //exit;
        $this->load->view('layout/vendorsearch_div.php', $output);
    }
    public function searchJob(){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $jobPosts = $this->_jobOperations_model->fetchJobPostings($accountId);
        $this->_viewArray['page'] = 'myposts';
        $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
        $this->_viewArray['jobs'] = $jobPosts;
        //print'<pre>';print_r($jobPosts); exit;
        $this->load->view('jobsearch.php', $this->_viewArray);
    }
    public function jobpostSearch(){

        try {
            if($_POST) {
                $keyword = $_POST['key'];
                //$location = $_POST['loc'];
                //print_r($_POST); exit;
                $result = $this->vendors_model->searchJobs($keyword);
                $output['jobs'] = $result;
                //print '<pre>'; print_r($output); exit;
                $this->load->view('layout/jobsearch_div.php', $output);
                //echo json_encode($output);
                //exit;
            } elseif (!$this->session->userdata('isLoggedin')) {
                redirect('landing/index');
            } else {
                redirect("dashboard");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function addRec() {
        try {
                $this->_viewArray['page'] = 'add_rec_view';
                $this->_view('Dashboard', $this->_viewArray);
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function saveRec() {
        try {

                //print'<pre>';print_r($_POST); exit;
                $userDetails = $this->session->userdata('userLoginDetails');
                $accountId = $userDetails->accountid;
                $users['first_name'] = trim($_POST['rec_first_name']);
                $users['last_name'] = trim($_POST['rec_last_name']);
                $users['username'] = $_POST['rec_email'];
                $users['phonenumber'] = $_POST['rec_mobile'];
                $users['password'] = $_POST['rec_cpassword'];
                $users['contacttypeid'] = 3;
                $users['status'] = 1;
                $users['accountid'] = $accountId;
                $users['createdby'] = $accountId;
                $users['createddate'] = date("Y-m-d h-i-s");
                $this->vendors_model->insertRec($users);
                $this->session->set_flashdata('suc_msg', 'Recruiter added successfully !');
                redirect(base_url('dashboard/myRecs'));

        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }

    }
    public function myRecs(){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $this->_viewArray['recs'] = $this->vendors_model->listRec($accountId);
        $this->_viewArray['page'] = 'rec_list_view';
        $this->new_view('My recruiters', $this->_viewArray);
    }
    public function addCandidate() {
        $this->_viewArray['page'] = 'add_candidate_view';
        $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
        $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
        $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
        $this->new_view('Add Candidate', $this->_viewArray);
    }
    public function saveCandidate() {
        //print_r($_POST); exit;
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $can['can_account_id'] = $accountId;
        $can['can_first_name'] = $_POST['can_first_name'];
        $can['can_last_name'] = $_POST['can_last_name'];
        $can['can_email'] = $_POST['can_email'];
        $can['can_mobile'] = $_POST['can_mobile'];
        $can['can_current_ctc'] = $_POST['can_ctc'];
        $can['can_current_exp_years'] = $_POST['can_exp_year'];
        //$can['can_current_exp_months'] = $_POST['can_exp_mnth'];
        $can['can_maj_skill'] = $_POST['can_skill'];
        $can['can_status'] = 1;
        $can['can_created_date'] = date('Y-m-d');
        $can['can_created_time'] = date('h-i-s');
        $can['can_created_by'] = $accountId;

        $config['upload_path'] = APPPATH.'candidates_resumes';
        //print($config['upload_path']);
        $config['allowed_types'] = 'doc|docx|pdf';
        $config['max_size']    = '10000';
        $this->load->library('upload', $config);
        if(isset($_FILES['can_resume']) && $_FILES['can_resume']['size'] > 0){
            // user provided a file to upload
            $this->load->library("upload");
            if (!$this->upload->do_upload('can_resume')) {
                // already checked for file from form, so this is a legit error
                $error = array('error' => $this->upload->display_errors());
                $data['error'] = $error['error'];
                // print_r($error); exit;
                //$this->_viewArray['page'] = 'add_candidate_view';
                //$this->_viewArray['vendors'] = $data;
                //$this->new_view('Add Candidate', $this->_viewArray);
                redirect ('dashboard/addCandidate');
                //$this->load->view('add_candidate_view',$data);
            }
            else {
                $this->vendors_model->insertCandidate($can);
                redirect ('dashboard/addCandidate_details');
            }
        }
    }
	public function changePlaced()
	{
		$val = addslashes($_POST['val']);
		$canID = addslashes($_POST['canID']);
		$output= array();
		$this->_viewArray['placed'] = $this->vendors_model->changePlaced($val,$canID);
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
    public function acceptrejectsumereq()
	{
		$val = addslashes($_POST['val']);
		$canID = addslashes($_POST['canID']);
		$output= array();
		$this->_viewArray['placed'] = $this->vendors_model->updaterequestresume($val,$canID);
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
    public function myCandidates()
	{
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $this->_viewArray['cans'] = $this->vendors_model->listCandidates($accountId);
        $this->_viewArray['page'] = 'candidates_list_view';
        $this->new_view('My Candidates', $this->_viewArray);
    }
    public function candidatesList($cmid="")
	{
		$userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
		if(!empty($cmid))
		{
			$this->_viewArray['cans'] = $this->vendors_model->requestListCandidates($cmid, $accountId);
		}
		else
		{
			redirect ('/dashboard/myCandidates');
			exit;
		}
		
		$this->_viewArray['page'] = 'candidates_list';
        $this->new_view('Candidates List', $this->_viewArray);
    }
    public function addCandidate_details() {
        //print("hi");
        $this->_viewArray['page'] = 'add_candidate_view_2';
        $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
        $this->new_view('Add Candidate', $this->_viewArray);
    }
    public function saveCandidate_Details() {
        //print'<pre>'; print_r($_POST); exit;
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $can['can_det_account_id'] = $accountId;
        $can['can_current_org'] = $_POST['can_current_company'];
        $can['can_emp_type'] = $_POST['can_emp_type'];
        $can['can_work_type'] = $_POST['can_work_type'];
        $can['can_high_edu'] = $_POST['can_high_edu'];
        $can['can_high_year'] = $_POST['can_high_year_pass'];
        $can['can_high_univ'] = $_POST['can_high_univ'];
        $can['can_other_edu'] = $_POST['can_other_edu'];
        $can['can_other_year'] = $_POST['can_other_year_pass'];
        $can['can_other_univ'] = $_POST['can_other_univ'];
        $can['can_other_skill_1'] = $_POST['other_skill_1'];
        $can['can_other_skill_2'] = $_POST['other_skill_2'];
        //$can['can_cur_country'] = $_POST['can_cur_country'];
        //$can['can_cur_state'] = $_POST['can_cur_state'];
        //$can['can_cur_city'] = $_POST['can_cur_city'];
        $can['can_location'] = $_POST['location'];
        $can['can_det_status'] = 1;
        $can['can_det_created_date'] = date("Y-m-d");
        $can['can_det_created_time'] = date("h-i-s");
        $can['can_det_created_by'] = $accountId;

        $this->vendors_model->insertCandidate_Details($can,$accountId);
        $error[0][0] = 'alert alert-success';
        $error[0][1] = 'Candidate added successfully.';
        $this->session->set_flashdata('error', $error);
       /* $this->session->set_flashdata('suc_msg', 'Candidate added successfully');*/
        redirect ('dashboard/myCandidates');
    }
    public function editCandidate($candidateId) {
        $this->_viewArray['page'] = 'edit_candidate_view';
        $this->_viewArray['cans'] = $this->vendors_model->candidate($candidateId);
        $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
        $this->_viewArray['cities'] = $this->_utilities_model->fetchCities();
        $this->new_view('Edit Candidate', $this->_viewArray);
    }
    public function UpdateEditCandidate() {
        try {
            //print"<pre>"; print_r($_POST); exit;

            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $canId = $_POST['canId'];

            $can['can_first_name'] = $_POST['can_first_name'];
            $can['can_last_name'] = $_POST['can_last_name'];
            $can['can_email'] = $_POST['can_email'];
            $can['can_mobile'] = $_POST['can_mobile'];
            $can['can_current_ctc'] = $_POST['can_ctc'];
            $can['can_current_exp_years'] = $_POST['can_exp_year'];
            //$can['can_current_exp_months'] = $_POST['can_exp_mnth'];
            $can['can_maj_skill'] = $_POST['can_skill'];

            $can['can_updated_date'] = date('Y-m-d');
            $can['can_updated_time'] = date('h-i-s');
            $can['can_updated_by'] = $accountId;



            $canD['can_current_org'] = $_POST['can_current_company'];
            $canD['can_emp_type'] = $_POST['can_emp_type'];
            $canD['can_work_type'] = $_POST['can_work_type'];
            $canD['can_high_edu'] = $_POST['can_high_edu'];
            $canD['can_high_year'] = $_POST['can_high_year_pass'];
            $canD['can_high_univ'] = $_POST['can_high_univ'];
            $canD['can_other_edu'] = $_POST['can_other_edu'];
            $canD['can_other_year'] = $_POST['can_other_year_pass'];
            $canD['can_other_univ'] = $_POST['can_other_univ'];
            $canD['can_other_skill_1'] = $_POST['other_skill_1'];
            $canD['can_other_skill_2'] = $_POST['other_skill_2'];
            $canD['can_location'] = $_POST['location'];




            $config['upload_path'] = APPPATH.'candidates_resumes';
            //print($config['upload_path']);
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['max_size']    = '10000';
            $this->load->library('upload', $config);
            if(isset($_FILES['can_resume_file']) && $_FILES['can_resume_file']['size'] > 0){
                // user provided a file to upload
                $this->load->library("upload");
                if (!$this->upload->do_upload('can_resume_file')) {
                    // already checked for file from form, so this is a legit error
                    $error = array('error' => $this->upload->display_errors());
                    $data['error'] = $error['error'];
                    redirect ('dashboard/editCandidate');
                    //$this->load->view('add_candidate_view',$data);
                } else {
                    #echo "hi1";
                    #print_r($_FILES);exit;
                    $upload_data = $this->upload->data();
                    $can['can_resume'] =   $upload_data['file_name'];
                    $this->vendors_model->updateCandidate($can, $canD, $canId, $accountId);
                    $error[0][0] = 'alert alert-success';
                    $error[0][1] = 'Candidate Updated successfully.';
                    $this->session->set_flashdata('error', $error);
                    /* $this->session->set_flashdata('suc_msg', 'Candidate added successfully');*/
                    redirect ('dashboard/myCandidates');
                }
            } else {
                #echo "hi2";
                #print_r($_FILES);exit;
                $this->vendors_model->updateCandidate($can, $canD, $canId, $accountId);
                $error[0][0] = 'alert alert-success';
                $error[0][1] = 'Candidate Updated successfully.';
                $this->session->set_flashdata('error', $error);
                /* $this->session->set_flashdata('suc_msg', 'Candidate added successfully');*/
                redirect ('dashboard/myCandidates');
            }

        }catch (Exception $e) {
            echo $e->getMessage(); exit;
        }
    }
    public function searchIn() {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $search = trim($_POST["keyword"]);
            $Word = explode(" ", $search);
            $c = count($Word);
            for($i=0;$i<$c;$i++) { $keyWord[$i] = trim($Word[$i]); }
            //print_r($keyWord);exit;
            $this->_viewArray['search'] = $this->vendors_model->searchIn($keyWord,$accountId);
            //print'<pre>';print_r($viewArray['search']);
            $this->_viewArray['page'] = 'search_inside_view';
            $this->new_view('Search Result', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function ymkMore(){
        try{
            $cityStateId = $this->_requestRelations_model->vendorLocation($this->_loginDetails->accountid);
            //print_r($cityStateId[0]); exit;
            $cityId = $cityStateId[0]->cityid;
            $stateId = $cityStateId[0]->stateid;
            $this->_viewArray['ymkMoreList'] = $this->_requestRelations_model->ymkVendorsList($cityId,$stateId,$this->_loginDetails->accountid);
            //print_r($this->_viewArray['ymkVendors']);
            $this->_viewArray['page'] = 'ymk_more_view';
            $this->new_view('You May Know', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function rsvMore(){
        try{
            $this->_viewArray['rsvMoreList'] = $this->_requestRelations_model->rsVendorsList($this->_loginDetails->accountid);
            $this->_viewArray['page'] = 'rsv_more_view';
            $this->new_view('Recently Signed', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function rjpMore(){
        try{
            $this->_viewArray['jobs'] = $this->_jobOperations_model->allJobList($this->_loginDetails->accountid);
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['page'] = 'rjp_more_view';
            $this->_view('Recently Posted Jobs', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function notifications(){
		try{
			$userDetails = $this->session->userdata('userLoginDetails');
            $accountid = $userDetails->accountid;
			$this->db->select('count(request_id) as countreq');
			$this->db->from('request_resumes rr');
			$this->db->join('candidates c', 'c.can_id=rr.can_id');
			$this->db->where('rr.request_status',1);
			$this->db->where('c.can_account_id',$accountid);
			$rows['resume_request']=$this->db->get()->result();
			
			$this->db->select('count(request_id) as countreq');
			$this->db->from('request_resumes rr');
			$this->db->join('candidates c', 'c.can_id=rr.request_id');
			$this->db->where('rr.request_status',2);
			$this->db->where('c.can_account_id',$accountid);
			$rows['resume_accept']=$this->db->get()->result();
			
			$this->db->select('count(request_id) as countreq');
			$this->db->from('request_resumes rr');
			$this->db->join('candidates c', 'c.can_id=rr.can_id');
			$this->db->where('rr.request_status',4);
			$this->db->where('c.can_account_id',$accountid);
			$rows['resume_down']=$this->db->get()->result();
			
			//print_r($rows);exit;
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if((isset($contact_type_id)) && (!empty($contact_type_id)) && ($contact_type_id == 2)) {
                $from = $this->_loginDetails->accountid;
                $list = $this->_requestRelations_model->fetchIncomingRequests($from);
                $rows['requests'] = $list->result();
                //print_r($reuests); exit;
                $this->load->view('layout/requests.php',$rows);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
		
    }
    public function jobViewApply($jobPostId,$PostedAccId){
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $this->_viewArray['page'] = 'job_view_apply_view';
            $this->_viewArray['resultJob'] = $this->_jobOperations_model->viewAndApply($jobPostId,$PostedAccId);
            $this->_viewArray['cans'] = $this->vendors_model->listCandidates($accountId);
            $this->_view('View And Apply Job', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function applyJobByEmp($jobPostId,$PostedAccId){
        try {
            //print'<pre>';
            //print_r($_POST['cans']);
            //print $jobPostId;
            //print $PostedAccId;
            $can = $_POST['cans'];
            //print_r($can);
            $c = count($can);

            //print $c;
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;
            $data['ja_post_id'] = $jobPostId;
            $data['ja_posted_by'] = $PostedAccId;
            $data['ja_applied_acc_id'] = $accountId;
            $data['ja_applied_con_id'] = $contactId;
            $data['ja_applied_date'] = date("Y-m-d");
            $data['ja_applied_time'] = date("hi-i-s");
            //echo "hi";
            for($i =0; $i<$c; $i++) {
                //echo "hi";
                $data['ja_can_id'] = $can[$i];
                //print ($data['ja_can_id']);
                $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
                $this->_jobOperations_model->applyJobByEmp($data);
            }//exit;

            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Applied For this Job successfully !.';
            $this->session->set_flashdata('error', $error);
            /*$this->_viewArray['page'] = 'jobs_list_view';
            $this->_view('Dashboard', $this->_viewArray);*/
            redirect('dashboard');

        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function testupload()
    {
        print_r($_FILES);
        print_r($_POST); exit;
    }

    public function pPicChange(){
        try{
            $config =  array(
                'upload_path'     => APPPATH."profileImg",
                'allowed_types'   => "gif|jpg|png|jpeg",
                'overwrite'       => FALSE,
                'max_size'        => "2000KB"
            );
            $this->load->library('upload', $config);
            if($this->upload->do_upload())
            {
                echo "file upload success";
                //Image Resizing
                $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 200;
                $config['height'] = 250;

                $this->load->library('image_lib', $config);

                if ( ! $this->image_lib->resize()){
                    $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
                }

                $this->MUser->updateProfile($this->input->post('user_id'));
                //Need to update the session information if email was changed
                $this->session->set_userdata('email', $this->input->xss_clean($this->input->post('user_email')));
                $this->session->set_flashdata('message', 'Your Profile has been Updated!');
                redirect('profile');
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                $data['error'] = $error['error'];
                print_r($error); exit;
                //echo $data;
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function editJobPost($postId){
        try{
            //print_r($_POST);exit;
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
            $this->_viewArray['postDetails'] = $this->_jobOperations_model->fetchJobPost($postId);
            $this->_viewArray['page'] = 'edit_jobpost_view';
            $this->new_view('Edit Job', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateJobPost() {
        try {
            //print'<pre>'; print_r($_POST); exit;
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;

            $nes['accId'] = $accountId;
            $nes['conId'] = $contactId;
            $nes['jpsId'] = $_POST['jobPostSkillId'];
            $nes['jplId'] = $_POST['jobPostLocationId'];
            $nes['lId'] = $_POST['locationId'];
            $nes['postId'] = $_POST['postID'];

            $array['accountid'] = $accountId;
            $array['post_title'] = trim($_POST['posttitle']);
            $array['post_description'] = trim($_POST['postDescription']);
            $array['ctc_from'] = trim($_POST['ctc_from']);
            $array['ctc_to'] = trim($_POST['ctc_to']);
            $array['contract_terms'] = trim($_POST['contract_terms']);
            $array['experience_from'] = trim($_POST['experience_from']);
            $array['experience_to'] = trim($_POST['experience_to']);
            //$array['createdby'] = $contactId;
            $array['updateddate'] = date('Y-m-d');
            //$array['createdtime'] = date('h:i:s');
            $array['jobid'] = trim($_POST['jobId']);
            $array['rate'] = trim($_POST['rate']);
            $array['positions'] = trim($_POST['numpos']);
            $array['qualification'] = trim($_POST['qual']);
            $array['emp_type'] = trim($_POST['emptype']);
            $array['req_type'] = trim($_POST['reqtype']);
            $array['work_status'] = trim($_POST['work']);
            $array['keywords'] = trim($_POST['keyword']);
            $array['industry'] = trim($_POST['industry']);
            $array['fun_area'] = trim($_POST['funarea']);
            $array['comp_desc'] = trim($_POST['compDescription']);
            $array['travel_type'] = trim($_POST['travel']);
            $array['on_boarding_by'] = trim($_POST['onboardby']);
            $array['refresh_by'] = trim($_POST['refjob']);

            /*if(isset($skills) && (!empty($skills))) {
                foreach ($skills as $skill) {
                    $skl['skill_id'] = trim($skill);
                }
            }*/
            $loc['locationname'] = trim($_POST['location']);
            $loc['latitude'] = trim($_POST['latitude']);
            $loc['longitude'] = trim($_POST['longitude']);
            $loc['address'] = trim($_POST['fAddress']);

            $this->_jobOperations_model->updateJobPost($array, $loc, $nes);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Job Updated Successfully';
            $this->session->set_flashdata('error', $error);
            redirect('dashboard/myposts');
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function editEmployer(){
        try{
            //print_r($_POST);exit;
            $this->_viewArray['rsvMoreList'] = $this->_requestRelations_model->rsVendorsList($this->_loginDetails->accountid);
            $this->_viewArray['page'] = 'edit_employer_view_step1   ';
            $this->_view('Recently Signed', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function editEmpSec2(){
        try{
            //print_r($_POST);exit;
            $comp = $this->load->model('company_details_model', '', TRUE);
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;
            $data['asu_account_id'] = $accountId;
            $data['asu_contact_id'] = $contactId;
            $data['asu_facebook'] = trim($_POST['facebook']);
            $data['asu_linkedin'] = trim($_POST['linkedIn']);
            $data['asu_website'] = trim($_POST['website']);
            $data['asu_twitter'] = trim($_POST['twitter']);
            $data['asu_google'] = trim($_POST['google']);
            $data['asu_updated_by'] = $accountId;
            $data['asu_updated_date'] = date("Y-m-d");
            $data['asu_updated_time'] = date("h-i-s");
            $comp->updateSocial($data,$accountId);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Updated successfully.';
            $this->session->set_flashdata('error', $error);
            redirect('dashboard/myProfile');
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function editEmpSec3() {
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;

        $data['as_account_id'] = $accountId;
        $data['as_contact_id'] = $contactId;

        $data['as_service'] = trim($_POST['serviceName']);
        $data['as_expertise'] = trim($_POST['expertise']);
        $data['as_client'] = trim($_POST['client']);

        $data['as_updated_by'] = $accountId;
        $data['as_updated_date'] = date("Y-m-d");
        $data['as_updated_time'] = date("h-i-s");
        $comp = $this->load->model('company_details_model', '', TRUE);
        $comp->updateAccountServices($data,$accountId,$contactId);
        $error[0][0] = 'alert alert-success';
        $error[0][1] = 'Updated successfully.';
        $this->session->set_flashdata('error', $error);
        redirect('dashboard/myProfile');
    }
    public function editEmpSec4() {
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        //echo '<pre>'; print_r($_POST); exit;

        $data['ac_account_id'] = $accountId;
        $data['ac_contact_id'] = $contactId;

        $data['ac_est_date'] = date('Y-m-d', strtotime(trim($_POST['estDate'])));
        $data['ac_ann_revenue'] = trim($_POST['annRev']);
        $data['ac_num_emp'] = trim($_POST['numEmp']);

        $data['ac_updated_by'] = $accountId;
        $data['ac_updated_date'] = date("Y-m-d");
        $data['ac_updated_time'] = date("h-i-s");

        $comp = $this->load->model('company_details_model', '', TRUE);
        $comp->updateAccountComp($data,$accountId,$contactId);
        $error[0][0] = 'alert alert-success';
        $error[0][1] = 'Updated successfully.';
        $this->session->set_flashdata('error', $error);
        redirect('dashboard/myProfile');
    }
    public function editEmpSec5(){
        print'<pre>';print_r($_POST); print_r($_FILES); exit;
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;

        $comp = $this->load->model('company_details_model', '', TRUE);
        $loopCount = $_POST['counter'];
        //print'<pre>';print_r($_FILES['file']);
        for($i=0;$i<=$loopCount;$i++){
            if(isset($_POST['item_'.$i.'']) && (!empty($_POST['item_'.$i.'']))){
                $data['ap_account_id'] = $accountId;
                $data['ap_contact_id'] = $contactId;

                $data['ap_item'] = trim($_POST['item_'.$i.'']);
                $data['ap_item_cat'] = trim($_POST['cat_'.$i.'']);
                $data['ap_item_desc'] = trim($_POST['desc_'.$i.'']);

                $data['ap_created_by'] = $accountId;
                $data['ap_created_date'] = date("Y-m-d");
                $data['ap_created_time'] = date("h-i-s");
                //print_r($_SERVER);
                $config['upload_path'] = APPPATH.'../assets/portfolio_images/';
                print($config['upload_path']); exit;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']    = '10000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file_'.$i.'')) {
                    /*// already checked for file from form, so this is a legit error
                    $error = array('error' => $this->upload->display_errors());
                    $data['error'] = $error['error'];
                    print_r($error);
                    exit;*/
                    $com = $comp->insertAccountPort($data);
                    $this->session->set_userdata('comId', $com);
                } else {
                    $upload_data = $this->upload->data();
                    $data['ap_item_img'] = $upload_data['file_name'];
                    //echo $data['ap_item_img'];
                    $com = $comp->insertAccountPort($data);
                    $this->session->set_userdata('comId', $com);
                }
            }
        }
        $this->session->set_userdata('isLoggedin', '1');
        redirect('dashboard');
    }
}
