<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widget extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $param['pageNo'] = 14;
        $this->load->view('business/widget/vwIndex', $param);
    }
}
