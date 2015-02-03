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
                <div style="background: url(<?php echo base_url(); ?>assets/images/mobile.jpg); padding: 15px; background-size: cover; min-height: 400px;">
                    <div style="padding: 10px; background: rgba(255, 255, 255, 0.6); border-radius: 5px;">
                    
                        <?php if (isset($alert)) { ?>
                            <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                        <?php } ?>
                                                    
                        <?php if ($result == 'success') {?>
                        <input type="hidden" id="js-avaiable" value="<?php echo $amount_status['avaiable'];?>"/>
                        
                        <form method="post" action="<?php echo base_url()."gift/submit";?>" class="form-horizontal" role="form">
                            <input type="hidden" name="gift_ids" value=""/>
                            <div class="pull-left">Amount Avaiable : <b id="b-amount-avaiable"><?php echo $amount_status['avaiable'];?></b></div>
                            <div class="pull-right">
                                <button class="btn btn-primary btn-sm" id="js-btn-buy"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Thumb</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($gifts as $gift) {?>
                                <tr>
                                    <td><input type="checkbox" value="<?php echo $gift->id;?>" id="js-checkbox-item"/></td>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $gift->name; ?></td>
                                    <td>
                                        <img src="<?php echo HTTP_GIFT_PATH.$gift->thumb; ?>" style="height: 30px;">
                                    </td>
                                    <td><?php echo $gift->price; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } else {?>
                            <div class="text-center" style="line-height: 300px;"><b>Wrong URL</b></div>
                        <?php } ?>
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
<script src="<?php echo base_url()."assets/js/bootbox.js"?>"></script>
<?php $this->load->view('js/gift/jsChoose'); ?>
</html>
