<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        
        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="row text-center">
                <h2>My Profile</h2>
                <div class="margin-top-20"></div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url()."customer/user/save";?>">
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone *</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $user->phone;?>" name="phone">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-sm-3">
                                <p class="form-control-static color-gray font-size-12">
                                    * Enter password to change
                                </p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name *</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $user->name;?>" name="name">
                            </div>
                        </div>    
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email *</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $user->email;?>" name="email">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Country *</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="country_id">
                                    <?php foreach ($countries as $country) {?>
                                        <option value="<?php echo $country->id;?>" <?php echo ($country->id == $user->country_id) ? 'selected' : '';?>><?php echo $country->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Created At</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">
                                    <?php echo $user->created_at;?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Updated At</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">
                                    <?php echo $user->updated_at;?>
                                </p>
                            </div>
                        </div>                                                
                        
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-success">Save</button>
                                &nbsp;
                                <a class="btn btn-info" href="<?php echo base_url()."customer/home"?>">Home</a>
                            </div>
                        </div>                        

                    </form>                    
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
