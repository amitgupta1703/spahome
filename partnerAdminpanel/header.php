
<?php
include 'dbwe.php';
session_start();
$sessionid=session_id();
//$baseurl="http://localhost/spa2/partnerAdminpanel"; 
$baseurl="https://spahomeservice.in/partnerAdminpanel";
/* echo "$_COOKIE::: ".$_COOKIE['un_'];
echo "<br>$_COOKIE::: ".$_COOKIE['un_i']; */
/* if(isset($_SESSION['U_Name_partner']) ||  ){ 
  $_SESSION['U_Name_partner']=$_COOKIE['U_Name_partner'];
  $_SESSION['admin_UserId_partner']=$_COOKIE['admin_UserId_partner'];
  } */
  $decryption_un='';
  $decryption_uid='';
  if(isset($_COOKIE['un_'])){

    $un_partner = $_COOKIE['un_']; 
    $uid_partner = $_COOKIE['un_i'];
   
    $ciphering = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0; 
    $decryption_iv = '1234567891011121'; 
    $decryption_key = "admin_un"; 
    $decryption_un=openssl_decrypt ($un_partner, $ciphering, $decryption_key, $options, $decryption_iv); 

    $decryption_key1 = "admin_uid"; 
    $decryption_uid=openssl_decrypt ($uid_partner, $ciphering, $decryption_key1, $options, $decryption_iv); 
  
  /*   $decryption_iv = '1234567891011121'; 
    $decryption_key = "admin_un"; 
    $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
    echo "Decrypted String: " . $decryption; */
  }

/*   echo "$_COOKIEun::: ".$decryption_un;
echo "<br>$_COOKIEuni::: ".$decryption_uid; */
  
  if(!isset($_COOKIE['un_'])){
    echo '<script>window.open("'.$baseurl.'", "_self")</script>';
    die();
  }

  if(isset($_COOKIE['un_']) && !isset($_SESSION['U_Name_partner'])){
    $_SESSION['U_Name_partner']=$decryption_un;
    $_SESSION['admin_UserId_partner']=$decryption_uid;
  }

  /* if(isset($_COOKIE['un_']) && !isset($_SESSION['U_Name_partner'])){
    $_SESSION['U_Name_partner']=$_COOKIE['U_Name_partner'];
    $_SESSION['admin_UserId_partner']=$_COOKIE['admin_UserId_partner'];
  } */

//$partners_id=$_SESSION["admin_UserId_partner"];  
//$partners_id=$_COOKIE["admin_UserId_partner"]; 

$partners_id=$decryption_uid; 
//echo "partner id ".$partners_id;
$query="select * from partners_registration where partners_id = '$partners_id'  limit 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 1) {
 while ($row = mysqli_fetch_array($result)) {  
  $profileImg=$row['profileImg'];  
 }
} 

# Session Logout after in activity 
function sessionX($decryption_un,$decryption_uid){ 
  $logLength = 60*60*24*30; # time in seconds :: 1800 = 30 minutes 
  $ctime = strtotime("now"); # Create a time from a string 
  # If no session time is created, create one 
  //echo "ctime ::: ".$ctime." :::: ".strtotime("now")." :::: ".(strtotime("now") - $_SESSION['sessionX']);
  if(!isset($_SESSION['sessionX'])){  
      # create session time 
      $_SESSION['sessionX'] = $ctime;  
  }else{ 
      # Check if they have exceded the time limit of inactivity  
      if(((strtotime("now") - $_SESSION['sessionX']) > $logLength)){ 
          # If exceded the time, log the user out 
          //session_unset();
        //session_destroy();
        //unset($_SESSION['admin_UserId_partner']);
        //unset($_SESSION['U_Name_partner']);
        if(isset($_COOKIE['un_']) && isset($_COOKIE['un_i'])){
          $_SESSION['U_Name_partner']=$decryption_un;
          $_SESSION['admin_UserId_partner']=$decryption_uid;
          //echo 'adjhdjh::: '.$_SESSION['U_Name_partner'];
        }else{
          unset($_COOKIE['un_i']);
          unset($_COOKIE['un_']);
          setcookie('un_i',"",time()-60);
          setcookie('un_',"",time()-60);
          session_unset();
          session_destroy();
          echo '<script>(function(){window.location.href ="login.php"})();</script>';
          exit; 
        }
          # Redirect to login page to log back in 
          //header("Location:".$baseurl); 
          
      }else{ 
          # If they have not exceded the time limit of inactivity, keep them logged in 
          $_SESSION['sessionX'] = $ctime; 
      } 
  } 
} 

sessionX($decryption_un,$decryption_uid);

/*  if(isset($_SESSION['U_Name_partner']) == ''){
//	$unames=$_SESSION['U_Name_partner'];
	
	// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 10);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(10);

echo '<script>window.open("'.$baseurl.'", "_self")</script>';

}  */
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