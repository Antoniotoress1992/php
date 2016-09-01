<?php
class Purchase_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function savePurchase(){

		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
		$currencySelect = $_POST['currencySelect'];	

		$purchaseContent = $_POST['purchaseContent'];

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
	             VALUE (?, ?, ?, ?, ? , ? , 'awaitingApprove', NOW(), NOW())";
	    
	    $this->db->query($sql, array($contactId, $dateInput, $dueDate, '' , $reference , $currencySelect ));
	    $transactionId = $this->db->insert_id();


	    $purchaseContent = $_POST['purchaseContent'];

	    for($i = 0 ; $i < count($purchaseContent);$i++){
	    	
	    	$itemId =  $purchaseContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $purchaseContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $purchaseContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $purchaseContent[$i]['itemUnitPriceForInvoice'];
	    	$itemAccountForInvoice =  $purchaseContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $purchaseContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $purchaseContent[$i]['itemAmountForInvoice'];



	    	$sql = "INSERT INTO bg_transaction_content(transactionId,   itemId, description, qty, unitPrice, discount ,accountId ,taxRateId ,amount , transType , transCoff , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , ? , ? ,? , 'purchase' ,'-1',NOW(), NOW())";
	    
	    	$this->db->query($sql, array($transactionId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , '' , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice ));

	    }

	    return $transactionId; 
		
	}

	public function makeApprove(){
		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
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

		$sql = "INSERT INTO bg_purchase(contactId, date,  dueDate , reference, currencyId, state , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , 'approve', NOW(), NOW())";
	    
	    $this->db->query($sql, array($contactId, $dateInput, $dueDate ,$reference , $currencySelect ));
	    $purchaseId = $this->db->insert_id();
	
	    $purchaseContent = $_POST['purchaseContent'];
	    for($i = 0 ; $i < count($purchaseContent);$i++){
	    	
	    	$itemId =  $purchaseContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $purchaseContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $purchaseContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $purchaseContent[$i]['itemUnitPriceForInvoice'];
	    	$itemAccountForInvoice =  $purchaseContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $purchaseContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $purchaseContent[$i]['itemAmountForInvoice'];

	    	$sql = "INSERT INTO bg_purchase_content(purchaseId,   itemId, description, qty, unitPrice ,accountId ,taxRateId ,amount , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , ? , ?  , NOW(), NOW())";
	    
	    	$this->db->query($sql, array($purchaseId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice ));

	    }

	    return $purchaseId; 
	}

	public function getContentsFromId($purchaseId){
		$sql = "select t1.* , t2.taxRate as taxRate from bg_transaction_content t1, bg_tax t2 where t1.taxRateId = t2.id and transactionId = ?";
		$result = $this->db->query($sql , $purchaseId )->result();
		return $result;
	}

	public function getContentsFromIdDetail($purchaseId){
		$sql = "SELECT t1.* , t2.taxRate AS taxRate , t3.itemName AS itemName , t4.accountName AS accountName ,t2.name AS taxName  FROM 
					bg_purchase_content t1, 
					bg_tax t2 ,
					bg_item t3 ,
					bg_account t4
					WHERE 
					t1.taxRateId = t2.id AND
					t1.itemId = t3.id AND
					t1.accountId = t4.id 
					AND purchaseId = ?";
		$result = $this->db->query($sql , $purchaseId )->result();
		return $result;	
	}

	public function getContent($purchaseId){
		$sql = "select t1.* , t2.name as contactName 
				from bg_transaction t1 , bg_contacts t2 
				where t1.id = ? and t2.id = t1.contactId";
		$result = $this->db->query($sql , $purchaseId )->result();
		return $result[0];
	}


	public function updatePurchase(){

		$purchaseId = $_POST['purchaseId'];
		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
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



		$sql = "UPDATE bg_purchase
						SET contactId=? , 
							date=? ,
							dueDate=? ,
							reference=? ,
							currencyId=? ,
							state= 'awaitingApprove' ,
							updated_at = NOW()
						WHERE id=?"; 

	    $this->db->query($sql, array($contactId, $dateInput, $dueDate,  $reference , $currencySelect , $purchaseId));
	    
	
	    $purchaseContent = $_POST['purchaseContent'];
	    for($i = 0 ; $i < count($purchaseContent);$i++){
	    	
	    	$ContentId = $purchaseContent[$i]['purchaseContentId']; 
	    	$itemId =  $purchaseContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $purchaseContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $purchaseContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $purchaseContent[$i]['itemUnitPriceForInvoice'];
	    	$itemAccountForInvoice =  $purchaseContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $purchaseContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $purchaseContent[$i]['itemAmountForInvoice'];

	    	$sql = "UPDATE bg_purchase_content
	    				set purchaseId = ? ,   
	    					itemId = ?, 
	    					description = ?, 
	    					qty = ? , 
	    					unitPrice = ?, 
	    					accountId = ?,
	    					taxRateId = ?,
	    					amount = ? , 
	    					updated_at = Now()
	    				where id = ?";
	       	    
	    
	    	$this->db->query($sql, array($purchaseId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice , $ContentId ));
	    }

	}
	public function getPaids(){
		$sql = "select * from bg_paidto";
		$result = $this->db->query($sql)->result();
		return $result;

	}

	public function savePayment(){

		$purchaseId = $_POST['purchaseId'];
		$amountPaid = $_POST['amountPaid'];
		$datePaid = $_POST['datePaid'];
		$paidTo = $_POST['paidTo'];
		$paidReference = $_POST['paidReference'];

		$sql = "UPDATE bg_purchase
	    				set state = 'authorized' , 
	    					updated_at = Now()
	    				where id = ?";

	    $this->db->query($sql,$purchaseId);

	    $sql = "INSERT INTO bg_purchase_payment(amountPaid,   datePaid, paidTo, paidReference, purchasegetId, state ,created_at ,updated_at )
	             VALUE (?, ?, ?, ?, ? ,'authorized' , NOW(), NOW())";
	    
	    $this->db->query($sql, array($amountPaid, $datePaid, $paidTo, $paidReference , $purchaseId ));
		                        
	}
	

	public function getContentOfAuth(){
		$sql = "SELECT * FROM bg_purchase_payment t1 , bg_purchase t2
					WHERE t1.purchaseId = t2.id AND t1.state = 'authorized'";


		return $this->db->query($sql)->result();
	}

	public function getContentOfAll(){
		$sql = "SELECT t1.* , t2.name as contactName FROM  bg_purchase t1 , bg_contacts t2
				where t1.contactId = t2.id
		";


		return $this->db->query($sql)->result();
	}
}
