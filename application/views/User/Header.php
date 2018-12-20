<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>DP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DARSHPUN</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()?>assets/User/dist/img/user2-160x160.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata("user_username"); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()?>assets/User/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                <p><?php echo $this->session->userdata("user_username"); ?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>User/Logout" class="btn btn-default btn-flat">Sign out</a>
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
                <p><?php echo $this->session->userdata("user_username"); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url();?>User/Dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>User/JoinNow">
                    <i class="fa fa-user-plus"></i> <span>Join Now</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-open"></i>
                    <span>Documents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>User/WelcomeLetter"><i class="fa fa-circle-o"></i> Welcome Letter</a></li>
                    <li><a href="<?php echo base_url();?>User/JoiningLetter"><i class="fa fa-circle-o"></i> Joining Letter</a></li>
                    <li><a href="<?php echo base_url();?>User/Invoices"><i class="fa fa-circle-o"></i> Invoices</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>User/Profile"><i class="fa fa-circle-o"></i> My Profile</a></li>
                    <li><a href="<?php echo base_url();?>User/UpdateProfile"><i class="fa fa-circle-o"></i> Update Profile</a></li>
                    <li><a href="<?php echo base_url();?>User/updatePassword"><i class="fa fa-circle-o"></i> Change Password</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>My Income</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>User/ShoppingFund"><i class="fa fa-circle-o"></i> Shopping Fund</a></li>
                    <li><a href="<?php echo base_url();?>User/ProfileSharingValue"><i class="fa fa-circle-o"></i> Profit Sharing Value</a></li>
                    <li><a href="<?php echo base_url();?>User/DirectReferralIncome"><i class="fa fa-circle-o"></i> Direct Referral Income</a></li>
                    <li><a href="<?php echo base_url();?>User/BinaryIncome"><i class="fa fa-circle-o"></i> Binary Income</a></li>
                    <li><a href="<?php echo base_url();?>User/AutoPullMatrixIncome"><i class="fa fa-circle-o"></i> Auto Pool Matrix Income</a></li>
                    <li><a href="<?php echo base_url();?>User/MonthlySalaryIncome"><i class="fa fa-circle-o"></i> Monthly Salary Income</a></li>
                    <li><a href="<?php echo base_url();?>User/MonthlyFieldAllowance"><i class="fa fa-circle-o"></i> Monthly Field Allowance</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>My Network</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>User/DirectReferralList"><i class="fa fa-circle-o"></i> Direct Referral List</a></li>
                    <li><a href="<?php echo base_url();?>User/LeftGroupList"><i class="fa fa-circle-o"></i> Left Group List</a></li>
                    <li><a href="<?php echo base_url();?>User/RightGroupList"><i class="fa fa-circle-o"></i> Right Group List</a></li>
                    <li><a href="<?php echo base_url();?>User/LevelWiseList"><i class="fa fa-circle-o"></i> Level Wise List</a></li>
                    <li><a href="<?php echo base_url();?>User/BinaryTree"><i class="fa fa-circle-o"></i> Binary Tree</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url();?>User/AwardReward">
                    <i class="fa fa-trophy"></i> <span>Award & Reward</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>User/Rank">
                    <i class="fa fa-gift"></i> <span>My Rank</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>User/Calender">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url();?>User/Logout">
                    <i class="fa fa-sign-out"></i> <span>Sign out</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
