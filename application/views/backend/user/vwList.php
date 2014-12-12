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
                
                    <h2>User List</h2>
                    
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Country</th>                                    
                                    <th class="text-center">Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($users as $user) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $user->phone;?></td>
                                    <td><?php echo $user->country_name;?></td>
                                    <td><?php echo $user->created_at;?></td>
                                    <td>
                                        <a href="<?php echo base_url()."backend/user/detail/".$user->id;?>" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                        </a>
                                    </td>
                                </tr>
                                <?php }
                                if (count($users) == 0) { ?>
                                    <tr><td colspan="5">There is no users</td></tr>
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
