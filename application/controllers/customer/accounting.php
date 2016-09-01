<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Entry_model');
        $this->load->model('item_model');
        $this->load->model('currency_model');
        $this->load->model('entry_model');
    }
    
    public function index() {
        $param['pageNo'] = 4;
        
        $user_id = $this->session->userdata('user_id');
        $entryDataGroup = $this->entry_model->getAllEntryCategoryData();
        $entryAccountGroup = $this->entry_model->getAllEntryAccountData();
        
        $param['entryDataGroup'] = $entryDataGroup;
        $param['entryAccountGroup'] = $entryAccountGroup;

        $param['incomeCategoryData'] = $this->entry_model->getAllEntryCategoryByName('income');
        $param['expenseCategoryData'] = $this->entry_model->getAllEntryCategoryByName('expense');
        
        $this->load->view('customer/accounting/vwEdit', $param);
    }

    public function edit(){
         $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $purchaseId = $_GET['purchaseId'];

        $taxes = $this->tax_model->getAllTax();
        $category = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes  ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();

        $param['purchaseContents'] = $this->purchase_model->getContentsFromId($purchaseId);
        $param['purchaseInv'] = $this->purchase_model->getContent($purchaseId);
         
        $param['contacts'] = $this->contact_model->getAll();

        $this->load->view('customer/accounting/vwDraft', $param);

    }

    function saveEntry(){
        $entryId = $this->entry_model->saveEntry(); 
        die(json_encode(['entryId'=> $entryId]));
    }

    function savePurchase(){
        
        $purchaseId = $this->purchase_model->savePurchase(); 
        die(json_encode(['purchaseId'=> $purchaseId]));
    }

    function updatePurchase(){
        $this->purchase_model->updatePurchase(); 
        die(json_encode(['success'=> 'success']));   
    }

    function makeApprove(){
        $purchaseId = $this->purchase_model->makeApprove(); 
        die(json_encode(['purchaseId'=> $purchaseId]));   
    }

    function search(){
        
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        $state = $_GET['state'];
        if($state == "All"){
            $param['purchases'] = $this->purchase_model->getContentOfAll();
        }
        if($state == "authorized"){
            $param['purchases'] = $this->purchase_model->getContentOfAuth();
            
        }
        
        $this->load->view('customer/accounting/vwSearch', $param);
    
    }

    function receivable(){
         $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $purchaseId = $_GET['purchaseId'];

        
        $taxes = $this->tax_model->getAllTax();
        $accountTypes = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes  ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();

        $param['purchaseContents'] = $this->purchase_model->getContentsFromIdDetail($purchaseId);
        $param['purchaseInv'] = $this->purchase_model->getContent($purchaseId);
         
        $param['contacts'] = $this->contact_model->getAll();
        $param['paidTos'] = $this->purchase_model->getPaids(); 
       

        $this->load->view('customer/accounting/vwReceivable', $param);
    }
    
    function savePayment(){
        $this->purchase_model->savePayment();
        die( json_encode(['result'=>'success']));
    }
    function printPdf(){
          $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $invoiceId = 20;

        $taxes = $this->tax_model->getAllTax();
        $accountTypes = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();
        $param['paidTos'] = $this->invoice_model->getPaids();
               

        $param['invoiceContents'] = $this->invoice_model->getContentsFromIdDetail($invoiceId);

        $param['invoiceInv'] = $this->invoice_model->getContent($invoiceId);
         
       

        $this->load->library('mpdf/mpdf');
        $html = $this->load->view('customer/accounting/vwReceivable', $param, true); 
        
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output('test.pdf', 'I');
    }
}
