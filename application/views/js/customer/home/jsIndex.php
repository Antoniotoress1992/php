<script>
$(document).ready(function() {
    $('#expired_at').datepicker({format: 'yyyy-mm-dd'});
});

function validate() {
    if ($("#is_login").val() == '') {
        bs_alert('You have to login for this');
        return false;
    }

    var name = $("input[name='name']").val();
    var phone = $("input[name='phone']").val();
    var expired_at = $("input[name='expired_at']").val();
    var amount = $("input[name='amount']").val();
    var invitors = $("input[name='invitors']").val();
    var message = $("input[name='message']").val();

    if (name == '' || phone == '' || expired_at == '' || amount == '') {
        bs_alert('Please enter forms correctly');
        return false;
    }
    
    return true;
}
</script>