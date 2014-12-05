<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
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
                    <h2>Coupon Saled History</h2>

                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Coupon Code</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Saled At</th>
                                    <th class="text-center">Project Name</th>                                    
                                    <th class="text-center">Receiver</th>
                                    <th class="text-center">Creator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($histories as $history) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $history->coupon_code;?></td>
                                    <td><?php echo $history->amount;?></td>
                                    <td><?php echo $history->created_at;?></td>
                                    <td><?php echo $history->project_name;?></td>
                                    <td><?php echo $history->receiver_tel;?></td>
                                    <td><?php echo $history->creator_tel;?></td>
                                </tr>
                                <?php }
                                if (count($histories) == 0) { ?>
                                    <tr><td colspan="7">There is no coupon saled</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>
</html>
