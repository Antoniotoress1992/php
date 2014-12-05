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
                <h2>Project Detail</h2>
                <div class="margin-top-20"></div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-horizontal" role="form">
                        <?php
                        $fields = [ 'name' => 'Name',
                                    'receiver_tel' => 'Receiver',
                                    'country_name' => 'Country',
                                    'amount' => 'Amount',
                                    'crowded_amount' => 'Crowded Amount',
                                    'message' => 'Message',
                                    'created_at' => 'Created At',
                                    'updated_at' => 'Updated At',
                                  ];
                        foreach ($fields as $key => $value) { 
                        ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $value;?></label>
                                <div class="col-sm-9">
                                <?php if ($key == 'message') { ?>
                                    <textarea class="form-control" rows="5"><?php echo $project->{$key};?></textarea>
                                <?php } else {?>
                                    <p class="form-control-static"><?php echo $project->{$key};?></p>
                                <?php }?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/lists"?>">
                                    <span class="glyphicon glyphicon-list"></span>
                                    List
                                </a>
                                &nbsp;
                                <a class="btn btn-info" href="<?php echo base_url()."customer/home"?>">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Home
                                </a>
                            </div>
                        </div>                        
                        <hr/>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3>Invitors</h3>
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($invitors as $invitor) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $invitor->invitor_tel;?></td>
                                        </tr>
                                        <?php }
                                        if (count($invitors) == 0) { ?>
                                        <tr>
                                            <td colspan="2" class="text-center">There is no invitors</td>
                                        </tr>                                        
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-8">
                                <h3>Payers</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Payed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1; 
                                        foreach ($payers as $payer) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $payer->tel;?></td>
                                            <td><?php echo $payer->amount;?></td>
                                            <td><?php echo $payer->created_at;?></td>
                                        </tr>
                                        <?php }
                                        if (count($payers) == 0) { ?>
                                        <tr>
                                            <td colspan="4" class="text-center">There is no payers</td>
                                        </tr>                                        
                                        <?php } ?>
                                    </tbody>
                                </table>                                
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>
</html>
