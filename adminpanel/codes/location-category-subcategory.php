
<?php   
include 'dbwe.php';
// echo '$baseurl '.$baseurl;
unset($errors); 
$errors = array(); 

unset($successMsg); 

$successMsg = array(); 

if(isset($_POST['add_location'])){
 
$locationName=mysqli_real_escape_string($db, $_POST['location_name']);
$city =mysqli_real_escape_string($db, $_POST['city']);
$state=mysqli_real_escape_string($db, $_POST['state']); 
$pincode = mysqli_real_escape_string($db, $_POST['pincode']);   
if($state=="-1"){
    array_push($errors, "Please select state ");
} 

//echo 'l:'.$location.'::n: '.$name.' :e: '.$email.': c: '.$contact.': cn: '.$company_name;
  
if (empty($locationName)) { array_push($errors, "Please enter location"); } 
if (empty($city)) { array_push($errors, "Please enter city"); } 
if (empty($state)) { array_push($errors, "Please enter state"); } 
if (empty($pincode)) { array_push($errors, "Please enter pincode"); } 

if(is_numeric($pincode)!=1){
    array_push($errors, "Please enter valid pincode");
}
if(strlen($pincode)!=6){
    array_push($errors, "Please enter six digit pincode");
}

$user_check_query = "select * from ourlocations where (locationName='$locationName')  limit 1"; 
$results = mysqli_query($db, $user_check_query); 
if (mysqli_num_rows($results) >0) { 
    $row = mysqli_fetch_array($results); 
    $locationName1=$row[1]; 
    if($locationName1==$locationName){
        array_push($errors, "Location already in database");
    }     
}
date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $status="active"; 
    if (count($errors) == 0) {  
        $stmt = $db->prepare("INSERT INTO ourlocations(locationName,city,state,pincode,status,date) VALUES(?,?,?,?,?,?)");
        $rc=$stmt->bind_param("ssssss", $locationName,$city,$state,$pincode,$status,$date);
        $rc=$stmt->execute(); 
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
            array_push($errors, "Error occurs while submitting data, Retry again!");
        }else{
           
            $locationName="";  
            $location="";
            $city="";
            $pincode="";  
            array_push($successMsg, "Location added successfully!");
        }     
    }
}

//add main category


if(isset($_POST['add_main_category'])){
 
    $main_category_name=mysqli_real_escape_string($db, $_POST['main_category_name']);

    $uploadBannerImgName=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["name"]); 
    $uploadBannerImgsize=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["size"]); 
    $uploadBannerImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["tmp_name"]); 
    $uploadBannerImgUrl="";
    if($uploadBannerImgName==''){
        array_push($errors, "Please upload banner");
    }else{
       // echo "else";
        $folderPath="images/sliders/";
        $uploadBannerImgUrl=saveUploadImage($folderPath,$uploadBannerImgName,$uploadBannerImgsize,$uploadBannerImgTmp_name,$db,$baseurl);
       // print_r("sd bsndfbnsf ",$uploadBannerImgUrl);
        //echo '<br> anbasndbnasbdnbasnd:: '.$uploadBannerImgUrl.'</br>';
    }
   
//echo "uploadBannerImg::: ".$uploadBannerImgUrl;
    $uploadspaImgName=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["name"]); 
    $uploadspaImgsize=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["size"]); 
    $uploadspaImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["tmp_name"]); 

    $uploadspaImgUrl="";
    if($uploadspaImgName==''){
        array_push($errors, "Please upload banner");
    }else{
        $folderPath="images/our_spa/";
        $uploadspaImgUrl=saveUploadImage($folderPath,$uploadspaImgName,$uploadspaImgsize,$uploadspaImgTmp_name,$db,$baseurl);
    }
   
    $uploadOfferImgName=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["name"]); 
    $uploadOfferImgsize=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["size"]); 
    $uploadOfferImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["tmp_name"]); 
    $uploadOfferImgUrl="";
    if($uploadOfferImgName==''){
        array_push($errors, "Please upload spa image");
    }else{
        $folderPath="images/offers/";
        $uploadOfferImgUrl=saveUploadImage($folderPath,$uploadOfferImgName,$uploadOfferImgsize,$uploadOfferImgTmp_name,$db,$baseurl);
    }
    
    $uploadimage1Name=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["name"]); 
    $uploadimage1size=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["size"]); 
    $uploadimage1Tmp_name=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["tmp_name"]); 
    $uploadimage1Url="";
    if($uploadimage1Name==''){
        //array_push($errors, "Please upload spa image");
    }else{
        $folderPath="images/categoryImg/";
        $uploadimage1Url=saveUploadImage($folderPath,$uploadimage1Name,$uploadimage1size,$uploadimage1Tmp_name,$db,$baseurl);
    }
   
    $uploadimage2Name=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["name"]); 
    $uploadimage2size=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["size"]); 
    $uploadimage2Tmp_name=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["tmp_name"]); 
    $uploadimage2Url="";
    if($uploadimage2Name==''){
        //array_push($errors, "Please upload spa image");
    }else{
        $folderPath="images/categoryImg/";
        $uploadimage2Url=saveUploadImage($folderPath,$uploadimage2Name,$uploadimage2size,$uploadimage2Tmp_name,$db,$baseurl);
    }
    
    
    $locationsId='';
    //echo 'lebn'.strlen($_POST['check_list']);
    if(isset($_POST['main_check_list']) ){ 
        foreach($_POST['main_check_list'] as $checkbox) {
            //echo 's'.$checkbox;
            $locationsId=$locationsId.','.$checkbox;
         }
         $locationsId=$locationsId;
    } else{
        array_push($errors, "Please select locations");
    }

    //saveUploadImage($folderPath,$fileId);
    //saveUploadImage($folderPath,$fileId);
    //saveUploadImage($folderPath,$fileId);
    //saveUploadImage($folderPath,$fileId);
    //saveUploadImage($folderPath,$fileId);
   
    $user_check_query = "select * from main_category where (main_category_name='$main_category_name')  limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $categories1=$row[1]; 
        if($categories1==$main_category_name){
            array_push($errors, "Main Category already in database");
        }     
    }
      
    date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $status="active"; 
        $imgUrl;
        //echo $main_category_name,$status,$uploadimage1Url,$locationsId,$date,$uploadBannerImgUrl,$uploadspaImgUrl,$uploadOfferImgUrl,$uploadimage2Url;
        if (count($errors) == 0) {  
            $stmt = $db->prepare("INSERT INTO main_category(main_category_name,status,imageUrl,location,date,bannerImg,ourspaImg,offerImg,imageUrl2) VALUES(?,?,?,?,?,?,?,?,?)");
            $rc=$stmt->bind_param("sssssssss", $main_category_name,$status,$uploadimage1Url,$locationsId,$date,$uploadBannerImgUrl,$uploadspaImgUrl,$uploadOfferImgUrl,$uploadimage2Url);
            $rc=$stmt->execute(); 
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                //echo "if par dattete  after";
                array_push($errors, "Error occurs while submitting data, Retry again!");
            }else{
               
                //echo "if par dattete  else";
                $main_category_name="";
                array_push($successMsg, "Main Category added successfully!");
            }     
        }
    }


    if(isset($_POST['edit_main_category'])){
 
        $main_category_name=mysqli_real_escape_string($db, $_POST['main_category_name']);
        $id=mysqli_real_escape_string($db, $_POST['id']);

        $bannerImg=mysqli_real_escape_string($db, $_POST['bannerImg']);
        $ourspaImg=mysqli_real_escape_string($db, $_POST['ourspaImg']);
        $offerImg=mysqli_real_escape_string($db, $_POST['offerImg']);
        $imageUrl=mysqli_real_escape_string($db, $_POST['imageUrl']);
        $imageUrl2=mysqli_real_escape_string($db, $_POST['imageUrl2']);

        $uploadBannerImgName=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["name"]); 
        $uploadBannerImgsize=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["size"]); 
        $uploadBannerImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadBannerImg"]["tmp_name"]); 
        $uploadBannerImgUrl="";
        if($uploadBannerImgName==''){
            //array_push($errors, "Please upload banner");
            $uploadBannerImgUrl=$bannerImg;
        }else{
           // echo "else";
            $folderPath="images/sliders/";
            $uploadBannerImgUrl=saveUploadImage($folderPath,$uploadBannerImgName,$uploadBannerImgsize,$uploadBannerImgTmp_name,$db,$baseurl);
           // print_r("sd bsndfbnsf ",$uploadBannerImgUrl);
            //echo '<br> anbasndbnasbdnbasnd:: '.$uploadBannerImgUrl.'</br>';
        }
       
    //echo "uploadBannerImg::: ".$uploadBannerImgUrl;
        $uploadspaImgName=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["name"]); 
        $uploadspaImgsize=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["size"]); 
        $uploadspaImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadspaImg"]["tmp_name"]); 
    
        $uploadspaImgUrl="";
        if($uploadspaImgName==''){
            //array_push($errors, "Please upload spa image");
            $uploadspaImgUrl=$ourspaImg;
        }else{
            $folderPath="images/our_spa/";
            $uploadspaImgUrl=saveUploadImage($folderPath,$uploadspaImgName,$uploadspaImgsize,$uploadspaImgTmp_name,$db,$baseurl);
        }
       
        $uploadOfferImgName=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["name"]); 
        $uploadOfferImgsize=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["size"]); 
        $uploadOfferImgTmp_name=mysqli_real_escape_string($db, $_FILES["uploadOfferImg"]["tmp_name"]); 
        $uploadOfferImgUrl="";
        if($uploadOfferImgName==''){
            //array_push($errors, "Please upload spa image");
            $uploadOfferImgUrl=$offerImg;
        }else{
            $folderPath="images/offers/";
            $uploadOfferImgUrl=saveUploadImage($folderPath,$uploadOfferImgName,$uploadOfferImgsize,$uploadOfferImgTmp_name,$db,$baseurl);
        }
        
        $uploadimage1Name=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["name"]); 
        $uploadimage1size=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["size"]); 
        $uploadimage1Tmp_name=mysqli_real_escape_string($db, $_FILES["uploadimage1"]["tmp_name"]); 
        $uploadimage1Url="";
        if($uploadimage1Name==''){
            //array_push($errors, "Please upload spa image");
            $uploadimage1Url=$imageUrl;
        }else{
            $folderPath="images/categoryImg/";
            $uploadimage1Url=saveUploadImage($folderPath,$uploadimage1Name,$uploadimage1size,$uploadimage1Tmp_name,$db,$baseurl);
        }
       
        $uploadimage2Name=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["name"]); 
        $uploadimage2size=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["size"]); 
        $uploadimage2Tmp_name=mysqli_real_escape_string($db, $_FILES["uploadimage2"]["tmp_name"]); 
        $uploadimage2Url="";
        if($uploadimage2Name==''){
            //array_push($errors, "Please upload spa image");
            $uploadimage2Url=$imageUrl2;
        }else{
            $folderPath="images/categoryImg/";
            $uploadimage2Url=saveUploadImage($folderPath,$uploadimage2Name,$uploadimage2size,$uploadimage2Tmp_name,$db,$baseurl);
        }
        
        
        $locationsId='';
        //echo 'lebn'.strlen($_POST['check_list']);
        if(isset($_POST['main_check_list']) ){ 
            foreach($_POST['main_check_list'] as $checkbox) {
                //echo 's'.$checkbox;
                $locationsId=$locationsId.','.$checkbox;
             }
             $locationsId=$locationsId;
        } else{
            array_push($errors, "Please select locations");
        }
    
        //saveUploadImage($folderPath,$fileId);
        //saveUploadImage($folderPath,$fileId);
        //saveUploadImage($folderPath,$fileId);
        //saveUploadImage($folderPath,$fileId);
        //saveUploadImage($folderPath,$fileId);
       
       /*  $user_check_query = "select * from main_category where (main_category_name='$main_category_name')  limit 1"; 
        $results = mysqli_query($db, $user_check_query); 
        if (mysqli_num_rows($results) >0) { 
            $row = mysqli_fetch_array($results); 
            $categories1=$row[1]; 
            if($categories1==$main_category_name){
                array_push($errors, "Main Category already in database");
            }     
        } */
          
        date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
            //$status="active"; 
            $imgUrl;
           // echo $main_category_name,',',$uploadimage1Url,',',$locationsId,',',$date,',',$uploadBannerImgUrl,',',$uploadspaImgUrl,',',$uploadOfferImgUrl,',',$uploadimage2Url,',',$id;
            if (count($errors) == 0) {  
                $stmt = $db->prepare("update main_category set main_category_name=?,imageUrl=?,location=?,date=?,bannerImg=?,ourspaImg=?,offerImg=?,imageUrl2=? where id=?");
                $rc=$stmt->bind_param("sssssssss", $main_category_name,$uploadimage1Url,$locationsId,$date,$uploadBannerImgUrl,$uploadspaImgUrl,$uploadOfferImgUrl,$uploadimage2Url,$id);
                $rc=$stmt->execute(); 
                if ( false===$rc ) {
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                   // echo "if par dattete  after";
                    array_push($errors, "Error occurs while submitting data, Retry again!");
                }else{
                   
                   // echo "if par dattete  else";
                    $main_category_name="";
                    array_push($successMsg, "Main Category updated successfully!");
                }     
            }
        }

// add category code

if(isset($_POST['add_category'])){
 
    $category_name=mysqli_real_escape_string($db, $_POST['category_name']); 
    $main_category_name=mysqli_real_escape_string($db, $_POST['main_category_name']);  
    if($main_category_name=="-1"){
        array_push($errors, "Please select main category ");
    }
    $locationsId='0';
    //echo 'lebn'.strlen($_POST['check_list']);
    if(isset($_POST['check_list']) ){ 
        foreach($_POST['check_list'] as $checkbox) {
            //echo 's'.$checkbox;
            $locationsId=$locationsId.','.$checkbox;
         }
         $locationsId=$locationsId;
    } else{
        array_push($errors, "Please select locations");
    }
   
    /* $user_check_query = "select * from categories where (category_name='$category_name')  limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $categories1=$row[1]; 
        if($categories1==$category_name){
            array_push($errors, "Category already in database");
        }     
    } */


    $user_check_query = "select * from categories where category_name='$category_name' and main_category_name='$main_category_name'  limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $categories1=$row[1]; 
        if($categories1==$category_name){
            array_push($errors, "Category and Main Category already in database");
        }     
    }
    date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $status="active"; 
        if (count($errors) == 0) {  
            $stmt = $db->prepare("INSERT INTO categories(category_name,locationId,main_category_name,status,date) VALUES(?,?,?,?,?)");
            $rc=$stmt->bind_param("sssss", $category_name,$locationsId,$main_category_name,$status,$date);
            $rc=$stmt->execute(); 
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                array_push($errors, "Error occurs while submitting data, Retry again!");
            }else{
               
                $category_name="";  
                $main_category_name="";
                array_push($successMsg, "Category added successfully!");
            }     
        }
    }

    //edit category

    if(isset($_POST['edit_category'])){
 
        $category_name=mysqli_real_escape_string($db, $_POST['category_name']); 
        $id=mysqli_real_escape_string($db, $_POST['id']);
        $main_category_name=mysqli_real_escape_string($db, $_POST['main_category_name']);  
        if($main_category_name=="-1"){
            array_push($errors, "Please select main category ");
        }
        $locationsId='0';
        //echo 'lebn'.strlen($_POST['check_list']);
        if(isset($_POST['check_list']) ){ 
            foreach($_POST['check_list'] as $checkbox) {
                //echo 's'.$checkbox;
                $locationsId=$locationsId.','.$checkbox;
             }
             $locationsId=$locationsId;
        } else{
            array_push($errors, "Please select locations");
        }
       
       /*  $user_check_query = "select * from categories where (category_name='$category_name')  limit 1"; 
        $results = mysqli_query($db, $user_check_query); 
        if (mysqli_num_rows($results) >0) { 
            $row = mysqli_fetch_array($results); 
            $categories1=$row[1]; 
            if($categories1==$category_name){
                array_push($errors, "Category already in database");
            }     
        } */
        date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
            $status="active"; 
            if (count($errors) == 0) {  
                $stmt = $db->prepare("Update categories set category_name=?,locationId=?,main_category_name=?,date=? where id=?");
                $rc=$stmt->bind_param("sssss", $category_name,$locationsId,$main_category_name,$date,$id);
                $rc=$stmt->execute(); 
                if ( false===$rc ) {
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                    array_push($errors, "Error occurs while submitting data, Retry again!");
                }else{
                   
                    $category_name="";  
                    $main_category_name="";
                    array_push($successMsg, "Category updated successfully!");
                }     
            }
        }

    // add sub category code


 
if(isset($_POST['add_sub_category'])){
 
    
     
    //echo 'lebn'.strlen($_POST['check_list']);
    $category = mysqli_real_escape_string($db, $_POST['category_name']);
    $main_category = mysqli_real_escape_string($db, $_POST['main_category_name']);
    $subcategory_name=mysqli_real_escape_string($db, $_POST['subcategory_name']); 
    if($category=="-1"){
        array_push($errors, "Please select category ");
    } 
    if($main_category=="-1"){
        array_push($errors, "Please select main category ");
    } 
    $locationId=0;
    $category_id=1;
    $category_name=$category;
    $user_check_query = "select * from subcategories where subcategory_name='$subcategory_name' and category_name='$category' and main_category='$main_category'  limit 1"; 
    $results = mysqli_query($db, $user_check_query); 
    if (mysqli_num_rows($results) >0) { 
        $row = mysqli_fetch_array($results); 
        $subcategory_name1=$row[1]; 
        if($subcategory_name1==$subcategory_name){
            //array_push($errors, "Sub Category already in database");
        }     
    }
    date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $status="active"; 
        if (count($errors) == 0) {  
            $stmt = $db->prepare("INSERT INTO subcategories(subCategory_name,category_id,category_name,locationId,status,date,main_category) VALUES(?,?,?,?,?,?,?)");
            $rc=$stmt->bind_param("sssssss", $subcategory_name,$category_id,$category_name,$locationId,$status,$date,$main_category);
            $rc=$stmt->execute(); 
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
                array_push($errors, "Error occurs while submitting data, Retry again!");
            }else{
               
                $subCategory_name="";  
                $category="";
                array_push($successMsg, "Category added successfully!");
            }     
        }
    }


    //edit sub categories

    if(isset($_POST['edit_sub_category'])){
 
        $subcategory_name=mysqli_real_escape_string($db, $_POST['subcategory_name']); 
        $id=mysqli_real_escape_string($db, $_POST['id']);
        //echo 'lebn'.strlen($_POST['check_list']);
        $category = mysqli_real_escape_string($db, $_POST['category_name']);
        $main_category = mysqli_real_escape_string($db, $_POST['main_category_name']);
        if($main_category=="-1"){
            array_push($errors, "Please select main category ");
        } 
        if($category=="-1"){
            array_push($errors, "Please select category ");
        } 
        $locationId=0;
        $category_id=1;
        $category_name=$category;
         
        date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');
            $status="active"; 
            if (count($errors) == 0) {  
                $stmt = $db->prepare("update subcategories set subCategory_name=?,category_id=?,category_name=?,locationId=?,date=?,main_category=? where id=?");
                $rc=$stmt->bind_param("sssssss", $subcategory_name,$category_id,$category_name,$locationId,$date,$main_category,$id);
                $rc=$stmt->execute(); 
                if ( false===$rc ) {
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                    array_push($errors, "Error occurs while submitting data, Retry again!");
                }else{
                   
                    $subCategory_name="";  
                    $category="";
                    array_push($successMsg, "Sub Category updated successfully!");
                }     
            }
        }




    if(isset($_POST['activate_location']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update ourlocations set status='active' where id='$id' ";
        mysqli_query($db, $user_check_query);
      }
    
      if(isset($_POST['deactivate_location']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update ourlocations set status='deactive'where id='$id' ";
        mysqli_query($db, $user_check_query);
      }

      if(isset($_POST['delete_location']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $stmt = $db->prepare("delete from ourlocations where id=?");
            $rc=$stmt->bind_param("s", $id);
            $rc=$stmt->execute(); 
         
      }



      
    if(isset($_POST['activate_category']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update categories set status='active' where id='$id' ";
        mysqli_query($db, $user_check_query);
      }
    
      if(isset($_POST['deactivate_category']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update categories set status='deactive'where id='$id' ";
        mysqli_query($db, $user_check_query);
      }

      if(isset($_POST['delete_category']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $stmt = $db->prepare("delete from categories where id=?");
            $rc=$stmt->bind_param("s", $id);
            $rc=$stmt->execute(); 
         
      }

      if(isset($_POST['activate_subcategory']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update subcategories set status='active' where id='$id' ";
        mysqli_query($db, $user_check_query);
      }
    
      if(isset($_POST['deactivate_subcategory']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update subcategories set status='deactive'where id='$id' ";
        mysqli_query($db, $user_check_query);
      }

      if(isset($_POST['activate_main_category']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update main_category set status='active' where id='$id' ";
        mysqli_query($db, $user_check_query);
      }
    
      if(isset($_POST['deactivate_main_category']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $user_check_query = "update main_category set status='deactive'where id='$id' ";
        mysqli_query($db, $user_check_query);
      }

      if(isset($_POST['delete_subcategory']) && isset($_SESSION['spa_userName'])){
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $stmt = $db->prepare("delete from subcategories where id=?");
            $rc=$stmt->bind_param("s", $id);
            $rc=$stmt->execute(); 
         
      }

      function saveUploadImage($folderPath,$filename,$filessize,$fileTemName,$db,$baseurl){
          //$db1=$db;
        //$db = mysqli_connect('localhost:3306', 'root', 'shiv', 'spa2'); 
        //$db = mysqli_connect('127.0.0.1:3306', 'u231784203_spadbun', '0Z^Bj:^Z3=Wk', 'u231784203_spadb');  
        //echo $folderPath,',',$filename,',',$filessize,$fileTemName;

            $allowedExts = array(
                "jpg",  "jpeg",  "png", "gif"
            ); 
            
            $allowedMimeTypes = array(  'image/gif', 'image/jpeg', 'image/png', 'image/jpg'
            );
        
            $queryGetCount="select count(*) as total from main_category";
            $result = mysqli_query($db, $queryGetCount);
            $allRecord=mysqli_fetch_assoc($result);
            $totalRecord;
            
            if($allRecord>0)
            {
                $totalRecord=$allRecord['total'];
                $totalRecord=$totalRecord+1;
            }
        
            //echo "total count :: ". $totalRecord;
            $target_path = $folderPath;
            //$file = $_POST['uploadResume'];
            $target_path = $target_path.basename( $totalRecord.'_'. $filename); 
            $file_name= $totalRecord.'_'.$filename;
            $file_name=strtolower($file_name);
            $temp = explode('.', $file_name);
        
            $extension = end($temp);  
            if ( 1048576 < $filessize  ) { 
            array_push($errors, "File size should be less than 1MB ");
            }
    
            if ( !( in_array($extension, $allowedExts ) ) ) {
                array_push($errors, "Please upload jpeg, png, gif ");
            }
            else{
                $destinationUrl='./../'.$target_path;
                //echo "desigjhsjfg: ".$destinationUrl;
            copy($fileTemName, $destinationUrl); 
            if(copy($fileTemName, $destinationUrl)){
                //echo "file succes<br>";
            
            }else{
               // echo "file not succes<br>";
            }
            }
            //echo $target_path.'<br>';
            return $target_path;
      }
?>