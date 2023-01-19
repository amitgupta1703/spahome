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
<style>
    .s {
        border-top: 1px solid #c3c3c3;
        border-width: thin;
        width: 30%;
    }

    .cart-item-image {
        height: 70px;
        width: 80px;
        border: 1px solid #c1c1c1;
    }
    .table td{
        vertical-align: top;
        border-top: none;
    }
    .review td{
        padding:5px 10px;
    }
    .qty{
        width:60px; 
        text-align:left;
    }
    .sName{
        font-weight:500;
        margin-bottom: 0;
        line-height: 1rem;
        font-size: 14px;
    }
     
</style>
<div class="site-section bg-light mt-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col -md-8 card box">
                <div class=" pd10">
                    <h3 class="paymentTypeHead text-center">Review and Place Order</h3>
                    <div class="card box pd10">
                        <table class="review table" width="100%">
                         

                            <tr>
                                <td>Customer Name: </td>
                                <td><?php echo $name;?></td>
                            </tr>

                            <tr>
                                <td>Customer Email: </td>
                                <td><?php echo $email;?></td>
                            </tr>
                            <tr>
                                <td>Customer Mobile Number: </td>
                                <td><?php echo $contact;?></td>
                            </tr>
                            <tr>
                                <td>Customer Address: </td>
                                <td><?php echo $customer_address;?></td>
                            </tr>
                            <tr>
                                <td>Service Date:</td>
                                <td><?php echo $servicesDetails['serviceDate']?></td>
                            </tr>
                            <tr>
                                <td>Service Timing:</td>
                                <td><?php echo $servicesDetails['serviceTiming']?></td>
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
                "description"       => "Spa Home Services",
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

                <div class="ml-2">
                    <form class="text-center" action="verify.php" method="POST">
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key']?>"
                            data-amount="<?php echo $data['amount']?>" data-currency="INR"
                            data-name="<?php echo $data['name']?>" data-image="<?php echo $data['image']?>"
                            data-description="<?php echo $data['description']?>"
                            data-prefill.name="<?php echo $data['prefill']['name']?>"
                            data-prefill.email="<?php echo $data['prefill']['email']?>"
                            data-prefill.contact="<?php echo $data['prefill']['contact']?>"
                            data-notes.shopping_order_id="<?php echo $orderId?>"
                            data-order_id="<?php echo $data['order_id']?>" <?php if ($displayCurrency !== 'INR') { ?>
                            data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
                            <?php if ($displayCurrency !== 'INR') { ?>
                            data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>>
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
                <form class="text-center" action="verify.php" method="post">
                    <div class="text-center py-4">
                        <input type="submit" class="btn btn-pil btn-primary btn-md text-white btnSubmit"
                            style="width:50%" name="cod" value="Place Order">
                    </div>

                </form>

                <?php  }?>
            </div>
            <div class="col-md-4 aos-init aos-animate bg-white" data-aos="fade" data-aos-delay="100"> 
            <div style="border-bottom:1px solid #f1f1f1;">
              <h5 class="my-3">Summary</h5>
            </div>
          <table class="table" cellpadding="10" cellspacing="1">
                            <tbody>
                               <!--  <tr>
                                    <th style="text-align:left;">Name</th>
                                    <th style="text-align:right;">Quantity</th>
                                    <th style="text-align:right;">Unit Price</th>
                                    <th style="text-align:right;">Price</th>
                                    <th style="text-align:center;">Remove</th>
                                </tr> -->
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
                                    <td><?php echo $imgHtml?></td>
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
                                <td class="float-right theme-color"> <strong><?php echo "<i class='fa fa-rupee'></i>" ?>0</strong></td>
                            </tr>
                            <tr class="py-4" style="border-top:1px dashed #c1c1c1;border-bottom:1px dashed #c1c1c1; font-size: 18px;">
                                <td class="pl-0">Estimated Total:</td>
                                <td class="float-right"> <strong><?php echo "<i class='fa fa-rupee'></i>".number_format(($total_price-$totalDiscount), 2); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                               
                               
                                </td>
                            </tr>
                        </table>

          </div>
        </div>
    </div>
    <script>
        var btn = document.querySelector('.razorpay-payment-button');
        btn.setAttribute("class", "btn btn-pil btn-primary btn-md text-white btnSubmit");
        btn.setAttribute("style", "width:50%");
        btn.setAttribute("value", "Place Order");
    </script>
</div>
<?php 
include '../footer.php';
?>
