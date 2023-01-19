 <!-- footer content -->
        <footer>
          
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script>  
    CKEDITOR.replace('description');  
    CKEDITOR.replace('editor2');  
  
    function getData() {  
        //Get data written in first Editor   
        var editor_data = CKEDITOR.instances['editor1'].getData();  
        //Set data in Second Editor which is written in first Editor  
        CKEDITOR.instances['editor2'].setData(editor_data);  
    }  
</script>
   
    
    <script src="../js/myScript.js" type="text/javascript"></script>
   <!--  <script src="../js/ckeditor.js" type="text/javascript"></script> -->
    <!-- jQuery -->
    <script src="<?php echo $baseurl?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $baseurl?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $baseurl?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $baseurl?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo $baseurl?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo $baseurl?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo $baseurl?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $baseurl?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo $baseurl?>/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo $baseurl?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo $baseurl?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $baseurl?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo $baseurl?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo $baseurl?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo $baseurl?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo $baseurl?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo $baseurl?>/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- DateJS -->
    <script src="<?php echo $baseurl?>/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo $baseurl?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo $baseurl?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo $baseurl?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $baseurl?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

     <!-- Switchery -->
     <script src="<?php echo $baseurl?>/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo $baseurl?>/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo $baseurl?>/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo $baseurl?>/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo $baseurl?>/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo $baseurl?>/vendors/starrr/dist/starrr.js"></script>
       <!-- Datatables -->
       <script src="<?php echo $baseurl?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo $baseurl?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo $baseurl?>/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
 
 
	
  </body>
     
</html>
