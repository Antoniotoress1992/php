<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function index() {
        $this->load->model('dashboard_model');
        
        $param['pageNo'] = 51;
        
        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
        $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
        if ($startDate == '' || $endDate == '') {
            $endDate = date('Y-m-d');
            $startDate = substr($endDate, 0, 8)."01";
        }
        $param['startDate'] = $startDate;
        $param['endDate'] = $endDate;
        
        $param['userList'] = $this->dashboard_model->userList($startDate, $endDate);
        $param['projectList'] = $this->dashboard_model->projectList($startDate, $endDate);
        $param['invitorList'] = $this->dashboard_model->invitorList($startDate, $endDate);
        $param['moneyList'] = $this->dashboard_model->moneyList($startDate, $endDate);
        
        $param['amountCollect'] = $this->dashboard_model->amountCollect($startDate, $endDate);
        $param['countUser'] = $this->dashboard_model->countUser($startDate, $endDate);
        $param['countProject'] = $this->dashboard_model->countProject($startDate, $endDate);
        $param['countInvitor'] = $this->dashboard_model->countInvitor($startDate, $endDate);
        
        $this->load->view('backend/dashboard/vwIndex', $param);
    }
}
