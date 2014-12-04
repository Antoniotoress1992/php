<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function signup() {
        $this->load->model('company_model');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Phone', 'required');
        $this->form_validation->set_rules('phone', 'Email', 'required');
        
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $vat_number = isset($_POST['vat_number']) ? $_POST['vat_number'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        $bank_number = isset($_POST['bank_number']) ? $_POST['bank_number'] : '';
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('business/company/vwSignUp');
        } else {
            $result = $this->company_model->signup($name, $password, $email, $phone, $vat_number, $address, $postal_code, $bank_number);
            $this->load->view('business/company/vwSignIn', $result);
        }
    }

    public function signin() {
        $this->load->model('company_model');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('business/company/vwSignIn');
        } else {
            $result = $this->company_model->signin($name, $password);
            if ($result['result'] == 'success') {
                
                $this->session->set_userdata([ 'company_id' => $result['company_id'],
                                               'name' => $name,
                                               'email' => $result['email'],
                                               'phone' => $result['phone'], ] );
                
                redirect('home');
            } else {
                $this->load->view('business/company/vwSignIn', $result);
            }
            
        }
    }
    
    public function signout() {
        $this->session->unset_userdata('company_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('phone');
        $this->session->sess_destroy();
        
        $this->load->helper('cookie');
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }
    
    public function setting() {
        $this->load->model('company_model');
        $company_id = $this->session->userdata('company_id');
        $param['pageNo'] = 13;
        $param['company'] = $this->company_model->detail($company_id);
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        
        $this->load->view('business/company/vwSetting', $param);
    }
    
    public function update() {
        $this->load->model('company_model');
        
        $company_id = $this->session->userdata('company_id');
        
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $vat_number = isset($_POST['vat_number']) ? $_POST['vat_number'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $bank_number = isset($_POST['bank_number']) ? $_POST['bank_number'] : '';
        
        $this->company_model->update($company_id, $name, $password, $vat_number, $address, $postal_code, $phone, $email, $bank_number);
        
        $alert['msg'] = 'Company setting has been changed successfully';       
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
        
        redirect('business/company/setting');
    }
}
