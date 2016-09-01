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
                        <h3 class="page-title">Dashboard</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Dashboard</span>
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
                                    <i class="fa fa-pencil-square-o"></i> Dashboard
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class = "row">
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>To</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "toData">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "dateInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "dueDate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Invoice #</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "invoice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Reference</label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id = "reference">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-sm-4">
                                        <select class="form-control" id = "currencySelect" onchange="changeCurrency()"> 
                                          <option>SGD Singapore Dollar</option>
                                          <option value="add">
                                            + Add Currency
                                          </option>  
                                        </select>
                                    </div>
                                </div>

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
                                                     Item
                                                </th>
                                                <th width="15%">
                                                     Description
                                                </th>
                                                <th width="15%">
                                                     Qty
                                                </th>
                                                <th width="10%">
                                                     Unit Price
                                                </th>
                                                <th width="10%">
                                                     Disc %
                                                </th>
                                                <th width="10%">
                                                     Account
                                                </th>
                                                <th width="10%">
                                                     Tax Rate
                                                </th>
                                                <th width="10%">
                                                     Amount
                                                </th>
                                                 <th width="10%">
                                                     
                                                </th>
                                            </thead>
                                            <tbody id = "invoiceTbody">
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_no">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to">
                                                    </td>
                                                    <td>
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </td>
                                                </tr>
                                          
                                            <tbody>
                                            </tbody>
                                            </table>
                                        </div>
                                        <div class = "row">
                                           <div class = "col-sm-4">
                                             <button type="button" class="btn default" onclick = "addNewLine()">Add a new line</button>
                                           </div> 
                                        </div>
                                        <div class = "row">
                                            <div class="col-xs-8 invoice-block pull-right text-right">
                                                <ul class="list-unstyled amounts">
                                                    <li>
                                                        <strong>Sub - Total amount:</strong> $100
                                                    </li>
                                                    <li>
                                                        <strong>Total Tax 7.00%:</strong> 7.00
                                                    </li>
                                                    <li>
                                                        <strong>TOTAL:</strong> 107.00
                                                    </li>
                                                    
                                                </ul>
                                                <br>
                                                
                                            </div>
                                        </div>
                                        <div class = "row">
                                            <div class = "col-sm-4">
                                                <button type="button" class="btn btn-primary">Save</button>
                                            </div>
                                            <div class = "col-sm-4 text-right pull-right">
                                                <button type="button" class="btn green">Approve</button>
                                                <button type="button" class="btn grey-cascade">Cancle</button>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('backend/vwFooter'); ?>
    <a class="btn default" id = "addCurrencyButton" data-toggle="modal" href="#addCurrency" style = "display:none;">addCurrency</a>
    <div id="addCurrency" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add Currency</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Select Input</label>
                    <select class="form-control" id = "currencySelect"> 
                      <option>Select one...</option>  
                      <option>SGD</option>
                    </select>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-8">
                    Automatic Foreign Exchange Rates provided by Accounting Software
                </div>
                <div class="col-md-4">
                    Latest SGD Rate
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Cancle</button>
            <button type="button" class="btn blue">Add Currency</button>
        </div>
    </div>
</body>
<?php $this->load->view('backend/vwJs'); ?>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/modules/exporting.js"></script>
<?php $this->load->view('js/invoice/jsInvoice'); ?>
<script type = "text/javascript">
$( document ).ready(function() {
    $("#dueDate").datepicker({
        changeYear:true,
        yearRange: "2005:2015"
    });
    $("#dateInput").datepicker({
        changeYear:true,
        yearRange: "2005:2015"
    });
});
</script>
</html>
