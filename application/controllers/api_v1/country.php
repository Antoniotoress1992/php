<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
    }
    
    public function lists() {
        
        $this->load->model('country_model');
        $countries = $this->country_model->lists();
        $result['result'] = 'success';
        $result['msg'] = '';
        $result['countreis'] = $countries;
        die(json_encode($result));
    }
}
