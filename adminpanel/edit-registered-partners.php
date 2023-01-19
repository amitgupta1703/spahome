<?php include 'header.php' ;
include 'top-nav.php';
include 'dbwe.php';
include 'codes/partners-registration-code.php';
if(isset($_GET["partners_id"]) && $_GET["partners_id"]!="")
 {
  $partners_id=$_GET["partners_id"];  
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
     $status=$row['status'];
     $leads= $row['leads']; 
     $previous_leads=$row['previous_leads'];

   }
 } 
 else{
 
  echo "<script> location.href='all-registered-partners.php'; </script>";
}
 }

 else{
  echo "<script> location.href='all-registered-partners.php'; </script>";
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
.mt20{
  margin-top:20px !important;
}
.text{
  height: 34px;
    padding: 6px 12px; 
    line-height: 1.42857143;
    color: #555;
    background-color: #fff; 
    border: 1px solid #ccc;
    width:100%;
}
.loc {
    background-color: #f1f1f1;
    padding: 10px;
    display: inline-block;
    width: 100%;
}
.chkbx{
  margin-bottom: 1rem;
}
.stateCities{
  /* border-bottom: 1px solid #d0cece; */
}
.plr15{
  padding:0px 15px !important;
}
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="col-md-9">
                  <h3>Edit Registered Partners</h3>
                </div>
                <div class="col-md-3">
                  <a class="btn btn-success" href="partners-payment.php?partners_id=<?php echo $partners_id; ?>">Transfer Payment</a>
                </div>
               
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Generate Partners</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <form  method="post" action="edit-registered-partners.php?partners_id=<?php echo $partners_id?>" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
                      <div class="form-group">
                          <div class="col-md-3"></div>
                        <div  >
                        <div style="margin-top:1rem;color:red;">
                                <?php  include '../errors.php' ?>
                            </div>
                        <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                            <?php  include '../success.php' ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="admin_username">Name<span class="required">*</span>
                        </label><br>
                        <div  >
                        <input type="hidden" id="partners_id" required="required" name="partners_id" value="<?php echo $partners_id; ?>" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="name" required="required" name="name" value="<?php echo $name; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="email">Email<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="email" required="required" name="email" value="<?php echo $email; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="contact">Contact<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="contact" required="required" name="contact" value="<?php echo $contact; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="company_name">Business Name<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="company_name" required="required" name="company_name" value="<?php echo $company_name; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="location">Business Address<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="location" required="required" name="location" value="<?php echo $location; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                     <!--  <div class="form-group col-md-4">
                        <label class="control-label " for="city">City<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="city" required="required" name="city" value="<?php echo $city; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>  -->
                      

                      <div class="form-group col-md-4">
                        <label class="control-label " for="state">State<span class="required">*</span>
                        </label><br>
                        <div  >
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

                     <div class="form-group col-md-4">
                        <label class="control-label " for="pincode">Pincode<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" id="pincode" required="required" name="pincode" value="<?php echo $pincode; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    

                      <div class="form-group col-md-4">
                        <label class="control-label " for="admin_username">Username<span class="required">*</span>
                        </label><br>
                        <div  >
                          <input type="text" readonly id="admin_username" required="required" value="<?php echo $partners_username; ?>" name="admin_username" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="form-group col-md-4">
                        <label class="control-label " for="password">Password
                        </label><br>
                        <div  >
                          <input type="password" id="password" name="password" value="<?php echo $partners_password; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="form-group col-md-4">
                        <label class="control-label" for="status">Status <span class="required">*</span>
                        </label><br>
                        <div  >
                          <select name="status" id="status" class="form-control col-md-7 col-xs-12">
                              <option value="-1">----Select Status----</option>
                              <option value="active" <?php if($status == "active") echo 'selected = "selected"'; ?>>Active</option>
                              <option value="deactive" <?php if($status == "deactive") echo 'selected = "selected"'; ?>>Deactive</option>
                          </select>
                        </div>
                      </div> 

                      <div class="form-group col-md-4">
                        <label class="control-label" for="roles">Role <span class="required">*</span>
                        </label><br>
                        <div>
                          <select name="roles" id="roles" class="form-control col-md-7 col-xs-12">
                              <option value="-1">----Select Status----</option>
                              <option value="partners" <?php if($roles == "partners") echo 'selected = "selected"'; ?>>Partners</option>
                              <option value="employee" <?php if($roles == "employee") echo 'selected = "selected"'; ?>>Employee</option>
                          </select>

                        

                        </div>
                      </div> 
 
                      <div class="form-group col-md-12 " style="background-color:#fafafa;padding-top:20px">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="locationName">Choose Cities <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="loc p-2">
                              <!-- <div id="cities">Select state first</div> -->
                                <?php  
                                 $user_check_query = "SELECT state FROM ourlocations where status='active' GROUP BY state"; 
                                 $results = mysqli_query($db, $user_check_query); 
                                 while($row = mysqli_fetch_row($results)){ 
                                   $state=$row[0];
                                  $user_check_query1 = "select * from ourlocations where state='$state' and status='active' order by id desc"; 
                                  $results1 = mysqli_query($db, $user_check_query1);
                                  
                                  if (mysqli_num_rows($results1) >0) { 
                                    echo '<div class="stateCities row  plr15"><p><b>'.$state.'</b></p>';
                                    while($row = mysqli_fetch_row($results1)){
                                            echo '<div class="chkbx col-md-6 col-xs-6 mt-2"><input type="checkbox" name="cities[]"  value="'.$row[1].'">  '.$row[1].'</div>'; 
                                            
                                        }
                                    echo '</div>';
                                    }
                                 }  
                                ?>
                            </div> 
                        </div>

                        <div class="col-md-3">
                          <label for=""><?php echo $city; ?></label>
                        </div>
                      </div> 
                      
                      <!-- <div class="ln_solid"></div> -->
                      <div class="form-group col-md-12 mt20">
                        <div> 
                          <input type="submit" class="btn btn-success" name="update_partners_registration" value="Update Registred Partners">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>


        <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Partners Leads Payment History</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                         
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="row">
                                  
                                  <div class="form-group col-md-4">
                                    <label class="control-label " for="partner_id">Partner Id
                                    </label><br>
                                    <div>
                                      <label class="text"> <?php echo $partners_id; ?></label>
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <label class="control-label " for="Available_Leads">Available Leads
                                    </label><br>
                                    <div>
                                      <label class="text"> <?php echo $leads; ?></label>
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <label class="control-label " for="p_Leads">Previous Leads
                                    </label><br>
                                    <div>
                                      <label class="text"> <?php echo $previous_leads; ?></label>
                                    </div>
                                  </div>
 
                                </div>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr> 
                                                <th>ID</th>
                                                <th>Buy Leads</th> 
                                                <th>Amount</th> 
                                                <th>Payment Status</th>
                                                <th>Payment ID</th>
                                                <th>Date</th>  
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            
                                            $user_check_query = "select * from spa_partners_leads where partner_id= $partners_id"; 
                                            $results = mysqli_query($db, $user_check_query); 
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_assoc($results)){
                                                         echo '<tr>  
                                                         <td>'.$row['id'].'</td> 
                                                         <td>'.$row['no_of_leads'].'</td> 
                                                         <td>'.$row['total_amount'].'</td> 
                                                         <td>'.$row['paymentStatus'].'</td>
                                                         <td>'.$row['paymentId'].'</td>
                                                         <td>'.$row['date'].'</td> 
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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Partner Payment History</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content"> 
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           <!--  <th>ID</th> -->
                            <th class="sorting" tabindex="0" aria-controls="datatable-checkbox" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 128px;">ID</th>
                            <th>Payment Type</th>
                            <th>UPI Id or Account Number</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Date</th>

                        </tr>
                    </thead>


                    <tbody>
                        <?php
                          $total_amount=0;  
                          $user_check_query = "select * from spa_partners_payment_history where partner_id= $partners_id"; 
                          $results = mysqli_query($db, $user_check_query); 
                            
                          if (mysqli_num_rows($results) >0) {
                          
                          while($row = mysqli_fetch_assoc($results)){
                              $total_amount+=$row['amount'];
                                echo '<tr>  
                                <td>'.$row['id'].'</td> 
                                <td>'.$row['payment_type'].'</td> 
                                <td>'.$row['upi_or_account'].'</td> 
                                <td>'.$row['transaction_id'].'</td>
                                <td>'.$row['amount'].'</td>
                                <td>'.$row['date'].'</td>  
                                </tr> 
                                
                                '; 
                              }
                              echo '<tr><td colspan="4"><h5><b>Total Amount: </b></h5></td><td><h5><b>'.number_format($total_amount,2) .'</b></h5></td></tr>';
                            }else{
                                echo '<tr><td colspan="6">No Records found</td></tr>';
                            }
                          
                          ?> 
                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Partner Rating</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> 
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!--  <th>ID</th> -->
                             
                            <th>Id</th>
                            <th>Rating</th>
                            <th>Feedback Message</th>
                            <th>feedback_date</th>

                        </tr>
                    </thead>


                    <tbody>
                        <?php
                              $total_rating=0; 
                              $count=0; 
                              $user_check_query = "select * from spa_feedback where partner_id= $partners_id"; 
                              $results = mysqli_query($db, $user_check_query); 
                                
                              if (mysqli_num_rows($results) >0) {
                              
                              while($row = mysqli_fetch_assoc($results)){
                                  $total_rating+=$row['rate'];
                                    echo '<tr>  
                                    <td>'.$row['id'].'</td> 
                                    <td>'.$row['rate'].'</td> 
                                    <td>'.$row['feedback'].'</td> 
                                    <td>'.$row['feedback_date'].'</td>  
                                    </tr> 
                                    
                                    ';  
                                    $count=$count+1;
                                  }
                                  echo '<tr><td colspan="3"><h5><b>Average Rating: </b></h5></td><td><h5><b>'.number_format((($total_rating)/$count),2) .'</b></h5></td></tr>';
                                }else{
                                    echo '<tr><td colspan="6">No Records found</td></tr>';
                                }
                              
                              ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add leads</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> 
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <form  method="post" action="edit-registered-partners.php?partners_id=<?php echo $partners_id?>" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
                      <div class="form-group">
                          <div class="col-md-3"></div>
                        <div  >
                        <div style="margin-top:1rem;color:red;">
                                <?php  include '../errors.php' ?>
                            </div>
                        <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                            <?php  include '../success.php' ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label " for="admin_username">Enter leads Quantity<span class="required">*</span>
                        </label><br>
                        <div>
                        <input type="hidden" id="partners_id" required="required" name="partners_id" value="<?php echo $partners_id; ?>" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="leads_qty" required="required" name="leads_qty"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                      <!-- <div class="ln_solid"></div> -->
                      <div class="form-group col-md-12 mt20">
                        <div> 
                          <input type="submit" class="btn btn-success" name="add_leads" value="Add Leads">
                        </div>
                      </div>

                    </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>

        
        
<?php include 'footer.php'?>