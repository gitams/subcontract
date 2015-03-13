<?php

require_once 'utilities_model.php';
require_once 'company_details_model.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Request_relations_model extends utilities_model
{

    private $_error = array();
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function fetchIncomingRequests($to) {
        try {
            $this->db->select('*')
                    ->from('relation_requests as rr')
                    ->join('accounts as a', 'rr.requestfrom = a.accountid', 'left')
                    ->where(array('rr.requestto' => trim($to), 'rr.status' => '6'));
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchOutgoingRequests($from) {
        try {
            $this->db->select('*')
                    ->from('relation_requests as rr')
                    ->join('accounts as a', 'rr.requestto = a.accountid', 'left')
                    ->where(array('rr.requestfrom' => trim($from), 'rr.status' => '6'));
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchCandidatesCount($a) {
        try {
            $this->db->select('*')->from('candidates as cc')->where('(cc.can_account_id ='.$a.' and cc.can_status = 1)');
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchJobsCount($a) {
        try {
            $this->db->select('*')->from('job_posts as jp')->where('(jp.accountid = '.$a.' and jp.status = 1)');
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
	public function fetchSelfuserAppliedJobsCount($a) {
        try {
            $this->db->select('*')->from('job_apply as ja')->where('(ja.ja_applied_con_id = '.$a.' and ja.ja_status = 1)');
            return $this->db->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchVendorsCount($accountID) {
        try {
            $this->db   ->select('*')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$accountID.', "1", "0"))) as is_requested_from', false)
                        ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$accountID.', "1","0")) as is_requested_to', false)
                        ->from('accounts as a')
                        ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$accountID.'', 'left')
                        ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$accountID.'', 'left')
                        ->join('industries as i', 'a.industrytype = i.industryid')
                        ->where('a.status = 1 and a.accounttype = 2 and rr.status = 5');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function vendorLocation($accountId) {
        try {
            $this->db   ->select('l.cityid, l.stateid')
                        ->from('account_locations as al')
                        ->join('locations as l', 'l.locationid = al.locationid')
                        ->where('accountid',$accountId);
            $query = $this->db->get();
            //echo $this->db->last_query();
            //$result =  $query->result();
            //print'<pre>'; print_r($result); exit;
            return $query->result();
        } catch(Exception $ex) { echo $ex->getMessage(); exit; }
    }
    public function ymkVendorsList($city,$state,$currentAccId) {
        try {
            $this->db   ->select('a.*, locations.locationname, i.industry_name as iname')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$currentAccId.', "1", "0"))) as is_requested_from', false)
                        ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$currentAccId.', "1","0")) as is_requested_to', false)
                        ->from('accounts as a')
                        ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$currentAccId.'', 'left')
                        ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$currentAccId.'', 'left')
                        ->join('industries as i', 'a.industrytype = i.industryid')
                        ->join('account_locations', 'account_locations.accountid = a.accountid','left')
                        ->join('locations', 'locations.locationid = account_locations.locationid','left')
                        ->join('accountskills', 'accountskills.accountid = a.accountid','left')
                        ->join('skills', 'skills.skillid = accountskills.accountid','left')
                        ->where('locations.cityid = '.$city.' and locations.stateid = '.$state.' and a.accountid != '.$currentAccId.' and rr.status IS NULL')
                        ->group_by('a.accountid')
                        ->order_by('a.createddate','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function rsVendorsList($currentAccId) {
        try {
            $this->db   ->select('rr.requestfrom, rr.status AS req_status, i.industry_name')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$currentAccId.', "1", "0"))) as is_requested_from', false)
                        ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$currentAccId.', "1","0")) as is_requested_to', false)
                        ->select('a.*')
                        ->from('accounts as a')
                        ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$currentAccId.'', 'left')
                        ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$currentAccId.'', 'left')
                        ->join('industries as i', 'a.industrytype = i.industryid')
                        ->where('a.accountid != '.$currentAccId.'  and a.accountid != 1 and rr.status IS NULL')
                        ->order_by('a.createddate','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function createRelation($from, $to)
    {
        try {
            if ($this->_checkRelation($from, $to)) {
                $relation['requestfrom'] = trim($from);
                $relation['requestto'] = trim($to);
                $relation['request_sent_count'] = 1;
                $relation['last_request_date'] = date('Y-m-d');
                $relation['last_request_time'] = date('h:i:s');
                $relation['createddate'] = date('Y-m-d h:i:s');
                $this->db->insert('relation_requests', $relation);
                return $this->db->insert_id();
            } else {
                $this->_updateRelation($from, $to);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function fetchActiveConnections($accountId)
    {
        try {$this->db   ->select('rr.requestfrom, rr.status AS req_status, i.industry_name')
            ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$accountId.', "1", "0"))) as is_requested_from', false)
            ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$accountId.', "1","0")) as is_requested_to', false)
            ->select('a.*')
            ->from('accounts as a')
            ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$accountId.'', 'left')
            ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$accountId.'', 'left')
            ->join('industries as i', 'a.industrytype = i.industryid')
            ->where('a.accountid != '.$accountId.'  and a.accountid != 1 and rr.status = 5');
            $query = $this->db->get();
            return $query;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function cancelRequest($from, $to)
    {
        try {
            if (!$this->_checkRelation($from, NULL)) {
                $this->_updateRelation($from, $to, FALSE, TRUE);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function deleteRequest($from, $to)
    {
        try {
            if (!$this->_checkAccountRelation($from, NULL)) {
                $this->_updateAccountRelations($from, $to);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function approveRequest($from, $to)
    {
        try {
            if (!$this->_checkRelation(NULL, $to)) {
                $this->_updateRelation($from, $to, TRUE);
                $this->_insertAccountRelations($from, $to);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    private function _insertAccountRelations($from, $to)
    {
        try {
            $relation['requestto'] = trim($from);
            $relation['requestfrom'] = trim($to);
            $relation['request_sent_count'] = 1;
            $relation['last_request_date'] = date('Y-m-d');
            $relation['last_request_time'] = date('h-i-s');
            $relation['status'] = 5;
            $relation['createddate'] = date('Y-m-d h:i:s');
            $this->db->insert('relation_requests', $relation);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _updateAccountRelations($from, $to)
    {
        try {
            $relation['relation_from'] = trim($from);
            $relation['relation_to'] = trim($to);
            $relation['status'] = 3;
            $this->db->insert('account_relations', $relation);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _updateRelation($from, $to, $updateAccept = false, $updateReject = false)
    {
        try {
            if (!$updateAccept && !$updateReject) {
                $result = $this->_checkRelation($from, $to, true);
                $resultArray = $result->result();
                $resultObj = $resultArray[0];
                $latArray = array(
                    'request_sent_count' => ($resultObj->request_sent_count + 1),
                    'last_request_date' => date('Y-m-d'),
                    'last_request_time' => date('h:i:s')
                );
            } else if ($updateAccept) {
                $latArray = array('status' => 5);
            } else if ($updateReject) {
                $latArray = array('status' => 4);
            }
            $this->db->where('requestfrom', $from);
            $this->db->where('requestto', $to);
            $this->db->update('relation_requests', $latArray);
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _checkRelation($from = NULL, $to = NULL, $retutn = false)
    {
        try {
            $this->db->select('*')
                    ->from('relation_requests');
            if (!is_null($from)) {
                $this->db->where('requestfrom', trim($from));
            }
            if (!is_null($to)) {
                $this->db->where('requestto', trim($to));
            }
            $this->db->where('status', '6');
            $result = $this->db->get();
            if ($retutn) {
                return $result;
            }
            if ($result->num_rows() > 0) {
                return false;
            }
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    private function _checkAccountRelation($from = NULL, $to = NULL, $active = true, $retutn = false)
    {
        try {
            $this->db->select('*')
                    ->from('account_relations');
            if (!is_null($from)) {
                $this->db->where('request_from', trim($from));
            }
            if (!is_null($to)) {
                $this->db->where('request_to', trim($to));
            }
            if ($active) {
                $this->db->where('status', '5');
            } else {
                $this->db->where('status', '4');
            }
            $result = $this->db->get();
            if ($retutn) {
                return $result;
            }
            if ($result->num_rows() > 0) {
                return false;
            }
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    public function fetchLats($accountID)
    {
        try {
            //echo $accountID;
            $this->db   ->select('*')
                        ->select('if(rr.requestfrom is null, 0, (if(rr.requestfrom = '.$accountID.', "1", "0"))) as is_requested_from', false)
                        ->select('if(rr2.requestto is null, "0", if(rr2.requestfrom='.$accountID.', "1","0")) as is_requested_to', false)
                        ->select('al.accountid as aid, a.accountname as cname')
                        ->from('locations as l')
                        ->join('account_locations as al','al.locationid = l.locationid','left')
                        ->join('accounts as a','a.accountid = al.accountid','left')
                        ->join('relation_requests as rr', 'rr.requestto = a.accountid and rr.requestfrom = '.$accountID.'', 'left')
                        ->join('relation_requests as rr2', 'rr2.requestfrom = a.accountid and rr2.requestfrom = '.$accountID.'', 'left')
                        ->where('(a.status = 1 and a.accounttype = 2 and rr.status = 5) or a.accountid ='.$accountID.'')
                        ->group_by('a.accountid');
            $query = $this->db->get();
            $list = $query->result();
           //echo $this->db->last_query();
            return $list;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

}
