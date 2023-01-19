<?php 
    include 'dbwe.php'; 
?>
  
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <div>
   
    <form action="openCloseShop.php" method="post">;
      <?php
       
   
       $ids; 
      if( isset($_SESSION['admin_UserId_partner'])){
          $ids=$_SESSION['admin_UserId_partner'];
      } 
      $user_check_query = "select * from partners_registration where partners_id='$ids' limit 1";
     
      $results = mysqli_query($db, $user_check_query); 
      if (mysqli_num_rows($results) >0) { 
      while($row = mysqli_fetch_row($results)){
        if($row[14]=='close')
        {
          echo '

            <input type="hidden" name="id" value="'.$row[0].'" />
            <input type="submit" name="open" class="btn btn-success" value="Online">
            <input type="submit" name="close" disabled class="btn btn-danger" value="Offline">
            ';
        }
        else{
        echo ' 

            <input type="hidden" name="id" value="'.$row[0].'" />
            <input type="submit" name="open" class="btn btn-success" disabled value="Online">
            <input type="submit" name="close" class="btn btn-danger" value="Offline">
            ';
        }
      }
    }
      ?>
   </form>
    </div>
    <ul class="nav side-menu">
      <li>
        <a href="<?php echo $baseurl?>/dashboard.php">
          <i class="fa fa-dashboard"></i> Dashboard
        </a>
      </li>
      <li>
        <a href="profile.php">
          <i class="fa fa-users"></i> Profile
        </a>
      </li>
      <li><a href="<?php echo $baseurl?>/check-appointments.php"><i class="fa fa-edit"></i> Booked Appointments</a>
          
      </li>
     <li>
        <a href="<?php echo $baseurl?>/change-password.php">
          <i class="fa fa-users"></i> Change Password
        </a>
      </li>
      <li>
        <a href="<?php echo $baseurl?>/buy-leads.php">
          <i class="fa fa-users"></i> Buy Leads
        </a>
      </li>
      <li>
        <a href="<?php echo $baseurl?>/payment-history.php">
          <i class="fa fa-bank"></i> Payment History
        </a>
      </li>
	
       
    </ul>
  </div>


</div>