<?php 
$title="Shopping Cart";
$metaKeywords="Body Messsage, Spa for Women, Spa for Men";
$metaDescription="All type of spa services provided";
include 'header.php';
include 'codes/login-code.php';
 //echo $session_ids;
 if(isset($_GET['action']) && $_GET['action']=='remove' && isset($_GET['sid']) && $_GET['sid']!==''){
    if(isset($_SESSION['username'])){
        $userid=$_SESSION['username'];
        $stmt = $db->prepare("delete from cart where cart_id=? and user_id=?");
        $rc=$stmt->bind_param("ss", $_GET['sid'],$userid); 
        $rc=$stmt->execute(); 
        if($rc==false){
           // echo 'item not in cart';
        }else{
           // echo 'deleteletete hhh';
            $userid=$_SESSION['username'];
            $cart_count_qu="select * from cart where user_id='$userid'";
            $cartcount=$dbControllers->numRows($cart_count_qu); 
            echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
        }
    }else{
        $cart_count_query="select * from cart where";
        $stmt = $db->prepare("delete from cart where cart_id=? and  session_id=?");
        $rc=$stmt->bind_param("ss", $_GET['sid'],$session_ids); 
        $rc=$stmt->execute();
        if($rc==false){

        }else{
           // echo 'deleteletete hhh in sesssion'; 
           // echo 'item not in cart';
            $cart_count_qu="select * from cart where session_id='$session_ids'";
            $cartcount=$dbControllers->numRows($cart_count_qu); 
            echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
        }
    }

    
 }
 $cartcount=0;
?>
<?php 
    if(isset($_SESSION['username'])){
        $userid=$_SESSION['username'];
        $cart_count_qu="select * from cart where user_id='$userid'";
    }else{
        $userid='Guest';
        $cart_count_qu="select * from cart where session_id='$session_ids'";
    } 
    $cartcount=$dbControllers->numRows($cart_count_qu); 
?>
<!--Add to Cart Page-->
<! -- Just after opening body-->
<script>
fbq('track', 'AddToCart');;
</script>
<style>
    .s {
        border-top: 1px solid #c3c3c3;
        border-width: thin;
        width: 30%;
    }

    .cart-item-image {
        height: 100px;
        width: 120px;
        border: 1px solid #f1f1f1;
    }

    .table td {
        vertical-align: middle;
        border-top: none;
    }

    .qty {
        width: 50px;
        text-align: center;
    }

    .sName {
        font-weight: 600;
        margin-bottom: 0;
    }

    .title1 {
        background-color:
    }

    .checkoutBtn:hover {
        opacity: 0.8;
    }
    .delete{
        text-align:center;
    }
    @media (max-width:767.98px){
        .cart-item-image {
            height: 200px;
            width: 90%;
            border: 1px solid #f1f1f1;
        }
        .delete{
            text-align:left;
        }
    }
</style>
<div class="site-blocks-cover overlay" style="background-image: url(<?php echo $baseurl?>/images/sliders/slider5.jpg);">
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

<div class="site-section bg-light py-4">
    <div class="container">
        <?php 
                             
        if($cartcount!=0){
        ?>
        <div class="row">
            <div class="col-md-9 mb-5 aos-init aos-animate" data-aos="fade">
                <form action="" method="post" class="p-3 bg-white">
                    <h3 class="theme-color text-center"></h3>
                    <div style="margin-top:1rem;color:red;">
                        <?php  include 'errors.php' ?>
                    </div>
                    <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                        <?php  include 'success.php'; ?>
                    </div>

                    <div class="container form-group">
                        <div class="row">
                            <div class="col-md-12 borderBottom">
                                <h5><i class="fa fa-shopping-bag"></i> My Cart(<?php echo $cart_count; ?>)</h5>
                            </div> 
                        </div>
                        
                        <?php		 
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    $userid='';
                                    $offer=0;
                                   
                                    $cart_count=0;
                                    $totalDiscount=0; 
                                    if(isset($_SESSION['username'])){
                                        $userid=$_SESSION['username'];
                                        $cart_count_query="select * from cart where user_id='$userid'";
                                    }else{
                                        $cart_count_query="select * from cart where session_id='$session_ids'";
                                    }
                                   unset($_SESSION['cartItems']);
                                    $results = mysqli_query($db, $cart_count_query); 
                                    
                                    if (mysqli_num_rows($results) >0) {
                                    
                                    while($item = mysqli_fetch_assoc($results)){
                                        $cart_id=$item['cart_id'];
                                        $itemArray=array($cart_id=>array('cart_id'=>$item['cart_id'],'service_id'=>$item['service_id'],'session_id'=>$item['session_id'],'quantity'=>$item['quantity'],'amount'=>$item['amount'],'offers'=>$item['offersOrDiscount']));

                                        if(!empty($_SESSION["cartItems"])) { 
                                                $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"],$itemArray);
                                            }
                                         else {
                                            $_SESSION["cartItems"] = $itemArray;
                                        } 
                                      
                                       // print_r($_SESSION["cartItems"]);
                                        $item_price = $item["quantity"]*$item["amount"]; 
                                        $offer=$item["offersOrDiscount"];
                                        if($offer=='' || $offer==0){
                                            $offer='';
                                            $item_price= $item_price;
                                        }else{
                                            $totalDiscount=$totalDiscount+(($item_price*$offer)/100);
                                            $item_price=$item_price-(($item_price*$offer)/100);
                                            $offer=$offer.'% Off';
                                        }


                                        $imgHtml=''; 
                                        if($item["services_image"]!=""){
                                            if(strpos($item["services_image"],",")>-1){
                                                $imgs=explode(',',$item["services_image"]);  
                                                $imgHtml.='<img src="'.$baseurl.'/'.'services_img/'.$imgs[1].'" alt="'.$item["services_name"].'" id="img1" class="cart-item-image"/>';      
                                                
                                            }
                                            else{
                                                $imgHtml='<img src="'.$baseurl.'/'.$item["services_image"].'" alt="'.$item["services_name"].'" class="cart-item-image" >';
                                                
                                            }
                                            
                                        }
                                        
                                ?>
                        <div class="row py-md-3 py-3" style="border-bottom:1px solid #f1f1f1;">

                            <div class="col-md-2 px-md-0 pl-0 pb-1"> 
                                    <?php echo $imgHtml;?>
                                     
                            </div>
                            <div class="col-md-5 pr-md-0 pl-0 pb-1">
                                <p class="sName"><?php echo $item["services_name"]; ?></p>
                                <p><?php echo $item["services_description"]; ?></p>
                            </div>
                            <div class="col-md-1 px-md-0 pl-0 pb-1"><input type="tel" class="qty"
                                    value="<?php echo $item["quantity"]; ?>" /></div>
                            <div class="col-md-3 pr-md-0 pl-0 py-2 py-md-0">
                                <small><del><?php echo "<i class='fa fa-rupee'></i> ".$item["amount"].'</del></small>' ?>
                                        <?php echo "<i class='fa fa-rupee'></i> ". number_format($item_price,2).' <span class="theme-color">'.$offer ?></span>
                            </div>
                            <div class="col-md-1 pl-0 pb-1 delete">
                                <a href="shopping-cart.php?action=remove&sid=<?php echo $item["cart_id"]; ?>"
                                    class="btnRemoveAction"
                                    ><i
                                        class="fa fa-trash-o" title="Delete item"></i> <span class="d-sm-block d-md-none">Delete</span>
                                </a>
                            </div>
                            </div>
                            <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["amount"]*$item["quantity"]);
                                }
                                ?>
 

                        
                        <?php
                        } else {
                        ?>
                        <div class="no-records">Your Cart is Empty</div>
                        <?php 
                        }
                    

                        ?>


                    </div>


                </form>
            </div>

            <div class="col-md-3 aos-init aos-animate pr-0 pl-0" data-aos="fade" data-aos-delay="100">
                <div class="orderSummary">
                    <div class="paymentTypeHead">
                        <h5 class=" mb-0">Price Summary</h5>
                    </div>
                    <div class="bg-white p-2">
                        <table class="table">
                            <tr style="border-top:1px dashed #c1c1c1;">
                                <td class="pl-0">Subtotal:</td>
                                <td class="float-right">
                                    <strong><?php echo "<i class='fa fa-rupee'></i>".number_format($total_price, 2); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0">Discount:</td>
                                <td class="float-right theme-color">
                                    <strong><?php echo "-<i class='fa fa-rupee'></i>".number_format($totalDiscount, 2); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0">Convenience Fee:</td>
                                <td class="float-right theme-color">
                                    <strong><?php echo "<i class='fa fa-rupee'></i>" ?>
                                <?php
                                $convenienceFee=0; 
                                 $totalAmt=$total_price-$totalDiscount;
                                 if($totalAmt>299 && $totalAmt<1500){
                                     $convenienceFee=($totalAmt*5)/100;
                                 }
                                else if($totalAmt>1499 && $totalAmt<2500){
                                    $convenienceFee=($totalAmt*4)/100;
                                }
                                else if($totalAmt>2499 && $totalAmt<3500){
                                    $convenienceFee=($totalAmt*3)/100;
                                }
                                else if($totalAmt>3499 && $totalAmt<10000){
                                    $convenienceFee=($totalAmt*2.8)/100;
                                }
                                $convenienceFee=round($convenienceFee);
                                echo number_format($convenienceFee,2);
                                ?>
                                </strong></td>
                            </tr>
                            <tr class="py-4"
                                style="border-top:1px dashed #c1c1c1;border-bottom:1px dashed #c1c1c1; font-size: 18px;">
                                <td class="pl-0">Estimated Total:</td>
                                <td class="float-right">
                                    <strong><?php echo "<i class='fa fa-rupee'></i>".number_format(($total_price-$totalDiscount+$convenienceFee), 2); ?></strong>
                                </td>
                            </tr>
                            
                        </table>
                        <div class="">
                            
                             <h5 class="text-center mb-1"> 
                                <?php  
                                if($totalAmt>=700){
                                    echo '<a class="w-100 text-white paymentTypeHead checkoutBtn btnblack d-block"
                                    href="book-appointment.php?checkout=true&service_id=1&amount='.($total_price-$totalDiscount).'">Checkout</a>';
                                }
                                    elseif($totalAmt<700){
                                        echo '<p class="ordersText">Minimum order amount should be greater than Rs 700</p><button type="button" class="w-100 text-white paymentTypeHead checkoutBtn btnblack d-block disabledBtn"
                                         disabled="true" >Checkout</button>';
                                    }
                                ?>
                                
                                 
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            }else{  
        ?>
        <div class="row">
            <div class="col-md-12 aos-init aos-animate bg-white py-5" data-aos="fade">
                <h5><i class="fa fa-shopping-bag"></i> My Cart(0)</h5>
                <h5>Your cart is empty! Please add items to cart.</h5>
                <p><a href="<?php echo $baseurl?>/services-list.php">Continue Shopping</a></p>
            </div>

        </div>
        <?php } ?>
    </div>
</div>

<?php 
include 'footer.php';
?>