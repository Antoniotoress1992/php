<?php
class Contact_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	
	public function upload($user_id, $contacts) {
	    $this->load->model('common_model');
	    foreach ($contacts as $contact) {
	        $sql = "SELECT *
	                  FROM bg_contacts
	                 WHERE user_id = ?
	                   AND phone = ?";
	        $result = $this->db->query($sql, array($user_id, $this->common_model->phoneNo($contact['phone'])))->result();
	        if ($result) {
	            $sql = "UPDATE bg_contacts
	                       SET name = ?
	                     WHERE id = ?";
	            $this->db->query($sql, array($contact['name'], $result[0]->id));
	        } else {
	            $sql = "INSERT INTO bg_contacts(user_id, name, phone, created_at, updated_at)
	                     VALUE (?, ?, ?, NOW(), NOW())";
	            $this->db->query($sql, array($user_id, $contact['name'], $this->common_model->phoneNo($contact['phone'])));
	        }
	    }	    	    
	}
}
