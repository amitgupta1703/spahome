<?php include 'header.php'?>

<?php include 'top-nav.php';?>
<?php  
include 'dbwe.php';
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
if(isset($_POST['cancel_order'])){
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $admin_reason = mysqli_real_escape_string($db, $_POST['admin_reason']);  
    if(empty($admin_reason)){
        array_push($errors, "Enter Admin Reason");
    }
 
  
     $stmt = $db->prepare("select * from book_appointment where orderId=? and id=?  limit 1"); 
     $orderInTable;
     $stmt->bind_param("ss", $order_id,$booking_id);
     $stmt->execute();
     $result2 = $stmt->get_result();
      $datas2 = $result2->fetch_array(MYSQLI_ASSOC);
      if($datas2['orderId']==$order_id && $datas2['id']==$booking_id){
        $leads;
        $partner_id= $datas2['assign_partner_id'];
        if($partner_id!='' || $partner_id!=null){
            $stmt = $db->prepare("select * from partners_registration where partners_id=? limit 1");  
            $stmt->bind_param("s", $partner_id);
            $stmt->execute();
            $resultPartner1 = $stmt->get_result();
            $resultPartner1Data = $resultPartner1->fetch_array(MYSQLI_ASSOC);
           
            if($resultPartner1Data){
                $leads=$resultPartner1Data['leads']; 
            }
        }

       
     



         if (count($errors) == 0) {
             date_default_timezone_set('Asia/Kolkata');
             $date = date('Y-m-d H:i:s');
              $canceled_order_by_admin="true"; 
              $stmtCheck = $db->prepare("select * from spa_assign_lead where order_id=? and booking_id=?  limit 1");  
              $orderInTable;
              $stmtCheck->bind_param("ss", $order_id,$booking_id);
              $stmtCheck->execute();
              $resultSpaAssign = $stmtCheck->get_result();
              $resultSpaAssignDatas = $resultSpaAssign->fetch_array(MYSQLI_ASSOC);
              if($resultSpaAssignDatas['order_id']==$order_id && $resultSpaAssignDatas['booking_id']==$booking_id){
                 $stmt = $db->prepare("update spa_assign_lead set canceled_order_by_admin=?,canceled_datetime=? where order_id=? and booking_id=? ");
                 $rc1= $stmt->bind_param("ssss", $canceled_order_by_admin,$date,$order_id,$booking_id);
                 $rc1=$stmt->execute();
              } 
             $stmt = $db->prepare("update book_appointment set canceled_order_by_admin=?,admin_reason=?,canceled_datetime=? where orderId=? and id=?");
             $rc= $stmt->bind_param("sssss", $canceled_order_by_admin,$admin_reason,$date,$order_id,$booking_id);
             $rc=$stmt->execute();


             $leads=(int)$leads;
             $previous_leads=$leads;
             $current_leads=$leads+1;
     
             $stmt = $db->prepare("update partners_registration set leads=?,previous_leads=? where partners_id=?");
             $rc1= $stmt->bind_param("sss", $current_leads,$previous_leads,$partner_id);
             $rc1=$stmt->execute(); 

             array_push($successMsg,"Order canceled successfully!");
     
         }   
          
      } else{
         echo "<script>(function(){alert('Order not found')})()</script>";
      } 
}else if(isset($_POST['restore_order'])){
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $admin_reason ='';
 
    $stmt = $db->prepare("select * from book_appointment where orderId=? and id=?  limit 1"); 
     $orderInTable;
     $stmt->bind_param("ss", $order_id,$booking_id);
     $stmt->execute();
     $result2 = $stmt->get_result();
      $datas2 = $result2->fetch_array(MYSQLI_ASSOC);
      if($datas2['orderId']==$order_id && $datas2['id']==$booking_id){
         if (count($errors) == 0) {
             date_default_timezone_set('Asia/Kolkata');
             $date = date('Y-m-d H:i:s');
              $canceled_order_by_admin="false";
              $stmtCheck = $db->prepare("select * from spa_assign_lead where order_id=? and booking_id=?  limit 1");  
              $orderInTable;
              $stmtCheck->bind_param("ss", $order_id,$booking_id);
              $stmtCheck->execute();
              $resultSpaAssign = $stmtCheck->get_result();
              $resultSpaAssignDatas = $resultSpaAssign->fetch_array(MYSQLI_ASSOC);
              if($resultSpaAssignDatas['order_id']==$order_id && $resultSpaAssignDatas['booking_id']==$booking_id){
                 $stmt = $db->prepare("update spa_assign_lead set canceled_order_by_admin=?,canceled_datetime=? where order_id=? and booking_id=? ");
                 $rc1= $stmt->bind_param("ssss", $canceled_order_by_admin,$date,$order_id,$booking_id);
                 $rc1=$stmt->execute();
              } 
             $stmt = $db->prepare("update book_appointment set canceled_order_by_admin=?,admin_reason=?,canceled_datetime=? where orderId=? and id=?");
             $rc= $stmt->bind_param("sssss", $canceled_order_by_admin,$admin_reason,$date,$order_id,$booking_id);
             $rc=$stmt->execute();
             array_push($successMsg,"Order restore successfully!");
     
         }   
          
      } else{
         echo "<script>(function(){alert('Order not found')})()</script>";
      }  
}
if (isset($_POST['assign_order']) && isset($_SESSION['spa_userName']) && $_SESSION['spa_userName']!="") {
    $partner_id = mysqli_real_escape_string($db, $_POST['available_partners']);
    $partner_name = mysqli_real_escape_string($db, $_POST['partner_name']);
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    $bookingStatus = mysqli_real_escape_string($db, $_POST['bookingStatus']); 
    if($partner_id=="-1"){
      array_push($errors, "Please select Partners");
    }
  
    function generateNumericOTP($n) { 
        $generator = "135792468"; 
        $result = ""; 
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        } 
        return $result;
    } 

    $otpCode=generateNumericOTP(4);
      
   // echo 'sn:'.$services_name.' sd:'.$services_description.' a: '.$amount.'uplo:';
    $rejected='rejected';
   $stmt = $db->prepare("select * from spa_assign_lead where order_id=? and booking_id=?  limit 1"); 
   $orderInTable;
   $stmt->bind_param("ss", $order_id,$booking_id);
   $stmt->execute();
   $result2 = $stmt->get_result();
    $datas2 = $result2->fetch_array(MYSQLI_ASSOC);
    if($datas2['order_id']==$order_id && $datas2['booking_id']==$booking_id && $datas2['partner_request_status']=='' && $datas2['isassigned']=='true'){
        array_push($errors, "Order already assign");
        $orderInTable=false;
        echo "<script>(function(){alert('Order already assigned')})()</script>";
    }else if($datas2['order_id']==$order_id && $datas2['booking_id']==$booking_id && $datas2['partner_request_status']=='rejected' && $datas2['isassigned']=='false'){
        $orderInTable=true;
    }else{
        $orderInTable=true;
    }
 

 
   date_default_timezone_set('Asia/Kolkata');
      $date = date('Y-m-d H:i:s');

       // echo 'user admin id '.$register_id. ' :: name '. $name;
      
       $stmt = $db->prepare("select * from partners_registration where partners_id=? limit 1");  
       $stmt->bind_param("s", $partner_id);
       $stmt->execute();
       $resultPartner1 = $stmt->get_result();
       $resultPartner1Data = $resultPartner1->fetch_array(MYSQLI_ASSOC);
       $leads;
       if($resultPartner1Data){
           $leads=$resultPartner1Data['leads'];
           if($leads=='' || $leads==null || $leads==0){
            array_push($errors,"Partners not have any leads! Order can't assign to him");
           }
       }

        if (count($errors) == 0) {
            $isassigned1="true";
            $canceled_order_by_admin='false';
            $canceled_order_by_customer='false';
            $bookingStatus;
            $is_code_verify="false";
            if($bookingStatus=='rejected'){
                $bookingStatus='pending';
            }
            if($orderInTable==true){ 
                $stmt = $db->prepare("INSERT INTO spa_assign_lead(partner_id,order_id,booking_id,bookingStatus,amount,isassigned,date,canceled_order_by_admin,canceled_order_by_customer,partners_reach_code,is_code_verify) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $rc= $stmt->bind_param("sssssssssss", $partner_id,$order_id,$booking_id,$bookingStatus,$amount,$isassigned1,$date,$canceled_order_by_admin,$canceled_order_by_customer,$otpCode,$is_code_verify);
                 $rc=$stmt->execute();

                 if($rc==false){
                    array_push($errors,"Something went wrong! Service not added successfully!");
                  }else{
                    $isassigned='true';
                    $reason='';
                    $stmt = $db->prepare("update book_appointment set isassigned=?,assign_partner_id=?,assign_partner_name=?,bookingStatus=?,reason=? where orderId=?");
                    $rc= $stmt->bind_param("ssssss", $isassigned,$partner_id,$partner_name,$bookingStatus,$reason,$order_id);
                    $rc=$stmt->execute();
                   
                    $leads=(int)$leads;
                    $previous_leads=$leads;
                    $current_leads=$leads-1;

                    $stmt = $db->prepare("update partners_registration set leads=?,previous_leads=? where partners_id=?");
                    $rc1= $stmt->bind_param("sss", $current_leads,$previous_leads,$partner_id);
                    $rc1=$stmt->execute();
                    array_push($successMsg,"Order assigned successfully!");
                   
                  }
                 
            }
         


         
             
        } 
         else{
          array_push($errors,"Something went wrong! Order not assign successfully!");
         }
        }
        else{
          //echo '<script>(function(){window.location.href ="index.php";})();</script>';
        }
  
?>


<style>
    .row {
        padding: 6px 0px !important;
    }

    button {
        width: 150px !important;
    }

    label.data {
        border: 1px solid #ccc;
        padding: 8px;
        width: 100%;
    }

    .form-group label:first-child {
        font-size: 14px;
    }
    .form-group label:last-child {
        font-weight:500;
    }
    .mt-3 {
        padding-top: 1rem;
    }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Booked Order Details</h3>
            </div>


        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Booked Order Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $dateS = date('Y-m-d');
                            $dataPartner1;     
                            //echo "date ",$dateS;

                            $stmt = $db->prepare("select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,o.gateway_paymentid,b.paymentStatus,
                            b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.cust_address_id,b.serviceTiming,b.message,
                            b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                            b.cust_address_id,b.session_id,b.reason,b.cust_username,b.cust_id,b.isassigned,b.canceled_order_by_admin,b.canceled_order_by_customer,b.cust_reason,b.admin_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                            from book_appointment b
                            join orders_details o on o.order_id=b.orderId 
                            where order_id=? limit 1");
                            $stmt->bind_param("i",$_GET['o_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $datas = $result->fetch_array(MYSQLI_ASSOC);

                            $orderCanceledBy='';
                            $orderCanceled='false';
                            $reasonBy='';
                            if( $datas['canceled_order_by_admin'] && $datas['canceled_order_by_admin']=='true'){
                                $orderCanceled='true';
                                $orderCanceledBy="Order canceled by Admin";
                                $reasonBy=$datas['admin_reason'];

                            }else if($datas['canceled_order_by_customer'] && $datas['canceled_order_by_customer']=='true'){
                                $orderCanceled='true';
                                $orderCanceledBy="Order canceled by Customer";
                                $reasonBy=$datas['cust_reason'];
                            }else{
                                $orderCanceled='false';
                            }
                            if($orderCanceled=='true'){
                        ?>
                        
                        <div class="row">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="color:red">Order Canceled</h2>
                                     
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" style="color:red">Order Canceled By
                                                </label><br>
                                                <label class="control-label data" style="color:red;font-size: 16px;font-weight: 600;">
                                                    &nbsp;<?php echo $orderCanceledBy?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Reason
                                                </label><br>
                                                <label class="control-label data" style="color:red">
                                                    &nbsp;<?php echo $reasonBy?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pt-3">
                                            <label class="control-label">&nbsp;
                                                </label><br>
                                            <form action="booking-orders-details.php?o_id=<?php echo $_GET['o_id'] ?>" method="post">

                                                <input type="hidden" name="order_id" value="<?php echo $datas['order_id']?>">
                                            
                                                <input type="hidden" name="booking_id" value="<?php echo $datas['booking_id']?>">

                                                <input style="width: 100%;" onclick="return confirm('Are you sure you want to restore this order')"  type="submit" class="btn btn-success" name="restore_order" value="Restore Order">
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                   <!--  <div class="col-md-12">
                                        <h3 style="color:red"><?php echo $orderCanceledBy?></h3>  
                                        <h4><?php echo $reasonBy; ?></h4>
                                    </div> -->
                                     
                                </div>
                            </div>
                            
                         </div>

                        <?php }  ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Order ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['order_id']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Booking ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['booking_id']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Customer Username
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['cust_username']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Order Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo date_format(new DateTime($datas['date']),"d M Y H:i")?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Payment Status
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['paymentStatus']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Payment Mode
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['paymentMode']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Booking Status
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['bookingStatus']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Amount
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo number_format($datas['amount'],2)?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Payment ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['gateway_paymentid']?>
                                    </label>
                                </div>
                            </div>
 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Service Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php 
                                        echo date_format(new DateTime($datas['serviceDate']),"d M Y")," - ";
                                       // $day=$dateS = date('d');
                                       // echo $datas['serviceDate'],':',$dateS,':',date('Y-m-d');
                                        $dayToService='';
                                        $d1=$datas['serviceDate'];
                                        $d2=date('Y-m-d');

                                        $reD1=$datas['rescheduleDate']; 
                                       // $date1 = new DateTime($d1);
                                        //$date2 = new DateTime($d2);
                                        //$interval = $date2->diff($date1);

                                        $date1=date_create($d2);
                                        $date2=date_create($d1);
                                        $diff=date_diff($date1,$date2);
                                        //echo $diff->format("%R%a");

                                        $dateRe2=date_create($reD1); 
                                        $diffRe=date_diff($date1,$dateRe2);

                                        $dayDiff=$diff->format("%R%a"); 
                                        $dayReDiff=$diffRe->format("%R%a"); 
                                        if($dayDiff=="1"){
                                            $dayToService="Tomorrow"; 
                                        }else if($dayDiff=="2"){
                                            $dayToService="The Day After Tomorrow"; 
                                        }else if($dayDiff=="0"){
                                            $dayToService="Today"; 
                                        }if($dayDiff=="-1"){
                                            $dayToService="Yestarday"; 
                                        }
                                       // echo "$dayDiff:: ",$dayDiff;
                                       if($dayToService!=''){
                                        echo '&nbsp;'.$dayToService;
                                       }
                                        //echo "<br> d1:",$d1," ::: d2:: ",$d2;
                                        ?>
                                    </label>
                                   
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Service Timing
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['serviceTiming']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Is Reschedule
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['isreschedule']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Reschedule Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['rescheduleDate']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Reschedule Timing
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['rescheduleTime']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Is Assigned
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['isassigned']?>
                                    </label>
                                </div>
                            </div>
                           <!--  <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Partner Reached
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['is_code_verify']?>
                                    </label>
                                </div>
                            </div> -->
                            

                        </div>
                        </div>
                </div>
               
                <div class="x_panel">
                    <div class="x_title"> 
                        <h2>Customer Details</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['name']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['email']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Contact
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['contact']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Address
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['customer_address']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Message
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['message']?>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                         
                            <h2>Orders Details</h2> 
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            </ul>
                            <div class="clearfix"></div>
                        
                    </div>
                    <div class="x_content">
                        <?php    
                            $items=$datas['service_name']; 
                            $arr = json_decode($items, true);
                            //print_r($arr);
                            $item_price =0;
                            foreach($arr as $item){
                                $s_id= $item['service_id'];
                                $stmt = $db->prepare("select * from services
                                where service_id=? limit 1");
                                $stmt->bind_param("i",$s_id);
                                $stmt->execute();
                                $resultServices = $stmt->get_result();
                                $service = $resultServices->fetch_array(MYSQLI_ASSOC);
                                //print_r($service);
                                
                                $item_price = $item["quantity"]*$item["amount"]; 
                                $offer=$item["offers"];
                                if($offer=='' || $offer==0){
                                    $offer='';
                                    $item_price= $item_price;
                                }else{
                                    //$totalDiscount=$totalDiscount+(($item_price*$offer)/100);
                                    $item_price=$item_price-(($item_price*$offer)/100);
                                    $offer=$offer.'% Off';
                                }
                            
                                 $imgHtml=''; 
                                $imgUrl=$service['services_image'];
                                if($imgUrl!=""){
                                    if(strpos($imgUrl,",")>-1){
                                        $imgs=explode(',',$imgUrl);  
                                        $imgHtml.='<img width="120px" height="100px" src="'.$baseurl.'/'.'services_img/'.$imgs[1].'" alt="'.$item["services_name"].'" id="img1" class="cart-item-image"/>';      
                                        
                                    }
                                    else{
                                        $imgHtml='<img width="120px" height="100px" src="'.$baseurl.'/'.$imgUrl.'" alt="'.$service["services_name"].'" class="cart-item-image" >';
                                        
                                    }
                                    
                                }

                                
                                ?>
                        <div class="row">
                            <div class="col-md-2 mt-3">
                                 
                                    <?php echo $imgHtml?> 
                            </div>
                        <!-- <div class="row">
                            <div class="col-md-2 mt-3">
                                <img width="120px" height="100px"
                                    src="<?php echo $baseurl?><?php echo $service['services_image']?>" alt="">
                            </div> -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Service Name
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $service['services_name']?>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Service Description
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $service['services_description']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Quantity
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $item['quantity']?>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Service ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $item['service_id']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Amount
                                </label><br>
                                <label class="control-label data">
                                    &nbsp;<del><?php echo number_format($item["amount"],2)?></del>
                                    <?php echo number_format($item_price,2),' ',$offer?>
                                </label>
                            </div> 

                        </div>
                        <hr>
                        <?php } ?>

                    </div>
                </div>
                <?php 
                   $order_ids=$datas['order_id'];
                   $data;
                  // echo "order id :: ",$order_ids;
                   $assign_lead_data;
                   $spa_assign_lead_query = "select * from spa_assign_lead where order_id='$order_ids' and isassigned='true' and not bookingStatus='rejected'"; 
                   $resultsData1 = mysqli_query($db, $spa_assign_lead_query); 
                   $assign_count=mysqli_num_rows($resultsData1);

                   $assign_lead_data = mysqli_fetch_assoc($resultsData1);
                   $partner_id=$assign_lead_data['partner_id'];


                   $spa_assign_lead_query1 = "select * from spa_assign_lead where partner_id='$partner_id' and isassigned='true' and DATE(date)='$dateS'"; 
                   $getPartnerCount = mysqli_query($db, $spa_assign_lead_query1); 
                   $assign_partner_count=mysqli_num_rows($getPartnerCount);
                   //$assign_count=mysqli_num_rows($resultsData1);
                   $shopStatusP='';
                   $addres='';

                   $spa_assign_lead_query2 = "select * from spa_assign_lead where order_id='$order_ids' and partner_id='$partner_id'  limit 1"; 
                   $getOtpVerify = mysqli_query($db, $spa_assign_lead_query2); 
                   $getOtpVerify_count=mysqli_num_rows($getOtpVerify);
                   $getOtpVerifyData;
                   if($getOtpVerify_count==1){
                        $getOtpVerifyData=mysqli_fetch_assoc($getOtpVerify);
                   }

                  
                   //echo "count ",$count;
                   if($assign_count>0){
                    
                    $partners_registration_query = "select * from partners_registration where partners_id='$partner_id' limit 1"; 
                    $results2 = mysqli_query($db, $partners_registration_query); 
                    if (mysqli_num_rows($results2) >0) { 
                        $item = mysqli_fetch_assoc($results2);
                        $dataPartner1 = array(
                            'partners_id' => $item['partners_id'],
                            'name' => $item['name'],
                            'email' => $item['email'],
                            'contact' => $item['contact'],
                            'location' => $item['location'],
                            'city' => $item['city'],
                            'state' => $item['state'],
                            'pincode' => $item['pincode'],
                            'partners_username' => $item['partners_username'],
                            'status' => $item['status'],
                            'shopStatus' => $item['shopStatus'],
                            'lead_count'=>$assign_partner_count
                        );
                        if($dataPartner1['shopStatus']=='open'){
                            $shopStatusP='Online';
                        }else{
                            $shopStatusP='Offline';
                        }
                        $addres=$dataPartner1['location'].', '.$dataPartner1['city'].', '.$dataPartner1['state'].'-'.$dataPartner1['pincode'];
                 ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Assigned</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Partner ID</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $dataPartner1['partners_id'] ?>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Name</label><br>
                                <label class="control-label data" id="pname">
                                    &nbsp;<?php echo $dataPartner1['name'] ?>
                                </label>
                            </div> 
                            <div class="col-md-3">
                                <label class="control-label">Email</label><br>
                                <label class="control-label data" id="pemail">
                                    &nbsp;<?php echo $dataPartner1['email'] ?>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Contact</label><br>
                                <label class="control-label data" id="pcontact">
                                    &nbsp;<?php echo $dataPartner1['contact'] ?>
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Address</label><br>
                                <label class="control-label data" id="address">
                                    &nbsp;<?php echo $addres ?>
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Status</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $shopStatusP ?>
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Today Leads</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $dataPartner1['lead_count'] ?>
                                </label>
                            </div> 

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label class="control-label">Booking Or Service Status
                                    </label><br>
                                    <label class="control-label data" style="color:red">
                                        &nbsp;<?php echo $datas['bookingStatus']?>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label class="control-label">Partner Reached OTP
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $getOtpVerifyData['partners_reach_code'];?>
                                    </label>
                                </div>
                            </div>

                              <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label class="control-label">Partner Reached
                                    </label><br>
                                    <label class="control-label data" style="color:red">
                                        &nbsp;<?php if($getOtpVerifyData['is_code_verify']=="true"){echo 'Reached';}else{echo 'Not reached';}?>
                                    </label>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <h4>Partner service image</h4>
                        <?php 
                        if($assign_lead_data['partner_on_service_image']!=""){
                            $imgs=explode(',',$assign_lead_data['partner_on_service_image']);
                          
                            $len=count($imgs);
                            //echo "len::: ".$len;
                            for($i=0;$i<$len;$i++){
                                if($imgs[$i]!=""){
                                    echo '<a href="./../partners_service_img/'.$imgs[$i].'" target="_blank"> <img src="./../partners_service_img/'.$imgs[$i].'" alt="" height="120" width="150" border="1px"></a>';
                                }
                            }
                        }
                    ?>
                        </div>
                    </div>
                </div>
               <?php 
               
                        } 
                    } 
                ?> 


                <?php 
                   $order_ids=$datas['order_id']; 
                   $partner_id=$assign_lead_data['partner_id'];
 
                   $feedbackData;
                   $feedback_query = "select * from spa_feedback where order_id='$order_ids' and partner_id='$partner_id'"; 
                   $feedbackDataResult = mysqli_query($db, $feedback_query);  

                   $feedbackData = mysqli_fetch_assoc($feedbackDataResult);
                   

 
                
                ?>
                  
                   
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Feedback</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Rating</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $feedbackData['rate'] ?>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Feedback Message</label><br>
                                <label class="control-label data" id="pname">
                                    &nbsp;<?php echo $feedbackData['feedback'] ?>
                                </label>
                            </div>  
                            </div> 

                        </div>
                    </div>
                </div>
              



                <div class="x_panel"  <?php if($assign_count>0){echo 'style="display:none"';}else{echo 'style="display:inline-block"';} ?>>
                    <div class="x_title">
                        <h2>Assign Order to Partners</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <form action="booking-orders-details.php?o_id=<?php echo $_GET['o_id'] ?>" method="post">
                            <?php 
                             $cust_address_id=$datas['cust_address_id'];
                             $stmt = $db->prepare("select * from cust_address
                             where address_id=? limit 1");
                             $stmt->bind_param("i",$cust_address_id);
                             $stmt->execute();
                             $resultServices = $stmt->get_result();
                             $addressData = $resultServices->fetch_array(MYSQLI_ASSOC);
                           // echo "date : ".$dateS;
                           //and DATE(a.date)=?
                             $cust_city=$addressData['city'];
                             
                             $stmt1 = $db->prepare("select p.partners_id,p.name,p.email,p.contact,p.location,p.city,p.state,p.pincode,p.status,p.shopStatus from partners_registration p where p.city like ? and p.status=? and p.shopStatus=? and p.leads>0 ");
                             $cust_city=trim($cust_city);
                             $a='%'.$cust_city.'%';
                             
                            // echo $a,$cust_city;
                            $status='active';
                            $shopSt='open';
                            $bookingStatus1="completed";
                            $dates=$dateS;
                           // $dates=$dates.'%';
                            //echo "$dates ",$dates;
                             $stmt1->bind_param("sss",$a,$status,$shopSt);
                             $stmt1->execute();
                             $resultPartner = $stmt1->get_result();
                             $partnersData = $resultPartner->fetch_all(MYSQLI_ASSOC);
                            // print_r($partnersData);
                             ?>
                         
                             <div class="col-md-3">
                                    <label class="control-label">Order Location </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $cust_city?>
                                    </label>
                             </div>
                             <div class="col-md-6">
                                <?php 
                                    if($dayToService=="Today")
                                    {
                                ?>
                                    <label class="control-label">Select Partners </label><br>
                                    <select name="available_partners" onchange="selectPartners(event)" id="available_partners"   class="form-control ">
                                    <option value="-1">----Select Partners----</option>
                                    <?php
                                        foreach($partnersData as $partnerData){
                                    ?> 
                                        <option value="<?php echo $partnerData['partners_id']?>"><?php echo $partnerData['name'].','.$partnerData['email'].','.$partnerData['contact'] ?></option>
                                        
                                    <?php
                                        }
                                    ?>
                                    </select>
                                <?php 
                                    }else{
                                        echo '<label class="control-label">Select Partners </label><br>
                                        <label class="control-label data" style="color:red;">
                                            &nbsp;This service is not available today for assign
                                        </label>
                                        ';
                                    }
                                ?>
                            </div>

                                <div class="col-md-3">
                                    <?php 
                                        if($dayToService=="Today")
                                        {
                                    ?>
                                     <input type="hidden" id="partner_name" name="partner_name">
                                        <input type="hidden" name="order_id" value="<?php echo $datas['order_id']?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $datas['booking_id']?>">
                                        <input type="hidden" name="bookingStatus" value="<?php echo $datas['bookingStatus']?>">
                                        <input type="hidden" name="amount" value="<?php echo $datas['amount']?>"> 
                                        <label class="control-label">&nbsp; </label><br>
                                        <input  type="submit" class="btn btn-success" name="assign_order" value="Assign Order">
                                    <?php 
                                        }
                                    ?>
                                
                              </div>

                            </form>
                        </div>
                   
                        <hr>
                        <div class="row d-none" style="display:none;" id="partners_details">
                            <div class="col-md-3">
                                <label class="control-label">Partner ID</label><br>
                                <label class="control-label data" id="pId">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Name</label><br>
                                <label class="control-label data" id="pname">
                                    &nbsp;
                                </label>
                            </div> 
                            <div class="col-md-3">
                                <label class="control-label">Email</label><br>
                                <label class="control-label data" id="pemail">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Contact</label><br>
                                <label class="control-label data" id="pcontact">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Address</label><br>
                                <label class="control-label data" id="address">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Working Locations</label><br>
                                <label class="control-label data" id="wlocation">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Status</label><br>
                                <label class="control-label data" id="pshopStatus">
                                    &nbsp;
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Today Leads</label><br>
                                <label class="control-label data" id="plead_count">
                                    &nbsp;
                                </label>
                            </div> 
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Service Status</label><br>
                                <label class="control-label data" id="sStatus">
                                    &nbsp;
                                </label>
                            </div> 
                        </div>

                    </div>
                </div>

                
                <div class="x_panel">
                    <div class="x_title"> 
                        <h2>Cancel Customer Orders</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="x_content">
                        <form action="booking-orders-details.php?o_id=<?php echo $_GET['o_id'] ?>" method="post">
                            <div class="row">
                            
                                <div class="col-md-6">
                                <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                                <?php  include '../success.php' ?>
                            </div>
                                    <div class="form-group">
                                        <label class="control-label">Order ID
                                        </label><br>
                                        <label class="control-label data">
                                            &nbsp;<?php echo $datas['order_id']?>
                                        </label>
                                    
                                        <input type="hidden" name="order_id" value="<?php echo $datas['order_id']?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Booking ID
                                        </label><br>
                                        <label class="control-label data">
                                            &nbsp;<?php echo $datas['booking_id']?>
                                        </label>
                                        <input type="hidden" name="booking_id" value="<?php echo $datas['booking_id']?>">
                                    </div>
                                        
                                </div>
                                <div class="col-md-6">
                                <div style="margin-top:1rem;color:red;">
                                <?php  include '../errors.php' ?>
                            </div>
                          
                                    <div class="form-group">
                                        <label class="control-label">Reason To Cancel Order
                                        </label><br>
                                        
                                            <textarea required="required" class="form-control col-md-12 col-xs-12" name="admin_reason" id="admin_reason"></textarea>
                                        
                                    </div>
                                    <div class="form-group pt-3">
                                    <label class="control-label"> &nbsp;
                                        </label><br>
                                        <input style="width: 100%;" onclick="return confirm('Are you sure you want to cancel this order')"  type="submit" class="btn btn-danger" name="cancel_order" value="Cancel Order">
                                    </div>
                                </div> 
                                 
                            </div>
                        </form>
                    </div>
                </div>

            </div>
           
           
        </div>
    </div>
</div>
 <script>
   function selectPartners(event)
    {
     //console.log(event.target.value);
      $.ajax({
            url: 'codes/fetch-category-ddl.php',
            type:'POST',
            dataType:"json",
            data:
            { 
                partners_id: event.target.value
            },
            success: function(response)
            {
                
                //alert(response);
                $('#partners_details').attr('style','display:inline-block');
                $('#pId').html(response.partners_id);
                $('#pname').html(response.name);
                $('#partner_name').val(response.name);
                $('#pemail').html(response.email);
                $('#pcontact').html(response.contact);
                $('#wlocation').html(response.city);
                $('#address').html(response.location+', '+response.state+'-'+response.pincode);
                var shopStatus='';
                if(response.shopStatus=='open'){
                    shopStatus='Online';
                }else{
                    shopStatus='Offline';
                }
                $('#pshopStatus').html(shopStatus);
                $('#plead_count').html(response.lead_count);
                if(response.bookingStatus=="Not Assign"){
                    $('#sStatus').html($datas['bookingStatus']);
                }else{
                    $('#sStatus').html(response.bookingStatus);
                }
                
                
                
            }               
        });

    } 
 </script>
<?php include 'footer.php'?>