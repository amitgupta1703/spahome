<?php 
include 'header.php';
include 'top-nav.php'; 
include 'codes/services-post-code.php';
include_once('codes/delete.php');
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
  .btnDelete{
      width:auto !important;
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
                                                <th>Main Category</th> 
                                                <th>Category</th> 
                                                <th>Sub Category</th> 
                                                <th>Duration</th>
                                                <th>Services Description</th>
                                                 <th>Amount</th>
                                                 <th>Offers Or Discount</th>
                                                 <th>Image</th>
                                                 <!-- <th>Admin Status</th> -->
                                                <!--  <th>Partners Admin ID</th>
                                                 <th>Partners Status</th> -->
                                                 <th>Status</th>
                                                 <th>Date</th>
                                                 <th>Action</th>
                                               <!--   <th>Delete</th> -->
                                                 
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            include 'dbwe.php';
                                            if( isset($_SESSION['admin_UserId_partner'])){
                                                $partner_admin_id=$_SESSION['admin_UserId_partner'];
                                            } 
                                            $user_check_query = "select * from services  order by service_id desc";
                                           
                                            $results = mysqli_query($db, $user_check_query);
								
									
                                            if (mysqli_num_rows($results) >0) {
                                            
                                            while($row = mysqli_fetch_row($results)){
                                                $imgHtml='';
                                                if($row[9]!=""){
                                                    if(strpos($row[9],",")>-1){
                                                       $imgs=explode(',',$row[9]); 
                                                       $len=count($imgs);
                                                       for($i=0;$i<$len;$i++){
                                                           if($imgs[$i]!=""){
                                                               $imgHtml.='<img src="../services_img/'.$imgs[$i].'" alt="" height="90" width="120" border="1px"/>';
                                                           }
                                                       }
                                                       
                                                    }
                                                    else{
                                                        $imgHtml='<img src="../'.$row[9].'" alt="" height="90" width="120">';
                                                        
                                                    }
                                                   
                                                 }
                                                   
                                                        if($row[8] && $row[8]>0){$offer=$row[8];}else{$offer=0;}
                                                         echo '<tr>
                                                         <td><a style="color:blue;" href="edit-services.php?service_id='.$row[0].'&editmode=true">Edit</a></td>
                                                         <td>'.$row[0].'</td>
                                                         <td>'.$row[1].'</td>
                                                         <td>'.$row[2].'</td>
                                                         <td>'.$row[3].'</td>
                                                         <td>'.$row[4].'</td>
                                                         <td>'.$row[5].'</td>
                                                         <td>'.$row[6].'</td>
                                                         <td>'.$row[7].'</td>
                                                         <td>'.$offer.'% Off</td>
                                                         <td>'.$imgHtml.'</td>  
                                                          
                                                         <td>'.$row[12].'</td>
                                                         <td>'.$row[13].'</td>  
                                                         <td><form action="posted-services.php" method="post">';
                                                         if(strtolower($row[12])=='deactive')
                                                         {
                                                           echo '
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_service" class="btn btn-success" value="Approve">
                                                             <input type="submit" name="deactivate_service" disabled class="btn btn-danger" value="Reject">
                                                             ';
                                                         }
                                                         else{
                                                          echo ' 
                                         
                                                             <input type="hidden" name="id" value="'.$row[0].'" />
                                                             <input type="submit" name="activate_service" class="btn btn-success" disabled value="Approve">
                                                             <input type="submit" name="deactivate_service" class="btn btn-danger" value="Reject">
                                                             ';
                                                         }
                                                        echo '</form></td>';
                                                        ?>
                                                        <!--  <td>
                                                             <form method="post" action="posted-services.php?action=remove">
                                                            <input type="hidden" name="p_sid" value="<?php echo $row[0] ?>" /> 
                                                             <button type="submit" onclick="return confirm('Are you sure you want to delete this item')" name="service_delete" class="btn btn-danger btnDelete"  ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> 
                                                            </form>
                                                         </td> -->
                                                       
                                                     </tr><?php 
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