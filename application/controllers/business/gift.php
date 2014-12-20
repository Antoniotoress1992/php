<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('company_id')) {
            redirect("business/company/signin");
        }
    }
    
    public function index() {
        $this->load->model('gift_model');
        $company_id = $this->session->userdata('company_id');
        $param['pageNo'] = 12;
        $param['gifts'] = $this->gift_model->lists($company_id);
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }
        
        $this->load->view('business/gift/vwList', $param);
    }
    
    public function add() {
        $this->load->model('gift_model');
        $param['pageNo'] = 12;
        $this->load->view('business/gift/vwAdd', $param);
    }
    
    public function edit($id) {
        $this->load->model('gift_model');
        $param['pageNo'] = 12;
        $param['gift'] = $this->gift_model->detail($id);
        $this->load->view('business/gift/vwEdit', $param);
    }
    
    public function save() {
        $this->load->model('gift_model');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $company_id = $this->session->userdata('company_id');
        if ($this->form_validation->run() == FALSE) {
            $param['pageNo'] = 12;
            if ($id == '') {
                $this->load->view('business/gift/vwAdd', $param);
            } else {
                $param['gift'] = $this->gift_model->detail($id);
                $this->load->view('business/gift/vwEdit', $param);
            }
        } else {
            if ($id == '') {
                $alert['msg'] = 'Gift has been added successfully';
            } else {
                $alert['msg'] = 'Gift has been edited successfully';
            }
            
            $this->gift_model->save($id, $company_id, $name, $price, $_FILES['thumb']);
            
            $alert['type'] = 'success';
            $this->session->set_flashdata('alert', $alert);
            redirect('business/gift');
        }
    }
    
    public function delete($id) {
        $this->load->model('gift_model');
        $this->gift_model->delete($id);
        $alert['msg'] = 'Gift has been deleted successfully';
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
        redirect('business/gift');
    }
    
    public function history() {
        $this->load->model('gift_buy_model');
        $company_id = $this->session->userdata('company_id');
        $param['pageNo'] = 15;
        $param['histories'] = $this->gift_buy_model->history($company_id);
        $this->load->view('business/gift/vwHistory', $param);
    }
    
    public function delivered($id) {
        $this->load->model('gift_buy_model');
        $param['histories'] = $this->gift_buy_model->deliver($id);
        redirect('business/gift/history');
    }
}
