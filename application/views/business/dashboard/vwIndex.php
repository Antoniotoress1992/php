<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
    <link rel='stylesheet' href="<?php echo base_url();?>assets/css/datepicker.css" type='text/css' media='all'/>    
</head>
<body>
    <?php $this->load->view('business/vwHeader'); ?>
        <div class="container" style="min-height: 500px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('business/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center">
                    <h2>Dashboard</h2>
                    <div class="row">
                        <form class="form-horizontal" method="post" action="<?php echo base_url();?>backend/dashboard">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Search Date</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center readonly" name="startDate" id="startDate" placeholder="Start Date" readonly value="<?php echo $startDate;?>">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-center readonly" name="endDate" id="endDate" placeholder="End Date" readonly value="<?php echo $endDate;?>">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary" onclick="return validate();">Search</button>
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>                                
                                <div class="col-sm-3">
                                    <select class="form-control" id="period">
                                        <option value="0">Select Period</option>
                                        <option value="3">Last 3 days</option>
                                        <option value="7">Last 1 week</option>
                                        <option value="30">Last 1 month</option>
                                        <option value="60">Last 2 months</option>
                                        <option value="90">Last 3 months</option>
                                        <option value="180">Last 6 months</option>
                                        <option value="365">Last 1 year</option>
                                    </select>
                                </div>
                            </div>                        
                        </form>
                    </div>                     
                </div>
            </div>
        </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<?php $this->load->view('js/business/dashboard/jsIndex'); ?>
</html>
