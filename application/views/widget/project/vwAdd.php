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
               
                <div class="row">
                    <?php if (isset($alert)) { ?>
                        <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                    <?php } ?>
                </div>                
                                    
                <form class="form-horizontal" method="POST" action="<?php echo base_url();?>widget/project/save" role="form">
                    <input type="hidden" id="is_login" value="<?php echo ($this->session->userdata('wuser_id')) ? $this->session->userdata('wuser_id') : '';?>"/>
                    <?php
                    $fields = [ 'name' => 'Project Name',
                                'receiver' => 'Receiver Phone No',
                                'country_id' => 'Country',
                                'expired_at' => 'Expired At',
                                'amount' => 'Amount to collect',
                                'invitors' => 'Invite Friends',
                                'message' => 'Message',
                              ];
                    foreach ($fields as $key => $value) { ?> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $value;?></label>
                        <div class="col-sm-9">
                            <?php if ($key == 'country_id') {?>
                            <select name="<?php echo $key;?>" class="form-control">
                                <?php foreach ($countries as $country) {?>
                                <option value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                <?php } ?>
                            </select>
                            <?php } elseif ($key == 'message') {?>
                            <textarea class="form-control" name="<?php echo $key;?>" rows="4"></textarea>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="<?php echo $key;?>" value="<?php echo isset($post) ? $post[$key] :'';?>">
                            <?php } ?>
                        </div>
                    </div>                        
                    <?php }?>
                    
                    <?php if (!$this->session->userdata('wuser_id')) {?>
                    <hr/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12 font-size-12 color-gray text-center">
                            <i>If you are new here or forgot password, click <a style="cursor: pointer;" id="js-a-click-here">here</a> to get password</i>
                        </div>
                    </div>                    
                    <?php } ?>
                    
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button class="btn btn-primary btn-block" onclick="return validate();">Send Now</button>
                        </div>
                    </div>
                                        
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('widget/vwFooter'); ?>
</body>
<?php $this->load->view('widget/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/widget/project/jsAdd'); ?>
</html>
