<?php
class Project_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function add($user_id, $name, $receiver_tel, $country_id, $amount, $message, $expired_at) {
	    $this->load->model('common_model');
	    $token = $this->common_model->generateSalt(16);
	    
	    $sql = "INSERT INTO bg_projects(user_id, name, receiver_tel, country_id, amount, message, token, expired_at, created_at, updated_at)
	             VALUE (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
	    
	    $result = $this->db->query($sql, array($user_id, $name, $receiver_tel, $country_id, $amount, $message, $token, $expired_at));
	    return $this->db->insert_id();
	}
	
	public function invite($id, $invitors) {
	    $arrInvitor = explode(",", $invitors);
	    $this->load->model('common_model');
	    $this->load->model('country_model');
        for ($i = 0; $i < count($arrInvitor); $i++) {
            $invitor_tel = str_replace(' ', '', $arrInvitor[$i]);
            if (substr($invitor_tel, 0, 1) == '0') {
                $invitor_tel = substr($invitor_tel, 1);
            }
            
            if ($invitor_tel != '') {
                $sql = "INSERT INTO bg_invitors(project_id, invitor_tel, created_at, updated_at)
                     VALUE (?, ?, NOW(), NOW())";
                $this->db->query($sql, array($id, $invitor_tel));                
            }
            
            $project = $this->detail($id);
            $country = $this->country_model->detail($project->country_id);
            
            $this->common_model->sendSMS($project->name, $country->prefix.$invitor_tel, $project->message.". "."http://".HOST_SERVER."/payment/i/".$project->token);
            
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
	    $sql = "SELECT invitor_tel
	              FROM bg_invitors
	             WHERE project_id = ?";
	   $result = $this->db->query($sql, $id)->result();
	   if ($result) {
	       return ['result' => 'success', 'msg' => '', 'invitors' => $result];
	   } else {
	       return ['result' => 'failed', 'msg' => 'Invalid Project ID', ]; 
	   }
	}
}
