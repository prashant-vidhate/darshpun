<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
    <!-- Site Metas -->
    <title>Darshpun</title>  
    <?php include("HeaderFile.php"); ?>

</head>
<body>

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__ball"></div>
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
    
    <?php include("HeaderMenu.php"); ?>

    <div id="about" class="section wb" style="background-color: #b14d05a3;">
        <div class="container">
            <div class="row">
                <div class="offset-md-3 col-md-6 offset-md-3 offset-sm-2 col-sm-8 offset-sm-2 col-xs-12 border 
                shadow p-3 mb-5 rounded register-summary">
                    <div class="register-summary" style="margin: 10px;">
                        <h2 style="font-weight: bold; color: #fff;text-align: center;">WELCOME TO DARSHPUN INNOVATION</h2>
                        <?php if($wrongUserId) { ?>
                            <h4 style="color: yellow;">User ID is wrong. User not found. Please contact system administrator.</h4>
                        <?php } else { ?>
                            <p>It's nice to meet you and we thank you for creating an account with us. Darshpun Innovation now a global community, is an amazing platform to high profits.</p>
                            <p>Your Partner ID is <strong><?php if(isset($username)) echo $username; ?></strong></p>
                            <!-- <p>Your Password is <strong>aailove×××××</strong></p> -->
                            <p>Please do not delete this email as you may want to refer to it later.</p>
                            <p>You can talk to us anytime on info.darshpun1622@gmail.com for any queries whatsoever.</p>
                            <a href="<?php echo base_url();?>Home/Homepage" class="btn btn-success">Click here to Login</a>
                            <p style="margin-top: 10px;">Any time you would like to write to us, do not hesitate to send an email to </p>
                            <a href="#" style="color: yellow">info.darshpun1622@gmail.com</a>
                        <?php } ?>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </div><!-- end section -->

    <?php include("Footer.php"); ?>    

</body>
</html>