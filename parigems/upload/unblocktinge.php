<?php
   include "../common/config.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   $id=$_GET['id'];
  
	$updateqry="Update tinge set status='1' where id=$id";
      if(mysqli_query($con,$updateqry))
   {
		echo str_replace(' ', '', 1);
   }
				 

   ?>