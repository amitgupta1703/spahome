 
<?php 
include './config.php'; 
include 'codes/functions.php';
unset($errors); 
$errors = array();  
unset($successMsg);  
$successMsg = array(); 

 
$contact = $_POST['mobileNumber']; 
 
//sendOtp($otp,$mobilenumber);
$user_check_query = "select * from spa_partners where contact='$contact' limit 1"; 
$results = mysqli_query($db, $user_check_query); 
if (mysqli_num_rows($results) >0) { 
    $row = mysqli_fetch_array($results); 
    $uname=$row[6];
    if($uname==$contact){
        array_push($errors, "Number already registered");
    }    
}
    $otp='';
    $n=6;
    $otp=generateNumericOTP($n);
    $phone_verify="Not Verify";

    $otp_check_query = "select * from spa_customers where otp='$otp' limit 1"; 
    echo "$otp :::: ";
    $otpcheck = mysqli_query($db, $otp_check_query); 
    if (mysqli_num_rows($otpcheck) >0) { 
        $row = mysqli_fetch_array($otpcheck); 
        $saveotp=$row['otp'];
        echo "saveotp: ".$saveotp;
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
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
            array_push($errors, "Error occurs while submitting data, Retry again!");
        }else{
           // sendOtp($otp,$contact);
            $name="";
            $email="";
            //$contact="";
            $company_name="";
            $location="";
            $city="";
            $pincode="";
            echo "abjjdshjshf";
            //array_push($successMsg,"Send successfully we will contact you soon!!");
            echo "<script> window.location.assign('verify-otp.php?becomePartner=true&mobile=".$contact."'); </script>";
            $contact="";
        }     
    }
?>
