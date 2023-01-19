<?php 
session_start(); //to ensure you are using same session
unset($_COOKIE['un_i']);
unset($_COOKIE['un_']);
setcookie('un_i',"",time()-60);
setcookie('un_',"",time()-60);
session_unset();
session_destroy(); //destroy the session

header("location:index.php"); //to redirect back to "index.php" after logging out


exit();
?>