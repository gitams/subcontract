<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_dashboard extends CI_Controller
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
        $this->check_isFirstTime();
        $this->load->model('user_operations_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('vendors_model');
        $userDetails = $this->session->userdata('userLoginDetails');
        //print'<pre>'; print_r($userDetails);
        $contactId =  $userDetails->contactid;
        $accountId =  $userDetails->accountid;

        $this->_utilities_model = $this->load->model('utilities_model', '', TRUE);
        $this->_jobOperations_model = $this->load->model('job_operations_model', '', TRUE);
        $this->_requestRelations_model = $this->load->model('request_relations_model', '', TRUE);
        $this->check_isValidated();
        /*$this->check_isProfileExist();*/
        $this->_loginDetails = $this->session->userdata('userLoginDetails');
        //$contactId =  $this->_loginDetails->contactid;
        //print'<pre>'; print($contactId);
        $countCandidates = $this->_requestRelations_model->fetchCandidatesCount($accountId);
        $this->_viewArray['canCount'] = $countCandidates->num_rows();
        $countJobs = $this->_requestRelations_model->fetchJobsCount($accountId);
        $this->_viewArray['jobsCount'] = $countJobs->num_rows();
        $countVendors = $this->_requestRelations_model->fetchVendorsCount($this->_loginDetails->accountid);
        $this->_viewArray['vendorsCount'] = $countVendors->num_rows();
        $this->_viewArray['jobs'] = $this->user_operations_model->recentJobs();

    }
    private function check_isValidated(){
        $userDetails = $this->session->userdata('userLoginDetails');
        $contact_type_id = $userDetails->contacttypeid;
        if($contact_type_id != 4){
            redirect('dashboard');
        }
    }
      private function check_isFirstTime(){
        try {
            $this->load->model('user_operations_model');
            $this->_loginDetails = $this->session->userdata('userLoginDetails');
            //print"<pre>"; print_r($this->_loginDetails); //exit;
            $contactId = $this->_loginDetails->contactid;
            $accountId = $this->_loginDetails->accountid;
            $profileCheck = $this->user_operations_model->checkProfileEmployer($contactId);
            $profileExist = count($profileCheck);
            //print $profileExist; exit;
            if ($profileExist == 0) {
                redirect('no_profile');
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    /*private function check_isProfileExist(){
        try{
            $this->_loginDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $this->_loginDetails->contactid;
            $profileCheck = $this->user_operations_model->checkProfile($contactId);
            $profileExist= count($profileCheck);
            if($profileExist != 1){
                redirect('no_profile');
            }
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }*/
    public function index() {
        try{
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['page'] = 'user_dashboard_view';
            $this->_view('Add Your Profile', $this->_viewArray);
        }catch (Exception $ex){
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
    public function saveSelfUser(){
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $userDetails->contactid;
            //print'<pre>';print_r($_POST); exit;
            $data['scd_contact_id'] = $contactId;
            $data['scd_first_name'] = $_POST['su_first_name'];
            $data['scd_last_name'] = $_POST['su_last_name'];
            $data['scd_mobile'] = $_POST['su_mobile'];
            $data['scd_email'] = $_POST['su_email'];
            $data['scd_cur_ctc'] = $_POST['su_ctc'];
            $data['scd_tot_exp_yr'] = $_POST['su_exp_year'];
            $data['scd_exp_mnth'] = $_POST['su_exp_mnth'];
            $data['scd_majar_skill'] = $_POST['su_skill'];
            $data['scd_cur_company'] = $_POST['su_current_company'];
            $data['scd_cur_emp_type'] = $_POST['su_emp_type'];
            $data['scd_cur_work_type'] = $_POST['su_work_type'];
            $data['scd_high_edu'] = $_POST['su_high_edu'];
            $data['scd_high_year'] = $_POST['su_high_year_pass'];
            $data['scd_high_univ'] = $_POST['su_high_univ'];
            $data['scd_other_edu'] = $_POST['su_other_edu'];
            $data['scd_other_year'] = $_POST['su_other_year_pass'];
            $data['scd_other_univ'] = $_POST['su_other_univ'];
            $data['scd_other_skill_1'] = $_POST['other_skill_1'];
            $data['scd_other_skill_2'] = $_POST['other_skill_2'];
            $data['scd_cur_country'] = $_POST['su_cur_country'];
            $data['scd_cur_state'] = $_POST['su_cur_state'];
            $data['scd_cur_city'] = $_POST['su_cur_city'];
            $data['location']    = $_POST['location'];

            $data['scd_status'] = 1;
            $data['scd_created_date'] = date("Y-m-d");
            $data['scd_created_time'] = date("h-i-s");
            $data['scd_created_by'] = $contactId;


            $config['upload_path'] = APPPATH.'self_user_resumes';
            //print($config['upload_path']);
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['max_size']    = '10000';
            $this->load->library('upload', $config);
            if(isset($_FILES['su_resume']) && $_FILES['su_resume']['size'] > 0){
                // user provided a file to upload
                $this->load->library("upload");
                if (!$this->upload->do_upload('su_resume')) {
                    // already checked for file from form, so this is a legit error
                    $error = array('error' => $this->upload->display_errors());
                    $data['error'] = $error['error'];
                    // print_r($error); exit;
                    $this->_viewArray['page'] = 'add_self_user_profile_view';
                    $this->_viewArray['vendors'] = $data;
                    $this->_view('Add Your Profile', $this->_viewArray);
                    //$this->load->view('add_candidate_view',$data);
                }
                else {
                    $this->user_operations_model->insertSelfUser($data);
                    $this->session->set_flashdata('suc_msg', 'Profile Added successfully !');
                    redirect ('user_dashboard/index');
                }
            }
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function myProfile(){
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $userDetails->contactid;
            $this->_viewArray['page'] = 'myprofile_view1';
            $this->_viewArray['profile'] = $this->user_operations_model->checkProfile($contactId);
            $this->_view('Dashboard', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateProfile() {
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $userDetails->contactid;
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['details'] = $this->user_operations_model->getUserDetails($contactId);
            $this->_viewArray['page'] = 'edit_self_user_profile_view';
            $this->_view('Edit Your Profile', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function saveUpdateProfile(){
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $userDetails->contactid;
            //print'<pre>';print_r($_POST); exit;
            $data['scd_contact_id'] = $contactId;
            $data['scd_first_name'] = $_POST['su_first_name'];
            $data['scd_last_name'] = $_POST['su_last_name'];
            $data['scd_mobile'] = $_POST['su_mobile'];
            $data['scd_email'] = $_POST['su_email'];
            $data['scd_cur_ctc'] = $_POST['su_ctc'];
            $data['scd_tot_exp_yr'] = $_POST['su_exp_year'];
            $data['scd_exp_mnth'] = $_POST['su_exp_mnth'];
            $data['scd_majar_skill'] = $_POST['su_skill'];
            $data['scd_cur_company'] = $_POST['su_current_company'];
            $data['scd_cur_emp_type'] = $_POST['su_emp_type'];
            $data['scd_cur_work_type'] = $_POST['su_work_type'];
            $data['scd_high_edu'] = $_POST['su_high_edu'];
            $data['scd_high_year'] = $_POST['su_high_year_pass'];
            $data['scd_high_univ'] = $_POST['su_high_univ'];
            $data['scd_other_edu'] = $_POST['su_other_edu'];
            $data['scd_other_year'] = $_POST['su_other_year_pass'];
            $data['scd_other_univ'] = $_POST['su_other_univ'];
            $data['scd_other_skill_1'] = $_POST['other_skill_1'];
            $data['scd_other_skill_2'] = $_POST['other_skill_2'];
            $data['scd_location'] = $_POST['su_location'];

            $data['scd_updated_date'] = date("Y-m-d");
            $data['scd_updated_time'] = date("h-i-s");
            $data['scd_updated_by'] = $contactId;


            $config['upload_path'] = APPPATH.'self_user_resumes';
            //print($config['upload_path']);
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['max_size']    = '10000';
            $this->load->library('upload', $config);
            if(isset($_FILES['su_resume']) && $_FILES['su_resume']['size'] > 0){
                // user provided a file to upload
                $this->load->library("upload");
                if (!$this->upload->do_upload('su_resume')) {
                    $this->user_operations_model->updateSelfUser($data,$contactId);
                    $this->session->set_flashdata('suc_msg', 'Profile Updated successfully !');
                    redirect ('user_dashboard/myProfile');
                }
                else {
                    $upload_data = $this->upload->data();
                    $data['scd_resume'] =   $upload_data['file_name'];
                    $this->user_operations_model->updateSelfUser($data,$contactId);
                    $this->session->set_flashdata('suc_msg', 'Profile Updated successfully !');
                    redirect ('user_dashboard/myProfile');
                }
            }else {
                $this->user_operations_model->updateSelfUser($data,$contactId);
                $this->session->set_flashdata('suc_msg', 'Profile Updated successfully !');
                redirect ('user_dashboard/myProfile');
            }
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function joblist() {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $jobPosts = $this->_jobOperations_model->allJobList($accountId);
            $this->_viewArray['page'] = 'jobs_list_view';
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['jobs'] = $jobPosts;
            //echo json_encode($jobPosts);
            //exit;
            $this->_view('jobslistView', $this->_viewArray);
        } catch(Exception $ex){
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
                $this->_view('Accept Requests', $this->_viewArray);
            } else {
                redirect('dashboard');
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    private function _view($title, $viewArray) {
        $this->load->view('layout/user_header', array('title' => $title));
        $this->load->view('layout/user_afterloginlayout', $viewArray);
        $this->load->view('layout/user_footer', array());
    }

    public function searchByLoc() {
        try{
            $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
            $this->_viewArray['page'] = 'user_search_by_loc_view';
            $this->_view('Search for jobs by Location', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function searchResultByLoc() {
            try {
                $country = $_POST["countryId"];
                $state = $_POST["stateId"];
                $city = $_POST["cityId"];
                $searchResult['search'] = $this->user_operations_model->searchResultByLoc($country,$state,$city);
                //print'<pre>';print_r($viewArray['search']);
                $this->load->view('layout/self_user_search_by_loc_div',$searchResult);
            } catch(Exception $ex){
                echo $ex->getMessage();
                exit;
            }
    }

    public function searchBySkill() {
        try{
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['page'] = 'user_search_by_skill_view';
            $this->_view('Search for jobs by Skill', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchResultBySkill() {
        try{
            $skill = $_POST["skill"];
            $searchResult['search'] = $this->user_operations_model->searchResultBySkill($skill);
            //print'<pre>';print_r($viewArray['search']);
            $this->load->view('layout/self_user_search_by_loc_div',$searchResult);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function searchByEmp() {
        try{
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['page'] = 'user_search_by_emp_view';
            $this->_view('Search for jobs by Location', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function searchResultByEmp() {
        try{
            $empName = trim($_POST["company"]);
            $searchResult['search'] = $this->user_operations_model->searchResultByEmp($empName);
            //print'<pre>';print_r($viewArray['search']);
            $this->load->view('layout/self_user_search_by_emp_div',$searchResult);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function selfUserSearchJobs() {
        try{
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['page'] = 'self_user_search_jobs_view';
            $this->_view('Search for All Jobs', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function selfUserSearchJobsResult() {
        try{
            $input = trim($_POST["company"]);
            $key = explode(" ",$input);
            //print'<pre>';print_r($key); exit;
            $searchResult['search'] = $this->user_operations_model->selfUserSearchJobsResult($key);
            //print'<pre>';print_r($viewArray['search']);
            $this->load->view('layout/self_user_job_search_result_div',$searchResult);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function selfUserSearchEmp() {
        try{
            $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
            $this->_viewArray['page'] = 'self_user_search_emp_view';
            $this->_view('Search for All Jobs', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function selfUserSearchEmpResult() {
        try{
            $input = trim($_POST["company"]);
            $key = explode(" ",$input);
            //print'<pre>';print_r($key); exit;
            $searchResult['search'] = $this->user_operations_model->selfUserSearchEmpResult($key);
            //print'<pre>';print_r($viewArray['search']);
            $this->load->view('layout/self_user_emp_search_result_div',$searchResult);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function selfUserSuggestJobs(){
        try{
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId =  $userDetails->contactid;
            $this->_viewArray['sugJobs'] = $this->user_operations_model->selfUserSuggestJobs($contactId);
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_viewArray['page'] = 'self_user_jobs_suggest_view';
            $this->_view('Search for All Jobs', $this->_viewArray);
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
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

    public function editCandidate($candidateId) {
        $this->_viewArray['page'] = 'edit_candidate_view';
        $this->_viewArray['cans'] = $this->vendors_model->candidate($candidateId);
        $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
        $this->_viewArray['cities'] = $this->_utilities_model->fetchCities();
        $this->_view('Edit Candidate', $this->_viewArray);
    }
    public function searchIn() {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $search = $_POST["keyword"];
            $Word = explode(" ", $search);
            $c = count($Word);
            for($i=0;$i<$c;$i++) { $keyWord[$i] = trim($Word[$i]); }
            //print_r($keyWord);exit;
            $this->_viewArray['search'] = $this->vendors_model->searchIn($keyWord,$accountId);
            //print'<pre>';print_r($viewArray['search']);
            $this->_viewArray['page'] = 'search_inside_view';
            $this->_view('Search Result', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function jVApplyUser($jobPostId,$PostedAccId){
        try{
            $this->_viewArray['page'] = 'job_view_apply_view';
            $this->_viewArray['resultJob'] = $this->_jobOperations_model->viewAndApply($jobPostId,$PostedAccId);
            $this->_view('View And Apply Job', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function applyJobByUser($jobPostId,$PostedAccId){
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;
            $data['ja_post_id'] = $jobPostId;
            $data['ja_posted_by'] = $PostedAccId;
            $data['ja_applied_acc_id'] = $accountId;
            $data['ja_applied_con_id'] = $contactId;
            $data['ja_applied_date'] = date("Y-m-d");
            $data['ja_applied_time'] = date("hi-i-s");
            $this->_viewArray['skillsObj'] = $this->_jobOperations_model;
            $this->_jobOperations_model->applyJobByEmp($data);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Applied For this Job successfully !.';
            $this->session->set_flashdata('error', $error);
            /*$this->_viewArray['page'] = 'jobs_list_view';
            $this->_view('Dashboard', $this->_viewArray);*/
            redirect('user_dashboard');

        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function inProgress(){
        try{
            $this->_viewArray['page'] = 'in_progress_view';
            $this->_view('Under Construction', $this->_viewArray);
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
}
