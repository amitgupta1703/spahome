<?php
$title="Thank You";
include '../header.php'; 
include '../config.php';
//echo session_id();
$username=$_SESSION['username'];
require('config.php');

//session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
$bookingid='';
$orderid='';
$date='';

?>

<div class="site-section bg-light mt-5">
<div class="container">
<div class="row">
    <div class="col-md-8 offset-md-2 card box mt-5">
        <div class=" pd10  ">
<?php
//echo "cod payment method sid: ".$_SESSION['bookingid'];
if(isset($_SESSION['paymentMode']) && $_SESSION['paymentMode']=='Online')
{
$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    //echo $_SESSION['bookingid'];
  $bookingid=$_SESSION['bookingid'];
  $orderid=$_SESSION['orderid'];
  $razorpay_payment_id= $_POST['razorpay_payment_id'];
  //$bookingStatus="payment capture";
  $paymentStatus="Payment Capture successfully";
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s'); 
  //echo "gateyggh :: ".$bookingStatus.', '.$razorpay_payment_id.', '.$orderid.', '.$bookingid;
  $stmt = $db->prepare("update orders_details set paymentStatus=?,gateway_paymentid=?,date=? where order_id=? and booking_id=?");
  $rc=$stmt->bind_param("sssss", $paymentStatus,$razorpay_payment_id,$date,$orderid,$bookingid); 
  $rc=$stmt->execute();   

  if ( false===$rc ) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
  } 
    $stmt = $db->prepare("update book_appointment set paymentStatus=?,orderId=? where id=?");
    $ba=$stmt->bind_param("sss", $paymentStatus,$orderid,$bookingid); 
    $ba=$stmt->execute(); 

    if ( false===$ba ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
    } else{
        unset($_SESSION['bookingid']);
        unset($_SESSION['orderid']);
        unset($_SESSION['paymentMode']);
        if(isset($_SESSION['cartItems'])){
            foreach($_SESSION['cartItems'] as $item){
                $cart_id=$item['cart_id'];{
                    $stmt = $db->prepare("delete from cart where cart_id=?");
                        $rc=$stmt->bind_param("s", $cart_id); 
                        $rc=$stmt->execute(); 
                }
            }
        }
        unset($_SESSION['cartItems']);
        if(isset($_SESSION['username'])){
            $userid=$_SESSION['username'];
            $cart_count_qu="select * from cart where user_id='$userid'";
        }else{
            $userid='Guest';
            $cart_count_qu="select * from cart where session_id='$session_ids'";
        }
        
        
        $cartcount=$dbControllers->numRows($cart_count_qu); 
        echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
    }

 
    $html = "<h4 class='text-center'>Your payment was successful</h4>
             <h2 class='text-center theme-color'>Thank You</h2>
             <h3 class='text-center'>Your Service Booked</h3>
                <table class='table'>
                    <tr><td>Payment ID:</td><td>{$_POST['razorpay_payment_id']}</td></tr>
                    <tr><td>Order ID:</td><td>{$orderid}</td></tr> 
                </table> ";

                //echo 'check session ::: '.$_SESSION['bookingid'].', s2:: '.$_SESSION['orderid'].', s3:: '.$_SESSION['paymentMode'];
                echo $html;
}
else
{
    //$html = "<p>Your payment failed</p>
            // <p>{$error}</p>";
         //    echo $html;

              //echo $_SESSION['bookingid'];
  $bookingid=$_SESSION['bookingid'];
  $orderid=$_SESSION['orderid']; 
  //$bookingStatus="payment capture";
  $paymentStatus="Payment Failed";

  //echo "gateyggh :: ".$bookingStatus.', '.$razorpay_payment_id.', '.$orderid.', '.$bookingid;
  $stmt = $db->prepare("update orders_details set paymentStatus=?,gateway_paymentid=? where order_id=? and booking_id=?");
  $rc=$stmt->bind_param("ssss", $paymentStatus,$razorpay_payment_id,$orderid,$bookingid); 
  $rc=$stmt->execute();   

  if ( false===$rc ) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
  } 
  $stmt = $db->prepare("update book_appointment set paymentStatus=?,orderId=? where id=?");
  $ba=$stmt->bind_param("sss", $paymentStatus,$orderid,$bookingid); 
    $ba=$stmt->execute(); 

    if ( false===$ba ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
    } else{
        unset($_SESSION['bookingid']);
        unset($_SESSION['orderid']);
        unset($_SESSION['paymentMode']);
        //unset($_SESSION['cartItems']);
    }

 
    $html = "<h4 class='text-center'>Your payment failed</h4>
             <h2 class='text-center theme-color'>Thank You</h2>
             <h3 class='text-center'>Your Service Not Booked</h3>";
    echo $html;
                
 
}
}
else if(isset($_SESSION['paymentMode']) && $_SESSION['paymentMode']=='Cash On Service'){
   // echo "cod ".$_SESSION['paymentMode'];
    //echo "cod payment method sid: ".$_SESSION['bookingid'];
    $bookingid=$_SESSION['bookingid'];
    $orderid=$_SESSION['orderid']; 
    $paymentStatus="Cash On Service Delivery";
    $cod_payment_id="COD Payment";
  
    //echo "gateyggh :: ".$bookingStatus.', '.$razorpay_payment_id.', '.$orderid.', '.$bookingid;
    $stmt = $db->prepare("update orders_details set paymentStatus=?,gateway_paymentid=? where order_id=? and booking_id=?");
    $rc=$stmt->bind_param("ssss", $paymentStatus,$cod_payment_id,$orderid,$bookingid); 
    $rc=$stmt->execute();   
  
    if ( false===$rc ) {
      die('execute() failed: ' . htmlspecialchars($stmt->error));
    } 
    $stmt = $db->prepare("update book_appointment set paymentStatus=?,orderId=? where id=?");
    $ba=$stmt->bind_param("sss", $paymentStatus,$orderid,$bookingid); 
    $ba=$stmt->execute(); 
    
    if ( false===$ba ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
        } else{
        unset($_SESSION['bookingid']);
        unset($_SESSION['orderid']);
        unset($_SESSION['paymentMode']);
        if(isset($_SESSION['cartItems'])){
            foreach($_SESSION['cartItems'] as $item){
                $cart_id=$item['cart_id'];{
                   // echo $cart_id;
                    $stmt = $db->prepare("delete from cart where cart_id=?");
                        $rc=$stmt->bind_param("s", $cart_id); 
                        $rc=$stmt->execute(); 
                }
            }
        }

        unset($_SESSION['cartItems']);
        if(isset($_SESSION['username'])){
            $userid=$_SESSION['username'];
            $cart_count_qu="select * from cart where user_id='$userid'";
        }else{
            $userid='Guest';
            $cart_count_qu="select * from cart where session_id='$session_ids'";
        }
        
        
        $cartcount=$dbControllers->numRows($cart_count_qu); 
        echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
        }
  
    $html = " 
    <h2 class='text-center theme-color'>Thank You</h2>
    <h3 class='text-center'>Your Service Booked</h3>
       <table class='table'> 
       <tr><td>Payment Type:</td><td>{$paymentStatus}</td></tr>
           <tr><td>Order ID:</td><td>{$orderid}</td></tr> 
       </table> ";


       echo $html;

      // echo 'check session ::: '.$_SESSION['bookingid'].', s2:: '.$_SESSION['orderid'].', s3:: '.$_SESSION['paymentMode'];
}
else{
   echo "dd: ".$baseurl;
    echo "<script> window.location.assign('".$baseurl."'); </script>";
}
?>
</div>
</div>
</div>
</div>
</div>
<?php 
include '../footer.php';
?>