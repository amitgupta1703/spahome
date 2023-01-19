<?php 
include './config.php';
include 'functions.php';
unset($errors); 
$errors = array();  
unset($successMsg); 
$successMsg = array();   
if(isset($_POST['submitContact'])){
    $name=mysqli_real_escape_string($db, $_POST['name']);
    $email =mysqli_real_escape_string($db, $_POST['email']);
    $contact=mysqli_real_escape_string($db, $_POST['contact']);  
    $message = mysqli_real_escape_string($db, $_POST['message']); 
    //echo 's:'.$services.'::n: '.$name.' :e: '.$email.': c: '.$contact.': m: '.$message;

    if (empty($name)) { array_push($errors, "Please enter  name"); } 
    if (empty($email)) { array_push($errors, "Please enter email"); }
    if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
    if (empty($message)) { array_push($errors, "Please enter message"); } 
    if($_POST['g-recaptcha-response']!=""){
      //$secret = '6LcS3OIhAAAAAF_U-TnEYkSyvWTTynIWVJY4USL9';
      $secret='6LecTuMhAAAAAB4iu-G5wZhOXcFS7izLQofgi4h4';
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      $responseData = json_decode($verifyResponse);
      if($responseData->success)
      { 
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');  
        if (count($errors) == 0) {  
            $stmt = $db->prepare("INSERT INTO user_contact(name,email,contact,message,date) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss", $name, $email, $contact,$message,$date);
            $stmt->execute();
            $name="";
            $email="";
            $contact="";
            $message="";
            array_push($successMsg,"Message send successfully we will contact you soon!!");
          }
          else{
            array_push($errors,"Message not send successfully, Please try again!!");
          }
          
      }
    
    }
    else{
      array_push($errors,"Captcha not verified");
    }
}

 if(isset($_POST['submitfranchise'])){
  $name=mysqli_real_escape_string($db, $_POST['name']);
  $email =mysqli_real_escape_string($db, $_POST['email']);
  $contact=mysqli_real_escape_string($db, $_POST['contact']);  
  $message = mysqli_real_escape_string($db, $_POST['message']); 

  $city=mysqli_real_escape_string($db, $_POST['city']);
  $address =mysqli_real_escape_string($db, $_POST['address']);
  $state=mysqli_real_escape_string($db, $_POST['state']); 
  if($state=="-1"){
    array_push($errors, "Please select state");
  } 
  $occupation = mysqli_real_escape_string($db, $_POST['occupation']); 

  $workExperience=mysqli_real_escape_string($db, $_POST['workExperience']);
  $ownerspace =$_POST['ownerspace'];
  //echo "owner ::: ".$ownerspace;
  

  if (empty($name)) { array_push($errors, "Please enter  name"); } 
  if (empty($email)) { array_push($errors, "Please enter email"); }
  if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
  //if (empty($message)) { array_push($errors, "Please enter message"); } 

  if (empty($city)) { array_push($errors, "Please enter city"); } 
  if (empty($address)) { array_push($errors, "Please enter address"); }
  if (empty($state)) { array_push($errors, "Please enter state"); } 
  if (empty($occupation)) { array_push($errors, "Please enter occupation"); } 


  if (empty($workExperience)) { array_push($errors, "Please enter work experience"); } 
  if (empty($ownerspace)) { array_push($errors, "Please enter owner space"); } 

  $user_check_query = "select * from franchise where (contact='$contact' and phone_verification_status='Verify') or (email='$email' and phone_verification_status='Verify')  limit 1"; 
$results = mysqli_query($db, $user_check_query); 
if (mysqli_num_rows($results) >0) { 
    $row = mysqli_fetch_array($results); 
    $contact1=$row[3];
    $email1=$row[2];
   //echo $contact1;
    if($contact1==$contact){
        array_push($errors, "Number already registered");
    }   
    if($email1==$email){
        array_push($errors, "Email already registered");
    }  
}
$otp='';
$n=6;
$otp=generateNumericOTP($n);
$phone_verification_status="Not Verify";

$otp_check_query = "select * from franchise where otp='$otp' limit 1"; 
$otpcheck = mysqli_query($db, $otp_check_query); 
if (mysqli_num_rows($otpcheck) >0) { 
    $row = mysqli_fetch_array($otpcheck); 
    $saveotp=$row['otp'];
    //echo "saveotp: ".$saveotp;
    if($saveotp==$otp){
        $otp=(generateNumericOTP($n));
    }  
    
}
  if($_POST['g-recaptcha-response']!=""){
    //$secret = '6LcS3OIhAAAAAF_U-TnEYkSyvWTTynIWVJY4USL9';
    $secret='6LecTuMhAAAAAB4iu-G5wZhOXcFS7izLQofgi4h4';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success)
    {
      date_default_timezone_set('Asia/Kolkata');
      $date = date('Y-m-d H:i:s');  
      if (count($errors) == 0) {  
          $stmt = $db->prepare("insert into franchise(name,email,contact,address,city,state,occupation,workExperience,ownerSpace,message,date,otp,phone_verification_status) values(?,?,?,?,?,?,?,?,?,?,?,?,?)");
          $rc=$stmt->bind_param("sssssssssssss", $name,$email,$contact,$address,$city,$state,$occupation,$workExperience,$ownerspace,$message,$date,$otp,$phone_verification_status);
          $rc=$stmt->execute(); 
          $id=$stmt->insert_id; 
          if($rc==true){
            
            $_POST=array();
           // $franchise="Message send successfully we will contact you soon!";
           $franchise="franchise";
           sendOtp($otp,$contact);
           $pid="hGME2322x-".$id."-h73232";
            setcookie("f_bpar",$pid,time()+60*60*24*30);
            $_SESSION['name']=$name;

            $urls=$baseurl.'/thank-you/'.$franchise;
            //echo "url::: ".$urls;
           //echo '<script>(function(){window.location.href ="'.$urls.'";})();</script>';
            //array_push($successMsg,"Message send successfully we will contact you soon!!");
            echo "<script> window.location.assign('verify-otp.php?franchise=true&mobile=".$contact."'); </script>";
            $name="";
            $email="";
            $contact="";
            $message="";
          }else{
            array_push($errors,"Message not send successfully, Please try again!!");
             
          }
          
        }
        else{
          array_push($errors,"Message not send successfully, Please try again!!");
          //echo '<script>(function(){window.location.href ="'.$baseurl.'/franchise";})();</script>';
        }
        
    }
  
  }
  else{
    array_push($errors,"Captcha not verified");
  }
}
?>
