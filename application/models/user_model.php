<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function signup($name, $password, $email, $phone) {
	    $this->load->model('common_model');
	    
	    $salt = $this->common_model->generateSalt(16);
	    $secure_key = md5($salt.$password);
	    
	    $sql = "INSERT INTO bg_users(name, email, phone, secure_key, salt, is_active, created_at, updated_at)
	             VALUE (?, ?, ?, ?, ?, TRUE, NOW(), NOW())";
	    
	    $this->db->query($sql, array($name, $email, $phone, $secure_key, $salt));
	    return ['result' => 'success', 'msg' => ''];
	}
	
	public function signin($name, $password) {
	    $this->load->model('common_model');
	     
	    $sql = "SELECT *
	              FROM bg_users
	             WHERE name = ?
	               AND secure_key = md5(concat( salt, ?))";
	    
	    $result = $this->db->query($sql, array($name, $password))->result();
	    if (!$result) {
	        $result = ['result' => 'failed', 'msg' => 'Invalid username and password', ];
	    } else {
	        if ($result[0]->is_active) {
	            $result = ['result' => 'success', 'msg' => '', 'user_id' => $result[0]->id,
	                       'email' => $result[0]->email, 'phone' => $result[0]->phone,  ];
	        } else {
	            $result = ['result' => 'failed', 'msg' => 'This account is not actived yet', ];
	        }
	    }
	    return $result;
	}
}
