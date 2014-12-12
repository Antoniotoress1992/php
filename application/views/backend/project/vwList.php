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
                
                    <h2>Project List</h2>
                    
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Creator</th>                                    
                                    <th class="text-center">Receiver</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($projects as $project) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $project->name;?></td>
                                    <td><?php echo $project->creator_tel;?></td>
                                    <td><?php echo $project->receiver_tel;?></td>
                                    <td><?php echo $project->country_name;?></td>
                                    <td><?php echo $project->amount;?></td>
                                    <td><?php echo $project->created_at;?></td>
                                    <td>
                                        <a href="<?php echo base_url()."backend/project/detail/".$project->id;?>" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-edit"></span>&nbsp;Detail
                                        </a>                                    
                                    </td>
                                </tr>
                                <?php }
                                if (count($projects) == 0) { ?>
                                    <tr><td colspan="8">There is no projects</td></tr>
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
