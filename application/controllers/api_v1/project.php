<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
    }
    
    public function add() {
        
        $this->load->model('project_model');
        
        $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $receiver_tel = isset($_POST['receiver_tel']) ? trim($_POST['receiver_tel']) : '';
        $country_id = isset($_POST['country_id']) ? trim($_POST['country_id']) : '';
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $expired_at = isset($_POST['expired_at']) ? trim($_POST['expired_at']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';
        
        if ($name == '' || $user_id == '' || $receiver_tel == '' || $country_id == '' || $amount == '' || $message == '' || $expired_at == '') {
            $result =  ['result' => 'failed', 'msg' => 'Please enter forms correctly', ];
        } else {
            $project_id = $this->project_model->add($user_id, $name, $receiver_tel, 0, $country_id, $amount, $message, $expired_at);
            $result = $this->inviting($project_id, $invitors);
        }
        
        die(json_encode($result));
    }
    
    public function invite() {
        $project_id = isset($_POST['project_id']) ? trim($_POST['project_id']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';
        
        if ($project_id == '' || $invitors == '') {
            $result =  ['result' => 'failed', 'msg' => 'Please enter forms correctly', ];
        } else {
            $result = $this->inviting($project_id, $invitors);
        }
        
        die(json_encode($result));
    }
    
    public function inviting($project_id, $invitors) {
        $this->load->model('project_model');
        return $this->project_model->invite($project_id, $invitors);
    }
    
    public function lists() {
        $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
        $type = isset($_POST['type']) ? trim($_POST['type']) : 0;
        $this->load->model('project_model');
        
        if ($user_id == '') {
            $result =  ['result' => 'failed', 'msg' => 'Please enter forms correctly', ];
        } else {
            $projects = $this->project_model->lists($user_id, $type);
            if ($projects) {
                $result['result'] = 'success';
                $result['msg'] = '';
                $result['projects'] = $projects;
            } else {
                $result['result'] = 'success';
                $result['msg'] = '';
                $result['projects'] = array();                
            }
        }
        die(json_encode($result));
    }
    
    public function detail() {
        $project_id = isset($_POST['project_id']) ? trim($_POST['project_id']) : '';
        
        $this->load->model('project_model');
        
        $result = $this->project_model->detail($project_id);
        $result = json_decode(json_encode($result), true);
        $result['invitors'] = $this->project_model->invitors($project_id);
        $result['payers'] = $this->project_model->payers($project_id);
        $result['amount_status'] = $this->project_model->amount_status($project_id);
        die(json_encode($result));
    }
    
    public function invitors() {
        $project_id = isset($_POST['project_id']) ? trim($_POST['project_id']) : '';
        
        $this->load->model('project_model');
        
        $result = $this->project_model->invitors($project_id);
        die(json_encode($result));
    }
    
    public function submit_bank() {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $bank_info = isset($_POST['bank_info']) ? $_POST['bank_info'] : '';
        $this->load->model('project_model');
        $amount_status = $this->project_model->amount_status($project_id);
    
        if ($project_id == '' || $amount == '' || $amount * 1 == 0) {
            $result['msg'] = "Enter Amount Correctly";
            $result['result'] = "failed";
        } elseif($bank_info == '') {
            $result['msg'] = "Enter Bank Info Correctly";
            $result['result'] = "failed";
        }elseif ($amount != $amount * 1) {
            $result['msg'] = "Amount should be number format";
            $result['result'] = "failed";
        } elseif ($amount * 1 > $amount_status['avaiable'] * 1) {
            $result['msg'] = "Amount can not big than maximum avaiable";
            $result['result'] = "failed";
        } else {
            $result['msg'] = "Successfully submited";
            $result['result'] = "success";
        }
        
        die(json_encode($result));
    }
    
    public function submit_gift() {
        $this->load->model('project_model');
        $this->load->model('gift_buy_model');
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $gift_ids = isset($_POST['gift_ids']) ? $_POST['gift_ids'] : '';
        $is_creator = isset($_POST['is_creator']) ? $_POST['is_creator'] : TRUE;
    
        if ($project_id == '' || $gift_ids == '') {
            $result['msg'] = "Invalid Request";
            $result['result'] = "failed";
        }
    
        $total = $this->gift_buy_model->total_by_gifts($project_id);
        $amount_status = $this->project_model->amount_status($project_id);
    
        if ($total * 1 > $amount_status['avaiable'] * 1 ) {
            $result['msg'] = "Too many gifts than avaiable amount";
            $result['result'] = "failed";            
        } else {
            $this->gift_buy_model->add($project_id, $gift_ids, $is_creator);
            $result['msg'] = "You have been purchase the gift successfully";
            $result['result'] = "success";
        }
    
        die(json_encode($result));
    }

    public function choose_gift() {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        if ($project_id == '') {
            die(json_encode(['result' => 'failed', 'msg' => 'Invalid request', ]));
        } else {
            $this->load->model('project_model');
            $this->load->model('common_model');
            $this->load->model('country_model');
            $project = $this->project_model->detail($project_id);
            $country = $this->country_model->detail($project->country_id);
            $this->common_model->sendSMS(SITE_NAME, $country->prefix.$this->common_model->phoneNo($project->receiver_tel), 'Visit this link and choose the gift on there. http://'.HOST_SERVER.'/gift/choose/'.$project->token);
            die(json_encode(['result' => 'success', 'msg' => 'SMS has been sent successfully', ]));
        }
    }    
}
