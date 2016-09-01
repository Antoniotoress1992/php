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
                                <span>Invoice</span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php 
                    $nameTo = $invoiceInv->contactName;                
                    $date = $invoiceInv->date;                
                    $dueDate = $invoiceInv->dueDate;                
                    $invoiceNumber = $invoiceInv->invoiceNumber;                
                    $reference = $invoiceInv->reference;                
                    $currencyId = $invoiceInv->currencyId;                
                ?>          
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-pencil-square-o"></i> Awaiting Payment
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class = "row">
                                    <div class = "col-sm-12">
                                        <div class="alert alert-danger">
                                          <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>To</label>
                                            <p><?php echo $nameTo;?></p>
                                               
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <p><?php echo $date;?></p>
                                            
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Due Date</label>
											<p><?php echo $dueDate;?></p>
                                            
                                        </div>
                                    </div>
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label>Invoice #</label>
											<p><?php echo $invoiceNumber;?></p>
                                            
                                        </div>
                                    </div>
                                    <div class = "col-sm-2 pull-right">
										<a type="button" class="btn blue" href = "/customer/invoice/printPdf">Print Pdf</a>
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
                                                 
                                            </thead>
                                            <tbody id = "invoiceTbody">
                                                <?php $totalAmount = 0 ;?>
                                                <?php foreach($invoiceContents as $invoiceContent){?> 
                                                <tr role="row" class="filter">
                                                    <?php 
                                                        $itemId = $invoiceContent->itemId;
                                                        $description = $invoiceContent->description;  
                                                        $qty = $invoiceContent->qty;
                                                        $unitPrice = $invoiceContent->unitPrice;
                                                        $discount = $invoiceContent->discount;
                                                        $accountId = $invoiceContent->accountId;
                                                        $taxRateId = $invoiceContent->taxRateId;
                                                        $amount = $invoiceContent->amount;

                                                        $totalAmount = $totalAmount + $amount * 1;
                                                    ?>
                                                    <td>
                                                        <input type = "hidden" id = "invoiceContentId" value = "<?php echo $invoiceContent->id;?>"/>
                                                        <?php echo $invoiceContent->itemName;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $description;?>
                                                    </td>
                                                    <td>
                                                       
														<?php echo $qty; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $unitPrice;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $discount;?>
                                                    </td>
                                                    <td>
														<?php echo $invoiceContent->accountName;?>
                                                     
                                                    </td>
                                                    <td>
														<?php echo $invoiceContent->taxName;?>
                                                       
                                                    </td>
                                                    <td>
														<?php echo $amount;?>
                                                    </td>
                                                   
                                                </tr>
                                                <?php } ?>
                                            <tbody>
                                            </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class = "row">
                                            <div class="col-xs-4 invoice-block pull-right text-right">
                                                <ul class="list-unstyled amounts">
                                                    <li>
                                                        <strong>Sub - Total amount:</strong> <strong id = "subTotalAmount">$<?php echo $totalAmount;?></strong>
                                                    </li>
                                                    <?php $subTax = 0 ; ?>
                                                    <li id = "totalTaxDiv" style = "display:none;">
                                                        <strong >Total Tax 7.00%:</strong> <strong id = "totalTax">7.00</strong>
                                                    </li>
                                                    <?php foreach($invoiceContents as $invoiceContent){?>
                                                    <?php if($invoiceContent->taxRate*1 != 0){?> 
                                                    <li id = "totalTaxDiv" style = "">
                                                        <strong >Total Tax <?php echo $invoiceContent->taxRate;?>%:</strong> <strong id = "totalTax"><?php echo $invoiceContent->amount*$invoiceContent->taxRate/100;$subTax = $invoiceContent->amount*$invoiceContent->taxRate/100 + $subTax;?></strong>
                                                    </li>
                                                    <?php } }?>
                                                    <hr>
                                                    <li>
                                                        <strong>TOTAL:</strong> <strong id = "totalAmount"><?php echo $subTax + $totalAmount; ?></strong>
                                                    </li>
                                                    <hr>
                                                    
                                                </ul>
                                                <br>
                                                
                                            </div>
                                        </div>
                            </div>
                        </div>
				,
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
                      <option>SGD Singapore Dollar</option>
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

    <a class="btn default" id = "addTaxButton" data-toggle="modal" href="#addTax" style = "display:none;">addCurrency</a>
    <div id="addTax" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add New Tax Rate</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Tax Rate Display Name</label>
                    <p>The name as you would like it to appear in the accounting software</p>
                    <input type = "text" class = "form-control" id = "newTaxRateName" />
                </div>
            </div>
            <div class = "row">
                <div class = "col-sm-12">
                    <label>Tax Components</label>
                </div>
                <div class="col-md-6">
                    <input type = "text" class = "form-control" id = "newTaxComponent" />
                </div>
                <div class="col-md-6">
                    <input type = "text" class = "form-control" id = "newTaxComponentRate" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Cancle</button>
            <button type="button" class="btn blue" onclick = "saveRate()">Save</button>
        </div>
    </div>


     <a class="btn default" id = "addItemModal" data-toggle="modal" href="#addItem" style = "display:none;">addCurrency</a>
    <div id="addItem" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">New Item</h4>
        </div>
        <div class="modal-body">
            <div class = "row">
                <div class = "col-sm-3">
                     <div class="form-group">
                        <label>Item Code</label>
                        <div class="input-icon">
                            <input type="text" class="form-control" id = "itemCode">
                        </div>
                    </div>
                </div>
                <div class = "col-sm-6">
                     <div class="form-group">
                        <label>Item Name</label>
                        <div class="input-icon">
                            <input type="text" class="form-control" id = "itemName">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class = "row">
                <div class = "col-sm-3">
                    <input type = "checkbox" id = "trackThisItem">I track this item
                </div>
                <div class = "col-sm-6">
                    This treats your item as a tracked inventory asset. Xero will record the quantity on hand and prevent you selling below a quantity of zero.
                    Note: this option can not be changed once you have recorded transactions against the item.
                    Find out if tracked inventory is right for you.
                </div>
            </div>
            <hr>
            <div class = "row">
                <div class = "col-sm-8">
                    <input type = "checkbox" id = "purchaseItem" >I purchase this item
                </div>
            </div>
            <hr>
            <div class = "row">
                <div class  ="col-sm-3">
                    <input type = "checkbox" id = "sellItem">I sell this item 
                </div>
                <div class = "col-sm-3">
                    <div class = "form-group">
                        <label>Unit Price</label>
                        <div class = "input-icon">
                            <input type = "text" class = "form-control" id = "unitPrice" />
                        </div>
                    </div>
                </div>
                <div class = "col-sm-3">
                    <div class = "form-group">
                        <label>Sales Account</label>
                        <select class = "form-control" id = "salesAccountTypeForItem" onchange = "changeAccount(this)">
                            <option></option>
                            <option value = "add">Add New Account</option>
                            <?php foreach($accounts as $account){?>
                                <option value = "<?php echo $account->id;?>"><?php echo $account->accountName;?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class = "col-sm-3">
                    <div class = "form-group">
                        <label>Tax Rate</label>
                        <select class = "form-control" id = "taxRateForItem" >
                            <option></option>
                            <?php foreach($taxes as $tax){?>
                            <option value = "<?php echo $tax->id;?>"><?php echo $tax->name.' '.$tax->taxRate;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class = "row">
                <div class = "col-sm-3">
                </div>
                <div class = "col-sm-9">
                    <div class = "form-group">
                        <label style = "width:100%;">Sales Description (for my customers)</label>
                        <textarea id = "salesDescriptionForItem" style = "width:100%;height:200px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Cancle</button>
            <button type="button" class="btn blue" onclick = "saveItem()">Save</button>
        </div>
    </div>
    <a class="btn default" id = "addAccount" data-toggle="modal" href="#addAccountModal" style = "display:none;">addAccount</a>
    <div id="addAccountModal" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add New Account</h4>
        </div>
        <div class="modal-body">
            <div class = "row">
                <div class = "col-sm-6">
                    <div class = "col-sm-6">
                        <div class = "form-group">
                            <label>Account Type</label>
                            <?php $preAccount = "" ; ?>
                            <select class = "form-control" id = "salesAccountTypeForNew" onchange = "changeAccount(this)">
                            <option value = ""></option>
                            <?php foreach ($accountTypes as $key => $value) {?>
                                    <?php 
                                    if($preAccount != $value->categoryName ){?>
                                        <option disabled style = "background:#e6e6e6;"><?php echo $value->categoryName;?></option>

                                    <?php } ?>
                                    <option value = "<?php echo $value->accountTypeId;?>"><?php echo($value->accountTypeName);?></option>
                                    <?php 
                                       $preAccount = $value->categoryName;
                                    ?>
                            <?php } ?>    
                            </select>
                            
                        </div>
                    </div>
                    <div class = "col-sm-12">
                        <div class = "form-group">
                            <label>Code</label>
                            <p>A unique code/number for this account (limited to 10 characters)</p>
                            <div class = "input-icon">
                                <input type = "text" class = "form-control" id = "accountCode" />
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-12">
                        <div class = "form-group">
                            <label>Name</label>
                            <p>A short title for this account (limited to 150 characters)</p>
                            <div class = "input-icon">
                                <input type = "text" class = "form-control" id = "accountName" />
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-12">
                        <div class = "form-group">
                            <label>Description(optional)</label>
                            <p>A description of how this account should be used</p>
                            <div class = "input-icon">
                                <input type = "text" class = "form-control" id = "accountDescription" />
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-10">
                        <div class = "form-group">
                            <label>Tax</label>
                            <p>The default tax setting for this account</p>
                            <select class = "form-control" id = "salesTax" onchange = "changeAccount(this)">
                            <option></option>
                            <?php foreach($taxes as $key=>$value){?>
                                <option value = "<?php echo $value->id;?>"><?php echo $value->name.' '.$value->taxRate;?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class  ="col-sm-12">
                        <input type = "checkbox" id = "watchlist" />Show on Dashboard Watchlist<br>
                        <input type = "checkbox" id = "expenseClaim" />Show in Expense Claims<br>
                        <input type = "checkbox" id = "enablePayment" />Enable payments to this account
                    </div>
                </div>
                <div class = "col-sm-6">
                    <img id = "accountHelp" src = "<?php echo HTTP_IMAGES_PATH.'account-help.png'?>" style ="width:100%;height:400px;"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Cancle</button>
            <button type="button" class="btn blue" onclick = "saveAccount()">Save</button>
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
    $("#dueDate").datepicker(
        "option", "dateFormat","yy-mm-dd"
    );
    $("#datePaid").datepicker({
        changeYear:true,
        dateFormat: 'yy-mm-dd' ,
        yearRange: "2005:2015"
    });
});
</script>
</html>
