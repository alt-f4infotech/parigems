<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $id=$_GET['userid'];
  
	$updateqry="Update login set loginstatus='0' where userid=$id";
      if(mysqli_query($con,$updateqry))
   {
	  $updateqry2="Update basic_details set userstatus='0' where userid=$id";
      if(mysqli_query($con,$updateqry2))
   {
		echo str_replace(' ', '', 1);
   }
   }
				 

   ?>