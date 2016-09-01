<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounttype_model');
        $this->load->model('tax_model');
        $this->load->model('account_model');
        $this->load->model('item_model');
        $this->load->model('currency_model');
        $this->load->model('purchase_model');
        $this->load->model('contact_model');
        $this->load->model('transaction_model');
    }
    
    public function index() {
        $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $accountTypes = $this->accounttype_model->getAllAccountType();
        

        $taxes = $this->tax_model->getAllTax();

        $param['accountTypes'] = $accountTypes  ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();
        $param['taxes'] = $taxes ;
        $param['contacts'] = $this->contact_model->getAll();

        $this->load->view('customer/purchase/vwEdit', $param);
    }

    public function edit(){
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

        $param['purchaseContents'] = $this->purchase_model->getContentsFromId($purchaseId);
        $param['purchaseInv'] = $this->purchase_model->getContent($purchaseId);
         
        $param['contacts'] = $this->contact_model->getAll();

        $this->load->view('customer/purchase/vwDraft', $param);

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
        $purchaseId = $this->transaction_model->makeApprove(); 
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
        
        $this->load->view('customer/purchase/vwSearch', $param);
    
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

        
        $param['purchaseContents'] = $this->transaction_model->getContentsFromIdDetail($purchaseId , 'purchase');
        

        $param['purchaseInv'] = $this->transaction_model->getContent($purchaseId , 'purchase');
         
        $param['contacts'] = $this->contact_model->getAll();
        $param['paidTos'] = $this->purchase_model->getPaids(); 
       

        $this->load->view('customer/purchase/vwReceivable', $param);
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
        $html = $this->load->view('customer/purchase/vwReceivable', $param, true); 
        
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output('test.pdf', 'I');
    }
}
