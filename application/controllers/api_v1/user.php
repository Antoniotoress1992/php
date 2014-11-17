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
    
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        $result = $this->user_model->signin($name, $password);
    
        die(json_encode($result));
    }    
}