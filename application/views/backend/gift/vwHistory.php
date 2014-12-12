<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('backend/vwHeader'); ?>
        <div class="container" style="min-height: 500px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('backend/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center">
                
                    <h2>Gift Sales History</h2>
                    
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Gift Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Company Name</th>                                    
                                    <th class="text-center">Saled At</th>
                                    <th class="text-center">Delivered</th>
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
                                    <td><?php echo $history->name;?></td>
                                    <td><img src="<?php echo HTTP_GIFT_PATH.$history->thumb;?>" style="height: 30px;"></td>
                                    <td><?php echo $history->price;?></td>
                                    <td><?php echo $history->company_name;?></td>
                                    <td><?php echo $history->saled_at;?></td>
                                    <td><?php echo ($history->is_delivered) ? 'Yes' : 'No';?></td>
                                    <td><?php echo $history->project_name;?></td>
                                    <td><?php echo $history->receiver_tel;?></td>
                                    <td><?php echo $history->creator_tel;?></td>
                                </tr>
                                <?php }
                                if (count($histories) == 0) { ?>
                                    <tr><td colspan="10">There is no gifts sales</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>


</html>
