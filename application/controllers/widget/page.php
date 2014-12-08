<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function error() {
        $this->load->view('widget/page/vwError');
    }
}
