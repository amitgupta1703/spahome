<?php include 'header.php'?>
 
<?php include 'top-nav.php';?>
<?php 
include 'codes/services-post-code.php';
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
  .link{
      color:blue;
      text-decoration:underline;
      font-weight:600;
  }
  .link:hover{ 
    color:blue;
      text-decoration:none;
  }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>All Customers</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Registers Customers</h2>
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
                                                <th>Customer Id</th>
                                                <th>Name</th> 
                                                <th>Email</th>
                                                <th>Contact</th>   
                                                <th>Customer Username</th> 
                                                <th>Password</th>
                                                <th>Mobile Number Verify</th> 
                                                <th>OTP</th> 
                                                <th>Status</th>
                                                 <th>Date</th> 
                                                 
                                                
                                                  
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            
                                            $user_data_query = "select * from spa_customers order by cust_id desc"; 
                                            $results = mysqli_query($db, $user_data_query); 
                                            if (mysqli_num_rows($results) >0) { 
                                            while($row = mysqli_fetch_row($results)){
                                                         echo '<tr>
                                                         <td><a class="link" href="#">'.$row[0].'</a></td>
                                                         <td>'.$row[1].'</td>
                                                         <td>'.$row[2].'</td>
                                                         <td>'.$row[3].'</td>
                                                         <td>'.$row[6].'</td>
                                                         <td>'.$row[7].'</td>
                                                         <td>'.$row[8].'</td> 
                                                         <td>'.$row[9].'<form action="all-registered-customers.php" method="post">';
                                                         if($row[8]=='Not Verify')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="verify_customers_mobiles" class="btn btn-success" value="Verify Customers"> 
                                                             ';
                                                         }
                                                         echo '</form></td> 
                                                         <td>'.$row[11].'</td>
                                                         <td>'.$row[10].'</td>
                                                         <td><form action="all-registered-customers.php" method="post">';
                                                         if($row[11]=='deactive')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_customers" class="btn btn-success" value="Activate">
                                                             <input type="submit" name="deactivate_customers" disabled class="btn btn-danger" value="Deactivate">
                                                             ';
                                                         }
                                                         else{
                                                          echo ' 
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_customers" class="btn btn-success" disabled value="Activate">
                                                             <input type="submit" name="deactivate_customers" class="btn btn-danger" value="Deactivate">
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
        function f(v){ 
            var ele=document.getElementById('popup1');
           ele.innerHTML=' <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog">   <div class="modal-content"> <div class="modal-header">  <button type="button" class="close" data-dismiss="modal">&times;</button>  <h4 class="modal-title">Reason why you reject this service.</h4>  </div>  <div class="modal-body"> <form action="book-appointment-data.php" method="post"> <div class="row form-group">  <div class="col-md-12">  <input type="hidden" id="service_id" name="service_id" class="form-control" value="'+v+'">   <label class="text-black" for="reason">Reason</label>   <input type="text" id="reason" name="reason" class="form-control">   </div>  </div> <div class="row form-group">  <div class="col-md-12">   <input type="submit" name="submit_reason" value="Submit Reason" class="btn btn-pil btn-primary btn-md text-white">   </div> </div>  </form>  </div> </div> </div> </div>'
        }
        </script>
    <div id="popup1"></div>
<?php include 'footer.php'?>