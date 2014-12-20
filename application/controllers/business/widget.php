<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widget extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('company_id')) {
            redirect("business/company/signin");
        }        
    }
    
    public function index() {
        $param['pageNo'] = 14;
        
        $this->load->model('company_model');
        
        $company_id = $this->session->userdata('company_id');
        $param['company'] = $this->company_model->detail($company_id);
        
        if($alert = $this->session->flashdata('alert')) {
            $param['alert'] = $alert;
        }        

        $this->load->view('business/widget/vwIndex', $param);
    }
    
    public function update() {
        $this->load->model('company_model');
        $company_id = $this->session->userdata('company_id');
    
        $name = isset($_POST['w_name']) ? $_POST['w_name'] : '';
        $width = isset($_POST['w_width']) ? $_POST['w_width'] : '';
        $height = isset($_POST['w_height']) ? $_POST['w_height'] : '';
        $color = isset($_POST['w_color']) ? $_POST['w_color'] : '';
        $background = isset($_POST['w_background']) ? $_POST['w_background'] : '';
        $notification_url = isset($_POST['w_notification_url']) ? $_POST['w_notification_url'] : '';
        $logo = $_FILES['w_logo'];
        
        $this->company_model->update_widget($company_id, $name, $width, $height, $color, $background, $notification_url, $logo);
    
        $alert['msg'] = 'Company Widget has been changed successfully';
        $alert['type'] = 'success';
        $this->session->set_flashdata('alert', $alert);
    
        redirect('business/widget');
    }    
}
