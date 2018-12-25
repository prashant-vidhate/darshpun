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
               <li><a href="#">My Profile</a></li>
               <li class="active">Change Password</li>
            </ol>
         </section>
         <!-- Main content -->
         <section class="content">
            <?php if ($this->session->flashdata('success')) {
                echo "<div class='row'>
                <div class='col-md-3'></div> 
                <div class='col-md-6'>
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>";
                echo $this->session->flashdata('success');
                echo "</strong></div></div>
              <div class='col-md-3'></div>
              </div>";
            } else if ($this->session->flashdata('error')) {
                echo "<div class='row'>
                <div class='col-md-3'></div> 
                <div class='col-md-6'>
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>";
                echo $this->session->flashdata('error');
                echo "</strong></div></div>
                <div class='col-md-3'></div>
                </div>";
            } ?>

            <form id="user-form" class="form-horizontal" role="form" method="post" action="<?php echo base_url()?>User/ChangePassword">
                <div class="row">
                  <!-- right column -->
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                      <!-- Personal Information Form -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Change Password</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                           <!-- <div class="form-group">
                              <label for="NameLabel" class="col-sm-4 control-label">Current Password</label>
                              <div class="col-sm-8">
                                 <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" placeholder="Enter Current Password">
                              </div>
                           </div> -->

                           <div class="form-group">
                              <label for="NameLabel" class="col-sm-4 control-label">New Password</label>
                              <div class="col-sm-8">
                                 <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="Enter New Password">
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="NameLabel" class="col-sm-4 control-label">Confirm Password</label>
                              <div class="col-sm-8">
                                 <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Enter Confirm Password">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info">Change Password</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn" action="">Close</button>
                    </div>
                    <div class="col-md-4">
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