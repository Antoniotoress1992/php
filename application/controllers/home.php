<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('customer/home');
        } elseif ($this->session->userdata('company_id')) {
            redirect('business/dashboard');
        } elseif ($this->session->userdata('admin_id')) { 
            redirect('backend/dashboard');
        } else {
            redirect('customer/home');
        }
    }
}
