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
                        <h3 class="page-title">Transaction</h3>
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <span>Transaction</span>
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
                                    <div class = "col-sm-12">
                                        <div class="alert alert-danger">
                                          <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-sm-2">
                                        <div class="form-group">
                                            <label><strong>Transaction</strong></label>
                                        </div>
                                    </div>
                                    <div class="clearfix pull-right col-sm-4">
                                       <a type="button" class="btn btn-warning" onclick = "addNewLine('income')">Add Income</a>
                                       <a type="button" class="btn btn-warning" onclick = "addNewLine('expense')">Add Expense</a>
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
                                                     Date
                                                </th>
                                                <th width="15%">
                                                     Description
                                                </th>
                                                <th width="15%">
                                                     Amount
                                                </th>
                                                <th width="10%">
                                                     Category
                                                </th>
                                                
                                                <th width="10%">
                                                     Account
                                                </th>
                                               
                                                 <th width="10%">
                                                     
                                                </th>
                                            </thead>
                                            <tbody id = "invoiceTbody">
                                                <select class = "form-control" id = "incomeTransactionCategory">
                                                    <option></option>
                                                    <option value = "add">Add New Category</option>
                                                     <?php foreach ($incomeCategoryData as $key => $value) {?>
                                                        <?php 
                                                        if($preAccount != $value->categoryName ){?>
                                                            <option disabled style = "background:#e6e6e6;"><?php echo $value->categoryName;?></option>

                                                        <?php } ?>
                                                        <option value = "<?php echo $value->id;?>"><?php echo($value->name);?></option>
                                                        <?php 
                                                           $preAccount = $value->categoryName;
                                                        ?>
                                                    <?php } ?>    
                                                </select>
                                                <select class = "form-control" id = "expenseTransactionCategory">
                                                    <option></option>
                                                    <option value = "add">Add New Category</option>
                                                     <?php foreach ($expenseCategoryData as $key => $value) {?>
                                                        <?php 
                                                        if($preAccount != $value->categoryName ){?>
                                                            <option disabled style = "background:#e6e6e6;"><?php echo $value->categoryName;?></option>

                                                        <?php } ?>
                                                        <option value = "<?php echo $value->id;?>"><?php echo($value->name);?></option>
                                                        <?php 
                                                           $preAccount = $value->categoryName;
                                                        ?>
                                                    <?php } ?>    
                                                </select>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <input type = "hidden" id = "transactionType" value = ""/>
                                                        <input type = "hidden" id = "entryId" value = "" />
                                                        <input type="text" class="form-control form-filter input-sm" id="transactionDate" style = "width:100px;">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" id="transactionDescription">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" id="transactionAmount">
                                                    </td>
                                                   
                                                    <td id = "transCategory">
                                                        <select class = "form-control" id = "transactionCategory" onchange = "changeAccount(this)">
                                                            <option></option>
                                                            <option value = "add">Add New Category</option>
                                                            <?php foreach ($entryDataGroup as $key => $value) {?>
                                                                <?php 
                                                                if($preAccount != $value->categoryName ){?>
                                                                    <option disabled style = "background:#e6e6e6;"><?php echo $value->categoryName;?></option>

                                                                <?php } ?>
                                                                <option value = "<?php echo $value->id;?>"><?php echo($value->name);?></option>
                                                                <?php 
                                                                   $preAccount = $value->categoryName;
                                                                ?>
                                                            <?php } ?>    

                                                        </select>

                                                    </td>
                                                  
                                                    <td>
                                                         <select class = "form-control" id = "transactionAccount" onchange = "changeAccount(this)">
                                                            <option></option>
                                                            <option value = "add">Add New Account</option>
                                                            <?php foreach ($entryAccountGroup as $key => $value) {?>
                                                                <?php 
                                                                if($preAccount != $value->categoryName ){?>
                                                                    <option disabled style = "background:#e6e6e6;"><?php echo $value->categoryName;?></option>

                                                                <?php } ?>
                                                                <option value = "<?php echo $value->id;?>"><?php echo($value->accountName);?></option>
                                                                <?php 
                                                                   $preAccount = $value->categoryName;
                                                                ?>
                                                            <?php } ?>    

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <span class="glyphicon glyphicon-trash" onclick = "removeTr(this)" style = "cursor:pointer;"></span>
                                                        <span class="glyphicon glyphicon-check" onclick = "validateTr(this)" style = "cursor:pointer;"></span>

                                                    </td>
                                                </tr>
                                          
                                            <tbody>
                                            </tbody>
                                            </table>
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
                        <label>Purchase Account</label>
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
<?php $this->load->view('js/entry/jsEntry'); ?>
<script type = "text/javascript">
     $("input#transactionDate").eq(0).datepicker({
        changeYear:true,
        format: 'yyyy-mm-dd' ,
        yearRange: "2005:2015"
    });
</script>
</html>
