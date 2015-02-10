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
                        <h2>Add Contact</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                                     
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1">
                            <hr/>
                            </div>
                        </div>                    
                        <form action="<?php echo base_url()."customer/contact/save"?>" class="form-horizontal form-horizontal-custom" role="form" method="post">
                            <input type="hidden" name="contact_id"/>                                                
                            <?php
                            $fields = [ 'name' => 'Name',
                                        'phone' => 'Phone',
                                      ];
                            foreach ($fields as $key => $value) { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $value;?> : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="<?php echo $key;?>"></p>
                                </div>                                        
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                <hr/>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info">
                                    <span class="glyphicon glyphicon-floppy-saved"></span> Save
                                </button>
                                <a class="btn btn-danger" href="<?php echo base_url()."customer/contact/lists"?>">
                                    <span class="glyphicon glyphicon-share-alt"></span> Back
                                </a>
                            </div>
                        </form>
                    </div>                                     
                    
                </div>
            </div>
        </div>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>

</html>
