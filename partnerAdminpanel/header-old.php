
<?php
include 'dbwe.php';
session_start();
$sessionid=session_id();
//$baseurl="http://localhost/spa2/partnerAdminpanel"; 
$baseurl="https://spahomeservice.in/partnerAdminpanel";


$partners_id=$_SESSION["admin_UserId_partner"];  
$query="select * from partners_registration where partners_id = '$partners_id'  limit 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 1) {
 while ($row = mysqli_fetch_array($result)) { 
   
  $profileImg=$row['profileImg'];  
 }
} 

# Session Logout after in activity 
function sessionX(){ 
  $logLength = 60000000; # time in seconds :: 1800 = 30 minutes 
  $ctime = strtotime("now"); # Create a time from a string 
  # If no session time is created, create one 
  if(!isset($_SESSION['sessionX'])){  
      # create session time 
      $_SESSION['sessionX'] = $ctime;  
  }else{ 
      # Check if they have exceded the time limit of inactivity 
      if(((strtotime("now") - $_SESSION['sessionX']) > $logLength)){ 
          # If exceded the time, log the user out 
          session_unset();
        session_destroy();
          # Redirect to login page to log back in 
          //header("Location:".$baseurl); 
          echo '<script>(function(){window.location.href ="'.$baseurl.'"})();</script>';
          exit; 
      }else{ 
          # If they have not exceded the time limit of inactivity, keep them logged in 
          $_SESSION['sessionX'] = $ctime; 
      } 
  } 
} 

sessionX();

if(isset($_SESSION['U_Name_partner']) == ''){
	$unames=$_SESSION['U_Name_partner'];
	
	// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 10000);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(10);

echo '<script>window.open("'.$baseurl.'", "_self")</script>';

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

    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="<?php echo $baseurl?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $baseurl?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $baseurl?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $baseurl?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $baseurl?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $baseurl?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $baseurl?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $baseurl?>/build/css/custom.min.css" rel="stylesheet">
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
                <img src="<?php echo $baseurl ?>/<?php if($profileImg && $profileImg!=null){echo $profileImg;}else{echo 'images/avtar.png';} ?>" alt="..." class="img-circle profile_img headerImg">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION["U_Name_partner"];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include 'partners-side-nav.php';?>
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