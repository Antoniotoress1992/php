<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function how_it_works() {
        $param['pageNo'] = 1;
        $this->load->view('page/vwHowItWorks', $param);
    }
}
