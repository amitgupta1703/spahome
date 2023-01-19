<?php 
$title="Become Partners";
$metaKeywords="Become Partner, Earn money,Services";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'codes/become-partner-code.php';
?>
<style>
  #spaServices .checkbox {
    background-color: #fff6f8;
    padding: 10px;
    font-size: 12px;
  }
#spaServices .checkbox input[type=checkbox]{
  margin:3px 5px 3px 15px;
}
</style>

<div class="site-blocks-cover overlay" style="background-image: url(images/become.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                           <!--  <h1 data-aos="fade-up" class="mb-5">Become Partners</h1> -->
 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mb-5 aos-init aos-animate" data-aos="fade"> 
            <form action="become-partner.php" class="p-5 bg-white"  method="post" style="margin-top: -150px;">
             <h2 class="theme-color mb-5">Become Partner</h2>
             <div style="margin-top:1rem;color:red;">
                <?php  include 'errors.php';
                
                ?>
            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php';
                  if(isset($_GET['success']) && $_GET['success']=='true'){
                    echo 'Message send successfully! we will contact you soon';
                  }
                
                ?>

            </div>
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="name">Name</label>
                  <input type="text" id="name" name="name" value="<?php if(isset($_POST['name'])) {echo $name;}?>" class="form-control">
                </div> 
                <div class="col-md-6">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $email;}?>">
                </div>
              </div> 

              <div class="row form-group">
                
                <div class="col-md-6">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) {echo $contact;}?>" maxLength="10">
                  <span id="contactNumber" class="errors"></span>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="company_name">Bussiness Name</label> 
                  <input type="text" name="company_name" id="company_name" class="form-control" value="<?php if(isset($_POST['company_name'])) {echo $company_name;}?>">
                </div>
              </div> 
              <div class="row form-group"> 
                <div class="col-md-12">
                  <label class="text-black" for="services">Services</label> 
                  <select name="services" id="services" class="form-control" onChange="locationDe(event)">
                      <option value="-1">----Book Services----</option>
                        <?php          
                          $mainCategorys=array();
                          $mainCategorys=$dbControllers->getMainCategory();
                          foreach($mainCategorys as $mainCategory)
                          {
                            $mainCatName=$mainCategory['main_category_name'];
                          ?>
                         
                          <option  <?php if(isset($_POST['services']) && $_POST['services'] ==$mainCatName){echo 'selected';}?> value="<?php echo $mainCatName?>"><?php echo $mainCatName;?></option>
                          
                          <?php  
                          }
                          ?> 
                  </select>
                 
                </div>
                <div class="col-md-12" id="spaServices"> 

                </div>
              </div> 
              
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="location">Business Address</label>
                  <input type="text" id="location" name="location" class="form-control" value="<?php if(isset($_POST['location'])) {echo $location;}?>">
                </div>
               
              </div>

              <div class="row form-group"> 
                 
                <div class="col-md-6">
                  <label class="text-black" for="city">City</label>
                  <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_POST['city'])) {echo $city;}?>">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="pincode">Pincode</label>
                  <input type="text" id="pincode" name="pincode" maxLength="6" class="form-control" value="<?php if(isset($_POST['pincode'])) {echo $pincode;}?>">
                </div>
              </div>
              <div class="row form-group"> 
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="subject">State</label> 
                  <select name="state" id="state" class="form-control">
                    <option value="-1">----Select State----</option>
                    <option value="Andhra Pradesh" <?php if(isset($_POST['state']) && $_POST['state'] =='Andhra Pradesh'){echo 'selected';}?>>Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands" <?php if(isset($_POST['state']) && $_POST['state'] =='Andaman and Nicobar Islands'){echo 'selected';}?> >Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh" <?php if(isset($_POST['state']) && $_POST['state'] =='Arunachal Pradesh'){echo 'selected';}?>>Arunachal Pradesh</option>
                    <option value="Assam" <?php if(isset($_POST['state']) && $_POST['state'] =='Assam'){echo 'selected';}?>>Assam</option>
                    <option value="Bihar" <?php if(isset($_POST['state']) && $_POST['state'] =='Bihar'){echo 'selected';}?>>Bihar</option>
                    <option value="Chandigarh" <?php if(isset($_POST['state']) && $_POST['state'] =='Chandigarh'){echo 'selected';}?>>Chandigarh</option>
                    <option value="Chhattisgarh" <?php if(isset($_POST['state']) && $_POST['state'] =='Chhattisgarh'){echo 'selected';}?>>Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli" <?php if(isset($_POST['state']) && $_POST['state'] =='Dadar and Nagar Haveli'){echo 'selected';}?>>Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu" <?php if(isset($_POST['state']) && $_POST['state'] =='Daman and Diu'){echo 'selected';}?>>Daman and Diu</option>
                    <option value="Delhi" <?php if(isset($_POST['state']) && $_POST['state'] =='Delhi'){echo 'selected';}?>>Delhi</option>
                    <option value="Lakshadweep" <?php if(isset($_POST['state']) && $_POST['state'] =='Lakshadweep'){echo 'selected';}?>>Lakshadweep</option>
                    <option value="Puducherry" <?php if(isset($_POST['state']) && $_POST['state'] =='Puducherry'){echo 'selected';}?>>Puducherry</option>
                    <option value="Goa" <?php if(isset($_POST['state']) && $_POST['state'] =='Goa'){echo 'selected';}?>>Goa</option>
                    <option value="Gujarat" <?php if(isset($_POST['state']) && $_POST['state'] =='Gujarat'){echo 'selected';}?>>Gujarat</option>
                    <option value="Haryana" <?php if(isset($_POST['state']) && $_POST['state'] =='Haryana'){echo 'selected';}?>>Haryana</option>
                    <option value="Himachal Pradesh" <?php if(isset($_POST['state']) && $_POST['state'] =='Himachal Pradesh'){echo 'selected';}?>>Himachal Pradesh</option>
                    <option value="Jammu and Kashmir" <?php if(isset($_POST['state']) && $_POST['state'] =='Jammu and Kashmir'){echo 'selected';}?>>Jammu and Kashmir</option>
                    <option value="Jharkhand" <?php if(isset($_POST['state']) && $_POST['state'] =='Jharkhand'){echo 'selected';}?>>Jharkhand</option>
                    <option value="Karnataka" <?php if(isset($_POST['state']) && $_POST['state'] =='Karnataka'){echo 'selected';}?>>Karnataka</option>
                    <option value="Kerala" <?php if(isset($_POST['state']) && $_POST['state'] =='Kerala'){echo 'selected';}?>>Kerala</option>
                    <option value="Madhya Pradesh" <?php if(isset($_POST['state']) && $_POST['state'] =='Madhya Pradesh'){echo 'selected';}?>>Madhya Pradesh</option>
                    <option value="Maharashtra" <?php if(isset($_POST['state']) && $_POST['state'] =='Maharashtra'){echo 'selected';}?>>Maharashtra</option>
                    <option value="Manipur" <?php if(isset($_POST['state']) && $_POST['state'] =='Manipur'){echo 'selected';}?>>Manipur</option>
                    <option value="Meghalaya" <?php if(isset($_POST['state']) && $_POST['state'] =='Meghalaya'){echo 'selected';}?>>Meghalaya</option>
                    <option value="Mizoram" <?php if(isset($_POST['state']) && $_POST['state'] =='Mizoram'){echo 'selected';}?>>Mizoram</option>
                    <option value="Nagaland" <?php if(isset($_POST['state']) && $_POST['state'] =='Nagaland'){echo 'selected';}?>>Nagaland</option>
                    <option value="Odisha" <?php if(isset($_POST['state']) && $_POST['state'] =='Odisha'){echo 'selected';}?>>Odisha</option>
                    <option value="Punjab" <?php if(isset($_POST['state']) && $_POST['state'] =='Punjab'){echo 'selected';}?>>Punjab</option>
                    <option value="Rajasthan" <?php if(isset($_POST['state']) && $_POST['state'] =='Rajasthan'){echo 'selected';}?>>Rajasthan</option>
                    <option value="Sikkim" <?php if(isset($_POST['state']) && $_POST['state'] =='Sikkim'){echo 'selected';}?>>Sikkim</option>
                    <option value="Tamil Nadu" <?php if(isset($_POST['state']) && $_POST['state'] =='Tamil Nadu'){echo 'selected';}?>>Tamil Nadu</option>
                    <option value="Telangana" <?php if(isset($_POST['state']) && $_POST['state'] =='Telangana'){echo 'selected';}?>>Telangana</option>
                    <option value="Tripura" <?php if(isset($_POST['state']) && $_POST['state'] =='Tripura'){echo 'selected';}?>>Tripura</option>
                    <option value="Uttar Pradesh" <?php if(isset($_POST['state']) && $_POST['state'] =='Uttar Pradesh'){echo 'selected';}?>>Uttar Pradesh</option>
                    <option value="Uttarakhand" <?php if(isset($_POST['state']) && $_POST['state'] =='Uttarakhand'){echo 'selected';}?>>Uttarakhand</option>
                    <option value="West Bengal" <?php if(isset($_POST['state']) && $_POST['state'] =='West Bengal'){echo 'selected';}?>>West Bengal</option>
                 </select>  
                </div>
            </div>

              <div class="row mt-5 form-group">
                <div class="col-md-12">
                  <input type="submit" name="submitBecomePartner" value="Submit Details" class="btn btn-pil btn-primary btn-md text-white mtb width50">
                </div>
              </div>

  
            </form>
          
          </div>
        <div class="col-md-4 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
          <div class="p-4 mb-3 bg-white books">
              <img src="images/trained.jpg" alt="Tissue" height="200"> 
            </div>
            <div class="p-4 mb-3 bg-white"> 

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+91 9818255100</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">support@spahomeservice.in</a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p> Today life get very busy and Hectic now. People are disturbed & tired mentally and Physically.</p>
              <p><a href="https://spahomeservice.in/services-list/spa-for-women" class="btn btn-primary px-4 py-2 text-white btn-pil btn-sm ptb">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
    
  <!-- Spa Home Services 
<section class="ym_easysteps form_bg">
    <div class="container">
        <span class="heading">
            <h2>
                <b>
                    Join Spa Home Service<br />
                    4 easy steps
                </b>
            </h2>
            <img src="images/Rectangle.webp" alt="" loading="lazy" />
        </span>
        <div class="steps">
            <div class="step_bx">
                <img src="images/step_1.webp" loading="lazy" />
                <h4>Step 1</h4>
                <p>Share your details</p>
            </div>
            <div class="step_bx">
                <img src="images/step_2.webp" loading="lazy" />
                <h4>Step 2</h4>
                <p>Complete your documentation</p>
            </div>
            <div class="step_bx">
               <img src="images/step_3.webp" loading="lazy" />
                <h4>Step 3</h4>
                <p>Complete training</p>
            </div>
            <div class="step_bx">
                <img src="images/step_4.webp" loading="lazy" />
                <h4>Step 4</h4>
                <p>Start job &amp; start earning</p>
            </div>
        </div>
    </div>
</section>  
     -->
 <section class="become_partner_new my-5">
<div class="container">
    <div>
        <h2><b>
                    Join Spa Home Service<br>
                    4 easy steps
                </b></h2>
                <img src="images/Rectangle.webp" alt="" loading="lazy" style="margin-bottom:30px;">
    </div>
    <div class="col-md-12">
                
                <div class="d-inline-flex w-md-25">
                    <div class="one_step">
                        <img src="images/document.gif">
                        
                    </div>
                    <div class="oned_step">
                        <h3>Step 1</h3>
                        <p>Share your details</p>
                    </div>
                </div>
                <div class="d-inline-flex w-md-25">
                    <div class="one_step">
                       <img src="images/briefcase.gif">
                    </div>
                    <div class="oned_step">
                        <h3>Step 2</h3>
                        <p>Complete your documentation</p>
                    </div>
                </div>
                <div class="d-inline-flex w-md-25">
                    <div class="one_step">
                      <img src="images/notebook.gif">
                    </div>
                    <div class="oned_step">
                          <h3>Step 3</h3>
                        <p>Complete training</p>
                    </div>
                </div>
                <div class="d-inline-flex w-md-25">
                    <div class="one_step">
                        <img src="images/money-bag.gif">
                        
                    </div>
                    <div class="oned_step">
                         <h3>Step 4</h3>
                        <p>Start job & start earning</p>
                    </div>
                </div>
            </div>
        </div>
            
        
</section>   
    
    
   <!-- <div class="block-services-1 py-5" id="become-partner">
      <div class="container">
        <div class="row" style="    align-items: center;">
          
          <div class="col-md-12 about">
            <h2 class="mb-3 mt-3">Start Work With Spa Home Service </h2>
            <ul>
                <li>1. Share Your details</li>
                <li>2. Complete Your documentation</li>
                <li>3. Complete training</li>
                <li>4. Start Work & Earn Money</li>
            </ul>
          
            
                           
 
          </div>
        </div>
      </div>
    </div>-->
    
<!-- <script type="text/javascript"
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDcFbZ9bBXviOqxPVyuLdpWtOCfgfshmzo&sensor=false&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript"> 
        $(document).ready(function() {
          var location = 'location';
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(location)), {
                types: ['geocode'],
                componentRestrictions: { country: ["in"] },
                fields: ["address_components", "geometry"],
                types: ["address"] 
            });
            var place;

            var address1;
            var postcode;
            var city;
            var country;
            var state;
            var district;

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
              place = autocomplete.getPlace();
                console.log("place");
                console.log(place);
                console.log(place.address_components);
                //place="";
                address1 = "";
                postcode = "";
                city="";
                state="";
                postcode="";

                document.querySelector("#city").value=" ";
                document.querySelector("#pincode").value=" ";
                
                for (const component of place.address_components) {
                  // @ts-ignore remove once typings fixed
                  //console.log(component);
                  const componentType = component.types[0];

                  switch (componentType) {
                    case "street_number": {
                      address1 = `${component.long_name} ${address1}`;
                      break;
                    }

                    case "route": {
                      address1 += component.short_name;
                      break;
                    }

                    case "postal_code": {
                      postcode = `${component.long_name}${postcode}`;
                      document.querySelector("#pincode").value = postcode;
                      break;
                    }

                    case "postal_code_suffix": {
                      postcode = `${postcode}-${component.long_name}`;
                      break;
                    }
                    case "locality":
                   /// console.log(locality)
                      city = component.long_name;
                      
                      break;
                    case "administrative_area_level_2": {
                      district=component.short_name; 
                      document.querySelector("#city").value = city+', '+district; 
                    break;
                    }
                    case "administrative_area_level_1": {
                      //document.querySelector("#state").value = component.short_name;
                      state=component.long_name;
                      console.log("state:: ",state);
                      //document.querySelector('select option[value=" + state +"]').selected;
                      //var e=document.getElementById('option').value ;
                      //console.log("E:: ",e);

                      //Get select object
                      var objSelect = document.getElementById("state");

                      //Set selected
                      setSelectedValue(objSelect, state);

                      function setSelectedValue(selectObj, valueToSet) {
                          for (var i = 0; i < selectObj.options.length; i++) {
                              if (selectObj.options[i].text== valueToSet) {
                                  selectObj.options[i].selected = true;
                                  return;
                              }
                          }
                      }
                      break;
                    }
                    case "country":
                      //document.querySelector("#country").value = component.long_name;
                      break;
                  }
                }
               // console.log("add: ",address1," :: post:: ",postcode," : city: ",city)
                
            });
            var ele=document.getElementById('')
        });

</script>

    
 
<?php 
include 'footer.php';
?>