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
                        <h3 class="page-title">Income Statement</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Income Statement</span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sportlet box blue">
                            
                            <div class="portlet-body">
                                <div class = "row">
                                     <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>From</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "toData" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>To</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "dateInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-12">
                                           <div class="table-container" style = "margin-top:20px;" >
                                            <label>Revenue</label>
                                            <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                                <thead>
                                                    <th width="5%">
                                                         Account
                                                    </th>
                                                   
                                                     <th width="10%">
                                                         
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    <?php foreach($incomeTransactions as $incomeTransaction){?>
                                                    <tr role="row" class="filter">
                                                        <?php 
                                                            $firstDate = $_GET['period_start'];
                                                            $lastDate = $_GET['period_end'];
                                                            
                                                        ?>
                                                        <td>
                                                            <?php echo $incomeTransaction->accountName;?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <a href = "/customer/accountReport/viewEntry?account=<?php echo $incomeTransaction->accountId;?>&period_start=<?php echo $firstDate;?>&period_end=<?php echo $lastDate;?>&type=income"><?php echo $incomeTransaction->totalAmount;?></a>
                                                        </td>
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-container" style = "margin-top:20px;" >
                                            <label>Expense</label>
                                            <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                                <thead>
                                                    <th width="5%">
                                                         Account
                                                    </th>
                                                   
                                                     <th width="10%">
                                                         
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    <?php foreach($expenseTransactions as $expenseTransaction){?>
                                                    <tr role="row" class="filter">
                                                        
                                                        <td>
                                                            <?php echo $expenseTransaction->accountName;?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                            <a href = "/customer/accountReport/viewEntry?account=<?php echo $expenseTransaction->accountId;?>&period_start=<?php echo $firstDate;?>&period_end=<?php echo $lastDate;?>&type=expense"><?php echo $expenseTransaction->totalAmount;?></a>
                                                        </td>
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    $("#toData").datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });

    $("#toData").val("<?php echo $_GET['period_start']?>");
    //$('#dateInput').datepicker("option","dateFormat","yy-mm-dd");
    $("#dateInput").datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });
    $("#dateInput").val("<?php echo $_GET['period_end']?>");
});
</script>
</html>
