<?php
class Tax_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getAllTax() {
	    $sql = "select * from bg_tax";
	    $result = $this->db->query($sql)->result();
	    return $result;
	}
}
