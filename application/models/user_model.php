<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function signup($name, $password, $email, $phone, $country_id = 1) {
	    $this->load->model('common_model');
	    
	    $salt = $this->common_model->generateSalt(16);
	    $secure_key = md5($salt.$password);
	    $phone = $this->common_model->phoneNo($phone);
	    
	    $sql = "INSERT INTO bg_users(name, email, phone, country_id, secure_key, salt, is_active, created_at, updated_at)
	             VALUE (?, ?, ?, ?, ?, ?, TRUE, NOW(), NOW())";
	    
	    $this->db->query($sql, array($name, $email, $phone, $country_id, $secure_key, $salt));
	    return ['result' => 'success', 'msg' => ''];
	}
	
	public function signin($phone1, $password) {
	    $this->load->model('common_model');
	    $phone = $this->common_model->phoneNo($phone1);
	    $sql = "SELECT *
	              FROM bg_users
	             WHERE phone = ?
	               AND secure_key = md5(concat( salt, ?))";
	    
	    $result = $this->db->query($sql, array($phone, $password))->result();
	    if (!$result) {
	        $result = ['result' => 'failed', 'msg' => 'Invalid username and password', ];
	    } else {
	        if ($result[0]->is_active) {
	            $result = ['result' => 'success', 'msg' => '', 'user_id' => $result[0]->id, 'name' => $result[0]->name,
	                       'email' => $result[0]->email, 'phone' => $result[0]->phone, 'country_id' => $result[0]->country_id, ];
	        } else {
	            $result = ['result' => 'failed', 'msg' => 'This account is not actived yet', ];
	        }
	    }
	    return $result;
	}
	
	public function generate_password($phone, $country_id, $company_id = 0) {
	    $this->load->model('common_model');
	    $phone = $this->common_model->phoneNo($phone);
	    
	    $sql = "SELECT *
	              FROM bg_users
	             WHERE phone = ?";
	    $result = $this->db->query($sql, $phone)->result();
	    
	    $password = $this->common_model->generateSalt(5, TRUE);
	    $salt = $this->common_model->generateSalt(16);
	    $secure_key = md5($salt.$password);	    
	    
	    if ($result) {	        
	        $sql = "UPDATE bg_users
	                   SET secure_key = ?
	                     , salt = ?
	                 WHERE id = ?";
	        $this->db->query($sql, array($secure_key, $salt, $result[0]->id));	        
	        
	    } else {
    	    $sql = "INSERT INTO bg_users(name, email, phone, company_id, country_id, secure_key, salt, is_active, created_at, updated_at)
    	             VALUE ('', '', ?, ?, ?, ?, ?, TRUE, NOW(), NOW())";
    	    $this->db->query($sql, array($phone, $company_id, $country_id, $secure_key, $salt));
	    }
	    return ['result' => 'success', 'msg' => 'Check your phone to get Password', 'password' => $password, ];
	}
	
	public function detail($id) {
	    $sql = "SELECT *
	              FROM bg_users
	             WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return;
	    }
	}
	
	public function update($user_id, $name, $password, $email, $phone, $country_id = 1) {
	    $this->load->model('common_model');

	    if ($password == '') {
	        $user = $this->detail($user_id);
	        $salt = $user->salt;
	        $secure_key = $user->secure_key;
	    } else {
	        $salt = $this->common_model->generateSalt(16);
	        $secure_key = md5($salt.$password);	        
	    }

	    $phone = $this->common_model->phoneNo($phone);
	     
	    $sql = "UPDATE bg_users
	               SET name = ?
	                 , email = ?
	                 , phone = ?
	                 , country_id = ?
	                 , secure_key = ?
	                 , salt = ?
	                 , updated_at = NOW()
	             WHERE id = ?";
	    $this->db->query($sql, array($name, $email, $phone, $country_id, $secure_key, $salt, $user_id));
	}
	
	public function lists() {
	    $sql = "SELECT t1.*, t2.name as country_name
	              FROM bg_users t1, bg_countries t2
	             WHERE t1.country_id = t2.id";
	    return $this->db->query($sql)->result();
	}
	
	public function count() {
	    $sql = "SELECT COUNT(*) as cnt
	              FROM bg_users";
	    $result = $this->db->query($sql)->result();
	    return $result[0]->cnt;
	}	
}
