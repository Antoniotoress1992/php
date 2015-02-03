<script>
$(document).ready(function() {
    $('#expired_at').datepicker({format: 'yyyy-mm-dd'});

    $("input[name='name']").keyup(function() {
        $("#js-div-receiver").fadeIn();
    });

    $("input[name='receiver']").keyup(function() {
        $("#js-div-country").fadeIn();
        $("#js-div-expired").fadeIn();
    });

    $("input[name='expired_at']").blur(function() {
        $("#js-div-amount").fadeIn();
    });

    $("input[name='amount']").keyup(function() {
        $("#js-div-friends").fadeIn();
    });

    $("input[name='invitors']").keyup(function() {
        $("#js-div-message").fadeIn();
        $("#js-div-button").fadeIn();
        if ($("#is_login").val() == '') {
            $("#js-div-login").fadeIn();
        }
    });

    $("a#js-a-click-here").click(function(event) {
        event.stopPropagation();
        var phone = $("input[name='phone']").val();
        var country_id = $("select[name='country_id']").val();
        
        $.ajax({
            url: "/customer/user/async_generate_password",
            dataType : "json",
            type : "POST",
            data : { phone : phone, country_id : country_id },
            success : function(data){
                bootbox.alert(data.msg);
            }
        });
    });
    $("input[name='name']").focus();
});

function validate() {
    if ($("#is_login").val() == '') {
        var phone = $("input[name='phone']").val();
        var password = $("input[name='password']").val();
        if (phone == '' || password == '') {
            bootbox.alert('Please enter correct Phone No and Password');
            return false;
        }
    }
    var name = $("input[name='name']").val();
    var receiver = $("input[name='receiver']").val();
    var expired_at = $("input[name='expired_at']").val();
    var amount = $("input[name='amount']").val();
    var invitors = $("input[name='invitors']").val();
    var message = $("input[name='message']").val();

    if (name == '' || receiver == '' || expired_at == '' || amount == '') {
        bootbox.alert('Please enter forms correctly');
        return false;
    }
    return true;
}
</script>