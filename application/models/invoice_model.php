<?php
class Invoice_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function signup($name, $password, $email) {
	    $this->load->model('common_model');
	    
	    $salt = $this->common_model->generateSalt(16);
	    $secure_key = md5($salt.$password);
	    
	    $sql = "INSERT INTO bg_users(name, email,  secure_key, salt, is_active, created_at, updated_at)
	             VALUE (?, ?, ?, ?, TRUE, NOW(), NOW())";
	    
	    $this->db->query($sql, array($name, $email, $secure_key, $salt));
	    return ['result' => 'success', 'msg' => ''];
	}
	
	public function saveInvoice(){

		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
		$invoice = $_POST['invoice'];
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
	             VALUE (?, ?, ?, ?, ? , ? , 'awaitingApprove', NOW(), NOW())";
	    
	    $this->db->query($sql, array($contactId, $dateInput, $dueDate, $invoice , $reference , $currencySelect ));
	    $invoiceId = $this->db->insert_id();
	
	    $invoiceContent = $_POST['invoiceContent'];
	    for($i = 0 ; $i < count($invoiceContent);$i++){
	    	
	    	$itemId =  $invoiceContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $invoiceContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $invoiceContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $invoiceContent[$i]['itemUnitPriceForInvoice'];
	    	$itemDisForInvoice =  $invoiceContent[$i]['itemDisForInvoice'];
	    	$itemAccountForInvoice =  $invoiceContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $invoiceContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $invoiceContent[$i]['itemAmountForInvoice'];

	    	$sql = "INSERT INTO bg_transaction_content(transactionId,   itemId, description, qty, unitPrice, discount ,accountId ,taxRateId ,amount , transType , transCoff , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , ? , ? ,? , 'invoice' ,'1',NOW(), NOW())";
	    
	    	$this->db->query($sql, array($invoiceId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemDisForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice ));

	    }

	    return $invoiceId; 
		
	}

	public function makeApprove(){
		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
		$invoice = $_POST['invoice'];
		$currencySelect = $_POST['currencySelect'];		

		$sql = "INSERT INTO bg_invoice(nameTo, date,  dueDate, invoiceNumber, reference, currencyId, state , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , 'approve', NOW(), NOW())";
	    
	    $this->db->query($sql, array($nameTo, $dateInput, $dueDate, $invoice , $invoice , $currencySelect ));
	    $invoiceId = $this->db->insert_id();
	
	    $invoiceContent = $_POST['invoiceContent'];
	    for($i = 0 ; $i < count($invoiceContent);$i++){
	    	
	    	$itemId =  $invoiceContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $invoiceContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $invoiceContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $invoiceContent[$i]['itemUnitPriceForInvoice'];
	    	$itemDisForInvoice =  $invoiceContent[$i]['itemDisForInvoice'];
	    	$itemAccountForInvoice =  $invoiceContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $invoiceContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $invoiceContent[$i]['itemAmountForInvoice'];

	    	$sql = "INSERT INTO bg_invoice_content(invoiceId,   itemId, description, qty, unitPrice, discount ,accountId ,taxRateId ,amount , created_at , updated_at)
	             VALUE (?, ?, ?, ?, ? , ? , ? , ? ,? , NOW(), NOW())";
	    
	    	$this->db->query($sql, array($invoiceId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemDisForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice ));

	    }

	    return $invoiceId; 
	}

	public function getContentsFromId($invoiceId){
		$sql = "select t1.* , t2.taxRate as taxRate from bg_transaction_content t1, bg_tax t2 where t1.taxRateId = t2.id and transactionId = ?";
		$result = $this->db->query($sql , $invoiceId )->result();
		return $result;
	}

	public function getContentsFromIdDetail($invoiceId){
		$sql = "SELECT t1.* , t2.taxRate AS taxRate , t3.itemName AS itemName , t4.accountName AS accountName ,t2.name AS taxName  FROM 
					bg_invoice_content t1, 
					bg_tax t2 ,
					bg_item t3 ,
					bg_account t4
					WHERE 
					t1.taxRateId = t2.id AND
					t1.itemId = t3.id AND
					t1.accountId = t4.id 
					AND invoiceId = ?";
		$result = $this->db->query($sql , $invoiceId )->result();
		return $result;	
	}

	public function getContent($invoiceId){
		$sql = "select t1.* , t2.name as contactName 
				from bg_transaction t1 , bg_contacts t2 
				where t1.id = ? and t2.id = t1.contactId";
		$result = $this->db->query($sql , $invoiceId )->result();
		return $result[0];
	}

	public function updateInvoice(){

		$invoiceId = $_POST['invoiceId'];
		$nameTo = $_POST['nameTo'];
		$dateInput = $_POST['dateInput'];
		$dueDate = $_POST['dueDate'];
		$reference = $_POST['reference'];
		$invoice = $_POST['invoice'];
		$currencySelect = $_POST['currencySelect'];		
		$sql = "UPDATE bg_invoice
						SET nameTo=? , 
							date=? ,
							dueDate=? ,
							invoiceNumber=? ,
							reference=? ,
							currencyId=? ,
							state= 'draft' ,
							updated_at = NOW()
						WHERE id=?"; 

	    $this->db->query($sql, array($nameTo, $dateInput, $dueDate, $invoice , $reference , $currencySelect , $invoiceId));
	    
	
	    $invoiceContent = $_POST['invoiceContent'];
	    for($i = 0 ; $i < count($invoiceContent);$i++){
	    	
	    	$invoiceContentId = $invoiceContent[$i]['invoiceContentId']; 
	    	$itemId =  $invoiceContent[$i]['item'];
	    	$itemDescriptionForInvoice =  $invoiceContent[$i]['itemDescriptionForInvoice'];
	    	$itemQtyForInvoice =  $invoiceContent[$i]['itemQtyForInvoice'];
	    	$itemUnitPriceForInvoice =  $invoiceContent[$i]['itemUnitPriceForInvoice'];
	    	$itemDisForInvoice =  $invoiceContent[$i]['itemDisForInvoice'];
	    	$itemAccountForInvoice =  $invoiceContent[$i]['itemAccountForInvoice'];
	    	$itemTaxRateForInvoice =  $invoiceContent[$i]['itemTaxRateForInvoice'];
	    	$itemAmountForInvoice =  $invoiceContent[$i]['itemAmountForInvoice'];

	    	$sql = "UPDATE bg_invoice_content
	    				set invoiceId = ? ,   
	    					itemId = ?, 
	    					description = ?, 
	    					qty = ? , 
	    					unitPrice = ?, 
	    					discount = ?,
	    					accountId = ?,
	    					taxRateId = ?,
	    					amount = ? , 
	    					updated_at = Now()
	    				where id = ?";
	       	    
	    
	    	$this->db->query($sql, array($invoiceId, $itemId, $itemDescriptionForInvoice, $itemQtyForInvoice , $itemUnitPriceForInvoice , $itemDisForInvoice , $itemAccountForInvoice , $itemTaxRateForInvoice , $itemAmountForInvoice , $invoiceContentId ));


	    }

	    
	}
	public function getPaids(){
		$sql = "select * from bg_paidto";
		$result = $this->db->query($sql)->result();
		return $result;

	}

	public function savePayment(){

		$invoiceId = $_POST['invoiceId'];
		$amountPaid = $_POST['amountPaid'];
		$datePaid = $_POST['datePaid'];
		$paidTo = $_POST['paidTo'];
		$paidReference = $_POST['paidReference'];

		$sql = "UPDATE bg_invoice
	    				set state = 'authorized' , 
	    					updated_at = Now()
	    				where id = ?";

	    $this->db->query($sql,$invoiceId);

	    $sql = "INSERT INTO bg_payment(amountPaid,   datePaid, paidTo, paidReference, invoiceId, state ,created_at ,updated_at )
	             VALUE (?, ?, ?, ?, ? ,'authorized' , NOW(), NOW())";
	    
	    $this->db->query($sql, array($amountPaid, $datePaid, $paidTo, $paidReference , $invoiceId ));
		                        
	}
	public function getContentOfAuth(){
		$sql = "SELECT * FROM bg_payment t1 , bg_invoice t2
					WHERE t1.invoiceId = t2.id AND t1.state = 'authorized'";

		return $this->db->query($sql)->result();
	}

	
}
