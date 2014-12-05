<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widget extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $param['pageNo'] = 14;
        
        $this->load->model('company_model');
        
        $company_id = $this->session->userdata('company_id');
        $param['company'] = $this->company_model->detail($company_id);
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        

        $this->load->view('business/widget/vwIndex', $param);
    }
}
