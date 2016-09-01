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
        <?php $account = $_GET['account'];?>  
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-title">Chart of Account</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Account: <?php echo $account;?></span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                             
                <div class="row">
                    <div class="ocl-sm-12">
                        <div class="sportlet box blue">
                            
                            <div class="portlet-body">
                               
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
                                                         Date
                                                    </th>
                                                    <th width="15%">
                                                         Transaction
                                                    </th>
                                                    <th width="15%">
                                                         Debit
                                                    </th>
                                                    <th width="10%">
                                                         Credit
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    
                                                    <?php foreach($transactions as $transaction){?> 
                                                    <tr role="row" class="filter">
                                                        <td>
                                                            <?php echo $transaction->transactionDate;?>
                                                        </td>

                                                        <td>
                                                            <a href = "/customer/accountReport/viewTrans?id=<?php echo $transaction->transactionId;?>"> 
                                                                <?php echo $transaction->transactionName;?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                        <?php if($transaction->transCoff == -1){?> 
                                                               <?php echo $transaction->amount;?>
                                                        <?php } ?>  
                                                        </td>
                                                        <td>
                                                        <?php if($transaction->transCoff == 1){?> 
                                                               <?php echo $transaction->amount;?>
                                                        <?php } ?>     
                                                           
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
