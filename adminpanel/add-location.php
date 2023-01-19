<?php include 'header.php' ;
include 'top-nav.php';
include 'codes/location-category-subcategory.php';

?>

<style>
  .row {
    padding: 6px 0px !important;
  }

  button {
    width: 150px !important;
  }

  .cke_top,
  .cke_bottom {
    display: none !important;
  }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Location</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Location</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form method="post" action="add-location.php" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
              <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php include '../errors.php'; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location_name">Location Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="location_name" required="required" name="location_name" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="city" name="city" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="state" id="state" class="form-control">
                    <option value="-1">----Select State----</option>
                    <option value="Andhra Pradesh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Andhra Pradesh' ){echo 'selected';}?>>Andhra
                      Pradesh
                    </option>
                    <option value="Andaman and Nicobar Islands" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Andaman and Nicobar Islands'
                      ){echo 'selected';}?> >Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Arunachal Pradesh' ){echo
                      'selected';}?>>Arunachal Pradesh</option>
                    <option value="Assam" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Assam' ){echo 'selected';}?>>Assam</option>
                    <option value="Bihar" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Bihar' ){echo 'selected';}?>>Bihar</option>
                    <option value="Chandigarh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Chandigarh' ){echo 'selected';}?>>Chandigarh</option>
                    <option value="Chhattisgarh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Chhattisgarh' ){echo 'selected';}?>>Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Dadar and Nagar Haveli' ){echo
                      'selected';}?>>Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Daman and Diu' ){echo 'selected';}?>>Daman
                      and Diu</option>
                    <option value="Delhi" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Delhi' ){echo 'selected';}?>>Delhi</option>
                    <option value="Lakshadweep" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Lakshadweep' ){echo 'selected';}?>>Lakshadweep</option>
                    <option value="Puducherry" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Puducherry' ){echo 'selected';}?>>Puducherry</option>
                    <option value="Goa" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Goa' ){echo 'selected';}?>>Goa</option>
                    <option value="Gujarat" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Gujarat' ){echo 'selected';}?>>Gujarat</option>
                    <option value="Haryana" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Haryana' ){echo 'selected';}?>>Haryana</option>
                    <option value="Himachal Pradesh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Himachal Pradesh' ){echo
                      'selected';}?>>Himachal Pradesh</option>
                    <option value="Jammu and Kashmir" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Jammu and Kashmir' ){echo
                      'selected';}?>>Jammu and Kashmir</option>
                    <option value="Jharkhand" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Jharkhand' ){echo 'selected';}?>>Jharkhand</option>
                    <option value="Karnataka" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Karnataka' ){echo 'selected';}?>>Karnataka</option>
                    <option value="Kerala" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Kerala' ){echo 'selected';}?>>Kerala</option>
                    <option value="Madhya Pradesh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Madhya Pradesh' ){echo 'selected';}?>>Madhya
                      Pradesh
                    </option>
                    <option value="Maharashtra" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Maharashtra' ){echo 'selected';}?>>Maharashtra</option>
                    <option value="Manipur" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Manipur' ){echo 'selected';}?>>Manipur</option>
                    <option value="Meghalaya" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Meghalaya' ){echo 'selected';}?>>Meghalaya</option>
                    <option value="Mizoram" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Mizoram' ){echo 'selected';}?>>Mizoram</option>
                    <option value="Nagaland" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Nagaland' ){echo 'selected';}?>>Nagaland</option>
                    <option value="Odisha" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Odisha' ){echo 'selected';}?>>Odisha</option>
                    <option value="Punjab" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Punjab' ){echo 'selected';}?>>Punjab</option>
                    <option value="Rajasthan" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Rajasthan' ){echo 'selected';}?>>Rajasthan</option>
                    <option value="Sikkim" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Sikkim' ){echo 'selected';}?>>Sikkim</option>
                    <option value="Tamil Nadu" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Tamil Nadu' ){echo 'selected';}?>>Tamil
                      Nadu
                    </option>
                    <option value="Telangana" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Telangana' ){echo 'selected';}?>>Telangana</option>
                    <option value="Tripura" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Tripura' ){echo 'selected';}?>>Tripura</option>
                    <option value="Uttar Pradesh" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Uttar Pradesh' ){echo 'selected';}?>>Uttar
                      Pradesh
                    </option>
                    <option value="Uttarakhand" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='Uttarakhand' ){echo 'selected';}?>>Uttarakhand</option>
                    <option value="West Bengal" <?php if(isset($_POST[ 'state']) && $_POST[ 'state']=='West Bengal' ){echo 'selected';}?>>West
                      Bengal
                    </option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pincode">Pincode <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="tel" maxlength="6" id="pincode" required="required" name="pincode" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <input type="submit" class="btn btn-success" name="add_location" value="Add Location">
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
            <h2>All Locations</h2>
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
                  <th>Edit</th>
                  <th>Id</th>
                  <th>Location Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Pincode</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                       
                    $user_check_query = "select * from ourlocations order by id desc"; 
                    $results = mysqli_query($db, $user_check_query); 
                    if (mysqli_num_rows($results) >0) { 
                    while($row = mysqli_fetch_row($results)){
                            echo '<tr> 
                            <td><a style="color:blue;" href="edit-location.php?id='.$row[0].'">Edit</a></td>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            <td>'.$row[2].'</td> 
                            <td>'.$row[3].'</td>
                            <td>'.$row[4].'</td>
                            <td>'.$row[5].'</td>
                            <td>'.$row[6].'</td>  
                            <td><form action="add-location.php" method="post">';
                            if($row[5]=='deactive')
                            {
                              echo '
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_location" class="btn btn-success" value="Activate">
                                <input type="submit" name="deactivate_location" disabled class="btn btn-danger" value="Deactivate">
                                <input type="submit" name="delete_location" class="btn btn-danger" value="Delete">
                                ';
                            }
                            else{
                            echo ' 
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_location" class="btn btn-success" disabled value="Activate">
                                <input type="submit" name="deactivate_location" class="btn btn-danger" value="Deactivate">
                                <input type="submit" name="delete_location" class="btn btn-danger" value="Delete">
                                ';
                            }
                            echo '</form></td>
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
</div>


<?php include 'footer.php'?>