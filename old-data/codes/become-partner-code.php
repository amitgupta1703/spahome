<?php   
include './config.php';
 
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
$pincode=mysqli_real_escape_string($db, $_POST['pincode']); 


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
$status="rejected";
$link_partner_admin_id=0;

if (count($errors) == 0) { 

    $stmt = $db->prepare("INSERT INTO spa_partners(name,email,contact,company_name,services,location,city,state,pincode,date,status,link_partner_admin_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssss", $name, $email, $contact,$company_name,$services,$location,$city,$state,$pincode,$date,$status,$link_partner_admin_id);
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
?>