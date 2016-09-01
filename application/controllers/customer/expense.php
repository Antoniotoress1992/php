<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('item_model');
    }
    
    public function index() {
        $param['pageNo'] = 4;
       
        
        $user_id = $this->session->userdata('user_id');
        
        $this->load->view('customer/expense/vwIndex', $param);
    }
    public function detail() {
        $param['pageNo'] = 4;
        $this->load->model('project_model');
        $this->load->model('transaction_model');
        
        $user_id = $this->session->userdata('user_id');
        
        $this->load->view('customer/dashboard/vwSaleDetail', $param);
    }

    public function saveAccount(){

         $this->account_model->saveAccount();
         echo json_encode( ["success" => 'success'] );        
    }

    public function saveItem(){
        $this->item_model->saveItem();
        echo json_encode( ["success" => 'success'] );  
    }
}
