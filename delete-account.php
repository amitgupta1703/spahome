<?php 
$title="Delete Account";
include 'header.php';
include 'codes/login-code.php';
include 'profile-header.php';

if(isset($_GET['deleteAccount']) && $_GET['deleteAccount']=='true' && isset($_SESSION['username']) && isset($_SESSION['cust_id']) && $_SESSION['cust_id']!='' ){
 
    $username=$_SESSION['username'];
    $cust_id=$_SESSION['cust_id'];
    $emailid='';
    $cust_name='';
    $user_check_query = "select * from spa_customers where cust_username='$username' and cust_id='cust_id' and status='active' limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_assoc($results); 
        $custId=$row['cust_id'];
        $emailid=$row['cust_email'];
        $cust_name=$row['cust_name'];
        echo $cust_name.':::: in if f  ::sdfsdfsdf::'.$emailid;
        if($custId!=$cust_id){
            array_push($errors, "User not found");
        }    
    }
     
    if (count($errors) == 0) { 
    $status='deactive';
       $stmt = $db->prepare("Update spa_customers set status=? where cust_username=? and cust_id=?");
       $rc=$stmt->bind_param("sss",$status,$username,$cust_id); 
       $rc=$stmt->execute();
       if($rc==true){ 
            deleteAccountEmail($cust_name,$emailid,$emailid);
            unset($_SESSION['username']);
            unset($_SESSION['cust_id']);
            unset($_SESSION['name']);
            echo "<script> (function(){setTimeout(() => {  window.location.href='{$baseurl}'}, 5000)})();</script>";
       }
       
    }
    }else{
       // echo "<script> window.location.assign('{$baseurl}/profile'); </script>";
    }
    


    function deleteAccountEmail($name,$email,$emailTo){
        // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      
      
        
      
      $to = $emailTo;
      $subject = "Account Deleted";
      
      
      $message = "
               <html>
                 <head>
                 <title>Account Deleted</title>
                 </head>
                 <body>  
                   <table style='width:100%;'> 
                  
                    <tr>
                       <td colspan='2'>Dear <b>".$name."</b>,</td> 
                     </tr> 
                      <tr>
                        <td colspan='2' align='center'> 
                            <h4>Your Account deleted successfully</h4></br>
                            <p>Thank you being with us</p>
                            <p>Good Luck</p>
                        </td> 
                      </tr>  
                   
                 </table>
               </body>
             </html>
             ";
      
      
      
      // More headers
      $headers .= 'From: Spa Home Services<support@spahomeservice.in>' . "\r\n";
      //$headers .= 'Cc: myboss@example.com' . "\r\n";
      
      mail($to,$subject,$message,$headers);
      
      }
?>


<div class="site-blocks-cover overlay" style="background-image: url(<?php echo $baseurl?>/images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center"> 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="block-services-1 py-5">
      <div class="container">
        <div class="row">
           
          <div class="col-md-12 about text-center">
            <h2 class="text-primary mb-3 mt-3">Your account deleted successfully</h2>
            <p>Thank you being with us!</p>
            <p>Good Luck!</p>
                           
 
          </div>
        </div>
      </div>
    </div>

<?php 
include 'footer.php';
?>