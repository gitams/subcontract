<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CI Layout
 *
 *
 */
class Layout {
    public function index() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return;
        }
        $CI = & get_instance();
        $current_output = $CI->output->get_output();
        if (isset($layout) && !empty($layout)) {
            $layout_file = APPPATH . 'views/' . $layout;
        } else {
            $layout_file = APPPATH . 'views/layout.php';
        }
        $layout = $CI->load->file($layout_file, true);
        $mod_output = str_replace("{content}", $current_output, $layout);
        echo $mod_output;
    }
}