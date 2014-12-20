<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function index() {
        $this->load->model('company_model');
        $param['pageNo'] = 53;
        $param['companies'] = $this->company_model->lists();
        $this->load->view('backend/company/vwList', $param);
    }
}
