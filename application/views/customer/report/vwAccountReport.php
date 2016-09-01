<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('backend/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('backend/vwLeftMenu'); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-title">Chart of Account</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Accounts Report</span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php $status = $_GET['state'];?>               
                <div class="row">
                    <div class="ocl-sm-12">
                        <div class="sportlet box blue">
                            
                            <div class="portlet-body">
                                <ul class="nav nav-tabs">
                                    <li class="<?php if($status == "All"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=All" >
                                        All Accounts </a>
                                    </li>
                                    <li class="<?php if($status == "Assets"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=Assets" >
                                        Assets </a>
                                    </li>
                                    <li class="<?php if($status == "Liabilities"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=Liabilities" >
                                        Liabilities </a>
                                    </li>
                                    <li class="<?php if($status == "Equity"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=Equity" >
                                        Equity </a>
                                    </li>
                                    <li class="<?php if($status == "Expenses"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=Expenses" >
                                        Expenses </a>
                                    </li>
                                    <li class="<?php if($status == "Revenue"){echo 'active';}?>">
                                        <a href="/customer/accountReport/search?state=Revenue" >
                                        Revenue </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="table-container" style = "margin-top:20px;" >
                                                <div class="table-actions-wrapper">
                                                    <span>
                                                    </span>
                                                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                                                        <option value="">Select...</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="paid">Paid</option>
                                                        <option value="canceled">Canceled</option>
                                                    </select>
                                                    <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                                                </div>
                                                <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                                <thead>
                                                    <th width="5%">
                                                         Code
                                                    </th>
                                                    <th width="15%">
                                                         Name
                                                    </th>
                                                    <th width="15%">
                                                         Type
                                                    </th>
                                                    <th width="10%">
                                                         TaxRate
                                                    </th>
                                                    <th width="10%">
                                                         YTD
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    
                                                    <?php foreach($transactions as $transaction){?> 
                                                    <tr role="row" class="filter">
                                                        <td>
                                                            <?php echo $transaction->accountCode;?>
                                                        </td>
                                                        <td>
                                                            <?php echo $transaction->accountName;?>
                                                        </td>
                                                        <td>
                                                           <?php echo $transaction->accoutType;?>
                                                           
                                                        </td>
                                                        <td>
                                                            <?php echo $transaction->taxName.' '.$transaction->taxRate;?>
                                                        </td>
                                                        <td>
                                                             <a href="/customer/accountReport/view?account=<?php echo $transaction->accountId;?>" >
                                                                <?php echo $transaction->totalAmount;?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                          
                                                <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <div class="clearfix margin-bottom-20">
                            </div>
                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('backend/vwFooter'); ?>
 



   
   

</body>
<?php $this->load->view('backend/vwJs'); ?>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/modules/exporting.js"></script>
<?php $this->load->view('js/invoice/jsInvoice'); ?>
<script type = "text/javascript">
$( document ).ready(function() {
    $("#dueDate").datepicker(
        "option", "dateFormat","yy-mm-dd"
    );
    $("#dateInput").datepicker({
        changeYear:true,
        dateFormat: 'yy-mm-dd' ,
        yearRange: "2005:2015"
    });
});
</script>
</html>
