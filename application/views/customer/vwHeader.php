    <!-- Modal -->
    <div class="modal fade" id="msgAlert" tabindex="-1" role="dialog" aria-labelledby="msgAlertLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="msgAlertLabel">Kickgifter</h4>
          </div>
          <div class="modal-body">
              <h4></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


<header class="navi">
    <div style="background: #003580; height: 65px;">
        <div class="container">
        <div class="navi-header pull-left" style="margin-top: 5px;">
            <a class="navi-logo" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/images/logo.png"/>
            </a>
        </div>
        <div class="pull-right">
            <ul class="nav nav-pills nav-top">
                <li style="width: 300px;">
                    <div class="pull-left color-white" style="width:40%; line-height: 38px;">Enter your code : </div>
                    <div class="pull-left" style="width:55%;"><input type="text" class="form-control"/></div>
                    <div class="clearfix"></div>
                </li>
                <li><a href="<?php echo base_url(); ?>page/how_it_works">How it works?</a></li>
                <?php if (!$this->session->userdata('user_id')) { ?>
                <li><a href="<?php echo base_url()."customer/user/signin"?>">Sign in</a></li>
                <li><a href="<?php echo base_url()."customer/user/signup"?>">Register</a></li>
                <?php } else { ?>
                <li><a href="<?php echo base_url()."customer/project/lists"?>">List</a></li>
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