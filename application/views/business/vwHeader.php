<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/">
			    <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" class="logo-default" style="height: 32px; margin-top: 10px;"/>
			</a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
			    <?php if (!$this->session->userdata('company_id')) { ?>
			    
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="/" class="dropdown-toggle">
				        <i class="icon-home"></i> Home
					</a>
				</li>			    
			    
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?php echo base_url()."business/company/signin"?>" class="dropdown-toggle">
				        <i class="fa fa-sign-in"></i> Sign In
					</a>
				</li>
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?php echo base_url()."business/company/signup"?>" class="dropdown-toggle">
				        <i class="fa fa-pencil-square-o"></i> Register
					</a>
				</li>
				<?php } else { ?>
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?php echo base_url()."business/company/signout"?>" class="dropdown-toggle">
				        <i class="icon-logout"></i> Sign Out
					</a>
				</li>
				<?php } ?>		
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>

<div class="clearfix"></div>