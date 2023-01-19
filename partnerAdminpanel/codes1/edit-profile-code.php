<?php 
include 'dbwe.php';
 
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg = array(); 
$partners_id=$_SESSION['admin_UserId_partner'];
if(isset($_POST['update_partners_registration']) && isset($_SESSION['admin_UserId_partner'])){
 
    $name=mysqli_real_escape_string($db, $_POST['name']);
    $email =mysqli_real_escape_string($db, $_POST['email']);
    $contact=mysqli_real_escape_string($db, $_POST['contact']); 
    $company_name = mysqli_real_escape_string($db, $_POST['company_name']);  
    $location = mysqli_real_escape_string($db, $_POST['location']); 
    $city=mysqli_real_escape_string($db, $_POST['city']); 
    $state = mysqli_real_escape_string($db, $_POST['state']);
    if($state=="-1"){
        array_push($errors, "Please select state ");
    } 
    $spaServices='';
    $pincode=mysqli_real_escape_string($db, $_POST['pincode']);  
    /* $partners_password = mysqli_real_escape_string($db, $_POST['password']);  
    $status = mysqli_real_escape_string($db, $_POST['status']); 
    if($status=="-1"){
        array_push($errors, "Please select status");
    }
    $roles = mysqli_real_escape_string($db, $_POST['roles']);  */
   /*  if($roles=="-1"){
        array_push($errors, "Please select roles");
    } */
    
    
    //echo 'l:'.$location.'::n: '.$name.' :e: '.$email.': c: '.$contact.': cn: '.$company_name;
    $partners_id=$_SESSION['admin_UserId_partner'];
    
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
    
        $stmt = $db->prepare("Update partners_registration set name=?,email=?,contact=?,company_name=?,location=?,city=?,state=?,pincode=? where partners_id=?");
       $rc= $stmt->bind_param("sssssssss", $name, $email, $contact,$company_name,$location,$city,$state,$pincode,$partners_id);
       $rc=$stmt->execute();
       if($rc==true){
        array_push($successMsg,"Update successfully!!");
       }else{
        array_push($successMsg,"Something went wrong!, not updated successfully"); 
       } 
          
    }
}


if(isset($_POST['submitImg'])){
    $profileImg=mysqli_real_escape_string($db, $_FILES["profileImg"]["name"]); 
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
  
    $queryGetCount="select count(*) as total from partners_registration";
    $result = mysqli_query($db, $queryGetCount);
    $allRecord=mysqli_fetch_assoc($result);
    $totalRecord;
    
    if($allRecord>0)
    {
        $totalRecord=$allRecord['total'];
        $totalRecord=$totalRecord+1;
    }
  
    $target_path = "./../partner_profile_img/";
    //$file = $_POST['uploadResume'];
    $target_path = $target_path.basename( $totalRecord.'_'. $_FILES["profileImg"]["name"]); 
    $file_name= $totalRecord.'_'.$_FILES["profileImg"]["name"];
    $file_name=strtolower($file_name);
    $temp = explode('.', $file_name);
  
    $extension = end($temp);
  
    //array_push($errors, "Extension ".$extension);
  
      if ( 1048576 < $_FILES["profileImg"]["size"]  ) { 
      array_push($errors, "File size should be less than 1MB ");
      }
  
      if ( ! ( in_array($extension, $allowedExts ) ) ) {
          array_push($errors, "Please upload jpeg, png, gif ");
      }
      else{
        move_uploaded_file($_FILES["profileImg"]["tmp_name"], $target_path); 
      }
  
  
      if (count($errors) == 0) { 
      
        $stmt = $db->prepare("Update partners_registration set profileImg=? where partners_id=?");
       $rc= $stmt->bind_param("ss", $target_path, $partners_id);
       $rc=$stmt->execute();
       if($rc==true){
        array_push($successMsg,"Image uploaded successfully!!");
        $baseurl=$baseurl;
        //echo '$baseurl '.$baseurl.'/'.$target_path;
        $imgUrl1=$baseurl.'/'.$target_path;
        //echo "<br>imfge url ::: ".$imgUrl1;
        echo '<script>(function(){var ele=document.querySelector(".topImg");var headerele=document.querySelector(".headerImg");if(ele){ele.src="'.$imgUrl1.'";} if(headerele){headerele.src="'.$imgUrl1.'";}})()</script>';

        
       }else{
        array_push($successMsg,"Something went wrong!, Image not uploaded successfully"); 
       }
       
     
          
    }
   
   }
?>