<?php 
include './config.php';
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
}
?>
