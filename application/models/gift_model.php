<?php
class Gift_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function lists($company_id = 0) {
	    if ($company_id == 0) {
	        $sql = "SELECT t1.*, t2.name as company_name
	                  FROM bg_gifts t1, bg_companies t2
	                 WHERE t1.company_id = t2.id
	                 ORDER BY t1.created_at DESC";
	        return $this->db->query($sql)->result();
	    } else {
	        $sql = "SELECT *
	                  FROM bg_gifts
	                 WHERE company_id = ?
	                 ORDER BY created_at DESC";
	        return $this->db->query($sql, $company_id)->result();
	    }
	}
	
	public function detail($id) {
	    $sql = "SELECT *
                  FROM bg_gifts
                 WHERE id = ?";
	    $result = $this->db->query($sql, $id)->result();
	    if ($result) {
	        return $result[0];
	    } else {
	        return null;
	    }
	}
	
	public function delete($id) {
	    $sql = "DELETE
	              FROM bg_gifts
	             WHERE id = ?";
	    $this->db->query($sql, $id);
	}
	
	public function save($id, $company_id, $name, $price, $file) {
	    if ($id == '') {
	        if ($file['name'] == '') {
	            $thumb = DEFAULT_GIFT_IMAGE;
	        } else {
	            $ext = pathinfo( $file['name'] )['extension'];
	            $thumb = $company_id."_".time().".$ext";
	            if (!move_uploaded_file($file['tmp_name'], ABS_GIFT_PATH.$thumb)) {
	                $thumb = DEFAULT_GIFT_IMAGE;
	            }
	        }
	        
	        $sql = "INSERT INTO bg_gifts(company_id, name, thumb, price, created_at, updated_at)
	                 VALUE (?, ?, ?, ?, NOW(), NOW())";
	        $this->db->query($sql, array($company_id, $name, $thumb, $price));
	    } else {
	        $gift = $this->detail($id);
	        if ($file['name'] == '') {
	            $thumb = $gift->thumb;
	        } else {
	            $ext = pathinfo( $file['name'] )['extension'];
	            $thumb = $company_id."_".time().".$ext";
	            if (!move_uploaded_file($file['tmp_name'], ABS_GIFT_PATH.$thumb)) {
	                $thumb = $gift->thumb;
	            }	            
	        }
	        $sql = "UPDATE bg_gifts
	                   SET name = ?
	                     , thumb = ?
	                     , price = ?
	                     , updated_at = NOW()
	                 WHERE id = ?";
	        $this->db->query($sql, array($name, $thumb, $price, $id));	        
	    }
	}
	
	public function count() {
	    $sql = "SELECT COUNT(*) as cnt
	              FROM bg_gifts";
	    $result = $this->db->query($sql)->result();
	    return $result[0]->cnt;
	}
}
