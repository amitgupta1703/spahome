<?php  
include './config.php';  
unset($errors); 
$errors = array(); 

unset($successMsg); 
$a= $_POST['submit_otp_becomepartner'];
echo $a;
echo $_POST['otp'];
$successMsg = array(); 
if(isset($_POST['submit_otp_becomepartner'])){
   echo $_POST['submit_otp_becomepartner'];
    //$mob=$_GET['mobile'];
    echo $_POST['otp'];
    //echo $mob;
    $otp=$_POST['otp']; 
    // $otp=(int)$otp;
    /* if(is_numeric($otp)!=1){
        array_push($errors, "Please enter valid otp1");
    } */
    //echo strlen($otp);
    if(strlen($otp)!=6 || is_numeric($otp)!=1){
        array_push($errors, "Please enter valid otp");
    }
      
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s'); 
     
    if (empty($otp)) { array_push($errors, "Please enter otp"); }  
    
    $user_check_query = "select * from spa_customers where otp='$otp' and phone_verification_status='Not Verify' limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $dotp=$row[9];
        if($otp!=$dotp){
            array_push($errors, "Enter Valid OTP");
        }    
    }
   $mob=(string)$mob;
    if (count($errors) == 0) {  
         
        $phone_verification_status="Verify";
        $status='active';
        /* $update_details = "update spa_customers set phone_verification_status='$phone_verification_status',otp=$otp where $cust_username='$mob'";
                 
        $result1 = mysqli_query($db, $update_details);
        if($result1>0){
            echo "<script> window.location.assign('login.php'); </script>";
        }else{
            echo "<script> (function(){alert('not save');})() </script>";
        } */
       $stmt = $db->prepare("update spa_customers set phone_verification_status=?,otp=?,status=? where otp=?");
        $stmt->bind_param("ssss", $phone_verification_status,$otp,$status,$otp); 
      $stmt->execute();    
      echo "<script> window.location.assign('login.php'); </script>"; 
      
      
    }
    }


    if( isset($_POST['submit_otpforBecomePartner']) && isset($_GET['mobile']) && isset($_GET['becomePartner']) && $_GET['becomePartner']==true){
        
        $mob=$_GET['mobile'];
        //echo $mob;
        $otp=mysqli_real_escape_string($db, $_POST['otp']); 
        echo "mob: ".$mob.', otp '.$otp;
        // $otp=(int)$otp;
        if(is_numeric($otp)!=1){
            array_push($errors, "Please enter valid otp1");
        }
        //echo strlen($otp);
        if(strlen($otp)!=6){
            array_push($errors, "Please enter valid otp");
        }
          
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s'); 
         
        if (empty($otp)) { array_push($errors, "Please enter otp"); }  
        
        $user_check_query = "select * from spa_partners where otp='$otp' and phone_verification_status='Not Verify' and contact='$mob' limit 1"; 
        $results = mysqli_query($db, $user_check_query); 
        if (mysqli_num_rows($results) >0) { 
            $row = mysqli_fetch_array($results); 
            $dotp=$row[13];
            if($otp!=$dotp){
                array_push($errors, "Enter Valid OTP");
            }    
        }
       $mob=(string)$mob;
        if (count($errors) == 0) {  
             
            $phone_verification_status="Verify"; 
           $stmt = $db->prepare("update spa_partners set phone_verification_status=? where otp=? and contact=?");
            $rc=$stmt->bind_param("sss", $phone_verification_status,$otp,$mob); 
            $rc=$stmt->execute(); 
          
          
          if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
            array_push($errors, "Error occurs while submitting data, Retry again!");
          }else{
            array_push($successMsg, "Partner register successfully we will contact you soon");
            echo "<script> window.location.assign('become-partner.php'); </script>"; 
          }
 
          
        }
        }
?>