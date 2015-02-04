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
                        <h2>Shopping</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row">
                        <hr/>
                    </div>
                    <form method="post" action="<?php echo base_url()."customer/project/submit_gift";?>" class="form-horizontal" role="form">
                        <input type="hidden" name="project_id" value="<?php echo $project_id;?>"/>
                        <input type="hidden" name="gift_ids" value=""/>
                        <input type="hidden" name="is_creator" value="1"/>
                        <div class="row">
                            <div class="form-horizontal" role="form">
                            
                                <div class="row">
                                    <?php if (isset($alert)) { ?>
                                        <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                                    <?php } ?>
                                </div>
                                                    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label col-sm-offset-6">Amount Avaiable</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="left" class="form-control text-center readonly" id="js-left" value="<?php echo $amount_status['avaiable'];?>" readonly/>
                                        <input type="hidden" name="avaiable" id="js-avaiable" value="<?php echo $amount_status['avaiable'];?>"/>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped" style="background: #FFF;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Thumb</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($gifts as $gift) {?>
                                    <tr>
                                        <td><input type="checkbox" value="<?php echo $gift->id;?>" id="js-checkbox-item"/></td>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $gift->name;?></td>
                                        <td><img src="<?php echo HTTP_GIFT_PATH.$gift->thumb;?>" style="height: 30px;"></td>
                                        <td><?php echo $gift->price;?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-primary" onclick="return onBtnBuy(1);">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Deliver To Me
                                </button>
                                <button class="btn btn-info" onclick="return onBtnBuy(0);">
                                    <span class="glyphicon glyphicon-gift"></span>
                                    Deliver To Friend
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-success" href="<?php echo base_url()."customer/project/detail/".$project_id;?>">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                    Back
                                </a>                        
                            </div>
                        </div>
                    </form>                                    
                </div>
            </div>
        </div>
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<?php $this->load->view('js/customer/project/jsShop'); ?>
</html>
