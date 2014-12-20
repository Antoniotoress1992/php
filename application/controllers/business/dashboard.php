<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('company_id')) {
            redirect("business/company/signin");
        }    
    }
    
    public function index() {
        $this->load->model('dashboard_model');
        
        $param['pageNo'] = 11;
        
        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
        $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
        if ($startDate == '' || $endDate == '') {
            $endDate = date('Y-m-d');
            $startDate = substr($endDate, 0, 8)."01";
        }
        $param['startDate'] = $startDate;
        $param['endDate'] = $endDate;
        
        $company_id = $this->session->userdata('company_id');
        
        $param['userList'] = $this->dashboard_model->userList($startDate, $endDate, $company_id);
        $param['projectList'] = $this->dashboard_model->projectList($startDate, $endDate, $company_id);
        $param['invitorList'] = $this->dashboard_model->invitorList($startDate, $endDate, $company_id);
        $param['moneyList'] = $this->dashboard_model->moneyList($startDate, $endDate, $company_id);
        
        $param['amountCollect'] = $this->dashboard_model->amountCollect($startDate, $endDate, $company_id);
        $param['countUser'] = $this->dashboard_model->countUser($startDate, $endDate, $company_id);
        $param['countProject'] = $this->dashboard_model->countProject($startDate, $endDate, $company_id);
        $param['countInvitor'] = $this->dashboard_model->countInvitor($startDate, $endDate, $company_id);
        
        $this->load->view('business/dashboard/vwIndex', $param);
    }
}
