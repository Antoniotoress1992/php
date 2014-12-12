<?php
class Bank_transfer_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function history($company_id = 0) {
        $sql = "SELECT t1.*, t2.name as project_name, t2.receiver_tel, t3.phone as creator_tel
	              FROM bg_bank_transfers t1, bg_projects t2, bg_users t3
	             WHERE t1.project_id = t2.id
	               AND t2.user_id = t3.id
	             ORDER BY t1.created_at DESC";
        return $this->db->query($sql)->result();
	}
	
	public function deliver($id) {
	    $sql = "UPDATE bg_bank_transfers
	               SET is_delivered = !is_delivered
	                 , updated_at = NOW()
	             WHERE id = ?";
	    $this->db->query($sql, $id);
	}
}
