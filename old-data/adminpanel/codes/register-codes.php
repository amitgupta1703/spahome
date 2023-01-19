<?php
include 'dbwe.php';
if(isset($_POST['activate_user']) && isset($_SESSION['U_Name_career'])){
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $user_check_query = "update career_register set status='Active' where user_id='$user_id' ";
    mysqli_query($db, $user_check_query);
  }

  if(isset($_POST['deactivate_user']) && isset($_SESSION['U_Name_career'])){
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $user_check_query = "update career_register set status='Inactive'where user_id='$user_id' ";
    mysqli_query($db, $user_check_query);
  }
?>