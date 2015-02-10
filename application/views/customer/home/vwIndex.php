<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
    <main class="bg-main1">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1 color-white margin-top-lg margin-bottom-lg text-center">
                <h2><b>Send someone special an amount, let them choose a gift
                and deliver it straight to them with a personalised card</b></h2>
                
                <?php if (isset($message)) {?>
                <h3>
                    <div class="text-center alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                </h3>
                <?php } ?>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <div class="process text-center">
                    <div class="process-no">1</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_01.png"?>"/>
                    <p class="color-blue margin-top-5">
                        Simply select amount &amp;<br/>personalised message
                    </p>
                </div>
                
                <div class="process text-center">
                    <div class="process-no">2</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_02.png"?>"/>
                    <p class="color-blue margin-top-5">
                        Recipient receives a text with a<br/>secure link allowing them to<br/>choose any gift for the gifted amount
                    </p>
                </div>
                
                <div class="process text-center">
                    <div class="process-no">3</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_03.png"?>"/>
                    <p class="color-blue margin-top-5">
                        We'll send out your recipients<br/>selected gift next day
                    </p>
                </div>                
            </div>
            <div class="col-sm-6 col-sm-offset-1">
                <div class="process" style="font-size: 16px; background: rgba(255, 255, 255, 0.8)">
                    <div class="process-user pull-left">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <div class="color-blue pull-left form-title">
                        <b>Create New Project</b>
                    </div>
                    <div class="clearfix"></div>
                    <div class="color-orange text-center form-desciption">
                        <b>Start collecting your first present</b>
                    </div>
                    
                    <div class="color-blue">
                        <input type="hidden" id="is_login" value="<?php echo ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '';?>"/>
                        <form method="POST" action="<?php echo base_url();?>customer/project/add" role="form">                            
                            <div id="js-div-name">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Project Name:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="name" value="<?php echo isset($post) ? $post['name'] :'';?>"></div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>
                            
                            <div id="js-div-receiver" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Receiver Phone No:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="receiver" value="<?php echo isset($post) ? $post['receiver'] :'';?>"></div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>
                            
                            <div id="js-div-country" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Country:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;">
                                    <select class="form-control" name="country_id">
                                    <?php foreach ($countries as $country) {?>
                                        <option value="<?php echo $country->id;?>" <?php echo (isset($post) && ($post['country_id'] == $country->id)) ? 'selected' :'';?>><?php echo $country->name;?></option>
                                    <?php }?>
                                    </select>
                                </div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>
                            
                            <div id="js-div-expired" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Expired At:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control readonly" name="expired_at" id="expired_at" readonly value="<?php echo isset($post) ? $post['expired_at'] :'';?>"></div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>                                                    
                            
                            <div id="js-div-amount" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Amount to collect:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="amount" value="<?php echo isset($post) ? $post['amount'] :'';?>"></div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>
                            
                            <div id="js-div-friends" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;">
                                    <b>Invite Friends:</b>
                                    <?php if ($this->session->userdata('user_id')) {?>
                                    <button type="button" class="btn btn-info btn-sm pull-right" id="js-btn-invite-friends" style="margin-right: 10px;"><span class="glyphicon glyphicon-phone"></span></button>
                                    <?php } ?>
                                </div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="invitors" value="<?php echo isset($post) ? $post['invitors'] :'';?>"></div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>

                            <div id="js-div-message" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 20%;"><b>Message:</b></div>
                                <div class="pull-left margin-left-15" style="width: 75%;">
                                    <textarea class="form-control" rows="3" name="message"><?php echo isset($post) ? $post['message'] :'';?></textarea>
                                </div>
                                <div class="clearfix margin-bottom-xs"></div>                                                                                                
                            </div>
                            
                            <div id="js-div-login" class="<?php echo (isset($post) && !$this->session->userdata('user_id'))? '' : 'unshow'?>">
                                <hr/>
                                <div class="pull-left line-height-30" style="width: 15%;"><b>Login</b></div>
                                <div class="pull-left margin-left-15" style="width: 38%;">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone No">
                                </div>
                                <div class="pull-left margin-left-15" style="width: 39%;">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="clearfix margin-bottom-xs"></div>
                                <div class="pull-right">
                                    <p class="font-size-12 color-black">
                                        If you are new here or forgot password, <a id="js-a-click-here" style="cursor: pointer;">click here</a> to get the password
                                    </p>
                                    <div class="text-center font-size-12 alert alert-danger <?php echo isset($post) ? '' : 'unshow'?>" role="alert" style="padding: 7px; margin-bottom: 3px;">
                                        Login info is incorrect
                                    </div>
                                </div>
                                <div class="clearfix margin-bottom-xs"></div>
                            </div>                            
                            
                            <div id="js-div-button" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <button class="btn btn-primary btn-block btn-lg" onclick="return validate();">Send now</button>
                            </div>                                                  
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 color-blue text-center">
                <h2><b>We've got you covered, your recipient will have the option to select from many awesome gifts</b></h2>
            </div>
        </div>
        <div class="margin-top-xs">&nbsp;</div>
    </div>
    
    <main class="bg-main2">
        <div class="container">
            <div class="row padding-top-lg">
                <div class="col-sm-2 col-sm-offset-1">
                    <div class="text-center step-front-item">
                        <img src="<?php echo base_url()."assets/images/icon_blue_01.png";?>" class="step-front-item-img">
                        <div class="text-center margin-top-xs color-gray-dark"><b>Kick-off</b></div>
                        <div class="step-front-item-no">
                            1
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-center step-front-item">
                        <img src="<?php echo base_url()."assets/images/icon_blue_02.png";?>" class="step-front-item-img">
                        <div class="text-center margin-top-xs color-gray-dark"><b>Invite friends</b></div>
                        <div class="step-front-item-no">
                            2
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-center step-front-item">
                        <img src="<?php echo base_url()."assets/images/icon_blue_03.png";?>" class="step-front-item-img">
                        <div class="text-center margin-top-xs color-gray-dark"><b>Money collected</b></div>
                        <div class="step-front-item-no">
                            3
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-center step-front-item">
                        <img src="<?php echo base_url()."assets/images/icon_blue_04.png";?>" class="step-front-item-img">
                        <div class="text-center margin-top-xs color-gray-dark"><b>Spend money</b></div>
                        <div class="step-front-item-no">
                            4
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-center step-front-item">
                        <img src="<?php echo base_url()."assets/images/icon_blue_05.png";?>" class="step-front-item-img">
                        <div class="text-center margin-top-xs color-gray-dark"><b>Give the love</b></div>
                        <div class="step-front-item-no">
                            5
                        </div>
                    </div>
                </div>
                                
            </div>
        </div>
        <div class="margin-top-lg"></div>
        <div style="background: rgba(255, 255, 255, 0.8);">
            <div class="container">
                <div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="col-sm-4 text-center">
                        <div class="status-item">
                            <div class="pull-left status-item-border-right">
                                <span class="glyphicon glyphicon-time color-gray-normal status-item-icon"></span>
                            </div>
                            <div class="pull-left">
                                <div class="color-blue status-item-count"><b><?php echo number_format($count['gift']);?> +</b></div>
                                <div class="status-item-desc">Gift are ready</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="status-item">
                            <div class="pull-left status-item-border-right">
                                <span class="glyphicon glyphicon-user color-gray-normal status-item-icon"></span>
                            </div>
                            <div class="pull-left">
                                <div class="color-blue status-item-count"><b><?php echo number_format($count['user']);?> +</b></div>
                                <div class="status-item-desc">People use our platform</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="status-item">
                            <div class="pull-left status-item-border-right">
                                <span class="glyphicon glyphicon-star color-gray-normal status-item-icon"></span>
                            </div>
                            <div class="pull-left">
                                <div class="color-blue status-item-count"><b><?php echo number_format($count['project']);?> +</b></div>
                                <div class="status-item-desc">Projects are active</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                                        
                    
                </div>
            
            </div>
        </div>
        
        <div class="container">
            <div class="row padding-top-lg padding-bottom-lg text-center color-white">
                <h2>CHOOSE TO SPEND THE MONEY ON YOUR OWN WAYS!</h2>
            </div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="working-item" style="border-top: 5px solid #9b59b6;">
                                <div class="padding-top-normal text-center color-gray-light">
                                    <h4>
                                        Choose a gift from<br/>
                                        our selections
                                    </h4>
                                </div>
                                <div class="padding-top-normal padding-bottom-normal text-center">
                                    <img src="<?php echo base_url()."assets/images/icon_01.png";?>" style="width: 50%;"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="working-item" style="border-top: 5px solid #fea621;">
                                <div class="padding-top-normal text-center color-gray-light">
                                    <h4>
                                        Let the recipient choose<br/>
                                        the gift they want
                                    </h4>
                                </div>
                                <div class="padding-top-normal padding-bottom-normal text-center">
                                    <img src="<?php echo base_url()."assets/images/icon_02.png";?>" style="width: 50%;"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="working-item" style="border-top: 5px solid #2ecc71;">
                                <div class="padding-top-normal text-center color-gray-light">
                                    <h4>
                                        Withdraw the money<br/><br/>
                                    </h4>
                                </div>
                                <div class="padding-top-normal padding-bottom-normal text-center">
                                    <img src="<?php echo base_url()."assets/images/icon_03.png";?>" style="width: 50%;"/>
                                </div>
                            </div>
                        </div>                                                
                    </div>
                </div>
            </div>
            <div class="margin-top-lg"></div>
            <div class="margin-top-lg"></div>                    
        </div>

    </main>
    
    <div class="modal fade" id="js-dlg-contacts">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo SITE_NAME;?></h4>
                </div>
                <div class="modal-body">
                    <p>Select your friends.</p>
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
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>
