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
                                <span>Expenses</span>
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
                                    <i class="fa fa-pencil-square-o"></i> Expenses
                                </div>
                            </div>
                            <div class="portlet-body">
							   <div class = "row">
									<div class = "col-sm-4">
										<div class="dropdown">
										  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">New
										  <span class="caret"></span></button>
										  <ul class="dropdown-menu">
											<li><a href="/customer/purchase">Purchase</a></li>
											
										  </ul>
										</div>
									</div>
									<div class = "col-sm-2 pull-right text-right">
										<a type="submit" class="btn green" href = "/customer/pruchase/search?state=All"><i class="fa fa-search"></i> Submit</a>
									</div>
							   </div>	
                               <div class="row" style = "margin-top:20px;">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="dashboard-stat blue-madison">
											<div class="visual">
												<i class="fa fa-comments"></i>
											</div>
											<div class="details">
												<div class="number">
													 0
												</div>
												<div class="desc">
													 Draft
												</div>
											</div>
											
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="dashboard-stat red-intense">
											<div class="visual">
												<i class="fa fa-bar-chart-o"></i>
											</div>
											<div class="details">
												<div class="number">
													 0
												</div>
												<div class="desc">
													 Awaiting Approval
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="dashboard-stat green-haze">
											<div class="visual">
												<i class="fa fa-shopping-cart"></i>
											</div>
											<div class="details">
												<div class="number">
													 0
												</div>
												<div class="desc">
													 Awaiting Payment
												</div>
											</div>
											
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="dashboard-stat purple-plum">
											<div class="visual">
												<i class="fa fa-globe"></i>
											</div>
											<div class="details">
												<div class="number">
													 0
												</div>
												<div class="desc">
													 Overdue
												</div>
											</div>
											
										</div>
									</div>
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
</html>
<script type = "text/javascript">
	$(document).ready(function() {
	    $(".dropdown-toggle").dropdown();
	});
</script>
