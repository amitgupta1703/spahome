<?php 
$title="Book Appointment";
include 'header.php';
include 'config.php';
 
unset($errors); 
$errors = array(); 

unset($successMsg); 
$successMsg = array(); 

if(isset($_POST['submit'])){

$services=mysqli_real_escape_string($db, $_POST['services']);
$name=mysqli_real_escape_string($db, $_POST['name']);
$email =mysqli_real_escape_string($db, $_POST['email']);
$contact=mysqli_real_escape_string($db, $_POST['contact']);  
$message = mysqli_real_escape_string($db, $_POST['message']); 
//echo 's:'.$services.'::n: '.$name.' :e: '.$email.': c: '.$contact.': m: '.$message;

if (empty($name)) { array_push($errors, "Please enter  name"); }
if (empty($services)) { array_push($errors, "Please enter services"); } 
if (empty($email)) { array_push($errors, "Please enter email"); }
if (empty($contact)) { array_push($errors, "Please enter contact number"); } 
if (empty($message)) { array_push($errors, "Please enter message"); } 

$date = date('Y-m-d H:i:s');

if (count($errors) == 0) { 

    $stmt = $db->prepare("INSERT INTO book_appointment(name,email,contact,service_name,message,date) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $name, $email, $contact,$services,$message,$date);
   $stmt->execute();
 array_push($successMsg,"Message send successfully we will contact you soon!!");
      
}
}
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
            <form action="book-appointment.php?service=<?php echo $_GET['service']?>" class="p-5 bg-white" style="margin-top: -150px;" method="post"> 
            <h2 class="h1">Book Appointment</h2>
            <div style="margin-top:1rem;color:red;">
                                <?php  include 'errors.php' ?>
                            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php' ?>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="name">Service Name</label>
                  <input type="text" id="services" name="services" class="form-control" value="<?php echo $_GET['service']?>" readonly>
                </div> 
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
              </div><!-- 

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Address</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>
 -->
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" rows="3" class="form-control" placeholder="Write your notes or questions here..." value="<?php if(isset($_POST['message'])) {echo $message;}?>"></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Send Message" class="btn btn-pil btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white books">
              <img src="images/body-massage.jpg" alt="">
              <img src="images/home-massage.jpg" alt="">
            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p> Today life get very busy and Hectic now. People are disturbed & tired mentally and Physically. Massage therapy helps improve overall health and restore the body's equilibrium and restores it to a state of pure peace. Body Massage is very much essential for relaxation of our body, muscles and to improve blood circulation reduce stress and tension, increase energy levels and improve body muscle strength.</p>
              <p><a href="services.php" class="btn btn-primary px-4 py-2 text-white btn-sm">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>


<?php 
include 'footer.php';
?>