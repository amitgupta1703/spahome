<?php 
include './config.php'; 
include 'functions.php';
unset($errors); 
$errors = array();  
unset($successMsg); 
$successMsg = array();   
if(isset($_POST['resendOtps'])){
    if(!isset($_COOKIE['ouy3_37dfuu'])){
        echo "<script> window.location.assign('registration'); </script>";
    }
      
    $otpSend; 
    $mobileNo=mysqli_real_escape_string($db, $_POST['mobileNo']);
    $oldOTP; 
    $cIds='';
    $otp='';
    $id;

    $n = 6; 
    $otp=(generateNumericOTP($n));
    /* $oldOTP=$_COOKIE['ouy3_37dfuu']; 
    $oldOTP=explode("-",$oldOTP)[1]; */
    $getIds='';
    $getIds=$_COOKIE['ouy3_37dfuu']; 
    $cIds=explode("-",$getIds)[1];
    //echo "otp ::: ".$otp." :::: ";
    //echo $_COOKIE["ouy3_37dfuu"];
   
    // echo "cid::: ".$cIds." :::::: ".$_COOKIE['ouy3_37dfuu'];
    // echo ":::cid::: ".explode("-",$getIds)[1];
    $status='Not Verify'; 
    $stmt = $db->prepare("update spa_customers set otp=? where cust_contact=? and cust_id=? and phone_verification_status=?");
    $rc=$stmt->bind_param("ssss", $otp,$mobileNo,$cIds,$status); 
    $rc=$stmt->execute();
    // $id=$stmt->insert_id;
    if($rc==true){
        //sendOtp($otp,$mobileNo);

        // echo "<br>new otp::: ".$otp." ::::old ::: ".$oldOTP;
        /*  $otpSet1="hGME232312elc%SuK-".$otp."-#gbd64783#2%xh73lg365232";
        setcookie("ouy3_37dfuu",$otpSet1,time()+60*60*24*30); */

        //$setId1="hGME232312elcSuK-".$cIds."-gbd64783#2xh73lg365232";
        $setId1="hGME232312elcSuK-".$cIds."-gbd64783#2xh73lg365232";
        setcookie("ouy3_37dfuu",$setId1,time()+60*60*24*30);
        array_push($successMsg,"Otp resend successfully"); 
        //$otpSend="true";
        sendOtp($otp,$mobileNo);

    }else{
    array_push($errors,"Otp not resend successfully");
    //$otpSend="false";
    }   
    // $data=array("value"=>$otpSend);

    //echo json_encode($data);
    
    }


    if(isset($_POST['becomePartnerresendOtps'])){
        if(!isset($_COOKIE['o_bpar'])){
            echo "<script> window.location.assign('become-partner'); </script>";
        }
          
        $otpSend; 
        $mobileNo=mysqli_real_escape_string($db, $_POST['partnermobileNo']);
        $oldOTP; 
        $pIds='';
        $otp='';
        $id;
    
        $n = 6; 
        $otp=(generateNumericOTP($n)); 
        $getIds='';
        $getIds=$_COOKIE['o_bpar']; 
        $pIds=explode("-",$getIds)[1]; 
        $status='Not Verify'; 
        $stmt = $db->prepare("update spa_partners set otp=? where partner_id=? and phone_verification_status=?");
        $rc=$stmt->bind_param("sss", $otp,$pIds,$status); 
        $rc=$stmt->execute(); 
        if($rc==true){ 
            $setpid="hGME232312elcSuKgbd64783#2x-".$pIds."-h73lg365232";
            setcookie("o_bpar",$setpid,time()+60*60*24*30);
            array_push($successMsg,"Otp resend successfully");  
            sendOtp($otp,$mobileNo);
    
        }else{
        array_push($errors,"Otp not resend successfully"); 
        }    
        
        }

if(isset($_POST['register'])){

 
$n = 6;
$otp='';
$otp=(generateNumericOTP($n)); 

$date;
$name=mysqli_real_escape_string($db, $_POST['name']);
$email =mysqli_real_escape_string($db, $_POST['email']);
$contact=mysqli_real_escape_string($db, $_POST['contact']);  
$password = mysqli_real_escape_string($db, $_POST['password']); 
$confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']); 
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s'); 
if($password!=$confirmpassword){
    array_push($errors, "Password and confirm password not matched");
}
//echo 's:'.$services.'::n: '.$name.' :e: '.$email.': c: '.$contact.': m: '.$message;

if (empty($name)) { array_push($errors, "Please enter  name"); } 
if (empty($email)) { array_push($errors, "Please enter email"); }
if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
if (empty($password)) { array_push($errors, "Please enter password"); } 

if(is_numeric($contact)!=1){
    array_push($errors, "Please enter valid mobile number");
}
if(strlen($contact)!=10){
    array_push($errors, "Please enter valid mobile number");
}

$user_check_query = "select * from spa_customers where cust_username='$contact' and phone_verification_status='Verify' limit 1"; 
$results = mysqli_query($db, $user_check_query); 
if (mysqli_num_rows($results) >0) { 
    $row = mysqli_fetch_array($results); 
    $uname=$row[6];
    if($uname==$contact){
        array_push($errors, "Number already registered");
    }    
}

$otp_check_query = "select * from spa_customers where otp='$otp' limit 1"; 
$otpcheck = mysqli_query($db, $otp_check_query); 
if (mysqli_num_rows($otpcheck) >0) { 
    $row = mysqli_fetch_array($otpcheck); 
    $saveotp=$row['otp'];
    //echo "saveotp: ".$saveotp;
    if($saveotp==$otp){
        $otp=(generateNumericOTP($n));
    }  
    
    /* while($saveotp==$otp){
       $otp= getOtp($opt);
    } */
}

 $status='deactive';
 $orderid=0;
 $serviceid=0;
$phone_verify="Not Verify";
$roles="customer";
//echo "otp :::: ".$otp;
if (count($errors) == 0) { 

   $stmt = $db->prepare("INSERT INTO spa_customers(cust_name,cust_email,cust_contact,orderid,serviceid,cust_username,cust_password,phone_verification_status,otp,date,status,roles,login_time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
   $stmt->bind_param("sssssssssssss", $name, $email, $contact, $orderid, $serviceid, $contact, $password, $phone_verify,$otp,$date,$status,$roles,$date); 
  $stmt->execute();
  
  sendOtp($otp,$contact);
  $id=$stmt->insert_id;
  //echo "inserted id :: ".$id;
  /* $otpSet="hGME232312elc%SuK-".$otp."-#gbd64783#2%xh73lg365232";
setcookie("ouy3_37dfuu",$otpSet,time()+60*60*24*30); */

$cid="hGME232312elcSuK-".$id."-gbd64783#2xh73lg365232";
setcookie("ouy3_37dfuu",$cid,time()+60*60*24*30);

   $name="";
   $email=""; 
   $message="";
   
  echo "<script> window.location.assign('verify-otp.php?mobile=".$contact."'); </script>";
   //array_push($successMsg,"Message send successfully we will contact you soon!!");
   $contact=""; 
}


}


//login code ////////////////////////////////////////////////////

if(isset($_POST['login'])){

 $service_id='';

 if(isset($_SESSION['service_id']) && $_SESSION['service_id']!=''){
     $service_id=$_SESSION['service_id'];
 }
$username=mysqli_real_escape_string($db, $_POST['username']);  
$password = mysqli_real_escape_string($db, $_POST['password']);  

//echo $username.','.$password;

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s'); 
  

if (empty($username)) { array_push($errors, "Please enter registered number"); }  
if (empty($password)) { array_push($errors, "Please enter password"); } 

 

if (count($errors) == 0) {  
    $user_check_query = "select * from spa_customers where cust_username='$username' and cust_password='$password' and phone_verification_status='Verify' and roles='customer' and status='active' limit 1"; 
    $results = mysqli_query($db, $user_check_query); 

    $services_name='';
    $amount='';
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $_SESSION['username']=$row[6];
        $_SESSION['cust_id']=$row[0];
        $_SESSION['name']=$row[1];  
        $u_name=$row[6];
        $session_ids=$session_ids;

        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0; 
        $encryption_iv = '1234567891011121'; 
        $encryption_key = "cust_un"; 
        $encryption_un = openssl_encrypt($row[6], $ciphering, $encryption_key, $options, $encryption_iv); 

        $encryption_key1 = "cust_uid"; 
        $encryption_uid = openssl_encrypt($row[0], $ciphering, $encryption_key1, $options, $encryption_iv); 

       /*  $encryption_name = "cust_uname"; 
        $encryption_uname = openssl_encrypt($row[1], $ciphering, $encryption_name, $options, $encryption_iv);  */

        setcookie('un_c',$encryption_un,time()+60*60*24*30);
        setcookie('un_ic',$encryption_uid,time()+60*60*24*30);
       // setcookie('un_na',$encryption_uname,time()+60*60*24*30);
       // echo 'session:i login: ',$session_ids;
       // print_r($_SESSION["cartItems"]);
        if(isset($_SESSION["cartItems"])){
            //print_r($_SESSION["cartItems"]);
            foreach($_SESSION["cartItems"] as $value){
               // echo '$value::'.$value;
                //$cart_Query = mysqli_query($db,"update cart set user_id='$u_name' WHERE cart_id=$value and session_id=$session_ids");
                //$results12 = mysqli_query($db, $cart_Query); 
                $stmt = $db->prepare("update cart set user_id=? WHERE cart_id=? and session_id=?");
                $stmt->bind_param("sss",$u_name,$value['cart_id'],$session_ids ); 
              $stmt->execute();
              $result = $stmt->get_result();
              
            }
          }
          //unset($_SESSION["cartItems"]);
                //header("location: index.php");
        //echo '<script>(function(){window.location.href="'+$baseurl+'"})()</script>';
       /*  $user_check_query = "select * from partners_services where service_id='$service_id' and status='active' limit 1"; 
        $results = mysqli_query($db, $user_check_query); 
        if (mysqli_num_rows($results) >0) { 
            $row = mysqli_fetch_array($results); 
            $services_name=$row[1];
            $amount=$row[4];
        } */
        
      //echo "ancnncnnc: " .$services_name.', '.$amount;
        if(isset($_SESSION['ischeckout']) && $_SESSION['ischeckout']!=''){
            //$amount=$_SESSION['amount'];
            $url= "book-appointment.php?service_id=1";
            //echo $url."<br>".$service_id;
            unset($_SESSION['ischeckout']);
           // echo "<br>".$_SESSION['service_id'];
          // $_SESSION['ischeckout']
           echo "<script> window.location.href='".$url."';</script>";
        }else{
            //echo "<script> window.location.assign('{$baseurl}'); </script>";
        }
       

    }else{
        array_push($errors, "Invalid username or password");
    }
  
   
 //array_push($successMsg,"Message send successfully we will contact you soon!!");
      
}
}


if(isset($_POST['addnewaddress']) && isset($_SESSION['username']) && $_SESSION['username']!=''){
$username=$_SESSION['username'];
$cust_id=$_SESSION['cust_id'];
$date;
$name=mysqli_real_escape_string($db, $_POST['name']);
$address1 =mysqli_real_escape_string($db, $_POST['address1']);
$mobilenumber=mysqli_real_escape_string($db, $_POST['mobilenumber']);  
$locality = mysqli_real_escape_string($db, $_POST['locality']); 
$city = mysqli_real_escape_string($db, $_POST['city']); 

$pincode = mysqli_real_escape_string($db, $_POST['pincode']); 
$landmark = mysqli_real_escape_string($db, $_POST['landmark']); 
$state = mysqli_real_escape_string($db, $_POST['state']); 
$altenateNumber = mysqli_real_escape_string($db, $_POST['altenateNumber']); 

if($state=='-1'){
    array_push($errors, "Please select state");
}
 

/* function validate_number($phone_number){
    if(preg_match('/^[0-9]{10}+$/', $phone_number)) {
        // the format /^[0-9]{11}+$/ will check for phone number with 11 digits and only numbers
        echo "Phone Number is Valid <br>";
    }   else{
        array_push($errors, "Please enter valid mobile number");
        }
    } */
if(is_numeric($mobilenumber)!=1){
    array_push($errors, "Please enter valid mobile number");
}
if(strlen($mobilenumber)!=10){
    array_push($errors, "Please enter valid mobile number");
}
if(is_numeric($pincode)!=1){
    array_push($errors, "Please enter valid pincode");
}
if(strlen($pincode)!=6){
    array_push($errors, "Please enter valid pincode");
}
//validate_number($mobilenumber);
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s'); 

if (empty($name)) { array_push($errors, "Please enter  name"); } 
if (empty($address1)) { array_push($errors, "Please enter address"); }
if (empty($mobilenumber)) { array_push($errors, "Please enter mobile number"); } 
if (empty($locality)) { array_push($errors, "Please enter locality"); } 

if (empty($city)) { array_push($errors, "Please enter  city"); } 
if (empty($pincode)) { array_push($errors, "Please enter pincode"); }
if (empty($state)) { array_push($errors, "Please select state"); }  
 
 $country='India'; 
 $uId=$username;

 //echo 'hdfhd: '.$name.', '.$address1.', '.$locality.','.$landmark.', '.$city.', '.$mobilenumber.', '.$altenateNumber.', '. $pincode.', '.$state.', '.$country.', '.$date.', '.$cust_id.', '.$uId.'<br>askkjksdajk<br>';

if (count($errors) == 0) { 

   $stmt = $db->prepare("INSERT INTO cust_address(name,addressline1,addressline2,landmark,city,contactnumber,alternatenumber,pincode,state,country,date,cust_id,cust_username) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssis", $name, $address1, $locality, $landmark, $city, $mobilenumber, $altenateNumber, $pincode,$state,$country,$date,$cust_id,$uId); 
  $stmt->execute();
  $result = $stmt->get_result();
  //echo 'abc: '.$result;
   /* $name="";
   $address1="";
   $mobilenumber="";
   $address2=""; */
   //array_push($successMsg,"Message send successfully we will contact you soon!!");
      
}
}

function getOtp($otp){
    $gOtp;
    $otp_check_query = "select * from spa_customers where otp='$otp' and phone_verification_status='Not Verify' limit 1"; 
    $otpcheck = mysqli_query($db, $otp_check_query); 
    if (mysqli_num_rows($otpcheck) >0) { 
        $row = mysqli_fetch_array($otpcheck); 
        $saveotp=$row['otp'];
        //echo "saveotp: ".$saveotp;
        if($saveotp==$otp){
            $gOtp=(generateNumericOTP($n));
        }  
        
    }
    return $gOtp;
}

/* function sendOtp($otp,$mobilenumber){
    $key = "0665563232716606766f";	
    $mbl="91{$mobilenumber}";
    $message_content=urlencode("Your OTP for Account Verification is: {$otp} Please do not share this OTP with anyone. Best Wishes Spahomeservice.in");
    $senderid="SMSNCR";	
    $route= 3;
    $templateid="1207165458221179539";  
    $url = "http://sms.smsinsta.com/vb/apikey.php?apikey=$key&senderid=$senderid&templateid=$templateid&route=$route&number=$mbl&message=$message_content"; 
    $output = file_get_contents($url);
    echo $output;
} */
$partner_name=''; 
    $partner_email=''; 
    $partner_contact='';
    $partner_company_name='';
    $paddress='';
function getPartners($p_id){
    $db = mysqli_connect('127.0.0.1:3306', 'root', 'shiv', 'spa2');
    
    $getPartner="select * from spa_partners where partner_id='$p_id' limit 1"; 
    $results = mysqli_query($db, $getPartner); 
    $data = mysqli_fetch_assoc($results);
    if($data){
        $partner_name=$data['name'];
        $partner_email=$data['email'];
        $partner_contact=$data['contact'];
        $partner_company_name=$data['company_name'];
        $paddress= $data['location'].', '.$data['city'].', '.$data['state'].'-'.$data['pincode'];
       //echo $paddress;
    }
}

/* if(isset($_POST['mobileNo'])){
    $n = 6;
    $otp='';
    $otp=(generateNumericOTP($n));

    $mobileNo=$_POST['mobileNo'];
    $oldOTP='';
   // echo "old otp::: ".$oldOTP;
    $oldOTP=explode("-",$_COOKIE['ouy3_37dfuu'])[1];
   // echo "::: old otp 3333::: ".$oldOTP;
    $status='Not Verify';
    //$otp_check_query1 = "update spa_customers set otp=$otp where cust_contact=$mobileNo and  otp='$oldOTP' and phone_verification_status='Not Verify'"; 
   // $otpcheck = mysqli_query($db, $otp_check_query1); 
    $stmt = $db->prepare("update spa_customers set otp=? where cust_contact=? and otp=? and phone_verification_status=?");
    $rc=$stmt->bind_param("ssss", $otp,$mobileNo,$oldOTP,$status); 
    $rc=$stmt->execute();

    if($rc==true){
        array_push($successMsg,"Otp resend successfully");
        unset($_COOKIE["ouy3_37dfuu"]);
        setcookie("ouy3_37dfuu","",time()-60*60);

    }else{
        array_push($errors,"Otp not resend successfully");
    }

   
      

} */

?>
