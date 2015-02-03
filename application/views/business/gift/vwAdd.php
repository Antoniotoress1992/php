<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('business/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('business/vwLeftMenu'); ?>
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			<div class="row">
    				<div class="col-md-12">
    					<h3 class="page-title">Gifts</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Gift</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    						<li>
    							<span>Add</span>
    						</li>
    					</ul>
    					
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-pencil-square-o"></i> Gift Add
    							</div>     							
    						</div>
    						<div class="portlet-body">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>                    
                                    </div>
                                </div>
                            
                                <form method="POST" action="<?php echo base_url();?>business/gift/save" class="form-horizontal margin-top-normal" role="form" enctype='multipart/form-data'>
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
                                        <div class="col-sm-6 text-center">
                                            <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Save</button>
                                            <a class="btn btn-success" href="<?php echo base_url();?>business/gift"><span class="glyphicon glyphicon-new-window"></span>&nbsp;Back</a>
                                        </div>                            
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>


</html>
