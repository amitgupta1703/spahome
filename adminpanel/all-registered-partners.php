<?php include 'header.php'?>

<?php include 'top-nav.php'?>


<?php 
include 'dbwe.php'; 
 include 'codes/partners-registration-code.php';

?> 
<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Registered Partners</h3>
              </div> 
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Registered Partners</h2>
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
                                                <th>Partner Id</th>
                                                <th>Available Leads</th>
                                                <th>Previous Leads</th>
                                                <th>Name</th> 
                                                <th>Email Id</th> 
                                                <th>Contact Number</th>
                                                <th>Company Name</th> 
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <th>Partners Username</th>
                                                <th>Partners Password</th>
                                                <th>Roles</th>
                                                <th>Date</th>
                                                <th>Status</th>  
                                                <th>Shop Status</th> 
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            
                                            $user_check_query = "select * from partners_registration order by partners_id desc"; 
                                            $results = mysqli_query($db, $user_check_query);

                                            $user_check_query1 = "select * from admin_spa_login where roles in ('partners','employee') and status='active' order by id desc"; 
                                            $results1 = mysqli_query($db, $user_check_query1);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr> 
                                                         <td><a style="color:blue;" href="edit-registered-partners.php?partners_id='.$row[0].'">Edit</a></td>
                                                         <td>'.$row[0].'</td>
                                                         <td>'.$row[15].'</td>
                                                         <td>'.$row[16].'</td>
                                                         <td>'.$row[1].'</td> 
                                                         <td>'.$row[2].'</td> 
                                                         <td>'.$row[3].'</td>
                                                         <td>'.$row[4].'</td>
                                                         <td>'.$row[5].'</td>
                                                         <td>'.$row[6].'</td> 
                                                         <td>'.$row[7].'</td>
                                                         <td>'.$row[8].'</td>
                                                         <td>'.$row[9].'</td>
                                                         <td>'.$row[10].'</td> 
                                                         <td>'.$row[11].'</td> 
                                                         <td>'.$row[12].'</td>
                                                         <td>'.$row[13].'</td>
                                                         <td>'.$row[14].'</td>
                                                         <td><form action="all-registered-partners.php" method="post">';
                                                         if($row[13]=='deactive')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_partners" class="btn btn-success" value="Activate Partners">
                                                             <input type="submit" name="deactivate_partners" disabled class="btn btn-danger" value="Deactivate Partners">
                                                             ';
                                                         }
                                                         else{
                                                          echo ' 
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_partners" class="btn btn-success" disabled value="Activate Partners">
                                                             <input type="submit" name="deactivate_partners" class="btn btn-danger" value="Deactivate Partners">
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
    

<?php include 'footer.php'?>