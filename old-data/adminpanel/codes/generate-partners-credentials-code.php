<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include 'dbwe.php';

if (isset($_POST['generate_partners']) && isset($_SESSION['spa_userName']) && $_SESSION['spa_userName']!="") {

    $admin_username = mysqli_real_escape_string($db, $_POST['admin_username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);  
    $status = mysqli_real_escape_string($db, $_POST['status']); 
    if($status=="-1"){
        array_push($errors, "Please select status");
    }
    $roles = mysqli_real_escape_string($db, $_POST['roles']); 
    if($roles=="-1"){
        array_push($errors, "Please select roles");
    }
    $date = date('Y-m-d H:i:s'); 
    if (empty($admin_username)) { array_push($errors, "Please enter user name"); } 
    if (empty($password)) { array_push($errors, "Please enter password"); }  
       // echo 'user admin id '.$register_id. ' :: name '. $name;

       $user_check_query = "select * from admin_spa_login where admin_username='$admin_username' limit 1";
       $result = mysqli_query($db, $user_check_query);
       $codes = mysqli_fetch_assoc($result);
       
       if ($codes) { // if user exists
         
         if ($codes['admin_username'] === $admin_username) {
           array_push($errors, "Username already in database");
         }
       }
  
        if (count($errors) == 0) {
             
            $stmt = $db->prepare("INSERT INTO admin_spa_login(admin_username,admin_password,roles,date,status) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss", $admin_username, $password, $roles,$date,$status);
           $stmt->execute();
           $admin_username="";
           $password="";
           $roles="";
           $date="";
           $status=""; 
         array_push($successMsg,"Partners Credentials generated successfully!");
               
             
         }
         else{
   
         }
        }
  

        
        if(isset($_POST['activate_partners']) && isset($_SESSION['spa_userName'])){
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $user_check_query = "update admin_spa_login set status='active' where id='$id' ";
            mysqli_query($db, $user_check_query);
          }
        
          if(isset($_POST['deactivate_partners']) && isset($_SESSION['spa_userName'])){
            $id = mysqli_real_escape_string($db, $_POST['id']);
            $user_check_query = "update admin_spa_login set status='deactive'where id='$id' ";
            mysqli_query($db, $user_check_query);
          }

          if(isset($_POST['link_partners']) && isset($_SESSION['spa_userName'])){
            $partner_id = mysqli_real_escape_string($db, $_POST['partner_id']);
            $admin_id = mysqli_real_escape_string($db, $_POST['admin_id']);
            $user_check_query = "update spa_partners set link_partner_admin_id='$admin_id', status='approved' where partner_id='$partner_id'";
            mysqli_query($db, $user_check_query);
          }

          


?>