<?php   
 
if(isset($_SESSION["cartItems"])){
    unset($_SESSION["cartItems"]);
}
session_start(); //to ensure you are using same session
setcookie('un_ic',"",time()-60);
setcookie('un_c',"",time()-60);
setcookie('un_na',"",time()-60);
unset($_COOKIE['un_ic']);
unset($_COOKIE['un_c']);
unset($_COOKIE['un_na']);
session_unset();
session_destroy(); //destroy the session
header("location:index"); //to redirect back to "index.php" after logging out

exit();
?>