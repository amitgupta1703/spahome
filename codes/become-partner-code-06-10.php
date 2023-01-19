<?php   
include './config.php';
include 'functions.php';
 
unset($errors); 
$errors = array(); 

unset($successMsg); 

$successMsg = array(); 

if(isset($_POST['submitBecomePartner'])){
 
$name=mysqli_real_escape_string($db, $_POST['name']);
$email =mysqli_real_escape_string($db, $_POST['email']);
$contact=mysqli_real_escape_string($db, $_POST['contact']); 
$company_name = mysqli_real_escape_string($db, $_POST['company_name']);  
$services=mysqli_real_escape_string($db, $_POST['services']);  
if($services=="-1"){
    array_push($errors, "Please select services ");
}
$location = mysqli_real_escape_string($db, $_POST['location']); 
$city=mysqli_real_escape_string($db, $_POST['city']); 
$state = mysqli_real_escape_string($db, $_POST['state']);
if($state=="-1"){
    array_push($errors, "Please select state ");
} 
$spaServices='';
$pincode=mysqli_real_escape_string($db, $_POST['pincode']); 
if(isset($_POST['check_list'])){

    foreach($_POST['check_list'] as $checkbox) {
        //echo 's'.$checkbox;
        $spaServices=$spaServices.','.$checkbox;
     }
     $services=$services.$spaServices;
}

//echo 'l:'.$location.'::n: '.$name.' :e: '.$email.': c: '.$contact.': cn: '.$company_name;

if (empty($name)) { array_push($errors, "Please enter  name"); }
if (empty($email)) { array_push($errors, "Please enter email"); }
if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
if (empty($company_name)) { array_push($errors, "Please enter business name"); } 
if (empty($location)) { array_push($errors, "Please enter location"); } 
if (empty($city)) { array_push($errors, "Please enter city"); } 
if (empty($state)) { array_push($errors, "Please enter state"); } 
if (empty($pincode)) { array_push($errors, "Please enter pincode"); } 

if(is_numeric($contact)!=1){
    array_push($errors, "Please enter valid mobile number");
}
if(strlen($contact)!=10){
    array_push($errors, "Please enter valid mobile number");
}

$user_check_query = "select * from spa_partners where (contact='$contact' and phone_verification_status='Verify') or (email='$email' and phone_verification_status='Verify')  limit 1"; 
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
    $phone_verify="Not Verify";

    $otp_check_query = "select * from spa_partners where otp='$otp' limit 1"; 
    $otpcheck = mysqli_query($db, $otp_check_query); 
    if (mysqli_num_rows($otpcheck) >0) { 
        $row = mysqli_fetch_array($otpcheck); 
        $saveotp=$row['otp'];
        //echo "saveotp: ".$saveotp;
        if($saveotp==$otp){
            $otp=(generateNumericOTP($n));
        }  
        
    }

    $date = date('Y-m-d H:i:s');
    $status="rejected";
    $link_partner_admin_id=0; 
    if (count($errors) == 0) {  
        $stmt = $db->prepare("INSERT INTO spa_partners(name,email,contact,company_name,services,location,city,state,pincode,date,status,link_partner_admin_id,otp,phone_verification_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $rc=$stmt->bind_param("ssssssssssssss", $name, $email, $contact,$company_name,$services,$location,$city,$state,$pincode,$date,$status,$link_partner_admin_id,$otp,$phone_verify);
        $rc=$stmt->execute(); 
        $id=$stmt->insert_id; 

       
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
            array_push($errors, "Error occurs while submitting data, Retry again!");
        }else{
           sendOtp($otp,$contact);
           $pid="hGME232312elcSuKgbd64783#2x-".$id."-h73lg365232";
            setcookie("o_bpar",$pid,time()+60*60*24*30);
            $_SESSION['name']=$name;
            $name="";
            $email="";
            //$contact="";
            $company_name="";
            $location="";
            $city="";
            $pincode="";
            
            //array_push($successMsg,"Send successfully we will contact you soon!!");
            echo "<script> window.location.assign('verify-otp.php?becomePartner=true&mobile=".$contact."'); </script>";
            $contact="";
        }     
    }
}
?>