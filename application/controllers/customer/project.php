<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function add() {
        $this->load->model('project_model');
    
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
        } else {
            $this->load->model('user_model');
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $result = $this->user_model->signin($phone, $password);
            if ($result['result'] == 'success') {
                $user_id = $result['user_id'];
                
                $this->session->set_userdata([ 'user_id' => $result['user_id'],
                                               'username' => $result['name'],
                                               'email' => $result['email'],
                                               'phone' => $result['phone'], ] );                
            } else {
                $this->session->set_flashdata('post', $_POST);
                redirect('customer/home'); 
            }
        }
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $receiver_tel = isset($_POST['receiver']) ? trim($_POST['receiver']) : '';
        $country_id = isset($_POST['country_id']) ? trim($_POST['country_id']) : '';
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $expired_at = isset($_POST['expired_at']) ? trim($_POST['expired_at']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';

        $project_id = $this->project_model->add($user_id, $name, $receiver_tel, $country_id, $amount, $message, $expired_at);
        
        $this->project_model->invite($project_id, $invitors);
        $this->session->set_flashdata('message', 'Project has been added successfully');
        redirect('customer/home');
    }
    
    public function lists() {
        $this->load->model('project_model');
        
        $user_id = $this->session->userdata('user_id');
        
        $param['projects'] = $this->project_model->lists($user_id);
        $param['pageNo'] = 2;
        
        $this->load->view('customer/project/vwList', $param);
    }
    
    public function detail($id) {
        $this->load->model('project_model');

        $param['project'] = $this->project_model->detail($id);
        $param['invitors'] = $this->project_model->invitors($id);
        $param['payers'] = $this->project_model->payers($id);
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['pageNo'] = 2;
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        
    
        $this->load->view('customer/project/vwDetail', $param);
    }    
    
    public function shop($id) {
        $this->load->model('project_model');
        $this->load->model('gift_model');
        $param['pageNo'] = 2;
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['project_id'] = $id;
        
        $param['gifts'] = $this->gift_model->lists();

        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        
        $this->load->view('customer/project/vwShop', $param);
    }
    
    public function transfer($id) {
        $this->load->model('project_model');
        $param['pageNo'] = 2;
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['project_id'] = $id;
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        $this->load->view('customer/project/vwTransfer', $param);
    }
    
    public function submit_bank() {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $bank_info = isset($_POST['bank_info']) ? $_POST['bank_info'] : '';
        $this->load->model('project_model');
        $amount_status = $this->project_model->amount_status($project_id);
        
        if ($project_id == '' || $amount == '') {
            $alert['msg'] = 'Enter Amount Correctly';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);
        } elseif($bank_info == '') {
            $alert['msg'] = 'Enter Bank Info Correctly';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);
        }elseif ($amount != $amount * 1) {
            $alert['msg'] = 'Amount should be number format';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);            
        } elseif ($amount * 1 > $amount_status['avaiable'] * 1) {
            $alert['msg'] = 'Amount can not big than maximum avaiable';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);            
        } else {
            $this->project_model->submit_bank($project_id, $amount, $bank_info);
            $alert['msg'] = 'Successfully submited';
            $alert['type'] = 'success';
            $this->session->set_flashdata('alert', $alert);
        }
        if ($alert['type'] == 'success') {
            redirect('customer/project/detail/'.$project_id);
        } else {
            redirect('customer/project/transfer/'.$project_id);
        }
    }
    
    public function submit_gift() {
        $this->load->model('project_model');
        $this->load->model('gift_buy_model');
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $gift_ids = isset($_POST['gift_ids']) ? $_POST['gift_ids'] : '';
        
        if ($project_id == '' || $gift_ids == '') {
            $alert['msg'] = 'Invalid Request';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);            
        }
        
        $total = $this->gift_buy_model->total_by_gifts($project_id);
        $amount_status = $this->project_model->amount_status($project_id);
        
        if ($total * 1 > $amount_status['avaiable'] * 1 ) {
            $alert['msg'] = 'Too many gifts than avaiable amount';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);            
        } else {
            $this->gift_buy_model->add($project_id, $gift_ids);
            $alert['msg'] = 'You have been purchase the gift successfully';
            $alert['type'] = 'success';
            $this->session->set_flashdata('alert', $alert);
        }
        
        if ($alert['type'] == 'success') {
            redirect('customer/project/detail/'.$project_id);
        } else {
            redirect('customer/project/shop/'.$project_id);
        }        
    }
}
