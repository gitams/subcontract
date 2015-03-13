<?php   if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class No_profile extends CI_Controller
{
    private $_utilities_model;
    private $_viewArray;
    private $_loginDetails;
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedin')) {
            redirect('landing/index');
        }
        $this->load->model('user_operations_model');
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
        if ($contact_type_id != 4) {
            redirect('dashboard');
        }
    }
    public function index() {
        try {
            $this->_loginDetails = $this->session->userdata('userLoginDetails');
            $contactId = $this->_loginDetails->contactid;
            $profileCheck = $this->user_operations_model->checkProfile($contactId);
            $profileExist = count($profileCheck);
            if ($profileExist != 1) {
                $p = $this->user_operations_model->getProfile($contactId);
                $this->_viewArray['profile'] = $p[0];
                $this->_viewArray['pExist'] = $profileExist;
                $this->_viewArray['skills'] = $this->_utilities_model->fetchSkills();
                $this->_viewArray['countries'] = $this->_utilities_model->fetchCountries();
                $this->_viewArray['industries'] = $this->_utilities_model->fetchIndustries();
                $this->load->view('add_self_user_profile_view', $this->_viewArray);
            } else {
                redirect('user_dashboard');
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
    public function saveSelfUser() {
        try {
            $userDetails = $this->session->userdata('userLoginDetails');
            $contactId = $userDetails->contactid;
            //print'<pre>';print_r($_FILES); exit;
            $data['scd_contact_id']     = $contactId;
            $data['scd_first_name']     = $_POST['su_first_name'];
            $data['scd_last_name']      = $_POST['su_last_name'];
            $data['scd_mobile']         = $_POST['su_mobile'];
            $data['scd_email']          = $_POST['su_email'];
            $data['scd_cur_ctc']        = $_POST['su_ctc'];
            $data['scd_tot_exp_yr']     = $_POST['su_exp_year'];
            $data['scd_exp_mnth']       = $_POST['su_exp_mnth'];
            $data['scd_majar_skill']    = $_POST['su_skill'];
            $data['scd_cur_company']    = $_POST['su_current_company'];
            $data['scd_cur_emp_type']   = $_POST['su_emp_type'];
            $data['scd_cur_work_type']  = $_POST['su_work_type'];
            //$data['scd_resume']  = $_POST['su_resume'];
            $data['scd_high_edu']       = $_POST['su_high_edu'];
            $data['scd_high_year']      = $_POST['su_high_year_pass'];
            $data['scd_high_univ']      = $_POST['su_high_univ'];
            $data['scd_other_edu']      = $_POST['su_other_edu'];
            $data['scd_other_year']     = $_POST['su_other_year_pass'];
            $data['scd_other_univ']     = $_POST['su_other_univ'];
            $data['scd_other_skill_1']  = $_POST['other_skill_1'];
            $data['scd_other_skill_2']  = $_POST['other_skill_2'];
            $data['scd_location']    = $_POST['location'];
            

            $data['scd_status']         = 1;
            $data['scd_created_date']   = date("Y-m-d");
            $data['scd_created_time']   = date("h-i-s");
            $data['scd_created_by']     = $contactId;

            $config['upload_path']      = APPPATH . 'self_user_resumes';
            $config['allowed_types']    = 'doc|docx|pdf';
            $config['max_size']         = '10000';

            $this->load->library('upload', $config);
            if (isset($_FILES['su_resume']) && $_FILES['su_resume']['size'] > 0) { // user provided a file to upload
                $this->load->library("upload");
                if (!$this->upload->do_upload('su_resume')) { // already checked for file from form, so this is a legit error
                    $error = array('error' => $this->upload->display_errors());
                    $data['error'] = $error['error']; // print_r($error); exit;
                    $this->_viewArray['vendors'] = $data;
                    $this->load->view('add_self_user_profile_view', $this->_viewArray);
                } else {
                    $upload_data = $this->upload->data();
                    $data['scd_resume'] = $upload_data['file_name'];
                    $this->user_operations_model->insertSelfUser($data);
                    $this->session->set_flashdata('suc_msg', 'Profile Added successfully !'); //$this->load->view('add_candidate_view',$data);
                    redirect('user_dashboard/index');
                }
            }
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
