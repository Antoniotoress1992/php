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
            <div class="col-sm-10 col-sm-offset-1 color-white margin-top-50 margin-bottom-50 text-center">
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
                                <div class="clearfix margin-bottom-10"></div>
                            </div>
                            
                            <div id="js-div-receiver" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Receiver Phone No:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="receiver" value="<?php echo isset($post) ? $post['receiver'] :'';?>"></div>
                                <div class="clearfix margin-bottom-10"></div>
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
                                <div class="clearfix margin-bottom-10"></div>
                            </div>
                            
                            <div id="js-div-expired" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Expired At:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control readonly" name="expired_at" id="expired_at" readonly value="<?php echo isset($post) ? $post['expired_at'] :'';?>"></div>
                                <div class="clearfix margin-bottom-10"></div>
                            </div>                                                    
                            
                            <div id="js-div-amount" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Amount to collect:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="amount" value="<?php echo isset($post) ? $post['amount'] :'';?>"></div>
                                <div class="clearfix margin-bottom-10"></div>
                            </div>
                            
                            <div id="js-div-friends" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 35%;"><b>Invite Friends:</b></div>
                                <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="invitors" value="<?php echo isset($post) ? $post['invitors'] :'';?>"></div>
                                <div class="clearfix margin-bottom-10"></div>
                            </div>

                            <div id="js-div-message" class="<?php echo isset($post) ? '' : 'unshow'?>">
                                <div class="pull-left line-height-30" style="width: 20%;"><b>Message:</b></div>
                                <div class="pull-left margin-left-15" style="width: 75%;">
                                    <textarea class="form-control" rows="3" name="message"><?php echo isset($post) ? $post['message'] :'';?></textarea>
                                </div>
                                <div class="clearfix margin-bottom-10"></div>                                                                                                
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
                                <div class="clearfix margin-bottom-10"></div>
                                <div class="pull-right">
                                    <p class="font-size-12 color-black">
                                        If you are new here or forgot password, <a id="js-a-click-here" style="cursor: pointer;">click here</a> to get the password
                                    </p>
                                    <div class="text-center font-size-12 alert alert-danger <?php echo isset($post) ? '' : 'unshow'?>" role="alert" style="padding: 7px; margin-bottom: 3px;">
                                        Login info is incorrect
                                    </div>
                                </div>
                                <div class="clearfix margin-bottom-10"></div>
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
        <div class="margin-top-10">&nbsp;</div>
    </div>
    
    <main class="bg-main2">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="text-center gift-item">
                        <img src="<?php echo base_url()."assets/images/gift_01.png";?>" class='img-thumbnail'>
                        <div class="text-center margin-top-10 color-blue">Pooh</div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="text-center gift-item">
                        <img src="<?php echo base_url()."assets/images/gift_02.png";?>" class='img-thumbnail'>
                        <div class="text-center margin-top-10 color-blue">Flower</div>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="text-center gift-item">
                        <img src="<?php echo base_url()."assets/images/gift_03.png";?>" class='img-thumbnail'>
                        <div class="text-center margin-top-10 color-blue">Notebook</div>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="text-center gift-item">
                        <img src="<?php echo base_url()."assets/images/gift_04.png";?>" class='img-thumbnail'>
                        <div class="text-center margin-top-10 color-blue">Cake</div>
                    </div>
                </div>                                                  
            </div>
        </div>
        <div class="margin-top-50"></div>
        <div style="background: rgba(255, 255, 255, 0.8);">
            <div class="container">
                <div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="col-sm-4 text-center">
                        <div class="status-item">
                            <div class="pull-left status-item-border-right">
                                <span class="glyphicon glyphicon-time color-gray-normal status-item-icon"></span>
                            </div>
                            <div class="pull-left">
                                <div class="color-blue status-item-count"><b>1,000+</b></div>
                                <div class="status-item-desc">Hours spent on coding</div>
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
                                <div class="color-blue status-item-count"><b>40,304,000+</b></div>
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
                                <div class="color-blue status-item-count"><b>1,000+</b></div>
                                <div class="status-item-desc">Positive reviews</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                                        
                    
                </div>
            
            </div>
        </div>
        
        <div class="container">
            <div class="margin-top-50"></div>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1 color-white">
                    <div class="step-item">
                        <h3 class="color-white"><b>Step 1</b></h3>
                        <p>Choose gift receiver</p>
                    </div>
                </div>
                <div class="col-sm-2 color-white">
                    <div class="step-item">
                        <h3 class="color-white"><b>Step 2</b></h3>
                        <p>Invite friends</p>
                    </div>
                </div>
                <div class="col-sm-2 color-white">
                    <div class="step-item">
                        <h3 class="color-white"><b>Step 3</b></h3>
                        <p>Contribute</p>
                    </div>
                </div>
                <div class="col-sm-2 color-white">
                    <div class="step-item">
                        <h3 class="color-white"><b>Step 4</b></h3>
                        <p>Choose gift</p>
                    </div>
                </div>
                <div class="col-sm-2 color-white">
                    <div class="step-item">
                        <h3 class="color-white"><b>Step 5</b></h3>
                        <p>Give the gift</p>
                    </div>
                </div>
            </div>
            <div class="margin-top-50"></div>
            <div class="margin-top-50"></div>                    
        </div>

    </main>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>
