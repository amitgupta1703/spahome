<?php 
$title="Contact Us";
include 'header.php';
include 'codes/contact-us-code.php';
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
            <form action="contact-us.php" method="post" class="p-5 bg-white" style="margin-top: -150px;">
             <h3 class="theme-color">Send us Query!</h3>
            <div style="margin-top:1rem;color:red;">
                                <?php  include 'errors.php' ?>
                            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php' ?>
            </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $name;}?>">
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
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" value="<?php if(isset($_POST['message'])) {echo $message;}?>" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submitContact" value="Send Message" class="btn btn-pil btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">Company address</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@spahomeservice.in</a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p> Today life get very busy and Hectic now. People are disturbed & tired mentally and Physically. Massage therapy helps improve overall health and restore the body's equilibrium and restores it to a state of pure peace. Body Massage is very much essential for relaxation of our body, muscles and to improve blood circulation reduce stress and tension, increase energy levels and improve body muscle strength.</p>
              <p><a href="services.php" class="btn btn-primary px-4 py-2 text-white btn-pil btn-sm">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>

<?php 
include 'footer.php';
?>