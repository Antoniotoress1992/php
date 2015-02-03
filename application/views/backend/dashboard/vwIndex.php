<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('backend/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('backend/vwLeftMenu'); ?>
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			<div class="row">
    				<div class="col-md-12">
    					<h3 class="page-title">Dashboard</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Dashboard</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    					</ul>
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-pencil-square-o"></i> Dashboard
    							</div>
    						</div>
    						<div class="portlet-body">
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
                                <hr/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
        									<div class="visual">
        										<i class="fa fa-euro"></i>
        									</div>
        									<div class="details">
        										<div class="number">
        											 <?php echo $amountCollect;?>
        										</div>
        										<div class="desc">
        											 Total Money Collected
        										</div>
        									</div>
        								</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
        									<div class="visual">
        										<i class="fa fa-group"></i>
        									</div>
        									<div class="details">
        										<div class="number">
        											 <?php echo $countUser;?>
        										</div>
        										<div class="desc">
        											 Total User Collected
        										</div>
        									</div>
        								</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
        									<div class="visual">
        										<i class="fa fa-bar-chart-o"></i>
        									</div>
        									<div class="details">
        										<div class="number">
        											 <?php echo $countProject;?>
        										</div>
        										<div class="desc">
        											 <div class="text-center margin-top-xs">Total Project Collected</div>
        										</div>
        									</div>
        								</div>                                    
                                    </div>
                                                        
                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
        									<div class="visual">
        										<i class="fa fa-cloud"></i>
        									</div>
        									<div class="details">
        										<div class="number">
        											 <?php echo $countInvitor;?>
        										</div>
        										<div class="desc">
        											 Total Invitations
        										</div>
        									</div>
        								</div>                                    
                                    </div>
                                </div>
                    
                                <hr/>
                                <div class="row">
                                    <div id="container1" class="chart-container col-sm-12"></div>
                                    <div class="col-sm-12"><hr/></div>
                                    <div id="container2" class="chart-container col-sm-12"></div>
                                    <div class="col-sm-12"><hr/></div>
                                    <div id="container3" class="chart-container col-sm-12"></div>
                                    <div class="col-sm-12"><hr/></div>
                                    <div id="container4" class="chart-container col-sm-12"></div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts/modules/exporting.js"></script>
<?php $this->load->view('js/business/dashboard/jsIndex'); ?>

</html>
