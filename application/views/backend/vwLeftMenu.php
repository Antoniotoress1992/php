<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler"></div>
            </li>
            <li class="start <?php echo ($pageNo == 50) ? "active" : "";?>">
                    <a href="javascript:;">
                        <i class="icon-basket"></i>
                        <span class="title">Accounting</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/customer/accounting">
                            <i class="icon-home"></i>
                            Transaction</a>
                        </li>
                    </ul>
            </li>    
           
            <li class="<?php echo ($pageNo == 52) ? "active" : "";?>">
                <a href="<?php echo base_url();?>customer/expense">
                    <i class="fa fa-user"></i>
                    <span class="title">Expense</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/expense/index">
                            <i class="icon-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 62) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/purchase">
                            <i class="icon-home"></i>
                            Purchase
                        </a>
                    </li>
                  
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($pageNo == 54) ? "active" : "";?>">
                <a href="<?php echo base_url();?>customer/sales">
                    <i class="fa fa-building"></i>
                    <span class="title">Sales</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/sales/index">
                            <i class="icon-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 62) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/invoice">
                            <i class="icon-home"></i>
                            Invoice
                        </a>
                    </li>
                  
                    </li>
                </ul>
            </li>

            <?php 
                $firstDay = date('Y').('-01-01');
                $lastDay = date('Y') . '-12-31';
            ?>

            <li class="<?php echo ($pageNo == 53) ? "active" : "";?>">
                <a href="<?php echo base_url();?>customer/report">
                    <i class="fa fa-building"></i>
                    <span class="title">Reports</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/accountReport/income?period_start=<?php echo  $firstDay;?>&period_end=<?php echo $lastDay;?>">
                            <i class="icon-home"></i>
                            Profit and Loss Report
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 62) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/accountReport/search?state=All">
                            <i class="icon-home"></i>
                            Accounting Report
                        </a>
                    </li>
                  
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/accountReport/balance">
                            <i class="icon-home"></i>
                            Balance Sheet 
                        </a>
                    </li>
                    <?php $nowDate = date("Y-m-d");?>
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/accountReport/trial?date=<?php echo $nowDate;?>">
                            <i class="icon-home"></i>
                            Trial balance 
                        </a>
                    </li>
                    <li class="<?php echo ($pageNo == 61) ? "active" : "";?>">
                        <a href="<?php echo base_url();?>customer/accountReport/accountingPeriod">
                            <i class="icon-home"></i>
                            Accounting Period 
                        </a>
                    </li>
                </ul>
            </li>

    </div>
</div>
<!-- END SIDEBAR -->