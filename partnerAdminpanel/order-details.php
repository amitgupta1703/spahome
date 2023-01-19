<?php include 'header.php'?>

<?php include 'top-nav.php';?>
<?php  
include 'dbwe.php';
unset($errors); 
$errors = array(); 
unset($successMsg); 
$successMsg=array();




 if(!isset($_GET['o_id']) || $_GET['o_id']==''){
    echo "<script> window.location.assign('check-appointments.php'); </script>";
 }
 else{
    $order_ids=$_GET['o_id'];
}

 
if(isset($_POST['submit_otp'])){
    $otp =mysqli_real_escape_string($db, $_POST['otp']);
    if (empty($otp)) { array_push($errors, "Please enter otp"); }
    $query="select * from spa_assign_lead where partners_reach_code = '$otp'  limit 1";
    $result = mysqli_query($db, $query);
   if (mysqli_num_rows($result) ==1) {
    if (count($errors) == 0) {
        $is_code_verify="true";
        $stmt = $db->prepare("update spa_assign_lead set is_code_verify=? where order_id=?");
        $rc=$stmt->bind_param("ss", $is_code_verify,$order_ids);
        $rc=$stmt->execute();
       if ( true===$rc ) {
        array_push($successMsg, "Code submitted sucessfully");
        }else{
            array_push($errors, "Code not submitted sucessfully, Please Try Again!!");  
        }
     }
   } else{
    array_push($errors, "Invalid Code, Please Try Again!!");
   }
 }


 if(isset($_POST['submit_image'])){
   /*  $profileImg=mysqli_real_escape_string($db, $_FILES["uploadImg"]["name"]); 
    if(empty($profileImg) || $profileImg==""){
        array_push($errors, "Please select image");
    }
      */
  
    $queryGetCount="select count(*) as total from spa_assign_lead";
    $result = mysqli_query($db, $queryGetCount);
    $allRecord=mysqli_fetch_assoc($result);
    $totalRecord;
    
    if($allRecord>0)
    {
        $totalRecord=$allRecord['total'];
        $totalRecord=$totalRecord+1;
    }

            // Configure upload directory and allowed file types
            $upload_dir = './../partners_service_img/'.DIRECTORY_SEPARATOR;
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
            $target_path='';
            // Define maxsize for files i.e 2MB
            $maxsize = 4 * 1024 * 1024;
        
            // Checks if user sent an empty form
            if(!empty(array_filter($_FILES['uploadImg']['name']))) {
        
                // Loop through each file in files[] array
                foreach ($_FILES['uploadImg']['tmp_name'] as $key => $value) {
                    
                    $file_tmpname = $_FILES['uploadImg']['tmp_name'][$key];
                    $file_name = $_FILES['uploadImg']['name'][$key];
                    $file_size = $_FILES['uploadImg']['size'][$key];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
                    // Set upload file path
                    $filepath = $upload_dir.$file_name;
                  
                    // Check file type is allowed or not
                    if(in_array(strtolower($file_ext), $allowed_types)) {
        
                        // Verify file size - 4MB max
                        if ($file_size > $maxsize)		 
                            array_push($errors, "File size should be less than 4MB ");
        
                        // If file with name already exist then append time in
                        // front of name of the file to avoid overwriting of file
                        if(file_exists($filepath)) {
                            $filepath = $upload_dir.time().$file_name;
 
                            
                            if( move_uploaded_file($file_tmpname, $filepath)) {   
                                $target_path.=','.time().$file_name;
                            }
                            else {					 
                                array_push($errors, "Error uploading, Try again!! ");
                            }
                        }
                        else {
                        
                            if( move_uploaded_file($file_tmpname, $filepath)) { 
                               $target_path.=','.$file_name;
                            }
                            else {					
                                array_push($errors, "Error uploading, Try again!! ");
                            }
                        }
                    }
                    else { 
                        array_push($errors, "Error uploading, Try again!! "); 
                        array_push($errors, "({$file_ext} file type is not allowed)<br / >");
                    }
                }
                
            }
            else { 
                array_push($errors, "No image selected, Please select image ");
            }
        
  
    /* $target_path = "./../partners_service_img/";
    //$file = $_POST['uploadResume'];
    $target_path = $target_path.basename( $totalRecord.'_'. $_FILES["uploadImg"]["name"]); 
    $file_name= $totalRecord.'_'.$_FILES["uploadImg"]["name"];
    $file_name=strtolower($file_name);
    $temp = explode('.', $file_name);
  
    $extension = end($temp);
  
    //array_push($errors, "Extension ".$extension);
  
      if ( 8048576 < $_FILES["uploadImg"]["size"]  ) { 
      array_push($errors, "File size should be less than 4MB ");
      }
  
      if ( ! ( in_array($extension, $allowedExts ) ) ) {
          array_push($errors, "Please upload jpeg, png, gif ");
      }
      else{
        move_uploaded_file($_FILES["uploadImg"]["tmp_name"], $target_path); 
      } */
  
  
      if (count($errors) == 0) { 
      
        $stmt = $db->prepare("Update spa_assign_lead set partner_on_service_image=? where order_id=?");
       $rc= $stmt->bind_param("ss", $target_path, $order_ids);
       $rc=$stmt->execute();
       if($rc==true){
        array_push($successMsg,"Image uploaded successfully!!");
        $target_path='';
        
       }else{
        array_push($successMsg,"Something went wrong!, Image not uploaded successfully"); 
        $target_path='';
       }
       
     
          
    }
   
}

?>


<style>
    .row {
        padding: 6px 0px !important;
    }

    button {
        width: 150px !important;
    }

    label.data {
        border: 1px solid #ccc;
        padding: 8px;
        width: 100%;
    }

    .form-group label:first-child {
        font-size: 14px;
    }
    .form-group label:last-child {
        font-weight:500;
    }
    .mt-3 {
        padding-top: 1rem;
    }
</style>

<div class="right_col" role="main" style="min-height: 3787px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Booked Order Details</h3>
            </div>


        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Booked Order Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $dateS = date('Y-m-d');
                                        
                            //echo "date ",$dateS;

                            $stmt = $db->prepare("select o.order_id,o.booking_id,o.session_id,o.date,o.bookingStatus,o.paymentStatus,o.gateway_paymentid,b.paymentStatus,
                            b.id,b.name,b.email,b.contact,b.service_name,b.serviceDate,b.cust_address_id,b.serviceTiming,b.message,
                            b.amount,b.paymentMode,b.bookingStatus,b.service_id,b.partners_admin_id,b.customer_address,
                            b.cust_address_id,b.session_id,b.reason,b.cust_username,b.cust_id,b.isassigned,b.isreschedule,b.rescheduleDate,b.rescheduleTime
                            from book_appointment b
                            join orders_details o on o.order_id=b.orderId
                            where order_id=? limit 1");
                            $stmt->bind_param("i",$_GET['o_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $datas = $result->fetch_array(MYSQLI_ASSOC);
                            if($datas){

                           
                        ?>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Order ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['order_id']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Booking ID
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['booking_id']?>
                                    </label>
                                </div>
                            </div>
 

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Order Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo date_format(new DateTime($datas['date']),"d M Y H:i")?>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Payment Mode
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['paymentMode']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Booking Status
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['bookingStatus']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Amount
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo number_format($datas['amount'],2)?>
                                    </label>
                                </div>
                            </div>
 

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Service Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php 
                                        echo date_format(new DateTime($datas['serviceDate']),"d M Y"),'-';
                                       // $day=$dateS = date('d');
                                       // echo $datas['serviceDate'],':',$dateS,':',date('Y-m-d');
                                        $dayToService='';
                                        $d1=$datas['serviceDate'];
                                        $d2=date('Y-m-d');
                                       // $date1 = new DateTime($d1);
                                        //$date2 = new DateTime($d2);
                                        //$interval = $date2->diff($date1);

                                        $date1=date_create($d2);
                                        $date2=date_create($d1);
                                        $diff=date_diff($date1,$date2);
                                        //echo $diff->format("%R%a");

                                        $dayDiff=$diff->format("%R%a"); 
                                        if($dayDiff=="1"){
                                            $dayToService="Tomorrow"; 
                                        }else if($dayDiff=="2"){
                                            $dayToService="The Day After Tomorrow"; 
                                        }else if($dayDiff=="0"){
                                            $dayToService="Today"; 
                                        }if($dayDiff=="-1"){
                                            $dayToService="Yestarday"; 
                                        }
                                       // echo "$dayDiff:: ",$dayDiff;
                                       if($dayToService!=''){
                                        echo '&nbsp;'.$dayToService;
                                       }
                                        
                                        //echo "<br> d1:",$d1," ::: d2:: ",$d2;
                                        ?>
                                    </label>
                                   
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Service Timing
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['serviceTiming']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Is Reschedule
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['isreschedule']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Reschedule Date
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['rescheduleDate']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Reschedule Timing
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['rescheduleTime']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Is Assigned
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['isassigned']?>
                                    </label>
                                </div>
                            </div>

                        </div>
                        </div>
                </div>
               
                <div class="x_panel">
                    <div class="x_title"> 
                        <h2>Customer Details</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Name
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['name']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Email
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['email']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Contact
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['contact']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Address
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['customer_address']?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Message
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $datas['message']?>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="x_panel">
                    <div class="x_title">
                         
                            <h2>Orders Details</h2> 
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            </ul>
                            <div class="clearfix"></div>
                        
                    </div>
                    <div class="x_content">
                        <?php    
                            $items=$datas['service_name']; 
                            $arr = json_decode($items, true);
                            //print_r($arr);
                            $item_price =0;
                            foreach($arr as $item){
                                $s_id= $item['service_id'];
                                $stmt = $db->prepare("select * from services
                                where service_id=? limit 1");
                                $stmt->bind_param("i",$s_id);
                                $stmt->execute();
                                $resultServices = $stmt->get_result();
                                $service = $resultServices->fetch_array(MYSQLI_ASSOC);
                                //print_r($service);
                                
                                $item_price = $item["quantity"]*$item["amount"]; 
                                $offer=$item["offers"];
                                if($offer=='' || $offer==0){
                                    $offer='';
                                    $item_price= $item_price;
                                }else{
                                    //$totalDiscount=$totalDiscount+(($item_price*$offer)/100);
                                    $item_price=$item_price-(($item_price*$offer)/100);
                                    $offer=$offer.'% Off';
                                }
                                ?>
                        <div class="row">
                            <div class="col-md-2 mt-3">
                                <img width="120px" height="100px"
                                    src="../<?php echo $service['services_image']?>" alt="">
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Service Name
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $service['services_name']?>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Service Description
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $service['services_description']?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Quantity
                                    </label><br>
                                    <label class="control-label data">
                                        &nbsp;<?php echo $item['quantity']?>
                                    </label>
                                </div> 
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Amount
                                </label><br>
                                <label class="control-label data">
                                    &nbsp;<del><?php echo number_format($item["amount"],2)?></del>
                                    <?php echo number_format($item_price,2),' ',$offer?>
                                </label>
                            </div> 

                        </div>
                        <hr>
                        <?php } ?>

                    </div>
                </div>
                <?php 
                   $order_ids=$datas['order_id'];
                   $data;
                  // echo "order id :: ",$order_ids;
                   $assign_lead_data;
                   $spa_assign_lead_query = "select * from spa_assign_lead where order_id='$order_ids' and isassigned='true'"; 
                   $resultsData1 = mysqli_query($db, $spa_assign_lead_query); 
                   $assign_count=mysqli_num_rows($resultsData1);
                   $assign_lead_data = mysqli_fetch_assoc($resultsData1);
                   $partner_id=$assign_lead_data['partner_id'];

 


                   $spa_assign_lead_query1 = "select * from spa_assign_lead where partner_id='$partner_id' and isassigned='true' and DATE(date)='$dateS'"; 
                   $getPartnerCount = mysqli_query($db, $spa_assign_lead_query1); 
                   $assign_partner_count=mysqli_num_rows($getPartnerCount);
                   //$assign_count=mysqli_num_rows($resultsData1);
                   $shopStatusP='';
                   $addres='';
                   //echo "count ",$count;
                   if($assign_count>0){
                    
                    $partners_registration_query = "select * from partners_registration where partners_id='$partner_id' limit 1"; 
                    $results2 = mysqli_query($db, $partners_registration_query); 
                    if (mysqli_num_rows($results2) >0) { 
                        $item = mysqli_fetch_assoc($results2);
                        $dataPartner1 = array(
                            'partners_id' => $item['partners_id'],
                            'name' => $item['name'],
                            'email' => $item['email'],
                            'contact' => $item['contact'],
                            'location' => $item['location'],
                            'city' => $item['city'],
                            'state' => $item['state'],
                            'pincode' => $item['pincode'],
                            'partners_username' => $item['partners_username'],
                            'status' => $item['status'],
                            'shopStatus' => $item['shopStatus'],
                            'lead_count'=>$assign_partner_count
                        );
                        if($dataPartner1['shopStatus']=='open'){
                            $shopStatusP='Online';
                        }else{
                            $shopStatusP='Offline';
                        }
                        $addres=$dataPartner1['location'].', '.$dataPartner1['city'].', '.$dataPartner1['state'].'-'.$dataPartner1['pincode'];
                 ?>
                <div class="x_panel">
                    <div class="x_title"> 
                        <h2>Order Assigned To You</h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Your ID</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $dataPartner1['partners_id'] ?>
                                </label>
                            </div> 
                             
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Status</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $shopStatusP ?>
                                </label>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="control-label">Today Leads</label><br>
                                <label class="control-label data">
                                    &nbsp;<?php echo $dataPartner1['lead_count'] ?>
                                </label>
                            </div> 
 
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label class="control-label">Booking Or Service Status
                                    </label><br>
                                    <label class="control-label data" style="color:red">
                                        &nbsp;<?php echo $datas['bookingStatus']?>
                                    </label>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                  
                 <div class="x_panel" style="display:<?php if($assign_lead_data['is_code_verify']=="true"){echo 'none';}else{echo 'inline-block';} ?>">
                    <div class="x_title">
                         
                            <h2>Submit Otp</h2> 
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            </ul>
                            <div class="clearfix"></div>
                        
                    </div>
                    <div class="x_content">
                        <form  method="post" action="order-details.php?o_id=<?php echo $order_ids ?>" data-parsley-validate=""  class="form-horizontal form-label-left" novalidate="" enctype="multipart/form-data" > 
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div style="margin-top:1rem;color:red;">
                                            <?php  include '../errors.php' ?>
                                    </div>
                                    <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                                        <?php  include '../success.php' ?>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-group" id="otp">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="otp">Enter OTP 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="otp" name="otp" class="form-control col-md-7 col-xs-12">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12"> 
                                    <input type="submit" class="btn btn-success" name="submit_otp" value="Submit Otp">
                                </div>
                            </div>  
                        </form>
                    </div>
                </div>

                <div class="x_panel"  >
                    <div class="x_title">
                         
                            <h2>Upload Image</h2> 
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li> 
                            </ul>
                            <div class="clearfix"></div>
                        
                    </div>
                    <div class="x_content">

                    <form  method="post" action="order-details.php?o_id=<?php echo $order_ids ?>" enctype="multipart/form-data"> 
                    <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="margin-top:1rem;color:red;">
                                    <?php  include '../errors.php' ?>
                            </div>
                            <div style="margin-top:1rem;color:green;font-size:1.3rem;">
                                <?php  include '../success.php' ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label " for="otp"> 
                            </label>
                         </div> 
                    </div>
                    <div class="row" >
                    <?php 
                        if($assign_lead_data['partner_on_service_image']!=""){
                            $imgs=explode(',',$assign_lead_data['partner_on_service_image']);
                          
                            $len=count($imgs);
                            for($i=0;$i<$len;$i++){
                                if($imgs[$i]!=""){
                                    echo ' <img src="./../partners_service_img/'.$imgs[$i].'" alt="" height="120" width="150" border="1px">';
                                }
                            }
                    ?> 
                         
                        </div>
                    <?php
                        } 
                    ?>
                   
                    <div class="row">
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" id="fileField" name="uploadImg[]" multiple class="form-control" accept="image/*" hidden="true">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                            
                            <input type="submit" class="btn btn-success" name="submit_image" value="Upload Image">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                       
                      </div> -->
                      <!--  <div class="form-group row" id="otp">
                      
                       

                      </div> --> 
                      
                    </form>

                     
                    </div>
                </div>


               <?php 
               
                        } 
                    } 
                ?> 
                 
            </div>
           
        </div>
        <?php 
            }else{
                echo "Not a valid order";
            }
        ?>

    </div>
</div>
  
<?php include 'footer.php'?>