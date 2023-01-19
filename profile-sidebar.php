<div class="card text-center box">
    <div class="card-body pd0">
        <img src="../adminpanel/images/avtar.png" class="profileImg" alt="profile">
        <p class="card-title mt-2 fs18">Welcome <?php echo $name;?></p>
    </div> 
</div>
<div class="card box mt-3">
    <div class="card-body pd0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item box"><a href="<?php echo $baseurl?>/profile">Profile</a></li>
            <li class="list-group-item mt-1 box"><a href="<?php echo $baseurl?>/change-password">Change Password</a></li>
            <li class="list-group-item mt-1 box"><a href="<?php echo $baseurl?>/addresses">Save Address</a></li>
            <li class="list-group-item mt-1 box"><a href="<?php echo $baseurl?>/order-history">Order History</a></li>
        </ul>
    </div> 
</div>
<div class="card box mt-3">
    <div class="card-body pd0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?php echo $baseurl?>/logout"> <i class="fa fa-power-off theme-color"></i> Logout</a></li> 
            <li class="list-group-item"><a onclick="deleteAccount(event)" id="daccount"> <i class="fa fa-trash theme-color"></i> Delete Account</a></li> 
        </ul>
    </div> 
</div>