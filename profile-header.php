<?php 

$customer_name='';
$email='';
$contact='';

if(!isset($_SESSION['username']) && $_SESSION['username']=='' && !isset($_SESSION['cust_id'])){
    echo "<script> window.location.assign('{$baseurl}'); </script>";
}else{
    $uname=$_SESSION['username'];
   // echo $uname;
    $user_check_query = "select * from spa_customers where cust_username='$uname'  and phone_verification_status='Verify' limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results);  
        $customer_id=$row[0];
        $customer_name=$row[1]; 
        $email=$row[2];
        $contact=$row[3];  
    }
}
?>

<style>
@import url("https://rsms.me/inter/inter.css");
:root {
  --color-light: white;
  --color-dark: #212121;
  --color-signal: #fab700;
  --color-background: var(--color-light);
  --color-text: var(--color-dark);
  --color-accent: #ea728c;
  --size-bezel: .5rem;
  
} 
.input {
  position: relative;
  
}
.form-control{
    height:50px !important;
    /* margin-bottom:1rem; */
}
.input__label {
  position: absolute;
  left: 0;
  top: 0;
  padding: calc(var(--size-bezel) * 0.75) calc(var(--size-bezel) * .5);
  margin: calc(var(--size-bezel) * 0.75 + 3px) calc(var(--size-bezel) * .5);
  background: pink; 
  transform: translate(0, 0);
  transform-origin: 0 0;
  background: var(--color-background);
  transition: transform 120ms ease-in; 
  line-height: 1.2;
}
.input__field {
  box-sizing: border-box;
  display: block;
  width: 100%;
  padding: calc(var(--size-bezel) * 1.5) var(--size-bezel);
  color: currentColor;
  background: transparent;
  border-radius: var(--size-radius);
}
.input__field:not(:-moz-placeholder-shown) + .input__label {
  transform: translate(0.25rem, -65%) scale(0.8);
  color: var(--color-accent);
}
.input__field:not(:-ms-input-placeholder) + .input__label {
  transform: translate(0.25rem, -65%) scale(0.8);
  color: var(--color-accent);
}
.input__field:focus + .input__label, .input__field:not(:placeholder-shown) + .input__label {
  transform: translate(0.25rem, -65%) scale(0.8);
  color: var(--color-accent);
}

  
.hidden {
  display: none;
}
</style>
