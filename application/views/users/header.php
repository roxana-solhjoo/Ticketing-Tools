<!DOCTYPE html>

<html>
<head>
        <title>aaaa Ticketing Tool</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo site_url ('assets/image/favicon.png');?>"/>

        <link rel="stylesheet" href="<?php echo site_url ('assets/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url ('assets/css/bootstrap.min.css.map');?>">
        <link rel="stylesheet" href="<?php echo site_url ('assets/css/mystyle.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/css/datatables.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url ('assets/css/bootstrap-multiselect.css');?>">
        <link rel="stylesheet" type="text/css" href="https://cmccs.superapp.com.my/assets/admin/jquery-toast-plugin/dist/jquery.toast.min.css">
<style type="text/css" >
  .error{
    color: red red !important;
  } 
</style>
        
</head>
<body>
 
 <nav class="navbar navbar-expand-lg navbar-cus navbar-light bg-faded">
   <a class="navbar-brand waves-light" href="<?php echo base_url ('dashboardd');?>">
    <img src="<?php echo site_url ('assets/image/logo.png');?>" /> 
   </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
       <span class="navbar-toggler-icon"></span>
     </button>
          <div class="collapse navbar-collapse navbar-mob-bar" id="navbarNav">
            <ul class="nav navbar-nav ml-auto nav-head-font">
              <!-- <li class="nav-item active"><a class="nav-link" href="<?php echo site_url ('setting');?>"><i class="fa fa-cog" aria-hidden="true"></i></a></li> -->
              <!-- <li class="nav-item active"><a class="nav-link" href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li> -->
              <li class="nav-item dropdown dropdown-mob" id="dropdown-mob-hide">
                    <a href="#" class="nav-link dropdown-toggle"   data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?php echo site_url('front_myProfile');?>" class="dropdown-item"><i class="fa fa-address-book-o" aria-hidden="true"></i>My Profile</a>
                        <a href="<?php echo site_url ('front_profile_edit');?>" class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</a>
                        <!-- <a href="#" class="dropdown-item"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a> -->
                        <!-- <a href="#" class="dropdown-item"><i class="fa fa-handshake-o" aria-hidden="true"></i>Account Ledger</a> -->
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo site_url ('users/dashboard/logout');?>" class="dropdown-item"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
 </nav>
 <div class="container-fluid container-fluid-cus">
  <div class="fixed-nav">
    <div class="fixed-nav-inner open-nav">
      <ul class="text-center">
        <a href="<?php echo site_url('dashboardd');?>" id="menu-toggle" class="waves-light menu-toggle" data-toggle="offcanvas">
          <li>
            <i class="fa fa-dashboard"></i></li>
            <li>Menu</li>
        </a>
        <a href="<?php echo site_url('front_incidents');?>" class="waves-light">
          <li><i class="fa fa-ticket"></i></li>
          <li>Incidents</li>
        </a>
        <a href="<?php echo site_url('front_tasks');?>"class="waves-light">
          <li><i class="fa fa-ticket"></i></li>
          <li>Tasks </li>
        </a>
      </ul>
    </div>
  </div>
</div>