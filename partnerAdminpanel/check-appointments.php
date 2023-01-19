<?php include 'header.php'?>

<?php include 'top-nav.php';
 
include 'codes1/services-post-code.php';
$service_id;
?>




<style>
  .row
  {
  padding:6px 0px !important;
  }
  button
  {
  width:150px !important;
  }
.link{
    color:blue;
    text-decoration:underline; 
}
.link:hover{
    color:blue;
    text-decoration:none;
    
}
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Check Booked Appointment</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>All Booked Appointment</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                         
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                  
                                            <?php
                                            include 'dbwe.php';
                                            $user_data_query;
                                            if(isset($_SESSION['admin_UserId_partner']) && $_SESSION['admin_UserId_partner']!=""){
                                                $partners_admin_id=$_SESSION['admin_UserId_partner'];
                                            } 

                                            if(isset($_GET['status']) && $_GET['status']!=''){
                                                $status=$_GET['status'];
                                                //echo "status: ".$status;
                                                $pending='';
                                                $accepted='';
                                                if($status=='pending-accepted'){
                                                   // echo 'pending if'; 
                                                    $pending=explode("-",$status)[0];
                                                    $accepted=explode("-",$status)[1];
                                                    $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                                                    b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                                                    b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                                                    b.cust_address_id,b.session_id,b.reason,b.isassigned,sa.partner_id,sa.isassigned,sa.id,b.canceled_order_by_admin,b.admin_reason,b.canceled_order_by_customer,b.cust_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                                    from book_appointment b
                                                    join orders_details o on o.order_id=b.orderId
                                                    join spa_assign_lead sa on o.order_id=sa.order_id
                                                    where sa.partner_id='$partners_admin_id' and (b.bookingStatus='$pending' or b.bookingStatus='$accepted') and sa.isassigned='true' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false' order by b.id DESC
                                                    ";
                                                }
                                                else{
                                                    //echo 'pending elaes'; 
                                                    $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                                                    b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                                                    b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                                                    b.cust_address_id,b.session_id,b.reason,b.isassigned,sa.partner_id,sa.isassigned,sa.id,b.canceled_order_by_admin,b.admin_reason,b.canceled_order_by_customer,b.cust_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                                    from book_appointment b
                                                    join orders_details o on o.order_id=b.orderId
                                                    join spa_assign_lead sa on o.order_id=sa.order_id
                                                    where sa.partner_id='$partners_admin_id' and b.bookingStatus='$status' and sa.isassigned='true' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false' order by b.id DESC
                                                    ";
                                                }
                                                
                                            }else  if(isset($_GET['paymentType']) && $_GET['paymentType']!=''){
                                                //echo 'paymentType if'; 
                                                $paymentMode=$_GET['paymentType'];
                                                if($paymentMode=='cash'){
                                                    $paymentMode='Cash On Service';
                                                }
                                                //echo "paymentMode: ".$paymentMode;
                                                $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                                                b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                                                b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                                                b.cust_address_id,b.session_id,b.reason,b.isassigned,sa.partner_id,sa.isassigned,sa.id,b.canceled_order_by_admin,b.admin_reason,b.canceled_order_by_customer,b.cust_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                                from book_appointment b
                                                join orders_details o on o.order_id=b.orderId
                                                join spa_assign_lead sa on o.order_id=sa.order_id
                                                where sa.partner_id='$partners_admin_id' and b.paymentMode='$paymentMode' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false' order by b.id DESC;
                                                ";
                                            }else{
                                                //echo 'all else'; 
                                                $user_data_query = "select 
                                                o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id, b.customer_address,
                                                b.cust_address_id,b.session_id,b.reason,b.isassigned,sa.partner_id,sa.isassigned,sa.id,b.canceled_order_by_admin,b.admin_reason,b.canceled_order_by_customer,b.cust_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                                from book_appointment b
                                                join orders_details o on o.order_id=b.orderId
                                                join spa_assign_lead sa on o.order_id=sa.order_id
                                                where sa.partner_id='$partners_admin_id' and  sa.isassigned='true' order by b.id DESC
                                                ";
                                            }

                                            if(isset($_GET['status']) &&  $_GET['status']=='rejected'){ 
                                                
                                                    
                                                    
                                                
                                            ?>
                                                    <table id="datatable" class="table table-striped table-bordered">
                                                    <thead> 
                                                        <tr> 
    
                                                            <th>Booking Id</th>  
                                                            <th>Customer Name</th> 
                                                            <th>Email</th>
                                                            <th>Contact</th> 
                                                            <th>Amount</th>  
                                                            <th>Your Status</th>
                                                            <th>Reason</th>
                                                            <th>Services Date</th>
                                                            <th>Services Timing</th>
                                                            <th>Booking Date</th> 
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
    
                                                <?php
                                                $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                                                b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                                                b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                                                b.cust_address_id,b.session_id,b.reason,b.isassigned,sa.partner_id,sa.isassigned,sa.id,sa.partner_request_status,sa.partner_reason,b.canceled_order_by_admin,b.admin_reason,b.canceled_order_by_customer,b.cust_reason,b.canceled_datetime,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                                from book_appointment b
                                                join orders_details o on o.order_id=b.orderId
                                                join spa_assign_lead sa on o.order_id=sa.order_id
                                                where sa.partner_id='$partners_admin_id' and partner_request_status='rejected' order by b.id DESC
                                                ";
                                               
                                                $results = mysqli_query($db, $user_data_query);
                                    
                                        
                                                if (mysqli_num_rows($results) >0) {
                                                
                                                while($row = mysqli_fetch_assoc($results)){
                                                    $ids= $row['booking_id'].','.$row['id'];
                                                             echo '<tr>
                                                             <td><a class="link" href="order-details.php?o_id='.$row['order_id'].'">'.$row['order_id'].'</td>
                                                               
                                                             <td>'.$row['name'].'</td>
                                                             <td>'.$row['email'].'</td> 
                                                             <td>'.$row['contact'].'</td> 
                                                             <td>'.$row['amount'].'</td> 
                                                             <td>'.$row['partner_request_status'].'</td> 
                                                             <td>'.$row['partner_reason'].'</td>  
                                                             <td>'.date_format(new DateTime($row['serviceDate']),"d-m-Y").'</td> 
                                                             <td>'.$row['serviceTiming'].'</td> 
                                                             <td>'.date_format(new DateTime($row['date']),"d M Y H:i").'</td> 
                                                            
                                                             
                                                              
                                                         </tr> ';
                                                           }
                                                        }
                                                         
                                                    }
                                                else{
                                                    ?>
                                                    <table id="datatable" class="table table-striped table-bordered">
                                                <thead> 
                                                    <tr> 

                                                        <th>Booking Id</th> 
                                                        <th>Is Assigned</th> 
                                                        <th>Is Reshchedule</th> 
                                                        <th>Order Status</th>
                                                        <th>Customer Name</th> 
                                                        <th>Email</th>
                                                        <th>Contact</th> 
                                                        <th>Amount</th> 
                                                        <th>Payment Mode</th>
                                                        <th>Payment Status</th>
                                                        <th>Booking Status</th> 
                                                        <th>Reason</th>
                                                        <th>Services Date</th>
                                                        <th>Services Timing</th>
                                                        <th>Reschedule Date</th>
                                                        <th>Reschedule Timing</th>
                                                        <th>Booking Date</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>

                                            <?php
                                           
                                            $results = mysqli_query($db, $user_data_query);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                                
                                            while($row = mysqli_fetch_assoc($results)){
                                                $ids= $row['booking_id'].','.$row['id'];
                                                         echo '<tr>
                                                         <td><a class="link" href="order-details.php?o_id='.$row['order_id'].'">'.$row['order_id'].'</td>
                                                          
                                                         <td>'.$row['isassigned'].'</td>
                                                         <td>'.$row['isreschedule'].'</td>';
                                                          
                                                          if(($row['canceled_order_by_admin']=='false' && $row['canceled_order_by_customer']=='false')){echo '<td>Order Booked';}else{echo '<td style="background-color:red;color:#fff"> Order Canceled';} echo '</td>
                                                         <td>'.$row['name'].'</td>
                                                         <td>'.$row['email'].'</td> 
                                                         <td>'.$row['contact'].'</td>
                                                         <!--td>'.$row['customer_address'].'</td-->  
                                                         <!--td>'.$row['amount'].'</td-->
                                                         <td>'.$row['amount'].'</td>
                                                         <td>'.$row['paymentMode'].'</td>
                                                         <td>'.$row['paymentStatus'].'</td>
                                                         ';
                                                         if($row['canceled_order_by_admin']=='false' && $row['canceled_order_by_customer']=='false'){
                                                             echo '<td><b style="font-siZe:20px;text-transform: capitalize;">'.$row['bookingStatus'].'</b><br><p style="padding-top:1rem;">';
                                                         if($row['bookingStatus']=='pending')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-appointments.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row['booking_id'].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service"> 
                                                             </form> 
                                                             <input type="submit" name="reject_service" class="btn btn-danger" onClick=f('.$ids.') data-toggle="modal" data-target="#myModal"  value="Reject Service">
                                                             ';
                                                         }
                                                         else if($row['bookingStatus']=='rejected')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-appointments.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row['booking_id'].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service">

                                                             <input type="hidden" name="id" value="'.$row['booking_id'].'" />
                                                             <input type="submit" name="pending_service" class="btn btn-warning" value="Pending Service">
                                                             </form>  
                                                             ';
                                                         }
                                                         else if($row['bookingStatus']=='completed')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-appointments.php" method="post"> 
                                                             
                                                             </form>  
                                                             ';
                                                         }
                                                         else{
                                                          echo '  
                                                          <form action="check-appointments.php" method="post"> 
                                                          <input type="hidden" name="id" value="'.$row['booking_id'].'" /> 
                                                          <input type="hidden" name="assign_id" value="'.$row['id'].'" />
                                                          <input type="submit" name="complete_service" class="btn btn-primary" value="Complete Service">
                                                          </form>  
                                                             ';
                                                         }
                                                        }else{
                                                            echo "<td style='background-color:red;color:#fff'><span >Order Canceled "?> <?php if($row['canceled_order_by_admin']=='true'){echo 'by Admin';}else {echo 'by Customer';} ?>  <?php "</span>";
                                                        }
                                                        echo '</p> 
                                                         
                                                         </td> 
                                                         <td>';if($row['canceled_order_by_admin']=='true' || $row['canceled_order_by_admin']!='' || $row['canceled_order_by_admin']!='null'){if($row['admin_reason']!=''){echo $row['admin_reason'];}else{echo $row['cust_reason'];}}else{echo $row['reason'];} echo '</td>  
                                                         <td>'.date_format(new DateTime($row['serviceDate']),"d-m-Y").'</td> 
                                                         <td>'.$row['serviceTiming'].'</td> 
                                                         <td>'.$row['rescheduleDate'].'</td> 
                                                         <td>'.$row['rescheduleTime'].'</td> 
                                                         <td>'.date_format(new DateTime($row['date']),"d M Y H:i").'</td> 
                                                        
                                                         
                                                          
                                                     </tr> ';
                                                       }
                                                    }
                                                }
                                            ?>
                                         
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
             </div>
          </div>
        </div>
        <script>
        function f(v1,v2){ 
            var ele=document.getElementById('popup1');
            
           ele.innerHTML=' <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header">  <button type="button" class="close" data-dismiss="modal">&times;</button>  <h4 class="modal-title">Reason why you reject this service.</h4>  </div>  <div class="modal-body"> <form action="check-appointments.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="service_id" name="service_id" class="form-control" value="'+v1+'">  <input type="hidden" id="assign_id" name="assign_id" class="form-control" value="'+v2+'">   <label class="text-black" for="reason">Reason</label>   <input type="text" id="reason" name="reason" class="form-control">   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="submit_reason" value="Submit Reason" class="btn btn-pil btn-primary btn-md text-white">   </div> </div>  </form>  </div> </div> </div> </div>'
        }
        </script>
    <div id="popup1"></div>

<?php include 'footer.php'?>