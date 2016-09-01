<?php
class Accounttype_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getAllAccountType() {
	   
	   	$sql = "SELECT t1.name AS categoryName , t2.name accountTypeName , t2.id AS accountTypeId
					FROM bg_accountcategory t1
					INNER JOIN bg_accounttype t2
					ON t1.id = t2.category";
	    
	    $result = $this->db->query($sql)->result();
	    return $result;
	}
	
	public function getTypes(){
		$sql = "SELECT *
					FROM bg_accountcategory";
	    
	    $result = $this->db->query($sql)->result();
	    return $result;
	}
}
