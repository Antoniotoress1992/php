<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
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
                        <h2>Project List</h2>
                        <div class="margin-top-sm"></div>
                    </div>
                    <div class="row">
                        <hr/>
                    </div>
                    <div class="row text-right margin-bottom-xs">
                        <div class="btn-group">
                            <a href="<?php echo base_url()."customer/project/lists";?>" class="btn-project-type btn <?php echo ($type == 'all') ? 'btn-primary' : 'btn-default';?>">All</a>
                            <a href="<?php echo base_url()."customer/project/lists/now";?>" class="btn-project-type btn <?php echo ($type == 'now') ? 'btn-primary' : 'btn-default';?>">Now</a>
                            <a href="<?php echo base_url()."customer/project/lists/expired";?>" class="btn-project-type btn <?php echo ($type == 'expired') ? 'btn-primary' : 'btn-default';?>">Expired</a>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover" id="js-tbl-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Receiver</th>
                                    <th>Country</th>
                                    <th>Amount</th>
                                    <th>Collected</th>
                                    <th>Inviters</th>
                                    <th>Expired At</th>
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
                                    <td><?php echo $project->receiver_tel;?></td>
                                    <td><?php echo $project->country_name;?></td>
                                    <td><?php echo $project->amount;?></td>
                                    <td><?php echo $project->crowded_amount;?></td>
                                    <td><?php echo $project->cnt_invitors;?></td>
                                    <td><?php echo $project->expired_at;?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo base_url()."customer/project/detail/".$project->id;?>">
                                            <span class="glyphicon glyphicon-share"></span> Detail
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
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>
<?php $this->load->view('js/customer/home/jsIndex'); ?>

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
