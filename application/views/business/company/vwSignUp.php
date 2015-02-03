<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">  
    <?php $this->load->view('business/vwHeader'); ?>
    <div class="page-container" style="background: #FFF;">
        <div class="page-contect-wrapper">
    	    <div class="page-content">
                <div class="col-sm-6 col-sm-offset-3 thumbnail margin-top-xl margin-bottom-xl">
                    <div class="row text-center">
                        <h2>Sign Up For Company</h2>
                    </div>
                    
                    <div class="col-sm-10 col-sm-offset-1">
                        <hr/>
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

                    <form method="POST" action="<?php echo base_url();?>business/company/signup" role="form" class="form-login">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input class="form-control" name="name" type="text">
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
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input class="form-control" name="phone" type="text">
                                </div>
                            </div>
                        </div>    
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input class="form-control" name="email" type="text">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Vat Number</label>
                                    <input class="form-control" name="vat_number" type="text">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Address *</label>
                                    <input class="form-control" name="address" type="text">
                                </div>
                            </div>
                        </div>                                              
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Postal Code *</label>
                                    <input class="form-control" name="postal_code" type="text">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Bank Number *</label>
                                    <input class="form-control" name="bank_number" type="text">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-10 col-sm-offset-1">
                            <hr/>
                        </div>                        
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 text-right margin-top-lg">
                                <p> Already Registered? Go to the
                                    <a href="<?php echo base_url()."business/company/signin"?>" >Sign In</a> Page
                                </p>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-lg btn-danger text-uppercase margin-right-30">Sign Up <span class="glyphicon glyphicon-ok-circle"></span></button>
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
