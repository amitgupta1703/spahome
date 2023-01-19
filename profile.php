<?php 
$title="Profile";
include 'header.php';
include 'codes/login-code.php';
include 'profile-header.php';
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
                    <p class="fs18">Personal Information</p>
                     <table class="table tbl">
                         <tr>
                             <td>Name</td>
                             <td><?php echo $customer_name?></td>
                         </tr>
                         <tr>
                             <td>Email </td>
                             <td><?php echo $email?></td>
                         </tr>
                         <tr>
                             <td>Contact</td>
                             <td><?php echo $contact?></td>
                         </tr>
                         <tr>
                             <td colspan="2"><input type="button" class="btn btn-primary btn-sm btn-pil becomePartnersBtn" value="Edit"></td> 
                         </tr>
                     </table>
                </div>
            </div>
        </div>
      </div>
    </div>

<?php 
include 'footer.php';
?>