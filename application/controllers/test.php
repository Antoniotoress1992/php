<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('common_model');
    }

    public function index() {
        $params = array(
                        'apikey'		=> 'd5c7f1250afa164d353dee90dbf3c8b1',
                        'msisdn'        => '358452625977',
                        'price'         => '1',
        );
        $str_url = "https://api.centili.com/api/payment/1_3/transaction";
        
        $json_result = $this->common_model->httpPOST( $str_url, $params );
        $this->common_model->print_log(var_export($json_result, true));
    }
}
