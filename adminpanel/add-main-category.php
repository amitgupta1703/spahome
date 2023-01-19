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
  .loc{
    background-color: #f1f1f1;
    padding: 10px;
  }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add Main Category</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Category</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form method="post" action="add-main-category.php" data-parsley-validate="" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
              <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php include '../errors.php'; ?>
                </div>
              </div>
               
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_category_name">Main Category Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="main_category_name" required="required" name="main_category_name" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="locationName">Choose Location Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="loc p-2">
                        <?php                       
                        $user_check_query = "select * from ourlocations where status='active' order by id desc"; 
                        $results = mysqli_query($db, $user_check_query); 
                        if (mysqli_num_rows($results) >0) { 
                        while($row = mysqli_fetch_row($results)){
                                echo '<input type="checkbox" name="main_check_list[]"  value="'.$row[1].'">  '.$row[1].'</br>'; 
                            }
                        }
                        ?>
                    </div> 
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadBannerImg">Upload Banner Image <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Banner Image" name="uploadBannerImg"  class="form-control col-md-7 col-xs-12" />
              
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadspaImg">Upload Spa Image <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Spa Image" name="uploadspaImg"  class="form-control col-md-7 col-xs-12" />
              
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadOfferImg">Upload Offer Image <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Spa Image" name="uploadOfferImg"  class="form-control col-md-7 col-xs-12" />
              
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadimage1">Upload Image1 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Image 1" name="uploadimage1"  class="form-control col-md-7 col-xs-12" />
              
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadimage2">Upload Image2 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Image 2" name="uploadimage2"  class="form-control col-md-7 col-xs-12" />
               
                </div>
              </div>
               

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <input type="submit" class="btn btn-success" name="add_main_category" value="Add Main Category">
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
                  <!-- <th>Edit</th> -->
                  <th>Edit</th>
                  <th>Id</th>
                  <th>Main Category Name</th>
                  <th>Locations</th>    
                  <th>Status</th>
                  <th>Banner Image</th>
                  <th>Our Spa Image</th>
                  <th>Offers Image</th>
                  <th>Image 1</th>
                  <th>Image 2</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                       
                    $user_check_query = "select * from main_category order by id desc"; 
                    $results = mysqli_query($db, $user_check_query); 
                    if (mysqli_num_rows($results) >0) { 
                    while($row = mysqli_fetch_row($results)){
                            echo '<tr> 
                            <td><a href="edit-main-category.php?id='.$row[0].'">Edit</a></td>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            <td>'.$row[4].'</td> 
                            <td>'.$row[2].'</td> 
                            <td>'.$row[6].'<br><img height="100px" width="130px" src="../'.$row[6].'" ></td> 
                            <td>'.$row[7].'<br><img height="100px" width="130px" src="../'.$row[7].'" ></td> 
                            <td>'.$row[8].'<br><img height="100px" width="130px" src="../'.$row[8].'" ></td> 
                            <td>'.$row[3].'<br><img height="100px" width="130px" src="../'.$row[3].'" ></td>
                            <td>'.$row[9].'<br><img height="100px" width="130px" src="../'.$row[9].'" ></td> 
                            <td>'.$row[5].'</td>
                            
                            <td><form action="add-main-category.php" method="post">';
                            if($row[2]=='deactive')
                            {
                              echo '
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_main_category" class="btn btn-success" value="Activate ">
                                <input type="submit" name="deactivate_main_category" disabled class="btn btn-danger" value="Deactivate">
                                <!--input type="submit" name="delete_main_category" class="btn btn-danger" value="Delete"-->
                                ';
                            }
                            else{
                            echo ' 
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_main_category" class="btn btn-success" disabled value="Activate">
                                <input type="submit" name="deactivate_main_category" class="btn btn-danger" value="Deactivate">
                                <!--input type="submit" name="delete_main_category" class="btn btn-danger" value="Delete"-->
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