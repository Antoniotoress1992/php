<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function index() {
        $this->load->model('gift_model');
        $param['pageNo'] = 55;
        $param['gifts'] = $this->gift_model->lists();
        $this->load->view('backend/gift/vwList', $param);
    }
    
    public function history() {
        $this->load->model('gift_buy_model');
        $param['pageNo'] = 56;
        $param['histories'] = $this->gift_buy_model->history();
        $this->load->view('backend/gift/vwHistory', $param);
    }
}
