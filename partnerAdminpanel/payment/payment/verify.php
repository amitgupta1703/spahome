<?php
$title="Pay Now";
include './../header.php';  
include './../top-nav.php'; 
require('config.php');

//session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
//session_start();

 
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
                         
                             
                        
<?php  
$success = true;
$totalAmount;
$oid;
$orderId;
$sessionid=$sessionid;
$error = "Payment Failed";
if(isset($_SESSION['totalAmount']) && isset($_SESSION['oid']) && isset($_SESSION['partner_id']) ){
    $totalAmount=$_SESSION['totalAmount'];
    $orderId=$_SESSION['oid'];


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
   
  $razorpay_payment_id= $_POST['razorpay_payment_id'];
  //$bookingStatus="payment capture";
  $paymentStatus="Payment Capture successfully";
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s'); 
  //echo "gateyggh :: ".$bookingStatus.', '.$razorpay_payment_id.', '.$orderid.', '.$bookingid;
  $stmt = $db->prepare("update spa_partners_leads set paymentStatus=?,paymentId=?,date=? where id=? and session_id=?");
  $rc=$stmt->bind_param("sssss", $paymentStatus,$razorpay_payment_id,$date,$orderId,$sessionid); 
  $rc=$stmt->execute();   

  

    if ( false===$rc ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
    } else{
        $lastId=mysqli_insert_id($db);
        $partner_id=$_SESSION['admin_UserId_partner'];
        $remiaing_leads;
        $getService = "select * from partners_registration where partners_id='$partner_id'";
        $services = mysqli_query($db, $getService);
        $servicesDetails = mysqli_fetch_assoc($services); 
        if ($servicesDetails) { // if user exists  
            $remiaing_leads=$servicesDetails['leads']; 
            if($remiaing_leads=='' || $remiaing_leads==null){
                $remiaing_leads=0;
            } else{
                $remiaing_leads=$remiaing_leads;
            }
        }
        
        $no_of_leads=0;
        $total_leads=0;
        //echo "id='".$orderId."' and partner_id='".$partner_id."' and paymentId='".razorpay_payment_id;
        $getLeadsPayment = "select * from spa_partners_leads where id='$orderId' and partner_id='$partner_id' and paymentId='$razorpay_payment_id' and paymentStatus='Payment Capture successfully'";
        $services1 = mysqli_query($db, $getLeadsPayment);
        $servicesDetails1 = mysqli_fetch_assoc($services1); 
        if ($servicesDetails1) { // if user exists  
            $no_of_leads=$servicesDetails1['no_of_leads'];  
           
        }
        
        $total_leads=(int)$remiaing_leads+(int)$no_of_leads;
        //echo "$no_of_leads ".$no_of_leads." ::: tot :: ".$total_leads;


        $stmt = $db->prepare("update partners_registration set leads=? where partners_id=?");
        $rc=$stmt->bind_param("ss", $total_leads,$partner_id); 
        $rc=$stmt->execute();   

       
       echo " <script>
            (function(){var leads=document.querySelector('.leads');if(leads){leads.innerHTML='Remianing Leads : {$total_leads}'}})();
        </script>";

        
        
       // echo "last id ::: ".$lastId;
        unset($_SESSION['totalAmount']);
        unset($_SESSION['oid']); 
         
    }

 
    $html = "<h4 class='text-center'>Your payment was successful</h4>
             <h2 class='text-center theme-color'>Thank You</h2>
             
                <table class='table'>
                    <tr><td>Payment ID:</td><td>{$_POST['razorpay_payment_id']}</td></tr>
                    <tr><td>Order ID:</td><td>{$orderId}</td></tr> 
                </table> ";
 
                echo $html;
}
else
{ 
  $bookingid=$_SESSION['bookingid'];
  $orderid=$_SESSION['orderid']; 
  //$bookingStatus="payment capture";
  $paymentStatus="Payment Failed";

  //echo "gateyggh :: ".$bookingStatus.', '.$razorpay_payment_id.', '.$orderid.', '.$bookingid;
  $stmt = $db->prepare("update spa_partners_leads set paymentStatus=?,paymentId=?,date=? where id=? and session_id=?");
  $rc=$stmt->bind_param("sssss", $paymentStatus,$razorpay_payment_id,$date,$orderId,$sessionid); 
  $rc=$stmt->execute();   

 

    if ( false===$rc ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error)); 
    } else{
        unset($_SESSION['totalAmount']);
        unset($_SESSION['oid']); 
    }

 
    $html = "<h4 class='text-center'>Your payment failed</h4> 
             <h3 class='text-center'>Please try again!</h3>";
    echo $html;
                
 
}
}else{
    echo '<script>(function(){window.location.href ="'.$baseurl.'/buy-leads.php"})();</script>';
}

?>
                        
                 
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      
 
<?php 
include '../footer.php';
?>


 