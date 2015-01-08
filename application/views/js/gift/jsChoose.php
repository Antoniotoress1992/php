<script>

function bs_alert(msg) {
    $("#msgAlert").find("div.modal-body").html('<h4>' + msg + '</h4>');
    $("#msgAlert").modal();
}

$(document).ready(function() {
    $("input#js-checkbox-item").click(function() {
        var objList = $("input#js-checkbox-item");
        var total = 0;
        for (var i = 0; i < objList.size(); i++) {
            if (objList.eq(i).prop('checked')) {
                total += objList.eq(i).parents("tr").eq(0).find("td").last().text() * 1;
            }
        }
        var txt = ($("#js-avaiable").val() * 100 - total * 100) / 100;
        $("#b-amount-avaiable").text(txt.toFixed(1));
    });

    $("button#js-btn-buy").click(function() {
        if ($("#b-amount-avaiable").text() * 1 < 0) {
            bs_alert("Selected total gift price is over than avaiable");
            return false;
        }
        var objList = $("input#js-checkbox-item");
        var strIds = "";
        for (var i = 0; i < objList.size(); i++) {
            if (objList.eq(i).prop('checked')) {
                strIds += objList.eq(i).val() + ",";
            }
        }
        if (strIds != "") {
            strIds = strIds.substring(0, strIds.length - 1);
        } else {
            bs_alert("Please select gift");
            return false;        
        }
        $("input[name='gift_ids']").val(strIds);
        return true;
    });
});

</script>