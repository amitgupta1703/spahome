<?php include 'header.php'?>

<?php include 'top-nav.php';?>
<?php include 'codes/generate-partners-credentials-code.php';
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

</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Partners Credentials</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>All Partners Credentials</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                         
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr><th>Id</th>
                                                <th>Username</th>
                                                <th>Password</th> 
                                                <th>Roles</th>
                                                 <th>Date</th>
                                                 <th>Status</th>
                                                 <th>Action</th>
                                                
                                                 
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            $user_check_query = "select * from admin_spa_login where roles in('partners','employee') order by id desc";
                                           
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
                                                        <td><form action="all-partners-credentials.php" method="post">';
                                                         if($row[5]=='deactive')
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