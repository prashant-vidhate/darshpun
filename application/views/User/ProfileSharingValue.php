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
  <style> 
  table, th, td {
    border: 1px solid black;
  }
  tr:nth-child(odd) {
    background-color: #dddddd;
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("Header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Profit Sharing Value
        <small>My Income</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> My Income</a></li>
        <li class="active">Profit Sharing Value</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if (isset($userWallet->profit_sharing_value)) {
                    echo $userWallet->profit_sharing_value;
                  } else {
                    echo 0;
                  } ?></h3>
              <p>Profit Sharing Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <!-- <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>             -->
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="row">
            <div class="col-md-12">
              <div class="message-box">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <td>Profit Sharing Value</td>
                      <td><?php echo $userWallet->DefaultProfitSharingValue; ?>.00</td>
                    </tr>
                    <tr>
                      <td>Daily Profit</td>
                      <td><?php if(isset($userWallet->daily_profit)) { echo $userWallet->daily_profit; } else { echo '0.00'; } ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Remaining Amount</td>
                      <td><?php if(isset($userWallet->profit_sharing_value)) { echo $userWallet->profit_sharing_value; } else { echo '0.00'; } ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Profit Sharing Value</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Transaction Date</th>
                    <th>Transaction Remark</th>
                    <th>Transaction Amount</th>
                    <th>Close/Open</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $cnt = 0; if(isset($profitSharingHistory)) { foreach($profitSharingHistory as $profitSharing) { $cnt++; ?>
                    <tr>
                      <td></td>
                      <td><?php if(isset($profitSharing->transaction_date)) echo $profitSharing->transaction_date; ?></td>
                      <td><?php if(isset($profitSharing->transaction_remark)) echo $profitSharing->transaction_remark; ?></td>
                      <td><?php if(isset($profitSharing->transaction_amount)) echo $profitSharing->transaction_amount; ?></td>
                      <td></td>
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
