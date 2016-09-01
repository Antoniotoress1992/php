<?php
class Currency_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getAll() {
	    
	    $sql = "select * from bg_currency";
	    
	    $result = $this->db->query($sql)->result();
	    return $result;
	}
	

	
}
