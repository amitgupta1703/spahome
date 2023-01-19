<?php include 'header.php'?>

<?php include 'top-nav.php';?>
<?php include 'codes1/services-post-code.php';
 
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
                <h3>All Posted Services</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Posted Services</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                         
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr><th>Edit</th>
                                                <th>Id</th>
                                                <th>Service Name</th> 
                                                <th>Duration</th>
                                                <th>Services Description</th>
                                                 <th>Amount</th>
                                                 <th>Offers</th>
                                                 <th>Image</th> 
                                                 <th>Admin Status</th>
                                                 <th>Status</th>
                                                 <th>Date</th>
                                                 <th>Action</th>
                                                
                                                 
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            if( isset($_SESSION['admin_UserId_partner'])){
                                                $partner_admin_id=$_SESSION['admin_UserId_partner'];
                                            } 
                                            $user_check_query = "select * from partners_services where partners_admin_id='$partner_admin_id' order by service_id desc";
                                           
                                            $results = mysqli_query($db, $user_check_query);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr>
                                                         <td><a style="color:blue;" href="edit-services.php?service_id='.$row[0].'">Edit</a></td>
                                                         <td>'.$row[0].'</td>
                                                         <td>'.$row[1].'</td>
                                                         <td>'.$row[2].'</td>
                                                         <td>'.$row[3].'</td>
                                                         <td>'.$row[4].'</td>
                                                         <td>'.$row[5].'</td>
                                                         <td><img height="100" width="120" src="../'.$row[6].'"</td>  
                                                         <td>'.$row[8].'</td> 
                                                         <td>'.$row[9].'</td> 
                                                         <td>'.$row[10].'</td> 
                                                         <td><form action="all-posted-services.php" method="post">';
                                                         if($row[9]=='deactive')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_service" class="btn btn-success" value="Activate Service">
                                                             <input type="submit" name="deactivate_service" disabled class="btn btn-danger" value="Deactivate Service">
                                                             ';
                                                         }
                                                         else{
                                                          echo ' 
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_service" class="btn btn-success" disabled value="Activate Service">
                                                             <input type="submit" name="deactivate_service" class="btn btn-danger" value="Deactivate Service">
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
    
<script>
(function(){
    $('#datatable').DataTable();
})()
</script>
<?php include 'footer.php'?>