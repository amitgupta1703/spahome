<?php 
$title="Contact Us";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'codes/contact-us-code.php';
?>


<div class="site-blocks-cover overlay" style="background-image: url(images/sliders/contact.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
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
            <div class="col-md-12 mb-5 aos-init aos-animate" data-aos="fade">
                <form action="<?php echo $baseurl?>/franchise" method="post" class="p-3 bg-white" style="margin-top: -150px;">
                    <h3 class="theme-color">Send us a message</h3>
                    <div style="margin-top:1rem;color:red;">
                        <?php  include 'errors.php' ?>
                    </div>
                    <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                        <?php  include 'success.php' ?>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $name;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="name_error" class="errors"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="text-black" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $email;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="email_error" class="errors"></span>
                        </div>
                    </div>

                    <div class="row form-group">


                        <div class="col-md-6">
                            <label class="text-black" for="contact">Contact Number</label>
                            <input type="text" id="contact" name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) {echo $contact;}?>" oninput="validateContact(event)" maxlength="10" onblur="validateContact(event)">
                            <span id="contact_error" class="errors"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="text-black" for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="<?php if(isset($_POST['address'])) {echo $address;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="address_error" class="errors"></span>
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-md-6">
                            <label class="text-black" for="city">City/District/Location</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_POST['city'])) {echo $city;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="city_error" class="errors"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="text-black" for="state">State</label>
                            <select name="state" required="" class="form-control">
                          <option value="-1" >--Select State--</option><option value="Andaman &amp; Nicobar Islands">Andaman &amp; Nicobar Islands</option><option value="Andhra Pradesh">Andhra Pradesh</option><option value="Arunachal Pradesh">Arunachal Pradesh</option><option value="Assam">Assam</option><option value="Bihar">Bihar</option><option value="Chandigarh">Chandigarh</option><option value="Chhattisgarh">Chhattisgarh</option><option value="Dadra &amp; Nagar Haveli &amp; Daman &amp; Diu">Dadra &amp; Nagar Haveli &amp; Daman &amp; Diu</option><option value="Delhi">Delhi</option><option value="Goa">Goa</option><option value="Gujarat">Gujarat</option><option value="Haryana">Haryana</option><option value="Himachal Pradesh">Himachal Pradesh</option><option value="Jammu &amp; Kashmir">Jammu &amp; Kashmir</option><option value="Jharkhand">Jharkhand</option><option value="Karnataka">Karnataka</option><option value="Kerala">Kerala</option><option value="Ladakh">Ladakh</option><option value="Lakshadweep">Lakshadweep</option><option value="Madhya Pradesh">Madhya Pradesh</option><option value="Maharashtra">Maharashtra</option><option value="Manipur">Manipur</option><option value="Meghalaya">Meghalaya</option><option value="Mizoram">Mizoram</option><option value="Nagaland">Nagaland</option><option value="Odisha">Odisha</option><option value="Puducherry">Puducherry</option><option value="Punjab">Punjab</option><option value="Rajasthan">Rajasthan</option><option value="Sikkim">Sikkim</option><option value="Tamil Nadu">Tamil Nadu</option><option value="Telangana">Telangana</option><option value="Tripura">Tripura</option><option value="Uttarakhand">Uttarakhand</option><option value="Uttar Pradesh">Uttar Pradesh</option><option value="West Bengal">West Bengal</option></select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="occupation">Occupation</label>
                            <input type="text" id="occupation" name="occupation" class="form-control" value="<?php if(isset($_POST['occupation'])) {echo $occupation;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="occupation_error" class="errors" ></span>
                        </div>

                        <div class="col-md-6">
                            <label class="text-black" for="workExperience">Work experience in years</label>
                            <input type="text" id="workExperience" name="workExperience" class="form-control" value="<?php if(isset($_POST['workExperience'])) {echo $workExperience;}?>" oninput="validateContact(event)" onblur="validateContact(event)">
                            <span id="workExperience_error" class="errors"></span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="message">Owner space</label> <br>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ownerspace" value="Own">Own
                  </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="ownerspace" value="Rented" checked>Rented
                  </label>
                            </div>
                        </div>

                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="message">Message</label>
                            <textarea name="message" id="message" value="<?php if(isset($_POST['message'])) {echo $message;}?>" class="form-control" placeholder="Write your query..."  ></textarea>
                            <span id="message_error" class="errors"></span>
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-md-6 mt-3"> 
                            <div class="g-recaptcha" data-sitekey="6LecTuMhAAAAALQed2td5GnypJs2vyNpXEI0p2_7"></div>
                            <input type="submit" id="submitfranchise"  name="submitfranchise" value="Submit" class="btn btn-pil btn-primary btn-md text-white w-100 mt-3">
                        </div>
                    </div>


                </form>

            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
              <h2 class="fhead">Franchise Facts</h2>
                <div class="franchiseFirstDiv"> 
                    <div>
                        <ul class="franchiseList">
                            <li>Space Required : 700-1100 Sq.Ft.</li>
                            <li>Investment: 10-12 Lakh</li> 
                            <li>Pay Back Period: 18-30 Months</li>
                            <li>Gross Margin: 60-65%</li>
                        </ul>
                    </div>
                    <div><img src="images/franchise.png" alt="Franchise"></div>
                </div>
            </div>
            <div class="col-md-6">
            <h2 class="fhead">Support</h2>
                <div class="franchiseSecondDiv">
                    <div>
                        <ul class="franchiseList">
                            <li>Online Platform </li>  
                            <li>Customer Support Team</li>
                            <li>Training Support</li>
                            <li>iOS &amp; Android App for Customer and Partners </li>
                            <li>Digital Marketing Support</li>
                        </ul>
                    </div>
                    <div><img src="images/customer-service.png" alt="Franchise"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var flag;
    var flag2;
    var submitBtn = document.getElementById('submitfranchise');

    function validateContact(event) {


        var target = event.target;

        var text;
        if (target.id == "name") {
            if (target.value.length == 0 || target.value.trim() == "") {
                text = "Please enter name";
                name_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                name_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }
        if (target.id == "email") {
            var email = target.value;
            var regex = "[a-zA-Z0-9._+-]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z]{2,}";
            if (target.value == "" || target.value.trim() == "") {
                text = "Please enter email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
                //return false;
            } else if (email.match(regex)) {
                email_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            } else {
                text = "Please enter valid email";
                email_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
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

        if (target.id == "contact") {
            var contact = target.value;
            if (contact == "" || contact.trim() == "") {
                text = "Please enter contact number";
                contact_error.innerHTML = text;
                target.style.border = "1px solid red";
                //return false;
                flag = false;
            } else if (isNaN(contact) || contact.length != 10) {
                text = "Please enter valid number";
                contact_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                contact_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

        if (target.id == "message") {
            var message = target.value;
            if (message == "" || message.trim() == "") {
                text = "Please select message";
                message_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else if (message.trim().length < 30) {
                text = "Message should not be less than 30 letter";
                message_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                message_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

        if (target.id == "address") {
            var address = target.value;
            if (address == "" || address.trim() == "") {
                text = "Please select address";
                address_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else if (address.trim().length < 10) {
                text = "Address should not be less than 10 letter";
                address_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                address_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

        if (target.id == "city") { 
            if (target.value.length == 0 || target.value.trim() == "") {
                text = "Please enter city";
                city_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                city_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

        if (target.id == "occupation") { 
            if (target.value.length == 0 || target.value.trim() == "") {
                text = "Please enter occupation";
                occupation_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
                occupation_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

        if (target.id == "workExperience") { 
            if (target.value.length == 0 || target.value.trim() == "") {
                text = "Please enter work experience";
                workExperience_error.innerHTML = text;
                target.style.border = "1px solid red";
                flag = false;
            } else {
              workExperience_error.innerHTML = "";
                target.style.border = "1px solid #ced4da";
                flag = true;
            }
        }

         

        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var contact = document.getElementById("contact").value;
        var message = document.getElementById("message").value;
        var address = document.getElementById("address").value;
        var city = document.getElementById("city").value;
        var occupation = document.getElementById("occupation").value;
        var workExperience = document.getElementById("workExperience").value;
        if (name == "" || name.length == 0) {
            flag = false;
        }
        if (email.indexOf("@") == -1 || email.length == 0) {
            flag = false;
        }
        if (isNaN(contact) || contact.length != 10) {
            flag = false;
        }
        if (message == "" || message.length < 30) {
            flag = false;
        }
        if (address == "" || address.length < 10) {
            flag = false;
        }
        if (city == "" || city.length == 0) {
            flag = false;
        }
        if (occupation == "" || occupation.length == 0) {
            flag = false;
        }
        if ( workExperience == "" || workExperience.length == 0) {
            flag = false;
            console.log("flag in id",flag,)
        }
        console.log("354 flag in id",flag,)
        //console.log("flag",flag,flag2)
        if (submitBtn && flag == true) {
            //console.log("flag in id",flag,)
           // submitBtn.removeAttribute("disabled");
        } else if (submitBtn && (flag == false)) {
            //console.log("flag in else if",flag,)
            //submitBtn.setAttribute("disabled", "true");
        }

    }
    
</script>

<?php 
include 'footer.php';
?>