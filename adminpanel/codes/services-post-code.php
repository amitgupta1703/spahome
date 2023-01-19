<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include '../config.php';


if (isset($_POST['post_services']) && isset($_SESSION['spa_userName']) && $_SESSION['spa_userName']!="") {
    $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
    $main_category_name = mysqli_real_escape_string($db, $_POST['main_category_name']);
    if($main_category_name=="-1"){
      array_push($errors, "Please select main services");
    }
     
    $category_name = mysqli_real_escape_string($db, $_POST['category_name']);
    if($category_name=="-1"){
      array_push($errors, "Please select category");
    }
     
    $subcategory_name = mysqli_real_escape_string($db, $_POST['subcategory_name']);
    if($subcategory_name=="-1"){
      array_push($errors, "Please select sub category");
    }
    $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    $duration = mysqli_real_escape_string($db, $_POST['duration']); 
    if (empty($services_name)) { array_push($errors, "Please enter services name"); }
    

   
  $offersOrDiscount = mysqli_real_escape_string($db, $_POST['offersOrDiscount']);
  if($offersOrDiscount=="-1"){
    array_push($errors, "Please select offers or discounts");
  }
    //$uploadLogo = mysqli_real_escape_string($db, $_POST['uploadLogo']); 
    $partner_admin_id;
    if(isset($_SESSION['admin_spa_UserId'])){
      $partner_admin_id=$_SESSION['admin_spa_UserId'];
    }
    $admin_status='Approved';
    $status='active';

   // echo 'sn:'.$services_name.' sd:'.$services_description.' a: '.$amount.'uplo:';

     
    if (empty($services_description)) { array_push($errors, "Please enter services description"); } 
   

  /*   $allowedExts = array(
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
    ); */

    $queryGetCount="select count(*) as total from services";
    $result = mysqli_query($db, $queryGetCount);
    $allRecord=mysqli_fetch_assoc($result);
    $totalRecord;
    
    if($allRecord>0)
    {
        $totalRecord=$allRecord['total'];
        $totalRecord=$totalRecord+1;
    }

    //$target_path = "../services_img/";
    //$file = $_POST['uploadResume'];
   /*  $target_path = $target_path.basename( $totalRecord.'_'. $_FILES["uploadLogo"]["name"]); 
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
      } */

      
            // Configure upload directory and allowed file types
            $upload_dir = './../services_img/'.DIRECTORY_SEPARATOR;
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
            $target_path='';
            // Define maxsize for files i.e 2MB
            $maxsize = 4 * 1024 * 1024;
        
            // Checks if user sent an empty form
            if(!empty(array_filter($_FILES['uploadImg']['name']))) {
        
                // Loop through each file in files[] array
                foreach ($_FILES['uploadImg']['tmp_name'] as $key => $value) {
                    
                    $file_tmpname = $_FILES['uploadImg']['tmp_name'][$key];
                    $file_name = $_FILES['uploadImg']['name'][$key];
                    $file_size = $_FILES['uploadImg']['size'][$key];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
                    // Set upload file path
                    $filepath = $upload_dir.$file_name;
                  
                    // Check file type is allowed or not
                    if(in_array(strtolower($file_ext), $allowed_types)) {
        
                        // Verify file size - 4MB max
                        if ($file_size > $maxsize)		 
                            array_push($errors, "File size should be less than 4MB ");
        
                        // If file with name already exist then append time in
                        // front of name of the file to avoid overwriting of file
                        if(file_exists($filepath)) {
                            $filepath = $upload_dir.time().$file_name;
 
                            
                            if( move_uploaded_file($file_tmpname, $filepath)) {   
                                $target_path.=','.time().$file_name;
                            }
                            else {					 
                                array_push($errors, "Error uploading, Try again!! ");
                            }
                        }
                        else {
                        
                            if( move_uploaded_file($file_tmpname, $filepath)) { 
                               $target_path.=','.$file_name;
                            }
                            else {					
                                array_push($errors, "Error uploading, Try again!! ");
                            }
                        }
                    }
                    else { 
                        array_push($errors, "Error uploading, Try again!! "); 
                        array_push($errors, "({$file_ext} file type is not allowed)<br / >");
                    }
                }
                
            }
            else { 
                array_push($errors, "No image selected, Please select image ");
            }
 
      $services_name_query = "select * from services where  services_name='$services_name' limit 1";
      $services_names = mysqli_query($db, $services_name_query);
      $codes = mysqli_fetch_assoc($services_names);
      
      if ($codes) { // if user exists
        
        if ($codes['services_name'] === $services_name) {
          //array_push($errors, "Service name already in database");
        }
      }
      date_default_timezone_set('Asia/Kolkata');
      $date = date('Y-m-d H:i:s');

       // echo 'user admin id '.$register_id. ' :: name '. $name;
      
  
        if (count($errors) == 0) {
             
          $stmt = $db->prepare("INSERT INTO services(services_name,main_category,category,subcategory,duration,services_description,amount,offersOrDiscount,services_image,partners_admin_id,admin_status,status,date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $rc= $stmt->bind_param("sssssssssssss", $services_name,$main_category_name,$category_name,$subcategory_name,$duration,$services_description, $amount,$offersOrDiscount,$target_path,$partner_admin_id,$admin_status,$status,$date);
          $rc=$stmt->execute();
          if($rc==false){
            array_push($errors,"Something went wrong! Service not added successfully!");
          }else{
            array_push($successMsg,"Service added successfully!");
            $services_name="";
            $services_description="";
            $amount="";
            $duration="";
          }
         
             
        } 
         else{
          array_push($errors,"Something went wrong! Service not added successfully!");
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  

 

if (isset($_POST['post_services_update']) && isset($_SESSION['spa_userName']) && $_SESSION['spa_userName']!="") {
  $service_id = mysqli_real_escape_string($db, $_POST['service_id']);
  $services_name = mysqli_real_escape_string($db, $_POST['services_name']);
  $main_category_name = mysqli_real_escape_string($db, $_POST['main_category_name']);
  $imagesUrls = mysqli_real_escape_string($db, $_POST['imagesUrls']);
  if($main_category_name=="-1"){
    array_push($errors, "Please select main services");
  }
   
  $category_name = mysqli_real_escape_string($db, $_POST['category_name']);
  if($category_name=="-1"){
    array_push($errors, "Please select category");
  }
   
  $subcategory_name = mysqli_real_escape_string($db, $_POST['subcategory_name']);
  if($subcategory_name=="-1"){
    array_push($errors, "Please select sub category");
  }
  $services_description = mysqli_real_escape_string($db, $_POST['services_description']);  
  $amount = mysqli_real_escape_string($db, $_POST['amount']);
  $duration = mysqli_real_escape_string($db, $_POST['duration']); 
  if (empty($services_name)) { array_push($errors, "Please enter services name"); }
  


$offersOrDiscount = mysqli_real_escape_string($db, $_POST['offersOrDiscount']);
if($offersOrDiscount=="-1"){
  array_push($errors, "Please select offers or discounts");
}  
  if (empty($services_description)) { array_push($errors, "Please enter services description"); } 
 

 /*  $allowedExts = array(
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
  ); */

  $queryGetCount="select count(*) as total from services";
  $result = mysqli_query($db, $queryGetCount);
  $allRecord=mysqli_fetch_assoc($result);
  $totalRecord;
  
  if($allRecord>0)
  {
      $totalRecord=$allRecord['total'];
      $totalRecord=$totalRecord+1;
  }

  /* $target_path = "adminpanel/services_img/";
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
    } */


    // Configure upload directory and allowed file types
    $upload_dir = './../services_img/'.DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
    $target_path='';
    // Define maxsize for files i.e 2MB
    $maxsize = 4 * 1024 * 1024;

    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['uploadImg']['name']))) {

        // Loop through each file in files[] array
        foreach ($_FILES['uploadImg']['tmp_name'] as $key => $value) {
            
            $file_tmpname = $_FILES['uploadImg']['tmp_name'][$key];
            $file_name = $_FILES['uploadImg']['name'][$key];
            $file_size = $_FILES['uploadImg']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            // Set upload file path
            $filepath = $upload_dir.$file_name;
          
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {

                // Verify file size - 4MB max
                if ($file_size > $maxsize)		 
                    array_push($errors, "File size should be less than 4MB ");

                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;

                    
                    if( move_uploaded_file($file_tmpname, $filepath)) {   
                        $target_path.=','.time().$file_name;
                    }
                    else {					 
                        array_push($errors, "Error uploading, Try again!! ");
                    }
                }
                else {
                
                    if( move_uploaded_file($file_tmpname, $filepath)) { 
                       $target_path.=','.$file_name;
                    }
                    else {					
                        array_push($errors, "Error uploading, Try again!! ");
                    }
                }
            }
            else { 
                array_push($errors, "Error uploading, Try again!! "); 
                array_push($errors, "({$file_ext} file type is not allowed)<br / >");
            }
        }
        
    }
    else { 
        //array_push($errors, "No image selected, Please select image ");
        $target_path=$imagesUrls;
    }

   /*  $services_name_query = "select * from services where  services_name='$services_name' limit 1";
    $services_names = mysqli_query($db, $services_name_query);
    $codes = mysqli_fetch_assoc($services_names);
    
    if ($codes) { // if user exists
      
      if ($codes['services_name'] === $services_name) {
        array_push($errors, "Service name already in database");
      }
    } */
    $date = date('Y-m-d H:i:s');

     // echo 'user admin id '.$register_id. ' :: name '. $name;
    

      if (count($errors) == 0) {
           
        $stmt = $db->prepare("UPDATE services set services_name=?,main_category=?,category=?,subcategory=?,duration=?,services_description=?,amount=?,offersOrDiscount=?,services_image=?,date=? where service_id=?");
       $rc= $stmt->bind_param("sssssssssss", $services_name,$main_category_name,$category_name,$subcategory_name,$duration,$services_description, $amount,$offersOrDiscount,$target_path,$date,$service_id);
        $rc=$stmt->execute();
        if($rc==false){
          array_push($errors,"Something went wrong! Service not updated successfully!");
        }else{
          array_push($successMsg,"Service updated successfully!");
          $services_name="";
          $services_description="";
          $amount="";
          $duration="";
        }
       
           
      } 
       else{
        array_push($errors,"Something went wrong! Service not updated successfully!");
       }
      }
      else{
        //echo '<script>(function(){window.location.href ="index.php";})();</script>';
      }
  


        if(isset($_POST['activate_service'])){ 
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update services set status='active' where service_id='$id' ";
          mysqli_query($db, $user_check_query);
        }

        if(isset($_POST['deactivate_service'])){
   
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update services set status='deactive' where service_id='$id' ";
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

         //activate and deactivate customers

         if(isset($_POST['activate_customers'])){ 
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update spa_customers set status='active' where cust_id='$id' ";
          mysqli_query($db, $user_check_query);
        }

        if(isset($_POST['deactivate_customers'])){
   
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update spa_customers set status='deactive' where cust_id='$id' ";
          mysqli_query($db, $user_check_query);
        }
        if(isset($_POST['verify_customers_mobiles'])){
   
          $id = mysqli_real_escape_string($db, $_POST['id']);
          $user_check_query = "update spa_customers set phone_verification_status='Verify' where cust_id='$id' ";
          mysqli_query($db, $user_check_query);
        }
?>