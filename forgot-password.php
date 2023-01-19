<?php 
$title="Forgot Password";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'codes/login-code.php';



if(isset($_POST['submitForgotPassword'])){
 
   $username=mysqli_real_escape_string($db, $_POST['username']);  
   $email = mysqli_real_escape_string($db, $_POST['email']);  
   date_default_timezone_set('Asia/Kolkata');
   $date = date('Y-m-d H:i:s'); 
     
   
   if (empty($username)) { array_push($errors, "Please enter registered number"); }  
   if (empty($email)) { array_push($errors, "Please enter email"); }  
   if (count($errors) == 0) {  
       $user_check_query = "select * from spa_customers where cust_username='$username' and cust_email='$email' and phone_verification_status='Verify' and roles='customer' and status='active' limit 1"; 
       $results = mysqli_query($db, $user_check_query); 
   
       $services_name='';
       $amount='';
       if (mysqli_num_rows($results) >0) { 
           $row = mysqli_fetch_array($results); 
           $name=$row['cust_name'];
           $pwd=$row['cust_password'];
           $emailTo=$row['cust_email'];
           passwordResetEmail($name,$pwd,$emailTo);
           array_push($successMsg, "Password sent to your email id '".$emailTo."'");
   
       }else{
           array_push($errors, "Username or Email Id not found, Try again!!!");
       }
         
   }
   }

function passwordResetEmail($name,$pwd,$emailTo){
    // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
  
  $to = $emailTo;
  $subject = "Reset password SPA Home Service";
  
  
  $message = "
            <html> 
                <head>
                    <title>Reset password SPA Home Service</title>
                </head> 
                <body>
                    <table style='width:100%;'>

                        <tr>
                            <td colspan='2'>Dear <b>".$name."</b>,</td>
                        </tr>
                        <tr>
                            <td>
                                <p>There was a request to your forgot password!</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <p>Your password is : <b>".$pwd."</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <p style='margin:0'><b>\n\n\nThanks</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <p style='margin:0'><b>SPA Home Service</b></p>
                            </td>
                        </tr>
                    </table>
                </body> 
                </html>
         ";
  
  $headers .= 'From: Spa Home Services<support@spahomeservice.in>' . "\r\n"; 
  mail($to,$subject,$message,$headers);
  
  }
?>

<style> 
.s{
    border-top: 1px solid #c3c3c3;
    border-width: thin;
    width: 30%;
}
.fs15{
    font-size: 15px;
}

/* .bg{
  background: #ccc;
    background: rgb(247,185,199);
    background: linear-gradient(132deg, rgba(247,185,199,1) 0%, rgba(239,132,155,1) 17%, rgba(246,158,177,1) 42%, rgba(255,255,255,1) 100%);
}
 */
</style>
<div class="site-blocks-cover overlay" style="background-image: url(images/sliders/contact.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                           <!--  <h1 data-aos="fade-up" class="mb-5">Contact Us</h1>  -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
    <div class="site-section bg-light bg">
      <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
          <div class="col-md-6 offset-md-1 mb-5 aos-init aos-animate" data-aos="fade"> 
            <form action="<?php echo $baseurl?>/forgot-password" method="post" class="p-3 bg-white" onSubmit="validate2(event)">
             <h3  class="theme-color text-center">Forgot Password</h3>
            <div class="errorMsg">
                <?php  include 'errors.php' ?>
            </div>
            <div class="successMsg">
                <?php  include 'success.php'; ?>
            </div>
                
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="username">Register Number</label> 
                  <input type="text" id="username" name="username" class="form-control" value="<?php if(isset($_POST['username'])) {echo $username;}?>" oninput="validate(event);" maxlength="10">
                  <span id="username_error" class="errors"></span>
                </div>
              </div> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Email Id</label> 
                  <input type="email" id="email" name="email" class="form-control" oninput="validate(event);">
                  <span id="email_error" class="errors"></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" id="submitFP" style="width:100% !important" name="submitForgotPassword" value="Submit" disabled class="btn btn-pil btn-primary btn-md text-white"> 
                </div>
                <div class="col-md-12 text-center mt-3">
                   <span>If you have account! </span> <a href="<?php echo $baseurl?>/login"  class="text-center">Login</a>
                </div>
              </div>
             
  
            </form>
          </div>
          <div class="col-md-2 aos-init aos-animate" data-aos="fade" data-aos-delay="100"> 
          </div>
        </div>
      </div>
    </div>
<script>
    var flag;
    var flag2;
    var submitBtn=document.getElementById('submitFP');
    function validate(event) {
        //console.log("event ", event);
        var target = event.target;
        var text;
        
        if (target.id == "username") {
            var contact = target.value;
            if (contact == "" || contact.trim() == "") {
                text = "Please enter contact number";
                username_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag=false;
            // return false;
            } else if(isNaN(contact) || contact.length != 10){
                text = "Please enter valid number";
                username_error.innerHTML = text;
                target.style.border = "1px solid red";
            flag=false;
                //return false;
            
            }else{
                username_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag=true;
            }
        }
        if (target.id == "email") {
            var email = target.value; 
            var regex = "[a-zA-Z0-9._+-]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z]{2,}";
            if (target.value == "" || target.value.trim() == "") {
                text = "Please enter email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red"; 
                flag=false;
                //return false;
            }else if(email.match(regex)){ 
                email_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag=true;
            } 
            else { 
                text = "Please enter valid email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag=false;  
            }
        }
    
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;  
            if(isNaN(username) || username.length != 10){
                flag=false;  
            } 
            if(email.indexOf("@") == -1 || email.length ==0){
                flag=false;  
            }

            //console.log("flag",flag,flag2)
            if(submitBtn && flag==true){
                //console.log("flag in id",flag,flag2)
                submitBtn.removeAttribute("disabled");
            }else if(submitBtn && (flag==false)){
                //console.log("flag in else if",flag,flag2)
                submitBtn.setAttribute("disabled","true");
            }  
    }
</script>
<?php 
include 'footer.php';
?>