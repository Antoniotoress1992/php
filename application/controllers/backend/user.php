<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect("backend/admin");
        }        
    }
    
    public function index() {
        $this->load->model('user_model');
        $param['pageNo'] = 52;
        $param['users'] = $this->user_model->lists();
        $this->load->view('backend/user/vwList', $param);
    }
    
    public function detail($id) {
        $this->load->model('user_model');
        $this->load->model('country_model');
        $param['pageNo'] = 52;
        
        $param['user'] = $this->user_model->detail($id);
        $param['countries'] = $this->country_model->lists();
        $this->load->view('backend/user/vwEdit', $param);
    }

    public function save() {
        $this->load->model('user_model');
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $country_id = isset($_POST['country_id']) ? $_POST['country_id'] : 1;
        $id = isset($_POST['user_id']) ? $_POST['user_id'] : 1;
        $result = $this->user_model->update($id, $name, $password, $email, $phone, $country_id);
        redirect('backend/user');
    }    
}
