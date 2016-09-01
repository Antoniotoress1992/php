<?php
class Item_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	public function saveItem() {

		$itemCode   				= $_POST['itemCode']  ;
        $itemName        			= $_POST['itemName']  ;
        $unitPrice        			= $_POST['unitPrice']  ;
        $salesAccountTypeForItem 	= $_POST['salesAccountTypeForItem']  ;
        $taxRateForItem           	= $_POST['taxRateForItem']  ;
        $salesDescriptionForItem    = $_POST['salesDescriptionForItem']  ;
        $trackThisItem       		= $_POST['trackThisItem']  ;
        $purchaseItem      			= $_POST['purchaseItem']  ; 
        $sellItem      				= $_POST['sellItem']  ; 

        if($trackThisItem == "true"){$trackThisItem = 1;}else{$trackThisItem = 0;}
        if($purchaseItem == "true"){$purchaseItem = 1;}else{$purchaseItem = 0;}
        if($sellItem == "true"){$sellItem = 1;}else{$sellItem = 0;}

	    $sql = "INSERT INTO bg_item( itemName , itemCode, unitPrice, accountId, taxRate, description , 	trackItem, purchaseItem, sellItem , created_at, updated_at )
                                        
	             VALUE (?, ?, ?, ?, ?, ?, ?, ?, ? , NOW(), NOW())";
	    
	    $this->db->query($sql, array($itemName, $itemCode, $unitPrice, $salesAccountTypeForItem, $taxRateForItem, $salesDescriptionForItem, $trackThisItem, $purchaseItem , $sellItem));
	    return ['result' => 'success', 'msg' => ''];
	}

	public function getAll(){
		$sql = "select * from bg_item";
		$result = $this->db->query($sql)->result();
		return $result; 
	}
	
	public function getItem(){
		$itemId = $_POST['itemId'];
		$sql = "select * from bg_item where id = ?";
		$result = $this->db->query($sql , $itemId );
		return $result[0];

	}
	
}
