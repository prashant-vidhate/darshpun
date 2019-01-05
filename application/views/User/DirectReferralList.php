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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/User/dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("Header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Direct Referral List
        <small>My Network</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> My Network</a></li>
        <li class="active">Direct Referral List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php if ($this->session->flashdata('success')) {
              echo "<div class='row'>
                  <div class=''></div>
                  <div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <strong>";
              echo $this->session->flashdata('success');
              echo "  </strong></div>
              <div class=''></div></div>";
            } else if ($this->session->flashdata('error')) {
              echo "<div class='row'>
                  <div class=''></div>
                  <div class='alert alert-danger alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <strong>";
              echo $this->session->flashdata('error');
              echo "  </strong></div>
              <div class=''></div></div>";
            } ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Direct Referral List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Partner Id</th>
                    <th>Partner Name</th>
                    <th>Joining Date & Time</th>
                    <th>Sponser ID</th>
                    <th>Placement ID</th>
                    <th>Placement position</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($DirectReferralList)) { foreach($DirectReferralList as $DirectReferral) { ?>
                    <tr>
                      <td></td>
                      <td><?php if(isset($DirectReferral->username)) echo $DirectReferral->username; ?></td>
                      <td style="text-transform:uppercase;"><?php if(isset($DirectReferral->name)) echo $DirectReferral->name; ?></td>
                      <td><?php if(isset($DirectReferral->created_date)) echo $DirectReferral->created_date; ?></td>
                      <td><?php if(isset($DirectReferral->sponser_username)) echo $DirectReferral->sponser_username; ?></td>
                      <td><?php if(isset($DirectReferral->placement_username)) echo $DirectReferral->placement_username; ?></td>
                      <td style="text-transform:uppercase;"><?php if(isset($DirectReferral->placement_position)) echo $DirectReferral->placement_position; ?></td>
                      <td><a href="<?php echo base_url(); ?>User/ViewProfile?username=<?php if(isset($DirectReferral->username)) echo $DirectReferral->username; ?>">View Profile</a></td>
                    </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      </div>
      <strong>Design & developed by <a href="http://dreamkloud.in" target="_blank">DreamKloud Technology Pvt Ltd, Nashik</a>.</strong>
    </footer>

    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- /.content-wrapper -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url() ?>assets/User/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url() ?>assets/User/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/User/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/User/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/User/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/User/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/User/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/User/dist/js/demo.js"></script>
<script>
 $(function () {
  var t = $("#example1").DataTable({
      "scrollX": true,
      "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
  });
</script>
</body>
</html>
