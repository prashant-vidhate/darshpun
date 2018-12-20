<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>Admin/AdminDashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Lubdha & AK</b> INDIA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- admin Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()?>assets/User/dist/img/user2-160x160.png" class="user-image" alt="admin Image">
              <span class="hidden-xs"><?php echo $this->session->userdata("admin_username"); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()?>assets/User/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                <p><?php echo $this->session->userdata("admin_username"); ?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()?>Admin/EditProfile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>Admin/Logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                 <img src="<?php echo base_url()?>assets/User/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata("admin_username"); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url();?>Admin/AdminDashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Member</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>Admin/MemberList"><i class="fa fa-circle-o"></i> View Members</a></li>
                    <li><a href="<?php echo base_url();?>Admin/BLockedMemberList"><i class="fa fa-circle-o"></i> Blocked Members</a></li>
                    <li><a href="<?php echo base_url();?>Admin/LatestUserList"><i class="fa fa-circle-o"></i> Latest Members</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url();?>Admin/UserRegisterSponser">
                    <i class="fa fa-user-plus"></i> <span> Join Now</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span> E-Wallet</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>Admin/PayoutRequest"><i class="fa fa-circle-o"></i> Fund Payout Request</a></li>
                    <!-- <li><a href="<?php echo base_url();?>Admin/TopupPage"><i class="fa fa-circle-o"></i> Manage Wallet Fund</a></li> -->
                    <!-- <li><a href="<?php echo base_url();?>Admin/TransferFundHistory"><i class="fa fa-circle-o"></i> Transfer Fund</a></li> -->
                    <li><a href="<?php echo base_url();?>Admin/PayoutFundHistory"><i class="fa fa-circle-o"></i> Fund History</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>E-Pin</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>Admin/GeneratePin"><i class="fa fa-circle-o"></i> Generate e-PIN</a></li>
                    <li><a href="<?php echo base_url();?>Admin/UsedPins"><i class="fa fa-circle-o"></i> Used e-PINs</a></li>
                    <li><a href="<?php echo base_url();?>Admin/UnusedPins"><i class="fa fa-circle-o"></i> Un-Used e-PINs</a></li>
                    <li><a href="<?php echo base_url();?>Admin/TransferPin"><i class="fa fa-circle-o"></i> Transfer e-PIN</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Rewards</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>Admin/MemberSummary"><i class="fa fa-circle-o"></i> Pay Rewards</a></li>
                    <li><a href="<?php echo base_url();?>Admin/DailyBinaryIncome"><i class="fa fa-circle-o"></i> Search Rewards</a></li>
                    <li><a href="<?php echo base_url();?>Admin/Weekly payout"><i class="fa fa-circle-o"></i> Reward Setting</a></li>
                </ul>
            </li> 

            <li>
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Product & Services</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>Admin/ProductReceipt"><i class="fa fa-circle-o"></i> Product receipt</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url();?>Admin/Calender">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>Admin/Logout">
                    <i class="fa fa-sign-out"></i> <span>Sign out</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
