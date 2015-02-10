<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('business/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('business/vwLeftMenu'); ?>
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			<div class="row">
    				<div class="col-md-12">
    					<h3 class="page-title">iFrame Projects</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Project</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    						<li>
    							<span>Detail</span>
    						</li>
    					</ul>
    					
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-pencil-square-o"></i> Project Detail
    							</div>
    							<div class="actions">
								    <a href="<?php echo base_url(); ?>business/project" class="btn btn-default btn-sm">
								        <i class="fa fa-pencil-square-o"></i>&nbsp;List
								    </a>								    
							    </div>     							
    						</div>
    						<div class="portlet-body">
                                <div class="form-horizontal" role="form">
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
                                            <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
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
                                            <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
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
                                            <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
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
                                    <hr/>
                                    
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <h4 class="text-left pull-left">Inviters (<?php echo count($invitors);?> Invited, <?php echo count($payers);?> Paid)</h4>
                                            <table class="table table-mobile">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Phone</th>
                                                        <th>Name</th>
                                                        <th>Amount</th>
                                                        <th>Invited At</th>
                                                        <th>Paid At</th>
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
                                                    </tr>
                                                    <?php }
                                                    if (count($invitors) == 0) { ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">There is no inviters</td>
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
            </div>
        </div>
    </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>


</html>
