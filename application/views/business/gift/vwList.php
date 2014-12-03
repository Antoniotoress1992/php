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
                    <h2>Gift List</h2>
                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="row text-right">
                        <a href="<?php echo base_url(); ?>business/gift/add" class="btn btn-primary" style="margin-bottom: 10px;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</a>
                    </div>
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($gifts as $gift) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $gift->name;?></td>
                                    <td><img src="<?php echo HTTP_GIFT_PATH.$gift->thumb;?>" style="height: 30px;"></td>
                                    <td><?php echo $gift->price;?></td>
                                    <td><?php echo $gift->created_at;?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo base_url()."business/gift/edit/".$gift->id;?>">
                                            <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url()."business/gift/delete/".$gift->id;?>">
                                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete
                                        </a>                                        
                                    </td>
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
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>
</html>
