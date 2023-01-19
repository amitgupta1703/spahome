<?php include 'header.php'?>
 
<?php include 'top-nav.php';?>
<?php 
include 'codes/services-post-code.php';
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
      font-weight:600;
  }
  .link:hover{ 
    color:blue;
      text-decoration:none;
  }
  .red{
      background-color:red;
      color:#fff;
  }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Booked Appointment</h3>
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
                                <div class="x_content" style="overflow-y:auto;">
                                    
                                    <table id="" class="table table-striped table-bordered  " >
                                        <thead>
                                            <tr>
                                                <th>Order Details</th>
                                                <th>Booking Id</th> 
                                                <th>Is Assigned</th> 
                                                <th>Is Reshchedule</th> 
                                                <th>Partner Id</th>
                                                <th>Leads Tarnsfer To Partner Name</th> 
                                                <th>Customer Name</th> 
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Order Canceled by Admin</th>
                                                <th>Order Canceled by Customer</th> 
                                                 <th>Amount</th> 
                                                 <th>Payment Mode</th>
                                                 <th>Payment Status</th>
                                                 <th>Booking Status</th> 
                                                 <th>Reason</th>
                                                 <th>Services Date</th>
                                                 <th>Services Timing</th>
                                                 <th>Reschedule Date</th>
                                                 <th>Reschedule Timing</th>
                                                 <th>Date</th>
                                                
                                                  
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            
                                            $user_data_query = "select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,b.paymentStatus,
                                            b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.message,
                                            b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                                            b.cust_address_id,b.session_id,b.reason,b.isassigned,b.assign_partner_id,b.assign_partner_name,b.canceled_order_by_admin,b.canceled_order_by_customer,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                                            from book_appointment b
                                            join orders_details o on o.order_id=b.orderId
                                             order by b.date desc
                                            ";
                                           
                                            $results = mysqli_query($db, $user_data_query);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr>
                                                         <td><a class="link" href="booking-orders-details.php?o_id='.$row[0].'">'.$row[0].'</td>
                                                         <td>'.$row[1].'</td>
                                                         <td>'.$row[24].'</td>
                                                         <td>'.$row[29].'</td>
                                                         <td>'.$row[25].'</td>
                                                         <td>'.$row[26].'</td>
                                                         <td>'.$row[8].'</td>
                                                         <td>'.$row[9].'</td> 
                                                         
                                                         <td>'.$row[10].'</td>
                                                         <td class="';if($row[27]=='true'){echo 'red';}echo '">'.$row[27].'</td>
                                                         <td class="';if($row[28]=='true'){echo 'red';}echo '">'.$row[28].'</td>
                                                          
                                                         <td>'.$row[15].'</td>
                                                         <td>'.$row[16].'</td>
                                                         <td>'.$row[6].'</td>
                                                         <td><b style="font-siZe:20px;text-transform: capitalize;">'.$row[17].'</b><br><p style="padding-top:1rem;">';
                                                         if($row[17]=='pending')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-leads.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service">
                                                             <input type="submit" name="complete_service" class="btn btn-primary" value="Complete Service">
                                                             </form> 
                                                             <input type="submit" name="reject_service" class="btn btn-danger" onClick=f('.$row[0].') data-toggle="modal" data-target="#myModal"  value="Reject Service">
                                                             ';
                                                         }
                                                         else if($row[17]=='rejected')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-leads.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service">

                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="pending_service" class="btn btn-warning" value="Pending Service">
                                                             </form>  
                                                             ';
                                                         }
                                                         else if($row[17]=='completed')
                                                         {
                                                           echo '
                                         
                                                           <form action="check-leads.php" method="post"> 
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="pending_service" class="btn btn-warning" value="Pending Service">
                                                             </form>  
                                                             ';
                                                         }
                                                         else{
                                                          echo '  
                                                          <form action="check-leads.php" method="post"> 
                                                          <input type="hidden" name="id" value="'.$row[0].'" /> 
                                                          <input type="submit" name="complete_service" class="btn btn-primary" value="Complete Service">
                                                          </form>  
                                                             ';
                                                         }
                                                        echo '</p> 
                                                         
                                                         </td> 
                                                         <td>'.$row[23].'</td>  
                                                         <td>'.date_format(new DateTime($row[12]),"d-m-Y").'</td> 
                                                         <td>'.$row[13].'</td> 
                                                         <td>'.$row[30].'</td> 
                                                         <td>'.$row[31].'</td> 
                                                         <td>'.date_format(new DateTime($row[3]),"d M Y H:i").'</td> 
                                                        
                                                         
                                                          
                                                     </tr> ';
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
        function f(v){ 
            var ele=document.getElementById('popup1');
           ele.innerHTML=' <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header">  <button type="button" class="close" data-dismiss="modal">&times;</button>  <h4 class="modal-title">Reason why you reject this service.</h4>  </div>  <div class="modal-body"> <form action="check-leads.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="service_id" name="service_id" class="form-control" value="'+v+'">   <label class="text-black" for="reason">Reason</label>   <input type="text" id="reason" name="reason" class="form-control">   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="submit_reason" value="Submit Reason" class="btn btn-pil btn-primary btn-md text-white">   </div> </div>  </form>  </div> </div> </div> </div>'
        }
        </script>
    <div id="popup1"></div>
<?php include 'footer.php'?>