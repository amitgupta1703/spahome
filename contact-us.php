<?php 
$title="Contact Us";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'codes/contact-us-code.php';
?>
 

<div class="site-blocks-cover overlay" style="background-image: url(images/contact-banner.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                           <!--  <h1 data-aos="fade-up" class="mb-5">Contact Us</h1>  -->
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
            <form action="<?php echo $baseurl?>/contact-us" method="post" class="p-3 bg-white" style="margin-top: -150px;">
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
                  <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $name;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                  <span id="name_error" class="errors"></span>
                </div> 
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $email;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                  <span id="email_error" class="errors"></span>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) {echo $contact;}?>" oninput="validateContact(event)" maxlength="10" onblur="validateContact(event)">
                  <span id="contact_error" class="errors"></span>
                </div>
              </div> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" value="<?php if(isset($_POST['message'])) {echo $message;}?>" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..." oninput="validateContact(event)" onblur="validateContact(event)"></textarea>
                  <span id="message_error" class="errors"></span>
                </div>
              </div>

              <div class="row form-group">

                <div class="col-md-12">
                  <!-- <div class="g-recaptcha" data-sitekey="6LcS3OIhAAAAAOG5gW4DakpRyzeoJJGNeuXdf2es"></div> -->
                  <div class="g-recaptcha" data-sitekey="6LecTuMhAAAAALQed2td5GnypJs2vyNpXEI0p2_7"></div>
                  <input type="submit" id="submitContact" disabled name="submitContact" value="Send Message" class="btn btn-pil btn-primary btn-md text-white w-100">
                </div>
              </div>

  
            </form>
           
          </div>
          <div class="col-md-5 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4 theme-color">Office: FF-2 Moolchand Tower, I Block Sector 22, Noida, U.P - 201301</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+91 9818255100</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">support@spahomeservice.in</a></p>

            </div>
             
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p> Today life get very busy and Hectic now. People are disturbed & tired mentally and Physically. Massage therapy helps improve overall health and restore the body's equilibrium and restores it to a state of pure peace. Body Massage is very much essential for relaxation of our body, muscles and to improve blood circulation reduce stress and tension, increase energy levels and improve body muscle strength.</p>
              <p><a href="<?php echo $baseurl?>/services-list/" class="btn btn-primary px-4 py-2 text-white btn-pil btn-sm">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3503.042177271302!2d77.34313826508188!3d28.59851148243115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sI%20Block%20Sector%2022%2C%20Noida!5e0!3m2!1sen!2sin!4v1662632131769!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <script>
    var flag;
    var flag2;
    var submitBtn=document.getElementById('submitContact');
    function validateContact(event){


      var target=event.target;
      
      var text;
      if(target.id=="name"){ 
        if(target.value.length==0 || target.value.trim()=="") {
          text = "Please enter name";
          name_error.innerHTML = text;
          target.style.border="1px solid red"; 
        }else{
          name_error.innerHTML = "";
          target.style.border= "1px solid #ced4da";
          flag=true;
        }
      }
      if (target.id == "email") {
            var email = target.value; 
            var regex = "[a-zA-Z0-9._+-]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z]{2,}";
            if (target.value == "" || target.value.trim() == "") {
                text = "Please enter email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red"; 
                flag=false;
                //return false;
            }else if(email.match(regex)){ 
                email_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag=true;
            } 
            else { 
                text = "Please enter valid email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag=false;  
            }
        }
      /* if(target.id=="contact"){
        var contact=target.value;
        if(contact=="" || contact.trim()=="" || isNaN(contact) || contact.length != 10){
          text = "Please enter contact number";
          contact_error.innerHTML = text;
          target.style.border="1px solid red"; 
        }else{
          contact_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      } */

      if(target.id=="contact"){
        var contact=target.value;
        if(contact=="" || contact.trim()==""){
          text = "Please enter contact number";
          contact_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else if(isNaN(contact) || contact.length != 10){
          text = "Please enter valid number";
          contact_error.innerHTML = text;
          target.style.border="1px solid red";
          flag=false;
        } 
        else{
          contact_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }
      
      if(target.id=="message"){
        var message=target.value;
        if(message=="" || message.trim()==""){
          text = "Please select date";
          message_error.innerHTML = text;
          target.style.border="1px solid red"; 
        }else if(message.trim().length<30)
        {
          text = "Message should not be less than 30 letter";
          message_error.innerHTML = text;
          target.style.border="1px solid red";
        }
        else{
          message_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }
      
    
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value; 
        var contact = document.getElementById("contact").value;
        var message = document.getElementById("message").value; 

         
        if(name=="" || name.length ==0){
            flag=false;  
        } 
        if(email.indexOf("@") == -1 || email.length ==0){
            flag=false;  
        }
        if(isNaN(contact) || contact.length != 10){
            flag=false;  
        }
        if(message=="" || message.length <30){
            flag=false;  
        } 

        //console.log("flag",flag,flag2)
        if(submitBtn && flag==true){
            //console.log("flag in id",flag,flag2)
            submitBtn.removeAttribute("disabled");
        }else if(submitBtn && (flag==false)){
            //console.log("flag in else if",flag,flag2)
            submitBtn.setAttribute("disabled","true");
        }  
 
    }
    </script>
      
<?php 
include 'footer.php';
?>