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
    					<h3 class="page-title">Gift Sales History</h3>
    					<ul class="page-breadcrumb breadcrumb">
    						<li>
    							<i class="fa fa-home"></i>
    							<span>Gift Sales</span>
    							<i class="fa fa-angle-right"></i>
    						</li>
    						<li>
    							<span>History</span>
    						</li>
    					</ul>
    					
    				</div>
    			</div>    		
    		
    			<div class="row">
    			    <div class="col-sm-12">
    			        <div class="portlet box blue">
        			        <div class="portlet-title">
    							<div class="caption">
    								<i class="fa fa-navicon"></i> History
    							</div>
    						</div>
    						<div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Gift Name</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Company Name</th>                                    
                                            <th class="text-center">Saled At</th>
                                            <th class="text-center">Delivered</th>
                                            <th class="text-center">Project Name</th>                                    
                                            <th class="text-center">Receiver</th>
                                            <th class="text-center">Creator</th>
                                            <th class="text-center">Deliver To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1; 
                                            foreach ($histories as $history) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $history->name;?></td>
                                            <td><img src="<?php echo HTTP_GIFT_PATH.$history->thumb;?>" style="height: 30px;"></td>
                                            <td><?php echo $history->price;?></td>
                                            <td><?php echo $history->company_name;?></td>
                                            <td><?php echo $history->saled_at;?></td>
                                            <td><?php echo ($history->is_delivered) ? 'Yes' : 'No';?></td>
                                            <td><?php echo $history->project_name;?></td>
                                            <td><?php echo $history->receiver_tel;?></td>
                                            <td><?php echo $history->creator_tel;?></td>
                                            <td><?php echo ($history->is_creator) ? 'Creator' : 'Receiver';?></td>
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
