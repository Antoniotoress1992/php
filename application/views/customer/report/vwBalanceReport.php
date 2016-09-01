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
                        <h3 class="page-title">Balance Sheet</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Balance Sheet</span>
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
                                            <label>Report Date</label>
                                            <div class="input-icon">
                                                <?php $dateNow = date("Y-m-d");?>
                                                <input type="text" class="form-control" id = "reportDate" value = "<?php echo $dateNow;?>">
                                            </div>
                                        </div>
                                    </div>
                                 
                                    <div class = "col-sm-12">
                                           <div class="table-container" style = "margin-top:20px;" >
                                            <label>Assets</label>
                                            <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                                <thead>
                                                    <th width="5%">
                                                         Account
                                                    </th>
                                                     <th style = "text-align: right; ">
                                                         Balance
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    <?php foreach($assetAccounts as $assetAccount){?>
                                                    <tr role="row" class="filter">
                                                        
                                                        <td>
                                                            <?php echo $assetAccount->accountName;?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <a href = "/customer/accountReport/viewBalance?account=<?php echo $assetAccount->accountId;?>"><?php echo $assetAccount->totalAmount;?></a>
                                                        </td>
                                                  
                                                    </tr>
                                                    <?php } ?>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-container" style = "margin-top:20px;" >
                                            <label>Equity</label>
                                            <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                                <thead>
                                                    <th width="5%">
                                                         Account
                                                    </th>
                                                   
                                                    <th style = "text-align: right; ">
                                                         Balance
                                                    </th>
                                                </thead>
                                                <tbody id = "invoiceTbody">
                                                    <?php foreach($equityAccounts as $equityAccounts){?>
                                                    <tr role="row" class="filter">
                                                        
                                                        <td>
                                                            <?php echo $equityAccounts->accountName;?>
                                                        </td>
                                                        <td style = "text-align: right; ">
                                                           <a href = "/customer/accountReport/viewBalance?account=<?php echo $equityAccounts->accountId;?>"><?php echo $equityAccounts->totalAmount;?></a>
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

    //$('#dateInput').datepicker("option","dateFormat","yy-mm-dd");
    $("#reportDate").datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });
    
});
</script>
</html>
