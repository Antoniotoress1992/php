<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function history() {
        $this->load->model('gift_buy_model');
        $param['pageNo'] = 56;
        $param['histories'] = $this->gift_buy_model->history();
        $this->load->view('backend/gift/vwHistory', $param);
    }
}
