

<?php
session_start();


if(isset($_POST["admin_submit_career"]))
{
	$uName=$_POST["admin_username_career"];
	$pwd=$_POST["admin_pwd_career"];
	
	include '../config.php';
	
	$query="select * from admin_spa_login where admin_username='$uName' and admin_password='$pwd' and roles='admin' and status='active'";
	
	$result=mysqli_query($db, $query);
	
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result); 
	$_SESSION['admin_spa_UserId'] = $row['id'];
	$_SESSION['spa_userName'] = $row['admin_username']; 
	$_SESSION['login_time'] = time();
 
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

    <title>Welcome to Career Felix Admin Panel </title>

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
                <input type="text" name="admin_username_career" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="admin_pwd_career" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" name="admin_submit_career" class="btn btn-warning" value="Login" style="width:100%;margin-left:0 !important;">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                 
                  <p>©2019 All Rights Reserved. Career</p>
                </div>
              </div>
            </form>
          </section>
        </div>

         
    </div>
  </body> 
</html>
