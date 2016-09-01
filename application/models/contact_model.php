<?php
class Contact_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getAll() {
	    $sql = "SELECT *
	              FROM bg_contacts";
	    return $this->db->query($sql)->result();
	}
	
	
}
