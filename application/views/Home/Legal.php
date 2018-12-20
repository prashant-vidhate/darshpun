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

   	<div class="banner-area banner-bg-legal">
	</div>

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                    <a href="<?php echo base_url();?>assets/images/Legal/1_INCORPORATION.JPG">
                        <img src="<?php echo base_url();?>assets/images/Legal/1_INCORPORATION.JPG" alt="Lights" style="width:100%">
                        <div class="caption">
                        <h4 style="text-align: center; font-weight: bold;">INCORPORATION CERTIFICATE</h4>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                    <a href="<?php echo base_url();?>assets/images/Legal/2_PAN.JPG">
                        <img src="<?php echo base_url();?>assets/images/Legal/2_PAN.JPG" alt="Fjords" style="width:100%">
                        <div class="caption">
                        <h4 style="text-align: center; font-weight: bold;">PAN CARD</h4>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                    <a href="<?php echo base_url();?>assets/images/Legal/3_MCA.png">
                        <img src="<?php echo base_url();?>assets/images/Legal/3_MCA.png" alt="Lights" style="width:100%">
                        <div class="caption">
                        <h4 style="text-align: center; font-weight: bold;">MCA</h4>
                        </div>
                    </a>
                    </div>
                </div>
                <!--div class="col-md-6">
                    <div class="thumbnail">
                    <a href="<?php echo base_url();?>assets/images/Legal/4-udyog adhar.JPG">
                        <img src="<?php echo base_url();?>assets/images/Legal/4-udyog adhar.JPG" alt="Fjords" style="width:100%">
                        <div class="caption">
                        <h4 style="text-align: center; font-weight: bold;">UDYOG ADHAR</h4>
                        </div>
                    </a>
                    </div>
                </div-->
            </div>
        </div><!-- end container -->
    </div><!-- end section -->

    <?php include("Footer.php"); ?>    

</body>
</html>