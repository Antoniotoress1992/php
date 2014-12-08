<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('widget/vwMeta'); ?>
    <?php $this->load->view('widget/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('widget/vwHeader'); ?>
    <div class="container">
        <div class="rows">
            <div class="col-sm-8 col-sm-offset-2">
               
                <div class="form-horizontal" role="form">
                    <div class="row text-center">
                        <h2>Project Detail</h2>
                    </div>
                    <div class="row">
                        <?php if (isset($alert)) { ?>
                            <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <a class="btn btn-success btn-sm" href="<?php echo base_url()."widget/project/coupon/".$project->id;?>">
                                <span class="glyphicon glyphicon-send"></span>
                                Buy Coupon
                            </a>
                            <a class="btn btn-info btn-sm" href="<?php echo base_url()."widget/project/transfer/".$project->id;?>">
                                <span class="glyphicon glyphicon-credit-card"></span>
                                Bank Transfer
                            </a>
                        </div>
                    </div>
                    
                    <hr/>                    
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Crowded Amount</label>
                        <div class="col-sm-3">
                            <p class="form-control-static"><?php echo $amount_status['crowded'];?></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Wasted Amount</label>
                        <div class="col-sm-3">
                            <p class="form-control-static"><?php echo $amount_status['wasted'];?></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Avaiable Amount</label>
                        <div class="col-sm-3">
                            <p class="form-control-static"><?php echo $amount_status['avaiable'];?></p>
                        </div>
                    </div>
                    <hr/>                    
                    <?php
                    $fields = [ 'name' => 'Name',
                                'receiver_tel' => 'Receiver',
                                'country_name' => 'Country',
                                'amount' => 'Amount',
                                'message' => 'Message',
                                'created_at' => 'Created At',
                                'updated_at' => 'Updated At',
                              ];
                    foreach ($fields as $key => $value) { 
                    ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo $value;?></label>
                            <div class="col-sm-9">
                            <?php if ($key == 'message') { ?>
                                <textarea class="form-control" rows="5"><?php echo $project->{$key};?></textarea>
                            <?php } else {?>
                                <p class="form-control-static"><?php echo $project->{$key};?></p>
                            <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                </div>                
                                    
            </div>
        </div>
    </div>
    <?php $this->load->view('widget/vwFooter'); ?>
</body>
<?php $this->load->view('widget/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/widget/project/jsAdd'); ?>
</html>
