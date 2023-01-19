<?php  
$subCat_query = "select * from subcategories where category_name='$category_name'"; 
    $resultsubCat_query = mysqli_query($db, $subCat_query); 
    if (mysqli_num_rows($resultsubCat_query) >0) { 
    while($rowSubCat = mysqli_fetch_row($resultsubCat_query)){
                echo '<li><a href="">'.$resultsubCat_query[1].'</a></li>';
        }
    } 
?>