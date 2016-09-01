<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('user_model');
        $this->load->model('project_model');
        $this->load->model('contact_model');
        
         
        if ($post = $this->session->flashdata('post')) {
            $param['post'] = $post;
        }
        if ($message = $this->session->flashdata('message')) {
            $param['message'] = $message;
        }
        
        $this->load->view('customer/home/vwIndex');
    }
}
