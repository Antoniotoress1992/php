<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $param['pageNo'] = 11;
        
        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
        $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
        if ($startDate == '' || $endDate == '') {
            $endDate = date('Y-m-d');
            $startDate = substr($endDate, 0, 8)."01";
        }
        $param['startDate'] = $startDate;
        $param['endDate'] = $endDate;
        
        $this->load->view('business/dashboard/vwIndex', $param);
    }
}
