

<?php
session_start();
include '../config.php';
include 'dbwe.php';

if(isset($_POST["admin_submit_partner"]))
{
 
  $uName = mysqli_real_escape_string($db, $_POST['admin_username']);
  $pwd = mysqli_real_escape_string($db, $_POST['admin_pwd']); 
	$query="select * from partners_registration where partners_username='$uName' and partners_password='$pwd' and roles='partners' and status='active'";
	$result=mysqli_query($db, $query);
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result);  
  $_SESSION['admin_UserId_partner'] = $row['partners_id']; 
	$_SESSION['U_Name_partner'] = $row['partners_username']; 
  $_SESSION['login_time'] = time();

/*   setcookie('admin_UserId_partner',$row['partners_id'],time()+60*60*24*30);
  setcookie('U_Name_partner',$row['partners_username'],time()+60*60*24*30); */


  $U_Name_partner = $row['partners_username']; 
  $admin_UserId_partner = $row['partners_id'];

  echo "Original String: " . $simple_string; 
  $ciphering = "AES-128-CTR"; 
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0; 
  $encryption_iv = '1234567891011121'; 
  $encryption_key = "admin_un"; 
  $encryption_un = openssl_encrypt($U_Name_partner, $ciphering, $encryption_key, $options, $encryption_iv); 

  $encryption_key1 = "admin_uid"; 
  $encryption_uid = openssl_encrypt($admin_UserId_partner, $ciphering, $encryption_key1, $options, $encryption_iv); 
 
  setcookie('un_',$encryption_un,time()+60*60*24*30);
  setcookie('un_i',$encryption_uid,time()+60*60*24*30);
	header("location: dashboard.php");
}
else
{
  echo "<script>alert('User Name or Password is Incorrect !')</script>";
}
	
}


?>
 
<!DOCTYPE html>
<html lang="en">

 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to Spa Partner Panel </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
		    <div>
			<!--img src="images/logo.png" width="80%"/-->
			</div>
            <form role="form" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="admin_username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="admin_pwd" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" name="admin_submit_partner" class="btn btn-warning" value="Login" style="width:100%;margin-left:0 !important;">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                 
                  <p>©<script>document.write(new Date().getFullYear())</script> All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

         
    </div>
  </body> 
</html>
