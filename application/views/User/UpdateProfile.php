<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Darshpun</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
  
</head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
      <?php include("Header.php");?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Profile
               <small></small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="<?php echo base_url()?>User/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
               <li><a href="#">Profile</a></li>
               <li class="active">Update Profile</li>
            </ol>
         </section>
         <!-- Main content -->
         <section class="content">
         

            <form id="user-form" class="form-horizontal" role="form" method="post" action="<?php echo base_url()?>User/UpdateUser">
                <div class="row">
                      <?php if ($this->session->flashdata('success')) {
                        echo "<div class='row'>
                            <div class='col-sm-3'></div>
                            <div class='alert alert-success alert-dismissable col-sm-6'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>";
                        echo $this->session->flashdata('success');
                        echo "  </strong></div>
                        <div class='col-sm-3'></div></div>";
                      } else if ($this->session->flashdata('error')) {
                        echo "<div class='row'>
                            <div class='col-sm-3'></div>
                            <div class='alert alert-danger alert-dismissable colsm-6'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <strong>";
                        echo $this->session->flashdata('error');
                        echo "  </strong></div>
                        <div class='col-sm-3'></div></div>";
                      } ?>
                  <!-- left column -->
                  <div class="col-md-6">
                     <!-- Account Information Form -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Account Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                           <div class="form-group">
                              <label for="SponsorIdLabel" class="col-sm-3 control-label">Sponsor Id</label>
                              <div class="col-sm-9">
                                 <input readonly type="text" class="form-control uppercase" id="sponserUsername" placeholder="" 
                                 value ='<?php if(isset($ProfileDetails->sponserUsername)) echo $ProfileDetails->sponserUsername;?>'>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="SponsorIdLabel" class="col-sm-3 control-label">Sponsor Name</label>
                              <div class="col-sm-9">
                                 <input readonly type="text" class="form-control uppercase" id="sponserName" placeholder="" 
                                 value ='<?php if(isset($ProfileDetails->sponserName)) echo $ProfileDetails->sponserName;?>'>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="SponsorIdLabel" class="col-sm-3 control-label">Placement user id</label>
                              <div class="col-sm-9">
                                 <input readonly type="text" class="form-control uppercase" id="placementUsername" placeholder="" 
                                 value ='<?php if(isset($ProfileDetails->placementUsername)) echo $ProfileDetails->placementUsername;?>'>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="SponsorIdLabel" class="col-sm-3 control-label">Placement user's name</label>
                              <div class="col-sm-9">
                                 <input readonly type="text" class="form-control uppercase" id="placementName" placeholder="" 
                                 value ='<?php if(isset($ProfileDetails->placementName)) echo $ProfileDetails->placementName;?>'>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="SponsorIdLabel" class="col-sm-3 control-label">Placement Position</label>
                              <div class="col-sm-9">
                                 <input readonly type="text" class="form-control uppercase" id="placement_position" placeholder="" 
                                 value ='<?php if(isset($ProfileDetails->placement_position)) echo $ProfileDetails->placement_position;?>'>
                              </div>
                           </div>

                        </div>
                     </div>
                     <!-- /.box -->
                     <!-- Bank Details Form -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Bank Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                              <label for="LabelForHolderName" class="col-sm-3 control-label">Holder Name</label>
                              <div class="col-sm-9">
                                <input readonly type="text" class="form-control uppercase" id="HolderName" name="HolderName" placeholder="Enter Holder Name" 
                                value ='<?php if(isset($ProfileDetails->name)) echo $ProfileDetails->name;?>'>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="PanLabel" class="col-sm-3 control-label">Pan No.</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control uppercase" id="Pan" name="Pan" placeholder="Enter Pan Number" 
                                value ='<?php if(isset($ProfileDetails->pan_number)) echo $ProfileDetails->pan_number;?>'
                                <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="BankNameLabel" class="col-sm-3 control-label">Bank Name</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control uppercase" id="BankName" name="BankName" placeholder="Enter Bank Name" 
                                value ='<?php if(isset($ProfileDetails->bank_name)) echo $ProfileDetails->bank_name;?>'
                                <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="BankBranchLabel" class="col-sm-3 control-label">Bank Branch</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control uppercase" id="BankBranch" name="BankBranch" placeholder="Enter Bank Branch" 
                                value ='<?php if(isset($ProfileDetails->bank_branch)) echo $ProfileDetails->bank_branch;?>'
                                <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="BankIFSCCodeLabel" class="col-sm-3 control-label">Bank IFSC Code</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control uppercase" id="BankIFSCCode" name="BankIFSCCode" placeholder="Enter Bank IFSC Code" 
                                value ='<?php if(isset($ProfileDetails->bank_ifsc)) echo $ProfileDetails->bank_ifsc;?>'
                                <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>

                            <div class="form-group row"> 
                                <label class="control-label col-sm-3" for="account_type">Account Type:<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control uppercase" id="accountType" name="accountType" required <?php if($viewMode) { ?> readonly <?php } ?> >
                                        <option value="SAVING"
                                          <?php if(isset($ProfileDetails->account_type)) { 
                                            if($ProfileDetails->account_type === 'SAVING') { ?> selected='selected' <?php }
                                          } ?>
                                        >SAVING</option>
                                        <option value="CURRENT" 
                                          <?php if(isset($ProfileDetails->account_type)) { 
                                            if($ProfileDetails->account_type === 'CURRENT') { ?> selected='selected' <?php }
                                          } ?>
                                        >CURRENT</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="AccountNoLabel" class="col-sm-3 control-label">Account No.</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control uppercase" id="AccountNo" name="AccountNo" placeholder="Enter Account Number" 
                                value ='<?php if(isset($ProfileDetails->account_number)) echo $ProfileDetails->account_number;?>'
                                <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>
                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
                  <!-- right column -->
                  <div class="col-md-6">
                      <!-- Personal Information Form -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Personal Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="FirstName">First Name:<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uppercase" name="firstName" id="firstName" placeholder="Enter First Name"
                                    value ='<?php if(isset($ProfileDetails->firstname)) echo $ProfileDetails->firstname;?>' readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="MiddleName">Middle Name:<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uppercase" name="middleName" id="middleName" placeholder="Enter Middle Name"
                                    value ='<?php if(isset($ProfileDetails->middlename)) echo $ProfileDetails->middlename;?>' readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="LastName">Last Name:<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uppercase" name="lastName" id="lastName" placeholder="Enter Last Name"
                                    value ='<?php if(isset($ProfileDetails->lastname)) echo $ProfileDetails->lastname;?>' readonly>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="dob">Date of birth:<span class="required">*</span></label>
                                <div class="col-sm-9"> 
                                    <input type="date" class="form-control uppercase" name="dob" id="dob" placeholder="DD/MM/YYYY"
                                    value='<?php if(isset($ProfileDetails->date_of_birth)) echo $ProfileDetails->date_of_birth;?>'
                                    <?php if($viewMode) { ?> readonly <?php } ?> >
                                </div>
                            </div>

                            <div class="form-group row"> 
                                <label class="control-label col-sm-3" for="gender">Gender:<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="gender" name="gender" required <?php if($viewMode) { ?> readonly <?php } ?> >
                                        <option value="Male"
                                          <?php if(isset($ProfileDetails->gender)) { 
                                            if($ProfileDetails->gender == 'Male') { ?> selected='selected' <?php }
                                          } ?>
                                        >Male</option>
                                        <option value="Female" 
                                          <?php if(isset($ProfileDetails->gender)) { 
                                            if($ProfileDetails->gender == 'Female') { ?> selected='selected' <?php }
                                          } ?>
                                        >Female</option>
                                        <option value="Other" 
                                          <?php if(isset($ProfileDetails->gender)) { 
                                            if($ProfileDetails->gender == 'Other') { ?> selected='selected' <?php }
                                          } ?>
                                          >Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="MobileLabel" class="col-sm-3 control-label">Mobile</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control uppercase" id="mobile" name="mobile" placeholder="Enter Mobile" 
                                  value ='<?php if(isset($ProfileDetails->mobile)) echo $ProfileDetails->mobile;?>'
                                  <?php if($viewMode) { ?> readonly <?php } ?> >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EmailLabel" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control uppercase" id="email" name="email" placeholder="Enter Email" 
                                  value ='<?php if(isset($ProfileDetails->email)) echo $ProfileDetails->email;?>'
                                  <?php if($viewMode) { ?> readonly <?php } ?> >
                                </div>
                            </div>

                            <h3 style="text-align: center; font-weight: bold;">ADDRESS DETAILS</h3>

                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="location">Near / House No. / Location:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uppercase" name="location" id="location" placeholder="Enter Near / House No. / Location"
                                    value ='<?php if(isset($ProfileDetails->location)) echo $ProfileDetails->location;?>'
                                    <?php if($viewMode) { ?> readonly <?php } ?> >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="landmark">Landmark / Street Road:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uppercase" name="landmark" id="landmark" placeholder="Enter Landmark / Street Road"
                                    value ='<?php if(isset($ProfileDetails->landmark)) echo $ProfileDetails->landmark;?>'
                                    <?php if($viewMode) { ?> readonly <?php } ?> >
                                </div>
                            </div>

                           <div class="form-group">
                              <label for="CityLabel" class="col-sm-3 control-label">City</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control uppercase" id="city" name="city" placeholder="Enter City" 
                                 value ='<?php if(isset($ProfileDetails->city)) echo $ProfileDetails->city;?>'
                                 <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                           </div>

                            <div class="form-group row">
                              <label class="control-label col-sm-3" for="district">District:<span class="required">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control uppercase" name="district" id="district" placeholder="Enter District"
                                  value ='<?php if(isset($ProfileDetails->district)) echo $ProfileDetails->district;?>'
                                  <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                          </div>

                           <div class="form-group">
                              <label for="StateLabel" class="col-sm-3 control-label">State</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control uppercase" id="state" name="state" placeholder="Enter State" 
                                 value ='<?php if(isset($ProfileDetails->state)) echo $ProfileDetails->state;?>'
                                 <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="PincodeLabel" class="col-sm-3 control-label">PinCode</label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control uppercase" id="pincode" name="pincode" placeholder="Enter PinCode" 
                                 value ='<?php if(isset($ProfileDetails->pin_code)) echo $ProfileDetails->pin_code;?>'
                                 <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                           </div>

                            <div class="form-group">
                              <label for="PincodeLabel" class="col-sm-3 control-label">Country</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control uppercase" id="country" name="country" placeholder="Enter country" 
                                  value ='<?php if(isset($ProfileDetails->country)) echo $ProfileDetails->country;?>'
                                  <?php if($viewMode) { ?> readonly <?php } ?> >
                              </div>
                            </div>

                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-info" <?php if($viewMode) { ?> style="display: none;" <?php } ?> >Save</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn" action="">Close</button>
                    </div>
                    <div class="col-md-5">
                    </div>
                </div>
            </form>
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include("Footer.php");?>
   </body>
</html>
