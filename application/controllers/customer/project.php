<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function add() {
        $this->load->model('project_model');
    
        $user_id = $this->session->userdata('user_id');
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $receiver_tel = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $country_id = isset($_POST['country_id']) ? trim($_POST['country_id']) : '';
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        $expired_at = isset($_POST['expired_at']) ? trim($_POST['expired_at']) : '';
        $invitors = isset($_POST['invitors']) ? trim($_POST['invitors']) : '';

        $project_id = $this->project_model->add($user_id, $name, $receiver_tel, $country_id, $amount, $message, $expired_at);
        
        $this->project_model->invite($project_id, $invitors);
        
        redirect('customer/home');
    }
    
    public function lists() {
        $this->load->model('project_model');
        
        $user_id = $this->session->userdata('user_id');
        
        $param['projects'] = $this->project_model->lists($user_id);
        
        $this->load->view('customer/project/vwList', $param);
    }
    
    public function detail($id) {
        $this->load->model('project_model');

        $param['project'] = $this->project_model->detail($id);
    
        $this->load->view('customer/project/vwDetail', $param);
    }    
    
}
