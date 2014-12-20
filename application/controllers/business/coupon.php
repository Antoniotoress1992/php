<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('company_id')) {
            redirect("business/company/signin");
        }
    }
    
    public function history() {
        $this->load->model('coupon_code_model');
        $company_id = $this->session->userdata('company_id');
        $param['pageNo'] = 16;
        $param['histories'] = $this->coupon_code_model->history($company_id);
        $this->load->view('business/coupon/vwHistory', $param);
    }
    
}
