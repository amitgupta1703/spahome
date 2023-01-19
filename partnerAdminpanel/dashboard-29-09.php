<?php include 'header.php'?>

 <?php include 'top-nav.php'?>
 
 <?php 
include '../config.php';
if(isset($_SESSION['admin_UserId_partner'])){
  $partners_admin_id=$_SESSION['admin_UserId_partner'];
}
  $query="select count(*) as bookAppointment from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id'";
  $result = mysqli_query($db, $query);
  $allRecord=mysqli_fetch_assoc($result);
  
  if($allRecord>0)
  {
	  $allServices=$allRecord['bookAppointment'];
  }
  

  $alltotalOnlineAmount=0;
  $alltotalCashAmount=0;
  $completedServices="select sum(b.amount) as totalAmount from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id' and b.bookingStatus='completed' and b.paymentMode='Online' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false'" ;
  $completedServices1 = mysqli_query($db, $completedServices);
  $allRecord=mysqli_fetch_assoc($completedServices1);
  
  if($allRecord>0)
  {
	  $alltotalOnlineAmount=$allRecord['totalAmount'];
  }



  $completedCashServices="select sum(b.amount) as totalcashAmount from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id' and b.bookingStatus='completed' and b.paymentMode='Cash On Service' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false'";


  $completedCashServices1 = mysqli_query($db, $completedCashServices);
  $allRecord1=mysqli_fetch_assoc($completedCashServices1);
  
  if($allRecord1>0)
  {
	  $alltotalCashAmount=$allRecord1['totalcashAmount'];
  }else{
    
  }
 
$totalCompletedLeads;
  $completedLeadsQuery="select count(*) as completedLeads1 from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id' and sa.bookingStatus='completed' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false' ";
  $completedLeadsQuery1 = mysqli_query($db, $completedLeadsQuery);
  $allRecord=mysqli_fetch_assoc($completedLeadsQuery1);
  
  if($allRecord>0)
  {
	  $totalCompletedLeads=$allRecord['completedLeads1'];
  }

  $totalPendingLeads;
  $pendingLeadsQuery="select count(*) as completedLeads from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id' and (b.bookingStatus='pending' or b.bookingStatus='ongoing' or b.bookingStatus='accepted') and sa.isassigned='true' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false' ";
  $pendingLeadsQuery1 = mysqli_query($db, $pendingLeadsQuery);
  $allRecord=mysqli_fetch_assoc($pendingLeadsQuery1);
  
  if($allRecord>0)
  {
	  $totalPendingLeads=$allRecord['completedLeads'];
  }
 
  $totalCanceledLeads;
  $cancelLeadsQuery="select count(*) as cancelLeads from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where sa.partner_id='$partners_admin_id' and sa.isassigned='false' and sa.partner_request_status='rejected' ";
  $cancelLeadsQuery1 = mysqli_query($db, $cancelLeadsQuery);
   
  $allRecord=mysqli_fetch_assoc($cancelLeadsQuery1);
  
  if($allRecord>0)
  {
	  $totalCanceledLeads=$allRecord['cancelLeads'];
  }else{
    $totalCanceledLeads='0';
  }
   
  $totalRating=0;
  $count=0;
  $avgRating=0;
 $feedback_data_query = "select * from spa_feedback where partner_id='$partners_admin_id'"; 
 $resultsf = mysqli_query($db, $feedback_data_query);
 if (mysqli_num_rows($resultsf) >0) { 
    while($row = mysqli_fetch_assoc($resultsf)){
      $totalRating+=$row['rate'];
      $count++;
    }
    $avgRating=$totalRating/$count;
     
}
			 
?>
 
 <style>
 .totalList div
 {
	 float:left;
	 display:inline-block;
	 width:40%;
 }
 .tile_stats_count
 {
	 background-color:#2f4356;
 }
 </style>
 <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
         
          
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Leads</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-user-plus"></i> </div>
                      <div class="count green"><?php echo $allServices?></div> 
                    </div> 
                  </div>
              </a>
            </div> 

             <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?status=pending-accepted">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Pending Leads</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-hourglass-half"></i> </div>
                      <div class="count green"><?php echo $totalPendingLeads?></div> 
                    </div> 
                  </div>
              </a>
            </div> 

            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?status=rejected">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Canceled Leads</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-user-times"></i> </div>
                      <div class="count green"><?php echo $totalCanceledLeads?></div> 
                    </div> 
                  </div>
              </a>
            </div> 

             <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?status=completed">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Completed Leads</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-thumbs-o-up"></i> </div>
                      <div class="count green"><?php echo $totalCompletedLeads?></div> 
                    </div> 
                  </div>
              </a>
            </div> 
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?paymentType=online">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Online Payment</h4></span>
                    <div class="totalList">
                    
                      <div class="count green"><span class="count red "><i class="fa fa-rupee"></i> </span> <?php echo number_format($alltotalOnlineAmount,2)?></div> 
                    </div> 
                  </div>
              </a>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?paymentType=cash">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Cash Payment</h4></span>
                    <div class="totalList">
                     
                      <div class="count green"><span class="count red "><i class="fa fa-rupee"></i> </span> <?php echo number_format($alltotalCashAmount,2)?></div> 
                    </div> 
                  </div>
              </a>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="check-appointments.php?status=completed">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Customers Rating</h4></span>
                    <div class="totalList">
                     
                      <div class="count green"><span class="count red "><i class="fa fa-star"></i> </span> <?php echo number_format($avgRating,1)?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
          </div> 
        </div>
        <!-- /page content -->

<?php include 'footer.php'?>