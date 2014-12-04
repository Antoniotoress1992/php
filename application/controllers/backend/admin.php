<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        if ($this->session->userdata('admin_id')) {
            redirect('backend/dashboard');
        } else {
            redirect('backend/admin/signin');
        }
    }
    
    public function signin() {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if ($username == "kickgifter" && $password == "mikael90") {   
            $this->session->set_userdata([ 'admin_id' => 1 ]);
            redirect('home');
        } else {
            $alert['type'] = 'danger';
            $alert['msg'] = 'Admin name and Password is incorrect';
            $param['alert'] = $alert;
            $this->load->view('backend/admin/vwSignIn', $param);
        }
    }
    
    public function signout() {
        $this->session->unset_userdata('admin_id');
        $this->session->sess_destroy();
        
        $this->load->helper('cookie');
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }
}
