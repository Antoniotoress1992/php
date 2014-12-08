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
                        <h2>Buy Coupon Code</h2>
                    </div>
                                    
                    <div class="row">
                        <?php if (isset($alert)) { ?>
                            <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                        <?php } ?>
                    </div>

                    <form method="post" action="<?php echo base_url()."widget/project/submit_coupon";?>">
                        <input type="hidden" name="project_id" value="<?php echo $project_id;?>"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Coupon Price</label>
                            <div class="col-sm-4">
                                <input name="amount" class="form-control text-center" value="<?php echo $amount_status['avaiable'];?>"/>
                            </div>
                            <div class="col-sm-5">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="is_sms"> Send Coupon Code To Receiver
                                </label>
                              </div>                            
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-primary">
                                    <span class="glyphicon glyphicon-transfer"></span>
                                    Send
                                </button>
                                <a class="btn btn-success" href="<?php echo base_url()."widget/project/detail/".$project_id;?>">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                    Back
                                </a>                                             
                            </div>               
                        </div>                         
                    </form>
                    <hr/>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Coupon Codes</label>
                        <div class="col-sm-9">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Coupon Code</th>
                                        <th>Amount</th>
                                        <th>Company Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach ($amount_status['coupon_codes'] as $item) {?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $item->coupon_code;?></td>
                                        <td><?php echo $item->amount;?></td>
                                        <td><?php echo $item->company_name;?></td>
                                    </tr>
                                    <?php }
                                    if (count($amount_status['coupon_codes']) == 0) { ?>
                                    <tr><td colspan="5">There is no coupon codes</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                        
                    
                    <hr/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Crowded Amount</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $amount_status['crowded'];?></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Wasted Amount</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $amount_status['wasted'];?></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Avaiable Amount</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo $amount_status['avaiable'];?></p>
                        </div>
                    </div>
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
