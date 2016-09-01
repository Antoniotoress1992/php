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
                        <h3 class="page-title">Trial Balance</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Trial Balance</span>
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
                                     <form method = "get" action = "/customer/accountReport/trial">
                                         <div class = "col-sm-2">
                                            <div class="form-group">
                                                <label>Report Date</label>

                                                <div class="input-icon">
                                                    <?php $date = isset($_GET['date'])?$_GET['date']:"";?>
                                                    <input type="text" class="form-control" name = "date" id = "reportDate" value = "<?php echo $date;?>">
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
                                                <thead>
                                                    <th width="30%">
                                                         Account
                                                    </th>
                                                    <th width="30%">
                                                         Debit
                                                    </th>
                                                     <th width = "40%" style = "text-align: right; ">
                                                         Balance
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    <?php $debitAmount = 0 ; $creditAmount = 0;?>
                                                    <?php foreach($accountData as $value){?>
                                                    <tr role="row" class="filter">
                                                        
                                                         <td>
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->accountName;?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                echo $value->debitAmount;
                                                                $debitAmount =  $debitAmount + intval($value->debitAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <?php 
                                                                echo $value->creditAmount;
                                                                $creditAmount =  $creditAmount + intval($value->creditAmount);
                                                            ?>
                                                        </td>
                                                  
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                    <?php foreach($categoryData as $value){?>
                                                    <tr role="row" class="filter">
                                                        
                                                        <td>
                                                            <a href = "/customer/accountReport/viewTrial?account=<?php echo $value->accountId;?>">
                                                                <?php echo $value->name;?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                echo $value->debitAmount;
                                                                $debitAmount =  $debitAmount + intval($value->debitAmount);
                                                            ?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                            <?php 
                                                                echo $value->creditAmount;
                                                                $creditAmount =  $creditAmount + intval($value->creditAmount);
                                                            ?>
                                                        </td>
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                    <tr role="row" class="filter">
                                                        <td>Total</td>
                                                        <td><?php echo $debitAmount;?></td>
                                                        <td style = "text-align: right; "><?php echo $creditAmount;?></td></td>
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
    
});
</script>
</html>
