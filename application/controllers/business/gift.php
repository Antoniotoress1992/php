<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $param['pageNo'] = 12;
        $this->load->view('business/gift/vwList', $param);
    }    
}
