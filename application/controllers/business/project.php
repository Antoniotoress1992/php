<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('company_id')) {
            redirect("business/company/signin");
        }       
    }
    
    public function index() {
        $this->load->model('project_model');
        $param['pageNo'] = 17;
        $companyId = $this->session->userdata('company_id');
        $param['projects'] = $this->project_model->allByCompanyId($companyId);
        $this->load->view('business/project/vwList', $param);
    }
    
    public function detail($id) {
        $this->load->model('project_model');
        $param['pageNo'] = 17;
    
        $param['project'] = $this->project_model->detail($id);
        $param['amount_status'] = $this->project_model->amount_status($id);
        $param['invitors'] = $this->project_model->invitors($id);
        $param['payers'] = $this->project_model->payers($id);
        $this->load->view('business/project/vwDetail', $param);
    }    
}
