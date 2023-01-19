<?php
$title="Pay Now";
include './../header.php';  
include './../top-nav.php';
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
//session_start();

//echo session_id();
//$username=$_SESSION['username'];
$id='';
$name='';
$email='';
$contact='';
$service_name='';
$amount=0;
$customer_address='';
$paymentMode='';
$totalAmount;
$oid;
$orderId;
$leads=0;
if(isset($_SESSION['U_Name_partner']) && isset($_GET['skids']) && isset($_GET['session_id'])){
    $session_ids=$_GET['session_id'];
    $skids=$_GET['skids'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s'); 
    $bookingStatus='Pending';
    $paymentStatus='Pending';

   
    if(isset($_SESSION['totalAmount']) && isset($_SESSION['oid']) && isset($_SESSION['partner_id']) ){
        $totalAmount=$_SESSION['totalAmount'];
        $orderId=$_SESSION['oid'];
   
/*     $orderId='';  
    $getService = "select * from spa_partners_leads where id='$partner_id'";
    $services = mysqli_query($db, $getService);
    $servicesDetails = mysqli_fetch_assoc($services);  */

        //$orderId=mysqli_insert_id($db); 
        $partner_id=$_SESSION['partner_id'];
        $getService = "select * from partners_registration where partners_id='$partner_id'";
        $services = mysqli_query($db, $getService);
        $servicesDetails = mysqli_fetch_assoc($services); 
        if ($servicesDetails) { // if user exists 
        //$id= $servicesDetails['id'];
        $name=$servicesDetails['name'];
        $email=$servicesDetails['email'];
        $contact=$servicesDetails['contact'];
        $leads=$servicesDetails['leads'];
        
        //$service_name=$servicesDetails['service_name'];
        $amount=(int)$totalAmount;
        $customer_address=$servicesDetails['location'].', '.$servicesDetails['city'].', '.$servicesDetails['state'];
        //$paymentMode=$servicesDetails['paymentMode']; 

        }
      
} 
else{
    echo '<script>(function(){window.location.href ="'.$baseurl.'/buy-leads.php"})();</script>';
}
}else{
    echo '<script>(function(){window.location.href ="'.$baseurl.'/buy-leads.php"})();</script>'; 
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
<!-- page content -->


<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payment</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Payment</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <h3 class="paymentTypeHead text-center">Review and Place Order</h3>
                         
                            <table class="table table-bordered"  width="50%">
                                <tr>
                                    <td>Number Of Leads</td>
                                    <td><?php echo $amount/177;?></td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td><i class="fa fa-rupee"></i> <?php echo number_format($amount,2);?></td>
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
                        
<?php
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
                "image"             => "../../images/logo.png",
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
                 
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <script>
        var btn = document.querySelector('.razorpay-payment-button');
        btn.setAttribute("class", "btn btn-pil btn-primary btn-md text-white btnSubmit");
        btn.setAttribute("style", "width:50%");
        btn.setAttribute("value", "Place Order");
    </script>
 
<?php 
include '../footer.php';
?>
