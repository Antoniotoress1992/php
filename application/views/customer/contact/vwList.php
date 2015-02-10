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
                        <h2>Contact List</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'];?>"><?php echo $alert['msg'];?></div>
                            <?php } ?>
                        </div>
                    </div>                    
                    <div class="row text-right margin-bottom-xs">
                        <div class="btn-group">
                            <a class="btn btn-success btn-sm" href="<?php echo base_url()."customer/contact/add";?>">
                                <span class="glyphicon glyphicon-plus"></span>&nbsp;Add
                            </a>
                        </div>
                    </div>                    
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($contacts as $contact) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $contact->name;?></td>
                                    <td><?php echo $contact->phone;?></td>
                                    <td><?php echo $contact->created_at;?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo base_url()."customer/contact/edit/".$contact->id;?>">
                                            <span class="glyphicon glyphicon-share"></span> Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url()."customer/contact/delete/".$contact->id;?>">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </a>                                        
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>

</html>
