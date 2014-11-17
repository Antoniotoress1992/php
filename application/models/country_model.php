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
	
}
