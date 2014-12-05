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
        $param['pageNo'] = 2;
    
        $this->load->view('customer/project/vwDetail', $param);
    }    
    
}
