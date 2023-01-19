
<style>
    .category a {
        cursor: pointer;
        width: 100%;
        display: block;
        padding-right: 10px;
    }

    .category span {
        float: right;
        /* font-size: 18px !important; */
    }

    .hr {
        margin-top: 0.7rem;
        margin-bottom: 0.7rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    .mainCategory:hover{
        background-color: #ea728c;
        color: #fff;
        opacity:0.9;
        cursor:pointer;
        text-decoration:none;
    }
    
</style>
<div class="panel-group" id="accordion">
    <?php  
    $mainCatName;
    $cat;
     if(isset($_POST['search'])){
        $postData=$_POST['services_name'];
        if($postData=="-1"){
            echo "<script>window.location.href='index'</script>";
        }
        $_SESSION['search_data']=$postData;
        $user_check_query;
        }else if((isset($_GET['services']) && $_GET['services']!='')){ 
            $postData=str_replace("-"," ",$_GET['services']);
            $_SESSION['search_data']=$postData;
        }else if((isset($_GET['services_sub_cat']) && isset($_GET['cat']) && $_GET['services_sub_cat']!='')){ 
            $url=$_SERVER['REQUEST_URI'];
            // echo "url: ".$url;
             $parameters=$_GET['services_sub_cat']; 
            // echo "<br>para: ".$parameters;
             $postData=str_replace("-"," ",$parameters);
             $postData=str_replace("=","",$postData);
            $_SESSION['search_data']=$postData;
            //echo "pso: ".$postData;
            $cat=str_replace("-"," ",$_GET['cat']);

            $get_category_query = "select * from categories where category_name='$cat'"; 
            $results3 = mysqli_query($db, $get_category_query);
            if (mysqli_num_rows($results3) >0) { 
                $mainCatName=mysqli_fetch_assoc($results3);
            }
        }

                         
        $user_check_query = "select * from main_category where status='active' order by id asc"; 
        $results = mysqli_query($db, $user_check_query);
        $count=0;
        $catCount=0;
        $subCatCount=0;
        $postData;
 
         
        if (mysqli_num_rows($results) >0) { 
        while($row = mysqli_fetch_row($results)){ 
           // echo "nn",$_SESSION['search_data'];
          
        echo ' <div class="category search">
                    <div class=" panel-heading" id="headingOne"> 
                        
                        <h1 class="btn-link theme-color panel-title mainCategory" data-toggle="collapse" data-target="#collapseMaincategory'.$row[0].'" aria-expanded="true" aria-controls="collapseMaincategory'.$row[0].'">
                        '.$row[1].'<span><i class="fa fa-angle-down"></i></span>
                        </h1> 
                    </div>
                    <div id="collapseMaincategory'.$row[0].'" class="';if(((isset($_POST['search']) || isset($_GET['services'])) && (strtolower($_SESSION['search_data']))==strtolower($row[1])) || ((isset($_GET['services_sub_cat']) && (strtolower($mainCatName['main_category_name']))==strtolower($row[1])))){echo 'in collapse show';} else{echo 'collapse';} echo '" aria-labelledby="heading'.$row[0].'" data-parent="#accordionExample">
                            <div class="">
                        <div class="accordion" id="accordionExample">';
                        $main_category_name=$row[1];                    
                        $category_query = "select * from categories where  main_category_name='$main_category_name'"; 
                        $results1 = mysqli_query($db, $category_query); 
                        if (mysqli_num_rows($results1) >0) { 
                        while($rowCat = mysqli_fetch_row($results1)){
                            
                            $category_name=$rowCat[1]; 
                            echo '
                            <div class="category search">
                                <div class="pl-2" id="headingOne"> 
                                    <a class="btn-link theme-color" data-toggle="collapse" data-target="#collapsecategory'.$rowCat[0].'" aria-expanded="true" aria-controls="collapsecategory'.$rowCat[0].'">
                                    '.$rowCat[1].'<span><i class="fa fa-angle-down"></i></span>
                                    </a> 
                                </div>
                        
                            <div id="collapsecategory'.$rowCat[0].'" class="';if(isset($_GET['cat']) && (strtolower($cat)==strtolower($category_name))){echo 'in collapse show';} else{echo 'collapse';} echo '" aria-labelledby="heading'.$rowCat[0].'" data-parent="#accordionExample">
                              <div class="">
                                <ul>';
                                $subCat_query = "select * from subcategories where category_name='$category_name' and status='active'"; 
                               
                                $resultsubCat_query = mysqli_query($db, $subCat_query); 
                                if (mysqli_num_rows($resultsubCat_query) >0) { 
                                while($rowSubCat = mysqli_fetch_row($resultsubCat_query)){
                                    //echo "m_c:: ".$rowSubCat['7'];
                                    $categoryNames=str_replace(" ","-",$category_name);
                                    $categoryNames=str_replace("&","*",$categoryNames);
                                    $subCat=str_replace(" ","-",$rowSubCat[1]);
                                    $subCat=str_replace("&","*",$subCat);
                                    $mCat=str_replace(" ","-",$main_category_name);
                                    $mCat=str_replace("&","*",$mCat);
                                    
                                         echo '<li><a href="'.$baseurl.'/'.'services-list/'.strtolower($mCat).'/'.strtolower($categoryNames).'/'.strtolower($subCat).'">'.$rowSubCat[1].'</a></li>';
                                    }
                                }
                               echo ' </ul>
                              </div>
                            </div>
                          </div><hr class="hr">
                            ';

                            
                            }
                        } 
                        
                      echo  '</div></div>
                    </div>
                </div>'; 
            }
        }
    ?>

</div>