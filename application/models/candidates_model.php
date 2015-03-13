<?php

class Candidates_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertUser($data){
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    public function get_can_res($candId){
        try
        {
            $this->db->select('can_resume')
                ->from('candidates')->where('can_id', $candId);
            $query = $this->db->get();
            $list = $query->result();
            //echo '<pre>';
            //print_r($list); echo '</pre>';
            return $list;

        } catch(Exception $ex){
            echo $ex->getMessage();
            exit;
        }

    }

}
