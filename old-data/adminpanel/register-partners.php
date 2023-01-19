<?php include 'header.php'?>

<?php include 'top-nav.php'?>


<?php 


include 'codes/generate-partners-credentials-code.php'; 
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
                                                <th>Partner Id</th>
                                                <th>Name</th> 
                                                <th>Email Id</th> 
                                                <th>Contact Number</th>
                                                <th>Company Name</th>
                                                <th>Services</th>
                                                <th>Location</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <th>Date</th>
                                                <th>Status</th> 
                                                <th>Admin Details</th> 
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            
                                            $user_check_query = "select * from spa_partners order by partner_id desc"; 
                                            $results = mysqli_query($db, $user_check_query);

                                            $user_check_query1 = "select * from admin_spa_login where roles in ('partners','employee') and status='active' order by id desc"; 
                                            $results1 = mysqli_query($db, $user_check_query1);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr> 
                                                         
                                                         <td>'.$row[0].'</td>
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
                                                         <!-- <td><a class="resumeLink" href="register-user.php?reg_id='.$row[0].'">Delete</a></td> -->
                                                         <td><form action="register-partners.php" method="post">';
                                                        echo '
                                                        <input type="hidden" name="partner_id" value="'.$row[0].'" />
                                                            
                                                         <select name="admin_id" id="admin_id" class="form-control col-md-7 col-xs-12">
                                                         <option value="-1">----Select Status----</option>';
                                                         if (mysqli_num_rows($results) >0){
                                                            while($row1 = mysqli_fetch_row($results1)){ 
                                                               echo '<option value="'.$row1[0]. '">'.$row1[0].', '.$row1[1].', '.$row1[3].'</option> ';
                                                            
                                                            } 
                                                         }
                                                         echo '</select> <input type="submit" name="link_partners" class="btn btn-success form-group mt1" value="Link Partners">';
                                                        
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