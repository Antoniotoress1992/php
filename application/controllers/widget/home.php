<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index($token) {
        $this->load->model('company_model');
        
        $company = $this->company_model->detailByToken($token);
        if ($company) {
            $this->session->set_userdata(['business_id' => $company->id]);
            redirect('widget/project/add');
        } else {
            redirect('widget/page/error');
        }
    }
}
