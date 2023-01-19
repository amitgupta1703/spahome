<?php include 'header.php' ;
include 'top-nav.php';
include 'codes1/services-post-code.php';
include 'dbwe.php';

if(isset($_GET["service_id"]) && $_GET["service_id"]!="")
 {
  $service_id=$_GET["service_id"]; 
  $query="select * from partners_services where service_id = '$service_id'  limit 1";
  $result = mysqli_query($db, $query);
 if (mysqli_num_rows($result) == 1) {
   while ($row = mysqli_fetch_array($result)) { 
     $services_name=$row['services_name'];
     $services_description=$row['services_description']; 
     $amount= $row['amount'];  
     $image=$row['services_image']; 
    

   }
 } 
 }

 else{
     header("location:all-posted-services.php");
 }
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
  .cke_top,
  .cke_bottom {
      display: none !important;
  }
  .upload-btn-wrapper{ 
    cursor: pointer;
  }
  .upload-btn-wrapper img{
    border:1px solid #c2c2c2;
  }
  .upload-btn-wrapper a{
    text-decoration:underline;
    cursor: pointer;
  }
  .upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
}
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Answer Key</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Answer Key</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="edit-services.php?service_id=<?php echo $service_id ?>" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" enctype="multipart/form-data" > 
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php include '../errors.php'; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="services_name">Service Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="services_name" required="required" name="services_name" class="form-control col-md-7 col-xs-12" value="<?php echo $services_name ?>">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="services_description">Services Description 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="services_description" name="services_description" class="form-control col-md-7 col-xs-12" value="<?php echo $services_description ?>">
                        </div>
                      </div>  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="amount "  name="amount" class="form-control col-md-7 col-xs-12" value="<?php echo $amount ?>">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Image<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img  src="../<?php echo $image?>" height="100" width="120" id="img" alt="service image">
                          <div>
                            <span>Change image<input id="uploadImage" type="file"  placeholder="Service Image" name="uploadLogo" /> </span>
</div>
                          
                        </div>
                      </div> 

                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <input type="submit" class="btn btn-success" name="post_services_update" value="Update Service">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <script>
          function a(){
            var ele=document.getElementById('uploadImage');
          if(ele){
            var v=ele.value;
            setTimeout(() => {
              var img=document.getElementById('img');
            if(img){
              console.log(v);
              img.setAttribute('src',v);
            }
            }, 2000);
           
          }
          }
          
          </script>
       
<?php include 'footer.php'?>