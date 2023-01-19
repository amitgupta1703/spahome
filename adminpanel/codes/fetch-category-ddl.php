<?php
include '../dbwe.php';
if(isset($_POST['main_category'])){
    $main_category =$_POST['main_category'];
    $options=' <select name="category_name" required="required" id="category_name" onchange="selectSubCategory(event)" class="form-control ">
    <option value="-1">----Select Category----</option>';
    $user_check_query = "select * from categories where main_category_name='$main_category' and status='active' order by id desc"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
    while($row = mysqli_fetch_row($results)){
            $options.= '<option value="'.$row[1].'">  '.$row[1].'</option>'; 
        }
    }else{
        $options.= '<option value="-1">No record found!</option>';
    }
    $options.='</select>';
 
    $data = array( 
        'ddl' => $options
    );
    
    echo json_encode($options);
}


if(isset($_POST['sub_category'])){
    $sub_category =$_POST['sub_category'];
    $options=' <select name="subcategory_name" id="subcategory_name" required="required"  class="form-control ">
    <option value="-1">----Select Sub Category----</option>';
    $user_check_query = "select * from subcategories where category_name='$sub_category' and status='active' order by id desc"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
    while($row = mysqli_fetch_row($results)){
            $options.= '<option value="'.$row[0].','.$row[1].'">  '.$row[1].'</option>'; 
        }
    }
    else{
        $options.= '<option value="-1">No record found!</option>';
    }
    $options.='</select>';
 
    $data = array(
        'ddl' => $options
    );
    
    echo json_encode($options);
}
 

if(isset($_POST['partners_id'])){
   // echo "abc";
    $partners_id =$_POST['partners_id'];
    $data;
    $fetchData=array();
    $spa_assign_lead_query = "select * from spa_assign_lead where partner_id='$partners_id'"; 
    $resultsData = mysqli_query($db, $spa_assign_lead_query); 
    $count=mysqli_num_rows($resultsData);
    if($count>0){
        $fetchData= mysqli_fetch_assoc($resultsData);
    }
    if($fetchData){
        $fetchData=$fetchData;
    }else{
        $fetchData=array('bookingStatus'=>'Not Assign');
    }
        
      

    $partners_registration_query = "select * from partners_registration where partners_id='$partners_id' limit 1"; 
    $results = mysqli_query($db, $partners_registration_query); 
    if (mysqli_num_rows($results) >0) { 
        $item = mysqli_fetch_assoc($results);
        $data = array(
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
            'lead_count'=>$count,
            'bookingStatus'=>$fetchData['bookingStatus']
        );
    }
     
    //echo $data;
    echo json_encode($data);
}

if(isset($_POST['states'])){
    $states1 =$_POST['states']; 
   $checkbox='';

    $user_check_query = "SELECT state FROM ourlocations where state='$states1' and status='active' GROUP BY state"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        while($row = mysqli_fetch_row($results)){ 
        $state=$row[0];
            $user_check_query1 = "select * from ourlocations where state='$state' and status='active' order by id desc"; 
            $results1 = mysqli_query($db, $user_check_query1); 
            if (mysqli_num_rows($results1) >0) {  
            while($row = mysqli_fetch_row($results1)){
                    $checkbox.= '<div class="chkbx col-md-6 col-xs-6 mt-2"><input type="checkbox" name="cities[]"  value="'.$row[1].'"> '.$row[1].'</div>';  
                }
                
            } 
        }
    }else{
        $checkbox.= '<div class="chkbx col-md-6 col-xs-6 mt-2">No record Found</div>';
    }

echo json_encode($checkbox);
}

?>