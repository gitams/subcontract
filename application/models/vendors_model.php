<?php
/**
 * Created by PhpStorm.
 * User: Yasaswi Kiran
 * Date: 11/26/2014
 * Time: 1:51 PM
 */
class Vendors_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function getVendors($current) {
        try{
            $this->db   ->select('locations.locationname')
                        ->select("accounts.*")
                        ->from("accounts")
                        ->join ('account_locations', 'account_locations.accountid = accounts.accountid','left')
                        ->join ('locations', 'locations.locationid = account_locations.locationid','left')

                        ->group_by('accounts.accountid')
                        ->where('accounts.accountid !=',$current);
            $query = $this->db->get();
            //echo $this->db->last_query();
            $list['vendors'] = $query->result();
            return $list;

        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchVendors($search,$currentid) {
        try{
            //print_r($search); exit;
            //print($current);
            $this->db   ->select('rr.requestfrom,skills.skillname, locations.locationname,rr.status as req_status')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$currentid.', "1", "0"))) as is_requested_from', false)
                        ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$currentid.', "1","0")) as is_requested_to', false)
                        ->select('a.*')
                        ->from('accounts as a')
                        ->where('a.accountid !=', $currentid)
                        ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$currentid.'', 'left')
                        ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$currentid.'', 'left')
                        ->where('((rr.requestfrom = '.$currentid.') or (rr.requestfrom is null) or (rr2.requestto = 4) or(rr2.requestto is null))')
                        ->join ('account_locations', 'account_locations.accountid = a.accountid','left')
                        ->join ('locations', 'locations.locationid = account_locations.locationid','left')
                        ->join ('accountskills', 'accountskills.accountid = a.accountid','left')
                        ->join ('skills', 'skills.skillid = accountskills.accountid','left')
                        ->where("locations.locationname",$search)
                        ->or_where("skills.skillname",$search)
                        ->or_where("a.accountname",$search)
                        ->group_by("a.accountid");

            $query = $this->db->get();
            $list['vendors'] = $query->result();
            echo $this->db->last_query();
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
                ->join ('job_post_skills', 'job_post_skills.post_id = jp.post_id')
                ->join ('skills', 'skills.skillid = job_post_skills.skill_id')
                ->join ('relation_requests', 'relation_requests.requestfrom = job_post_skills.skill_id')
                ->where("jp.post_title",$search)
                -> or_where("l.locationname",$search)
                -> or_where("skills.skillname",$search);
            /*$this->db->where('jp.status', '1');
            $this->db   ->select('skills.skillname, locations.locationname')
                        ->select('job_posts.*')
                        ->from("job_posts")
                        ->join ('job_post_locations', 'job_post_locations.jobpost_id = job_posts.post_id')
                        ->join ('locations', 'locations.locationid = job_post_locations.location_id')
                        ->join ('job_post_skills', 'job_post_skills.post_id = job_posts.post_id')
                        ->join ('skills', 'skills.skillid = job_post_skills.skill_id')
                        ->where("job_posts.post_title",$search)
                        -> or_where("locations.locationname",$search)
                        -> or_where("skills.skillname",$search);*/
            $query = $this->db->get();
            $list = $query->result();
            //print_r($list); exit;
            return $list;

        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchIn($keyWord,$curAccId) {
        try{
            $str_array = array();
            $str_array2 = array();
            foreach($keyWord as $k=>$key)
            {
                $str_array[] =  'jp.post_title like "%'.$key .'%"';
                $str_array2[] =  'acnt.accountname like "%'.$key .'%"';
            }
            $str = array_merge($str_array, $str_array2);
            $str = join(' or ', $str );
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
                ->where($str)
                ->or_where_in("lc.cityname",$keyWord)
                ->or_where_in("skills.skillname",$keyWord)
                ->group_by('jp.post_id');
            $query = $this->db->get();
            $list = $query->result();
            //print'<pre>';print_r($list); exit;
            //echo $this->db->last_query();
            return $list;
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function insertRec($data) {
        try {
                $this->db->insert('contacts', $data);
                return $this->db->insert_id();
        } catch(Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function listRec($accountId) {
        try {
            $this->db->select('*')->from('contacts')->where('(createdby='.$accountId.') and contacttypeid = 3');
            $query = $this->db->get();
            return  $list = $query->result();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }
    public function insertCandidate($data) {
        try {
            $upload_data = $this->upload->data();
            $data['can_resume'] =   $upload_data['file_name'];
            $this->db->insert('candidates',$data);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function insertCandidate_Details($data,$accountId) {
        try {
            $this->db->select('can_id')->from('candidates')->where('can_account_id',$accountId)->order_by('can_id', "desc")->limit(1);
            $query = $this->db->get();
            $result = $query->result();
            //echo $this->db->last_query();
            //print_r($result[0]->can_id); exit;
            $data['candidate_id'] = $result[0]->can_id;
            $this->db->insert('candidate_details',$data);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateCandidate($can, $canD, $canId, $accountId) {
        try {

            $this->db->select('candidate_id')->from("candidate_details")->where('candidate_id',$canId);
            $query = $this->db->get();
            $rec = $query->result();
            $c = count($rec);
            //print($c); exit;
            if($c == 0) {
                $this->db->where('can_id',$canId)->update('candidates',$can);
                $canD['candidate_id'] = $canId;
                $canD['can_det_account_id'] = $accountId;
                $canD['can_det_created_date'] = date("Y-m-d");
                $canD['can_det_created_time'] = date("h-i-s");
                $canD['can_det_created_by'] = $accountId;
                $this->db->insert('candidate_details',$canD);
            } else {
                $this->db->where('can_id',$canId)->update('candidates',$can);
                $canD['can_det_updated_date'] = date("Y-m-d");
                $canD['can_det_updated_time'] = date("h-i-s");
                $canD['can_det_updated_by'] = $accountId;
                $this->db->where('candidate_id',$canId)->update('candidate_details',$canD);
            }
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function listCandidates($accountId) {
        try {
            $this->db->select('*') 
				->select('ss.skillname, cityname')
				->select('a.accountname, cityname')
                ->from('candidates')
                ->join('accounts as a','a.accountid = candidates.can_account_id','left')
                ->join('skills as ss','ss.skillid = candidates.can_maj_skill','left')
                ->join('candidate_details as cd', 'cd.candidate_id = candidates.can_id','left')
                ->join ('cities as city', 'city.cityid = cd.can_cur_city','left')
				->order_by('is_can_placed,can_created_date,can_created_time')
                ->group_by('candidates.can_id');
            $this->db->where('can_account_id', $accountId);
            $query = $this->db->get();
            return  $list = $query->result();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
	public function requestListCandidates($accountId, $logged_in) {
        try 
		{
		    $this->db->select('request_resumes.*,candidates.*,cd.*') 
				->select('ss.skillname, cityname')
				->select('a.accountname')
                ->from('candidates')
                ->join('request_resumes','request_resumes.can_id = candidates.can_id AND request_resumes.company_id = "'.$logged_in .'"','left')
                ->join('accounts as a','a.accountid = candidates.can_account_id','left')
                ->join('skills as ss','ss.skillid = candidates.can_maj_skill','left')
                ->join('candidate_details as cd', 'cd.candidate_id = candidates.can_id','left')
                ->join ('cities as city', 'city.cityid = cd.can_cur_city','left')
				->order_by('is_can_placed,can_created_date,can_created_time')
                ->group_by('candidates.can_id');
            $this->db->where('can_account_id', $accountId);
            $query = $this->db->get();
             $list = $query->result();
			 //echo '<pre>';
			 //print_r($list); echo '</pre>';
            return $list = $query->result();
			
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function candidate($candidateId) {
        try {
            $this->db->select('*')
                ->from('candidates')
                ->join('skills as ss','ss.skillid = candidates.can_maj_skill','left')
                ->join('candidate_details as cd', 'cd.candidate_id = candidates.can_id','left')
                ->join ('cities as city', 'city.cityid = cd.can_cur_city','left')
                ->group_by('candidates.can_id');
            $this->db->where('can_id', $candidateId);
            $query = $this->db->get();
            $list = $query->result();
            //print'<pre>';print_r($list);
            //echo $this->db->last_query();
            return  $list;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
	public function changePlaced($val,$canID) {
        try {
			$data = array(
               'is_can_placed' => $val
            );
			$this->db->where('can_id', $canID);
			$this->db->update('candidates', $data); 			
            return  true;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
	public function updaterequestresume($val,$canID) {
        try {
			$data = array(
               'request_status' => $val
            );
			$this->db->where('can_id', $canID);
			$this->db->update('request_resumes', $data); 			
            return  true;
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

}