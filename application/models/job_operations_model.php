<?php

require_once 'utilities_model.php';
require_once 'company_details_model.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Job_operations_model extends utilities_model
{

    private $_error = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function saveJobPost($jobDetails, $accountId, $contactId)
    {
        try {
            //$latlong = $this->_getLatLong($jobDetails['country'], $jobDetails['state'], $jobDetails['city'], $jobDetails['zipcode']);
            $postId = $this->_insertJobPost($jobDetails, $accountId, $contactId);
            //$postId = 20;
            if(isset($jobDetails['skills']) && (!empty($jobDetails['skills']))) {
                $this->_insertSkills($jobDetails['skills'], $postId);
            }
            $locationId = $this->_insertLocations($jobDetails);
            $this->_insertjobLocations($locationId, $postId);
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    private function _insertJobPost($jobDetails, $accountId, $contactId)
    {
        $array = array();
        try {
            //print'<pre>'; print_r($jobDetails); exit;
            $array['accountid'] = $accountId;
            $array['post_title'] = trim($jobDetails['posttitle']);
            $array['post_description'] = trim($jobDetails['postDescription']);
            $array['ctc_from'] = trim($jobDetails['ctc_from']);
            $array['ctc_to'] = trim($jobDetails['ctc_to']);
            $array['contract_terms'] = trim($jobDetails['contract_terms']);
            $array['experience_from'] = trim($jobDetails['experience_from']);
            $array['experience_to'] = trim($jobDetails['experience_to']);
            $array['createdby'] = $contactId;
            $array['createddate'] = date('Y-m-d');
            $array['createdtime'] = date('h:i:s');
            $array['jobid'] = trim($jobDetails['postid']);
            $array['rate'] = trim($jobDetails['rate']);
            $array['positions'] = trim($jobDetails['numpos']);
            $array['qualification'] = trim($jobDetails['qual']);
            $array['emp_type'] = trim($jobDetails['emptype']);
            $array['req_type'] = trim($jobDetails['reqtype']);
            $array['work_status'] = trim($jobDetails['work']);
            $array['keywords'] = trim($jobDetails['keyword']);
            $array['industry'] = trim($jobDetails['industry']);
            $array['fun_area'] = trim($jobDetails['funarea']);
            $array['comp_desc'] = trim($jobDetails['compDescription']);
            $array['travel_type'] = trim($jobDetails['travel']);
            $array['on_boarding_by'] = trim($jobDetails['onboardby']);
            $array['refresh_by'] = trim($jobDetails['refjob']);

            $this->db->insert('job_posts', $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _insertSkills($skillSet, $postId)
    {
        $skills = array();
        try {
            //print $postId; print_r($skillSet); exit;
            if(isset($skillSet) && (!empty($skillSet))) {
                foreach ($skillSet as $skill) {
                    if(is_numeric($skill)) {
                        $skills['post_id'] = trim($postId);
                        $skills['skill_id'] = trim($skill);
                        $skills['createddate'] = date('Y-m-d h:i:s');
                        $this->db->insert('job_post_skills', $skills);
                    } else {
                        $n_skill['skillname'] = trim($skill);
                        $n_skills['skilltypeid'] = 1;
                        $n_skills['status'] = 1;
                        $n_skills['createddate'] = date('Y-m-d h:i:s');

                        $g_skillId = $this->_insertNewSkills($n_skill);

                        if(is_numeric($g_skillId)) {
                            $skills['post_id'] = trim($postId);
                            $skills['skill_id'] = trim($g_skillId);
                            $skills['createddate'] = date('Y-m-d h:i:s');
                            $this->db->insert('job_post_skills', $skills);
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    private function _insertNewSkills($n_skill)
    {
        try {
            //print $n_skill; print_r($n_skill); exit;
            if(isset($n_skill) && (!empty($n_skill))) {
                $this->db->insert('skills', $n_skill);
                return $this->db->insert_id();
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    private function _insertLocations($jobDetails)
    {
        $locationDetails = array();
        try {
            $locationDetails['locationname'] = trim($_POST['location']);
            $locationDetails['latitude'] = trim($_POST['latitude']);
            $locationDetails['longitude'] = trim($_POST['longitude']);
            //$locationDetails['address'] = '';
            //$locationDetails['cityid'] = trim($jobDetails['city']);
            //$locationDetails['stateid'] = trim($jobDetails['state']);
            //$locationDetails['countryid'] = trim($jobDetails['country']);
            $locationDetails['createddate'] = date('Y-m-d h:i:s');
            $this->db->insert('locations', $locationDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    private function _insertjobLocations($locationId, $postId)
    {
        $locations = array();
        try {
            $locations['jobpost_id'] = trim($postId);
            $locations['location_id'] = trim($locationId);
            $locations['createddate'] = date('Y-m-d h:i:s');
            $this->db->insert('job_post_locations', $locations);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }


    public function updateJobPost($array, $loc, $nes) {
        //print"<pre>";print_r($array); print"<pre>";
        //print"<pre>";print_r($loc); print"<pre>";
        //print"<pre>";print_r($nes); print"<pre>";exit;
        try{
            $this->db->where('post_id', $nes['postId'])->update('job_posts',$array);
            $this->db->where('locationid', $nes['lId'])->update('locations',$loc);
            return true;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function fetchJobPostings($accountId)
    {
        try {
            $this->db->select('jp.post_id, COUNT(ja.`ja_id`) AS cnt,jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate,acnt.accountid as accid,jp.rate,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                    ->from('job_posts as jp')
                    ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                    ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                    ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                    ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                    ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                    ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                    ->join ('job_apply as ja','ja.ja_post_id = jp.post_id','left')
                    ->group_by('jp.post_id') ;
            $this->db->where('jp.status', '1');
            if (!is_null($accountId)) {
                $this->db->where('jp.accountid', $accountId);
            }
            $list_jobs = $this->db->get()->result();
           // echo $this->db->last_query();
            return $list_jobs;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function fetchJobPost($postId)
    {
        try {
            $this->db->select(' jp.post_id, jp.jobid, jp.positions, jp.qualification, jp.contract_terms, jp.keywords, jp.post_title,
                                jp.post_description, jp.ctc_from, jp.ctc_to, jp.experience_from, jp.experience_to, jp.createddate,
                                jp.fun_area,jp.comp_desc, jp.on_boarding_by, jp.industry, jp.emp_type, jp.req_type, jp.rate,
                                jp.travel_type, jps.skill_id, jps.job_post_skill_id as jpsId, skl.skillname, acnt.accountid as accid,
                                jp.refresh_by, l.locationname, jpl.location_id as lId, l.latitude, l.longitude, jpl.job_post_location_id as jplId, acnt.accountname')
                ->from('job_posts as jp')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join('job_post_skills as jps', 'jps.post_id = jp.post_id', 'left')
                ->join('skills as skl', 'skl.skillid = jps.skill_id', 'left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->join ('job_apply as ja','ja.ja_post_id = jp.post_id','left')
                ->group_by('jp.post_id') ;
            $this->db->where('jp.status', '1');
            if (!is_null($postId)) {
                $this->db->where('jp.post_id', $postId);
            }
            $list_jobs = $this->db->get()->result();
            //echo $this->db->last_query();
            return $list_jobs;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchApplied($postid) {
        try {
            $this->db   ->select('ja.ja_id, ja.ja_post_id, ja.ja_posted_by, ja.ja_can_id, ja.ja_applied_acc_id, ja.ja_applied_con_id, ja.ja_applied_date, acnt.accountid, acnt.accountname, acnt.accounttype, acnt.industrytype, i.industry_name,
                                    can.can_id, can.can_first_name, can.can_last_name, can.can_email, can.can_mobile, can.can_current_exp_years, can.can_current_exp_months,can.can_maj_skill,
                                    skl.skillname')
                        ->from('job_apply as ja')
                        ->join('accounts as acnt', 'acnt.accountid = ja.ja_applied_acc_id', 'left')
                        ->join('candidates as can', 'can.can_id = ja.ja_can_id', 'left')
                        ->join('skills as skl', 'skl.skillid = can.can_maj_skill', 'left')
                        ->join('industries as i', 'i.industryid = acnt.industrytype', 'left')
                        ->where('ja.ja_post_id',$postid);
            $list_applied = $this->db->get()->result();
            //echo $this->db->last_query();
            return $list_applied;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
	public function selfUserFetchAppliedJobs($postid) {
        try {
            $this->db   ->select('ja.ja_id, ja.ja_post_id, ja.ja_posted_by, ja.ja_can_id, ja.ja_applied_acc_id, ja.ja_applied_con_id, ja.ja_applied_date, acnt.accountid, acnt.accountname, acnt.accounttype, acnt.industrytype, i.industry_name,skl.skillname,jp.jobid,jp.post_title,jp.post_description,jp.ctc_from, jp.ctc_to,ja_applied_acc_id,jp.experience_from, jp.experience_to, jp.createddate,jp.rate')


                        ->from('job_apply as ja')
                        ->join('accounts as acnt', 'acnt.accountid = ja.ja_posted_by', 'left')
                        ->join('candidates as can', 'can.can_id = ja.ja_can_id', 'left')
						->join('job_posts as jp', 'jp.post_id = ja.ja_post_id', 'left')
                        ->join('skills as skl', 'skl.skillid = can.can_maj_skill', 'left')
                        ->join('industries as i', 'i.industryid = acnt.industrytype', 'left')
                        ->where('ja.ja_applied_con_id',$postid)
						->order_by('ja.ja_id','desc');
            $list_applied = $this->db->get()->result();
            //echo $this->db->last_query();
            return $list_applied;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function allJobList($accountId)
    {
        try {
            //print_r($accountId); //exit;
            $this->db   ->select('rr.requestfrom,skills.skillname, locations.locationname,rr.status as req_status,jp.post_id,
                                jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,ja_applied_acc_id,
                                jp.experience_from, jp.experience_to, jp.createddate, acnt.accountid as accid, jp.rate,
                                c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$accountId.', "1", "0"))) as is_requested_from', false)
                        //->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$accountId.', "1","0")) as is_requested_to', false)
                        ->from('relation_requests as rr')
                        ->join('accounts as acnt', 'acnt.accountid = rr.requestto', 'left')
                        ->join('job_posts AS jp','rr.requestto = jp.accountid','left')
                        ->join('job_apply AS ja','ja.ja_post_id = jp.post_id','left')
                        ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                        ->join ('locations', 'locations.locationid = jpl.location_id','left')
                        ->join ('job_post_skills as jps', 'jps.post_id = jp.post_id','left')
                        ->join ('skills', 'skills.skillid = jps.skill_id','left')
                        ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                        ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                        ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                        ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                        ->where('(acnt.accountid != '.$accountId .' and (rr.status = 5 and (rr.requestfrom = '.$accountId.' or rr.requestto = '.$accountId.')) and jp.post_id is not null)')
                        ->group_by('jp.post_id');
            /*if (!is_null($accountId)) {
                $this->db->where('jp.accountid', $accountId);
            }*/
            //print'<pre>';print_r($this->db->get()->result());
            //echo $this->db->last_query(); exit;
            return $this->db->get()->result();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function viewAndApply($jobPostId,$PostedAccId){
        try{
            $this->db->select('jp.post_id, skills.skillname,jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate,acnt.accountid as accid,jp.rate,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('job_posts as jp')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join ('job_post_skills as jps', 'jps.post_id = jp.post_id','left')
                ->join ('skills', 'skills.skillid = jps.skill_id','left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left');
            $this->db->where('jp.status = 1 and jp.post_id ='.$jobPostId.'');
            if (!is_null($PostedAccId)) {
                $this->db->where('jp.accountid', $PostedAccId);
            }
            $query = $this->db->get();
            $output = $query->result();
            return $output;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function applyJobByEmp($data){
        try {
            $this->db->insert('job_apply', $data);
            return $this->db->insert_id();
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function appliedJobsByEmp($curAccId){
        try{
            $this->db->select('jp.post_id, skills.skillname,jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate,acnt.accountid as accid,jp.rate,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('job_apply as ja')
                ->join('job_posts as jp','ja.ja_post_id = jp.post_id')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join ('job_post_skills as jps', 'jps.post_id = jp.post_id','left')
                ->join ('skills', 'skills.skillid = jps.skill_id','left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->where('jp.status = 1 and ja.ja_applied_acc_id ='.$curAccId.'')
                ->group_by('ja.ja_post_id');
            $query = $this->db->get();
            $output = $query->result();
            return $output;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchJobSkills($postId)
    {
        try {
            $this->db->select('s.skillname,jps.job_post_skill_id as postskill, s.skillid')
                    ->from('job_post_skills as jps')
                    ->join('skills as s', 'jps.skill_id = s.skillid and s.status=1', 'left');
            $this->db->where('jps.status', '1');
            $this->db->where('post_id', $postId);
            return $this->db->get()->result();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function fetchRequests($accountId)
    {
        try {
            $this->db->select('s.skillname,jps.job_post_skill_id as postskill, s.skillid')
                    ->from('job_post_skills as jps')
                    ->join('skills as s', 'jps.skill_id = s.skillid and s.status=1', 'left');
            $this->db->where('jps.status', '1');
            $this->db->where('post_id', $accountId);
            return $this->db->get()->result();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function fetchCompanies($companyName, $notAccount)
    {
        try {
            $this->db->select('accountname as item, accountid as id')
                    ->from('accounts');
            $this->db->where('status', '1');
            $this->db->like('accountname', $companyName);
            $this->db->where_not_in('accounttype', '1');
            $this->db->where_not_in('accountid', $notAccount);
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }



    private function _getLatLong($country, $state, $city, $zipcode)
    {
        $companyDetails = new company_details_model();
        $countries = $companyDetails->fetchCountries($country);
        $states = $companyDetails->fetchStates(NULL, $state);
        $cities = $companyDetails->fetchCities(NULL, $city);
        $states = $states[0];
        $countries = $countries[0];
        $cities = $cities[0];

        $url = "http://maps.google.com/maps/api/geocode/json?address=";
        $url .= urlencode($cities->cityname) . '+' . urlencode($states->statename) . '+' . urlencode($countries->countryname);
        $url .= '+' . urlencode($zipcode);
        //$url .= '&region=US';
        $result = file_get_contents($url);
        $response = json_decode($result, true);
        $lat = $response['results'][0]['geometry']['location']['lat'];
        $long = $response['results'][0]['geometry']['location']['lng'];
        return array('Latitude' => $lat, 'Longitude' => $long, 'Location' => $response['results'][0]['formatted_address']);
    }

}
