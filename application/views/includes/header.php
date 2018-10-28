<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>HMS</title>

  <link href="<?php echo base_url(); ?>assets/css/style.default.css" rel="stylesheet">

  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/toggles.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.cookies.js"></script>


  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

  <script src="<?php echo base_url(); ?>assets/custom/js/bootbox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrapValidator.js"></script>
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrapValidator.min.js"></script>


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> HMS <span>]</span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo base_url(); ?>patients"><i class="fa fa-users"></i> <span>Patients</span></a></li>
        <li><a href="<?php echo base_url(); ?>patients/qeued_patients"><i class="fa fa-users"></i> <span>Queued Patients</span></a></li>
        <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar"></i> <span>Appointments</span></a></li>
        <li><a href="<?php echo base_url(); ?>services"><i class="fa fa-calendar"></i> <span>Services</span></a></li>
        <li><a href="<?php echo base_url(); ?>laboratory/lab_services"><i class="fa fa-medkit"></i> <span>Laboratory Services</span></a></li>
        <li><a href="<?php echo base_url(); ?>laboratory/labRequests"><i class="fa fa-users"></i> <span>Laboratory Requests</span></a></li>
        <li><a href="<?php echo base_url(); ?>patients/patient_treatment"><i class="fa fa-users"></i> <span>Patients Treatment List</span></a></li>
        <li><a href="<?php echo base_url(); ?>patients/prescription_list"><i class="fa fa-users"></i> <span>Prescription List</span></a></li>
        <li><a href="<?php echo base_url(); ?>medicines"><i class="fa fa-medkit"></i> <span>Medicines</span></a></li>
        <li><a href="<?php echo base_url(); ?>users/doctors"><i class="fa fa-user-md"></i> <span>Doctors</span></a></li>
        <li><a href="<?php echo base_url(); ?>users/technicians"><i class="fa fa-users"></i> <span>Lab Technicians</span></a></li>
        <li><a href="<?php echo base_url(); ?>users/nurses"><i class="fa fa-stethoscope"></i> <span>Nurses</span></a></li>
        <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-user"></i> <span>Users</span></a></li>
      </ul>
      <div class="infosummary">
        <h5 class="sidebartitle">Users</h5>
        <ul>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Daily Traffic</span>
                    <h4>630, 201</h4>
                </div>
                <div id="sidebar-chart" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Average Users</span>
                    <h4>1, 332, 801</h4>
                </div>
                <div id="sidebar-chart2" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Disk Usage</span>
                    <h4>82.2%</h4>
                </div>
                <div id="sidebar-chart3" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">CPU Usage</span>
                    <h4>140.05 - 32</h4>
                </div>
                <div id="sidebar-chart4" class="chart"></div>
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Memory Usage</span>
                    <h4>32.2%</h4>
                </div>
                <div id="sidebar-chart5" class="chart"></div>
            </li>
        </ul>
      </div><!-- infosummary -->

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">
    <div class="headerbar">
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      <div class="header-right">
        <ul class="headermenu">
           <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globe"></i>
                <?php $not = 0; $not=(countNotifications(($this->session->userdata('logged_in')['role_id']),0)); if($not > 0){?>
                  <span class="badge"><?php echo $not; } ?></span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have <?php echo $not; ?> New Notifications</h5>
                <ul class="dropdown-list gen-list"><!-- 
                  <?php print_r(getNotifications(2,2)->result()[0]); ?> -->
                 <!--  Fetch data -->
                  <?php foreach (getNotifications(2,2)->result() as $notification){?>
                    <li class="new">
                      <?php $message = ""; if($notification->reciever_role == 2){ $message ="You have awaiting Lab Results from";?>
                          <a href="<?php echo base_url(); ?>laboratory/update_notifications/<?php echo ($notification->notification_id."/".$notification->patient_id."/".$notification->treatment_id."/".$notification->request_id); ?>/">
                        <?php } elseif ($notification->reciever_role == 4) { $message ="You have awaiting Lab Request from"; ?>
                          <a href="<?php echo base_url(); ?>laboratory/labRequests">
                        <?php } else { $message ="You have awaiting Prescription from"; ?>
                          <a href="#">
                            <?php }?>
                        <span>
                          <span class="name"><?php echo $notification->patient_name; ?> <span class="badge badge-success"><?php if($notification->notification_status == 0) echo "New"; ?></span></span>
                          <span class="msg"><?php echo $message. " ". $notification->name; ?></span>
                        </span>
                      </a>
                    </li>
                  <?php }?>
                  <li class="new"><a href="#">See All Notifications</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Welcome, <?php echo ucwords($this->session->userdata('logged_in')['name']); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href=""><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li><a href="<?php echo base_url();?>users/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->
        
    
    
  
    


    <!-- Content goes here -->
