<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $param['pageNo'] = 4;
        $this->load->model('project_model');
        $this->load->model('transaction_model');
        
        $user_id = $this->session->userdata('user_id');
        
        $this->load->view('customer/dashboard/vwIndex', $param);
    }
}
