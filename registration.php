<?php 
$title="Registration";
include 'header.php';
include 'codes/login-code.php';
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
            <div class="col-md-2"></div>
          <div class="col-md-6 offset-md-1 mb-5 aos-init aos-animate" data-aos="fade"> 
            <form action="registration.php" method="post" class="p-3 bg-white">
             <h3  class="theme-color text-center">Registration</h3>
            <div style="margin-top:1rem;color:red;">
                <?php  include 'errors.php' ?>
            </div>
            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                <?php  include 'success.php' ?>
            </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $name;}?>" oninput="validate(event)" onblur="validate(event)">
                  <span id="name_error" class="errors"></span>
                </div> 
              </div>

              <div class="row form-group"> 
                <div class="col-md-12 ">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $email;}?>" oninput="validate(event)" onblur="validate(event)">
                  <span id="email_error" class="errors"></span>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="contact">Contact Number</label> 
                  <input type="text" id="contact" name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) {echo $contact;}?>" maxlength="10" oninput="validate(event)" onblur="validate(event)">
                  <span id="contact_error" class="errors"></span>
                </div>
              </div> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="password">Password</label> 
                  <input type="password" id="password" name="password" class="form-control" oninput="validate(event)" onblur="validate(event)">
                  <span id="password_error" class="errors"></span>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="confirmpassword">Confirm Password</label> 
                  <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" oninput="validate(event)" onblur="validate(event)">
                  <span id="confirmpassword_error" class="errors"></span>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" id="registerSubmit" disabled style="width:100% !important" name="register" value="Register" class="btn btn-pil btn-primary btn-md text-white btnblack">
                  <br>
                  <p class="mt-3 text-center">Having account? <a href="<?php $baseurl?>/login">Login</a></p>
                  
                </div>
              </div>
            
  
            </form>
          </div>
          <div class="col-md-2 aos-init aos-animate" data-aos="fade" data-aos-delay="100">
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
            </div>
          

          </div>
        </div>
      </div>
    </div>
    <script>
     var flag;
    var flag2;
    var submitBtn=document.getElementById('registerSubmit');
    function validate(event){ 
      var target=event.target; 
      var text;
      if(target.id=="name"){
        console.log("isNaN(target.value)",!isNaN(target.value),target.value.length)
        if(target.value.length==0 || target.value.trim()=="") {
          text = "Please enter name";
          name_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          name_error.innerHTML = "";
          target.style.border= "1px solid #ced4da";
          flag=true;
        }
      }
      if(target.id=="email"){
        var email=target.value;
        if(target.value=="" || target.value.trim()==""){
          text = "Please enter email";
          email_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          var regex="[a-zA-Z0-9._+-]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z]{2,}";
          if(email.match(regex)){
            email_error.innerHTML = "";
            target.style.border="1px solid #ced4da";
            flag=true;
          }else{
            text = "Please enter valid email";
            email_error.innerHTML = text;
            target.style.border="1px solid red";
           //return false;
           flag=false;
          }
        }
      }
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
      
      if(target.id=="password"){
        var password=target.value;
        if(password=="" || password.trim()==""){
          text = "Please enter password";
          password_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          password_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }
      

      if(target.id=="confirmpassword"){
        var confirmpassword=target.value;
        if(confirmpassword=="" || confirmpassword.trim()==""){
          text = "Please enter confirm password";
          confirmpassword_error.innerHTML = text;
          target.style.border="1px solid red";
          //return false;
          flag=false;
        }else{
          confirmpassword_error.innerHTML = "";
          target.style.border="1px solid #ced4da";
          flag=true;
        }
      }

            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var contact = document.getElementById("contact").value;
            var password = document.getElementById("password").value;   
            var confirmpassword = document.getElementById("confirmpassword").value;
            if(name=="" || name.trim().length == 0){
                flag=false;  
            } 
            if(email.indexOf("@") == -1 || email.length ==0){
                flag=false;  
            }
            if(isNaN(contact) || contact.length != 10){
                flag=false;  
            } 
            if(password=="" || password.trim().length == 0){
                flag=false;  
            }
            if(confirmpassword=="" || confirmpassword.trim().length == 0){
                flag=false;  
            }
      
      
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