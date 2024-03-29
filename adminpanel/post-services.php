<?php include 'header.php' ;
include 'top-nav.php';
include 'codes/services-post-code.php';
 
if(isset($_GET['service_id']) && isset($_GET['editmode'])=='true'){
  $service_id=$_GET['service_id'];
  $services_name='';
  $duration='';
  $services_description='';
  $offersOrDiscount=''; 
  $amount='';

  $services_query = "select * from services where service_id='$service_id' limit 1";
  $services = mysqli_query($db, $services_query);
  $data = mysqli_fetch_assoc($services);
 
  if ($data) { // if user exists
     $services_name=$data['services_name'];
     $duration=$data['duration'];
     $services_description=$data['services_description'];
     $offersOrDiscount=$data['offersOrDiscount'];
     $amount=$data['amount']; 
  }
  echo $services_name;
}
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
  .spaServices .checkbox1 {
    background-color: #fff6f8;
    padding: 10px 15px;
    font-size: 12px;
  }
.spaServices .checkbox1 input[type=checkbox]{
  /* margin:3px 5px 3px 15px; */
  margin-right:4px;
} 
.spaServices .checkbox1 table{
    width:100%;
}
.plr{
    padding:0 !important;
}
#durationT{
  display:none;
}

</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Post Services</h3>
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Services</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form  method="post" action="post-services.php" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate> 
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="services_name">Services Title or Name 
                        </label>
                         
                        <div class="col-md-6 col-sm-6 col-xs-12">  
                        <input type="text" id="services_name" name="services_name" value="<?php if(isset($_POST['services_name'])) {echo $services_name;}?>" class="form-control col-md-7 col-xs-12"> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_category_name">Main Services<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <select name="services_name" id="services_name" class="form-control col-md-7 col-xs-12" onChange="locationDe(event)"> -->
                          <select name="main_category_name" id="main_category_name" onchange="selectCategory(event)" class="form-control ">
                            <option value="-1">----Select Main Category----</option>
                              <?php                       
                                  $user_check_query = "select * from main_category where status='active' order by id desc"; 
                                  $results = mysqli_query($db, $user_check_query); 
                                  if (mysqli_num_rows($results) >0) { 
                                  while($row = mysqli_fetch_row($results)){
                                          echo '<option value="'.$row[1].'">  '.$row[1].'</option>'; 
                                      }
                                  }
                              ?>
                            </select> 
                        </div> 
                      </div> 

                       <div class="form-group" id="cat">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Select Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" id="category">
                          <input type="hidden" name="category_name">
                            <select disabled class="form-control"  name="category_name">
                              <option value="-1">----Select Category----</option>
                            </select>
                        </div> 
                      </div> 

                      <div class="form-group" id="cat">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_name">Select Sub Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" id="subcategory">
                        <input type="hidden" name="subcategory_name">
                            <select disabled class="form-control " name="subcategory_name" required>
                              <option value="-1">----Select Sub Category----</option>
                            </select>
                        </div> 
                      </div> 
 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="duration">Duration 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="duration" name="duration" value="<?php if(isset($_POST['duration'])) {echo $duration;}?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
                       
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="services_description">Services Description 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <input type="text" id="description" id="services_description" name="services_description" class="form-control col-md-7 col-xs-12"> -->
                          <textarea id="services_description" id="services_description" name="services_description" required="required" value="" class="form-control col-md-7 col-xs-12 txtarea"><?php if(isset($_POST['services_description'])) {echo $services_description;}?></textarea>
                        </div>
                      </div>  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="amount" required="required" name="amount" value="<?php if(isset($_POST['amount'])) {echo $amount;}?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 

                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offersOrDiscount">Offers or Discount<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="offersOrDiscount" id="offersOrDiscount" class="form-control col-md-7 col-xs-12">
                                  <option value="-1">----Select Offers----</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='0'){echo 'selected';} ?> value="0">0% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='5'){echo 'selected';} ?> value="5">5% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='10'){echo 'selected';} ?> value="10">10% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='15'){echo 'selected';} ?> value="15">15% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='20'){echo 'selected';} ?> value="20">20% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='25'){echo 'selected';} ?> value="25">25% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='30'){echo 'selected';} ?> value="30">30% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='35'){echo 'selected';} ?> value="35">35% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='40'){echo 'selected';} ?> value="40">40% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='45'){echo 'selected';} ?> value="45">45% Off</option>
                                  <option <?php if(isset($_POST['offersOrDiscount']) && $_POST['offersOrDiscount']=='50'){echo 'selected';} ?> value="50">50% Off</option> 
                            </select> 
                          </div> 
                      </div> 


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadImg">Upload Image <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" placeholder="Service Image" name="uploadImg[]" multiple  accept="image/*" class="form-control col-md-7 col-xs-12" />
										 
                        </div>
                      </div> 
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input  type="submit" class="btn btn-success" name="post_services" value="Add New Services">
                         
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
    if (e.target.value == "Spa Services") {
      
      var ele= document.getElementById("durationT");
      if(ele){
        ele.style.display="block";
      }else{
        ele.style.display="none";
      }
        document.getElementById("spaServices").innerHTML = '<div class="spaServices"><div class="checkbox1"> <table><tr><td>' +
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

            '</td><tr></table> </div></div>';
    } else {
        document.getElementById("spaServices").innerHTML = '';
    }

     if (e.target.value == "Ayurvedic Spa") { 
      var ele= document.getElementById("durationT");
      if(ele){
        ele.style.display="block";
      }else{
        ele.style.display="none";
      }
      document.getElementById("AyurvedicServices").innerHTML = '';
      document.getElementById("AyurvedicServices").innerHTML = '<div class="spaServices"><div class="checkbox1"> <table><tr><td>' +
          '<input type="checkbox" name="check_list[]"  value="Swedish Therapy">Swedish Therapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Abhyangam Therapy">Abhyangam Therapy</br>' +
          ' <input type="checkbox" name="check_list[]" value="Nasyam Therapy">Nasyam Therapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Acupuncture">Acupuncture                                                                                                                                                                               \                           Body Massage</br>' +
          '<input type="checkbox" name="check_list[]" value="Udvarthanam Therapy">Udvarthanam Therapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Acupressure">Acupressure</td><td>' +
          '<input type="checkbox" name="check_list[]" value="Aroma Therapy">Aroma Therapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Physiotherapy">Physiotherapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Shirodhara Therapy">Shirodhara Therapy</br>' +
          '<input type="checkbox" name="check_list[]" value="Enema">Enema</br>' +

          '</td><tr></table></div> </div>';
  } else {
      document.getElementById("AyurvedicServices").innerHTML = '';
  }

if (e.target.value == "Salon For Women") {
  var ele= document.getElementById("durationT");
      if(ele) {
        ele.style.display="none";
      }
  document.getElementById("salonForWomen").innerHTML = ''; 
      document.getElementById("salonForWomen").innerHTML = '<div class="spaServices"><div class="checkbox1"> <table><tr><td>' +
          '<input type="checkbox" name="check_list[]"  value="Hair Cut & Styling">Hair Cut & Styling</br>' +
          '<input type="checkbox" name="check_list[]" value="Ironing">Ironing</br>' +
          ' <input type="checkbox" name="check_list[]" value="Global Colouring">Global Colouring</br>' +
          '<input type="checkbox" name="check_list[]" value="Blow Dry">Blow Dry                                                                                                                                                                               \                           Body Massage</br>' +
          '<input type="checkbox" name="check_list[]" value="Root Touch Up">Root Touch Up</br>' +
          '<input type="checkbox" name="check_list[]" value="Shampoo & Conditioning">Shampoo & Conditioning</br>' +
          '<input type="checkbox" name="check_list[]" value="Head Massage">Head Massage</br>' +
          '<input type="checkbox" name="check_list[]" value="Roller Setting">Roller Setting</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Oiling">Hair Oiling</br>' +
          '<input type="checkbox" name="check_list[]" value="Straightening">Straightening</br>' +
          '<input type="checkbox" name="check_list[]" value="Party Makeup">Party Makeup</br>' +
          '<input type="checkbox" name="check_list[]" value="Engagement Makeup">Engagement Makeup</br></td><td>' +
          '<input type="checkbox" name="check_list[]" value="Bridal & Reception Makeup">Bridal & Reception Makeup</br>' +
          '<input type="checkbox" name="check_list[]" value="Pre Bridal Services">Pre Bridal Services</br>' +
          '<input type="checkbox" name="check_list[]" value="Base Makeup">Base Makeup</br>' +
          '<input type="checkbox" name="check_list[]" value="Eye Makeup">Eye Makeup</br>' +
          '<input type="checkbox" name="check_list[]" value="Nail Art & Extension">Nail Art & Extension</br>' +
          '<input type="checkbox" name="check_list[]" value="Skin Treatments & Facial">Skin Treatments & Facial</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Rebonding">Hair Rebonding</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Perming Service">Hair Perming Service</br>' +
          '<input type="checkbox" name="check_list[]" value="Keratin Treatment">Keratin Treatment</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Color Protection">Hair Color Protection</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Smoothening">Hair Smoothening</br>' +

          '</td><tr></table></div> </div>';
  } else {
      document.getElementById("salonForWomen").innerHTML = '';
  }

if (e.target.value == "Salon For Men") {
  var ele= document.getElementById("durationT");
      if(ele) {
        ele.style.display="none";
      }
  document.getElementById("salonForMen").innerHTML = ''; 
      document.getElementById("salonForMen").innerHTML = '<div class="spaServices"><div class="checkbox1"> <table><tr><td>' +
          '<input type="checkbox" name="check_list[]"  value="Hair Cut For Father & Childs">Hair Cut For Father & Childs</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Cut For Men">Hair Cut For Men</br>' +
          ' <input type="checkbox" name="check_list[]" value="Hair Cut For 2 Men">Hair Cut For 2 Men</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Cut For Family">Hair Cut For Family<br>'+
          '<input type="checkbox" name="check_list[]" value="Hair Cut For Child">Hair Cut For Child</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Cut For 2 Child">Hair Cut For 2 Child</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair Cut + Head Massage + Beard Grooming">Hair Cut + Head Massage + Beard Grooming</br>' +
          '<input type="checkbox" name="check_list[]" value="Clean Shave + Face Massage">Clean Shave + Face Massage</br>' +
          '<input type="checkbox" name="check_list[]" value="Styling + Beard Shaping">Styling + Beard Shaping</br>' +
          '<input type="checkbox" name="check_list[]" value="Hair colour + Beard colour">Hair colour + Beard colour</br></td><td>' +
          '<input type="checkbox" name="check_list[]" value="Beard Shaping & Styling">Beard Shaping & Styling</br>' +
          '<input type="checkbox" name="check_list[]" value="Waxing for Men">Waxing for Men</br>' +
          '<input type="checkbox" name="check_list[]" value="Threading for Men">Threading for Men</br>' +
          '<input type="checkbox" name="check_list[]" value="Wedding Makeup">Wedding Makeup </br>' +
          '<input type="checkbox" name="check_list[]" value="Wedding Makeup + 2 Men">Wedding Makeup + 2 Men</br>' +
          '<input type="checkbox" name="check_list[]" value="Wedding Makeup + Full Family">Wedding Makeup + Full Family</br>' +
          '<input type="checkbox" name="check_list[]" value="Normal Facial">Normal Facial</br>' +
          '<input type="checkbox" name="check_list[]" value=" Facial with Massage"> Facial with Massage</br>' +
          '<input type="checkbox" name="check_list[]" value="Bleach for Men">Bleach for Men</br>' +
          '<input type="checkbox" name="check_list[]" value="Party Beauty Makeup for Men">Party Beauty Makeup for Men</br>' + 
         

          '</td><tr></table></div> </div>';
  } else {
      document.getElementById("salonForMen").innerHTML = '';
  }


  if (e.target.value == "Health Tips") {
  var ele= document.getElementById("durationT");
      if(ele) {
        console.log("tttt")
        ele.style.display="none";
      }
  }

}


  function  selectCategory(event)
    {
     // console.log(event.target.value);
      $.ajax({
            url: 'codes/fetch-category-ddl.php',
            type:'POST',
            dataType:"json",
            data:
            { 
                main_category: event.target.value
            },
            success: function(response)
            {
                
               // alert(response);
                $('#category').html(response);
                
                
            }               
        });

    }   
    
    function selectSubCategory(event){
      //console.log(event.target.value);
      $.ajax({
            url: 'codes/fetch-category-ddl.php',
            type:'POST',
            dataType:"json",
            data:
            { 
                sub_category: event.target.value
            },
            success: function(response)
            { 
                //alert(response);
                $('#subcategory').html(response);
                
                
            }               
        });
    }
    
    </script>
       
<?php include 'footer.php'?>



