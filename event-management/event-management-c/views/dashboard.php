<!-- /.col -->
<div class="row-md-4" style="margin:20px 80px;">
<?php 
$type = 'admin';
if($type == 'admin' || $type == 'teacher') {
	include('eventform.php');
}
else {
	echo "&nbsp;";
}
?>	
</div>
<!-- /.col -->
<div class="row-md-8" style="margin:20px" >
  <?php include('calendar.php'); ?>
</div>

