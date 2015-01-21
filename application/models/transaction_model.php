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
	
	public function paidToday($user_id) {
	    $sql = "SELECT IFNULL(SUM(t1.amount), 0) as amt
                  FROM bg_transactions t1, bg_projects as t2
                 WHERE t1.project_id = t2.id
                   AND t2.user_id = ?
                   AND DATE(t1.created_at) = DATE(NOW())";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result[0]->amt;
	}
}
