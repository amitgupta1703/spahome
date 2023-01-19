<?php include 'header.php' ;
include 'top-nav.php';  
include 'dbwe.php';
include 'codes/partners-registration-code.php';
if(isset($_GET["partners_id"]) && $_GET["partners_id"]!="")
 {
  $partners_id=$_GET["partners_id"];  
  $query="select * from partners_registration where partners_id = '$partners_id'  limit 1";
  $result = mysqli_query($db, $query);
 if (mysqli_num_rows($result) == 1) {
   while ($row = mysqli_fetch_array($result)) { 
     $partners_id=$row['partners_id'];
     $name=$row['name']; 
     $email= $row['email'];  

     $contact=$row['contact'];
     $company_name=$row['company_name']; 
     $location= $row['location']; 

     $city=$row['city'];
     $state=$row['state']; 
     $pincode= $row['pincode']; 

     $partners_username=$row['partners_username'];
     $partners_password=$row['partners_password']; 
     $roles= $row['roles']; 
     $status=$row['status'];
     $leads= $row['leads']; 
     $previous_leads=$row['previous_leads'];

   }
 } 
 else{
 
  echo "<script> location.href='all-registered-partners.php'; </script>";
}
 }

 else{
  echo "<script> location.href='all-registered-partners.php'; </script>";
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
        <h3>Edit Category</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Category</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form method="post" action="partners-payment.php?partners_id=<?php echo $_GET['partners_id'] ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_Type">Payment Type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="payment_Type" id="payment_Type" class="form-control ">
                        <option value="-1">----Select Payment Type----</option>
                        <option value="UPI Transfer">UPI</option>
                        <option value="Account Transfer">Account Transfer</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upiAccount">UPI Id or Account Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="upiAccount" required="required" name="upiAccount" class="form-control col-md-7 col-xs-12">
                  <input type="hidden" name="partners_id" value="<?php echo $partners_id ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="t_id">Transaction Id <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="t_id" required="required" name="t_id" class="form-control col-md-7 col-xs-12"> 
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="amount" required="required" name="amount" class="form-control col-md-7 col-xs-12"> 
                </div>
              </div> 

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
                  <input type="submit" class="btn btn-success" name="payment_transfer" value="Transfer Payment">
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