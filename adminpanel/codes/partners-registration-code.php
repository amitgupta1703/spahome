<?php   
include 'dbwe.php';
 
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg = array(); 

if(isset($_POST['partners_registration'])){
 
$name=mysqli_real_escape_string($db, $_POST['name']);
$email =mysqli_real_escape_string($db, $_POST['email']);
$contact=mysqli_real_escape_string($db, $_POST['contact']); 
$company_name = mysqli_real_escape_string($db, $_POST['company_name']);  
$location = mysqli_real_escape_string($db, $_POST['location']); 
//$city=mysqli_real_escape_string($db, $_POST['cities']); 
$city='';
//echo 'lebn'.strlen($_POST['check_list']);
if(isset($_POST['cities']) ){ 
    foreach($_POST['cities'] as $checkbox) {
        //echo 's'.$checkbox;
        $city=$city.','.$checkbox;
     }
     $city=$city;
} else{
    array_push($errors, "Please select locations");
}
$state = mysqli_real_escape_string($db, $_POST['state']);
if($state=="-1"){
    array_push($errors, "Please select state ");
} 
$spaServices='';
$pincode=mysqli_real_escape_string($db, $_POST['pincode']); 
$partners_username = mysqli_real_escape_string($db, $_POST['admin_username']);
$partners_password = mysqli_real_escape_string($db, $_POST['password']);  
$status = mysqli_real_escape_string($db, $_POST['status']); 
if($status=="-1"){
    array_push($errors, "Please select status");
}
$roles = mysqli_real_escape_string($db, $_POST['roles']); 
if($roles=="-1"){
    array_push($errors, "Please select roles");
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

$date = date('Y-m-d H:i:s');
//$status="active"; 
$partners_username=strtolower($partners_username);
$user_check_query = "select * from partners_registration where partners_username='$partners_username' or email='$email' or contact='$contact' limit 1";
$result = mysqli_query($db, $user_check_query);
$codes = mysqli_fetch_assoc($result);
$leads=0;
$previous_leads=0;
$shopStatus='open';

if ($codes) { // if user exists
  
  if ($partners_username === strtolower($codes['partners_username'])) {
    array_push($errors, "Username already in database");
  }
  if ($codes['email'] === $email) {
    array_push($errors, "Email already in database");
  }
  if ($codes['contact'] === $contact) {
    array_push($errors, "Contact already in database");
  }
}

if (count($errors) == 0) { 

    $stmt = $db->prepare("INSERT INTO partners_registration(name,email,contact,company_name,location,city,state,pincode,partners_username,partners_password,roles,date,status,shopStatus,leads,previous_leads) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssssss", $name, $email, $contact,$company_name,$location,$city,$state,$pincode,$partners_username,$partners_password,$roles,$date,$status,$shopStatus,$leads,$previous_leads);
   $stmt->execute();
   $name="";
   $email="";
   $contact="";
   $company_name="";
   $location="";
   $city="";
   $pincode="";
 array_push($successMsg,"Send successfully we will contact you soon!!");
      
}
}

if(isset($_POST['update_partners_registration'])){
 
    $partners_id=mysqli_real_escape_string($db, $_POST['partners_id']);
    $name=mysqli_real_escape_string($db, $_POST['name']);
    $email =mysqli_real_escape_string($db, $_POST['email']);
    $contact=mysqli_real_escape_string($db, $_POST['contact']); 
    $company_name = mysqli_real_escape_string($db, $_POST['company_name']);  
    $location = mysqli_real_escape_string($db, $_POST['location']); 
    //$city=mysqli_real_escape_string($db, $_POST['city']); 
    $city='';
    //echo 'lebn'.strlen($_POST['check_list']);
    if(isset($_POST['cities']) ){ 
        foreach($_POST['cities'] as $checkbox) {
            //echo 's'.$checkbox;
            $city=$city.','.$checkbox;
        }
        $city=$city;
    } else{
        array_push($errors, "Please select cities");
    }
    $state = mysqli_real_escape_string($db, $_POST['state']);
    if($state=="-1"){
        array_push($errors, "Please select state ");
    } 
    $spaServices='';
    $pincode=mysqli_real_escape_string($db, $_POST['pincode']);  
    $partners_password = mysqli_real_escape_string($db, $_POST['password']);  
    $status = mysqli_real_escape_string($db, $_POST['status']); 
    if($status=="-1"){
        array_push($errors, "Please select status");
    }
    $roles = mysqli_real_escape_string($db, $_POST['roles']); 
    if($roles=="-1"){
        array_push($errors, "Please select roles");
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
    
    $date = date('Y-m-d H:i:s');
    //$status="active"; 
    
    
    if (count($errors) == 0) { 
    
        $stmt = $db->prepare("Update partners_registration set name=?,email=?,contact=?,company_name=?,location=?,city=?,state=?,pincode=?,partners_password=?,roles=? where partners_id=?");
        $stmt->bind_param("sssssssssss", $name, $email, $contact,$company_name,$location,$city,$state,$pincode,$partners_password,$roles,$partners_id);
       $stmt->execute();
       
     array_push($successMsg,"Update successfully!!");
          
    }
    } 

    if(isset($_POST['payment_transfer'])){
 
        $payment_type=mysqli_real_escape_string($db, $_POST['payment_Type']);
        $upi_or_account =mysqli_real_escape_string($db, $_POST['upiAccount']);
        $transaction_id=mysqli_real_escape_string($db, $_POST['t_id']); 
        $amount = mysqli_real_escape_string($db, $_POST['amount']);  
        $partners_id = mysqli_real_escape_string($db, $_POST['partners_id']);

        if($payment_type=="-1"){
            array_push($errors, "Please select payment type ");
        } 
        
          
        if (empty($upi_or_account)) { array_push($errors, "Please enter UPI or Account number"); } 
        if (empty($transaction_id)) { array_push($errors, "Please enter transaction id"); } 
        if (empty($amount)) { array_push($errors, "Please enter amount"); } 
       
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        
         
        if (count($errors) == 0) { 
        
            $stmt = $db->prepare("INSERT INTO spa_partners_payment_history(payment_type,upi_or_account,transaction_id,amount,date,partner_id) VALUES(?,?,?,?,?,?)");
            $rc=$stmt->bind_param("ssssss", $payment_type, $upi_or_account, $transaction_id,$amount,$date,$partners_id);
           $rc=$stmt->execute();

           if($rc==true){
            $payment_type="";
            $upi_or_account="";
            $transaction_id="";
            $amount="";
           
            array_push($successMsg,"Payment transfer successfully!!");
            echo "<script> location.href='edit-registered-partners.php?partners_id={$partners_id}'; </script>";
           }else{
            array_push($successMsg,"Payment not transfer successfully. Something went wrong try again!!"); 
           }
           
              
        }
        }
        
        if(isset($_POST['add_leads']) && isset($_SESSION['spa_userName'])){ 

     
    $leads_qty = mysqli_real_escape_string($db, $_POST['leads_qty']); 
    $partners_id = mysqli_real_escape_string($db, $_POST['partners_id']);
   
    $query="select * from partners_registration where partners_id = '$partners_id'  limit 1";
    $result = mysqli_query($db, $query);
   if (mysqli_num_rows($result) == 1) {
     while ($row = mysqli_fetch_array($result)) { 
       $partners_id=$row['partners_id'];
       
       $leads= $row['leads']; 
       $previous_leads=$row['previous_leads'];
  
     }
    }


    if(empty($leads_qty)){array_push($errors, "Please enter leads quantity");}
  
    if(!is_numeric($leads_qty)){array_push($errors, "Please enter valid number of leads");}
    $leads=$leads+$leads_qty;
    if(count($errors)==0){ 
      $stmt = $db->prepare("Update partners_registration set leads=? where partners_id=?");
          $rc=$stmt->bind_param("ss", $leads,$partners_id);
         $rc=$stmt->execute();
         if($rc==true){ 
          $_POST=array();  
          array_push($successMsg, "Leads added successfully1!");
          echo "<script> location.href='edit-registered-partners.php?partners_id={$partners_id}'; </script>";
         }else{
          array_push($errors, "Leads not added successfully, Please try again!");
          echo "<script> location.href='edit-registered-partners.php?partners_id={$partners_id}'; </script>";
         }
    }
   
  }

if(isset($_POST['activate_partners']) && isset($_SESSION['spa_userName'])){
   
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $user_check_query = "update partners_registration set status='active' where partners_id='$id' ";
    mysqli_query($db, $user_check_query);
  }

  if(isset($_POST['deactivate_partners']) && isset($_SESSION['spa_userName'])){
    $id = mysqli_real_escape_string($db, $_POST['id']); 
    $user_check_query = "update partners_registration set status='deactive' where partners_id='$id' ";
    mysqli_query($db, $user_check_query);
  }
?>