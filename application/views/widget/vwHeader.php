<?php 
if ($this->session->userdata('business_id')) {
    $ci =&get_instance(); 
    $ci->load->model('company_model');
    $company = $ci->company_model->detail($this->session->userdata('business_id'));
}
?>
<style>
body {
    color: <?php echo $company->w_color;?>;
    background: <?php echo $company->w_background;?>;
}
</style>

<header class="navi">
    <div style="padding-bottom: 12px;">
        <div class="container">
            <div class="navi-header pull-left" style="margin-top: 5px;">
                <div class="navi-logo">
                    <?php if (isset($company)) {?>
                        <img src="<?php echo HTTP_LOGO_PATH.$company->w_logo; ?>" style="height: 100%;"/>
                        <span class="font-size-20 navi-company-name"><?php echo $company->w_name; ?></span>
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
                    <?php if (!$this->session->userdata('wuser_id')) { ?>
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