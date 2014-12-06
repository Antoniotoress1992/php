<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
    }
    
    public function lists() {
        
        $this->load->model('gift_model');
        $gifts = $this->gift_model->lists();
        for ($i = 0; $i < count($gifts); $i++) {
            $gifts[$i]->thumb = HTTP_GIFT_PATH.$gifts[$i]->thumb;
        }
        $result =  ['result' => 'success', 'msg' => '', 'gifts' => $gifts, ];
        die(json_encode($result));
    }
}
