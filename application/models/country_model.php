<?php
class Country_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function lists() {
	    $sql = "SELECT *
	              FROM bg_countries";
	    return $this->db->query($sql)->result();
	}
	
	public function detail($id) {
	    $sql = "SELECT *
	              FROM bg_countries
	             WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return;
	    }
	    
	}	
	
}
