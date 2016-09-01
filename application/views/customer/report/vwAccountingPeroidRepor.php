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
                        <h3 class="page-title">Accounting Period</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Accounting Period</span>
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
                                     <form method = "get" action = "/customer/accountReport/accountingPeriod">
                                         <?php $startDate = isset($_GET['period_start'])?$_GET['period_start']:"";?>
                                         <?php $lastDate = isset($_GET['period_end'])?$_GET['period_end']:"";?>
                                         <div class = "col-sm-2">
                                            <div class="form-group">
                                                <label>From</label>

                                                <div class="input-icon">

                                                    <input type="text" class="form-control" name = "period_start" id = "reportDate" value = "<?php echo $startDate;?>">
                                                </div>
                                            </div>
                                        </div>
                                         <div class = "col-sm-2">
                                            <div class="form-group">
                                                <label>To</label>

                                                <div class="input-icon">

                                                    <input type="text" class="form-control" name = "period_end" id = "toDate" value = "<?php echo $lastDate;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix pull-right col-sm-4">

                                           <button type="submit" class="btn btn-warning" >Update</button>
                                          
                                        </div>
                                    </form>
                                    <div class = "col-sm-12">
                                           <div class="table-container" style = "margin-top:20px;" >
                                            
                                            <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                             
                                                <tbody id = "invoiceTbody">
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td colspan="2">BEG. BALANCE</td>
                                                        <td colspan="2">THIS PERIOD</td>
                                                        <td colspan="2">CURRENT BAL.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account</td>
                                                        <td>Account Name</td>
                                                        <td>Debit</td>
                                                        <td>Credit</td>
                                                        <td>Debit</td>
                                                        <td>Credit</td>
                                                        <td>Debit</td>
                                                        <td>Credit</td>
                                                    </tr>    

                                                    <?php 
                                                        $debitRegAmount = 0 ; $creditRegAmount = 0;
                                                        $debitDueAmount = 0 ; $creditDueAmount = 0;
                                                        $debitCurrentAmount = 0 ; $creditCurrentAmount = 0;
                                                    ?>
                                                    <?php foreach($accountData as $value){?>
                                                    <tr role="row" class="filter">
                                                        <td >
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->accountId;?>
                                                            </a>
                                                        </td>
                                                        
                                                         <td >
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->accountName;?>
                                                            </a>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitRegAmount;
                                                                $debitRegAmount =  $debitRegAmount + intval($value->debitRegAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditRegAmount;
                                                                $creditRegAmount =  $creditRegAmount + intval($value->creditRegAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitDueAmount;
                                                                $debitDueAmount =  $debitDueAmount + intval($value->debitDueAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditDueAmount;
                                                                $creditDueAmount =  $creditDueAmount + intval($value->creditDueAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitCurrentAmount;
                                                                $debitCurrentAmount =  $debitCurrentAmount + intval($value->debitCurrentAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditCurrentAmount;
                                                                $creditCurrentAmount =  $creditCurrentAmount + intval($value->creditCurrentAmount);
                                                            ?>
                                                        </td>
                                                  
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                    <?php foreach($categoryData as $value){?>
                                                    <tr role="row" class="filter">
                                                        <td >
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->accountId;?>
                                                            </a>
                                                        </td>
                                                        
                                                         <td >
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->accountName;?>
                                                            </a>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitRegAmount;
                                                                $debitRegAmount =  $debitRegAmount + intval($value->debitRegAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditRegAmount;
                                                                $creditRegAmount =  $creditRegAmount + intval($value->creditRegAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitDueAmount;
                                                                $debitDueAmount =  $debitDueAmount + intval($value->debitDueAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditDueAmount;
                                                                $creditDueAmount =  $creditDueAmount + intval($value->creditDueAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right;">
                                                            <?php 
                                                                echo $value->debitCurrentAmount;
                                                                $debitCurrentAmount =  $debitCurrentAmount + intval($value->debitCurrentAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditCurrentAmount;
                                                                $creditCurrentAmount =  $creditCurrentAmount + intval($value->creditCurrentAmount);
                                                            ?>
                                                        </td>
                                                  
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                    <tr role="row" class="filter">
                                                        <td colspan = "2">Total</td>
                                                        <td style = "text-align: right; "><?php echo $debitRegAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $creditRegAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $debitDueAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $creditDueAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $debitCurrentAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $creditCurrentAmount;?></td>

                                                    </tr>
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

    //$('#dateInput').datepicker("option","dateFormat","yy-mm-dd");
    $("#reportDate").datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });
     $("#toDate").datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });
    
});
</script>
</html>
