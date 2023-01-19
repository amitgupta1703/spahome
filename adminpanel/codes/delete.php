<?php 
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();
include '../config.php';
if(isset($_POST['service_delete']) && isset($_GET['action']) && $_GET['action']=='remove' && isset($_POST['p_sid'])){ 

       $stmt = $db->prepare("delete from services where service_id=?");
       $rc=$stmt->bind_param("i", $_POST['p_sid']); 
       $rc=$stmt->execute(); 
       echo "delete id ", mysqli_delete_id($db);
       if($rc==false){
            echo "<script>(function(){alert('Item not deleted successfully')})()</script>";
       }else{  
           echo "<script>(function(){alert('Item deleted successfully')})()</script>";
       }
      
} 
?>
 