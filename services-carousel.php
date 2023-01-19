<div class="owl-carousel-s owl-carousel" id="our_service_sec">

     <?php 
                                       
        $mainCategorys=array(); 
        $mainCategorys=$dbControllers->getMainCategory();
        foreach($mainCategorys as $mainCategory)
        {
            $url=str_replace(" ","-",$mainCategory['main_category_name']);
            $url=strtolower($url);  
        ?>  
            <div class="d-block block-testimony mx-auto text-center">
                <div class="mb-4">
                    <img src="<?php echo $baseurl?>/<?php echo $mainCategory['ourspaImg']; ?>" alt="<?php echo $mainCategory['main_category_name']; ?>" class="img-fluid ">
                </div>
                <div>
                    <h2 class="h5 theme-color fs17"><?php echo $mainCategory['main_category_name']; ?></h2>
                    <p><a href="<?php echo $baseurl?>/services-list/<?php echo $url?>" class="btn btn-primary btn-sm btn-pil">Book Now</a></p>
                </div>
            </div>
        
        <?php 
            
        }
        ?>
 
</div>