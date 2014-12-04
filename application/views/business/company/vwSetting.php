<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('business/vwHeader'); ?>
        <div class="container" style="min-height: 500px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('business/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center">
                    <h2>Settings</h2>
                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                            <?php } ?>
                        </div>
                    </div>                    
                    
                    <div class="row">
                        <form method="POST" action="<?php echo base_url();?>business/company/update" class="form-horizontal margin-top-30" role="form">
                            <?php
                            $fields = [ 'name' => 'Name',
                                        'password' => 'Password',
                                        'vat_number' => 'VAT ID',
                                        'address' => 'Address',
                                        'postal_code' => 'Postal Code',
                                        'phone' => 'Phone',
                                        'email' => 'Email',
                                        'bank_number' => 'Bank Number',
                                        'created_at' => 'Created At',
                                        'updated_at' => 'Updated At',
                                      ];
                            foreach ($fields as $key => $value) {
                                if ($key == 'created_at' || $key == 'updated_at') { 
                            ?>
                                <div class="form-group">
                                    <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                    <div class="col-sm-6">
                                        <p class="form-control-static"><?php echo $company->{$key}?></p>
                                    </div>
                                </div>
                            <?php 
                                } else {
                            ?>
                                <div class="form-group">
                                    <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                    <div class="col-sm-6">
                                        <input class="form-control" name="<?php echo $key;?>" type="<?php echo ($key == 'password') ? 'password' : 'text';?>" value='<?php echo set_value($key, isset($company->{$key}) ? $company->{$key} : ''); ?>'>
                                    </div>
                                </div>                        
                            <?php
                                }
                            } ?>
                            
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-1 control-label"></label>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Save</button>
                                </div>                            
                            </div>                            
                        </form>
                    </div>                    
                    
                </div>
            </div>
        </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>


</html>
