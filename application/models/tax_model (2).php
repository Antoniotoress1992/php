<?php
class Account_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function saveAccount() {
	   
	   	$salesAccountType   = $_POST['salesAccountType']  ;
        $accountCode        = $_POST['accountCode']  ;
        $accountName        = $_POST['accountName']  ;
        $accountDescription = $_POST['accountDescription']  ;
        $salesTax           = $_POST['salesTax']  ;
        $watchlist          = $_POST['watchlist']  ;
        $expenseClaim       = $_POST['expenseClaim']  ;
        $enablePayment      = $_POST['enablePayment']  ; 

        if($watchlist == "true"){$watchlist = 1;}else{$watchlist = 0;}
        if($expenseClaim == "true"){$expenseClaim = 1;}else{$expenseClaim = 0;}
        if($enablePayment == "true"){$enablePayment = 1;}else{$enablePayment = 0;}

	    $sql = "INSERT INTO bg_account( accountName , accountCode, salesAccountType, accountDescription, salesTax, watchlist , 	expenseClaim, enablePayment, created_at, updated_at )
                                        
	             VALUE (?, ?, ?, ?, ?, ?, ?, ?,  NOW(), NOW())";
	    
	    $this->db->query($sql, array($accountName, $accountCode, $salesAccountType, $accountDescription, $salesTax, $watchlist, $expenseClaim, $enablePayment));
	    return ['result' => 'success', 'msg' => ''];
	}
	
}
