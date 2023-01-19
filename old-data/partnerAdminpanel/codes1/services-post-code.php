<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include '../config.php';

if (isset($_POST['post_services']) && isset($_SESSION['U_Name_partner']) && $_SESSION['U_Name_partner']!="") {
    $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
    $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']); 
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    if(isset($_SESSION['admin_UserId_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
    }
    $admin_status='Rejected';
    $status='active';

   // echo 'sn:'.$services_name.' sd:'.$services_description.' a: '.$amount.'uplo:';

    if (empty($services_name)) { array_push($errors, "Please enter services name"); } 
    if (empty($services_description)) { array_push($errors, "Please enter services description"); } 
    if (empty($amount)) { array_push($errors, "Please enter amount"); } 

    $allowedExts = array(
      "jpg", 
      "jpeg", 
      "png",
      "gif"
    ); 
    
    $allowedMimeTypes = array( 
    
      'image/gif',
      'image/jpeg',
      'image/png',
      'image/jpg'
    );

    $queryGetCount="select count(*) as total from partners_services";
    $result = mysqli_query($db, $queryGetCount);
    $allRecord=mysqli_fetch_assoc($result);
    $totalRecord;
    
    if($allRecord>0)
    {
        $totalRecord=$allRecord['total'];
        $totalRecord=$totalRecord+1;
    }

    $target_path = "partnerAdminpanel/services_img/";
    //$file = $_POST['uploadResume'];
    $target_path = $target_path.basename( $totalRecord.'_'. $_FILES["uploadLogo"]["name"]); 
    $file_name= $totalRecord.'_'.$_FILES["uploadLogo"]["name"];
    $file_name=strtolower($file_name);
    $temp = explode('.', $file_name);

    $extension = end($temp);

    //array_push($errors, "Extension ".$extension);

      if ( 1048576 < $_FILES["uploadLogo"]["size"]  ) { 
      array_push($errors, "File size should be less than 1MB ");
      }

      if ( ! ( in_array($extension, $allowedExts ) ) ) {
          array_push($errors, "Please upload jpeg, png, gif ");
      }
      else{
        move_uploaded_file($_FILES["uploadLogo"]["tmp_name"], '../'.$target_path); 
      }
 
      $services_name_query = "select * from partners_services where  services_name='$services_name' limit 1";
      $services_names = mysqli_query($db, $services_name_query);
      $codes = mysqli_fetch_assoc($services_names);
      
      if ($codes) { // if user exists
        
        if ($codes['services_name'] === $services_name) {
          array_push($errors, "Service already in database");
        }
      }
      $date = date('Y-m-d H:i:s');

       // echo 'user admin id '.$register_id. ' :: name '. $name;
  
        if (count($errors) == 0) {
             
          $stmt = $db->prepare("INSERT INTO partners_services(services_name,services_description,amount,services_image,partners_admin_id,admin_status,status,date) VALUES(?,?,?,?,?,?,?,?)");
          $stmt->bind_param("ssssssss", $services_name, $services_description, $amount,$target_path,$partner_admin_id,$admin_status,$status,$date);
         $stmt->execute();
       array_push($successMsg,"Service added successfully we will review first then activate!");
             
            }
          
               
             
         
         else{
            echo "not post";
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  

 

if (isset($_POST['post_services_update']) && isset($_SESSION['U_Name_partner']) && $_SESSION['U_Name_partner']!="") {
    $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
    $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']); 
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    if(isset($_SESSION['admin_UserId_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
    }
    $admin_status='Rejected';
    $status='active';
 

    if (empty($services_name)) { array_push($errors, "Please enter services name"); } 
    if (empty($services_description)) { array_push($errors, "Please enter services description"); } 
    if (empty($amount)) { array_push($errors, "Please enter amount"); } 

    $allowedExts = array(
      "jpg", 
      "jpeg", 
      "png",
      "gif"
    ); 
    
    $allowedMimeTypes = array( 
    
      'image/gif',
      'image/jpeg',
      'image/png',
      'image/jpg'
    );

    $queryGetCount="select count(*) as total from partners_services";
    $result = mysqli_query($db, $queryGetCount);
    $allRecord=mysqli_fetch_assoc($result);
    $totalRecord;
    
    if($allRecord>0)
    {
        $totalRecord=$allRecord['total'];
        $totalRecord=$totalRecord+1;
    }

    $target_path = "partnerAdminpanel/services_img/";
    //$file = $_POST['uploadResume'];
    $target_path = $target_path.basename( $totalRecord.'_'. $_FILES["uploadLogo"]["name"]); 
    $file_name= $totalRecord.'_'.$_FILES["uploadLogo"]["name"];
    $file_name=strtolower($file_name);
    $temp = explode('.', $file_name);

    $extension = end($temp);

    //array_push($errors, "Extension ".$extension);

      if ( 1048576 < $_FILES["uploadLogo"]["size"]  ) { 
      array_push($errors, "File size should be less than 1MB ");
      }

      if ( ! ( in_array($extension, $allowedExts ) ) ) {
          array_push($errors, "Please upload jpeg, png, gif ");
      }
      else{
        move_uploaded_file($_FILES["uploadLogo"]["tmp_name"], '../'.$target_path); 
      }
 
     
      $date = date('Y-m-d H:i:s');

       // echo 'user admin id '.$register_id. ' :: name '. $name;
  
        if (count($errors) == 0) {
             
          $stmt = $db->prepare("update partners_services set services_name=?,services_description=?,amount=?,services_image=?");
          $stmt->bind_param("ssss", $services_name, $services_description, $amount,$target_path);
         $stmt->execute();
       array_push($successMsg,"Service update successfully we will review first then activate!");
             
            }
          
               
             
         
         else{
            echo "not post";
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  

?>