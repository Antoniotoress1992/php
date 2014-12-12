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
                
                    <h2>Gift List</h2>
                    
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Price</th>                                    
                                    <th class="text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($gifts as $gift) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $gift->company_name;?></td>
                                    <td><?php echo $gift->name;?></td>
                                    <td><img src="<?php echo HTTP_GIFT_PATH.$gift->thumb;?>" style="height: 30px;"/></td>
                                    <td><?php echo $gift->price;?></td>
                                    <td><?php echo $gift->created_at;?></td>

                                </tr>
                                <?php }
                                if (count($gifts) == 0) { ?>
                                    <tr><td colspan="6">There is no gifts</td></tr>
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
