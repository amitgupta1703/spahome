<?php include 'header.php' ;
include 'top-nav.php';
include 'codes1/buy-leads-code.php';

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
                <h3>Change Password</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change Password</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="buy-leads.php" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
                      <div class="form-group">
                          <div class="col-md-3"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div style="margin-top:1rem;color:red;">
                                  <?php  include '../errors.php' ?>
                              </div>
                          <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                              <?php  include '../success.php' ?>
                          </div>
                          <h3>1 Lead = <i class="fa fa-rupee"></i>177(150 + 18% GST)</h3>
                        </div>
                      </div>
                       
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="noOfLeads">No of Leads <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                          <span><i>Minimum purchase leads is 10</i></span><br>
                          <input type="text" id="noOfLeads" onInput="getNoOfLeads(event)" required="required" name="noOfLeads" class="form-control col-md-7 col-xs-12">
                          <span id="leads_error" style="margin-top:0.5rem;color:red;"></span>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="totalAmount">Total Leads Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="totalAmount" required="required" readonly name="totalAmount" class="form-control col-md-7 col-xs-12">
                          <span id="leads_error" style="margin-top:0.5rem;color:red;"></span>
                        </div>
                      </div> 
 
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <input type="submit" class="btn btn-success" name="buy_leads" value="Buy Leads">
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
            function getNoOfLeads(e){ 
                var noLeads=e.target.value;
                var totalAmount;
                var getEle=document.getElementById('totalAmount');
                var leads_error=document.getElementById('leads_error');
                if(isNaN(noLeads)==false && noLeads>=5){ 
                    totalAmount=noLeads*177;
                    if(getEle){
                        getEle.value=totalAmount;
                        leads_error.innerText="";
                    }
                }else{
                   if(leads_error){
                    leads_error.innerText="Please enter leads greater than or equal to 5";
                   }
                   if(getEle){
                        getEle.value="";
                    }
                }
            }
        
        </script>
       
<?php include 'footer.php'?>