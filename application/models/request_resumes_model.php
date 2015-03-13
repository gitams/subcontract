<?php
/**
 * Created by PhpStorm.
 * User: Yasaswi Kiran
 * Date: 11/26/2014
 * Time: 1:51 PM
 */
class Request_resumes_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function requestResume($val,$canID) 
	{
		$requestDetails = array();
        try
		{
			$requestDetails['company_id'] = $this->session->userdata('userLoginDetails')->accountid;
            $requestDetails['can_id'] = trim(addslashes($_POST['canID']));
            $requestDetails['request_date'] = date('Y-m-d h:i:s');
            $requestDetails['request_status'] = trim(addslashes($_POST['val']));
            $this->db->insert('request_resumes', $requestDetails);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

}