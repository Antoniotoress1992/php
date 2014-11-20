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
    <div class="container">
        <div class="row">
            <div class="col-sm-3 text-center header-item">
                <a class="navi-logo" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png"/>
                </a>
            </div>
            <div class="col-sm-2 text-center header-item">
                <b>FAQ</b>
            </div>
            <div class="col-sm-2 text-center header-item">
                <b>Costs</b>
            </div>
            <div class="col-sm-2 text-center header-item">
                <b>Contact Us</b>
            </div>            
            <div class="col-sm-3 text-center header-item">
                <?php if (!$this->session->userdata('company_id')) { ?>
                    <a href="<?php echo base_url()."business/company/signin"?>" class="btn btn-primary">Sign In</a>
                    <a href="<?php echo base_url()."business/company/signup"?>" class="btn btn-info">Sign Up</a>                
                <?php } else { ?>
                    <a href="<?php echo base_url()."business/company/signout"?>" class="btn btn-danger">Sign Out</a>                
                <?php } ?>
            </div>                        
        </div>
    </div>
</header>