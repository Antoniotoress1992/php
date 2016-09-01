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
                        <h3 class="page-title">Invoice</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Search</span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-pencil-square-o"></i> Awaiting Payment
                                </div>
                            </div>
                            <div class="portlet-body">
							<ul class="nav nav-tabs">
								<?php $status = $_GET['state'];?>
								<li class="<?php if($status == "All"){echo 'active';}?>">
									<a href="/customer/invoice/search?state=All" >
									All </a>
								</li>
								<li class="<?php if($status == "authorized"){echo 'active';}?>">
									<a href="/customer/invoice/search?state=authorized" >
									Awaiting Payment </a>
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
                                                     Number
                                                </th>
                                                <th width="15%">
                                                     Ref
                                                </th>
                                                <th width="15%">
                                                     To
                                                </th>
                                                <th width="10%">
                                                     Date
                                                </th>
                                                <th width="10%">
                                                     Due Date
                                                </th>
                                                <th width="10%">
                                                     Paid 
                                                </th>
												
                                                <th width="10%">
                                                     Status
                                                </th>
                                               
                                                 
                                            </thead>
                                            <tbody id = "invoiceTbody">
												
												<?php if($status == "authorized"){?>
                                                <?php foreach($invoices as $invoice){?> 
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <?php echo $invoice->invoiceNumber;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice->paidReference;?>
                                                    </td>
                                                    <td>
                                                       
														<?php echo $invoice->paidTo; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice->datePaid;?>
                                                    </td>
													<td>
                                                        <?php echo $invoice->dueDate;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice->amountPaid;?>
                                                    </td>
                                                    <td>
														<?php echo $invoice->state;?>
                                                     
                                                    </td>
                                                   
                                                </tr>
                                                <?php } ?>
												<?php } ?>
												<?php if($status == "All"){?>
												<?php foreach($invoices as $invoice){?> 
												<tr role="row" class="filter">
													<td>
                                                        <?php echo $invoice->invoiceNumber;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice->reference;?>
                                                    </td>
                                                    <td>
                                                       
														<?php echo $invoice->nameTo; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $invoice->date;?>
                                                    </td>
													<td>
                                                        <?php echo $invoice->dueDate;?>
                                                    </td>
                                                    <td>
                                                       
                                                    </td>
                                                    <td>
														<?php echo $invoice->state;?>
                                                     
                                                    </td>
												</tr>
												<?php }}?>
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
