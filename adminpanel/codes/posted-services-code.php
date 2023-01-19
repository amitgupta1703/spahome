<?php 
include 'dbwe.php';
if(isset($_POST['activate_service']) && isset($_SESSION['spa_userName'])){
   
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $user_check_query = "update partners_services set admin_status='Approved' where service_id='$id' ";
    mysqli_query($db, $user_check_query);
  }

  if(isset($_POST['deactivate_service']) && isset($_SESSION['spa_userName'])){
    $id = mysqli_real_escape_string($db, $_POST['id']); 
    $user_check_query = "update partners_services set admin_status='Rejected' where service_id='$id' ";
    mysqli_query($db, $user_check_query);
  }
?>