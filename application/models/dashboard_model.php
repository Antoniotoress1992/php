<?php
class Dashboard_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function userList($startDate, $endDate, $company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT DATE(created_at) dt, count(*) as cnt
	                  FROM bg_users
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                 GROUP BY DATE(created_at)";
	    } else {
	        $sql = "SELECT DATE(created_at) dt, count(*) as cnt
	                  FROM bg_users
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                   AND company_id = ?
	                 GROUP BY DATE(created_at)";
	    }
	    
	    $sql = "SELECT t1.*, YEAR(dt) as y, MONTH(dt)-1 as m, DATE_FORMAT(dt,'%e') as d
	              FROM ($sql) t1";
	    $sqlPeriod = $this->allPeriod($startDate, $endDate);
	    $sql = "SELECT t1.*, IFNULL(t2.cnt, 0) AS cnt, YEAR(t1.dt) as y, MONTH(t1.dt)-1 as m, DATE_FORMAT(t1.dt,'%e') as d
	              FROM ($sqlPeriod) t1
	              LEFT JOIN ($sql) t2
	                ON t1.dt = t2.dt
	             ORDER BY t1.dt ASC";
	    
	    if ($company_id == 0) {
	        return $this->db->query($sql, array($startDate, $endDate))->result();
	    } else {
	        return $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
	}
	
	public function projectList($startDate, $endDate, $company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT DATE(created_at) dt, count(*) as cnt
	                  FROM bg_projects
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                 GROUP BY DATE(created_at)";
	    } else {
	        $sql = "SELECT DATE(created_at) dt, count(*) as cnt
	                  FROM bg_projects
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                   AND company_id = ?
	                 GROUP BY DATE(created_at)";
	    }
	     
	    $sql = "SELECT t1.*, YEAR(dt) as y, MONTH(dt)-1 as m, DATE_FORMAT(dt,'%e') as d
                  FROM ($sql) t1";
	    $sqlPeriod = $this->allPeriod($startDate, $endDate);
	    $sql = "SELECT t1.*, IFNULL(t2.cnt, 0) AS cnt, YEAR(t1.dt) as y, MONTH(t1.dt)-1 as m, DATE_FORMAT(t1.dt,'%e') as d
	              FROM ($sqlPeriod) t1
	              LEFT JOIN ($sql) t2
	                ON t1.dt = t2.dt
	             ORDER BY t1.dt ASC";
	     
	    if ($company_id == 0) {
	        return $this->db->query($sql, array($startDate, $endDate))->result();
	    } else {
	        return $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
    }
    
    public function invitorList($startDate, $endDate, $company_id = 0) {
        if ($company_id == 0) {
            $sql = "SELECT DATE(t2.created_at) dt, count(*) as cnt
	                  FROM bg_invitors t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
                       AND t1.project_id = t2.id
	                 GROUP BY DATE(t2.created_at)";
        } else {
            $sql = "SELECT DATE(t2.created_at) dt, count(*) as cnt
	                  FROM bg_invitors t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
                       AND t1.project_id = t2.id
                       AND t2.company_id = ?
	                 GROUP BY DATE(t2.created_at)";
        }
    
        $sql = "SELECT t1.*, YEAR(dt) as y, MONTH(dt)-1 as m, DATE_FORMAT(dt,'%e') as d
                  FROM ($sql) t1";
        $sqlPeriod = $this->allPeriod($startDate, $endDate);
        $sql = "SELECT t1.*, IFNULL(t2.cnt, 0) AS cnt, YEAR(t1.dt) as y, MONTH(t1.dt)-1 as m, DATE_FORMAT(t1.dt,'%e') as d
                  FROM ($sqlPeriod) t1
                  LEFT JOIN ($sql) t2
                    ON t1.dt = t2.dt
                 ORDER BY t1.dt ASC";
    
        if ($company_id == 0) {
            return $this->db->query($sql, array($startDate, $endDate))->result();
        } else {
            return $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
        }
    }
    
    public function moneyList($startDate, $endDate, $company_id = 0) {
        if ($company_id == 0) {
            $sql = "SELECT DATE(t2.created_at) dt, sum(t1.amount) as amount
	                  FROM bg_transactions t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
                       AND t1.project_id = t2.id
	                 GROUP BY DATE(t2.created_at)";
        } else {
            $sql = "SELECT DATE(t2.created_at) dt, sum(t1.amount) as amount
	                  FROM bg_transactions t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
                       AND t1.project_id = t2.id
                       AND t2.company_id = ?
	                 GROUP BY DATE(t2.created_at)";
        }
    
        $sql = "SELECT t1.*, YEAR(dt) as y, MONTH(dt)-1 as m, DATE_FORMAT(dt,'%e') as d
                  FROM ($sql) t1";
        $sqlPeriod = $this->allPeriod($startDate, $endDate);
        $sql = "SELECT t1.*, IFNULL(t2.amount, 0) AS amount, YEAR(t1.dt) as y, MONTH(t1.dt)-1 as m, DATE_FORMAT(t1.dt,'%e') as d
                  FROM ($sqlPeriod) t1
                  LEFT JOIN ($sql) t2
                    ON t1.dt = t2.dt
                 ORDER BY t1.dt ASC";
    
        if ($company_id == 0) {
            return $this->db->query($sql, array($startDate, $endDate))->result();
        } else {
            return $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
        }
    }    

	public function amountCollect($startDate, $endDate, $company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT ifnull(sum(t1.amount), 0) as amount
	                  FROM bg_transactions t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
	                   AND t1.project_id = t2.id";
	        $result = $this->db->query($sql, array($startDate, $endDate))->result();
	    } else{
	        $sql = "SELECT ifnull(sum(t1.amount), 0) as amount
	                  FROM bg_transactions t1, bg_projects t2
	                 WHERE (DATE(t2.created_at) BETWEEN ? AND ?)
                       AND t1.project_id = t2.id
	                   AND t2.company_id = ?";
	        $result = $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
	    return $result[0]->amount;
	}	
	
	public function countUser($startDate, $endDate, $company_id = 0) {	    
	    if ($company_id == 0) {
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_users
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)";
	        $result = $this->db->query($sql, array($startDate, $endDate))->result();
	    } else{
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_users
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                   AND company_id = ?";
	        $result = $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
	    return $result[0]->cnt;
	}
	
	public function countProject($startDate, $endDate, $company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_projects
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)";
	        $result = $this->db->query($sql, array($startDate, $endDate))->result();
	    } else{
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_projects
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)
	                   AND company_id = ?";
	        $result = $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
	    return $result[0]->cnt;
	}

	public function countInvitor($startDate, $endDate, $company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_invitors
	                 WHERE (DATE(created_at) BETWEEN ? AND ?)";
	        $result = $this->db->query($sql, array($startDate, $endDate))->result();
	    } else{
	        $sql = "SELECT count(*) as cnt
	                  FROM bg_invitors t1, bg_projects t2
	                 WHERE (DATE(t1.created_at) BETWEEN ? AND ?)
	                   AND t2.company_id = ?
	                   AND t1.project_id = t2.id";
	        $result = $this->db->query($sql, array($startDate, $endDate, $company_id))->result();
	    }
	    return $result[0]->cnt;
	}
	
	public function allPeriod($startDate, $endDate) {
	    $sql = "select datediff( ?, ? ) as days";
	    $days = $this->db->query($sql, array($endDate, $startDate))->result();
	    $days = $days[0];
	    $days = $days->days;
	     
	    $dateSql = "";
	    $days++;
	    for ($i = 0; $i < $days; $i++) {
	        $dateSql.="select date_add('$startDate',interval $i day) as dt";
	        if( $i != $days - 1  ){
	            $dateSql.=" union all ";
	        }
	    }
        return $dateSql;
	}
}
