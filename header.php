 <?php
ob_start();
session_start(); 
//$baseurl="http://localhost/spa2";
$baseurl="https://spahomeservice.in";
require_once('codes/dbcontroller.php');
include 'config.php';
$decryption_un_c='';
$decryption_uid_c='';
$decryption_uname='';
if(isset($_COOKIE['un_c'])){
    //echo "cookieee ".$_COOKIE['un_c'];
  $un_cust = $_COOKIE['un_c']; 
  $uid_cust = $_COOKIE['un_ic'];
  $uname_cust = $_COOKIE['un_na'];
  $ciphering = "AES-128-CTR"; 
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;  
  $decryption_iv = '1234567891011121'; 
  $decryption_key = "cust_un"; 
  $decryption_un_c=openssl_decrypt ($un_cust, $ciphering, $decryption_key, $options, $decryption_iv); 

  $decryption_key1 = "cust_uid"; 
  $decryption_uid_c=openssl_decrypt ($uid_cust, $ciphering, $decryption_key1, $options, $decryption_iv); 

  $decryption_name = "cust_uname"; 
  $decryption_uname=openssl_decrypt ($uname_cust, $ciphering, $decryption_name, $options, $decryption_iv); 
 
  //echo "Decrypted String: " . $decryption_un_c.":: ".$decryption_uid_c; 
 
}

# Session Logout after in activity 
function sessionX($decryption_un_c,$decryption_uid_c,$baseurl,$decryption_uname){ 
   // echo "<br>Decrypted String in: " . $decryption_un_c.":: ".$decryption_uid_c; 
    $logLength = 60*60*24*30; # time in seconds :: 1800 = 30 minutes 
    $ctime = strtotime("now"); # Create a time from a string 
    # If no session time is created, create one 
    //echo "ctime ::: ".$ctime." :::: ".strtotime("now")." :::: ".(strtotime("now") - $_SESSION['sessionX']);
    if(!isset($_SESSION['sessionX'])){  
        # create session time 
        $_SESSION['sessionX'] = $ctime;  
       // echo "<br>Decrypted String if: " . $decryption_un_c.":: ".$decryption_uid_c; 
        if(isset($_COOKIE['un_c']) && isset($_COOKIE['un_ic'])){
            $_SESSION['username']=$decryption_un_c;
            $_SESSION['cust_id']=$decryption_uid_c;
            $_SESSION['name']=$decryption_uname;
            //echo 'adjhdjh::: '.$_SESSION['U_Name_partner'];
           // echo "<br>Decrypted String if else 1: " . $decryption_un_c.":: ".$decryption_uid_c."uname :: ".$decryption_uname; 
          }
    }else{ 
        # Check if they have exceded the time limit of inactivity  
        if(((strtotime("now") - $_SESSION['sessionX']) > $logLength)){ 
            # If exceded the time, log the user out 
            //session_unset();
          //session_destroy();
          //unset($_SESSION['admin_UserId_partner']);
          //unset($_SESSION['U_Name_partner']);
          if(isset($_COOKIE['un_c']) && isset($_COOKIE['un_ic'])){
            $_SESSION['username']=$decryption_un_c;
            $_SESSION['cust_id']=$decryption_uid_c;
            $_SESSION['name']=$decryption_uname;
            //echo 'adjhdjh::: '.$_SESSION['U_Name_partner'];
            //echo "<br>Decrypted String if else: " . $decryption_un_c.":: ".$decryption_uid_c; 
          }else{
            unset($_COOKIE['un_ic']);
            unset($_COOKIE['un_c']);
            setcookie('un_ic',"",time()-60);
            setcookie('un_c',"",time()-60);
            session_unset();
            session_destroy();
            //echo '<script>(function(){window.location.href ="'.$baseurl.'"})();</script>';
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
  

  sessionX($decryption_un_c,$decryption_uid_c,$baseurl,$decryption_uname);

  



 
$cust_username='';
$loginUser='';
$session_ids=session_id();
$cart_count=0;
//echo '<br>session id header: ',$session_ids;
$dbControllers = new DBController();
//echo "abbc",$dbControllers->getMainCategory();
// print_r($dbControllers->getMainCategory());
require_once('codes/all-common-functions.php');




if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  {
    $url = "https://";   
} 
else{
    $url = "http://";      
    $url.= $_SERVER['HTTP_HOST'];       
    $url.= $_SERVER['REQUEST_URI'];
    //echo $url;
}
$page=$_SERVER['REQUEST_URI'];   
if(isset($_SESSION['username']))
{ 
    $cust_username =$_SESSION['username']; 
    $class='profile';
    $page=$_SERVER['REQUEST_URI'];
    if(strpos($page,'profile')>0 || strpos($page,'change-password')>0 || strpos($page,'addresses')>0 || strpos($page,'order-history')>0 || strpos($page,'pay')>0 || strpos($page,'verify')>0){
        $loginUser="true";
    }else{
        $loginUser="false";
    }
} 
$verfitOtp="false";
if(strpos($page,'verify-otp')>0 || strpos($page,'thank-you')>0){

  $verfitOtp="true";
    }else{
        $verfitOtp="false";
    }

//echo $loginUser;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  

    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="<?php echo $metaKeywords ?>">
    <meta name="description" content="<?php echo $metaDescription;?>">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo $baseurl?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/icon-style.css">

    <link rel="stylesheet" href="<?php echo $baseurl?>/css/bootstrap.min.css">
  <!--   <link rel="stylesheet" href="<?php echo $baseurl?>/css/magnific-popup.css"> -->
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/owl.theme.default.min.css">

   <!--  <link rel="stylesheet" href="<?php echo $baseurl?>/css/bootstrap-datepicker.css"> 
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/flaticon.css"> -->

    <link rel="stylesheet" href="<?php echo $baseurl?>/css/aos.css">
    <!-- <link rel="stylesheet" href="<?php echo $baseurl?>/css/rangeslider.css"> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="<?php echo $baseurl?>/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo $baseurl?>/css/icomoon.ttf"> -->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcFbZ9bBXviOqxPVyuLdpWtOCfgfshmzo&libraries=places"></script>
    
    <title><?php echo $title?></title>
    <!-- <script type="text/javascript">
		$(document).ready(function(){

			var autocomplete;
			var id = 'location';

			autocomplete = new google.maps.places.Autocomplete((document.getElementById(id)),{
				types:['geocode'],
			})

		});
    </script> --> 
    
    
 
    <style>
        .cartIcon .cart{
            padding: 0 !important;
            font-size: 20px;
        }
        .itemsCount{
            padding: 0  !important;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            /* background-color: #ea728c; */ 
            background-color: #000;
            text-align:center;
        }
        .cartIcon sup{
            left: -1px;
            bottom: 5px;
            top: -6px;
        }
    </style>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-246580864-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-246580864-1');
      gtag('config', 'AW-10974244937');
    </script>
    <!-- Meta Pixel Code -->
    
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1524972281259685');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1524972281259685&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    <meta name="facebook-domain-verification" content="qjscko8i3m4qbtcbkca28hs99fksle" />
     
</head>

<body>

    <div class="site-wrap">

        <div class="site-mobile-menu">
           <!--  <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div> -->
            <div class="site-mobile-menu-body"></div>
        </div>

        <header id="sticky-nav" class="<?php if(($loginUser!='' && $loginUser=='true') || ($verfitOtp=='true') ){ echo 'site-navbar profile';}else{echo 'site-navbar ';}?>" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-9 col-xl-4">
                        <h1 class="mb-0 site-logo"><a href="<?php echo $baseurl?>" class="text-white mb-0"><img src="<?php echo $baseurl?>/images/logo.png" alt=""> <!-- SPA Home Service<span class="text-primary">.</span> --> </a></h1>
                    </div>
                    <div class="col-12 col-md-8 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block"> 
                                   
                                <li class="has-children">
                                    <a href="#"><span>Book Services</span></a>
                                    <ul class="dropdown">
                                        <?php 
                                       
                                        $mainCategorys=array();
                                        $mainCategorys=$dbControllers->getMainCategory();
                                        foreach($mainCategorys as $mainCategory)
                                        {
                                                $url=str_replace(" ","-",$mainCategory['main_category_name']);
                                                $url=strtolower($url);
                                        ?>
                                        <li><a href="<?php echo $baseurl?>/services-list/<?php echo $url; ?>"><?php echo $mainCategory['main_category_name']?></a></li>
                                        
                                        <?php 
                                            
                                        }
                                        ?>
                                    </ul>
                                </li> 
                                
                                <li><a href="https://spahomeservice.in/blog/"><span> Blog</span></a></li>
                                
                                <?php 
                               
            
                                if ($cust_username && $cust_username!="" || $cust_username!=null){
                                    $name=$_SESSION['name']; 
                                    echo '
                                <li class="has-children">
                                <a><span>'.$name.'</span> </a>
                                <ul class="dropdown"> 
                                        <li><a href="'. $baseurl.'/profile">Profile</a></li>
                                        <li><a href="'. $baseurl.'/order-history">Order History</a></li>
                                        <li><a href="'. $baseurl.'/addresses">Save Addresses</a></li>
                                        <li><a href="'. $baseurl.'/logout">Logout</a></li>
                                    </ul>
                                </li>';
                                }
                                
                           
                                if(!isset($_SESSION['username'])){
                                    echo ' 
                                    <li><a href="'.$baseurl.'/login" style="padding-right:15px;">Login</a></li>
                                   ';
                                } 
                                ?>
                                <li class="d-none d-md-inline-block">
                                    <a class="cartIcon" href="<?php echo $baseurl?>/shopping-cart.php">
                                        <?php 
                                        $userid='';
                                        if(isset($_SESSION['username'])){
                                            $userid=$_SESSION['username'];
                                            $cart_count_query="select * from cart where user_id='$userid'";
                                        }else{
                                            $userid='Guest';
                                            $cart_count_query="select * from cart where session_id='$session_ids'";
                                        }
                                        
                                        
                                        $cart_count=$dbControllers->numRows($cart_count_query);   
                                        ?>
                                       <span class="cart"><i class="fa fa-shopping-cart"></i> </span> 
                                       <span class="itemsCount" id="cartCount"><sup><?php echo $cart_count; ?></sup></span>
                                    </a>
                                </li>
                                 <!--  <li><a href="<?php echo $baseurl?>/contact-us.php"><span>Contact</span></a></li> -->
                            </ul>
                        </nav>
                    </div>


                    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3 col-3 px-0" style="position: relative; top: 3px;">
                        <a class="d cartIcon d-inline-block align-top" href="<?php echo $baseurl?>/shopping-cart.php">
                            <?php 
                            $userid='';
                            if(isset($_SESSION['username'])){
                                $userid=$_SESSION['username'];
                                $cart_count_query="select * from cart where user_id='$userid'";
                            }else{
                                $userid='Guest';
                                $cart_count_query="select * from cart where session_id='$session_ids'";
                            }
                            
                            
                            $cart_count=$dbControllers->numRows($cart_count_query);   
                            ?>
                            <span class="cart"><i class="fa fa-shopping-cart"></i> </span> 
                            <span class="d itemsCount" id="cartCount"><?php echo $cart_count; ?></span>
                        </a>
                        <a href="#" class="site-menu-toggle js-menu-toggle text-white d-inline-block">
                            <div class="menuIcon"></div>
                            <div class="menuIcon"></div>
                            <div class="menuIcon"></div>
                        </a>
                    </div>


                </div>

            </div>
    </div>

    </header>