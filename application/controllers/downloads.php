<?php
if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Downloads extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedin')) {
            redirect('landing/index');
        }

    }
    public function download($can_id='')
    {
        $this->load->helper('download');
        $this->load->model("candidates_model");
        $result = $this->candidates_model->get_can_res($can_id);
        $result = $result[0];
        $file_name = $result->can_resume;
        $file_path = base_url('application/candidates_resumes/')."/".$file_name;
        //echo $file_path; exit;

        $data = file_get_contents($file_path);
        force_download($file_name, $data);
        exit;
    }
}
