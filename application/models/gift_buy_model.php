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
	
	public function history($company_id = 0) {
	    if ($company_id != 0) {
    	    $sql = "SELECT t2.name, t2.thumb, t2.price, t1.created_at as saled_at, t1.is_delivered, t1.id, t1.is_creator
    	                 , t3.name as project_name, t3.receiver_tel, t4.phone as creator_tel
    	              FROM bg_gift_buys t1, bg_gifts t2, bg_projects t3, bg_users t4
    	             WHERE t1.gift_id = t2.id
    	               AND t2.company_id = ?
    	               AND t1.project_id = t3.id
    	               AND t3.user_id = t4.id
    	             ORDER BY t1.created_at DESC";
    	    return $this->db->query($sql, $company_id)->result();
	    } else {
	        $sql = "SELECT t2.name, t2.thumb, t2.price, t1.created_at as saled_at, t1.is_delivered, t1.id, t1.is_creator
    	                 , t3.name as project_name, t3.receiver_tel, t4.phone as creator_tel, t5.name as company_name
    	              FROM bg_gift_buys t1, bg_gifts t2, bg_projects t3, bg_users t4, bg_companies t5
    	             WHERE t1.gift_id = t2.id
    	               AND t1.project_id = t3.id
    	               AND t3.user_id = t4.id
	                   AND t2.company_id = t5.id
    	             ORDER BY t1.created_at DESC";
	        return $this->db->query($sql)->result();	        
	    }
	}

	public function total_by_gifts($gift_ids) {
	    $sql = "SELECT SUM(price) as total
	               FROM bg_gifts
	              WHERE id IN ($gift_ids)";
	    $result = $this->db->query($sql)->result();
	    return $result[0]->total;
	}
	
	public function add($project_id, $gift_ids, $is_creator = TRUE) {
	    $arr = explode(",", $gift_ids);
	    foreach ($arr as $item) {
	        if ($item != '') {
    	        $sql = "INSERT INTO bg_gift_buys(project_id, gift_id, is_creator, is_delivered, created_at, updated_at)
    	                 VALUE (?, ?, ?, FALSE, NOW(), NOW())";
    	        $this->db->query($sql, array($project_id, $item, $is_creator));
	        }
	    }
	}
}
