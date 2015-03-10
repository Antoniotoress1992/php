<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
    }
    
    public function signup() {
        
        $this->load->model('user_model');
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        
        if ($name == '' || $password == '' || $email == '' || $password == '') {
            $result =  ['result' => 'failed', 'msg' => 'Please enter forms correctly', ];
        } else {
            $result = $this->user_model->signup($name, $password, $email, $phone);
        }
        
        die(json_encode($result));
    }
    
    public function signin() {
    
        $this->load->model('user_model');
    
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        $result = $this->user_model->signin($phone, $password);
    
        die(json_encode($result));
    }
    
    public function detail() {
        $this->load->model('user_model');
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $result = $this->user_model->detail($user_id);
        
        $res = ['name' => $result->name,
                'email' => $result->email,
                'phone' => $result->phone,
                'country_id' => $result->country_id,
                'result' => 'success',
                'msg' => ''];
        die(json_encode($res));
        
    }

    public function update() {
        $this->load->model('user_model');
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $country_id = isset($_POST['country_id']) ? $_POST['country_id'] : '';
        
        $this->user_model->update($user_id, $name, $password, $email, $phone, $country_id);
        $res = ['result' => 'success',
                'msg' => ''];
        die(json_encode($res));
    }    
    
}
