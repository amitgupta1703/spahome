<?php
$session_ids=$session_ids;
function updateCartValue(){
    if(isset($_SESSION['username'])){
        $userid=$_SESSION['username'];
        $cart_count_qu="select * from cart where user_id='$userid'";
    }else{
        $userid='Guest';
        $cart_count_qu="select * from cart where session_id='$session_ids'";
    }
    
    
    $cartcount=$dbControllers->numRows($cart_count_qu); 
    echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
}
?>