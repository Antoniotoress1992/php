<?php
class Transaction_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function add($project_id, $invitor_tel, $amount, $data = '') {
        $sql = "INSERT INTO bg_transactions(project_id, invitor_tel, amount, data, created_at, updated_at)
                 VALUE(?, ?, ?, ?, NOW(), NOW())";
        $this->db->query($sql, array($project_id, $invitor_tel, $amount, $data));
	}
}
