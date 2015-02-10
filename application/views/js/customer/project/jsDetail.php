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
                        bootbox.alert(data.msg);
                    }
                });
            }
        });        
    });
    
    $("button#js-btn-add-more").click(function() {
        $("button#js-btn-friend").removeClass("btn-info");
        $("button#js-btn-friend").addClass("btn-default");
        $("div#js-dlg-contacts").modal();
        /*
        bootbox.prompt("Enter Phone Number by separating comma", function(result) {
            if (result === null) {
                
            } else {
                $("input[name='invitors']").val(result);
                $("form#frmAddInvitors").submit();                      
            }
        });
        */
    });

    $("button#js-btn-submit-add-more").click(function() {
        var objFriends = $("button#js-btn-friend.btn-info");
        var strPhone = $("#js-textarea-phone").val();
        for (var i = 0; i < objFriends.length; i++) {
            strPhone += "," + objFriends.eq(i).attr('data-phone');
        }
        $("input[name='invitors']").val(strPhone);
        $("form#frmAddInvitors").submit();        
    });

    $("button#js-btn-resend").click(function() {
        var invitor = $(this).attr("data-invitor-tel");
        bootbox.confirm("Are you sure?", function(result) {
            if (result) {
                var project_id = "<?php echo $project->id?>";
                $.ajax({
                    url: "/customer/project/async_resend",
                    dataType : "json",
                    type : "POST",
                    data : { project_id : project_id, invitor : invitor },
                    success : function(data){
                        bootbox.alert(data.msg);
                    }
                });
            }
        });
    });

    $("button#js-btn-friend").click(function() {
        if ($(this).hasClass("btn-default")) {
            $(this).removeClass("btn-default");
            $(this).addClass("btn-info");
        } else {
            $(this).addClass("btn-default");
            $(this).removeClass("btn-info");            
        }
    });
});
</script>