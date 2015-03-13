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
        try
		{
			$data = array(
               'is_can_placed' => $val
            );
			$this->db->where('can_id', $canID);
			$this->db->update('candidates', $data); 			
            return  true;
        } 
		catch(Exception $ex)
		{
            echo $ex->getMessage();
            exit;
        }
    }

}