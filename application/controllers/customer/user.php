<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function signup() {
        $this->load->model('user_model');
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Phone', 'required');
        $this->form_validation->set_rules('phone', 'Email', 'required');
        
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('customer/user/vwSignUp');
        } else {
            $result = $this->user_model->signup($username, $password, $email, $phone);
            $this->load->view('customer/user/vwSignIn', $result);
        }        
    }

    public function signin() {
        $this->load->model('user_model');
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('customer/user/vwSignIn');
        } else {
            $result = $this->user_model->signin($username, $password);
            if ($result['result'] == 'success') {
                
                $this->session->set_userdata([ 'user_id' => $result['user_id'],
                                               'username' => $username,
                                               'email' => $result['email'],
                                               'phone' => $result['phone'], ] );
                
                redirect('home');
            } else {
                $this->load->view('customer/user/vwSignIn', $result);
            }
            
        }
    }
    
    public function signout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('phone');
        $this->session->sess_destroy();
        
        $this->load->helper('cookie');
        delete_cookie('ut');
        // setcookie('ut', "", time() - 3600);
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }
}
