<?php
class Company_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function signup($name, $password, $email, $phone, $vat_number, $address, $postal_code, $bank_number) {
	    $this->load->model('common_model');
	    
	    $salt = $this->common_model->generateSalt(16);
	    $secure_key = md5($salt.$password);
	    
	    $sql = "INSERT INTO bg_companies(name, vat_number, address, postal_code, phone, email, bank_number, secure_key, salt, is_active, created_at, updated_at)
	             VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, TRUE, NOW(), NOW())";
	    
	    $this->db->query($sql, array($name, $vat_number, $address, $postal_code, $phone, $email, $bank_number, $secure_key, $salt));
	    return ['result' => 'success', 'msg' => ''];
	}
	
	public function signin($name, $password) {
	    $this->load->model('common_model');
	     
	    $sql = "SELECT *
	              FROM bg_companies
	             WHERE name = ?
	               AND secure_key = md5(concat( salt, ?))";
	    
	    $result = $this->db->query($sql, array($name, $password))->result();
	    if (!$result) {
	        $result = ['result' => 'failed', 'msg' => 'Invalid username and password', ];
	    } else {
	        if ($result[0]->is_active) {
	            $result = ['result' => 'success', 'msg' => '', 'company_id' => $result[0]->id,
	                       'email' => $result[0]->email, 'phone' => $result[0]->phone,  ];
	        } else {
	            $result = ['result' => 'failed', 'msg' => 'This account is not actived yet', ];
	        }
	    }
	    return $result;
	}
	
	public function detail($id) {
	    $sql = "SELECT *
	              FROM bg_companies
	             WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return;
	    }
	}
	
	public function update($company_id, $name, $password, $vat_number, $address, $postal_code, $phone, $email, $bank_number) {
	    $this->load->model('common_model');
	    if ($password == '') {
	        $company = $this->detail($company_id);
	        
	        $salt = $company->salt;
	        $secure_key = $company->secure_key;
	    } else {
	        $salt = $this->common_model->generateSalt(16);
	        $secure_key = md5($salt.$password);	        
	    }
	    
	    $sql = "UPDATE bg_companies
	               SET name = ?
	                 , vat_number = ?
	                 , address = ?
	                 , postal_code = ?
	                 , phone = ?
	                 , email = ?
	                 , bank_number = ?
	                 , salt = ?
	                 , secure_key = ?
	             WHERE id = ?";
	    $this->db->query($sql, array($name, $vat_number, $address, $postal_code, $phone, $email, $bank_number, $salt, $secure_key, $company_id));
	}
}
