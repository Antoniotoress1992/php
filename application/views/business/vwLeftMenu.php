<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler"></div>
            </li>

            <li class="start <?php echo ($pageNo == 11) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/dashboard">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 12) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/gift">
                    <i class="fa fa-gift"></i>
                    <span class="title">Gifts</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 13) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/company/setting">
                    <i class="fa fa-gear"></i>
                    <span class="title">Settings</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 14) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/widget">
                    <i class="fa fa-send"></i>
                    <span class="title">Widget</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 15) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/gift/history">
                    <i class="fa fa-bookmark"></i>
                    <span class="title">Gift Saled History</span>
                </a>
            </li>
            
            <li class="<?php echo ($pageNo == 16) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/coupon/history">
                    <i class="fa fa-book"></i>
                    <span class="title">Coupon Saled History</span>
                </a>
            </li>
            
            <li class="last <?php echo ($pageNo == 17) ? "active" : "";?>">
                <a href="<?php echo base_url();?>business/project">
                    <i class="fa fa-share-alt"></i>
                    <span class="title">iFrame Projects</span>
                </a>
            </li>								
        </ul>
    </div>
</div>
<!-- END SIDEBAR -->