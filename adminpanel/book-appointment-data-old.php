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
                                <div class="x_content">
                                    
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Booked Id</th>
                                                <th>Customer Name</th> 
                                                <th>Email</th>
                                                 <th>Contact</th>
                                                 <th>Shop Name</th>
                                                 <th>Service Name</th>
                                                 <th>Service Description</th>
                                                 <th>Service ID</th>
                                                 <th>Service Date</th>
                                                 <th>Service Timing</th>
                                                 <th>Services Want At</th>
                                                 <th>Message</th>
                                                 <th>Amount</th> 
                                                 <th>Payment Mode</th>
                                                 <th>Booking Status</th>
                                                 <th>Reason</th>
                                                 <th>Date</th>
                                                
                                                 
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            $user_check_query = "select b.id,b.email,b.name,b.contact,b.service_name,b.serviceDate,b.serviceTiming,b.serviceAt,b.message,b.amount,b.paymentMode,b.bookingStatus,b.reason,b.service_id,b.partners_admin_id,b.date,p.company_name,ps.services_description from book_appointment b join partners_registration p on b.partners_admin_id=p.partners_id join partners_services ps on b.service_id=ps.service_id  order by b.date desc";
                                           
                                            $results = mysqli_query($db, $user_check_query);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr>
                                                         <td>'.$row[0].'</td>
                                                         <td>'.$row[1].'</td>
                                                         <td>'.$row[2].'</td>
                                                         <td>'.$row[3].'</td> 
                                                         <td>'.$row[16].'</td> 
                                                         <td>'.$row[17].'</td>
                                                         <td>'.$row[4].'</td>
                                                         <td>'.$row[13].'</td> 
                                                         <td>'.$row[5].'</td>
                                                         <td>'.$row[6].'</td>
                                                         <td>'.$row[7].'</td>
                                                         <td>'.$row[8].'</td> 
                                                         <td>'.$row[9].'</td> 
                                                         <td>'.$row[10].'</td>
                                                         <td><b style="font-siZe:20px;text-transform: capitalize;">'.$row[11].'</b><br><p style="padding-top:1rem;">';
                                                         if($row[11]=='pending')
                                                         {
                                                           echo '
                                         
                                                           <form action="book-appointment-data.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service">
                                                             <input type="submit" name="complete_service" class="btn btn-primary" value="Complete Service">
                                                             </form> 
                                                             <input type="submit" name="reject_service" class="btn btn-danger" onClick=f('.$row[0].') data-toggle="modal" data-target="#myModal"  value="Reject Service">
                                                             ';
                                                         }
                                                         else if($row[11]=='rejected')
                                                         {
                                                           echo '
                                         
                                                           <form action="book-appointment-data.php" method="post">
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="accept_service" class="btn btn-success" value="Accept Service">

                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="pending_service" class="btn btn-warning" value="Pending Service">
                                                             </form>  
                                                             ';
                                                         }
                                                         else if($row[11]=='completed')
                                                         {
                                                           echo '
                                         
                                                           <form action="book-appointment-data.php" method="post"> 
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="pending_service" class="btn btn-warning" value="Pending Service">
                                                             </form>  
                                                             ';
                                                         }
                                                         else{
                                                          echo '  
                                                          <form action="book-appointment-data.php" method="post"> 
                                                          <input type="hidden" name="id" value="'.$row[0].'" /> 
                                                          <input type="submit" name="complete_service" class="btn btn-primary" value="Complete Service">
                                                          </form>  
                                                             ';
                                                         }
                                                        echo '</p> 
                                                         
                                                         </td> 
                                                         <td>'.$row[12].'</td> 
                                                         <td>'.$row[15].'</td> 
                                                          
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
           ele.innerHTML=' <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header">  <button type="button" class="close" data-dismiss="modal">&times;</button>  <h4 class="modal-title">Reason why you reject this service.</h4>  </div>  <div class="modal-body"> <form action="book-appointment-data.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="service_id" name="service_id" class="form-control" value="'+v+'">   <label class="text-black" for="reason">Reason</label>   <input type="text" id="reason" name="reason" class="form-control">   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="submit_reason" value="Submit Reason" class="btn btn-pil btn-primary btn-md text-white">   </div> </div>  </form>  </div> </div> </div> </div>'
        }
        </script>
    <div id="popup1"></div>
<?php include 'footer.php'?>