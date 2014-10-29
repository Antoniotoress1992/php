<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function save() {
	    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
	    $username = isset($_POST['username']) ? $_POST['username'] : '';
	    $password = isset($_POST['password']) ? $_POST['password'] : '';
	    $address = isset($_POST['address']) ? $_POST['address'] : '';
	    $email = isset($_POST['email']) ? $_POST['email'] : '';
	    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
	    $description = isset($_POST['description']) ? $_POST['description'] : '';
	    $country = isset($_POST['country']) ? $_POST['country'] : '';
	    $city = isset($_POST['city']) ? $_POST['city'] : '';
	    $vat_id = isset($_POST['vat_id']) ? $_POST['vat_id'] : '';
	    $is_business = isset($_POST['is_business']) ? $_POST['is_business'] : FALSE;
	    $is_admin = isset($_POST['is_admin']) ? $_POST['is_admin'] : FALSE;
	    $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : FALSE;
	    
	    $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : '';
	    if ($user_id == '') {
	        $salt = $this->common_model->generateSalt(8);
	        $secure_key = md5($salt.$password);
	         
	        $sql = "INSERT INTO im_users(username, email, phone, address, country_id, city_id, secure_key, salt, description, vat_id, credit, created_at, updated_at)
                     VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())";
	        $this->db->query($sql, array($username, $email, $phone, $address, $country, $city, $secure_key, $salt, $description, $vat_id, FREE_CREDIT));
	        $user_id = $this->db->insert_id();
	        
	        if ($job_id != '') {
	            // if job post first, and user register ( send email noti also )
	            $sql = "UPDATE im_jobs
	                       SET user_id = ?
	                     WHERE id = ?";
	            $this->db->query($sql, array($user_id, $job_id));
	            
	            $sql = "UPDATE im_collects
	                       SET is_registered = TRUE
	                     WHERE job_id = ?";
	            $this->db->query($sql, $job_id);
	        } else {
	            // job post before, and register later, link the job & user
	            $sql = "SELECT *
	                      FROM im_collects
	                     WHERE email = ?
	                        OR phone = ?";
	            $collects = $this->db->query($sql, array($email, $phone))->result();
	            
	            foreach ($collects as $collect) {
	                $sql = "UPDATE im_jobs
	                           SET user_id = ?
	                         WHERE id = ?
	                           AND user_id = 0";
	                $this->db->query($sql, array($user_id, $collect->job_id));
	                
	                $sql = "UPDATE im_collects
	                           SET is_registered = TRUE
	                         WHERE id = ?";
	                $this->db->query($sql, $collect->id);
	            }
	        }
	        
	        return ['salt' => $salt, 'secure_key' => $secure_key, 'id' => $user_id, ];
	    } else {
	        // Admin Update the User Info
	        if ($password == '') {
	            $user = $this->detail($user_id);
	            $salt = $user->salt;
	            $secure_key = $user->secure_key;
	        } else {
	            $salt = $this->common_model->generateSalt(8);
	            $secure_key = md5($salt.$password);
	        }
	        
	        $sql = "UPDATE im_users
	                   SET username = ?
	                     , email = ?
	                     , phone = ?
	                     , address = ?
	                     , country_id = ?
	                     , city_id = ?
	                     , secure_key = ?
	                     , salt = ?
	                     , description = ?
	                     , vat_id = ?
	                     , is_business = ?
	                     , is_active = ?
	                     , is_admin = ?
	                     , updated_at = NOW()
	                 WHERE id = ?";
	        $this->db->query($sql, array($username, $email, $phone, $address, $country, $city, $secure_key, $salt, $description, $vat_id, 
	                                     $is_business, $is_active, $is_admin, $user_id));
	    }
	}
	
	public function login() {
	    $email = $_POST['email'];
	    $password = $_POST['password'];

	    $sql = "SELECT *
	              FROM im_users
	             WHERE MD5(CONCAT(salt,?)) = secure_key
	               AND email = ?";
	    $result = $this->db->query($sql, array($password, $email))->result();
	    if ($result) {
	        $result = $result[0];
	        if ($result->is_active) {
	            return ['result' => 'success', 'msg' => '', 'userid' => $result->id, 'secure_key' => $result->secure_key, 'salt' => $result->salt,
	                'username' => $result->username, 'email' => $result->email, 'photo' => $result->photo, 'is_admin' => $result->is_admin, ];	            
	        } else {
	            return ['result' => 'failed', 'msg' => 'This account is not actived yet. Check your email to make it active.'];
	        }

	    } else {
	        return ['result' => 'failed', 'msg' => 'Username and Password is incorrect.'];
	    }
	}
	
	public function detail($id) {
	    $sql = "SELECT *
	              FROM im_users
	             WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    return $result[0];
	}
	
	public function update() {
	    // User update his profile
	    $userid = $this->session->userdata('userid');
	    $username = $_POST['username'];
	    $address = $_POST['address'];
	    $email = $_POST['email'];
	    $phone = $_POST['phone'];
	    $photo = $_POST['photo'];
	    $description = $_POST['description'];
	    $is_business = $_POST['is_business'];
	    $country = $_POST['country'];
	    $city = $_POST['city'];
	    $vat_id = $_POST['vat_id'];
	    
	    $this->session->set_userdata(['username' => $username]);
	    
	    $ptr_date = new DateTime();
	    if ($_FILES['imgPhoto']['name'] != '') {
	        $ext = pathinfo( $_FILES['imgPhoto']['name'] )['extension'];
	        $photo = $this->common_model->GenerateSalt(3)."_".$ptr_date->format('YmdHis').".$ext";
	        if (!move_uploaded_file($_FILES['imgPhoto']['tmp_name'], ABS_PHOTO_PATH.$photo))
	            $photo = '';	        
	    }
	    
	    $sql = "UPDATE im_users
	               SET username = ?
	                 , address = ?
	                 , country_id = ?
	                 , city_id = ?
	                 , email = ?
	                 , phone = ?
	                 , photo = ?
	                 , description = ?
	                 , vat_id = ?
	                 , is_business = ?
	             WHERE id = ?";
	    $this->db->query($sql, array($username, $address, $country, $city, $email, $phone, $photo, $description, $vat_id, $is_business, $userid));
	    
	    $sql = "DELETE FROM im_user_sub_category WHERE user_id = ?";
	    $this->db->query($sql, $userid);
	    
	    foreach ($_POST['sub_category'] as $item) {
	        $sql = "INSERT INTO im_user_sub_category(user_id, sub_category_id, created_at, updated_at)
	                 VALUE (?, ?, NOW(), NOW())";
	        $this->db->query($sql, array($userid, $item));
	    }
	}
	
	public function all() {
	    $sql = "SELECT *
	              FROM im_users";
	    return $this->db->query($sql)->result();	    
	}
	
	public function delete($id) {
	    $sql = "DELETE
	              FROM im_users
	             WHERE id = ?";
	    $this->db->query($sql, $id);
	}
	
	public function active($salt, $secure_key) {
	    
	    $sql = "UPDATE im_users
	               SET is_active = TRUE
	             WHERE salt = ?
	               AND secure_key = ?";
	    $this->db->query($sql, array($salt, $secure_key));
	    
	    $sql = "SELECT *
	              FROM im_users
	             WHERE salt = ?
	               AND secure_key = ?";
	    $result = $this->db->query($sql, array($salt, $secure_key))->result();
	    if ($result) {
	        $result = $result[0];
	        $user_id = $result->id;
	        $sql = "SELECT *
	                  FROM im_jobs
	                 WHERE user_id = ?";
	        $jobs = $this->db->query($sql, $user_id)->result();
	        foreach ($jobs as $job) {
	            $this->load->model('job_model');
	            $this->job_model->jobPostNotification($job->id);	            
	        }
	        return ['result' => 'success', 'msg' => '', 'userid' => $result->id, 'secure_key' => $result->secure_key, 'salt' => $result->salt,
	        'username' => $result->username, 'email' => $result->email, 'photo' => $result->photo, 'is_admin' => $result->is_admin, ];
	    } else {
	        return ['result' => 'failed', 'msg' => 'Username and Password is incorrect.'];
	    }	    
	}
}
