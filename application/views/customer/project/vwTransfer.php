<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        <div class="background-dashboard"></div>
        <div class="container" style="margin-top: 70px; margin-bottom: 30px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('customer/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center border-blue">
                    <div class="row">
                        <h2>Bank Transfer</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row">
                        <hr/>
                    </div>
                    <div class="row">
                        <div class="form-horizontal" role="form">
                        
                            <div class="row">
                                <?php if (isset($alert)) { ?>
                                    <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                                <?php } ?>
                            </div>
                                                
                            <form method="post" action="<?php echo base_url()."customer/project/submit_bank";?>">
                                <input type="hidden" name="project_id" value="<?php echo $project_id;?>"/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Amount to Send</label>
                                    <div class="col-sm-5">
                                        <input name="amount" class="form-control text-center" value="<?php echo $amount_status['avaiable'];?>"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Bank Info</label>
                                    <div class="col-sm-5">
                                        <textarea name="bank_info" class="form-control" placeholder="Enter Bank Info..." rows="5"></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="color-gray font-size-12 form-control-static">
                                            ( The avaialbe maxium about is <?php echo $amount_status['avaiable'];?> )
                                        </p>
                                    </div>                                
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn-primary">
                                            <span class="glyphicon glyphicon-transfer"></span>
                                            Send
                                        </button>
                                        <a class="btn btn-success" href="<?php echo base_url()."customer/project/detail/".$project_id;?>">
                                            <span class="glyphicon glyphicon-share-alt"></span>
                                            Back
                                        </a>                                             
                                    </div>               
                                </div>                         
                            </form>
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
                                    <table class="table table-mobile">
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
                                    <table class="table table-mobile">
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
                                    <table class="table table-mobile">
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
                        </div>
                    </div>                                    
                </div>            
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
