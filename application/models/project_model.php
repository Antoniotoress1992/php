<?php
class Project_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function add($user_id, $name, $receiver_tel, $company_id, $country_id, $amount, $message, $expired_at) {
	    $this->load->model('common_model');
	    $token = $this->common_model->generateSalt(16);
	    
	    $sql = "INSERT INTO bg_projects(user_id, name, receiver_tel, company_id, country_id, amount, message, token, expired_at, created_at, updated_at)
	             VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
	    
	    $result = $this->db->query($sql, array($user_id, $name, $receiver_tel, $company_id, $country_id, $amount, $message, $token, $expired_at));
	    return $this->db->insert_id();
	}
	
	public function invite($id, $invitors) {
	    $arrInvitor = explode(",", $invitors);
	    $this->load->model('common_model');
	    $this->load->model('country_model');
        for ($i = 0; $i < count($arrInvitor); $i++) {
            $invitor_tel = $this->common_model->phoneNo($arrInvitor[$i]);
            
            if ($invitor_tel != '') {
                $sql = "INSERT INTO bg_invitors(project_id, invitor_tel, created_at, updated_at)
                         VALUE (?, ?, NOW(), NOW())";
                $this->db->query($sql, array($id, $invitor_tel));

                $project = $this->detail($id);
                $country = $this->country_model->detail($project->country_id);
                
                $this->common_model->sendSMS($project->name, $country->prefix.$invitor_tel, $project->message.". "."http://".HOST_SERVER."/payment/i/".$project->token);                
            }
            
        }
        return ['result' => 'success', 'msg' => '', ]; 
	}
	
	public function lists($user_id, $type = 0) {
	    $sql = "SELECT t1.*, t2.name as country_name, if(t1.expired_at < DATE(NOW()), 1, 0) AS is_expired
	              FROM bg_projects t1, bg_countries t2
	             WHERE t1.user_id = ?
	               AND t1.country_id = t2.id";
	    if ($type == 0 ) {
	        
	    } elseif ($type == 1) {
	        $sql .= " AND DATE(NOW()) < t1.expired_at";
	    } else {
	        $sql .= " AND DATE(NOW()) > t1.expired_at";
	    }
	    
	    $sql_crowded = "SELECT SUM(amount) AS crowded_amount, project_id
	                      FROM bg_transactions
	                     GROUP BY project_id";
	    
	    $sql_invitors = "SELECT COUNT(*) AS cnt_invitors, project_id
	                      FROM bg_invitors
	                     GROUP BY project_id";
	    
	    $sql = "SELECT t1.*, IFNULL(t2.crowded_amount, 0) AS crowded_amount, IFNULL(t3.cnt_invitors, 0) AS cnt_invitors
	              FROM ($sql) t1
	              LEFT JOIN ($sql_crowded) t2
	                ON t1.id = t2.project_id
	              LEFT JOIN ($sql_invitors) t3
	                ON t1.id = t3.project_id	                
	             ORDER BY t1.created_at DESC";

	    return $this->db->query($sql, $user_id)->result();
	}
	
	public function detail($id) {
	    $sql = "SELECT t1.*, t2.name as country_name, if(t1.expired_at < DATE(NOW()), 1, 0) AS is_expired, 'success' as result, '' as msg 
	              FROM bg_projects t1, bg_countries t2
	             WHERE t1.id = ?
	               AND t1.country_id = t2.id";
	     
	    $sql_crowded = "SELECT SUM(amount) AS crowded_amount, project_id
	                      FROM bg_transactions
	                     WHERE project_id = ?
	                     GROUP BY project_id";
	    $sql = "SELECT t1.*, IFNULL(t2.crowded_amount, 0) AS crowded_amount
                  FROM ($sql) t1
                  LEFT JOIN ($sql_crowded) t2
	                ON t1.id = t2.project_id";
	    
	    $result = $this->db->query($sql, array($id, $id))->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return ['result' => 'failed', 'msg' => 'Invalid Project ID', ];
	    }    
	    
	}
	
	public function detailByToken($token) {
	    $sql = "SELECT *
	              FROM bg_projects
	             WHERE token = ?";
	    
	    $result = $this->db->query($sql, $token)->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return ['result' => 'failed', 'msg' => 'Invalid Token', ];
	    }
	}	
	
	public function invitors($id) {
	    $project = $this->detail($id);
	    $user_id = $project->user_id;
	    
	    $sql = "SELECT SUM(amount) as amount, invitor_tel, created_at
	              FROM bg_transactions
	             WHERE project_id = ?";
	    
	    $sql = "SELECT t1.invitor_tel, t2.amount, t2.created_at as paid_at, t1.created_at as invited_at
	              FROM bg_invitors t1
	              LEFT JOIN ($sql) t2
	                ON t1.invitor_tel = t2.invitor_tel
	             WHERE t1.project_id = ?";
	    
	    $sql = "SELECT t1.*, t2.name
	              FROM ($sql) t1
	              LEFT JOIN bg_contacts t2 ON t1.invitor_tel = t2.phone AND t2.user_id = ?";
	    
	   $result = $this->db->query($sql, array($id, $id, $user_id))->result();
	   if ($result) {
	       return $result;
	   } else {
	       return array(); 
	   }
	}
	
	public function payers($id) {
	    $sql = "SELECT invitor_tel as tel, amount, created_at
	              FROM bg_transactions
	             WHERE project_id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    if ($result) {
	        return $result;
	    } else {
	        return array();
	    }
	}

	public function amount_status($id) {
	    $sql = "SELECT IFNULL(SUM(amount), 0) as crowded_amount
	              FROM bg_transactions
	             WHERE project_id = ?";
	    $result_crowded = $this->db->query($sql, $id)->result();
	    
	    $sql = "SELECT *
	              FROM bg_bank_transfers
	             WHERE project_id = ?";
	    $result_bank_transfers = $this->db->query($sql, $id)->result();
	    
	    $sql = "SELECT t1.*, t2.w_name as company_name
	              FROM bg_coupon_codes t1, bg_companies t2
	             WHERE t1.project_id = ?
	               AND t1.company_id = t2.id";
	    $result_coupon_codes = $this->db->query($sql, $id)->result();
	    
	    $sql = "SELECT t1.*, t2.name as gift_name, t2.price as amount
	              FROM bg_gift_buys t1, bg_gifts t2
	             WHERE t1.project_id = ?
	               AND t1.gift_id = t2.id";
	    $result_gift_buys = $this->db->query($sql, $id)->result();
	    
	    $result_crowded = $result_crowded[0]->crowded_amount;
	    $result_wasted = 0;
	    foreach ($result_bank_transfers as $item) {
	        $result_wasted += $item->amount;
	    }
	    
	    foreach ($result_coupon_codes as $item) {
	        $result_wasted += $item->amount;
	    }

	    foreach ($result_gift_buys as $item) {
	        $result_wasted += $item->amount;
	    }
	    return ['crowded' => $result_crowded, 'wasted' => $result_wasted, 'avaiable' => $result_crowded * (100 - FEE) / 100 - $result_wasted, 'fee' => FEE,  
	            'bank_transfers' => $result_bank_transfers, 'coupon_codes' => $result_coupon_codes, 'gift_buys' => $result_gift_buys, ];
	}
	
	public function submit_bank($project_id, $amount, $bank_info) {
	    $sql = "INSERT INTO bg_bank_transfers(project_id, amount, bank_info, is_delivered, created_at, updated_at)
	             VALUE (?, ?, ?, FALSE, NOW(), NOW())";
	    $this->db->query($sql, array($project_id, $amount, $bank_info));
	}
	
	public function submit_coupon($project_id, $business_id, $amount) {
	    $this->load->model('common_model');	     
	    $coupon_code = $this->common_model->generateSalt(6, TRUE);
	    	    
	    $sql = "INSERT INTO bg_coupon_codes(project_id, company_id, amount, coupon_code, is_used, created_at, updated_at)
	             VALUE (?, ?, ?, ?, FALSE, NOW(), NOW())";
	    $this->db->query($sql, array($project_id, $business_id, $amount, $coupon_code));
	    return $coupon_code;
	}

	public function all() {
	    $sql = "SELECT t1.*, t2.phone as creator_tel, t3.name as country_name
	              FROM bg_projects t1, bg_users t2, bg_countries t3
	             WHERE t1.user_id = t2.id
	               AND t1.country_id = t3.id";
	    return $this->db->query($sql)->result();
	}
	
	public function allByCompanyId($companyId) {
	    $sql = "SELECT t1.*, t2.phone as creator_tel, t3.name as country_name
	              FROM bg_projects t1, bg_users t2, bg_countries t3
	             WHERE t1.user_id = t2.id
	               AND t1.country_id = t3.id
	               AND t1.company_id = ?";
	    return $this->db->query($sql, $companyId)->result();	    
	}
	
	public function count() {
	    $sql = "SELECT COUNT(*) as cnt
	              FROM bg_projects";
	    $result = $this->db->query($sql)->result();
	    return $result[0]->cnt;
	}
	
	public function countCreatedWeek($user_id) {
	    $sql = "SELECT COUNT(*) as cnt
                  FROM bg_projects
                 WHERE user_id = ?
                   AND YEAR(NOW()) = YEAR(created_at)
                   AND WEEK(NOW()) = WEEK(created_at)";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result[0]->cnt;
	}

	public function countExpiredWeek($user_id) {
	    $sql = "SELECT COUNT(*) as cnt
                  FROM bg_projects
                 WHERE user_id = ?
                   AND YEAR(NOW()) = YEAR(expired_at)
                   AND WEEK(NOW()) = WEEK(expired_at)";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result[0]->cnt;
	}

	public function createdToday($user_id) {
	    $sql = "SELECT *
                  FROM bg_projects
                 WHERE user_id = ?
                   AND DATE(NOW()) = DATE(created_at)";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result;
	}
	
	public function expiredToday($user_id) {
	    $sql = "SELECT *
                  FROM bg_projects
                 WHERE user_id = ?
                   AND DATE(NOW()) = DATE(expired_at)";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result;
	}
}
