<?php
class Gift_buy_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function deliver($id) {
	    $sql = "UPDATE bg_gift_buys
	               SET is_delivered = !is_delivered
	             WHERE id = ?";
	    $this->db->query($sql, $id);
	}
	
	public function history($company_id) {
	    $sql = "SELECT t2.name, t2.thumb, t2.price, t1.created_at as saled_at, t1.is_delivered, t1.id
	                 , t3.name as project_name, t3.receiver_tel, t4.phone as creator_tel
	              FROM bg_gift_buys t1, bg_gifts t2, bg_projects t3, bg_users t4
	             WHERE t1.gift_id = t2.id
	               AND t2.company_id = ?
	               AND t1.project_id = t3.id
	               AND t3.user_id = t4.id
	             ORDER BY t1.created_at DESC";
	    return $this->db->query($sql, $company_id)->result();
	}	
}