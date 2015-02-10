<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('country_model');
        $this->load->model('gift_model');
        $this->load->model('user_model');
        $this->load->model('project_model');
        $this->load->model('contact_model');
        
        $param['countries'] = $this->country_model->lists();
        
        if ($post = $this->session->flashdata('post')) {
            $param['post'] = $post;
        }
        
        if ($message = $this->session->flashdata('message')) {
            $param['message'] = $message;
        }
        
        $param['count'] = ['gift'    => $this->gift_model->count(), 
                           'user'    => $this->user_model->count(),
                           'project' => $this->project_model->count(), ];
        
        if ($this->session->userdata('user_id')) {
            $param['contacts'] = $this->contact_model->all($this->session->userdata('user_id'));
        } else {
            $param['contacts'] = array();
        }
        
        $this->load->view('customer/home/vwIndex', $param);
    }
}
