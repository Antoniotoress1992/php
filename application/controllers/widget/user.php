<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function signin() {
        $this->load->model('user_model');
    
        $this->form_validation->set_rules('phone', 'Phone No', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
    
        if ($this->form_validation->run() == FALSE) {
            $result['pageNo'] = 92;
            $this->load->view('widget/user/vwSignIn', $result);
        } else {
            $result = $this->user_model->signin($phone, $password);
            if ($result['result'] == 'success') {
    
                $this->session->set_userdata(['wuser_id' => $result['user_id']] );
                redirect('widget/project/add');
            } else {
                $result['pageNo'] = 92;
                $this->load->view('widget/user/vwSignIn', $result);
            }
    
        }
    }

    public function signout() {
        $this->session->unset_userdata('wuser_id');
        // $this->session->sess_destroy();
    
        $this->load->helper('cookie');
    
        // $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        // $this->output->set_header("Pragma: no-cache");
        redirect('widget/project/add', 'refresh');
    }    
}
