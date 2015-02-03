<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
    <main class="bg-main1" style="color: #FFF;">
        <div class="container">            
            <div class="row text-center margin-top-xl">
                <h2>Sign In For Customer</h2>
            </div>
            
            <div class="row margin-top-xs">
                <div class="col-sm-6 col-sm-offset-3 text-center">
                    <?php if (isset($msg) && $msg != '') {?>
                        <div class="alert alert-info" role="alert">
                                <?php echo $msg;?>                            
                        </div>
                    <?php }?>
                    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                </div>
            </div>
    
            <form method="POST" action="<?php echo base_url();?>customer/user/signin" role="form" class="form-login">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label>Phone No *</label>
                            <input class="form-control" name="phone" type="text">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <label>Password *</label>
                            <input class="form-control" name="password" type="password">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text-right margin-top-lg">
                        <p> New Customer? Go to the
                            <a href="<?php echo base_url()."customer/user/signup"?>" >Sign Up</a> Page
                        </p>
                        &nbsp;&nbsp;&nbsp;                    
                        <button class="btn btn-lg btn-danger text-uppercase margin-right-30">Sign In <span class="glyphicon glyphicon-ok-circle"></span></button>
                    </div>
                </div>
            </form>        
        </div>
    </main>

    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
