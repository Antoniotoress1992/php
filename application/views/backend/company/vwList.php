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
    					<h3 class="page-title">Company Management</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Company</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    						<li>
    							<span>List</span>
    						</li>
    					</ul>
    					
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-navicon"></i> Company List
    							</div>
    						</div>
    						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
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
                                        <?php } ?>
                                    </tbody>
                                </table>
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

<script>
$(document).ready(function() {
    // begin first table
    $('#js-tbl-data').dataTable({
        "columns": [{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        },{
            "orderable": true
        }, {
            "orderable": false
        }],
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 15,            
        "pagingType": "bootstrap_full_number",
        "language": {
            "lengthMenu": "  _MENU_ records",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [0]
        }, {
            "searchable": false,
            "targets": [0]
        }],
        "order": [
            [0, "asc"]
        ] // set first column as a default sort by asc
    });
});
</script>

</html>
