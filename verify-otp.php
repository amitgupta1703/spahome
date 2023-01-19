<?php 
$title="Verify OTP";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";

include 'header.php';
include 'codes/login-code.php'; 
/* unset($errors); 
$errors = array();  
unset($successMsg);  
$successMsg = array();  */



if(isset($_POST['submit_otp']) && isset($_GET['mobile'])){
    $mobileNo;
    $mob=$_GET['mobile'];
    $mobileNo=$mob;
    $getId;
    $custId;
    //echo $mob;
    $otp=mysqli_real_escape_string($db, $_POST['otp']); 
    // $otp=(int)$otp;
  /*   if(is_numeric($otp)!=1){
        array_push($errors, "Please enter valid otp1");
    } */
    //echo strlen($otp);
    /* if(strlen($otp)!=6 || is_numeric($otp)!=1){
        array_push($errors, "Please enter valid otp");
    } */
    if(strlen($otp)!=6 || is_numeric($otp)!=1){
        array_push($errors, "Please enter valid otp");
    }
      
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s'); 

    $getId=$_COOKIE['ouy3_37dfuu']; 
    $custId=explode("-",$getId)[1];
    //echo "cust id: ".$custId;
     
    if (empty($otp)) { array_push($errors, "Please enter otp"); }  
    
    $user_check_query = "select * from spa_customers where phone_verification_status='Not Verify' and cust_id='$custId'  limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $dotp=$row[9];
        if($otp!=$dotp || (strlen($otp)!=6 || is_numeric($otp)!=1)){
            array_push($errors, "OTP not matched");
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
       $stmt = $db->prepare("update spa_customers set phone_verification_status=?,otp=?,status=? where cust_username=? and cust_id=?");
       $rc= $stmt->bind_param("sssss", $phone_verification_status,$otp,$status,$mob,$custId); 
       $rc=$stmt->execute(); 
       if($rc==true){
           //echo "true";
        //echo "<script> window.location.assign('login.php'); </script>"; 
        echo "<script> window.location.assign('thank-you.php?register=true'); </script>"; 
       }else{
        array_push($errors, "Please enter not validate try again!!");
       }

     
      
      
    }
    }
 

    if( isset($_POST['submit_otpforBecomePartner']) && isset($_GET['mobile']) && isset($_GET['becomePartner']) && $_GET['becomePartner']=="true"){
        
        if(!isset($_COOKIE['o_bpar'])){
            echo "<script> window.location.assign('become-partner.php?success=true'); </script>";
        }
        $mob=$_GET['mobile'];
        //echo $mob;
        $otp=mysqli_real_escape_string($db, $_POST['otp']); 
        //echo "mob: ".$mob.', otp '.$otp;
        // $otp=(int)$otp;
        /* if(is_numeric($otp)!=1){
            array_push($errors, "Please enter valid otp1");
        } */
        //echo strlen($otp);
        if (empty($otp)) { array_push($errors, "Please enter otp"); }  

        else if(strlen($otp)!=6 || is_numeric($otp)!=1){
            array_push($errors, "Please enter valid otp");
        }
          
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s'); 
         
        /* $pid="hGME232312elcSuKgbd64783#2x-".$id."-h73lg365232";
        setcookie("o_bpar",$pid,time()+60*60*24*30); */

        $getId=$_COOKIE['o_bpar']; 
        $pId=explode("-",$getId)[1];
       // echo "inf verify number :::: pid ".$pId;
        $user_check_query = "select * from spa_partners where otp='$otp' and phone_verification_status='Not Verify' and partner_id='$pId' limit 1"; 
        $results = mysqli_query($db, $user_check_query); 
        if (mysqli_num_rows($results) >0) { 
            $row = mysqli_fetch_array($results); 
            $dotp=$row[13];
            if($otp!=$dotp){
                //echo "inf verify number";
                array_push($errors, "OTP not matched");
            }       
        }else{
            array_push($errors, "OTP not matched");
        }
       $mob=(string)$mob;
        if (count($errors) == 0) {  
             
            $phone_verification_status="Verify"; 
           $stmt = $db->prepare("update spa_partners set phone_verification_status=? where otp=? and partner_id=?");
            $rc=$stmt->bind_param("sss", $phone_verification_status,$otp,$pId); 
            $rc=$stmt->execute(); 
          
          
          if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
            array_push($errors, "Error occurs while submitting data, Retry again!");
          }else{
            array_push($successMsg, "Partner register successfully we will contact you soon");
            $n='';
            if(isset($_SESSION['name'])){
                $n=$_SESSION['name'];
            } 
            //sendWhatsappMsg($n,$mob);
            unset($_SESSION['name']);
            echo "<script> window.location.assign('become-partner.php?success=true'); </script>"; 
          }
 
          
        }
        }


        if( isset($_POST['submit_otpforFranchise']) && isset($_GET['mobile']) && isset($_GET['franchise']) && $_GET['franchise']=="true"){ 
          if(!isset($_COOKIE['f_bpar'])){
              echo "<script> window.location.assign('franchise.php?success=true'); </script>";
          }
          $mob=$_GET['mobile'];
          //echo $mob;
          $otp=mysqli_real_escape_string($db, $_POST['otpfranchise']); 
          echo "mob: ".$mob.', otp '.$otp;
          // $otp=(int)$otp;
          /* if(is_numeric($otp)!=1){
              array_push($errors, "Please enter valid otp1");
          } */
          //echo strlen($otp);
          if (empty($otp)) { array_push($errors, "Please enter otp"); }  
    
          else if(strlen($otp)!=6 || is_numeric($otp)!=1){
              array_push($errors, "Please enter valid otp");
          }
            
          date_default_timezone_set('Asia/Kolkata');
          $date = date('Y-m-d H:i:s'); 
           
          /* $pid="hGME232312elcSuKgbd64783#2x-".$id."-h73lg365232";
          setcookie("o_bpar",$pid,time()+60*60*24*30); */
    
          $getId=$_COOKIE['f_bpar']; 
          $pId=explode("-",$getId)[1];
         echo "inf verify number :::: pid ".$pId;
          $user_check_query = "select * from franchise where otp='$otp' and phone_verification_status='Not Verify' and id='$pId' limit 1"; 
          $results = mysqli_query($db, $user_check_query); 
          if (mysqli_num_rows($results) >0) { 
              $row = mysqli_fetch_array($results); 
              $dotp=$row[13];
              if($otp!=$dotp){
                  //echo "inf verify number";
                  //array_push($errors, "OTP not matched");
              }       
          }else{
              array_push($errors, "OTP not matched");
          }
         $mob=(string)$mob;
          if (count($errors) == 0) {  
               $franchise="franchise";
              $phone_verification_status="Verify"; 
             $stmt = $db->prepare("update franchise set phone_verification_status=? where otp=? and id=?");
              $rc=$stmt->bind_param("sss", $phone_verification_status,$otp,$pId); 
              $rc=$stmt->execute(); 
              $urls=$baseurl.'/thank-you/'.$franchise;
            
            if ( false===$rc ) {
              die('execute() failed: ' . htmlspecialchars($stmt->error));
              array_push($errors, "Error occurs while submitting data, Retry again!");
            }else{
              //array_push($successMsg, "Partner register successfully we will contact you soon");
              $n='';
              if(isset($_SESSION['name'])){
                  $n=$_SESSION['name'];
              } 
              //sendWhatsappMsg($n,$mob);
              unset($_SESSION['name']); 
              echo '<script>(function(){window.location.href ="'.$urls.'";})();</script>';
            }
    
            
          }else{
            echo "not verify";
          }
          }
       
?>


<div class="site-section bg-light pt-5 mt-2">
    <div class="container py-5">
        <?php if(!isset($_GET['franchise'])){?>
        <div class="row mt-5 d-flex">
            <div class="col-md-2"></div>
            <div class="col-md-6 offset-md-1 mb-5 aos-init aos-animate bg-white pt-3" data-aos="fade">
                <h3 class="theme-color text-center">Submit OTP</h3>
                <div class="px-3" style="margin-top:1rem;color:red;">
                    <?php  include 'errors.php' ?>
                </div>
                <div class="px-3" style="margin-top:1rem;color:green;font-size:1.3rem;">
                    <?php  include 'success.php' ?>
                </div>
                <form action="verify-otp.php?<?php if(isset($_GET['becomePartner']) && $_GET['becomePartner']==true){echo 'becomePartner=true&';} ?>mobile=<?php echo $_GET['mobile'];?>" method="post">
                    <div class="row form-group px-3 mb-0">
                        <div class="col-md-12">
                            <label class="text-black" style="width:100% !important" for="name">Enter OTP <span class="right"><span id="resendLink" class="d-none"><!-- <a class='resendBtn theme-color' onclick='resendOtp(<?php echo $_GET["mobile"];?>)' >Resend OTP</a> --> 
                
                    
                    <!-- <input type='submit' class='resendBtn resendOtpBtn' name="resendOtps" value='Resend OTP'> -->

                    <?php 
                    
                    if(isset($_GET['becomePartner']) && $_GET['becomePartner']==true){
                        $mobNo=$_GET["mobile"];
                        echo '<input type="hidden" name="partnermobileNo" value="'.$mobNo.'">';
                        echo "<input type='submit' class='resendBtn resendOtpBtn' name='becomePartnerresendOtps' value='Resend OTP'>";
                    }else{
                        $mobNo=$_GET["mobile"];
                        echo '<input type="hidden" name="mobileNo" value="'.$mobNo.'">';
                        echo "<input type='submit' class='resendBtn resendOtpBtn' name='resendOtps' value='Resend OTP'>";
                    }
                    
                    ?>

                     
                 
                </span><span id="timer" class="theme-color"></span></span></label>

                        </div>
                    </div>
                </form>
                <form action="verify-otp.php?<?php if(isset($_GET['becomePartner']) && $_GET['becomePartner']==true){echo 'becomePartner=true&';} ?>mobile=<?php echo $_GET['mobile'];?>" method="post" class="pb-3 px-3 pt-0 bg-white">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" id="otp" name="otp" class="form-control" maxlength="6">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <?php 
                    if(isset($_GET['becomePartner']) && $_GET['becomePartner']==true){
                        echo '<input type="submit" style="width:100% !important" name="submit_otpforBecomePartner" value="Submit Otp" class="btn btn-pil btn-primary btn-md text-white bp">';
                    }else{
                        echo '<input type="submit" style="width:100% !important" name="submit_otp" value="Submit Otp" class="btn btn-pil btn-primary btn-md text-white">';
                    }
                    ?>
                        </div>
                    </div>


                </form>
            </div>

        </div>
        <?php }
        elseif(isset($_GET['franchise']) && $_GET['franchise']==true) {?>

        <div class="row mt-5 <?php if(isset($_GET['franchise']) && $_GET['franchise']==true){echo 'd-flex';}else{echo 'd-none';} ?>">
            <div class="col-md-2"></div>
            <div class="col-md-6 offset-md-1 mb-5 aos-init aos-animate bg-white pt-3" data-aos="fade">
                <h3 class="theme-color text-center">Submit OTP</h3>
                <div class="px-3" style="margin-top:1rem;color:red;">
                    <?php  include 'errors.php' ?>
                </div>
                <div class="px-3" style="margin-top:1rem;color:green;font-size:1.3rem;">
                    <?php  include 'success.php' ?>
                </div>
                <form action="verify-otp.php?<?php if(isset($_GET['franchise']) && $_GET['franchise']==true){echo 'franchise=true&';} ?>mobile=<?php echo $_GET['mobile'];?>" method="post">
                    <div class="row form-group px-3 mb-0">
                        <div class="col-md-12">
                            <label class="text-black" style="width:100% !important" for="name">Enter OTP <span class="right"><span id="resendLink" class="d-none"><!-- <a class='resendBtn theme-color' onclick='resendOtp(<?php echo $_GET["mobile"];?>)' >Resend OTP</a> --> 
                
                    
                    <!-- <input type='submit' class='resendBtn resendOtpBtn' name="resendOtps" value='Resend OTP'> -->

                    <?php 
                    
                    if(isset($_GET['franchise']) && $_GET['franchise']==true){
                        $mobNo=$_GET["mobile"];
                        echo '<input type="hidden" name="franchisemobileNo" value="'.$mobNo.'">';
                        echo "<input type='submit' class='resendBtn resendOtpBtn' name='franchiseresendOtps' value='Resend OTP'>";
                    } 
                    
                    ?>

                     
                 
                </span><span id="timer" class="theme-color"></span></span></label>

                        </div>
                    </div>
                </form>
                <form action="verify-otp.php?<?php if(isset($_GET['franchise']) && $_GET['franchise']==true){echo 'franchise=true&';} ?>mobile=<?php echo $_GET['mobile'];?>" method="post" class="pb-3 px-3 pt-0 bg-white">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" id="otp" name="otpfranchise" class="form-control" maxlength="6">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <?php 
                        if(isset($_GET['franchise']) && $_GET['franchise']==true){
                        $mobNo=$_GET["mobile"];
                        echo '<input type="hidden" name="franchisemobileNo" value="'.$mobNo.'">';
                        echo "<input type='submit' class='btn btn-pil btn-primary btn-md text-white w-100 bp' name='submit_otpforFranchise' value='Submit Otp'> ";
                    } ?>



                        </div>
                    </div>


                </form>
            </div>

        </div>
        <?php }?>

    </div>
</div>
<script>
    let timerOn = true;

    function timer(remaining) {
        console.log("ellee");
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if (!timerOn) {

            return;
        }

        // Do timeout stuff here
        //alert('Timeout for otp');
        var ele = document.getElementById('resendLink');
        console.log(document.getElementById('resendLink'))
        if (ele) {
            // console.log("ellee");
            //ele.innerHTML="<input type='submit' class='resendBtn' onclick='resendOtp('{$mobileNo}')' value='Resend OTP'>";
            ele.setAttribute("class", "d-block");
        }
        document.getElementById('timer').setAttribute("class", "d-none");
    }

    timer(5);

    /* function resendOtp(mobileNo){
    //console.log("mobileNo",mobileNo);
        $.ajax({
            url: 'verify-otp.php',
            type:'POST',
            dataType:"json",
            data:
            { 
                mobileNo: mobileNo
            },
            success: function(response)
            { 
                alert(response);
                //timer(5); 
            }               
        });
    } */
</script>
<?php 
include 'footer.php';
?>