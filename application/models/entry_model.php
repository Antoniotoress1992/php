<?php
class Entry_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getAllEntryCategoryData() {
	   
	   	$sql = "SELECT t1.*  , t2.name AS categoryName FROM 
					bg_entry_category t1 , bg_entry_category_group t2
					WHERE t2.id = t1.groupId";
	    
	    $result = $this->db->query($sql)->result();
	    return $result;
	}

	public function getAllEntryCategoryByName($type){
		$sql = "SELECT t1.*  , t2.name AS categoryName FROM 
					bg_entry_category t1 , bg_entry_category_group t2
					WHERE t2.id = t1.groupId AND (t2.typeFor = ? or t2.typeFor = 'both') ";
	    if($type == 'income'){
	    	$result = $this->db->query($sql , 'income')->result();
	    }else{
	    	$result = $this->db->query($sql , 'expense')->result();
	    }
	    
	    return $result;
	}

	public function getAllEntryAccountData(){
		 $sql = "SELECT t1.*  , t2.categoryName AS categoryName FROM 
					bg_entry_account t1 , bg_entry_account_category t2
					WHERE t2.id = t1.categoryId";
	    $result = $this->db->query($sql)->result();
	    return $result;
	}

	public function saveEntry(){

       	$transactionDate = $_POST['transactionDate'];
		$transactionDescription = $_POST['transactionDescription'];
		$transactionAmount = $_POST['transactionAmount'];
		$transactionCategory = $_POST['transactionCategory'];
		$transactionAccount = $_POST['transactionAccount'];
		$transactionType = $_POST['transactionType'];		
		$entryId = $_POST['entryId'];
		$staus = $_POST['status'];
		

		if($entryId == ""){
			$sql = "INSERT INTO bg_entry(date, description,  amount, categoryId, accountId, state, entryType , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , 'verified' , ?, NOW(), NOW())";
	        $this->db->query($sql, array($transactionDate, $transactionDescription, $transactionAmount, $transactionCategory , $transactionAccount , $transactionType ));
	    	$entryId = $this->db->insert_id();
		}else{
			
			if($staus == 'verified'){
				$sql = "UPDATE bg_entry
					SET date=? , 
						description=? ,
						amount=? ,
						categoryId=? ,
						accountId=? ,
						state='not' ,
						entryType= ? ,
						updated_at = NOW()
					WHERE id=?"; 

			}else{
				$sql = "UPDATE bg_entry
					SET date=? , 
						description=? ,
						amount=? ,
						categoryId=? ,
						accountId=? ,
						state='verified' ,
						entryType= ? ,
						updated_at = NOW()
					WHERE id=?"; 
			}
		

	    	$this->db->query($sql, array($transactionDate, $transactionDescription, $transactionAmount, $transactionCategory , $transactionAccount , $transactionType , $entryId));

		}

	    return $entryId; 
	}

	 
}
