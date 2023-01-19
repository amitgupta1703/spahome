<?php 
$title="Book Appointment";
include 'header.php';
include 'config.php';
$cust_name="";
$cust_email="";
$cust_contact="";
$username="";
$cust_id;
$jsonCart;

 

$timeArray=array("08:30"=>"08:00AM-08:30AM","09:00"=>"08:30AM-09:00AM","09:30"=>"09:00AM-09:30AM","10.00"=>"09:30AM-10.00AM","10:30"=>"10:00AM-10:30AM","11:00"=>"10:30AM-11:00AM","11:30"=>"11:00AM-11:30AM","12:00"=>"11:30AM-12:00PM","12:30"=>"12:00PM-12:30PM","13:00"=>"12:30PM-01:00PM","13:30"=>"01:00PM-01:30PM","14:00"=>"01:30PM-02:00PM","14:30"=>"02:00PM-02:30PM","15:00"=>"02:30PM-03:00PM","15:30"=>"03:00PM-03:30PM","16:00"=>"03:30PM-04:00PM","16:30"=>"04:00PM-04:30PM","17:00"=>"04:30PM-05:00PM","17:30"=>"05:00PM-05:30PM","18:00"=>"05:30PM-06:00PM","18:30"=>"06:00PM-06:30PM","19:00"=>"06:30PM-07:00PM","19:30"=>"07:00PM-07:30PM");

//echo '<br>session id: ',$session_ids;
//echo "uaser name: ".$_SESSION['username'];
if(isset($_GET['checkout']) && $_GET['checkout']!='' && isset($_GET['amount']) && $_GET['amount']!=''){
  $_SESSION['ischeckout']='true';
  $_SESSION['amount']=$_GET['amount'];
}

if(!isset($_SESSION['username']) || $_SESSION['username']==''){
 echo "<script> window.location.assign('login.php'); </script>";
}else{
  $username=$_SESSION['username'];
  $customer_query = "select * from spa_customers where cust_username='$username' and phone_verification_status ='Verify' limit 1";
      $customer_details = mysqli_query($db, $customer_query);
      $cust_details = mysqli_fetch_assoc($customer_details); 
      if ($cust_details) { // if user exists
        
       $cust_name= $cust_details['cust_name'];
       $cust_email= $cust_details['cust_email'];
       $cust_contact= $cust_details['cust_contact'];
       $cust_id= $cust_details['cust_id'];
       
      }
}
 	 
$total_quantity = 0;
$total_price = 0;
$userid='';
$offer=0;


if(isset($_SESSION['username'])){
    $userid=$_SESSION['username'];
    $cart_count_query="select * from cart where user_id='$userid'";
  }else{
    $cart_count_query="select * from cart where session_id='$session_ids'";
  } 
  $cart_count=0;
  $totalDiscount=0; 
  $cart_total=0;
  $results = mysqli_query($db, $cart_count_query); 
  if (mysqli_num_rows($results) >0) { 
    while($item = mysqli_fetch_assoc($results)){ 
      $offer=$item["offersOrDiscount"];
        $item_price = $item["quantity"]*$item["amount"];  
          $totalDiscount=$totalDiscount+(($item_price*$offer)/100);
          $item_price=$item_price-(($item_price*$offer)/100); 
        
        //$total_quantity += $item["quantity"];
        $total_price += ($item["amount"]*$item["quantity"]);
      
      }
    $cart_total=$total_price-$totalDiscount;
   //echo "ashjfh: ",round($cart_total),' g:: ',$totalDiscount;
  }
 
/* if(isset($_GET['service_id']) && $_GET['service_id']!==""){

  $_SESSION['service_id']=$_GET['service_id'];
  $service_id1=$_GET['service_id'];

  $service_name=$_GET['service_name'];
  //$service_name=explode(",",$service_name)[0];
  //echo $service_name;
  $partners_admin_id;
  $services_name_query = "select * from partners_services where service_id='$service_id1' limit 1";
      $services_names = mysqli_query($db, $services_name_query);
      $codes = mysqli_fetch_assoc($services_names);
      
      if ($codes) { // if user exists
        
       $partners_admin_id= $codes['partners_admin_id'];
      }
} */




 


//echo  $jsonCart;


$partners_admin_id=100;


unset($errors); 
$errors = array(); 

unset($successMsg); 
$successMsg = array(); 

if(isset($_POST['submit'])){
 // echo 'submit  ';
$service_id=mysqli_real_escape_string($db, $_POST['service_id']); 
$partnersAID=mysqli_real_escape_string($db, $_POST['partnersAID']);
$amount=mysqli_real_escape_string($db, $_POST['amount']);
$serviceDate=mysqli_real_escape_string($db, $_POST['serviceDate']);
$serviceTiming=mysqli_real_escape_string($db, $_POST['timing']);
if($serviceTiming=="-1"){
  array_push($errors, "Please select timing");
}else{
  $serviceTiming=$timeArray[$serviceTiming];
}

$cust_addr=mysqli_real_escape_string($db, $_POST['cust_addr']);
if($cust_addr=="-1"){
  array_push($errors, "Please select address. if address not added add new");
}
//echo "cust_addd::: ".$cust_addr;
$customer_address;
$cust_address_id;

if($cust_addr!="-1"){
  $customer_address=explode('#',$cust_addr)[1];
  $cust_address_id=explode('#',$cust_addr)[0];
}

$convenienceFee=0; 
      $totalAmt=$amount;
      if($totalAmt>299 && $totalAmt<1500){
          $convenienceFee=($totalAmt*5)/100;
      }
    else if($totalAmt>1499 && $totalAmt<2500){
        $convenienceFee=($totalAmt*4)/100;
    }
    else if($totalAmt>2499 && $totalAmt<3500){
        $convenienceFee=($totalAmt*3)/100;
    }
    else if($totalAmt>3499 && $totalAmt<10000){
        $convenienceFee=($totalAmt*2.8)/100;
    }
    $convenienceFee=round($convenienceFee);

    $amount=$amount+$convenienceFee;

/* if($serviceTiming=="-1"){
  array_push($errors, "Please select timing");
}else if(empty($serviceTiming)){
  array_push($errors, "Please select timing");
} */
$serviceAt='';
/* if($serviceAt=="-1"){
  array_push($errors, "Please select service at");
} */
if(isset($_GET['service_name'])){

}

$name=mysqli_real_escape_string($db, $_POST['name']);
$email =mysqli_real_escape_string($db, $_POST['email']);
$contact=mysqli_real_escape_string($db, $_POST['contact']);  
$message = mysqli_real_escape_string($db, $_POST['message']); 
$paymentType = mysqli_real_escape_string($db, $_POST['paymentType']); 
//echo 's:'.$services.'::n: '.$name.' :e: '.$email.': c: '.$contact.': m: '.$message;
if (empty($cust_addr)) { array_push($errors, "Please select address. if address not added add new"); }
if (empty($name)) { array_push($errors, "Please enter  name"); }
if (empty($serviceDate)) { array_push($errors, "Please enter date"); } 
if (empty($email)) { array_push($errors, "Please enter email"); }
if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
//if (empty($message)) { array_push($errors, "Please enter message"); } 


if(isset($_SESSION['username'])){
  $userid=$_SESSION['username'];
  $cart_count_query1="select * from cart where user_id='$userid'";
}else{
  $cart_count_query1="select * from cart where session_id='$session_ids'";
}

//$cart_count_query="select * from cart where user_id='$userid' and session_id='$session_ids'";
$results1 = mysqli_query($db, $cart_count_query1); 
unset($_SESSION['cartItems']);
if (mysqli_num_rows($results1) >0) {

while($item = mysqli_fetch_assoc($results1)){
  $cart_id=$item['cart_id'];
  $itemArray=array($cart_id=>array('cart_id'=>$item['cart_id'],'service_id'=>$item['service_id'],'session_id'=>$item['session_id'],'quantity'=>$item['quantity'],'amount'=>$item['amount'],'offers'=>$item['offersOrDiscount']));

  if(!empty($_SESSION["cartItems"])) { 
          $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"],$itemArray);
      }
   else {
      $_SESSION["cartItems"] = $itemArray;
  } 
 
}
$jsonCart = json_encode($_SESSION["cartItems"]);
}

$services=$jsonCart;
$paymentMode=$paymentType;
$bookingStatus='pending';
$paymentStatus='pending';
$reason='';
$session_ids=session_id();
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s'); 
$isassigned='false';
$canceled_order_by_admin='false';
$canceled_order_by_customer='false';
$isreschedule="false";
if (count($errors) == 0) {
    $stmt = $db->prepare("INSERT INTO book_appointment(name,email,contact,service_name,serviceDate,serviceTiming,serviceAt,message,amount,paymentMode,bookingStatus,reason,service_id,partners_admin_id,date,customer_address,cust_address_id,session_id,paymentStatus,cust_username,cust_id,isassigned,canceled_order_by_admin,canceled_order_by_customer,isreschedule,convenienceFee) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $rc=$stmt->bind_param("ssssssssssssssssssssssssss", $name, $email, $contact,$services,$serviceDate,$serviceTiming,$serviceAt,$message,$amount,$paymentMode,$bookingStatus,$reason,$service_id,$partnersAID,$date,$customer_address,$cust_address_id,$session_ids,$paymentStatus,$username,$cust_id,$isassigned,$canceled_order_by_admin,$canceled_order_by_customer,$isreschedule,$convenienceFee);
    $rc=$stmt->execute();
   if ( false===$rc ) {
    die('execute() failed: ' . htmlspecialchars($stmt->error)); 
  } else{

 
 
 //array_push($successMsg,"Appointment booked successfully we will contact you soon!!");
 $company_name;
$spaContact;
$services_name_query1 = "select * from partners_registration where partners_id='$partnersAID' limit 1";
      $services_names1 = mysqli_query($db, $services_name_query1);
      $codes = mysqli_fetch_assoc($services_names1);
      
      if ($codes) { // if user exists
        
       $company_name= $codes['company_name'];
       $spaContact=$codes['contact'];
      }
      //bookAppointmentEmail($name,$email,$contact,$company_name,$spaContact,$service_name,$serviceTiming,$amount,$email);
      $amount="";
      $services="";
      $name="";
      $email="";
      $contact="";
      $message="";
      $serviceTiming=""; 
 
        $services_query1 = "select * from book_appointment where session_id='$session_ids' and service_id='$service_id' and partners_admin_id='$partnersAID' order by id desc";
        $services_names1 = mysqli_query($db, $services_query1);
        $codes = mysqli_fetch_assoc($services_names1);
        $id='';
        if ($codes) { // if user exists
          
        $id= $codes['id'];
        
        }
        //$p_url="gateway/pay.php?o_id=".$id;
        //echo "window.location.assign('gateway/pay.php?o_id=".$id."')";
        echo "<script> window.location.assign('gateway/pay.php?o_id=".$id."&session_id=".$session_ids."'); </script>";
      
    }  
}
}


function bookAppointmentEmail($name,$email,$contact,$company_name,$spaContact,$service_name,$serviceTiming,$amount,$emailTo){
  // Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


  

$to = $emailTo;
$subject = "Your Appointment Booked Successfully with SPA Home Services";


$message = "
         <html>
           <head>
           <title>Appointment Booked Succesfully</title>
           </head>
           <body>  
             <table style='width:100%;'> 
            
              <tr>
                 <td colspan='2'>Dear <b>".$name."</b>,</td> 
               </tr> 
                <tr>
                  <td colspan='2'> 
                      <h4>Your Booking Details</h4>
                  </td> 
                </tr> 
                <tr>
                  <td> 
                      Your Email:
                  </td> 
                  <td><b>".$email."</b></td>
                </tr>
                <tr>
                <td> 
                    Your Contact Number:
                </td> 
                <td><b>".$contact."</b></td>
              </tr> 
              <tr>
                <td>Spa Name: </td> 
                <td><b>".$company_name."</b></td>
               </tr>
              <tr>
              <tr>
                <td>Spa Contact Number: </td> 
                <td><b>".$spaContact."</b></td>
               </tr>
              <tr>
                <td>Service Name: </td> 
                <td><b>".$service_name."</b></td>
               </tr>
               <tr>
               <td>Service Timing: </td> 
               <td><b>".$serviceTiming."</b></td>
              </tr>
              <tr>
              <td>Amount: </td> 
              <td><b>".$amount."</b></td>
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

<style>
  .table td{
        /* vertical-align: middle; */
        border-top: none;
        padding:10px 5px;
    }
    .table td p{
        padding-bottom:0;
        margin-bottom: 0rem;
        line-height: 16px;
    font-size: 13px;
    }
    .ui-datepicker{
      width: 300px !important;
      background-color: #fff;
    }
    .ui-datepicker .ui-datepicker-calendar{
      width:100% !important;
    }
    .ui-corner-all{
      border-bottom-right-radius: 0px;
      border-bottom-left-radius:0px;
    }
    .ui-datepicker-calendar thead tr th{
      text-align:center;
      border:1px solid #c1c1c1;
    }
    .ui-datepicker-calendar tr td{
      text-align:center;
      border:1px solid #c1c1c1;
    }
    .ui-datepicker-unselectable.ui-state-disabled{
      background-color:#c5dbec;
    } 
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: none;
    background: transparent;
    font-weight: 500;
    color: #000;
  }
  .ui-datepicker .ui-datepicker-calendar td:not(.ui-state-disabled){
    background-color:#2e6e9e;
    color:#fff !important;
  }
  .ui-datepicker .ui-datepicker-today{
    background-color:#ea728c !important;
  }
  .ui-datepicker .ui-datepicker-prev,.ui-datepicker .ui-datepicker-next{
    display:none !important;
  }
  .ui-datepicker-header{
    text-align: center;
    padding: 5px;
  }
  .error{
    color:red;
    font-size: 13px;
  }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="site-blocks-cover overlay" style="background-image: url(images/sliders/book.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                           <!--  <h1 data-aos="fade-up" class="mb-5">Book Appointment</h1> --> 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mb-5 aos-init aos-animate" data-aos="fade"> 
            <form action="book-appointment.php?service_id=<?php echo $_GET['service_id']?>" class="p-3 bg-white"  method="post"> 
            <h2 class="h1">Book Appointment</h2>
            <div style="margin-top:1rem;color:red;">
                                <?php  include 'errors.php' ?>
                            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php' ?>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
               <!--    <label class="text-black" for="name">Service Name</label> -->
                  <input type="hidden" id="service_id" name="service_id" class="form-control" value="<?php echo $_GET['service_id']?>">
                 

                  <input type="hidden" id="partnersAID" name="partnersAID" class="form-control" value="<?php echo $partners_admin_id;?>">
                 <!--   <input type="text" id="services" name="services" class="form-control" value="<?php if(isset($_SESSION['cartItems'])){ print_r( $_SESSION['cartItems']) ;}?>" readonly>  -->
                 <!--  <textarea name="services" id="services" rows="4" class="form-control" readonly><?php echo $service_name?></textarea> -->
                 <input type="hidden" name="services" id="services" >
                </div> 
              </div>
              <div class="row form-group">
               <!--  <div class="col-md-6">
                  <label class="text-black" for="name">Amount</label>
                  
                  <input type="text" id="amount" name="amount" class="form-control" value="<?php echo  $_GET['amount']?>" readonly>
                </div>  -->
                <div class="col-md-12"> 
                  
                  <input style="display:none" type="hidden" id="amount" name="amount" class="form-control" value="<?php echo $cart_total?>" readonly>
                  <label class="text-black" for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" oninput="validate(event)" value="<?php echo $cust_name;?>" oninput="validate(event)">
                  <span id="name_error" class="errors"></span>
                </div>
              </div>
 
              <div class="row form-group">
                
                <div class="col-md-6">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" class="form-control" oninput="validate(event)" value="<?php echo $cust_email;?>" oninput="validate(event)">
                  <span id="email_error" class="errors"></span>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" oninput="validate(event)" class="form-control" oninput="validate(event)" value="<?php  echo $cust_contact;?>" maxlength="10">
                  <span id="contact_error" class="errors"></span>
                </div>
              </div>

              <!-- <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" class="form-control" value="<?php  echo $cust_contact;?>">
                </div>
              </div>  -->
              <div class="row form-group"> 
                <div class="col-md-6">
                  <label class="text-black" for="serviceDate">Service Date</label> 
                  <input type="text"  id="date_picker" oninput="validate(event)" name="serviceDate" oninput="validate(event)" class="form-control" >
                 <!--  <input type="date" id="tbDate" class="datepicker" value="" /> -->
                 <span id="date_picker_error" class="errors"></span>
                </div>
                <div class="col-md-6">
                  
                  <label class="text-black" for="timing">Timing</label> 
                   <select name="timing" id="timing" class="form-control">
                     <option class="form-control" value="-1">----Select Timing----</option>
                     <option class="form-control" value="08:30">08:00AM-08:30AM</option>
                     <option class="form-control" value="09:00">08:30AM-09:00AM</option>
                     <option class="form-control" value="09:30">09:00AM-09:30AM</option>
                     <option class="form-control" value="10.00">09:30AM-10.00AM</option>
                     <option class="form-control" value="10:30">10:00AM-10:30AM</option>
                     <option class="form-control" value="11.00">10:30AM-11.00AM</option>
                     <option class="form-control" value="11:30">11:00AM-11:30AM</option>
                     <option class="form-control" value="12:00">11:30AM-12.00PM</option>
                     <option class="form-control" value="12:30">12:00PM-12:30PM</option>
                     <option class="form-control" value="13:00">12:30PM-01:00PM</option>
                     <option class="form-control" value="13:30">01:00PM-01:30PM</option>
                     <option class="form-control" value="14:00">01:30PM-02:00PM</option>
                     <option class="form-control" value="14:30">02:00PM-02:30PM</option>
                     <option class="form-control" value="15:00">02:30PM-03:00PM</option>
                     <option class="form-control" value="15:30">03:00PM-03:30PM</option>
                     <option class="form-control" value="16:00">03:30PM-04:00PM</option>
                     <option class="form-control" value="16:30">04:00PM-04:30PM</option>
                     <option class="form-control" value="17:00">04:30PM-05:00PM</option>
                     <option class="form-control" value="17:30">05:00PM-05:30PM</option>
                     <option class="form-control" value="18:00">05:30PM-06:00PM</option> 
                     <option class="form-control" value="18:30">06:00PM-06:30PM</option>
                     <option class="form-control" value="19:00">06:30PM-07:00PM</option> 
                     <option class="form-control" value="19:30">07:00PM-07:30PM</option> 
                     
                   </select>
                </div>
              </div> 
 
            <!--   <div class="row form-group"> 
                <div class="col-md-12">
                  <label class="text-black" for="serviceAt">Select Address</label> 
                  <select name="cust_addr" id="cust_addr" class="form-control" >
                  <option class="form-control" value="-1">--- Select Address ---</option>
                     <?php  
                      $address_query = "select * from cust_address where cust_username='$username' order by address_id desc"; 
                      $results = mysqli_query($db, $address_query); 
                      $numRows=mysqli_num_rows($results);
                      if (mysqli_num_rows($results) >0) { 
                        //echo '<select name="cust_addr" id="cust_addr" class="form-control" >';
                          while($row = mysqli_fetch_row($results)){
                              $address='';

                          if($row[2]!=''){
                              $address=$row[2];
                          }if($row[3]!='' || $row[3]!=null){
                              $address=$address.", ".$row[3];
                          }
                          if($row[4]!='' || $row[4]!=null){
                              $address=$address.", ".$row[4];
                          }
                          if($row[5]!='' || $row[5]!=null){
                              $address=$address.", ".$row[5];
                          }
                          $address=$row[1].", ".$address.", ".$row[9]." - ".$row[8];

                          $addressValue=$row[0]."#".$address; 
                              echo ' 
                                    <option class="form-control" value="'.$addressValue.'"> '.$address.'</option>';
                          }
                        //echo ' </select>';
                      }
                     ?>
                 </select>
                  <?php
                  
                  if($numRows==0){
                     
                      echo '<div class="card pd10">No address found. <br> <a href="addresses.php?add=true" >+ Add New Address</a></div>';
                    
                  }
                  ?>
                </div>
              </div> -->

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" rows="3" class="form-control" placeholder="Write your notes or questions here..." value="<?php if(isset($_POST['message'])) {echo $message;}?>"></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 ">
                  <div class="card box pd10">
                    <h3 class="paymentTypeHead">Select Address</h3>
                    <div class="card box pd10">
                    <div class="col-md-12 px-0">
                      <label class="text-black" for="serviceAt">Select Address</label> 
                      <select name="cust_addr" id="cust_addr" class="form-control" >
                      <option class="form-control" value="-1">--- Select Address ---</option>
                     <?php  
                      $address_query = "select * from cust_address where cust_username='$username' order by address_id desc"; 
                      $results = mysqli_query($db, $address_query); 
                      $numRows=mysqli_num_rows($results);
                      if (mysqli_num_rows($results) >0) { 
                        //echo '<select name="cust_addr" id="cust_addr" class="form-control" >';
                          while($row = mysqli_fetch_row($results)){
                              $address='';

                          if($row[2]!=''){
                              $address=$row[2];
                          }if($row[3]!='' || $row[3]!=null){
                              $address=$address.", ".$row[3];
                          }
                          if($row[4]!='' || $row[4]!=null){
                              $address=$address.", ".$row[4];
                          }
                          if($row[5]!='' || $row[5]!=null){
                              $address=$address.", ".$row[5];
                          }
                          $address=$row[1].", ".$address.", ".$row[9]." - ".$row[8];

                          $addressValue=$row[0]."#".$address; 
                              echo ' 
                                    <option class="form-control" value="'.$addressValue.'"> '.$address.'</option>';
                          }
                        //echo ' </select>';
                      }
                     ?>
                 </select>
                 <div class="pt-2">
                   <a href="addresses.php?add=true" >+ Add New Address</a>
                
                </div>
                  <?php
                  
                  if($numRows==0){
                     
                      echo '<div class="card pd10">No address found. <br> <a href="addresses.php?add=true" >+ Add New Address</a></div>';
                    
                  }
                  ?>
                </div>
                    </div> 
                  </div> 
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 ">
                  <div class="card box pd10">
                    <h3 class="paymentTypeHead">Select Payment Method</h3>
                    <div class="card box pd10">
                       <div class="form-check">
                          <input class="form-check-input" type="radio" name="paymentType" value="Online" id="flexRadioDefault2" checked>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Online Payment
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="paymentType" id="flexRadioDefault1" value="Cash On Service">
                          <label class="form-check-label" for="flexRadioDefault1">
                            Cash on Service
                          </label>
                        </div>
                       <div class="paymentCards mt-3">
                         <span>All Card Accepted </span> <span><img src="images/cards/visa.png" alt="Visa" srcset=""></span><span><img src="images/cards/mastercard.png" alt="Mastercard" srcset=""></span><span><img src="images/cards/rupay.png" alt="Rupay" srcset=""></span>
                        </div>
                    </div> 
                  </div> 
                </div>
              </div>
            
               <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" id="submitPayNow"  name="submit" value="Book Now" class="btn btn-pil btn-primary btn-md text-white btnSubmit btnblack w-50">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-4 aos-init aos-animate bg-white" data-aos="fade" data-aos-delay="100"> 
            <div style="border-bottom:1px solid #f1f1f1;">
              <h5 class="my-3">Summary</h5>
            </div>
          <table class="table" cellpadding="10" cellspacing="1">
                            <tbody> 
                                <?php		 
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    $userid='';
                                    $offer=0;
                                    if(isset($_SESSION['username'])){
                                      $userid=$_SESSION['username'];
                                      $cart_count_query="select * from cart where user_id='$userid'";
                                  }else{
                                      $cart_count_query="select * from cart where session_id='$session_ids'";
                                  }
                                    $cart_count=0;
                                    $totalDiscount=0;
                                    //$cart_count_query="select * from cart where user_id='$userid' and session_id='$session_ids'";
                                    $results = mysqli_query($db, $cart_count_query); 
                                    unset($_SESSION['cartItems']);
                                    if (mysqli_num_rows($results) >0) {
                                    
                                    while($item = mysqli_fetch_assoc($results)){
                                      $cart_id=$item['cart_id'];
                                      $itemArray=array($cart_id=>array('cart_id'=>$item['cart_id'],'service_id'=>$item['service_id'],'session_id'=>$item['session_id'],'quantity'=>$item['quantity'],'amount'=>$item['amount'],'offers'=>$item['offersOrDiscount']));

                                      if(!empty($_SESSION["cartItems"])) { 
                                              $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"],$itemArray);
                                          }
                                       else {
                                          $_SESSION["cartItems"] = $itemArray;
                                      } 
                                      //$json = json_encode($_SESSION["cartItems"]);
                                     
                                        $item_price = $item["quantity"]*$item["amount"]; 
                                        $offer=$item["offersOrDiscount"];
                                        if($offer=='' || $offer==0){
                                            $offer='';
                                            $item_price= $item_price;
                                        }else{
                                            $totalDiscount=$totalDiscount+(($item_price*$offer)/100);
                                            $item_price=$item_price-(($item_price*$offer)/100);
                                            $offer=$offer.'% Off';
                                        }

                                        $imgHtml=''; 
                                        if($item["services_image"]!=""){
                                            if(strpos($item["services_image"],",")>-1){
                                                $imgs=explode(',',$item["services_image"]);  
                                                $imgHtml.='<img src="'.$baseurl.'/'.'services_img/'.$imgs[1].'" alt="'.$item["services_name"].'" id="img1" class="cart-item-image" height="60" width="60"/>';      
                                                
                                            }
                                            else{
                                                $imgHtml='<img src="'.$baseurl.'/'.$item["services_image"].'" alt="'.$item["services_name"].'" class="cart-item-image" height="60" width="60" >';
                                                
                                            }
                                            
                                        }
                                        
                                ?>
                                <tr style="border-bottom:1px solid #f1f1f1;">
                                    <td> <?php echo $imgHtml ?></td>
                                    <td>
                                        <p class="sName"><?php echo $item["services_name"]; ?></p> 
                                        <p class="qty">Qty: <?php echo $item["quantity"]; ?></p>
                                    </td> 
                                    <td style="text-align:right;"> <p> <?php echo "<i class='fa fa-rupee'></i> ". number_format($item_price,2).' <span class="theme-color">'.$offer ?></span></p></td>
                                    
                                </tr>
                                <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["amount"]*$item["quantity"]);
                                }
                              }
                                ?> 
                            </tbody>
                        </table>
                        <table class="table">
                            <tr>
                                <td class="pl-0">Subtotal:</td>
                                <td class="float-right"> <strong><?php echo "<i class='fa fa-rupee'></i>".number_format($total_price, 2); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="pl-0">Discount:</td>
                                <td class="float-right theme-color"> <strong><?php echo "-<i class='fa fa-rupee'></i>".number_format($totalDiscount, 2); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="pl-0">Convenience Fee:</td>
                                <td class="float-right theme-color"> <strong><?php echo "<i class='fa fa-rupee'></i>" ?>
                                <?php
                                $convenienceFee=0; 
                                 $totalAmt=$total_price-$totalDiscount;
                                 if($totalAmt>299 && $totalAmt<1500){
                                     $convenienceFee=($totalAmt*5)/100;
                                 }
                                else if($totalAmt>1499 && $totalAmt<2500){
                                    $convenienceFee=($totalAmt*4)/100;
                                }
                                else if($totalAmt>2499 && $totalAmt<3500){
                                    $convenienceFee=($totalAmt*3)/100;
                                }
                                else if($totalAmt>3499 && $totalAmt<10000){
                                    $convenienceFee=($totalAmt*2.8)/100;
                                }
                                $convenienceFee=round($convenienceFee);
                                echo number_format($convenienceFee,2);
                                ?>
                              
                              
                              </strong></td>
                            </tr>
                            <tr class="py-4" style="border-top:1px dashed #c1c1c1;border-bottom:1px dashed #c1c1c1; font-size: 18px;">
                                <td class="pl-0">Estimated Total:</td>
                                <td class="float-right"> <strong><?php echo "<i class='fa fa-rupee'></i>".number_format(($total_price-$totalDiscount+$convenienceFee), 2); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                               
                               
                                </td>
                            </tr>
                        </table>

          </div>
        </div>
      </div>
    </div>
  
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

         var dd1=parseInt(dd)+5;

        today = yyyy + '-' + mm + '-' + dd;
        week = yyyy + '-' + mm + '-' + dd1;
                              
        todayDate = dd+'-'+mm+'-'+yyyy;
        
    /*    $('#date_picker').attr('min',today);
       $('#date_picker').attr('max',week); */
 
      /*  $('#date_picker').datepicker({
          format: 'yyyy-mm-dd',  
      }) */
      
       // $('#date_picker').datepicker({ 
      // minDate: 0,
      // maxDate: "3",
      // dateFormat: "dd-mm-yy",
      // showOtherMonths: true,
      // onClose: function(){
      //     getDate($(this).val());
      // }
      // });
      
       $('#date_picker').datepicker({ 
        minDate: 0,
        maxDate:30,
        changeMonth: true,
        stepMonths: 0, 
        dateFormat: "dd-mm-yy",
        firstDay: 1,
        showOtherMonths: true,
      onClose: function(){
          getDate($(this).val());
      }
      }).datepicker();

      function getDate(tdate){
       // console.log("ev",tdate);
       // console.log("text",todayDate,week)
        if(todayDate==tdate){
         // console.log("if"); 
          var hour = new Date().getHours();
          var min = new Date().getMinutes()
          //console.log("t",hour,min);
          $("#timing option").each(function() {
            var data=$(this).val();
            //console.log()
            var h=data.split(':')[0];
            //console.log("date",data) 
            if ((hour+1.5)>h){
              //console.log(hour,"h",h);
              // console.log("a",$(this));
              $(this).prop("disabled", true);
              $('#timing').removeAttr('disabled').find('option:first');;
              $('#timing').val('-1');
            } 
          });
          
        }else{
          //console.log("elsss");
          
           // $('#timing').removeAttr('selected').find('option:first').attr('selected', 'selected');
            $("#timing option").each(function() {
              $(this).removeAttr('disabled');
              $('#timing').removeAttr('disabled').find('option:first');;
              $('#timing').val('-1');
            });
             
           
        }
      }
  
    </script>

    <script language="javascript">
    /*     var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

         var dd1=parseInt(dd)+5;

        today = yyyy + '-' + mm + '-' + dd;
        week = yyyy + '-' + mm + '-' + dd1;
        console.log("text")
       $('#date_picker').attr('min',today);
       $('#date_picker').attr('max',week); */

/* 
        var hour = new Date().getHours();
        var min = new Date().getMinutes();
       $(document).ready(function(){
        
        console.log("t",hour,min);
        $("#timing option").each(function() {
          var data=$(this).val();
          //console.log()
          var h=data.split(':')[0];
          console.log("date",data) 
          if (hour>h){
            console.log(hour,"h",h);
         // console.log("a",$(this));
          $(this).prop("disabled", true);
          }
          

        });
       }) */

    </script>
    <!-- <script>
    var hour = new Date().getHours();
        var min = new Date().getMinutes();
    (function(){
        var time=hour+':'+min;
        var userTime = time;
        console.log("usertime",userTime);
        var stt = new Date("Jul 11, 2022 " + userTime);
            stt = stt.getTime();

        var a1 = moment(stt);

        if (a1.diff()<0){
          alert("Time is passed already!")
        }else {
          alert("You still have time!")
        }
      })();
    </script> -->

    <script>
     var flag;
    var flag2;
    var submitBtn=document.getElementById('submitPayNow');
    function validate(event){ 
      var target=event.target; 
      var text;
      if(target.id=="name"){
        console.log("isNaN(target.value)",!isNaN(target.value),target.value.length)
        if(target.value.length==0 || target.value.trim()=="") {
          text = "Please enter name";
          name_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          name_error.innerHTML = "";
          target.style.border= "1px solid #ced4da";
          flag=true;
        }
      }
      if(target.id=="email"){
        var email=target.value;
        if(target.value=="" || target.value.trim()==""){
          text = "Please enter email";
          email_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          var regex="[a-zA-Z0-9._+-]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z]{2,}";
          if(email.match(regex)){
            email_error.innerHTML = "";
            target.style.border="1px solid #ced4da";
            flag=true;
          }else{
            text = "Please enter valid email";
            email_error.innerHTML = text;
            target.style.border="1px solid red";
           //return false;
           flag=false;
          }
        }
      }
      if(target.id=="contact"){
        var contact=target.value;
        if(contact=="" || contact.trim()==""){
          text = "Please enter contact number";
          contact_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else if(isNaN(contact) || contact.length != 10){
          text = "Please enter valid number";
          contact_error.innerHTML = text;
          target.style.border="1px solid red";
          flag=false;
        } 
        else{
          contact_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }
      
      if(target.id=="date_picker"){
        var datePicker=target.value;
        if(datePicker=="" || datePicker.trim()==""){
          text = "Please select date";
          date_picker_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          date_picker_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }
      
      
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