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
        <h3>Add Subcategory</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Subcategory</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form method="post" action="add-subcategory.php" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
              <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?php include '../errors.php'; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_name">Subcategory Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="subcategory_name" required="required" name="subcategory_name" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="category" id="category" class="form-control ">
                        <option value="-1">----Select Category----</option>
                    <?php                       
                        $user_check_query = "select * from categories where status='active' order by id desc"; 
                        $results = mysqli_query($db, $user_check_query); 
                        if (mysqli_num_rows($results) >0) { 
                        while($row = mysqli_fetch_row($results)){
                                echo '<option value="'.$row[0].','.$row[1].'">  '.$row[1].'</option>'; 
                            }
                        }
                    ?>
                    </select>
                </div>
              </div>

               

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <input type="submit" class="btn btn-success" name="add_sub_category" value="Add Category">
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
                  <th>Sub Category Name</th>
                  <th>Category Id</th> 
                  <th>Category Name</th>
                  <th>Location ID</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                       
                    $user_check_query = "select * from subcategories order by id desc"; 
                    $results = mysqli_query($db, $user_check_query); 
                    if (mysqli_num_rows($results) >0) { 
                    while($row = mysqli_fetch_row($results)){
                            echo '<tr> 
                            <td><a style="color:blue;" href="edit-subcategories.php?id='.$row[0].'">Edit</a></td>
                            <td>'.$row[0].'</td>
                            <td>'.$row[1].'</td>
                            <td>'.$row[2].'</td> 
                            <td>'.$row[3].'</td>
                            <td>'.$row[4].'</td>
                            <td>'.$row[5].'</td> 
                            <td><form action="add-subcategory.php" method="post">';
                            if($row[5]=='deactive')
                            {
                              echo '
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_subcategory" class="btn btn-success" value="Activate">
                                <input type="submit" name="deactivate_subcategory" disabled class="btn btn-danger" value="Deactivate">
                                <input type="submit" name="delete_subcategory" class="btn btn-danger" value="Delete">
                                ';
                            }
                            else{
                            echo ' 
            
                                <input type="hidden" name="id" value="'.$row[0].'" />
                                <input type="submit" name="activate_subcategory" class="btn btn-success" disabled value="Activate">
                                <input type="submit" name="deactivate_subcategory" class="btn btn-danger" value="Deactivate">
                                <input type="submit" name="delete_subcategory" class="btn btn-danger" value="Delete">
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