<?php include 'header.php' ;
include 'top-nav.php';
include 'codes/partners-registration-code.php';

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
  #spaServices .checkbox {
    background-color: #fff6f8;
    padding: 10px 30px;
    font-size: 12px;
  }
#spaServices .checkbox input[type=checkbox]{
  /* margin:3px 5px 3px 15px; */
} 
#spaServices .checkbox table{
    width:100%;
}
.plr{
    padding:0 !important;
}
.loc {
    background-color: #f1f1f1;
    padding: 10px;
    display: inline-block;
    width: 100%;
}
.chkbx{
  margin-bottom: 1rem;
}
.stateCities{
  /* border-bottom: 1px solid #d0cece; */
}
.plr15{
  padding:0px 15px !important;
}
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Partners Registration</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Generate Partners</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="partners-registration.php" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" > 
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admin_username">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" required="required" name="name" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" required="required" name="email" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Contact<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact" required="required" name="contact" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name">Business Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="company_name" required="required" name="company_name" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Business Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="location" required="required" name="location" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="city" required="required" name="city" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>  -->
                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="state" id="state" class="form-control col-md-7 col-xs-12" onchange="selectState(event)" >
                            <option value="-1">----Select State----</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                          </select> 
                        </div> 
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="locationName">Choose Cities <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="loc p-2">
                              <!-- <div id="cities">Select state first</div> -->
                                <?php  
                                 $user_check_query = "SELECT state FROM ourlocations where status='active' GROUP BY state"; 
                                 $results = mysqli_query($db, $user_check_query); 
                                 while($row = mysqli_fetch_row($results)){ 
                                   $state=$row[0];
                                  $user_check_query1 = "select * from ourlocations where state='$state' and status='active' order by id desc"; 
                                  $results1 = mysqli_query($db, $user_check_query1);
                                  
                                  if (mysqli_num_rows($results1) >0) { 
                                    echo '<div class="stateCities row  plr15"><p><b>'.$state.'</b></p>';
                                    while($row = mysqli_fetch_row($results1)){
                                            echo '<div class="chkbx col-md-6 col-xs-6 mt-2"><input type="checkbox" name="cities[]"  value="'.$row[1].'">  '.$row[1].'</div>'; 
                                            
                                        }
                                    echo '</div>';
                                    }
                                 } 
                                
                                

                               /*   $user_check_query = "select * from ourlocations where status='active' order by id desc"; 
                                $results = mysqli_query($db, $user_check_query);
                                $data= mysqli_fetch_assoc($results)
                                if (mysqli_num_rows($results) >0) { 
                                while($row = mysqli_fetch_row($results)){
                                        echo '<div class="chkbx col-md-6 col-xs-6 mt-2"><input type="checkbox" name="cities[]"  value="'.$row[1].'">  '.$row[1].'</div>'; 
                                        
                                    }
                                } */
                                ?>
                            </div> 
                        </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pincode">Pincode<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pincode" required="required" name="pincode" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    <!--   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Services">Services<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control col-md-7 col-xs-12" onChange="locationDe(event)">
                                <option value="-1">----Select Services----</option>
                                <option value="Spa Services">Spa Services</option>
                                <option value="Ayurvedic Spa">Ayurvedic Spa Services</option>
                                <option value="Beauty Spa">Beauty Spa Services</option>
                                <option value="Health Tips">Health Tips Services</option>
                          </select>
                          
                          <div class="col-md-12 plr" id="spaServices">
                          </div>
                        </div>

                        
                      </div> --> 

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
                          
                          <input type="submit" class="btn btn-success" name="partners_registration" value=" Registration Partners">
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
        function locationDe(e) {
    // console.log("Function call" + e.target.value);
    if (e.target.value == "Spa Services") {
        document.getElementById("spaServices").innerHTML = '<div class="checkbox"> <table><tr><td>' +
            '<input type="checkbox" name="check_list[]"  value="Male To Male Body Massage">Male To Male Body Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Body Massage">Body Massage</br>' +
            ' <input type="checkbox" name="check_list[]" value="Deep Tissue Massage">Deep Tissue Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Female To Male Body Massage">Female To Male Body Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Male to Female Massage">Male to Female Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Female to Female Massage">Female to Female Massage</td><td>' +
            '<input type="checkbox" name="check_list[]" value="Sandwich Massage">Sandwich Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Massage at Home">Massage at Home</br>' +
            '<input type="checkbox" name="check_list[]" value="Massage at Hotel">Massage at Hotel</br>' +
            '<input type="checkbox" name="check_list[]" value="Group Body Massage">Group Body Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Aroma Massage">Aroma Massage</br>' +
            '<input type="checkbox" name="check_list[]" value="Thai Massage">Thai Massage</br>' +

            '</td><tr></div>';
    } else {
        document.getElementById("spaServices").innerHTML = '';
    }


}

function selectState(event){
  /* $.ajax({
        url: 'codes/fetch-category-ddl.php',
        type:'POST',
        dataType:"json",
        data:
        { 
          states: event.target.value
        },
        success: function(response)
        { 
             alert(response);
            $('#cities').html(response); 
        }               
    }); */
}
        </script>
       
<?php include 'footer.php'?>