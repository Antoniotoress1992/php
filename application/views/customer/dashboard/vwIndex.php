<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        
        <div class="background-dashboard"></div>
        <div class="container" style="margin-top: 70px; margin-bottom: 30px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('customer/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center border-blue">        
                    <div class="row text-center">
                        <h2>Dashboard</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row"><hr/></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="alert alert-info" role="alert">
                                <h4>Opened Projects<br/><br/></h4>
                                <?php echo $openedProjects;?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="alert alert-info" role="alert">
                                <h4>Paid Today<br/><br/></h4>
                                <?php echo $paidToday;?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="alert alert-info" role="alert">
                                <h4>Project Created This Week</h4>
                                <?php echo $countCreatedWeek;?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="alert alert-info" role="alert">
                                <h4>Project Expired This Week</h4>
                                <?php echo $countExpiredWeek;?>
                            </div>
                        </div>                                                                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="text-left pull-left">Opened Project Today</h4>
                            <table class="table table-mobile">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Expired At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach ($createdToday as $item) {?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><a href="<?php echo base_url()."customer/project/detail/".$item->id;?>"><?php echo $item->name;?></a></td>
                                        <td><?php echo $item->amount;?></td>
                                        <td><?php echo $item->expired_at;?></td>
                                    </tr>
                                    <?php }
                                    if (count($createdToday) == 0) { ?>
                                    <tr>
                                        <td colspan="4" class="text-center">There is no projects created today</td>
                                    </tr>                                        
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-left pull-left">Expires Project Today</h4>
                            <table class="table table-mobile">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach ($expiredToday as $item) {?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><a href="<?php echo base_url()."customer/project/detail/".$item->id;?>"><?php echo $item->name;?></a></td>
                                        <td><?php echo $item->amount;?></td>
                                        <td><?php echo substr($item->created_at, 0, 10);?></td>
                                    </tr>
                                    <?php }
                                    if (count($expiredToday) == 0) { ?>
                                    <tr>
                                        <td colspan="4" class="text-center">There is no projects expires today</td>
                                    </tr>                                        
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>                           
                    </div>
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
