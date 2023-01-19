<?php 
$title="Become Partners";
include 'header.php';
include 'codes/become-partner-code.php';
?>


<div class="site-blocks-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                            <h1 data-aos="fade-up" class="mb-5">We give solutions to your <span class="typed-words"></span></h1>

                            <p data-aos="fade-up" data-aos-delay="100"><a href="#" class="btn btn-primary btn-pill">Get Started</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5 aos-init aos-animate" data-aos="fade"> 
            <form action="become-partner.php" class="p-5 bg-white"  method="post" style="margin-top: -150px;">
             <h2 class="theme-color mb-5">Become Partner</h2>
             <div style="margin-top:1rem;color:red;">
                                <?php  include 'errors.php' ?>
                            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php' ?>
            </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="name">Name</label>
                  <input type="text" id="name" name="name" value="<?php if(isset($_POST['name'])) {echo $name;}?>" class="form-control">
                </div> 
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $email;}?>">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) {echo $contact;}?>">
                </div>
              </div>

              <div class="row form-group"> 
                <div class="col-md-12">
                  <label class="text-black" for="company_name">Bussiness Name</label> 
                  <input type="text" name="company_name" id="company_name" class="form-control" value="<?php if(isset($_POST['company_name'])) {echo $company_name;}?>">
                </div>
              </div>

              <div class="row form-group"> 
                <div class="col-md-12">
                  <label class="text-black" for="services">Services</label> 
                  <select name="services" id="services" class="form-control">
                      <option value="-1">----Select Services----</option>
                      <option value="Ayurvedic Spa">Ayurvedic Spa</option>
                      <option value="Beauty Spa">Beauty Spa</option>
                      <option value="other spa">Other Spa</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="location">Location</label>
                  <input type="text" id="location" name="location" class="form-control" value="<?php if(isset($_POST['location'])) {echo $location;}?>">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="city">City</label>
                  <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_POST['city'])) {echo $city;}?>">
                </div>
              </div>

              <div class="row form-group"> 
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="subject">State</label> 
                  <select name="state" id="state" class="form-control">
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
                <div class="col-md-6">
                  <label class="text-black" for="pincode">Pincode</label>
                  <input type="text" id="pincode" name="pincode" class="form-control" value="<?php if(isset($_POST['pincode'])) {echo $pincode;}?>">
                </div>
              </div>


              <div class="row mt-5 form-group">
                <div class="col-md-12">
                  <input type="submit" name="submitBecomePartner" value="Submit Details" class="btn btn-pil btn-primary btn-md text-white mtb">
                </div>
              </div>

  
            </form>
            <div class="p-4 mb-3 bg-white books">
              <img src="images/deep-tissue.webp" alt="Tissue"> 
            </div>
          </div>
          <div class="col-md-5 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
          <div class="p-4 mb-3 bg-white books">
              <img src="images/deep-tissue1.webp" alt="Tissue"> 
            </div>
            <div class="p-4 mb-3 bg-white"> 

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@spahomeservice.in</a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p> Today life get very busy and Hectic now. People are disturbed & tired mentally and Physically. Massage therapy helps improve overall health and restore the body's equilibrium and restores it to a state of pure peace.</p>
              <p><a href="services.php" class="btn btn-primary px-4 py-2 text-white btn-pil btn-sm ptb">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>

<?php 
include 'footer.php';
?>