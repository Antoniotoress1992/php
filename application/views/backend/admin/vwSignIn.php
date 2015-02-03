<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">    
    <?php $this->load->view('backend/vwHeader'); ?>
    <div class="page-container">
        <div class="page-contect-wrapper">
    	    <div class="page-content">
                <div class="col-sm-6 col-sm-offset-3 thumbnail margin-top-xl margin-bottom-xl">
                    <div class="row text-center">
                        <h2>Sign In For Backend</h2>
                    </div>
                    
                    <div class="col-sm-10 col-sm-offset-1">
                        <hr/>
                    </div>
        
                    <div class="row margin-top-xs">
                        <div class="col-sm-6 col-sm-offset-3 text-center">
                            <?php if (isset($alert)) {?>
                                <div class="alert alert-<?php echo $alert['type']?>" role="alert">
                                        <?php echo $alert['msg']?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
            
                    <form method="POST" action="<?php echo base_url();?>backend/admin/signin" role="form" class="form-login">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Username *</label>
                                    <input class="form-control" name="username" type="text">
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
                        
                        <div class="col-sm-10 col-sm-offset-1">
                            <hr/>
                        </div>                        
                        
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 text-right margin-top-lg">                    
                                <button class="btn btn-lg btn-danger text-uppercase margin-right-30">Sign In <span class="glyphicon glyphicon-ok-circle"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>
</html>
