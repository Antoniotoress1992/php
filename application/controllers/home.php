<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('customer/home');
        } elseif ($this->session->userdata('company_id')) {
            redirect('business/dashboard');
        } elseif ($this->session->userdata('admin_id')) { 
            $this->load->view('admin/home/vwIndex');
        } else {
            redirect('customer/home');
        }
    }
    
    public function payment() {
        $this->load->view('vwPayment');
    }
}
