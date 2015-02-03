<header class="navi">
    <div style="background: #003580; padding-bottom: 12px;">
        <div class="container">
        <div class="navi-header pull-left" style="margin-top: 5px;">
            <a class="navi-logo" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/images/logo.png"/>
            </a>
        </div>
        <div class="pull-right">
            <ul class="nav nav-pills nav-top">
                <!-- li style="width: 300px;">
                    <div class="pull-left color-white" style="width:40%; line-height: 38px;">Enter your code : </div>
                    <div class="pull-left" style="width:55%;"><input type="text" class="form-control"/></div>
                    <div class="clearfix"></div>
                </li -->
                <?php
                    if (!isset($pageNo)) { 
                        $pageNo = 0; 
                    } 
                ?>
                <li <?php echo ($pageNo == 1) ? "class='active'" : "";?>><a href="<?php echo base_url(); ?>page/how_it_works">How it works?</a></li>
                <?php if (!$this->session->userdata('user_id')) { ?>
                <li><a href="<?php echo base_url()."business/company/signin"?>">Business Login</a></li>
                <li><a href="<?php echo base_url()."customer/user/signin"?>">Sign In</a></li>
                <li><a href="<?php echo base_url()."customer/user/signup"?>">Register</a></li>
                <?php } else { ?>
                <li <?php echo ($pageNo == 2 || $pageNo == 3 || $pageNo == 4) ? "class='active'" : "";?>><a href="<?php echo base_url()."customer/dashboard"?>">Dashboards</a></li>
                <li><a href="<?php echo base_url()."customer/user/signout"?>">Sign Out</a></li>
                <?php } ?>
            </ul>
        </div>
                
            <!-- div class="row" >
                <div class="col-sm-4 text-center">
                    <a class="navi-logo" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>assets/images/logo.png"/>
                    </a>
                </div>
                <div class="col-sm-8 text-right">
                    <a href="#">How It Works?</a>
                    <a href="#">Sign In</a>
                    <a href="#">Register</a>
                </div>    
                <div class="col-sm-3 text-center header-item">
                    <?php if (!$this->session->userdata('user_id')) { ?>
                        <a href="<?php echo base_url()."customer/user/signin"?>" class="btn btn-primary">Sign In</a>
                        <a href="<?php echo base_url()."customer/user/signup"?>" class="btn btn-info">Sign Up</a>                
                    <?php } else { ?>
                        <a href="<?php echo base_url()."customer/project/lists"?>" class="btn btn-primary">List</a>
                        <a href="<?php echo base_url()."customer/user/signout"?>" class="btn btn-danger">Sign Out</a>                
                    <?php } ?>
                </div>                        
            </div -->
        </div>
    </div>        
</header>