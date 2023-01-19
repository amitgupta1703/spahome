<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include 'dbwe.php';

if (isset($_POST['generate_access_code']) && isset($_SESSION['U_Name_career']) && $_SESSION['U_Name_career']!="") {

    $access_code = mysqli_real_escape_string($db, $_POST['access_code']);  


    if (empty($access_code)) { array_push($errors, "Please enter access code"); } 
  

   $validity='valid';
   $user_check_query = "select * from career_access_codes where  access_code='$access_code' limit 1";
   $result = mysqli_query($db, $user_check_query);
   $codes = mysqli_fetch_assoc($result);
   
   if ($codes) { // if user exists
     
     if ($codes['access_code'] === $access_code) {
       array_push($errors, "Access Code already in database");
     }
   }
  
       // echo 'user admin id '.$register_id. ' :: name '. $name;
  
        if (count($errors) == 0) {
             
             //array_push($errors, '$company_name');
             $queryInsert= "insert into career_access_codes(access_code,date,validity) values('$access_code',Now(),'$validity')";
             $result1 = mysqli_query($db, $queryInsert); 
            if($result1){
              echo '<script>(function(){alert("Access Code Generated successfully");window.location.href ="all-access-code.php";})();</script>';
              //include '../errors.php';
            }
            else{
              echo '<script>(function(){alert("Access Code not Generated successfully");window.location.href ="post-access-code.php";})();</script>';
              //include '../errors.php';
            }
          
               
             
         }
         else{
  
  
         // include 'errors.php';
  
            echo '<script>(function(){alert("Access Code not Generated successfully");})();</script>';
           // echo $id.'ansdbansbnfbasf'.$name;
         }
        }
  
  
  


if(isset($_POST['activate_code']) && isset($_SESSION['U_Name_career'])){
    $access_id = mysqli_real_escape_string($db, $_POST['access_id']);
    $user_check_query = "update career_access_codes set validity='valid' where access_id='$access_id' ";
    mysqli_query($db, $user_check_query);
  }

  if(isset($_POST['deactivate_code']) && isset($_SESSION['U_Name_career'])){
    $access_id = mysqli_real_escape_string($db, $_POST['access_id']);
    $user_check_query = "update career_access_codes set validity='expired'where access_id='$access_id' ";
    mysqli_query($db, $user_check_query);
  }
?>