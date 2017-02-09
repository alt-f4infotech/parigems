<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $id=$_GET['id'];
  $action=$_GET['action'];
  if($action=='0'){
 $changestatus="update location_master set locationstatus='0' where locationid='$id'";
  }else{
	$changestatus="update location_master set locationstatus='1' where locationid='$id'";
  }
 if(mysqli_query($con,$changestatus))
   {
	 
		echo str_replace(' ', '', 1);
   }
 ?>