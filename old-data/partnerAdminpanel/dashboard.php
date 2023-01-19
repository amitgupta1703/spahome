<?php include 'header.php'?>

 <?php include 'top-nav.php'?>
 
 <?php 
include '../config.php';
  $query="select count(*) as totalServices from career_services_amount";
  $result = mysqli_query($db, $query);
  $allRecord=mysqli_fetch_assoc($result);
  
  if($allRecord>0)
  {
	  $allServices=$allRecord['totalServices'];
  }
  
   

  $registerUser="select count(*) as registerUser from career_register";
  $result1 = mysqli_query($db, $registerUser);
  $allRecordRegisterUsers=mysqli_fetch_assoc($result1);
  
  if($allRecordRegisterUsers>0)
  {
	  $registerUser=$allRecordRegisterUsers['registerUser'];
  }

  $accessCode="select count(*) as accessCode from career_access_codes";
  $result1 = mysqli_query($db, $accessCode);
  $allRecordaccessCode=mysqli_fetch_assoc($result1);
  
  if($allRecordaccessCode>0)
  {
	  $accessCodes=$allRecordaccessCode['accessCode'];
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
          <div class="row tile_count">
            <!-- <div class="col-md-3 col-sm-4 col-xs-6 " >
              <a href="contact-user.php">
                <div class="tile_stats_count">
                    <span class="count_top"><h4> Contact Users Details</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-user-plus"></i> </div>
                      <div class="count green"><?php echo $allContact?></div> 
                    </div>
                </div>
              </a>
            </div> -->
           <!--  <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="subscribe-user.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Subscribe Users</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-bullhorn"></i> </div>
                      <div class="count green"><?php echo $allSubscribe?></div> 
                    </div> 
                  </div>
              </a>
            </div> -->
            
            <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="all-posted-jobs.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4>Access Code</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-edit"></i> </div>
                      <div class="count green"><?php echo $accessCodes?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
            <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="register-user.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Register Users</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-group"></i> </div>
                      <div class="count green"><?php echo $registerUser?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            
             <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="all-posted-services.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Total Services</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-thumbs-o-up"></i> </div>
                      <div class="count green"><?php echo $allServices?></div> 
                    </div> 
                  </div>
              </a>
            </div>
            <!--
            <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="uploaded-resumes.php">
                  <div class="tile_stats_count">
                    <span class="count_top"><h4> Uploaded Resume</h4></span>
                    <div class="totalList">
                      <div class="count red "><i class="fa fa-upload"></i> </div>
                      <div class="count green"><?php echo $alluploadedResume?></div> 
                    </div> 
                  </div>
              </a>
			      </div> -->
            
          </div> 
        </div>
        <!-- /page content -->

<?php include 'footer.php'?>