<script>
$(document).ready(function() {
    $("button#js-btn-choose-gift").click(function() {
        bootbox.confirm("Are you sure?", function(result) {
            if (result) {
                var project_id = "<?php echo $project->id?>";
                $.ajax({
                    url: "/customer/project/async_choose_gift",
                    dataType : "json",
                    type : "POST",
                    data : { project_id : project_id },
                    success : function(data){
                        bs_alert(data.msg);
                    }
                });
            }
        });        
    });
    
    $("button#js-btn-add-more").click(function() {
        bootbox.prompt("Enter Phone Number by separating comma", function(result) {
            if (result === null) {
                
            } else {
                $("input[name='invitors']").val(result);
                $("form#frmAddInvitors").submit();                      
            }
        });
    });
});
</script>