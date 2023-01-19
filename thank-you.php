<?php 
$title="Thank You";
include 'header.php';
$franchise='';
$msg='';
$html='';
if(isset($_GET['franchise']) || isset($_GET['becomepartner'])){
    $franchise=$_GET['franchise'];
    $msg="Message send successfully we will contact you soon!";
    
}elseif (isset($_GET['register'])) {
    $register=$_GET['register'];
    if($register==true){
      $msg="Registration Successfull! <br> <span>Click <a href='".$baseurl."/login' class='loginLink'>here</a> to login</span>";
      //$html="<br> Click <a href='".$baseurl."/login' class='loginLink'>here</a> to login";

    }
}
?>

 

    <div class="block-services-1 py-5 mt-5" style="">
      <div class="container pt-5">
        <div class="row my-md-5">
         <div class="col-md-7 pr-md-0">
            <img src="<?php echo $baseurl; ?>/images/thank-you-2.jpg" class="img-responsive w-100"  alt="">
         </div>
          <div class="col-md-5 text-center bg d-flex justify-content-center align-items-center ml-xs-3 mr-xs-3"> 
            <h5 class="thanku"><?php echo $msg; ?></h5>
           <!-- <p><?php echo $html;?></p> -->
          </div>
        </div>
      </div>
    </div>
    
    <?php 
include 'footer.php';
?>