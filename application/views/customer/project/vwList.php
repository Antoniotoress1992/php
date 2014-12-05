<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
        
        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="row text-center">
                <h2>Project List</h2>
            </div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Receiver</th>
                                <th>Country</th>
                                <th>Amount</th>
                                <th>Collected</th>
                                <th>Invitors</th>
                                <th>Expired At</th>
                                <th>Created At</th>
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
                                <td><?php echo $project->receiver_tel;?></td>
                                <td><?php echo $project->country_name;?></td>
                                <td><?php echo $project->amount;?></td>
                                <td><?php echo $project->crowded_amount;?></td>
                                <td><?php echo $project->cnt_invitors;?></td>
                                <td><?php echo $project->expired_at;?></td>
                                <td><?php echo $project->created_at;?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo base_url()."customer/project/detail/".$project->id;?>">
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
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>