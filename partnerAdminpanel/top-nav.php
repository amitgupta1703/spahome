 

<!-- top navigation -->
<style>
.leads{
  margin-top: 18px;
    width: 300px;
    display: inline-block;
    font-size: 16px;
    font-weight:600;
}
@media (max-width:600px){
  .leads{
    width: 180px;
  } 
  .top_nav .navbar-right { 
    width: 80%;
    }
}
@media (max-width:360px){
  .leads{
    width: 170px;
  } 
}
/* .green{
  color:green;
}
.red{
  color:red;
} */ 
</style>
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                
              </div>
               
                 
                
              <ul class="nav navbar-nav navbar-right">
              <?php 
                  $leads=0;
                  $partner_id=$_SESSION['admin_UserId_partner'];
                  $getService = "select * from partners_registration where partners_id='$partner_id'";
                  $services = mysqli_query($db, $getService);
                  $servicesDetails = mysqli_fetch_assoc($services); 
                  if ($servicesDetails) { 
                  $leads=$servicesDetails['leads'];  
                  $profileImg=$servicesDetails['profileImg'];  
                  } 
                  ?>
                  <p class="leads <?php if($leads>=10){echo 'green';}else{echo 'red';}?>" >Remianing Leads : <?php echo $leads;?></p> 
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img class="topImg" src="<?php echo $baseurl ?>/<?php if($profileImg && $profileImg!=null){echo $profileImg;}else{echo 'images/avtar.png';} ?>" alt=""><?php echo $_SESSION["U_Name_partner"]?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                     
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> 
                  </ul>
                </li> 
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->