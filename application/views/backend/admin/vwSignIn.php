<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('backend/vwHeader'); ?>
    <div class="container">       
        <div class="row margin-top-30">
        </div>
        
        <div class="row text-center">
            <h2>Sign In For Backend</h2>
        </div>
        
        <div class="row margin-top-10">
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
            
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 text-right margin-top-50">                    
                    <button class="btn btn-lg btn-danger text-uppercase margin-right-30">Sign In <span class="glyphicon glyphicon-ok-circle"></span></button>
                </div>
            </div>
        </form>        
        
    </div>
    

    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>
</html>
