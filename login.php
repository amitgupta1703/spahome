<?php 
$title="Login";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
unset($errors); 
$errors = array();  
unset($successMsg); 
$successMsg = array();  
include 'header.php';

//include 'codes/login-code.php';
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
   
           $encryption_name = "cust_uname"; 
           $encryption_uname = openssl_encrypt($row[1], $ciphering, $encryption_name, $options, $encryption_iv); 
   
           setcookie('un_c',$encryption_un,time()+60*60*24*30);
           setcookie('un_ic',$encryption_uid,time()+60*60*24*30);
           setcookie('un_na',$encryption_uname,time()+60*60*24*30);
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
               echo "<script> window.location.assign('{$baseurl}'); </script>";
           }
          
   
       }else{
           array_push($errors, "Invalid username or password");
       }
     
      
    //array_push($successMsg,"Message send successfully we will contact you soon!!");
         
   }
   }
?>

<style> 
.s{
    border-top: 1px solid #c3c3c3;
    border-width: thin;
    width: 30%;
}
form{
  box-shadow: 0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12)!important;
}
/* .bg{
  background: #ccc;
    background: rgb(247,185,199);
    background: linear-gradient(132deg, rgba(247,185,199,1) 0%, rgba(239,132,155,1) 17%, rgba(246,158,177,1) 42%, rgba(255,255,255,1) 100%);
} */

</style>
<div class="site-blocks-cover overlay" style="background-image: url(images/sliders/slider5.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
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
            <form action="<?php echo $baseurl?>/login" method="post" class="p-3 bg-white">
             <h3  class="theme-color text-center">Login</h3>
            <div style="margin-top:1rem;color:red;">
                <?php  include 'errors.php' ?>
            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php'; ?>
            </div>
                
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="username">Registered Number</label> 
                  <input type="text" id="username" name="username" class="form-control" value="<?php if(isset($_POST['username'])) {echo $username;}?>" maxlength="10" oninput="validate(event)">
                  <span id="username_error" class="errors"></span>
                </div>
              </div> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Password</label> 
                  <input type="password" id="password" name="password" class="form-control" oninput="validate(event)">
                  <span id="password_error" class="errors"></span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" style="width:100% !important" id="login" name="login" value="Login" class="btn btn-pil btn-primary btn-md text-white btnblack" disabled> 
                </div>
                <div class="col-md-6">
                <a href="<?php echo $baseurl?>/forgot-password"  class="text-center">Forgot Password?</a>
                </div>
              </div>
             <div class="row">
                 <div class="col-md-12">
                 <!-- <span class="s">&nbsp;</span><span>or</span><span class="s">&nbsp;</span> <br> -->
                <p class="text-center">Not have account? <a href="<?php echo $baseurl?>/registration">Sign Up</a></p>
                 
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
    var submitBtn=document.getElementById('login');
    function validate(event) { 
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

         if (target.id == "password") {
            var password = target.value;
            if (password == "" || password.trim() == "") {
                text = "Please enter password";
                password_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag=false;
            // return false;
            } 
            else{
                password_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag=true;
            }
        }
       
    
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;  
            if(isNaN(username) || username.length != 10){
                flag=false;  
            } 
            if(password=="" || password.length ==0){
                flag=false;  
            }
 
            if(submitBtn && flag==true){ 
                submitBtn.removeAttribute("disabled");
            }else if(submitBtn && (flag==false)){ 
                submitBtn.setAttribute("disabled","true");
            }  
    }
</script>
<?php 
include 'footer.php';
?>