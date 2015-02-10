<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
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
                    <div class="row text-center">
                        <h2>Project Detail</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row">
                        <hr/>
                    </div>
                    <div class="row">
                        <div class="form-horizontal form-horizontal-custom" role="form">
                            <div class="row">
                                <?php if (isset($alert)) { ?>
                                    <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                                <?php } ?>
                            </div>
                                                
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 text-center">
                                        <a class="btn btn-success" href="<?php echo base_url()."customer/project/shop/".$project->id;?>">
                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                            Go Shopping
                                        </a>
                                        <a class="btn btn-success" href="<?php echo base_url()."customer/project/transfer/".$project->id;?>">
                                            <span class="glyphicon glyphicon-credit-card"></span>
                                            Bank Transfer
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <button class="btn btn-info" id="js-btn-choose-gift" >
                                            <span class="glyphicon glyphicon-gift"></span>
                                            Friend Choose the Gift
                                        </button>                                
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i = 0;
                            $fields = [ 'name' => 'Name',
                                        'receiver_tel' => 'Receiver',
                                        'country_name' => 'Country',
                                        'amount' => 'Amount',
                                        'created_at' => 'Created At',
                                        'updated_at' => 'Updated At',
                                        'message' => 'Message',
                                      ];
                            foreach ($fields as $key => $value) { ?>
                            <?php if ($i % 2 == 0) {
                                echo '<div class="form-group">';
                             } ?>
                                    <?php if ($key != 'message') { ?>
                                        <label class="col-sm-2 control-label"><?php echo $value;?></label>
                                        <div class="col-sm-4">
                                            <p class="form-control-static"><?php echo $project->{$key};?></p>
                                        </div>                                        
                                    <?php } else { ?>
                                        <label class="col-sm-2 control-label"><?php echo $value;?></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5"><?php echo $project->{$key};?></textarea>
                                        </div>
                                    <?php } ?>
                            <?php 
                                if ($i % 2 == 1 || $i == 6) {
                                    echo "</div>";
                                }
                                $i++; 
                            } ?>
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
                                <div class="col-sm-8 col-sm-offset-2">
                                    <h4 class="text-left pull-left">Inviters (<?php echo count($invitors);?> Invited, <?php echo count($payers);?> Paid)</h4>
                                    <button class="btn btn-info btn-sm pull-right" id="js-btn-add-more">+ Add More</button>
                                    <div class="clearfix"></div>
                                    <table class="table table-mobile">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Phone</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Invited At</th>
                                                <th>Paid At</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1; 
                                            foreach ($invitors as $invitor) {?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $invitor->invitor_tel;?></td>
                                                <td><?php echo $invitor->name;?></td>
                                                <td><?php echo $invitor->amount;?></td>
                                                <td><?php echo $invitor->invited_at;?></td>
                                                <td><?php echo $invitor->paid_at;?></td>
                                                <td>
                                                    <?php if ($invitor->amount == '') {?>
                                                    <button class="btn btn-default btn-sm" id="js-btn-resend" data-invitor-tel="<?php echo $invitor->invitor_tel;?>">Resend</button>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <?php }
                                            if (count($invitors) == 0) { ?>
                                            <tr>
                                                <td colspan="7" class="text-center">There is no inviters</td>
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
        </div>
        <form method="post" action="<?php echo base_url()."customer/project/invite";?>" class="hidden" id="frmAddInvitors">
            <input type="hidden" name="project_id" value="<?php echo $project->id;?>">
            <input type="hidden" name="invitors" value=""/>
        </form>
        
        <div class="modal fade" id="js-dlg-contacts">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php echo SITE_NAME;?></h4>
                    </div>
                    <div class="modal-body">
                        <p>Select your friends or enter Phone Number by separating comma.</p>
                        <hr/>                        
                        <textarea class="form-control" id="js-textarea-phone"></textarea>
                        <hr/>
                        <?php foreach ($contacts as $contact) {?>
                            <button class="btn btn-default btn-sm" id="js-btn-friend" data-phone="<?php echo $contact->phone;?>"><?php echo $contact->name."(".$contact->phone.")";?></button>
                        <?php } ?>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="js-btn-submit-add-more">Ok</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        
        
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<script src="<?php echo base_url()."assets/js/bootbox.js"?>"></script>
<?php $this->load->view('js/customer/project/jsDetail'); ?>
</html>
