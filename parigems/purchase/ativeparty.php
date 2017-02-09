<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $id=$_GET['id'];
 $changestatus="update party set partystatus='1' where partyid='$id'";
 if(mysqli_query($con,$changestatus))
   {
	 
		echo str_replace(' ', '', 1);
   }
 ?>