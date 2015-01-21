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
        
        $param['openedProjects'] = count($this->project_model->lists($user_id, 1));
        $param['paidToday'] = $this->transaction_model->paidToday($user_id);
        $param['countCreatedWeek'] = $this->project_model->countCreatedWeek($user_id);
        $param['countExpiredWeek'] = $this->project_model->countExpiredWeek($user_id);
        
        $param['createdToday'] = $this->project_model->createdToday($user_id);
        $param['expiredToday'] = $this->project_model->expiredToday($user_id);
        
        $this->load->view('customer/dashboard/vwIndex', $param);
    }
}
