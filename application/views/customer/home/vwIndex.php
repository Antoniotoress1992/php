<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
    <main class="bg-main1">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1 color-white margin-top-50 margin-bottom-50">
                <h2><b>Send someone special an amount, let them choose a gift
                and deliver it straight to them with a personalised card</b></h2>
            </div>
        </div>
    </main>
    <main class="bg-main2">
        <div class="container">
            <h2>Apple of eye</h2>
        </div>    
    </main>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
