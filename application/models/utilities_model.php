<?php

require_once 'validation_model.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class utilities_model extends Validation_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fetchCountries($countryId = NULL)
    {
        try {
            $this->db->select('*')->from('countries');
            $this->db->where('status', '1');
            if (!is_null($countryId)) {
                $this->db->where('countryid', $countryId);
            }
            return $this->db->get()->result();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function fetchIndustries($industryId = NULL)
    {
        try {
            $this->db->select('*')->from('industries');
            $this->db->where('status', '1');
            if (!is_null($industryId)) {
                $this->db->where('industryid', $industryId);
            }
            return $this->db->get()->result();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function fetchStates($countryId = NULL, $stateId = NULL)
    {
        try {
            $this->db->select('*')->from('states');
            $this->db->where('status', '1');
            if (!is_null($countryId)) {
                $this->db->where('countryid', $countryId);
            }
            if (!is_null($stateId)) {
                $this->db->where('stateid', $stateId);
            }
            return $this->db->get()->result();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function fetchCities($stateId = NULL, $cityId = NULL)
    {
        try {
            $this->db->select('*')->from('cities');
            $this->db->where('status', '1');
            if (!is_null($stateId)) {
                $this->db->where('stateid', $stateId);
            }
            if (!is_null($cityId)) {
                $this->db->where('cityid', $cityId);
            }
            return $this->db->get()->result();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function fetchSkills($skillId = NULL, $skillTypeId = NULL)
    {
        try {
            $this->db->select('*')->from('skills');
            $this->db->where('status', '1');
            if (!is_null($skillId)) {
                $this->db->where('skillid', $skillId);
            }
            if (!is_null($skillTypeId)) {
                $this->db->where('skilltypeid', $skillTypeId);
            }
            return $this->db->get()->result();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public function searchVendors($search) {
        try{
            //print_r($search); exit;
            //print($current);
            $this->db   ->select('rr.requestfrom,skills.skillname, locations.locationname,rr.status as req_status')
                ->select('a.*')
                ->from('accounts as a')
                ->join('relation_requests as rr', 'rr.requestto = a.accountid', 'left')
                ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid', 'left')
                ->join('account_locations', 'account_locations.accountid = a.accountid','left')
                ->join('locations', 'locations.locationid = account_locations.locationid','left')
                ->join('accountskills', 'accountskills.accountid = a.accountid','left')
                ->join('skills', 'skills.skillid = accountskills.accountid','left')
                ->where_in("locations.locationname",$search)
                ->or_where_in("skills.skillname",$search)
                ->or_where_in("a.accountname",$search)
                ->group_by("a.accountid");

            $query = $this->db->get();
            $list = $query->result();
            //echo $this->db->last_query();
            //print'<pre>'; print_r($list); exit;
            return $list;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function searchJobs($search) {
        try{
            $this->db->select('jp.post_id, jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate, skills.skillname,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('job_posts as jp')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->join('job_post_skills', 'job_post_skills.post_id = jp.post_id')
                ->join('skills', 'skills.skillid = job_post_skills.skill_id')
                ->join('relation_requests', 'relation_requests.requestfrom = job_post_skills.skill_id')
                ->where_in("jp.post_title",$search)
                ->or_where_in("l.locationname",$search)
                ->or_where_in("skills.skillname",$search);
            $query = $this->db->get();
            $list = $query->result();
            //print_r($list); exit;
            //echo $this->db->last_query();
            return $list;

        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function land($keyWord, $keyWord2) {
        try
		{
			$keyWord2 = array_filter($keyWord2);
			
            $str_array = array();
            $str_array2 = array();
            
			if(!empty($keyWord))
			{
				$str_in = '';
				foreach($keyWord as $k=>$key)
				{
					$str_array[] =  'jp.post_title like "%'.$key .'%"';
					$str_array2[] =  'acnt.accountname like "%'.$key .'%"';
					$str_in .= "'".$key."',";
				}
				$str = array_merge($str_array, $str_array2);
				$str = join(' or ', $str );
				$str_in = trim($str_in,',' );
			}
			$this->db->select('jp.post_id, jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate, jp.rate, skills.skillname,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('job_posts as jp')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->join('job_post_skills', 'job_post_skills.post_id = jp.post_id')
                ->join('skills', 'skills.skillid = job_post_skills.skill_id')
                ->join('relation_requests', 'relation_requests.requestfrom = job_post_skills.skill_id')
                ->group_by('jp.post_id');
				
				if(!empty($keyWord))
				{
					$this->db->or_where('('.$str.' or skills.skillname in ('.$str_in.')'.')');
					
				}
				if(!empty($keyWord2))
				{
					$this->db->where_in("lc.cityname",$keyWord2);
				}
				
            $query = $this->db->get();
            $list = $query->result();
            //print'<pre>';print_r($list); exit;
            //echo $this->db->last_query();exit;
            return $list;
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function getLandSingleJob($postID) {
        try {
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
            $this->db->where('jp.status = 1 and jp.post_id ='.$postID.'');
            $query = $this->db->get();
            $output = $query->result();
            return $output;
        }catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function profile($accountId){
        try{
            $this->db   ->select('*')
                        ->from('accounts as a')
                        ->join('account_locations as al','al.accountid = a.accountid','left')
                        ->join('industries as i','i.industryid = a.industrytype','left')
                        ->join('contacts as cn','cn.accountid = a.accountid and cn.contacttypeid = 2','left')
                        ->join('locations as l','l.locationid = al.locationid','left')
                        ->join('cities as ct', 'ct.cityid = l.cityid and ct.status = 1', 'left')
                        ->join('states as s', 's.stateid = l.stateid and s.status = 1', 'left')
                        ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                        ->where('a.accountid',$accountId);
            $query = $this->db->get();
            $details = $query->result();
            //print'<pre>'; print_r($details); exit;
            return $details;
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    public function pSocial($accountId){
        try{
            $this->db   ->select('*')
                        ->from('account_social_url')
                        ->where('asu_account_id',$accountId);
            $query = $this->db->get();
            $details = $query->result();
            //print'<pre>'; print_r($details); exit;
            return $details;
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    public function pServices($accountId){
        try{
            $this->db   ->select('*')
                        ->from('account_services')
                        ->where('as_account_id',$accountId);
            $query = $this->db->get();
            $details = $query->result();
            //print'<pre>'; print_r($details); exit;
            return $details;
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    public function pCompany($accountId){
        try{
            $this->db   ->select('*')
                        ->from('account_company')
                        ->where('ac_account_id',$accountId);
            $query = $this->db->get();
            $details = $query->result();
            //print'<pre>'; print_r($details); exit;
            return $details;
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    public function pPortfolio($accountId){
        try{
            $this->db   ->select('*')
                        ->from('account_portfolio')
                        ->where('ap_account_id',$accountId);
            $query = $this->db->get();
            $details = $query->result();
            //print'<pre>'; print_r($details); exit;
            return $details;
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
}
