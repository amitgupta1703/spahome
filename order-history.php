<?php 
$title="Order History";
include 'header.php';
include 'codes/login-code.php';
include 'profile-header.php';
$customer_name='';
$email='';
$contact='';
$add='';
$timeArray=array("08:30"=>"08:00AM-08:30AM","09:00"=>"08:30AM-09:00AM","09:30"=>"09:00AM-09:30AM","10.00"=>"09:30AM-10.00AM","10:30"=>"10:00AM-10:30AM","11:00"=>"10:30AM-11:00AM","11:30"=>"11:00AM-11:30AM","12:00"=>"11:30AM-12:00PM","12:30"=>"12:00PM-12:30PM","13:00"=>"12:30PM-01:00PM","13:30"=>"01:00PM-01:30PM","14:00"=>"01:30PM-02:00PM","14:30"=>"02:00PM-02:30PM","15:00"=>"02:30PM-03:00PM","15:30"=>"03:00PM-03:30PM","16:00"=>"03:30PM-04:00PM","16:30"=>"04:00PM-04:30PM","17:00"=>"04:30PM-05:00PM","17:30"=>"05:00PM-05:30PM","18:00"=>"05:30PM-06:00PM","18:30"=>"06:00PM-06:30PM","19:00"=>"06:30PM-07:00PM","19:30"=>"07:00PM-07:30PM");
if(!isset($_SESSION['username']) && $_SESSION['username']=='' && !isset($_SESSION['cust_id'])){
    echo "<script> window.location.assign('index.php'); </script>";
}else{
    $uname=$_SESSION['username'];
    //echo $uname,'cus_id ',$_SESSION['cust_id'];
    $user_check_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.id,b.name,b.email,b.contact,b.service_name,
        b.serviceDate,b.serviceTiming,b.message,b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.assign_partner_id,b.customer_address,
        b.cust_address_id,b.session_id,s.service_id,s.services_description,s.offersOrDiscount,s.services_image 
        from book_appointment b
        join orders_details o on b.orderId=o.order_id
        join services s on b.service_id=s.service_id where b.contact='$uname' 
        and o.paymentStatus not in ('Pending') order by o.order_id";
    $results = mysqli_query($db, $user_check_query); 
    $data = mysqli_fetch_assoc($results); 
    if ($data) { 
         //echo "asjdjashdj:: ".$data['order_id'];
    }
     
}

if(isset($_POST['cust_cancel_order'])){
    echo "submit cancel";
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $cust_reason = mysqli_real_escape_string($db, $_POST['reason']); 

    if(empty($cust_reason)){
        array_push($errors, "Please select Reason");
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
             $canceled_order_by_customer="true";
             $stmtCheck = $db->prepare("select * from spa_assign_lead where order_id=? and booking_id=?  limit 1");  
             $orderInTable;
             $stmtCheck->bind_param("ss", $order_id,$booking_id);
             $stmtCheck->execute();
             $resultSpaAssign = $stmtCheck->get_result();
             $resultSpaAssignDatas = $resultSpaAssign->fetch_array(MYSQLI_ASSOC);
             if($resultSpaAssignDatas['order_id']==$order_id && $resultSpaAssignDatas['booking_id']==$booking_id){
                $stmt = $db->prepare("update spa_assign_lead set canceled_order_by_customer=?,canceled_datetime=? where order_id=? and booking_id=? ");
                $rc1= $stmt->bind_param("ssss", $canceled_order_by_customer,$date,$order_id,$booking_id);
                $rc1=$stmt->execute();
             } 
            $stmt = $db->prepare("update book_appointment set canceled_order_by_customer=?,cust_reason=?,canceled_datetime=? where orderId=? and id=?");
            $rc= $stmt->bind_param("sssss", $canceled_order_by_customer,$cust_reason,$date,$order_id,$booking_id);
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
}


if(isset($_POST['cust_reschedule_order'])){
    echo "cust_reschedule_order cancel";
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $rescheduleDate = mysqli_real_escape_string($db, $_POST['rescheduleDate']); 
    $rescheduleTime = mysqli_real_escape_string($db, $_POST['timing']); 
    $rescheduleTime= $timeArray[$rescheduleTime];
    if(empty($rescheduleDate)){
        array_push($errors, "Please enter Reschedule Date");
    }

    if(empty($rescheduleTime) || $rescheduleTime=="-1"){
        array_push($errors, "Please select Reschedule Time");
    }
 
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
             $isreschedule="true";
             $stmtCheck = $db->prepare("select * from spa_assign_lead where order_id=? and booking_id=?  limit 1");  
             $orderInTable;
             $stmtCheck->bind_param("ss", $order_id,$booking_id);
             $stmtCheck->execute();
             $resultSpaAssign = $stmtCheck->get_result();
             $resultSpaAssignDatas = $resultSpaAssign->fetch_array(MYSQLI_ASSOC);
             if($resultSpaAssignDatas['order_id']==$order_id && $resultSpaAssignDatas['booking_id']==$booking_id){
                $stmt = $db->prepare("update spa_assign_lead set isreschedule=?,rescheduleDate=?,rescheduleTime=? where order_id=? and booking_id=? ");
                $rc1= $stmt->bind_param("sssss", $isreschedule,$rescheduleDate,$rescheduleTime,$order_id,$booking_id);
                $rc1=$stmt->execute();
             } 
            $stmt = $db->prepare("update book_appointment set isreschedule=?,rescheduleDate=?,rescheduleTime=? where orderId=? and id=?");
            $rc= $stmt->bind_param("sssss", $isreschedule,$rescheduleDate,$rescheduleTime,$order_id,$booking_id);
            $rc=$stmt->execute();
 
            array_push($successMsg,"Order canceled successfully!");
    
        }   
         
     } else{
        echo "<script>(function(){alert('Order not found')})()</script>";
     } 
}


if(isset($_POST['submit_feedback'])){
    //echo "cust_reschedule_order cancel";
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $booking_id = mysqli_real_escape_string($db, $_POST['booking_id']);  
    $partner_id = mysqli_real_escape_string($db, $_POST['partner_id']);
    $feedbackMsg = mysqli_real_escape_string($db, $_POST['feedbackMsg']); 
    $rate = mysqli_real_escape_string($db, $_POST['rate']); 

    if(empty($feedbackMsg)){
        array_push($errors, "Please enter Feedback");
    }
    if(empty($rate)){
        array_push($errors, "Please select rating");
    }
     
    $stmt = $db->prepare("select * from book_appointment where orderId=? and id=?  limit 1"); 
    $orderInTable;
    $stmt->bind_param("ss", $order_id,$booking_id);
    $stmt->execute();
    $result2 = $stmt->get_result();
     $datas2 = $result2->fetch_array(MYSQLI_ASSOC);
     if($datas2['orderId']==$order_id && $datas2['id']==$booking_id){ 
        if (count($errors) == 0) {
            date_default_timezone_set('Asia/Kolkata');
            $feedback_date = date('Y-m-d H:i:s');
             
            $stmt = $db->prepare("insert into spa_feedback(rate,feedback,feedback_date,partner_id,booking_id,order_id) values(?,?,?,?,?,?)");
            $rc= $stmt->bind_param("ssssss", $rate,$feedbackMsg,$feedback_date,$partner_id,$booking_id,$order_id);
            $rc=$stmt->execute();
            if($rc==true){
                array_push($successMsg,"Feedback submitted successfully!");
            }
 
             
    
        }   
         
     } else{
        echo "<script>(function(){alert('Order not found')})()</script>";
     } 
}
?>

<style> 
.s{
    border-top: 1px solid #c3c3c3;
    border-width: thin;
    width: 30%;
}
.boxS{
    box-shadow: 1px 1px 4px 0px #dfdfdf;
}
.modal-backdrop {
    position: inherit;
    
}
.modal-content {
    width: 100%;
}
.w-200{
    width:150px;
    color:#fff;
}
.w100{
    width:100%;
}
#myModal{
    padding-right: 0px
}
.datepicker{ z-index:99999 !important; width:300px }
.datepicker{
      width: 300px !important;
      background-color: #fff;
    }
    .datepicker .datepicker-calendar{
      width:100% !important;
    }
    .ui-corner-all{
      border-bottom-right-radius: 0px;
      border-bottom-left-radius:0px;
    }
    .datepicker-calendar thead tr th{
      text-align:center;
      border:1px solid #c1c1c1;
    }
    .datepicker-calendar tr td{
      text-align:center;
      border:1px solid #c1c1c1;
    }
    .datepicker-unselectable.ui-state-disabled{
      background-color:#c5dbec;
    } 
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: none;
    background: transparent;
    font-weight: 500;
    color: #000;
  }
  .datepicker .datepicker-calendar td:not(.ui-state-disabled){
    background-color:#2e6e9e;
    color:#fff !important;
  }
  .datepicker .datepicker-today{
    background-color:#ea728c !important;
  }
  .datepicker .datepicker-prev,.datepicker .datepicker-next{
    display:none !important;
  }
  .datepicker-days table{
      width:100%;
  }
  .datepicker-days thead{
    border: 1px solid #4297d7;
    background: #5c9ccc ;
    color: #ffffff;
    font-weight: bold;
  }
  .datepicker{ z-index:99999 !important; }
  .datepicker td{
    
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px; 
    background-color: #c5dbec;
    border: 1px solid #4297d7;
}
.datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
    background: none;
    color: #525252;
    cursor: default;
    background-color: #c5dbec;
}
.datepicker table tbody tr td:not(.disabled) {
    color: #fff; 
}
.datepicker table tbody tr td {
    background-color: #2e6e9e; 
}
.datepicker table thead tr .prev,.datepicker table thead tr .next {
    background-color: #5c9ccc !important;
    color: #fff !important;
    visibility: visible !important;
    pointer-events: none !important;
}
.datepicker th { 
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px; 
}
.datepicker table tr td.day:hover, .datepicker table tr td.day.focused {
    background: #3e749d;
    cursor: pointer;

}
.datepicker table tr td.active.active{
    background-color: #008000;
    background-image: linear-gradient(to bottom, #15c115, #008000);
}
.datepicker table tr td.today{
    background-color: #ea728c !important;
    background-image: linear-gradient(to bottom, #e79eae, #ea728c);
    color: #fff;
}
.datepicker table tr td.today:hover{ 
    color: #fff;
}
.datepicker .datepicker-switch:hover, .datepicker .prev:hover, .datepicker .next:hover, .datepicker tfoot tr th:hover{
    background-color: #5c9ccc !important;

}
.rateContainer .rate {
    float: left;
    height: 46px;
    /* padding: 0 10px; */
}
.rateContainer .rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rateContainer .rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rateContainer .rate:not(:checked) > label:before {
    content: '★ ';
}
.rateContainer .rate > input:checked ~ label {
    color: #ffc700;    
}
.rateContainer .rate:not(:checked) > label:hover,
.rateContainer .rate:not(:checked) > label:hover ~ label {
    color: #ffc700;  
}
.rateContainer .rate > input:checked + label:hover,
.rateContainer .rate > input:checked + label:hover ~ label,
.rateContainer .rate > input:checked ~ label:hover,
.rateContainer .rate > input:checked ~ label:hover ~ label,
.rateContainer .rate > label:hover ~ input:checked ~ label {
    color: #ffc700;
}
.star{
    cursor:pointer;
    font-size:30px;
    color:#ffc700;
}
.notStar{
    cursor:pointer;
    font-size:30px;
    color:#ccc;  
}
.rateContainer{
    display: flex;
}
 
</style>
 
   
    <div class="site-section bg-light mt-5">
      <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php include 'profile-sidebar.php'; ?>
            </div> 
            <div class="col-md-9 aos-init aos-animate" data-aos="fade" data-aos-delay="100"> 
                <div class="card box inners"> 
                    <div class="row">
                        <div class="col-md-12">
                        <p class="fs18">Order History</p>
                        </div>
                    </div>
                    <?php 
                    $uname=$_SESSION['username'];
                    //echo $uname;
                    $partner_name='';
                    $partner_email='';
                    $partner_contact='';
                    $partner_company_name='';
                    $location='';
                    $city='';
                    $state='';
                    $pincode='';
                    $paddress='';
                    $pProfileImg='';

                  
                    $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                    b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                    b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.assign_partner_id,b.customer_address,
                    b.cust_address_id,b.session_id,b.canceled_order_by_admin,b.canceled_order_by_customer,b.admin_reason,b.cust_reason,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                    from book_appointment b
                    join orders_details o on o.order_id=b.orderId
                    where b.contact='$uname' and o.paymentStatus not in ('Pending') order by o.order_id desc
                    ";
                    $count=0;
                     

                    $results = mysqli_query($db, $user_data_query); 
                    if (mysqli_num_rows($results) >0) { 
                        while($row = mysqli_fetch_assoc($results)){
                            $partnerId=$row['assign_partner_id'];
                            //echo $partnerId;
                            $pServiceNameJson=$row["service_name"]; 
                            $arr = json_decode($pServiceNameJson, true);
                            $orderCount= (int)count($arr)-1;
                            //echo $orderCount;
                            if($orderCount==0){
                                $orderCount='';
                            }else{
                                $orderCount='+ '.$orderCount.' more items';
                            }
                           // echo $arr[0]["service_id"],' :: len  :: ',str_len
                           $service_id;
                            foreach($arr as $key){
                                $service_id= $key["service_id"];
                                //echo '<br>id:',$service_id,'<br>';
                                break;
                            }
                           // echo '<br>id:',$service_id,'<br>';
                            $getServiceQuery="select * from services where service_id='$service_id'";
                            $resultService = mysqli_query($db, $getServiceQuery);
                            $rowService = mysqli_fetch_assoc($resultService);
                            $pServiceName= $rowService['services_name'];
                           
                           
                            $pServiceDesc=$rowService["services_description"];
                            if (strlen($pServiceDesc) > 30) {
                                $pServiceDesc = substr($pServiceDesc, 0, 70). ' <a href="#">...</a>';
                            } else {
                                $pServiceDesc = $pServiceDesc;
                            } 
                            //getPartners($partnerId);
                            $orId=$row['order_id'];
                            $isassign='false';
                           // echo "orrr: ".$orId;
                            $getPartnerQuery="select p.partners_id,p.name,p.email,p.contact,p.location,p.city,p.state,p.pincode,p.partners_username,p.profileImg,sa.order_id,sa.partners_reach_code from partners_registration p join spa_assign_lead sa on p.partners_id = sa.partner_id where sa.order_id='$orId' and sa.isassigned='true' limit 1"; 
                            $results3 = mysqli_query($db, $getPartnerQuery); 
                            $getPartner = mysqli_fetch_assoc($results3);
                            if($getPartner){
                                $partner_name=$getPartner['name'];
                                $partner_email=$getPartner['email'];
                                $partner_contact=$getPartner['contact'];
                                 $pProfileImg=$getPartner['profileImg'];
                                $pProfileImg=str_replace('./..','',$pProfileImg);
                                //$partner_company_name=$getPartner['company_name'];
                                $paddress= $getPartner['location'].', '.$getPartner['city'].', '.$getPartner['state'].'-'.$getPartner['pincode'];
                                $isassign='true';
                            //echo $paddress;
                            }else{
                                $isassign='false';
                            }
                            $bookingStatus;
                            if($row['bookingStatus']=='rejected'){
                                $bookingStatus='Pending';
                            }else if($row['canceled_order_by_admin']=='true' || $row['canceled_order_by_customer']=='true'){
                                $bookingStatus='Canceled';
                            }else{
                                $bookingStatus=$row['bookingStatus'];
                            
                            }

                            $imgHtml=''; 
                            $imgUrl=$rowService['services_image'];
                            //echo "img:: ".$imgUrl;
                            if($imgUrl!=""){
                                if(strpos($imgUrl,",")>-1){
                                    $imgs=explode(',',$imgUrl);  
                                    $imgHtml.='<img width="70px" height="50px" src="'.$baseurl.'/'.'services_img/'.$imgs[1].'" alt="'.$rowService["services_name"].'" id="img1" class="cart-item-image"/>';      
                                    
                                }
                                else{
                                    $imgHtml='<img width="70px" height="50px" src="'.$baseurl.'/'.$imgUrl.'" alt="'.$rowService["services_name"].'" class="cart-item-image" >';
                                    
                                }
                                
                            }
                                                    
                            echo  '<div class="card box pd10 mb-3">';?>
                                        <div class="row fs18" style="color:red;">
                                            
                                         <?php if($row['canceled_order_by_admin']=='true'){ ?>
                                            <div class="col-md-6">
                                                <p class="fs18">Order Canceled by Service Provider</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="fs18">Reason: <?php echo $row['admin_reason'] ?></p>
                                            </div>
                                                
                                         <?php } else if($row['canceled_order_by_customer']=='true'){
                                             echo ' <div class="col-md-6">
                                                        <p class="fs18">Order Canceled</p>
                                                    </div>';
                                         }?>
                                            
                                        </div>
                                      <?php  echo '<div class="row">
                                            <div class="col-md-2">
                                                '.$imgHtml.'
                                                <p>'.$orderCount.'</p>
                                            </div>
                                            <div class="col-md-4">
                                            <p class="theme-color mb-2">Order Id: '.$row['order_id'].'</p>
                                             <p class="pb-2 m-0 fs18">'.$pServiceName.'</p>
                                             <p>'.$pServiceDesc.'</p>
                                             
                                             <p class=" mb-0">Order Date: '.date_format(new DateTime($row['date']),"d M Y H:i").'</p>
                                             <p class="mt-2">Booking Status: '.ucfirst($bookingStatus).'</p>
                                            </div>
                                            <div class="col-md-2">
                                             <p><i class="fa fa-rupee"></i>'.number_format($row["amount"],2).'</p>
                                             <p class="mb-0" style="font-weight:500 !important">';

                                             if($row['paymentMode']=='Online'){ echo 'Online Payment';}
                                             else{echo 'Cash on Service Payment';}
                                             
                                             echo '</p>'?>

                                             <!-- <input type="button" class="btn btn-warning p-1 px-2 w-200" value="Reschedule Order"  onClick=re(<?php echo $row['order_id']?>,<?php echo $row['booking_id']?>) data-toggle="modal" data-target="#myModalRe" > -->
                                             <?php
                                            echo '
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1 theme-color"><!--i class="fa fa-clock-o"></i-->Timing: '.$row['serviceTiming'].'</p>
                                                <p class="mb-1 theme-color"><!--i class="fa fa-calendar"></i-->Date: '.$row['serviceDate'].'</p>
                                                
                                                '?>
                                                   
                                                    <?php  if($row['isreschedule']=="true"){  ?>
                                                        <p class="my-2">Order Rescheduled </p>
                                                        <p class="mb-1 theme-color">Reschedule Date: <?php echo $row['rescheduleDate'] ?></p>
                                                        <p class="mb-1 theme-color">Reschedule Timing: <?php echo $row['rescheduleTime'] ?></p>
                                                    <?php }?>
                                                    <p class="mt-2"><i class="fa fa-map-marker"></i> <?php echo $row['customer_address'] ?></p>
                                                <div>

                                               
                                            </div>
                                                <?php
                                              
                                         echo '  </div>
                                        </div>';
                                        ?>

                                        <p>
                                        <a class="btn btn-primary p-1 px-2 w-200" data-toggle="collapse" href="#items<?php echo $count;?>" role="button" aria-expanded="false" aria-controls="items<?php echo $count;?>">
                                            More Details
                                        </a> 
                                        
                                        <?php if($row['bookingStatus']!=='completed' && $row['canceled_order_by_admin']=='false' && $row['canceled_order_by_customer']=='false'){ ?>
                                         
                                            <input type="button" class="btn btn-warning p-1 px-2 w-200" value="Reschedule Order"  onClick=re(<?php echo $row['order_id']?>,<?php echo $row['booking_id']?>) data-toggle="modal" data-target="#myModalRe" >

                                             <!--a class="btn btn-warning p-1 px-2 w-200" data-toggle="collapse" href="#re<?php echo $count;?>" role="button" aria-expanded="false" aria-controls="re<?php echo $count;?>">
                                             Reschedule Order
                                            </a-->

                                            <input type="button" class="btn btn-danger p-1 px-2 w-200" value="Cancel Order"  onClick=f(<?php echo $row['order_id']?>,<?php echo $row['booking_id']?>) data-toggle="modal" data-target="#myModal" >
                                        <?php }?>
                                        </p>
                                        <div class="collapse" id="items<?php echo $count;?>">
                                        <div class="card card-body p-2 boxS">
                                             <?php    
                                                 
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
                                                    
                                                      $imgHtml1=''; 
                                                    $imgUrl1=$service['services_image'];
                                                    if($imgUrl1!=""){
                                                        if(strpos($imgUrl1,",")>-1){
                                                            $imgs1=explode(',',$imgUrl1);  
                                                            $imgHtml1.='<img width="70px" height="50px" src="'.$baseurl.'/'.'services_img/'.$imgs1[1].'" alt="'.$service["services_name"].'" id="img1" class="cart-item-image"/>';      
                                                            
                                                        }
                                                        else{
                                                            $imgHtml1='<img width="70px" height="50px" src="'.$baseurl.'/'.$imgUrl1.'" alt="'.$service["services_name"].'" class="cart-item-image" >';
                                                            
                                                        }
                                                        
                                                    }
                                                    
                                                    ?>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <!-- <img width="70px" height="50px"
                                                        src="./<?php echo $service['services_image']?>" alt=""> -->
                                                        <?php echo $imgHtml1; ?>
                                                </div>
                                                <div class="col-md-4 p-md-0"> 
                                                        <label class="control-label data">
                                                            <?php echo $service['services_name']?>
                                                        </label>  
                                                        <p class="control-label data">
                                                            <?php echo $service['services_description']?>
                                                        </p> 
                                                </div>

                                                <div class="col-md-2"> 
                                                    <label class="control-label">Quantity : <?php echo $item['quantity']?>
                                                    </label>
                                                      
                                                </div>

                                                <div class="col-md-4"> 
                                                   <label><i class="fa fa-rupee"></i><del><?php echo number_format($item["amount"],2)?></del>
                                                    <?php echo number_format($item_price,2),' ',$offer?> </label> 
                                                </div> 

                                            </div>
                                            <hr>
                                            <?php } ?>
                                        </div>
                                        </div>

                                            <!-- re schedule accoedion-->
                                            <div class="collapse" id="re<?php echo $count;?>">
                                                    <div class="card card-body p2">
                                                    <form action="<?php $baseurl?>/order-history" method="post">
                                                        <div class="row form-group">
                                                            <div class="col-md-12"> <input type="hidden" id="order_id" name="order_id" class="form-control" value="">
                                                                <input type="hidden" id="booking_id" name="booking_id" class="form-control" value="">
                                                                <label class="text-black" for="serviceDate">Service Date</label>
                                                                <input type="text" id="datepicker" name="date_picker_re" class="form-control">
                                                                <label class="text-black" for="timing">Timing</label>
                                                                <select name="timing" id="timing" class="form-control">
                                                                    <option class="form-control" value="-1">----Select Timing----</option>
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

                                                                </select> </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-12"> 
                                                                <input type="submit" name="cust_cancel_order" value="Cancel Order" class="btn btn-pil btn-primary btn-md text-white p-2 px-2 w100"> 
                                                            </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                            </div>

                                       <?php 
                                         $b_id=$row['booking_id'];
                                         $o_id=$row['order_id'];
                                         $p_id=$row['assign_partner_id'];
                                        $feedback_data_query = "select * from spa_feedback where partner_id='$p_id' and booking_id='$b_id' limit 1"; 
                                         //echo "ggggg: ".$b_id.", ".$o_id.", ".$p_id;
                                        $feedbackRow=0;
                                        $resultsf = mysqli_query($db, $feedback_data_query); 
                                        $feedbackRow=mysqli_num_rows($resultsf);
                                        if (mysqli_num_rows($resultsf) >0) {
                                             
                                             $feedbackData = mysqli_fetch_assoc($resultsf);
                                        }


                                        if(($isassign=='true' && (strtolower($row['bookingStatus'])=='accepted' || strtolower($row['bookingStatus'])=='ongoing')) || ($isassign=='true' && (strtolower($row['bookingStatus']))=='completed')){echo ' <hr>';}

                                        if($isassign!='true' && (strtolower($row['bookingStatus'])!='accepted' || strtolower($row['bookingStatus'])!='ongoing')){echo ' <hr>';}
                                        // echo $isassign;
                                        echo '
                                        <div class="row" style="';if($isassign=='true' && (strtolower($row['bookingStatus'])=='accepted' || strtolower($row['bookingStatus'])=='ongoing')){echo 'display:block;';}else{echo 'display:none';} echo '">
                                            <div class="col-md-12">
                                                <h4 class="fs18">Therapist Assigned</h4>
                                            </div>
                                           
                                           <div class="col-md-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p>Name: '.$partner_name.'</p>
                                                        <p>Contact: '.$partner_contact.'</p>
                                                        <p>Email: '.$partner_email.'</p>
                                                    </div>
                                                    <div class="';if($pProfileImg && $pProfileImg!==null && $pProfileImg!==''){echo 'd-none d-md-block';}else{echo 'd-none';}echo '">
                                                        <img  src="'.$baseurl.$pProfileImg.'" height="150" width="150">
                                                    </div>
                                                   
                                                </div>
                                                <div class="';if($pProfileImg && $pProfileImg!==null && $pProfileImg){echo 'd-md-none d-sm-block mb-3';}else{echo 'd-none';}echo '">
                                                    <img  src="'.$baseurl.$pProfileImg.'" height="150" width="150">
                                                </div> 
                                            </div>
                                            
                                            <div class="col-md-12">Share Otp when Therapist reached - '.$getPartner['partners_reach_code'].'</div>
                                            
                                        </div>
                                           
                                        <div class="row" style="';if($isassign=='false' && ($row['canceled_order_by_admin']=='false' || $row['canceled_order_by_customer']=='false')){echo 'display:block;';}else{echo 'display:none';} echo '">
                                            <div class="col-md-12">
                                                <h4 class="fs18">Therapist not assigned yet</h4>
                                            </div>
                                             
                                        </div>
                                       
                                        <div class="row" style="';if($isassign=='true' && (strtolower($row['bookingStatus']))=='completed'){echo 'display:block;';}else{echo 'display:none';} echo '">
                                        <div class="col-md-8 float-left">
                                            <h4 class="fs18">Service Completed By: </h4> 
                                            <p>Name: '.$partner_name.'</p>
                                            <p>Contact: '.$partner_contact.'</p>
                                            <p>Email: '.$partner_email.'</p> 
                                        </div>
                                        <div class="col-md-4 float-left">';
                                        if($feedbackRow==0){
                                           echo '<input type="button" class="btn btn-warning p-1 px-2 w-200" value="Share Feedback" onClick=feedbackPopup('. $row['order_id'].','.$row['booking_id'].','.$row['assign_partner_id'].') data-toggle="modal" data-target="#myModalFeedback">';
                                        }else{
                                            
                                            //echo "ra: ".$feedbackData['rate'];
                                            echo '<div>Feedback</div>';

                                            $select=$feedbackData['rate'];
                                            $a=5-$select;
                                            $j=1;

                                            for ($i=1; $i<=$select; $i++) 
                                            { 
                                                echo "<span class='star'>&#9733</span>"; 
                                                if($i==$select){
                                                    for ($j=1; $j<=$a; $j++){
                                                        echo "<span class='notStar'>&#9733</span>";
                                                    }
                                                }
                                            }
                                            
                                            echo '<p>'.$feedbackData['feedback'].'</p>';
                                        }
                                       
                                      echo ' </div>
                                         
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <p>Therapist will be assigned 60 minutes before booking time.</p>
                                        </div>
                                    </div>
                                    </div>
                                    ';
                                    $count=$count+1;
                        }
                        
                    }
                    else{
                        echo 'No Orders History';
                    }
                    ?>
                </div>
            </div>
        </div>
      </div>
    </div> 
     <input type="text"  id="date_picker1" name="serviceDate1" class="form-control" >
    <script>
     function f(v1,v2){ 
         console.log("veee",v1,v2);
            var ele=document.getElementById('canceledPopup');
           /*  var v1,v2;
            v1=v.split(',')[0];
            v2=v.split(',')[1]; */
           ele.innerHTML=' <div id="myModal" class="modal fade pr-0" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header pt-0 py-0 pb-3"> <h4 class="modal-title">Cancel Order</h4> <button type="button" class="close" data-dismiss="modal">&times;</button> <br>   </div>  <div class="modal-body"> <form action="order-history.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="order_id" name="order_id" class="form-control" value="'+v1+'">  <input type="hidden" id="booking_id" name="booking_id" class="form-control" value="'+v2+'">   <label class="text-black" for="reason">Reason</label>   <select name="reason" id="reason" class="form-control"> <option value="Order by Mistake">Order by Mistake</option>  <option value="Urgent work">Urgent Work</option>  </select>   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="cust_cancel_order" value="Cancel Order" class="btn btn-pil btn-primary btn-md text-white p-2 px-2 w100">   </div> </div>  </form>  </div> </div> </div> </div>'
        }

        function re(v1,v2){ 
         console.log("veee",v1,v2);
            var ele=document.getElementById('rePopup');
           /*  var v1,v2;
            v1=v.split(',')[0];
            v2=v.split(',')[1]; */
           ele.innerHTML=' <div id="myModalRe" class="modal fade pr-0" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header pt-0 py-0 pb-3"> <h4 class="modal-title">Reshcedule Order</h4> <button type="button" class="close" data-dismiss="modal">&times;</button> <br>   </div>  <div class="modal-body"> <form action="order-history.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="order_id" name="order_id" class="form-control" value="'+v1+'">  <input type="hidden" id="booking_id" name="booking_id" class="form-control" value="'+v2+'">'+
                '<label class="text-black" for="serviceDate">Service Date</label> '+
                  '<input type="text"  id="date_picker_re1" name="rescheduleDate" class="form-control" >'+
                    '<label class="text-black" for="timing">Timing</label>'+ 
                   '<select name="timing" id="timing" class="form-control">'+
                   '<option class="form-control" value="-1">----Select Timing----</option>'+
                    
                   '<option class="form-control" value="08:30">08:00AM-08:30AM</option>'+
                   '<option class="form-control" value="09:00">08:30AM-09:00AM</option>'+
                     '<option class="form-control" value="09:30">09:00AM-09:30AM</option>'+
                     '<option class="form-control" value="10.00">09:30AM-10.00AM</option>'+
                     '<option class="form-control" value="10:30">10:00AM-10:30AM</option>'+
                     '<option class="form-control" value="11.00">10:30AM-11.00AM</option>'+
                     '<option class="form-control" value="11:30">11:00AM-11:30AM</option>'+
                     '<option class="form-control" value="12:00">11:30AM-12.00PM</option>'+
                     '<option class="form-control" value="12:30">12:00PM-12:30PM</option>'+
                     '<option class="form-control" value="13:00">12:30PM-01:00PM</option>'+
                     '<option class="form-control" value="13:30">01:00PM-01:30PM</option>'+
                     '<option class="form-control" value="14:00">01:30PM-02:00PM</option>'+
                     '<option class="form-control" value="14:30">02:00PM-02:30PM</option>'+
                     '<option class="form-control" value="15:00">02:30PM-03:00PM</option>'+
                     ' <option class="form-control" value="15:30">03:00PM-03:30PM</option>'+
                     ' <option class="form-control" value="16:00">03:30PM-04:00PM</option>'+
                     ' <option class="form-control" value="16:30">04:00PM-04:30PM</option>'+
                     '<option class="form-control" value="17:00">04:30PM-05:00PM</option>'+
                     '<option class="form-control" value="17:30">05:00PM-05:30PM</option>'+
                     '<option class="form-control" value="18:00">05:30PM-06:00PM</option> '+
                     '<option class="form-control" value="18:30">06:00PM-06:30PM</option>'+
                     '<option class="form-control" value="19:00">06:30PM-07:00PM</option>'+
                     '<option class="form-control" value="19:30">07:00PM-07:30PM</option>'+
                      
                    
                  ' </select>   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="cust_reschedule_order" value="Reschedule Order" class="btn btn-pil btn-primary btn-md text-white p-2 px-2 w100">   </div> </div>  </form>  </div> </div> </div> </div>';
        }

        function feedbackPopup(order_id,booking_id,partner_id){ 
         console.log("veee",order_id,booking_id,partner_id);
            var ele=document.getElementById('feedback');
           /*  var v1,v2;
            v1=v.split(',')[0];
            v2=v.split(',')[1]; */
           ele.innerHTML=' <div id="myModalFeedback" class="modal fade pr-0" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header pt-0 py-0 pb-3"> <h4 class="modal-title">Share Feedback</h4> <button type="button" class="close" data-dismiss="modal">&times;</button> <br>   </div>  <div class="modal-body"> '+
           '<form action="order-history.php" method="post"> <div class="row form-group"> '+ 
           '<div class="col-md-12">  '+
           '<input type="hidden" id="order_id" name="order_id" class="form-control" value="'+order_id+'"> '+
           ' <input type="hidden" id="booking_id" name="booking_id" class="form-control" value="'+booking_id+'">'+ 
           '<input type="hidden" id="partner_id" name="partner_id" class="form-control" value="'+partner_id+'">'+   
           '<label class="text-black mb-0" for="reason">Rating</label>'+ 
           '<div class="rateContainer"><div class="rate">'+
                '<input type="radio" id="star5" name="rate" value="5" />'+
                '<label for="star5" title="text">5 stars</label>'+
                '<input type="radio" id="star4" name="rate" value="4" />'+
                '<label for="star4" title="text">4 stars</label>'+
                '<input type="radio" id="star3" name="rate" value="3" />'+
                '<label for="star3" title="text">3 stars</label>'+
                '<input type="radio" id="star2" name="rate" value="2" />'+
                '<label for="star2" title="text">2 stars</label>'+
                '<input type="radio" id="star1" name="rate" value="1" />'+
                '<label for="star1" title="text">1 star</label>'+
            '</div></div>'+
            '<div><label class="text-black" for="feedbackMsg">Feedback</label><br> '+
            '<input type="text" id="feedbackMsg" name="feedbackMsg" class="form-control"></div>'+
     '</div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="submit_feedback" value="Submit Feedback" class="btn btn-pil btn-primary btn-md text-white p-2 px-2 w100">   </div> </div>  </form>  </div> </div> </div> </div>'
        }
    
    </script>
    <div id="canceledPopup"></div>
    <div id="rePopup"></div>
    <div id="feedback"></div>
      
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear(); 
         var dd1=parseInt(dd)+4; 
        today = dd + '-' + mm + '-' + yyyy;
        week = dd1 + '-' + mm + '-' + yyyy; 
        todayDate = dd+'-'+mm+'-'+yyyy;
      

      $("body").delegate("#date_picker_re1", "focusin", function () {
        //console.log("if",today,week); 
                $(this).datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            startDate: today,
            endDate:week
            
            }).on('change', function(){
                //console.log("if else"); 
                $('.datepicker').hide();
                getDate($(this).val());
            });
        });

      function getDate(tdate){ 
        if(todayDate==tdate){ 
          var hour = new Date().getHours();
          var min = new Date().getMinutes() 
          $("#timing option").each(function() {
            var data=$(this).val(); 
            var h=data.split(':')[0]; 
            if ((hour+3)>h){ 
              $(this).prop("disabled", true);
              $('#timing').removeAttr('disabled').find('option:first');;
              $('#timing').val('-1');
            } 
          });
          
        }else{ 
            $("#timing option").each(function() {
              $(this).removeAttr('disabled');
              $('#timing').removeAttr('disabled').find('option:first');;
              $('#timing').val('-1');
            });
             
           
        }
      }
  

    </script>

 
<?php 
include 'profile-footer.php';
include 'footer.php';
?>