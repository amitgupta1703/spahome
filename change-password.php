<?php 
$title="Change Password";
include 'header.php';
include 'codes/login-code.php';
include 'profile-header.php';
$customer_name='';
$email='';
$contact='';

if(!isset($_SESSION['username']) && $_SESSION['username']=='' && !isset($_SESSION['cust_id'])){
    echo "<script> window.location.assign('index.php'); </script>";
}else{
    $uname=$_SESSION['username'];
    if (isset($_POST['change_password']) && isset($_SESSION['username'])) {
        echo "abc";
        $old_password = mysqli_real_escape_string($db, $_POST['oldpassword']);
        $new_password = mysqli_real_escape_string($db, $_POST['newpassword']);  
        $confirm_password = mysqli_real_escape_string($db, $_POST['confirmpassword']); 
         
    
        if (empty($old_password)) { array_push($errors, "Please enter old password"); } 
        if (empty($new_password)) { array_push($errors, "Please enter new password"); } 
        if (empty($confirm_password)) { array_push($errors, "Please enter confirm password"); } 
    
      
    
        $services_name_query = "select * from spa_customers where cust_username='$uname' limit 1";
          $services_names = mysqli_query($db, $services_name_query);
          $codes = mysqli_fetch_assoc($services_names); 
          if ($codes) { // if user exists
            
            if ($old_password!==$codes['cust_password']) { 
              array_push($errors, "Old password does not matched");
            }
          }
        
          if($new_password!==$confirm_password){
            array_push($errors, "New password and confirm password did't matched");
        } 
      
            if (count($errors) == 0) {
                 
                $stmt = $db->prepare("update spa_customers set cust_password=? where cust_username=?");
                $stmt->bind_param("ss", $new_password, $uname);
               $stmt->execute();
             array_push($successMsg,"Password update successfully!");
                 
                } 
             
             else{
               // echo "not post";
             }
            }
            else{
              //echo '<script>(function(){window.location.href ="index.php";})();</script>';
            }
      
    
     
}
?>

<style> 
.s{
    border-top: 1px solid #c3c3c3;
    border-width: thin;
    width: 30%;
}

</style>
 
   
    <div class="site-section bg-light mt-5">
      <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include 'profile-sidebar.php'; ?>
            </div> 
            <div class="col-md-8 aos-init aos-animate" data-aos="fade" data-aos-delay="100"> 
                <div class="card box inners">
                    <p class="fs18">Change Password</p>
                    <div class="card box">
                        
                    <form action="change-password.php" method="post" class="p-3 bg-white"> 
                        <div style="margin-top:1rem;color:red;">
                            <?php  include 'errors.php' ?>
                        </div>
                        <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                            <?php  include 'success.php' ?>
                        </div> 
                        <div class="row form-group">
                            <div class="col-md-12">
                            <label class="text-black" for="oldpassword">Old Password</label> 
                            <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder=" " value=""> 
                           <!--  <span class="input__label">Old Password</span>  -->
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                            <label class="text-black" for="newpassword">New Password</label> 
                            <input type="password" id="newpassword" name="newpassword" class="form-control " placeholder=" " value="">
                            <!-- <span class="input__label">New Password</span>  -->
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                            <label class="text-black" for="confirmpassword">Confirm Password</label> 
                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder=" " value="">
                           <!--  <span class="input__label">Confirm Password</span> -->
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                            <input type="submit" style="width:100% !important" name="change_password" value="Change Password" class="btn btn-pil btn-primary btn-md text-white">
                             
                            </div>
                        </div> 
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

<?php 
include 'profile-footer.php';
include 'footer.php';
?>