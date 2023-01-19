<?php 
include './config.php';  
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg = array();
  
$session_id;
$status="";
if (isset($_POST['service_id']) && $_POST['service_id']!=""){
$quantity = 1;
$session_id=$session_ids;
//echo 'sss:: '.$session_ids.'<br>';
$s_id=$_POST['service_id'];
$user_id='';
 if(isset($_SESSION['username'])){
    $user_id=$_SESSION['username'];
 }else{
    $user_id='Guest'; 
 }
 
$result = mysqli_query($db,"SELECT * FROM services WHERE service_id=$s_id");
$row = mysqli_fetch_assoc($result);

$services_name = $row['services_name'];
$service_id=$row['service_id'];
$main_category = $row['main_category'];
$category = $row['category'];
$subcategory = $row['subcategory'];
$duration = $row['duration'];
$services_description = $row['services_description'];
$amount = $row['amount'];
$offersOrDiscount = $row['offersOrDiscount'];
$services_image = $row['services_image'];

 $cartArray = array($s_id=>array('services_name'=>$services_name, 'service_id'=>$s_id, 'main_category'=>$main_category, 'category'=>$category,  'subcategory'=>$subcategory,  'duration'=>$duration, 'services_description'=>$services_description, 'amount'=>$amount, 'offersOrDiscount'=>$offersOrDiscount, 'services_image'=>$services_image, 'quantity'=>$quantity
    )
); 


 

//echo "checkjksjd :: ".$service_id[0]["service_id"];
//$_SESSION["shopping_cart"]='';
/* echo '<br>new cart<br>';
print_r($_SESSION['cart']);

 if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    echo 'echo ::::: '.$array_keys[0],' gggggg: ',in_array($s_id,$array_keys),'<br>';
    if(in_array($s_id,$array_keys)) {
        if(isset($_SESSION["shopping_cart"])){
            foreach($_SESSION["shopping_cart"] as $data){
                echo 'data:: ',$data['quantity'];
                if($data['service_id']==$s_id){
                    $_SESSION["shopping_cart"]["quantity"] =$_SESSION["shopping_cart"]["quantity"]+$quantity;
                }
            }
        } 
        echo '<br> if<br>';
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } else {
        echo '<br> else<br>';
        //echo 'echo 1::::: '.$array_keys.'<br>';
        if(isset($_SESSION["shopping_cart"])){
            foreach($_SESSION["shopping_cart"] as $data){
                echo 'data:: ',$data;
            }
        } 
    $_SESSION["shopping_cart"] = array_merge( $_SESSION["shopping_cart"], $cartArray);
    $status = "<div class='box'>Product is added to your cart!</div>";
	}

    }
   
     echo $status;
     
    echo 'abbc',$array_keys[0],'<br>';
    //print_r();
    print_r($_SESSION["shopping_cart"]); 
    echo '<br>abbc  end <br>'; */

 
if($user_id=='Guest'){
    $user_check_query = "select * from cart where service_id='$service_id' and session_id='$session_ids'"; 
    $results123 = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results123) >0) { 
        $row = mysqli_fetch_array($results123); 
        $ser_id=$row[1]; 
        $session_id1=$row[12];
        //echo '<br>ajhaskjdhkhdfkh: ', $ser_id, ',',$session_id1,'<br>';
        if($service_id==$ser_id && $session_ids==$session_id1){
           //echo 'array.pud';
            array_push($errors, "Item already in cart"); 
            echo "<script>(function(){alert('Item already in cart')})()</script>";
            
        }     
    }
}else{
    $user_check_query = "select * from cart where service_id='$service_id' and user_id='$user_id'"; 
    $results123 = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results123) >0) { 
        $row = mysqli_fetch_array($results123); 
        $ser_id=$row[1]; 
        $session_id1=$row[12];
       // echo '<br>ajhaskjdhkhdfkh: ', $ser_id, ',',$session_id1,'<br>';
        if($service_id==$ser_id && $session_ids==$session_id1){
         //  echo 'array.pud';
            array_push($errors, "Item already in cart");
            echo "<script>(function(){alert('Item already in cart')})()</script>";
        }     
    }
}

      
        $date = date('Y-m-d H:i:s'); 
        if (count($errors) == 0) {  
            $stmt = $db->prepare("INSERT INTO cart(service_id,services_name,quantity,main_category,category,subcategory,duration,services_description,amount,offersOrDiscount,services_image,session_id,user_id,date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $rc=$stmt->bind_param("ssssssssssssss", $service_id,$services_name,$quantity,$main_category,$category,$subcategory,$duration,$services_description,$amount,$offersOrDiscount,$services_image,$session_id,$user_id,$date);
            $rc=$stmt->execute(); 
        
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                array_push($errors, "Error occurs while submitting data, Retry again!");
            }else{
                $cart_id=mysqli_insert_id($db); 
               // echo "<script>(function(){alert('Item added successfully in cart!')})()</script>";
                //$_SESSION['cartItems'];
                $itemArray=array($cart_id=>array('cart_id'=>$cart_id,'service_id'=>$service_id,'session_id'=>$session_ids));
                if(!empty($_SESSION["cartItems"])) { 
                        $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"],$itemArray);
                    }
                 else {
                    $_SESSION["cartItems"] = $itemArray;
                } 
                //print_r($_SESSION["cartItems"]);
                //echo cartCount
                if(isset($_SESSION['username'])){
                    $userid=$_SESSION['username'];
                    $cart_count_qu="select * from cart where user_id='$userid'";
                }else{
                    $userid='Guest';
                    $cart_count_qu="select * from cart where session_id='$session_ids'";
                }
                
                
                $cartcount=$dbControllers->numRows($cart_count_qu); 
                echo "<script>(function(){var ele=document.getElementById('cartCount');if(ele){ele.innerHTML='<sup>{$cartcount}</sup>'}})()</script>";
                
                echo "<script>(function(){window.location.href='{$baseurl}/shopping-cart'})()</script>";
                array_push($successMsg, "Item added successfully in cart!");
            }     
        }



/* $cartArray = array(
	$service_id=>array( 
    'services_name'=>$services_name,
    'service_id'=>$service_id,
	'main_category'=>$main_category,
	'category'=>$category,
    'subcategory'=>$subcategory,
    'duration'=>$duration,
    'services_description'=>$services_description,
    'amount'=>$amount,
    'offersOrDiscount'=>$offersOrDiscount,
    'services_image'=>$services_image,
    'quantity'=>$quantity,
    
    
    )
); */

//echo "checkjksjd :: ".$service_id[0]["service_id"];
//$_SESSION["shopping_cart"]='';
//print_r($cartArray);

/* if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    //echo 'echo ::::: '.$array_keys.'<br>';
    if(in_array($service_id,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } else {
        //echo 'echo 1::::: '.$array_keys.'<br>';
    $_SESSION["shopping_cart"] = array_merge( $_SESSION["shopping_cart"], $cartArray);
    $status = "<div class='box'>Product is added to your cart!</div>";
	}

    }
   
     echo $status;
     
    //echo 'abbc'.$cart_count;
    print_r($array_keys);
    print_r($cartArray['1001'][0]); */
}
 
?>