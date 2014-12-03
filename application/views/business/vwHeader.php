    <!-- Modal -->
    <div class="modal fade" id="msgAlert" tabindex="-1" role="dialog" aria-labelledby="msgAlertLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="msgAlertLabel"><?php echo SITE_NAME;?></h4>
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
                    <?php
                        if (!isset($pageNo)) { 
                            $pageNo = 0; 
                        } 
                    ?>
                    
                    <?php if (!$this->session->userdata('company_id')) { ?>
                        <li><a href="<?php echo base_url()."business/company/signin"?>">Sign in</a></li>
                        <li><a href="<?php echo base_url()."business/company/signup"?>">Register</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url()."business/company/signout"?>">Sign Out</a></li>                
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>        
</header>