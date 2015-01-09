<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        
        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="row text-center">
                <h2>Project Detail</h2>
                <div class="margin-top-20"></div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-horizontal" role="form">
                        <div class="row">
                            <?php if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                            <?php } ?>
                        </div>
                                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9 text-right">
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/shop/".$project->id;?>">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Go Shopping
                                </a>
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/transfer/".$project->id;?>">
                                    <span class="glyphicon glyphicon-credit-card"></span>
                                    Bank Transfer
                                </a>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                <button class="btn btn-info" id="js-btn-choose-gift" >
                                    <span class="glyphicon glyphicon-gift"></span>
                                    Friend Choose the Gift
                                </button>
                            </div>
                        </div>
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
                            <label class="col-sm-3 control-label">Left Amount</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $amount_status['crowded'] - $amount_status['wasted'];?></p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Buy Gifts</label>
                            <div class="col-sm-9">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gift Name</th>
                                            <th>Amount</th>
                                            <th>Delivered</th>
                                            <th>Buy At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($amount_status['gift_buys'] as $item) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $item->gift_name;?></td>
                                            <td><?php echo $item->amount;?></td>
                                            <td><?php echo ($item->is_delivered) ? "Yes" : "No";?></td>
                                            <td><?php echo $item->created_at;?></td>
                                        </tr>
                                        <?php }
                                        if (count($amount_status['gift_buys']) == 0) { ?>
                                        <tr><td colspan="5">There is no gifts</td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Coupon Codes</label>
                            <div class="col-sm-9">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Coupon Code</th>
                                            <th>Amount</th>
                                            <th>Company Name</th>
                                            <th>Created At</th>
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
                                            <td><?php echo $item->created_at;?></td>
                                        </tr>
                                        <?php }
                                        if (count($amount_status['coupon_codes']) == 0) { ?>
                                        <tr><td colspan="5">There is no coupon codes</td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Bank Trasfers</label>
                            <div class="col-sm-9">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bank Info</th>
                                            <th>Amount</th>
                                            <th>Delivered</th>
                                            <th>Requested At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($amount_status['bank_transfers'] as $item) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $item->bank_info;?></td>
                                            <td><?php echo $item->amount;?></td>
                                            <td><?php echo ($item->is_delivered) ? "Yes" : "No";?></td>
                                            <td><?php echo $item->created_at;?></td>
                                        </tr>
                                        <?php }
                                        if (count($amount_status['bank_transfers']) == 0) { ?>
                                        <tr><td colspan="5">There is no bank transfer</td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                            
                        
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/lists"?>">
                                    <span class="glyphicon glyphicon-list"></span>
                                    List
                                </a>
                                &nbsp;
                                <a class="btn btn-info" href="<?php echo base_url()."customer/home"?>">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Home
                                </a>
                            </div>
                        </div>                        
                        <hr/>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3>Invitors</h3>
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($invitors as $invitor) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $invitor->invitor_tel;?></td>
                                        </tr>
                                        <?php }
                                        if (count($invitors) == 0) { ?>
                                        <tr>
                                            <td colspan="2" class="text-center">There is no invitors</td>
                                        </tr>                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-8">
                                <h3>Payers</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Payed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($payers as $payer) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $payer->tel;?></td>
                                            <td><?php echo $payer->amount;?></td>
                                            <td><?php echo $payer->created_at;?></td>
                                        </tr>
                                        <?php }
                                        if (count($payers) == 0) { ?>
                                        <tr>
                                            <td colspan="4" class="text-center">There is no payers</td>
                                        </tr>                                        
                                        <?php } ?>
                                    </tbody>
                                </table>                                
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<script src="<?php echo base_url()."assets/js/bootbox.js"?>"></script>
<?php $this->load->view('js/customer/project/jsDetail'); ?>
</html>
