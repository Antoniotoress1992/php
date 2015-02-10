<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function lists() {
        $param['pageNo'] = 5;
        $this->load->model('contact_model');
        
        $user_id = $this->session->userdata('user_id');
        $param['contacts'] = $this->contact_model->all($user_id);
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        
        
        $this->load->view('customer/contact/vwList', $param);        
    }
    
    public function add() {
        $this->load->model('contact_model');
        $param['pageNo'] = 5;
        $this->load->view('customer/contact/vwAdd', $param);        
    }
    
    public function edit($id) {
        $this->load->model('contact_model');
        $param['pageNo'] = 5;
        $param['contact'] = $this->contact_model->edit($id);
        $this->load->view('customer/contact/vwEdit', $param);
    }    
    
    public function delete($id) {
        $this->load->model('contact_model');
        $this->contact_model->delete($id);
        
        $alert['msg'] = 'Contact has been deleted successfully';
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
                
        redirect('customer/contact/lists');
    }
    
    public function save() {
        $this->load->model('contact_model');
        
        $contact_id = isset($_POST['contact_id']) ? $_POST['contact_id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $user_id = $this->session->userdata('user_id');
        
        $this->contact_model->save($user_id, $contact_id, $name, $phone);
        
        if ($contact_id == '') {
            $alert['msg'] = 'Contact has been added successfully';
        } else {
            $alert['msg'] = 'Contact has been updated successfully';
        }
        
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
        
        redirect('customer/contact/lists');
        
    }
}
