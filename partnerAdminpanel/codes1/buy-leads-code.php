<?php
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include '../config.php';
$sessionid=$sessionid;
//echo 'session id '.$sessionid;
if (isset($_POST['buy_leads']) && isset($_SESSION['U_Name_partner']) && $_SESSION['U_Name_partner']!="") {
    $noOfLeads = mysqli_real_escape_string($db, $_POST['noOfLeads']);   
    $partner_admin_id;
    $partner_username;
    if(isset($_SESSION['admin_UserId_partner']) && isset($_SESSION['U_Name_partner'])){
      $partner_admin_id=$_SESSION['admin_UserId_partner'];
      $partner_username=$_SESSION['U_Name_partner'];
    }  
    if (empty($noOfLeads)) { array_push($errors, "Please enter leads"); }  
    if($noOfLeads<0){
      array_push($errors, "Please enter leads greater than or equal to 5");
    }

    $totalAmount=$noOfLeads*177; 
    $sessionid=$sessionid;
    $paymentStatus='pending';
    $paymentId='';
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
  
        if (count($errors) == 0) {
             
            $stmt = $db->prepare("INSERT into spa_partners_leads(partner_id,no_of_leads,total_amount,paymentStatus,paymentId,date,session_id) values(?,?,?,?,?,?,?)");
           $rc= $stmt->bind_param("sssssss", $partner_admin_id, $noOfLeads,$totalAmount,$paymentStatus,$paymentId,$date,$sessionid);
           $rc= $stmt->execute();
           $id=mysqli_insert_id($db);
           if($rc==true){
              //array_push($successMsg,"Password update successfully!");
              $_SESSION['partner_id']=$partner_admin_id;
              $_SESSION['totalAmount']=$totalAmount;
              $_SESSION['oid']=$id;
              $url='payment/pay-now.php?skids='.$partner_admin_id.'&session_id='.$sessionid;
              //echo $url;

             // echo "gateway/pay-now.php?skids="'.$partner_admin_id.'&session_id='.$sessionid.'";
              echo '<script>(function(){window.location.href ="'.$url.'"})();</script>';
           }else{
             echo 'abc';
           }
              //array_push($successMsg,"Password update successfully!");
             
            } 
         
         else{
           // echo "not post";
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  

 
 

?>