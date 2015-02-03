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
			    <?php if ($this->session->userdata('admin_id')) { ?>
			    
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?php echo base_url()."backend/admin/signout"?>" class="dropdown-toggle">
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