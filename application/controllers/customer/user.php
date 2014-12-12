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
        $country_id = isset($_POST['country_id']) ? $_POST['country_id'] : 1;
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->model('country_model');
            $param['countries'] = $this->country_model->lists();
            $this->load->view('customer/user/vwSignUp', $param);
        } else {
            $result = $this->user_model->signup($username, $password, $email, $phone, $country_id);
            $this->load->view('customer/user/vwSignIn', $result);
        }        
    }

    public function signin() {
        $this->load->model('user_model');
        
        $this->form_validation->set_rules('phone', 'Phone No', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('customer/user/vwSignIn');
        } else {
            $result = $this->user_model->signin($phone, $password);
            if ($result['result'] == 'success') {
                
                $this->session->set_userdata([ 'user_id' => $result['user_id'],
                                               'username' => $result['name'],
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
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }
    
    public function async_generate_password() {
        $this->load->model('user_model');
        $this->load->model('common_model');
        $this->load->model('country_model');
        
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $country_id = isset($_POST['country_id']) ? $_POST['country_id'] : '';
        
        if (!($company_id = $this->session->userdata('business_id'))) {
            $company_id = 0;
        }
        
        if ($phone == '' || $country_id == '') {
            die(json_encode(['result' => 'failed', 'msg' => 'Invalid request', ]));
        }
        $result = $this->user_model->generate_password($phone, $country_id, $company_id);
        
        if ($result['result'] == 'success') {
            $country = $this->country_model->detail($country_id);
            $this->common_model->sendSMS(SITE_NAME, $country->prefix.$this->common_model->phoneNo($phone), 'Your Password : '.$result['password']);
        }
        die(json_encode($result));
    }
    
    public function profile() {
        $this->load->model('user_model');
        $this->load->model('country_model');
        $param['pageNo'] = 3;
        
        
        $user_id = $this->session->userdata('user_id');
        
        $param['user'] = $this->user_model->detail($user_id);
        $param['countries'] = $this->country_model->lists();
        $this->load->view('customer/user/vwProfile', $param);
    }
    
    public function save() {
        $this->load->model('user_model');
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $country_id = isset($_POST['country_id']) ? $_POST['country_id'] : 1;
        $user_id = $this->session->userdata('user_id');
        $result = $this->user_model->update($user_id, $name, $password, $email, $phone, $country_id);
        
        redirect('customer/user/profile');
    }
}
