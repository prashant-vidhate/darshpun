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
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/hexagon.min.css">
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

	<div class="slider-area">
		<div class="slider-wrapper owl-carousel">
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-one">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-two">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								<!-- <div class="slide-text">
									<h1 class="homepage-three-title">Welcome to  <span>DarshPun</span> Marketing</h1>
									<h2>Description of the DarshPun Marketing website </h2>
									<div class="slider-content-btn">
										<a class="btn11" href="<?php echo base_url();?>Home/AboutUs">Contact<div class="transition"></div></a>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-three">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-four">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-five">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-six">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="slider-content-area">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="message-box">
                        <h2>WELCOME TO OUR SITE</h2>
                        <h4>Dear Sir/Madam,</h4>
                        <p> It is a matter of great pride for us that this business interest you are reading is actually the launch of a very big campaign. A campaign that is going to give new meaning to your life, new flight to your diet and make your dream come true. Our mission is awakening to the new hope of achieving all the facilities of life. Remember, troubles in life never end. The courage that you have to finish them will be the mobilization of your own hard work. </p>
                        <p>Before proceeding, you have a question: 'In whatever profession you are in today, in this profession, if you continue to do the work for the next 10 years or 15 years, then you feel that the picture of your life will be very happy. If that sounds like this, of course, you continue to do the same thing, but if you have no answer, "no", and the work you are doing or the profession you are involved with, if you are 20 or 25 years or even by the end of life Even if you do not have any special change in your life then friends, you have to change yourself.</p>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-4">
					<div class="row border" style="background-color: #f68b20;">
						<div class="col-md-12">
							<form id="loginForm" class="form-horizontal"
								role="form" method="post" action="<?php echo base_url() ?>Home/login">
								<br>
								<h2 class="custom-header" 
									style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px!important;padding-left: 10px;">
									Login Page</h2><br>
								<div class="form-group">
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
								</div>
								<div class="form-group" style="text-align: center;display: none">
									<label class="radio-inline"><input type="radio" name="userType" value="Representative" checked> Representative</label>
									<label class="radio-inline"><input type="radio" name="userType" value="Retailer"> Retailer</label>
								</div>
								<button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
								<br><br>
							</form>
						</div>
					</div>
                </div><!-- end col -->
			</div><!-- end row -->
			
			<!-- Banner of the awards & Ranks -->
			<div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                    <a data-toggle="modal" data-target="#awardAndRewardsModal" style="cursor: pointer">
                        <img src="<?php echo base_url();?>assets/images/all/award.png" alt="Award and Reward" style="height: 306px;width:100%">
                    </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                    <a data-toggle="modal" data-target="#RanksModal" style="cursor: pointer">
                        <img src="<?php echo base_url();?>assets/images/all/rank.png" alt="Ranking" style="height: 306px;width:100%">
                    </a>
                    </div>
                </div>
			</div>

			<!-- Awards & Rewards Modal -->
			<div id="awardAndRewardsModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2>AWARDS & REWARDS</h2>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<h3>1. Silver - Darshpun Business Kit</h3>
							<h3>2. Gold - Goa Trip</h3>
							<h3>3. Diamond - Android Phone</h3>
							<h3>4. Diplomat - 10 Gram Gold</h3>
							<h3>5. Silver Diplomat - Laptop</h3>
							<h3>6. Gold Diplomat- Bike</h3>
							<h3>7. Diamond Diplomat - Thailand Trip + 1 Lack Cash</h3>
							<h3>8. Ambassador - EON Car</h3>
							<h3>9. Silver Ambassador - Swift Dzire</h3>
							<h3>10. Gold Ambassador - Innova</h3>
							<h3>11. Diamond Ambassador - Row House</h3>
							<h3>12. Chairman Circle - Rangle Rover</h3>
						</div>
					</div>
				</div>
			</div>

			<!-- Ranks Modal -->
			<div id="RanksModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2>RANKS</h2>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<h3>0. Sales Executive</h3>
							<h3>1. Silver - 50 Pairs</h3>
							<h3>2. Gold - 150 Pairs</h3>
							<h3>3. Diamond - 350 Pairs</h3>
							<h3>4. Diplomat - 750 Pairs</h3>
							<h3>5. Silver Diplomat - 1550 Pairs</h3>
							<h3>6. Gold Diplomat - 3150 Pairs</h3>
							<h3>7. Diamond Diplomat - 6350 Pairs</h3>
							<h3>8. Ambassador - 12750 Pairs</h3>
							<h3>9. Silver Ambassador - 25550 Pairs</h3>
							<h3>10. Gold Ambassador - 51150 Pairs</h3>
							<h3>11. Diamond Ambassador - 102350 Pairs</h3>
							<h3>12. Chairman Circle - 204750 Pairs</h3>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end container -->

		<div class="p-btm gray-bg row product-column text-center gray-bg">
			<div class="offset-1 col-10 offset-1">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<a href="products.php" class="product-bg wow pulse hvr-buzz-out" data-wow-duration="4000ms" style="visibility: visible; animation-duration: 4000ms; animation-name: pulse;">
							<img src="<?php echo base_url();?>assets/images/categories/product-img.png" class="product-edu image-product" style="margin-top: 17px;">
							<img src="<?php echo base_url();?>assets/images/categories/product-img-white.png" class="white-product">
							<h1>Products</h1>
						</a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href="referrer.php" class="product-bg blue-bg wow pulse hvr-buzz-out" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-name: pulse;">
							<img src="<?php echo base_url();?>assets/images/categories/buy-img.png" class="image-product" style="margin-top: 17px;">
							<h1>Join Now</h1>
						</a>
					</div>
					<div class="col-md-4 col-sm-4">
						<a href="http://education.ebizel.com/" target="_blank" class="product-bg wow pulse hvr-buzz-out" data-wow-duration="4000ms" style="visibility: visible; animation-duration: 4000ms; animation-name: pulse;">
							<img src="<?php echo base_url();?>assets/images/categories/education.png" class="product-edu image-product" style="margin-top: 17px;">
							<img src="<?php echo base_url();?>assets/images/categories/education-white.png" class="white-product">
							<h1>Education</h1>
						</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- START Categories -->
		<div class="categories text-center" style="background-color: #2c8fcd; padding-top: 27px; padding-bottom: 30px;">
			<h1>Categories</h1>
			<ul class="categoru-list">
				<li>
					<a href="photogal_cat.php" class="column wow bounceInUp" data-wow-duration="500ms" style="visibility: visible; animation-duration: 500ms; animation-name: initial;">
						<div class="table-cell">
							<img id="photo_gallary"
							src="<?php echo base_url();?>assets/images/categories/gallery.png">
							<p style="color: #000">Photo Gallery</p>
						</div>
					</a>
				</li>
				<li>
					<a href="news.php" class="column wow bounceInUp" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-name: initial;">
						<div class="table-cell">
							<img src="<?php echo base_url();?>assets/images/categories/news.png">
							<p style="color: #000">News</p>
						</div>
					</a>
				</li>
				<li>
					<a href="pressreleases.php" class="column wow bounceInUp" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: initial;">
						<div class="table-cell">
							<img src="<?php echo base_url();?>assets/images/categories/press.png">
							<p style="color: #000">Press Releases</p>
						</div>
					</a>
				</li>
				<li>
					<a href="downloads.php" class="column wow bounceInUp" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-name: initial;">
						<div class="table-cell">
							<img src="<?php echo base_url();?>assets/images/categories/download.png">
							<p style="color: #000">Downloads</p>
						</div>
					</a>
				</li>
				<li>
					<a href="paymentmodes.php" class="column wow bounceInUp" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-name: bounceInUp;">
						<div class="table-cell">
							<img src="<?php echo base_url();?>assets/images/categories/paymentmode.png">
							<p style="color: #000">Payment Mode</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<!-- END Categories -->
	</div><!-- end section -->
		 
	
	<section class="p-btm gray-bg">
		<div class="container">
			
		</div>
	</section>
    <?php include("Footer.php"); ?>  
</body>
</html>

