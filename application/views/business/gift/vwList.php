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
    								<i class="fa fa-navicon"></i> Gift List
    							</div>
    							<div class="actions">
								    <a href="<?php echo base_url(); ?>business/gift/add" class="btn btn-default btn-sm">
								        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add
								    </a>								    								    
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
                                <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Created At</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1; 
                                            foreach ($gifts as $gift) {?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $gift->name;?></td>
                                            <td><img src="<?php echo HTTP_GIFT_PATH.$gift->thumb;?>" style="height: 30px;"></td>
                                            <td><?php echo $gift->price;?></td>
                                            <td><?php echo $gift->created_at;?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?php echo base_url()."business/gift/edit/".$gift->id;?>">
                                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url()."business/gift/delete/".$gift->id;?>">
                                                    <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete
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
