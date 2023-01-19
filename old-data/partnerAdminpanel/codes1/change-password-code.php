<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include '../config.php';

if (isset($_POST['change_password']) && isset($_SESSION['U_Name_partner']) && $_SESSION['U_Name_partner']!="") {
    $old_password = mysqli_real_escape_string($db, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($db, $_POST['new_password']);  
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']); 
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    $partner_username;
    if(isset($_SESSION['admin_UserId_partner']) && isset($_SESSION['U_Name_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
      $partner_username=$_SESSION['U_Name_partner'];
    } 
 

    if (empty($old_password)) { array_push($errors, "Please enter old password"); } 
    if (empty($new_password)) { array_push($errors, "Please enter new password"); } 
    if (empty($confirm_password)) { array_push($errors, "Please enter confirm password"); } 

  

    $services_name_query = "select * from admin_spa_login where id='$partner_admin_id' and roles='partners' limit 1";
      $services_names = mysqli_query($db, $services_name_query);
      $codes = mysqli_fetch_assoc($services_names);
      
      echo 'a:'.$codes['admin_password'].'o:'.$old_password;
      if ($codes) { // if user exists
        
        if ($old_password!==$codes['admin_password']) { 
          array_push($errors, "Old password does not matched");
        }
      }
    
      if($new_password!==$confirm_password){
        array_push($errors, "New password and confirm password did't matched");
    }
    $partners='partners';
  
        if (count($errors) == 0) {
             
            $stmt = $db->prepare("update admin_spa_login set admin_password=? where id=? and admin_username=? and roles=?");
            $stmt->bind_param("ssss", $new_password, $partner_admin_id, $partner_username,$partners);
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
  

 
 

?>