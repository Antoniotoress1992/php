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
            <div class="row text-center">
                <h2>Project Detail</h2>
                <div class="margin-top-20"></div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-horizontal" role="form">
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $project->name;?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $project->receiver_tel;?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $project->country_name;?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $project->amount;?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Crowded Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $project->crowded_amount;?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5"><?php echo $project->message;?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/lists"?>">List</a>
                                &nbsp;
                                <a class="btn btn-info" href="<?php echo base_url()."customer/home"?>">Home</a>
                            </div>
                        </div>                        

                    </div>                    
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>
