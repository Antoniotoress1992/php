<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('widget/vwMeta'); ?>
    <?php $this->load->view('widget/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('widget/vwHeader'); ?>
    <div class="container">
        <div class="alert alert-danger">
            Invalid Request
        </div>
    </div>
    <?php $this->load->view('widget/vwFooter'); ?>
</body>
<?php $this->load->view('widget/vwJs'); ?>
</html>
