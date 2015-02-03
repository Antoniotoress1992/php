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
    					<h3 class="page-title">iFrame Projects</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Project</span>
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
    								<i class="fa fa-navicon"></i> Project List
    							</div>
    						</div>
    						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Creator</th>                                    
                                            <th class="text-center">Receiver</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Created At</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1; 
                                            foreach ($projects as $project) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $project->name;?></td>
                                            <td><?php echo $project->creator_tel;?></td>
                                            <td><?php echo $project->receiver_tel;?></td>
                                            <td><?php echo $project->country_name;?></td>
                                            <td><?php echo $project->amount;?></td>
                                            <td><?php echo $project->created_at;?></td>
                                            <td>
                                                <a href="<?php echo base_url()."business/project/detail/".$project->id;?>" class="btn btn-info btn-sm">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Detail
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
            </div>
        </div>
    </div>
    <?php $this->load->view('business/vwFooter'); ?>
</body>
<?php $this->load->view('business/vwJs'); ?>


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
