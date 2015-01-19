<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {                
        $param['pageNo'] = 4;
        $this->load->view('customer/dashboard/vwIndex', $param);
    }
}
