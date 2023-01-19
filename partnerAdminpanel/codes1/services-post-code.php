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
    $duration='';
    if($services_name=='Spa Services' || $services_name=='Ayurvedic Spa'){
      $duration = mysqli_real_escape_string($db, $_POST['duration']); 
      if (empty($duration)) { array_push($errors, "Please enter duration"); } 
    }else{
      $duration='';
    }
    if (empty($services_name)) { array_push($errors, "Please enter services name"); }
    $spaServices='';
    if(isset($_POST['check_list'])){

      foreach($_POST['check_list'] as $checkbox) {
          //echo 's'.$checkbox;
          $spaServices=$spaServices.','.$checkbox;
       }
       $services_name=$services_name.$spaServices;
  }

  
  $offersOrDiscount = mysqli_real_escape_string($db, $_POST['offersOrDiscount']);
  if($offersOrDiscount=="-1"){
    array_push($errors, "Please select offers or discounts");
  }
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    if(isset($_SESSION['admin_UserId_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
    }
    $admin_status='Rejected';
    $status='active';

   // echo 'sn:'.$services_name.' sd:'.$services_description.' a: '.$amount.'uplo:';

     
    if (empty($services_description)) { array_push($errors, "Please enter services description"); } 
   

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
      
     /*  if ($codes) { // if user exists
        
        if ($codes['services_name'] === $services_name) {
          array_push($errors, "Service already in database");
        }
      } */
      $date = date('Y-m-d H:i:s');

       // echo 'user admin id '.$register_id. ' :: name '. $name;
  
        if (count($errors) == 0) {
             
          $stmt = $db->prepare("INSERT INTO partners_services(services_name,duration,services_description,amount,offersOrDiscount,services_image,partners_admin_id,admin_status,status,date) VALUES(?,?,?,?,?,?,?,?,?,?)");
          $stmt->bind_param("ssssssssss", $services_name,$duration,$services_description, $amount,$offersOrDiscount,$target_path,$partner_admin_id,$admin_status,$status,$date);
          $stmt->execute();
          array_push($successMsg,"Service added successfully we will review first then activate!");
          $services_name="";
          $services_description="";
          $amount="";
          $duration="";
             
        } 
         else{
            echo "not post";
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  

 

if (isset($_POST['post_services_update']) && isset($_SESSION['U_Name_partner']) && $_SESSION['U_Name_partner']!="" && isset($_GET['service_id']) && $_GET['service_id']!="") {
    $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
    $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']); 
    $duration = mysqli_real_escape_string($db, $_POST['duration']); 
    $offersOrDiscount = mysqli_real_escape_string($db, $_POST['offersOrDiscount']);
    if($offersOrDiscount=="-1"){
      array_push($errors, "Please select offers or discounts");
    }
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    if(isset($_SESSION['admin_UserId_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
    }
    $admin_status='Rejected';
    $status='active';
    if (empty($services_name)) { array_push($errors, "Please enter services name"); }
    $spaServices='';
    if(isset($_POST['check_list'])){

      foreach($_POST['check_list'] as $checkbox) {
          //echo 's'.$checkbox;
          $spaServices=$spaServices.','.$checkbox;
       }
       $services_name=$services_name.$spaServices;
  }
  $service_id=$_GET['service_id'];

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
             
          $stmt = $db->prepare("update partners_services set services_name=?,duration=?,services_description=?,amount=?,offersOrDiscount=?,services_image=? where service_id=?");
          $stmt->bind_param("sssssss", $services_name,$duration, $services_description, $amount,$offersOrDiscount,$target_path,$service_id);
         $stmt->execute();
          array_push($successMsg,"Service update successfully we will review first then activate!");
          $services_name="";
          $services_description="";
          $amount="";
          $duration="";
             
            }
          
               
             
         
         else{
            echo "not post";
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  


        if(isset($_POST['activate_service']) && isset($_SESSION['U_Name_partner'])){
   
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update partners_services set status='active' where service_id='$id' ";
          mysqli_query($db, $user_check_query);
        }
      
        if(isset($_POST['deactivate_service']) && isset($_SESSION['U_Name_partner'])){
          $id = mysqli_real_escape_string($db, $_POST['id']); 
          $user_check_query = "update partners_services set status='deactive' where service_id='$id' ";
          mysqli_query($db, $user_check_query);
        }
 

        if(isset($_POST['accept_service']) && isset($_SESSION['U_Name_partner'])){
         // echo "sdhjkhdfj : ".$id;
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update book_appointment set bookingStatus='accepted', reason='' where id='$id' ";
          mysqli_query($db, $user_check_query);
        }
      
        if(isset($_POST['submit_reason']) && isset($_SESSION['U_Name_partner'])){
          $id = mysqli_real_escape_string($db, $_POST['service_id']); 
          $assign_id = mysqli_real_escape_string($db, $_POST['assign_id']);  
          $reason = mysqli_real_escape_string($db, $_POST['reason']); 

          $user_check_query = "update book_appointment set bookingStatus='rejected', reason='$reason',isassigned='false' where id='$id' ";
          mysqli_query($db, $user_check_query);

          $user_check_query1 = "update spa_assign_lead set bookingStatus='rejected',isassigned='false',partner_request_status='rejected',partner_reason='$reason' where booking_id='$id' and id='$assign_id' ";
          mysqli_query($db, $user_check_query1);
        }

        if(isset($_POST['pending_service']) && isset($_SESSION['U_Name_partner'])){
   
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update book_appointment set bookingStatus='pending', reason='' where id='$id' ";
          mysqli_query($db, $user_check_query);
        }
        if(isset($_POST['complete_service']) && isset($_SESSION['U_Name_partner'])){
   
          $assign_id = mysqli_real_escape_string($db, $_POST['assign_id']);
          $id = mysqli_real_escape_string($db, $_POST['id']);
           
          $user_check_query = "update book_appointment set bookingStatus='completed', reason='' where id='$id' ";
          mysqli_query($db, $user_check_query);

          $user_check_query_completed = "update spa_assign_lead set bookingStatus='completed' where booking_id='$id' and id='$assign_id' ";

          
          mysqli_query($db, $user_check_query_completed);
        }
?>