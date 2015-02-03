<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('business/vwMeta'); ?>
    <?php $this->load->view('business/vwCss'); ?>
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap-colorpicker.min.css" rel="stylesheet">
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('business/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('business/vwLeftMenu'); ?>
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			<div class="row">
    				<div class="col-md-12">
    					<h3 class="page-title">Widget</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Widget</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    					</ul>
    					
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-pencil-square-o"></i> Widget
    							</div>     							
    						</div>
    						<div class="portlet-body">
                    
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <?php if (isset($alert)) { ?>
                                            <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                                        <?php } ?>
                                    </div>
                                </div>                    
                    
                                <div class="row">
                                    <form method="POST" action="<?php echo base_url();?>business/widget/update" class="form-horizontal margin-top-normal" role="form" enctype='multipart/form-data'>
                                        <?php
                                        $fields = [ 'w_name' => 'Company Name',
                                                    'w_logo' => 'Logo',
                                                    'w_width' => 'Width',
                                                    'w_height' => 'Height',
                                                    'w_color' => 'Color',
                                                    'w_background' => 'Background',
                                                    'w_notification_url' => 'Notification Url',
                                                  ];
                                        foreach ($fields as $key => $value) { ?>
                                        <div class="form-group">
                                            <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                            <div class="col-sm-6">
                                                <?php if ($key == 'w_color' || $key == 'w_background') {?>
                                                    <div class="input-group" id="js-div-<?php echo $key;?>">
                                                        <input type="text" name="<?php echo $key;?>" value="<?php echo set_value($key, isset($company->{$key}) ? $company->{$key} : ''); ?>" class="form-control readonly" readonly/>
                                                        <span class="input-group-addon"><i></i></span>
                                                    </div>                                  
                                                <?php } else {?>
                                                    <input class="form-control" name="<?php echo $key;?>" type="<?php echo ($key == 'w_logo') ? 'file' : 'text';?>" value='<?php echo set_value($key, isset($company->{$key}) ? $company->{$key} : ''); ?>'>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                            <div class="col-sm-12">
                                                <hr/>
                                            </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-offset-1 control-label">Embed URL</label>
                                            <div class="col-sm-6">
                                                <?php
                                                    $embed = "http://".HOST_SERVER."/embed/main/".$company->token;
                                                    $embed = "<iframe width='".$company->w_width."' height='".$company->w_height."' src='$embed' frameborder='0'></iframe>";
                                                ?>
                                                <textarea class="form-control" style="cursor: pointer;" readonly rows="3"><?php echo $embed;?></textarea>
                                            </div>                            
                                        </div>      
                                                                    
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-offset-1 control-label"></label>
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Save</button>
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
    </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>
<script type="text/javascript" src="<?php echo base_url()."assets/js/bootstrap-colorpicker.min.js"?>"></script>
<?php $this->load->view('js/business/widget/jsIndex'); ?>
</html>
