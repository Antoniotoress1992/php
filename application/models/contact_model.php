<?php
class Contact_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function all($user_id) {
	    $sql = "SELECT *
	              FROM bg_contacts
	             WHERE user_id = ?";
	    return $this->db->query($sql, $user_id)->result();
	}
	
	public function upload($user_id, $contacts) {
	    $this->load->model('common_model');
	    $contacts = json_decode($contacts, true);
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
	
	public function edit($id) {
	    $sql = "SELECT *
	              FROM bg_contacts
	             WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    return $result[0];
	}	
	
	public function delete($id) {
	    $sql = "DELETE
	              FROM bg_contacts
	             WHERE id = ?";
	    $this->db->query($sql, $id);
	}
	
	public function save($user_id, $contact_id, $name, $phone) {
	    $this->load->model('common_model');

        if ($contact_id != '') {
            $sql = "UPDATE bg_contacts
                       SET name = ?
                         , phone = ?   
                     WHERE id = ?";
            $this->db->query($sql, array($name, $phone, $contact_id));
        } else {
            $sql = "INSERT INTO bg_contacts(user_id, name, phone, created_at, updated_at)
                     VALUE (?, ?, ?, NOW(), NOW())";
            $this->db->query($sql, array($user_id, $name, $phone));
        }
	}	
}
