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
            <div class="col-sm-10 col-sm-offset-1 color-white margin-top-50 margin-bottom-50">
                <h2><b>Send someone special an amount, let them choose a gift
                and deliver it straight to them with a personalised card</b></h2>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <div class="process text-center">
                    <div class="process-no">1</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_01.png"?>"/>
                    <p class="color-blue font-size-12 margin-top-5">
                        <b>Simply select amount &amp;<br/>personalised message</b>
                    </p>
                </div>
                
                <div class="process text-center">
                    <div class="process-no">2</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_02.png"?>"/>
                    <p class="color-blue font-size-12 margin-top-5">
                        <b>Recipient receives a text with a<br/>secure link allowing them to<br/>choose any gift for the gifted amount</b>
                    </p>
                </div>
                
                <div class="process text-center">
                    <div class="process-no">3</div>
                    <img src="<?php echo base_url()."assets/images/icon_step_03.png"?>"/>
                    <p class="color-blue font-size-12 margin-top-5">
                        <b>We'll send out your recipients<br/>selected gift next day</b>
                    </p>
                </div>                
            </div>
            <div class="col-sm-4">
                <div class="process" style="font-size: 16px;">
                    <div class="process-user pull-left">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <div class="color-blue pull-left form-title">
                        <b>Recipient Details</b>
                    </div>
                    <div class="clearfix"></div>
                    <div class="color-orange text-center form-desciption">
                        <b>Start collecting your first present</b>
                    </div>
                    
                    <div class="color-blue">
                        <input type="hidden" id="is_login" value="<?php echo ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '';?>"/>
                        <form method="POST" action="<?php echo base_url();?>customer/project/add" role="form">
                            <div class="pull-left line-height-30" style="width: 20%;"><b>Name:</b></div>
                            <div class="pull-left margin-left-15" style="width: 75%;"><input type="text" class="form-control" name="name"></div>
                            <div class="clearfix margin-bottom-10"></div>
                            
                            <div class="pull-left line-height-30" style="width: 20%;"><b>Phone:</b></div>
                            <div class="pull-left margin-left-15" style="width: 75%;"><input type="text" class="form-control" name="phone"></div>
                            <div class="clearfix margin-bottom-10"></div>
                            
                            <div class="pull-left line-height-30" style="width: 20%;"><b>Country:</b></div>
                            <div class="pull-left margin-left-15" style="width: 75%;">
                                <select class="form-control" name="country_id">
                                <?php foreach ($countries as $country) {?>
                                    <option value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                <?php }?>
                                </select>
                            </div>
                            <div class="clearfix margin-bottom-10"></div>
                            
                            <div class="pull-left line-height-30" style="width: 35%;"><b>Expired At:</b></div>
                            <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="expired_at" id="expired_at"></div>
                            <div class="clearfix margin-bottom-10"></div>                                                    
                            
                            <div class="pull-left line-height-30" style="width: 45%;"><b>Amount to collect:</b></div>
                            <div class="pull-left margin-left-15" style="width: 50%;"><input type="text" class="form-control" name="amount"></div>
                            <div class="clearfix margin-bottom-10"></div>
                            
                            <div class="pull-left line-height-30" style="width: 35%;"><b>Invite Friends:</b></div>
                            <div class="pull-left margin-left-15" style="width: 60%;"><input type="text" class="form-control" name="invitors"></div>
                            <div class="clearfix margin-bottom-10"></div>
                            
                            <div class="pull-left line-height-30" style="width: 20%;"><b>Message:</b></div>
                            <div class="pull-left margin-left-15" style="width: 75%;">
                                <textarea class="form-control" rows="3" name="message"></textarea>
                            </div>
                            <div class="clearfix margin-bottom-10"></div>                                                                                                
                            
                            <button class="btn btn-success btn-block btn-lg" onclick="return validate();">Send now</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-4" style="min-height: 481px;">
                <div style="position: absolute;bottom: 0px; right: 0px;">
                    <img src="<?php echo base_url()."assets/images/hand.png"?>" style="width: 100%;"/>
                </div>
            </div>
        </div>
    </main>
    <main class="bg-main2">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1 color-sky margin-top-50 margin-bottom-50 text-center">
                <h2><b>We've got you covered, your recipient will have the option to select from many awesome gifts</b></h2>
            </div>
            
            <div class="col-sm-4 introduction color-orange text-center">
                <img src="<?php echo base_url()."assets/images/process_01.png"?>"/>
                <p>
                    <b>We'll wrap & add a personalised senderly card including your greeting</b>
                </p>
            </div>
            
            <div class="col-sm-4 introduction color-orange text-center">
                <img src="<?php echo base_url()."assets/images/process_02.png"?>"/>
                <p>
                    <b>We'll wrap post the gift to the recipient within 24 hours</b>
                </p>
            </div>
            
            <div class="col-sm-4 introduction color-orange text-center">
                <img src="<?php echo base_url()."assets/images/process_03.png"?>"/>
                <p>
                    <b>We'll wrap & add a personalised senderly card including your greeting</b>
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="margin-top-50">&nbsp;</div>
            <div class="col-sm-5 col-sm-offset-2">
                <button class="btn btn-info bnt-sm">
                    Many great gift choices your recipient can choose from
                </button>
            </div>
            <div class="col-sm-5 pull-right">
                <img src="<?php echo base_url()."assets/images/photo01.png"?>"/>
                <img src="<?php echo base_url()."assets/images/photo02.png"?>"/>
                <img src="<?php echo base_url()."assets/images/photo03.png"?>"/>
                <img src="<?php echo base_url()."assets/images/photo04.png"?>"/>
                <img src="<?php echo base_url()."assets/images/photo05.png"?>"/>
            </div>
            <div class="clearfix"></div>
            <div class="margin-bottom-50">&nbsp;</div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <button class="btn btn-info btn-sm btn-block">Birthdaygift will be launch soon. Thanks for your patience.</button>
                </div>
            </div>
        </div>    
    </main>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>
