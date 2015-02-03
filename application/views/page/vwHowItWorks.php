<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('customer/vwMeta'); ?>
    <?php $this->load->view('customer/vwCss'); ?>
</head>
<body>
    <?php $this->load->view('customer/vwHeader'); ?>
    <main style="background: url(/assets/images/how_it_works_background.jpg); background-size: cover;">
        <div class="container" style="font-family: 'Bitter';">
            <div class="row padding-top-lg">
                <h1 class="text-center color-blue">HOW IT WORKS</h1>
            </div>
            
            <div class="row padding-top-lg">
                <div class="col-sm-2 col-sm-offset-2">
                    <div class="how-it-work-step-blue">
                        <img src="<?php echo base_url()."assets/images/icon_white_01.png";?>" style="width: 50%;"/>
                    </div>
                </div>
                <div class="col-sm-7 color-gray-middle" style="font-weight: bold;">
                    <h2>1. Kick Off</h2>
                    <p class="font-droid">
                        Create group gift project by downloading our mobile app or using 
                        <br/>our web app
                    </p>
                </div>
            </div>
            
            <div class="row margin-top-sm">
                <div class="col-sm-2 col-sm-offset-2">
                    <div class="how-it-work-step-blue">
                        <img src="<?php echo base_url()."assets/images/icon_white_02.png";?>" style="width: 50%;"/>
                    </div>
                </div>
                <div class="col-sm-7 color-gray-middle">
                    <h2>2. Invite friends</h2>
                    <p class="font-droid">
                        Select friends from your phone contact book and invite them to join 
                        <br/>via SMS
                    </p>
                </div>
            </div>
            
            <div class="row margin-top-sm">
                <div class="col-sm-2 col-sm-offset-2">
                    <div class="how-it-work-step-blue">
                        <img src="<?php echo base_url()."assets/images/icon_white_03.png";?>" style="width: 50%;"/>
                    </div>
                </div>
                <div class="col-sm-7">
                    <h2>3. Collect money</h2>
                    <p class="font-droid">
                        Friends confirm and contribute money by replying "OK" to our SMS
                        <br/> system
                    </p>
                </div>
            </div>
            
            <div class="row margin-top-sm">
                <div class="col-sm-2 col-sm-offset-2">
                    <div class="how-it-work-step-blue">
                        <img src="<?php echo base_url()."assets/images/icon_white_04.png";?>" style="width: 50%;"/>
                    </div>
                </div>
                <div class="col-sm-7">
                    <h2>4. Spend money</h2>
                    <p class="font-droid">
                        Choose a gift from our selection, let your recipient choose the gift or
                        <br/> withdraw the money
                    </p>
                </div>
            </div>
            
            <div class="row margin-top-sm">
                <div class="col-sm-2 col-sm-offset-2">
                    <div class="how-it-work-step-blue">
                        <img src="<?php echo base_url()."assets/images/icon_white_05.png";?>" style="width: 50%;"/>
                    </div>
                </div>
                <div class="col-sm-7">
                    <h2>5. Give the love</h2>
                    <p class="font-droid">
                        Mission completed. Send the gift to your beloved and make them
                        <br/> tounched
                    </p>
                </div>
            </div>
            <div class="margin-top-lg">&nbsp;</div>
            <div class="margin-top-lg">&nbsp;</div>
        </div>
        
    </main>
    <?php $this->load->view('customer/vwFooter'); ?>
</body>
<?php $this->load->view('customer/vwJs'); ?>
</html>
