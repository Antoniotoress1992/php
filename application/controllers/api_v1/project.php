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
        $receiver_tel = isset($_POST['receiver_tel']) ? trim($_POST['receiver_tel']) : '';
        $country_id = isset($_POST['country_id']) ? trim($_POST['country_id']) : '';
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $expired_at = isset($_POST['expired_at']) ? trim($_POST['expired_at']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';
        
        if ($user_id == '' || $receiver_tel == '' || $country_id == '' || $amount == '' || $message == '' || $expired_at == '') {
            $result =  ['result' => 'failed', 'msg' => 'Please enter forms correctly', ];
        } else {
            $project_id = $this->project_model->add($user_id, $receiver_tel, $country_id, $amount, $message, $expired_at);
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
        
        die(json_encode($result));
    }
    
    public function invitors() {
        $project_id = isset($_POST['project_id']) ? trim($_POST['project_id']) : '';
        
        $this->load->model('project_model');
        
        $result = $this->project_model->invitors($project_id);
        die(json_encode($result));
    }
}
