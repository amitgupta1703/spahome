<?php
   // initializing variables
$name = "";
$email    = "";
unset($errors); 
$errors = array(); 

// connect to the database 
 include 'dbwe.php';
      // Upload resume
      if (isset($_POST['admin_post_job']) && isset($_SESSION['U_Name_career']) && $_SESSION['U_Name_career']!="") {

        $company_name = mysqli_real_escape_string($db, $_POST['company_name']);
        $applyOnMainWebsite=mysqli_real_escape_string($db, $_POST['applyOnMainWebsite']);
        $job_title = mysqli_real_escape_string($db, $_POST['job_title']);
        $job_title_other = mysqli_real_escape_string($db, $_POST['job_title_other']);
        if($job_title == '-1' ){ 
          array_push($errors, "Please select category type");  
        } 
        else{
          if($job_title=='Other'){
            if($job_title_other==''){
              array_push($errors, "Please select category type");
            }
            $job_title='Other,'.$job_title_other;
            
          }
          
        }
        $job_type = mysqli_real_escape_string($db, $_POST['job_type']); 
        if($job_type == '-1'){
          array_push($errors, "Please select job type");
       }
        $job_category = mysqli_real_escape_string($db, $_POST['job_category']); 
      if($job_category == '-1'){
        array_push($errors, "Please select category type");
      } 

      $country = mysqli_real_escape_string($db, $_POST['country']); 
      if($country == '-1'){
       array_push($errors, "Please select country");
     } 
     
     $experience = mysqli_real_escape_string($db, $_POST['experience']); 
     if($experience == '-1'){
      array_push($errors, "Please select experience");
     } 

     $salary = mysqli_real_escape_string($db, $_POST['salary']);
     if($salary == '-1'){
       array_push($errors, "Please select salary");
      }
      
      $location='';
      $equity='';
      
      if(isset($_POST['location'])){
        $location = $_POST['location']; 
      }
      
      if(isset($_POST['equity'])){
        $equity = $_POST['equity']; 
      }
      
        
        $description = mysqli_real_escape_string($db, $_POST['description']);
      
        $skills = mysqli_real_escape_string($db, $_POST['skills']); 
        $salary = mysqli_real_escape_string($db, $_POST['salary']);
        //$equity =  $_POST['equity'];
        $status='Active';
        $employeer_status='Active';
      
        if (empty($company_name)) { array_push($errors, "Please enter company name"); }
        if (empty($job_title)) { array_push($errors, "Please enter job title"); }
      
        if (empty($location)) { array_push($errors, "Please select location"); }
        if (empty($description)) { array_push($errors, "Please enter job description"); }
      
       // if (empty($skills)) { array_push($errors, "Please enter skills"); }
        if (empty($salary)) { array_push($errors, "Please enter salary"); }
      
        //if (empty($equity)) { array_push($errors, "Please select equity"); } 
      
        
      
        
      
      
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
      
          $queryGetCount="select count(*) as total from crj_job_post";
          $result = mysqli_query($db, $queryGetCount);
          $allRecord=mysqli_fetch_assoc($result);
          $totalRecord;
          
          if($allRecord>0)
          {
              $totalRecord=$allRecord['total'];
              $totalRecord=$totalRecord+1;
          }
      
          $target_path = "company-logos/";
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
      
               
         
            
           /*  else
            {
            //die('Please provide another file type [E/3].');
            array_push($errors, "Please provide another file type");
            } */
      
            $register_id=$_SESSION['admin_UserId'];
      
            $name=$_SESSION['U_Name_career'];
           $register_email;
      
           // echo 'user admin id '.$register_id. ' :: name '. $name;
      
            if (count($errors) == 0) {
                // $password = md5($password);
                 $query = "select * from admin_login where admin_id=$register_id";
                 $results = mysqli_query($db, $query);
               
                 
                 if (mysqli_num_rows($results) == 1) {
                  
                   while($row = mysqli_fetch_row($results)){
                    // $register_id = $row[0];
                    // $name = $row[1];
                     $register_email =$row[3]; 
                   } 
                  
                 }
                 //array_push($errors, '$company_name');
                 $queryInsert= "insert into crj_job_post(company_name,job_title,company_logo_path,job_type,job_category,location,country,description,skills,experience,salary,applyOnMainWebsite,equity,dates,register_id,register_email,status,job_option,employeer_status) values('$company_name','$job_title','$target_path','$job_type','$job_category','$location','$country','$description','$skills','$experience','$salary','$applyOnMainWebsite','$equity',Now(),'$register_id','$register_email','$status','posted','$employeer_status')";
                 $result1 = mysqli_query($db, $queryInsert); 
                if($result1){
                  echo '<script>(function(){alert("Job Posted successfully");window.location.href ="all-posted-jobs.php";})();</script>';
                  //include '../errors.php';
                }
                else{
                  echo '<script>(function(){alert("Job not Posted successfully");window.location.href ="post-new-job.php";})();</script>';
                  //include '../errors.php';
                }
              
                   
                 
             }
             else{
      
      
             // include 'errors.php';
      
                echo '<script>(function(){alert("Error in uploading file");})();</script>';
               // echo $id.'ansdbansbnfbasf'.$name;
             }
      
      
      }

      if(isset($_POST['update_Jobs']) && isset($_GET["job_id"]) && $_GET["job_id"]!=""){

        $job_id=$_GET["job_id"];

        $company_name = mysqli_real_escape_string($db, $_POST['company_name']);
        $applyOnMainWebsite=mysqli_real_escape_string($db, $_POST['applyOnMainWebsite']);
        
        $job_title = mysqli_real_escape_string($db, $_POST['job_title']);
        $job_title_other = mysqli_real_escape_string($db, $_POST['job_title_other']);
        if($job_title == '-1' ){ 
          array_push($errors, "Please select category type");  
        } 
        else{
          if($job_title=='Other'){
            if($job_title_other==''){
              array_push($errors, "Please select category type");
            }
            $job_title='Other,'.$job_title_other;
            
          }
          
        }
        
        $job_type = mysqli_real_escape_string($db, $_POST['job_type']); 
        if($job_type == '-1'){
          array_push($errors, "Please select job type");
       }
        $job_category = mysqli_real_escape_string($db, $_POST['job_category']); 
      if($job_category == '-1'){
        array_push($errors, "Please select category type");
      } 

      $salary = mysqli_real_escape_string($db, $_POST['salary']);
        if($salary == '-1'){
          array_push($errors, "Please select salary");
         }
      
      $location='';
      $equity='';
      
      if(isset($_POST['location'])){
        $location = $_POST['location']; 
      }
      
      if(isset($_POST['equity'])){
        $equity = $_POST['equity']; 
      }

      if(isset($_POST['status'])){
        $status = $_POST['status']; 
      }
      $country='';
      if(isset($_POST['country'])){
        $country = $_POST['country']; 
      if($country == '-1'){
       array_push($errors, "Please select country");
     } 
      }
      
      
        
        $description = mysqli_real_escape_string($db, $_POST['description']); 
        $skills = mysqli_real_escape_string($db, $_POST['skills']); 
       // $salary = mysqli_real_escape_string($db, $_POST['salary']);
        //$equity =  $_POST['equity'];
       // $status='Inactive';
        if (empty($status)) { array_push($errors, "Please seletct status"); }
        if (empty($company_name)) { array_push($errors, "Please enter company name"); }
        if (empty($job_title)) { array_push($errors, "Please enter job title"); }
      
        if (empty($location)) { array_push($errors, "Please select location"); }
        if (empty($description)) { array_push($errors, "Please enter job description"); }
      
       // if (empty($skills)) { array_push($errors, "Please enter skills"); }
        if (empty($salary)) { array_push($errors, "Please enter salary"); }
      
        //if (empty($equity)) { array_push($errors, "Please select equity"); } 
      
        
        $experience = mysqli_real_escape_string($db, $_POST['experience']); 
        if($experience == '-1'){
         array_push($errors, "Please select experience");
        } 
   
        
        
      
      
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
      
          $queryGetCount="select count(*) as total from crj_job_post";
          $result = mysqli_query($db, $queryGetCount);
          $allRecord=mysqli_fetch_assoc($result);
          $totalRecord;
          
          if($allRecord>0)
          {
              $totalRecord=$allRecord['total'];
              $totalRecord=$totalRecord+1;
          }
      
          $target_path = "company-logos/";
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
      
               
         
            
           /*  else
            {
            //die('Please provide another file type [E/3].');
            array_push($errors, "Please provide another file type");
            } */
      
            $register_id=$_SESSION['admin_UserId'];
      
            $name=$_SESSION['U_Name_career'];
           $register_email;
      
           // echo 'user admin id '.$register_id. ' :: name '. $name;
      
            if (count($errors) == 0) {
                // $password = md5($password);
               
                 //array_push($errors, '$company_name');
                 $update_details = "update crj_job_post set
                 company_name='$company_name',
                 job_title='$job_title',company_logo_path='$target_path',
                 job_type='$job_type',job_category='$job_category',location='$location',country='$country',description='$description',
                 skills='$skills',experience='$experience',salary='$salary',applyOnMainWebsite='$applyOnMainWebsite',status='$status'
                 where job_id='$job_id'";
                 
                 $result1 = mysqli_query($db, $update_details); 
                if($result1>0){
                  echo '<script>(function(){alert("Job updated successfully");window.location.href ="all-posted-jobs.php";})();</script>';
                  //include '../errors.php';
                }
                else{
                  echo '<script>(function(){alert("Job not updated successfully");window.location.href ="edit-jobs.php?job_id='.$job_id.'";})();</script>';
                  //include '../errors.php';
                }
              
                   
                 
             }
             else{
      
      
             // include 'errors.php';
      
                echo '<script>(function(){alert("Error in uploading file");})();</script>';
               // echo $id.'ansdbansbnfbasf'.$name;
             }

      }

      if(isset($_POST['activate_job']) && isset($_SESSION['U_Name_career'])){
        $job_id = mysqli_real_escape_string($db, $_POST['job_id']);
        $user_check_query = "update crj_job_post set status='Active' ,employeer_status='Active' where job_id='$job_id' ";
        mysqli_query($db, $user_check_query);
      }

      if(isset($_POST['deactivate_job']) && isset($_SESSION['U_Name_career'])){
        $job_id = mysqli_real_escape_string($db, $_POST['job_id']);
        $user_check_query = "update crj_job_post set status='Inactive',employeer_status='Inactive' where job_id='$job_id' ";
        mysqli_query($db, $user_check_query);
      }

?>