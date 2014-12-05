<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('country_model');
        $param['countries'] = $this->country_model->lists();
        
        if ($post = $this->session->flashdata('post')) {
            $param['post'] = $post;
        }
        
        if ($message = $this->session->flashdata('message')) {
            $param['message'] = $message;
        }
        
        $this->load->view('customer/home/vwIndex', $param);
    }
}