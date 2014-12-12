<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('backend/vwMeta'); ?>
    <?php $this->load->view('backend/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('backend/vwHeader'); ?>
        <div class="container" style="min-height: 500px;">
            <div class="row">
                <div class="col-sm-3">
                    <h1>&nbsp;</h1>
                    <div class="list-group front-leftmenu">
                        <?php $this->load->view('backend/vwLeftMenu'); ?>                
                    </div>                
                </div>
                <div class="col-sm-9 text-center">
                
                    <h2>Company List</h2>
                    
                    <div class="row">
                        <table class="table table-strip">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">VAT ID</th>                                    
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Postal Code</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Bank Number</th>
                                    <th class="text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1; 
                                    foreach ($companies as $company) {?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $company->name;?></td>
                                    <td><?php echo $company->vat_number;?></td>
                                    <td><?php echo $company->address;?></td>
                                    <td><?php echo $company->postal_code;?></td>
                                    <td><?php echo $company->phone;?></td>
                                    <td><?php echo $company->email;?></td>
                                    <td><?php echo $company->bank_number;?></td>
                                    <td><?php echo $company->created_at;?></td>
                                </tr>
                                <?php }
                                if (count($companies) == 0) { ?>
                                    <tr><td colspan="9">There is no companies</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    <?php $this->load->view('backend/vwFooter'); ?>
</body>
<?php $this->load->view('backend/vwJs'); ?>


</html>
