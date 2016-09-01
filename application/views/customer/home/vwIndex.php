<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
    <link href="<?php echo base_url()."assets/css/datepicker.css"?>" rel="stylesheet">
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
    <main class="bg-main1">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1 color-white margin-top-lg margin-bottom-lg text-center">
                <h2><b>Accounting was the course that helped me more than anything.</b></h2>
                
                <?php if (isset($message)) {?>
                <h3>
                    <div class="text-center alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                </h3>
                <?php } ?>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
              
                
                          
            </div>
        
        </div>
    </main>


    
    <div class="modal fade" id="js-dlg-contacts">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo SITE_NAME;?></h4>
                </div>
                <div class="modal-body">
                    <p>Select your friends.</p>
                    <?php foreach ($contacts as $contact) {?>
                        <button class="btn btn-default btn-sm" id="js-btn-friend" data-phone="<?php echo $contact->phone;?>"><?php echo $contact->name."(".$contact->phone.")";?></button>
                    <?php } ?>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="js-btn-submit-add-more">Ok</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
<script src="<?php echo base_url()."assets/js/bootstrap-datepicker.js"?>"></script>

</html>
