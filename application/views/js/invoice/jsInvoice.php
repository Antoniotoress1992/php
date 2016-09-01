<script>
var currentObj = {};
var subAmount = 0 ;
var totalAmount = 0 ; 
var itemQtyForInvoice = 0 ;
var itemUnitPrice = "";
var itemDisForInvoice = 0 ;
var itemTaxRateForInvoice = 0;
var itemInv = 0;

var subTax = 0 ;
var totalTax = 0 ;

function changeCurrency(){

    if ($("#currencySelect").val() == 'add') {
        $("#addCurrencyButton").click();
    } else {
           
    }
}
function changeItem(obj){
	currentObj = obj;
    if ($(obj).val() == 'add') {
        
        $("#itemCode").val('');
        $("#itemName").val('');
        $("#unitPrice").val('');
        $("#salesAccountTypeForItem").val('');
        $("#taxRateForItem").val('');
        $("#salesDescriptionForItem").val('');

        $("#trackThisItem").get(0).checked = false;
        $("#purchaseItem").get(0).checked = false;
        $("#sellItem").get(0).checked = false;
        $("#addItemModal").click();

    } else {
        var itemId = $("#item").val();
        $.ajax({
        url: "/customer/item/getItem",
        dataType : "json",
        type : "POST",
        data : { itemId   : itemId
                },
            success : function(data){
                $(currentObj).parent().parent().find("input#itemDescriptionForInvoice").val(data[0].description);
                $(currentObj).parent().parent().find("input#itemQtyForInvoice").val(1);
                $(currentObj).parent().parent().find("input#itemUnitPriceForInvoice").val(data[0].unitPrice);
                $(currentObj).parent().parent().find("input#itemDisForInvoice").val();
                $(currentObj).parent().parent().find("select#itemAccountForInvoice").val(data[0].accountId);
                $(currentObj).parent().parent().find("select#itemTaxRateForInvoice").val(data[0].taxRate);
                $(currentObj).parent().parent().find("input#itemAmountForInvoice").val(data[0].unitPrice);


                showAll();
            }
        });

    }
}

function changeAccount(obj){
	if($(obj).val() == 'add'){

    var salesAccountType = $("#salesAccountTypeForNew").val();
    var accountCode = $("#accountCode").val();
    var accountName = $("#accountName").val();
    var accountDescription = $("#accountDescription").val();
    var salesTax = $("#salesTax").val();
    var watchlist = $("#watchlist").get(0).checked;
    var expenseClaim = $("#expenseClaim").get(0).checked;
    var enablePayment = $("#enablePayment").get(0).checked;

		$("#addAccount").click();
	}else{

	}
}

function saveAccount(){

	
	var salesAccountType = $("#salesAccountTypeForNew").val();
    var accountCode = $("#accountCode").val();
    var accountName = $("#accountName").val();
    var accountDescription = $("#accountDescription").val();
    var salesTax = $("#salesTax").val();
    var watchlist = $("#watchlist").get(0).checked;
    var expenseClaim = $("#expenseClaim").get(0).checked;
    var enablePayment = $("#enablePayment").get(0).checked;
        
    $.ajax({
        url: "/customer/sales/saveAccount",
        dataType : "json",
        type : "POST",
        data : { salesAccountType 	: salesAccountType, 
        		 accountCode 		: accountCode , 
        		 accountName 		: accountName ,
        		 accountDescription : accountDescription ,
        		 salesTax			: salesTax ,
        		 watchlist			: watchlist ,
        		 expenseClaim		: expenseClaim ,
        		 enablePayment		: enablePayment
        		},
        success : function(data){
            
        }
    });
} 

function saveItem(){

    var itemCode = $("#itemCode").val();
    var itemName = $("#itemName").val();
    var unitPrice = $("#unitPrice").val();
    var salesAccountTypeForItem = $("#salesAccountTypeForItem").val();
    var taxRateForItem = $("#taxRateForItem").val();
    var salesDescriptionForItem = $("#salesDescriptionForItem").val();

    var trackThisItem = $("#trackThisItem").get(0).checked;
    var purchaseItem = $("#purchaseItem").get(0).checked;
    var sellItem = $("#sellItem").get(0).checked;
        
    $.ajax({
        url: "/customer/sales/saveItem",
        dataType : "json",
        type : "POST",
        data : { 
                 itemCode                   : itemCode, 
                 itemName                   : itemName , 
                 unitPrice                  : unitPrice ,
                 salesAccountTypeForItem    : salesAccountTypeForItem ,
                 taxRateForItem             : taxRateForItem ,
                 salesDescriptionForItem    : salesDescriptionForItem ,
                 trackThisItem              : trackThisItem ,
                 purchaseItem               : purchaseItem ,
                 sellItem                   : sellItem 
                },
        success : function(data){
            
        }
    });
}

function addNewLine(){
	var newObj = $("tr.filter").eq(0).clone();
    // this is for the initialization of the table
	for(var i = 0; i < newObj.find("td").length;i++){
		newObj.find("td").eq(i).find("input").val("");
	}
    $("#invoiceTbody").append(newObj);
}
function removeTr(obj){
    if($("#invoiceTbody").find("tr").length >1){
        $(obj).parent().parent().eq(0).remove();
    }else{
        
        $(obj).parent().parent().find("select#item").val('');
        
        $(obj).parent().parent().find("input#itemDescriptionForInvoice").val('');
        $(obj).parent().parent().find("input#itemQtyForInvoice").val('');
        $(obj).parent().parent().find("input#itemUnitPriceForInvoice").val('');
        $(obj).parent().parent().find("input#itemDisForInvoice").val('');
        $(obj).parent().parent().find("select#itemAccountForInvoice").val('');
        $(obj).parent().parent().find("select#itemTaxRateForInvoice").val('');
        $(obj).parent().parent().find("input#itemAmountForInvoice").val('');
    }
	
    
    showAll();
}

function changeQtyForInvoice(obj){
    

 

}
function changeQty(evt , obj){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }else{

        itemQtyForInvoice = $(obj).parent().parent().find("input#itemQtyForInvoice").val();
        itemUnitPrice = $(obj).parent().parent().find("input#itemUnitPriceForInvoice").val();
        itemTaxRateForInvoice = $(obj).parent().parent().find("select#itemTaxRateForInvoice").find(":selected").attr('price');
        itemDisForInvoice = $(obj).parent().parent().find("input#itemDisForInvoice").val();

        if(itemDisForInvoice == ""){itemDisForInvoice = 0;}
        if(itemTaxRateForInvoice == ""){itemTaxRateForInvoice = 0;}
        
        if($.isNumeric(itemQtyForInvoice)){
            subAmount = itemQtyForInvoice * itemUnitPrice * 1 *(100 - itemDisForInvoice * 1)/100 ;
            $(obj).parent().parent().find("input#itemAmountForInvoice").val(subAmount);
            
        }
        showAll();
        return true;    
    }
    
}

function showAll(){
    totalAmount = sumTotalAmount();
    $("#subTotalAmount").text('$' + totalAmount); 
    totalTax = displayTax();
    totalAmount = totalAmount*1 + totalTax * 1;
    $("#totalAmount").text(totalAmount);
}

function sumTotalAmount(){
    var rows = $("#datatable_invoices").find("tbody").find("tr");
    totalAmount = 0 ;
    var amount = 0;
    for(var i = 0 ; i < rows.length ; i++){
        amount = rows.eq(i).find("input#itemAmountForInvoice").val();
        if(amount == ""){amount = 0 ;}
        totalAmount = totalAmount*1 + amount * 1;

    }
    return totalAmount.toFixed(2);
}

function displayTax(){
    var rows = $("#datatable_invoices").find("tbody").find("tr");
   
    var taxInv = 0 ;
    totalTax = 0 ;
    while($("li#totalTaxDiv").length > 1){
        $("li#totalTaxDiv").eq(1).remove();
    }

    for(var i = 0 ; i < rows.length ; i++){
        taxInv = rows.eq(i).find("select#itemTaxRateForInvoice").find(":selected").attr('price');
        itemInv = rows.eq(i).find("select#item").val();
        if(taxInv*1 != 0 && itemInv != ""){
            var newTotalTax = $("li#totalTaxDiv").eq(0).clone();  
            newTotalTax.css("display" , "block");
            $("li#totalTaxDiv").eq($("li#totalTaxDiv").length -1).after(newTotalTax) ;

            itemQtyForInvoice = rows.eq(i).find("input#itemQtyForInvoice").val();
            itemUnitPrice = rows.eq(i).find("input#itemUnitPriceForInvoice").val();
            itemTaxRateForInvoice = rows.eq(i).find("select#itemTaxRateForInvoice").find(":selected").attr('price');
            itemDisForInvoice = rows.eq(i).find("input#itemDisForInvoice").val();

            subTax = itemQtyForInvoice * itemUnitPrice * 1 *(100 - itemDisForInvoice * 1)/100 * 1 * itemTaxRateForInvoice/100 ;

            newTotalTax.find("strong").eq(0).text("Total Tax " + taxInv + '%');
            newTotalTax.find("strong").eq(1).text("$" + subTax );

            totalTax  = totalTax + subTax * 1;

        }
        
    }
    return totalTax;
}

function saveInvoice(){
	
	var nameTo = $("#toData").val();
	var dateInput = $("#dateInput").val();
    var dueDate = $("#dueDate").val();
    var invoice = $("#invoice").val();
    var reference = $("#reference").val();
    var currencySelect = $("#currencySelect").val();
	
	if( nameTo == ""){$(".alert").text('Please input the contact data');$(".alert").css('display','block');return;}
	if( dateInput == ""){$(".alert").text('Please input the date');$(".alert").css('display','block');return;}
	if( dueDate == ""){$(".alert").text('Please input the due date');$(".alert").css('display','block');return;}
	if( invoice == ""){$(".alert").text('Please input the invoice data');$(".alert").css('display','block');return;}
	if( reference == ""){$(".alert").text('Please input the reference');$(".alert").css('display','block');return;}
	if( currencySelect == ""){$(".alert").text('Please select the currency data');$(".alert").css('display','block');return;}

    var invoiceContent = new Array();
   

    var rows = $("#datatable_invoices").find("tbody").find("tr");
    for(var i = 0 ; i < rows.length ; i++){
         var newInvoice = {};
         if(rows.eq(i).find("select#item").val() != ""){
            newInvoice.item = rows.eq(i).find("select#item").val();
            newInvoice.itemDescriptionForInvoice = rows.eq(i).find("input#itemDescriptionForInvoice").val();
            newInvoice.itemQtyForInvoice = rows.eq(i).find("input#itemQtyForInvoice").val();
            newInvoice.itemUnitPriceForInvoice = rows.eq(i).find("input#itemUnitPriceForInvoice").val();
            newInvoice.itemDisForInvoice = rows.eq(i).find("input#itemDisForInvoice").val();
            newInvoice.itemAccountForInvoice = rows.eq(i).find("select#itemAccountForInvoice").val();
            newInvoice.itemTaxRateForInvoice = rows.eq(i).find("select#itemTaxRateForInvoice").val();
            newInvoice.itemAmountForInvoice = rows.eq(i).find("input#itemAmountForInvoice").val();  
			invoiceContent[invoiceContent.length] = newInvoice;
         }
			
    }
	$.ajax({
        url: "/customer/invoice/saveInvoice",
        dataType : "json",
        type : "POST",
        data : { 
                 invoiceContent             : invoiceContent, 
                 nameTo                   	: nameTo , 
                 dateInput                  : dateInput ,
                 dueDate    				: dueDate ,
                 invoice             		: invoice ,
                 reference    				: reference ,
                 currencySelect             : currencySelect 
                },
        success : function(data){
            window.location.href = '/customer/invoice/edit?invoiceId='+ data.invoice;
        }
    });
    
    
}
function makeApprove(){
    var nameTo = $("#toData").val();
    var dateInput = $("#dateInput").val();
    var dueDate = $("#dueDate").val();
    var invoice = $("#invoice").val();
    var reference = $("#reference").val();
    var currencySelect = $("#currencySelect").val();
    
    if( nameTo == ""){$(".alert").text('Please input the contact data');$(".alert").css('display','block');return;}
    if( dateInput == ""){$(".alert").text('Please input the date');$(".alert").css('display','block');return;}
    if( dueDate == ""){$(".alert").text('Please input the due date');$(".alert").css('display','block');return;}
    if( invoice == ""){$(".alert").text('Please input the invoice data');$(".alert").css('display','block');return;}
    if( reference == ""){$(".alert").text('Please input the reference');$(".alert").css('display','block');return;}
    if( currencySelect == ""){$(".alert").text('Please select the currency data');$(".alert").css('display','block');return;}

    var invoiceContent = new Array();
    var type = "invoice";
    var coff = "1";

    var rows = $("#datatable_invoices").find("tbody").find("tr");
    for(var i = 0 ; i < rows.length ; i++){
         var newInvoice = {};
         if(rows.eq(i).find("select#item").val() != ""){
            newInvoice.item = rows.eq(i).find("select#item").val();
            newInvoice.itemDescriptionForInvoice = rows.eq(i).find("input#itemDescriptionForInvoice").val();
            newInvoice.itemQtyForInvoice = rows.eq(i).find("input#itemQtyForInvoice").val();
            newInvoice.itemUnitPriceForInvoice = rows.eq(i).find("input#itemUnitPriceForInvoice").val();
            newInvoice.itemDisForInvoice = rows.eq(i).find("input#itemDisForInvoice").val();
            newInvoice.itemAccountForInvoice = rows.eq(i).find("select#itemAccountForInvoice").val();
            newInvoice.itemTaxRateForInvoice = rows.eq(i).find("select#itemTaxRateForInvoice").val();
            newInvoice.itemAmountForInvoice = rows.eq(i).find("input#itemAmountForInvoice").val();  
            invoiceContent[invoiceContent.length] = newInvoice;
         }
            
    }
    $.ajax({
        url: "/customer/invoice/makeApprove",
        dataType : "json",
        type : "POST",
        data : { 
                 invoiceContent             : invoiceContent, 
                 nameTo                     : nameTo , 
                 dateInput                  : dateInput ,
                 dueDate                    : dueDate ,
                 invoice                    : invoice ,
                 reference                  : reference ,
                 currencySelect             : currencySelect ,
                 type                       : type ,
                 coff                       : coff  
                },
        success : function(data){
            window.location.href = '/customer/invoice/receivable?invoiceId='+ data.invoice;
        }
    });
}


function updateInvoice(invoiceId){

    var invoiceId = invoiceId ; 
    var nameTo = $("#toData").val();
    var dateInput = $("#dateInput").val();
    var dueDate = $("#dueDate").val();
    var invoice = $("#invoice").val();
    var reference = $("#reference").val();
    var currencySelect = $("#currencySelect").val();
    
    if( nameTo == ""){$(".alert").text('Please input the contact data');$(".alert").css('display','block');return;}
    if( dateInput == ""){$(".alert").text('Please input the date');$(".alert").css('display','block');return;}
    if( dueDate == ""){$(".alert").text('Please input the due date');$(".alert").css('display','block');return;}
    if( invoice == ""){$(".alert").text('Please input the invoice data');$(".alert").css('display','block');return;}
    if( reference == ""){$(".alert").text('Please input the reference');$(".alert").css('display','block');return;}
    if( currencySelect == ""){$(".alert").text('Please select the currency data');$(".alert").css('display','block');return;}

    var invoiceContent = new Array();
   

    var rows = $("#datatable_invoices").find("tbody").find("tr");
    for(var i = 0 ; i < rows.length ; i++){
         var newInvoice = {};
         if(rows.eq(i).find("select#item").val() != ""){
            newInvoice.invoiceContentId = rows.eq(i).find("input#invoiceContentId").val();
            newInvoice.item = rows.eq(i).find("select#item").val();
            newInvoice.itemDescriptionForInvoice = rows.eq(i).find("input#itemDescriptionForInvoice").val();
            newInvoice.itemQtyForInvoice = rows.eq(i).find("input#itemQtyForInvoice").val();
            newInvoice.itemUnitPriceForInvoice = rows.eq(i).find("input#itemUnitPriceForInvoice").val();
            newInvoice.itemDisForInvoice = rows.eq(i).find("input#itemDisForInvoice").val();
            newInvoice.itemAccountForInvoice = rows.eq(i).find("select#itemAccountForInvoice").val();
            newInvoice.itemTaxRateForInvoice = rows.eq(i).find("select#itemTaxRateForInvoice").val();
            newInvoice.itemAmountForInvoice = rows.eq(i).find("input#itemAmountForInvoice").val();  
            invoiceContent[invoiceContent.length] = newInvoice;
         }
            
    }
    $.ajax({
        url: "/customer/invoice/updateInvoice",
        dataType : "json",
        type : "POST",
        data : { 
                 invoiceContent             : invoiceContent, 
                 invoiceId                  : invoiceId ,
                 nameTo                     : nameTo , 
                 dateInput                  : dateInput ,
                 dueDate                    : dueDate ,
                 invoice                    : invoice ,
                 reference                  : reference ,
                 currencySelect             : currencySelect 
                },
        success : function(data){
            window.location.href = '/customer/invoice/edit?invoiceId='+ invoiceId;
        }
    });
}

function savePayment(invoiceId){
	var amountPaid = $("#amountPaid").val();
	var datePaid = $("#datePaid").val();
	var paidTo = $("#paidTo").val();
	var paidReference = $("#paidReference").val();

	$.ajax({
        url: "/customer/invoice/savePayment",
        dataType : "json",
        type : "POST",
        data : { 
                 invoiceId             		: invoiceId, 
                 amountPaid                 : amountPaid ,
                 datePaid                   : datePaid , 
                 paidTo                  	: paidTo ,
                 paidReference              : paidReference
                },
        success : function(data){
           window.location.href = '/customer/invoice/search?state=authorized';
        }
    });
}



</script>