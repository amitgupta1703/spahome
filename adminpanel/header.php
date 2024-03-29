
<?php
session_start();

//$baseurl="http://localhost/spa2/";
$baseurl="https://spahomeservice.in/";
# Session Logout after in activity 
function sessionY(){ 
  $logLength = 60*60*60; # time in seconds :: 1800 = 30 minutes 
  $ctime = strtotime("now"); # Create a time from a string 
  # If no session time is created, create one 
  if(!isset($_SESSION['sessionY'])){  
      # create session time 
      $_SESSION['sessionY'] = $ctime;  
  }else{  
      # Check if they have exceded the time limit of inactivity 
      if(((strtotime("now") - $_SESSION['sessionY']) > $logLength)){ 
          # If exceded the time, log the user out 
          //session_unset();
        //session_destroy();
        unset($_SESSION['admin_spa_UserId']);
        unset($_SESSION['spa_userName']);
        unset($_SESSION['login_time']);
          # Redirect to login page to log back in 
          header("Location: index.php"); 
          exit; 
      }else{ 
          # If they have not exceded the time limit of inactivity, keep them logged in 
          $_SESSION['sessionY'] = $ctime; 
      } 
  } 
} 

sessionY();

if(isset($_SESSION['spa_userName']) == ''){
/* 	$unames=$_SESSION['spa_userName'];
	
	// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 10);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(10); */

echo '<script>window.open("index.php", "_self")</script>';

}
?>





<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spa Home Service Admin</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> 
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><i class="fa fa-dashboard"></i> <span> ADMIN</span></a>
            </div>
            <!--div class="navbar nav_title" style="border-bottom:1px solid #104c88;padding-bottom:10px;">
              <a href="index.php" class="site_title">  <img src="images/logo.png" style="margin-bottom:10px;height:80%;width:90%;" /></a>
            </div-->
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/avtar.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION["spa_userName"];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include 'side-nav.php';?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>