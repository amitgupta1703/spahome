<?php 
$title="Spa Description";
include 'header.php';

include 'config.php';
                         
if(isset($_GET['service_id']) && $_GET['service_id']!=""){
    $service_id=$_GET['service_id'];
    $user_check_query = "select s.service_id,s.services_name,s.duration,s.services_description,s.amount,s.services_image,s.partners_admin_id,s.admin_status,s.status,s.date,p.name,p.email,p.contact,p.company_name,p.location,p.city,p.state,p.pincode,p.status,s.offersOrDiscount from partners_services s join partners_registration p on s.partners_admin_id=p.partners_id where s.service_id='$service_id' and s.admin_status='Approved' and s.status='active' limit 1";

    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        while($row = mysqli_fetch_row($results)){
            $service_id=$row[0];
            $service_name=$row[1];
            $duration=$row[2];
            $service_description=$row[3];
            $amount=$row[4];
            $services_image=$row[5];
            $partners_admin_id=$row[6];

            $admin_status=$row[7];
            $status=$row[8];
            $date=$row[9];
            $name=$row[10];
            $email=$row[11];
            $contact=$row[12];
            $company_name=$row[13];

            $location=$row[14];
            $city=$row[15];
            $state=$row[16];
            $pincode=$row[17];
            $partners_status=$row[18];
            $offers=$row[19];
            $address=$location.', '.$city.', '.$state.', '.$pincode;

            $originalPrice=(int)$row[4];
            $offerOrDiscount=(int)$row[19];
            $discountPrice;
            $prices;
            if($offerOrDiscount!=='' && $offerOrDiscount>0){
                $discountPrice=$originalPrice-($originalPrice*$offerOrDiscount)/100;
                $prices=$discountPrice.'<sup><del>'.$originalPrice.'</del></sup> <span class="theme-color">'.$offerOrDiscount.'% Off</span>';
                $amount=$discountPrice;
            }else{
                $prices=$originalPrice;
                $amount=$originalPrice;
            } 

        }
    }
}
?>

<style>
    .block-services-1{
        color:#626262 !important;
    }
    h1.lists {
        display: table;
        font-size: 18px;
        margin: 0;
        margin-bottom: 0px;
        margin-bottom: 7px;
        /* margin-top: 3px; */
    }
    h1{
        font-size: 24px;
        margin: 0;
        margin-bottom: 0px;
        margin-bottom: 7px;
    }
    h1 strong{
        font-size: 18px; 
    }
    h1.serviceName{
        font-size: 14px;
        margin: 0;
        margin-bottom: 0px;
        margin-bottom: 7px;
    }
    
    .last {
        margin-left: 30px;
    }
    
    .amount {
        position: absolute;
        right: 1px;
        top: 0;
        font-size: 18px;
    }
    p{
        margin-bottom: 0.5rem;
    }
    p strong{
        font-weight:600;
    }
    p i{
        font-size: 24px;
        color:#ea728c;
        margin-right:5px;
    }
    .mt{
        margin-top:2rem;
    }
    .desc strong{
        font-weight:600;
        margin-right:5px;
    }
    sup{
        margin-left: 4px;
    margin-right: 5px;
    font-size: 14px;
    }
    .prices{
        font-size: 18px;
    }
   
</style>

<div class="site-blocks-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-10">

                <div class="row justify-content-center mb-4">
                    <div class="col-md-10 text-center">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="block-services-1 py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-5">
                <img src="<?php echo $services_image?>" alt="<?php echo $service_name?>" class="img-fluid rounded mb-3 spaImg"> 
            </div>
            <div class="col-md-7 desc">  
                <h1 class="theme-color"><?php echo $company_name?></h1>
                <p class="prices">
                   <i class="fa fa-rupee"></i><?php echo $prices;?>
                </p>
                <hr>
             <!--    <table>
                    <tr>
                        <td>Price</td>
                        <td><?php echo $prices;?></td>
                    </tr>
                    <tr>
                        <td>Service</td>
                        <td><?php echo $service_name;?></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><?php echo $address;?></td>
                    </tr>
                    <?php 
                        if($duration!=""){ 
                            echo  '<tr><td>Duration</td>
                            <td>'.$duration.'</td></tr>' ;
                        } 
                    ?>
                    <tr>
                        <td>Description</td>
                        <td><?php echo $service_description;?></td>
                    </tr>
                   
                </table> -->
                
                <p>
                   <strong>Services: <i class="fa fa-support"></i> </strong> <?php echo $service_name;?>
                </p>
                
                <p>
                   <strong>Location: <i class="fa fa-map-marker"></i></strong> <?php echo $address;?>
                </p>
                <?php 
                    if($duration!=""){ 
                        echo  '<p>
                        <strong>Duration: <i class="fa fa-clock-o"></i></strong> '.$duration.'
                     </p>' ;
                    }
                ?>
               
                <p>
                   <strong>Description: </strong> <?php echo $service_description;?>
                </p>
                <a class="btn btn-primary btn-sm btn-pil mt" href="book-appointment.php?service_id=<?php echo $service_id; ?>&amount=<?php echo $amount; ?>&service_name=<?php echo $service_name ?>">Book Appointments</a>
            </div>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="site-section-heading text-center font-secondary">Other Spa Services</h2>
                <p>We provides various kinds of Body Massage Services. We have a team of Trained & Experienced Female therapists and each member of the team is determined towards customer satisfaction & takes good care of our clients</p>
            </div>
        </div>
        <div class="row">

            <div class="col-12">

                <div class="owl-carousel-s owl-carousel">

                    <div class="d-block block-testimony mx-auto text-center">
                        <div class="mb-4">
                            <img src="images/male-to-male.webp" alt="Image" class="img-fluid ">
                        </div>
                        <div>
                            <h2 class="h5 theme-color">Spa <br> Services</h2> 
                            <p><a href="<?php echo $baseurl?>/services-list.php?services=spa" class="btn btn-primary btn-sm btn-pil">Learn More</a></p>
                        </div>
                    </div>
 
                    <div class="d-block block-testimony mx-auto text-center">
                        <div class="mb-4">
                            <img src="images/male-to-female.webp" alt="Image" class="img-fluid ">
                        </div>
                        <div>
                            <h2 class="h5 theme-color">Ayurvedic <br>Spa Services</h2>
                            <p><a href="<?php echo $baseurl?>/services-list.php?services=ayurvedic-spa" class="btn btn-primary btn-sm btn-pil">Learn More</a></p>
                        </div>
                    </div>

                    <div class="d-block block-testimony mx-auto text-center">
                        <div class="mb-4">
                            <img src="images/female-to-female.webp" alt="Image" class="img-fluid ">
                        </div>
                        <div>
                            <h2 class="h5 theme-color">Salon <br>For Women</h2>
                             <p><a href="<?php echo $baseurl?>/services-list.php?services=Salon-For-Women" class="btn btn-primary btn-sm btn-pil">Learn More</a></p>
                        </div>
                    </div>
 

                </div>
            </div>


        </div>
    </div>
</div>
<?php 
include 'footer.php';
?>