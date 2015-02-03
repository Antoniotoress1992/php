<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler"></div>
            </li>

            <li class="start <?php echo ($pageNo == 51) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/dashboard">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 52) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/user">
                    <i class="fa fa-user"></i>
                    <span class="title">User Management</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 53) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/company">
                    <i class="fa fa-building"></i>
                    <span class="title">Company Management</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 54) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/project">
                    <i class="fa fa-share-alt"></i>
                    <span class="title">Project Management</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 55) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/gift">
                    <i class="fa fa-gift"></i>
                    <span class="title">Gift Management</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 56) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/gift/history">
                    <i class="fa fa-bookmark"></i>
                    <span class="title">Gift Sales History</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 57) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/coupon/history">
                    <i class="fa fa-book"></i>
                    <span class="title">Coupon Code History</span>
                </a>
            </li>
            
            <li class="last <?php echo ($pageNo == 58) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/bank/history">
                    <i class="fa fa-bank"></i>
                    <span class="title">Bank Transfer History</span>
                </a>
            </li>
            
            <!-- li class="<?php echo ($pageNo == 59) ? "active" : "";?>">
                <a href="<?php echo base_url();?>backend/admin/setting">
                    <i class="fa fa-gear"></i>
                    <span class="title">Setting</span>
                </a>
            </li -->                          
            								
        </ul>
    </div>
</div>
<!-- END SIDEBAR -->