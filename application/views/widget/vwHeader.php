<?php 
if ($this->session->userdata('business_id')) {
    $ci =&get_instance(); 
    $ci->load->model('company_model');
    $company = $ci->company_model->detail($this->session->userdata('business_id'));
}
?>

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
    <div style="padding-bottom: 12px;">
        <div class="container">
            <div class="navi-header pull-left" style="margin-top: 5px;">
                <div class="navi-logo">
                    <?php if (isset($company)) {?>
                        <img src="<?php echo HTTP_LOGO_PATH.$company->w_logo; ?>" style="height: 50px;"/>
                        <span class="font-size-20"><?php echo $company->w_name; ?></span>
                    <?php } else {?>
                        <img src="<?php echo HTTP_LOGO_PATH."default.png"; ?>" style="height: 50px;"/>
                        <span class="font-size-20">Kickgifter</span>
                    <?php } ?>
                </div>
            </div>
            <div class="pull-right">
                <ul class="nav nav-pills nav-top">
                    <?php
                        if (!isset($pageNo)) { 
                            $pageNo = 91; 
                        } 
                    ?>
                    <li <?php echo ($pageNo == 91) ? "class='active'" : "";?>><a href="<?php echo base_url()."widget/project/add"?>">Home</a></li>                
                    <?php if (!$this->session->userdata('user_id')) { ?>
                    <li <?php echo ($pageNo == 92) ? "class='active'" : "";?>><a href="<?php echo base_url()."widget/user/signin"?>">Sign In</a></li>
                    <li><a href="<?php echo base_url()."customer/user/signup"?>" target="_blank">Register</a></li>
                    <?php } else { ?>
                    <li <?php echo ($pageNo == 93) ? "class='active'" : "";?>><a href="<?php echo base_url()."widget/project/lists"?>">Projects</a></li>
                    <li><a href="<?php echo base_url()."widget/user/signout"?>">Sign Out</a></li>                
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>        
</header>