<?php  if (count($successMsg) > 0) : ?>
  <div class="success"> 
  	<?php foreach ($successMsg as $successMessage) : ?>
  	  <?php echo $successMessage ?><br>
  	<?php endforeach ?>
  </div>
<?php  endif ?>