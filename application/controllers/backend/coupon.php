<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function history() {
        $this->load->model('coupon_code_model');
        $param['pageNo'] = 57;
        $param['histories'] = $this->coupon_code_model->history();
        $this->load->view('backend/coupon/vwHistory', $param);
    }
    
}
