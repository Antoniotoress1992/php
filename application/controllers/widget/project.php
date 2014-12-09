<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function lists() {
        $this->load->model('project_model');
        $user_id = $this->session->userdata('wuser_id');
        
        $param['pageNo'] = 93;
        $param['projects'] = $this->project_model->lists($user_id);
        $this->load->view('widget/project/vwList', $param);
    }
    
    public function add() {
        $this->load->model('country_model');
        $param['countries'] = $this->country_model->lists();
        
        if ($post = $this->session->flashdata('post')) {
            $param['post'] = $post;
        }
        
        if ($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        
        $param['pageNo'] = 91; 
        $this->load->view('widget/project/vwAdd', $param);
    }
    
    public function save() {
        $this->load->model('project_model');
        
        if ($this->session->userdata('wuser_id')) {
            $user_id = $this->session->userdata('wuser_id');
        } else {
            $this->load->model('user_model');
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $result = $this->user_model->signin($phone, $password);
            if ($result['result'] == 'success') {
                $user_id = $result['user_id'];
                $this->session->set_userdata(['wuser_id' => $result['user_id']]);
            } else {
                $alert['msg'] = 'Phone No and Password is incorrect';
                $alert['type'] = 'danger';
                $this->session->set_flashdata('post', $_POST);
                $this->session->set_flashdata('alert', $alert);
                redirect('widget/project/add');
            }
        }
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $receiver_tel = isset($_POST['receiver']) ? trim($_POST['receiver']) : '';
        $country_id = isset($_POST['country_id']) ? trim($_POST['country_id']) : '';
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $expired_at = isset($_POST['expired_at']) ? trim($_POST['expired_at']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';
        
        if (!($company_id = $this->session->userdata('business_id'))) {
            $company_id = 0;
        }
        
        $project_id = $this->project_model->add($user_id, $name, $receiver_tel, $company_id, $country_id, $amount, $message, $expired_at);
        
        $this->project_model->invite($project_id, $invitors);
        $this->session->set_flashdata('message', 'Project has been added successfully');
        
        $alert['msg'] = 'Project has been added successfully';
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
                
        redirect('widget/project/add');        
    }
    
    public function detail($id) {
        $this->load->model('project_model');
        
        $param['project'] = $this->project_model->detail($id);
        $param['invitors'] = $this->project_model->invitors($id);
        $param['payers'] = $this->project_model->payers($id);
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['pageNo'] = 93;
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        
        $this->load->view('widget/project/vwDetail', $param);        
    }
    
    public function transfer($id) {
        $this->load->model('project_model');
        $param['pageNo'] = 93;
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['project_id'] = $id;
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        
        $this->load->view('widget/project/vwTransfer', $param);
    }
    
    public function coupon($id) {
        $this->load->model('project_model');
        $param['pageNo'] = 93;
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['project_id'] = $id;
    
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        $this->load->view('widget/project/vwCoupon', $param);
    }

    public function submit_bank() {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $bank_info = isset($_POST['bank_info']) ? $_POST['bank_info'] : '';
        $this->load->model('project_model');
        $amount_status = $this->project_model->amount_status($project_id);
    
        if ($project_id == '' || $amount == '' || $amount * 1 == 0) {
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
            redirect('widget/project/detail/'.$project_id);
        } else {
            redirect('widget/project/transfer/'.$project_id);
        }
    }
    
    public function submit_coupon() {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $is_sms = isset($_POST['is_sms']) ? TRUE : FALSE;
        $user_id = $this->session->userdata('wuser_id');
        
        $this->load->model('project_model');
        $this->load->model('common_model');
        
        $amount_status = $this->project_model->amount_status($project_id);
        
        if ($project_id == '' || $amount == '' || $amount * 1 == 0) {
            $alert['msg'] = 'Enter Amount Correctly';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);
        } elseif ($amount != $amount * 1) {
            $alert['msg'] = 'Amount should be number format';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);
        } elseif ($amount * 1 > $amount_status['avaiable'] * 1) {
            $alert['msg'] = 'Amount can not big than maximum avaiable';
            $alert['type'] = 'danger';
            $this->session->set_flashdata('alert', $alert);
        } else {
            if ($this->session->userdata('business_id')) {
                $business_id = $this->session->userdata('business_id');
                $coupon_code = $this->project_model->submit_coupon($project_id, $business_id, $amount);
                
                $business = $this->company_model->detail($business_id);
                
                if ($business->w_notification_url != '') {
                    // $this->common_model->httpPOST($business->w_notification_url, ['coupon_code' => $coupon_code, 'amount' => $amount, ]);
                }
                
                if ($is_sms) {
                    // $this->load->model('country_model');
                    // $project = $this->project_model->detail($project_id);
                    // $country = $this->country_model->detail($project->country_id);
                    // sendSMS(SITE_NAME, $country->prefix.$project->receiver_tel, "Congratulation! Coupon Code : ".$coupon_code.", Store : ".$business->w_name);
                }
                
                $alert['msg'] = "Coupon Code : <b>".$coupon_code."</b>";
                $alert['type'] = 'success';
                $this->session->set_flashdata('alert', $alert);                
            } else {
                $alert['msg'] = 'Invalid Request';
                $alert['type'] = 'danger';
                $this->session->set_flashdata('alert', $alert);                
            }
        }
        if ($alert['type'] == 'success') {
            redirect('widget/project/detail/'.$project_id);
        } else {
            redirect('widget/project/coupon/'.$project_id);
        }
    }    

}
