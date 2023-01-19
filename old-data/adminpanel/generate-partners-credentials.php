<?php include 'header.php' ;
include 'top-nav.php';
include 'codes/generate-partners-credentials-code.php';

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

</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Generate Partners Credentials</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Generate Partners Credentials</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="generate-partners-credentials.php" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
                      <div class="form-group">
                          <div class="col-md-3"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div style="margin-top:1rem;color:red;">
                                <?php  include '../errors.php' ?>
                            </div>
                        <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                            <?php  include '../success.php' ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admin_username">Username<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="admin_username" required="required" name="admin_username" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control col-md-7 col-xs-12">
                              <option value="-1">----Select Status----</option>
                              <option value="active">Active</option>
                              <option value="deactive">Deactive</option>
                          </select>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roles">Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="roles" id="roles" class="form-control col-md-7 col-xs-12">
                              <option value="-1">----Select Status----</option>
                              <option value="partners">Partners</option>
                              <option value="employee">Employee</option>
                          </select>
                        </div>
                      </div> 
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <input type="submit" class="btn btn-success" name="generate_partners" value="Add New Services">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        
       
<?php include 'footer.php'?>