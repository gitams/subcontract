<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Landing extends CI_Controller
{
    private $_utilities_model;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLoggedin')) {
            if($this->session->userdata('userLoginDetails')){
                $userDetails = $this->session->userdata('userLoginDetails');
                $contact_type_id = $userDetails->contacttypeid;
                if($contact_type_id == 4){
                    redirect('no_profile');
                } else{
                    redirect('dashboard/index');
                }
            }
        }
        $this->_utilities_model = $this->load->model('utilities_model', '', TRUE);
        $this->load->helper('form');
    }
    public function index()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard');
        } else {
            $viewArray = array('title' => 'Subcontract');
            $this->load->view('layout/header', $viewArray);
            $this->load->view('landing_view', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        }
    }
    public function searchAll()
	{
		if(!isset($_POST) || (empty($_POST['searchKeyword']) && empty($_POST['searchKeyword2'])))
		{
			redirect('landing/index');
			exit;
		}
        $this->load->library('pagination');
		$keyWord = array();
		$keyWord2 = array();
        $search = addslashes($_POST["searchKeyword"]);
        $search2 = addslashes($_POST["searchKeyword2"]);
        if(!empty($search))
		{
			$Word = explode(" ", $search);
			$c = count($Word);
			for($i=0;$i<$c;$i++) { $keyWord[$i] = trim($Word[$i]); }
		}
		$keyWord2 = explode(" ", $search2);
        $viewArray = array('title' => 'Search Result');
		$viewArray['jobs'] = $this->_utilities_model->land($keyWord, $keyWord2);
        $this->load->view('layout/header', $viewArray);
        $this->load->view('search_all_result_view', $viewArray);
        $this->load->view('layout/footer', $viewArray);

    }
    public function landSingleJob($postId){
        try {
            $viewArray = array('title' => 'View Job');
            $viewArray['resultJob'] = $this->_utilities_model->getLandSingleJob($postId);
            $this->load->view('layout/header', $viewArray);
            $this->load->view('land_search_single_job_view', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function register()
    {
        //echo("start"); EXIT;
        if ($this->session->userdata('isLoggedin')) {
            //echo("hi"); EXIT;
            redirect('dashboard/index');
        }
        //echo("register"); EXIT;
        $viewArray = array('title' => 'Register as a Company');
        $viewArray['countries'] = $this->_utilities_model->fetchCountries();
        $viewArray['industries'] = $this->_utilities_model->fetchIndustries();
        $this->load->view('layout/header', $viewArray);
        $this->load->view('register_employer_new_view', $viewArray);
        $this->load->view('layout/footer', $viewArray);
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
    public function checkUser() 
	{
        try 
		{
            $userInput  = trim($_POST['email']);
            $comp = $this->load->model('company_details_model', '', TRUE);
            $boolean = $comp->checkEmail($userInput);
			//random token
			/*random number*/
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
			$string_length = 8;
			$randomstring = '';
			for ($i=0; $i<$string_length; $i++) 
			{
				$rnum = floor(rand() * strlen($chars));
				$randomstring = $randomstring . $chars.substr($rnum,$rnum+1);
			}
			$randomstring = $randomstring . "-@#$-'".$userInput."'";
			$encoded = base64_encode($randomstring);
			/*random number*/
            //$boolean2 = $comp->updateToken($userInput);
            $stat = $boolean->num_rows();
			if($stat >= 1)
			{
				$to = $userInput;
				$subject = "Forgot Password";
				$txt = "<a href='".base_url('landing/changePasswordCall?token='.$encoded.'')."'>Change Password</a>";
				$headers = "From: subcontract@gmail.com" . "\r\n" .
				"CC: subcontract@gmail.com";
				mail($to,$subject,$txt,$headers);
			}
			
            if($stat == 1)
			{
				redirect('/landing/forgotPasswordCall?msg=1');
				exit;
			}
			else
			{
				redirect('/landing/forgotPasswordCall?msg=2');
				exit;
			}
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
	public function changePasswordCall() {
        try {
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }
            $viewArray = array('title' => 'Forgot Password');
            $this->load->view('layout/header', $viewArray);
            $this->load->view('ChangePasswordView', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkExt() {
        try {
            $userInput  = trim($_POST['email']);
            $Word = explode("@", $userInput);
            $c = count($Word);
            for($i=0;$i<$c;$i++) { $keyWord[$i] = trim($Word[$i]); }
            $final = "@".$keyWord['1'];
            $comp = $this->load->model('company_details_model', '', TRUE);
            $boolean = $comp->checkExt($final);
            $stat = $boolean->num_rows();
            //print_r($stat);exit;
            //print_r($iReqCount);
            echo $stat;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkCompany() {
        try
        {
            $cmp_name  = trim($_POST['cmp_name']);
            $comp = $this->load->model('company_details_model', '', TRUE);
            $boolean = $comp->checkCompany($cmp_name);
            $stat = $boolean->num_rows();
            //print_r($stat);exit;
            //print_r($iReqCount);
            echo $stat;
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
            exit;
        }
    }
    public function saveCompanyNew()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        $comp = $this->load->model('company_details_model', '', TRUE);
        if (isset($_POST['aggrement']) && trim($_POST['aggrement']) == 'on') {
            $boolean = $comp->saveNew($_POST);
            if (!$boolean) {
                redirect('landing/register');
            }
            //print_r($boolean); exit;
            $accountId = $boolean['accountId'];
            $contactId = $boolean['contactId'];
            $log = $comp->getDetails($accountId);
            $log = $log['user'];
            $log = $log[0];
            $this->login_after_reg($log);
            //print_r($log); exit;
            /*$username = $log->first_name. ' ' .$log->last_name;
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('userrole', $log->contacttypeid);
            if ($log->accounttype == 2) {
                $this->session->set_userdata('isDefault', true);
            } else {
                $this->session->set_userdata('isDefault', false);
            }
            $this->session->set_userdata('userLoginDetails', $log);
            $userDetails = $this->session->userdata('userLoginDetails');
            $accountId = $userDetails->accountid;
            $contactId = $userDetails->contactid;
            $this->session->set_userdata('isLoggedin', '1');
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Registration successful, Welcome to SubContract';
            $this->session->set_flashdata('error', $error);
            redirect('dashboard');*/
        } else {
            $this->session->set_flashdata('error', array(array('alert alert-danger', 'Please accept Terms and Conditions.')));
            redirect('landing/register');
        }
    }
    public function login_after_reg($log)
    {
        //print"<pre>";print($log->username);print($log->password); exit;
        $useremail = trim($log->username);
        $userpassword = trim($log->password);
        $userOperations = $this->load->model('user_operations_model', '', TRUE);
        $userDetails = $userOperations->checkUser($useremail, $userpassword);
        if ($userDetails->num_rows() == 0) {
            $this->session->set_flashdata('error', array(array('alert alert-danger', 'No User present with the provided credentials.')));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata('isLoggedin', '1');
            $resultset = $userDetails->result();
            $resultset = $resultset[0];
            $username = $resultset->first_name. ' ' .$resultset->last_name;
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('userrole', $resultset->contacttypeid);
            if ($resultset->accounttype == 2) {
                $this->session->set_userdata('isDefault', true);
            } else {
                $this->session->set_userdata('isDefault', false);
            }
            $this->session->set_userdata('userLoginDetails', $resultset);
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Welcome to Subcontract';
            $this->session->set_flashdata('error', $error);
            if($contact_type_id == 4){
                redirect('no_profile');
            } else{
                redirect('no_profile_employer');
            }
        }
    }
    public function saveCompany()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        $comp = $this->load->model('company_details_model', '', TRUE);
        if (isset($_POST['aggrement']) && trim($_POST['aggrement']) == 'on') {
            $boolean = $comp->save($_POST);
            if (!$boolean) {
                redirect('landing/register');
            }
            $this->session->set_userdata('latlong', $boolean);
            redirect('landing/step2');
        } else {
            $this->session->set_flashdata('error', array(array('alert alert-danger', 'Please accept Terms and Conditions.')));
            redirect('landing/register');
        }
    }

    public function updateLatLong()
    {
        $comp = $this->load->model('companyDetails_model', '', TRUE);
        $contactId = trim($_POST['contactId']);
        $latitude = trim($_POST['latitude']);
        $longitude = trim($_POST['longitude']);
        $comp->updateLatLong($contactId, $latitude, $longitude);
    }
    public function step2()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        if ($this->session->userdata('latlong')) {
            //$latdetails= $this->session->userdata('latlong');
            //print_r($latdetails);
            $viewArray = array('title' => 'Registration - step2');
            //$comp = $this->load->model('companyDetails_model', '', TRUE);
            $this->load->view('layout/header', $viewArray);
            $this->load->view('step2', array('latlong' => $this->session->userdata('latlong')));
            $this->load->view('layout/footer', $viewArray);
        } else {
            redirect('landing/register');
        }

    }
    public function saveStep2(){
        $accountId = $_POST['accountIdNumber'];
        $comp = $this->load->model('company_details_model', '', TRUE);
        $log = $comp->getDetails($accountId);
        $log = $log['user'];
        $log = $log[0];
        $username = $log->first_name. ' ' .$log->last_name;
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('userrole', $log->contacttypeid);
        if ($log->accounttype == 2) {
            $this->session->set_userdata('isDefault', true);
        } else {
            $this->session->set_userdata('isDefault', false);
        }
        $this->session->set_userdata('userLoginDetails', $log);
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
        $data['asu_created_by'] = $accountId;
        $data['asu_created_date'] = date("Y-m-d");
        $data['asu_created_time'] = date("h-i-s");
        $log = $comp->insertSocial($data);
        $this->session->set_userdata('socialId', $log);
        $this->session->unset_userdata('latlong');
        redirect('landing/step3');
        //echo '<pre>'; print($log); echo '<pre>';
    }

    public function step3()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        //print'<pre>'; print_r($userDetails); print'<pre>';//exit;
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        //echo '<pre>'; print_r($userDetails); echo '</pre>';//exit;
        if($this->session->userdata('socialId')){
            $viewArray = array('title' => 'Registration - step3');
            //$comp = $this->load->model('companyDetails_model', '', TRUE);
            $this->load->view('layout/header', $viewArray);
            $this->load->view('step3', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        }else{
            redirect('landing/register');
        }
    }
    public function skipStep3() {
        try{
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }elseif($this->session->userdata('userLoginDetails')) {
                $viewArray = array('title' => 'Registration - step4');
                //$comp = $this->load->model('companyDetails_model', '', TRUE);
                $this->load->view('layout/header', $viewArray);
                $this->load->view('step4', $viewArray);
                $this->load->view('layout/footer', $viewArray);
            } else {
                redirect('landing/register');
            }
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function saveStep3(){
        try {
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }elseif($this->session->userdata('userLoginDetails')) {
                //echo '<pre>'; print_r($_POST); exit;
                $userDetails = $this->session->userdata('userLoginDetails');
                $accountId = $userDetails->accountid;
                $contactId = $userDetails->contactid;

                $data['as_account_id'] = $accountId;
                $data['as_contact_id'] = $contactId;

                $data['as_service'] = trim($_POST['serviceName']);
                $data['as_expertise'] = trim($_POST['expertise']);
                $data['as_client'] = trim($_POST['client']);

                $data['as_created_by'] = $accountId;
                $data['as_created_date'] = date("Y-m-d");
                $data['as_created_time'] = date("h-i-s");
                $comp = $this->load->model('company_details_model', '', TRUE);
                $as = $comp->insertAccountServices($data);
                $this->session->set_userdata('serviceId', $as);
                //$this->session->unset_userdata('socialId');
                redirect('landing/step4');
                //echo '<pre>'; print($log); echo '<pre>';
            } else {
                redirect('landing/register');
            }
        }catch (Exception $ex){
            echo $ex->getMessage();exit;
        }

    }

    public function doItLater(){
        try{
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }
            $this->session->set_userdata('isLoggedin', '1');
            redirect('dashboard');
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function step4()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }elseif($this->session->userdata('userLoginDetails')) {
            $viewArray = array('title' => 'Registration - step4');
            //$comp = $this->load->model('companyDetails_model', '', TRUE);
            $this->load->view('layout/header', $viewArray);
            $this->load->view('step4', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        }

    }

    public function skipStep4() {
        try{
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }elseif($this->session->userdata('userLoginDetails')) {
                $viewArray = array('title' => 'Registration - step5');
                //$comp = $this->load->model('companyDetails_model', '', TRUE);
                $this->load->view('layout/header', $viewArray);
                $this->load->view('step5', $viewArray);
                $this->load->view('layout/footer', $viewArray);
            } else {
                redirect('landing/register');
            }
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function saveStep4(){

        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        //echo '<pre>'; print_r($_POST); exit;

        $data['ac_account_id'] = $accountId;
        $data['ac_contact_id'] = $contactId;

        $data['ac_est_date'] = trim($_POST['estDate']);
        $data['ac_ann_revenue'] = trim($_POST['annRev']);
        $data['ac_num_emp'] = trim($_POST['numEmp']);

        $data['ac_created_by'] = $accountId;
        $data['ac_created_date'] = date("Y-m-d");
        $data['ac_created_time'] = date("h-i-s");

        $comp = $this->load->model('company_details_model', '', TRUE);
        $com = $comp->insertAccountComp($data);
        $this->session->set_userdata('comId', $com);
        //$this->session->unset_userdata('socialId');
        redirect('landing/step5');
        //echo '<pre>'; print($log); echo '<pre>';
    }
    public function step5()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        $viewArray = array('title' => 'Registration - step5');
        //$comp = $this->load->model('companyDetails_model', '', TRUE);
        $this->load->view('layout/header', $viewArray);
        $this->load->view('step5', $viewArray);
        $this->load->view('layout/footer', $viewArray);
    }

    public function complete()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        print'<pre>';print_r($_POST);
        print'<pre>';print_r($_FILES);
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

                $config['upload_path'] = APPPATH.'../assets/portfolio_images/';
                //print($config['upload_path']);
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
    public function registerUser()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard/index');
        }
        $viewArray = array('title' => 'Register as a User');
        $viewArray['skills'] = $this->_utilities_model->fetchSkills();
        $viewArray['countries'] = $this->_utilities_model->fetchCountries();
        $viewArray['industries'] = $this->_utilities_model->fetchIndustries();
        $this->load->view('layout/header', $viewArray);
        $this->load->view('register_user_view', $viewArray);
        $this->load->view('layout/footer', $viewArray);
    }
    public function saveUser()
    {
        if ($this->session->userdata('isLoggedin')) {
            redirect('dashboard');
        } else {
            $users['first_name'] = trim($_POST['user_fname']);
            $users['last_name'] = trim($_POST['user_lname']);
            $users['username'] = $_POST['user_email'];
            $users['phonenumber'] = $_POST['user_mobile'];
            $users['password'] = $_POST['user_password'];
            $users['contacttypeid'] = 4;
            $users['status'] = 1;
            $users['accountid'] = 1;
            $users['createdby'] = 1;
            $users['createddate'] = date("Y-m-d h-i-s");
            $this->load->model('company_details_model');
            $insId = $this->company_details_model->insertUser($users);
            $log = $this->company_details_model->getDetailsUser($insId);
            $log = $log['user'];
            $log = $log[0];
            $this->login_after_reg($log);
            $error[0][0] = 'alert alert-success';
            $error[0][1] = 'Registration successful, Please Login with email and password..';
            $this->session->set_flashdata('error', $error);
            redirect(base_url());
        }
    }
    public function login()
    {
        //echo "hi"; exit;
        $userOperations = $this->load->model('user_operations_model', '', TRUE);
        $userDetails = $userOperations->checkUser(trim($_POST['useremail']), trim($_POST['userpassword']));
        if ($userDetails->num_rows() == 0) {
            $this->session->set_flashdata('error', array(array('alert alert-danger', 'No User present with the provided credentials.')));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata('isLoggedin', '1');
            $resultset = $userDetails->result();
            $resultset = $resultset[0];
            $username = $resultset->first_name. ' ' .$resultset->last_name;
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('userrole', $resultset->contacttypeid);
            if ($resultset->accounttype == 2) {
                $this->session->set_userdata('isDefault', true);
            } else {
                $this->session->set_userdata('isDefault', false);
            }
            $this->session->set_userdata('userLoginDetails', $resultset);
            $userDetails = $this->session->userdata('userLoginDetails');
            $contact_type_id = $userDetails->contacttypeid;
            if($contact_type_id == 4){
                redirect('no_profile');
            } else{
                redirect('no_profile_employer');
            }
        }
    }
    public function forgotPasswordCall() {
        try {
            if ($this->session->userdata('isLoggedin')) {
                redirect('dashboard/index');
            }
            $viewArray = array('title' => 'Forgot Password');
            $this->load->view('layout/header', $viewArray);
            $this->load->view('forgot_password_view', $viewArray);
            $this->load->view('layout/footer', $viewArray);
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
}
