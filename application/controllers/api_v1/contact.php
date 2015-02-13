<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function upload() {
        $this->load->model('contact_model');
        $this->load->model('common_model');
        
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $contacts = isset($_POST['contacts']) ? $_POST['contacts'] : '';
        
        if ($user_id == '' || $contacts == '') {
            $result['result'] = 'failed';
            $result['msg'] = 'Invalid Request';
        } else {
            $this->contact_model->upload($user_id, $contacts);
            $result['result'] = 'success';
            $result['msg'] = '';            
        }

        die(json_encode($result));
    }
}
