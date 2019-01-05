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

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/orgchart/jquery.orgchart.css">
  <style>
    #chart-container {
      font-family: Arial;
      height: 420px;
      border: 2px dashed #aaa;
      border-radius: 5px;
      overflow: auto;
      text-align: center;
    }
    /* #github-link {
      position: fixed;
      top: 0px;
      right: 10px;
      font-size: 3em;
    } */
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("Header.php");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Binary Tree
        <small>My network</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>User/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>My network</li>
        <li class="active">Binary Tree</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div id="chart-container"></div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <!-- <b>Version</b> 2.3.2 -->
    </div>
    <strong>Design & developed by <a href="http://dreamkloud.in" target="_blank">DreamKloud Technology Pvt Ltd, Nashik</a>.</strong>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url() ?>assets/User/plugins/jQuery/jQuery-2.1.4.min.js"></script>

  <script src="<?php echo base_url() ?>assets/orgchart/jquery.orgchart.js"></script>
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
      (function($) {
      $(function() {
        var tree;
        //function getTreeData() {
            $.ajax({
                url: '<?php echo base_url(); ?>User/getUserTreeByPlacementId',
                type: 'POST',
                header: 'Content-type: application/json',
                data: {},
                success: function(data) {
                    if(data) {
                        var arr = JSON.parse(data);
                        // console.log('------------------');
                        tree = list_to_tree(arr);
                        // console.log(tree[0]);
                        displayTree(tree[0]);
                    }    
                }, 
            });
        //}
      });
    })(jQuery);

    function displayTree(tree){
      var oc = $('#chart-container').orgchart({
          'data' : tree,
          'nodeContent': 'title'
        });
    }

    function list_to_tree(list) {
        var map = {}, node, roots = [], i, placement_id_is_exist = false;
        for (i = 0; i < list.length; i += 1) {
            map[list[i].id] = i; // initialize the map
            list[i].children = []; // initialize the children
            list[i]['name'] = list[i]['username'] + ' [' + list[i]['placement_position'].toUpperCase() +']';
            list[i]['title'] = list[i]['firstname'] + ' ' + list[i]['lastname'];
        }
        for (i = 0; i < list.length; i += 1) {
            node = list[i];
            placement_id_is_exist = false;
            for (j = 0; j < list.length; j += 1) {
              if(list[j].id == node.placement_id) {
                placement_id_is_exist = true;
                break;
              }
            }
            if (node.placement_id !== "0" && placement_id_is_exist) {
                // if you have dangling branches check that map[node.parentId] exists
                list[map[node.placement_id]].children.push(node);
            } else {
                roots.push(node);
            }
        }
        return roots;
    }

  </script>
</body>
</html>
