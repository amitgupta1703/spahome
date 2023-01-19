<?php
				   include 'dbwe.php';
				   if(isset($_GET['reg_id'])){
					//echo '<script>confirm("Are you sure want to delete? User: '.$_GET['reg_id'].'");return true;</script>';
						
						$str=$_GET['reg_id'];
						echo 'str '.$str;
						$delete_user="delete from crj_registration where id=$str";
						$result1=mysqli_query($db,$delete_user); 
						if ( $result1 > 0) {
						echo '<script>alert("User Deleted Successefully");window.location.href="register-user.php"</script>';
						
						//echo "window.location('register-user.php')";
						}
						else
						{
							echo '<script>alert("User not Deleted Successefully");window.location.href="register-user.php"</script>';
							//echo "window.location('register-user.php')";
						}
				   }
                  
				   
?>