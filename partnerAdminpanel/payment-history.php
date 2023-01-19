<?php include 'header.php'?>

<?php include 'top-nav.php';
  
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
                <h3>Payment History</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
             <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Payment History</h2>
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
             </div>
          </div>
        </div>
      
<?php include 'footer.php'?>