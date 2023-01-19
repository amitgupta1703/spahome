<?php 
include 'header.php' ;
include 'top-nav.php';
include 'dbwe.php';
include 'codes1/edit-profile-code.php';
 //echo "base ".$baseurl;
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg = array(); 
$baseurl=$baseurl;
  $partners_id=$_SESSION["admin_UserId_partner"];  
  $query="select * from partners_registration where partners_id = '$partners_id'  limit 1";
  $result = mysqli_query($db, $query);
 if (mysqli_num_rows($result) == 1) {
   while ($row = mysqli_fetch_array($result)) { 
     $partners_id=$row['partners_id'];
     $name=$row['name']; 
     $email= $row['email'];  

     $contact=$row['contact'];
     $company_name=$row['company_name']; 
     $location= $row['location']; 

     $city=$row['city'];
     $state=$row['state']; 
     $pincode= $row['pincode']; 

     $partners_username=$row['partners_username'];
     $partners_password=$row['partners_password']; 
     $roles= $row['roles']; 
     $status= $row['status']; 
    $profileImg=$row['profileImg']; 
    //echo 'pfppfff: '.$profileImg;
   }
 } 


 
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
  .cke_top,
  .cke_bottom {
      display: none !important;
  } 
  #spaServices .checkbox {
    background-color: #fff6f8;
    padding: 10px 30px;
    font-size: 12px;
  }
#spaServices .checkbox input[type=checkbox]{
  /* margin:3px 5px 3px 15px; */
} 
#spaServices .checkbox table{
    width:100%;
}
.plr{
    padding:0 !important;
}
.profileImg{
  background-color:#f1f1f1;
  height:130px;
  width:130px;
  cursor:pointer;
}
span.link{
  cursor:pointer;
}
.d-none{
  display:none !important;
}
.user-profile-icon{
  font-size: 18px;
  width:18px;
  margin-right:1rem;
}
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Profile</h3>
              </div>

             
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel"> 
                  <div class="x_content">
                    <br>
                    <form  method="post" action="profile.php" enctype="multipart/form-data"> 
                       <div class="col-md-3">
                         <div class="form-group">
                          <!-- <img src="images/avtar.png" class="profileImg" alt=""> -->
                          <label for="fileField"><img src="<?php if($profileImg && $profileImg!=null){echo $profileImg;}else{echo 'images/avtar.png';} ?>" class="profileImg" ><!-- <br><span class="link">Edit Image</span></label>  -->
                          
                         
                        </div>
                        <input type="file" id="fileField" name="profileImg" accept="image/*" hidden="true">
                         <!--  <input type="file" name="profileImage" id="">Change -->
                         <input type="submit" class="btn btn-warning" style="margin-top:1rem;" name="submitImg" value="Upload Image">
                       </div>
                       <div class="col-md-9">
                       <div class="form-group">
                          <h3><?php echo $name; ?></h3> 
                        </div>

                       <ul class="list-unstyled user_data">
                          <li><i class="fa fa-envelope user-profile-icon"></i><?php echo $email; ?>
                          </li>
                          <li>
                          <i class="fa fa-phone user-profile-icon"></i><?php echo $contact; ?>
                          </li>
                          <li class="m-top-xs">
                          <i class="fa fa-map-marker user-profile-icon"></i><?php echo $location.', '.$city.', '.$state.' - '.$pincode ?>
                          </li>
                      </ul>
                       
                        <!-- <div class="form-group my-2">
                          <h4><i class="fa fa-envelope ml-1"></i> <?php echo $email; ?></h4>  
                        </div>

                         <div class="form-group">
                          <h4><i class="fa fa-phone ml-1"></i> <?php echo $contact; ?></h4>  
                        </div>
                        <div class="form-group">
                          <h4><i class="fa fa-map-marker"></i> <?php echo $location.', '.$city.', '.$state.' - '.$pincode ?></h4>  
                        </div> -->

                       </div>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="profile.php?partners_id=<?php echo $partners_id?>" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
                      <div class="form-group">
                          <div class="col-md-3"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div style="margin-top:1rem;color:red;">
                                <?php  include '../errors.php' ?>
                            </div>
                        <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                            <?php  include '../success.php' ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admin_username">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" required="required" name="name" value="<?php echo $name; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" required="required" name="email" value="<?php echo $email; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Contact<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact" required="required" name="contact" value="<?php echo $contact; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name">Business Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="company_name" required="required" name="company_name" value="<?php echo $company_name; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Business Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="location" required="required" name="location" value="<?php echo $location; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="city" required="required" name="city" value="<?php echo $city; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="state" id="state" class="form-control col-md-7 col-xs-12" >
                            <option value="-1">----Select State----</option>
                            <option value="Andhra Pradesh" <?php if($state == "Andhra Pradesh") echo 'selected = "selected"'; ?>>Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands" <?php if($state == "Andaman and Nicobar Islands") echo 'selected = "selected"'; ?>>Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh" <?php if($state == "Arunachal Pradesh") echo 'selected = "selected"'; ?>>Arunachal Pradesh</option>
                            <option value="Assam" <?php if($state == "Assam") echo 'selected = "selected"'; ?>>Assam</option>
                            <option value="Bihar" <?php if($state == "Bihar") echo 'selected = "selected"'; ?>>Bihar</option>
                            <option value="Chandigarh" <?php if($state == "Chandigarh") echo 'selected = "selected"'; ?>>Chandigarh</option>
                            <option value="Chhattisgarh" <?php if($state == "Chhattisgarh") echo 'selected = "selected"'; ?>>Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli" <?php if($state == "Dadar and Nagar Haveli") echo 'selected = "selected"'; ?>>Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu" <?php if($state == "Daman and Diu") echo 'selected = "selected"'; ?>>Daman and Diu</option>
                            <option value="Delhi" <?php if($state == "Delhi") echo 'selected = "selected"'; ?>>Delhi</option>
                            <option value="Lakshadweep" <?php if($state == "Lakshadweep") echo 'selected = "selected"'; ?>>Lakshadweep</option>
                            <option value="Puducherry" <?php if($state == "Puducherry") echo 'selected = "selected"'; ?>>Puducherry</option>
                            <option value="Goa" <?php if($state == "Goa") echo 'selected = "selected"'; ?>>Goa</option>
                            <option value="Gujarat" <?php if($state == "Gujarat") echo 'selected = "selected"'; ?>>Gujarat</option>
                            <option value="Haryana" <?php if($state == "Haryana") echo 'selected = "selected"'; ?>>Haryana</option>
                            <option value="Himachal Pradesh" <?php if($state == "Himachal Pradesh") echo 'selected = "selected"'; ?>>Himachal Pradesh</option>
                            <option value="Jammu and Kashmir" <?php if($state == "Jammu and Kashmir") echo 'selected = "selected"'; ?>>Jammu and Kashmir</option>
                            <option value="Jharkhand" <?php if($state == "Jharkhand") echo 'selected = "selected"'; ?>>Jharkhand</option>
                            <option value="Karnataka" <?php if($state == "Karnataka") echo 'selected = "selected"'; ?>>Karnataka</option>
                            <option value="Kerala" <?php if($state == "Kerala") echo 'selected = "selected"'; ?>>Kerala</option>
                            <option value="Madhya Pradesh" <?php if($state == "Madhya Pradesh") echo 'selected = "selected"'; ?>>Madhya Pradesh</option>
                            <option value="Maharashtra" <?php if($state == "Maharashtra") echo 'selected = "selected"'; ?>>Maharashtra</option>
                            <option value="Manipur" <?php if($state == "Manipur") echo 'selected = "selected"'; ?>>Manipur</option>
                            <option value="Meghalaya" <?php if($state == "Meghalaya") echo 'selected = "selected"'; ?>>Meghalaya</option>
                            <option value="Mizoram" <?php if($state == "Mizoram") echo 'selected = "selected"'; ?>>Mizoram</option>
                            <option value="Nagaland" <?php if($state == "Nagaland") echo 'selected = "selected"'; ?>>Nagaland</option>
                            <option value="Odisha" <?php if($state == "Odisha") echo 'selected = "selected"'; ?>>Odisha</option>
                            <option value="Punjab" <?php if($state == "Punjab") echo 'selected = "selected"'; ?>>Punjab</option>
                            <option value="Rajasthan" <?php if($state == "Rajasthan") echo 'selected = "selected"'; ?>>Rajasthan</option>
                            <option value="Sikkim" <?php if($state == "Sikkim") echo 'selected = "selected"'; ?>>Sikkim</option>
                            <option value="Tamil Nadu" <?php if($state == "Tamil Nadu") echo 'selected = "selected"'; ?>>Tamil Nadu</option>
                            <option value="Telangana" <?php if($state == "Telangana") echo 'selected = "selected"'; ?>>Telangana</option>
                            <option value="Tripura" <?php if($state == "Tripura") echo 'selected = "selected"'; ?>>Tripura</option>
                            <option value="Uttar Pradesh" <?php if($state == "Uttar Pradesh") echo 'selected = "selected"'; ?>>Uttar Pradesh</option>
                            <option value="Uttarakhand" <?php if($state == "Uttarakhand") echo 'selected = "selected"'; ?>>Uttarakhand</option>
                            <option value="West Bengal" <?php if($state == "West Bengal") echo 'selected = "selected"'; ?>>West Bengal</option>
                          </select> 
                        </div> 
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pincode">Pincode<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pincode" required="required" name="pincode" value="<?php echo $pincode; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    
                       
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <input type="submit" class="btn btn-success" name="update_partners_registration" value="Edit Profile">
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
        function showname () {
            var name = document.getElementById('fileField'); 
            alert('Selected file: ' + name.files.item(0).name);
            alert('Selected file: ' + name.files.item(0).size);
            alert('Selected file: ' + name.files.item(0).type);
          };
        </script>
       
<?php include 'footer.php'?>