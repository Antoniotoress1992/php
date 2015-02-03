<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
    <?php $this->load->view('backend/vwHeader'); ?>
    <div class="page-container">
        <?php $this->load->view('backend/vwLeftMenu'); ?>
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			<div class="row">
    				<div class="col-md-12">
    					<h3 class="page-title">User Management</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>User</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    						<li>
    							<span>Detail</span>
    						</li>
    					</ul>
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-pencil-square-o"></i> User Edit
    							</div>
    						</div>
    						<div class="portlet-body">
                    
                                <form method="POST" action="<?php echo base_url();?>backend/user/save" class="form-horizontal margin-top-normal" role="form">
                                    <input type="hidden" name="id" value="<?php echo $user->id?>"/>
                                    <?php
                                    $fields = [ 'phone' => 'Phone',
                                                'password' => 'Password',
                                                'name' => 'Name',
                                                'phone' => 'Phone',
                                                'country_id' => 'Country',
                                                'created_at' => 'Created At',
                                                'updated_at' => 'Updated At',
                                              ];
                                    foreach ($fields as $key => $value) {
                                        if ($key == 'created_at' || $key == 'updated_at') { 
                                    ?>
                                        <div class="form-group">
                                            <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                            <div class="col-sm-6">
                                                <p class="form-control-static"><?php echo $user->{$key}?></p>
                                            </div>
                                        </div>
                                    <?php } elseif ($key == 'country_id') { ?>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Country</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="country_id">
                                                    <?php foreach ($countries as $country) {?>
                                                        <option value="<?php echo $country->id;?>" <?php echo ($country->id == $user->country_id) ? 'selected' : '';?>><?php echo $country->name;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>                        
                                    <?php } else {
                                    ?>
                                        <div class="form-group">
                                            <label for="<?php echo $value;?>" class="col-sm-2 col-sm-offset-1 control-label"><?php echo $value;?></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" name="<?php echo $key;?>" type="<?php echo ($key == 'password') ? 'password' : 'text';?>" value='<?php echo set_value($key, $user->{$key}); ?>'>
                                            </div>
                                        </div>                        
                                    <?php
                                        }
                                    } ?>
            
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-offset-1 control-label"></label>
                                        <div class="col-sm-6 text-center">
                                            <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Save</button>
                                            <a class="btn btn-success" href="<?php echo base_url();?>backend/user"><span class="glyphicon glyphicon-new-window"></span>&nbsp;Back</a>
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
    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>


</html>
