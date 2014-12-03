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
                    <h2>Gift Add</h2>
                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>                    
                        </div>
                    </div>
                
                    <form method="POST" action="<?php echo base_url();?>business/gift/save" class="form-horizontal margin-top-30" role="form" enctype='multipart/form-data'>
                        <?php
                        $fields = [ 'name' => 'Name',
                                    'thumb' => 'Image',
                                    'price' => 'Price', ];
                        foreach ($fields as $key => $value) { 
                        ?>
                            <div class="form-group">
                                <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="<?php echo $key;?>" type="<?php echo ($key == 'thumb') ? 'file' : 'text';?>" value='<?php echo set_value($key); ?>'>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-1 control-label"></label>
                            <div class="col-sm-6">
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Save</button>
                                <a class="btn btn-success" href="<?php echo base_url();?>business/gift"><span class="glyphicon glyphicon-new-window"></span>&nbsp;Back</a>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>


</html>
