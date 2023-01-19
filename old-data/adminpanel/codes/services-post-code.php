<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include 'dbwe.php';

if (isset($_POST['post_services']) && isset($_SESSION['U_Name_career']) && $_SESSION['U_Name_career']!="") {

    $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
    $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']); 


    if (empty($services_name)) { array_push($errors, "Please enter services name"); } 
    if (empty($amount)) { array_push($errors, "Please enter amount"); } 
  

   $services_name_query = "select * from career_services_amount where  services_name='$services_name' limit 1";
   $services_names = mysqli_query($db, $services_name_query);
   $codes = mysqli_fetch_assoc($services_names);
   
   if ($codes) { // if user exists
     
     if ($codes['services_name'] === $services_name) {
       array_push($errors, "Service already in database");
     }
   }
  
       // echo 'user admin id '.$register_id. ' :: name '. $name;
  
        if (count($errors) == 0) {
             
             //array_push($errors, '$company_name');
             $queryInsert= "insert into career_services_amount(services_name,services_description,amount) values('$services_name','$services_description','$amount')";
             $result1 = mysqli_query($db, $queryInsert); 
            if($result1){
             echo '<script>(function(){alert("Service inserted successfully");window.location.href ="all-posted-services.php";})();</script>';
              //include '../errors.php';
            }
            else{
             echo '<script>(function(){alert("Service not inserted successfully");window.location.href ="post-services.php";})();</script>';
              //include '../errors.php';
            }
          
               
             
         }
         else{
  
  
         // include 'errors.php';
  
           // echo '<script>(function(){alert("Service not inserted successfully");})();</script>';
           // echo $id.'ansdbansbnfbasf'.$name;
         }
        }
  

        if (isset($_POST['post_services_update']) && isset($_SESSION['U_Name_career']) && $_SESSION['U_Name_career']!="" && isset($_GET['services_id'])) {

            $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
            $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
            $amount = mysqli_real_escape_string($db, $_POST['amount']); 
        
        
            if (empty($services_name)) { array_push($errors, "Please enter services name"); } 
            if (empty($amount)) { array_push($errors, "Please enter amount"); } 
          
        
            
          
               // echo 'user admin id '.$register_id. ' :: name '. $name;
          
                if (count($errors) == 0) {
                  $services_id= $_GET['services_id'];
                     //array_push($errors, '$company_name');
                     $queryUpdate= " update career_services_amount set services_name='$services_name',services_description='$services_description',amount='$amount' where services_id='$services_id'";
                     $resultUpdate = mysqli_query($db, $queryUpdate); 
                    if($resultUpdate){
                      echo '<script>(function(){alert("Service updated successfully");window.location.href ="all-posted-services.php";})();</script>';
                      //include '../errors.php';
                    }
                    else{
                      echo '<script>(function(){alert("Service not updated successfully");window.location.href ="post-services.php";})();</script>';
                      //include '../errors.php';
                    }
                  
                       
                     
                 }
                 else{
          
          
                 // include 'errors.php';
          
                    echo '<script>(function(){alert("Service not updated successfully");})();</script>';
                   // echo $id.'ansdbansbnfbasf'.$name;
                 }
                }
  
  



?>