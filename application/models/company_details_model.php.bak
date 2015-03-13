<?php

require_once 'utilities_model.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Company_details_model extends utilities_model
{

    private $_error = array();

    public function __construct()
    {
        parent::__construct();
    }
    public function checkEmail($user,$mob) {
        try {
            $this->db->select('username,contactid,accountid,first_name,last_name,phonenumber')
                ->from('contacts')
                ->where('username = '."'$user'".' and phonenumber = '.$mob.'');
            $query =  $this->db->get();
            $list = $query->result();
            return $list;
			//echo $this->db->last_query();exit;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkEmailLand($user) {
        try {
            $this->db->select('username,contactid,accountid,first_name,last_name,phonenumber')
                ->from('contacts')
                ->where('username',$user);
            return  $this->db->get();
            //echo $this->db->last_query();exit;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function temp_forgot($t,$c) {
        try {
            $this->db->where('contactid',$c)->update('contacts',$t);
            return true;
            //echo $this->db->last_query();exit;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function check_link_expire($a,$c) {
        try {
            $this->db->select('temp_p')
                ->from('contacts')
                ->where('contactid = '."'$c'".' and accountid = '.$a.'');
            $query =  $this->db->get();
            $list = $query->result();
            return $list;
            //echo $this->db->last_query();exit;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateNewPass($ncp,$a,$c,$t,$e) {
        try 
		{
            $retVal = false;
			$sql = "select * from contacts where contactid = ? and accountid = ? and username=? ";
			$query = $this->db->query($sql, array($c,$a,$e));
			if($query->num_rows() > 0)
			{
				$this->db->where('contactid = '.$c.' and accountid = '.$a.' and username = '."'$e'".' and temp_p = '."'$t'".'')->update('contacts',$ncp);
				$retVal = true;
			}
			else
			{
				$retVal = false;
			}
            return $retVal;
            //echo $this->db->last_query();exit;
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkExt($user) {
        try {
            $this->db->select('*')
                ->from('contacts')
                ->like('username',$user);
            return $this->db->get();
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkCompany($name) {
        try {
            $this->db->select('*')
                ->from('accounts')
                ->like('accountname',$name);
            return $this->db->get();
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function saveNew($companyDetails) {
        try {
            $accountId = $this->_insertAccountDetails($companyDetails);
            $contactId = $this->_insertContactDetails($companyDetails, $accountId);
            $latlong['accountId'] = $accountId;
            $latlong['contactId'] = $contactId;
            return $latlong;
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function save_after_login(){
        try {

        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function save($companyDetails)
    {
        try {
            if (!$this->_checkCompany($companyDetails)) {
                $this->session->set_flashdata('error', $this->_error);
                return false;
            } elseif (!$this->_restrictDomains(trim($companyDetails['username']))) {
                $error[0][0] = 'alert alert-danger';
                $error[0][1] = 'Invalid Email domain selected.';
                $this->session->set_flashdata('error', $error);
                return false;
            } else {
                $latlong = $this->_getLatLong($companyDetails['address1'] . ' ' . $companyDetails['address2'], $companyDetails['country'], $companyDetails['city'], $companyDetails['state'], $companyDetails['zipcode']);
                $accountId = $this->_insertAccountDetails($companyDetails);
                $contactId = $this->_insertContactDetails($companyDetails, $accountId);
                $locationId = $this->_insertLocationDetails($companyDetails, $latlong);
                $this->_insertAccountLocationDetails($accountId, $locationId);
                $latlong['accountId'] = $accountId;
                $latlong['contactId'] = $contactId;
                return $latlong;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function getDetails($accountId)
    {
        try {
            $this->db->select('*')->from('contacts as c')
                ->join('accounts as a','a.accountid = c.accountid')
                ->where('c.accountid',$accountId);
            $query =  $this->db->get();
            $list['user'] = $query->result();
            return $list;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function getDetailsUser($cId)
    {
        try {
            $this->db->select('*')->from('contacts as c')
                ->where('c.contactid',$cId);
            $query =  $this->db->get();
            $list['user'] = $query->result();
            return $list;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateLatLong($locationId, $latitude, $longitude)
    {
        try {
            $latArray = array('latitude' => $latitude, 'longitude' => $longitude);
            $this->db->where('locationid', $locationId);
            $this->db->update('locations', $latArray);
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _restrictDomains($username = NULL)
    {
        try {
            $username = strtolower($username);
            $pos = (strpos($username, '@') + 1);
            $domain_ext = substr($username, $pos);
            $dotPos = strpos($domain_ext, '.');
            $domain = substr($username, $pos, $dotPos);
            $restrictedDomains = $this->config->item('restrictedDomains');
            if (in_array($domain, $restrictedDomains)) {
                return false;
            }
            return $domain;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _insertAccountDetails($companyDetails)
    {
        $accountDetails = array();
        $account_type = 2; // 2 - Company
        try {
            $accountDetails['accountname'] = trim($companyDetails['companyname']);
            $accountDetails['accounttype'] = $account_type;
            if(isset($companyDetails['industry']) && !empty($companyDetails['industry'])) {
                $accountDetails['industrytype'] = trim($companyDetails['industry']);
            }
            $accountDetails['aggrement'] = (isset($companyDetails['aggrement'])) ? 1 : 0;
            $accountDetails['promotions'] = (isset($companyDetails['promotions'])) ? 1 : 0;
            $accountDetails['createddate'] = date('Y-m-d H:i:s');
            $this->db->insert('accounts', $accountDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _insertAccountLocationDetails($accountId, $locationId)
    {
        $accountDetails = array();
        try {
            $accountDetails['accountid'] = $accountId;
            $accountDetails['locationid'] = $locationId;
            $accountDetails['createddate'] = date('Y-m-d H:i:s');
            $this->db->insert('account_locations', $accountDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _insertLocationDetails($companyDetails, $latlong)
    {
        $locationDetails = array();
        try {
            $locationDetails['locationname'] = trim($latlong['Location']);
            $locationDetails['latitude'] = trim($latlong['Latitude']);
            $locationDetails['longitude'] = trim($latlong['Longitude']);
            $locationDetails['address'] = trim($companyDetails['address1']) . ' ' . trim($companyDetails['address2']);
            $locationDetails['cityid'] = trim($companyDetails['city']);
            $locationDetails['stateid'] = trim($companyDetails['state']);
            $locationDetails['countryid'] = trim($companyDetails['country']);
            $locationDetails['createddate'] = date('Y-m-d H:i:s');
            $this->db->insert('locations', $locationDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _insertContactDetails($companyDetails, $accountId)
    {
        $contactDetails = array();
        $contact_type = 2; // 2 - Company
        try {
            $contactDetails['contacttypeid'] = $contact_type;
            $contactDetails['accountid'] = $accountId;
            $contactDetails['username'] = trim($companyDetails['username']);
            $contactDetails['password'] = trim($companyDetails['password']);
            if(isset($companyDetails['contactName']) && !empty($companyDetails['contactName'])) {
                $contactDetails['first_name'] = trim($companyDetails['contactName']);
            }
            if(isset($companyDetails['contactNumber']) && !empty($companyDetails['contactNumber'])) {
                $contactDetails['phonenumber'] = trim($companyDetails['contactNumber']);
            }
            $contactDetails['createddate'] = date('Y-m-d H:i:s');
            $this->db->insert('contacts', $contactDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function insertSocial($data){
        $this->db->insert('account_social_url',$data);
        return $this->db->insert_id();
    }
    public function updateSocial($data,$a){
        $this->db->where('asu_account_id',$a)->update('account_social_url',$data);
        return true;
    }
    public function insertAccountServices($data){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        $this->db   ->where('as_account_id = '.$accountId.' and as_contact_id = '.$contactId.'')
                    ->delete('account_services');
        $this->db->insert('account_services',$data);
        return $this->db->insert_id();
    }
    public function updateAccountServices($data,$a,$c){
        $this->db->where('as_account_id = '.$a.' and as_contact_id = '.$c.'')->update('account_services',$data);
        return true;
    }
    public function insertAccountComp($data){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        $this->db   ->where('ac_account_id = '.$accountId.' and ac_contact_id = '.$contactId.'')
            ->delete('account_company');
        $this->db->insert('account_company',$data);
        return $this->db->insert_id();
    }
    public function updateAccountComp($data,$a,$c){
        $this->db->where('ac_account_id = '.$a.' and ac_contact_id = '.$c.'') ->update('account_company',$data);
        return true;
    }
    public function insertAccountPort($data){
        $userDetails = $this->session->userdata('userLoginDetails');
        $accountId = $userDetails->accountid;
        $contactId = $userDetails->contactid;
        $this->db   ->where('ap_account_id = '.$accountId.' and ap_contact_id = '.$contactId.'')
            ->delete('account_portfolio');
        $this->db->insert('account_portfolio',$data);
        return $this->db->insert_id();
    }
    private function _checkCompany($companyDetails)
    {
        $counter = 0;
        try {
            if (!$this->validate_email_dot_underscore(trim($companyDetails['username'])) || empty($companyDetails['username'])) {
                $this->_error[$counter][0] = 'alert alert-danger';
                $this->_error[$counter][1] = 'Invalid Email entered.';
                $counter++;
            }
            /*if (!$this->validate_alphanumeric_password(trim($companyDetails['password'])) || empty($companyDetails['password'])) {
                $this->_error[$counter][0] = 'alert alert-danger';
                $this->_error[$counter][1] = 'Please enter a valid password.<br/>Allowed characters are A-Z, a-z, 0-9 and special characters(!@$).';
                $counter++;
            }
            if (!$this->validate_alphanumeric_password(trim($companyDetails['confirmpassword'])) || empty($companyDetails['confirmpassword'])) {
                $this->_error[$counter][0] = 'alert alert-danger';
                $this->_error[$counter][1] = 'Please enter valid password for confirmation.';
                $counter++;
            }*/
            if (trim($companyDetails['confirmpassword']) != trim($companyDetails['password'])) {
                $this->_error[$counter][0] = 'alert alert-danger';
                $this->_error[$counter][1] = 'Please enter valid password for confirmation same as password.';
                $counter++;
            }
            if ($counter > 0) {
                return false;
            }
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _getLatLong($address, $country, $city, $state, $zipcode)
    {
        $countries = $this->fetchCountries($country);
        $states = $this->fetchStates(NULL, $state);
        $cities = $this->fetchCities(NULL, $city);

        $url = "http://maps.google.com/maps/api/geocode/json?address=";
        $url .= urlencode($address) . '+' . urlencode($cities[0]->cityname) . '+' . urlencode($states[0]->statename) . '+' . urlencode($countries[0]->countryname);
        $url .= '+' . urlencode($zipcode);
        //$url .= '&region=US';
        $result = file_get_contents($url);
        $response = json_decode($result, true);
        $lat = $response['results'][0]['geometry']['location']['lat'];
        $long = $response['results'][0]['geometry']['location']['lng'];
        return array('Latitude' => $lat, 'Longitude' => $long, 'Location' => $response['results'][0]['formatted_address']);
    }
    public function insertUser($data){
        $this->db->insert('contacts', $data);
        return $this->db->insert_id();
    }
    public function checkProfileEmployer($id) {
        try{
            $this->db->select('*')->from('contacts as c')->where('c.accountid = '.$id.' and c.first_name is null');
            $query = $this->db->get();
            return  $list = $query->result();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function getProfile($id) {
        try{
            $this->db->select('*')->from('contacts')->where('contactid',$id);
            $query = $this->db->get();
            $list = $query->result();
            return  $list;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function insert_location_after_login($data) {
        try{
            //print_r($data); exit;
            $this->db->insert('locations',$data);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function insert_account_location_after_login($alData) {
        try{
            $this->db->insert('account_locations',$alData);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function update_industry_after_login($indus,$a){
        $this->db->where('accountid',$a)->update('accounts',$indus);
        return true;
    }
    public function update_contact_after_login($cont,$a){
        $this->db->where('accountid',$a)->update('contacts',$cont);
        return true;
    }
    public function insert_website_after_login($social) {
        try{
            $this->db->insert('account_social_url',$social);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function getUserName($a){
        $this->db->select('first_name,last_name')->from('contacts')->where('accountid',$a);
        $query = $this->db->get();
        $list = $query->result();
        return  $list;
    }
}
