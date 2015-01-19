<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        
        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('customer/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center">        
                    <div class="row text-center">
                        <h2>Dashboard</h2>
                        <div class="margin-top-20"></div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<script src="<?php echo base_url()."assets/js/bootbox.js"?>"></script>
<?php $this->load->view('js/customer/project/jsDetail'); ?>
</html>
