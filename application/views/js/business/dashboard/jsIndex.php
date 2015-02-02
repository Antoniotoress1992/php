<script>
var data1 = [], data2 = [], data3 = [], data4 = [];
<?php 
        $i = 0; 
        foreach ($userList as $item) {?>
        var temp = [Date.UTC(<?php echo $item->y;?>, <?php echo $item->m;?>, <?php echo $item->d;?>), <?php echo $item->cnt?>]
        data1[<?php echo $i++;?>] = temp;
<?php } ?>

<?php 
        $i = 0; 
        foreach ($projectList as $item) {?>
        var temp = [Date.UTC(<?php echo $item->y;?>, <?php echo $item->m;?>, <?php echo $item->d;?>), <?php echo $item->cnt?>]
        data2[<?php echo $i++;?>] = temp;
<?php } ?>

<?php 
        $i = 0; 
        foreach ($invitorList as $item) {?>
        var temp = [Date.UTC(<?php echo $item->y;?>, <?php echo $item->m;?>, <?php echo $item->d;?>), <?php echo $item->cnt?>]
        data3[<?php echo $i++;?>] = temp;
<?php } ?>

<?php
        $i = 0;
        foreach ($moneyList as $item) {?>
        var temp = [Date.UTC(<?php echo $item->y;?>, <?php echo $item->m;?>, <?php echo $item->d;?>), <?php echo $item->amount?>]
        data4[<?php echo $i++;?>] = temp;
<?php } ?>

$(document).ready(function() {
    $('#startDate, #endDate').datepicker({format: 'yyyy-mm-dd'});
    var startDate = $("#startDate").val();
    var endDate = $("#endDate").val(); 
    if (startDate == '' || endDate == '') {
        $("#period").val(7);
        $("#period").change();
    }
    $("#period").change(function() {
        var type = $(this).val();
        var startDate = new Date();
        var endDate = new Date();
        if (type == 0) {
            $("#startDate").val("");
            $("#endDate").val("");
        } else if (type == 3) {
            startDate.setDate(startDate.getDate() - 3 );
        } else if (type == 7) {
            startDate.setDate(startDate.getDate() - 7 );
        } else if (type == 30) {
            startDate.setMonth(startDate.getMonth() - 1 );
        } else if (type == 60) {
            startDate.setMonth(startDate.getMonth() - 2 );
        } else if (type == 90) {
            startDate.setMonth(startDate.getMonth() - 3 );
        } else if (type == 180) {
            startDate.setMonth(startDate.getMonth() - 6 );
        } else if (type == 365) {
            startDate.setYear(startDate.getFullYear() - 1 );
        }
        $("#startDate").val(getFormattedDate(startDate));
        $("#endDate").val(getFormattedDate(endDate));        
    });
    
    $('#container1').highcharts({
        chart: { type: 'spline' },
        title: { text: 'How many user registered per day?' },
        xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: 'Date' } },
        yAxis: { title: {text: ' '}, min: 0 },
        tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.0f}' },
        series: [{name: 'Count', data: data1}]
    });

    $('#container2').highcharts({
        chart: { type: 'spline' },
        title: { text: 'How many project registered per day?' },
        xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: 'Date' } },
        yAxis: { title: {text: ' '}, min: 0 },
        tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.0f}' },
        series: [{name: 'Count', data: data2}]
    });

    $('#container3').highcharts({
        chart: { type: 'spline' },
        title: { text: 'How many invitations has been sent per day?' },
        xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: 'Date' } },
        yAxis: { title: {text: ' '}, min: 0 },
        tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.0f}' },
        series: [{name: 'Count', data: data3}]
    });

    $('#container4').highcharts({
        chart: { type: 'spline' },
        title: { text: 'How much has been collected per day?' },
        xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: 'Date' } },
        yAxis: { title: {text: ' '}, min: 0 },
        tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.2f}' },
        series: [{name: 'Euro', data: data4}]
    });    
    
});

function getFormattedDate(date) {
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return year + '-' + month + '-' + day;
}

function validate() {
    var startDate = $("#startDate").val();
    var endDate = $("#endDate").val();

    if (startDate == '' || endDate == '' || endDate < startDate) {
        bootbox.alert('Please select Start Date & End Date Correctly.');
        return false;
    }
    return true;
}
</script>