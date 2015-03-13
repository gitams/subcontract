<?php require_once 'utilities_model.php';

class User_operations_model extends utilities_model
{

    private $_error = array();

    public function __construct()
    {
        parent::__construct();
    }
    public function checkUser($userName, $password)
    {
        //print($userName); print($password); exit;
        $this->db->select('*')->from('contacts as c')
            ->join('accounts as a', 'c.accountid = a.accountid and a.status = 1')
            /*->join('industries as i', 'a.industrytype = i.industryid and i.status = 1')*/
            /* ->join('account_locations as al', 'al.accountid = a.accountid and al.status = 1')
              ->join('locations as l', 'al.locationid = l.locationid and l.status = 1')
              ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1')
              ->join('states as lc', 'lc.cityid = l.cityid and lc.status = 1') */
            ->where(array('username' => $userName, 'password' => $password));
        //$query = $this->db->get();
        //$list = $query->result();
        //echo $this->db->last_query();
        //print'<pre>';print_r($list); exit;
        return $this->db->get();
    }
    public function insertSelfUser($data){
        try{
            $this->db->insert('self_candidate_details',$data);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function updateSelfUser($data,$contactId){
        try{
            $this->db->where('scd_contact_id', $contactId);
            $this->db->update('self_candidate_details',$data);
            return $this->db->insert_id();
        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function checkProfile($id) {
        try{
            $this->db->select('*')->from('self_candidate_details')->where('scd_contact_id',$id);
            $query = $this->db->get();
            return  $list = $query->result();

        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }

    public function checkProfileEmployer($id) {
        try{
            $this->db->select('*')->from('self_candidate_details as scd')->where('scd.scd_contact_id',$id);
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
    public function recentJobs(){
        try{
            $this->db->select('jp.post_id, jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate, ja.ja_applied_acc_id, ja.ja_applied_con_id, acnt.accountid as accid,jp.rate,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('job_posts as jp')
                ->join('job_apply AS ja','ja.ja_post_id = jp.post_id','left')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id and jpl.status=1', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join('locations as l', 'jpl.location_id = l.locationid and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                //->where('jp.post_id');
                ->group_by('jp.post_id')
				->order_by('jp.post_id','desc');
            $query = $this->db->get()->result();
            //print_r($query);
            return $query;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchResultByLoc($country,$state,$city){
        try{
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
                ->where('(c.countryid= '.$country.' and ls.stateid= '.$state.' and lc.cityid ='.$city.')')
                ->group_by('jp.post_id');
            $query = $this->db->get();
            $list = $query->result();
            return $list;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchResultBySkill($skill){
        try{
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
                ->where('(skills.skillid= '.$skill.')')
                ->group_by('jp.post_id');
            $query = $this->db->get();
            $list = $query->result();
            return $list;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function searchResultByEmp($company){
        try{
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
                ->where('acnt.accountname',$company)
                ->group_by('jp.post_id');
            $query = $this->db->get();
            $list = $query->result();
            return $list;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function getUserDetails($contactId){
        try{
            $this->db->select('*')->from('self_candidate_details as scd')->where('scd.scd_contact_id',$contactId);
            $query = $this->db->get();
            $list = $query->result();
            return $list;
        }catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
    public function selfUserSearchJobsResult($keyWord) {
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
    public function selfUserSearchEmpResult($keyWord) {
        try{
            //print_r($keyWord);exit;
            $str_array2 = array();
            foreach($keyWord as $k=>$key)
            {
                $str_array2[] =  'acnt.accountname like "%'.$key .'%"';
            }
            $str = array_merge($str_array2);
            $str = join(' or ', $str );
            //print_r($str);exit;
            $this->db->select('acnt.accountid,acnt.accountname,acnt.accounttype,i.industry_name,lc.cityname,ls.statename,c.countryname,acnt.createddate')
                ->from('accounts as acnt')
                ->join('account_locations as al','al.accountid = acnt.accountid')
                ->join('industries as i','i.industryid = acnt.industrytype')
                ->join('locations as l', 'l.locationid = al.locationid', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->where($str)
                ->group_by('acnt.accountid');
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

    public function selfUserSuggestJobs($contactId){
        try{
            $this->db->select('jp.post_id, jp.post_title, jp.post_description, jp.ctc_from, jp.ctc_to,
                jp.experience_from, jp.experience_to, jp.createddate, jp.rate, skl.skillname,
            c.countryname, ls.statename, lc.cityname, l.latitude, l.longitude, l.locationname, acnt.accountname')
                ->from('self_candidate_details as scd')
                ->join('skills as skl', 'skl.skillid = scd.scd_majar_skill or (skl.skillname = scd.scd_other_skill_1) or (skl.skillname = scd.scd_other_skill_2)')
                ->join('job_post_skills as jps', 'jps.skill_id = skl.skillid')
                ->join('job_posts as jp', 'jp.post_id = jps.post_id', 'left')
                ->join('job_post_locations as jpl', 'jpl.jobpost_id = jp.post_id', 'left')
                ->join('accounts as acnt', 'acnt.accountid = jp.accountid', 'left')
                ->join('locations as l', 'l.locationid = jpl.location_id and l.status = 1', 'left')
                ->join('cities as lc', 'lc.cityid = l.cityid and lc.status = 1', 'left')
                ->join('states as ls', 'ls.stateid = l.stateid and ls.status = 1', 'left')
                ->join('countries as c', 'c.countryid = l.countryid and c.status = 1', 'left')
                ->where('scd.scd_contact_id',$contactId)
                ->group_by('jp.post_id');
            $query = $this->db->get();
            $list = $query->result();
            //print'<pre>';print_r($list);
            //echo $this->db->last_query();exit;
            return $list;
        } catch (Exception $ex){
            echo $ex->getMessage();
            exit;
        }
    }
}
