<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AccountReport extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounttype_model');
        $this->load->model('tax_model');
        $this->load->model('account_model');
        $this->load->model('item_model');
        $this->load->model('currency_model');
        $this->load->model('transaction_model');
        $this->load->model('contact_model');
    }
    
    public function index() {
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        $state = $_GET['state'];
        if($state == "All"){
            $param['transactions'] = $this->transaction_model->getContentOfAllByAccount();
        }
        if($state == "authorized"){
            $param['invoices'] = $this->transaction_model->getContentOfAuthByAccount();
            
        }
        $this->load->view('customer/report/vwAccountReport', $param);
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
        $param['invoiceInv'] = $this->invoice_model->getContent($invoiceId);
         
        $this->load->view('customer/report/vwDraft', $param);

    }



    function view(){
        $account = $_GET['account'];
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        
        $transactions = $this->transaction_model->getAllContentByAccountInv($account);
        $param['transactions'] = $transactions;

        $this->load->view('customer/report/vwAccountReportDetail', $param);
    }

     function viewEntry(){
        $account = $_GET['account'];
        $firstDate = $_GET['period_start'];
        $lastDate = $_GET['period_end'];
        $type = $_GET['type'];
        
        $param['pageNo'] = 4;
        
        $entries = $this->transaction_model->getEntryContentByAccountInv($account , $firstDate , $lastDate , $type);
        $param['entries'] = $entries;

        $this->load->view('customer/report/vwAccountEntryDetail', $param);
    }

    function viewTrans(){
        $param['pageNo'] = 4;
        
        
        $user_id = $this->session->userdata('user_id');

        $invoiceId = $_GET['id'];

        $taxes = $this->tax_model->getAllTax();
        $accountTypes = $this->accounttype_model->getAllAccountType();
        $param['accountTypes'] = $accountTypes ;
        $param['taxes'] = $taxes ;
        $param['accounts'] = $this->account_model->getAll();
        $param['items'] = $this->item_model->getAll();
        $param['currencies'] = $this->currency_model->getAll();
        //$param['paidTos'] = $this->invoice_model->getPaids();
                

        $param['invoiceContents'] = $this->transaction_model->getContentsFromIdDetail($invoiceId );

        $param['invoiceInv'] = $this->transaction_model->getContent($invoiceId );
         
       

        $this->load->view('customer/report/vwAccountReportView', $param);
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
        $invoiceId = $this->invoice_model->makeApprove(); 
        die(json_encode(['invoice'=> $invoiceId]));   
    }

    function search(){
          
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        $state = $_GET['state'];
        $transactions = $this->transaction_model->getAllContentByAcccounts($state);
        $param['transactions'] = $transactions;

        $this->load->view('customer/report/vwAccountReport', $param);
    
    }

    function income(){
        $param['pageNo'] = 4;
        $user_id = $this->session->userdata('user_id');

        $period_start = $_GET['period_start'];
        $period_end = $_GET['period_end'];

        $incomeTransactions = $this->transaction_model->getAllEntryData($period_start, $period_end ,'income');
        $expenseTransactions = $this->transaction_model->getAllEntryData($period_start, $period_end ,'expense');

        
        $param['incomeTransactions'] = $incomeTransactions;
        $param['expenseTransactions'] = $expenseTransactions;

        $this->load->view('customer/report/vwIncomeReport', $param);
    }

    function balance(){
        $param['pageNo'] = 4;
        
        $assetAccounts = $this->transaction_model->getAllBalanceData('asset');
        $equityAccounts = $this->transaction_model->getAllBalanceData('equity');

        
        $param['assetAccounts'] = $assetAccounts;
        $param['equityAccounts'] = $equityAccounts;

        $this->load->view('customer/report/vwBalanceReport', $param);
    }

    function trial(){
        $param['pageNo'] = 4;

        $nowDate = $_GET['date'];
        
        $accountData = $this->transaction_model->getAllAccountTrial($nowDate);
        $categoryData = $this->transaction_model->getAllCategoryTrial($nowDate);

        
        $param['accountData'] = $accountData;
        $param['categoryData'] = $categoryData;

        $this->load->view('customer/report/vwTrialReport', $param);
    }

    function accountingPeriod(){
        $param['pageNo'] = 4;

        if(isset($_GET['period_start'])){
            $startDate = $_GET['period_start'];
        }else{
            $startDate = '1000-01-01';
        }

        if(isset($_GET['period_end'])){
            $lastDate = $_GET['period_end'];
        }else{
            $lastDate = '1000-01-01';
        }     
        
        $accountData = $this->transaction_model->getAllAccountOfPeriod($startDate , $lastDate);

        $categoryData = $this->transaction_model->getAllCategoryOfPeriod($startDate , $lastDate);

        
        $param['accountData'] = $accountData;
        $param['categoryData'] = $categoryData;

        $this->load->view('customer/report/vwAccountingPeroidRepor', $param);
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
               

        $param['invoiceContents'] = $this->invoice_model->getContentsFromIdDetail($invoiceId);

        $param['invoiceInv'] = $this->invoice_model->getContent($invoiceId);
         
       

        $this->load->view('customer/report/vwReceivable', $param);
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
               

        $param['invoiceContents'] = $this->invoice_model->getContentsFromIdDetail($invoiceId);

        $param['invoiceInv'] = $this->invoice_model->getContent($invoiceId);
         
       

        $this->load->library('mpdf/mpdf');
        $html = $this->load->view('customer/invoice/vwReceivable', $param, true); 
        
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output('test.pdf', 'I');
    }
}
