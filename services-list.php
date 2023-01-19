<?php 
$title="Services List";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'config.php'; 
include 'codes/add-to-cart-code.php';


$url=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) ; 
$queryString=strrpos($url,"/");
$stringUrl='';
$location='';
$services='';
$cat='';
$m_cat='';

//echo 'adjajsdh: '.$_GET['m_cat'];
if(isset($_GET['services']) && $_GET['services']!=''){

    $stringUrl=$_GET['services'];
    $services=$services=str_replace("-"," ",$_GET['services']); ;
    //echo "service ..".$services;
    $services=str_replace("*","&",$services);
   // echo "after ..".$services;
}else if(!isset($_GET['m_cat']) && isset($_GET['services_sub_cat']) && $_GET['services_sub_cat']!='' && isset($_GET['cat']) && $_GET['cat']!=''){
 
    $stringUrl=$_GET['cat'].'/'.$_GET['services_sub_cat'];
    $services=str_replace("-"," ",$_GET['services_sub_cat']); 
    $cat=str_replace("-"," ",$_GET['cat']); 
    $services=str_replace("*","&",$services);
    //echo 'in subcat and cat 3333'.$services.'<br>';
}else if(isset($_GET['m_cat']) && isset($_GET['services_sub_cat']) && $_GET['services_sub_cat']!='' && isset($_GET['cat']) && $_GET['cat']!=''){
 
    $stringUrl=$_GET['m_cat'].'/'.$_GET['cat'].'/'.$_GET['services_sub_cat'];
    $services=str_replace("-"," ",$_GET['services_sub_cat']); 
    $cat=str_replace("-"," ",$_GET['cat']); 
    $m_cat=str_replace("-"," ",$_GET['m_cat']);
    $services=str_replace("*","&",$services);
   // echo 'in m_cat subcat and cat 3333'.$services.'<br>';
}else if(isset($_POST['search'])){
        $serviceName=$_POST['services_name'];
        $services=$serviceName;
        $location=$_POST['location'];
        $location1=$_POST['location1'];
        if($location1){
           echo  "<script>
                    localStorage.setItem('search_location', '{$location1}');   
                </script>";
        }
        if($location==''){
            $location= $location1;
        } 
        
        //$stringUrl=$_GET['services'];
       // echo 'location '.$location;
       /* echo "
       <script>
            localStorage.setItem('location', '{$location}');   
        </script>
       "; */
}



//echo "<br>sub  ".$_GET['services_sub_cat'].' ::::: '.$_GET['cat'];
?>

<!-- <script> 
var value = localStorage.getItem('location'); 
 
jQuery.post("service-list/{$stringUrl}", {myKey: value}, function(data) 
{ 

  alert("Do something with example.php response::: "+data.myKey); 
}).fail(function() 
{ 
  alert("Damn, something broke"); 
}); 
</script>  -->

<style>
 
 
 
#main img {
  width: 100%;
height:200px;
  display: block;
  object-fit: cover;
}

 
 #main #contain-image {
 /*  position: relative;
 
  box-shadow: 0rem 0.7rem 2rem rgba(0, 0, 0, 0.5); */
  /* overflow: hidden; */
}

#main .img {
  display: none;
}

#main #contain-button {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.#main button:hover,
#main .button:focus {
  opacity: 0.5;
  transition: opacity ease-in-out 0.1s;
}

#main .active {
  opacity: 0.5;
}

#main #signature {
  text-align: center;
  font-size: 2rem;
  font-weight: 600;
}
.serviceImg{
    width: 100%;
    height:200px;
}


</style>


 
   
<div class="site-blocks-cover overlay" style="background-image: url(<?php echo $baseurl?>/images/sliders/slider5.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

             
        </div>
    </div>
</div>
 

<div class="block-services-1 py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 order-md-1 order-2">
                <div class="sticky-form inline-photo show-on-scroll is-visible" id="sticky-form-inline">
                <div class="contents">
                    <?php
                        include 'side-bar.php';
                    ?> 
                </div>
                </div>
               
            </div>
            <div class="col-md-8 ml-auto order-md-2 order-1">  
                <input type="hidden" name="location" id="location">
                <div class="row pl 1"> 
                    <?php  
                    
                    $user_check_query; 
                      /*   if(isset($_GET['services']) && $_GET['services']!=""){ 
                            $services=$_SESSION['search_data'];
                            
                        }else if(isset($_POST['search'])){
                            //$services=$_POST['services_name'];
                            $services=$_SESSION['search_data'];
                            $location=$_POST['location'];
                            $location1=$_POST['location1'];
                            if($location==''){
                                $location= $location1;
                            } 

                            
                        }
                        else if(isset($_GET['services_sub_cat'])){  
                            $services=str_replace("-"," ",$_GET['services_sub_cat']); 
                        } */
 
                         if((isset($_GET['services']) && $_GET['services']) || isset($_POST['search']) || isset($_GET['services_sub_cat'])){
                            
                            echo '<h1 class="theme-color title fs-14 t1">Search results for "'.$services.''.'"</h1>';
                            $user_check_query;
                            //echo 'sub: '.$_GET['services_sub_cat'].' ::: cat'.$_GET['cat'];
                           
                            if(!isset($_GET['cat']) && isset($_GET['services_sub_cat']) && $_GET['services_sub_cat']!=''){ 
                                //echo 'in subcat ::::  '.$services;
                                $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date from services s where s.subcategory like '%$services%' and  s.status='active' order by s.service_id DESC";
                            }else if(!isset($_GET['m_cat']) && isset($_GET['cat']) && isset($_GET['services_sub_cat'])){ 
                                //echo 'in subcat and cat ::::  '.$services;
                                 $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date from services s where s.subcategory like '%$services%' and s.category like '%$cat%' and  s.status='active' order by s.service_id DESC";
                             }
                             else if(isset($_GET['m_cat']) && isset($_GET['cat']) && isset($_GET['services_sub_cat'])){ 
                                //echo 'in subcat and cat11 ::::  '.$services;
                                 $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date from services s where s.subcategory like '%$services%' and s.category like '%$cat%' and s.main_category like '%$m_cat%' and  s.status='active' order by s.service_id DESC";
                             }
                            
                            else if(isset($_POST['search'])){
                               //echo 'in post '.$services.' : '.$location;
                                $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date,m.location from services s join main_category m on s.main_category=m.main_category_name where s.main_category like '%$services%' and m.location like '%$location%' and s.status='active' order by s.service_id DESC";
                            } else if(isset($_GET['services']) && $_GET['services']!='' ){
                               // echo "get ser:: ".$services;
                                $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date,m.location from services s join main_category m on s.main_category=m.main_category_name where s.main_category like '%$services%'  and s.status='active' order by s.service_id DESC";
                            }
                            
                            else{
                              // echo 'in post else'.$services.' : '.$location;
                                $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date,m.location from services s join main_category m on s.main_category=m.main_category_name where (s.main_category like '%$services%' or m.location like '%$location%')   and s.status='active' order by s.service_id DESC";
                            }
                            

                            
                            $results2 = mysqli_query($db, $user_check_query); 
                            $trimstring1='';
                            $trimstring='';
                            //print_r($results2);
                            if (mysqli_num_rows($results2) >0) {
                            
                            while($row = mysqli_fetch_row($results2)){ 
                                //print_r(" hhhf: ".$row);
                                $pDesc =$row[3] ;
                                $trimstring=$pDesc; 
                                $pServiceName =$row[1] ;
                                if (strlen($pServiceName) > 30) {
                                $trimstring1 = substr($pServiceName, 0, 2000). ' <a href="#">...</a>';
                                } else {
                                $trimstring1 = $trimstring1;
                                } 
                                $originalPrice=(int)$row[4];
                                $offerOrDiscount=(int)$row[5];
                                $discountPrice;
                                if($offerOrDiscount!=='' && $offerOrDiscount>0){
                                    $discountPrice=$originalPrice-($originalPrice*$offerOrDiscount)/100;
                                }else{
                                    $discountPrice=0;
                                }  

                                $imgHtml='';
                                $icon='';
                                if($row[6]!=""){
                                    if(strpos($row[6],",")>-1){
                                       /*  $imgs=explode(',',$row[6]); 
                                        //$len=count($imgs); 
                                        $len=2;
                                        for($i=1;$i<$ien;$i++){
                                            if($imgs[$i]!=""){
                                                $imgHtml.='<img src="'.$baseurl.'/'.'services_img/'.$imgs[$i].'" alt="'.$row[1].'" id="img'.$i.'" class="img img-fluid rounded mb-3 serviceImg"/>';
                                                $icon.='<ion-icon name="radio-button-on" class="button" id="button'.$i.'"></ion-icon>';

                                            }
                                        } */
                                        $imgs=explode(',',$row[6]); 
                                        $imgHtml.='<img src="'.$baseurl.'/'.'services_img/'.$imgs[1].'" alt="'.$row[1].'"   class="img img-fluid rounded mb-3 serviceImg d-block"/>';
                                        
                                    }
                                    else{
                                        $imgHtml='<img src="'.$baseurl.'/'.$row[6].'" alt="'.$row[1].'" class="img-fluid rounded mb-3 serviceImg" >';
                                        
                                    }
                                    
                                    }

                                
                                echo '<div class="col-md-12"><form action="'.$baseurl.'/'.'services-list/'.$stringUrl.'" method="post">
                                <div class="row lists-item">
                                <div class="col-md-4 plr"> <main id="main" role="main"> 
                                    <article id="contain-image">'.$imgHtml.' </article>
                                    <div id="contain-button">'.$icon.' </div>  
                                </main> </div>
                                <div class="col-md-8"> 
                                    <h1 class="lists theme-color">'.strtolower($row[1]).'</h1>
                                    <h1 class="serviceName price"><i class="fa fa-rupee"></i>';
                                    if($discountPrice==0){
                                        echo number_format((float)$originalPrice, 2, '.', '');
                                    }else{
                                        echo '<del>'.number_format((float)$originalPrice, 2, '.', '').'</del> '.number_format((float)$discountPrice, 2, '.', ''). '<span>'.$offerOrDiscount.'% Off</span>';
                                    }
                                    
                                    echo '</h1> 
                                    <h1 class="serviceName"><!--i class="fa fa-support"></i-->'.$trimstring1.'</h1> <p>'. $pDesc.' </p>
                                    
                                    <div class="job-type"> ';
                                    if($row[2]!=""){
                                       echo '<span class="last"> <i class="fa fa-clock-o"></i>'.$row[2].' min</span>'; 
                                   } 
                                    echo '<br>
                                    <input type="hidden" name="service_id" value="'.$row[0].'">
                                    <input type="submit" name="add-to-cart" value="Book Now" class="btn btn-primary btn-sm btn-pil btnblack">  
                                </div> </div>
                                </div></form>
                            </div>';
                                  }
                               }
                               else{
                                echo '<div class="col-md-12 pl-0">
                                       
                                        <div class="alert alert-danger" role="alert">
                                        Service not Available for "'.$services.'" in "'.$location.'"! Please try another location.
                                        </div>

                                </div>';
                               }
                            }
                            else{
                                //echo "else";
                                $user_check_query1 = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.offersOrDiscount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date from services s  where s.status='active' order by s.service_id DESC";
                                 
                                
                                $results1 = mysqli_query($db, $user_check_query1); 
                                $trimstring1='';
                                $trimstring='';
                                if (mysqli_num_rows($results1) >0) {
                                
                                while($row = mysqli_fetch_row($results1)){ 

                                    $imgHtml='';
                                $icon='';
                                if($row[6]!=""){
                                    if(strpos($row[6],",")>-1){
                                        $imgs=explode(',',$row[6]); 
                                        $len=count($imgs); 
                                        for($i=0;$i<$len;$i++){
                                            if($imgs[$i]!=""){
                                                $imgHtml.='<img src="../services_img/'.$imgs[$i].'" alt="'.$row[1].'" id="img'.$i.'" class="img img-fluid rounded mb-3 serviceImg"/>';
                                                $icon.='<ion-icon name="radio-button-on" class="button" id="button'.$i.'"></ion-icon>';

                                            }
                                        }
                                        
                                    }
                                    else{
                                        $imgHtml='<img src="'.$baseurl.'/'.$row[6].'" alt="'.$row[1].'" class="img-fluid rounded mb-3 serviceImg" >';
                                        
                                    }
                                    
                                    }
                                    
                                    $pDesc =$row[3] ;
                                    $trimstring=$pDesc; 
                                    $pServiceName =$row[1] ;
                                    if (strlen($pServiceName) > 30) {
                                    $trimstring1 = substr($pServiceName, 0, 2000). ' <a href="#">...</a>';
                                    } else {
                                    $trimstring1 = $trimstring1;
                                    } 
                                    $originalPrice=(int)$row[4];
                                    $offerOrDiscount=(int)$row[5];
                                    $discountPrice;
                                    if($offerOrDiscount!=='' && $offerOrDiscount>0){
                                        $discountPrice=$originalPrice-($originalPrice*$offerOrDiscount)/100;
                                    }else{
                                        $discountPrice=0;
                                    } 
    
                                    echo '<div class="col-md-12"><form action="services-list.php" method="post">
                                    <div class="row lists-item">
                                    <div class="col-md-4 plr">
                                    '.$imgHtml.' </div>
                                    <div class="col-md-8"> 
                                        <h1 class="lists theme-color">'.strtolower($row[1]).'</h1>
                                        <h1 class="serviceName price"><i class="fa fa-rupee"></i>';
                                        if($discountPrice==0){
                                            echo number_format((float)$originalPrice, 2, '.', '');
                                        }else{
                                            echo '<del>'.number_format((float)$originalPrice, 2, '.', '').'</del> '.number_format((float)$discountPrice, 2, '.', ''). '<span>'.$offerOrDiscount.'% Off</span>';
                                        }
                                        
                                        echo '</h1> 
                                        <h1 class="serviceName"><!--i class="fa fa-support"></i-->'.$trimstring1.'</h1> <p>'. $pDesc.' </p>
                                        
                                        <div class="job-type"> ';
                                        if($row[2]!=""){
                                           echo '<span class="last"> <i class="fa fa-clock-o"></i>'.$row[2].' min</span>'; 
                                       } 
                                        echo '<br>
                                        <input type="hidden" name="service_id" value="'.$row[0].'">
                                        <input type="submit" name="add-to-cart" value="Book Now" class="btn btn-primary btn-sm btn-pil btnblack"> 
                                    </div> </div>
                                    </div></form>
                                </div>';
                                      }
                                   }
                            }
                         
                    ?> 

                </div>
                
            </div> 
        </div>
    </div>
      <div class="container mb-5">
        <div class="row">
            <div class="col-md-6">
                <?php include 'faqs.php'; ?> 
            </div>
            <div class="col-md-6">
                <?php include 'ask-questions.php'; ?> 
            </div>
        </div> 
        
    </div>
</div>

<!--div class="site-section">
    <div class="container">
        <div class="row mb-1">
            <div class="col-md-12 text-center">
                <h2 class="site-section-heading text-center font-secondary">Other Spa Services</h2>
                <p>We provides various kinds of Body Massage Services. We have a team of Trained & Experienced Female therapists and each member of the team is determined towards customer satisfaction & takes good care of our clients</p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-12"> 
                <?php include 'services-carousel.php'; ?>
            </div> 
        </div>
    </div>
</div-->
<div id="myModal" class="modal"> 
    <div class="modal-content">
        <span class="close">&times;</span>
        <p><?php //$msg;?></p>
    </div> 
</div>
<script>
    var loc=localStorage.getItem('search_location');   
    var locationEle=document.getElementById('location');
    /* (function(){
        console.log("ele fff",loc)
         var locationInterval=setInterval(()=>{
           
        if(locationEle){
            clearInterval(locationInterval);
            console.log("ele intererer",loc,locationEle)
            locationEle.value=loc;
            console.log("ele",loc)
        }
    },500)
    })(); */
   
   // CREDIT: https://w3schools.com - HOW TO SECTION
let n = 0;

function slide() {
   // console.log("img")
  const images = document.getElementsByClassName("img");
  const button = document.getElementsByClassName("button");
   
  for (let i = 0; i < images.length; i++) {
    images[i].style = "display:none";
  }
  for (let i = 0; i < button.length; i++) {
    button[i].className = button[i].className.replace(" active", "");
  }

  n++;
  if (n > images.length) {
    n = 1;
  }
  //console.log("abc",images[n - 1])
  images[n - 1].style = "display:block";

  button[n - 1].className += " active";

  setTimeout(slide, 3000);
};

/* setTimeout(() => {
    slide();
}, 1000); */


/* var slider = setInterval(()=>{
    const images = document.getElementsByClassName("img");
    console.log("abc",images[0])
  const button = document.getElementsByClassName("button");
              if(images && button){
              clearInterval(slider);
              for (let i = 0; i < images.length; i++) {
                    images[i].style = "display:none";
                }
                for (let i = 0; i < button.length; i++) {
                    button[i].className = button[i].className.replace(" active", "");
                }

                n++;
                if (n > images.length) {
                    n = 1;
                }
                console.log("abc",images[n - 1])
                images[n - 1].style = "display:block";

                button[n - 1].className += " active";

                setTimeout(slide, 3000);
                        }
        },500); */
</script>


<?php 
include 'footer.php';
?>