<?php
class Transaction_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function add($project_id, $invitor_tel, $amount, $data = '') {
        $sql = "INSERT INTO bg_transactions(project_id, invitor_tel, amount, data, created_at, updated_at)
                 VALUE(?, ?, ?, ?, NOW(), NOW())";
        $this->db->query($sql, array($project_id, $invitor_tel, $amount, $data));
	}
	
	public function paidToday($user_id) {
	    $sql = "SELECT IFNULL(SUM(t1.amount), 0) as amt
                  FROM bg_transactions t1, bg_projects as t2
                 WHERE t1.project_id = t2.id
                   AND t2.user_id = ?
                   AND DATE(t1.created_at) = DATE(NOW())";
	    $result = $this->db->query($sql, $user_id)->result();
	    return $result[0]->amt;
	}

	public function getEntryContentByAccountInv($account , $firstDate , $lastDate , $type){
		$sql = "SELECT *   FROM bg_entry t1 
				WHERE t1.date >= ? AND t1.date <= ? AND t1.entryType = ? and t1.accountId = ? ";

		$result = $this->db->query($sql , array( $firstDate, $lastDate ,$type , $account))->result();
		return $result;
	}

	public function getAllContentByAccountInv($account){

		$sql  = "SELECT  t1.date as transactionDate ,
						 t4.name as transactionName ,
						 t2.transCoff as transCoff ,
						  SUM(t2.amount) AS amount ,
						
						 t1.id as transactionId
				    FROM 
					bg_transaction t1 ,
					bg_transaction_content t2 ,
					bg_accounttype t3 ,
					bg_contacts t4
				    WHERE t2.transactionId =  t1.id AND t3.id = t2.accountId AND t4.id = t1.contactId AND t3.id = ? GROUP BY transactionId";

		$result = $this->db->query($sql , $account)->result();

		return $result;
	}

	public function getAllAccountTrial($nowDate){
		$sql = "SELECT SUM(t1.amount * t1.debitCoff) AS debitAmount , SUM(t1.amount * t1.creditCoff) AS creditAmount , t2.* , t2.id AS accountId FROM 
			(SELECT *, IF(entryType = 'income',1,  0) AS debitCoff , IF(entryType = 'expense',1,  0) AS creditCoff 
			FROM    bg_entry) t1 , bg_entry_account t2
			WHERE t2.id = t1.accountId and t1.date <= ? GROUP BY t1.accountId";

		$result = $this->db->query($sql , $nowDate)->result();
		return $result;
	}
	public function getAllCategoryTrial($nowDate){
		$sql = "SELECT SUM(t1.amount * t1.debitCoff) AS creditAmount , SUM(t1.amount * t1.creditCoff) AS debitAmount , t2.* , t2.id AS accountId FROM 
			(SELECT *, IF(entryType = 'income',1,  0) AS debitCoff , IF(entryType = 'expense',1,  0) AS creditCoff 
			FROM    bg_entry) t1 , bg_entry_category t2
			WHERE t2.id = t1.categoryId and t1.date <= ? GROUP BY t1.categoryId";

		$result = $this->db->query($sql , $nowDate)->result();
		return $result;

	}

	public function getAllAccountOfPeriod($startDate , $lastDate){
		$sql = "SELECT SUM(t1.amount * t1.debitRegCoff) AS debitRegAmount , SUM(t1.amount * t1.creditRegCoff) AS creditRegAmount , 
		       SUM(t1.amount * t1.debitDueCoff) AS debitDueAmount , SUM(t1.amount * t1.creditDueCoff) AS creditDueAmount , 
		       SUM(t1.amount * t1.debitCurrentCoff) AS debitCurrentAmount , SUM(t1.amount * t1.creditCurrentCoff) AS creditCurrentAmount , 
			t2.* , t2.id AS accountId FROM 
					
					(SELECT *, IF(entryType = 'income' AND   DATE< ? ,1,  0) AS debitRegCoff , 
						   IF(entryType = 'expense' AND  DATE< ? ,1,  0) AS creditRegCoff ,
						   IF(entryType = 'income' AND  ?<= DATE AND DATE<= ? ,1,  0) AS debitDueCoff , 
						   IF(entryType = 'expense' AND  ?<= DATE AND DATE<= ? ,1,  0) AS creditDueCoff ,
						   IF(entryType = 'income' AND   DATE > ? ,1,  0) AS debitCurrentCoff , 
						   IF(entryType = 'expense' AND  DATE > ? ,1,  0) AS creditCurrentCoff 
						   
					FROM    bg_entry) t1 , bg_entry_account t2
					WHERE t2.id = t1.accountId  GROUP BY t1.accountId";
		$result = $this->db->query($sql , array($startDate,$startDate,$startDate,$lastDate,$startDate,$lastDate,$lastDate,$lastDate))->result();
		return $result;

	}
	public function getAllCategoryOfPeriod($startDate , $lastDate){
		$sql = "SELECT SUM(t1.amount * t1.debitRegCoff) AS creditRegAmount , SUM(t1.amount * t1.creditRegCoff) AS  debitRegAmount, 
		       SUM(t1.amount * t1.debitDueCoff) AS creditDueAmount  , SUM(t1.amount * t1.creditDueCoff) AS  debitDueAmount, 
		       SUM(t1.amount * t1.debitCurrentCoff) AS creditCurrentAmount  , SUM(t1.amount * t1.creditCurrentCoff) AS  debitCurrentAmount, 
			t2.* , t2.id AS accountId FROM 
					
					(SELECT *, IF(entryType = 'income' AND   DATE< ? ,1,  0) AS debitRegCoff , 
						   IF(entryType = 'expense' AND  DATE< ? ,1,  0) AS creditRegCoff ,
						   IF(entryType = 'income' AND  ?<= DATE AND DATE<= ? ,1,  0) AS debitDueCoff , 
						   IF(entryType = 'expense' AND  ?<= DATE AND DATE<= ? ,1,  0) AS creditDueCoff ,
						   IF(entryType = 'income' AND   DATE > ? ,1,  0) AS debitCurrentCoff , 
						   IF(entryType = 'expense' AND  DATE > ? ,1,  0) AS creditCurrentCoff 
						   
					FROM    bg_entry) t1 , bg_entry_account t2
					WHERE t2.id = t1.categoryId  GROUP BY t1.accountId";
		$result = $this->db->query($sql , array($startDate,$startDate,$startDate,$lastDate,$startDate,$lastDate,$lastDate,$lastDate))->result();
		return $result;
	}


	public function getAllBalanceData($type){

		$dateNow = date("Y-m-d");
		$sql = "SELECT * , SUM(t1.amount) AS totalAmount
				 FROM bg_entry t1 ,
				      bg_entry_account t2 ,
				      bg_entry_account_category t3 
				      
				 WHERE t3.callName = ? AND
				       t2.categoryId = t3.id AND
				       t1.accountId =  t2.id and
				       t1.date <= ?
				       	GROUP BY t2.id";
		$result = $this->db->query($sql , array($type , $dateNow ))->result();
		return $result;

	}
	
	
	public function getAllEntryData($startDay , $lastDay , $type){

		
		$sql = "SELECT * , SUM(t1.amount) AS totalAmount  FROM bg_entry t1 , bg_entry_account t2
				WHERE t1.date >= ? AND t1.date <= ? AND t1.entryType = ? AND t1.accountId = t2.id GROUP BY t1.accountId";

					
		$result = $this->db->query($sql , array($startDay, $lastDay, $type ))->result();
		return $result;
	}


	public function getAllContentByAcccounts($state){
		$result = array();
		if($state == "All"){
			$sql  = "SELECT  t3.accountCode AS accountCode ,
						t3.name AS accountName ,
						t4.name AS taxName ,
						t4.taxRate AS taxRate,
						t5.name AS accoutType ,
						SUM(t2.amount * transCoff ) AS totalAmount ,
						t3.id as accountId
					     FROM 
						bg_transaction t1 ,
						bg_transaction_content t2 ,
						bg_accounttype t3 ,
						bg_tax t4 ,
						bg_accountcategory t5
					    WHERE t2.transactionId =  t1.id AND t3.id = t2.accountId AND t4.id = t2.taxRateId AND t5.id = t3.category
					GROUP BY t2.accountId";

			$result = $this->db->query($sql)->result();

		}else{

			$sql = "select * from bg_accountcategory where callname = ? ";
			$result1 = $this->db->query($sql , $state)->result();
			if(count($result1)>0){
				$category = $result1[0]->id;
				$sql  = "SELECT  t3.accountCode AS accountCode ,
						t3.name AS accountName ,
						t4.name AS taxName ,
						t4.taxRate AS taxRate,
						t5.name AS accoutType ,
						SUM(t2.amount * transCoff ) AS totalAmount ,
						t3.id as accountId
					     FROM 	
						bg_transaction t1 ,
						bg_transaction_content t2 ,
						bg_accounttype t3 ,
						bg_tax t4 ,
						bg_accountcategory t5
					    WHERE t2.transactionId =  t1.id AND t3.id = t2.accountId AND t4.id = t2.taxRateId AND t5.id = t3.category and t3.category = ?
					GROUP BY t2.accountId";
				$result = $this->db->query($sql , $category )->result();
			}


			
		}

			
		return $result; 
	}

	public function getContentOfAll(){
		$sql = "SELECT * ,
					t3.name as contactName 
					FROM  
					bg_transaction t1,
					bg_transaction_content t2 ,
					bg_contacts t3
					where t2.transactionId = t1.id and t1.contactId = t3.id and t2.transType = 'invoice'
					";

		return $this->db->query($sql)->result();
	}

	public function getContentOfAuth(){
		$sql = "SELECT * FROM bg_payment t1 , bg_transaction t2,
					bg_transaction_content t3 ,
					bg_contacts t4
					WHERE t3.transactionId = t2.id AND t1.state = 'authorized' and t4.id = t2.contactId and t3.transType = 'invoice'";

		return $this->db->query($sql)->result();
	}

	public function getContentsFromIdDetail($transactionId){
		$sql = "SELECT t1.* , t2.taxRate AS taxRate , t3.itemName AS itemName , t4.name AS accountName ,t2.name AS taxName  FROM 
					bg_transaction_content t1, 
					bg_tax t2 ,
					bg_item t3 ,
					bg_accounttype t4 ,
					bg_transaction t5
					WHERE 
					t1.taxRateId = t2.id AND
					t1.itemId = t3.id AND
					t1.accountId = t4.id AND
					t1.transactionId = t5.id 
					AND t1.transactionId = ?";
		$result = $this->db->query($sql ,  $transactionId   )->result();
		return $result;	
	}

	public function getContent($transactionId){
		$sql = "select t1.* ,t3.* , t2.name as contactName 
				from bg_transaction_content t1 , bg_contacts t2 , bg_transaction t3 
				where t3.id = ? and t2.id = t3.contactId and t1.transactionId = t3.id ";
		$result = $this->db->query($sql ,  $transactionId )->result();
		return $result[0];
	}

	public function makeApprove(){


		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
		$type = $_POST['type'];
		$coff = $_POST['coff'];	

		if($type == 'invoice'){
			$invoice = $_POST['invoice'];
		}else{
			$invoice = "";
		}
		
		$currencySelect = $_POST['currencySelect'];	
		
		$sql = "select * from bg_contacts where name = ?";
		$contactResult = $this->db->query($sql , $nameTo)->result();

		if(count($contactResult) == 0){
			$sql = "INSERT INTO bg_contacts(name, created_at,  updated_at)
	             VALUE (?,  NOW(), NOW())";
	        $this->db->query($sql , $nameTo) ;
	        $contactId = $this->db->insert_id();    
	    }else{
			$contactId = $contactResult[0]->id; 
		}

		$sql = "INSERT INTO bg_transaction(contactId, date,  dueDate, invoiceNumber, reference, currencyId, state , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , 'approve', NOW(), NOW())";
	    
	    $this->db->query($sql, array($contactId, $dateInput, $dueDate, $invoice , $invoice , $currencySelect ));
	    $invoiceId = $this->db->insert_id();
		
	    if($type == 'invoice'){
	    	 	$content = $_POST['invoiceContent'];
	    	}else{
	    		$content = $_POST['purchaseContent'];
	    	}

	   
	    for($i = 0 ; $i < count($content);$i++){
	    	
	    	$itemId =  $content[$i]['item'];
	    	$itemDescriptionForInvoice =  $content[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $content[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $content[$i]['itemUnitPriceForInvoice'];
	    	if($type == 'invoice'){
	    		$itemDisForInvoice =  $content[$i]['itemDisForInvoice'];
	    	}else{ 
	    		$itemDisForInvoice ='';
	    	}
	    	
	    	$itemAccountForInvoice =  $content[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $content[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $content[$i]['itemAmountForInvoice'];

	    	$sql = "INSERT INTO bg_transaction_content(transactionId,   itemId, description, qty, unitPrice, discount ,accountId ,taxRateId ,amount , transType , transCoff , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , ? , ? ,? , ? , ? ,NOW(), NOW())";
	    
	    	$this->db->query($sql, array($invoiceId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemDisForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice ,$type ,$coff ));

	    }

	    return $invoiceId; 
	}
}
