<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('widget/vwMeta'); ?>
    <?php $this->load->view('widget/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('widget/vwHeader'); ?>
    <div class="container">
        <div class="rows">
            <div class="col-sm-8 col-sm-offset-2">
            
                <div class="row text-center">
                    <h2>Project List</h2>
                </div>
                                   
                <div class="row">
                    <?php if (isset($alert)) { ?>
                        <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                    <?php } ?>
                </div>
                
                <table class="table table-projects">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Expired At</th>
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
                            <td><?php echo $project->amount?></td>
                            <td><?php echo $project->expired_at?></td>
                            <td>
                                <a class="btn btn-info btn-xs" href="<?php echo base_url()."widget/project/detail/".$project->id;?>">
                                    <span class="glyphicon glyphicon-share"></span> Detail
                                </a>                            
                            </td>
                        </tr>                        
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('widget/vwFooter'); ?>
</body>
<?php $this->load->view('widget/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/widget/project/jsAdd'); ?>
</html>
