<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounttype_model');
        $this->load->model('tax_model');
        $this->load->model('account_model');
        $this->load->model('item_model');
        $this->load->model('currency_model');
        $this->load->model('invoice_model');
        $this->load->model('contact_model');
        $this->load->model('transaction_model');
    }
    
    public function index() {
        $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $accountTypes = $this->accounttype_model->getAllAccountType();
        $types = $this->accounttype_model->getTypes();
        

        $taxes = $this->tax_model->getAllTax();

        $param['accountTypes'] = $accountTypes	;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();
        $param['types'] = $types; 
        $param['contacts'] = $this->contact_model->getAll();
        $param['taxes'] = $taxes ;

        $this->load->view('customer/invoice/vwEdit', $param);
    }

    public function edit(){
         $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $invoiceId = $_GET['invoiceId'];

        $taxes = $this->tax_model->getAllTax();
        $accountTypes = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes  ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();

        $param['invoiceContents'] = $this->invoice_model->getContentsFromId($invoiceId);
        $param['invoiceInv'] = $this->invoice_model->getContent($invoiceId);
        
         
       

        $this->load->view('customer/invoice/vwDraft', $param);

    }

    function saveInvoice(){
        
        $invoiceId = $this->invoice_model->saveInvoice(); 
        die(json_encode(['invoice'=> $invoiceId]));
    }

    function updateInvoice(){
        $this->invoice_model->updateInvoice(); 
        die(json_encode(['success'=> 'success']));   
    }

    function makeApprove(){
        $invoiceId = $this->transaction_model->makeApprove(); 
        die(json_encode(['invoice'=> $invoiceId]));   
    }

    function search(){
        
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        $state = $_GET['state'];
        if($state == "All"){
            $param['invoices'] = $this->transaction_model->getContentOfAll('invoice');
        }
        if($state == "authorized"){
            $param['invoices'] = $this->transaction_model->getContentOfAuth('invoice');
            
        }
        
        $this->load->view('customer/invoice/vwSearch', $param);
    
    }

    function receivable(){
        $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $invoiceId = $_GET['invoiceId'];

        $taxes = $this->tax_model->getAllTax();
        $accountTypes = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();
        $param['paidTos'] = $this->invoice_model->getPaids();
               

        $param['invoiceContents'] = $this->transaction_model->getContentsFromIdDetail($invoiceId , 'invoice');

        $param['invoiceInv'] = $this->transaction_model->getContent($invoiceId , 'invoice');
         
       

        $this->load->view('customer/invoice/vwReceivable', $param);
    }
    
    function savePayment(){
        $this->invoice_model->savePayment();
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
               

        $param['invoiceContents'] = $this->transaction_model->getContentsFromIdDetail($invoiceId);

        $param['invoiceInv'] = $this->transaction_model->getContent($invoiceId);
         
       

        $this->load->library('mpdf/mpdf');
        $html = $this->load->view('customer/invoice/vwReceivable', $param, true); 
        
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output('test.pdf', 'I');
    }
}
