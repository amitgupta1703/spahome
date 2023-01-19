<?php include 'header.php'?>

 <?php include 'top-nav.php'?>
 
 <?php 
 include "dbwe.php";
  $query="select count(*) as totalUserContact from user_contact";
  $result = mysqli_query($db, $query);
  $allRecord=mysqli_fetch_assoc($result);
  
  if($allRecord>0)
  {
	  $allUserContact=$allRecord['totalUserContact'];
  }
  
   

  $registerUser="select count(*) as registerPartner from spa_partners";
  $result1 = mysqli_query($db, $registerUser);
  $allRecordRegisterPartner=mysqli_fetch_assoc($result1);
  
  if($allRecordRegisterPartner>0)
  {
	  $allBecomePartners=$allRecordRegisterPartner['registerPartner'];
  }

  $appointmentBook="select count(*) as appointmentBooks from book_appointment";
  $result1 = mysqli_query($db, $appointmentBook);
  $allappointmentBooked=mysqli_fetch_assoc($result1);
  
  if($allappointmentBooked>0)
  {
	  $allappointmentBooked1=$allappointmentBooked['appointmentBooks'];
  }

  $registerUser1="select count(*) as registeredPartner from partners_registration";
  $result1 = mysqli_query($db, $registerUser1);
  $allRecordRegisterPartner1=mysqli_fetch_assoc($result1);
  
  if($allRecordRegisterPartner1>0)
  {
	  $allPartnersRegistration=$allRecordRegisterPartner1['registeredPartner'];
  } 


  $customerQuery="select count(*) as customers from spa_customers";
  $customerQueryresult1 = mysqli_query($db, $customerQuery);
  $allRecordRegisterCustomers=mysqli_fetch_assoc($customerQueryresult1);
  
  if($allRecordRegisterCustomers>0)
  {
	  $allRecordRegisterCustomers1=$allRecordRegisterCustomers['customers'];
  } 


  
  $alltotalOnlineAmount=0;
  $alltotalCashAmount=0;
  $completedServices="select sum(b.amount) as totalAmount from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where  b.bookingStatus='completed' and b.paymentMode='Online' and b.canceled_order_by_admin='false' and b.canceled_order_by_customer='false'" ;
  $completedServices1 = mysqli_query($db, $completedServices);
  $allRecord=mysqli_fetch_assoc($completedServices1);
  
  if($allRecord>0)
  {
	  $alltotalOnlineAmount=$allRecord['totalAmount'];
  }



  $completedCashServices="select sum(b.amount) as totalcashAmount from book_appointment b join spa_assign_lead sa on b.orderId=sa.order_id where b.bookingStatus='completed' and b.paymentMode='Cash On Service' and (b.canceled_order_by_admin='false' or sa.canceled_order_by_admin='') and (b.canceled_order_by_customer='false' or sa.canceled_order_by_customer='')";


  $completedCashServices1 = mysqli_query($db, $completedCashServices);
  $allRecord1=mysqli_fetch_assoc($completedCashServices1);
  
  if($allRecord1>0)
  {
	  $alltotalCashAmount=$allRecord1['totalcashAmount'];
  }else{
    
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
              <a href="book-appointment-data.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Appointment Booked</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-group"></i> </div>
                      <div class="count green"><?php echo $allappointmentBooked1?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="all-user-contact.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>User Contact</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-edit"></i> </div>
                      <div class="count green"><?php echo $allUserContact?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="register-partners.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Become Partners</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-group"></i> </div>
                      <div class="count green"><?php echo $allBecomePartners?></div> 
                    </div> 
                  </div>
              </a>
            </div>
 
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="all-registered-partners.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>All Registered Partners</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-group"></i> </div>
                      <div class="count green"><?php echo $allPartnersRegistration?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="all-registered-customers.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Customers</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-group"></i> </div>
                      <div class="count green"><?php echo $allRecordRegisterCustomers1?></div> 
                    </div> 
                  </div>
              </a>
            </div>

             <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="book-appointment-data.php?paymentType=online">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Online Payment</h4></span>
                    <div class="totalList">
                    
                      <div class="count green"><span class="count red "><i class="fa fa-rupee"></i> </span> <?php echo number_format($alltotalOnlineAmount,2)?></div> 
                    </div> 
                  </div>
              </a>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-6 tile_count">
              <a href="book-appointment-data.php?paymentType=cash">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Total Cash Payment</h4></span>
                    <div class="totalList">
                     
                      <div class="count green"><span class="count red "><i class="fa fa-rupee"></i> </span> <?php echo number_format($alltotalCashAmount,2)?></div> 
                    </div> 
                  </div>
              </a>
            </div>

            </div>
            
          </div> 
        </div>
        <!-- /page content -->

<?php include 'footer.php'?>