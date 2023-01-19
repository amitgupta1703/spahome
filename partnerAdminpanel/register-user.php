<?php include 'header.php'?>

<?php include 'top-nav.php'?>


<?php 
if(isset($_GET['reg_id'])){
    include 'delete.php';
}

include 'codes/register-codes.php'; 
?> 
<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Register User</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Register User</h2>
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
                                                <th>Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email Id</th>
                                                <th>Password</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Qualification</th>
                                                <th>Skills</th>
                                                <th>Experience</th>
                                                <th>Industries</th>
                                                <th>Resume Link</th>
                                                <th>Accept Terms</th>
                                                <th>Role</th>
                                                <th>Access Code</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            
                                            $user_check_query = "select * from career_register order by user_id desc";
                                           
                                            $results = mysqli_query($db, $user_check_query);
								
									
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
                                                         <td>'.$row[13].'</td>
                                                         <td>'.$row[14].'</td> 
                                                         <td>'.$row[15].'</td>
                                                         <td>'.$row[16].'</td>
                                                         <!-- <td><a class="resumeLink" href="register-user.php?reg_id='.$row[0].'">Delete</a></td> -->
                                                         <td><form action="register-user.php" method="post">';
                                                         if($row[15]=='Inactive')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="user_id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_user" class="btn btn-success" value="Activate User">
                                                             <input type="submit" name="deactivate_user" disabled class="btn btn-danger" value="Deactivate User">
                                                             ';
                                                         }
                                                         else{
                                                          echo ' 
                                         
                                                             <input type="hidden" name="user_id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_user" class="btn btn-success" disabled value="Activate User">
                                                             <input type="submit" name="deactivate_user" class="btn btn-danger" value="Deactivate User">
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