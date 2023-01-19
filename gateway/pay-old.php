<?php
$title="Pay Now";
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
//session_start();
include '../header.php'; 
include '../config.php';
//echo session_id();
$username=$_SESSION['username'];
$id='';
$name='';
$email='';
$contact='';
$service_name='';
$amount=0;
$customer_address='';
$paymentMode='';
if(isset($_SESSION['username']) && isset($_GET['o_id']) && isset($_GET['session_id'])){
    $session_ids=$_GET['session_id'];
    $o_id=$_GET['o_id'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s'); 
    $bookingStatus='Pending';
    $paymentStatus='Pending';

    $orderId='';
  /*   $getTotalRow = "select count(*) total from orders_details";
    $getTotalRowQ = mysqli_query($db, $getTotalRow);
    $servicesDetailRows = mysqli_fetch_assoc($getTotalRowQ);
    if ($servicesDetailRows) { 
        //echo "uuuuu: ".$servicesDetailRows['total'];
        $orderId=(int)$servicesDetailRows['total']+1000;
    } */
    //echo  "ordere :: ".$orderId;

    $stmt = $db->prepare("INSERT INTO orders_details(booking_id,session_id,date,bookingStatus,paymentStatus) VALUES(?,?,?,?,?)");
    $rc=$stmt->bind_param("sssss", $o_id, $session_ids, $date,$bookingStatus,$paymentStatus);
    $rc=$stmt->execute();
   
    if ( false===$rc ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
      } else{
        $orderId=mysqli_insert_id($db); 
        $getService = "select * from book_appointment where session_id='$session_ids' and id='$o_id' limit 1";
        $services = mysqli_query($db, $getService);
        $servicesDetails = mysqli_fetch_assoc($services); 
        if ($servicesDetails) { // if user exists 
        $id= $servicesDetails['id'];
        $name=$servicesDetails['name'];
        $email=$servicesDetails['email'];
        $contact=$servicesDetails['contact'];
        $service_name=$servicesDetails['service_name'];
        $amount=(int)$servicesDetails['amount'];
        $customer_address=$servicesDetails['customer_address'];
        $paymentMode=$servicesDetails['paymentMode']; 

        }
      } 
} 
?>
<div class="site-section bg-light">
<div class="container">
<div class="row mt-5">
    <div class="col-md-8 offset-md-2 card box">
        <div class=" pd10">
        <h3 class="paymentTypeHead text-center">Checkout</h3>
            <div class="card box pd10">
            <table class="table" width="100%">
                <tr>
                    <td style="width:40%;">Service Description </td>
                    <td><?php echo $service_name;?></td>
                </tr>

                 <tr>
                    <td>Amount </td>
                    <td><?php echo $amount;?></td>
                </tr>

                <tr>
                    <td>Customer Name </td>
                    <td><?php echo $name;?></td>
                </tr>

                <tr>
                    <td>Customer Email </td>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                    <td>Customer Mobile Number </td>
                    <td><?php echo $contact;?></td>
                </tr>
                <tr>
                    <td>Customer Address </td>
                    <td><?php echo $customer_address;?></td>
                </tr>
            </table>
            </div> 
        </div>
        <?php if($paymentMode=='Online'){
            

            $api = new Api($keyId, $keySecret);
            
            //
            // We create an razorpay order using orders api
            // Docs: https://docs.razorpay.com/docs/orders
            //
            $orderData = [
                'receipt'         => $orderId,
                'amount'          => $amount * 100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            
            $razorpayOrder = $api->order->create($orderData);
            
            $razorpayOrderId = $razorpayOrder['id'];
            
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            
            $displayAmount = $amount = $orderData['amount'];
            $_SESSION['bookingid']=$o_id;
            $_SESSION['orderid']=$orderId;
            $_SESSION['paymentMode']=$paymentMode;
            if ($displayCurrency !== 'INR')
            {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);
            
                $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }
            
            $checkout = 'automatic';
            
            $data = [
                "key"               => $keyId,
                "amount"            => $amount,
                "name"              => $name,
                "description"       => $service_name,
                "image"             => $baseurl."/images/logo.png",
                "prefill"           => [
                "name"              => $name,
                "email"             => $email,
                "contact"           => $contact,
                ],
                "notes"             => [
                "address"           => $customer_address,
                "merchant_order_id" => $orderId,
                ],
                "theme"             => [
                "color"             => "#F37254"
                ],
                "order_id"          => $razorpayOrderId,
            ];
            
            if ($displayCurrency !== 'INR')
            {
                $data['display_currency']  = $displayCurrency;
                $data['display_amount']    = $displayAmount;
            }
            
            $json = json_encode($data);
            //echo $json;
            //include '../header.php';
            ?>
        
        <div class="text-center mb-5">
        <form action="verify.php" method="POST">
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $data['key']?>"
            data-amount="<?php echo $data['amount']?>"
            data-currency="INR"
            data-name="<?php echo $data['name']?>"
            data-image="<?php echo $data['image']?>"
            data-description="<?php echo $data['description']?>"
            data-prefill.name="<?php echo $data['prefill']['name']?>"
            data-prefill.email="<?php echo $data['prefill']['email']?>"
            data-prefill.contact="<?php echo $data['prefill']['contact']?>"
            data-notes.shopping_order_id="<?php echo $orderId?>"
            data-order_id="<?php echo $data['order_id']?>"
            <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
            <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
        >
        </script>
        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
        <input type="hidden" name="shopping_order_id" value="<?php echo $orderId?>">

        <!--input type="submit" value="submit"-->
        </form>
        </div>
  <?php   } else if($paymentMode=='Cash On Service'){
                $_SESSION['bookingid']=$o_id;
                $_SESSION['orderid']=$orderId;
                $_SESSION['paymentMode']=$paymentMode;
      ?>
      <form action="verify.php" method="post">
          <div class="text-center py-4">
          <input  type="submit" class="btn btn-pil btn-primary btn-md text-white btnSubmit" style="width:50%" name="cod" value="Pay Now">
          </div>
        
      </form>
      
      <?php  }?>
    </div>
</div>
</div>
<script>
var btn=document.querySelector('.razorpay-payment-button');
btn.setAttribute("class","btn btn-pil btn-primary btn-md text-white btnSubmit");
btn.setAttribute("style","width:50%");
</script>
</div>
<?php 
include '../footer.php';
?>
