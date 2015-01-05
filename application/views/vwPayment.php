<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Birthday Gift</title>

<link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap_style.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>style_common.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>style_customer.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4" style="padding: 0px;">
                <div style="height: 55px; background: #003580; text-align: center;">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png"/>
                </div>
                <input type="hidden" id="project_id" value="<?php echo $project->id;?>"/>
                <div style="background: url(<?php echo base_url(); ?>assets/images/mobile.jpg); padding: 15px; background-size: cover;">
                    <div style="padding: 10px; background: rgba(255, 255, 255, 0.6); border-radius: 5px;">
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Your Phone Number : </b></p></div>
                            <div class="col-sm-6"><input type="text" class="form-control text-center" id="phone"/></div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6"><p class="form-control-static"><b>Amount : </b></p></div>
                            <div class="col-sm-6"><input type="text" class="form-control text-center" id="amount"/></div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" id="js-btn-pay">PAY <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px; display: none; text-align: center; padding: 10px;" id="msgConfirm">
                        </div>
                    </div>
                    
                    <div style="padding: 10px; background: rgba(255, 255, 255, 0.6); border-radius: 5px; margin-top: 20px;">
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Name : </b></p></div>
                            <div class="col-sm-6"><p class="form-control-static"><?php echo $project->name;?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Receiver : </b></p></div>
                            <div class="col-sm-6"><p class="form-control-static"><?php echo $project->receiver_tel;?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Collect Amount : </b></p></div>
                            <div class="col-sm-6"><p class="form-control-static"><?php echo $project->amount;?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Expired At : </b></p></div>
                            <div class="col-sm-6"><p class="form-control-static"><?php echo $project->expired_at;?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><p class="form-control-static"><b>Message : </b></p></div>
                            <div class="col-sm-6"><p class="form-control-static"><?php echo $project->message;?></p></div>
                        </div>                        
                    </div>
                    
                </div>
                <div style="height: 30px; background: #002570; text-align: center; color: #FFF; line-height: 30px;">
                    Kickgifter
                </div>
            </div>
        </div>
    </div>    
</body>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
<![endif]-->
<script src="<?php echo HTTP_JS_PATH; ?>jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/js/bootstrap.js"?>"></script>
<script>
    $(document).ready(function() {
        $("button#js-btn-pay").click(function() {
            var phone = $("#phone").val();
            var amount = $("#amount").val();
            var project_id = $("#project_id").val();
            if (phone == '') {
                alert('Please enter Phone No');
                return;
            }

            if (amount == '') {
                alert('Please enter Amount');
                return;
            }

            if (Number(amount) != amount * 1 ) {
                alert('Please enter Amount correctly');
                return;
            }

            if (amount > 20 ) {
                alert('Please enter Amount correctly');
                return;
            }
            
            $.ajax({
                url: "/payment/async_process",
                dataType : "json",
                type : "POST",
                data : { phone : phone, amount : amount, project_id : project_id },
                success : function(data){
                    $("#msgConfirm").html("<div class='alert alert-danger'>" + data.msg + "</div>");
                    $("#msgConfirm").fadeIn();
                }
            });            
            
        });
    });
</script>
</html>
