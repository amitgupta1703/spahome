<?php include 'header.php' ;
include 'top-nav.php';
include 'codes/location-category-subcategory.php';
$data;
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=$_GET['id'];
    $user_check_query = "select * from main_category where id='$id' limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    $data=mysqli_fetch_assoc($results);
   // print_r($data);
}else{
    echo '<script>window.open("add-main-category.php", "_self")</script>';
}
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
            <form method="post" action="edit-main-category.php?id=<?php if(isset($_GET['id']) && $_GET['id']!=''){echo $_GET['id'];} ?>" data-parsley-validate="" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
              <div class="form-group">
                <div class="col-offset-3"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <div style="color:red">
                            <?php include '../errors.php'; ?>
                        </div>
                        <div style="color:green">
                            <?php include '../success.php'; ?>
                        </div> 
                    </div> 
              </div>
               
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_category_name">Main Category Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="main_category_name" required="required" name="main_category_name" class="form-control col-md-7 col-xs-12" value="<?php echo $data['main_category_name'] ?>" >
                  <input type="hidden" name="id"  value="<?php echo $data['id'] ?>" >
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
                  <input type="hidden" name="bannerImg"  value="<?php echo $data['bannerImg'] ?>" >
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadspaImg">Upload Spa Image <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Spa Image" name="uploadspaImg"  class="form-control col-md-7 col-xs-12" />
                  <input type="hidden" name="ourspaImg"  value="<?php echo $data['ourspaImg'] ?>" >
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadOfferImg">Upload Offer Image <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Spa Image" name="uploadOfferImg"  class="form-control col-md-7 col-xs-12" />
                  <input type="hidden" name="offerImg"  value="<?php echo $data['offerImg'] ?>" >
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadimage1">Upload Image1 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Image 1" name="uploadimage1"  class="form-control col-md-7 col-xs-12" />
                  <input type="hidden" name="imageUrl"  value="<?php echo $data['imageUrl'] ?>" >
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadimage2">Upload Image2 <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" placeholder="Image 2" name="uploadimage2"  class="form-control col-md-7 col-xs-12" />
                  <input type="hidden" name="imageUrl2"  value="<?php echo $data['imageUrl2'] ?>" >
                </div>
              </div>
               

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <input type="submit" class="btn btn-success" name="edit_main_category" value="Update Main Category">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


    
  </div>
</div>
</div>


<?php include 'footer.php'?>