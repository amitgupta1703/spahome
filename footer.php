 
  
<footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                            <h2 class="footer-heading mb-4">Quick Links</h2>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo $baseurl?>">Home</a></li>
                                <li><a href="<?php echo $baseurl?>/about-us">About Us</a></li>  
                                <li><a href="<?php echo $baseurl?>/contact-us">Contact Us</a></li>
                                <li><a href="<?php echo $baseurl?>/become-partner" style="margin-top:0px;" ><span>Become Partner</span></a></li>
                                <!-- class="btn btn-primary btn-sm btn-pil becomePartnersBtn" -->
                                <li><a href="<?php echo $baseurl?>/franchise" style="margin-top:0px;" ><span>Franchise</span></a></li>
                                <li><a href="https://spahomeservice.in/blog/" style="margin-top:0px;" ><span>Blog</span></a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                            <h2 class="footer-heading mb-4">Services</h2>
                            <ul class="list-unstyled"> 
                            <?php 
                                       
                                $mainCategorys=array();
                                $mainCategorys=$dbControllers->getMainCategory();
                                foreach($mainCategorys as $mainCategory)
                                {
                                        $url=str_replace(" ","-",$mainCategory['main_category_name']);
                                        $url=strtolower($url);
                                ?>
                                <li><a href="<?php echo $baseurl?>/services-list/<?php echo $url; ?>"><?php echo $mainCategory['main_category_name']?></a></li>
                                
                                <?php 
                                    
                                }
                                ?>
                                 
                            </ul>
                        </div>
                        <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                        <h2 class="footer-heading mb-4">Policies</h2>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo $baseurl?>/terms-and-conditions">Terms and Conditions</a></li>
                                <li><a href="<?php echo $baseurl?>/privacy-policy">Privacy Policy</a></li>
                                <li><a href="<?php echo $baseurl?>/refund-policy">Refund Policy</a></li> 
                            </ul>

                            
                        </div>
                        <div class="col-md-6 mb-5 mb-lg-0 col-lg-3"> 
                            <h2 class="footer-heading mb-4">Follow Us</h2>
                            <a href="https://www.facebook.com/profile.php?id=100083492975206" class="pl-0 pr-3" target="_blank"><span class="fa fa-facebook"></span></a>
                          <!--   <a href="" class="pl-3 pr-3"><span class="fa fa-twitter"></span></a> -->
                            <a href="https://www.instagram.com/spa.home.service/" class="pl-3 pr-3" target="_blank"><span class="fa fa-instagram"></span></a>
                            <a href="https://www.linkedin.com/company/spa-home-service-in/" class="pl-3 pr-3" target="_blank"><span class="fa fa-linkedin"></span></a>
                            <a href="https://www.youtube.com/@spahomeservicein" class="pl-3 pr-3" target="_blank"><span class="fa fa-youtube"></span></a>
                            <div> 
                                <p class="mb-0">
                                    <span class="app">Get app on Store</span> 
                                    <a class="d-block mt-2" href="https://play.google.com/store/apps/details?id=com.company.spa_costumer" target="_blank">
                                        <img src="<?php echo $baseurl?>/images/playstore.png" alt="Play Store" height="40" width="140" >
                                    </a>
                                </p>

                                <p> 
                                    <a href="https://apps.apple.com/us/app/spahomeservice/id1644927159" target="_blank">
                                        <img src="<?php echo $baseurl?>/images/appstore.png" alt="Apple Store" height="40" width="140" >
                                    </a>
                                </p> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                 
            </div>
            
        </div>
        <div class="foot_bottom">
            <div class="container">
            <div class="row mt-5">
                <div class="col-12 text-md-center text-left">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Spa Home Service</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
            </div>
        </div>
    </footer>
    </div>

    <script src="<?php echo $baseurl?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery-ui.js"></script>
    <script src="<?php echo $baseurl?>/js/popper.min.js"></script>
    <script src="<?php echo $baseurl?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseurl?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.stellar.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.countdown.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.animateNumber.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.waypoints.min.js"></script>

    <script src="<?php echo $baseurl?>/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $baseurl?>/js/aos.js"></script>
    <script src="<?php echo $baseurl?>/js/rangeslider.min.js"></script> 
    <script src="<?php echo $baseurl?>/js/main.js"></script>
    <script>
       function deleteAccount(event){
            console.log("event",event.target);
           /*  if(window.confirm("Are you sure want to delete account")){
                    window.open("{$baseurl}/delete-account/true");
                } */
            if(event.target && event.target.id=="daccount"){
                if(window.confirm("Are you sure want to delete account")){
                    window.open("<?php echo $baseurl;?>/delete-account/true");
                }

            }
        }
         
    </script>
</body>

</html>