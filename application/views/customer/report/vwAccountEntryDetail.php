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
        <?php $account = $_GET['account'];
              $firstDate = $_GET['period_start'];
              $lastDate = $_GET['period_end'];  
              $type = $_GET['type'];
        ?>  
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
               <div class = "row">
                    <div class = "col-sm-2">
                        <div class="form-group">
                            <label>To</label>
                              <select class="form-control" id = "accountSelect"> 
                                <option value = ""></option>
                                <option value="add">
                                    
                                </option>  
                                <?php foreach($currencies as $currency){?>
                                <option value = "<?php echo $currency->id;?>"><?php echo $currency->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class = "col-sm-2">
                        <div class="form-group">
                            <label>From</label>
                            <div class="input-icon">
                                <input type="text" class="form-control" id = "fromDate" value = "<?php echo $firstDate;?>">
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-2">
                        <div class="form-group">
                            <label>To</label>
                            <div class="input-icon">
                                <input type="text" class="form-control" id = "toDate" value = "<?php echo $lastDate;?>"> 
                            </div>
                        </div>
                    </div>
                          
                </div>              
                <div class="row">
                    <div class="col-sm-12">
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
                                                    <?php $type = $_GET['type'];
                                                        $debtAmount = 0;
                                                        $creditAmount = 0;
                                                    ?>
                                                    <?php foreach($entries as $entry){?> 
                                                    <tr role="row" class="filter">
                                                        <td>
                                                            <?php echo $entry->date;?>
                                                        </td>

                                                        <td>
                                                           <?php echo $entry->description;?>
                                                        </td>
                                                        <td>
                                                            <?php if($type == 'income'){?>
                                                                0.00 
                                                            <?php }else{?>
                                                                <?php echo $entry->amount;
                                                                    $debtAmount = $debtAmount + intval($entry->amount);
                                                                ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($type == 'income'){?>
                                                                <?php echo $entry->amount;
                                                                    $creditAmount = $creditAmount + intval($entry->amount);
                                                                ?>
                                                            <?php }else{?>
                                                                0.00
                                                            <?php } ?>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php } ?>
                                                    <tr role="row" class="filter">
                                                        <td>Total</td>
                                                        <td></td>
                                                        <td><?php echo $debtAmount;?></td>
                                                        <td><?php echo $creditAmount;?></td>
                                                    </tr>
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
