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
    <!-- Tabs CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tabset.css">
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

   	<div class="banner-area banner-bg-join-now">

    </div>

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($this->session->flashdata('success')) {
						echo "<div class='row'>
								<div class='alert alert-success alert-dismissable col-md-12'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<strong>";
						echo $this->session->flashdata('success');
						echo "  </strong></div></div>";
					} else if ($this->session->flashdata('error')) {
						echo "<div class='row'>
								<div class='alert alert-danger alert-dismissable col-md-12'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<strong>";
						echo $this->session->flashdata('error');
						echo "  </strong></div></div>";
					} ?>
                    <div class="tabs">
                        <form class="form-horizontal"
                            class="form-horizontal" role="form" id="signupForm" method="post" action="<?php echo base_url() ?>User/registerUser">
                            <div class="tab-button-outer">
                                <ul id="tab-button">
                                    <li><a class="disabled" href="#tab01">Step-1 <i class="fa fa-arrow-circle-right custom" aria-hidden="true"></i></a></li>
                                    <li><a class="disabled" href="#tab02">Step-2 <i class="fa fa-arrow-circle-right custom" aria-hidden="true"></i></a></li>
                                    <li><a class="disabled" href="#tab03">Step-3 </a></li>
                                </ul>
                            </div>

                            <div id="tab01" class="tab-contents vertical-scroll" style="height: 479px;">
                                <br>
                                <h3 style="text-align: center; font-weight: bold;">INTRODUCER / SPONSER DETAILS</h3>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="SponsorId">Introducer / Sponsor ID:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sponsorId" id="sponsorId" 
                                            placeholder="Enter Sponsor ID" required oninput="getSponser(this.value)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="SponsorName">Introducer / Sponsor Name:<span class="required">*</span></label>
                                    <div class="col-sm-8"> 
                                        <input type="text" class="form-control" name="SponsorName" id="SponsorName" placeholder="Sponsor Name" required readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="placementId">Placement ID:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="placementId" id="placementId" 
                                            placeholder="Enter Placement ID" required oninput="getPlacementSponserName(this.value)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="placementSponserName">Placement User Name:<span class="required">*</span></label>
                                    <div class="col-sm-8"> 
                                        <input type="text" class="form-control" name="placementSponserName" id="placementSponserName" placeholder="Placement Sponsor Name" required readonly>
                                    </div>
                                </div>
                                <div class="form-group row"> 
                                    <label class="control-label col-sm-4" for="PlacementPosition">Placement Position:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="placementPosition" name="placementPosition" required>
                                            <option value="left">Left</option>
                                            <option value="right" selected>Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-sm-12">
                                    <button type="button" id="tab01NextBtn" class="btn btn-success pull-right">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab02" class="tab-contents vertical-scroll" style="height: 501px;">
                                <br>
                                <h3 style="text-align: center; font-weight: bold;">PERSONAL DETAILS</h3>

                                <div class="form-group row"> 
                                    <label class="control-label col-sm-4" for="title">Title:<span class="required">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="title" name="title">
                                            <option value="Mr" selected>Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="FirstName">First Name:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="Enter First Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="MiddleName">Middle Name:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="MiddleName" id="MiddleName" placeholder="Enter Middle Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="LastName">Last Name:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Enter Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="dob">Date of birth:<span class="required">*</span></label>
                                    <div class="col-sm-8"> 
                                        <input type="date" class="form-control" name="dob" id="dob" placeholder="DD/MM/YYYY">
                                        <!-- <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group row"> 
                                    <label class="control-label col-sm-4" for="gender">Gender:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="contact">Contact / Mobile Number:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter Contact / Mobile Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="email">Email-ID:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email-ID">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="pan">PAN Number:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="pan" id="pan" placeholder="Enter PAN number">
                                    </div>
                                </div>

                                <h3 style="text-align: center; font-weight: bold;">ADDRESS DETAILS</h3>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="location">Near / House No. / Location:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="location" id="location" placeholder="Enter Near / House No. / Location">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="landmark">Landmark / Street Road:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark / Street Road">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="city">City:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="district">District:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="district" id="district" placeholder="Enter District">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="state">State:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="state" id="state" placeholder="Enter State">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="pincode">PIN Code:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter PIN Code">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="country">Country:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter Country">
                                    </div>
                                </div>

                                <div class="form-group row"> 
                                    <div class="col-sm-12">
                                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                                            <button type="button" id="tab02BackBtn" class="btn btn-warning"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</button>
                                            <button type="button" id="tab02NextBtn" class="btn btn-success">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="tab03" class="tab-contents vertical-scroll" style="height: 315px;">
                                <br>
                                <h3 style="text-align: center; font-weight: bold;">DARSHPUN ACCOUNT DETAIL</h3>
                                
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="Password">Password:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="ConfirmPassword">Confirm Password:<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-md-1 col-md-11">
                                        <input type="checkbox" class="form-check-input" id="termAndCondition" name="termAndCondition">
                                            <span class="required">*</span>I have read and agree to the Darshpun Agreement & Terms and Conditions
                                    </div>
                                </div>

                                <div class="form-group row"> 
                                    <div class="col-sm-12">
                                        <!-- <button type="button" class="btn btn-success pull-right" onclick="onSubmit()">Register</button> -->
                                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                                            <button type="button" id="tab03BackBtn" class="btn btn-warning"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</button>
                                            <button type="button" id="tab03NextBtn" class="btn btn-success" onclick="onSubmit()"> Register</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div><!-- end container -->
    </div><!-- end section -->

    <?php include("Footer.php"); ?>    
    <script>
        $(function() {
            var $tabButtonItem = $('#tab-button li'),
                $tabSelect = $('#tab-select'),
                $tabContents = $('.tab-contents'),
                activeClass = 'is-active';

            $tabButtonItem.first().addClass(activeClass);
            $tabContents.not(':first').hide();

            $tabButtonItem.find('a').on('click', function(e) {
                var target = $(this).attr('href');

                $tabButtonItem.removeClass(activeClass);
                $(this).parent().addClass(activeClass);
                $tabSelect.val(target);
                $tabContents.hide();
                $(target).show();
                e.preventDefault();
            });

            $tabSelect.on('change', function() {
                var target = $(this).val(),
                    targetSelectNum = $(this).prop('selectedIndex');

                $tabButtonItem.removeClass(activeClass);
                $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                $tabContents.hide();
                $(target).show();
            });
        });
    </script>

    <script>
        var isValidSponser = false;
        var isValidPlacementSponser = false;

        $(document).ready(function () {

            $('#tab01NextBtn').prop( "disabled", true);
            // $('#tab02NextBtn').prop( "disabled", true);
            // $('#tab03NextBtn').prop( "disabled", true);

            $('#tab01NextBtn').click(function(e){
                $('#tab-button a[href="#tab02"]').trigger('click');
            });

            $('#tab02BackBtn').click(function(e){
                $('#tab-button a[href="#tab01"]').trigger('click');
            });

            $('#tab02NextBtn').click(function(e){
                /*if($.trim($('#title').val()) == '') {
                alert('Please select the title')
                } else*/ if($.trim($('#FirstName').val()) == '') {
                    alert('Please Enter the First Name')
                } else if($.trim($('#MiddleName').val()) == '') {
                    alert('Please Enter the Middle Name')
                } else if($.trim($('#LastName').val()) == '') {
                    alert('Please Enter the Last Name')
                } else if($.trim($('#dob').val()) == '') {
                    alert('Please Enter the valid date of birth.')
                } else if($.trim($('#gender').val()) == '') {
                    alert('Please select the gender.')
                } else if($.trim($('#contact').val()) == '') {
                    alert('Please Enter the contact number.')
                } else if($.trim($('#city').val()) == '') {
                    alert('Please Enter the City.')
                } else if($.trim($('#district').val()) == '') {
                    alert('Please Enter the district.')
                } else if($.trim($('#state').val()) == '') {
                    alert('Please Enter the state.')
                } else if($.trim($('#country').val()) == '') {
                    alert('Please Enter the country.')
                } else {
                    $('#tab-button a[href="#tab03"]').trigger('click');
                }
            });

            $('#tab03BackBtn').click(function(e){
                $('#tab-button a[href="#tab02"]').trigger('click');
            });
        });

        function getSponser(sponserId) {
            console.log(sponserId);
            $.ajax({
                url: '<?php echo base_url(); ?>Home/getSponserById',
                type: 'POST',
                data: {sponserId:sponserId},
                success: function(data) {
                    $('#SponsorName').val('Sponser not found');
                    $('#tab01NextBtn').prop( "disabled", true);
                    isValidSponser = false;
                    if(data) {
                        $('#SponsorName').val(data);
                        isValidSponser = true;
                        if(isValidPlacementSponser && isValidSponser) {
                            $('#tab01NextBtn').prop( "disabled", false);
                        }
                    }    
                    //console.log('isValidSponser : '+isValidSponser);
                }, 
            });
        }

        function getPlacementSponserName(placementId) {
            console.log(placementId);
            $.ajax({
                url: '<?php echo base_url(); ?>Home/getSponserById',
                type: 'POST',
                data: {sponserId:placementId},
                success: function(data) {
                    $('#placementSponserName').val('Placement Sponser not found');
                    $('#tab01NextBtn').prop( "disabled", true);
                    isValidPlacementSponser = false;
                    if(data) {
                        $('#placementSponserName').val(data);
                        isValidPlacementSponser = true;
                        if(isValidPlacementSponser && isValidSponser) {
                            $('#tab01NextBtn').prop( "disabled", false);
                        }
                    }    
                    //console.log('isValidPlacementSponser : '+isValidPlacementSponser);
                }, 
            });
        }

        function onSubmit() {
            if($.trim($('#password').val()) == '') {
                alert('Please Enter the password')
            } else if($.trim($('#confirmPassword').val()) == '') {
                alert('Please Enter the confirm password')
            } else if (!$('#termAndCondition').is(":checked")) { 
                alert('Please select the checkbox of terms and condtions.');
            } else if ($.trim($('#password').val()) !== $.trim($('#confirmPassword').val())) {
                alert('Password and confirm password is not matched.')
            } else {
                $("#signupForm").submit();
                // $.ajax({
                //     url: '<?php echo base_url() ?>User/registerUser',
                //     type: 'post',
                //     dataType: 'json',
                //     data: $('form#signupForm').serialize(),
                //     success: function(data) {
                //         console.log('User registration status :: ' + data);
                //     },
                //     'json'
                // });
            }
        }
    </script>
</body>
</html>