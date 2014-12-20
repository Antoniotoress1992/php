<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function history() {
        $this->load->model('bank_transfer_model');
        $param['pageNo'] = 58;
        $param['histories'] = $this->bank_transfer_model->history();
        $this->load->view('backend/bank/vwHistory', $param);
    }
    
    public function delivered($id) {
        $this->load->model('bank_transfer_model');
        $this->bank_transfer_model->deliver($id);
        redirect('backend/bank/history');        
    }
}
