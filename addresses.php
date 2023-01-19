<?php 
$title="Profile";
include 'header.php';
include 'codes/login-code.php';
include 'profile-header.php';
$customer_name='';
$email='';
$contact='';
$add='';

if(!isset($_SESSION['username']) && $_SESSION['username']=='' && !isset($_SESSION['cust_id'])){
    echo "<script> window.location.assign('index.php'); </script>";
}else{
    $uname=$_SESSION['username'];
    if(isset($_GET['add'])){
        $add=$_GET['add'];
    }
    $mobilenumber="12234"; 
    //echo $uname;
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
.s{
    border-top: 1px solid #c3c3c3;
    border-width: thin;
    width: 30%;
}

</style>
 
   
    <div class="site-section bg-light mt-5">
      <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include 'profile-sidebar.php'; ?>
            </div> 
            <div class="col-md-8 aos-init aos-animate" data-aos="fade" data-aos-delay="100"> 
                <div class="card box inners">
                    <p class="fs18">Manages Addresses</p>
                    <?php 
                    $uname=$_SESSION['username'];
                     $address_query = "select * from cust_address where cust_username='$uname'"; 
                    $results = mysqli_query($db, $address_query); 
                    if (mysqli_num_rows($results) >0) { 
                    while($row = mysqli_fetch_row($results)){
                        $address='';
                    if($row[2]!=''){
                        $address=$row[2];
                    }if($row[3]!='' || $row[3]!=null){
                        $address=$address.', '.$row[3];
                    }
                    if($row[4]!='' || $row[4]!=null){
                        $address=$address.', '.$row[4];
                    }
                    if($row[5]!='' || $row[5]!=null){
                        $address=$address.', '.$row[5];
                    }
                    $address=$address.', '.$row[9].' - '.$row[8];
                        echo '<div class="card box inners">
                                <div class="row mb-2">
                                    <div class="col-md-3"><b>'.$row[1].'</b></div>
                                    <div class="col-md-6"><b>'.$row[6].'</b></div>
                                    <div class="col-md-3 text-right float-right"><i class="fa fa-ellipsis-v"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 fs14">'.$address.'</div></div></div>';
                        }
                    }else{
                        echo '<div class="card box inners">
                        <div class="row mb-2">
                            <div class="col-md-12"><b>No address found</b></div> 
                        </div>
                       </div>';
                    }
                    ?>   
                    <div class="card box inners"> 
                        <div class="row">
                            <div class="col-md-12"> 
                                <span class="theme-color cursor" onclick="addAddress(event)">+ Add New Address</span>
                            </div> 
                        </div>
                        <div><h1 id="add-address"></h1></div>
                        <div class="forms" style="<?php if($add=="true"){echo 'display:block;';}else{echo 'display:none;';} ?>"  id="addaddressform">
                              <form action="addresses.php?add=true" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div style="margin-top:1rem;color:red;">
                                        <?php  include 'errors.php' ?>
                                    </div>
                                    <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                                        <?php  include 'success.php' ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 ">
                                        <label class="text-black" for="name">Name</label> 
                                        <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $name;}?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-black" for="mobilenumber">Mobile Number</label> 
                                        <input type="text" id="mobilenumber" name="mobilenumber" class="form-control" value="<?php if(isset($_POST['mobilenumber'])) {echo $mobilenumber;}?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="text-black" for="address">Address</label> 
                                        <input type="text" id="address1" name="address1" class="form-control" value="<?php if(isset($_POST['address1'])) {echo $address1;}?>">
                                    </div> 
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 ">
                                        <label class="text-black" for="locality">Locality</label> 
                                        <input type="text" id="locality" name="locality" class="form-control" value="<?php if(isset($_POST['locality'])) {echo $locality;}?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-black" for="city">City/District/Location</label> 
                                        <!-- <input type="text" id="city" name="city" class="form-control"> -->
                                        <select id="city" name="city" class="form-control">
                                        <?php  
                                            $address_query = "select * from ourlocations where status='active'"; 
                                            $results = mysqli_query($db, $address_query); 
                                            $numRows=mysqli_num_rows($results);
                                            if (mysqli_num_rows($results) >0) { 
                                                    
                                                while($row = mysqli_fetch_row($results)){
                                                    $address=$row[2]; 
                                                $addressValue=$row[2]; 
                                                    echo ' 
                                                            <option class="form-control" value="'.$addressValue.'"> '.$address.'</option>';
                                                } 
                                            }
                                            ?>
                                        </select>
                                        <small><b>Note:</b> We provides service only given cities.</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 ">
                                        <label class="text-black" for="pincode">Pincode</label> 
                                        <input type="text" id="pincode" name="pincode" class="form-control" value="<?php if(isset($_POST['pincode'])) {echo $pincode;}?>">
                                    </div>
                                    <div class="col-md-6 ">
                                        <label class="text-black" for="landmark">Landmark(Optional)</label> 
                                        <input type="text" id="landmark" name="landmark" class="form-control" value="<?php if(isset($_POST['landmark'])) {echo $landmark;}?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label class="text-black" for="state">State</label> 
                                        <select name="state" required="" class="form-control">
                                            <option value="-1" >--Select State--</option><option value="Andaman &amp; Nicobar Islands">Andaman &amp; Nicobar Islands</option><option value="Andhra Pradesh">Andhra Pradesh</option><option value="Arunachal Pradesh">Arunachal Pradesh</option><option value="Assam">Assam</option><option value="Bihar">Bihar</option><option value="Chandigarh">Chandigarh</option><option value="Chhattisgarh">Chhattisgarh</option><option value="Dadra &amp; Nagar Haveli &amp; Daman &amp; Diu">Dadra &amp; Nagar Haveli &amp; Daman &amp; Diu</option><option value="Delhi">Delhi</option><option value="Goa">Goa</option><option value="Gujarat">Gujarat</option><option value="Haryana">Haryana</option><option value="Himachal Pradesh">Himachal Pradesh</option><option value="Jammu &amp; Kashmir">Jammu &amp; Kashmir</option><option value="Jharkhand">Jharkhand</option><option value="Karnataka">Karnataka</option><option value="Kerala">Kerala</option><option value="Ladakh">Ladakh</option><option value="Lakshadweep">Lakshadweep</option><option value="Madhya Pradesh">Madhya Pradesh</option><option value="Maharashtra">Maharashtra</option><option value="Manipur">Manipur</option><option value="Meghalaya">Meghalaya</option><option value="Mizoram">Mizoram</option><option value="Nagaland">Nagaland</option><option value="Odisha">Odisha</option><option value="Puducherry">Puducherry</option><option value="Punjab">Punjab</option><option value="Rajasthan">Rajasthan</option><option value="Sikkim">Sikkim</option><option value="Tamil Nadu">Tamil Nadu</option><option value="Telangana">Telangana</option><option value="Tripura">Tripura</option><option value="Uttarakhand">Uttarakhand</option><option value="Uttar Pradesh">Uttar Pradesh</option><option value="West Bengal">West Bengal</option></select>
                                    </div>

                                     <div class="col-md-6 ">
                                        <label class="text-black" for="altenateNumber">Alternate Number(Optional)</label> 
                                        <input type="text" id="altenateNumber" name="altenateNumber" class="form-control" value="<?php if(isset($_POST['altenateNumber'])) {echo $altenateNumber;}?>">
                                    </div> 
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <input type="submit" style="width:100% !important" name="addnewaddress" value="Save Address" class="btn btn-pil btn-primary btn-md text-white"> 
                                    </div>
                                    <div class="col-md-6">
                                        <a style="width:100% !important"   onclick="hideForm()"  class="btn btn-pil btn-primary btn-md text-white"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                    
                    
                </div>
            </div>
        </div>
      </div>
    </div>
<script>
/* function addAddress(e){
    console.log("abbbd");
} */
</script>
<?php 
include 'profile-footer.php';
include 'footer.php';
?>