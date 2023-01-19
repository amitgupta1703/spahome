

<?php include 'header.php' ;
include 'top-nav.php';
include 'dbwe.php';
if(isset($_POST['close'])){ 
  $id = mysqli_real_escape_string($db, $_POST['id']);  
  $user_check_query = "update partners_registration set shopStatus='close' where partners_id='$id' ";
  mysqli_query($db, $user_check_query);
  echo '<script>(function(){window.location.href ="dashboard.php";})();</script>';
}

if(isset($_POST['open']) && isset($_SESSION['U_Name_partner'])){ 
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $user_check_query = "update partners_registration set shopStatus='open' where partners_id='$id' ";
  mysqli_query($db, $user_check_query);
 echo '<script>(function(){window.location.href ="dashboard.php";})();</script>';
}

?>
 
 
<style>
  .row
  {
  padding:6px 0px !important;
  }
  button
  {
  width:150px !important;
  }
  .cke_top,
  .cke_bottom {
      display: none !important;
  }

</style>

<div class="right_col" role="main" style="min-height: 3787px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                
              </div>

             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        
       
<?php include 'footer.php'?>