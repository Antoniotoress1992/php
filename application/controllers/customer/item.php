<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('item_model');
    }
    
    public function getItem(){
        $result = $this->item_model->getAll();
        die(json_encode( $result));
    }
 
}
