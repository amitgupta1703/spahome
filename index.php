<?php 
$title="Spa Services at Home | Top Spa for New Born Baby, Men & Women";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="Avoid the hustle of visiting spa & salons. Get affordable and hygienic Spa Services at home for New Born Baby and Mother, men and womens.";
include 'header.php';
?>
<style>
.btn-search {
    margin-top: 0px;
    width: 100%;
    padding: 12px 0 !important;
}
</style>

<!-- TESTIMONIALS -->
<section class="testimonials">
    <div id="customers-testimonials" class="owl-carousel">
    <?php 
                                       
    $mainCategorys=array();
    $mainCategorys=$dbControllers->getMainCategory();
    foreach($mainCategorys as $mainCategory)
    {
            
    ?> 
    <div class="item"> 
        <div class="shadow-effect">
            <img class="pull-right" src="<?php echo $mainCategory['bannerImg']; ?>" alt="<?php echo $mainCategory['main_category_name']; ?>">
            <div class="slider-caption slider-caption2"> 
            </div> 
        </div>
    </div>
    
    <?php 
        
    }
    ?>

        

    </div>
</section>
 
 
<div class="block-quick-info-2">
    <div class="container">
        <div class="block-quick-info-2-inner" style="font-size: 1.2rem;">
        <form action="<?php echo $baseurl ?>/services-list" method="post">
                    <div class="row">
                    <div style="margin-top:1rem;color:red;">
                        <?php  //include 'errors.php' ?>
                    </div>
                    <div style="margin-top:1rem;color:green;font-size:0.825rem;">
                        <?php  //include 'success.php'; ?>
                    </div>

                    </div>
                    <div class="row"> 
                        
                        <div class="col-md-3">
                            <select name="services_name" id="services_name" class="form-control">
                               
                                <option value="-1">---- Book Services----</option>
                                <?php 
                                       
                                        $mainCategorys=array();
                                        $mainCategorys=$dbControllers->getMainCategory();
                                        foreach($mainCategorys as $mainCategory)
                                        {
                                                $url=str_replace(" ","-",$mainCategory['main_category_name']);
                                                $url=strtolower($url);
                                        ?>
                                        <li> <option value="<?php echo $mainCategory['main_category_name']; ?>" <?php if(isset($_POST['search']) && $_POST['services_name']==$mainCategory['main_category_name']){echo 'selected';}?> ><?php echo $mainCategory['main_category_name'] ?></option></li>
                                        
                                        <?php 
                                            
                                        }
                                        ?> 
                            </select>
                             
                        </div>
 
                        <!-- <div class="col-md-3 pl">
                            <select name="locations" id="locations" class="form-control" >
                               
                                <option value="-1">----Select Location----</option> -->
                                <?php  
                                $allLocation='';   
                                $locations=array();
                                $locations=$dbControllers->getLocations();
                                foreach($locations as $location)
                                {
                                       $allLocation=$allLocation.$location['locationName'].', '; 
                                ?>
                               
                              <!--   <li> <option value="<?php echo $location['locationName']; ?>" <?php if(isset($_POST['search']) && $_POST['locations']==$location['locationName']){echo 'selected';}?> ><?php echo $location['locationName'] ?></option></li> -->
                                
                                <?php 
                                    
                                }
                                ?> 
                            <!-- </select>
                             
                        </div> -->

                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-md-12 pl">  
                                <input type="text" id="location" name="location1" require class="form-control" placeholder="Enter location, city, state or zipcode" value="<?php if(isset($_POST['location'])){echo $_POST['location'];}?>">
                                <input type="hidden" id="allLocations" value="<?php echo $allLocation?>">
                                <input type="hidden" id="setLocation" name="location">
                                </div> 
                                <div class="col-md-12 fs-14"> 
                                    <span id="loc" style="color:red;font-size: 1rem;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row form-group">
                                <div class="col-md-12 pl">
                                <input type="submit" name="search" value="Search" class="btn btn-primary btn-sm btn-search">
                                </div>
                            </div>
                        </div> 
                </div>
                </form>
            
        </div>
    </div>
</div>

<!--
<div class="site-section" id="services">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h1 class="site-section-heading text-center font-secondary">Our Spa Services</h1>
                <<p>We provides various kinds of Body Massage Services. We have a team of Trained & Experienced Female & men therapists and each member of the team is determined towards customer satisfaction & takes good care of our clients</p>
            </div>
        </div>
    </div>
</div>
-->

<div class="site-section" id="services">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h1 class="site-section-heading text-center font-secondary">Top Spa Services at Your Home</h1>
                <p>We provides various kinds of Body Massage Services. We have a team of Trained & Experienced Female & men therapists and each member of the team is determined towards customer satisfaction & takes good care of our clients also we provide a variety of services that are specifically designed to help children relax and feel better. We offer Swedish massage, reflexology, and other types of massage that can help kids with a variety of issues. If your child is having trouble sleeping, we can help them relax and fall asleep more easily.</p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-12"> 
                <?php include 'services-carousel.php'; ?>
            </div> 
        </div>
    </div>
</div>


 <!--<div class="container">
<div class="block-half-content-1 d-block d-lg-flex mt-2">
    <div class="block-half-content-img" style="background-image: url('images/home-bg.jpg')">

    </div>
    <div class="block-half-content-text bg-primary">
        <div class="block-half-content-text-inner">
            <h1 class="block-half-content-heading mb-4">About Us</h1>
            <div class="block-half-content-excerpt">
                <p class="lead"> Relax and find the healing you seek. Our massage studio specializes in body work and foot reflexology to restore the body and mind. <br>
                We’re experts at what we do. But knowing the best techniques is only part of the process, we’re also here to make you feel great. Whether you’re here for a one-hour service or an entire day, your happiness is of utmost importance!
</p>
            </div>
        </div>

        <div class="block-counter-1 section-counter">
            <div class="row">
                <div class="col-sm-4">
                    <div class="counter">
                        <div class="number-wrap">
                            <span class="block-counter-1-number" data-number="3">0</span><span class="append">K</span>
                        </div>
                        <span class="block-counter-1-caption">Happy Customers</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="counter">
                        <div class="number-wrap">
                            <span class="block-counter-1-number" data-number="7">0</span><span class="append"></span>
                        </div>
                        <span class="block-counter-1-caption">Years of Experience</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="counter">
                        <div class="number-wrap">
                            <span class="block-counter-1-number" data-number="100">0</span><span class="append">%</span>
                        </div>
                        <span class="block-counter-1-caption">Satisfaction</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>-->

<!-- Why Choose Us -->

<div class="site-section" id="whyhoose">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h1 class="site-section-heading text-center font-secondary">Why Choose Us</h1>
                <p>Our therapists are experienced in working with a variety of different conditions that children may have, such as autism, ADHD, Sensory Processing Disorder, cerebral palsy, and more. This means that we can tailor the massage to each child's specific needs and help them to achieve the maximum possible benefit from the treatment.</p>
            </div>
        </div>
          <div class="row mb-5">
              <div class="col-md-4">
                  <div class="box_why">
                        <img src="images/trained-and-verified-experts.jpg" alt="Trained and Verified Experts" class="img-fluid ">
                      <h3>Trained and Verified Experts</h3>
                      <p>We have experienced & premium therapist  professionals in the list of Spa Home Service All service provider come on board after pass our standard training certification.</p>
                  </div>
            </div>
             <div class="col-md-4">
                  <div class="box_why">
                        <img src="images/genuine-and-sealed-products.jpg" alt="Genuine and Sealed Products" class="img-fluid ">
                      <h3>Genuine and Sealed Products</h3>
                      <p> Genuine product use and 100% transparency in our products, We Not use non chemical products for safer and better <br> for you.</p>
                  </div>
            </div>
             <div class="col-md-4">
                  <div class="box_why">
                        <img src="images/transparent-and-affordable-prices.jpg" alt="Transparent and Affordable Prices" class="img-fluid ">
                      <h3> Transparent and Affordable Prices </h3>
                      <p>We care about your body, skin, health, bone etc, Manage your low cost service to give, Safe & Hygienic services. Provide Services at very <br> affordable prices </p>
                  </div>
            </div>
              </div>
     </div>
</div>

<!-- Why Us End -->
<div class="site-section" id="offer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h1 class="site-section-heading text-center font-secondary">Offers</h1>
                <p>Let your problems slip away while you unwind. Check out these spa specials and make an appointment right away if you want to detoxify, give your skin more radiance, or simply just relax your back.</p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-12"> 
                <div class="owl-carousel-4 owl-carousel">
                    <?php 
                                       
                    $mainCategorys=array();
                    $mainCategorys=$dbControllers->getMainCategory();
                    foreach($mainCategorys as $mainCategory)
                    {
                            
                    ?> 
                         
                        <div class="d-block block-testimony mx-auto text-center">
                            <div class="mb-4">
                            <a href="<?php echo $baseurl?>/services-list">
                                    <img src="<?php echo $mainCategory['offerImg']; ?>" alt="<?php echo $mainCategory['main_category_name']; ?> offer" class="img-fluid ">
                                </a>
                            </div>
                            <div> 
                                
                                <p><a href="<?php echo $baseurl?>/services-list" class="btn btn-primary btn-sm btn-pil">Book Now</a></p>
                            </div>
                        </div>
                    
                    <?php 
                        
                    }
                    ?> 
                </div>
            </div>


        </div>
    </div>
</div>

 
<script type="text/javascript"> 
        $(document).ready(function() {
          var location = 'location';
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(location)), {
                types: ['geocode'],
                componentRestrictions: { country: ["in"] },
                 
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
              //console.log("place");
               // console.log("all",autocomplete)
                //console.log(place);
                var loc=[];
                    loc.push({"loc":place});
                //console.log(place.address_components);
                var addressComponent=place.address_components;  
                var formatted_add=place.formatted_address;
               // console.log("place111",loc[0]['loc']);
               // console.log(addressComponent); 
               // console.log(formatted_add);
                localStorage.setItem('location', JSON.stringify(loc[0]['loc']));
                localStorage.myMap = JSON.stringify(Array.from(place));
                //place="";
                address1 = "";
                postcode = "";
                city="";
                state="";

                //document.querySelector("#city").value=" ";
               // document.querySelector("#pincode").value=" ";
                
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
                     /// document.querySelector("#pincode").value = postcode;
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
                     // document.querySelector("#city").value = city+', '+district; 
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
                     // var objSelect = document.getElementById("state");

                      //Set selected
                     /*  setSelectedValue(objSelect, state);

                      function setSelectedValue(selectObj, valueToSet) {
                          for (var i = 0; i < selectObj.options.length; i++) {
                              if (selectObj.options[i].text== valueToSet) {
                                  selectObj.options[i].selected = true;
                                  return;
                              }
                          }
                      } */
                      break;
                    }
                    case "country":
                      //document.querySelector("#country").value = component.long_name;
                      break;
                  }
                }
                
                //console.log("abc ",city,district)
                
                 if(city!='' && city){
                    city=city.toLowerCase();
                }
                 if(district!='' && district){
                    district=district.toLowerCase();
                }

                
               
                
                var ele=document.getElementById('allLocations');
                var span=document.getElementById('loc');
                
                var inputLoc;
                
                 if(ele){
                    inputLoc=ele.value.trim().toLowerCase()
                }

                
                

                if(ele && (inputLoc.indexOf(district)==-1 && inputLoc.indexOf(city)==-1)){ 
                   // console.log((inputLoc).indexOf(city),(inputLoc).indexOf(district),"input value :: ",inputLoc);
                    span.innerText='Service is not available at this location';
                } 
                else{
                   
                    span.innerText='';  
                }
                
                /*if(city!=''){
                    city=city;
                }else if(district!=''){
                    city=district;
                }
                var ele=document.getElementById('allLocations');
                var span=document.getElementById('loc');

                if(ele && (ele.value).indexOf(city)==-1){
                    console.log("add: ",address1," :: post:: ",postcode," : city: ",city);
                    span.innerText='Service is not available at this location';
                }else{
                   
                    span.innerText='';  
                }*/
                //console.log("add: ",address1," :: post:: ",postcode," : city: ",city)
                var ele1=document.getElementById('setLocation');
                    if(ele1){
                        ele1.value=city;
                    }
            });
           
        });

 function checkInput(){

 }
</script>

<?php 
include 'footer.php';
?>