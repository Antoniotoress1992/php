<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function choose($token) {
        $this->load->model('project_model');
        $this->load->model('gift_model');
        
        $project = $this->project_model->detailByToken($token);
        
        if ($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        
        if (!isset($project->id)) {
            $param['result'] = 'failed';
        } else {
            $this->session->set_userdata(['token' => $token] );            
            $param['amount_status'] = $this->project_model->amount_status($project->id);
            $param['gifts'] = $this->gift_model->lists();
            $param['result'] = 'success';
        }
        $this->load->view('gift/vwChoose', $param);
    }
    
    public function submit() {
        $this->load->model('project_model');
        $this->load->model('gift_buy_model');
        if ($this->session->userdata('token')) {
            $token = $this->session->userdata('token');
            $gift_ids = isset($_POST['gift_ids']) ? $_POST['gift_ids'] : '';
            $project = $this->project_model->detailByToken($token);
            if (!isset($project->id) || $gift_ids == '') {
                $alert['msg'] = 'Invalid Request';
                $alert['type'] = 'danger';
                $this->session->set_flashdata('alert', $alert);                
            } else {
                $project_id = $project->id;
                $total = $this->gift_buy_model->total_by_gifts($project_id);
                $amount_status = $this->project_model->amount_status($project_id);
                
                if ($total * 1 > $amount_status['avaiable'] * 1 ) {
                    $alert['msg'] = 'Too many gifts than avaiable amount';
                    $alert['type'] = 'danger';
                    $this->session->set_flashdata('alert', $alert);
                } else {
                    $this->gift_buy_model->add($project_id, $gift_ids, FALSE);
                    $alert['msg'] = 'You have been purchase the gift successfully';
                    $alert['type'] = 'success';
                    $this->session->set_flashdata('alert', $alert);
                    
                    $this->load->model('common_model');
                    $this->load->model('user_model');
                    $this->load->model('country_model');
                    $creator = $this->user_model->detail($project->user_id);
                    $country = $this->country_model->detail($project->country_id);
                    $this->common_model->sendSMS(SITE_NAME, $country->prefix.$this->common_model->phoneNo($creator->phone), 'Your friend('.$project->receiver_tel.') choose the gift successfully.');
                }
            }
            redirect('gift/choose/'.$token);
        } else {
            $alert['msg'] = 'Invalid Request';
            $alert['type'] = 'danger';      
            redirect('gift/choose/111');
        }
        
    }
}
